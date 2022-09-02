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

/* acp_viglink.html */
class __TwigTemplate_442893f906712e065b6a604e1194bdfb7271bb60d78f63a617a45e5cfab29e0e extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_viglink.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

<h1>";
        // line 5
        echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_VIGLINK_SETTINGS");
        echo "</h1>

<p>";
        // line 7
        echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_VIGLINK_SETTINGS_EXPLAIN");
        echo "</p>

";
        // line 9
        if (($context["S_ERROR"] ?? null)) {
            // line 10
            echo "<div class=\"errorbox\">
\t<h3>";
            // line 11
            echo $this->extensions['phpbb\template\twig\extension']->lang("WARNING");
            echo "</h3>
\t<p>";
            // line 12
            echo ($context["ERROR_MSG"] ?? null);
            echo "</p>
</div>
";
        }
        // line 15
        echo "
<form id=\"acp_viglink\" method=\"post\" action=\"";
        // line 16
        echo ($context["U_ACTION"] ?? null);
        echo "\">

\t<fieldset>
\t\t<legend>";
        // line 19
        echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_VIGLINK_SETTINGS");
        echo "</legend>
\t\t<dl>
\t\t\t<dt><label for=\"viglink_enabled\">";
        // line 21
        echo ($this->extensions['phpbb\template\twig\extension']->lang("ACP_VIGLINK_ENABLE") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_VIGLINK_ENABLE_EXPLAIN");
        echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" id=\"viglink_enabled\" name=\"viglink_enabled\" value=\"1\"";
        // line 22
        if (($context["VIGLINK_ENABLED"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->extensions['phpbb\template\twig\extension']->lang("ENABLED");
        echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"viglink_enabled\" value=\"0\"";
        // line 23
        if ( !($context["VIGLINK_ENABLED"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->extensions['phpbb\template\twig\extension']->lang("DISABLED");
        echo "</label></dd>
\t\t</dl>
\t</fieldset>

\t<h1>";
        // line 27
        echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_VIGLINK_EARNINGS");
        echo "</h1>

\t<p>";
        // line 29
        echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_VIGLINK_EARNINGS_EXPLAIN");
        echo "</p>

\t<fieldset>
\t\t<legend>";
        // line 32
        echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_VIGLINK_EARNINGS");
        echo "</legend>
\t\t";
        // line 33
        if (($context["U_VIGLINK_CONVERT"] ?? null)) {
            // line 34
            echo "\t\t<dl>
\t\t\t<dt><label>";
            // line 35
            echo ($this->extensions['phpbb\template\twig\extension']->lang("ACP_VIGLINK_CLAIM") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_VIGLINK_CLAIM_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><a href=\"";
            // line 36
            echo ($context["U_VIGLINK_CONVERT"] ?? null);
            echo "\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_VIGLINK_CONVERT_ACCOUNT");
            echo "</a></dd>
\t\t</dl>
\t\t";
        }
        // line 39
        echo "\t</fieldset>

\t<fieldset class=\"submit-buttons\">
\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
        // line 42
        echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
        echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
        // line 43
        echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
        echo "\" />
\t\t";
        // line 44
        echo ($context["S_FORM_TOKEN"] ?? null);
        echo "
\t</fieldset>
</form>

";
        // line 48
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_viglink.html", 48)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_viglink.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  172 => 48,  165 => 44,  161 => 43,  157 => 42,  152 => 39,  144 => 36,  138 => 35,  135 => 34,  133 => 33,  129 => 32,  123 => 29,  118 => 27,  107 => 23,  99 => 22,  93 => 21,  88 => 19,  82 => 16,  79 => 15,  73 => 12,  69 => 11,  66 => 10,  64 => 9,  59 => 7,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_viglink.html", "");
    }
}
