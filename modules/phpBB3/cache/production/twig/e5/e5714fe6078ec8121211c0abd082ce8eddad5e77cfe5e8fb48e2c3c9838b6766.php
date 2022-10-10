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

/* acp_update.html */
class __TwigTemplate_c811f827f2e6863a64de406a00d963dc9bc394ae52ca0c20d0018b0116b913a4 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_update.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

<h1>";
        // line 5
        echo $this->extensions['phpbb\template\twig\extension']->lang("VERSION_CHECK");
        echo "</h1>

<p>";
        // line 7
        echo $this->extensions['phpbb\template\twig\extension']->lang("VERSION_CHECK_EXPLAIN");
        echo "</p>

";
        // line 9
        if (($context["S_UPDATE_INCOMPLETE"] ?? null)) {
            // line 10
            echo "\t<div class=\"errorbox\">
\t\t<p>";
            // line 11
            echo $this->extensions['phpbb\template\twig\extension']->lang("UPDATE_INCOMPLETE");
            echo " ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("UPDATE_INCOMPLETE_MORE");
            echo "</p>
\t</div>
";
        }
        // line 14
        if (($context["S_UP_TO_DATE"] ?? null)) {
            // line 15
            echo "\t<div class=\"successbox\">
\t\t<p>";
            // line 16
            echo $this->extensions['phpbb\template\twig\extension']->lang("VERSION_UP_TO_DATE_ACP");
            echo " - <a href=\"";
            echo ($context["U_VERSIONCHECK_FORCE"] ?? null);
            echo "\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("VERSIONCHECK_FORCE_UPDATE");
            echo "</a></p>
\t</div>
";
        } elseif ( !        // line 18
($context["S_UPDATE_INCOMPLETE"] ?? null)) {
            // line 19
            echo "\t<div class=\"errorbox\">
\t\t<p>";
            // line 20
            echo $this->extensions['phpbb\template\twig\extension']->lang("VERSION_NOT_UP_TO_DATE_ACP");
            echo " - <a href=\"";
            echo ($context["U_VERSIONCHECK_FORCE"] ?? null);
            echo "\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("VERSIONCHECK_FORCE_UPDATE");
            echo "</a></p>
\t</div>
";
        }
        // line 23
        if (($context["S_VERSION_UPGRADEABLE"] ?? null)) {
            // line 24
            echo "\t<div class=\"errorbox notice\">
\t\t<p>";
            // line 25
            echo ($context["UPGRADE_INSTRUCTIONS"] ?? null);
            echo "</p>
\t</div>
";
        }
        // line 28
        echo "
<fieldset>
\t<legend></legend>
\t";
        // line 31
        if ( !($context["S_UPDATE_INCOMPLETE"] ?? null)) {
            // line 32
            echo "\t<dl>
\t\t<dt><label>";
            // line 33
            echo $this->extensions['phpbb\template\twig\extension']->lang("CURRENT_VERSION");
            echo "</label></dt>
\t\t<dd><strong>";
            // line 34
            echo ($context["CURRENT_VERSION"] ?? null);
            echo "</strong></dd>
\t</dl>
\t";
        } else {
            // line 37
            echo "\t<dl>
\t\t<dt><label>";
            // line 38
            echo $this->extensions['phpbb\template\twig\extension']->lang("FILES_VERSION");
            echo "</label></dt>
\t\t<dd><strong>";
            // line 39
            echo ($context["FILES_VERSION"] ?? null);
            echo "</strong></dd>
\t</dl>
\t<dl>
\t\t<dt><label>";
            // line 42
            echo $this->extensions['phpbb\template\twig\extension']->lang("DATABASE_VERSION");
            echo "</label></dt>
\t\t<dd><strong>";
            // line 43
            echo ($context["CURRENT_VERSION"] ?? null);
            echo "</strong></dd>
\t</dl>
\t";
        }
        // line 46
        echo "</fieldset>

";
        // line 48
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "updates_available", [], "any", false, false, false, 48));
        foreach ($context['_seq'] as $context["_key"] => $context["updates_available"]) {
            // line 49
            echo "\t<fieldset>
\t\t<legend></legend>
\t\t<dl>
\t\t\t<dt><label>";
            // line 52
            echo $this->extensions['phpbb\template\twig\extension']->lang("LATEST_VERSION");
            echo "</label></dt>
\t\t\t<dd><strong>";
            // line 53
            echo twig_get_attribute($this->env, $this->source, $context["updates_available"], "current", [], "any", false, false, false, 53);
            echo "</strong></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label>";
            // line 56
            echo $this->extensions['phpbb\template\twig\extension']->lang("RELEASE_ANNOUNCEMENT");
            echo "</label></dt>
\t\t\t<dd><strong><a href=\"";
            // line 57
            echo twig_get_attribute($this->env, $this->source, $context["updates_available"], "announcement", [], "any", false, false, false, 57);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["updates_available"], "announcement", [], "any", false, false, false, 57);
            echo "</a></strong></dd>
\t\t</dl>
\t</fieldset>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['updates_available'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 61
        echo "
";
        // line 62
        if (($context["S_UPDATE_INCOMPLETE"] ?? null)) {
            // line 63
            echo "\t";
            echo ($context["INCOMPLETE_INSTRUCTIONS"] ?? null);
            echo "
\t<br>
";
        }
        // line 66
        echo "
";
        // line 67
        if ( !($context["S_UP_TO_DATE"] ?? null)) {
            // line 68
            echo "\t";
            echo ($context["UPDATE_INSTRUCTIONS"] ?? null);
            echo "
\t<br /><br />
";
        }
        // line 71
        echo "
";
        // line 72
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_update.html", 72)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_update.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  226 => 72,  223 => 71,  216 => 68,  214 => 67,  211 => 66,  204 => 63,  202 => 62,  199 => 61,  187 => 57,  183 => 56,  177 => 53,  173 => 52,  168 => 49,  164 => 48,  160 => 46,  154 => 43,  150 => 42,  144 => 39,  140 => 38,  137 => 37,  131 => 34,  127 => 33,  124 => 32,  122 => 31,  117 => 28,  111 => 25,  108 => 24,  106 => 23,  96 => 20,  93 => 19,  91 => 18,  82 => 16,  79 => 15,  77 => 14,  69 => 11,  66 => 10,  64 => 9,  59 => 7,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_update.html", "");
    }
}
