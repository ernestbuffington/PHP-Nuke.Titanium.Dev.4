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

/* acp_modules.html */
class __TwigTemplate_25c7fbd6b4db45c920193870572ff2dcb22d9cf43a708b5f6e197f92f829afc6 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_modules.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

";
        // line 5
        if (($context["S_EDIT_MODULE"] ?? null)) {
            // line 6
            echo "
\t<script>
\t// <![CDATA[
\t\tfunction display_options(value)
\t\t{
\t\t\tif (value == 'category')
\t\t\t{
\t\t\t\tphpbb.toggleDisplay('modoptions', -1);
\t\t\t}
\t\t\telse
\t\t\t{
\t\t\t\tphpbb.toggleDisplay('modoptions', 1);
\t\t\t}
\t\t}

\t\tfunction display_modes(value)
\t\t{
\t\t\t// Find the old select tag
\t\t\tvar item = document.getElementById('module_mode');

\t\t\t// Create the new select tag
\t\t\tvar new_node = document.createElement('select');
\t\t\tnew_node.setAttribute('id', 'module_mode');
\t\t\tnew_node.setAttribute('name', 'module_mode');

\t\t\t// Substitute it for the old one
\t\t\titem.parentNode.replaceChild(new_node, item);

\t\t\t// Reset the variable
\t\t\titem = document.getElementById('module_mode');

\t\t\tvar j = 0;
";
            // line 38
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "m_names", [], "any", false, false, false, 38));
            foreach ($context['_seq'] as $context["_key"] => $context["m_names"]) {
                // line 39
                echo "\t\t
\t\t\tif (value == '";
                // line 40
                echo twig_get_attribute($this->env, $this->source, $context["m_names"], "A_NAME", [], "any", false, false, false, 40);
                echo "')
\t\t\t{
\t";
                // line 42
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["m_names"], "modes", [], "any", false, false, false, 42));
                foreach ($context['_seq'] as $context["_key"] => $context["modes"]) {
                    // line 43
                    echo "\t\t\t\titem.options[j] = new Option('";
                    echo twig_get_attribute($this->env, $this->source, $context["modes"], "A_VALUE", [], "any", false, false, false, 43);
                    echo "');
\t\t\t\titem.options[j].value = '";
                    // line 44
                    echo twig_get_attribute($this->env, $this->source, $context["modes"], "A_OPTION", [], "any", false, false, false, 44);
                    echo "';
\t\t\t\tj++;
\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['modes'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 47
                echo "\t\t\t}
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m_names'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 49
            echo "
\t\t\t// select first item
\t\t\titem.options[0].selected = true;
\t\t}

\t// ]]>
\t</script>

\t<a href=\"";
            // line 57
            echo ($context["U_BACK"] ?? null);
            echo "\" style=\"float: ";
            echo ($context["S_CONTENT_FLOW_END"] ?? null);
            echo ";\">&laquo; ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BACK");
            echo "</a>

\t<h1>";
            // line 59
            echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE");
            echo " :: ";
            echo ($context["MODULENAME"] ?? null);
            echo "</h1>

\t<p>";
            // line 61
            echo $this->extensions['phpbb\template\twig\extension']->lang("EDIT_MODULE_EXPLAIN");
            echo "</p>

\t";
            // line 63
            if (($context["S_ERROR"] ?? null)) {
                // line 64
                echo "\t\t<div class=\"errorbox\">
\t\t\t<h3>";
                // line 65
                echo $this->extensions['phpbb\template\twig\extension']->lang("WARNING");
                echo "</h3>
\t\t\t<p>";
                // line 66
                echo ($context["ERROR_MSG"] ?? null);
                echo "</p>
\t\t</div>
\t";
            }
            // line 69
            echo "
\t<form id=\"moduleedit\" method=\"post\" action=\"";
            // line 70
            echo ($context["U_EDIT_ACTION"] ?? null);
            echo "\">

\t<fieldset>
\t\t<legend>";
            // line 73
            echo $this->extensions['phpbb\template\twig\extension']->lang("GENERAL_OPTIONS");
            echo "</legend>
\t<dl>
\t\t<dt><label for=\"module_langname\">";
            // line 75
            echo $this->extensions['phpbb\template\twig\extension']->lang("MODULE_LANGNAME");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br />
\t\t<span>";
            // line 76
            echo $this->extensions['phpbb\template\twig\extension']->lang("MODULE_LANGNAME_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input name=\"module_langname\" type=\"text\" class=\"text medium\" id=\"module_langname\" value=\"";
            // line 77
            echo ($context["MODULE_LANGNAME"] ?? null);
            echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"module_type\">";
            // line 80
            echo $this->extensions['phpbb\template\twig\extension']->lang("MODULE_TYPE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t<dd><select name=\"module_type\" id=\"module_type\" onchange=\"display_options(this.value);\"><option value=\"category\"";
            // line 81
            if (($context["S_IS_CAT"] ?? null)) {
                echo " selected=\"selected\"";
            }
            echo ">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("CATEGORY");
            echo "</option><option value=\"module\"";
            if ( !($context["S_IS_CAT"] ?? null)) {
                echo " selected=\"selected\"";
            }
            echo ">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("MODULE");
            echo "</option></select></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"parent_id\">";
            // line 84
            echo $this->extensions['phpbb\template\twig\extension']->lang("PARENT");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t<dd><select name=\"module_parent_id\" id=\"parent_id\">";
            // line 85
            echo ($context["S_CAT_OPTIONS"] ?? null);
            echo "</select></dd>
\t</dl>
\t<hr />
\t<dl>
\t\t<dt><label for=\"module_enabled\">";
            // line 89
            echo $this->extensions['phpbb\template\twig\extension']->lang("MODULE_ENABLED");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"module_enabled\" id=\"module_enabled\" value=\"1\"";
            // line 90
            if (($context["MODULE_ENABLED"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"module_enabled\" value=\"0\"";
            // line 91
            if ( !($context["MODULE_ENABLED"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t</dl>
\t<div id=\"modoptions\"";
            // line 93
            if (($context["S_IS_CAT"] ?? null)) {
                echo " style=\"display: none;\"";
            }
            echo ">
\t\t<dl>
\t\t\t<dt><label for=\"module_display\">";
            // line 95
            echo $this->extensions['phpbb\template\twig\extension']->lang("MODULE_DISPLAYED");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("MODULE_DISPLAYED_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"module_display\" id=\"module_display\" value=\"1\"";
            // line 96
            if (($context["MODULE_DISPLAY"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"module_display\" value=\"0\"";
            // line 97
            if ( !($context["MODULE_DISPLAY"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"module_basename\">";
            // line 100
            echo $this->extensions['phpbb\template\twig\extension']->lang("CHOOSE_MODULE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br />
\t\t\t<span>";
            // line 101
            echo $this->extensions['phpbb\template\twig\extension']->lang("CHOOSE_MODULE_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><select name=\"module_basename\" id=\"module_basename\" onchange=\"display_modes(this.value);\">";
            // line 102
            echo ($context["S_MODULE_NAMES"] ?? null);
            echo "</select></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"module_mode\">";
            // line 105
            echo $this->extensions['phpbb\template\twig\extension']->lang("CHOOSE_MODE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br />
\t\t\t<span>";
            // line 106
            echo $this->extensions['phpbb\template\twig\extension']->lang("CHOOSE_MODE_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><select name=\"module_mode\" id=\"module_mode\">";
            // line 107
            echo ($context["S_MODULE_MODES"] ?? null);
            echo "</select></dd>
\t\t</dl>
\t</div>

\t<p class=\"submit-buttons\">
\t\t<input type=\"hidden\" name=\"action\" value=\"";
            // line 112
            echo ($context["ACTION"] ?? null);
            echo "\" />
\t\t<input type=\"hidden\" name=\"m\" value=\"";
            // line 113
            echo ($context["MODULE_ID"] ?? null);
            echo "\" />
\t\t
\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
            // line 115
            echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
            echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
            // line 116
            echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
            echo "\" />
\t</p>
\t";
            // line 118
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t</form>

";
        } else {
            // line 123
            echo "
\t<h1>";
            // line 124
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_MODULE_MANAGEMENT");
            echo "</h1>

\t<p>";
            // line 126
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_MODULE_MANAGEMENT_EXPLAIN");
            echo "</p>

\t";
            // line 128
            if (($context["S_ERROR"] ?? null)) {
                // line 129
                echo "\t\t<div class=\"errorbox\">
\t\t\t<h3>";
                // line 130
                echo $this->extensions['phpbb\template\twig\extension']->lang("WARNING");
                echo "</h3>
\t\t\t<p>";
                // line 131
                echo ($context["ERROR_MSG"] ?? null);
                echo "</p>
\t\t</div>
\t";
            }
            // line 134
            echo "
\t<table class=\"table1\">
\t<tbody>
\t<tr>
\t\t<td class=\"row3\">";
            // line 138
            echo ($context["NAVIGATION"] ?? null);
            if (($context["S_NO_MODULES"] ?? null)) {
                echo " [<a href=\"";
                echo ($context["U_EDIT"] ?? null);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("EDIT");
                echo "</a> | <a href=\"";
                echo ($context["U_DELETE"] ?? null);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE");
                echo "</a> | ";
                if (($context["MODULE_ENABLED"] ?? null)) {
                    echo "<a href=\"";
                    echo ($context["U_DISABLE"] ?? null);
                    echo "\">";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("DISABLE");
                    echo "</a>";
                } else {
                    echo "<a href=\"";
                    echo ($context["U_ENABLE"] ?? null);
                    echo "\">";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ENABLE");
                    echo "</a>";
                }
                echo "]";
            }
            echo "</td>
\t</tr>
\t</tbody>
\t</table>

\t";
            // line 143
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "modules", [], "any", false, false, false, 143))) {
                // line 144
                echo "\t\t<table class=\"table1\">
\t\t\t<col class=\"row1\" /><col class=\"row1\" /><col class=\"row2\" /><col class=\"row2\" />
\t\t<tbody>
\t\t";
                // line 147
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "modules", [], "any", false, false, false, 147));
                foreach ($context['_seq'] as $context["_key"] => $context["modules"]) {
                    // line 148
                    echo "\t\t\t<tr>
\t\t\t\t<td style=\"width: 5%; text-align: center;\">";
                    // line 149
                    echo twig_get_attribute($this->env, $this->source, $context["modules"], "MODULE_IMAGE", [], "any", false, false, false, 149);
                    echo "</td>
\t\t\t\t<td><a href=\"";
                    // line 150
                    echo twig_get_attribute($this->env, $this->source, $context["modules"], "U_MODULE", [], "any", false, false, false, 150);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["modules"], "MODULE_TITLE", [], "any", false, false, false, 150);
                    echo "</a>";
                    if ( !twig_get_attribute($this->env, $this->source, $context["modules"], "MODULE_DISPLAYED", [], "any", false, false, false, 150)) {
                        echo " <span class=\"small\">[";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("HIDDEN_MODULE");
                        echo "]</span>";
                    }
                    echo "</td>
\t\t\t\t<td style=\"width: 15%; white-space: nowrap; text-align: center; vertical-align: middle;\">&nbsp;";
                    // line 151
                    if (twig_get_attribute($this->env, $this->source, $context["modules"], "MODULE_ENABLED", [], "any", false, false, false, 151)) {
                        echo "<a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["modules"], "U_DISABLE", [], "any", false, false, false, 151);
                        echo "\">";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("DISABLE");
                        echo "</a>";
                    } else {
                        echo "<a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["modules"], "U_ENABLE", [], "any", false, false, false, 151);
                        echo "\">";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("ENABLE");
                        echo "</a>";
                    }
                    echo "&nbsp;</td>
\t\t\t\t<td class=\"actions\">
\t\t\t\t\t<span class=\"up-disabled\" style=\"display:none;\">";
                    // line 153
                    echo ($context["ICON_MOVE_UP_DISABLED"] ?? null);
                    echo "</span>
\t\t\t\t\t<span class=\"up\"><a href=\"";
                    // line 154
                    echo twig_get_attribute($this->env, $this->source, $context["modules"], "U_MOVE_UP", [], "any", false, false, false, 154);
                    echo "\" data-ajax=\"row_up\">";
                    echo ($context["ICON_MOVE_UP"] ?? null);
                    echo "</a></span>
\t\t\t\t\t<span class=\"down-disabled\" style=\"display:none;\">";
                    // line 155
                    echo ($context["ICON_MOVE_DOWN_DISABLED"] ?? null);
                    echo "</span>
\t\t\t\t\t<span class=\"down\"><a href=\"";
                    // line 156
                    echo twig_get_attribute($this->env, $this->source, $context["modules"], "U_MOVE_DOWN", [], "any", false, false, false, 156);
                    echo "\" data-ajax=\"row_down\">";
                    echo ($context["ICON_MOVE_DOWN"] ?? null);
                    echo "</a></span>
\t\t\t\t\t<a href=\"";
                    // line 157
                    echo twig_get_attribute($this->env, $this->source, $context["modules"], "U_EDIT", [], "any", false, false, false, 157);
                    echo "\">";
                    echo ($context["ICON_EDIT"] ?? null);
                    echo "</a> 
\t\t\t\t\t<a href=\"";
                    // line 158
                    echo twig_get_attribute($this->env, $this->source, $context["modules"], "U_DELETE", [], "any", false, false, false, 158);
                    echo "\" data-ajax=\"row_delete\">";
                    echo ($context["ICON_DELETE"] ?? null);
                    echo "</a>
\t\t\t\t</td>
\t\t\t</tr>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['modules'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 162
                echo "\t\t</tbody>
\t\t</table>
\t";
            }
            // line 165
            echo "
\t<div class=\"clearfix\">&nbsp;</div>

\t<form id=\"quick\" method=\"post\" action=\"";
            // line 168
            echo ($context["U_ACTION"] ?? null);
            echo "\">

\t<fieldset class=\"quick\" style=\"float: ";
            // line 170
            echo ($context["S_CONTENT_FLOW_END"] ?? null);
            echo ";\">
\t\t<input type=\"hidden\" name=\"action\" value=\"quickadd\" />

\t\t<select name=\"quick_install\">";
            // line 173
            echo ($context["S_INSTALL_OPTIONS"] ?? null);
            echo "</select>
\t\t<input class=\"button2\" name=\"quickadd\" type=\"submit\" value=\"";
            // line 174
            echo $this->extensions['phpbb\template\twig\extension']->lang("ADD_MODULE");
            echo "\" />
\t</fieldset>
\t
\t</form>

\t<form id=\"module\" method=\"post\" action=\"";
            // line 179
            echo ($context["U_ACTION"] ?? null);
            echo "\">

\t<fieldset class=\"quick\" style=\"float: ";
            // line 181
            echo ($context["S_CONTENT_FLOW_BEGIN"] ?? null);
            echo ";\">
\t\t<input type=\"hidden\" name=\"action\" value=\"add\" />
\t\t<input type=\"hidden\" name=\"module_parent_id\" value=\"";
            // line 183
            echo ($context["PARENT_ID"] ?? null);
            echo "\" />

\t\t<input type=\"text\" name=\"module_langname\" maxlength=\"255\" /> 
\t\t<input class=\"button2\" name=\"addmodule\" type=\"submit\" value=\"";
            // line 186
            echo $this->extensions['phpbb\template\twig\extension']->lang("CREATE_MODULE");
            echo "\" />
\t</fieldset>

\t</form>

\t<div class=\"clearfix\">&nbsp;</div><br style=\"clear: both;\" />
\t
\t<form id=\"mselect\" method=\"post\" action=\"";
            // line 193
            echo ($context["U_SEL_ACTION"] ?? null);
            echo "\">
\t<fieldset class=\"quick\">
\t\t";
            // line 195
            echo $this->extensions['phpbb\template\twig\extension']->lang("SELECT_MODULE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo " <select name=\"parent_id\" onchange=\"if(this.options[this.selectedIndex].value != -1){ this.form.submit(); }\">";
            echo ($context["MODULE_BOX"] ?? null);
            echo "</select> 

\t\t<input class=\"button2\" type=\"submit\" value=\"";
            // line 197
            echo $this->extensions['phpbb\template\twig\extension']->lang("GO");
            echo "\" />
\t</fieldset>
\t</form>

";
        }
        // line 202
        echo "
";
        // line 203
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_modules.html", 203)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_modules.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  582 => 203,  579 => 202,  571 => 197,  563 => 195,  558 => 193,  548 => 186,  542 => 183,  537 => 181,  532 => 179,  524 => 174,  520 => 173,  514 => 170,  509 => 168,  504 => 165,  499 => 162,  487 => 158,  481 => 157,  475 => 156,  471 => 155,  465 => 154,  461 => 153,  444 => 151,  432 => 150,  428 => 149,  425 => 148,  421 => 147,  416 => 144,  414 => 143,  381 => 138,  375 => 134,  369 => 131,  365 => 130,  362 => 129,  360 => 128,  355 => 126,  350 => 124,  347 => 123,  339 => 118,  334 => 116,  330 => 115,  325 => 113,  321 => 112,  313 => 107,  309 => 106,  304 => 105,  298 => 102,  294 => 101,  289 => 100,  279 => 97,  271 => 96,  264 => 95,  257 => 93,  248 => 91,  240 => 90,  235 => 89,  228 => 85,  223 => 84,  207 => 81,  202 => 80,  196 => 77,  192 => 76,  187 => 75,  182 => 73,  176 => 70,  173 => 69,  167 => 66,  163 => 65,  160 => 64,  158 => 63,  153 => 61,  146 => 59,  137 => 57,  127 => 49,  120 => 47,  111 => 44,  106 => 43,  102 => 42,  97 => 40,  94 => 39,  90 => 38,  56 => 6,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_modules.html", "");
    }
}
