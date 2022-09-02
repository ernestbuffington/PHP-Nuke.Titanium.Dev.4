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

/* acp_main.html */
class __TwigTemplate_51bdf1d01528291e218498c9a501c5240686db62b3e3792322eb7c258ba33531 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_main.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

";
        // line 5
        if (($context["S_RESTORE_PERMISSIONS"] ?? null)) {
            // line 6
            echo "
\t<h1>";
            // line 7
            echo $this->extensions['phpbb\template\twig\extension']->lang("PERMISSIONS_TRANSFERRED");
            echo "</h1>

\t<p>";
            // line 9
            echo $this->extensions['phpbb\template\twig\extension']->lang("PERMISSIONS_TRANSFERRED_EXPLAIN");
            echo "</p>

";
        } else {
            // line 12
            echo "
\t<h1>";
            // line 13
            echo $this->extensions['phpbb\template\twig\extension']->lang("WELCOME_PHPBB");
            echo "</h1>

\t<p>";
            // line 15
            echo $this->extensions['phpbb\template\twig\extension']->lang("ADMIN_INTRO");
            echo "</p>

\t";
            // line 17
            if (($context["S_UPDATE_INCOMPLETE"] ?? null)) {
                // line 18
                echo "\t\t<div class=\"errorbox\">
\t\t\t<p>";
                // line 19
                echo $this->extensions['phpbb\template\twig\extension']->lang("UPDATE_INCOMPLETE");
                echo " <a href=\"";
                echo ($context["U_VERSIONCHECK"] ?? null);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("MORE_INFORMATION");
                echo "</a></p>
\t\t</div>
\t";
            } elseif (            // line 21
($context["S_VERSIONCHECK_FAIL"] ?? null)) {
                // line 22
                echo "\t\t<div class=\"errorbox notice\">
\t\t\t<p>";
                // line 23
                echo $this->extensions['phpbb\template\twig\extension']->lang("VERSIONCHECK_FAIL");
                echo "</p>
\t\t\t<p>";
                // line 24
                echo ($context["VERSIONCHECK_FAIL_REASON"] ?? null);
                echo "</p>
\t\t\t<p><a href=\"";
                // line 25
                echo ($context["U_VERSIONCHECK_FORCE"] ?? null);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("VERSIONCHECK_FORCE_UPDATE");
                echo "</a> &middot; <a href=\"";
                echo ($context["U_VERSIONCHECK"] ?? null);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("MORE_INFORMATION");
                echo "</a></p>
\t\t</div>
\t";
            } elseif ( !            // line 27
($context["S_VERSION_UP_TO_DATE"] ?? null)) {
                // line 28
                echo "\t\t<div class=\"errorbox\">
\t\t\t<p>";
                // line 29
                echo $this->extensions['phpbb\template\twig\extension']->lang("VERSION_NOT_UP_TO_DATE_TITLE");
                echo "</p>
\t\t\t<p><a href=\"";
                // line 30
                echo ($context["U_VERSIONCHECK_FORCE"] ?? null);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("VERSIONCHECK_FORCE_UPDATE");
                echo "</a> &middot; <a href=\"";
                echo ($context["U_VERSIONCHECK"] ?? null);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("MORE_INFORMATION");
                echo "</a></p>
\t\t</div>
\t";
            }
            // line 33
            echo "\t";
            if (($context["S_VERSION_UPGRADEABLE"] ?? null)) {
                // line 34
                echo "\t\t<div class=\"errorbox notice\">
\t\t\t<p>";
                // line 35
                echo ($context["UPGRADE_INSTRUCTIONS"] ?? null);
                echo "</p>
\t\t</div>
\t";
            }
            // line 38
            echo "
\t";
            // line 39
            if (($context["S_SEARCH_INDEX_MISSING"] ?? null)) {
                // line 40
                echo "\t\t<div class=\"errorbox\">
\t\t\t<h3>";
                // line 41
                echo $this->extensions['phpbb\template\twig\extension']->lang("WARNING");
                echo "</h3>
\t\t\t<p>";
                // line 42
                echo $this->extensions['phpbb\template\twig\extension']->lang("NO_SEARCH_INDEX");
                echo "</p>
\t\t</div>
\t";
            }
            // line 45
            echo "
\t";
            // line 46
            if (($context["S_REMOVE_INSTALL"] ?? null)) {
                // line 47
                echo "\t\t<div class=\"errorbox\">
\t\t\t<h3>";
                // line 48
                echo $this->extensions['phpbb\template\twig\extension']->lang("WARNING");
                echo "</h3>
\t\t\t<p>";
                // line 49
                echo $this->extensions['phpbb\template\twig\extension']->lang("REMOVE_INSTALL");
                echo "</p>
\t\t</div>
\t";
            }
            // line 52
            echo "
\t";
            // line 53
            if (($context["S_MBSTRING_LOADED"] ?? null)) {
                // line 54
                echo "\t\t";
                if (($context["S_MBSTRING_FUNC_OVERLOAD_FAIL"] ?? null)) {
                    // line 55
                    echo "\t\t\t<div class=\"errorbox\">
\t\t\t\t<h3>";
                    // line 56
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ERROR_MBSTRING_FUNC_OVERLOAD");
                    echo "</h3>
\t\t\t\t<p>";
                    // line 57
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ERROR_MBSTRING_FUNC_OVERLOAD_EXPLAIN");
                    echo "</p>
\t\t\t</div>
\t\t";
                }
                // line 60
                echo "
\t\t";
                // line 61
                if (($context["S_MBSTRING_ENCODING_TRANSLATION_FAIL"] ?? null)) {
                    // line 62
                    echo "\t\t\t<div class=\"errorbox\">
\t\t\t\t<h3>";
                    // line 63
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ERROR_MBSTRING_ENCODING_TRANSLATION");
                    echo "</h3>
\t\t\t\t<p>";
                    // line 64
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ERROR_MBSTRING_ENCODING_TRANSLATION_EXPLAIN");
                    echo "</p>
\t\t\t</div>
\t\t";
                }
                // line 67
                echo "
\t\t";
                // line 68
                if (($context["S_MBSTRING_HTTP_INPUT_FAIL"] ?? null)) {
                    // line 69
                    echo "\t\t\t<div class=\"errorbox\">
\t\t\t\t<h3>";
                    // line 70
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ERROR_MBSTRING_HTTP_INPUT");
                    echo "</h3>
\t\t\t\t<p>";
                    // line 71
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ERROR_MBSTRING_HTTP_INPUT_EXPLAIN");
                    echo "</p>
\t\t\t</div>
\t\t";
                }
                // line 74
                echo "
\t\t";
                // line 75
                if (($context["S_MBSTRING_HTTP_OUTPUT_FAIL"] ?? null)) {
                    // line 76
                    echo "\t\t\t<div class=\"errorbox\">
\t\t\t\t<h3>";
                    // line 77
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ERROR_MBSTRING_HTTP_OUTPUT");
                    echo "</h3>
\t\t\t\t<p>";
                    // line 78
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ERROR_MBSTRING_HTTP_OUTPUT_EXPLAIN");
                    echo "</p>
\t\t\t</div>
\t\t";
                }
                // line 81
                echo "
\t\t";
                // line 82
                if (($context["S_DEFAULT_CHARSET_FAIL"] ?? null)) {
                    // line 83
                    echo "\t\t\t<div class=\"errorbox\">
\t\t\t\t<h3>";
                    // line 84
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ERROR_DEFAULT_CHARSET");
                    echo "</h3>
\t\t\t\t<p>";
                    // line 85
                    echo $this->extensions['phpbb\template\twig\extension']->lang("ERROR_DEFAULT_CHARSET_EXPLAIN");
                    echo "</p>
\t\t\t</div>
\t\t";
                }
                // line 88
                echo "\t";
            }
            // line 89
            echo "
\t";
            // line 90
            if (($context["S_WRITABLE_CONFIG"] ?? null)) {
                // line 91
                echo "\t\t<div class=\"errorbox notice\">
\t\t\t<p>";
                // line 92
                echo $this->extensions['phpbb\template\twig\extension']->lang("WRITABLE_CONFIG");
                echo "</p>
\t\t</div>
\t";
            }
            // line 95
            echo "
\t";
            // line 96
            if (($context["S_PHP_VERSION_OLD"] ?? null)) {
                // line 97
                echo "\t\t<div class=\"errorbox notice\">
\t\t\t<p>";
                // line 98
                echo $this->extensions['phpbb\template\twig\extension']->lang("PHP_VERSION_OLD");
                echo "</p>
\t\t</div>
\t";
            }
            // line 101
            echo "
\t";
            // line 102
            // line 103
            echo "
\t\t<div class=\"lside\">
\t\t\t<table class=\"table2 zebra-table no-header\" data-no-responsive-header=\"true\">
\t\t\t\t<thead>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th>";
            // line 108
            echo $this->extensions['phpbb\template\twig\extension']->lang("STATISTIC");
            echo "</th>
\t\t\t\t\t\t<th>";
            // line 109
            echo $this->extensions['phpbb\template\twig\extension']->lang("VALUE");
            echo "</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>

\t\t\t\t<tbody>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">";
            // line 115
            echo ($this->extensions['phpbb\template\twig\extension']->lang("BOARD_STARTED") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</td>
\t\t\t\t\t\t<td class=\"tabled\"><strong>";
            // line 116
            echo ($context["START_DATE"] ?? null);
            echo "</strong></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">";
            // line 119
            echo ($this->extensions['phpbb\template\twig\extension']->lang("AVATAR_DIR_SIZE") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</td>
\t\t\t\t\t\t<td class=\"tabled\"><strong>";
            // line 120
            echo ($context["AVATAR_DIR_SIZE"] ?? null);
            echo "</strong></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">";
            // line 123
            echo ($this->extensions['phpbb\template\twig\extension']->lang("DATABASE_SIZE") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</td>
\t\t\t\t\t\t<td class=\"tabled\"><strong>";
            // line 124
            echo ($context["DBSIZE"] ?? null);
            echo "</strong></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">";
            // line 127
            echo ($this->extensions['phpbb\template\twig\extension']->lang("UPLOAD_DIR_SIZE") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</td>
\t\t\t\t\t\t<td class=\"tabled\"><strong>";
            // line 128
            echo ($context["UPLOAD_DIR_SIZE"] ?? null);
            echo "</strong></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">";
            // line 131
            echo ($this->extensions['phpbb\template\twig\extension']->lang("DATABASE_SERVER_INFO") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</td>
\t\t\t\t\t\t<td class=\"tabled\"><strong>";
            // line 132
            echo ($context["DATABASE_INFO"] ?? null);
            echo "</strong></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">";
            // line 135
            echo ($this->extensions['phpbb\template\twig\extension']->lang("GZIP_COMPRESSION") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</td>
\t\t\t\t\t\t<td class=\"tabled\"><strong>";
            // line 136
            echo ($context["GZIP_COMPRESSION"] ?? null);
            echo "</strong></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">";
            // line 139
            echo ($this->extensions['phpbb\template\twig\extension']->lang("PHP_VERSION") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</td>
\t\t\t\t\t\t<td class=\"tabled\"><strong>";
            // line 140
            echo ($context["PHP_VERSION_INFO"] ?? null);
            echo "</strong></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">";
            // line 143
            echo ($this->extensions['phpbb\template\twig\extension']->lang("NUMBER_ORPHAN") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</td>
\t\t\t\t\t\t<td class=\"tabled\">
\t\t\t\t\t\t";
            // line 145
            if ((($context["TOTAL_ORPHAN"] ?? null) > 0)) {
                // line 146
                echo "\t\t\t\t\t\t\t<a href=\"";
                echo ($context["U_ATTACH_ORPHAN"] ?? null);
                echo "\" title=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("MORE_INFORMATION");
                echo "\"><strong>";
                echo ($context["TOTAL_ORPHAN"] ?? null);
                echo "</strong></a>
\t\t\t\t\t\t";
            } else {
                // line 148
                echo "\t\t\t\t\t\t\t<strong>";
                echo ($context["TOTAL_ORPHAN"] ?? null);
                echo "</strong>
\t\t\t\t\t\t";
            }
            // line 150
            echo "\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t\t";
            // line 152
            if (($context["S_VERSIONCHECK"] ?? null)) {
                // line 153
                echo "\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">";
                // line 154
                echo ($this->extensions['phpbb\template\twig\extension']->lang("BOARD_VERSION") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
                echo "</td>
\t\t\t\t\t\t<td class=\"tabled\">
\t\t\t\t\t\t\t<strong><a href=\"";
                // line 156
                echo ($context["U_VERSIONCHECK"] ?? null);
                echo "\" ";
                if (($context["S_VERSION_UP_TO_DATE"] ?? null)) {
                    echo "style=\"color: #228822;\" ";
                } elseif ( !($context["S_VERSIONCHECK_FAIL"] ?? null)) {
                    echo "style=\"color: #BC2A4D;\" ";
                }
                echo "title=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("MORE_INFORMATION");
                echo "\">";
                echo ($context["BOARD_VERSION"] ?? null);
                echo "</a></strong> [&nbsp;<a href=\"";
                echo ($context["U_VERSIONCHECK_FORCE"] ?? null);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("VERSIONCHECK_FORCE_UPDATE");
                echo "</a>&nbsp;]
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t\t";
            }
            // line 160
            echo "\t\t\t\t</tbody>
\t\t\t</table>

\t\t\t<table class=\"table2 zebra-table no-header\" data-no-responsive-header=\"true\">
\t\t\t\t<thead>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th>";
            // line 166
            echo $this->extensions['phpbb\template\twig\extension']->lang("STATISTIC");
            echo "</th>
\t\t\t\t\t\t<th>";
            // line 167
            echo $this->extensions['phpbb\template\twig\extension']->lang("VALUE");
            echo "</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>

\t\t\t\t<tbody>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">";
            // line 173
            echo ($this->extensions['phpbb\template\twig\extension']->lang("NUMBER_POSTS") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</td>
\t\t\t\t\t\t<td class=\"tabled\"><strong>";
            // line 174
            echo ($context["TOTAL_POSTS"] ?? null);
            echo "</strong></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">";
            // line 177
            echo ($this->extensions['phpbb\template\twig\extension']->lang("POSTS_PER_DAY") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</td>
\t\t\t\t\t\t<td class=\"tabled\"><strong>";
            // line 178
            echo ($context["POSTS_PER_DAY"] ?? null);
            echo "</strong></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">";
            // line 181
            echo ($this->extensions['phpbb\template\twig\extension']->lang("NUMBER_TOPICS") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</td>
\t\t\t\t\t\t<td class=\"tabled\"><strong>";
            // line 182
            echo ($context["TOTAL_TOPICS"] ?? null);
            echo "</strong></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">";
            // line 185
            echo ($this->extensions['phpbb\template\twig\extension']->lang("TOPICS_PER_DAY") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</td>
\t\t\t\t\t\t<td class=\"tabled\"><strong>";
            // line 186
            echo ($context["TOPICS_PER_DAY"] ?? null);
            echo "</strong></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">";
            // line 189
            echo ($this->extensions['phpbb\template\twig\extension']->lang("NUMBER_USERS") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</td>
\t\t\t\t\t\t<td class=\"tabled\"><strong>";
            // line 190
            echo ($context["TOTAL_USERS"] ?? null);
            echo "</strong></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">";
            // line 193
            echo ($this->extensions['phpbb\template\twig\extension']->lang("USERS_PER_DAY") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</td>
\t\t\t\t\t\t<td class=\"tabled\"><strong>";
            // line 194
            echo ($context["USERS_PER_DAY"] ?? null);
            echo "</strong></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">";
            // line 197
            echo ($this->extensions['phpbb\template\twig\extension']->lang("NUMBER_FILES") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</td>
\t\t\t\t\t\t<td class=\"tabled\"><strong>";
            // line 198
            echo ($context["TOTAL_FILES"] ?? null);
            echo "</strong></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">";
            // line 201
            echo ($this->extensions['phpbb\template\twig\extension']->lang("FILES_PER_DAY") . $this->extensions['phpbb\template\twig\extension']->lang("COLON"));
            echo "</td>
\t\t\t\t\t\t<td class=\"tabled\"><strong>";
            // line 202
            echo ($context["FILES_PER_DAY"] ?? null);
            echo "</strong></td>
\t\t\t\t\t</tr>
\t\t\t\t\t";
            // line 204
            if (($context["S_VERSIONCHECK"] ?? null)) {
                // line 205
                echo "\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"tabled\">&nbsp;</td>
\t\t\t\t\t\t<td class=\"tabled\">&nbsp;</td>
\t\t\t\t\t</tr>
\t\t\t\t\t";
            }
            // line 210
            echo "\t\t\t\t</tbody>
\t\t\t</table>
\t\t</div>

\t";
            // line 214
            if (($context["S_ACTION_OPTIONS"] ?? null)) {
                // line 215
                echo "\t\t<fieldset>
\t\t\t<legend>";
                // line 216
                echo $this->extensions['phpbb\template\twig\extension']->lang("STATISTIC_RESYNC_OPTIONS");
                echo "</legend>

\t\t\t<form id=\"action_online_form\" method=\"post\" action=\"";
                // line 218
                echo ($context["U_ACTION"] ?? null);
                echo "\" data-ajax=\"true\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"action_online\">";
                // line 220
                echo $this->extensions['phpbb\template\twig\extension']->lang("RESET_ONLINE");
                echo "</label><br /><span>&nbsp;</span></dt>
\t\t\t\t\t<dd><input type=\"hidden\" name=\"action\" value=\"online\" /><input class=\"button2\" type=\"submit\" id=\"action_online\" name=\"action_online\" value=\"";
                // line 221
                echo $this->extensions['phpbb\template\twig\extension']->lang("RUN");
                echo "\" /></dd>
\t\t\t\t</dl>
\t\t\t</form>

\t\t\t<form id=\"action_date_form\" method=\"post\" action=\"";
                // line 225
                echo ($context["U_ACTION"] ?? null);
                echo "\" data-ajax=\"true\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"action_date\">";
                // line 227
                echo $this->extensions['phpbb\template\twig\extension']->lang("RESET_DATE");
                echo "</label><br /><span>&nbsp;</span></dt>
\t\t\t\t\t<dd><input type=\"hidden\" name=\"action\" value=\"date\" /><input class=\"button2\" type=\"submit\" id=\"action_date\" name=\"action_date\" value=\"";
                // line 228
                echo $this->extensions['phpbb\template\twig\extension']->lang("RUN");
                echo "\" /></dd>
\t\t\t\t</dl>
\t\t\t</form>

\t\t\t<form id=\"action_stats_form\" method=\"post\" action=\"";
                // line 232
                echo ($context["U_ACTION"] ?? null);
                echo "\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"action_stats\">";
                // line 234
                echo $this->extensions['phpbb\template\twig\extension']->lang("RESYNC_STATS");
                echo "</label><br /><span>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("RESYNC_STATS_EXPLAIN");
                echo "</span></dt>
\t\t\t\t\t<dd><input type=\"hidden\" name=\"action\" value=\"stats\" /><input class=\"button2\" type=\"submit\" id=\"action_stats\" name=\"action_stats\" value=\"";
                // line 235
                echo $this->extensions['phpbb\template\twig\extension']->lang("RUN");
                echo "\" /></dd>
\t\t\t\t</dl>
\t\t\t</form>

\t\t\t<form id=\"action_user_form\" method=\"post\" action=\"";
                // line 239
                echo ($context["U_ACTION"] ?? null);
                echo "\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"action_user\">";
                // line 241
                echo $this->extensions['phpbb\template\twig\extension']->lang("RESYNC_POSTCOUNTS");
                echo "</label><br /><span>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("RESYNC_POSTCOUNTS_EXPLAIN");
                echo "</span></dt>
\t\t\t\t\t<dd><input type=\"hidden\" name=\"action\" value=\"user\" /><input class=\"button2\" type=\"submit\" id=\"action_user\" name=\"action_user\" value=\"";
                // line 242
                echo $this->extensions['phpbb\template\twig\extension']->lang("RUN");
                echo "\" /></dd>
\t\t\t\t</dl>
\t\t\t</form>

\t\t\t<form id=\"action_db_track_form\" method=\"post\" action=\"";
                // line 246
                echo ($context["U_ACTION"] ?? null);
                echo "\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"action_db_track\">";
                // line 248
                echo $this->extensions['phpbb\template\twig\extension']->lang("RESYNC_POST_MARKING");
                echo "</label><br /><span>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("RESYNC_POST_MARKING_EXPLAIN");
                echo "</span></dt>
\t\t\t\t\t<dd><input type=\"hidden\" name=\"action\" value=\"db_track\" /><input class=\"button2\" type=\"submit\" id=\"action_db_track\" name=\"action_db_track\" value=\"";
                // line 249
                echo $this->extensions['phpbb\template\twig\extension']->lang("RUN");
                echo "\" /></dd>
\t\t\t\t</dl>
\t\t\t</form>

\t\t\t";
                // line 253
                if (($context["S_FOUNDER"] ?? null)) {
                    // line 254
                    echo "\t\t\t<form id=\"action_purge_sessions_form\" method=\"post\" action=\"";
                    echo ($context["U_ACTION"] ?? null);
                    echo "\" data-ajax=\"true\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"action_purge_sessions\">";
                    // line 256
                    echo $this->extensions['phpbb\template\twig\extension']->lang("PURGE_SESSIONS");
                    echo "</label><br /><span>";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("PURGE_SESSIONS_EXPLAIN");
                    echo "</span></dt>
\t\t\t\t\t<dd><input type=\"hidden\" name=\"action\" value=\"purge_sessions\" /><input class=\"button2\" type=\"submit\" id=\"action_purge_sessions\" name=\"action_purge_sessions\" value=\"";
                    // line 257
                    echo $this->extensions['phpbb\template\twig\extension']->lang("RUN");
                    echo "\" /></dd>
\t\t\t\t</dl>
\t\t\t</form>
\t\t\t";
                }
                // line 261
                echo "
\t\t\t<form id=\"action_purge_cache_form\" method=\"post\" action=\"";
                // line 262
                echo ($context["U_ACTION"] ?? null);
                echo "\" data-ajax=\"true\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"action_purge_cache\">";
                // line 264
                echo $this->extensions['phpbb\template\twig\extension']->lang("PURGE_CACHE");
                echo "</label><br /><span>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("PURGE_CACHE_EXPLAIN");
                echo "</span></dt>
\t\t\t\t\t<dd><input type=\"hidden\" name=\"action\" value=\"purge_cache\" /><input class=\"button2\" type=\"submit\" id=\"action_purge_cache\" name=\"action_purge_cache\" value=\"";
                // line 265
                echo $this->extensions['phpbb\template\twig\extension']->lang("RUN");
                echo "\" /></dd>
\t\t\t\t</dl>
\t\t\t</form>

\t\t\t";
                // line 269
                // line 270
                echo "  \t\t</fieldset>
\t";
            }
            // line 272
            echo "
\t";
            // line 273
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "log", [], "any", false, false, false, 273))) {
                // line 274
                echo "\t\t<h2>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("ADMIN_LOG");
                echo "</h2>

\t\t<p>";
                // line 276
                echo $this->extensions['phpbb\template\twig\extension']->lang("ADMIN_LOG_INDEX_EXPLAIN");
                echo "</p>

\t\t<div style=\"text-align: right;\"><a href=\"";
                // line 278
                echo ($context["U_ADMIN_LOG"] ?? null);
                echo "\">&raquo; ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("VIEW_ADMIN_LOG");
                echo "</a></div>

\t\t<table class=\"table1 zebra-table\">
\t\t<thead>
\t\t<tr>
\t\t\t<th>";
                // line 283
                echo $this->extensions['phpbb\template\twig\extension']->lang("USERNAME");
                echo "</th>
\t\t\t<th>";
                // line 284
                echo $this->extensions['phpbb\template\twig\extension']->lang("IP");
                echo "</th>
\t\t\t<th>";
                // line 285
                echo $this->extensions['phpbb\template\twig\extension']->lang("TIME");
                echo "</th>
\t\t\t<th>";
                // line 286
                echo $this->extensions['phpbb\template\twig\extension']->lang("ACTION");
                echo "</th>
\t\t</tr>
\t\t</thead>
\t\t<tbody>
\t\t";
                // line 290
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "log", [], "any", false, false, false, 290));
                foreach ($context['_seq'] as $context["_key"] => $context["log"]) {
                    // line 291
                    echo "\t\t\t<tr>
\t\t\t\t<td>";
                    // line 292
                    echo twig_get_attribute($this->env, $this->source, $context["log"], "USERNAME", [], "any", false, false, false, 292);
                    echo "</td>
\t\t\t\t<td style=\"text-align: center;\">";
                    // line 293
                    echo twig_get_attribute($this->env, $this->source, $context["log"], "IP", [], "any", false, false, false, 293);
                    echo "</td>
\t\t\t\t<td style=\"text-align: center;\">";
                    // line 294
                    echo twig_get_attribute($this->env, $this->source, $context["log"], "DATE", [], "any", false, false, false, 294);
                    echo "</td>
\t\t\t\t<td>";
                    // line 295
                    echo twig_get_attribute($this->env, $this->source, $context["log"], "ACTION", [], "any", false, false, false, 295);
                    echo "</td>
\t\t\t</tr>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['log'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 298
                echo "\t\t</tbody>
\t\t</table>
\t";
            }
            // line 301
            echo "
\t";
            // line 302
            if (($context["S_INACTIVE_USERS"] ?? null)) {
                // line 303
                echo "\t\t<h2>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("INACTIVE_USERS");
                echo "</h2>

\t\t<p>";
                // line 305
                echo $this->extensions['phpbb\template\twig\extension']->lang("INACTIVE_USERS_EXPLAIN_INDEX");
                echo "</p>

\t\t<div style=\"text-align: right;\"><a href=\"";
                // line 307
                echo ($context["U_INACTIVE_USERS"] ?? null);
                echo "\">&raquo; ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("VIEW_INACTIVE_USERS");
                echo "</a></div>

\t\t<table class=\"table1 zebra-table\">
\t\t<thead>
\t\t<tr>
\t\t\t<th>";
                // line 312
                echo $this->extensions['phpbb\template\twig\extension']->lang("USERNAME");
                echo "</th>
\t\t\t<th>";
                // line 313
                echo $this->extensions['phpbb\template\twig\extension']->lang("JOINED");
                echo "</th>
\t\t\t<th>";
                // line 314
                echo $this->extensions['phpbb\template\twig\extension']->lang("INACTIVE_DATE");
                echo "</th>
\t\t\t<th>";
                // line 315
                echo $this->extensions['phpbb\template\twig\extension']->lang("LAST_VISIT");
                echo "</th>
\t\t\t<th>";
                // line 316
                echo $this->extensions['phpbb\template\twig\extension']->lang("INACTIVE_REASON");
                echo "</th>
\t\t</tr>
\t\t</thead>
\t\t<tbody>
\t\t";
                // line 320
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "inactive", [], "any", false, false, false, 320));
                $context['_iterated'] = false;
                foreach ($context['_seq'] as $context["_key"] => $context["inactive"]) {
                    // line 321
                    echo "\t\t\t<tr>
\t\t\t\t<td style=\"vertical-align: top;\">
\t\t\t\t\t";
                    // line 323
                    echo twig_get_attribute($this->env, $this->source, $context["inactive"], "USERNAME_FULL", [], "any", false, false, false, 323);
                    echo "
\t\t\t\t\t";
                    // line 324
                    if (twig_get_attribute($this->env, $this->source, $context["inactive"], "POSTS", [], "any", false, false, false, 324)) {
                        echo "<br />";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("POSTS");
                        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                        echo " <strong>";
                        echo twig_get_attribute($this->env, $this->source, $context["inactive"], "POSTS", [], "any", false, false, false, 324);
                        echo "</strong> [<a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["inactive"], "U_SEARCH_USER", [], "any", false, false, false, 324);
                        echo "\">";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_USER_POSTS");
                        echo "</a>]";
                    }
                    // line 325
                    echo "\t\t\t\t</td>
\t\t\t\t<td style=\"vertical-align: top;\">";
                    // line 326
                    echo twig_get_attribute($this->env, $this->source, $context["inactive"], "JOINED", [], "any", false, false, false, 326);
                    echo "</td>
\t\t\t\t<td style=\"vertical-align: top;\">";
                    // line 327
                    echo twig_get_attribute($this->env, $this->source, $context["inactive"], "INACTIVE_DATE", [], "any", false, false, false, 327);
                    echo "</td>
\t\t\t\t<td style=\"vertical-align: top;\">";
                    // line 328
                    echo twig_get_attribute($this->env, $this->source, $context["inactive"], "LAST_VISIT", [], "any", false, false, false, 328);
                    echo "</td>
\t\t\t\t<td style=\"vertical-align: top;\">
\t\t\t\t\t";
                    // line 330
                    echo twig_get_attribute($this->env, $this->source, $context["inactive"], "REASON", [], "any", false, false, false, 330);
                    echo "
\t\t\t\t\t";
                    // line 331
                    if (twig_get_attribute($this->env, $this->source, $context["inactive"], "REMINDED", [], "any", false, false, false, 331)) {
                        echo "<br />";
                        echo twig_get_attribute($this->env, $this->source, $context["inactive"], "REMINDED_EXPLAIN", [], "any", false, false, false, 331);
                    }
                    // line 332
                    echo "\t\t\t\t</td>
\t\t\t</tr>
\t\t";
                    $context['_iterated'] = true;
                }
                if (!$context['_iterated']) {
                    // line 335
                    echo "\t\t\t<tr>
\t\t\t\t<td colspan=\"5\" style=\"text-align: center;\">";
                    // line 336
                    echo $this->extensions['phpbb\template\twig\extension']->lang("NO_INACTIVE_USERS");
                    echo "</td>
\t\t\t</tr>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['inactive'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 339
                echo "\t\t</tbody>
\t\t</table>
\t";
            }
            // line 342
            echo "
";
        }
        // line 344
        echo "
";
        // line 345
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_main.html", 345)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  933 => 345,  930 => 344,  926 => 342,  921 => 339,  912 => 336,  909 => 335,  902 => 332,  897 => 331,  893 => 330,  888 => 328,  884 => 327,  880 => 326,  877 => 325,  864 => 324,  860 => 323,  856 => 321,  851 => 320,  844 => 316,  840 => 315,  836 => 314,  832 => 313,  828 => 312,  818 => 307,  813 => 305,  807 => 303,  805 => 302,  802 => 301,  797 => 298,  788 => 295,  784 => 294,  780 => 293,  776 => 292,  773 => 291,  769 => 290,  762 => 286,  758 => 285,  754 => 284,  750 => 283,  740 => 278,  735 => 276,  729 => 274,  727 => 273,  724 => 272,  720 => 270,  719 => 269,  712 => 265,  706 => 264,  701 => 262,  698 => 261,  691 => 257,  685 => 256,  679 => 254,  677 => 253,  670 => 249,  664 => 248,  659 => 246,  652 => 242,  646 => 241,  641 => 239,  634 => 235,  628 => 234,  623 => 232,  616 => 228,  612 => 227,  607 => 225,  600 => 221,  596 => 220,  591 => 218,  586 => 216,  583 => 215,  581 => 214,  575 => 210,  568 => 205,  566 => 204,  561 => 202,  557 => 201,  551 => 198,  547 => 197,  541 => 194,  537 => 193,  531 => 190,  527 => 189,  521 => 186,  517 => 185,  511 => 182,  507 => 181,  501 => 178,  497 => 177,  491 => 174,  487 => 173,  478 => 167,  474 => 166,  466 => 160,  445 => 156,  440 => 154,  437 => 153,  435 => 152,  431 => 150,  425 => 148,  415 => 146,  413 => 145,  408 => 143,  402 => 140,  398 => 139,  392 => 136,  388 => 135,  382 => 132,  378 => 131,  372 => 128,  368 => 127,  362 => 124,  358 => 123,  352 => 120,  348 => 119,  342 => 116,  338 => 115,  329 => 109,  325 => 108,  318 => 103,  317 => 102,  314 => 101,  308 => 98,  305 => 97,  303 => 96,  300 => 95,  294 => 92,  291 => 91,  289 => 90,  286 => 89,  283 => 88,  277 => 85,  273 => 84,  270 => 83,  268 => 82,  265 => 81,  259 => 78,  255 => 77,  252 => 76,  250 => 75,  247 => 74,  241 => 71,  237 => 70,  234 => 69,  232 => 68,  229 => 67,  223 => 64,  219 => 63,  216 => 62,  214 => 61,  211 => 60,  205 => 57,  201 => 56,  198 => 55,  195 => 54,  193 => 53,  190 => 52,  184 => 49,  180 => 48,  177 => 47,  175 => 46,  172 => 45,  166 => 42,  162 => 41,  159 => 40,  157 => 39,  154 => 38,  148 => 35,  145 => 34,  142 => 33,  130 => 30,  126 => 29,  123 => 28,  121 => 27,  110 => 25,  106 => 24,  102 => 23,  99 => 22,  97 => 21,  88 => 19,  85 => 18,  83 => 17,  78 => 15,  73 => 13,  70 => 12,  64 => 9,  59 => 7,  56 => 6,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_main.html", "");
    }
}
