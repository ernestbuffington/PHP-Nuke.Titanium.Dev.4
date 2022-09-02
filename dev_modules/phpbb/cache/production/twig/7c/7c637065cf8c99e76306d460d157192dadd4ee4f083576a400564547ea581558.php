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

/* ucp_header.html */
class __TwigTemplate_d2a5530239f179f81d216db69531efdd6721ca4040983e1b3ec05a193fb21b7c extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "ucp_header.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<h2 class=\"ucp-title\">";
        // line 3
        echo $this->extensions['phpbb\template\twig\extension']->lang("UCP");
        echo "</h2>

<div id=\"tabs\" class=\"tabs\">
\t<ul>
\t\t";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "t_block1", [], "any", false, false, false, 7));
        foreach ($context['_seq'] as $context["_key"] => $context["t_block1"]) {
            // line 8
            echo "\t\t<li class=\"tab";
            if (twig_get_attribute($this->env, $this->source, $context["t_block1"], "S_SELECTED", [], "any", false, false, false, 8)) {
                echo " activetab";
            }
            echo "\"><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["t_block1"], "U_TITLE", [], "any", false, false, false, 8);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["t_block1"], "L_TITLE", [], "any", false, false, false, 8);
            echo "</a></li>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['t_block1'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "\t</ul>
</div>

";
        // line 13
        if (($context["S_COMPOSE_PM"] ?? null)) {
            // line 14
            echo "<form id=\"postform\" method=\"post\" action=\"";
            echo ($context["S_POST_ACTION"] ?? null);
            echo "\"";
            echo ($context["S_FORM_ENCTYPE"] ?? null);
            echo ">
";
        }
        // line 16
        echo "
<div class=\"panel bg3\">
\t<div class=\"inner\">

\t<div style=\"width: 100%;\">

\t<div id=\"cp-menu\" class=\"cp-menu\">
\t\t<div id=\"navigation\" class=\"navigation\" role=\"navigation\">

\t\t";
        // line 25
        if (($context["S_PRIVMSGS"] ?? null)) {
            // line 26
            echo "\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "t_block2", [], "any", false, false, false, 26));
            foreach ($context['_seq'] as $context["_key"] => $context["t_block2"]) {
                // line 27
                echo "\t\t\t\t";
                if ((($context["S_PRIVMSGS"] ?? null) &&  !twig_get_attribute($this->env, $this->source, $context["t_block2"], "S_LAST_ROW", [], "any", false, false, false, 27))) {
                    // line 28
                    echo "\t\t\t\t<ul>
\t\t\t\t\t";
                    // line 29
                    if (twig_get_attribute($this->env, $this->source, $context["t_block2"], "S_SELECTED", [], "any", false, false, false, 29)) {
                        // line 30
                        echo "\t\t\t\t\t\t<li id=\"active-subsection\" class=\"active-subsection\"><a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["t_block2"], "U_TITLE", [], "any", false, false, false, 30);
                        echo "\"><span>";
                        echo twig_get_attribute($this->env, $this->source, $context["t_block2"], "L_TITLE", [], "any", false, false, false, 30);
                        echo "</span></a></li>
\t\t\t\t\t";
                    } else {
                        // line 32
                        echo "\t\t\t\t\t\t<li><a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["t_block2"], "U_TITLE", [], "any", false, false, false, 32);
                        echo "\"><span>";
                        echo twig_get_attribute($this->env, $this->source, $context["t_block2"], "L_TITLE", [], "any", false, false, false, 32);
                        echo "</span></a></li>
\t\t\t\t\t";
                    }
                    // line 34
                    echo "\t\t\t\t</ul>
\t\t\t\t";
                }
                // line 36
                echo "\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['t_block2'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            echo "
\t\t\t<hr />
\t\t\t";
            // line 39
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "folder", [], "any", false, false, false, 39));
            foreach ($context['_seq'] as $context["_key"] => $context["folder"]) {
                // line 40
                echo "\t\t\t\t";
                if (twig_get_attribute($this->env, $this->source, $context["folder"], "S_FIRST_ROW", [], "any", false, false, false, 40)) {
                    echo "<ul>";
                }
                // line 41
                echo "\t\t\t\t";
                if (twig_get_attribute($this->env, $this->source, $context["folder"], "S_CUR_FOLDER", [], "any", false, false, false, 41)) {
                    // line 42
                    echo "\t\t\t\t\t<li id=\"active-subsection\" class=\"active-subsection\"><a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["folder"], "U_FOLDER", [], "any", false, false, false, 42);
                    echo "\">";
                    if ((twig_get_attribute($this->env, $this->source, $context["folder"], "UNREAD_MESSAGES", [], "any", false, false, false, 42) > 0)) {
                        echo "<strong>";
                        echo twig_get_attribute($this->env, $this->source, $context["folder"], "FOLDER_NAME", [], "any", false, false, false, 42);
                        echo " (";
                        echo twig_get_attribute($this->env, $this->source, $context["folder"], "UNREAD_MESSAGES", [], "any", false, false, false, 42);
                        echo ")</strong>";
                    } else {
                        echo twig_get_attribute($this->env, $this->source, $context["folder"], "FOLDER_NAME", [], "any", false, false, false, 42);
                    }
                    echo "</a></li>
\t\t\t\t";
                } else {
                    // line 44
                    echo "\t\t\t\t\t<li><a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["folder"], "U_FOLDER", [], "any", false, false, false, 44);
                    echo "\"><span>";
                    if ((twig_get_attribute($this->env, $this->source, $context["folder"], "UNREAD_MESSAGES", [], "any", false, false, false, 44) > 0)) {
                        echo "<strong>";
                        echo twig_get_attribute($this->env, $this->source, $context["folder"], "FOLDER_NAME", [], "any", false, false, false, 44);
                        echo " (";
                        echo twig_get_attribute($this->env, $this->source, $context["folder"], "UNREAD_MESSAGES", [], "any", false, false, false, 44);
                        echo ")</strong>";
                    } else {
                        echo twig_get_attribute($this->env, $this->source, $context["folder"], "FOLDER_NAME", [], "any", false, false, false, 44);
                    }
                    echo "</span></a></li>
\t\t\t\t";
                }
                // line 46
                echo "\t\t\t\t";
                if (twig_get_attribute($this->env, $this->source, $context["folder"], "S_LAST_ROW", [], "any", false, false, false, 46)) {
                    echo "</ul>";
                }
                // line 47
                echo "\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['folder'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 48
            echo "\t\t\t<hr />
\t\t";
        }
        // line 50
        echo "
\t\t\t<ul>
\t\t";
        // line 52
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "t_block2", [], "any", false, false, false, 52));
        foreach ($context['_seq'] as $context["_key"] => $context["t_block2"]) {
            // line 53
            echo "\t\t\t";
            if (((($context["S_PRIVMSGS"] ?? null) && twig_get_attribute($this->env, $this->source, $context["t_block2"], "S_LAST_ROW", [], "any", false, false, false, 53)) ||  !($context["S_PRIVMSGS"] ?? null))) {
                // line 54
                echo "\t\t\t\t";
                if (twig_get_attribute($this->env, $this->source, $context["t_block2"], "S_SELECTED", [], "any", false, false, false, 54)) {
                    // line 55
                    echo "\t\t\t\t\t<li id=\"active-subsection\" class=\"active-subsection\"><a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["t_block2"], "U_TITLE", [], "any", false, false, false, 55);
                    echo "\"><span>";
                    echo twig_get_attribute($this->env, $this->source, $context["t_block2"], "L_TITLE", [], "any", false, false, false, 55);
                    echo "</span></a></li>
\t\t\t\t";
                } else {
                    // line 57
                    echo "\t\t\t\t\t<li><a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["t_block2"], "U_TITLE", [], "any", false, false, false, 57);
                    echo "\"><span>";
                    echo twig_get_attribute($this->env, $this->source, $context["t_block2"], "L_TITLE", [], "any", false, false, false, 57);
                    echo "</span></a></li>
\t\t\t\t";
                }
                // line 59
                echo "\t\t\t";
            }
            // line 60
            echo "\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['t_block2'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 61
        echo "\t\t\t</ul>
\t\t</div>

\t\t";
        // line 64
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "friends_online", [], "any", false, false, false, 64)) || twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "friends_offline", [], "any", false, false, false, 64)))) {
            // line 65
            echo "\t\t<div class=\"cp-mini\">
\t\t\t<div class=\"inner\">

\t\t\t<dl class=\"mini\">
\t\t\t\t<dt>";
            // line 69
            echo $this->extensions['phpbb\template\twig\extension']->lang("FRIENDS");
            echo "</dt>

\t\t\t\t";
            // line 71
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "friends_online", [], "any", false, false, false, 71));
            foreach ($context['_seq'] as $context["_key"] => $context["friends_online"]) {
                // line 72
                echo "\t\t\t\t\t<dd class=\"friend-online\" title=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("FRIENDS_ONLINE");
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["friends_online"], "USERNAME_FULL", [], "any", false, false, false, 72);
                echo " ";
                if (($context["S_SHOW_PM_BOX"] ?? null)) {
                    echo " <input type=\"submit\" name=\"add_to[";
                    echo twig_get_attribute($this->env, $this->source, $context["friends_online"], "USER_ID", [], "any", false, false, false, 72);
                    echo "]\" value=\"";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ADD");
                    echo "\" class=\"button2\" />";
                }
                if ((twig_get_attribute($this->env, $this->source, $context["friends_online"], "S_LAST_ROW", [], "any", false, false, false, 72) && twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "friends_offline", [], "any", false, false, false, 72)))) {
                    echo "<hr />";
                }
                echo "</dd>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['friends_online'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 74
            echo "
\t\t\t\t";
            // line 75
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "friends_offline", [], "any", false, false, false, 75));
            foreach ($context['_seq'] as $context["_key"] => $context["friends_offline"]) {
                // line 76
                echo "\t\t\t\t\t<dd class=\"friend-offline\" title=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("FRIENDS_OFFLINE");
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["friends_offline"], "USERNAME_FULL", [], "any", false, false, false, 76);
                echo " ";
                if (($context["S_SHOW_PM_BOX"] ?? null)) {
                    echo "<input type=\"submit\" name=\"add_to[";
                    echo twig_get_attribute($this->env, $this->source, $context["friends_offline"], "USER_ID", [], "any", false, false, false, 76);
                    echo "]\" value=\"";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ADD");
                    echo "\" class=\"button2\" />";
                }
                echo "</dd>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['friends_offline'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 78
            echo "\t\t\t</dl>

\t\t\t</div>
\t\t</div>
\t\t";
        }
        // line 83
        echo "
\t\t";
        // line 84
        if (($context["S_SHOW_COLOUR_LEGEND"] ?? null)) {
            // line 85
            echo "\t\t<div class=\"cp-mini\">
\t\t\t<div class=\"inner\">

\t\t\t<dl class=\"mini\">
\t\t\t\t<dt>";
            // line 89
            echo $this->extensions['phpbb\template\twig\extension']->lang("MESSAGE_COLOURS");
            echo "</dt>
\t\t\t\t";
            // line 90
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pm_colour_info", [], "any", false, false, false, 90));
            foreach ($context['_seq'] as $context["_key"] => $context["pm_colour_info"]) {
                // line 91
                echo "\t\t\t\t\t<dd class=\"pm-legend";
                if (twig_get_attribute($this->env, $this->source, $context["pm_colour_info"], "CLASS", [], "any", false, false, false, 91)) {
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["pm_colour_info"], "CLASS", [], "any", false, false, false, 91);
                }
                echo "\">";
                if (twig_get_attribute($this->env, $this->source, $context["pm_colour_info"], "IMG", [], "any", false, false, false, 91)) {
                    echo twig_get_attribute($this->env, $this->source, $context["pm_colour_info"], "IMG", [], "any", false, false, false, 91);
                    echo " ";
                }
                echo twig_get_attribute($this->env, $this->source, $context["pm_colour_info"], "LANG", [], "any", false, false, false, 91);
                echo "</dd>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pm_colour_info'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 93
            echo "\t\t\t</dl>

\t\t\t</div>
\t\t</div>
\t\t";
        }
        // line 98
        echo "
\t</div>

\t<div id=\"cp-main\" class=\"cp-main ucp-main panel-container\">
";
    }

    public function getTemplateName()
    {
        return "ucp_header.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  368 => 98,  361 => 93,  343 => 91,  339 => 90,  335 => 89,  329 => 85,  327 => 84,  324 => 83,  317 => 78,  298 => 76,  294 => 75,  291 => 74,  269 => 72,  265 => 71,  260 => 69,  254 => 65,  252 => 64,  247 => 61,  241 => 60,  238 => 59,  230 => 57,  222 => 55,  219 => 54,  216 => 53,  212 => 52,  208 => 50,  204 => 48,  198 => 47,  193 => 46,  177 => 44,  161 => 42,  158 => 41,  153 => 40,  149 => 39,  145 => 37,  139 => 36,  135 => 34,  127 => 32,  119 => 30,  117 => 29,  114 => 28,  111 => 27,  106 => 26,  104 => 25,  93 => 16,  85 => 14,  83 => 13,  78 => 10,  63 => 8,  59 => 7,  52 => 3,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "ucp_header.html", "");
    }
}
