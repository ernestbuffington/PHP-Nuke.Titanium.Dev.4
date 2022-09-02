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

/* ucp_profile_profile_info.html */
class __TwigTemplate_d1a7baf2e71e6e49665b7ba79e84ec19bf5709fde1b0a139019fc29c03980dd2 extends \Twig\Template
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
        $this->loadTemplate("ucp_header.html", "ucp_profile_profile_info.html", 1)->display($context);
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
        echo " <span class=\"small\">[ <a href=\"";
        echo ($context["U_USER_PROFILE"] ?? null);
        echo "\" title=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("VIEW_PROFILE");
        echo "\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("VIEW_PROFILE");
        echo "</a> ]</span></h2>

<div class=\"panel\">
\t<div class=\"inner\">
\t<p>";
        // line 9
        echo $this->extensions['phpbb\template\twig\extension']->lang("PROFILE_INFO_NOTICE");
        echo "</p>

\t<fieldset>
\t";
        // line 12
        if (($context["ERROR"] ?? null)) {
            echo "<p class=\"error\">";
            echo ($context["ERROR"] ?? null);
            echo "</p>";
        }
        // line 13
        echo "\t";
        // line 14
        echo "\t";
        if (($context["S_BIRTHDAYS_ENABLED"] ?? null)) {
            // line 15
            echo "\t\t<dl>
\t\t\t<dt><label for=\"bday_day\">";
            // line 16
            echo $this->extensions['phpbb\template\twig\extension']->lang("BIRTHDAY");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BIRTHDAY_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd>
\t\t\t\t<label for=\"bday_day\">";
            // line 18
            echo $this->extensions['phpbb\template\twig\extension']->lang("DAY");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo " <select name=\"bday_day\" id=\"bday_day\">";
            echo ($context["S_BIRTHDAY_DAY_OPTIONS"] ?? null);
            echo "</select></label>
\t\t\t\t<label for=\"bday_month\">";
            // line 19
            echo $this->extensions['phpbb\template\twig\extension']->lang("MONTH");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo " <select name=\"bday_month\" id=\"bday_month\">";
            echo ($context["S_BIRTHDAY_MONTH_OPTIONS"] ?? null);
            echo "</select></label>
\t\t\t\t<label for=\"bday_year\">";
            // line 20
            echo $this->extensions['phpbb\template\twig\extension']->lang("YEAR");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo " <select name=\"bday_year\" id=\"bday_year\">";
            echo ($context["S_BIRTHDAY_YEAR_OPTIONS"] ?? null);
            echo "</select></label>
\t\t\t</dd>
\t\t</dl>
\t";
        }
        // line 24
        echo "\t";
        if (($context["S_JABBER_ENABLED"] ?? null)) {
            // line 25
            echo "\t\t<dl>
\t\t\t<dt><label for=\"jabber\">";
            // line 26
            echo $this->extensions['phpbb\template\twig\extension']->lang("UCP_JABBER");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><input type=\"email\" name=\"jabber\" id=\"jabber\" maxlength=\"255\" value=\"";
            // line 27
            echo ($context["JABBER"] ?? null);
            echo "\" class=\"inputbox\" /></dd>
\t\t</dl>
\t";
        }
        // line 30
        echo "\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "profile_fields", [], "any", false, false, false, 30));
        foreach ($context['_seq'] as $context["_key"] => $context["profile_fields"]) {
            // line 31
            echo "\t\t<dl>
\t\t\t<dt><label";
            // line 32
            if (twig_get_attribute($this->env, $this->source, $context["profile_fields"], "FIELD_ID", [], "any", false, false, false, 32)) {
                echo " for=\"";
                echo twig_get_attribute($this->env, $this->source, $context["profile_fields"], "FIELD_ID", [], "any", false, false, false, 32);
                echo "\"";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["profile_fields"], "LANG_NAME", [], "any", false, false, false, 32);
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            if (twig_get_attribute($this->env, $this->source, $context["profile_fields"], "S_REQUIRED", [], "any", false, false, false, 32)) {
                echo " *";
            }
            echo "</label>
\t\t\t";
            // line 33
            if (twig_get_attribute($this->env, $this->source, $context["profile_fields"], "LANG_EXPLAIN", [], "any", false, false, false, 33)) {
                echo "<br /><span>";
                echo twig_get_attribute($this->env, $this->source, $context["profile_fields"], "LANG_EXPLAIN", [], "any", false, false, false, 33);
                echo "</span>";
            }
            echo "</dt>
\t\t\t";
            // line 34
            if (twig_get_attribute($this->env, $this->source, $context["profile_fields"], "ERROR", [], "any", false, false, false, 34)) {
                echo "<dd class=\"error\">";
                echo twig_get_attribute($this->env, $this->source, $context["profile_fields"], "ERROR", [], "any", false, false, false, 34);
                echo "</dd>";
            }
            // line 35
            echo "\t\t\t<dd>";
            echo twig_get_attribute($this->env, $this->source, $context["profile_fields"], "FIELD", [], "any", false, false, false, 35);
            echo "</dd>
\t\t</dl>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['profile_fields'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo "\t";
        // line 39
        echo "\t</fieldset>

\t</div>
</div>

<fieldset class=\"submit-buttons\">
\t";
        // line 45
        echo ($context["S_HIDDEN_FIELDS"] ?? null);
        echo "
\t<input type=\"submit\" name=\"submit\" value=\"";
        // line 46
        echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
        echo "\" class=\"button1\" />
\t";
        // line 47
        echo ($context["S_FORM_TOKEN"] ?? null);
        echo "
</fieldset>
</form>

";
        // line 51
        $location = "ucp_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("ucp_footer.html", "ucp_profile_profile_info.html", 51)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "ucp_profile_profile_info.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  212 => 51,  205 => 47,  201 => 46,  197 => 45,  189 => 39,  187 => 38,  177 => 35,  171 => 34,  163 => 33,  149 => 32,  146 => 31,  141 => 30,  135 => 27,  130 => 26,  127 => 25,  124 => 24,  114 => 20,  107 => 19,  100 => 18,  92 => 16,  89 => 15,  86 => 14,  84 => 13,  78 => 12,  72 => 9,  59 => 5,  52 => 3,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "ucp_profile_profile_info.html", "");
    }
}
