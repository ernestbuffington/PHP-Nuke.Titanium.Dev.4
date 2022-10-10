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

/* navbar_footer.html */
class __TwigTemplate_c5990dd02eeffeed12ae5c07997b74fc2827ca1e19d6937157f7c314956453c9 extends \Twig\Template
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
        echo "<div class=\"navbar\" role=\"navigation\">
\t<div class=\"inner\">

\t<ul id=\"nav-footer\" class=\"nav-footer linklist\" role=\"menubar\">
\t\t<li class=\"breadcrumbs\">
\t\t\t";
        // line 6
        if (($context["U_SITE_HOME"] ?? null)) {
            // line 7
            echo "\t\t\t\t";
            ob_start(function () { return ''; });
            // line 8
            echo "\t\t\t\t<span class=\"crumb\">
\t\t\t\t\t<a href=\"";
            // line 9
            echo ($context["U_SITE_HOME"] ?? null);
            echo "\" data-navbar-reference=\"home\">
\t\t\t\t\t\t<i class=\"icon fa-home fa-fw\" aria-hidden=\"true\"></i><span>";
            // line 10
            echo $this->extensions['phpbb\template\twig\extension']->lang("SITE_HOME");
            echo "</span>
\t\t\t\t\t</a>
\t\t\t\t</span>
\t\t\t\t";
            $___internal_parse_0_ = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 7
            echo twig_spaceless($___internal_parse_0_);
            // line 14
            echo "\t\t\t";
        }
        // line 15
        echo "\t\t\t";
        // line 16
        echo "\t\t\t";
        ob_start(function () { return ''; });
        // line 17
        echo "\t\t\t<span class=\"crumb\">
\t\t\t\t<a href=\"";
        // line 18
        echo ($context["U_INDEX"] ?? null);
        echo "\" data-navbar-reference=\"index\">
\t\t\t\t\t";
        // line 19
        if ( !($context["U_SITE_HOME"] ?? null)) {
            echo "<i class=\"icon fa-home fa-fw\" aria-hidden=\"true\"></i>";
        }
        echo "<span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("INDEX");
        echo "</span>
\t\t\t\t</a>
\t\t\t</span>
\t\t\t";
        $___internal_parse_1_ = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 16
        echo twig_spaceless($___internal_parse_1_);
        // line 23
        echo "\t\t\t";
        // line 24
        echo "\t\t</li>
\t\t";
        // line 25
        if ((($context["U_WATCH_FORUM_LINK"] ?? null) &&  !($context["S_IS_BOT"] ?? null))) {
            // line 26
            echo "\t\t\t<li data-last-responsive=\"true\">
\t\t\t\t<a href=\"";
            // line 27
            echo ($context["U_WATCH_FORUM_LINK"] ?? null);
            echo "\" title=\"";
            echo ($context["S_WATCH_FORUM_TITLE"] ?? null);
            echo "\" data-ajax=\"toggle_link\" data-toggle-class=\"icon ";
            if (($context["S_WATCHING_FORUM"] ?? null)) {
                echo "fa-check-square-o";
            } else {
                echo "fa-square-o";
            }
            echo " fa-fw\" data-toggle-text=\"";
            echo ($context["S_WATCH_FORUM_TOGGLE"] ?? null);
            echo "\" data-toggle-url=\"";
            echo ($context["U_WATCH_FORUM_TOGGLE"] ?? null);
            echo "\">
\t\t\t\t\t<i class=\"icon ";
            // line 28
            if (($context["S_WATCHING_FORUM"] ?? null)) {
                echo "fa-square-o";
            } else {
                echo "fa-check-square-o";
            }
            echo " fa-fw\" aria-hidden=\"true\"></i><span>";
            echo ($context["S_WATCH_FORUM_TITLE"] ?? null);
            echo "</span>
\t\t\t\t</a>
\t\t\t</li>
\t\t";
        }
        // line 32
        echo "
\t\t";
        // line 33
        // line 34
        echo "\t\t<li class=\"rightside\">";
        echo ($context["S_TIMEZONE"] ?? null);
        echo "</li>
\t\t";
        // line 35
        // line 36
        echo "\t\t";
        if ( !($context["S_IS_BOT"] ?? null)) {
            // line 37
            echo "\t\t\t<li class=\"rightside\">
\t\t\t\t<a href=\"";
            // line 38
            echo ($context["U_DELETE_COOKIES"] ?? null);
            echo "\" data-ajax=\"true\" data-refresh=\"true\" role=\"menuitem\">
\t\t\t\t\t<i class=\"icon fa-trash fa-fw\" aria-hidden=\"true\"></i><span>";
            // line 39
            echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE_COOKIES");
            echo "</span>
\t\t\t\t</a>
\t\t\t</li>
\t\t\t";
            // line 42
            if (($context["S_DISPLAY_MEMBERLIST"] ?? null)) {
                // line 43
                echo "\t\t\t\t<li class=\"rightside\" data-last-responsive=\"true\">
\t\t\t\t\t<a href=\"";
                // line 44
                echo ($context["U_MEMBERLIST"] ?? null);
                echo "\" title=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("MEMBERLIST_EXPLAIN");
                echo "\" role=\"menuitem\">
\t\t\t\t\t\t<i class=\"icon fa-group fa-fw\" aria-hidden=\"true\"></i><span>";
                // line 45
                echo $this->extensions['phpbb\template\twig\extension']->lang("MEMBERLIST");
                echo "</span>
\t\t\t\t\t</a>
\t\t\t\t</li>
\t\t\t";
            }
            // line 49
            echo "\t\t";
        }
        // line 50
        echo "\t\t";
        // line 51
        echo "\t\t";
        if (($context["U_TEAM"] ?? null)) {
            // line 52
            echo "\t\t\t<li class=\"rightside\" data-last-responsive=\"true\">
\t\t\t\t<a href=\"";
            // line 53
            echo ($context["U_TEAM"] ?? null);
            echo "\" role=\"menuitem\">
\t\t\t\t\t<i class=\"icon fa-shield fa-fw\" aria-hidden=\"true\"></i><span>";
            // line 54
            echo $this->extensions['phpbb\template\twig\extension']->lang("THE_TEAM");
            echo "</span>
\t\t\t\t</a>
\t\t\t</li>
\t\t";
        }
        // line 58
        echo "\t\t";
        // line 59
        echo "\t\t";
        if (($context["U_CONTACT_US"] ?? null)) {
            // line 60
            echo "\t\t\t<li class=\"rightside\" data-last-responsive=\"true\">
\t\t\t\t<a href=\"";
            // line 61
            echo ($context["U_CONTACT_US"] ?? null);
            echo "\" role=\"menuitem\">
\t\t\t\t\t<i class=\"icon fa-envelope fa-fw\" aria-hidden=\"true\"></i><span>";
            // line 62
            echo $this->extensions['phpbb\template\twig\extension']->lang("CONTACT_US");
            echo "</span>
\t\t\t\t</a>
\t\t\t</li>
\t\t";
        }
        // line 66
        echo "\t</ul>

\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "navbar_footer.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  217 => 66,  210 => 62,  206 => 61,  203 => 60,  200 => 59,  198 => 58,  191 => 54,  187 => 53,  184 => 52,  181 => 51,  179 => 50,  176 => 49,  169 => 45,  163 => 44,  160 => 43,  158 => 42,  152 => 39,  148 => 38,  145 => 37,  142 => 36,  141 => 35,  136 => 34,  135 => 33,  132 => 32,  119 => 28,  103 => 27,  100 => 26,  98 => 25,  95 => 24,  93 => 23,  91 => 16,  80 => 19,  76 => 18,  73 => 17,  70 => 16,  68 => 15,  65 => 14,  63 => 7,  56 => 10,  52 => 9,  49 => 8,  46 => 7,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "navbar_footer.html", "");
    }
}
