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

/* auth_provider_oauth.html */
class __TwigTemplate_597a651d5b5b5d373a81c4f71f4f5338ffead6027b7fb689adc6c066a627f206 extends \Twig\Template
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
        echo "
<div id=\"auth_oauth_settings\">
\t<p>";
        // line 3
        echo $this->extensions['phpbb\template\twig\extension']->lang("AUTH_PROVIDER_OAUTH_EXPLAIN");
        echo "</p>

\t";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "oauth_services", [], "any", false, false, false, 5));
        foreach ($context['_seq'] as $context["_key"] => $context["oauth_services"]) {
            // line 6
            echo "\t<fieldset>
\t\t<legend>";
            // line 7
            echo twig_get_attribute($this->env, $this->source, $context["oauth_services"], "ACTUAL_NAME", [], "any", false, false, false, 7);
            echo "</legend>
\t\t<dl>
\t\t\t<dt><label for=\"oauth_service_";
            // line 9
            echo twig_get_attribute($this->env, $this->source, $context["oauth_services"], "NAME", [], "any", false, false, false, 9);
            echo "_key\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("AUTH_PROVIDER_OAUTH_KEY");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><input type=\"text\" id=\"oauth_service_";
            // line 10
            echo twig_get_attribute($this->env, $this->source, $context["oauth_services"], "NAME", [], "any", false, false, false, 10);
            echo "_key\" size=\"40\" name=\"config[auth_oauth_";
            echo twig_get_attribute($this->env, $this->source, $context["oauth_services"], "NAME", [], "any", false, false, false, 10);
            echo "_key]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["oauth_services"], "KEY", [], "any", false, false, false, 10);
            echo "\" /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"oauth_service_";
            // line 13
            echo twig_get_attribute($this->env, $this->source, $context["oauth_services"], "NAME", [], "any", false, false, false, 13);
            echo "_secret\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("AUTH_PROVIDER_OAUTH_SECRET");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><input type=\"text\" id=\"oauth_service_";
            // line 14
            echo twig_get_attribute($this->env, $this->source, $context["oauth_services"], "NAME", [], "any", false, false, false, 14);
            echo "_secret\" size=\"40\" name=\"config[auth_oauth_";
            echo twig_get_attribute($this->env, $this->source, $context["oauth_services"], "NAME", [], "any", false, false, false, 14);
            echo "_secret]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["oauth_services"], "SECRET", [], "any", false, false, false, 14);
            echo "\" /></dd>
\t\t</dl>
\t</fieldset>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oauth_services'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "auth_provider_oauth.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 18,  82 => 14,  75 => 13,  65 => 10,  58 => 9,  53 => 7,  50 => 6,  46 => 5,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "auth_provider_oauth.html", "");
    }
}
