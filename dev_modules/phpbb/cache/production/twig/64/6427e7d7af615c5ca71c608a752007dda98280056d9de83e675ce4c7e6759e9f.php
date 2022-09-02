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

/* faq_body.html */
class __TwigTemplate_c6c708be2381529fcd90b4bd9e05fc222044669f9a7f7974dc94c75b33a12296 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "faq_body.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<h2 class=\"faq-title\">";
        // line 3
        echo $this->extensions['phpbb\template\twig\extension']->lang("FAQ_TITLE");
        echo "</h2>


<div class=\"panel bg1\" id=\"faqlinks\">
\t<div class=\"inner\">
\t\t<div class=\"column1\">
\t\t";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "faq_block", [], "any", false, false, false, 9));
        foreach ($context['_seq'] as $context["_key"] => $context["faq_block"]) {
            // line 10
            echo "\t\t\t";
            if ((twig_get_attribute($this->env, $this->source, $context["faq_block"], "SWITCH_COLUMN", [], "any", false, false, false, 10) || (($context["SWITCH_COLUMN_MANUALLY"] ?? null) && (twig_get_attribute($this->env, $this->source, $context["faq_block"], "S_ROW_COUNT", [], "any", false, false, false, 10) == 4)))) {
                // line 11
                echo "\t\t\t\t</div>

\t\t\t\t<div class=\"column2\">
\t\t\t";
            }
            // line 15
            echo "
\t\t\t<dl class=\"faq\">
\t\t\t\t<dt><strong>";
            // line 17
            echo twig_get_attribute($this->env, $this->source, $context["faq_block"], "BLOCK_TITLE", [], "any", false, false, false, 17);
            echo "</strong></dt>
\t\t\t\t";
            // line 18
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["faq_block"], "faq_row", [], "any", false, false, false, 18));
            foreach ($context['_seq'] as $context["_key"] => $context["faq_row"]) {
                // line 19
                echo "\t\t\t\t\t<dd><a href=\"#f";
                echo twig_get_attribute($this->env, $this->source, $context["faq_block"], "S_ROW_COUNT", [], "any", false, false, false, 19);
                echo "r";
                echo twig_get_attribute($this->env, $this->source, $context["faq_row"], "S_ROW_COUNT", [], "any", false, false, false, 19);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["faq_row"], "FAQ_QUESTION", [], "any", false, false, false, 19);
                echo "</a></dd>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['faq_row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 21
            echo "\t\t\t</dl>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['faq_block'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "\t\t</div>
\t</div>
</div>

";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "faq_block", [], "any", false, false, false, 27));
        foreach ($context['_seq'] as $context["_key"] => $context["faq_block"]) {
            // line 28
            echo "\t<div class=\"panel ";
            if ((twig_get_attribute($this->env, $this->source, $context["faq_block"], "S_ROW_COUNT", [], "any", false, false, false, 28) % 2 != 0)) {
                echo "bg1";
            } else {
                echo "bg2";
            }
            echo "\">
\t\t<div class=\"inner\">

\t\t<div class=\"content\">
\t\t\t<h2 class=\"faq-title\">";
            // line 32
            echo twig_get_attribute($this->env, $this->source, $context["faq_block"], "BLOCK_TITLE", [], "any", false, false, false, 32);
            echo "</h2>
\t\t\t";
            // line 33
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["faq_block"], "faq_row", [], "any", false, false, false, 33));
            foreach ($context['_seq'] as $context["_key"] => $context["faq_row"]) {
                // line 34
                echo "\t\t\t\t<dl class=\"faq\">
\t\t\t\t\t<dt id=\"f";
                // line 35
                echo twig_get_attribute($this->env, $this->source, $context["faq_block"], "S_ROW_COUNT", [], "any", false, false, false, 35);
                echo "r";
                echo twig_get_attribute($this->env, $this->source, $context["faq_row"], "S_ROW_COUNT", [], "any", false, false, false, 35);
                echo "\"><strong>";
                echo twig_get_attribute($this->env, $this->source, $context["faq_row"], "FAQ_QUESTION", [], "any", false, false, false, 35);
                echo "</strong></dt>
\t\t\t\t\t<dd>";
                // line 36
                echo twig_get_attribute($this->env, $this->source, $context["faq_row"], "FAQ_ANSWER", [], "any", false, false, false, 36);
                echo "</dd>
\t\t\t\t</dl>
\t\t\t\t<a href=\"#faqlinks\" class=\"top\">
\t\t\t\t\t<i class=\"icon fa-chevron-circle-up fa-fw icon-gray\" aria-hidden=\"true\"></i><span>";
                // line 39
                echo $this->extensions['phpbb\template\twig\extension']->lang("BACK_TO_TOP");
                echo "</span>
\t\t\t\t</a>
\t\t\t\t";
                // line 41
                if ( !twig_get_attribute($this->env, $this->source, $context["faq_row"], "S_LAST_ROW", [], "any", false, false, false, 41)) {
                    echo "<hr class=\"dashed\" />";
                }
                // line 42
                echo "\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['faq_row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 43
            echo "\t\t</div>

\t\t</div>
\t</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['faq_block'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 48
        echo "
";
        // line 49
        $location = "jumpbox.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("jumpbox.html", "faq_body.html", 49)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 50
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "faq_body.html", 50)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "faq_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  193 => 50,  181 => 49,  178 => 48,  168 => 43,  162 => 42,  158 => 41,  153 => 39,  147 => 36,  139 => 35,  136 => 34,  132 => 33,  128 => 32,  116 => 28,  112 => 27,  106 => 23,  99 => 21,  86 => 19,  82 => 18,  78 => 17,  74 => 15,  68 => 11,  65 => 10,  61 => 9,  52 => 3,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "faq_body.html", "");
    }
}
