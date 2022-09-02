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

/* ucp_pm_viewfolder.html */
class __TwigTemplate_65c7d4df299a0c79b31926f983cc745e7db05d69660158a6d45c83992a9f10e1 extends \Twig\Template
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
        $location = "ucp_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("ucp_header.html", "ucp_pm_viewfolder.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
";
        // line 3
        if ( !($context["PROMPT"] ?? null)) {
            // line 4
            echo "\t";
            $location = "ucp_pm_message_header.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("ucp_pm_message_header.html", "ucp_pm_viewfolder.html", 4)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 6
        echo "
";
        // line 7
        if (($context["PROMPT"] ?? null)) {
            // line 8
            echo "\t<h2>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("EXPORT_AS_CSV");
            echo "</h2>
\t<form id=\"viewfolder\" method=\"post\" action=\"";
            // line 9
            echo ($context["S_PM_ACTION"] ?? null);
            echo "\">
\t<div class=\"panel\">
\t\t<div class=\"inner\">
\t\t<h3>";
            // line 12
            echo $this->extensions['phpbb\template\twig\extension']->lang("OPTIONS");
            echo "</h3>
\t\t<fieldset>
\t\t\t<dl>
\t\t\t\t<dt><label for=\"delimiter\">";
            // line 15
            echo $this->extensions['phpbb\template\twig\extension']->lang("DELIMITER");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t\t<dd><input class=\"inputbox\" type=\"text\" id=\"delimiter\" name=\"delimiter\" value=\",\" /></dd>
\t\t\t</dl>
\t\t\t<dl>
\t\t\t\t<dt><label for=\"enclosure\">";
            // line 19
            echo $this->extensions['phpbb\template\twig\extension']->lang("ENCLOSURE");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t\t<dd><input class=\"inputbox\" type=\"text\" id=\"enclosure\" name=\"enclosure\" value=\"&#034;\" /></dd>
\t\t\t</dl>
\t\t</fieldset>
\t\t</div>
\t</div>
\t<fieldset class=\"submit-buttons\">
\t\t<input type=\"hidden\" name=\"export_option\" value=\"CSV\" />
\t\t<input class=\"button1\" type=\"submit\" name=\"submit_export\" value=\"";
            // line 27
            echo $this->extensions['phpbb\template\twig\extension']->lang("EXPORT_FOLDER");
            echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"reset\" value=\"";
            // line 28
            echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
            echo "\" name=\"reset\" />&nbsp;
\t\t";
            // line 29
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t</form>

";
        } else {
            // line 34
            echo "
\t";
            // line 35
            if (($context["NUM_REMOVED"] ?? null)) {
                // line 36
                echo "\t\t<div class=\"notice\">
\t\t\t<p>";
                // line 37
                echo ($context["RULE_REMOVED_MESSAGES"] ?? null);
                echo "</p>
\t\t</div>
\t";
            }
            // line 40
            echo "
\t";
            // line 41
            if (($context["NUM_NOT_MOVED"] ?? null)) {
                // line 42
                echo "\t\t<div class=\"notice\">
\t\t\t<p>";
                // line 43
                echo ($context["NOT_MOVED_MESSAGES"] ?? null);
                echo "<br />";
                echo ($context["RELEASE_MESSAGE_INFO"] ?? null);
                echo "</p>
\t\t</div>
\t";
            }
            // line 46
            echo "
\t";
            // line 47
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "messagerow", [], "any", false, false, false, 47))) {
                // line 48
                echo "\t\t<ul class=\"topiclist two-columns\">
\t\t\t<li class=\"header\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><div class=\"list-inner\">";
                // line 51
                echo $this->extensions['phpbb\template\twig\extension']->lang("MESSAGE");
                echo "</div></dt>
\t\t\t\t\t<dd class=\"mark\">";
                // line 52
                echo $this->extensions['phpbb\template\twig\extension']->lang("MARK");
                echo "</dd>
\t\t\t\t</dl>
\t\t\t</li>
\t\t</ul>
\t\t<ul class=\"topiclist cplist pmlist responsive-show-all ";
                // line 56
                if (($context["S_SHOW_RECIPIENTS"] ?? null)) {
                    echo "missing-column";
                } else {
                    echo "two-columns";
                }
                echo "\">

\t\t";
                // line 58
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "messagerow", [], "any", false, false, false, 58));
                foreach ($context['_seq'] as $context["_key"] => $context["messagerow"]) {
                    // line 59
                    echo "\t\t\t<li class=\"row";
                    if ((twig_get_attribute($this->env, $this->source, $context["messagerow"], "S_ROW_COUNT", [], "any", false, false, false, 59) % 2 != 0)) {
                        echo " bg1";
                    } else {
                        echo " bg2";
                    }
                    if (twig_get_attribute($this->env, $this->source, $context["messagerow"], "PM_CLASS", [], "any", false, false, false, 59)) {
                        echo " ";
                        echo twig_get_attribute($this->env, $this->source, $context["messagerow"], "PM_CLASS", [], "any", false, false, false, 59);
                    }
                    echo "\">
\t\t\t\t<dl class=\"row-item ";
                    // line 60
                    echo twig_get_attribute($this->env, $this->source, $context["messagerow"], "FOLDER_IMG_STYLE", [], "any", false, false, false, 60);
                    echo "\">
\t\t\t\t\t<dt";
                    // line 61
                    if ((twig_get_attribute($this->env, $this->source, $context["messagerow"], "PM_ICON_URL", [], "any", false, false, false, 61) && ($context["S_PM_ICONS"] ?? null))) {
                        echo " style=\"background-image: url(";
                        echo twig_get_attribute($this->env, $this->source, $context["messagerow"], "PM_ICON_URL", [], "any", false, false, false, 61);
                        echo "); background-repeat: no-repeat;\"";
                    }
                    echo ">
\t\t\t\t\t\t";
                    // line 62
                    if ((twig_get_attribute($this->env, $this->source, $context["messagerow"], "S_PM_UNREAD", [], "any", false, false, false, 62) &&  !twig_get_attribute($this->env, $this->source, $context["messagerow"], "S_PM_DELETED", [], "any", false, false, false, 62))) {
                        echo "<a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["messagerow"], "U_VIEW_PM", [], "any", false, false, false, 62);
                        echo "\" class=\"row-item-link\"></a>";
                    }
                    // line 63
                    echo "\t\t\t\t\t\t<div class=\"list-inner\">

\t\t\t\t\t\t";
                    // line 65
                    if (twig_get_attribute($this->env, $this->source, $context["messagerow"], "S_PM_DELETED", [], "any", false, false, false, 65)) {
                        // line 66
                        echo "\t\t\t\t\t\t\t<a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["messagerow"], "U_REMOVE_PM", [], "any", false, false, false, 66);
                        echo "\" class=\"topictitle\">";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE_MESSAGE");
                        echo "</a><br />
\t\t\t\t\t\t\t<span class=\"error\">";
                        // line 67
                        echo $this->extensions['phpbb\template\twig\extension']->lang("MESSAGE_REMOVED_FROM_OUTBOX");
                        echo "</span>
\t\t\t\t\t\t";
                    } else {
                        // line 69
                        echo "\t\t\t\t\t\t\t<a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["messagerow"], "U_VIEW_PM", [], "any", false, false, false, 69);
                        echo "\" class=\"topictitle\">";
                        echo twig_get_attribute($this->env, $this->source, $context["messagerow"], "SUBJECT", [], "any", false, false, false, 69);
                        echo "</a>
\t\t\t\t\t\t";
                    }
                    // line 71
                    echo "\t\t\t\t\t\t";
                    if (twig_get_attribute($this->env, $this->source, $context["messagerow"], "S_AUTHOR_DELETED", [], "any", false, false, false, 71)) {
                        // line 72
                        echo "\t\t\t\t\t\t\t<br /><em class=\"small\">";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("PM_FROM_REMOVED_AUTHOR");
                        echo "</em>
\t\t\t\t\t\t";
                    }
                    // line 74
                    echo "\t\t\t\t\t\t";
                    if (twig_get_attribute($this->env, $this->source, $context["messagerow"], "S_PM_REPORTED", [], "any", false, false, false, 74)) {
                        // line 75
                        echo "\t\t\t\t\t\t\t<a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["messagerow"], "U_MCP_REPORT", [], "any", false, false, false, 75);
                        echo "\">
\t\t\t\t\t\t\t\t<i class=\"icon fa-exclamation fa-fw icon-red\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                        // line 76
                        echo ($context["PM_REPORTED"] ?? null);
                        echo "</span>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t";
                    }
                    // line 78
                    echo " ";
                    if (twig_get_attribute($this->env, $this->source, $context["messagerow"], "ATTACH_ICON_IMG", [], "any", false, false, false, 78)) {
                        echo "<i class=\"icon fa-paperclip fa-fw\" aria-hidden=\"true\"></i> ";
                    }
                    echo "<br />
\t\t\t\t\t\t";
                    // line 79
                    if (($context["S_SHOW_RECIPIENTS"] ?? null)) {
                        echo $this->extensions['phpbb\template\twig\extension']->lang("MESSAGE_TO");
                        echo " ";
                        echo twig_get_attribute($this->env, $this->source, $context["messagerow"], "RECIPIENTS", [], "any", false, false, false, 79);
                    } else {
                        echo $this->extensions['phpbb\template\twig\extension']->lang("MESSAGE_BY_AUTHOR");
                        echo " ";
                        echo twig_get_attribute($this->env, $this->source, $context["messagerow"], "MESSAGE_AUTHOR_FULL", [], "any", false, false, false, 79);
                        echo " &raquo; ";
                        echo twig_get_attribute($this->env, $this->source, $context["messagerow"], "SENT_TIME", [], "any", false, false, false, 79);
                    }
                    // line 80
                    echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t</dt>
\t\t\t\t\t";
                    // line 83
                    if (($context["S_SHOW_RECIPIENTS"] ?? null)) {
                        echo "<dd class=\"info\"><span>";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("SENT_AT");
                        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                        echo " ";
                        echo twig_get_attribute($this->env, $this->source, $context["messagerow"], "SENT_TIME", [], "any", false, false, false, 83);
                        echo "</span></dd>";
                    }
                    // line 84
                    echo "\t\t\t\t\t";
                    if (($context["S_UNREAD"] ?? null)) {
                        echo "<dd class=\"info\">";
                        if (twig_get_attribute($this->env, $this->source, $context["messagerow"], "FOLDER", [], "any", false, false, false, 84)) {
                            echo "<a href=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["messagerow"], "U_FOLDER", [], "any", false, false, false, 84);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["messagerow"], "FOLDER", [], "any", false, false, false, 84);
                            echo "</a>";
                        } else {
                            echo $this->extensions['phpbb\template\twig\extension']->lang("UNKNOWN_FOLDER");
                        }
                        echo "</dd>";
                    }
                    // line 85
                    echo "\t\t\t\t\t<dd class=\"mark\"><input type=\"checkbox\" name=\"marked_msg_id[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["messagerow"], "MESSAGE_ID", [], "any", false, false, false, 85);
                    echo "\" /></dd>
\t\t\t\t</dl>
\t\t\t</li>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['messagerow'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 89
                echo "
\t\t</ul>
\t";
            } else {
                // line 92
                echo "\t\t<p><strong>
\t\t\t";
                // line 93
                if ((($context["S_COMPOSE_PM_VIEW"] ?? null) && ($context["S_NO_AUTH_SEND_MESSAGE"] ?? null))) {
                    // line 94
                    echo "\t\t\t\t";
                    if (($context["S_USER_NEW"] ?? null)) {
                        echo $this->extensions['phpbb\template\twig\extension']->lang("USER_NEW_PERMISSION_DISALLOWED");
                    } else {
                        echo $this->extensions['phpbb\template\twig\extension']->lang("NO_AUTH_SEND_MESSAGE");
                    }
                    // line 95
                    echo "\t\t\t";
                } else {
                    // line 96
                    echo "\t\t\t\t";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("NO_MESSAGES");
                    echo "
\t\t\t";
                }
                // line 98
                echo "\t\t</strong></p>
\t";
            }
            // line 100
            echo "
\t";
            // line 101
            if ((($context["FOLDER_CUR_MESSAGES"] ?? null) != 0)) {
                // line 102
                echo "\t\t<fieldset class=\"display-actions\">
\t\t\t<div class=\"left-box\"><label for=\"export_option\">";
                // line 103
                echo $this->extensions['phpbb\template\twig\extension']->lang("EXPORT_FOLDER");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo " <select name=\"export_option\" id=\"export_option\"><option value=\"CSV\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("EXPORT_AS_CSV");
                echo "</option><option value=\"CSV_EXCEL\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("EXPORT_AS_CSV_EXCEL");
                echo "</option><option value=\"XML\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("EXPORT_AS_XML");
                echo "</option></select></label> <input class=\"button2\" type=\"submit\" name=\"submit_export\" value=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("GO");
                echo "\" /><br /></div>
\t\t\t<select name=\"mark_option\">";
                // line 104
                echo ($context["S_MARK_OPTIONS"] ?? null);
                echo ($context["S_MOVE_MARKED_OPTIONS"] ?? null);
                echo "</select> <input class=\"button2\" type=\"submit\" name=\"submit_mark\" value=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("GO");
                echo "\" />
\t\t\t<div><a href=\"#\" onclick=\"marklist('viewfolder', 'marked_msg', true); return false;\">";
                // line 105
                echo $this->extensions['phpbb\template\twig\extension']->lang("MARK_ALL");
                echo "</a> &bull; <a href=\"#\" onclick=\"marklist('viewfolder', 'marked_msg', false); return false;\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("UNMARK_ALL");
                echo "</a></div>
\t\t</fieldset>

\t\t<hr />

\t\t<div class=\"action-bar bottom\">
\t\t\t";
                // line 111
                $location = "display_options.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->loadTemplate("display_options.html", "ucp_pm_viewfolder.html", 111)->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 112
                echo "\t\t\t<input type=\"hidden\" name=\"cur_folder_id\" value=\"";
                echo ($context["CUR_FOLDER_ID"] ?? null);
                echo "\" />

\t\t\t<div class=\"pagination\">
\t\t\t\t";
                // line 115
                echo ($context["TOTAL_MESSAGES"] ?? null);
                echo "
\t\t\t\t";
                // line 116
                if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pagination", [], "any", false, false, false, 116))) {
                    // line 117
                    echo "\t\t\t\t\t";
                    $location = "pagination.html";
                    $namespace = false;
                    if (strpos($location, '@') === 0) {
                        $namespace = substr($location, 1, strpos($location, '/') - 1);
                        $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                        $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                    }
                    $this->loadTemplate("pagination.html", "ucp_pm_viewfolder.html", 117)->display($context);
                    if ($namespace) {
                        $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                    }
                    // line 118
                    echo "\t\t\t\t";
                } else {
                    // line 119
                    echo "\t\t\t\t\t &bull; ";
                    echo ($context["PAGE_NUMBER"] ?? null);
                    echo "
\t\t\t\t";
                }
                // line 121
                echo "\t\t\t</div>
\t\t</div>
\t";
            }
            // line 124
            echo "
\t\t</div>
\t</div>

\t";
            // line 128
            $location = "ucp_pm_message_footer.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("ucp_pm_message_footer.html", "ucp_pm_viewfolder.html", 128)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 130
        $location = "ucp_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("ucp_footer.html", "ucp_pm_viewfolder.html", 130)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "ucp_pm_viewfolder.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  469 => 130,  456 => 128,  450 => 124,  445 => 121,  439 => 119,  436 => 118,  423 => 117,  421 => 116,  417 => 115,  410 => 112,  398 => 111,  387 => 105,  380 => 104,  367 => 103,  364 => 102,  362 => 101,  359 => 100,  355 => 98,  349 => 96,  346 => 95,  339 => 94,  337 => 93,  334 => 92,  329 => 89,  318 => 85,  303 => 84,  294 => 83,  289 => 80,  277 => 79,  270 => 78,  264 => 76,  259 => 75,  256 => 74,  250 => 72,  247 => 71,  239 => 69,  234 => 67,  227 => 66,  225 => 65,  221 => 63,  215 => 62,  207 => 61,  203 => 60,  190 => 59,  186 => 58,  177 => 56,  170 => 52,  166 => 51,  161 => 48,  159 => 47,  156 => 46,  148 => 43,  145 => 42,  143 => 41,  140 => 40,  134 => 37,  131 => 36,  129 => 35,  126 => 34,  118 => 29,  114 => 28,  110 => 27,  98 => 19,  90 => 15,  84 => 12,  78 => 9,  73 => 8,  71 => 7,  68 => 6,  54 => 4,  52 => 3,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "ucp_pm_viewfolder.html", "");
    }
}
