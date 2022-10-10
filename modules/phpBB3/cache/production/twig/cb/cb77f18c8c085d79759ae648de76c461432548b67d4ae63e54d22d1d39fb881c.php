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

/* acp_permissions.html */
class __TwigTemplate_ed445195a4f60e6e212a01e401f72f4ed99b07fdf4a19053584d979204743745 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_permissions.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

";
        // line 5
        if (($context["S_INTRO"] ?? null)) {
            // line 6
            echo "
\t<h1>";
            // line 7
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_PERMISSIONS");
            echo "</h1>

\t";
            // line 9
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_PERMISSIONS_EXPLAIN");
            echo "

";
        }
        // line 12
        echo "
";
        // line 13
        if (($context["S_SELECT_VICTIM"] ?? null)) {
            // line 14
            echo "
\t";
            // line 15
            if (($context["U_BACK"] ?? null)) {
                echo "<a href=\"";
                echo ($context["U_BACK"] ?? null);
                echo "\" style=\"float: ";
                echo ($context["S_CONTENT_FLOW_END"] ?? null);
                echo ";\">&laquo; ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("BACK");
                echo "</a>";
            }
            // line 16
            echo "
\t<h1>";
            // line 17
            echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE");
            echo "</h1>

\t<p>";
            // line 19
            echo $this->extensions['phpbb\template\twig\extension']->lang("EXPLAIN");
            echo "</p>

\t";
            // line 21
            if (($context["S_FORUM_NAMES"] ?? null)) {
                // line 22
                echo "\t\t<p><strong>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("FORUMS");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</strong> ";
                echo ($context["FORUM_NAMES"] ?? null);
                echo "</p>
\t";
            }
            // line 24
            echo "
\t";
            // line 25
            if (($context["S_SELECT_FORUM"] ?? null)) {
                // line 26
                echo "
\t\t<form id=\"select_victim\" method=\"post\" action=\"";
                // line 27
                echo ($context["U_ACTION"] ?? null);
                echo "\">

\t\t<fieldset>
\t\t\t<legend>";
                // line 30
                echo $this->extensions['phpbb\template\twig\extension']->lang("LOOK_UP_FORUM");
                echo "</legend>
\t\t\t";
                // line 31
                if (($context["S_FORUM_MULTIPLE"] ?? null)) {
                    echo "<p>";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("LOOK_UP_FORUMS_EXPLAIN");
                    echo "</p>";
                }
                // line 32
                echo "\t\t<dl>
\t\t\t<dt>";
                // line 33
                echo "<label for=\"forum\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("LOOK_UP_FORUM");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label>";
                echo "</dt>
\t\t\t<dd><select id=\"forum\" name=\"forum_id[]\"";
                // line 34
                if (($context["S_FORUM_MULTIPLE"] ?? null)) {
                    echo " multiple=\"multiple\"";
                }
                echo " size=\"10\">";
                echo ($context["S_FORUM_OPTIONS"] ?? null);
                echo "</select></dd>
\t\t\t";
                // line 35
                if (($context["S_FORUM_ALL"] ?? null)) {
                    echo "<dd><label><input type=\"checkbox\" class=\"radio\" name=\"all_forums\" value=\"1\" /> ";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ALL_FORUMS");
                    echo "</label></dd>";
                }
                // line 36
                echo "\t\t</dl>

\t\t<p class=\"quick\">
\t\t\t";
                // line 39
                echo ($context["S_HIDDEN_FIELDS"] ?? null);
                echo "
\t\t\t";
                // line 40
                echo ($context["S_FORM_TOKEN"] ?? null);
                echo "
\t\t\t<input type=\"submit\" name=\"submit\" value=\"";
                // line 41
                echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
                echo "\" class=\"button1\" />
\t\t</p>

\t\t</fieldset>
\t\t</form>

\t\t";
                // line 47
                if (($context["S_FORUM_MULTIPLE"] ?? null)) {
                    // line 48
                    echo "
\t\t\t<form id=\"select_subforum\" method=\"post\" action=\"";
                    // line 49
                    echo ($context["U_ACTION"] ?? null);
                    echo "\">

\t\t\t<fieldset>
\t\t\t\t<legend>";
                    // line 52
                    echo $this->extensions['phpbb\template\twig\extension']->lang("LOOK_UP_FORUM");
                    echo "</legend>
\t\t\t\t<p>";
                    // line 53
                    echo $this->extensions['phpbb\template\twig\extension']->lang("SELECT_FORUM_SUBFORUM_EXPLAIN");
                    echo "</p>
\t\t\t<dl>
\t\t\t\t<dt>";
                    // line 55
                    echo "<label for=\"sforum\">";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("LOOK_UP_FORUM");
                    echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                    echo "</label>";
                    echo "</dt>
\t\t\t\t<dd><select id=\"sforum\" name=\"subforum_id\">";
                    // line 56
                    echo ($context["S_SUBFORUM_OPTIONS"] ?? null);
                    echo "</select></dd>
\t\t\t</dl>

\t\t\t<p class=\"quick\">
\t\t\t\t";
                    // line 60
                    echo ($context["S_HIDDEN_FIELDS"] ?? null);
                    echo "
\t\t\t\t";
                    // line 61
                    echo ($context["S_FORM_TOKEN"] ?? null);
                    echo "
\t\t\t\t<input type=\"submit\" name=\"submit\" value=\"";
                    // line 62
                    echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
                    echo "\" class=\"button1\" />
\t\t\t</p>

\t\t\t</fieldset>
\t\t\t</form>

\t\t";
                }
                // line 69
                echo "
\t";
            } elseif ((            // line 70
($context["S_SELECT_USER"] ?? null) && ($context["S_CAN_SELECT_USER"] ?? null))) {
                // line 71
                echo "
\t\t<form id=\"select_victim\" method=\"post\" action=\"";
                // line 72
                echo ($context["U_ACTION"] ?? null);
                echo "\">

\t\t<fieldset>
\t\t\t<legend>";
                // line 75
                echo $this->extensions['phpbb\template\twig\extension']->lang("LOOK_UP_USER");
                echo "</legend>
\t\t<dl>
\t\t\t<dt><label for=\"username\">";
                // line 77
                echo $this->extensions['phpbb\template\twig\extension']->lang("FIND_USERNAME");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t\t<dd><input class=\"text medium\" type=\"text\" id=\"username\" name=\"username[]\" /></dd>
\t\t\t<dd>[ <a href=\"";
                // line 79
                echo ($context["U_FIND_USERNAME"] ?? null);
                echo "\" onclick=\"find_username(this.href); return false;\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("FIND_USERNAME");
                echo "</a> ]</dd>
\t\t\t<dd class=\"full\" style=\"text-align: left;\"><label><input type=\"checkbox\" class=\"radio\" id=\"anonymous\" name=\"user_id[]\" value=\"";
                // line 80
                echo ($context["ANONYMOUS_USER_ID"] ?? null);
                echo "\" /> ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("SELECT_ANONYMOUS");
                echo "</label></dd>
\t\t</dl>

\t\t<p class=\"quick\">
\t\t\t";
                // line 84
                echo ($context["S_HIDDEN_FIELDS"] ?? null);
                echo "
\t\t\t";
                // line 85
                echo ($context["S_FORM_TOKEN"] ?? null);
                echo "
\t\t\t<input type=\"submit\" name=\"submit\" value=\"";
                // line 86
                echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
                echo "\" class=\"button1\" />
\t\t</p>
\t\t</fieldset>
\t\t</form>

\t";
            } elseif ((            // line 91
($context["S_SELECT_GROUP"] ?? null) && ($context["S_CAN_SELECT_GROUP"] ?? null))) {
                // line 92
                echo "
\t\t<form id=\"select_victim\" method=\"post\" action=\"";
                // line 93
                echo ($context["U_ACTION"] ?? null);
                echo "\">

\t\t<fieldset>
\t\t\t<legend>";
                // line 96
                echo $this->extensions['phpbb\template\twig\extension']->lang("LOOK_UP_GROUP");
                echo "</legend>
\t\t<dl>
\t\t\t<dt>";
                // line 98
                echo "<label for=\"group\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("LOOK_UP_GROUP");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label>";
                echo "</dt>
\t\t\t<dd><select name=\"group_id[]\" id=\"group\">";
                // line 99
                echo ($context["S_GROUP_OPTIONS"] ?? null);
                echo "</select></dd>
\t\t</dl>

\t\t<p class=\"quick\">
\t\t\t";
                // line 103
                echo ($context["S_HIDDEN_FIELDS"] ?? null);
                echo "
\t\t\t";
                // line 104
                echo ($context["S_FORM_TOKEN"] ?? null);
                echo "
\t\t\t<input type=\"submit\" name=\"submit\" value=\"";
                // line 105
                echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
                echo "\" class=\"button1\" />
\t\t</p>

\t\t</fieldset>
\t\t</form>

\t\t";
            } elseif (            // line 111
($context["S_SELECT_USERGROUP"] ?? null)) {
                // line 112
                echo "
\t\t<div class=\"column1\">

\t\t";
                // line 115
                if (($context["S_CAN_SELECT_USER"] ?? null)) {
                    // line 116
                    echo "
\t\t\t<h1>";
                    // line 117
                    echo $this->extensions['phpbb\template\twig\extension']->lang("USERS");
                    echo "</h1>

\t\t\t<form id=\"users\" method=\"post\" action=\"";
                    // line 119
                    echo ($context["U_ACTION"] ?? null);
                    echo "\">

\t\t\t<fieldset>
\t\t\t\t<legend>";
                    // line 122
                    echo $this->extensions['phpbb\template\twig\extension']->lang("MANAGE_USERS");
                    echo "</legend>
\t\t\t<dl>
\t\t\t\t<dd class=\"full\"><select style=\"width: 100%;\" name=\"user_id[]\" multiple=\"multiple\" size=\"5\">";
                    // line 124
                    echo ($context["S_DEFINED_USER_OPTIONS"] ?? null);
                    echo "</select></dd>
\t\t\t\t";
                    // line 125
                    if (($context["S_ALLOW_ALL_SELECT"] ?? null)) {
                        echo "<dd class=\"full\" style=\"text-align: right;\"><label><input type=\"checkbox\" class=\"radio\" name=\"all_users\" value=\"1\" /> ";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("ALL_USERS");
                        echo "</label></dd>";
                    }
                    // line 126
                    echo "\t\t\t</dl>
\t\t\t</fieldset>

\t\t\t<fieldset class=\"quick\">
\t\t\t\t";
                    // line 130
                    echo ($context["S_HIDDEN_FIELDS"] ?? null);
                    echo "
\t\t\t\t";
                    // line 131
                    echo ($context["S_FORM_TOKEN"] ?? null);
                    echo "
\t\t\t\t<input type=\"submit\" class=\"button2\" name=\"action[delete]\" value=\"";
                    // line 132
                    echo $this->extensions['phpbb\template\twig\extension']->lang("REMOVE_PERMISSIONS");
                    echo "\" style=\"width: 46% !important;\" /> &nbsp; <input class=\"button1\" type=\"submit\" name=\"submit_edit_options\" value=\"";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("EDIT_PERMISSIONS");
                    echo "\" style=\"width: 46% !important;\" />
\t\t\t</fieldset>
\t\t\t</form>

\t\t\t<form id=\"add_user\" method=\"post\" action=\"";
                    // line 136
                    echo ($context["U_ACTION"] ?? null);
                    echo "\">

\t\t\t<fieldset>
\t\t\t\t<legend>";
                    // line 139
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ADD_USERS");
                    echo "</legend>
\t\t\t\t<p>";
                    // line 140
                    echo $this->extensions['phpbb\template\twig\extension']->lang("USERNAMES_EXPLAIN");
                    echo "</p>
\t\t\t<dl>
\t\t\t\t<dd class=\"full\"><textarea id=\"username\" name=\"usernames\" rows=\"5\" cols=\"5\" style=\"width: 100%; height: 60px;\"></textarea></dd>
\t\t\t\t<dd class=\"full\" style=\"text-align: left;\">";
                    // line 143
                    echo "<div style=\"float: ";
                    echo ($context["S_CONTENT_FLOW_END"] ?? null);
                    echo ";\">[ <a href=\"";
                    echo ($context["U_FIND_USERNAME"] ?? null);
                    echo "\" onclick=\"find_username(this.href); return false;\">";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("FIND_USERNAME");
                    echo "</a> ]</div>";
                    echo "<label><input type=\"checkbox\" class=\"radio\" id=\"anonymous\" name=\"user_id[]\" value=\"";
                    echo ($context["ANONYMOUS_USER_ID"] ?? null);
                    echo "\" /> ";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("SELECT_ANONYMOUS");
                    echo "</label></dd>
\t\t\t</dl>
\t\t\t</fieldset>

\t\t\t<fieldset class=\"quick\">
\t\t\t\t";
                    // line 148
                    echo ($context["S_HIDDEN_FIELDS"] ?? null);
                    echo "
\t\t\t\t";
                    // line 149
                    echo ($context["S_FORM_TOKEN"] ?? null);
                    echo "
\t\t\t\t<input class=\"button1\" type=\"submit\" name=\"submit_add_options\" value=\"";
                    // line 150
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ADD_PERMISSIONS");
                    echo "\" />
\t\t\t</fieldset>
\t\t\t</form>

\t\t";
                }
                // line 155
                echo "
\t\t</div>

\t\t<div class=\"column2\">

\t\t";
                // line 160
                if (($context["S_CAN_SELECT_GROUP"] ?? null)) {
                    // line 161
                    echo "
\t\t\t<h1>";
                    // line 162
                    echo $this->extensions['phpbb\template\twig\extension']->lang("USERGROUPS");
                    echo "</h1>

\t\t\t<form id=\"groups\" method=\"post\" action=\"";
                    // line 164
                    echo ($context["U_ACTION"] ?? null);
                    echo "\">

\t\t\t<fieldset>
\t\t\t\t<legend>";
                    // line 167
                    echo $this->extensions['phpbb\template\twig\extension']->lang("MANAGE_GROUPS");
                    echo "</legend>
\t\t\t<dl>
\t\t\t\t<dd class=\"full\"><select style=\"width: 100%;\" name=\"group_id[]\" multiple=\"multiple\" size=\"5\">";
                    // line 169
                    echo ($context["S_DEFINED_GROUP_OPTIONS"] ?? null);
                    echo "</select></dd>
\t\t\t\t";
                    // line 170
                    if (($context["S_ALLOW_ALL_SELECT"] ?? null)) {
                        echo "<dd class=\"full\" style=\"text-align: right;\"><label><input type=\"checkbox\" class=\"radio\" name=\"all_groups\" value=\"1\" /> ";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("ALL_GROUPS");
                        echo "</label></dd>";
                    }
                    // line 171
                    echo "\t\t\t</dl>
\t\t\t</fieldset>

\t\t\t<fieldset class=\"quick\">
\t\t\t\t";
                    // line 175
                    echo ($context["S_HIDDEN_FIELDS"] ?? null);
                    echo "
\t\t\t\t";
                    // line 176
                    echo ($context["S_FORM_TOKEN"] ?? null);
                    echo "
\t\t\t\t<input class=\"button2\" type=\"submit\" name=\"action[delete]\" value=\"";
                    // line 177
                    echo $this->extensions['phpbb\template\twig\extension']->lang("REMOVE_PERMISSIONS");
                    echo "\" style=\"width: 46% !important;\" /> &nbsp; <input class=\"button1\" type=\"submit\" name=\"submit_edit_options\" value=\"";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("EDIT_PERMISSIONS");
                    echo "\" style=\"width: 46% !important;\" />
\t\t\t</fieldset>
\t\t\t</form>

\t\t\t<form id=\"add_groups\" method=\"post\" action=\"";
                    // line 181
                    echo ($context["U_ACTION"] ?? null);
                    echo "\">

\t\t\t<fieldset>
\t\t\t\t<legend>";
                    // line 184
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ADD_GROUPS");
                    echo "</legend>
\t\t\t<dl>
\t\t\t\t<dd class=\"full\">";
                    // line 186
                    echo "<select name=\"group_id[]\" style=\"width: 100%; height: 107px;\" multiple=\"multiple\">";
                    echo ($context["S_ADD_GROUP_OPTIONS"] ?? null);
                    echo "</select>";
                    echo "</dd>
\t\t\t</dl>
\t\t\t</fieldset>

\t\t\t<fieldset class=\"quick\">
\t\t\t\t";
                    // line 191
                    echo ($context["S_HIDDEN_FIELDS"] ?? null);
                    echo "
\t\t\t\t";
                    // line 192
                    echo ($context["S_FORM_TOKEN"] ?? null);
                    echo "
\t\t\t\t<input type=\"submit\" class=\"button1\" name=\"submit_add_options\" value=\"";
                    // line 193
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ADD_PERMISSIONS");
                    echo "\" />
\t\t\t</fieldset>
\t\t\t</form>

\t\t";
                }
                // line 198
                echo "
\t\t</div>

\t";
            } elseif (            // line 201
($context["S_SELECT_USERGROUP_VIEW"] ?? null)) {
                // line 202
                echo "
\t\t<div class=\"column1\">

\t\t\t<h1>";
                // line 205
                echo $this->extensions['phpbb\template\twig\extension']->lang("USERS");
                echo "</h1>

\t\t\t<form id=\"users\" method=\"post\" action=\"";
                // line 207
                echo ($context["U_ACTION"] ?? null);
                echo "\">

\t\t\t<fieldset>
\t\t\t\t<legend>";
                // line 210
                echo $this->extensions['phpbb\template\twig\extension']->lang("MANAGE_USERS");
                echo "</legend>
\t\t\t<dl>
\t\t\t\t<dd class=\"full\"><select style=\"width: 100%;\" name=\"user_id[]\" multiple=\"multiple\" size=\"5\">";
                // line 212
                echo ($context["S_DEFINED_USER_OPTIONS"] ?? null);
                echo "</select></dd>
\t\t\t</dl>
\t\t\t</fieldset>

\t\t\t<fieldset class=\"quick\">
\t\t\t\t";
                // line 217
                echo ($context["S_HIDDEN_FIELDS"] ?? null);
                echo "
\t\t\t\t";
                // line 218
                echo ($context["S_FORM_TOKEN"] ?? null);
                echo "
\t\t\t\t<input class=\"button1\" type=\"submit\" name=\"submit\" value=\"";
                // line 219
                echo $this->extensions['phpbb\template\twig\extension']->lang("VIEW_PERMISSIONS");
                echo "\" />
\t\t\t</fieldset>
\t\t\t</form>

\t\t\t<form id=\"add_user\" method=\"post\" action=\"";
                // line 223
                echo ($context["U_ACTION"] ?? null);
                echo "\">

\t\t\t<fieldset>
\t\t\t\t<legend>";
                // line 226
                echo $this->extensions['phpbb\template\twig\extension']->lang("LOOK_UP_USER");
                echo "</legend>
\t\t\t<dl>
\t\t\t\t<dt><label for=\"username\">";
                // line 228
                echo $this->extensions['phpbb\template\twig\extension']->lang("FIND_USERNAME");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t\t\t<dd><input type=\"text\" id=\"username\" name=\"username[]\" /></dd>
\t\t\t\t<dd>[ <a href=\"";
                // line 230
                echo ($context["U_FIND_USERNAME"] ?? null);
                echo "\" onclick=\"find_username(this.href); return false;\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("FIND_USERNAME");
                echo "</a> ]</dd>
\t\t\t\t<dd class=\"full\" style=\"text-align: left;\"><label><input type=\"checkbox\" class=\"radio\" id=\"anonymous\" name=\"user_id[]\" value=\"";
                // line 231
                echo ($context["ANONYMOUS_USER_ID"] ?? null);
                echo "\" /> ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("SELECT_ANONYMOUS");
                echo "</label></dd>
\t\t\t</dl>
\t\t\t</fieldset>

\t\t\t<fieldset class=\"quick\">
\t\t\t\t";
                // line 236
                echo ($context["S_HIDDEN_FIELDS"] ?? null);
                echo "
\t\t\t\t";
                // line 237
                echo ($context["S_FORM_TOKEN"] ?? null);
                echo "
\t\t\t\t<input type=\"submit\" name=\"submit\" value=\"";
                // line 238
                echo $this->extensions['phpbb\template\twig\extension']->lang("VIEW_PERMISSIONS");
                echo "\" class=\"button1\" />
\t\t\t</fieldset>
\t\t\t</form>

\t\t</div>

\t\t<div class=\"column2\">

\t\t\t<h1>";
                // line 246
                echo $this->extensions['phpbb\template\twig\extension']->lang("USERGROUPS");
                echo "</h1>

\t\t\t<form id=\"groups\" method=\"post\" action=\"";
                // line 248
                echo ($context["U_ACTION"] ?? null);
                echo "\">

\t\t\t<fieldset>
\t\t\t\t<legend>";
                // line 251
                echo $this->extensions['phpbb\template\twig\extension']->lang("MANAGE_GROUPS");
                echo "</legend>
\t\t\t<dl>
\t\t\t\t<dd class=\"full\"><select style=\"width: 100%;\" name=\"group_id[]\" multiple=\"multiple\" size=\"5\">";
                // line 253
                echo ($context["S_DEFINED_GROUP_OPTIONS"] ?? null);
                echo "</select></dd>
\t\t\t</dl>
\t\t\t</fieldset>

\t\t\t<fieldset class=\"quick\">
\t\t\t\t";
                // line 258
                echo ($context["S_HIDDEN_FIELDS"] ?? null);
                echo "
\t\t\t\t";
                // line 259
                echo ($context["S_FORM_TOKEN"] ?? null);
                echo "
\t\t\t\t<input class=\"button1\" type=\"submit\" name=\"submit\" value=\"";
                // line 260
                echo $this->extensions['phpbb\template\twig\extension']->lang("VIEW_PERMISSIONS");
                echo "\" />
\t\t\t</fieldset>
\t\t\t</form>

\t\t\t<form id=\"group\" method=\"post\" action=\"";
                // line 264
                echo ($context["U_ACTION"] ?? null);
                echo "\">

\t\t\t<fieldset>
\t\t\t\t<legend>";
                // line 267
                echo $this->extensions['phpbb\template\twig\extension']->lang("LOOK_UP_GROUP");
                echo "</legend>
\t\t\t<dl>
\t\t\t\t<dt><label for=\"group_select\">";
                // line 269
                echo $this->extensions['phpbb\template\twig\extension']->lang("LOOK_UP_GROUP");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t\t\t";
                // line 270
                // line 271
                echo "\t\t\t\t<dd><select name=\"group_id[]\" id=\"group_select\">";
                echo ($context["S_ADD_GROUP_OPTIONS"] ?? null);
                echo "</select></dd>
\t\t\t\t";
                // line 272
                // line 273
                echo "\t\t\t\t<dd>&nbsp;</dd>
\t\t\t</dl>
\t\t\t</fieldset>

\t\t\t<fieldset class=\"quick\">
\t\t\t\t";
                // line 278
                echo ($context["S_HIDDEN_FIELDS"] ?? null);
                echo "
\t\t\t\t";
                // line 279
                echo ($context["S_FORM_TOKEN"] ?? null);
                echo "
\t\t\t\t<input type=\"submit\" name=\"submit\" value=\"";
                // line 280
                echo $this->extensions['phpbb\template\twig\extension']->lang("VIEW_PERMISSIONS");
                echo "\" class=\"button1\" />
\t\t\t</fieldset>
\t\t\t</form>

\t\t</div>

\t";
            }
            // line 287
            echo "
";
        }
        // line 289
        echo "
";
        // line 290
        if (($context["S_VIEWING_PERMISSIONS"] ?? null)) {
            // line 291
            echo "
\t<h1>";
            // line 292
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACL_VIEW");
            echo "</h1>

\t<p>";
            // line 294
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACL_VIEW_EXPLAIN");
            echo "</p>

\t<fieldset class=\"quick\">
\t\t<strong>&raquo; ";
            // line 297
            echo $this->extensions['phpbb\template\twig\extension']->lang("PERMISSION_TYPE");
            echo "</strong>
\t</fieldset>

\t";
            // line 300
            $location = "permission_mask.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("permission_mask.html", "acp_permissions.html", 300)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 301
            echo "
";
        }
        // line 303
        echo "
";
        // line 304
        if (($context["S_SETTING_PERMISSIONS"] ?? null)) {
            // line 305
            echo "
\t<h1>";
            // line 306
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACL_SET");
            echo "</h1>

\t<p>";
            // line 308
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACL_SET_EXPLAIN");
            echo "</p>

\t<br />

\t<fieldset class=\"quick\" style=\"float: ";
            // line 312
            echo ($context["S_CONTENT_FLOW_END"] ?? null);
            echo ";\">
\t\t<strong>&raquo; ";
            // line 313
            echo $this->extensions['phpbb\template\twig\extension']->lang("PERMISSION_TYPE");
            echo "</strong>
\t</fieldset>

\t";
            // line 316
            if (($context["S_PERMISSION_DROPDOWN"] ?? null)) {
                // line 317
                echo "\t\t<form id=\"pselect\" method=\"post\" action=\"";
                echo ($context["U_ACTION"] ?? null);
                echo "\">

\t\t<fieldset class=\"quick\" style=\"float: ";
                // line 319
                echo ($context["S_CONTENT_FLOW_BEGIN"] ?? null);
                echo ";\">
\t\t\t";
                // line 320
                echo ($context["S_HIDDEN_FIELDS"] ?? null);
                echo "
\t\t\t";
                // line 321
                echo ($context["S_FORM_TOKEN"] ?? null);
                echo "
\t\t\t";
                // line 322
                echo $this->extensions['phpbb\template\twig\extension']->lang("SELECT_TYPE");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo " <select name=\"type\">";
                echo ($context["S_PERMISSION_DROPDOWN"] ?? null);
                echo "</select>

\t\t\t<input class=\"button2\" type=\"submit\" name=\"submit\" value=\"";
                // line 324
                echo $this->extensions['phpbb\template\twig\extension']->lang("GO");
                echo "\" />
\t\t</fieldset>
\t\t</form>
\t";
            }
            // line 328
            echo "
\t<br class=\"responsive-hide\" /><br class=\"responsive-hide\" />

\t<!-- include tooltip file -->
\t";
            // line 332
            $asset_file = "tooltip.js";
            $asset = new \phpbb\template\asset($asset_file, $this->env->get_path_helper(), $this->env->get_filesystem());
            if (substr($asset_file, 0, 2) !== './' && $asset->is_relative()) {
                $asset_path = $asset->get_path();                $local_file = $this->env->get_phpbb_root_path() . $asset_path;
                if (!file_exists($local_file)) {
                    $local_file = $this->env->findTemplate($asset_path);
                    $asset->set_path($local_file, true);
                }
            }
            
            if ($asset->is_relative()) {
                $asset->add_assets_version($this->env->get_phpbb_config()['assets_version']);
            }
            $this->env->get_assets_bag()->add_script($asset);            // line 333
            echo "
\t<form id=\"set-permissions\" method=\"post\" action=\"";
            // line 334
            echo ($context["U_ACTION"] ?? null);
            echo "\" data-role-description=\"";
            echo $this->extensions['phpbb\template\twig\extension']->lang("ROLE_DESCRIPTION");
            echo "\">

\t";
            // line 336
            echo ($context["S_HIDDEN_FIELDS"] ?? null);
            echo "

\t";
            // line 338
            $location = "permission_mask.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("permission_mask.html", "acp_permissions.html", 338)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 339
            echo "
\t<br class=\"responsive-hide\" /><br class=\"responsive-hide\" />

\t<fieldset class=\"quick\" style=\"float: ";
            // line 342
            echo ($context["S_CONTENT_FLOW_END"] ?? null);
            echo ";\">
\t\t<legend>";
            // line 343
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_SUBMIT_CHANGES");
            echo "</legend>
\t\t<p class=\"submit-buttons\">
\t\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"action[apply_all_permissions]\" value=\"";
            // line 345
            echo $this->extensions['phpbb\template\twig\extension']->lang("APPLY_ALL_PERMISSIONS");
            echo "\" />&nbsp;
\t\t\t<input class=\"button2\" type=\"button\"  id=\"reset\" name=\"cancel\" value=\"";
            // line 346
            echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
            echo "\" onclick=\"document.forms['set-permissions'].reset(); init_colours(active_pmask + active_fmask);\" />
\t\t\t";
            // line 347
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t\t</p>
\t</fieldset>

\t<br class=\"responsive-hide\" /><br class=\"responsive-hide\" />

\t</form>

";
        }
        // line 356
        echo "
";
        // line 357
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_permissions.html", 357)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_permissions.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  930 => 357,  927 => 356,  915 => 347,  911 => 346,  907 => 345,  902 => 343,  898 => 342,  893 => 339,  881 => 338,  876 => 336,  869 => 334,  866 => 333,  852 => 332,  846 => 328,  839 => 324,  831 => 322,  827 => 321,  823 => 320,  819 => 319,  813 => 317,  811 => 316,  805 => 313,  801 => 312,  794 => 308,  789 => 306,  786 => 305,  784 => 304,  781 => 303,  777 => 301,  765 => 300,  759 => 297,  753 => 294,  748 => 292,  745 => 291,  743 => 290,  740 => 289,  736 => 287,  726 => 280,  722 => 279,  718 => 278,  711 => 273,  710 => 272,  705 => 271,  704 => 270,  699 => 269,  694 => 267,  688 => 264,  681 => 260,  677 => 259,  673 => 258,  665 => 253,  660 => 251,  654 => 248,  649 => 246,  638 => 238,  634 => 237,  630 => 236,  620 => 231,  614 => 230,  608 => 228,  603 => 226,  597 => 223,  590 => 219,  586 => 218,  582 => 217,  574 => 212,  569 => 210,  563 => 207,  558 => 205,  553 => 202,  551 => 201,  546 => 198,  538 => 193,  534 => 192,  530 => 191,  520 => 186,  515 => 184,  509 => 181,  500 => 177,  496 => 176,  492 => 175,  486 => 171,  480 => 170,  476 => 169,  471 => 167,  465 => 164,  460 => 162,  457 => 161,  455 => 160,  448 => 155,  440 => 150,  436 => 149,  432 => 148,  414 => 143,  408 => 140,  404 => 139,  398 => 136,  389 => 132,  385 => 131,  381 => 130,  375 => 126,  369 => 125,  365 => 124,  360 => 122,  354 => 119,  349 => 117,  346 => 116,  344 => 115,  339 => 112,  337 => 111,  328 => 105,  324 => 104,  320 => 103,  313 => 99,  306 => 98,  301 => 96,  295 => 93,  292 => 92,  290 => 91,  282 => 86,  278 => 85,  274 => 84,  265 => 80,  259 => 79,  253 => 77,  248 => 75,  242 => 72,  239 => 71,  237 => 70,  234 => 69,  224 => 62,  220 => 61,  216 => 60,  209 => 56,  202 => 55,  197 => 53,  193 => 52,  187 => 49,  184 => 48,  182 => 47,  173 => 41,  169 => 40,  165 => 39,  160 => 36,  154 => 35,  146 => 34,  139 => 33,  136 => 32,  130 => 31,  126 => 30,  120 => 27,  117 => 26,  115 => 25,  112 => 24,  103 => 22,  101 => 21,  96 => 19,  91 => 17,  88 => 16,  78 => 15,  75 => 14,  73 => 13,  70 => 12,  64 => 9,  59 => 7,  56 => 6,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_permissions.html", "");
    }
}
