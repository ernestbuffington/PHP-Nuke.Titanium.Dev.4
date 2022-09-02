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

/* acp_reasons.html */
class __TwigTemplate_674f4a32ab6c4214b4e8ffc7f459cacdbb1bcd580f269b977938e20dfd0e6d39 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_reasons.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

";
        // line 5
        if (($context["S_EDIT_REASON"] ?? null)) {
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
            echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE");
            echo "</h1>

\t<p>";
            // line 11
            echo $this->extensions['phpbb\template\twig\extension']->lang("REASON_EDIT_EXPLAIN");
            echo "</p>

\t";
            // line 13
            if (($context["S_ERROR"] ?? null)) {
                // line 14
                echo "\t\t<div class=\"errorbox\">
\t\t\t<h3>";
                // line 15
                echo $this->extensions['phpbb\template\twig\extension']->lang("WARNING");
                echo "</h3>
\t\t\t<p>";
                // line 16
                echo ($context["ERROR_MSG"] ?? null);
                echo "</p>
\t\t</div>
\t";
            }
            // line 19
            echo "
\t";
            // line 20
            if ( !($context["S_TRANSLATED"] ?? null)) {
                // line 21
                echo "\t\t<h3>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("AVAILABLE_TITLES");
                echo "</h3>

\t\t<p>";
                // line 23
                echo ($context["S_AVAILABLE_TITLES"] ?? null);
                echo "</p>
\t";
            }
            // line 25
            echo "
\t<form id=\"acp_reasons\" method=\"post\" action=\"";
            // line 26
            echo ($context["U_ACTION"] ?? null);
            echo "\">

\t<fieldset>
\t\t<legend>";
            // line 29
            echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE");
            echo "</legend>
\t\t<p>";
            // line 30
            if (($context["S_TRANSLATED"] ?? null)) {
                echo $this->extensions['phpbb\template\twig\extension']->lang("IS_TRANSLATED_EXPLAIN");
            } else {
                echo $this->extensions['phpbb\template\twig\extension']->lang("IS_NOT_TRANSLATED_EXPLAIN");
            }
            echo "</p>
\t<dl>
\t\t<dt><label for=\"reason_title\">";
            // line 32
            echo $this->extensions['phpbb\template\twig\extension']->lang("REASON_TITLE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t<dd><input name=\"reason_title\" type=\"text\" id=\"reason_title\" value=\"";
            // line 33
            echo ($context["REASON_TITLE"] ?? null);
            echo "\" maxlength=\"255\" /></dd>
\t</dl>
\t";
            // line 35
            if (($context["S_TRANSLATED"] ?? null)) {
                // line 36
                echo "\t<dl>
\t\t<dt>";
                // line 37
                echo $this->extensions['phpbb\template\twig\extension']->lang("REASON_TITLE_TRANSLATED");
                echo "</dt>
\t\t<dd>";
                // line 38
                echo ($context["TRANSLATED_TITLE"] ?? null);
                echo "</dd>
\t</dl>
\t";
            }
            // line 41
            echo "\t<dl>
\t\t<dt><label for=\"reason_description\">";
            // line 42
            echo $this->extensions['phpbb\template\twig\extension']->lang("REASON_DESCRIPTION");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t<dd><textarea name=\"reason_description\" id=\"reason_description\" rows=\"8\" cols=\"80\">";
            // line 43
            echo ($context["REASON_DESCRIPTION"] ?? null);
            echo "</textarea></dd>
\t</dl>
\t";
            // line 45
            if (($context["S_TRANSLATED"] ?? null)) {
                // line 46
                echo "\t<dl>
\t\t<dt>";
                // line 47
                echo $this->extensions['phpbb\template\twig\extension']->lang("REASON_DESC_TRANSLATED");
                echo "</dt>
\t\t<dd>";
                // line 48
                echo ($context["TRANSLATED_DESCRIPTION"] ?? null);
                echo "</dd>
\t</dl>
\t";
            }
            // line 51
            echo "
\t<p class=\"submit-buttons\">
\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
            // line 53
            echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
            echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
            // line 54
            echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
            echo "\" />
\t\t";
            // line 55
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</p>
\t</fieldset>
\t</form>

";
        } else {
            // line 61
            echo "
\t<h1>";
            // line 62
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_REASONS");
            echo "</h1>

\t<p>";
            // line 64
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_REASONS_EXPLAIN");
            echo "</p>

\t<form id=\"reasons\" method=\"post\" action=\"";
            // line 66
            echo ($context["U_ACTION"] ?? null);
            echo "\">
\t<fieldset class=\"tabulated\">
\t<legend>";
            // line 68
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_REASONS");
            echo "</legend>

\t";
            // line 70
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "reasons", [], "any", false, false, false, 70))) {
                // line 71
                echo "\t\t<table class=\"table1\">
\t\t\t<col class=\"row1\" /><col class=\"row1\" /><col class=\"row2\" />
\t\t<thead>
\t\t<tr>
\t\t\t<th>";
                // line 75
                echo $this->extensions['phpbb\template\twig\extension']->lang("REASON");
                echo "</th>
\t\t\t<th>";
                // line 76
                echo $this->extensions['phpbb\template\twig\extension']->lang("USED_IN_REPORTS");
                echo "</th>
\t\t\t<th>";
                // line 77
                echo $this->extensions['phpbb\template\twig\extension']->lang("OPTIONS");
                echo "</th>
\t\t</tr>
\t\t</thead>
\t\t<tbody>
\t\t";
                // line 81
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "reasons", [], "any", false, false, false, 81));
                foreach ($context['_seq'] as $context["_key"] => $context["reasons"]) {
                    // line 82
                    echo "\t\t\t<tr>
\t\t\t\t<td>
\t\t\t\t\t<i style=\"float: ";
                    // line 84
                    echo ($context["S_CONTENT_FLOW_END"] ?? null);
                    echo "; font-size: .9em;\">";
                    if (twig_get_attribute($this->env, $this->source, $context["reasons"], "S_TRANSLATED", [], "any", false, false, false, 84)) {
                        echo $this->extensions['phpbb\template\twig\extension']->lang("IS_TRANSLATED");
                    } else {
                        echo $this->extensions['phpbb\template\twig\extension']->lang("IS_NOT_TRANSLATED");
                    }
                    echo "</i>
\t\t\t\t\t<strong>";
                    // line 85
                    echo twig_get_attribute($this->env, $this->source, $context["reasons"], "REASON_TITLE", [], "any", false, false, false, 85);
                    if (twig_get_attribute($this->env, $this->source, $context["reasons"], "S_OTHER_REASON", [], "any", false, false, false, 85)) {
                        echo " *";
                    }
                    echo "</strong>
\t\t\t\t\t<br /><span>";
                    // line 86
                    echo twig_get_attribute($this->env, $this->source, $context["reasons"], "REASON_DESCRIPTION", [], "any", false, false, false, 86);
                    echo "</span>
\t\t\t\t</td>
\t\t\t\t<td style=\"width: 100px;\">";
                    // line 88
                    echo twig_get_attribute($this->env, $this->source, $context["reasons"], "REASON_COUNT", [], "any", false, false, false, 88);
                    echo "</td>
\t\t\t\t<td class=\"actions\" style=\"width: 80px;\">
\t\t\t\t\t<span class=\"up-disabled\" style=\"display:none;\">";
                    // line 90
                    echo ($context["ICON_MOVE_UP_DISABLED"] ?? null);
                    echo "</span>
\t\t\t\t\t<span class=\"up\"><a href=\"";
                    // line 91
                    echo twig_get_attribute($this->env, $this->source, $context["reasons"], "U_MOVE_UP", [], "any", false, false, false, 91);
                    echo "\" data-ajax=\"row_up\">";
                    echo ($context["ICON_MOVE_UP"] ?? null);
                    echo "</a></span>
\t\t\t\t\t<span class=\"down-disabled\" style=\"display:none;\">";
                    // line 92
                    echo ($context["ICON_MOVE_DOWN_DISABLED"] ?? null);
                    echo "</span>
\t\t\t\t\t<span class=\"down\"><a href=\"";
                    // line 93
                    echo twig_get_attribute($this->env, $this->source, $context["reasons"], "U_MOVE_DOWN", [], "any", false, false, false, 93);
                    echo "\" data-ajax=\"row_down\">";
                    echo ($context["ICON_MOVE_DOWN"] ?? null);
                    echo "</a></span>
\t\t\t\t\t<a href=\"";
                    // line 94
                    echo twig_get_attribute($this->env, $this->source, $context["reasons"], "U_EDIT", [], "any", false, false, false, 94);
                    echo "\">";
                    echo ($context["ICON_EDIT"] ?? null);
                    echo "</a> 
\t\t\t\t\t";
                    // line 95
                    if (twig_get_attribute($this->env, $this->source, $context["reasons"], "U_DELETE", [], "any", false, false, false, 95)) {
                        // line 96
                        echo "\t\t\t\t\t\t<a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["reasons"], "U_DELETE", [], "any", false, false, false, 96);
                        echo "\" data-ajax=\"row_delete\">";
                        echo ($context["ICON_DELETE"] ?? null);
                        echo "</a>
\t\t\t\t\t";
                    } else {
                        // line 98
                        echo "\t\t\t\t\t\t";
                        echo ($context["ICON_DELETE_DISABLED"] ?? null);
                        echo "
\t\t\t\t\t";
                    }
                    // line 100
                    echo "\t\t\t\t</td>
\t\t\t</tr>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['reasons'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 103
                echo "\t\t</tbody>
\t\t</table>

\t";
            }
            // line 107
            echo "
\t<p class=\"quick\">
\t\t<input type=\"hidden\" name=\"action\" value=\"add\" />

\t\t<input type=\"text\" name=\"reason_title\" /> 
\t\t<input class=\"button2\" name=\"addreason\" type=\"submit\" value=\"";
            // line 112
            echo $this->extensions['phpbb\template\twig\extension']->lang("ADD_NEW_REASON");
            echo "\" />
\t\t";
            // line 113
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</p>
\t</fieldset>
\t
\t</form>

";
        }
        // line 120
        echo "
";
        // line 121
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_reasons.html", 121)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_reasons.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  366 => 121,  363 => 120,  353 => 113,  349 => 112,  342 => 107,  336 => 103,  328 => 100,  322 => 98,  314 => 96,  312 => 95,  306 => 94,  300 => 93,  296 => 92,  290 => 91,  286 => 90,  281 => 88,  276 => 86,  269 => 85,  259 => 84,  255 => 82,  251 => 81,  244 => 77,  240 => 76,  236 => 75,  230 => 71,  228 => 70,  223 => 68,  218 => 66,  213 => 64,  208 => 62,  205 => 61,  196 => 55,  192 => 54,  188 => 53,  184 => 51,  178 => 48,  174 => 47,  171 => 46,  169 => 45,  164 => 43,  159 => 42,  156 => 41,  150 => 38,  146 => 37,  143 => 36,  141 => 35,  136 => 33,  131 => 32,  122 => 30,  118 => 29,  112 => 26,  109 => 25,  104 => 23,  98 => 21,  96 => 20,  93 => 19,  87 => 16,  83 => 15,  80 => 14,  78 => 13,  73 => 11,  68 => 9,  59 => 7,  56 => 6,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_reasons.html", "");
    }
}
