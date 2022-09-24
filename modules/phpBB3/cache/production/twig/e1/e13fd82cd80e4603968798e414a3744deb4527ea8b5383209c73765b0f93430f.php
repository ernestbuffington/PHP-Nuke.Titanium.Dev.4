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

/* acp_board.html */
class __TwigTemplate_f4cf0ebc58ae2c058d51ae12cd2556ef086941674f9eab4575158b8fae00c97c extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_board.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

<h1>";
        // line 5
        echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE");
        echo "</h1>

<p>";
        // line 7
        echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE_EXPLAIN");
        echo "</p>

";
        // line 9
        if (($context["S_ERROR"] ?? null)) {
            // line 10
            echo "\t<div class=\"errorbox\">
\t\t<h3>";
            // line 11
            echo $this->extensions['phpbb\template\twig\extension']->lang("WARNING");
            echo "</h3>
\t\t<p>";
            // line 12
            echo ($context["ERROR_MSG"] ?? null);
            echo "</p>
\t</div>
";
        }
        // line 15
        echo "
<form id=\"acp_board\" method=\"post\" action=\"";
        // line 16
        echo ($context["U_ACTION"] ?? null);
        echo "\">

";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "options", [], "any", false, false, false, 18));
        foreach ($context['_seq'] as $context["_key"] => $context["options"]) {
            // line 19
            echo "\t";
            if (twig_get_attribute($this->env, $this->source, $context["options"], "S_LEGEND", [], "any", false, false, false, 19)) {
                // line 20
                echo "\t\t";
                if ( !twig_get_attribute($this->env, $this->source, $context["options"], "S_FIRST_ROW", [], "any", false, false, false, 20)) {
                    // line 21
                    echo "\t\t</fieldset>
\t\t";
                }
                // line 23
                echo "
\t\t<fieldset>
\t\t<legend>";
                // line 25
                echo twig_get_attribute($this->env, $this->source, $context["options"], "LEGEND", [], "any", false, false, false, 25);
                echo "</legend>
\t";
            } else {
                // line 27
                echo "
\t\t<dl>
\t\t\t<dt><label for=\"";
                // line 29
                echo twig_get_attribute($this->env, $this->source, $context["options"], "KEY", [], "any", false, false, false, 29);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["options"], "TITLE", [], "any", false, false, false, 29);
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label>";
                if (twig_get_attribute($this->env, $this->source, $context["options"], "S_EXPLAIN", [], "any", false, false, false, 29)) {
                    echo "<br /><span>";
                    echo twig_get_attribute($this->env, $this->source, $context["options"], "TITLE_EXPLAIN", [], "any", false, false, false, 29);
                    echo "</span>";
                }
                echo "</dt>
\t\t\t<dd>";
                // line 30
                echo twig_get_attribute($this->env, $this->source, $context["options"], "CONTENT", [], "any", false, false, false, 30);
                echo "</dd>
\t\t</dl>

\t";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['options'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
        echo "
";
        // line 36
        if (($context["S_AUTH"] ?? null)) {
            // line 37
            echo "\t</fieldset>
\t";
            // line 38
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "auth_tpl", [], "any", false, false, false, 38));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["auth_tpl"]) {
                // line 39
                echo "\t\t";
                $location = (("" . twig_get_attribute($this->env, $this->source, $context["auth_tpl"], "TEMPLATE_FILE", [], "any", false, false, false, 39)) . "");
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->loadTemplate((("" . twig_get_attribute($this->env, $this->source, $context["auth_tpl"], "TEMPLATE_FILE", [], "any", false, false, false, 39)) . ""), "acp_board.html", 39)->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 40
                echo "\t";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['auth_tpl'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 41
            echo "\t<fieldset>
\t\t<legend>";
            // line 42
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_SUBMIT_CHANGES");
            echo "</legend>
";
        }
        // line 44
        echo "
\t<p class=\"submit-buttons\">
\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
        // line 46
        echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
        echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
        // line 47
        echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
        echo "\" />
\t</p>
\t";
        // line 49
        echo ($context["S_FORM_TOKEN"] ?? null);
        echo "
</fieldset>
</form>

";
        // line 53
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_board.html", 53)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_board.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  218 => 53,  211 => 49,  206 => 47,  202 => 46,  198 => 44,  193 => 42,  190 => 41,  176 => 40,  163 => 39,  146 => 38,  143 => 37,  141 => 36,  138 => 35,  127 => 30,  114 => 29,  110 => 27,  105 => 25,  101 => 23,  97 => 21,  94 => 20,  91 => 19,  87 => 18,  82 => 16,  79 => 15,  73 => 12,  69 => 11,  66 => 10,  64 => 9,  59 => 7,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_board.html", "");
    }
}
