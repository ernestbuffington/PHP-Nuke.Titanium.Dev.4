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

/* acp_jabber.html */
class __TwigTemplate_7affa396d8b651c9fb1b75512d63ca47144a7683486f3147a88620a0bd5edfe9 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_jabber.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

<h1>";
        // line 5
        echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_JABBER_SETTINGS");
        echo "</h1>

<p>";
        // line 7
        echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_JABBER_SETTINGS_EXPLAIN");
        echo "</p>

";
        // line 9
        if (($context["S_WARNING"] ?? null)) {
            // line 10
            echo "\t<div class=\"errorbox\">
\t\t<h3>";
            // line 11
            echo $this->extensions['phpbb\template\twig\extension']->lang("WARNING");
            echo "</h3>
\t\t<p>";
            // line 12
            echo ($context["WARNING_MSG"] ?? null);
            echo "</p>
\t</div>
";
        }
        // line 15
        echo "
<form id=\"acp_jabber\" method=\"post\" action=\"";
        // line 16
        echo ($context["U_ACTION"] ?? null);
        echo "\">

<fieldset>
\t<legend>";
        // line 19
        echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_JABBER_SETTINGS");
        echo "</legend>
";
        // line 20
        if (($context["S_GTALK_NOTE"] ?? null)) {
            // line 21
            echo "\t<p>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_GTALK_NOTE");
            echo "</p>
";
        }
        // line 23
        echo "<dl>
\t<dt><label for=\"jab_enable\">";
        // line 24
        echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_ENABLE");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_ENABLE_EXPLAIN");
        echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" id=\"jab_enable\" name=\"jab_enable\" value=\"1\"";
        // line 25
        if (($context["JAB_ENABLE"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->extensions['phpbb\template\twig\extension']->lang("ENABLED");
        echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" name=\"jab_enable\" value=\"0\"";
        // line 26
        if ( !($context["JAB_ENABLE"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->extensions['phpbb\template\twig\extension']->lang("DISABLED");
        echo "</label></dd>
</dl>
<dl>
\t<dt><label for=\"jab_host\">";
        // line 29
        echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_SERVER");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_SERVER_EXPLAIN");
        echo "</span></dt>
\t<dd><input type=\"text\" id=\"jab_host\" name=\"jab_host\" value=\"";
        // line 30
        echo ($context["JAB_HOST"] ?? null);
        echo "\" /></dd>
</dl>
<dl>
\t<dt><label for=\"jab_port\">";
        // line 33
        echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_PORT");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_PORT_EXPLAIN");
        echo "</span></dt>
\t<dd><input type=\"number\" id=\"jab_port\" name=\"jab_port\" value=\"";
        // line 34
        echo ($context["JAB_PORT"] ?? null);
        echo "\" min=\"0\" max=\"99999\" /></dd>
</dl>
<dl>
\t<dt><label for=\"jab_username\">";
        // line 37
        echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_USERNAME");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_USERNAME_EXPLAIN");
        echo "</span></dt>
\t<dd><input type=\"text\" id=\"jab_username\" name=\"jab_username\" value=\"";
        // line 38
        echo ($context["JAB_USERNAME"] ?? null);
        echo "\" /></dd>
</dl>
<dl>
\t<dt><label for=\"jab_password\">";
        // line 41
        echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_PASSWORD");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_PASSWORD_EXPLAIN");
        echo "</span></dt>
\t<dd><input type=\"password\" id=\"jab_password\" name=\"jab_password\" value=\"";
        // line 42
        echo ($context["JAB_PASSWORD"] ?? null);
        echo "\" autocomplete=\"off\" /></dd>
</dl>
";
        // line 44
        if (($context["S_CAN_USE_SSL"] ?? null)) {
            // line 45
            echo "<dl>
\t<dt><label for=\"jab_use_ssl\">";
            // line 46
            echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_USE_SSL");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_USE_SSL_EXPLAIN");
            echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" id=\"jab_use_ssl\" name=\"jab_use_ssl\" value=\"1\"";
            // line 47
            if (($context["JAB_USE_SSL"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" name=\"jab_use_ssl\" value=\"0\"";
            // line 48
            if ( !($context["JAB_USE_SSL"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
</dl>
<dl>
\t<dt><label for=\"jab_verify_peer\">";
            // line 51
            echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_VERIFY_PEER");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_VERIFY_PEER_EXPLAIN");
            echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" id=\"jab_verify_peer\" name=\"jab_verify_peer\" value=\"1\"";
            // line 52
            if (($context["JAB_VERIFY_PEER"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" name=\"jab_verify_peer\" value=\"0\"";
            // line 53
            if ( !($context["JAB_VERIFY_PEER"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
</dl>
<dl>
\t<dt><label for=\"jab_verify_peer_name\">";
            // line 56
            echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_VERIFY_PEER_NAME");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_VERIFY_PEER_NAME_EXPLAIN");
            echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" id=\"jab_verify_peer_name\" name=\"jab_verify_peer_name\" value=\"1\"";
            // line 57
            if (($context["JAB_VERIFY_PEER_NAME"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" name=\"jab_verify_peer_name\" value=\"0\"";
            // line 58
            if ( !($context["JAB_VERIFY_PEER_NAME"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
</dl>
<dl>
\t<dt><label for=\"jab_allow_self_signed\">";
            // line 61
            echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_ALLOW_SELF_SIGNED");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_ALLOW_SELF_SIGNED_EXPLAIN");
            echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" id=\"jab_allow_self_signed\" name=\"jab_allow_self_signed\" value=\"1\"";
            // line 62
            if (($context["JAB_ALLOW_SELF_SIGNED"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" name=\"jab_allow_self_signed\" value=\"0\"";
            // line 63
            if ( !($context["JAB_ALLOW_SELF_SIGNED"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
</dl>
";
        }
        // line 66
        echo "<dl>
\t<dt><label for=\"jab_package_size\">";
        // line 67
        echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_PACKAGE_SIZE");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("JAB_PACKAGE_SIZE_EXPLAIN");
        echo "</span></dt>
\t<dd><input type=\"number\" id=\"jab_package_size\" name=\"jab_package_size\" value=\"";
        // line 68
        echo ($context["JAB_PACKAGE_SIZE"] ?? null);
        echo "\" min=\"0\" max=\"99999\" /></dd>
</dl>

</fieldset>

<fieldset>
\t<legend>";
        // line 74
        echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_SUBMIT_CHANGES");
        echo "</legend>
\t<p class=\"submit-buttons\">
\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
        // line 76
        echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
        echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
        // line 77
        echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
        echo "\" />
\t</p>
\t";
        // line 79
        echo ($context["S_FORM_TOKEN"] ?? null);
        echo "
</fieldset>
</form>

";
        // line 83
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_jabber.html", 83)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_jabber.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  324 => 83,  317 => 79,  312 => 77,  308 => 76,  303 => 74,  294 => 68,  287 => 67,  284 => 66,  274 => 63,  266 => 62,  259 => 61,  249 => 58,  241 => 57,  234 => 56,  224 => 53,  216 => 52,  209 => 51,  199 => 48,  191 => 47,  184 => 46,  181 => 45,  179 => 44,  174 => 42,  167 => 41,  161 => 38,  154 => 37,  148 => 34,  141 => 33,  135 => 30,  128 => 29,  118 => 26,  110 => 25,  103 => 24,  100 => 23,  94 => 21,  92 => 20,  88 => 19,  82 => 16,  79 => 15,  73 => 12,  69 => 11,  66 => 10,  64 => 9,  59 => 7,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_jabber.html", "");
    }
}
