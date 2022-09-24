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

/* acp_bbcodes.html */
class __TwigTemplate_63f89ecefdf3ebe5494b9ab5ed64e1d138cdec6eb1c0edd476cbdfe1ccf76d01 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_bbcodes.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

";
        // line 5
        if (($context["S_EDIT_BBCODE"] ?? null)) {
            // line 6
            echo "
\t<a href=\"";
            // line 7
            echo ($context["U_BACK"] ?? null);
            echo "\" style=\"float: ";
            echo ($context["S_CONTENT_FLOW_END"] ?? null);
            echo ";\">&laquo; ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BACK");
            echo "</a>

\t<h1>";
            // line 9
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_BBCODES");
            echo "</h1>

\t<p>";
            // line 11
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_BBCODES_EXPLAIN");
            echo "</p>

\t<form id=\"acp_bbcodes\" method=\"post\" action=\"";
            // line 13
            echo ($context["U_ACTION"] ?? null);
            echo "\">

\t<fieldset>
\t\t<legend>";
            // line 16
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_USAGE");
            echo "</legend>
\t\t<p>";
            // line 17
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_USAGE_EXPLAIN");
            echo "</p>
\t<dl>
\t\t<dt><label for=\"bbcode_match\">";
            // line 19
            echo $this->extensions['phpbb\template\twig\extension']->lang("EXAMPLES");
            echo "</label><br /><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_USAGE_EXAMPLE");
            echo "</span></dt>
\t\t<dd><textarea id=\"bbcode_match\" name=\"bbcode_match\" cols=\"60\" rows=\"5\">";
            // line 20
            echo ($context["BBCODE_MATCH"] ?? null);
            echo "</textarea></dd>
\t</dl>
\t</fieldset>

\t<fieldset>
\t\t<legend>";
            // line 25
            echo $this->extensions['phpbb\template\twig\extension']->lang("HTML_REPLACEMENT");
            echo "</legend>
\t\t<p>";
            // line 26
            echo $this->extensions['phpbb\template\twig\extension']->lang("HTML_REPLACEMENT_EXPLAIN");
            echo "</p>
\t<dl>
\t\t<dt><label for=\"bbcode_tpl\">";
            // line 28
            echo $this->extensions['phpbb\template\twig\extension']->lang("EXAMPLES");
            echo "</label><br /><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("HTML_REPLACEMENT_EXAMPLE");
            echo "</span></dt>
\t\t<dd><textarea id=\"bbcode_tpl\" name=\"bbcode_tpl\" cols=\"60\" rows=\"8\">";
            // line 29
            echo ($context["BBCODE_TPL"] ?? null);
            echo "</textarea></dd>
\t</dl>
\t</fieldset>

\t<fieldset>
\t\t<legend>";
            // line 34
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_HELPLINE");
            echo "</legend>
\t\t<p>";
            // line 35
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_HELPLINE_EXPLAIN");
            echo "</p>
\t<dl>
\t\t<dt><label for=\"bbcode_helpline\">";
            // line 37
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_HELPLINE_TEXT");
            echo "</label></dt>
\t\t<dd><textarea id=\"bbcode_helpline\" name=\"bbcode_helpline\" cols=\"60\" rows=\"4\">";
            // line 38
            echo ($context["BBCODE_HELPLINE"] ?? null);
            echo "</textarea></dd>
\t</dl>
\t</fieldset>

\t<fieldset>
\t\t<legend>";
            // line 43
            echo $this->extensions['phpbb\template\twig\extension']->lang("SETTINGS");
            echo "</legend>
\t<dl>
\t\t<dt><label for=\"display_on_posting\">";
            // line 45
            echo $this->extensions['phpbb\template\twig\extension']->lang("DISPLAY_ON_POSTING");
            echo "</label></dt>
\t\t<dd><input type=\"checkbox\" class=\"radio\" name=\"display_on_posting\" id=\"display_on_posting\" value=\"1\"";
            // line 46
            if (($context["DISPLAY_ON_POSTING"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /></dd>
\t</dl>
\t</fieldset>

\t";
            // line 50
            // line 51
            echo "
\t<fieldset class=\"submit-buttons\">
\t\t<legend>";
            // line 53
            echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
            echo "</legend>
\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
            // line 54
            echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
            echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
            // line 55
            echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
            echo "\" />
\t\t";
            // line 56
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t
\t<br />

\t<table class=\"table1\" id=\"down\">
\t<thead>
\t<tr>
\t\t<th colspan=\"2\">";
            // line 64
            echo $this->extensions['phpbb\template\twig\extension']->lang("TOKENS");
            echo "</th>
\t</tr>
\t<tr>
\t\t<td class=\"row3\" colspan=\"2\">";
            // line 67
            echo $this->extensions['phpbb\template\twig\extension']->lang("TOKENS_EXPLAIN");
            echo "</td>
\t</tr>
\t<tr>
\t\t<th>";
            // line 70
            echo $this->extensions['phpbb\template\twig\extension']->lang("TOKEN");
            echo "</th>
\t\t<th>";
            // line 71
            echo $this->extensions['phpbb\template\twig\extension']->lang("TOKEN_DEFINITION");
            echo "</th>
\t</tr>
\t</thead>
\t<tbody>
\t";
            // line 75
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "token", [], "any", false, false, false, 75));
            foreach ($context['_seq'] as $context["_key"] => $context["token"]) {
                // line 76
                echo "\t\t<tr style=\"vertical-align: top;\">
\t\t\t<td class=\"row1\">";
                // line 77
                echo twig_get_attribute($this->env, $this->source, $context["token"], "TOKEN", [], "any", false, false, false, 77);
                echo "</td>
\t\t\t<td class=\"row2\">";
                // line 78
                echo twig_get_attribute($this->env, $this->source, $context["token"], "EXPLAIN", [], "any", false, false, false, 78);
                echo "</td>
\t\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['token'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 81
            echo "\t</tbody>
\t</table>
\t</form>

";
        } else {
            // line 86
            echo "
\t<h1>";
            // line 87
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_BBCODES");
            echo "</h1>

\t<p>";
            // line 89
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_BBCODES_EXPLAIN");
            echo "</p>
\t
\t<form id=\"acp_bbcodes\" method=\"post\" action=\"";
            // line 91
            echo ($context["U_ACTION"] ?? null);
            echo "\">
\t<fieldset class=\"tabulated\">
\t<legend>";
            // line 93
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_BBCODES");
            echo "</legend>

\t<table class=\"table1 zebra-table\" id=\"down\">
\t<thead>
\t<tr>
\t\t<th>";
            // line 98
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_TAG");
            echo "</th>
\t\t<th>";
            // line 99
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACTION");
            echo "</th>
\t</tr>
\t</thead>
\t<tbody>
\t";
            // line 103
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "bbcodes", [], "any", false, false, false, 103));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["bbcodes"]) {
                // line 104
                echo "\t\t<tr>
\t\t\t<td style=\"text-align: center;\">";
                // line 105
                echo twig_get_attribute($this->env, $this->source, $context["bbcodes"], "BBCODE_TAG", [], "any", false, false, false, 105);
                echo "</td>
\t\t\t<td class=\"actions\">";
                // line 106
                echo " <a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["bbcodes"], "U_EDIT", [], "any", false, false, false, 106);
                echo "\">";
                echo ($context["ICON_EDIT"] ?? null);
                echo "</a> <a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["bbcodes"], "U_DELETE", [], "any", false, false, false, 106);
                echo "\" data-ajax=\"row_delete\">";
                echo ($context["ICON_DELETE"] ?? null);
                echo "</a> ";
                echo "</td>
\t\t</tr>
\t";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 109
                echo "\t\t<tr class=\"row3\">
\t\t\t<td colspan=\"2\">";
                // line 110
                echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_NO_ITEMS");
                echo "</td>
\t\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['bbcodes'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 113
            echo "\t</tbody>
\t</table>

\t<p class=\"quick\">
\t\t<input class=\"button2\" name=\"submit\" type=\"submit\" value=\"";
            // line 117
            echo $this->extensions['phpbb\template\twig\extension']->lang("ADD_BBCODE");
            echo "\" />
\t</p>
\t";
            // line 119
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>

\t</form>

";
        }
        // line 125
        echo "
";
        // line 126
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_bbcodes.html", 126)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_bbcodes.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  347 => 126,  344 => 125,  335 => 119,  330 => 117,  324 => 113,  315 => 110,  312 => 109,  296 => 106,  292 => 105,  289 => 104,  284 => 103,  277 => 99,  273 => 98,  265 => 93,  260 => 91,  255 => 89,  250 => 87,  247 => 86,  240 => 81,  231 => 78,  227 => 77,  224 => 76,  220 => 75,  213 => 71,  209 => 70,  203 => 67,  197 => 64,  186 => 56,  182 => 55,  178 => 54,  174 => 53,  170 => 51,  169 => 50,  160 => 46,  156 => 45,  151 => 43,  143 => 38,  139 => 37,  134 => 35,  130 => 34,  122 => 29,  116 => 28,  111 => 26,  107 => 25,  99 => 20,  93 => 19,  88 => 17,  84 => 16,  78 => 13,  73 => 11,  68 => 9,  59 => 7,  56 => 6,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_bbcodes.html", "");
    }
}
