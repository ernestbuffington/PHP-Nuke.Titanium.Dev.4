<?php

class HTMLPurifier_Filter_Iframe extends HTMLPurifier_Filter
{

    public $name = 'Iframe';

    public function preFilter($html, $config, $context) {
        return preg_replace("/iframe/", "img class=\"MyIframe\" ", preg_replace("/<\/iframe>/", "", $html));
    }

    public function postFilter($html, $config, $context) {
       $post_regex = '#<img class="MyIframe" ([^>]+)>#';
        return preg_replace_callback($post_regex, array($this, 'postFilterCallback'), $html);
    }

    protected function postFilterCallback($matches) {
        return '<iframe '.$matches[1].'></iframe>';
    }
}