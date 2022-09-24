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

/* overall_header.html */
class __TwigTemplate_de24651eaa160d9520e68ced14d0902696460d854fbbb0097b1de8be9218b6bc extends \Twig\Template
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
        echo "<!DOCTYPE html>
<html dir=\"";
        // line 2
        echo ($context["S_CONTENT_DIRECTION"] ?? null);
        echo "\" lang=\"";
        echo ($context["S_USER_LANG"] ?? null);
        echo "\">
<head>
<meta charset=\"utf-8\">
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />
";
        // line 7
        if (($context["META"] ?? null)) {
            echo ($context["META"] ?? null);
        }
        // line 8
        echo "<title>";
        echo ($context["PAGE_TITLE"] ?? null);
        echo "</title>

<link href=\"";
        // line 10
        echo ($context["T_FONT_AWESOME_LINK"] ?? null);
        echo "\" rel=\"stylesheet\">
<link href=\"style/admin.css?assets_version=";
        // line 11
        echo ($context["T_ASSETS_VERSION"] ?? null);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />

<script>
// <![CDATA[
var jump_page = \"";
        // line 15
        echo ($this->extensions['phpbb\template\twig\extension']->lang_js("JUMP_PAGE") . $this->extensions['phpbb\template\twig\extension']->lang_js("COLON"));
        echo "\";
var on_page = '";
        // line 16
        echo ($context["CURRENT_PAGE"] ?? null);
        echo "';
var per_page = '";
        // line 17
        echo ($context["PER_PAGE"] ?? null);
        echo "';
var base_url = \"";
        // line 18
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "js");
        echo "\";

/**
* Jump to page
*/
function jumpto()
{
\tvar page = prompt(jump_page, on_page);

\tif (page !== null && !isNaN(page) && page == Math.floor(page) && page > 0)
\t{
\t\tif (base_url.indexOf('?') == -1)
\t\t{
\t\t\tdocument.location.href = base_url + '?start=' + ((page - 1) * per_page);
\t\t}
\t\telse
\t\t{
\t\t\tdocument.location.href = base_url.replace(/&amp;/g, '&') + '&start=' + ((page - 1) * per_page);
\t\t}
\t}
}

/**
* Mark/unmark checkboxes
* id = ID of parent container, name = name prefix, state = state [true/false]
*/
function marklist(id, name, state)
{
\tvar parent = document.getElementById(id) || document[id];

\tif (!parent)
\t{
\t\treturn;
\t}

\tvar rb = parent.getElementsByTagName('input');

\tfor (var r = 0; r < rb.length; r++)
\t{
\t\tif (rb[r].name.substr(0, name.length) == name && rb[r].disabled !== true)
\t\t{
\t\t\trb[r].checked = state;
\t\t}
\t}
}

/**
* Find a member
*/
function find_username(url)
{
\tpopup(url, 760, 570, '_usersearch');
\treturn false;
}

/**
* Window popup
*/
function popup(url, width, height, name)
{
\tif (!name)
\t{
\t\tname = '_popup';
\t}

\twindow.open(url.replace(/&amp;/g, '&'), name, 'height=' + height + ',resizable=yes,scrollbars=yes, width=' + width);
\treturn false;
}

// ]]>
</script>

";
        // line 90
        // line 91
        echo "
";
        // line 92
        echo twig_get_attribute($this->env, $this->source, ($context["definition"] ?? null), "STYLESHEETS", [], "any", false, false, false, 92);
        echo "

";
        // line 94
        // line 95
        echo "
</head>

<body class=\"";
        // line 98
        echo ($context["S_CONTENT_DIRECTION"] ?? null);
        echo " ";
        echo ($context["BODY_CLASS"] ?? null);
        echo " nojs\">

";
        // line 100
        // line 101
        echo "
<div id=\"wrap\">
\t<div id=\"page-header\">
\t\t<h1>";
        // line 104
        echo $this->extensions['phpbb\template\twig\extension']->lang("ADMIN_PANEL");
        echo "</h1>
\t\t<p><a href=\"";
        // line 105
        echo ($context["U_ADM_INDEX"] ?? null);
        echo "\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("ADMIN_INDEX");
        echo "</a> &bull; <a href=\"";
        echo ($context["U_INDEX"] ?? null);
        echo "\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_INDEX");
        echo "</a></p>
\t\t<p id=\"skip\"><a href=\"#acp\">";
        // line 106
        echo $this->extensions['phpbb\template\twig\extension']->lang("SKIP");
        echo "</a></p>
\t</div>

\t<div id=\"page-body\">
\t\t<div id=\"tabs\">
\t\t\t<ul>
\t\t\t";
        // line 112
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "t_block1", [], "any", false, false, false, 112));
        foreach ($context['_seq'] as $context["_key"] => $context["t_block1"]) {
            // line 113
            echo "\t\t\t\t<li class=\"tab";
            if (twig_get_attribute($this->env, $this->source, $context["t_block1"], "S_SELECTED", [], "any", false, false, false, 113)) {
                echo " activetab";
            }
            echo "\"><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["t_block1"], "U_TITLE", [], "any", false, false, false, 113);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["t_block1"], "L_TITLE", [], "any", false, false, false, 113);
            echo "</a></li>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['t_block1'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 115
        echo "\t\t\t</ul>
\t\t</div>

\t\t<div id=\"acp\">
\t\t\t\t<div id=\"content\">
\t\t\t\t\t<div id=\"menu\">
\t\t\t\t\t\t<p>";
        // line 121
        echo $this->extensions['phpbb\template\twig\extension']->lang("LOGGED_IN_AS");
        echo "<br /><strong>";
        echo ($context["USERNAME"] ?? null);
        echo "</strong> [&nbsp;<a href=\"";
        echo ($context["U_LOGOUT"] ?? null);
        echo "\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("LOGOUT");
        echo "</a>&nbsp;][&nbsp;<a href=\"";
        echo ($context["U_ADM_LOGOUT"] ?? null);
        echo "\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("ADM_LOGOUT");
        echo "</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
\t\t\t\t\t\t";
        // line 122
        $value = 0;
        $context['definition']->set('LI_USED', $value);
        // line 123
        echo "\t\t\t\t\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "l_block1", [], "any", false, false, false, 123));
        foreach ($context['_seq'] as $context["_key"] => $context["l_block1"]) {
            // line 124
            echo "\t\t\t\t\t\t\t";
            if (twig_get_attribute($this->env, $this->source, $context["l_block1"], "S_SELECTED", [], "any", false, false, false, 124)) {
                // line 125
                echo "
\t\t\t\t\t\t";
                // line 126
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["l_block1"], "l_block2", [], "any", false, false, false, 126));
                foreach ($context['_seq'] as $context["_key"] => $context["l_block2"]) {
                    // line 127
                    echo "\t\t\t\t\t\t\t";
                    if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["l_block2"], "l_block3", [], "any", false, false, false, 127))) {
                        // line 128
                        echo "\t\t\t\t\t\t\t";
                        if (twig_get_attribute($this->env, $this->source, ($context["definition"] ?? null), "LI_USED", [], "any", false, false, false, 128)) {
                            echo "</ul></div>";
                        }
                        // line 129
                        echo "\t\t\t\t\t\t\t<div class=\"menu-block\">
\t\t\t\t\t\t\t\t<a class=\"header\" href=\"javascript:void(0);\">";
                        // line 130
                        echo twig_get_attribute($this->env, $this->source, $context["l_block2"], "L_TITLE", [], "any", false, false, false, 130);
                        echo "</a>
\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t";
                        // line 132
                        $value = 1;
                        $context['definition']->set('LI_USED', $value);
                        // line 133
                        echo "\t\t\t\t\t\t\t";
                    }
                    // line 134
                    echo "
\t\t\t\t\t\t\t";
                    // line 135
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["l_block2"], "l_block3", [], "any", false, false, false, 135));
                    foreach ($context['_seq'] as $context["_key"] => $context["l_block3"]) {
                        // line 136
                        echo "\t\t\t\t\t\t\t\t<li";
                        if (twig_get_attribute($this->env, $this->source, $context["l_block3"], "S_SELECTED", [], "any", false, false, false, 136)) {
                            echo " id=\"activemenu\"";
                        }
                        echo "><a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["l_block3"], "U_TITLE", [], "any", false, false, false, 136);
                        echo "\"><span>";
                        echo twig_get_attribute($this->env, $this->source, $context["l_block3"], "L_TITLE", [], "any", false, false, false, 136);
                        echo "</span></a></li>
\t\t\t\t\t\t\t\t";
                        // line 137
                        $value = 1;
                        $context['definition']->set('LI_USED', $value);
                        // line 138
                        echo "\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['l_block3'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 139
                    echo "\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['l_block2'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 140
                echo "
\t\t\t\t\t\t\t";
            }
            // line 142
            echo "\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['l_block1'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 143
        echo "\t\t\t\t\t\t";
        if (twig_get_attribute($this->env, $this->source, ($context["definition"] ?? null), "LI_USED", [], "any", false, false, false, 143)) {
            // line 144
            echo "\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
        }
        // line 147
        echo "\t\t\t\t\t</div>

\t\t\t\t\t<div id=\"main\">
\t\t\t\t\t\t<div class=\"main\">
\t\t\t\t\t\t\t";
        // line 151
        if ((($context["CONTAINER_EXCEPTION"] ?? null) !== false)) {
            // line 152
            echo "\t\t\t\t\t\t\t<div class=\"errorbox\">
\t\t\t\t\t\t\t\t<p>";
            // line 153
            echo $this->extensions['phpbb\template\twig\extension']->lang("CONTAINER_EXCEPTION");
            echo "</p><br />
\t\t\t\t\t\t\t\t<p>";
            // line 154
            echo $this->extensions['phpbb\template\twig\extension']->lang("EXCEPTION");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo " ";
            echo twig_get_attribute($this->env, $this->source, ($context["CONTAINER_EXCEPTION"] ?? null), "getMessage", [], "method", false, false, false, 154);
            echo "</p>
\t\t\t\t\t\t\t\t<pre>";
            // line 155
            echo twig_get_attribute($this->env, $this->source, ($context["CONTAINER_EXCEPTION"] ?? null), "getTraceAsString", [], "method", false, false, false, 155);
            echo "</pre>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
        }
    }

    public function getTemplateName()
    {
        return "overall_header.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  363 => 155,  356 => 154,  352 => 153,  349 => 152,  347 => 151,  341 => 147,  336 => 144,  333 => 143,  327 => 142,  323 => 140,  317 => 139,  311 => 138,  308 => 137,  297 => 136,  293 => 135,  290 => 134,  287 => 133,  284 => 132,  279 => 130,  276 => 129,  271 => 128,  268 => 127,  264 => 126,  261 => 125,  258 => 124,  253 => 123,  250 => 122,  236 => 121,  228 => 115,  213 => 113,  209 => 112,  200 => 106,  190 => 105,  186 => 104,  181 => 101,  180 => 100,  173 => 98,  168 => 95,  167 => 94,  162 => 92,  159 => 91,  158 => 90,  83 => 18,  79 => 17,  75 => 16,  71 => 15,  64 => 11,  60 => 10,  54 => 8,  50 => 7,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "overall_header.html", "");
    }
}
