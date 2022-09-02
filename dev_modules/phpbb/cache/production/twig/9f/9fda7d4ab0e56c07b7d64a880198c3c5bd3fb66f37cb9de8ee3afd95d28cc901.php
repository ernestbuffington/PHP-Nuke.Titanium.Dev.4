<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* plupload.html */
class __TwigTemplate_ba104f40b1b791c7680dd003b8b58466c322c55fede64630131c394b2e0b962a extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<script>
phpbb.plupload = {
\ti18n: {
\t\t'b': '";
        // line 4
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("BYTES_SHORT"), "js");
        echo "',
\t\t'kb': '";
        // line 5
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("KB"), "js");
        echo "',
\t\t'mb': '";
        // line 6
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("MB"), "js");
        echo "',
\t\t'gb': '";
        // line 7
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("GB"), "js");
        echo "',
\t\t'tb': '";
        // line 8
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("TB"), "js");
        echo "',
\t\t'Add Files': '";
        // line 9
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_ADD_FILES"), "js");
        echo "',
\t\t'Add files to the upload queue and click the start button.': '";
        // line 10
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_ADD_FILES_TO_QUEUE"), "js");
        echo "',
\t\t'Close': '";
        // line 11
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_CLOSE"), "js");
        echo "',
\t\t'Drag files here.': '";
        // line 12
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_DRAG"), "js");
        echo "',
\t\t'Duplicate file error.': '";
        // line 13
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_DUPLICATE_ERROR"), "js");
        echo "',
\t\t'File: %s': '";
        // line 14
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_FILE"), "js");
        echo "',
\t\t'File: %s, size: %d, max file size: %d': '";
        // line 15
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_FILE_DETAILS"), "js");
        echo "',
\t\t'File count error.': '";
        // line 16
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_ERR_FILE_COUNT"), "js");
        echo "',
\t\t'File extension error.': '";
        // line 17
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_EXTENSION_ERROR"), "js");
        echo "',
\t\t'File size error.': '";
        // line 18
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_SIZE_ERROR"), "js");
        echo "',
\t\t'File too large:': '";
        // line 19
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_ERR_FILE_TOO_LARGE"), "js");
        echo "',
\t\t'Filename': '";
        // line 20
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_FILENAME"), "js");
        echo "',
\t\t'Generic error.': '";
        // line 21
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_GENERIC_ERROR"), "js");
        echo "',
\t\t'HTTP Error.': '";
        // line 22
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_HTTP_ERROR"), "js");
        echo "',
\t\t'Image format either wrong or not supported.': '";
        // line 23
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_IMAGE_FORMAT"), "js");
        echo "',
\t\t'Init error.': '";
        // line 24
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_INIT_ERROR"), "js");
        echo "',
\t\t'IO error.': '";
        // line 25
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_IO_ERROR"), "js");
        echo "',
\t\t'Invalid file extension:': '";
        // line 26
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_ERR_FILE_INVALID_EXT"), "js");
        echo "',
\t\t'N/A': '";
        // line 27
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_NOT_APPLICABLE"), "js");
        echo "',
\t\t'Runtime ran out of available memory.': '";
        // line 28
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_ERR_RUNTIME_MEMORY"), "js");
        echo "',
\t\t'Security error.': '";
        // line 29
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_SECURITY_ERROR"), "js");
        echo "',
\t\t'Select files': '";
        // line 30
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_SELECT_FILES"), "js");
        echo "',
\t\t'Size': '";
        // line 31
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_SIZE"), "js");
        echo "',
\t\t'Start Upload': '";
        // line 32
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_START_UPLOAD"), "js");
        echo "',
\t\t'Start uploading queue': '";
        // line 33
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_START_CURRENT_UPLOAD"), "js");
        echo "',
\t\t'Status': '";
        // line 34
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_STATUS"), "js");
        echo "',
\t\t'Stop Upload': '";
        // line 35
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_STOP_UPLOAD"), "js");
        echo "',
\t\t'Stop current upload': '";
        // line 36
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_STOP_CURRENT_UPLOAD"), "js");
        echo "',
\t\t\"Upload URL might be wrong or doesn't exist.\": '";
        // line 37
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_ERR_UPLOAD_URL"), "js");
        echo "',
\t\t'Uploaded %d/%d files': '";
        // line 38
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_UPLOADED"), "js");
        echo "',
\t\t'%d files queued': '";
        // line 39
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_FILES_QUEUED"), "js");
        echo "',
\t\t'%s already present in the queue.': '";
        // line 40
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_ALREADY_QUEUED"), "js");
        echo "'
\t},
\tconfig: {
\t\truntimes: 'html5',
\t\turl: '";
        // line 44
        echo ($context["S_PLUPLOAD_URL"] ?? null);
        echo "',
\t\tmax_file_size: '";
        // line 45
        echo ($context["FILESIZE"] ?? null);
        echo "b',
\t\tchunk_size: '";
        // line 46
        echo ($context["CHUNK_SIZE"] ?? null);
        echo "b',
\t\tunique_names: true,
\t\tfilters: {
\t\t\tmime_types: [
\t\t\t\t";
        // line 50
        echo ($context["FILTERS"] ?? null);
        echo "
\t\t\t],
\t\t\tmime_types_max_file_size: [
\t\t\t\t";
        // line 53
        echo ($context["FILTERS"] ?? null);
        echo "
\t\t\t],
\t\t},
\t\t";
        // line 56
        echo ($context["S_RESIZE"] ?? null);
        echo "
\t\theaders: {'X-PHPBB-USING-PLUPLOAD': '1', 'X-Requested-With': 'XMLHttpRequest'},
\t\tfile_data_name: 'fileupload',
\t\tmultipart_params: {'add_file': '";
        // line 59
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("ADD_FILE"), "js");
        echo "'},
\t\tform_hook: '#postform',
\t\tbrowse_button: 'add_files',
\t\tdrop_element : 'message',
\t},
\tlang: {
\t\tERROR: '";
        // line 65
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("ERROR"), "js");
        echo "',
\t\tTOO_MANY_ATTACHMENTS: '";
        // line 66
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("TOO_MANY_ATTACHMENTS"), "js");
        echo "',
\t\tFORM_INVALID: '";
        // line 67
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("FORM_INVALID"), "js");
        echo "',
\t},
\torder: '";
        // line 69
        echo ($context["ATTACH_ORDER"] ?? null);
        echo "',
\tmaxFiles: ";
        // line 70
        echo ($context["MAX_ATTACHMENTS"] ?? null);
        echo ",
\tdata: ";
        // line 71
        echo ($context["S_ATTACH_DATA"] ?? null);
        echo ",
}
</script>
";
        // line 74
        $asset_file = (("" . ($context["T_ASSETS_PATH"] ?? null)) . "/plupload/plupload.full.min.js");
        $asset = new \phpbb\template\asset($asset_file, $this->env->get_path_helper(), $this->env->get_filesystem());
        if (substr($asset_file, 0, 2) !== './' && $asset->is_relative()) {
            $asset_path = $asset->get_path();            $local_file = $this->env->get_phpbb_root_path() . $asset_path;
            if (!file_exists($local_file)) {
                $local_file = $this->env->findTemplate($asset_path);
                $asset->set_path($local_file, true);
            }
        }
        
        if ($asset->is_relative()) {
            $asset->add_assets_version($this->env->get_phpbb_config()['assets_version']);
        }
        $this->env->get_assets_bag()->add_script($asset);        // line 75
        $asset_file = (("" . ($context["T_ASSETS_PATH"] ?? null)) . "/javascript/plupload.js");
        $asset = new \phpbb\template\asset($asset_file, $this->env->get_path_helper(), $this->env->get_filesystem());
        if (substr($asset_file, 0, 2) !== './' && $asset->is_relative()) {
            $asset_path = $asset->get_path();            $local_file = $this->env->get_phpbb_root_path() . $asset_path;
            if (!file_exists($local_file)) {
                $local_file = $this->env->findTemplate($asset_path);
                $asset->set_path($local_file, true);
            }
        }
        
        if ($asset->is_relative()) {
            $asset->add_assets_version($this->env->get_phpbb_config()['assets_version']);
        }
        $this->env->get_assets_bag()->add_script($asset);    }

    public function getTemplateName()
    {
        return "plupload.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  276 => 75,  262 => 74,  256 => 71,  252 => 70,  248 => 69,  243 => 67,  239 => 66,  235 => 65,  226 => 59,  220 => 56,  214 => 53,  208 => 50,  201 => 46,  197 => 45,  193 => 44,  186 => 40,  182 => 39,  178 => 38,  174 => 37,  170 => 36,  166 => 35,  162 => 34,  158 => 33,  154 => 32,  150 => 31,  146 => 30,  142 => 29,  138 => 28,  134 => 27,  130 => 26,  126 => 25,  122 => 24,  118 => 23,  114 => 22,  110 => 21,  106 => 20,  102 => 19,  98 => 18,  94 => 17,  90 => 16,  86 => 15,  82 => 14,  78 => 13,  74 => 12,  70 => 11,  66 => 10,  62 => 9,  58 => 8,  54 => 7,  50 => 6,  46 => 5,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "plupload.html", "");
    }
}
