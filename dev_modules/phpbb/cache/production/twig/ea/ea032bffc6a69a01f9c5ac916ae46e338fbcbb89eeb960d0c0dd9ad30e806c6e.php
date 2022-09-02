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

/* posting_topic_review.html */
class __TwigTemplate_98996a7d22b7022ecf838669be8c84f2801d04eeb3819b62a18f2ce7252c7ecb extends \Twig\Template
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
<h3 id=\"review\" class=\"review\">
\t<span class=\"right-box\"><a href=\"#review\" onclick=\"viewableArea(getElementById('topicreview'), true); var rev_text = getElementById('review').getElementsByTagName('a').item(0).firstChild; if (rev_text.data == '";
        // line 3
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("EXPAND_VIEW"), "js");
        echo "'){rev_text.data = '";
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("COLLAPSE_VIEW"), "js");
        echo "'; } else if (rev_text.data == '";
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("COLLAPSE_VIEW"), "js");
        echo "'){rev_text.data = '";
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("EXPAND_VIEW"), "js");
        echo "'};\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXPAND_VIEW");
        echo "</a></span>
\t";
        // line 4
        echo $this->extensions['phpbb\template\twig\extension']->lang("TOPIC_REVIEW");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo " ";
        echo ($context["TOPIC_TITLE"] ?? null);
        echo "
</h3>

<div id=\"topicreview\" class=\"topicreview\">
<script>
\tbbcodeEnabled = ";
        // line 9
        echo ($context["S_BBCODE_ALLOWED"] ?? null);
        echo ";
</script>
\t";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "topic_review_row", [], "any", false, false, false, 11));
        foreach ($context['_seq'] as $context["_key"] => $context["topic_review_row"]) {
            // line 12
            echo "
\t";
            // line 13
            if (twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "S_IGNORE_POST", [], "any", false, false, false, 13)) {
                // line 14
                echo "\t<div class=\"post bg3 post-ignore\">
\t\t<div class=\"inner\">
\t\t\t";
                // line 16
                echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "L_IGNORE_POST", [], "any", false, false, false, 16);
                echo "<br>
\t\t\t<a class=\"display_post_review\" href=\"";
                // line 17
                echo twig_get_attribute($this->env, $this->source, ($context["post_review_row"] ?? null), "U_MINI_POST", [], "any", false, false, false, 17);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("POST_DISPLAY");
                echo "</a>
\t";
            } elseif (twig_get_attribute($this->env, $this->source,             // line 18
$context["topic_review_row"], "S_POST_DELETED", [], "any", false, false, false, 18)) {
                // line 19
                echo "\t<div class=\"post bg3 post-ignore\">
\t\t<div class=\"inner\">
\t\t\t";
                // line 21
                echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "L_DELETE_POST", [], "any", false, false, false, 21);
                echo "<br>
\t\t\t<a class=\"display_post_review\" href=\"";
                // line 22
                echo twig_get_attribute($this->env, $this->source, ($context["post_review_row"] ?? null), "U_MINI_POST", [], "any", false, false, false, 22);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("POST_DISPLAY");
                echo "</a>
\t";
            } else {
                // line 24
                echo "\t<div class=\"post ";
                if ((twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "S_ROW_COUNT", [], "any", false, false, false, 24) % 2 != 0)) {
                    echo "bg1";
                } else {
                    echo "bg2";
                }
                if ((twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "POST_ID", [], "any", false, false, false, 24) == ($context["REPORTED_POST_ID"] ?? null))) {
                    echo " reported";
                }
                echo "\">
\t\t<div class=\"inner\">
\t";
            }
            // line 27
            echo "
\t\t<div class=\"postbody\" id=\"pr";
            // line 28
            echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "POST_ID", [], "any", false, false, false, 28);
            echo "\">
\t\t\t<h3><a href=\"";
            // line 29
            echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "U_MINI_POST", [], "any", false, false, false, 29);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "POST_SUBJECT", [], "any", false, false, false, 29);
            echo "</a></h3>

\t\t\t";
            // line 31
            if (((twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "POSTER_QUOTE", [], "any", false, false, false, 31) && twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "DECODED_MESSAGE", [], "any", false, false, false, 31)) || twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "U_MCP_DETAILS", [], "any", false, false, false, 31))) {
                // line 32
                echo "\t\t\t<ul class=\"post-buttons\">
\t\t\t";
                // line 33
                if (twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "U_MCP_DETAILS", [], "any", false, false, false, 33)) {
                    // line 34
                    echo "\t\t\t\t<li>
\t\t\t\t\t<a href=\"";
                    // line 35
                    echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "U_MCP_DETAILS", [], "any", false, false, false, 35);
                    echo "\" title=\"";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("POST_DETAILS");
                    echo "\" class=\"button button-icon-only\">
\t\t\t\t\t\t<i class=\"icon fa-info fa-fw\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                    // line 36
                    echo $this->extensions['phpbb\template\twig\extension']->lang("POST_DETAILS");
                    echo "</span>
\t\t\t\t\t</a>
\t\t\t\t<li>
\t\t\t";
                }
                // line 40
                echo "\t\t\t";
                if ((twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "POSTER_QUOTE", [], "any", false, false, false, 40) && twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "DECODED_MESSAGE", [], "any", false, false, false, 40))) {
                    // line 41
                    echo "\t\t\t\t<li>
\t\t\t\t\t<a href=\"#postingbox\" onclick=\"addquote(";
                    // line 42
                    echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "POST_ID", [], "any", false, false, false, 42);
                    echo ", '";
                    echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "POSTER_QUOTE", [], "any", false, false, false, 42);
                    echo "', '";
                    echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("WROTE"), "js");
                    echo "', {post_id:";
                    echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "POST_ID", [], "any", false, false, false, 42);
                    echo ",time:";
                    echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "POST_TIME", [], "any", false, false, false, 42);
                    echo ",user_id:";
                    echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "USER_ID", [], "any", false, false, false, 42);
                    echo "});\" title=\"";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("QUOTE");
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "POST_AUTHOR", [], "any", false, false, false, 42);
                    echo "\" class=\"button button-icon-only\">
\t\t\t\t\t\t<i class=\"icon fa-quote-left fa-fw\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                    // line 43
                    echo $this->extensions['phpbb\template\twig\extension']->lang("QUOTE");
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "POST_AUTHOR", [], "any", false, false, false, 43);
                    echo "</span>
\t\t\t\t\t</a>
\t\t\t\t</li>
\t\t\t";
                }
                // line 47
                echo "\t\t\t</ul>
\t\t\t";
            }
            // line 49
            echo "
\t\t\t";
            // line 50
            // line 51
            echo "\t\t\t<p class=\"author\">
\t\t\t\t";
            // line 52
            if (($context["S_IS_BOT"] ?? null)) {
                // line 53
                echo "\t\t\t\t\t<span><i class=\"icon fa-file fa-fw icon-lightgray icon-md\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "MINI_POST", [], "any", false, false, false, 53);
                echo "</span></span>
\t\t\t\t";
            } else {
                // line 55
                echo "\t\t\t\t\t<a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "U_MINI_POST", [], "any", false, false, false, 55);
                echo "\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "MINI_POST", [], "any", false, false, false, 55);
                echo "\">
\t\t\t\t\t\t<i class=\"icon fa-file fa-fw icon-lightgray icon-md\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                // line 56
                echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "MINI_POST", [], "any", false, false, false, 56);
                echo "</span>
\t\t\t\t\t</a>
\t\t\t\t";
            }
            // line 59
            echo "\t\t\t\t";
            echo $this->extensions['phpbb\template\twig\extension']->lang("POST_BY_AUTHOR");
            echo " ";
            echo "<strong>";
            echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "POST_AUTHOR_FULL", [], "any", false, false, false, 59);
            echo "</strong>";
            echo " &raquo; ";
            echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "POST_DATE", [], "any", false, false, false, 59);
            echo "
\t\t\t</p>
\t\t\t";
            // line 61
            // line 62
            echo "
\t\t\t<div class=\"content\">";
            // line 63
            echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "MESSAGE", [], "any", false, false, false, 63);
            echo "</div>

\t\t\t";
            // line 65
            // line 66
            echo "
\t\t\t";
            // line 67
            if (twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "S_HAS_ATTACHMENTS", [], "any", false, false, false, 67)) {
                // line 68
                echo "\t\t\t\t<dl class=\"attachbox\">
\t\t\t\t\t<dt>";
                // line 69
                echo $this->extensions['phpbb\template\twig\extension']->lang("ATTACHMENTS");
                echo "</dt>
\t\t\t\t\t";
                // line 70
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "attachment", [], "any", false, false, false, 70));
                foreach ($context['_seq'] as $context["_key"] => $context["attachment"]) {
                    // line 71
                    echo "\t\t\t\t\t\t<dd>";
                    echo twig_get_attribute($this->env, $this->source, $context["attachment"], "DISPLAY_ATTACHMENT", [], "any", false, false, false, 71);
                    echo "</dd>
\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attachment'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 73
                echo "\t\t\t\t</dl>
\t\t\t";
            }
            // line 75
            echo "
\t\t\t";
            // line 76
            if ((twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "POSTER_QUOTE", [], "any", false, false, false, 76) && twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "DECODED_MESSAGE", [], "any", false, false, false, 76))) {
                // line 77
                echo "\t\t\t\t<div id=\"message_";
                echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "POST_ID", [], "any", false, false, false, 77);
                echo "\" style=\"display: none;\">";
                echo twig_get_attribute($this->env, $this->source, $context["topic_review_row"], "DECODED_MESSAGE", [], "any", false, false, false, 77);
                echo "</div>
\t\t\t";
            }
            // line 79
            echo "\t\t</div>
\t\t</div>
\t</div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['topic_review_row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 83
        echo "</div>

<hr />

<p>
\t<a href=\"";
        // line 88
        if (($context["S_MCP_REPORT"] ?? null)) {
            echo "#report";
        } else {
            echo "#postingbox";
        }
        echo "\" class=\"top\">
\t\t<i class=\"icon fa-chevron-circle-up fa-fw icon-gray\" aria-hidden=\"true\"></i><span>";
        // line 89
        echo $this->extensions['phpbb\template\twig\extension']->lang("BACK_TO_TOP");
        echo "</span>
\t</a>
</p>
";
    }

    public function getTemplateName()
    {
        return "posting_topic_review.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  313 => 89,  305 => 88,  298 => 83,  289 => 79,  281 => 77,  279 => 76,  276 => 75,  272 => 73,  263 => 71,  259 => 70,  255 => 69,  252 => 68,  250 => 67,  247 => 66,  246 => 65,  241 => 63,  238 => 62,  237 => 61,  225 => 59,  219 => 56,  212 => 55,  206 => 53,  204 => 52,  201 => 51,  200 => 50,  197 => 49,  193 => 47,  184 => 43,  166 => 42,  163 => 41,  160 => 40,  153 => 36,  147 => 35,  144 => 34,  142 => 33,  139 => 32,  137 => 31,  130 => 29,  126 => 28,  123 => 27,  109 => 24,  102 => 22,  98 => 21,  94 => 19,  92 => 18,  86 => 17,  82 => 16,  78 => 14,  76 => 13,  73 => 12,  69 => 11,  64 => 9,  53 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "posting_topic_review.html", "");
    }
}
