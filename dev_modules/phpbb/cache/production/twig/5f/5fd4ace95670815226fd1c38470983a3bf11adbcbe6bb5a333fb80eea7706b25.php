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

/* memberlist_search.html */
class __TwigTemplate_7d939c0b487333a5a27687e759c692b033d3150672ef9fac09832cf844ecf05c extends \Twig\Template
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
        echo "<h2 class=\"solo\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("FIND_USERNAME");
        echo "</h2>

<form method=\"post\" action=\"";
        // line 3
        echo ($context["S_MODE_ACTION"] ?? null);
        echo "\" id=\"search_memberlist\">
<div class=\"panel\">
\t<div class=\"inner\">

\t<p>";
        // line 7
        echo $this->extensions['phpbb\template\twig\extension']->lang("FIND_USERNAME_EXPLAIN");
        echo "</p>

\t";
        // line 9
        // line 10
        echo "\t<fieldset class=\"fields1 column1\">
\t<dl style=\"overflow: visible;\">
\t\t<dt><label for=\"username\">";
        // line 12
        echo $this->extensions['phpbb\template\twig\extension']->lang("USERNAME");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label></dt>
\t\t<dd>
\t\t\t";
        // line 14
        if (($context["U_LIVE_SEARCH"] ?? null)) {
            echo "<div class=\"dropdown-container dropdown-";
            echo ($context["S_CONTENT_FLOW_END"] ?? null);
            echo "\">";
        }
        // line 15
        echo "\t\t\t<input type=\"text\" name=\"username\" id=\"username\" value=\"";
        echo ($context["USERNAME"] ?? null);
        echo "\" class=\"inputbox\"";
        if (($context["U_LIVE_SEARCH"] ?? null)) {
            echo " autocomplete=\"off\" data-filter=\"phpbb.search.filter\" data-ajax=\"member_search\" data-min-length=\"3\" data-url=\"";
            echo ($context["U_LIVE_SEARCH"] ?? null);
            echo "\" data-results=\"#user-search\"";
        }
        echo " />
\t\t\t";
        // line 16
        if (($context["U_LIVE_SEARCH"] ?? null)) {
            // line 17
            echo "\t\t\t\t<div class=\"dropdown live-search hidden\" id=\"user-search\">
\t\t\t\t\t<div class=\"pointer\"><div class=\"pointer-inner\"></div></div>
\t\t\t\t\t<ul class=\"dropdown-contents search-results\">
\t\t\t\t\t\t<li class=\"search-result-tpl\"><span class=\"search-result\"></span></li>
\t\t\t\t\t</ul>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t";
        }
        // line 25
        echo "\t\t</dd>
\t</dl>
";
        // line 27
        if (($context["S_EMAIL_SEARCH_ALLOWED"] ?? null)) {
            // line 28
            echo "\t<dl>
\t\t<dt><label for=\"email\">";
            // line 29
            echo $this->extensions['phpbb\template\twig\extension']->lang("EMAIL");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t<dd><input type=\"text\" name=\"email\" id=\"email\" value=\"";
            // line 30
            echo ($context["EMAIL"] ?? null);
            echo "\" class=\"inputbox\" /></dd>
\t</dl>
";
        }
        // line 33
        if (($context["S_JABBER_ENABLED"] ?? null)) {
            // line 34
            echo "\t<dl>
\t\t<dt><label for=\"jabber\">";
            // line 35
            echo $this->extensions['phpbb\template\twig\extension']->lang("JABBER");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t<dd><input type=\"text\" name=\"jabber\" id=\"jabber\" value=\"";
            // line 36
            echo ($context["JABBER"] ?? null);
            echo "\" class=\"inputbox\" /></dd>
\t</dl>
";
        }
        // line 39
        echo "\t<dl>
\t\t<dt><label for=\"search_group_id\">";
        // line 40
        echo $this->extensions['phpbb\template\twig\extension']->lang("GROUP");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label></dt>
\t\t<dd><select name=\"search_group_id\" id=\"search_group_id\">";
        // line 41
        echo ($context["S_GROUP_SELECT"] ?? null);
        echo "</select></dd>
\t</dl>
\t";
        // line 43
        // line 44
        echo "\t<dl>
\t\t<dt><label for=\"sk\" class=\"label3\">";
        // line 45
        echo $this->extensions['phpbb\template\twig\extension']->lang("SORT_BY");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label></dt>
\t\t<dd><select name=\"sk\" id=\"sk\">";
        // line 46
        echo ($context["S_SORT_OPTIONS"] ?? null);
        echo "</select> <select name=\"sd\">";
        echo ($context["S_ORDER_SELECT"] ?? null);
        echo "</select></dd>
\t</dl>
\t</fieldset>

\t<fieldset class=\"fields1 column2\">
\t<dl>
\t\t<dt><label for=\"joined\">";
        // line 52
        echo $this->extensions['phpbb\template\twig\extension']->lang("JOINED");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label></dt>
\t\t<dd><select name=\"joined_select\">";
        // line 53
        echo ($context["S_JOINED_TIME_OPTIONS"] ?? null);
        echo "</select> <input class=\"inputbox medium\" type=\"text\" name=\"joined\" id=\"joined\" value=\"";
        echo ($context["JOINED"] ?? null);
        echo "\" /></dd>
\t</dl>
";
        // line 55
        if (($context["S_VIEWONLINE"] ?? null)) {
            // line 56
            echo "\t<dl>
\t\t<dt><label for=\"active\">";
            // line 57
            echo $this->extensions['phpbb\template\twig\extension']->lang("LAST_ACTIVE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t<dd><select name=\"active_select\">";
            // line 58
            echo ($context["S_ACTIVE_TIME_OPTIONS"] ?? null);
            echo "</select> <input class=\"inputbox medium\" type=\"text\" name=\"active\" id=\"active\" value=\"";
            echo ($context["ACTIVE"] ?? null);
            echo "\" /></dd>
\t</dl>
";
        }
        // line 61
        echo "\t<dl>
\t\t<dt><label for=\"count\">";
        // line 62
        echo $this->extensions['phpbb\template\twig\extension']->lang("POSTS");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label></dt>
\t\t<dd><select name=\"count_select\">";
        // line 63
        echo ($context["S_COUNT_OPTIONS"] ?? null);
        echo "</select> <input class=\"inputbox medium\" type=\"number\" min=\"0\" name=\"count\" id=\"count\" value=\"";
        echo ($context["COUNT"] ?? null);
        echo "\" /></dd>
\t</dl>
";
        // line 65
        if (($context["S_IP_SEARCH_ALLOWED"] ?? null)) {
            // line 66
            echo "\t<dl>
\t\t<dt><label for=\"ip\">";
            // line 67
            echo $this->extensions['phpbb\template\twig\extension']->lang("POST_IP");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t<dd><input class=\"inputbox medium\" type=\"text\" name=\"ip\" id=\"ip\" value=\"";
            // line 68
            echo ($context["IP"] ?? null);
            echo "\" /></dd>
\t</dl>
";
        }
        // line 71
        echo "\t";
        // line 72
        echo "\t</fieldset>

\t<div class=\"clear\"></div>

\t<hr />

\t<fieldset class=\"submit-buttons\">
\t\t<input type=\"submit\" name=\"submit\" value=\"";
        // line 79
        echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH");
        echo "\" class=\"button1\" />
\t\t";
        // line 80
        echo ($context["S_FORM_TOKEN"] ?? null);
        echo "
\t</fieldset>

\t</div>
</div>

</form>
";
    }

    public function getTemplateName()
    {
        return "memberlist_search.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  240 => 80,  236 => 79,  227 => 72,  225 => 71,  219 => 68,  214 => 67,  211 => 66,  209 => 65,  202 => 63,  197 => 62,  194 => 61,  186 => 58,  181 => 57,  178 => 56,  176 => 55,  169 => 53,  164 => 52,  153 => 46,  148 => 45,  145 => 44,  144 => 43,  139 => 41,  134 => 40,  131 => 39,  125 => 36,  120 => 35,  117 => 34,  115 => 33,  109 => 30,  104 => 29,  101 => 28,  99 => 27,  95 => 25,  85 => 17,  83 => 16,  72 => 15,  66 => 14,  60 => 12,  56 => 10,  55 => 9,  50 => 7,  43 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "memberlist_search.html", "");
    }
}
