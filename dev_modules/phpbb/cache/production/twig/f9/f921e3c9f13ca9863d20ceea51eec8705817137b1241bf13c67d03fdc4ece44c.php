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

/* posting_attach_body.html */
class __TwigTemplate_f14079c373e61f77d72cd2cb99608a45d1f6df01132cdece5b6e9cd8ac768b37 extends \Twig\Template
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
        echo "<div class=\"panel bg3 panel-container\" id=\"attach-panel\">
\t<div class=\"inner\">

\t<p>";
        // line 4
        echo $this->extensions['phpbb\template\twig\extension']->lang("ADD_ATTACHMENT_EXPLAIN");
        echo " <span class=\"hidden\" id=\"drag-n-drop-message\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_DRAG_TEXTAREA");
        echo "</span></p>
\t";
        // line 5
        if ( !twig_test_empty(($context["MAX_ATTACHMENT_FILESIZE"] ?? null))) {
            echo "<p>";
            echo ($context["MAX_ATTACHMENT_FILESIZE"] ?? null);
            echo "</p>";
        }
        // line 6
        echo "
\t<fieldset class=\"fields2\" id=\"attach-panel-basic\">
\t<dl>
\t\t<dt><label for=\"fileupload\">";
        // line 9
        echo $this->extensions['phpbb\template\twig\extension']->lang("FILENAME");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label></dt>
\t\t<dd>
\t\t\t<input type=\"file\" accept=\"";
        // line 11
        echo ($context["ALLOWED_ATTACHMENTS"] ?? null);
        echo "\" name=\"fileupload\" id=\"fileupload\" class=\"inputbox autowidth\" />
\t\t\t<input type=\"submit\" name=\"add_file\" value=\"";
        // line 12
        echo $this->extensions['phpbb\template\twig\extension']->lang("ADD_FILE");
        echo "\" class=\"button2\" onclick=\"upload = true;\" />
\t\t</dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"filecomment\">";
        // line 16
        echo $this->extensions['phpbb\template\twig\extension']->lang("FILE_COMMENT");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label></dt>
\t\t<dd><textarea name=\"filecomment\" id=\"filecomment\" rows=\"1\" cols=\"40\" class=\"inputbox autowidth\">";
        // line 17
        echo ($context["FILE_COMMENT"] ?? null);
        echo "</textarea></dd>
\t</dl>
\t</fieldset>

\t<div id=\"attach-panel-multi\" class=\"attach-panel-multi\">
\t\t<input type=\"button\" class=\"button2\" value=\"";
        // line 22
        echo $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_ADD_FILES");
        echo "\" id=\"add_files\" />
\t</div>

\t";
        // line 25
        // line 26
        echo "\t<div class=\"panel";
        if ( !twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "attach_row", [], "any", false, false, false, 26))) {
            echo " hidden";
        }
        echo " file-list-container\" id=\"file-list-container\">
\t\t<div class=\"inner\">
\t\t\t<table class=\"table1 zebra-list fixed-width-table\">
\t\t\t\t<thead>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th class=\"attach-name\">";
        // line 31
        echo $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_FILENAME");
        echo "</th>
\t\t\t\t\t\t<th class=\"attach-comment\">";
        // line 32
        echo $this->extensions['phpbb\template\twig\extension']->lang("FILE_COMMENT");
        echo "</th>
\t\t\t\t\t\t<th class=\"attach-filesize\">";
        // line 33
        echo $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_SIZE");
        echo "</th>
\t\t\t\t\t\t<th class=\"attach-status\">";
        // line 34
        echo $this->extensions['phpbb\template\twig\extension']->lang("PLUPLOAD_STATUS");
        echo "</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<tbody class=\"responsive-skip-empty file-list\" id=\"file-list\">
\t\t\t\t\t<tr class=\"attach-row attach-row-tpl\" id=\"attach-row-tpl\">
\t\t\t\t\t\t\t<td class=\"attach-name\">
\t\t\t\t\t\t\t\t<span class=\"file-name ellipsis-text\"></span>
\t\t\t\t\t\t\t\t<span class=\"attach-controls\">
\t\t\t\t\t\t\t\t\t";
        // line 42
        if (($context["S_BBCODE_ALLOWED"] ?? null)) {
            echo "<input type=\"button\" value=\"";
            echo $this->extensions['phpbb\template\twig\extension']->lang("PLACE_INLINE");
            echo "\" class=\"button2 hidden file-inline-bbcode\" />&nbsp;";
        }
        // line 43
        echo "\t\t\t\t\t\t\t\t\t<input type=\"button\" value=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE_FILE");
        echo "\" class=\"button2 file-delete\" />
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t<span class=\"clear\"></span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-comment\">
\t\t\t\t\t\t\t\t<textarea rows=\"1\" cols=\"30\" class=\"inputbox\"></textarea>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-filesize\">
\t\t\t\t\t\t\t\t<span class=\"file-size\"></span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-status\">
\t\t\t\t\t\t\t\t<span class=\"file-progress\">
\t\t\t\t\t\t\t\t\t<span class=\"file-progress-bar\"></span>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t<span class=\"file-status\"></span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t\t";
        // line 60
        // line 61
        echo "\t\t\t\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "attach_row", [], "any", false, false, false, 61));
        foreach ($context['_seq'] as $context["_key"] => $context["attach_row"]) {
            // line 62
            echo "\t\t\t\t\t\t";
            // line 63
            echo "\t\t\t\t\t\t<tr class=\"attach-row\" data-attach-id=\"";
            echo twig_get_attribute($this->env, $this->source, $context["attach_row"], "ATTACH_ID", [], "any", false, false, false, 63);
            echo "\">
\t\t\t\t\t\t\t<td class=\"attach-name\">
\t\t\t\t\t\t\t\t<span class=\"file-name ellipsis-text\"><a href=\"";
            // line 65
            echo twig_get_attribute($this->env, $this->source, $context["attach_row"], "U_VIEW_ATTACHMENT", [], "any", false, false, false, 65);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["attach_row"], "FILENAME", [], "any", false, false, false, 65);
            echo "</a></span>
\t\t\t\t\t\t\t\t";
            // line 66
            // line 67
            echo "\t\t\t\t\t\t\t\t<span class=\"attach-controls\">
\t\t\t\t\t\t\t\t\t";
            // line 68
            if ((($context["S_BBCODE_ALLOWED"] ?? null) && ($context["S_INLINE_ATTACHMENT_OPTIONS"] ?? null))) {
                echo "<input type=\"button\" value=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("PLACE_INLINE");
                echo "\" class=\"button2 file-inline-bbcode\" />&nbsp;";
            }
            // line 69
            echo "\t\t\t\t\t\t\t\t\t<input type=\"submit\" name=\"delete_file[";
            echo twig_get_attribute($this->env, $this->source, $context["attach_row"], "ASSOC_INDEX", [], "any", false, false, false, 69);
            echo "]\" value=\"";
            echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE_FILE");
            echo "\" class=\"button2 file-delete\" />
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t";
            // line 71
            // line 72
            echo "\t\t\t\t\t\t\t\t<span class=\"clear\"></span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-comment\">
\t\t\t\t\t\t\t\t<textarea name=\"comment_list[";
            // line 75
            echo twig_get_attribute($this->env, $this->source, $context["attach_row"], "ASSOC_INDEX", [], "any", false, false, false, 75);
            echo "]\" rows=\"1\" cols=\"30\" class=\"inputbox\">";
            echo twig_get_attribute($this->env, $this->source, $context["attach_row"], "FILE_COMMENT", [], "any", false, false, false, 75);
            echo "</textarea>
\t\t\t\t\t\t\t\t";
            // line 76
            echo twig_get_attribute($this->env, $this->source, $context["attach_row"], "S_HIDDEN", [], "any", false, false, false, 76);
            echo "
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-filesize\">
\t\t\t\t\t\t\t\t<span class=\"file-size\">";
            // line 79
            echo twig_get_attribute($this->env, $this->source, $context["attach_row"], "FILESIZE", [], "any", false, false, false, 79);
            echo "</span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-status\">
\t\t\t\t\t\t\t\t<span class=\"file-status file-uploaded\"></span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t";
            // line 85
            // line 86
            echo "\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attach_row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 87
        echo "\t\t\t\t\t";
        // line 88
        echo "\t\t\t\t</tbody>
\t\t\t</table>
\t\t</div>
\t</div>
\t";
        // line 92
        // line 93
        echo "\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "posting_attach_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  238 => 93,  237 => 92,  231 => 88,  229 => 87,  223 => 86,  222 => 85,  213 => 79,  207 => 76,  201 => 75,  196 => 72,  195 => 71,  187 => 69,  181 => 68,  178 => 67,  177 => 66,  171 => 65,  165 => 63,  163 => 62,  158 => 61,  157 => 60,  136 => 43,  130 => 42,  119 => 34,  115 => 33,  111 => 32,  107 => 31,  96 => 26,  95 => 25,  89 => 22,  81 => 17,  76 => 16,  69 => 12,  65 => 11,  59 => 9,  54 => 6,  48 => 5,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "posting_attach_body.html", "");
    }
}
