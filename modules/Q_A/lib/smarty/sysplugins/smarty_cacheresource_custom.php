<?php
/**
 * Smarty Internal Plugin
 *
 * @package Smarty
 * @subpackage Cacher
 */

/**
 * Cache Handler API
 *
 * @package Smarty
 * @subpackage Cacher
 * @author Rodney Rehm
 */
abstract class Smarty_CacheResource_Custom extends Smarty_CacheResource
{
    /**
     * fetch cached content and its modification time from data source
     *
     * @param  string  $id         unique cache content identifier
     * @param  string  $name       template name
     * @param  string  $titanium_cache_id   cache id
     * @param  string  $compile_id compile id
     * @param  string  $content    cached content
     * @param  integer $mtime      cache modification timestamp (epoch)
     * @return void
     */
    abstract protected function fetch($id, $name, $titanium_cache_id, $compile_id, &$content, &$mtime);

    /**
     * Fetch cached content's modification timestamp from data source
     *
     * {@internal implementing this method is optional.
     *  Only implement it if modification times can be accessed faster than loading the complete cached content.}}
     *
     * @param  string          $id         unique cache content identifier
     * @param  string          $name       template name
     * @param  string          $titanium_cache_id   cache id
     * @param  string          $compile_id compile id
     * @return integer|boolean timestamp (epoch) the template was modified, or false if not found
     */
    protected function fetchTimestamp($id, $name, $titanium_cache_id, $compile_id)
    {
        return null;
    }

    /**
     * Save content to cache
     *
     * @param  string       $id         unique cache content identifier
     * @param  string       $name       template name
     * @param  string       $titanium_cache_id   cache id
     * @param  string       $compile_id compile id
     * @param  integer|null $exp_time   seconds till expiration or null
     * @param  string       $content    content to cache
     * @return boolean      success
     */
    abstract protected function save($id, $name, $titanium_cache_id, $compile_id, $exp_time, $content);

    /**
     * Delete content from cache
     *
     * @param  string       $name       template name
     * @param  string       $titanium_cache_id   cache id
     * @param  string       $compile_id compile id
     * @param  integer|null $exp_time   seconds till expiration time in seconds or null
     * @return integer      number of deleted caches
     */
    abstract protected function delete($name, $titanium_cache_id, $compile_id, $exp_time);

    /**
     * populate Cached Object with meta data from Resource
     *
     * @param  Smarty_Template_Cached   $titanium_cached    cached object
     * @param  Smarty_Internal_Template $_template template object
     * @return void
     */
    public function populate(Smarty_Template_Cached $titanium_cached, Smarty_Internal_Template $_template)
    {
        $_cache_id = isset($titanium_cached->cache_id) ? preg_replace('![^\w\|]+!', '_', $titanium_cached->cache_id) : null;
        $_compile_id = isset($titanium_cached->compile_id) ? preg_replace('![^\w\|]+!', '_', $titanium_cached->compile_id) : null;

        $titanium_cached->filepath = sha1($titanium_cached->source->filepath . $_cache_id . $_compile_id);
        $this->populateTimestamp($titanium_cached);
    }

    /**
     * populate Cached Object with timestamp and exists from Resource
     *
     * @param  Smarty_Template_Cached $source cached object
     * @return void
     */
    public function populateTimestamp(Smarty_Template_Cached $titanium_cached)
    {
        $mtime = $this->fetchTimestamp($titanium_cached->filepath, $titanium_cached->source->name, $titanium_cached->cache_id, $titanium_cached->compile_id);
        if ($mtime !== null) {
            $titanium_cached->timestamp = $mtime;
            $titanium_cached->exists = !!$titanium_cached->timestamp;

            return;
        }
        $timestamp = null;
        $this->fetch($titanium_cached->filepath, $titanium_cached->source->name, $titanium_cached->cache_id, $titanium_cached->compile_id, $titanium_cached->content, $timestamp);
        $titanium_cached->timestamp = isset($timestamp) ? $timestamp : false;
        $titanium_cached->exists = !!$titanium_cached->timestamp;
    }

    /**
     * Read the cached template and process the header
     *
     * @param  Smarty_Internal_Template $_template template object
     * @param  Smarty_Template_Cached   $titanium_cached    cached object
     * @return booelan                  true or false if the cached content does not exist
     */
    public function process(Smarty_Internal_Template $_template, Smarty_Template_Cached $titanium_cached=null)
    {
        if (!$titanium_cached) {
            $titanium_cached = $_template->cached;
        }
        $content = $titanium_cached->content ? $titanium_cached->content : null;
        $timestamp = $titanium_cached->timestamp ? $titanium_cached->timestamp : null;
        if ($content === null || !$timestamp) {
            $this->fetch(
                $_template->cached->filepath,
                $_template->source->name,
                $_template->cache_id,
                $_template->compile_id,
                $content,
                $timestamp
            );
        }
        if (isset($content)) {
            $_smarty_tpl = $_template;
            eval("?>" . $content);

            return true;
        }

        return false;
    }

    /**
     * Write the rendered template output to cache
     *
     * @param  Smarty_Internal_Template $_template template object
     * @param  string                   $content   content to cache
     * @return boolean                  success
     */
    public function writeCachedContent(Smarty_Internal_Template $_template, $content)
    {
        return $this->save(
            $_template->cached->filepath,
            $_template->source->name,
            $_template->cache_id,
            $_template->compile_id,
            $_template->properties['cache_lifetime'],
            $content
        );
    }

    /**
     * Empty cache
     *
     * @param  Smarty  $smarty   Smarty object
     * @param  integer $exp_time expiration time (number of seconds, not timestamp)
     * @return integer number of cache files deleted
     */
    public function clearAll(Smarty $smarty, $exp_time=null)
    {
        $this->cache = array();

        return $this->delete(null, null, null, $exp_time);
    }

    /**
     * Empty cache for a specific template
     *
     * @param  Smarty  $smarty        Smarty object
     * @param  string  $resource_name template name
     * @param  string  $titanium_cache_id      cache id
     * @param  string  $compile_id    compile id
     * @param  integer $exp_time      expiration time (number of seconds, not timestamp)
     * @return integer number of cache files deleted
     */
    public function clear(Smarty $smarty, $resource_name, $titanium_cache_id, $compile_id, $exp_time)
    {
        $this->cache = array();

        return $this->delete($resource_name, $titanium_cache_id, $compile_id, $exp_time);
    }

    /**
     * Check is cache is locked for this template
     *
     * @param  Smarty                 $smarty Smarty object
     * @param  Smarty_Template_Cached $titanium_cached cached object
     * @return booelan                true or false if cache is locked
     */
    public function hasLock(Smarty $smarty, Smarty_Template_Cached $titanium_cached)
    {
        $id = $titanium_cached->filepath;
        $name = $titanium_cached->source->name . '.lock';

        $mtime = $this->fetchTimestamp($id, $name, null, null);
        if ($mtime === null) {
            $this->fetch($id, $name, null, null, $content, $mtime);
        }

        return $mtime && time() - $mtime < $smarty->locking_timeout;
    }

    /**
     * Lock cache for this template
     *
     * @param Smarty                 $smarty Smarty object
     * @param Smarty_Template_Cached $titanium_cached cached object
     */
    public function acquireLock(Smarty $smarty, Smarty_Template_Cached $titanium_cached)
    {
        $titanium_cached->is_locked = true;

        $id = $titanium_cached->filepath;
        $name = $titanium_cached->source->name . '.lock';
        $this->save($id, $name, null, null, $smarty->locking_timeout, '');
    }

    /**
     * Unlock cache for this template
     *
     * @param Smarty                 $smarty Smarty object
     * @param Smarty_Template_Cached $titanium_cached cached object
     */
    public function releaseLock(Smarty $smarty, Smarty_Template_Cached $titanium_cached)
    {
        $titanium_cached->is_locked = false;

        $name = $titanium_cached->source->name . '.lock';
        $this->delete($name, null, null, null);
    }
}
