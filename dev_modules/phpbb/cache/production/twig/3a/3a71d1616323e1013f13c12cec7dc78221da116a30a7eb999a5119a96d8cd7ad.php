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

/* search_results.html */
class __TwigTemplate_2e4f88ccf196048babb2ec991102d5ea03c1c6043020d8d829f7ab8d22aa6c72 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "search_results.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
";
        // line 3
        // line 4
        echo "
<h2 class=\"searchresults-title\">";
        // line 5
        if (($context["SEARCH_TITLE"] ?? null)) {
            echo ($context["SEARCH_TITLE"] ?? null);
        } else {
            echo ($context["SEARCH_MATCHES"] ?? null);
        }
        if (($context["SEARCH_WORDS"] ?? null)) {
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo " <a href=\"";
            echo ($context["U_SEARCH_WORDS"] ?? null);
            echo "\">";
            echo ($context["SEARCH_WORDS"] ?? null);
            echo "</a>";
        }
        echo "</h2>
";
        // line 6
        if (($context["SEARCHED_QUERY"] ?? null)) {
            echo " <p>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCHED_QUERY");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo " <strong>";
            echo ($context["SEARCHED_QUERY"] ?? null);
            echo "</strong></p>";
        }
        // line 7
        if (($context["IGNORED_WORDS"] ?? null)) {
            echo " <p>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("IGNORED_TERMS");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo " <strong>";
            echo ($context["IGNORED_WORDS"] ?? null);
            echo "</strong></p>";
        }
        // line 8
        if (($context["PHRASE_SEARCH_DISABLED"] ?? null)) {
            echo " <p><strong>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("PHRASE_SEARCH_DISABLED");
            echo "</strong></p>";
        }
        // line 9
        echo "
";
        // line 10
        if (($context["SEARCH_TOPIC"] ?? null)) {
            // line 11
            echo "\t<p class=\"return-link\">
\t\t<a class=\"arrow-";
            // line 12
            echo ($context["S_CONTENT_FLOW_BEGIN"] ?? null);
            echo "\" href=\"";
            echo ($context["U_SEARCH_TOPIC"] ?? null);
            echo "\">
\t\t\t<i class=\"icon fa-angle-";
            // line 13
            echo ($context["S_CONTENT_FLOW_BEGIN"] ?? null);
            echo " fa-fw icon-black\" aria-hidden=\"true\"></i><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("RETURN_TO_TOPIC");
            echo "</span>
\t\t</a>
\t</p>
";
        } else {
            // line 17
            echo "\t<p class=\"advanced-search-link\">
\t\t<a class=\"arrow-";
            // line 18
            echo ($context["S_CONTENT_FLOW_BEGIN"] ?? null);
            echo "\" href=\"";
            echo ($context["U_SEARCH"] ?? null);
            echo "\" title=\"";
            echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_ADV");
            echo "\">
\t\t\t<i class=\"icon fa-angle-";
            // line 19
            echo ($context["S_CONTENT_FLOW_BEGIN"] ?? null);
            echo " fa-fw icon-black\" aria-hidden=\"true\"></i><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("GO_TO_SEARCH_ADV");
            echo "</span>
\t\t</a>
\t</p>
";
        }
        // line 23
        echo "
";
        // line 24
        // line 25
        echo "
";
        // line 26
        if ((((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pagination", [], "any", false, false, false, 26)) || ($context["SEARCH_MATCHES"] ?? null)) || ($context["TOTAL_MATCHES"] ?? null)) || ($context["PAGE_NUMBER"] ?? null))) {
            // line 27
            echo "\t<div class=\"action-bar bar-top\">

\t";
            // line 29
            if ((($context["TOTAL_MATCHES"] ?? null) > 0)) {
                // line 30
                echo "\t\t<div class=\"search-box\" role=\"search\">
\t\t\t<form method=\"post\" action=\"";
                // line 31
                echo ($context["S_SEARCH_ACTION"] ?? null);
                echo "\">
\t\t\t<fieldset>
\t\t\t\t<input class=\"inputbox search tiny\" type=\"search\" name=\"add_keywords\" id=\"add_keywords\" value=\"\" placeholder=\"";
                // line 33
                echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_IN_RESULTS");
                echo "\" />
\t\t\t\t<button class=\"button button-search\" type=\"submit\" title=\"";
                // line 34
                echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH");
                echo "\">
\t\t\t\t\t<i class=\"icon fa-search fa-fw\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                // line 35
                echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH");
                echo "</span>
\t\t\t\t</button>
\t\t\t\t<a href=\"";
                // line 37
                echo ($context["U_SEARCH"] ?? null);
                echo "\" class=\"button button-search-end\" title=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_ADV");
                echo "\">
\t\t\t\t\t<i class=\"icon fa-cog fa-fw\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                // line 38
                echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_ADV");
                echo "</span>
\t\t\t\t</a>
\t\t\t</fieldset>
\t\t\t</form>
\t\t</div>
\t";
            }
            // line 44
            echo "
\t\t";
            // line 45
            // line 46
            echo "
\t\t<div class=\"pagination\">
\t\t\t";
            // line 48
            if (($context["U_MARK_ALL_READ"] ?? null)) {
                echo "<a href=\"";
                echo ($context["U_MARK_ALL_READ"] ?? null);
                echo "\" class=\"mark-read\" accesskey=\"m\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("MARK_ALL_READ");
                echo "</a> &bull;";
            }
            // line 49
            echo "\t\t\t";
            echo ($context["SEARCH_MATCHES"] ?? null);
            echo "
\t\t\t";
            // line 50
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pagination", [], "any", false, false, false, 50))) {
                // line 51
                echo "\t\t\t\t";
                $location = "pagination.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->loadTemplate("pagination.html", "search_results.html", 51)->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 52
                echo "\t\t\t";
            } else {
                // line 53
                echo "\t\t\t\t &bull; ";
                echo ($context["PAGE_NUMBER"] ?? null);
                echo "
\t\t\t";
            }
            // line 55
            echo "\t\t</div>
\t</div>
";
        }
        // line 58
        echo "
";
        // line 59
        if (($context["S_SHOW_TOPICS"] ?? null)) {
            // line 60
            echo "
\t";
            // line 61
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "searchresults", [], "any", false, false, false, 61))) {
                // line 62
                echo "\t<div class=\"forumbg\">

\t\t<div class=\"inner\">
\t\t<ul class=\"topiclist\">
\t\t\t<li class=\"header\">
\t\t\t\t<dl class=\"row-item\">
\t\t\t\t\t<dt><div class=\"list-inner\">";
                // line 68
                echo $this->extensions['phpbb\template\twig\extension']->lang("TOPICS");
                echo "</div></dt>
\t\t\t\t\t<dd class=\"posts\">";
                // line 69
                echo $this->extensions['phpbb\template\twig\extension']->lang("REPLIES");
                echo "</dd>
\t\t\t\t\t<dd class=\"views\">";
                // line 70
                echo $this->extensions['phpbb\template\twig\extension']->lang("VIEWS");
                echo "</dd>
\t\t\t\t\t<dd class=\"lastpost\"><span>";
                // line 71
                echo $this->extensions['phpbb\template\twig\extension']->lang("LAST_POST");
                echo "</span></dd>
\t\t\t\t\t";
                // line 72
                // line 73
                echo "\t\t\t\t</dl>
\t\t\t</li>
\t\t</ul>
\t\t<ul class=\"topiclist topics\">

\t\t";
                // line 78
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "searchresults", [], "any", false, false, false, 78));
                foreach ($context['_seq'] as $context["_key"] => $context["searchresults"]) {
                    // line 79
                    echo "\t\t\t";
                    // line 80
                    echo "\t\t\t<li class=\"row";
                    if ((twig_get_attribute($this->env, $this->source, $context["searchresults"], "S_ROW_COUNT", [], "any", false, false, false, 80) % 2 == 0)) {
                        echo " bg1";
                    } else {
                        echo " bg2";
                    }
                    echo "\">
\t\t\t\t<dl class=\"row-item ";
                    // line 81
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "TOPIC_IMG_STYLE", [], "any", false, false, false, 81);
                    echo "\">
\t\t\t\t\t<dt";
                    // line 82
                    if (twig_get_attribute($this->env, $this->source, $context["searchresults"], "TOPIC_ICON_IMG", [], "any", false, false, false, 82)) {
                        echo " style=\"background-image: url(";
                        echo ($context["T_ICONS_PATH"] ?? null);
                        echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "TOPIC_ICON_IMG", [], "any", false, false, false, 82);
                        echo "); background-repeat: no-repeat;\"";
                    }
                    echo " title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "TOPIC_FOLDER_IMG_ALT", [], "any", false, false, false, 82);
                    echo "\">
\t\t\t\t\t\t";
                    // line 83
                    if ((twig_get_attribute($this->env, $this->source, $context["searchresults"], "S_UNREAD_TOPIC", [], "any", false, false, false, 83) &&  !($context["S_IS_BOT"] ?? null))) {
                        echo "<a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "U_NEWEST_POST", [], "any", false, false, false, 83);
                        echo "\" class=\"row-item-link\"></a>";
                    }
                    // line 84
                    echo "\t\t\t\t\t\t<div class=\"list-inner\">
\t\t\t\t\t\t\t";
                    // line 85
                    // line 86
                    echo "\t\t\t\t\t\t\t";
                    if ((twig_get_attribute($this->env, $this->source, $context["searchresults"], "S_UNREAD_TOPIC", [], "any", false, false, false, 86) &&  !($context["S_IS_BOT"] ?? null))) {
                        // line 87
                        echo "\t\t\t\t\t\t\t\t<a class=\"unread\" href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "U_NEWEST_POST", [], "any", false, false, false, 87);
                        echo "\">
\t\t\t\t\t\t\t\t\t<i class=\"icon fa-file fa-fw icon-red icon-md\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                        // line 88
                        echo $this->extensions['phpbb\template\twig\extension']->lang("NEW_POST");
                        echo "</span>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t";
                    }
                    // line 91
                    echo "\t\t\t\t\t\t\t<a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "U_VIEW_TOPIC", [], "any", false, false, false, 91);
                    echo "\" class=\"topictitle\">";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "TOPIC_TITLE", [], "any", false, false, false, 91);
                    echo "</a>
\t\t\t\t\t\t\t";
                    // line 92
                    if ((twig_get_attribute($this->env, $this->source, $context["searchresults"], "S_TOPIC_UNAPPROVED", [], "any", false, false, false, 92) || twig_get_attribute($this->env, $this->source, $context["searchresults"], "S_POSTS_UNAPPROVED", [], "any", false, false, false, 92))) {
                        // line 93
                        echo "\t\t\t\t\t\t\t\t<a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "U_MCP_QUEUE", [], "any", false, false, false, 93);
                        echo "\" title=\"";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("TOPIC_UNAPPROVED");
                        echo "\">
\t\t\t\t\t\t\t\t\t<i class=\"icon fa-question fa-fw icon-blue\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                        // line 94
                        echo $this->extensions['phpbb\template\twig\extension']->lang("TOPIC_UNAPPROVED");
                        echo "</span>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t";
                    }
                    // line 97
                    echo "\t\t\t\t\t\t\t";
                    if (twig_get_attribute($this->env, $this->source, $context["searchresults"], "S_TOPIC_DELETED", [], "any", false, false, false, 97)) {
                        // line 98
                        echo "\t\t\t\t\t\t\t\t<a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "U_MCP_QUEUE", [], "any", false, false, false, 98);
                        echo "\" title=\"";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("TOPIC_DELETED");
                        echo "\">
\t\t\t\t\t\t\t\t\t<i class=\"icon fa-recycle fa-fw icon-green\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                        // line 99
                        echo $this->extensions['phpbb\template\twig\extension']->lang("TOPIC_DELETED");
                        echo "</span>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t";
                    }
                    // line 102
                    echo "\t\t\t\t\t\t\t";
                    if (twig_get_attribute($this->env, $this->source, $context["searchresults"], "S_TOPIC_REPORTED", [], "any", false, false, false, 102)) {
                        // line 103
                        echo "\t\t\t\t\t\t\t\t<a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "U_MCP_REPORT", [], "any", false, false, false, 103);
                        echo "\" title=\"";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("TOPIC_REPORTED");
                        echo "\">
\t\t\t\t\t\t\t\t\t<i class=\"icon fa-exclamation fa-fw icon-red\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                        // line 104
                        echo $this->extensions['phpbb\template\twig\extension']->lang("TOPIC_REPORTED");
                        echo "</span>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t";
                    }
                    // line 107
                    echo "\t\t\t\t\t\t\t<br />
\t\t\t\t\t\t\t";
                    // line 108
                    // line 109
                    echo "
\t\t\t\t\t\t\t";
                    // line 110
                    if ( !($context["S_IS_BOT"] ?? null)) {
                        // line 111
                        echo "\t\t\t\t\t\t\t\t<div class=\"responsive-show\" style=\"display: none;\">
\t\t\t\t\t\t\t\t\t";
                        // line 112
                        echo $this->extensions['phpbb\template\twig\extension']->lang("LAST_POST");
                        echo " ";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("POST_BY_AUTHOR");
                        echo " ";
                        echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "LAST_POST_AUTHOR_FULL", [], "any", false, false, false, 112);
                        echo " &laquo; <a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "U_LAST_POST", [], "any", false, false, false, 112);
                        echo "\" title=\"";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("GOTO_LAST_POST");
                        echo "\"><time datetime=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "LAST_POST_TIME_RFC3339", [], "any", false, false, false, 112);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "LAST_POST_TIME", [], "any", false, false, false, 112);
                        echo "</time></a>
\t\t\t\t\t\t\t\t\t<br />";
                        // line 113
                        echo $this->extensions['phpbb\template\twig\extension']->lang("POSTED");
                        echo " ";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("IN");
                        echo " <a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "U_VIEW_FORUM", [], "any", false, false, false, 113);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "FORUM_TITLE", [], "any", false, false, false, 113);
                        echo "</a>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
                        // line 115
                        if (twig_get_attribute($this->env, $this->source, $context["searchresults"], "TOPIC_REPLIES", [], "any", false, false, false, 115)) {
                            echo "<span class=\"responsive-show left-box\" style=\"display: none;\">";
                            echo $this->extensions['phpbb\template\twig\extension']->lang("REPLIES");
                            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                            echo " <strong>";
                            echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "TOPIC_REPLIES", [], "any", false, false, false, 115);
                            echo "</strong></span>";
                        }
                        // line 116
                        echo "\t\t\t\t\t\t\t";
                    }
                    // line 117
                    echo "
\t\t\t\t\t\t\t<div class=\"responsive-hide left-box\">
\t\t\t\t\t\t\t\t";
                    // line 119
                    if (twig_get_attribute($this->env, $this->source, $context["searchresults"], "S_HAS_POLL", [], "any", false, false, false, 119)) {
                        echo "<i class=\"icon fa-bar-chart fa-fw\" aria-hidden=\"true\"></i>";
                    }
                    // line 120
                    echo "\t\t\t\t\t\t\t\t";
                    if (twig_get_attribute($this->env, $this->source, $context["searchresults"], "ATTACH_ICON_IMG", [], "any", false, false, false, 120)) {
                        echo "<i class=\"icon fa-paperclip fa-fw\" aria-hidden=\"true\"></i>";
                    }
                    // line 121
                    echo "\t\t\t\t\t\t\t\t";
                    // line 122
                    echo "\t\t\t\t\t\t\t\t";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("POST_BY_AUTHOR");
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "TOPIC_AUTHOR_FULL", [], "any", false, false, false, 122);
                    echo " &raquo; <time datetime=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "FIRST_POST_TIME_RFC3339", [], "any", false, false, false, 122);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "FIRST_POST_TIME", [], "any", false, false, false, 122);
                    echo "</time> &raquo; ";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("IN");
                    echo " <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "U_VIEW_FORUM", [], "any", false, false, false, 122);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "FORUM_TITLE", [], "any", false, false, false, 122);
                    echo "</a>
\t\t\t\t\t\t\t\t";
                    // line 123
                    // line 124
                    echo "\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t";
                    // line 126
                    if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["searchresults"], "pagination", [], "any", false, false, false, 126))) {
                        // line 127
                        echo "\t\t\t\t\t\t\t<div class=\"pagination\">
\t\t\t\t\t\t\t\t<span><i class=\"icon fa-clone fa-fw\" aria-hidden=\"true\"></i></span>
\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t";
                        // line 130
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["searchresults"], "pagination", [], "any", false, false, false, 130));
                        foreach ($context['_seq'] as $context["_key"] => $context["pagination"]) {
                            // line 131
                            echo "\t\t\t\t\t\t\t\t\t";
                            if (twig_get_attribute($this->env, $this->source, $context["pagination"], "S_IS_PREV", [], "any", false, false, false, 131)) {
                                // line 132
                                echo "\t\t\t\t\t\t\t\t\t";
                            } elseif (twig_get_attribute($this->env, $this->source, $context["pagination"], "S_IS_CURRENT", [], "any", false, false, false, 132)) {
                                echo "<li class=\"active\"><span>";
                                echo twig_get_attribute($this->env, $this->source, $context["pagination"], "PAGE_NUMBER", [], "any", false, false, false, 132);
                                echo "</span></li>
\t\t\t\t\t\t\t\t\t";
                            } elseif (twig_get_attribute($this->env, $this->source,                             // line 133
$context["pagination"], "S_IS_ELLIPSIS", [], "any", false, false, false, 133)) {
                                echo "<li class=\"ellipsis\"><span>";
                                echo $this->extensions['phpbb\template\twig\extension']->lang("ELLIPSIS");
                                echo "</span></li>
\t\t\t\t\t\t\t\t\t";
                            } elseif (twig_get_attribute($this->env, $this->source,                             // line 134
$context["pagination"], "S_IS_NEXT", [], "any", false, false, false, 134)) {
                                // line 135
                                echo "\t\t\t\t\t\t\t\t\t";
                            } else {
                                echo "<li><a class=\"button\" href=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["pagination"], "PAGE_URL", [], "any", false, false, false, 135);
                                echo "\">";
                                echo twig_get_attribute($this->env, $this->source, $context["pagination"], "PAGE_NUMBER", [], "any", false, false, false, 135);
                                echo "</a></li>
\t\t\t\t\t\t\t\t\t";
                            }
                            // line 137
                            echo "\t\t\t\t\t\t\t\t";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pagination'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 138
                        echo "\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
                    }
                    // line 141
                    echo "
\t\t\t\t\t\t\t";
                    // line 142
                    // line 143
                    echo "\t\t\t\t\t\t</div>
\t\t\t\t\t</dt>
\t\t\t\t\t<dd class=\"posts\">";
                    // line 145
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "TOPIC_REPLIES", [], "any", false, false, false, 145);
                    echo " <dfn>";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("REPLIES");
                    echo "</dfn></dd>
\t\t\t\t\t<dd class=\"views\">";
                    // line 146
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "TOPIC_VIEWS", [], "any", false, false, false, 146);
                    echo " <dfn>";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("VIEWS");
                    echo "</dfn></dd>
\t\t\t\t\t<dd class=\"lastpost\">
\t\t\t\t\t\t<span><dfn>";
                    // line 148
                    echo $this->extensions['phpbb\template\twig\extension']->lang("LAST_POST");
                    echo " </dfn>";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("POST_BY_AUTHOR");
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "LAST_POST_AUTHOR_FULL", [], "any", false, false, false, 148);
                    // line 149
                    echo "\t\t\t\t\t\t\t";
                    if ( !($context["S_IS_BOT"] ?? null)) {
                        // line 150
                        echo "\t\t\t\t\t\t\t\t<a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "U_LAST_POST", [], "any", false, false, false, 150);
                        echo "\" title=\"";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("GOTO_LAST_POST");
                        echo "\">
\t\t\t\t\t\t\t\t\t<i class=\"icon fa-external-link-square fa-fw icon-lightgray icon-md\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                        // line 151
                        echo ($context["VIEW_LATEST_POST"] ?? null);
                        echo "</span>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t";
                    }
                    // line 154
                    echo "\t\t\t\t\t\t\t<br /><time datetime=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "LAST_POST_TIME_RFC3339", [], "any", false, false, false, 154);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "LAST_POST_TIME", [], "any", false, false, false, 154);
                    echo "</time>
\t\t\t\t\t\t</span>
\t\t\t\t\t</dd>
\t\t\t\t\t";
                    // line 157
                    // line 158
                    echo "\t\t\t\t</dl>
\t\t\t</li>
\t\t\t";
                    // line 160
                    // line 161
                    echo "\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['searchresults'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 162
                echo "\t\t</ul>

\t\t</div>
\t</div>
\t";
            } else {
                // line 167
                echo "\t\t<div class=\"panel\">
\t\t\t<div class=\"inner\">
\t\t\t<strong>";
                // line 169
                echo $this->extensions['phpbb\template\twig\extension']->lang("NO_SEARCH_RESULTS");
                echo "</strong>
\t\t\t</div>
\t\t</div>
\t";
            }
            // line 173
            echo "
";
        } else {
            // line 175
            echo "
\t";
            // line 176
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "searchresults", [], "any", false, false, false, 176));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["searchresults"]) {
                // line 177
                echo "\t\t";
                // line 178
                echo "\t\t<div class=\"search post ";
                if ((twig_get_attribute($this->env, $this->source, $context["searchresults"], "S_ROW_COUNT", [], "any", false, false, false, 178) % 2 != 0)) {
                    echo "bg1";
                } else {
                    echo "bg2";
                }
                if (twig_get_attribute($this->env, $this->source, $context["searchresults"], "S_POST_REPORTED", [], "any", false, false, false, 178)) {
                    echo " reported";
                }
                echo "\">
\t\t\t<div class=\"inner\">

\t";
                // line 181
                if (twig_get_attribute($this->env, $this->source, $context["searchresults"], "S_IGNORE_POST", [], "any", false, false, false, 181)) {
                    // line 182
                    echo "\t\t<div class=\"postbody\">
\t\t\t";
                    // line 183
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "L_IGNORE_POST", [], "any", false, false, false, 183);
                    echo "
\t\t</div>
\t";
                } else {
                    // line 186
                    echo "\t\t<dl class=\"postprofile\">
\t\t\t";
                    // line 187
                    // line 188
                    echo "\t\t\t<dt class=\"author\">";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("POST_BY_AUTHOR");
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "POST_AUTHOR_FULL", [], "any", false, false, false, 188);
                    echo "</dt>
\t\t\t<dd class=\"search-result-date\">";
                    // line 189
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "POST_DATE", [], "any", false, false, false, 189);
                    echo "</dd>
\t\t\t<dd>";
                    // line 190
                    echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM");
                    echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                    echo " <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "U_VIEW_FORUM", [], "any", false, false, false, 190);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "FORUM_TITLE", [], "any", false, false, false, 190);
                    echo "</a></dd>
\t\t\t<dd>";
                    // line 191
                    echo $this->extensions['phpbb\template\twig\extension']->lang("TOPIC");
                    echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                    echo " <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "U_VIEW_TOPIC", [], "any", false, false, false, 191);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "TOPIC_TITLE", [], "any", false, false, false, 191);
                    echo "</a></dd>
\t\t\t";
                    // line 192
                    // line 193
                    echo "\t\t\t<dd>";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("REPLIES");
                    echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                    echo " <strong>";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "TOPIC_REPLIES", [], "any", false, false, false, 193);
                    echo "</strong></dd>
\t\t\t<dd>";
                    // line 194
                    echo $this->extensions['phpbb\template\twig\extension']->lang("VIEWS");
                    echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                    echo " <strong>";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "TOPIC_VIEWS", [], "any", false, false, false, 194);
                    echo "</strong></dd>
\t\t\t";
                    // line 195
                    // line 196
                    echo "\t\t</dl>

\t\t<div class=\"postbody\">
\t\t\t";
                    // line 199
                    // line 200
                    echo "\t\t\t<h3><a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "U_VIEW_POST", [], "any", false, false, false, 200);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "POST_SUBJECT", [], "any", false, false, false, 200);
                    echo "</a></h3>
\t\t\t<div class=\"content\">";
                    // line 201
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "MESSAGE", [], "any", false, false, false, 201);
                    echo "</div>
\t\t\t";
                    // line 202
                    // line 203
                    echo "\t\t</div>
\t";
                }
                // line 205
                echo "
\t";
                // line 206
                if ( !twig_get_attribute($this->env, $this->source, $context["searchresults"], "S_IGNORE_POST", [], "any", false, false, false, 206)) {
                    // line 207
                    echo "\t\t<ul class=\"searchresults\">
\t\t\t<li>
\t\t\t\t<a href=\"";
                    // line 209
                    echo twig_get_attribute($this->env, $this->source, $context["searchresults"], "U_VIEW_POST", [], "any", false, false, false, 209);
                    echo "\" class=\"arrow-";
                    echo ($context["S_CONTENT_FLOW_END"] ?? null);
                    echo "\">
\t\t\t\t\t<i class=\"icon fa-angle-";
                    // line 210
                    echo ($context["S_CONTENT_FLOW_END"] ?? null);
                    echo " fa-fw icon-black\" aria-hidden=\"true\"></i><span>";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("JUMP_TO_POST");
                    echo "</span>
\t\t\t\t</a>
\t\t\t</li>
\t\t</ul>
\t";
                }
                // line 215
                echo "
\t\t\t</div>
\t\t</div>
\t\t";
                // line 218
                // line 219
                echo "\t";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 220
                echo "\t\t<div class=\"panel\">
\t\t\t<div class=\"inner\">
\t\t\t<strong>";
                // line 222
                echo $this->extensions['phpbb\template\twig\extension']->lang("NO_SEARCH_RESULTS");
                echo "</strong>
\t\t\t</div>
\t\t</div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['searchresults'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 227
        echo "
<div class=\"action-bar bottom\">
\t";
        // line 229
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "searchresults", [], "any", false, false, false, 229)) && (($context["S_SELECT_SORT_DAYS"] ?? null) || ($context["S_SELECT_SORT_KEY"] ?? null)))) {
            // line 230
            echo "\t<form method=\"post\" action=\"";
            echo ($context["S_SEARCH_ACTION"] ?? null);
            echo "\">
\t\t";
            // line 231
            $location = "display_options.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("display_options.html", "search_results.html", 231)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 232
            echo "\t</form>
\t\t";
        }
        // line 234
        echo "
\t<div class=\"pagination\">
\t\t";
        // line 236
        echo ($context["SEARCH_MATCHES"] ?? null);
        echo "
\t\t";
        // line 237
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pagination", [], "any", false, false, false, 237))) {
            // line 238
            echo "\t\t\t";
            $location = "pagination.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("pagination.html", "search_results.html", 238)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 239
            echo "\t\t";
        } else {
            // line 240
            echo "\t\t\t &bull; ";
            echo ($context["PAGE_NUMBER"] ?? null);
            echo "
\t\t";
        }
        // line 242
        echo "\t</div>
</div>
";
        // line 244
        // line 245
        $location = "jumpbox.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("jumpbox.html", "search_results.html", 245)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 246
        echo "
";
        // line 247
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "search_results.html", 247)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "search_results.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  851 => 247,  848 => 246,  836 => 245,  835 => 244,  831 => 242,  825 => 240,  822 => 239,  809 => 238,  807 => 237,  803 => 236,  799 => 234,  795 => 232,  783 => 231,  778 => 230,  776 => 229,  772 => 227,  761 => 222,  757 => 220,  752 => 219,  751 => 218,  746 => 215,  736 => 210,  730 => 209,  726 => 207,  724 => 206,  721 => 205,  717 => 203,  716 => 202,  712 => 201,  705 => 200,  704 => 199,  699 => 196,  698 => 195,  691 => 194,  683 => 193,  682 => 192,  673 => 191,  664 => 190,  660 => 189,  653 => 188,  652 => 187,  649 => 186,  643 => 183,  640 => 182,  638 => 181,  624 => 178,  622 => 177,  617 => 176,  614 => 175,  610 => 173,  603 => 169,  599 => 167,  592 => 162,  586 => 161,  585 => 160,  581 => 158,  580 => 157,  571 => 154,  565 => 151,  558 => 150,  555 => 149,  549 => 148,  542 => 146,  536 => 145,  532 => 143,  531 => 142,  528 => 141,  523 => 138,  517 => 137,  507 => 135,  505 => 134,  499 => 133,  492 => 132,  489 => 131,  485 => 130,  480 => 127,  478 => 126,  474 => 124,  473 => 123,  456 => 122,  454 => 121,  449 => 120,  445 => 119,  441 => 117,  438 => 116,  429 => 115,  418 => 113,  402 => 112,  399 => 111,  397 => 110,  394 => 109,  393 => 108,  390 => 107,  384 => 104,  377 => 103,  374 => 102,  368 => 99,  361 => 98,  358 => 97,  352 => 94,  345 => 93,  343 => 92,  336 => 91,  330 => 88,  325 => 87,  322 => 86,  321 => 85,  318 => 84,  312 => 83,  301 => 82,  297 => 81,  288 => 80,  286 => 79,  282 => 78,  275 => 73,  274 => 72,  270 => 71,  266 => 70,  262 => 69,  258 => 68,  250 => 62,  248 => 61,  245 => 60,  243 => 59,  240 => 58,  235 => 55,  229 => 53,  226 => 52,  213 => 51,  211 => 50,  206 => 49,  198 => 48,  194 => 46,  193 => 45,  190 => 44,  181 => 38,  175 => 37,  170 => 35,  166 => 34,  162 => 33,  157 => 31,  154 => 30,  152 => 29,  148 => 27,  146 => 26,  143 => 25,  142 => 24,  139 => 23,  130 => 19,  122 => 18,  119 => 17,  110 => 13,  104 => 12,  101 => 11,  99 => 10,  96 => 9,  90 => 8,  81 => 7,  72 => 6,  56 => 5,  53 => 4,  52 => 3,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "search_results.html", "");
    }
}
