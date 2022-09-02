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

/* acp_search.html */
class __TwigTemplate_9d51c7ff9cb742bac9a4a738362e41b848313cdfdda85dc229f4561a06e59d64 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_search.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

";
        // line 5
        if (($context["S_SETTINGS"] ?? null)) {
            // line 6
            echo "\t<h1>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_SEARCH_SETTINGS");
            echo "</h1>

\t<p>";
            // line 8
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_SEARCH_SETTINGS_EXPLAIN");
            echo "</p>

\t<form id=\"acp_search\" method=\"post\" action=\"";
            // line 10
            echo ($context["U_ACTION"] ?? null);
            echo "\">

\t<fieldset>
\t\t<legend>";
            // line 13
            echo $this->extensions['phpbb\template\twig\extension']->lang("GENERAL_SEARCH_SETTINGS");
            echo "</legend>
\t<dl>
\t\t<dt><label for=\"load_search\">";
            // line 15
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES_SEARCH");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES_SEARCH_EXPLAIN");
            echo "</span></dt>
\t\t<dd><label><input type=\"radio\" class=\"radio\" id=\"load_search\" name=\"config[load_search]\" value=\"1\"";
            // line 16
            if (($context["S_YES_SEARCH"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"config[load_search]\" value=\"0\"";
            // line 17
            if ( !($context["S_YES_SEARCH"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"search_interval\">";
            // line 20
            echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_INTERVAL");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_INTERVAL_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input id=\"search_interval\" type=\"number\" min=\"0\" max=\"9999\" name=\"config[search_interval]\" value=\"";
            // line 21
            echo ($context["SEARCH_INTERVAL"] ?? null);
            echo "\" /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("SECONDS");
            echo "</dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"search_anonymous_interval\">";
            // line 24
            echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_GUEST_INTERVAL");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_GUEST_INTERVAL_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input id=\"search_anonymous_interval\" type=\"number\" min=\"0\" max=\"9999\" name=\"config[search_anonymous_interval]\" value=\"";
            // line 25
            echo ($context["SEARCH_GUEST_INTERVAL"] ?? null);
            echo "\" /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("SECONDS");
            echo "</dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"limit_search_load\">";
            // line 28
            echo $this->extensions['phpbb\template\twig\extension']->lang("LIMIT_SEARCH_LOAD");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("LIMIT_SEARCH_LOAD_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input id=\"limit_search_load\" type=\"text\" size=\"4\" maxlength=\"4\" name=\"config[limit_search_load]\" value=\"";
            // line 29
            echo ($context["LIMIT_SEARCH_LOAD"] ?? null);
            echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"min_search_author_chars\">";
            // line 32
            echo $this->extensions['phpbb\template\twig\extension']->lang("MIN_SEARCH_AUTHOR_CHARS");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("MIN_SEARCH_AUTHOR_CHARS_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input id=\"min_search_author_chars\" type=\"number\" min=\"0\" max=\"9999\" name=\"config[min_search_author_chars]\" value=\"";
            // line 33
            echo ($context["MIN_SEARCH_AUTHOR_CHARS"] ?? null);
            echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"max_num_search_keywords\">";
            // line 36
            echo $this->extensions['phpbb\template\twig\extension']->lang("MAX_NUM_SEARCH_KEYWORDS");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("MAX_NUM_SEARCH_KEYWORDS_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input id=\"max_num_search_keywords\" type=\"number\" min=\"0\" max=\"9999\" name=\"config[max_num_search_keywords]\" value=\"";
            // line 37
            echo ($context["MAX_NUM_SEARCH_KEYWORDS"] ?? null);
            echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt>
\t\t\t<label for=\"default_search_return_chars\">";
            // line 41
            echo ($this->extensions['phpbb\template\twig\extension']->lang("DEFAULT_SEARCH_RETURN_CHARS") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</label>
\t\t\t<br><span>";
            // line 42
            echo $this->extensions['phpbb\template\twig\extension']->lang("DEFAULT_SEARCH_RETURN_CHARS_EXPLAIN");
            echo "</span>
\t\t</dt>
\t\t<dd><input id=\"default_search_return_chars\" name=\"config[default_search_return_chars]\" type=\"number\" value=\"";
            // line 44
            echo ($context["DEFAULT_SEARCH_RETURN_CHARS"] ?? null);
            echo "\" min=\"0\" max=\"9999\"></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"search_store_results\">";
            // line 47
            echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_STORE_RESULTS");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_STORE_RESULTS_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input id=\"search_store_results\" type=\"number\" min=\"0\" max=\"999999\" name=\"config[search_store_results]\" value=\"";
            // line 48
            echo ($context["SEARCH_STORE_RESULTS"] ?? null);
            echo "\" /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("SECONDS");
            echo "</dd>
\t</dl>
\t</fieldset>

\t<fieldset>
\t\t<legend>";
            // line 53
            echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_TYPE");
            echo "</legend>
\t<dl>
\t\t<dt><label for=\"search_type\">";
            // line 55
            echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_TYPE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_TYPE_EXPLAIN");
            echo "</span></dt>
\t\t<dd><select id=\"search_type\" name=\"config[search_type]\" data-togglable-settings=\"true\">";
            // line 56
            echo ($context["S_SEARCH_TYPES"] ?? null);
            echo "</select></dd>
\t</dl>
\t</fieldset>

\t";
            // line 60
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "backend", [], "any", false, false, false, 60));
            foreach ($context['_seq'] as $context["_key"] => $context["backend"]) {
                // line 61
                echo "
\t\t<fieldset id=\"search_";
                // line 62
                echo twig_get_attribute($this->env, $this->source, $context["backend"], "IDENTIFIER", [], "any", false, false, false, 62);
                echo "_settings\">
\t\t\t<legend>";
                // line 63
                echo twig_get_attribute($this->env, $this->source, $context["backend"], "NAME", [], "any", false, false, false, 63);
                echo "</legend>
\t\t";
                // line 64
                echo twig_get_attribute($this->env, $this->source, $context["backend"], "SETTINGS", [], "any", false, false, false, 64);
                echo "
\t\t</fieldset>

\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['backend'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 68
            echo "
\t<fieldset>
\t\t<legend>";
            // line 70
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_SUBMIT_CHANGES");
            echo "</legend>
\t\t<p class=\"submit-buttons\">
\t\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
            // line 72
            echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
            echo "\" />&nbsp;
\t\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
            // line 73
            echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
            echo "\" />
\t\t</p>
\t\t";
            // line 75
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t</form>

";
        } elseif (        // line 79
($context["S_INDEX"] ?? null)) {
            // line 80
            echo "
\t<script>
\t// <![CDATA[
\t\t/**
\t\t* Popup search progress bar
\t\t*/
\t\tfunction popup_progress_bar(progress_type)
\t\t{
\t\t\tclose_waitscreen = 0;
\t\t\t// no scrollbars
\t\t\tpopup('";
            // line 90
            echo ($context["UA_PROGRESS_BAR"] ?? null);
            echo "&amp;type=' + progress_type, 400, 240, '_index');
\t\t}
\t// ]]>
\t</script>

\t<h1>";
            // line 95
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_SEARCH_INDEX");
            echo "</h1>

\t";
            // line 97
            if (($context["S_CONTINUE_INDEXING"] ?? null)) {
                // line 98
                echo "\t\t<p>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("CONTINUE_EXPLAIN");
                echo "</p>

\t\t<form id=\"acp_search_continue\" method=\"post\" action=\"";
                // line 100
                echo ($context["U_CONTINUE_INDEXING"] ?? null);
                echo "\">
\t\t\t<fieldset>
\t\t\t\t<legend>";
                // line 102
                echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_SUBMIT_CHANGES");
                echo "</legend>
\t\t\t\t<p class=\"submit-buttons\">
\t\t\t\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
                // line 104
                echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
                echo "\" />&nbsp;
\t\t\t\t\t<input class=\"button2\" type=\"submit\" id=\"cancel\" name=\"cancel\" value=\"";
                // line 105
                echo $this->extensions['phpbb\template\twig\extension']->lang("CANCEL");
                echo "\" />
\t\t\t\t</p>
\t\t\t\t";
                // line 107
                echo ($context["S_FORM_TOKEN"] ?? null);
                echo "
\t\t\t</fieldset>
\t\t</form>
\t";
            } else {
                // line 111
                echo "
\t\t<p>";
                // line 112
                echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_SEARCH_INDEX_EXPLAIN");
                echo "</p>

\t\t";
                // line 114
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "backend", [], "any", false, false, false, 114));
                foreach ($context['_seq'] as $context["_key"] => $context["backend"]) {
                    // line 115
                    echo "
\t\t\t";
                    // line 116
                    if (twig_get_attribute($this->env, $this->source, $context["backend"], "S_STATS", [], "any", false, false, false, 116)) {
                        // line 117
                        echo "
\t\t\t<form id=\"acp_search_index_";
                        // line 118
                        echo twig_get_attribute($this->env, $this->source, $context["backend"], "NAME", [], "any", false, false, false, 118);
                        echo "\" method=\"post\" action=\"";
                        echo ($context["U_ACTION"] ?? null);
                        echo "\">

\t\t\t\t<fieldset class=\"tabulated\">

\t\t\t\t";
                        // line 122
                        echo twig_get_attribute($this->env, $this->source, $context["backend"], "S_HIDDEN_FIELDS", [], "any", false, false, false, 122);
                        echo "

\t\t\t\t<legend>";
                        // line 124
                        echo $this->extensions['phpbb\template\twig\extension']->lang("INDEX_STATS");
                        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                        echo " ";
                        echo twig_get_attribute($this->env, $this->source, $context["backend"], "L_NAME", [], "any", false, false, false, 124);
                        echo " ";
                        if (twig_get_attribute($this->env, $this->source, $context["backend"], "S_ACTIVE", [], "any", false, false, false, 124)) {
                            echo "(";
                            echo $this->extensions['phpbb\template\twig\extension']->lang("ACTIVE");
                            echo ") ";
                        }
                        echo "</legend>

\t\t\t\t<table class=\"table1\">
\t\t\t\t\t<caption>";
                        // line 127
                        echo twig_get_attribute($this->env, $this->source, $context["backend"], "L_NAME", [], "any", false, false, false, 127);
                        echo " ";
                        if (twig_get_attribute($this->env, $this->source, $context["backend"], "S_ACTIVE", [], "any", false, false, false, 127)) {
                            echo "(";
                            echo $this->extensions['phpbb\template\twig\extension']->lang("ACTIVE");
                            echo ") ";
                        }
                        echo "</caption>
\t\t\t\t\t<col class=\"col1\" /><col class=\"col2\" /><col class=\"col1\" /><col class=\"col2\" />
\t\t\t\t<thead>
\t\t\t\t<tr>
\t\t\t\t\t<th>";
                        // line 131
                        echo $this->extensions['phpbb\template\twig\extension']->lang("STATISTIC");
                        echo "</th>
\t\t\t\t\t<th>";
                        // line 132
                        echo $this->extensions['phpbb\template\twig\extension']->lang("VALUE");
                        echo "</th>
\t\t\t\t\t<th>";
                        // line 133
                        echo $this->extensions['phpbb\template\twig\extension']->lang("STATISTIC");
                        echo "</th>
\t\t\t\t\t<th>";
                        // line 134
                        echo $this->extensions['phpbb\template\twig\extension']->lang("VALUE");
                        echo "</th>
\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<tbody>
\t\t\t\t";
                        // line 138
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["backend"], "data", [], "any", false, false, false, 138));
                        foreach ($context['_seq'] as $context["_key"] => $context["data"]) {
                            // line 139
                            echo "\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
                            // line 140
                            echo twig_get_attribute($this->env, $this->source, $context["data"], "STATISTIC_1", [], "any", false, false, false, 140);
                            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                            echo "</td>
\t\t\t\t\t\t<td>";
                            // line 141
                            echo twig_get_attribute($this->env, $this->source, $context["data"], "VALUE_1", [], "any", false, false, false, 141);
                            echo "</td>
\t\t\t\t\t\t<td>";
                            // line 142
                            echo twig_get_attribute($this->env, $this->source, $context["data"], "STATISTIC_2", [], "any", false, false, false, 142);
                            if (twig_get_attribute($this->env, $this->source, $context["data"], "STATISTIC_2", [], "any", false, false, false, 142)) {
                                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                            }
                            echo "</td>
\t\t\t\t\t\t<td>";
                            // line 143
                            echo twig_get_attribute($this->env, $this->source, $context["data"], "VALUE_2", [], "any", false, false, false, 143);
                            echo "</td>
\t\t\t\t\t</tr>
\t\t\t\t";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['data'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 146
                        echo "\t\t\t\t</tbody>
\t\t\t\t</table>

\t\t\t";
                    }
                    // line 150
                    echo "
\t\t\t<p class=\"quick\">
\t\t\t";
                    // line 152
                    if (twig_get_attribute($this->env, $this->source, $context["backend"], "S_INDEXED", [], "any", false, false, false, 152)) {
                        // line 153
                        echo "\t\t\t\t<input type=\"hidden\" name=\"action\" value=\"delete\" />
\t\t\t\t<input class=\"button2\" type=\"submit\" value=\"";
                        // line 154
                        echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE_INDEX");
                        echo "\" onclick=\"popup_progress_bar('delete');\" />
\t\t\t";
                    } else {
                        // line 156
                        echo "\t\t\t\t<input type=\"hidden\" name=\"action\" value=\"create\" />
\t\t\t\t<input class=\"button2\" type=\"submit\" value=\"";
                        // line 157
                        echo $this->extensions['phpbb\template\twig\extension']->lang("CREATE_INDEX");
                        echo "\" onclick=\"popup_progress_bar('create');\" />
\t\t\t";
                    }
                    // line 159
                    echo "\t\t\t</p>
\t\t\t";
                    // line 160
                    echo ($context["S_FORM_TOKEN"] ?? null);
                    echo "
\t\t\t</fieldset>

\t\t\t</form>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['backend'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 165
                echo "
\t";
            }
            // line 167
            echo "
";
        }
        // line 169
        echo "
";
        // line 170
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_search.html", 170)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_search.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  501 => 170,  498 => 169,  494 => 167,  490 => 165,  479 => 160,  476 => 159,  471 => 157,  468 => 156,  463 => 154,  460 => 153,  458 => 152,  454 => 150,  448 => 146,  439 => 143,  432 => 142,  428 => 141,  423 => 140,  420 => 139,  416 => 138,  409 => 134,  405 => 133,  401 => 132,  397 => 131,  384 => 127,  369 => 124,  364 => 122,  355 => 118,  352 => 117,  350 => 116,  347 => 115,  343 => 114,  338 => 112,  335 => 111,  328 => 107,  323 => 105,  319 => 104,  314 => 102,  309 => 100,  303 => 98,  301 => 97,  296 => 95,  288 => 90,  276 => 80,  274 => 79,  267 => 75,  262 => 73,  258 => 72,  253 => 70,  249 => 68,  239 => 64,  235 => 63,  231 => 62,  228 => 61,  224 => 60,  217 => 56,  210 => 55,  205 => 53,  195 => 48,  188 => 47,  182 => 44,  177 => 42,  173 => 41,  166 => 37,  159 => 36,  153 => 33,  146 => 32,  140 => 29,  133 => 28,  125 => 25,  118 => 24,  110 => 21,  103 => 20,  93 => 17,  85 => 16,  78 => 15,  73 => 13,  67 => 10,  62 => 8,  56 => 6,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_search.html", "");
    }
}
