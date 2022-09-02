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

/* posting_buttons.html */
class __TwigTemplate_dc6379e94327b92f2319780824cf2f9dbee2cf996199024f4e5e5eeb0d4b464b extends \Twig\Template
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
<script>
\tvar form_name = 'postform';
\tvar text_name = ";
        // line 4
        if (twig_get_attribute($this->env, $this->source, ($context["definition"] ?? null), "SIG_EDIT", [], "any", false, false, false, 4)) {
            echo "'signature'";
        } else {
            echo "'message'";
        }
        echo ";
\tvar load_draft = false;
\tvar upload = false;

\t// Define the bbCode tags
\tvar bbcode = new Array();
\tvar bbtags = new Array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[quote]','[/quote]','[code]','[/code]','[list]','[/list]','[list=]','[/list]','[img]','[/img]','[url]','[/url]','[flash=]', '[/flash]','[size=]','[/size]'";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "custom_tags", [], "any", false, false, false, 10));
        foreach ($context['_seq'] as $context["_key"] => $context["custom_tags"]) {
            echo ", ";
            echo twig_get_attribute($this->env, $this->source, $context["custom_tags"], "BBCODE_NAME", [], "any", false, false, false, 10);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_tags'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo ");
\tvar imageTag = false;

\tfunction change_palette()
\t{
\t\tphpbb.toggleDisplay('colour_palette');
\t\te = document.getElementById('colour_palette');

\t\tif (e.style.display == 'block')
\t\t{
\t\t\tdocument.getElementById('bbpalette').value = '";
        // line 20
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("FONT_COLOR_HIDE"), "js");
        echo "';
\t\t}
\t\telse
\t\t{
\t\t\tdocument.getElementById('bbpalette').value = '";
        // line 24
        echo twig_escape_filter($this->env, $this->extensions['phpbb\template\twig\extension']->lang("FONT_COLOR"), "js");
        echo "';
\t\t}
\t}
</script>
";
        // line 28
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
        $this->env->get_assets_bag()->add_script($asset);        // line 29
        echo "
";
        // line 30
        if (($context["S_BBCODE_ALLOWED"] ?? null)) {
            // line 31
            echo "<div id=\"colour_palette\" style=\"display: none;\">
\t<dl style=\"clear: left;\">
\t\t<dt><label>";
            // line 33
            echo $this->extensions['phpbb\template\twig\extension']->lang("FONT_COLOR");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t<dd id=\"color_palette_placeholder\" class=\"color_palette_placeholder\" data-color-palette=\"h\" data-height=\"12\" data-width=\"15\" data-bbcode=\"true\"></dd>
\t</dl>
</div>

";
            // line 38
            // line 39
            echo "<div id=\"format-buttons\" class=\"format-buttons\">
\t<button type=\"button\" class=\"button button-icon-only bbcode-b\" accesskey=\"b\" name=\"addbbcode0\" value=\" B \" onclick=\"bbstyle(0)\" title=\"";
            // line 40
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_B_HELP");
            echo "\">
\t\t<i class=\"icon fa-bold fa-fw\" aria-hidden=\"true\"></i>
\t</button>
\t<button type=\"button\" class=\"button button-icon-only bbcode-i\" accesskey=\"i\" name=\"addbbcode2\" value=\" i \" onclick=\"bbstyle(2)\" title=\"";
            // line 43
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_I_HELP");
            echo "\">
\t\t<i class=\"icon fa-italic fa-fw\" aria-hidden=\"true\"></i>
\t</button>
\t<button type=\"button\" class=\"button button-icon-only bbcode-u\" accesskey=\"u\" name=\"addbbcode4\" value=\" u \" onclick=\"bbstyle(4)\" title=\"";
            // line 46
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_U_HELP");
            echo "\">
\t\t<i class=\"icon fa-underline fa-fw\" aria-hidden=\"true\"></i>
\t</button>
\t";
            // line 49
            if (($context["S_BBCODE_QUOTE"] ?? null)) {
                // line 50
                echo "\t<button type=\"button\" class=\"button button-icon-only bbcode-quote\" accesskey=\"q\" name=\"addbbcode6\" value=\"Quote\" onclick=\"bbstyle(6)\" title=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_Q_HELP");
                echo "\">
\t\t<i class=\"icon fa-quote-left fa-fw\" aria-hidden=\"true\"></i>
\t</button>
\t";
            }
            // line 54
            echo "\t<button type=\"button\" class=\"button button-icon-only bbcode-code\" accesskey=\"c\" name=\"addbbcode8\" value=\"Code\" onclick=\"bbstyle(8)\" title=\"";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_C_HELP");
            echo "\">
\t\t<i class=\"icon fa-code fa-fw\" aria-hidden=\"true\"></i>
\t</button>
\t<button type=\"button\" class=\"button button-icon-only bbcode-list\" accesskey=\"l\" name=\"addbbcode10\" value=\"List\" onclick=\"bbstyle(10)\" title=\"";
            // line 57
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_L_HELP");
            echo "\">
\t\t<i class=\"icon fa-list fa-fw\" aria-hidden=\"true\"></i>
\t</button>
\t<button type=\"button\" class=\"button button-icon-only bbcode-list-\" accesskey=\"o\" name=\"addbbcode12\" value=\"List=\" onclick=\"bbstyle(12)\" title=\"";
            // line 60
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_O_HELP");
            echo "\">
\t\t<i class=\"icon fa-list-ol fa-fw\" aria-hidden=\"true\"></i>
\t</button>
\t<button type=\"button\" class=\"button button-icon-only bbcode-asterisk\" accesskey=\"y\" name=\"addlistitem\" value=\"[*]\" onclick=\"bbstyle(-1)\" title=\"";
            // line 63
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_LISTITEM_HELP");
            echo "\">
\t\t<i class=\"icon fa-asterisk fa-fw\" aria-hidden=\"true\"></i>
\t</button>
\t";
            // line 66
            if (($context["S_BBCODE_IMG"] ?? null)) {
                // line 67
                echo "\t<button type=\"button\" class=\"button button-icon-only bbcode-img\" accesskey=\"p\" name=\"addbbcode14\" value=\"Img\" onclick=\"bbstyle(14)\" title=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_P_HELP");
                echo "\">
\t\t<i class=\"icon fa-image fa-fw\" aria-hidden=\"true\"></i>
\t</button>
\t";
            }
            // line 71
            echo "\t";
            if (($context["S_LINKS_ALLOWED"] ?? null)) {
                // line 72
                echo "\t<button type=\"button\" class=\"button button-icon-only bbcode-url\" accesskey=\"w\" name=\"addbbcode16\" value=\"URL\" onclick=\"bbstyle(16)\" title=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_W_HELP");
                echo "\">
\t\t<i class=\"icon fa-link fa-fw\" aria-hidden=\"true\"></i>
\t</button>
\t";
            }
            // line 76
            echo "\t";
            if (($context["S_BBCODE_FLASH"] ?? null)) {
                // line 77
                echo "\t<button type=\"button\" class=\"button button-icon-only bbcode-flash\" accesskey=\"d\" name=\"addbbcode18\" value=\"Flash\" onclick=\"bbstyle(18)\" title=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_D_HELP");
                echo "\">
\t\t<i class=\"icon fa-flash fa-fw\" aria-hidden=\"true\"></i>
\t</button>
\t";
            }
            // line 81
            echo "\t<button type=\"button\" class=\"button button-icon-only bbcode-color\" name=\"bbpalette\" id=\"bbpalette\" value=\"";
            echo $this->extensions['phpbb\template\twig\extension']->lang("FONT_COLOR");
            echo "\" onclick=\"change_palette();\" title=\"";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_S_HELP");
            echo "\">
\t\t<i class=\"icon fa-tint fa-fw\" aria-hidden=\"true\"></i>
\t</button>
\t<select name=\"addbbcode20\" class=\"bbcode-size\" onchange=\"bbfontstyle('[size=' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + ']', '[/size]');this.form.addbbcode20.selectedIndex = 2;\" title=\"";
            // line 84
            echo $this->extensions['phpbb\template\twig\extension']->lang("BBCODE_F_HELP");
            echo "\">
\t\t<option value=\"50\">";
            // line 85
            echo $this->extensions['phpbb\template\twig\extension']->lang("FONT_TINY");
            echo "</option>
\t\t<option value=\"85\">";
            // line 86
            echo $this->extensions['phpbb\template\twig\extension']->lang("FONT_SMALL");
            echo "</option>
\t\t<option value=\"100\" selected=\"selected\">";
            // line 87
            echo $this->extensions['phpbb\template\twig\extension']->lang("FONT_NORMAL");
            echo "</option>
\t\t";
            // line 88
            if (( !($context["MAX_FONT_SIZE"] ?? null) || (($context["MAX_FONT_SIZE"] ?? null) >= 150))) {
                // line 89
                echo "\t\t\t<option value=\"150\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("FONT_LARGE");
                echo "</option>
\t\t\t";
                // line 90
                if (( !($context["MAX_FONT_SIZE"] ?? null) || (($context["MAX_FONT_SIZE"] ?? null) >= 200))) {
                    // line 91
                    echo "\t\t\t\t<option value=\"200\">";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("FONT_HUGE");
                    echo "</option>
\t\t\t";
                }
                // line 93
                echo "\t\t";
            }
            // line 94
            echo "\t</select>

\t";
            // line 96
            // line 97
            echo "
\t";
            // line 98
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "custom_tags", [], "any", false, false, false, 98));
            foreach ($context['_seq'] as $context["_key"] => $context["custom_tags"]) {
                // line 99
                echo "\t<button type=\"button\" class=\"button button-secondary bbcode-";
                echo twig_get_attribute($this->env, $this->source, $context["custom_tags"], "BBCODE_TAG_CLEAN", [], "any", false, false, false, 99);
                echo "\" name=\"addbbcode";
                echo twig_get_attribute($this->env, $this->source, $context["custom_tags"], "BBCODE_ID", [], "any", false, false, false, 99);
                echo "\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["custom_tags"], "BBCODE_TAG", [], "any", false, false, false, 99);
                echo "\" onclick=\"bbstyle(";
                echo twig_get_attribute($this->env, $this->source, $context["custom_tags"], "BBCODE_ID", [], "any", false, false, false, 99);
                echo ")\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["custom_tags"], "BBCODE_HELPLINE", [], "any", false, false, false, 99);
                echo "\">
\t\t";
                // line 100
                echo twig_get_attribute($this->env, $this->source, $context["custom_tags"], "BBCODE_TAG", [], "any", false, false, false, 100);
                echo "
\t</button>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_tags'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 103
            echo "</div>
";
            // line 104
        }
    }

    public function getTemplateName()
    {
        return "posting_buttons.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  291 => 104,  288 => 103,  279 => 100,  266 => 99,  262 => 98,  259 => 97,  258 => 96,  254 => 94,  251 => 93,  245 => 91,  243 => 90,  238 => 89,  236 => 88,  232 => 87,  228 => 86,  224 => 85,  220 => 84,  211 => 81,  203 => 77,  200 => 76,  192 => 72,  189 => 71,  181 => 67,  179 => 66,  173 => 63,  167 => 60,  161 => 57,  154 => 54,  146 => 50,  144 => 49,  138 => 46,  132 => 43,  126 => 40,  123 => 39,  122 => 38,  113 => 33,  109 => 31,  107 => 30,  104 => 29,  90 => 28,  83 => 24,  76 => 20,  55 => 10,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "posting_buttons.html", "");
    }
}
