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

/* memberlist_team.html */
class __TwigTemplate_ebf74f8882b472d34e37463e5b73e75d97b3a8b0c1d09b27e0c78f76893b20c8 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "memberlist_team.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<h2 class=\"solo\">";
        // line 3
        echo ($context["PAGE_TITLE"] ?? null);
        echo "</h2>

<form method=\"post\" action=\"";
        // line 5
        echo ($context["S_MODE_ACTION"] ?? null);
        echo "\">

";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "group", [], "any", false, false, false, 7));
        foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
            // line 8
            echo "<div class=\"forumbg forumbg-table\">
\t<div class=\"inner\">

\t<table class=\"table1\" id=\"team\">
\t<thead>
\t<tr>
\t\t<th class=\"name\" data-dfn=\"";
            // line 14
            echo $this->extensions['phpbb\template\twig\extension']->lang("RANK");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COMMA_SEPARATOR");
            echo $this->extensions['phpbb\template\twig\extension']->lang("USERNAME");
            echo "\"><span class=\"rank-img\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("RANK");
            echo "&nbsp;</span>";
            if (twig_get_attribute($this->env, $this->source, $context["group"], "U_GROUP", [], "any", false, false, false, 14)) {
                echo "<a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["group"], "U_GROUP", [], "any", false, false, false, 14);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["group"], "GROUP_NAME", [], "any", false, false, false, 14);
                echo "</a>";
            } else {
                echo twig_get_attribute($this->env, $this->source, $context["group"], "GROUP_NAME", [], "any", false, false, false, 14);
            }
            echo "</th>
\t\t<th class=\"info\">";
            // line 15
            echo $this->extensions['phpbb\template\twig\extension']->lang("PRIMARY_GROUP");
            echo "</th>
\t\t";
            // line 16
            if (($context["S_DISPLAY_MODERATOR_FORUMS"] ?? null)) {
                echo "<th class=\"info\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("MODERATOR");
                echo "</th>";
            }
            // line 17
            echo "\t</tr>
\t</thead>
\t<tbody>
";
            // line 20
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["group"], "user", [], "any", false, false, false, 20));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
                // line 21
                echo "\t<tr class=\"";
                if ((twig_get_attribute($this->env, $this->source, $context["user"], "S_ROW_COUNT", [], "any", false, false, false, 21) % 2 == 0)) {
                    echo "bg1";
                } else {
                    echo "bg2";
                }
                if (twig_get_attribute($this->env, $this->source, $context["user"], "S_INACTIVE", [], "any", false, false, false, 21)) {
                    echo " inactive";
                }
                echo "\">
\t\t<td>";
                // line 22
                if (twig_get_attribute($this->env, $this->source, $context["user"], "RANK_IMG", [], "any", false, false, false, 22)) {
                    echo "<span class=\"rank-img\">";
                    echo twig_get_attribute($this->env, $this->source, $context["user"], "RANK_IMG", [], "any", false, false, false, 22);
                    echo "</span>";
                } else {
                    echo "<span class=\"rank-img\">";
                    echo twig_get_attribute($this->env, $this->source, $context["user"], "RANK_TITLE", [], "any", false, false, false, 22);
                    echo "</span>";
                }
                echo twig_get_attribute($this->env, $this->source, $context["user"], "USERNAME_FULL", [], "any", false, false, false, 22);
                if (twig_get_attribute($this->env, $this->source, $context["user"], "S_INACTIVE", [], "any", false, false, false, 22)) {
                    echo " (";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("INACTIVE");
                    echo ")";
                }
                echo "</td>
\t\t<td class=\"info\">";
                // line 23
                if (twig_get_attribute($this->env, $this->source, $context["user"], "U_GROUP", [], "any", false, false, false, 23)) {
                    // line 24
                    echo "\t\t\t<a";
                    if (twig_get_attribute($this->env, $this->source, $context["user"], "GROUP_COLOR", [], "any", false, false, false, 24)) {
                        echo " style=\"font-weight: bold; color: #";
                        echo twig_get_attribute($this->env, $this->source, $context["user"], "GROUP_COLOR", [], "any", false, false, false, 24);
                        echo "\"";
                    }
                    echo " href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["user"], "U_GROUP", [], "any", false, false, false, 24);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["user"], "GROUP_NAME", [], "any", false, false, false, 24);
                    echo "</a>
\t\t\t";
                } else {
                    // line 26
                    echo "\t\t\t\t";
                    echo twig_get_attribute($this->env, $this->source, $context["user"], "GROUP_NAME", [], "any", false, false, false, 26);
                    echo "
\t\t\t";
                }
                // line 27
                echo "</td>
\t\t";
                // line 28
                if (($context["S_DISPLAY_MODERATOR_FORUMS"] ?? null)) {
                    // line 29
                    echo "\t\t\t<td class=\"info\">";
                    if (twig_get_attribute($this->env, $this->source, $context["user"], "FORUM_OPTIONS", [], "any", false, false, false, 29)) {
                        echo "<select style=\"width: 100%;\">";
                        echo twig_get_attribute($this->env, $this->source, $context["user"], "FORUMS", [], "any", false, false, false, 29);
                        echo "</select>";
                    } elseif (twig_get_attribute($this->env, $this->source, $context["user"], "FORUMS", [], "any", false, false, false, 29)) {
                        echo twig_get_attribute($this->env, $this->source, $context["user"], "FORUMS", [], "any", false, false, false, 29);
                    } else {
                        echo "-";
                    }
                    echo "</td>
\t\t";
                }
                // line 31
                echo "\t</tr>
";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 33
                echo "\t<tr class=\"bg1\">
\t\t<td colspan=\"3\"><strong>";
                // line 34
                echo $this->extensions['phpbb\template\twig\extension']->lang("NO_MEMBERS");
                echo "</strong></td>
\t</tr>
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            echo "\t</tbody>
\t</table>

\t</div>
</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        echo "
</form>

";
        // line 46
        $location = "jumpbox.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("jumpbox.html", "memberlist_team.html", 46)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 47
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "memberlist_team.html", 47)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "memberlist_team.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  229 => 47,  217 => 46,  212 => 43,  201 => 37,  192 => 34,  189 => 33,  183 => 31,  169 => 29,  167 => 28,  164 => 27,  158 => 26,  144 => 24,  142 => 23,  124 => 22,  112 => 21,  107 => 20,  102 => 17,  96 => 16,  92 => 15,  74 => 14,  66 => 8,  62 => 7,  57 => 5,  52 => 3,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "memberlist_team.html", "");
    }
}
