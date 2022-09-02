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

/* auth_provider_ldap.html */
class __TwigTemplate_192ce14f51406c11ba09396a08826bcad9aee00e25d567a99463989d444de1d2 extends \Twig\Template
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
        echo "<fieldset id=\"auth_ldap_settings\">
\t<legend>";
        // line 2
        echo $this->extensions['phpbb\template\twig\extension']->lang("LDAP");
        echo "</legend>
\t<dl>
\t\t<dt><label for=\"ldap_server\">";
        // line 4
        echo $this->extensions['phpbb\template\twig\extension']->lang("LDAP_SERVER");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("LDAP_SERVER_EXPLAIN");
        echo "</span></dt>
\t\t<dd><input type=\"text\" id=\"ldap_server\" size=\"40\" name=\"config[ldap_server]\" value=\"";
        // line 5
        echo ($context["AUTH_LDAP_SERVER"] ?? null);
        echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"ldap_port\">";
        // line 8
        echo $this->extensions['phpbb\template\twig\extension']->lang("LDAP_PORT");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("LDAP_PORT_EXPLAIN");
        echo "</span></dt>
\t\t<dd><input type=\"text\" id=\"ldap_port\" size=\"40\" name=\"config[ldap_port]\" value=\"";
        // line 9
        echo ($context["AUTH_LDAP_PORT"] ?? null);
        echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"ldap_dn\">";
        // line 12
        echo $this->extensions['phpbb\template\twig\extension']->lang("LDAP_DN");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("LDAP_DN_EXPLAIN");
        echo "</span></dt>
\t\t<dd><input type=\"text\" id=\"ldap_dn\" size=\"40\" name=\"config[ldap_base_dn]\" value=\"";
        // line 13
        echo ($context["AUTH_LDAP_BASE_DN"] ?? null);
        echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"ldap_uid\">";
        // line 16
        echo $this->extensions['phpbb\template\twig\extension']->lang("LDAP_UID");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("LDAP_UID_EXPLAIN");
        echo "</span></dt>
\t\t<dd><input type=\"text\" id=\"ldap_uid\" size=\"40\" name=\"config[ldap_uid]\" value=\"";
        // line 17
        echo ($context["AUTH_LDAP_UID"] ?? null);
        echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"ldap_user_filter\">";
        // line 20
        echo $this->extensions['phpbb\template\twig\extension']->lang("LDAP_USER_FILTER");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("LDAP_USER_FILTER_EXPLAIN");
        echo "</span></dt>
\t\t<dd><input type=\"text\" id=\"ldap_user_filter\" size=\"40\" name=\"config[ldap_user_filter]\" value=\"";
        // line 21
        echo ($context["AUTH_LDAP_USER_FILTER"] ?? null);
        echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"ldap_email\">";
        // line 24
        echo $this->extensions['phpbb\template\twig\extension']->lang("LDAP_EMAIL");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("LDAP_EMAIL_EXPLAIN");
        echo "</span></dt>
\t\t<dd><input type=\"text\" id=\"ldap_email\" size=\"40\" name=\"config[ldap_email]\" value=\"";
        // line 25
        echo ($context["AUTH_LDAP_EMAIL"] ?? null);
        echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"ldap_user\">";
        // line 28
        echo $this->extensions['phpbb\template\twig\extension']->lang("LDAP_USER");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("LDAP_USER_EXPLAIN");
        echo "</span></dt>
\t\t<dd><input type=\"text\" id=\"ldap_user\" size=\"40\" name=\"config[ldap_user]\" value=\"";
        // line 29
        echo ($context["AUTH_LDAP_USER"] ?? null);
        echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"ldap_password\">";
        // line 32
        echo $this->extensions['phpbb\template\twig\extension']->lang("LDAP_PASSWORD");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("LDAP_PASSWORD_EXPLAIN");
        echo "</span></dt>
\t\t<dd><input type=\"password\" id=\"ldap_password\" size=\"40\" name=\"config[ldap_password]\" value=\"";
        // line 33
        echo ($context["AUTH_LDAP_PASSWORD"] ?? null);
        echo "\" autocomplete=\"off\" /></dd>
\t</dl>
</fieldset>
";
    }

    public function getTemplateName()
    {
        return "auth_provider_ldap.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  143 => 33,  136 => 32,  130 => 29,  123 => 28,  117 => 25,  110 => 24,  104 => 21,  97 => 20,  91 => 17,  84 => 16,  78 => 13,  71 => 12,  65 => 9,  58 => 8,  52 => 5,  45 => 4,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "auth_provider_ldap.html", "");
    }
}
