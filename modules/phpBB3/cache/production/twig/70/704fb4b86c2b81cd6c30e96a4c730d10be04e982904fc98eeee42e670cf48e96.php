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

/* acp_forums.html */
class __TwigTemplate_9002355b7e2d03bc3fbe72661cebb54bc511c6be570c08329fc13ab02b30b765 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_forums.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

";
        // line 5
        if (($context["S_EDIT_FORUM"] ?? null)) {
            // line 6
            echo "
\t<script>
\t// <![CDATA[
\t\t/**
\t\t* Handle displaying/hiding several options based on the forum type
\t\t*/
\t\tfunction display_options(value)
\t\t{
\t\t\t";
            // line 14
            if (( !($context["S_ADD_ACTION"] ?? null) && ($context["S_FORUM_ORIG_POST"] ?? null))) {
                // line 15
                echo "\t\t\t\tif (value == ";
                echo ($context["FORUM_POST"] ?? null);
                echo ")
\t\t\t\t{
\t\t\t\t\tphpbb.toggleDisplay('type_actions', -1);
\t\t\t\t}
\t\t\t\telse
\t\t\t\t{
\t\t\t\t\tphpbb.toggleDisplay('type_actions', 1);
\t\t\t\t}
\t\t\t";
            }
            // line 24
            echo "
\t\t\t";
            // line 25
            if ((( !($context["S_ADD_ACTION"] ?? null) && ($context["S_FORUM_ORIG_CAT"] ?? null)) && ($context["S_HAS_SUBFORUMS"] ?? null))) {
                // line 26
                echo "\t\t\t\tif (value == ";
                echo ($context["FORUM_LINK"] ?? null);
                echo ")
\t\t\t\t{
\t\t\t\t\tphpbb.toggleDisplay('cat_to_link_actions', 1);
\t\t\t\t}
\t\t\t\telse
\t\t\t\t{
\t\t\t\t\tphpbb.toggleDisplay('cat_to_link_actions', -1);
\t\t\t\t}
\t\t\t";
            }
            // line 35
            echo "
\t\t\tif (value == ";
            // line 36
            echo ($context["FORUM_POST"] ?? null);
            echo ")
\t\t\t{
\t\t\t\tphpbb.toggleDisplay('forum_post_options', 1);
\t\t\t\tphpbb.toggleDisplay('forum_link_options', -1);
\t\t\t\tphpbb.toggleDisplay('forum_rules_options', 1);
\t\t\t\tphpbb.toggleDisplay('forum_cat_options', -1);
\t\t\t}
\t\t\telse if (value == ";
            // line 43
            echo ($context["FORUM_LINK"] ?? null);
            echo ")
\t\t\t{
\t\t\t\tphpbb.toggleDisplay('forum_post_options', -1);
\t\t\t\tphpbb.toggleDisplay('forum_link_options', 1);
\t\t\t\tphpbb.toggleDisplay('forum_rules_options', -1);
\t\t\t\tphpbb.toggleDisplay('forum_cat_options', -1);
\t\t\t}
\t\t\telse if (value == ";
            // line 50
            echo ($context["FORUM_CAT"] ?? null);
            echo ")
\t\t\t{
\t\t\t\tphpbb.toggleDisplay('forum_post_options', -1);
\t\t\t\tphpbb.toggleDisplay('forum_link_options', -1);
\t\t\t\tphpbb.toggleDisplay('forum_rules_options', 1);
\t\t\t\tphpbb.toggleDisplay('forum_cat_options', 1);
\t\t\t}
\t\t}

\t\t/**
\t\t* Init the wanted display functionality if javascript is enabled.
\t\t* If javascript is not available, the user is still able to properly administer.
\t\t*/
\t\tonload = function()
\t\t{
\t\t\t";
            // line 65
            if (( !($context["S_ADD_ACTION"] ?? null) && ($context["S_FORUM_ORIG_POST"] ?? null))) {
                // line 66
                echo "\t\t\t\t";
                if (($context["S_FORUM_POST"] ?? null)) {
                    // line 67
                    echo "\t\t\t\t\tphpbb.toggleDisplay('type_actions', -1);
\t\t\t\t";
                }
                // line 69
                echo "\t\t\t";
            }
            // line 70
            echo "
\t\t\t";
            // line 71
            if ((( !($context["S_ADD_ACTION"] ?? null) && ($context["S_FORUM_ORIG_CAT"] ?? null)) && ($context["S_HAS_SUBFORUMS"] ?? null))) {
                // line 72
                echo "\t\t\t\t";
                if (($context["S_FORUM_CAT"] ?? null)) {
                    // line 73
                    echo "\t\t\t\t\tphpbb.toggleDisplay('cat_to_link_actions', -1);
\t\t\t\t";
                }
                // line 75
                echo "\t\t\t";
            }
            // line 76
            echo "
\t\t\t";
            // line 77
            if ( !($context["S_FORUM_POST"] ?? null)) {
                // line 78
                echo "\t\t\t\tphpbb.toggleDisplay('forum_post_options', -1);
\t\t\t";
            }
            // line 80
            echo "
\t\t\t";
            // line 81
            if ( !($context["S_FORUM_CAT"] ?? null)) {
                // line 82
                echo "\t\t\t\tphpbb.toggleDisplay('forum_cat_options', -1);
\t\t\t";
            }
            // line 84
            echo "
\t\t\t";
            // line 85
            if ( !($context["S_FORUM_LINK"] ?? null)) {
                // line 86
                echo "\t\t\t\tphpbb.toggleDisplay('forum_link_options', -1);
\t\t\t";
            }
            // line 88
            echo "
\t\t\t";
            // line 89
            if (($context["S_FORUM_LINK"] ?? null)) {
                // line 90
                echo "\t\t\tphpbb.toggleDisplay('forum_rules_options', -1);
\t\t\t";
            }
            // line 92
            echo "\t\t}

\t// ]]>
\t</script>

\t<a href=\"";
            // line 97
            echo ($context["U_BACK"] ?? null);
            echo "\" style=\"float: ";
            echo ($context["S_CONTENT_FLOW_END"] ?? null);
            echo ";\">&laquo; ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BACK");
            echo "</a>

\t<h1>";
            // line 99
            echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE");
            echo " ";
            if (($context["FORUM_NAME"] ?? null)) {
                echo ":: ";
                echo ($context["FORUM_NAME"] ?? null);
            }
            echo "</h1>

\t<p>";
            // line 101
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_EDIT_EXPLAIN");
            echo "</p>

\t";
            // line 103
            if (($context["S_ERROR"] ?? null)) {
                // line 104
                echo "\t\t<div class=\"errorbox\">
\t\t\t<h3>";
                // line 105
                echo $this->extensions['phpbb\template\twig\extension']->lang("WARNING");
                echo "</h3>
\t\t\t<p>";
                // line 106
                echo ($context["ERROR_MSG"] ?? null);
                echo "</p>
\t\t</div>
\t";
            }
            // line 109
            echo "
\t<form id=\"forumedit\" method=\"post\" action=\"";
            // line 110
            echo ($context["U_EDIT_ACTION"] ?? null);
            echo "\">

\t<fieldset>
\t\t<legend>";
            // line 113
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_SETTINGS");
            echo "</legend>
\t";
            // line 114
            // line 115
            echo "\t<dl>
\t\t<dt><label for=\"forum_type\">";
            // line 116
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_TYPE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t<dd><select id=\"forum_type\" name=\"forum_type\" onchange=\"display_options(this.options[this.selectedIndex].value);\">";
            // line 117
            echo ($context["S_FORUM_TYPE_OPTIONS"] ?? null);
            echo "</select></dd>
\t</dl>
\t";
            // line 119
            if (( !($context["S_ADD_ACTION"] ?? null) && ($context["S_FORUM_ORIG_POST"] ?? null))) {
                // line 120
                echo "\t<div id=\"type_actions\">
\t\t<dl>
\t\t\t<dt><label for=\"type_action\">";
                // line 122
                echo $this->extensions['phpbb\template\twig\extension']->lang("DECIDE_MOVE_DELETE_CONTENT");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"type_action\" value=\"delete\"";
                // line 123
                if ( !($context["S_MOVE_FORUM_OPTIONS"] ?? null)) {
                    echo " checked=\"checked\" id=\"type_action\"";
                }
                echo " /> ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE_ALL_POSTS");
                echo "</label></dd>
\t\t\t";
                // line 124
                if (($context["S_MOVE_FORUM_OPTIONS"] ?? null)) {
                    echo "<dd><label><input type=\"radio\" class=\"radio\" name=\"type_action\" id=\"type_action\" value=\"move\" checked=\"checked\" /> ";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("MOVE_POSTS_TO");
                    echo "</label> <select name=\"to_forum_id\">";
                    echo ($context["S_MOVE_FORUM_OPTIONS"] ?? null);
                    echo "</select></dd>";
                }
                // line 125
                echo "\t\t</dl>
\t</div>
\t";
            }
            // line 128
            echo "\t";
            if ((( !($context["S_ADD_ACTION"] ?? null) && ($context["S_FORUM_ORIG_CAT"] ?? null)) && ($context["S_HAS_SUBFORUMS"] ?? null))) {
                // line 129
                echo "\t<div id=\"cat_to_link_actions\">
\t\t<dl>
\t\t\t<dt><label for=\"action_subforums\">";
                // line 131
                echo $this->extensions['phpbb\template\twig\extension']->lang("DECIDE_MOVE_DELETE_SUBFORUMS");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t\t";
                // line 132
                if (($context["S_FORUMS_LIST"] ?? null)) {
                    // line 133
                    echo "\t\t\t\t<dd><label><input type=\"radio\" class=\"radio\" id=\"action_subforums\" name=\"action_subforums\" value=\"move\" checked=\"checked\" /> ";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("MOVE_SUBFORUMS_TO");
                    echo "</label> <select name=\"subforums_to_id\">";
                    echo ($context["S_FORUMS_LIST"] ?? null);
                    echo "</select></dd>
\t\t\t";
                } else {
                    // line 135
                    echo "\t\t\t\t<dd><label><input type=\"radio\" class=\"radio\" id=\"action_subforums\" name=\"action_subforums\" value=\"delete\" checked=\"checked\" /> ";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE_SUBFORUMS");
                    echo "</label></dd>
\t\t\t";
                }
                // line 137
                echo "\t\t</dl>
\t</div>
\t";
            }
            // line 140
            echo "\t<dl>
\t\t<dt><label for=\"parent\">";
            // line 141
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_PARENT");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t<dd><select id=\"parent\" name=\"forum_parent_id\"><option value=\"0\"";
            // line 142
            if ( !($context["S_FORUM_PARENT_ID"] ?? null)) {
                echo " selected=\"selected\"";
            }
            echo ">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO_PARENT");
            echo "</option>";
            echo ($context["S_PARENT_OPTIONS"] ?? null);
            echo "</select></dd>
\t</dl>
\t";
            // line 144
            if (($context["S_CAN_COPY_PERMISSIONS"] ?? null)) {
                // line 145
                echo "\t\t<dl>
\t\t\t<dt><label for=\"forum_perm_from\">";
                // line 146
                echo $this->extensions['phpbb\template\twig\extension']->lang("COPY_PERMISSIONS");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label><br /><span>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("COPY_PERMISSIONS_EXPLAIN");
                echo "</span></dt>
\t\t\t<dd><select id=\"forum_perm_from\" name=\"forum_perm_from\"><option value=\"0\">";
                // line 147
                echo $this->extensions['phpbb\template\twig\extension']->lang("NO_PERMISSIONS");
                echo "</option>";
                echo ($context["S_FORUM_OPTIONS"] ?? null);
                echo "</select></dd>
\t\t</dl>
\t";
            }
            // line 150
            echo "\t<dl>
\t\t<dt><label for=\"forum_name\">";
            // line 151
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_NAME");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t<dd><input class=\"text medium\" type=\"text\" id=\"forum_name\" name=\"forum_name\" value=\"";
            // line 152
            echo ($context["FORUM_NAME"] ?? null);
            echo "\" maxlength=\"255\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"forum_desc\">";
            // line 155
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_DESC");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_DESC_EXPLAIN");
            echo "</span></dt>
\t\t<dd><textarea id=\"forum_desc\" name=\"forum_desc\" rows=\"5\" cols=\"45\" data-bbcode=\"true\">";
            // line 156
            echo ($context["FORUM_DESC"] ?? null);
            echo "</textarea></dd>
\t\t<dd><label><input type=\"checkbox\" class=\"radio\" name=\"desc_parse_bbcode\"";
            // line 157
            if (($context["S_DESC_BBCODE_CHECKED"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("PARSE_BBCODE");
            echo "</label>
\t\t\t<label><input type=\"checkbox\" class=\"radio\" name=\"desc_parse_smilies\"";
            // line 158
            if (($context["S_DESC_SMILIES_CHECKED"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("PARSE_SMILIES");
            echo "</label>
\t\t\t<label><input type=\"checkbox\" class=\"radio\" name=\"desc_parse_urls\"";
            // line 159
            if (($context["S_DESC_URLS_CHECKED"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("PARSE_URLS");
            echo "</label></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"forum_image\">";
            // line 162
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_IMAGE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_IMAGE_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input class=\"text medium\" type=\"text\" id=\"forum_image\" name=\"forum_image\" value=\"";
            // line 163
            echo ($context["FORUM_IMAGE"] ?? null);
            echo "\" maxlength=\"255\" /></dd>
\t\t";
            // line 164
            if (($context["FORUM_IMAGE_SRC"] ?? null)) {
                // line 165
                echo "\t\t\t<dd><img src=\"";
                echo ($context["FORUM_IMAGE_SRC"] ?? null);
                echo "\" alt=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_IMAGE");
                echo "\" /></dd>
\t\t";
            }
            // line 167
            echo "\t</dl>
\t<dl>
\t\t<dt><label for=\"forum_password\">";
            // line 169
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_PASSWORD");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_PASSWORD_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input type=\"password\" id=\"forum_password\" name=\"forum_password\" value=\"";
            // line 170
            if (($context["S_FORUM_PASSWORD_SET"] ?? null)) {
                echo "&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;";
            }
            echo "\" autocomplete=\"off\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"forum_password_confirm\">";
            // line 173
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_PASSWORD_CONFIRM");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_PASSWORD_CONFIRM_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input type=\"password\" id=\"forum_password_confirm\" name=\"forum_password_confirm\" value=\"";
            // line 174
            if (($context["S_FORUM_PASSWORD_SET"] ?? null)) {
                echo "&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;";
            }
            echo "\" autocomplete=\"off\" /></dd>
\t</dl>
\t";
            // line 176
            if (($context["S_FORUM_PASSWORD_SET"] ?? null)) {
                // line 177
                echo "\t<dl>
\t\t<dt><label for=\"forum_password_unset\">";
                // line 178
                echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_PASSWORD_UNSET");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label><br /><span>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_PASSWORD_UNSET_EXPLAIN");
                echo "</span></dt>
\t\t<dd><input id=\"forum_password_unset\" name=\"forum_password_unset\" type=\"checkbox\" /></dd>
\t</dl>
\t";
            }
            // line 182
            echo "\t<dl>
\t\t<dt><label for=\"forum_style\">";
            // line 183
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_STYLE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t<dd><select id=\"forum_style\" name=\"forum_style\"><option value=\"0\">";
            // line 184
            echo $this->extensions['phpbb\template\twig\extension']->lang("DEFAULT_STYLE");
            echo "</option>";
            echo ($context["S_STYLES_OPTIONS"] ?? null);
            echo "</select></dd>
\t</dl>
\t";
            // line 186
            // line 187
            echo "\t</fieldset>

\t<div id=\"forum_cat_options\">
\t\t<fieldset>
\t\t\t<legend>";
            // line 191
            echo $this->extensions['phpbb\template\twig\extension']->lang("GENERAL_FORUM_SETTINGS");
            echo "</legend>
\t\t<dl>
\t\t\t<dt><label for=\"display_active\">";
            // line 193
            echo $this->extensions['phpbb\template\twig\extension']->lang("DISPLAY_ACTIVE_TOPICS");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("DISPLAY_ACTIVE_TOPICS_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"display_active\" value=\"1\"";
            // line 194
            if (($context["S_ENABLE_ACTIVE_TOPICS"] ?? null)) {
                echo " id=\"display_active\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"display_active\" value=\"0\"";
            // line 195
            if ( !($context["S_ENABLE_ACTIVE_TOPICS"] ?? null)) {
                echo " id=\"display_active\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t</fieldset>
\t</div>

\t<div id=\"forum_post_options\">
\t\t<fieldset>
\t\t\t<legend>";
            // line 202
            echo $this->extensions['phpbb\template\twig\extension']->lang("GENERAL_FORUM_SETTINGS");
            echo "</legend>
\t\t";
            // line 203
            // line 204
            echo "\t\t<dl>
\t\t\t<dt><label for=\"forum_status\">";
            // line 205
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_STATUS");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><select id=\"forum_status\" name=\"forum_status\">";
            // line 206
            echo ($context["S_STATUS_OPTIONS"] ?? null);
            echo "</select></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"display_subforum_list\">";
            // line 209
            echo $this->extensions['phpbb\template\twig\extension']->lang("LIST_SUBFORUMS");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("LIST_SUBFORUMS_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"display_subforum_list\" value=\"1\"";
            // line 210
            if (($context["S_DISPLAY_SUBFORUM_LIST"] ?? null)) {
                echo " id=\"display_subforum_list\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"display_subforum_list\" value=\"0\"";
            // line 211
            if ( !($context["S_DISPLAY_SUBFORUM_LIST"] ?? null)) {
                echo " id=\"display_subforum_list\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"display_subforum_limit\">";
            // line 214
            echo $this->extensions['phpbb\template\twig\extension']->lang("LIMIT_SUBFORUMS");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("LIMIT_SUBFORUMS_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"display_subforum_limit\" value=\"1\"";
            // line 215
            if (($context["S_DISPLAY_SUBFORUM_LIMIT"] ?? null)) {
                echo " id=\"display_subforum_limit\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"display_subforum_limit\" value=\"0\"";
            // line 216
            if ( !($context["S_DISPLAY_SUBFORUM_LIMIT"] ?? null)) {
                echo " id=\"display_subforum_limit\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"display_on_index\">";
            // line 219
            echo $this->extensions['phpbb\template\twig\extension']->lang("LIST_INDEX");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("LIST_INDEX_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"display_on_index\" value=\"1\"";
            // line 220
            if (($context["S_DISPLAY_ON_INDEX"] ?? null)) {
                echo " id=\"display_on_index\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"display_on_index\" value=\"0\"";
            // line 221
            if ( !($context["S_DISPLAY_ON_INDEX"] ?? null)) {
                echo " id=\"display_on_index\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"enable_post_review\">";
            // line 224
            echo $this->extensions['phpbb\template\twig\extension']->lang("ENABLE_POST_REVIEW");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("ENABLE_POST_REVIEW_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"enable_post_review\" value=\"1\"";
            // line 225
            if (($context["S_ENABLE_POST_REVIEW"] ?? null)) {
                echo " id=\"enable_post_review\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"enable_post_review\" value=\"0\"";
            // line 226
            if ( !($context["S_ENABLE_POST_REVIEW"] ?? null)) {
                echo " id=\"enable_post_review\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"enable_quick_reply\">";
            // line 229
            echo $this->extensions['phpbb\template\twig\extension']->lang("ENABLE_QUICK_REPLY");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("ENABLE_QUICK_REPLY_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"enable_quick_reply\" value=\"1\"";
            // line 230
            if (($context["S_ENABLE_QUICK_REPLY"] ?? null)) {
                echo " id=\"enable_quick_reply\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"enable_quick_reply\" value=\"0\"";
            // line 231
            if ( !($context["S_ENABLE_QUICK_REPLY"] ?? null)) {
                echo " id=\"enable_quick_reply\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"enable_indexing\">";
            // line 234
            echo $this->extensions['phpbb\template\twig\extension']->lang("ENABLE_INDEXING");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("ENABLE_INDEXING_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"enable_indexing\" value=\"1\"";
            // line 235
            if (($context["S_ENABLE_INDEXING"] ?? null)) {
                echo " id=\"enable_indexing\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"enable_indexing\" value=\"0\"";
            // line 236
            if ( !($context["S_ENABLE_INDEXING"] ?? null)) {
                echo " id=\"enable_indexing\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"enable_icons\">";
            // line 239
            echo $this->extensions['phpbb\template\twig\extension']->lang("ENABLE_TOPIC_ICONS");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"enable_icons\" value=\"1\"";
            // line 240
            if (($context["S_TOPIC_ICONS"] ?? null)) {
                echo " id=\"enable_icons\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"enable_icons\" value=\"0\"";
            // line 241
            if ( !($context["S_TOPIC_ICONS"] ?? null)) {
                echo " id=\"enable_icons\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"display_recent\">";
            // line 244
            echo $this->extensions['phpbb\template\twig\extension']->lang("ENABLE_RECENT");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("ENABLE_RECENT_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"display_recent\" value=\"1\"";
            // line 245
            if (($context["S_DISPLAY_ACTIVE_TOPICS"] ?? null)) {
                echo " id=\"display_recent\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"display_recent\" value=\"0\"";
            // line 246
            if ( !($context["S_DISPLAY_ACTIVE_TOPICS"] ?? null)) {
                echo " id=\"display_recent\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"topics_per_page\">";
            // line 249
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_TOPICS_PAGE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_TOPICS_PAGE_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><input type=\"number\" id=\"topics_per_page\" name=\"topics_per_page\" value=\"";
            // line 250
            echo ($context["TOPICS_PER_PAGE"] ?? null);
            echo "\" min=\"0\" max=\"9999\" /></dd>
\t\t</dl>
\t\t";
            // line 252
            // line 253
            echo "\t\t</fieldset>

\t\t<fieldset>
\t\t\t<legend>";
            // line 256
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_PRUNE_SETTINGS");
            echo "</legend>
\t\t";
            // line 257
            // line 258
            echo "\t\t<dl>
\t\t\t<dt><label for=\"enable_prune\">";
            // line 259
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_AUTO_PRUNE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_AUTO_PRUNE_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"enable_prune\" value=\"1\"";
            // line 260
            if (($context["S_PRUNE_ENABLE"] ?? null)) {
                echo " id=\"enable_prune\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"enable_prune\" value=\"0\"";
            // line 261
            if ( !($context["S_PRUNE_ENABLE"] ?? null)) {
                echo " id=\"enable_prune\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"prune_freq\">";
            // line 264
            echo $this->extensions['phpbb\template\twig\extension']->lang("AUTO_PRUNE_FREQ");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("AUTO_PRUNE_FREQ_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><input type=\"number\" id=\"prune_freq\" name=\"prune_freq\" value=\"";
            // line 265
            echo ($context["PRUNE_FREQ"] ?? null);
            echo "\" min=\"0\" max=\"9999\" /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("DAYS");
            echo "</dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"prune_days\">";
            // line 268
            echo $this->extensions['phpbb\template\twig\extension']->lang("AUTO_PRUNE_DAYS");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("AUTO_PRUNE_DAYS_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><input type=\"number\" id=\"prune_days\" name=\"prune_days\" value=\"";
            // line 269
            echo ($context["PRUNE_DAYS"] ?? null);
            echo "\" min=\"0\" max=\"9999\" /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("DAYS");
            echo "</dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"prune_viewed\">";
            // line 272
            echo $this->extensions['phpbb\template\twig\extension']->lang("AUTO_PRUNE_VIEWED");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("AUTO_PRUNE_VIEWED_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><input type=\"number\" id=\"prune_viewed\" name=\"prune_viewed\" value=\"";
            // line 273
            echo ($context["PRUNE_VIEWED"] ?? null);
            echo "\" min=\"0\" max=\"9999\" /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("DAYS");
            echo "</dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"prune_old_polls\">";
            // line 276
            echo $this->extensions['phpbb\template\twig\extension']->lang("PRUNE_OLD_POLLS");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("PRUNE_OLD_POLLS_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"prune_old_polls\" value=\"1\"";
            // line 277
            if (($context["S_PRUNE_OLD_POLLS"] ?? null)) {
                echo " id=\"prune_old_polls\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"prune_old_polls\" value=\"0\"";
            // line 278
            if ( !($context["S_PRUNE_OLD_POLLS"] ?? null)) {
                echo " id=\"prune_old_polls\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"prune_announce\">";
            // line 281
            echo $this->extensions['phpbb\template\twig\extension']->lang("PRUNE_ANNOUNCEMENTS");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"prune_announce\" value=\"1\"";
            // line 282
            if (($context["S_PRUNE_ANNOUNCE"] ?? null)) {
                echo " id=\"prune_announce\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"prune_announce\" value=\"0\"";
            // line 283
            if ( !($context["S_PRUNE_ANNOUNCE"] ?? null)) {
                echo " id=\"prune_announce\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"prune_sticky\">";
            // line 286
            echo $this->extensions['phpbb\template\twig\extension']->lang("PRUNE_STICKY");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"prune_sticky\" value=\"1\"";
            // line 287
            if (($context["S_PRUNE_STICKY"] ?? null)) {
                echo " id=\"prune_sticky\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"prune_sticky\" value=\"0\"";
            // line 288
            if ( !($context["S_PRUNE_STICKY"] ?? null)) {
                echo " id=\"prune_sticky\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"enable_shadow_prune\">";
            // line 291
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_PRUNE_SHADOW");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_PRUNE_SHADOW_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"enable_shadow_prune\" value=\"1\"";
            // line 292
            if (($context["S_PRUNE_SHADOW_ENABLE"] ?? null)) {
                echo " id=\"enable_shadow_prune\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"enable_shadow_prune\" value=\"0\"";
            // line 293
            if ( !($context["S_PRUNE_SHADOW_ENABLE"] ?? null)) {
                echo " id=\"enable_shadow_prune\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"prune_shadow_freq\">";
            // line 296
            echo $this->extensions['phpbb\template\twig\extension']->lang("AUTO_PRUNE_SHADOW_FREQ");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("AUTO_PRUNE_SHADOW_FREQ_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><input type=\"number\" id=\"prune_shadow_freq\" name=\"prune_shadow_freq\" value=\"";
            // line 297
            echo ($context["PRUNE_SHADOW_FREQ"] ?? null);
            echo "\" min=\"0\" max=\"9999\" /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("DAYS");
            echo "</dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"prune_shadow_days\">";
            // line 300
            echo $this->extensions['phpbb\template\twig\extension']->lang("AUTO_PRUNE_SHADOW_DAYS");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("AUTO_PRUNE_SHADOW_DAYS_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><input type=\"number\" id=\"prune_shadow_days\" name=\"prune_shadow_days\" value=\"";
            // line 301
            echo ($context["PRUNE_SHADOW_DAYS"] ?? null);
            echo "\" min=\"0\" max=\"9999\" /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("DAYS");
            echo "</dd>
\t\t</dl>
\t\t";
            // line 303
            // line 304
            echo "\t\t</fieldset>
\t</div>

\t<div id=\"forum_link_options\">
\t\t<fieldset>
\t\t\t<legend>";
            // line 309
            echo $this->extensions['phpbb\template\twig\extension']->lang("GENERAL_FORUM_SETTINGS");
            echo "</legend>
\t\t<dl>
\t\t\t<dt><label for=\"link_display_on_index\">";
            // line 311
            echo $this->extensions['phpbb\template\twig\extension']->lang("LIST_INDEX");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("LIST_INDEX_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"link_display_on_index\" value=\"1\"";
            // line 312
            if (($context["S_DISPLAY_ON_INDEX"] ?? null)) {
                echo " id=\"link_display_on_index\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"link_display_on_index\" value=\"0\"";
            // line 313
            if ( !($context["S_DISPLAY_ON_INDEX"] ?? null)) {
                echo " id=\"link_display_on_index\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"forum_link\">";
            // line 316
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_LINK");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_LINK_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><input class=\"text medium\" type=\"text\" id=\"forum_link\" name=\"forum_link\" value=\"";
            // line 317
            echo ($context["FORUM_DATA_LINK"] ?? null);
            echo "\" maxlength=\"255\" /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"forum_link_track\">";
            // line 320
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_LINK_TRACK");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_LINK_TRACK_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"forum_link_track\" value=\"1\"";
            // line 321
            if (($context["S_FORUM_LINK_TRACK"] ?? null)) {
                echo " id=\"forum_link_track\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"forum_link_track\" value=\"0\"";
            // line 322
            if ( !($context["S_FORUM_LINK_TRACK"] ?? null)) {
                echo " id=\"forum_link_track\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t</fieldset>
\t</div>

\t<div id=\"forum_rules_options\">
\t\t<fieldset>
\t\t\t<legend>";
            // line 329
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_RULES");
            echo "</legend>
\t\t";
            // line 330
            // line 331
            echo "\t\t<dl>
\t\t\t<dt><label for=\"forum_rules_link\">";
            // line 332
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_RULES_LINK");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_RULES_LINK_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><input class=\"text medium\" type=\"text\" id=\"forum_rules_link\" name=\"forum_rules_link\" value=\"";
            // line 333
            echo ($context["FORUM_RULES_LINK"] ?? null);
            echo "\" maxlength=\"255\" /></dd>
\t\t</dl>
\t";
            // line 335
            if (($context["FORUM_RULES_PREVIEW"] ?? null)) {
                // line 336
                echo "\t\t<dl>
\t\t\t<dt><label>";
                // line 337
                echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_RULES_PREVIEW");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t\t<dd>";
                // line 338
                echo ($context["FORUM_RULES_PREVIEW"] ?? null);
                echo "</dd>
\t\t</dl>
\t";
            }
            // line 341
            echo "\t\t<dl>
\t\t\t<dt><label for=\"forum_rules\">";
            // line 342
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_RULES");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_RULES_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><textarea id=\"forum_rules\" name=\"forum_rules\" rows=\"4\" cols=\"70\" data-bbcode=\"true\">";
            // line 343
            echo ($context["FORUM_RULES_PLAIN"] ?? null);
            echo "</textarea></dd>
\t\t\t<dd><label><input type=\"checkbox\" class=\"radio\" name=\"rules_parse_bbcode\"";
            // line 344
            if (($context["S_BBCODE_CHECKED"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("PARSE_BBCODE");
            echo "</label>
\t\t\t\t<label><input type=\"checkbox\" class=\"radio\" name=\"rules_parse_smilies\"";
            // line 345
            if (($context["S_SMILIES_CHECKED"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("PARSE_SMILIES");
            echo "</label>
\t\t\t\t<label><input type=\"checkbox\" class=\"radio\" name=\"rules_parse_urls\"";
            // line 346
            if (($context["S_URLS_CHECKED"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("PARSE_URLS");
            echo "</label></dd>
\t\t</dl>
\t\t";
            // line 348
            // line 349
            echo "\t\t</fieldset>
\t</div>
\t
\t";
            // line 352
            // line 353
            echo "
\t<fieldset class=\"submit-buttons\">
\t\t<legend>";
            // line 355
            echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
            echo "</legend>
\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"update\" value=\"";
            // line 356
            echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
            echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
            // line 357
            echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
            echo "\" />
\t\t";
            // line 358
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t</form>

";
        } elseif (        // line 362
($context["S_DELETE_FORUM"] ?? null)) {
            // line 363
            echo "
\t<a href=\"";
            // line 364
            echo ($context["U_BACK"] ?? null);
            echo "\" style=\"float: ";
            echo ($context["S_CONTENT_FLOW_END"] ?? null);
            echo ";\">&laquo; ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BACK");
            echo "</a>

\t<h1>";
            // line 366
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_DELETE");
            echo "</h1>

\t<p>";
            // line 368
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_DELETE_EXPLAIN");
            echo "</p>

\t";
            // line 370
            if (($context["S_ERROR"] ?? null)) {
                // line 371
                echo "\t\t<div class=\"errorbox\">
\t\t\t<h3>";
                // line 372
                echo $this->extensions['phpbb\template\twig\extension']->lang("WARNING");
                echo "</h3>
\t\t\t<p>";
                // line 373
                echo ($context["ERROR_MSG"] ?? null);
                echo "</p>
\t\t</div>
\t";
            }
            // line 376
            echo "
\t<form id=\"acp_forum\" method=\"post\" action=\"";
            // line 377
            echo ($context["U_ACTION"] ?? null);
            echo "\">

\t<fieldset>
\t\t<legend>";
            // line 380
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_DELETE");
            echo "</legend>
\t<dl>
\t\t<dt><label>";
            // line 382
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_NAME");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t<dd><strong>";
            // line 383
            echo ($context["FORUM_NAME"] ?? null);
            echo "</strong></dd>
\t</dl>
\t";
            // line 385
            if (($context["S_FORUM_POST"] ?? null)) {
                // line 386
                echo "\t\t<dl>
\t\t\t<dt><label for=\"delete_action\">";
                // line 387
                echo $this->extensions['phpbb\template\twig\extension']->lang("ACTION");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" id=\"delete_action\" name=\"action_posts\" value=\"delete\" checked=\"checked\" /> ";
                // line 388
                echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE_ALL_POSTS");
                echo "</label></dd>
\t\t\t";
                // line 389
                if (($context["S_MOVE_FORUM_OPTIONS"] ?? null)) {
                    // line 390
                    echo "\t\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"action_posts\" value=\"move\" /> ";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("MOVE_POSTS_TO");
                    echo "</label> <select name=\"posts_to_id\">";
                    echo ($context["S_MOVE_FORUM_OPTIONS"] ?? null);
                    echo "</select></dd>
\t\t\t";
                }
                // line 392
                echo "\t\t</dl>
\t";
            }
            // line 394
            echo "\t";
            if (($context["S_HAS_SUBFORUMS"] ?? null)) {
                // line 395
                echo "\t\t<dl>
\t\t\t<dt><label for=\"sub_delete_action\">";
                // line 396
                echo $this->extensions['phpbb\template\twig\extension']->lang("ACTION");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" id=\"sub_delete_action\" name=\"action_subforums\" value=\"delete\" checked=\"checked\" /> ";
                // line 397
                echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE_SUBFORUMS");
                echo "</label></dd>
\t\t\t";
                // line 398
                if (($context["S_FORUMS_LIST"] ?? null)) {
                    // line 399
                    echo "\t\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"action_subforums\" value=\"move\" /> ";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("MOVE_SUBFORUMS_TO");
                    echo "</label> <select name=\"subforums_to_id\">";
                    echo ($context["S_FORUMS_LIST"] ?? null);
                    echo "</select></dd>
\t\t\t";
                }
                // line 401
                echo "\t\t</dl>
\t";
            }
            // line 403
            echo "
\t<p class=\"quick\">
\t\t<input class=\"button1\" type=\"submit\" name=\"update\" value=\"";
            // line 405
            echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
            echo "\" />
\t</p>
\t";
            // line 407
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t</form>

";
        } elseif (        // line 411
($context["S_CONTINUE_SYNC"] ?? null)) {
            // line 412
            echo "
\t<script>
\t// <![CDATA[
\t\tvar close_waitscreen = 0;
\t\t// no scrollbars...
\t\tpopup('";
            // line 417
            echo ($context["UA_PROGRESS_BAR"] ?? null);
            echo "', 400, 240, '_sync');
\t// ]]>
\t</script>

\t<h1>";
            // line 421
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_ADMIN");
            echo "</h1>

\t<p>";
            // line 423
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_ADMIN_EXPLAIN");
            echo "</p>

\t<p>";
            // line 425
            echo $this->extensions['phpbb\template\twig\extension']->lang("PROGRESS_EXPLAIN");
            echo "</p>

";
        } else {
            // line 428
            echo "
\t<script>
\t// <![CDATA[
\t\t/**
\t\t* Popup search progress bar
\t\t*/
\t\tfunction popup_progress_bar()
\t\t{
\t\t\tvar close_waitscreen = 0;
\t\t\t// no scrollbars...
\t\t\tpopup('";
            // line 438
            echo ($context["UA_PROGRESS_BAR"] ?? null);
            echo "', 400, 240, '_sync');
\t\t}
\t// ]]>
\t</script>

\t<h1>";
            // line 443
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_ADMIN");
            echo "</h1>

\t<p>";
            // line 445
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_ADMIN_EXPLAIN");
            echo "</p>

\t";
            // line 447
            if (($context["ERROR_MSG"] ?? null)) {
                // line 448
                echo "\t\t<div class=\"errorbox\">
\t\t\t<h3>";
                // line 449
                echo $this->extensions['phpbb\template\twig\extension']->lang("WARNING");
                echo "</h3>
\t\t\t<p>";
                // line 450
                echo ($context["ERROR_MSG"] ?? null);
                echo "</p>
\t\t</div>
\t";
            }
            // line 453
            echo "
\t";
            // line 454
            if (($context["S_RESYNCED"] ?? null)) {
                // line 455
                echo "\t\t<script>
\t\t// <![CDATA[
\t\t\tvar close_waitscreen = 1;
\t\t// ]]>
\t\t</script>

\t\t<div class=\"successbox\">
\t\t\t<h3>";
                // line 462
                echo $this->extensions['phpbb\template\twig\extension']->lang("NOTIFY");
                echo "</h3>
\t\t\t<p>";
                // line 463
                echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_RESYNCED");
                echo "</p>
\t\t</div>
\t";
            }
            // line 466
            echo "
\t<p><strong>";
            // line 467
            echo ($context["NAVIGATION"] ?? null);
            if (($context["S_NO_FORUMS"] ?? null)) {
                echo " [<a href=\"";
                echo ($context["U_EDIT"] ?? null);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("EDIT");
                echo "</a> | <a href=\"";
                echo ($context["U_DELETE"] ?? null);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE");
                echo "</a>";
                if ( !($context["S_LINK"] ?? null)) {
                    echo " | <a href=\"";
                    echo ($context["U_SYNC"] ?? null);
                    echo "\">";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("RESYNC");
                    echo "</a>";
                }
                echo "]";
            }
            echo "</strong></p>

\t";
            // line 469
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "forums", [], "any", false, false, false, 469))) {
                // line 470
                echo "\t\t<table class=\"table1 forums\">
\t\t\t<col class=\"row1\" /><col class=\"row1\" /><col class=\"row2\" />
\t\t<tbody>
\t\t";
                // line 473
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "forums", [], "any", false, false, false, 473));
                foreach ($context['_seq'] as $context["_key"] => $context["forums"]) {
                    // line 474
                    echo "\t\t\t<tr>
\t\t\t\t<td class=\"folder\">";
                    // line 475
                    echo twig_get_attribute($this->env, $this->source, $context["forums"], "FOLDER_IMAGE", [], "any", false, false, false, 475);
                    echo "</td>
\t\t\t\t<td class=\"forum-desc\">
\t\t\t\t\t";
                    // line 477
                    if (twig_get_attribute($this->env, $this->source, $context["forums"], "FORUM_IMAGE", [], "any", false, false, false, 477)) {
                        echo "<div style=\"float: ";
                        echo ($context["S_CONTENT_FLOW_BEGIN"] ?? null);
                        echo "; margin-right: 5px;\">";
                        echo twig_get_attribute($this->env, $this->source, $context["forums"], "FORUM_IMAGE", [], "any", false, false, false, 477);
                        echo "</div>";
                    }
                    // line 478
                    echo "\t\t\t\t\t<strong>";
                    if (twig_get_attribute($this->env, $this->source, $context["forums"], "S_FORUM_LINK", [], "any", false, false, false, 478)) {
                        echo twig_get_attribute($this->env, $this->source, $context["forums"], "FORUM_NAME", [], "any", false, false, false, 478);
                    } else {
                        echo "<a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["forums"], "U_FORUM", [], "any", false, false, false, 478);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["forums"], "FORUM_NAME", [], "any", false, false, false, 478);
                        echo "</a>";
                    }
                    echo "</strong>
\t\t\t\t\t";
                    // line 479
                    if (twig_get_attribute($this->env, $this->source, $context["forums"], "FORUM_DESCRIPTION", [], "any", false, false, false, 479)) {
                        echo "<br /><span>";
                        echo twig_get_attribute($this->env, $this->source, $context["forums"], "FORUM_DESCRIPTION", [], "any", false, false, false, 479);
                        echo "</span>";
                    }
                    // line 480
                    echo "\t\t\t\t\t";
                    if (twig_get_attribute($this->env, $this->source, $context["forums"], "S_FORUM_POST", [], "any", false, false, false, 480)) {
                        echo "<br /><br /><span>";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("TOPICS");
                        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                        echo " <strong>";
                        echo twig_get_attribute($this->env, $this->source, $context["forums"], "FORUM_TOPICS", [], "any", false, false, false, 480);
                        echo "</strong> / ";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("POSTS");
                        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                        echo " <strong>";
                        echo twig_get_attribute($this->env, $this->source, $context["forums"], "FORUM_POSTS", [], "any", false, false, false, 480);
                        echo "</strong></span>";
                    }
                    // line 481
                    echo "\t\t\t\t</td>
\t\t\t\t<td class=\"actions\">
\t\t\t\t\t<span class=\"up-disabled\" style=\"display:none;\">";
                    // line 483
                    echo ($context["ICON_MOVE_UP_DISABLED"] ?? null);
                    echo "</span>
\t\t\t\t\t<span class=\"up\"><a href=\"";
                    // line 484
                    echo twig_get_attribute($this->env, $this->source, $context["forums"], "U_MOVE_UP", [], "any", false, false, false, 484);
                    echo "\" data-ajax=\"row_up\">";
                    echo ($context["ICON_MOVE_UP"] ?? null);
                    echo "</a></span>
\t\t\t\t\t<span class=\"down-disabled\" style=\"display:none;\">";
                    // line 485
                    echo ($context["ICON_MOVE_DOWN_DISABLED"] ?? null);
                    echo "</span>
\t\t\t\t\t<span class=\"down\"><a href=\"";
                    // line 486
                    echo twig_get_attribute($this->env, $this->source, $context["forums"], "U_MOVE_DOWN", [], "any", false, false, false, 486);
                    echo "\" data-ajax=\"row_down\">";
                    echo ($context["ICON_MOVE_DOWN"] ?? null);
                    echo "</a></span>
\t\t\t\t\t<a href=\"";
                    // line 487
                    echo twig_get_attribute($this->env, $this->source, $context["forums"], "U_EDIT", [], "any", false, false, false, 487);
                    echo "\">";
                    echo ($context["ICON_EDIT"] ?? null);
                    echo "</a>
\t\t\t\t\t";
                    // line 488
                    if ( !twig_get_attribute($this->env, $this->source, $context["forums"], "S_FORUM_LINK", [], "any", false, false, false, 488)) {
                        // line 489
                        echo "\t\t\t\t\t\t<a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["forums"], "U_SYNC", [], "any", false, false, false, 489);
                        echo "\" onclick=\"popup_progress_bar();\">";
                        echo ($context["ICON_SYNC"] ?? null);
                        echo "</a>
\t\t\t\t\t";
                    } else {
                        // line 491
                        echo "\t\t\t\t\t\t";
                        echo ($context["ICON_SYNC_DISABLED"] ?? null);
                        echo "
\t\t\t\t\t";
                    }
                    // line 493
                    echo "\t\t\t\t\t<a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["forums"], "U_DELETE", [], "any", false, false, false, 493);
                    echo "\">";
                    echo ($context["ICON_DELETE"] ?? null);
                    echo "</a>
\t\t\t\t</td>
\t\t\t</tr>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['forums'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 497
                echo "\t\t</tbody>
\t\t</table>
\t";
            }
            // line 500
            echo "
\t<form id=\"fselect\" method=\"post\" action=\"";
            // line 501
            echo ($context["U_SEL_ACTION"] ?? null);
            echo "\">

\t<fieldset class=\"quick\">
\t\t";
            // line 504
            echo $this->extensions['phpbb\template\twig\extension']->lang("SELECT_FORUM");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo " <select name=\"parent_id\" onchange=\"if(this.options[this.selectedIndex].value != -1){ this.form.submit(); }\">";
            echo ($context["FORUM_BOX"] ?? null);
            echo "</select>

\t\t";
            // line 506
            echo "<input class=\"button2\" type=\"submit\" value=\"";
            echo $this->extensions['phpbb\template\twig\extension']->lang("GO");
            echo "\" />";
            // line 507
            echo "\t\t";
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t</form>

\t<form id=\"forums\" method=\"post\" action=\"";
            // line 511
            echo ($context["U_ACTION"] ?? null);
            echo "\">

\t<fieldset class=\"quick\">
\t\t<input type=\"hidden\" name=\"action\" value=\"add\" />

\t\t<input type=\"text\" name=\"forum_name\" value=\"\" maxlength=\"255\" />
\t\t<input class=\"button2\" name=\"addforum\" type=\"submit\" value=\"";
            // line 517
            echo $this->extensions['phpbb\template\twig\extension']->lang("CREATE_FORUM");
            echo "\" />
\t\t";
            // line 518
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t</form>

";
        }
        // line 523
        echo "
";
        // line 524
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_forums.html", 524)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_forums.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1621 => 524,  1618 => 523,  1610 => 518,  1606 => 517,  1597 => 511,  1589 => 507,  1585 => 506,  1577 => 504,  1571 => 501,  1568 => 500,  1563 => 497,  1550 => 493,  1544 => 491,  1536 => 489,  1534 => 488,  1528 => 487,  1522 => 486,  1518 => 485,  1512 => 484,  1508 => 483,  1504 => 481,  1489 => 480,  1483 => 479,  1470 => 478,  1462 => 477,  1457 => 475,  1454 => 474,  1450 => 473,  1445 => 470,  1443 => 469,  1419 => 467,  1416 => 466,  1410 => 463,  1406 => 462,  1397 => 455,  1395 => 454,  1392 => 453,  1386 => 450,  1382 => 449,  1379 => 448,  1377 => 447,  1372 => 445,  1367 => 443,  1359 => 438,  1347 => 428,  1341 => 425,  1336 => 423,  1331 => 421,  1324 => 417,  1317 => 412,  1315 => 411,  1308 => 407,  1303 => 405,  1299 => 403,  1295 => 401,  1287 => 399,  1285 => 398,  1281 => 397,  1276 => 396,  1273 => 395,  1270 => 394,  1266 => 392,  1258 => 390,  1256 => 389,  1252 => 388,  1247 => 387,  1244 => 386,  1242 => 385,  1237 => 383,  1232 => 382,  1227 => 380,  1221 => 377,  1218 => 376,  1212 => 373,  1208 => 372,  1205 => 371,  1203 => 370,  1198 => 368,  1193 => 366,  1184 => 364,  1181 => 363,  1179 => 362,  1172 => 358,  1168 => 357,  1164 => 356,  1160 => 355,  1156 => 353,  1155 => 352,  1150 => 349,  1149 => 348,  1140 => 346,  1132 => 345,  1124 => 344,  1120 => 343,  1113 => 342,  1110 => 341,  1104 => 338,  1099 => 337,  1096 => 336,  1094 => 335,  1089 => 333,  1082 => 332,  1079 => 331,  1078 => 330,  1074 => 329,  1060 => 322,  1052 => 321,  1045 => 320,  1039 => 317,  1032 => 316,  1022 => 313,  1014 => 312,  1007 => 311,  1002 => 309,  995 => 304,  994 => 303,  987 => 301,  980 => 300,  972 => 297,  965 => 296,  955 => 293,  947 => 292,  940 => 291,  930 => 288,  922 => 287,  917 => 286,  907 => 283,  899 => 282,  894 => 281,  884 => 278,  876 => 277,  869 => 276,  861 => 273,  854 => 272,  846 => 269,  839 => 268,  831 => 265,  824 => 264,  814 => 261,  806 => 260,  799 => 259,  796 => 258,  795 => 257,  791 => 256,  786 => 253,  785 => 252,  780 => 250,  773 => 249,  763 => 246,  755 => 245,  748 => 244,  738 => 241,  730 => 240,  725 => 239,  715 => 236,  707 => 235,  700 => 234,  690 => 231,  682 => 230,  675 => 229,  665 => 226,  657 => 225,  650 => 224,  640 => 221,  632 => 220,  625 => 219,  615 => 216,  607 => 215,  600 => 214,  590 => 211,  582 => 210,  575 => 209,  569 => 206,  564 => 205,  561 => 204,  560 => 203,  556 => 202,  542 => 195,  534 => 194,  527 => 193,  522 => 191,  516 => 187,  515 => 186,  508 => 184,  503 => 183,  500 => 182,  490 => 178,  487 => 177,  485 => 176,  478 => 174,  471 => 173,  463 => 170,  456 => 169,  452 => 167,  444 => 165,  442 => 164,  438 => 163,  431 => 162,  421 => 159,  413 => 158,  405 => 157,  401 => 156,  394 => 155,  388 => 152,  383 => 151,  380 => 150,  372 => 147,  365 => 146,  362 => 145,  360 => 144,  349 => 142,  344 => 141,  341 => 140,  336 => 137,  330 => 135,  322 => 133,  320 => 132,  315 => 131,  311 => 129,  308 => 128,  303 => 125,  295 => 124,  287 => 123,  282 => 122,  278 => 120,  276 => 119,  271 => 117,  266 => 116,  263 => 115,  262 => 114,  258 => 113,  252 => 110,  249 => 109,  243 => 106,  239 => 105,  236 => 104,  234 => 103,  229 => 101,  219 => 99,  210 => 97,  203 => 92,  199 => 90,  197 => 89,  194 => 88,  190 => 86,  188 => 85,  185 => 84,  181 => 82,  179 => 81,  176 => 80,  172 => 78,  170 => 77,  167 => 76,  164 => 75,  160 => 73,  157 => 72,  155 => 71,  152 => 70,  149 => 69,  145 => 67,  142 => 66,  140 => 65,  122 => 50,  112 => 43,  102 => 36,  99 => 35,  86 => 26,  84 => 25,  81 => 24,  68 => 15,  66 => 14,  56 => 6,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_forums.html", "");
    }
}
