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

/* acp_bots.html */
class __TwigTemplate_775288ad396b1689e60f6744e6f10a6f52249673f5a1cd24802cf8daba437c1c extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_bots.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

";
        // line 5
        if (($context["S_EDIT_BOT"] ?? null)) {
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
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOT_EDIT_EXPLAIN");
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
\t<form id=\"acp_bots\" method=\"post\" action=\"";
            // line 20
            echo ($context["U_ACTION"] ?? null);
            echo "\">

\t<fieldset>
\t\t<legend>";
            // line 23
            echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE");
            echo "</legend>
\t<dl>
\t\t<dt><label for=\"bot_name\">";
            // line 25
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOT_NAME");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOT_NAME_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input name=\"bot_name\" type=\"text\" id=\"bot_name\" value=\"";
            // line 26
            echo ($context["BOT_NAME"] ?? null);
            echo "\" maxlength=\"255\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"bot_style\">";
            // line 29
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOT_STYLE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOT_STYLE_EXPLAIN");
            echo "</span></dt>
\t\t<dd><select id=\"bot_style\" name=\"bot_style\">";
            // line 30
            echo ($context["S_STYLE_OPTIONS"] ?? null);
            echo "</select></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"bot_lang\">";
            // line 33
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOT_LANG");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOT_LANG_EXPLAIN");
            echo "</span></dt>
\t\t<dd><select id=\"bot_lang\" name=\"bot_lang\">";
            // line 34
            echo ($context["S_LANG_OPTIONS"] ?? null);
            echo "</select></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"bot_active\">";
            // line 37
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOT_ACTIVE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t<dd><select id=\"bot_active\" name=\"bot_active\">";
            // line 38
            echo ($context["S_ACTIVE_OPTIONS"] ?? null);
            echo "</select></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"bot_agent\">";
            // line 41
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOT_AGENT");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOT_AGENT_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input name=\"bot_agent\" type=\"text\" id=\"bot_agent\" value=\"";
            // line 42
            echo ($context["BOT_AGENT"] ?? null);
            echo "\" maxlength=\"255\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"bot_ip\">";
            // line 45
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOT_IP");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOT_IP_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input name=\"bot_ip\" type=\"text\" id=\"bot_ip\" value=\"";
            // line 46
            echo ($context["BOT_IP"] ?? null);
            echo "\" maxlength=\"255\" /></dd>
\t</dl>

\t<p class=\"submit-buttons\">
\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
            // line 50
            echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
            echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
            // line 51
            echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
            echo "\" />
\t\t";
            // line 52
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</p>
\t</fieldset>
\t</form>

";
        } else {
            // line 58
            echo "
\t<h1>";
            // line 59
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOTS");
            echo "</h1>

\t<p>";
            // line 61
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOTS_EXPLAIN");
            echo "</p>

\t<form id=\"acp_bots\" method=\"post\" action=\"";
            // line 63
            echo ($context["U_ACTION"] ?? null);
            echo "\">

\t<table class=\"table1 zebra-table\">
\t<thead>
\t<tr>
\t\t<th>";
            // line 68
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOT_NAME");
            echo "</th>
\t\t<th>";
            // line 69
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOT_LAST_VISIT");
            echo "</th>
\t\t<th colspan=\"3\">";
            // line 70
            echo $this->extensions['phpbb\template\twig\extension']->lang("OPTIONS");
            echo "</th>
\t\t<th>";
            // line 71
            echo $this->extensions['phpbb\template\twig\extension']->lang("MARK");
            echo "</th>
\t</tr>
\t</thead>
\t<tbody>
\t";
            // line 75
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "bots", [], "any", false, false, false, 75));
            foreach ($context['_seq'] as $context["_key"] => $context["bots"]) {
                // line 76
                echo "\t\t<tr>
\t\t\t<td style=\"width: 50%;\">";
                // line 77
                echo twig_get_attribute($this->env, $this->source, $context["bots"], "BOT_NAME", [], "any", false, false, false, 77);
                echo "</td>
\t\t\t<td style=\"width: 15%; white-space: nowrap;\" align=\"center\">&nbsp;";
                // line 78
                echo twig_get_attribute($this->env, $this->source, $context["bots"], "LAST_VISIT", [], "any", false, false, false, 78);
                echo "&nbsp;</td>
\t\t\t<td style=\"text-align: center;\">&nbsp;<a href=\"";
                // line 79
                echo twig_get_attribute($this->env, $this->source, $context["bots"], "U_ACTIVATE_DEACTIVATE", [], "any", false, false, false, 79);
                echo "\" data-ajax=\"activate_deactivate\">";
                echo twig_get_attribute($this->env, $this->source, $context["bots"], "L_ACTIVATE_DEACTIVATE", [], "any", false, false, false, 79);
                echo "</a>&nbsp;</td>
\t\t\t<td style=\"text-align: center;\">&nbsp;<a href=\"";
                // line 80
                echo twig_get_attribute($this->env, $this->source, $context["bots"], "U_EDIT", [], "any", false, false, false, 80);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("EDIT");
                echo "</a>&nbsp;</td>
\t\t\t<td style=\"text-align: center;\">&nbsp;<a href=\"";
                // line 81
                echo twig_get_attribute($this->env, $this->source, $context["bots"], "U_DELETE", [], "any", false, false, false, 81);
                echo "\" data-ajax=\"row_delete\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE");
                echo "</a>&nbsp;</td>
\t\t\t<td style=\"text-align: center;\"><input type=\"checkbox\" class=\"radio\" name=\"mark[]\" value=\"";
                // line 82
                echo twig_get_attribute($this->env, $this->source, $context["bots"], "BOT_ID", [], "any", false, false, false, 82);
                echo "\" /></td>
\t\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['bots'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 85
            echo "\t</tbody>
\t</table>

\t<fieldset class=\"quick\" style=\"float: ";
            // line 88
            echo ($context["S_CONTENT_FLOW_BEGIN"] ?? null);
            echo ";\">
\t\t<input class=\"button2\" name=\"add\" type=\"submit\" value=\"";
            // line 89
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOT_ADD");
            echo "\" />
\t</fieldset>

\t<fieldset class=\"quick\" style=\"float: ";
            // line 92
            echo ($context["S_CONTENT_FLOW_END"] ?? null);
            echo ";\">
\t\t<select name=\"action\">";
            // line 93
            echo ($context["S_BOT_OPTIONS"] ?? null);
            echo "</select>
\t\t<input class=\"button2\" name=\"submit\" type=\"submit\" value=\"";
            // line 94
            echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
            echo "\" />
\t\t<p class=\"small\"><a href=\"#\" onclick=\"marklist('acp_bots', 'mark', true);\">";
            // line 95
            echo $this->extensions['phpbb\template\twig\extension']->lang("MARK_ALL");
            echo "</a> &bull; <a href=\"#\" onclick=\"marklist('acp_bots', 'mark', false);\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("UNMARK_ALL");
            echo "</a></p>
\t\t";
            // line 96
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t</form>

";
        }
        // line 101
        echo "
";
        // line 102
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_bots.html", 102)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_bots.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  327 => 102,  324 => 101,  316 => 96,  310 => 95,  306 => 94,  302 => 93,  298 => 92,  292 => 89,  288 => 88,  283 => 85,  274 => 82,  268 => 81,  262 => 80,  256 => 79,  252 => 78,  248 => 77,  245 => 76,  241 => 75,  234 => 71,  230 => 70,  226 => 69,  222 => 68,  214 => 63,  209 => 61,  204 => 59,  201 => 58,  192 => 52,  188 => 51,  184 => 50,  177 => 46,  170 => 45,  164 => 42,  157 => 41,  151 => 38,  146 => 37,  140 => 34,  133 => 33,  127 => 30,  120 => 29,  114 => 26,  107 => 25,  102 => 23,  96 => 20,  93 => 19,  87 => 16,  83 => 15,  80 => 14,  78 => 13,  73 => 11,  68 => 9,  59 => 7,  56 => 6,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_bots.html", "");
    }
}
