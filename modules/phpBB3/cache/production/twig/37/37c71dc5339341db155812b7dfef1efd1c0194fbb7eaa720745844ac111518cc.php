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

/* acp_ext_list.html */
class __TwigTemplate_8615ea8df26e2cdadbaf36bcd2e12de8186884776a76f6fa96b57e889e0137ee extends \Twig\Template
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
        $location = "overall_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_header.html", "acp_ext_list.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

\t<h1>";
        // line 5
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSIONS_ADMIN");
        echo "</h1>

\t<p>";
        // line 7
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSIONS_EXPLAIN");
        echo "</p>

\t<fieldset class=\"quick\">
\t\t<span class=\"small\"><a href=\"https://www.phpbb.com/go/customise/extensions/3.3\" target=\"_blank\">";
        // line 10
        echo $this->extensions['phpbb\template\twig\extension']->lang("BROWSE_EXTENSIONS_DATABASE");
        echo "</a> &bull; <a href=\"";
        echo ($context["U_VERSIONCHECK_FORCE"] ?? null);
        echo "\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("VERSIONCHECK_FORCE_UPDATE_ALL");
        echo "</a> &bull; <a href=\"javascript:phpbb.toggleDisplay('version_check_settings');\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("SETTINGS");
        echo "</a></span>
\t</fieldset>

\t<form id=\"version_check_settings\" method=\"post\" action=\"";
        // line 13
        echo ($context["U_ACTION"] ?? null);
        echo "\" style=\"display:none\">

\t<fieldset>
\t\t<legend>";
        // line 16
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSIONS_VERSION_CHECK_SETTINGS");
        echo "</legend>
\t\t<dl>
\t\t\t<dt><label for=\"force_unstable\">";
        // line 18
        echo $this->extensions['phpbb\template\twig\extension']->lang("FORCE_UNSTABLE");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label></dt>
\t\t\t<dd>
\t\t\t\t<label><input type=\"radio\" id=\"force_unstable\" name=\"force_unstable\" class=\"radio\" value=\"1\"";
        // line 20
        if (($context["FORCE_UNSTABLE"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
        echo "</label>
\t\t\t\t<label><input type=\"radio\" name=\"force_unstable\" class=\"radio\" value=\"0\"";
        // line 21
        if ( !($context["FORCE_UNSTABLE"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
        echo "</label>
\t\t\t</dd>
\t\t</dl>

\t\t<p class=\"submit-buttons\">
\t\t\t<input class=\"button1\" type=\"submit\" name=\"update\" value=\"";
        // line 26
        echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
        echo "\" />&nbsp;
\t\t\t<input class=\"button2\" type=\"reset\" name=\"reset\" value=\"";
        // line 27
        echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
        echo "\" />
\t\t\t<input type=\"hidden\" name=\"action\" value=\"set_config_version_check_force_unstable\" />
\t\t\t";
        // line 29
        echo ($context["S_FORM_TOKEN"] ?? null);
        echo "
\t\t</p>
\t</fieldset>
\t</form>

\t<table class=\"table1\">
\t\t<col class=\"row1\" ><col class=\"row1\" ><col class=\"row2\" ><col class=\"row2\" >
\t<thead>
\t\t<tr>
\t\t\t<th>";
        // line 38
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_NAME");
        echo "</th>
\t\t\t<th style=\"text-align: center; width: 20%;\">";
        // line 39
        echo $this->extensions['phpbb\template\twig\extension']->lang("CURRENT_VERSION");
        echo "</th>
\t\t\t<th style=\"text-align: center; width: 10%;\">";
        // line 40
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_OPTIONS");
        echo "</th>
\t\t\t<th style=\"text-align: center; width: 25%;\">";
        // line 41
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_ACTIONS");
        echo "</th>
\t\t</tr>
\t</thead>
\t<tbody>
\t\t";
        // line 45
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "enabled", [], "any", false, false, false, 45))) {
            // line 46
            echo "\t\t<tr>
\t\t\t<td class=\"row3\" colspan=\"4\"><strong>";
            // line 47
            echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSIONS_ENABLED");
            echo "</strong>";
            echo "</td>
\t\t</tr>
\t\t";
            // line 49
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "enabled", [], "any", false, false, false, 49));
            foreach ($context['_seq'] as $context["_key"] => $context["enabled"]) {
                // line 50
                echo "\t\t<tr class=\"ext_enabled row-highlight\">
\t\t\t<td><strong title=\"";
                // line 51
                echo twig_get_attribute($this->env, $this->source, $context["enabled"], "NAME", [], "any", false, false, false, 51);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["enabled"], "META_DISPLAY_NAME", [], "any", false, false, false, 51);
                echo "</strong>";
                echo "</td>
\t\t\t<td style=\"text-align: center;\">
\t\t\t\t";
                // line 53
                if (twig_get_attribute($this->env, $this->source, $context["enabled"], "S_VERSIONCHECK", [], "any", false, false, false, 53)) {
                    // line 54
                    echo "\t\t\t\t<strong class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["enabled"], "S_UP_TO_DATE", [], "any", false, false, false, 54)) {
                        echo "current-ext";
                    } else {
                        echo "outdated-ext";
                    }
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["enabled"], "META_VERSION", [], "any", false, false, false, 54);
                    echo "</strong>
\t\t\t\t";
                    // line 55
                    if ( !twig_get_attribute($this->env, $this->source, $context["enabled"], "S_UP_TO_DATE", [], "any", false, false, false, 55)) {
                        echo "<i class=\"fa fa-exclamation-circle outdated-ext\" aria-hidden=\"true\"></i>";
                    }
                    // line 56
                    echo "\t\t\t\t";
                } else {
                    // line 57
                    echo "\t\t\t\t";
                    echo twig_get_attribute($this->env, $this->source, $context["enabled"], "META_VERSION", [], "any", false, false, false, 57);
                    echo "
\t\t\t\t";
                }
                // line 59
                echo "\t\t\t</td>
\t\t\t<td style=\"text-align: center;\"><a href=\"";
                // line 60
                echo twig_get_attribute($this->env, $this->source, $context["enabled"], "U_DETAILS", [], "any", false, false, false, 60);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("DETAILS");
                echo "</a></td>
\t\t\t<td style=\"text-align: center;\">
\t\t\t\t";
                // line 62
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["enabled"], "actions", [], "any", false, false, false, 62));
                foreach ($context['_seq'] as $context["_key"] => $context["actions"]) {
                    // line 63
                    echo "\t\t\t\t\t<a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["actions"], "U_ACTION", [], "any", false, false, false, 63);
                    echo "\"";
                    if (twig_get_attribute($this->env, $this->source, $context["actions"], "L_ACTION_EXPLAIN", [], "any", false, false, false, 63)) {
                        echo " title=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["actions"], "L_ACTION_EXPLAIN", [], "any", false, false, false, 63);
                        echo "\"";
                    }
                    echo ">";
                    echo twig_get_attribute($this->env, $this->source, $context["actions"], "L_ACTION", [], "any", false, false, false, 63);
                    echo "</a>
\t\t\t\t\t";
                    // line 64
                    if ( !twig_get_attribute($this->env, $this->source, $context["actions"], "S_LAST_ROW", [], "any", false, false, false, 64)) {
                        echo "&nbsp;|&nbsp;";
                    }
                    // line 65
                    echo "\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['actions'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 66
                echo "\t\t\t</td>
\t\t</tr>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['enabled'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 69
            echo "\t\t";
        }
        // line 70
        echo "
\t\t";
        // line 71
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "disabled", [], "any", false, false, false, 71))) {
            // line 72
            echo "\t\t<tr>
\t\t\t<td class=\"row3\" colspan=\"4\"><strong>";
            // line 73
            echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSIONS_DISABLED");
            echo "</strong>";
            echo "</td>
\t\t</tr>
\t\t";
            // line 75
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "disabled", [], "any", false, false, false, 75));
            foreach ($context['_seq'] as $context["_key"] => $context["disabled"]) {
                // line 76
                echo "\t\t<tr class=\"ext_disabled row-highlight\">
\t\t\t<td><strong title=\"";
                // line 77
                echo twig_get_attribute($this->env, $this->source, $context["disabled"], "NAME", [], "any", false, false, false, 77);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["disabled"], "META_DISPLAY_NAME", [], "any", false, false, false, 77);
                echo "</strong>";
                echo "</td>
\t\t\t<td style=\"text-align: center;\">
\t\t\t\t";
                // line 79
                if (twig_get_attribute($this->env, $this->source, $context["disabled"], "S_VERSIONCHECK", [], "any", false, false, false, 79)) {
                    // line 80
                    echo "\t\t\t\t<strong class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["disabled"], "S_UP_TO_DATE", [], "any", false, false, false, 80)) {
                        echo "current-ext";
                    } else {
                        echo "outdated-ext";
                    }
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["disabled"], "META_VERSION", [], "any", false, false, false, 80);
                    echo "</strong>
\t\t\t\t";
                    // line 81
                    if ( !twig_get_attribute($this->env, $this->source, $context["disabled"], "S_UP_TO_DATE", [], "any", false, false, false, 81)) {
                        echo "<i class=\"fa fa-exclamation-circle outdated-ext\" aria-hidden=\"true\"></i>";
                    }
                    // line 82
                    echo "\t\t\t\t";
                } else {
                    // line 83
                    echo "\t\t\t\t";
                    echo twig_get_attribute($this->env, $this->source, $context["disabled"], "META_VERSION", [], "any", false, false, false, 83);
                    echo "
\t\t\t\t";
                }
                // line 85
                echo "\t\t\t</td>
\t\t\t<td style=\"text-align: center;\">
\t\t\t\t";
                // line 87
                if (twig_get_attribute($this->env, $this->source, $context["disabled"], "U_DETAILS", [], "any", false, false, false, 87)) {
                    echo "<a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["disabled"], "U_DETAILS", [], "any", false, false, false, 87);
                    echo "\">";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("DETAILS");
                    echo "</a>";
                }
                // line 88
                echo "\t\t\t</td>
\t\t\t<td style=\"text-align: center;\">
\t\t\t\t";
                // line 90
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["disabled"], "actions", [], "any", false, false, false, 90));
                foreach ($context['_seq'] as $context["_key"] => $context["actions"]) {
                    // line 91
                    echo "\t\t\t\t\t<a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["actions"], "U_ACTION", [], "any", false, false, false, 91);
                    echo "\"";
                    if (twig_get_attribute($this->env, $this->source, $context["actions"], "L_ACTION_EXPLAIN", [], "any", false, false, false, 91)) {
                        echo " title=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["actions"], "L_ACTION_EXPLAIN", [], "any", false, false, false, 91);
                        echo "\"";
                    }
                    echo ">";
                    echo twig_get_attribute($this->env, $this->source, $context["actions"], "L_ACTION", [], "any", false, false, false, 91);
                    echo "</a>
\t\t\t\t\t";
                    // line 92
                    if ( !twig_get_attribute($this->env, $this->source, $context["actions"], "S_LAST_ROW", [], "any", false, false, false, 92)) {
                        echo "&nbsp;|&nbsp;";
                    }
                    // line 93
                    echo "\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['actions'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 94
                echo "\t\t\t</td>
\t\t</tr>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['disabled'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 97
            echo "\t\t";
        }
        // line 98
        echo "\t</tbody>
\t</table>

\t<table class=\"table1\">
\t<tr>
\t\t<th>";
        // line 103
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_INSTALL_HEADLINE");
        echo "</th>
\t</tr>
\t<tr>
\t\t<td class=\"row3\">";
        // line 106
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_INSTALL_EXPLAIN");
        echo "</td>
\t</tr>
\t<tr>
\t\t<th>";
        // line 109
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_UPDATE_HEADLINE");
        echo "</th>
\t</tr>
\t<tr>
\t\t<td class=\"row3\">";
        // line 112
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_UPDATE_EXPLAIN");
        echo "</td>
\t</tr>
\t<tr>
\t\t<th>";
        // line 115
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_REMOVE_HEADLINE");
        echo "</th>
\t</tr>
\t<tr>
\t\t<td class=\"row3\">";
        // line 118
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_REMOVE_EXPLAIN");
        echo "</td>
\t</tr>
\t</tbody>
\t</table>

";
        // line 123
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_ext_list.html", 123)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_ext_list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  408 => 123,  400 => 118,  394 => 115,  388 => 112,  382 => 109,  376 => 106,  370 => 103,  363 => 98,  360 => 97,  352 => 94,  346 => 93,  342 => 92,  329 => 91,  325 => 90,  321 => 88,  313 => 87,  309 => 85,  303 => 83,  300 => 82,  296 => 81,  285 => 80,  283 => 79,  275 => 77,  272 => 76,  268 => 75,  262 => 73,  259 => 72,  257 => 71,  254 => 70,  251 => 69,  243 => 66,  237 => 65,  233 => 64,  220 => 63,  216 => 62,  209 => 60,  206 => 59,  200 => 57,  197 => 56,  193 => 55,  182 => 54,  180 => 53,  172 => 51,  169 => 50,  165 => 49,  159 => 47,  156 => 46,  154 => 45,  147 => 41,  143 => 40,  139 => 39,  135 => 38,  123 => 29,  118 => 27,  114 => 26,  102 => 21,  94 => 20,  88 => 18,  83 => 16,  77 => 13,  65 => 10,  59 => 7,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_ext_list.html", "");
    }
}
