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

/* simple_footer.html */
class __TwigTemplate_f15f6764487dd978569b8eb74d2946e329c99d80ca29f08c3f026277fff5af32 extends \Twig\Template
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
        echo "\t</div>

\t<div class=\"copyright\" role=\"contentinfo\">
\t\t<p class=\"footer-row\">
\t\t\t<span class=\"footer-copyright\">";
        // line 5
        echo ($context["CREDIT_LINE"] ?? null);
        echo "</span>
\t\t</p>
\t\t";
        // line 7
        if (($context["TRANSLATION_INFO"] ?? null)) {
            // line 8
            echo "\t\t\t<p class=\"footer-row\">
\t\t\t\t<span class=\"footer-copyright\">";
            // line 9
            echo ($context["TRANSLATION_INFO"] ?? null);
            echo "</span>
\t\t\t</p>
\t\t";
        }
        // line 12
        echo "\t\t";
        if (($context["DEBUG_OUTPUT"] ?? null)) {
            // line 13
            echo "\t\t\t<p class=\"footer-row\">
\t\t\t\t<span class=\"footer-info\">";
            // line 14
            echo ($context["DEBUG_OUTPUT"] ?? null);
            echo "</span>
\t\t\t</p>
\t\t";
        }
        // line 17
        echo "\t</div>

\t<div id=\"darkenwrapper\" class=\"darkenwrapper\" data-ajax-error-title=\"";
        // line 19
        echo $this->extensions['phpbb\template\twig\extension']->lang("AJAX_ERROR_TITLE");
        echo "\" data-ajax-error-text=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("AJAX_ERROR_TEXT");
        echo "\" data-ajax-error-text-abort=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("AJAX_ERROR_TEXT_ABORT");
        echo "\" data-ajax-error-text-timeout=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("AJAX_ERROR_TEXT_TIMEOUT");
        echo "\" data-ajax-error-text-parsererror=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("AJAX_ERROR_TEXT_PARSERERROR");
        echo "\">
\t\t<div id=\"darken\" class=\"darken\">&nbsp;</div>
\t</div>
\t<div id=\"loading_indicator\" class=\"loading_indicator\"></div>

\t<div id=\"phpbb_alert\" class=\"phpbb_alert\" data-l-err=\"";
        // line 24
        echo $this->extensions['phpbb\template\twig\extension']->lang("ERROR");
        echo "\" data-l-timeout-processing-req=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("TIMEOUT_PROCESSING_REQ");
        echo "\">
\t\t<a href=\"#\" class=\"alert_close\">
\t\t\t<i class=\"icon fa-times-circle fa-fw\" aria-hidden=\"true\"></i>
\t\t</a>
\t\t<h3 class=\"alert_title\">&nbsp;</h3><p class=\"alert_text\"></p>
\t</div>
\t<div id=\"phpbb_confirm\" class=\"phpbb_confirm phpbb_alert\">
\t\t<a href=\"#\" class=\"alert_close\">
\t\t\t<i class=\"icon fa-times-circle fa-fw\" aria-hidden=\"true\"></i>
\t\t</a>
\t\t<div class=\"alert_text\"></div>
\t</div>
</div>

<script src=\"";
        // line 38
        echo ($context["T_JQUERY_LINK"] ?? null);
        echo "\"></script>
";
        // line 39
        if (($context["S_ALLOW_CDN"] ?? null)) {
            echo "<script>window.jQuery || document.write('\\x3Cscript src=\"";
            echo ($context["T_ASSETS_PATH"] ?? null);
            echo "/javascript/jquery-3.6.0.min.js?assets_version=";
            echo ($context["T_ASSETS_VERSION"] ?? null);
            echo "\">\\x3C/script>');</script>";
        }
        // line 40
        echo "<script src=\"";
        echo ($context["T_ASSETS_PATH"] ?? null);
        echo "/javascript/core.js?assets_version=";
        echo ($context["T_ASSETS_VERSION"] ?? null);
        echo "\"></script>
";
        // line 41
        $asset_file = "forum_fn.js";
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
        $this->env->get_assets_bag()->add_script($asset);        // line 42
        $asset_file = "ajax.js";
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
        $this->env->get_assets_bag()->add_script($asset);        // line 43
        echo "
";
        // line 44
        // line 45
        echo "
";
        // line 46
        echo twig_get_attribute($this->env, $this->source, ($context["definition"] ?? null), "SCRIPTS", [], "any", false, false, false, 46);
        echo "

";
        // line 48
        // line 49
        echo "
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "simple_footer.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 49,  169 => 48,  164 => 46,  161 => 45,  160 => 44,  157 => 43,  143 => 42,  129 => 41,  122 => 40,  114 => 39,  110 => 38,  91 => 24,  75 => 19,  71 => 17,  65 => 14,  62 => 13,  59 => 12,  53 => 9,  50 => 8,  48 => 7,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "simple_footer.html", "");
    }
}
