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

/* acp_inactive.html */
class __TwigTemplate_7cd49e5f59023ff6beccc57694df84d1184de90e69b3a472147a0695fa777b4d extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_inactive.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

<h1>";
        // line 5
        echo $this->extensions['phpbb\template\twig\extension']->lang("INACTIVE_USERS");
        echo "</h1>

<p>";
        // line 7
        echo $this->extensions['phpbb\template\twig\extension']->lang("INACTIVE_USERS_EXPLAIN");
        echo "</p>

<form id=\"inactive\" method=\"post\" action=\"";
        // line 9
        echo ($context["U_ACTION"] ?? null);
        echo "\">

";
        // line 11
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pagination", [], "any", false, false, false, 11))) {
            // line 12
            echo "<div class=\"pagination\">
\t";
            // line 13
            $location = "pagination.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("pagination.html", "acp_inactive.html", 13)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 14
            echo "</div>
";
        }
        // line 16
        echo "
<table class=\"table1 zebra-table\">
<thead>
<tr>
\t<th>";
        // line 20
        echo $this->extensions['phpbb\template\twig\extension']->lang("USERNAME");
        echo "</th>
\t<th>";
        // line 21
        echo $this->extensions['phpbb\template\twig\extension']->lang("EMAIL");
        echo "</th>
\t<th>";
        // line 22
        echo $this->extensions['phpbb\template\twig\extension']->lang("JOINED");
        echo "</th>
\t<th>";
        // line 23
        echo $this->extensions['phpbb\template\twig\extension']->lang("INACTIVE_DATE");
        echo "</th>
\t<th>";
        // line 24
        echo $this->extensions['phpbb\template\twig\extension']->lang("LAST_VISIT");
        echo "</th>
\t<th>";
        // line 25
        echo $this->extensions['phpbb\template\twig\extension']->lang("INACTIVE_REASON");
        echo "</th>
\t<th>";
        // line 26
        echo $this->extensions['phpbb\template\twig\extension']->lang("MARK");
        echo "</th>
</tr>
</thead>
<tbody>
";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "inactive", [], "any", false, false, false, 30));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["inactive"]) {
            // line 31
            echo "\t<tr>
\t\t<td style=\"vertical-align: top;\">
\t\t\t";
            // line 33
            echo twig_get_attribute($this->env, $this->source, $context["inactive"], "USERNAME_FULL", [], "any", false, false, false, 33);
            echo "
\t\t\t";
            // line 34
            if (twig_get_attribute($this->env, $this->source, $context["inactive"], "POSTS", [], "any", false, false, false, 34)) {
                echo "<br />";
                echo $this->extensions['phpbb\template\twig\extension']->lang("POSTS");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo " <strong>";
                echo twig_get_attribute($this->env, $this->source, $context["inactive"], "POSTS", [], "any", false, false, false, 34);
                echo "</strong> [<a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["inactive"], "U_SEARCH_USER", [], "any", false, false, false, 34);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_USER_POSTS");
                echo "</a>]";
            }
            // line 35
            echo "\t\t</td>
\t\t<td style=\"vertical-align: top;\">";
            // line 36
            echo twig_get_attribute($this->env, $this->source, $context["inactive"], "USER_EMAIL", [], "any", false, false, false, 36);
            echo "</td>
\t\t<td style=\"vertical-align: top;\">";
            // line 37
            echo twig_get_attribute($this->env, $this->source, $context["inactive"], "JOINED", [], "any", false, false, false, 37);
            echo "</td>
\t\t<td style=\"vertical-align: top;\">";
            // line 38
            echo twig_get_attribute($this->env, $this->source, $context["inactive"], "INACTIVE_DATE", [], "any", false, false, false, 38);
            echo "</td>
\t\t<td style=\"vertical-align: top;\">";
            // line 39
            echo twig_get_attribute($this->env, $this->source, $context["inactive"], "LAST_VISIT", [], "any", false, false, false, 39);
            echo "</td>
\t\t<td style=\"vertical-align: top;\">
\t\t\t";
            // line 41
            echo twig_get_attribute($this->env, $this->source, $context["inactive"], "REASON", [], "any", false, false, false, 41);
            echo "
\t\t\t";
            // line 42
            if (twig_get_attribute($this->env, $this->source, $context["inactive"], "REMINDED", [], "any", false, false, false, 42)) {
                echo "<br />";
                echo twig_get_attribute($this->env, $this->source, $context["inactive"], "REMINDED_EXPLAIN", [], "any", false, false, false, 42);
            }
            // line 43
            echo "\t\t</td>
\t\t<td>&nbsp;<input type=\"checkbox\" class=\"radio\" name=\"mark[]\" value=\"";
            // line 44
            echo twig_get_attribute($this->env, $this->source, $context["inactive"], "USER_ID", [], "any", false, false, false, 44);
            echo "\" />&nbsp;</td>
\t</tr>
";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 47
            echo "\t<tr>
\t\t<td colspan=\"7\" style=\"text-align: center;\">";
            // line 48
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO_INACTIVE_USERS");
            echo "</td>
\t</tr>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['inactive'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
        echo "</tbody>
</table>

<fieldset class=\"display-options\">
\t";
        // line 55
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
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pagination", [], "any", false, false, false, 55))) {
            echo "&nbsp;";
            echo $this->extensions['phpbb\template\twig\extension']->lang("USERS_PER_PAGE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo " <input class=\"inputbox autowidth\" type=\"number\" name=\"users_per_page\" id=\"users_per_page\" min=\"0\" max=\"999\" value=\"";
            echo ($context["USERS_PER_PAGE"] ?? null);
            echo "\" />";
        }
        // line 56
        echo "\t<input class=\"button2\" type=\"submit\" value=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("GO");
        echo "\" name=\"sort\" />
</fieldset>

<hr />

";
        // line 61
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pagination", [], "any", false, false, false, 61))) {
            // line 62
            echo "\t<div class=\"pagination\">
\t\t";
            // line 63
            $location = "pagination.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("pagination.html", "acp_inactive.html", 63)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 64
            echo "\t</div>
";
        }
        // line 66
        echo "
<fieldset class=\"quick\">
\t<select name=\"action\">";
        // line 68
        echo ($context["S_INACTIVE_OPTIONS"] ?? null);
        echo "</select>
\t<input class=\"button2\" type=\"submit\" name=\"submit\" value=\"";
        // line 69
        echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
        echo "\" />
\t<p class=\"small\"><a href=\"#\" onclick=\"marklist('inactive', 'mark', true); return false;\">";
        // line 70
        echo $this->extensions['phpbb\template\twig\extension']->lang("MARK_ALL");
        echo "</a> &bull; <a href=\"#\" onclick=\"marklist('inactive', 'mark', false); return false;\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("UNMARK_ALL");
        echo "</a></p>
\t";
        // line 71
        echo ($context["S_FORM_TOKEN"] ?? null);
        echo "
</fieldset>

</form>

";
        // line 76
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_inactive.html", 76)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_inactive.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  287 => 76,  279 => 71,  273 => 70,  269 => 69,  265 => 68,  261 => 66,  257 => 64,  245 => 63,  242 => 62,  240 => 61,  231 => 56,  211 => 55,  205 => 51,  196 => 48,  193 => 47,  185 => 44,  182 => 43,  177 => 42,  173 => 41,  168 => 39,  164 => 38,  160 => 37,  156 => 36,  153 => 35,  140 => 34,  136 => 33,  132 => 31,  127 => 30,  120 => 26,  116 => 25,  112 => 24,  108 => 23,  104 => 22,  100 => 21,  96 => 20,  90 => 16,  86 => 14,  74 => 13,  71 => 12,  69 => 11,  64 => 9,  59 => 7,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_inactive.html", "");
    }
}
