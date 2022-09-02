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

/* ucp_prefs_personal.html */
class __TwigTemplate_5fe3357e6100cb7aedc2febbe753b6b4115d848a820b707f7ea0122ae36fe39f extends \Twig\Template
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
        $location = "ucp_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("ucp_header.html", "ucp_prefs_personal.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<form id=\"ucp\" method=\"post\" action=\"";
        // line 3
        echo ($context["S_UCP_ACTION"] ?? null);
        echo "\"";
        echo ($context["S_FORM_ENCTYPE"] ?? null);
        echo ">

<h2>";
        // line 5
        echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE");
        echo "</h2>

<div class=\"panel\">
\t<div class=\"inner\">

\t<fieldset>
\t";
        // line 11
        if (($context["ERROR"] ?? null)) {
            echo "<p class=\"error\">";
            echo ($context["ERROR"] ?? null);
            echo "</p>";
        }
        // line 12
        echo "\t";
        // line 13
        echo "\t<dl>
\t\t<dt><label for=\"viewemail0\">";
        // line 14
        echo $this->extensions['phpbb\template\twig\extension']->lang("SHOW_EMAIL");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label></dt>
\t\t<dd>
\t\t\t<label for=\"viewemail1\"><input type=\"radio\" name=\"viewemail\" id=\"viewemail1\" value=\"1\"";
        // line 16
        if (($context["S_VIEW_EMAIL"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
        echo "</label>
\t\t\t<label for=\"viewemail0\"><input type=\"radio\" name=\"viewemail\" id=\"viewemail0\" value=\"0\"";
        // line 17
        if ( !($context["S_VIEW_EMAIL"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
        echo "</label>
\t\t</dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"massemail1\">";
        // line 21
        echo $this->extensions['phpbb\template\twig\extension']->lang("ADMIN_EMAIL");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label></dt>
\t\t<dd>
\t\t\t<label for=\"massemail1\"><input type=\"radio\" name=\"massemail\" id=\"massemail1\" value=\"1\"";
        // line 23
        if (($context["S_MASS_EMAIL"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
        echo "</label>
\t\t\t<label for=\"massemail0\"><input type=\"radio\" name=\"massemail\" id=\"massemail0\" value=\"0\"";
        // line 24
        if ( !($context["S_MASS_EMAIL"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
        echo "</label>
\t\t</dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"allowpm1\">";
        // line 28
        echo $this->extensions['phpbb\template\twig\extension']->lang("ALLOW_PM");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("ALLOW_PM_EXPLAIN");
        echo "</span></dt>
\t\t<dd>
\t\t\t<label for=\"allowpm1\"><input type=\"radio\" name=\"allowpm\" id=\"allowpm1\" value=\"1\"";
        // line 30
        if (($context["S_ALLOW_PM"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
        echo "</label>
\t\t\t<label for=\"allowpm0\"><input type=\"radio\" name=\"allowpm\" id=\"allowpm0\" value=\"0\"";
        // line 31
        if ( !($context["S_ALLOW_PM"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
        echo "</label>
\t\t</dd>
\t</dl>
\t";
        // line 34
        if (($context["S_CAN_HIDE_ONLINE"] ?? null)) {
            // line 35
            echo "\t\t<dl>
\t\t\t<dt><label for=\"hideonline0\">";
            // line 36
            echo $this->extensions['phpbb\template\twig\extension']->lang("HIDE_ONLINE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("HIDE_ONLINE_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd>
\t\t\t\t<label for=\"hideonline1\"><input type=\"radio\" name=\"hideonline\" id=\"hideonline1\" value=\"1\"";
            // line 38
            if (($context["S_HIDE_ONLINE"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label for=\"hideonline0\"><input type=\"radio\" name=\"hideonline\" id=\"hideonline0\" value=\"0\"";
            // line 39
            if ( !($context["S_HIDE_ONLINE"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label>
\t\t\t</dd>
\t\t</dl>
\t";
        }
        // line 43
        echo "\t";
        if (($context["S_SELECT_NOTIFY"] ?? null)) {
            // line 44
            echo "\t\t<dl>
\t\t\t<dt><label for=\"notifymethod0\">";
            // line 45
            echo $this->extensions['phpbb\template\twig\extension']->lang("NOTIFY_METHOD");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t<dd>
\t\t\t\t<label for=\"notifymethod0\"><input type=\"radio\" name=\"notifymethod\" id=\"notifymethod0\" value=\"0\"";
            // line 47
            if (($context["S_NOTIFY_EMAIL"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NOTIFY_METHOD_EMAIL");
            echo "</label>
\t\t\t\t<label for=\"notifymethod1\"><input type=\"radio\" name=\"notifymethod\" id=\"notifymethod1\" value=\"1\"";
            // line 48
            if (($context["S_NOTIFY_IM"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NOTIFY_METHOD_IM");
            echo "</label>
\t\t\t\t<label for=\"notifymethod2\"><input type=\"radio\" name=\"notifymethod\" id=\"notifymethod2\" value=\"2\"";
            // line 49
            if (($context["S_NOTIFY_BOTH"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NOTIFY_METHOD_BOTH");
            echo "</label>
\t\t\t</dd>
\t\t</dl>
\t";
        }
        // line 53
        echo "\t";
        if (($context["S_MORE_LANGUAGES"] ?? null)) {
            // line 54
            echo "\t\t<dl>
\t\t\t<dt><label for=\"lang\">";
            // line 55
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOARD_LANGUAGE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><select name=\"lang\" id=\"lang\">";
            // line 56
            echo ($context["S_LANG_OPTIONS"] ?? null);
            echo "</select></dd>
\t\t</dl>
\t";
        }
        // line 59
        echo "\t";
        if ((($context["S_STYLE_OPTIONS"] ?? null) && ($context["S_MORE_STYLES"] ?? null))) {
            // line 60
            echo "\t\t<dl>
\t\t\t<dt><label for=\"user_style\">";
            // line 61
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOARD_STYLE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><select name=\"user_style\" id=\"user_style\">";
            // line 62
            echo ($context["S_STYLE_OPTIONS"] ?? null);
            echo "</select></dd>
\t\t</dl>
\t";
        }
        // line 65
        echo "\t";
        $location = "timezone_option.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("timezone_option.html", "ucp_prefs_personal.html", 65)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 66
        echo "\t<dl>
\t\t<dt><label for=\"dateformat\">";
        // line 67
        echo $this->extensions['phpbb\template\twig\extension']->lang("BOARD_DATE_FORMAT");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("BOARD_DATE_FORMAT_EXPLAIN");
        echo "</span></dt>
\t\t<dd>
\t\t\t<select name=\"dateoptions\" id=\"dateoptions\" onchange=\"if(this.value=='custom'){phpbb.toggleDisplay('custom_date',1);}else{phpbb.toggleDisplay('custom_date',-1);} if (this.value == 'custom') { document.getElementById('dateformat').value = default_dateformat; } else { document.getElementById('dateformat').value = this.value; }\">
\t\t\t\t";
        // line 70
        echo ($context["S_DATEFORMAT_OPTIONS"] ?? null);
        echo "
\t\t\t</select>
\t\t</dd>
\t\t<dd id=\"custom_date\" style=\"display:none;\"><input type=\"text\" name=\"dateformat\" id=\"dateformat\" value=\"";
        // line 73
        echo ($context["DATE_FORMAT"] ?? null);
        echo "\" maxlength=\"64\" class=\"inputbox narrow\" style=\"margin-top: 3px;\" /></dd>
\t</dl>
\t";
        // line 75
        // line 76
        echo "\t</fieldset>

\t</div>
</div>

<fieldset class=\"submit-buttons\">
\t";
        // line 82
        echo ($context["S_HIDDEN_FIELDS"] ?? null);
        echo "
\t<input type=\"submit\" name=\"submit\" value=\"";
        // line 83
        echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
        echo "\" class=\"button1\" />
\t";
        // line 84
        echo ($context["S_FORM_TOKEN"] ?? null);
        echo "
</fieldset>
</form>

<script>
\tvar date_format = '";
        // line 89
        echo ($context["A_DATE_FORMAT"] ?? null);
        echo "';
\tvar default_dateformat = '";
        // line 90
        echo ($context["A_DEFAULT_DATEFORMAT"] ?? null);
        echo "';

\tfunction customDates()
\t{
\t\tvar e = document.getElementById('dateoptions');

\t\te.selectedIndex = e.length - 1;

\t\t// Loop and match date_format in menu
\t\tfor (var i = 0; i < e.length; i++)
\t\t{
\t\t\tif (e.options[i].value == date_format)
\t\t\t{
\t\t\t\te.selectedIndex = i;
\t\t\t\tbreak;
\t\t\t}
\t\t}

\t\t// Show/hide custom field
\t\tif (e.selectedIndex == e.length - 1)
\t\t{
\t\t\tphpbb.toggleDisplay('custom_date',1);
\t\t}
\t\telse
\t\t{
\t\t\tphpbb.toggleDisplay('custom_date',-1);
\t\t}
\t}

\twindow.onload = customDates;
</script>

";
        // line 122
        $location = "ucp_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("ucp_footer.html", "ucp_prefs_personal.html", 122)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "ucp_prefs_personal.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  360 => 122,  325 => 90,  321 => 89,  313 => 84,  309 => 83,  305 => 82,  297 => 76,  296 => 75,  291 => 73,  285 => 70,  276 => 67,  273 => 66,  260 => 65,  254 => 62,  249 => 61,  246 => 60,  243 => 59,  237 => 56,  232 => 55,  229 => 54,  226 => 53,  215 => 49,  207 => 48,  199 => 47,  193 => 45,  190 => 44,  187 => 43,  176 => 39,  168 => 38,  160 => 36,  157 => 35,  155 => 34,  145 => 31,  137 => 30,  129 => 28,  118 => 24,  110 => 23,  104 => 21,  93 => 17,  85 => 16,  79 => 14,  76 => 13,  74 => 12,  68 => 11,  59 => 5,  52 => 3,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "ucp_prefs_personal.html", "");
    }
}
