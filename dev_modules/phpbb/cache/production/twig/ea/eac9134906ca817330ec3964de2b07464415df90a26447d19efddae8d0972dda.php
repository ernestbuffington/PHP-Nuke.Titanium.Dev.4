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

/* acp_attachments.html */
class __TwigTemplate_84154c5bb6d32a37856c210bf1f9182637b437ba6cd2946d1b6e9e52e679df5f extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_attachments.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

";
        // line 5
        if (($context["U_BACK"] ?? null)) {
            // line 6
            echo "\t<a href=\"";
            echo ($context["U_BACK"] ?? null);
            echo "\" style=\"float: ";
            echo ($context["S_CONTENT_FLOW_END"] ?? null);
            echo ";\">&laquo; ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BACK");
            echo "</a>
";
        }
        // line 8
        echo "
<h1>";
        // line 9
        echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE");
        echo "</h1>

<p>";
        // line 11
        echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE_EXPLAIN");
        echo "</p>

";
        // line 13
        if (($context["S_WARNING"] ?? null)) {
            // line 14
            echo "\t<div class=\"errorbox\">
\t\t<h3>";
            // line 15
            echo $this->extensions['phpbb\template\twig\extension']->lang("WARNING");
            echo "</h3>
\t\t<p>";
            // line 16
            echo ($context["WARNING_MSG"] ?? null);
            echo "</p>
\t</div>
";
        }
        // line 19
        echo "
";
        // line 20
        if (($context["S_NOTIFY"] ?? null)) {
            // line 21
            echo "\t<div class=\"successbox\">
\t\t<h3>";
            // line 22
            echo $this->extensions['phpbb\template\twig\extension']->lang("NOTIFY");
            echo "</h3>
\t\t<p>";
            // line 23
            echo ($context["NOTIFY_MSG"] ?? null);
            echo "</p>
\t</div>
";
        }
        // line 26
        echo "
";
        // line 27
        if (($context["S_UPLOADING_FILES"] ?? null)) {
            // line 28
            echo "\t<h2>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("UPLOADING_FILES");
            echo "</h2>

\t";
            // line 30
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "upload", [], "any", false, false, false, 30));
            foreach ($context['_seq'] as $context["_key"] => $context["upload"]) {
                // line 31
                echo "\t\t:: ";
                echo twig_get_attribute($this->env, $this->source, $context["upload"], "FILE_INFO", [], "any", false, false, false, 31);
                echo "<br />
\t\t";
                // line 32
                if (twig_get_attribute($this->env, $this->source, $context["upload"], "S_DENIED", [], "any", false, false, false, 32)) {
                    echo "<span class=\"error\">";
                    echo twig_get_attribute($this->env, $this->source, $context["upload"], "L_DENIED", [], "any", false, false, false, 32);
                    echo "</span>";
                } elseif (twig_get_attribute($this->env, $this->source, $context["upload"], "ERROR_MSG", [], "any", false, false, false, 32)) {
                    echo "<span class=\"error\">";
                    echo twig_get_attribute($this->env, $this->source, $context["upload"], "ERROR_MSG", [], "any", false, false, false, 32);
                    echo "</span>";
                } else {
                    echo "<span class=\"success\">";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("SUCCESSFULLY_UPLOADED");
                    echo "</span>";
                }
                // line 33
                echo "\t\t<br /><br />
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['upload'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            echo "
";
        }
        // line 37
        echo "
";
        // line 38
        if (($context["S_ATTACHMENT_SETTINGS"] ?? null)) {
            // line 39
            echo "
\t<form id=\"attachsettings\" method=\"post\" action=\"";
            // line 40
            echo ($context["U_ACTION"] ?? null);
            echo "\">
\t";
            // line 41
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "options", [], "any", false, false, false, 41));
            foreach ($context['_seq'] as $context["_key"] => $context["options"]) {
                // line 42
                echo "\t\t";
                if (twig_get_attribute($this->env, $this->source, $context["options"], "S_LEGEND", [], "any", false, false, false, 42)) {
                    // line 43
                    echo "\t\t\t";
                    if ( !twig_get_attribute($this->env, $this->source, $context["options"], "S_FIRST_ROW", [], "any", false, false, false, 43)) {
                        // line 44
                        echo "\t\t\t\t</fieldset>
\t\t\t";
                    }
                    // line 46
                    echo "\t\t\t<fieldset>
\t\t\t\t<legend>";
                    // line 47
                    echo twig_get_attribute($this->env, $this->source, $context["options"], "LEGEND", [], "any", false, false, false, 47);
                    echo "</legend>
\t\t";
                } else {
                    // line 49
                    echo "
\t\t\t<dl>
\t\t\t\t<dt><label for=\"";
                    // line 51
                    echo twig_get_attribute($this->env, $this->source, $context["options"], "KEY", [], "any", false, false, false, 51);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["options"], "TITLE", [], "any", false, false, false, 51);
                    echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                    echo "</label>";
                    if (twig_get_attribute($this->env, $this->source, $context["options"], "S_EXPLAIN", [], "any", false, false, false, 51)) {
                        echo "<br /><span>";
                        echo twig_get_attribute($this->env, $this->source, $context["options"], "TITLE_EXPLAIN", [], "any", false, false, false, 51);
                        echo "</span>";
                    }
                    echo "</dt>
\t\t\t\t<dd>";
                    // line 52
                    echo twig_get_attribute($this->env, $this->source, $context["options"], "CONTENT", [], "any", false, false, false, 52);
                    echo "</dd>
\t\t\t\t";
                    // line 53
                    if ((((twig_get_attribute($this->env, $this->source, $context["options"], "KEY", [], "any", false, false, false, 53) == "allow_attachments") && ($context["S_EMPTY_POST_GROUPS"] ?? null)) || ((twig_get_attribute($this->env, $this->source, $context["options"], "KEY", [], "any", false, false, false, 53) == "allow_pm_attach") && ($context["S_EMPTY_PM_GROUPS"] ?? null)))) {
                        // line 54
                        echo "\t\t\t\t\t<dd><span class=\"error\">";
                        echo $this->extensions['phpbb\template\twig\extension']->lang((((twig_get_attribute($this->env, $this->source, $context["options"], "KEY", [], "any", false, false, false, 54) == "allow_attachments")) ? ("NO_EXT_GROUP_ALLOWED_POST") : ("NO_EXT_GROUP_ALLOWED_PM")), ($context["U_EXTENSION_GROUPS"] ?? null));
                        echo "</span></dd>
\t\t\t\t";
                    }
                    // line 56
                    echo "\t\t\t</dl>

\t\t";
                }
                // line 59
                echo "\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['options'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 60
            echo "\t</fieldset>

\t<fieldset>
\t\t<legend>";
            // line 63
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_SUBMIT_CHANGES");
            echo "</legend>
\t\t<p class=\"submit-buttons\">
\t\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
            // line 65
            echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
            echo "\" />&nbsp;
\t\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
            // line 66
            echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
            echo "\" />
\t\t</p>
\t</fieldset>

\t";
            // line 70
            if ( !($context["S_SECURE_DOWNLOADS"] ?? null)) {
                // line 71
                echo "\t\t<div class=\"errorbox\">
\t\t\t<p>";
                // line 72
                echo $this->extensions['phpbb\template\twig\extension']->lang("SECURE_DOWNLOAD_NOTICE");
                echo "</p>
\t\t</div>
\t";
            }
            // line 75
            echo "
\t<fieldset>
\t\t<legend>";
            // line 77
            echo $this->extensions['phpbb\template\twig\extension']->lang("SECURE_TITLE");
            echo "</legend>
\t\t<p>";
            // line 78
            echo $this->extensions['phpbb\template\twig\extension']->lang("DOWNLOAD_ADD_IPS_EXPLAIN");
            echo "</p>
\t<dl>
\t\t<dt><label for=\"ip_hostname\">";
            // line 80
            echo $this->extensions['phpbb\template\twig\extension']->lang("IP_HOSTNAME");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t<dd><textarea id=\"ip_hostname\" cols=\"40\" rows=\"3\" name=\"ips\"></textarea></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"exclude\">";
            // line 84
            echo $this->extensions['phpbb\template\twig\extension']->lang("IP_EXCLUDE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("EXCLUDE_ENTERED_IP");
            echo "</span></dt>
\t\t<dd><label><input type=\"radio\" id=\"exclude\" name=\"ipexclude\" value=\"1\" class=\"radio\" /> ";
            // line 85
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t<label><input type=\"radio\" name=\"ipexclude\" value=\"0\" checked=\"checked\" class=\"radio\" /> ";
            // line 86
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t</dl>

\t<p class=\"quick\">
\t\t<input class=\"button1\" type=\"submit\" id=\"securesubmit\" name=\"securesubmit\" value=\"";
            // line 90
            echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
            echo "\" />
\t</p>
\t</fieldset>

\t<fieldset>
\t\t<legend>";
            // line 95
            echo $this->extensions['phpbb\template\twig\extension']->lang("REMOVE_IPS");
            echo "</legend>
\t";
            // line 96
            if (($context["S_DEFINED_IPS"] ?? null)) {
                // line 97
                echo "\t\t\t<p>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("DOWNLOAD_REMOVE_IPS_EXPLAIN");
                echo "</p>
\t\t<dl>
\t\t\t<dt><label for=\"remove_ip_hostname\">";
                // line 99
                echo $this->extensions['phpbb\template\twig\extension']->lang("IP_HOSTNAME");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t\t<dd><select name=\"unip[]\" id=\"remove_ip_hostname\" multiple=\"multiple\" size=\"10\">";
                // line 100
                echo ($context["DEFINED_IPS"] ?? null);
                echo "</select></dd>
\t\t</dl>

\t\t<p class=\"quick\">
\t\t\t<input class=\"button1\" type=\"submit\" id=\"unsecuresubmit\" name=\"unsecuresubmit\" value=\"";
                // line 104
                echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
                echo "\" />
\t\t</p>
\t\t</fieldset>

\t";
            } else {
                // line 109
                echo "\t\t<p>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("NO_IPS_DEFINED");
                echo "</p>
\t";
            }
            // line 111
            echo "\t";
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t</form>

";
        } elseif (        // line 115
($context["S_EXTENSION_GROUPS"] ?? null)) {
            // line 116
            echo "
\t";
            // line 117
            if (($context["S_EDIT_GROUP"] ?? null)) {
                // line 118
                echo "\t\t<script>
\t\t// <![CDATA[
\t\t\tfunction update_image(newimage)
\t\t\t{
\t\t\t\tif (newimage == 'no_image')
\t\t\t\t{
\t\t\t\t\tdocument.getElementById('image_upload_icon').src = \"";
                // line 124
                echo ($context["ROOT_PATH"] ?? null);
                echo "images/spacer.gif\";
\t\t\t\t}
\t\t\t\telse
\t\t\t\t{
\t\t\t\t\tdocument.getElementById('image_upload_icon').src = \"";
                // line 128
                echo ($context["ROOT_PATH"] ?? null);
                echo ($context["IMG_PATH"] ?? null);
                echo "/\" + newimage;
\t\t\t\t}
\t\t\t}

\t\t\tfunction show_extensions(elem)
\t\t\t{
\t\t\t\tvar str = '';

\t\t\t\tfor (i = 0; i < elem.length; i++)
\t\t\t\t{
\t\t\t\t\tvar element = elem.options[i];
\t\t\t\t\tif (element.selected)
\t\t\t\t\t{
\t\t\t\t\t\tif (str)
\t\t\t\t\t\t{
\t\t\t\t\t\t\tstr = str + ', ';
\t\t\t\t\t\t}

\t\t\t\t\t\tstr = str + element.innerHTML;
\t\t\t\t\t}
\t\t\t\t}

\t\t\t\tif (document.all)
\t\t\t\t{
\t\t\t\t\tdocument.all.ext.innerText = str;
\t\t\t\t}
\t\t\t\telse if (document.getElementById('ext').textContent)
\t\t\t\t{
\t\t\t\t\tdocument.getElementById('ext').textContent = str;
\t\t\t\t}
\t\t\t\telse if (document.getElementById('ext').firstChild.nodeValue)
\t\t\t\t{
\t\t\t\t\tdocument.getElementById('ext').firstChild.nodeValue = str;
\t\t\t\t}
\t\t\t}

\t\t// ]]>
\t\t</script>

\t\t<form id=\"extgroups\" method=\"post\" action=\"";
                // line 167
                echo ($context["U_ACTION"] ?? null);
                echo "\">
\t\t<fieldset>
\t\t\t<input type=\"hidden\" name=\"action\" value=\"";
                // line 169
                echo ($context["ACTION"] ?? null);
                echo "\" />
\t\t\t<input type=\"hidden\" name=\"g\" value=\"";
                // line 170
                echo ($context["GROUP_ID"] ?? null);
                echo "\" />

\t\t\t<legend>";
                // line 172
                echo $this->extensions['phpbb\template\twig\extension']->lang("LEGEND");
                echo "</legend>
\t\t<dl>
\t\t\t<dt><label for=\"group_name\">";
                // line 174
                echo $this->extensions['phpbb\template\twig\extension']->lang("GROUP_NAME");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t\t<dd><input type=\"text\" id=\"group_name\" size=\"20\" maxlength=\"100\" name=\"group_name\" value=\"";
                // line 175
                echo ($context["GROUP_NAME"] ?? null);
                echo "\" /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"category\">";
                // line 178
                echo $this->extensions['phpbb\template\twig\extension']->lang("SPECIAL_CATEGORY");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label><br /><span>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("SPECIAL_CATEGORY_EXPLAIN");
                echo "</span></dt>
\t\t\t<dd>";
                // line 179
                echo ($context["S_CATEGORY_SELECT"] ?? null);
                echo "</dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"allowed\">";
                // line 182
                echo $this->extensions['phpbb\template\twig\extension']->lang("ALLOWED");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t\t<dd><input type=\"checkbox\" class=\"radio\" id=\"allowed\" name=\"allow_group\" value=\"1\"";
                // line 183
                if (($context["ALLOW_GROUP"] ?? null)) {
                    echo " checked=\"checked\"";
                }
                echo " /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"allow_in_pm\">";
                // line 186
                echo $this->extensions['phpbb\template\twig\extension']->lang("ALLOW_IN_PM");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t\t<dd><input type=\"checkbox\" class=\"radio\" id=\"allow_in_pm\" name=\"allow_in_pm\" value=\"1\"";
                // line 187
                if (($context["ALLOW_IN_PM"] ?? null)) {
                    echo " checked=\"checked\"";
                }
                echo " /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"upload_icon\">";
                // line 190
                echo $this->extensions['phpbb\template\twig\extension']->lang("UPLOAD_ICON");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t\t<dd><select name=\"upload_icon\" id=\"upload_icon\" onchange=\"update_image(this.options[selectedIndex].value);\">
\t\t\t\t\t<option value=\"no_image\"";
                // line 192
                if (($context["S_NO_IMAGE"] ?? null)) {
                    echo " selected=\"selected\"";
                }
                echo ">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("NO_IMAGE");
                echo "</option>";
                echo ($context["S_FILENAME_LIST"] ?? null);
                echo "
\t\t\t</select></dd>
\t\t\t<dd>&nbsp;<img ";
                // line 194
                if (($context["S_NO_IMAGE"] ?? null)) {
                    echo "src=\"";
                    echo ($context["ROOT_PATH"] ?? null);
                    echo "images/spacer.gif\"";
                } else {
                    echo "src=\"";
                    echo ($context["UPLOAD_ICON_SRC"] ?? null);
                    echo "\"";
                }
                echo " id=\"image_upload_icon\" alt=\"\" title=\"\" />&nbsp;</dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"extgroup_filesize\">";
                // line 197
                echo $this->extensions['phpbb\template\twig\extension']->lang("MAX_EXTGROUP_FILESIZE");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t\t<dd><input type=\"number\" id=\"extgroup_filesize\" min=\"0\" max=\"999999999999999\" step=\"any\" name=\"max_filesize\" value=\"";
                // line 198
                echo ($context["EXTGROUP_FILESIZE"] ?? null);
                echo "\" /> <select name=\"size_select\">";
                echo ($context["S_EXT_GROUP_SIZE_OPTIONS"] ?? null);
                echo "</select></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"assigned_extensions\">";
                // line 201
                echo $this->extensions['phpbb\template\twig\extension']->lang("ASSIGNED_EXTENSIONS");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t\t<dd><div id=\"ext\">";
                // line 202
                echo ($context["ASSIGNED_EXTENSIONS"] ?? null);
                echo "</div> <span>[<a href=\"";
                echo ($context["U_EXTENSIONS"] ?? null);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("GO_TO_EXTENSIONS");
                echo "</a> ]</span></dd>
\t\t\t<dd><select name=\"extensions[]\" id=\"assigned_extensions\" class=\"narrow\" onchange=\"show_extensions(this);\" multiple=\"multiple\" size=\"8\">";
                // line 203
                echo ($context["S_EXTENSION_OPTIONS"] ?? null);
                echo "</select></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"allowed_forums\">";
                // line 206
                echo $this->extensions['phpbb\template\twig\extension']->lang("ALLOWED_FORUMS");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label><br /><span>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("ALLOWED_FORUMS_EXPLAIN");
                echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" id=\"allowed_forums\" class=\"radio\" name=\"forum_select\" value=\"0\"";
                // line 207
                if ( !($context["S_FORUM_IDS"] ?? null)) {
                    echo " checked=\"checked\"";
                }
                echo " /> ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("ALLOW_ALL_FORUMS");
                echo "</label></dd>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"forum_select\" value=\"1\"";
                // line 208
                if (($context["S_FORUM_IDS"] ?? null)) {
                    echo " checked=\"checked\"";
                }
                echo " /> ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("ALLOW_SELECTED_FORUMS");
                echo "</label></dd>
\t\t\t<dd><select name=\"allowed_forums[]\" multiple=\"multiple\" size=\"8\">";
                // line 209
                echo ($context["S_FORUM_ID_OPTIONS"] ?? null);
                echo "</select></dd>
\t\t</dl>

\t\t</fieldset>
\t\t<fieldset>
\t\t\t<legend>";
                // line 214
                echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_SUBMIT_CHANGES");
                echo "</legend>
\t\t\t\t<p class=\"submit-buttons\">
\t\t\t\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
                // line 216
                echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
                echo "\" />&nbsp;
\t\t\t\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
                // line 217
                echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
                echo "\" />
\t\t\t\t</p>
\t\t";
                // line 219
                echo ($context["S_FORM_TOKEN"] ?? null);
                echo "
\t\t</fieldset>

\t\t</form>
\t";
            } else {
                // line 224
                echo "
\t\t<form id=\"extgroups\" method=\"post\" action=\"";
                // line 225
                echo ($context["U_ACTION"] ?? null);
                echo "\">
\t\t<fieldset class=\"tabulated\">
\t\t<legend>";
                // line 227
                echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE");
                echo "</legend>

\t\t<table class=\"table1\">
\t\t\t<col class=\"row1\" /><col class=\"row1\" /><col class=\"row2\" />
\t\t<thead>
\t\t<tr>
\t\t\t<th>";
                // line 233
                echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_GROUP");
                echo "</th>
\t\t\t<th>";
                // line 234
                echo $this->extensions['phpbb\template\twig\extension']->lang("SPECIAL_CATEGORY");
                echo "</th>
\t\t\t<th>";
                // line 235
                echo $this->extensions['phpbb\template\twig\extension']->lang("OPTIONS");
                echo "</th>
\t\t</tr>
\t\t</thead>
\t\t<tbody>
\t\t";
                // line 239
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "groups", [], "any", false, false, false, 239));
                foreach ($context['_seq'] as $context["_key"] => $context["groups"]) {
                    // line 240
                    echo "\t\t\t";
                    if ((twig_get_attribute($this->env, $this->source, $context["groups"], "S_ADD_SPACER", [], "any", false, false, false, 240) &&  !twig_get_attribute($this->env, $this->source, $context["groups"], "S_FIRST_ROW", [], "any", false, false, false, 240))) {
                        // line 241
                        echo "\t\t\t<tr>
\t\t\t\t<td class=\"spacer\" colspan=\"3\">&nbsp;</td>
\t\t\t</tr>
\t\t\t";
                    }
                    // line 245
                    echo "\t\t\t<tr>
\t\t\t\t<td><strong>";
                    // line 246
                    echo twig_get_attribute($this->env, $this->source, $context["groups"], "GROUP_NAME", [], "any", false, false, false, 246);
                    echo "</strong>
\t\t\t\t\t";
                    // line 247
                    if ((twig_get_attribute($this->env, $this->source, $context["groups"], "S_GROUP_ALLOWED", [], "any", false, false, false, 247) &&  !twig_get_attribute($this->env, $this->source, $context["groups"], "S_ALLOWED_IN_PM", [], "any", false, false, false, 247))) {
                        echo "<br /><span>&raquo; ";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("NOT_ALLOWED_IN_PM");
                        echo "</span>
\t\t\t\t\t";
                    } elseif ((twig_get_attribute($this->env, $this->source,                     // line 248
$context["groups"], "S_ALLOWED_IN_PM", [], "any", false, false, false, 248) &&  !twig_get_attribute($this->env, $this->source, $context["groups"], "S_GROUP_ALLOWED", [], "any", false, false, false, 248))) {
                        echo "<br /><span>&raquo; ";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("ONLY_ALLOWED_IN_PM");
                        echo "</span>
\t\t\t\t\t";
                    } elseif (( !twig_get_attribute($this->env, $this->source,                     // line 249
$context["groups"], "S_GROUP_ALLOWED", [], "any", false, false, false, 249) &&  !twig_get_attribute($this->env, $this->source, $context["groups"], "S_ALLOWED_IN_PM", [], "any", false, false, false, 249))) {
                        echo "<br /><span>&raquo; ";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("NOT_ALLOWED_IN_PM_POST");
                        echo "</span>
\t\t\t\t\t";
                    } else {
                        // line 250
                        echo "<br /><span>&raquo; ";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("ALLOWED_IN_PM_POST");
                        echo "</span>";
                    }
                    // line 251
                    echo "\t\t\t\t</td>
\t\t\t\t<td>";
                    // line 252
                    echo twig_get_attribute($this->env, $this->source, $context["groups"], "CATEGORY", [], "any", false, false, false, 252);
                    echo "</td>
\t\t\t\t<td align=\"center\" valign=\"middle\" style=\"white-space: nowrap;\">&nbsp;<a href=\"";
                    // line 253
                    echo twig_get_attribute($this->env, $this->source, $context["groups"], "U_EDIT", [], "any", false, false, false, 253);
                    echo "\">";
                    echo ($context["ICON_EDIT"] ?? null);
                    echo "</a>&nbsp;&nbsp;<a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["groups"], "U_DELETE", [], "any", false, false, false, 253);
                    echo "\" data-ajax=\"row_delete\">";
                    echo ($context["ICON_DELETE"] ?? null);
                    echo "</a>&nbsp;</td>
\t\t\t</tr>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['groups'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 256
                echo "\t\t</tbody>
\t\t</table>
\t\t<p class=\"quick\">
\t\t\t\t";
                // line 259
                echo $this->extensions['phpbb\template\twig\extension']->lang("CREATE_GROUP");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo " <input type=\"text\" name=\"group_name\" maxlength=\"30\" />
\t\t\t\t<input class=\"button2\" name=\"add\" type=\"submit\" value=\"";
                // line 260
                echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
                echo "\" />
\t\t</p>
\t\t";
                // line 262
                echo ($context["S_FORM_TOKEN"] ?? null);
                echo "
\t\t</fieldset>
\t\t</form>

\t";
            }
            // line 267
            echo "
";
        } elseif (        // line 268
($context["S_EXTENSIONS"] ?? null)) {
            // line 269
            echo "
\t<form id=\"add_ext\" method=\"post\" action=\"";
            // line 270
            echo ($context["U_ACTION"] ?? null);
            echo "\">
\t<fieldset>
\t\t<legend>";
            // line 272
            echo $this->extensions['phpbb\template\twig\extension']->lang("ADD_EXTENSION");
            echo "</legend>
\t<dl>
\t\t<dt><label for=\"add_extension\">";
            // line 274
            echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION");
            echo "</label></dt>
\t\t<dd><input type=\"text\" id=\"add_extension\" size=\"20\" maxlength=\"100\" name=\"add_extension\" value=\"";
            // line 275
            echo ($context["ADD_EXTENSION"] ?? null);
            echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"extension_group\">";
            // line 278
            echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_GROUP");
            echo "</label></dt>
\t\t<dd>";
            // line 279
            echo ($context["GROUP_SELECT_OPTIONS"] ?? null);
            echo "</dd>
\t</dl>

\t<p class=\"quick\">
\t\t<input type=\"submit\" id=\"add_extension_check\" name=\"add_extension_check\" class=\"button2\" value=\"";
            // line 283
            echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
            echo "\" />
\t</p>
\t";
            // line 285
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t</form>

\t<form id=\"change_ext\" method=\"post\" action=\"";
            // line 289
            echo ($context["U_ACTION"] ?? null);
            echo "\">

\t<fieldset class=\"tabulated\">
\t<legend>";
            // line 292
            echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE");
            echo "</legend>

\t<table class=\"table1\">
\t\t<col class=\"row1\" /><col class=\"row1\" /><col class=\"row2\" />
\t<thead>
\t<tr>
\t\t<th>";
            // line 298
            echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION");
            echo "</th>
\t\t<th>";
            // line 299
            echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_GROUP");
            echo "</th>
\t\t<th>";
            // line 300
            echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE");
            echo "</th>
\t</tr>
\t</thead>
\t<tbody>
\t";
            // line 304
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "extensions", [], "any", false, false, false, 304));
            foreach ($context['_seq'] as $context["_key"] => $context["extensions"]) {
                // line 305
                echo "\t\t";
                if (twig_get_attribute($this->env, $this->source, $context["extensions"], "S_SPACER", [], "any", false, false, false, 305)) {
                    // line 306
                    echo "\t\t<tr>
\t\t\t<td class=\"spacer\" colspan=\"3\">&nbsp;</td>
\t\t</tr>
\t\t";
                }
                // line 310
                echo "\t\t<tr>
\t\t\t<td><strong>";
                // line 311
                echo twig_get_attribute($this->env, $this->source, $context["extensions"], "EXTENSION", [], "any", false, false, false, 311);
                echo "</strong></td>
\t\t\t<td>";
                // line 312
                echo twig_get_attribute($this->env, $this->source, $context["extensions"], "GROUP_OPTIONS", [], "any", false, false, false, 312);
                echo "</td>
\t\t\t<td><input type=\"checkbox\" class=\"radio\" name=\"extension_id_list[]\" value=\"";
                // line 313
                echo twig_get_attribute($this->env, $this->source, $context["extensions"], "EXTENSION_ID", [], "any", false, false, false, 313);
                echo "\" /><input type=\"hidden\" name=\"extension_change_list[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["extensions"], "EXTENSION_ID", [], "any", false, false, false, 313);
                echo "\" /></td>
\t\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extensions'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 316
            echo "\t</tbody>
\t</table>

\t</fieldset>
\t<fieldset>
\t\t<legend>";
            // line 321
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_SUBMIT_CHANGES");
            echo "</legend>
\t\t<p class=\"submit-buttons\">
\t\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
            // line 323
            echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
            echo "\" />&nbsp;
\t\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
            // line 324
            echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
            echo "\" />
\t\t</p>

\t";
            // line 327
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t</form>

";
        } elseif (        // line 331
($context["S_ORPHAN"] ?? null)) {
            // line 332
            echo "
\t<form id=\"orphan\" method=\"post\" action=\"";
            // line 333
            echo ($context["U_ACTION"] ?? null);
            echo "\">

\t<fieldset class=\"tabulated\">
\t<legend>";
            // line 336
            echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE");
            echo "</legend>

\t<div class=\"pagination top-pagination\">
\t";
            // line 339
            if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pagination", [], "any", false, false, false, 339)) || ($context["TOTAL_FILES"] ?? null))) {
                // line 340
                echo "\t\t";
                echo $this->extensions['phpbb\template\twig\extension']->lang("NUMBER_FILES");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo " ";
                echo ($context["TOTAL_FILES"] ?? null);
                echo " &bull; ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("TOTAL_SIZE");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo " ";
                echo ($context["TOTAL_SIZE"] ?? null);
                echo "
\t\t";
                // line 341
                if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pagination", [], "any", false, false, false, 341))) {
                    // line 342
                    echo "\t\t\t&bull; ";
                    $location = "pagination.html";
                    $namespace = false;
                    if (strpos($location, '@') === 0) {
                        $namespace = substr($location, 1, strpos($location, '/') - 1);
                        $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                        $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                    }
                    $this->loadTemplate("pagination.html", "acp_attachments.html", 342)->display($context);
                    if ($namespace) {
                        $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                    }
                    // line 343
                    echo "\t\t";
                } else {
                    // line 344
                    echo "\t\t\t&bull; ";
                    echo ($context["PAGE_NUMBER"] ?? null);
                    echo "
\t\t";
                }
                // line 346
                echo "\t";
            }
            // line 347
            echo "\t</div>

\t";
            // line 349
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "orphan", [], "any", false, false, false, 349))) {
                // line 350
                echo "\t\t<table class=\"table1 zebra-table fixed-width-table\">
\t\t<thead>
\t\t<tr>
\t\t\t<th>";
                // line 353
                echo $this->extensions['phpbb\template\twig\extension']->lang("FILENAME");
                echo "</th>
\t\t\t<th style=\"width: 15%;\">";
                // line 354
                echo $this->extensions['phpbb\template\twig\extension']->lang("FILEDATE");
                echo "</th>
\t\t\t<th style=\"width: 15%;\">";
                // line 355
                echo $this->extensions['phpbb\template\twig\extension']->lang("FILESIZE");
                echo "</th>
\t\t\t<th style=\"width: 15%;\">";
                // line 356
                echo $this->extensions['phpbb\template\twig\extension']->lang("ATTACH_POST_ID");
                echo "</th>
\t\t\t<th style=\"width: 15%;\">";
                // line 357
                echo $this->extensions['phpbb\template\twig\extension']->lang("ATTACH_TO_POST");
                echo "</th>
\t\t\t<th style=\"width: 15%;\">";
                // line 358
                echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE");
                echo "</th>
\t\t</tr>
\t\t</thead>
\t\t<tbody>
\t\t";
                // line 362
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "orphan", [], "any", false, false, false, 362));
                foreach ($context['_seq'] as $context["_key"] => $context["orphan"]) {
                    // line 363
                    echo "\t\t\t<tr>
\t\t\t\t<td><a href=\"";
                    // line 364
                    echo twig_get_attribute($this->env, $this->source, $context["orphan"], "U_FILE", [], "any", false, false, false, 364);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["orphan"], "REAL_FILENAME", [], "any", false, false, false, 364);
                    echo "</a></td>
\t\t\t\t<td>";
                    // line 365
                    echo twig_get_attribute($this->env, $this->source, $context["orphan"], "FILETIME", [], "any", false, false, false, 365);
                    echo "</td>
\t\t\t\t<td>";
                    // line 366
                    echo twig_get_attribute($this->env, $this->source, $context["orphan"], "FILESIZE", [], "any", false, false, false, 366);
                    echo "</td>
\t\t\t\t<td><strong>";
                    // line 367
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ATTACH_ID");
                    echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                    echo " </strong><input type=\"number\" min=\"0\" max=\"9999999999\" name=\"post_id[";
                    echo twig_get_attribute($this->env, $this->source, $context["orphan"], "ATTACH_ID", [], "any", false, false, false, 367);
                    echo "]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["orphan"], "POST_ID", [], "any", false, false, false, 367);
                    echo "\" style=\"width: 75%;\" /></td>
\t\t\t\t<td><input type=\"checkbox\" class=\"radio\" name=\"add[";
                    // line 368
                    echo twig_get_attribute($this->env, $this->source, $context["orphan"], "ATTACH_ID", [], "any", false, false, false, 368);
                    echo "]\" /></td>
\t\t\t\t<td><input type=\"checkbox\" class=\"radio\" name=\"delete[";
                    // line 369
                    echo twig_get_attribute($this->env, $this->source, $context["orphan"], "ATTACH_ID", [], "any", false, false, false, 369);
                    echo "]\" /></td>
\t\t\t</tr>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['orphan'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 372
                echo "\t\t<tr class=\"row4\">
\t\t\t<td colspan=\"4\">&nbsp;</td>
\t\t\t<td class=\"small\"><a href=\"#\" onclick=\"marklist('orphan', 'add', true); return false;\">";
                // line 374
                echo $this->extensions['phpbb\template\twig\extension']->lang("MARK_ALL");
                echo "</a> :: <a href=\"#\" onclick=\"marklist('orphan', 'add', false); return false;\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("UNMARK_ALL");
                echo "</a></td>
\t\t\t<td class=\"small\"><a href=\"#\" onclick=\"marklist('orphan', 'delete', true); return false;\">";
                // line 375
                echo $this->extensions['phpbb\template\twig\extension']->lang("MARK_ALL");
                echo "</a> :: <a href=\"#\" onclick=\"marklist('orphan', 'delete', false); return false;\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("UNMARK_ALL");
                echo "</a></td>
\t\t</tr>
\t\t</tbody>
\t\t</table>
\t";
            } else {
                // line 380
                echo "\t\t<div class=\"errorbox\">
\t\t\t<p>";
                // line 381
                echo $this->extensions['phpbb\template\twig\extension']->lang("NO_ATTACHMENTS");
                echo "</p>
\t\t</div>
\t";
            }
            // line 384
            echo "
\t";
            // line 385
            if (($context["TOTAL_FILES"] ?? null)) {
                // line 386
                echo "\t<div class=\"pagination\">
\t\t";
                // line 387
                echo $this->extensions['phpbb\template\twig\extension']->lang("NUMBER_FILES");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo " ";
                echo ($context["TOTAL_FILES"] ?? null);
                echo " &bull; ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("TOTAL_SIZE");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo " ";
                echo ($context["TOTAL_SIZE"] ?? null);
                echo "
\t\t";
                // line 388
                if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pagination", [], "any", false, false, false, 388))) {
                    // line 389
                    echo "\t\t\t&bull; ";
                    $location = "pagination.html";
                    $namespace = false;
                    if (strpos($location, '@') === 0) {
                        $namespace = substr($location, 1, strpos($location, '/') - 1);
                        $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                        $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                    }
                    $this->loadTemplate("pagination.html", "acp_attachments.html", 389)->display($context);
                    if ($namespace) {
                        $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                    }
                    // line 390
                    echo "\t\t";
                } else {
                    // line 391
                    echo "\t\t\t&bull; ";
                    echo ($context["PAGE_NUMBER"] ?? null);
                    echo "
\t\t";
                }
                // line 393
                echo "\t</div>
\t";
            }
            // line 395
            echo "
\t";
            // line 396
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "orphan", [], "any", false, false, false, 396))) {
                // line 397
                echo "\t</fieldset>
\t<fieldset>
\t\t<legend>";
                // line 399
                echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_SUBMIT_CHANGES");
                echo "</legend>
\t\t\t<p class=\"submit-buttons\">
\t\t\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
                // line 401
                echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
                echo "\" />&nbsp;
\t\t\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
                // line 402
                echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
                echo "\" />
\t\t\t</p>
\t";
            }
            // line 405
            echo "
\t";
            // line 406
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t</form>

";
        } elseif (        // line 410
($context["S_MANAGE"] ?? null)) {
            // line 411
            echo "
\t<form id=\"attachments\" method=\"post\" action=\"";
            // line 412
            echo ($context["U_ACTION"] ?? null);
            echo "\">

\t<fieldset class=\"tabulated\">
\t<legend>";
            // line 415
            echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE");
            echo "</legend>

\t<div class=\"pagination top-pagination\">
\t";
            // line 418
            if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pagination", [], "any", false, false, false, 418)) || ($context["TOTAL_FILES"] ?? null))) {
                // line 419
                echo "\t\t";
                echo $this->extensions['phpbb\template\twig\extension']->lang("NUMBER_FILES");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo " ";
                echo ($context["TOTAL_FILES"] ?? null);
                echo " &bull; ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("TOTAL_SIZE");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo " ";
                echo ($context["TOTAL_SIZE"] ?? null);
                echo "
\t\t";
                // line 420
                if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pagination", [], "any", false, false, false, 420))) {
                    // line 421
                    echo "\t\t\t&bull; ";
                    $location = "pagination.html";
                    $namespace = false;
                    if (strpos($location, '@') === 0) {
                        $namespace = substr($location, 1, strpos($location, '/') - 1);
                        $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                        $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                    }
                    $this->loadTemplate("pagination.html", "acp_attachments.html", 421)->display($context);
                    if ($namespace) {
                        $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                    }
                    // line 422
                    echo "\t\t";
                } else {
                    // line 423
                    echo "\t\t\t&bull; ";
                    echo ($context["PAGE_NUMBER"] ?? null);
                    echo "
\t\t";
                }
                // line 425
                echo "\t";
            }
            // line 426
            echo "\t</div>

";
            // line 428
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "attachments", [], "any", false, false, false, 428))) {
                // line 429
                echo "\t<table class=\"table1 zebra-table fixed-width-table\">
\t<thead>
\t<tr>
\t\t<th>";
                // line 432
                echo $this->extensions['phpbb\template\twig\extension']->lang("FILENAME");
                echo "</th>
\t\t<th style=\"width: 15%;\">";
                // line 433
                echo $this->extensions['phpbb\template\twig\extension']->lang("POSTED");
                echo "</th>
\t\t<th style=\"width: 15%;\" class=\"centered-text\">";
                // line 434
                echo $this->extensions['phpbb\template\twig\extension']->lang("FILESIZE");
                echo "</th>
\t\t<th style=\"width: 10%;\" class=\"centered-text\">";
                // line 435
                echo $this->extensions['phpbb\template\twig\extension']->lang("MARK");
                echo "</th>
\t</tr>
\t</thead>
\t<tbody>
\t";
                // line 439
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["attachments"]);
                foreach ($context['_seq'] as $context["_key"] => $context["attachments"]) {
                    // line 440
                    echo "\t\t<tr>
\t\t\t<td>
\t\t\t\t";
                    // line 442
                    echo ($this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_GROUP") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
                    echo " <strong>";
                    echo twig_get_attribute($this->env, $this->source, $context["attachments"], "EXT_GROUP_NAME", [], "any", false, false, false, 442);
                    echo "</strong>
\t\t\t\t";
                    // line 443
                    if (twig_get_attribute($this->env, $this->source, $context["attachments"], "S_IN_MESSAGE", [], "any", false, false, false, 443)) {
                        // line 444
                        echo "\t\t\t\t\t<br>";
                        echo twig_get_attribute($this->env, $this->source, $context["attachments"], "L_DOWNLOAD_COUNT", [], "any", false, false, false, 444);
                        echo "
\t\t\t\t\t<br>";
                        // line 445
                        echo $this->extensions['phpbb\template\twig\extension']->lang("IN");
                        echo " ";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("PRIVATE_MESSAGE");
                        echo "
\t\t\t\t";
                    } else {
                        // line 447
                        echo "\t\t\t\t\t<br><a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["attachments"], "U_FILE", [], "any", false, false, false, 447);
                        echo "\"><strong>";
                        echo twig_get_attribute($this->env, $this->source, $context["attachments"], "REAL_FILENAME", [], "any", false, false, false, 447);
                        echo "</strong></a>
\t\t\t\t\t";
                        // line 448
                        if (twig_get_attribute($this->env, $this->source, $context["attachments"], "COMMENT", [], "any", false, false, false, 448)) {
                            echo "<br>";
                            echo twig_get_attribute($this->env, $this->source, $context["attachments"], "COMMENT", [], "any", false, false, false, 448);
                        }
                        // line 449
                        echo "\t\t\t\t\t<br>";
                        echo twig_get_attribute($this->env, $this->source, $context["attachments"], "L_DOWNLOAD_COUNT", [], "any", false, false, false, 449);
                        echo "
\t\t\t\t\t<br>";
                        // line 450
                        echo ($this->extensions['phpbb\template\twig\extension']->lang("TOPIC") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
                        echo " <a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["attachments"], "U_VIEW_TOPIC", [], "any", false, false, false, 450);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["attachments"], "TOPIC_TITLE", [], "any", false, false, false, 450);
                        echo "</a>
\t\t\t\t";
                    }
                    // line 452
                    echo "\t\t\t</td>
\t\t\t<td>";
                    // line 453
                    echo twig_get_attribute($this->env, $this->source, $context["attachments"], "FILETIME", [], "any", false, false, false, 453);
                    echo "<br>";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("POST_BY_AUTHOR");
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["attachments"], "ATTACHMENT_POSTER", [], "any", false, false, false, 453);
                    echo "</td>
\t\t\t<td class=\"centered-text\">";
                    // line 454
                    echo twig_get_attribute($this->env, $this->source, $context["attachments"], "FILESIZE", [], "any", false, false, false, 454);
                    echo "</td>
\t\t\t<td class=\"centered-text\"><input type=\"checkbox\" class=\"radio\" name=\"delete[";
                    // line 455
                    echo twig_get_attribute($this->env, $this->source, $context["attachments"], "ATTACH_ID", [], "any", false, false, false, 455);
                    echo "]\" /></td>
\t\t</tr>
\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attachments'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 458
                echo "\t</tbody>
\t</table>
";
            } else {
                // line 461
                echo "\t<div class=\"errorbox\">
\t\t<p>";
                // line 462
                echo $this->extensions['phpbb\template\twig\extension']->lang("NO_ATTACHMENTS");
                echo "</p>
\t</div>
";
            }
            // line 465
            echo "
\t";
            // line 466
            if (($context["TOTAL_FILES"] ?? null)) {
                // line 467
                echo "\t<div class=\"pagination\">
\t\t";
                // line 468
                echo $this->extensions['phpbb\template\twig\extension']->lang("NUMBER_FILES");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo " ";
                echo ($context["TOTAL_FILES"] ?? null);
                echo " &bull; ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("TOTAL_SIZE");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo " ";
                echo ($context["TOTAL_SIZE"] ?? null);
                echo "
\t\t";
                // line 469
                if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pagination", [], "any", false, false, false, 469))) {
                    // line 470
                    echo "\t\t\t&bull; ";
                    $location = "pagination.html";
                    $namespace = false;
                    if (strpos($location, '@') === 0) {
                        $namespace = substr($location, 1, strpos($location, '/') - 1);
                        $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                        $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                    }
                    $this->loadTemplate("pagination.html", "acp_attachments.html", 470)->display($context);
                    if ($namespace) {
                        $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                    }
                    // line 471
                    echo "\t\t";
                } else {
                    // line 472
                    echo "\t\t\t&bull; ";
                    echo ($context["PAGE_NUMBER"] ?? null);
                    echo "
\t\t";
                }
                // line 474
                echo "\t</div>
\t";
            }
            // line 476
            echo "
\t<fieldset class=\"display-options\">
\t\t";
            // line 478
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
\t\t<input class=\"button2\" type=\"submit\" value=\"";
            // line 479
            echo $this->extensions['phpbb\template\twig\extension']->lang("GO");
            echo "\" name=\"sort\" />
\t</fieldset>

\t<hr />

";
            // line 484
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "attachments", [], "any", false, false, false, 484))) {
                // line 485
                echo "\t<fieldset class=\"quick\">
\t\t<input class=\"button2\" type=\"submit\" name=\"submit\" value=\"";
                // line 486
                echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE_MARKED");
                echo "\" /><br />
\t\t<p class=\"small\">
\t\t\t<a href=\"#\" onclick=\"marklist('attachments', 'delete', true); return false;\">";
                // line 488
                echo $this->extensions['phpbb\template\twig\extension']->lang("MARK_ALL");
                echo "</a> &bull;
\t\t\t<a href=\"#\" onclick=\"marklist('attachments', 'delete', false); return false;\">";
                // line 489
                echo $this->extensions['phpbb\template\twig\extension']->lang("UNMARK_ALL");
                echo "</a>
\t\t</p>
\t</fieldset>
";
            }
            // line 493
            echo "\t";
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t</form>

\t";
            // line 497
            if (($context["S_ACTION_OPTIONS"] ?? null)) {
                // line 498
                echo "\t<fieldset>
\t\t<legend>";
                // line 499
                echo $this->extensions['phpbb\template\twig\extension']->lang("RESYNC_STATS");
                echo "</legend>
\t\t<form id=\"action_stats_form\" method=\"post\" action=\"";
                // line 500
                echo ($context["U_ACTION"] ?? null);
                echo "\">
\t\t\t<dl>
\t\t\t\t<dt><label for=\"action_stats\">";
                // line 502
                echo $this->extensions['phpbb\template\twig\extension']->lang("RESYNC_FILES_STATS");
                echo "</label><br /><span>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("RESYNC_FILES_STATS_EXPLAIN");
                echo "</span></dt>
\t\t\t\t<dd><input type=\"hidden\" name=\"action\" value=\"stats\" /><input class=\"button2\" type=\"submit\" id=\"action_stats\" name=\"action_stats\" value=\"";
                // line 503
                echo $this->extensions['phpbb\template\twig\extension']->lang("RUN");
                echo "\" /></dd>
\t\t\t</dl>
\t\t</form>
\t</fieldset>
\t";
            }
        }
        // line 509
        echo "
";
        // line 510
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_attachments.html", 510)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_attachments.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1439 => 510,  1436 => 509,  1427 => 503,  1421 => 502,  1416 => 500,  1412 => 499,  1409 => 498,  1407 => 497,  1399 => 493,  1392 => 489,  1388 => 488,  1383 => 486,  1380 => 485,  1378 => 484,  1370 => 479,  1356 => 478,  1352 => 476,  1348 => 474,  1342 => 472,  1339 => 471,  1326 => 470,  1324 => 469,  1312 => 468,  1309 => 467,  1307 => 466,  1304 => 465,  1298 => 462,  1295 => 461,  1290 => 458,  1281 => 455,  1277 => 454,  1269 => 453,  1266 => 452,  1257 => 450,  1252 => 449,  1247 => 448,  1240 => 447,  1233 => 445,  1228 => 444,  1226 => 443,  1220 => 442,  1216 => 440,  1212 => 439,  1205 => 435,  1201 => 434,  1197 => 433,  1193 => 432,  1188 => 429,  1186 => 428,  1182 => 426,  1179 => 425,  1173 => 423,  1170 => 422,  1157 => 421,  1155 => 420,  1142 => 419,  1140 => 418,  1134 => 415,  1128 => 412,  1125 => 411,  1123 => 410,  1116 => 406,  1113 => 405,  1107 => 402,  1103 => 401,  1098 => 399,  1094 => 397,  1092 => 396,  1089 => 395,  1085 => 393,  1079 => 391,  1076 => 390,  1063 => 389,  1061 => 388,  1049 => 387,  1046 => 386,  1044 => 385,  1041 => 384,  1035 => 381,  1032 => 380,  1022 => 375,  1016 => 374,  1012 => 372,  1003 => 369,  999 => 368,  990 => 367,  986 => 366,  982 => 365,  976 => 364,  973 => 363,  969 => 362,  962 => 358,  958 => 357,  954 => 356,  950 => 355,  946 => 354,  942 => 353,  937 => 350,  935 => 349,  931 => 347,  928 => 346,  922 => 344,  919 => 343,  906 => 342,  904 => 341,  891 => 340,  889 => 339,  883 => 336,  877 => 333,  874 => 332,  872 => 331,  865 => 327,  859 => 324,  855 => 323,  850 => 321,  843 => 316,  832 => 313,  828 => 312,  824 => 311,  821 => 310,  815 => 306,  812 => 305,  808 => 304,  801 => 300,  797 => 299,  793 => 298,  784 => 292,  778 => 289,  771 => 285,  766 => 283,  759 => 279,  755 => 278,  749 => 275,  745 => 274,  740 => 272,  735 => 270,  732 => 269,  730 => 268,  727 => 267,  719 => 262,  714 => 260,  709 => 259,  704 => 256,  689 => 253,  685 => 252,  682 => 251,  677 => 250,  670 => 249,  664 => 248,  658 => 247,  654 => 246,  651 => 245,  645 => 241,  642 => 240,  638 => 239,  631 => 235,  627 => 234,  623 => 233,  614 => 227,  609 => 225,  606 => 224,  598 => 219,  593 => 217,  589 => 216,  584 => 214,  576 => 209,  568 => 208,  560 => 207,  553 => 206,  547 => 203,  539 => 202,  534 => 201,  526 => 198,  521 => 197,  507 => 194,  496 => 192,  490 => 190,  482 => 187,  477 => 186,  469 => 183,  464 => 182,  458 => 179,  451 => 178,  445 => 175,  440 => 174,  435 => 172,  430 => 170,  426 => 169,  421 => 167,  378 => 128,  371 => 124,  363 => 118,  361 => 117,  358 => 116,  356 => 115,  348 => 111,  342 => 109,  334 => 104,  327 => 100,  322 => 99,  316 => 97,  314 => 96,  310 => 95,  302 => 90,  295 => 86,  291 => 85,  284 => 84,  276 => 80,  271 => 78,  267 => 77,  263 => 75,  257 => 72,  254 => 71,  252 => 70,  245 => 66,  241 => 65,  236 => 63,  231 => 60,  225 => 59,  220 => 56,  214 => 54,  212 => 53,  208 => 52,  195 => 51,  191 => 49,  186 => 47,  183 => 46,  179 => 44,  176 => 43,  173 => 42,  169 => 41,  165 => 40,  162 => 39,  160 => 38,  157 => 37,  153 => 35,  146 => 33,  132 => 32,  127 => 31,  123 => 30,  117 => 28,  115 => 27,  112 => 26,  106 => 23,  102 => 22,  99 => 21,  97 => 20,  94 => 19,  88 => 16,  84 => 15,  81 => 14,  79 => 13,  74 => 11,  69 => 9,  66 => 8,  56 => 6,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_attachments.html", "");
    }
}
