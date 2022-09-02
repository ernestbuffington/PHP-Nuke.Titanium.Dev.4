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

/* acp_posting_buttons.html */
class __TwigTemplate_1d9b6fcc4fa7a297e268c76d9da6be86f250e27a1650e4e1262ea9837796bba2 extends \Twig\Template
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
        echo "<script>
// <![CDATA[

\t// Define the bbCode tags
\tvar bbcode = new Array();
\tvar bbtags = new Array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[quote]','[/quote]','[code]','[/code]','[list]','[/list]','[list=]','[/list]','[img]','[/img]','[url]','[/url]','[flash=]', '[/flash]','[size=]','[/size]'";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "custom_tags", [], "any", false, false, false, 6));
        foreach ($context['_seq'] as $context["_key"] => $context["custom_tags"]) {
            echo ", ";
            echo twig_get_attribute($this->env, $this->source, $context["custom_tags"], "BBCODE_NAME", [], "any", false, false, false, 6);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_tags'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo ");

// ]]>
</script>

";
        // line 11
        $asset_file = (("" . ($context["T_ASSETS_PATH"] ?? null)) . "/javascript/editor.js");
        $asset = new \phpbb\template\asset($asset_file, $this->env->get_path_helper(), $this->env->get_filesystem());
        if (substr($asset_file, 0, 2) !== './' && $asset->is_relative()) {
            $asset_path = $asset->get_path();            $local_file = $this->env->get_phpbb_root_path() . $asset_path;
            if (!file_exists($local_file)) {
                $local_file = $this->env->findTemplate($asset_path);
                $asset->set_path($local_file, true);
            }
        }
        
        if ($asset->is_relative()) {
            $asset->add_assets_version($this->env->get_phpbb_config()['assets_version']);
        }
        $this->env->get_assets_bag()->add_script($asset);        // line 12
        echo "
";
        // line 13
        // line 14
        echo "<div id=\"format-buttons\">
\t<input type=\"button\" class=\"button2\" accesskey=\"b\" name=\"addbbcode0\" value=\" B \" style=\"font-weight:bold; width: 30px\" onclick=\"bbstyle(0)\" title=\"";
        // line 15
        echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_B_HELP");
        echo "\" />
\t<input type=\"button\" class=\"button2\" accesskey=\"i\" name=\"addbbcode2\" value=\" i \" style=\"font-style:italic; width: 30px\" onclick=\"bbstyle(2)\" title=\"";
        // line 16
        echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_I_HELP");
        echo "\" />
\t<input type=\"button\" class=\"button2\" accesskey=\"u\" name=\"addbbcode4\" value=\" u \" style=\"text-decoration: underline; width: 30px\" onclick=\"bbstyle(4)\" title=\"";
        // line 17
        echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_U_HELP");
        echo "\" />
\t";
        // line 18
        if (($context["S_BBCODE_QUOTE"] ?? null)) {
            // line 19
            echo "\t\t<input type=\"button\" class=\"button2\" accesskey=\"q\" name=\"addbbcode6\" value=\"Quote\" style=\"width: 50px\" onclick=\"bbstyle(6)\" title=\"";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_Q_HELP");
            echo "\" />
\t";
        }
        // line 21
        echo "\t<input type=\"button\" class=\"button2\" accesskey=\"c\" name=\"addbbcode8\" value=\"Code\" style=\"width: 40px\" onclick=\"bbstyle(8)\" title=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_C_HELP");
        echo "\" />
\t<input type=\"button\" class=\"button2\" accesskey=\"l\" name=\"addbbcode10\" value=\"List\" style=\"width: 40px\" onclick=\"bbstyle(10)\" title=\"";
        // line 22
        echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_L_HELP");
        echo "\" />
\t<input type=\"button\" class=\"button2\" accesskey=\"o\" name=\"addbbcode12\" value=\"List=\" style=\"width: 40px\" onclick=\"bbstyle(12)\" title=\"";
        // line 23
        echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_O_HELP");
        echo "\" />
\t<input type=\"button\" class=\"button2\" accesskey=\"y\" name=\"addlistitem\" value=\"[*]\" style=\"width: 40px\" onclick=\"bbstyle(-1)\" title=\"";
        // line 24
        echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_LISTITEM_HELP");
        echo "\" />
\t";
        // line 25
        if (($context["S_BBCODE_IMG"] ?? null)) {
            // line 26
            echo "\t\t<input type=\"button\" class=\"button2\" accesskey=\"p\" name=\"addbbcode14\" value=\"Img\" style=\"width: 40px\" onclick=\"bbstyle(14)\" title=\"";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_P_HELP");
            echo "\" />
\t";
        }
        // line 28
        echo "\t";
        if (($context["S_LINKS_ALLOWED"] ?? null)) {
            // line 29
            echo "\t\t<input type=\"button\" class=\"button2\" accesskey=\"w\" name=\"addbbcode16\" value=\"URL\" style=\"text-decoration: underline; width: 40px\" onclick=\"bbstyle(16)\" title=\"";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_W_HELP");
            echo "\" />
\t";
        }
        // line 31
        echo "\t";
        if (($context["S_BBCODE_FLASH"] ?? null)) {
            // line 32
            echo "\t\t<input type=\"button\" class=\"button2\" accesskey=\"d\" name=\"addbbcode18\" value=\"Flash\" onclick=\"bbstyle(18)\" title=\"";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_D_HELP");
            echo "\" />
\t";
        }
        // line 34
        echo "\t<select name=\"addbbcode20\" onchange=\"bbfontstyle('[size=' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + ']', '[/size]');this.form.addbbcode20.selectedIndex = 2;\" title=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_F_HELP");
        echo "\">
\t\t<option value=\"50\">";
        // line 35
        echo $this->extensions['phpbb\template\twig\extension']->lang("FONT_TINY");
        echo "</option>
\t\t<option value=\"85\">";
        // line 36
        echo $this->extensions['phpbb\template\twig\extension']->lang("FONT_SMALL");
        echo "</option>
\t\t<option value=\"100\" selected=\"selected\">";
        // line 37
        echo $this->extensions['phpbb\template\twig\extension']->lang("FONT_NORMAL");
        echo "</option>
\t\t";
        // line 38
        if (( !($context["MAX_FONT_SIZE"] ?? null) || (($context["MAX_FONT_SIZE"] ?? null) >= 150))) {
            // line 39
            echo "\t\t<option value=\"150\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("FONT_LARGE");
            echo "</option>
\t\t";
            // line 40
            if (( !($context["MAX_FONT_SIZE"] ?? null) || (($context["MAX_FONT_SIZE"] ?? null) >= 200))) {
                // line 41
                echo "\t\t<option value=\"200\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("FONT_HUGE");
                echo "</option>
\t\t";
            }
            // line 43
            echo "\t\t";
        }
        // line 44
        echo "\t</select>
\t";
        // line 45
        // line 46
        echo "\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "custom_tags", [], "any", false, false, false, 46));
        foreach ($context['_seq'] as $context["_key"] => $context["custom_tags"]) {
            // line 47
            echo "\t<input type=\"button\" class=\"button2\" name=\"addbbcode";
            echo twig_get_attribute($this->env, $this->source, $context["custom_tags"], "BBCODE_ID", [], "any", false, false, false, 47);
            echo "\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["custom_tags"], "BBCODE_TAG", [], "any", false, false, false, 47);
            echo "\" onclick=\"bbstyle(";
            echo twig_get_attribute($this->env, $this->source, $context["custom_tags"], "BBCODE_ID", [], "any", false, false, false, 47);
            echo ")\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["custom_tags"], "BBCODE_HELPLINE", [], "any", false, false, false, 47);
            echo "\" />
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_tags'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        echo "</div>
";
        // line 50
    }

    public function getTemplateName()
    {
        return "acp_posting_buttons.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  206 => 50,  203 => 49,  188 => 47,  183 => 46,  182 => 45,  179 => 44,  176 => 43,  170 => 41,  168 => 40,  163 => 39,  161 => 38,  157 => 37,  153 => 36,  149 => 35,  144 => 34,  138 => 32,  135 => 31,  129 => 29,  126 => 28,  120 => 26,  118 => 25,  114 => 24,  110 => 23,  106 => 22,  101 => 21,  95 => 19,  93 => 18,  89 => 17,  85 => 16,  81 => 15,  78 => 14,  77 => 13,  74 => 12,  60 => 11,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_posting_buttons.html", "");
    }
}
