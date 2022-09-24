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

/* acp_logs.html */
class __TwigTemplate_cc559701525b999ad12a64bda296750c82f0edaa951e146056aa2d80ad69f00b extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_logs.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

<h1>";
        // line 5
        echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE");
        echo "</h1>

<p>";
        // line 7
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXPLAIN");
        echo "</p>

<form id=\"list\" method=\"post\" action=\"";
        // line 9
        echo ($context["U_ACTION"] ?? null);
        echo "\">

<fieldset class=\"display-options search-box\">
\t";
        // line 12
        echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_KEYWORDS");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo " <input type=\"text\" name=\"keywords\" value=\"";
        echo ($context["S_KEYWORDS"] ?? null);
        echo "\" />&nbsp;<input type=\"submit\" class=\"button2\" name=\"filter\" value=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH");
        echo "\" />
</fieldset>

";
        // line 15
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pagination", [], "any", false, false, false, 15))) {
            // line 16
            echo "<div class=\"pagination top-pagination\">
\t";
            // line 17
            $location = "pagination.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("pagination.html", "acp_logs.html", 17)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 18
            echo "</div>
";
        }
        // line 20
        echo "
";
        // line 21
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "log", [], "any", false, false, false, 21))) {
            // line 22
            echo "\t<table class=\"table1 zebra-table fixed-width-table\">
\t<thead>
\t<tr>
\t\t<th style=\"width: 15%;\">";
            // line 25
            echo $this->extensions['phpbb\template\twig\extension']->lang("USERNAME");
            echo "</th>
\t\t<th style=\"width: 15%;\">";
            // line 26
            echo $this->extensions['phpbb\template\twig\extension']->lang("IP");
            echo "</th>
\t\t<th style=\"width: 20%;\">";
            // line 27
            echo $this->extensions['phpbb\template\twig\extension']->lang("TIME");
            echo "</th>
\t\t<th>";
            // line 28
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACTION");
            echo "</th>
\t\t";
            // line 29
            if (($context["S_CLEARLOGS"] ?? null)) {
                // line 30
                echo "\t\t\t<th style=\"width: 50px;\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("MARK");
                echo "</th>
\t\t";
            }
            // line 32
            echo "\t</tr>
\t</thead>
\t<tbody>
\t";
            // line 35
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "log", [], "any", false, false, false, 35));
            foreach ($context['_seq'] as $context["_key"] => $context["log"]) {
                // line 36
                echo "\t\t<tr>
\t\t\t<td>
\t\t\t\t";
                // line 38
                echo twig_get_attribute($this->env, $this->source, $context["log"], "USERNAME", [], "any", false, false, false, 38);
                echo "
\t\t\t\t";
                // line 39
                if (twig_get_attribute($this->env, $this->source, $context["log"], "REPORTEE_USERNAME", [], "any", false, false, false, 39)) {
                    // line 40
                    echo "\t\t\t\t<br />&raquo; ";
                    echo twig_get_attribute($this->env, $this->source, $context["log"], "REPORTEE_USERNAME", [], "any", false, false, false, 40);
                    echo "
\t\t\t\t";
                }
                // line 42
                echo "\t\t\t</td>
\t\t\t<td style=\"text-align: center;\">";
                // line 43
                echo twig_get_attribute($this->env, $this->source, $context["log"], "IP", [], "any", false, false, false, 43);
                echo "</td>
\t\t\t<td style=\"text-align: center;\">";
                // line 44
                echo twig_get_attribute($this->env, $this->source, $context["log"], "DATE", [], "any", false, false, false, 44);
                echo "</td>
\t\t\t<td>";
                // line 45
                echo twig_get_attribute($this->env, $this->source, $context["log"], "ACTION", [], "any", false, false, false, 45);
                if (twig_get_attribute($this->env, $this->source, $context["log"], "DATA", [], "any", false, false, false, 45)) {
                    echo "<br /><span>";
                    echo twig_get_attribute($this->env, $this->source, $context["log"], "DATA", [], "any", false, false, false, 45);
                    echo "</span>";
                }
                echo "</td>
\t\t\t";
                // line 46
                if (($context["S_CLEARLOGS"] ?? null)) {
                    // line 47
                    echo "\t\t\t\t<td style=\"text-align: center;\"><input type=\"checkbox\" class=\"radio\" name=\"mark[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["log"], "ID", [], "any", false, false, false, 47);
                    echo "\" /></td>
\t\t\t";
                }
                // line 49
                echo "\t\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['log'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 51
            echo "\t</tbody>
\t</table>

";
            // line 54
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pagination", [], "any", false, false, false, 54))) {
                // line 55
                echo "\t<div class=\"pagination\">
\t\t";
                // line 56
                $location = "pagination.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->loadTemplate("pagination.html", "acp_logs.html", 56)->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 57
                echo "\t</div>
";
            }
            // line 59
            echo "
";
        } else {
            // line 61
            echo "\t<div class=\"errorbox\">
\t\t<p>";
            // line 62
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO_ENTRIES");
            echo "</p>
\t</div>
";
        }
        // line 65
        echo "
<fieldset class=\"display-options\">
\t";
        // line 67
        echo $this->extensions['phpbb\template\twig\extension']->lang("DISPLAY_LOG");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo " &nbsp;";
        echo ($context["S_LIMIT_DAYS"] ?? null);
        echo "&nbsp;";
        echo $this->extensions['phpbb\template\twig\extension']->lang("SORT_BY");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo " ";
        echo ($context["S_SORT_KEY"] ?? null);
        echo " ";
        echo ($context["S_SORT_DIR"] ?? null);
        echo "
\t<input class=\"button2\" type=\"submit\" value=\"";
        // line 68
        echo $this->extensions['phpbb\template\twig\extension']->lang("GO");
        echo "\" name=\"sort\" />
\t";
        // line 69
        echo ($context["S_FORM_TOKEN"] ?? null);
        echo "
</fieldset>
<hr />

";
        // line 73
        if (($context["S_SHOW_FORUMS"] ?? null)) {
            // line 74
            echo "\t<fieldset class=\"quick\">
\t\t";
            // line 75
            echo $this->extensions['phpbb\template\twig\extension']->lang("SELECT_FORUM");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo " <select name=\"f\" onchange=\"if(this.options[this.selectedIndex].value != -1){ this.form.submit(); }\">";
            echo ($context["S_FORUM_BOX"] ?? null);
            echo "</select>
\t\t";
            // line 76
            echo "<input class=\"button2\" type=\"submit\" value=\"";
            echo $this->extensions['phpbb\template\twig\extension']->lang("GO");
            echo "\" />";
            // line 77
            echo "\t</fieldset>
";
        }
        // line 79
        echo "
";
        // line 80
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "log", [], "any", false, false, false, 80)) && ($context["S_CLEARLOGS"] ?? null))) {
            // line 81
            echo "\t<fieldset class=\"quick\">
\t\t<input class=\"button2\" type=\"submit\" name=\"delall\" value=\"";
            // line 82
            echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE_ALL");
            echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"submit\" name=\"delmarked\" value=\"";
            // line 83
            echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE_MARKED");
            echo "\" /><br />
\t\t<p class=\"small\"><a href=\"#\" onclick=\"marklist('list', 'mark', true); return false;\">";
            // line 84
            echo $this->extensions['phpbb\template\twig\extension']->lang("MARK_ALL");
            echo "</a> &bull; <a href=\"#\" onclick=\"marklist('list', 'mark', false); return false;\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("UNMARK_ALL");
            echo "</a></p>
\t</fieldset>
";
        }
        // line 87
        echo "
</form>

";
        // line 90
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_logs.html", 90)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_logs.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  313 => 90,  308 => 87,  300 => 84,  296 => 83,  292 => 82,  289 => 81,  287 => 80,  284 => 79,  280 => 77,  276 => 76,  269 => 75,  266 => 74,  264 => 73,  257 => 69,  253 => 68,  239 => 67,  235 => 65,  229 => 62,  226 => 61,  222 => 59,  218 => 57,  206 => 56,  203 => 55,  201 => 54,  196 => 51,  189 => 49,  183 => 47,  181 => 46,  172 => 45,  168 => 44,  164 => 43,  161 => 42,  155 => 40,  153 => 39,  149 => 38,  145 => 36,  141 => 35,  136 => 32,  130 => 30,  128 => 29,  124 => 28,  120 => 27,  116 => 26,  112 => 25,  107 => 22,  105 => 21,  102 => 20,  98 => 18,  86 => 17,  83 => 16,  81 => 15,  70 => 12,  64 => 9,  59 => 7,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_logs.html", "");
    }
}
