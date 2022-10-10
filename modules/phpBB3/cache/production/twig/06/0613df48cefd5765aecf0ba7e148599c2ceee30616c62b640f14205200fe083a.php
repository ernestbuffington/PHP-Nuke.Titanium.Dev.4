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

/* acp_help_phpbb.html */
class __TwigTemplate_13a07ffa567685e51f1fc3d2d622b579444b05d8a50866bd30d6376d6025ec78 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_help_phpbb.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

<h1>";
        // line 5
        echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_HELP_PHPBB");
        echo "</h1>

<form id=\"acp_help_phpbb\" method=\"post\" action=\"";
        // line 7
        echo ($context["U_ACTION"] ?? null);
        echo "\" data-ajax-action=\"";
        echo ($context["U_COLLECT_STATS"] ?? null);
        echo "\">
<div class=\"send-stats-row\">
\t";
        // line 9
        // line 10
        echo "\t<div class=\"send-stats-tile\">
\t\t<h2><i class=\"icon fa-bar-chart\"></i>";
        // line 11
        echo $this->extensions['phpbb\template\twig\extension']->lang("SEND_STATISTICS");
        echo "</h2>
\t\t<p>";
        // line 12
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXPLAIN_SEND_STATISTICS");
        echo "</p>
\t\t<div class=\"send-stats-row\">
\t\t\t<div class=\"send-stats-data-row send-stats-data-only-row\">
\t\t\t\t<a id=\"trigger-configlist\" data-ajax=\"toggle_link\" data-overlay=\"false\" data-toggle-text=\"";
        // line 15
        echo $this->extensions['phpbb\template\twig\extension']->lang("HIDE_STATISTICS");
        echo "\"><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("SHOW_STATISTICS");
        echo "</span><i class=\"icon fa-angle-down\"></i></a>
\t\t\t</div>
\t\t\t<div class=\"send-stats-data-row\">
\t\t\t\t<div class=\"configlist\" id=\"configlist\">
\t\t\t\t\t";
        // line 19
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "providers", [], "any", false, false, false, 19));
        foreach ($context['_seq'] as $context["_key"] => $context["providers"]) {
            // line 20
            echo "\t\t\t\t\t<fieldset>
\t\t\t\t\t\t<legend>";
            // line 21
            echo twig_get_attribute($this->env, $this->source, $context["providers"], "NAME", [], "any", false, false, false, 21);
            echo "</legend>
\t\t\t\t\t\t";
            // line 22
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["providers"], "values", [], "any", false, false, false, 22));
            foreach ($context['_seq'] as $context["_key"] => $context["values"]) {
                // line 23
                echo "\t\t\t\t\t\t<dl>
\t\t\t\t\t\t\t<dt>";
                // line 24
                echo twig_get_attribute($this->env, $this->source, $context["values"], "KEY", [], "any", false, false, false, 24);
                echo "</dt>
\t\t\t\t\t\t\t<dd>";
                // line 25
                echo twig_get_attribute($this->env, $this->source, $context["values"], "VALUE", [], "any", false, false, false, 25);
                echo "</dd>
\t\t\t\t\t\t</dl>
\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['values'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 28
            echo "\t\t\t\t\t</fieldset>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['providers'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<dl class=\"send-stats-settings\">
\t\t\t<dt>
\t\t\t\t<input name=\"help_send_statistics\" id=\"help_send_statistics\" type=\"checkbox\"";
        // line 35
        if (($context["S_COLLECT_STATS"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " />
\t\t\t\t<label for=\"help_send_statistics\"></label>
\t\t\t</dt>
\t\t\t<dd>";
        // line 38
        echo $this->extensions['phpbb\template\twig\extension']->lang("SEND_STATISTICS_LONG");
        echo "</dd>
\t\t</dl>
\t</div>
\t<script>
\t\tvar statsData = ";
        // line 42
        echo ($context["S_STATS_DATA"] ?? null);
        echo ";
\t</script>
\t";
        // line 44
        // line 45
        echo "\t<fieldset>
\t\t<legend>";
        // line 46
        echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_SUBMIT_CHANGES");
        echo "</legend>
\t\t<p class=\"submit-buttons\">
\t\t\t<input type=\"hidden\" name=\"help_send_statistics_time\" value=\"";
        // line 48
        echo ($context["COLLECT_STATS_TIME"] ?? null);
        echo "\" />
\t\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
        // line 49
        echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
        echo "\" />
\t\t</p>
\t\t";
        // line 51
        echo ($context["S_FORM_TOKEN"] ?? null);
        echo "
\t</fieldset>
</div>
</form>
<form action=\"";
        // line 55
        echo ($context["U_COLLECT_STATS"] ?? null);
        echo "\" method=\"post\" target=\"questionaire_result\" id=\"questionnaire-form\">
\t<fieldset>
\t\t<legend>";
        // line 57
        echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_SUBMIT_CHANGES");
        echo "</legend>
\t\t<p class=\"submit-buttons\">
\t\t\t";
        // line 59
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($context["providers"]);
        foreach ($context['_seq'] as $context["_key"] => $context["providers"]) {
            // line 60
            echo "\t\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["providers"], "values", [], "any", false, false, false, 60));
            foreach ($context['_seq'] as $context["_key"] => $context["values"]) {
                // line 61
                echo "\t\t\t\t\t<input type=\"hidden\" name=\"";
                echo twig_get_attribute($this->env, $this->source, $context["providers"], "NAME", [], "any", false, false, false, 61);
                echo "[";
                echo twig_get_attribute($this->env, $this->source, $context["values"], "KEY", [], "any", false, false, false, 61);
                echo "]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["values"], "VALUE", [], "any", false, false, false, 61);
                echo "\" />
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['values'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 63
            echo "\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['providers'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 64
        echo "\t\t\t<input class=\"button1\" type=\"submit\" id=\"submit_stats\" name=\"submit\" value=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("SEND_STATISTICS");
        echo "\" />
\t\t</p>
\t</fieldset>
</form>

";
        // line 69
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_help_phpbb.html", 69)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_help_phpbb.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  226 => 69,  217 => 64,  211 => 63,  198 => 61,  193 => 60,  189 => 59,  184 => 57,  179 => 55,  172 => 51,  167 => 49,  163 => 48,  158 => 46,  155 => 45,  154 => 44,  149 => 42,  142 => 38,  134 => 35,  127 => 30,  120 => 28,  111 => 25,  107 => 24,  104 => 23,  100 => 22,  96 => 21,  93 => 20,  89 => 19,  80 => 15,  74 => 12,  70 => 11,  67 => 10,  66 => 9,  59 => 7,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_help_phpbb.html", "");
    }
}
