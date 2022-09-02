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

/* ucp_main_front.html */
class __TwigTemplate_9cab3f424df11dfeb783b6abb12335e824cb027d1eb2d66115c4c3bedf734411 extends \Twig\Template
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
        $this->loadTemplate("ucp_header.html", "ucp_main_front.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<h2>";
        // line 3
        echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE");
        echo "</h2>

<div class=\"panel\">
\t<div class=\"inner\">

\t<p>";
        // line 8
        echo $this->extensions['phpbb\template\twig\extension']->lang("UCP_WELCOME");
        echo "</p>

";
        // line 10
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "topicrow", [], "any", false, false, false, 10))) {
            // line 11
            echo "\t<h3>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("IMPORTANT_NEWS");
            echo "</h3>

\t<ul class=\"topiclist cplist two-long-columns\">
\t";
            // line 14
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "topicrow", [], "any", false, false, false, 14));
            foreach ($context['_seq'] as $context["_key"] => $context["topicrow"]) {
                // line 15
                echo "\t\t<li class=\"row";
                if ((twig_get_attribute($this->env, $this->source, $context["topicrow"], "S_ROW_COUNT", [], "any", false, false, false, 15) % 2 != 0)) {
                    echo " bg1";
                } else {
                    echo " bg2";
                }
                echo "\">
\t\t\t<dl class=\"row-item ";
                // line 16
                echo twig_get_attribute($this->env, $this->source, $context["topicrow"], "TOPIC_IMG_STYLE", [], "any", false, false, false, 16);
                echo "\">
\t\t\t\t<dt ";
                // line 17
                if (twig_get_attribute($this->env, $this->source, $context["topicrow"], "TOPIC_ICON_IMG", [], "any", false, false, false, 17)) {
                    echo "style=\"background-image: url(";
                    echo ($context["T_ICONS_PATH"] ?? null);
                    echo twig_get_attribute($this->env, $this->source, $context["topicrow"], "TOPIC_ICON_IMG", [], "any", false, false, false, 17);
                    echo "); background-repeat: no-repeat;\"";
                }
                echo ">
\t\t\t\t\t";
                // line 18
                if (twig_get_attribute($this->env, $this->source, $context["topicrow"], "S_UNREAD_TOPIC", [], "any", false, false, false, 18)) {
                    echo "<a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["topicrow"], "U_NEWEST_POST", [], "any", false, false, false, 18);
                    echo "\" class=\"row-item-link\"></a>";
                }
                // line 19
                echo "\t\t\t\t\t<div class=\"list-inner\">
\t\t\t\t\t\t";
                // line 20
                if (twig_get_attribute($this->env, $this->source, $context["topicrow"], "S_UNREAD", [], "any", false, false, false, 20)) {
                    // line 21
                    echo "\t\t\t\t\t\t\t<a class=\"unread\" href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["topicrow"], "U_NEWEST_POST", [], "any", false, false, false, 21);
                    echo "\">
\t\t\t\t\t\t\t\t<i class=\"icon fa-file fa-fw icon-red icon-md\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                    // line 22
                    echo ($context["NEW_POST"] ?? null);
                    echo "</span>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t";
                }
                // line 25
                echo "\t\t\t\t\t\t<a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["topicrow"], "U_VIEW_TOPIC", [], "any", false, false, false, 25);
                echo "\" class=\"topictitle\">";
                echo twig_get_attribute($this->env, $this->source, $context["topicrow"], "TOPIC_TITLE", [], "any", false, false, false, 25);
                echo "</a><br />
\t\t\t\t\t\t";
                // line 26
                if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["topicrow"], "pagination", [], "any", false, false, false, 26))) {
                    // line 27
                    echo "\t\t\t\t\t\t<div class=\"pagination\">
\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t";
                    // line 29
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["topicrow"], "pagination", [], "any", false, false, false, 29));
                    foreach ($context['_seq'] as $context["_key"] => $context["pagination"]) {
                        // line 30
                        echo "\t\t\t\t\t\t\t\t";
                        if (twig_get_attribute($this->env, $this->source, $context["pagination"], "S_IS_PREV", [], "any", false, false, false, 30)) {
                            // line 31
                            echo "\t\t\t\t\t\t\t\t";
                        } elseif (twig_get_attribute($this->env, $this->source, $context["pagination"], "S_IS_CURRENT", [], "any", false, false, false, 31)) {
                            echo "<li class=\"active\"><span>";
                            echo twig_get_attribute($this->env, $this->source, $context["pagination"], "PAGE_NUMBER", [], "any", false, false, false, 31);
                            echo "</span></li>
\t\t\t\t\t\t\t\t";
                        } elseif (twig_get_attribute($this->env, $this->source,                         // line 32
$context["pagination"], "S_IS_ELLIPSIS", [], "any", false, false, false, 32)) {
                            echo "<li class=\"ellipsis\"><span>";
                            echo $this->extensions['phpbb\template\twig\extension']->lang("ELLIPSIS");
                            echo "</span></li>
\t\t\t\t\t\t\t\t";
                        } elseif (twig_get_attribute($this->env, $this->source,                         // line 33
$context["pagination"], "S_IS_NEXT", [], "any", false, false, false, 33)) {
                            // line 34
                            echo "\t\t\t\t\t\t\t\t";
                        } else {
                            echo "<li><a href=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["pagination"], "PAGE_URL", [], "any", false, false, false, 34);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["pagination"], "PAGE_NUMBER", [], "any", false, false, false, 34);
                            echo "</a></li>
\t\t\t\t\t\t\t\t";
                        }
                        // line 36
                        echo "\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pagination'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 37
                    echo "\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
                }
                // line 40
                echo "\t\t\t\t\t\t<div class=\"responsive-hide\">
\t\t\t\t\t\t\t";
                // line 41
                if (twig_get_attribute($this->env, $this->source, $context["topicrow"], "ATTACH_ICON_IMG", [], "any", false, false, false, 41)) {
                    echo "<i class=\"icon fa-paperclip fa-fw\" aria-hidden=\"true\"></i> ";
                }
                // line 42
                echo "\t\t\t\t\t\t\t";
                echo $this->extensions['phpbb\template\twig\extension']->lang("POST_BY_AUTHOR");
                echo " ";
                echo twig_get_attribute($this->env, $this->source, $context["topicrow"], "TOPIC_AUTHOR_FULL", [], "any", false, false, false, 42);
                echo " &raquo; ";
                echo twig_get_attribute($this->env, $this->source, $context["topicrow"], "FIRST_POST_TIME", [], "any", false, false, false, 42);
                echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"responsive-show\" style=\"display: none;\">
\t\t\t\t\t\t\t";
                // line 45
                if (twig_get_attribute($this->env, $this->source, $context["topicrow"], "ATTACH_ICON_IMG", [], "any", false, false, false, 45)) {
                    echo "<i class=\"icon fa-paperclip fa-fw\" aria-hidden=\"true\"></i> ";
                }
                // line 46
                echo "\t\t\t\t\t\t\t";
                echo $this->extensions['phpbb\template\twig\extension']->lang("LAST_POST");
                echo " ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("POST_BY_AUTHOR");
                echo " ";
                echo twig_get_attribute($this->env, $this->source, $context["topicrow"], "LAST_POST_AUTHOR_FULL", [], "any", false, false, false, 46);
                echo " &laquo; <a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["topicrow"], "U_LAST_POST", [], "any", false, false, false, 46);
                echo "\" title=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("GOTO_LAST_POST");
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["topicrow"], "LAST_POST_TIME", [], "any", false, false, false, 46);
                echo "</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</dt>
\t\t\t\t<dd class=\"lastpost\">
\t\t\t\t\t<span>";
                // line 51
                echo $this->extensions['phpbb\template\twig\extension']->lang("LAST_POST");
                echo " ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("POST_BY_AUTHOR");
                echo " ";
                echo twig_get_attribute($this->env, $this->source, $context["topicrow"], "LAST_POST_AUTHOR_FULL", [], "any", false, false, false, 51);
                echo "
\t\t\t\t\t\t<a href=\"";
                // line 52
                echo twig_get_attribute($this->env, $this->source, $context["topicrow"], "U_LAST_POST", [], "any", false, false, false, 52);
                echo "\" title=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("GOTO_LAST_POST");
                echo "\">
\t\t\t\t\t\t\t<i class=\"icon fa-external-link-square fa-fw icon-lightgray icon-md\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                // line 53
                echo ($context["VIEW_LATEST_POST"] ?? null);
                echo "</span>
\t\t\t\t\t\t</a>
\t\t\t\t\t\t<br />";
                // line 55
                echo twig_get_attribute($this->env, $this->source, $context["topicrow"], "LAST_POST_TIME", [], "any", false, false, false, 55);
                echo "
\t\t\t\t\t</span>
\t\t\t\t</dd>
\t\t\t</dl>
\t\t</li>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['topicrow'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 61
            echo "\t</ul>
";
        }
        // line 63
        echo "
\t<h3>";
        // line 64
        echo $this->extensions['phpbb\template\twig\extension']->lang("YOUR_DETAILS");
        echo "</h3>

";
        // line 66
        // line 67
        echo "\t<dl class=\"details\">
\t\t";
        // line 68
        // line 69
        echo "\t\t<dt>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("JOINED");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</dt> <dd>";
        echo ($context["JOINED"] ?? null);
        echo "</dd>
\t\t<dt>";
        // line 70
        echo $this->extensions['phpbb\template\twig\extension']->lang("LAST_ACTIVE");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</dt> <dd>";
        echo ($context["LAST_VISIT_YOU"] ?? null);
        echo "</dd>
\t\t<dt>";
        // line 71
        echo $this->extensions['phpbb\template\twig\extension']->lang("TOTAL_POSTS");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</dt> <dd>";
        if (($context["POSTS_PCT"] ?? null)) {
            echo ($context["POSTS"] ?? null);
            if (($context["S_DISPLAY_SEARCH"] ?? null)) {
                echo " | <strong><a href=\"";
                echo ($context["U_SEARCH_USER"] ?? null);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_YOUR_POSTS");
                echo "</a></strong>";
            }
            echo "<br />(";
            echo ($context["POSTS_DAY"] ?? null);
            echo " / ";
            echo ($context["POSTS_PCT"] ?? null);
            echo ")";
        } else {
            echo ($context["POSTS"] ?? null);
        }
        echo "</dd>
\t\t";
        // line 72
        if ((($context["ACTIVE_FORUM"] ?? null) != "")) {
            echo "<dt>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACTIVE_IN_FORUM");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</dt> <dd><strong><a href=\"";
            echo ($context["U_ACTIVE_FORUM"] ?? null);
            echo "\">";
            echo ($context["ACTIVE_FORUM"] ?? null);
            echo "</a></strong><br />(";
            echo ($context["ACTIVE_FORUM_POSTS"] ?? null);
            echo " / ";
            echo ($context["ACTIVE_FORUM_PCT"] ?? null);
            echo ")</dd>";
        }
        // line 73
        echo "\t\t";
        if ((($context["ACTIVE_TOPIC"] ?? null) != "")) {
            echo "<dt>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACTIVE_IN_TOPIC");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</dt> <dd><strong><a href=\"";
            echo ($context["U_ACTIVE_TOPIC"] ?? null);
            echo "\">";
            echo ($context["ACTIVE_TOPIC"] ?? null);
            echo "</a></strong><br />(";
            echo ($context["ACTIVE_TOPIC_POSTS"] ?? null);
            echo " / ";
            echo ($context["ACTIVE_TOPIC_PCT"] ?? null);
            echo ")</dd>";
        }
        // line 74
        echo "\t\t";
        if (($context["WARNINGS"] ?? null)) {
            echo "<dt>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YOUR_WARNINGS");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</dt> <dd class=\"error\"><i class=\"icon fa-exclamation-triangle fa-fw icon-red\" aria-hidden=\"true\"></i> [";
            echo ($context["WARNINGS"] ?? null);
            echo "]</dd>";
        }
        // line 75
        echo "\t\t";
        // line 76
        echo "\t</dl>
";
        // line 77
        // line 78
        echo "
\t</div>
</div>

";
        // line 82
        $location = "ucp_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("ucp_footer.html", "ucp_main_front.html", 82)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "ucp_main_front.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  358 => 82,  352 => 78,  351 => 77,  348 => 76,  346 => 75,  336 => 74,  320 => 73,  305 => 72,  282 => 71,  275 => 70,  267 => 69,  266 => 68,  263 => 67,  262 => 66,  257 => 64,  254 => 63,  250 => 61,  238 => 55,  233 => 53,  227 => 52,  219 => 51,  200 => 46,  196 => 45,  185 => 42,  181 => 41,  178 => 40,  173 => 37,  167 => 36,  157 => 34,  155 => 33,  149 => 32,  142 => 31,  139 => 30,  135 => 29,  131 => 27,  129 => 26,  122 => 25,  116 => 22,  111 => 21,  109 => 20,  106 => 19,  100 => 18,  91 => 17,  87 => 16,  78 => 15,  74 => 14,  67 => 11,  65 => 10,  60 => 8,  52 => 3,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "ucp_main_front.html", "");
    }
}
