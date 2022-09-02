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

/* timezone_option.html */
class __TwigTemplate_f98a9213ccb2df67844cd1793ae76363e13fd1f1aeb45e9cb21fe91d512d6cbe extends \Twig\Template
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
        echo "<dl>
\t<dt><label for=\"timezone\">";
        // line 2
        echo $this->extensions['phpbb\template\twig\extension']->lang("BOARD_TIMEZONE");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label></dt>
\t";
        // line 3
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "timezone_date", [], "any", false, false, false, 3))) {
            // line 4
            echo "\t<dd id=\"tz_select_date\" style=\"display: none;\">
\t\t<select name=\"tz_date\" id=\"tz_date\" class=\"autowidth tz_select\">
\t\t\t<option value=\"\">";
            // line 6
            echo $this->extensions['phpbb\template\twig\extension']->lang("SELECT_CURRENT_TIME");
            echo "</option>
\t\t\t";
            // line 7
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "timezone_date", [], "any", false, false, false, 7));
            foreach ($context['_seq'] as $context["_key"] => $context["timezone_date"]) {
                // line 8
                echo "\t\t\t\t<option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["timezone_date"], "VALUE", [], "any", false, false, false, 8);
                echo "\"";
                if (twig_get_attribute($this->env, $this->source, $context["timezone_date"], "SELECTED", [], "any", false, false, false, 8)) {
                    echo " selected=\"selected\"";
                }
                echo ">";
                echo twig_get_attribute($this->env, $this->source, $context["timezone_date"], "TITLE", [], "any", false, false, false, 8);
                echo "</option>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['timezone_date'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 10
            echo "\t\t</select>
\t\t<input type=\"button\" id=\"tz_select_date_suggest\" class=\"button2\" style=\"display: none;\" timezone-preselect=\"";
            // line 11
            if (($context["S_TZ_PRESELECT"] ?? null)) {
                echo "true";
            } else {
                echo "false";
            }
            echo "\" data-l-suggestion=\"";
            echo $this->extensions['phpbb\template\twig\extension']->lang("TIMEZONE_DATE_SUGGESTION");
            echo "\" value=\"";
            echo $this->extensions['phpbb\template\twig\extension']->lang("TIMEZONE_DATE_SUGGESTION");
            echo "\" />
\t</dd>
\t";
        }
        // line 14
        echo "\t<dd>
\t\t<select name=\"tz\" id=\"timezone\" class=\"autowidth tz_select timezone\">
\t\t\t<option value=\"\">";
        // line 16
        echo $this->extensions['phpbb\template\twig\extension']->lang("SELECT_TIMEZONE");
        echo "</option>
\t\t\t";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "timezone_select", [], "any", false, false, false, 17));
        foreach ($context['_seq'] as $context["_key"] => $context["timezone_select"]) {
            // line 18
            echo "\t\t\t<optgroup label=\"";
            echo twig_get_attribute($this->env, $this->source, $context["timezone_select"], "LABEL", [], "any", false, false, false, 18);
            echo "\" data-tz-value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["timezone_select"], "VALUE", [], "any", false, false, false, 18);
            echo "\">
\t\t\t\t";
            // line 19
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["timezone_select"], "timezone_options", [], "any", false, false, false, 19));
            foreach ($context['_seq'] as $context["_key"] => $context["timezone_options"]) {
                // line 20
                echo "\t\t\t\t<option title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["timezone_options"], "TITLE", [], "any", false, false, false, 20);
                echo "\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["timezone_options"], "VALUE", [], "any", false, false, false, 20);
                echo "\"";
                if (twig_get_attribute($this->env, $this->source, $context["timezone_options"], "SELECTED", [], "any", false, false, false, 20)) {
                    echo " selected=\"selected\"";
                }
                echo ">";
                echo twig_get_attribute($this->env, $this->source, $context["timezone_options"], "LABEL", [], "any", false, false, false, 20);
                echo "</option>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['timezone_options'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            echo "\t\t\t</optgroup>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['timezone_select'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        echo "\t\t</select>

\t\t";
        // line 26
        $asset_file = "timezone.js";
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
        $this->env->get_assets_bag()->add_script($asset);        // line 27
        echo "\t</dd>
</dl>
";
    }

    public function getTemplateName()
    {
        return "timezone_option.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  156 => 27,  142 => 26,  138 => 24,  131 => 22,  114 => 20,  110 => 19,  103 => 18,  99 => 17,  95 => 16,  91 => 14,  77 => 11,  74 => 10,  59 => 8,  55 => 7,  51 => 6,  47 => 4,  45 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "timezone_option.html", "");
    }
}
