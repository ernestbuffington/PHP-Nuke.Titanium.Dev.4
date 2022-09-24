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

/* notification_dropdown.html */
class __TwigTemplate_05646a4b75687ff03d8399e90636b00f521bef66ec3fa2045ccb0494ba834bba extends \Twig\Template
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
        echo "<div id=\"notification_list\" class=\"dropdown dropdown-extended notification_list\">
\t<div class=\"pointer\"><div class=\"pointer-inner\"></div></div>
\t<div class=\"dropdown-contents\">
\t\t<div class=\"header\">
\t\t\t";
        // line 5
        echo $this->extensions['phpbb\template\twig\extension']->lang("NOTIFICATIONS");
        echo "
\t\t\t<span class=\"header_settings\">
\t\t\t\t<a href=\"";
        // line 7
        echo ($context["U_NOTIFICATION_SETTINGS"] ?? null);
        echo "\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("SETTINGS");
        echo "</a>
\t\t\t\t";
        // line 8
        if (($context["NOTIFICATIONS_COUNT"] ?? null)) {
            // line 9
            echo "\t\t\t\t\t<span id=\"mark_all_notifications\"> &bull; <a href=\"";
            echo ($context["U_MARK_ALL_NOTIFICATIONS"] ?? null);
            echo "\" data-ajax=\"notification.mark_all_read\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("MARK_ALL_READ");
            echo "</a></span>
\t\t\t\t";
        }
        // line 11
        echo "\t\t\t</span>
\t\t</div>

\t\t<ul>
\t\t\t";
        // line 15
        if ( !twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "notifications", [], "any", false, false, false, 15))) {
            // line 16
            echo "\t\t\t\t<li class=\"no_notifications\">
\t\t\t\t\t";
            // line 17
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO_NOTIFICATIONS");
            echo "
\t\t\t\t</li>
\t\t\t";
        }
        // line 20
        echo "\t\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "notifications", [], "any", false, false, false, 20));
        foreach ($context['_seq'] as $context["_key"] => $context["notifications"]) {
            // line 21
            echo "\t\t\t\t<li class=\"";
            if (twig_get_attribute($this->env, $this->source, $context["notifications"], "UNREAD", [], "any", false, false, false, 21)) {
                echo " bg2";
            }
            if (twig_get_attribute($this->env, $this->source, $context["notifications"], "STYLING", [], "any", false, false, false, 21)) {
                echo " ";
                echo twig_get_attribute($this->env, $this->source, $context["notifications"], "STYLING", [], "any", false, false, false, 21);
            }
            if ( !twig_get_attribute($this->env, $this->source, $context["notifications"], "URL", [], "any", false, false, false, 21)) {
                echo " no-url";
            }
            echo "\">
\t\t\t\t\t";
            // line 22
            if (twig_get_attribute($this->env, $this->source, $context["notifications"], "URL", [], "any", false, false, false, 22)) {
                // line 23
                echo "\t\t\t\t\t\t<a class=\"notification-block\" href=\"";
                if (twig_get_attribute($this->env, $this->source, $context["notifications"], "UNREAD", [], "any", false, false, false, 23)) {
                    echo twig_get_attribute($this->env, $this->source, $context["notifications"], "U_MARK_READ", [], "any", false, false, false, 23);
                    echo "\" data-real-url=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["notifications"], "URL", [], "any", false, false, false, 23);
                } else {
                    echo twig_get_attribute($this->env, $this->source, $context["notifications"], "URL", [], "any", false, false, false, 23);
                }
                echo "\">
\t\t\t\t\t";
            }
            // line 25
            echo "\t\t\t\t\t\t";
            if (twig_get_attribute($this->env, $this->source, $context["notifications"], "AVATAR", [], "any", false, false, false, 25)) {
                echo twig_get_attribute($this->env, $this->source, $context["notifications"], "AVATAR", [], "any", false, false, false, 25);
            } else {
                echo "<img src=\"";
                echo ($context["T_THEME_PATH"] ?? null);
                echo "/images/no_avatar.gif\" alt=\"\" />";
            }
            // line 26
            echo "\t\t\t\t\t\t<div class=\"notification_text\">
\t\t\t\t\t\t\t<p class=\"notification-title\">";
            // line 27
            echo twig_get_attribute($this->env, $this->source, $context["notifications"], "FORMATTED_TITLE", [], "any", false, false, false, 27);
            echo "</p>
\t\t\t\t\t\t\t";
            // line 28
            if (twig_get_attribute($this->env, $this->source, $context["notifications"], "REFERENCE", [], "any", false, false, false, 28)) {
                echo "<p class=\"notification-reference\">";
                echo twig_get_attribute($this->env, $this->source, $context["notifications"], "REFERENCE", [], "any", false, false, false, 28);
                echo "</p>";
            }
            // line 29
            echo "\t\t\t\t\t\t\t";
            if (twig_get_attribute($this->env, $this->source, $context["notifications"], "FORUM", [], "any", false, false, false, 29)) {
                echo "<p class=\"notification-forum\">";
                echo twig_get_attribute($this->env, $this->source, $context["notifications"], "FORUM", [], "any", false, false, false, 29);
                echo "</p>";
            }
            // line 30
            echo "\t\t\t\t\t\t\t";
            if (twig_get_attribute($this->env, $this->source, $context["notifications"], "REASON", [], "any", false, false, false, 30)) {
                echo "<p class=\"notification-reason\">";
                echo twig_get_attribute($this->env, $this->source, $context["notifications"], "REASON", [], "any", false, false, false, 30);
                echo "</p>";
            }
            // line 31
            echo "\t\t\t\t\t\t\t<p class=\"notification-time\">";
            echo twig_get_attribute($this->env, $this->source, $context["notifications"], "TIME", [], "any", false, false, false, 31);
            echo "</p>
\t\t\t\t\t\t</div>
\t\t\t\t\t";
            // line 33
            if (twig_get_attribute($this->env, $this->source, $context["notifications"], "URL", [], "any", false, false, false, 33)) {
                echo "</a>";
            }
            // line 34
            echo "\t\t\t\t\t";
            if (twig_get_attribute($this->env, $this->source, $context["notifications"], "UNREAD", [], "any", false, false, false, 34)) {
                // line 35
                echo "\t\t\t\t\t\t<a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["notifications"], "U_MARK_READ", [], "any", false, false, false, 35);
                echo "\" class=\"mark_read icon-mark\" data-ajax=\"notification.mark_read\" title=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("MARK_READ");
                echo "\">
\t\t\t\t\t\t\t <i class=\"icon fa-check-circle icon-xl fa-fw\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                // line 36
                echo $this->extensions['phpbb\template\twig\extension']->lang("MARK_READ");
                echo "</span>
\t\t\t\t\t\t</a>
\t\t\t\t\t";
            }
            // line 39
            echo "\t\t\t\t</li>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['notifications'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        echo "\t\t</ul>

\t\t<div class=\"footer\">
\t\t\t<a href=\"";
        // line 44
        echo ($context["U_VIEW_ALL_NOTIFICATIONS"] ?? null);
        echo "\"><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("SEE_ALL");
        echo "</span></a>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "notification_dropdown.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  188 => 44,  183 => 41,  176 => 39,  170 => 36,  163 => 35,  160 => 34,  156 => 33,  150 => 31,  143 => 30,  136 => 29,  130 => 28,  126 => 27,  123 => 26,  114 => 25,  102 => 23,  100 => 22,  86 => 21,  81 => 20,  75 => 17,  72 => 16,  70 => 15,  64 => 11,  56 => 9,  54 => 8,  48 => 7,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "notification_dropdown.html", "");
    }
}
