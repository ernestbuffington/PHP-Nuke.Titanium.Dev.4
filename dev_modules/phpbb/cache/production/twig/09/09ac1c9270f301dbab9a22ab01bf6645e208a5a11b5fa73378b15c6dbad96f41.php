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

/* acp_contact.html */
class __TwigTemplate_7b4078c1c9d1a73c7fd1226d5922c51b1b6fc30ebc147f50df861426a1e5dc5d extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_contact.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<script>
// <![CDATA[

\tvar form_name = 'acp_contact';
\tvar text_name = 'contact_admin_info';
\tvar load_draft = false;
\tvar upload = false;
\tvar imageTag = false;

// ]]>
</script>

<a id=\"maincontent\"></a>

<h1>";
        // line 17
        echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_CONTACT_SETTINGS");
        echo "</h1>

<p>";
        // line 19
        echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_CONTACT_SETTINGS_EXPLAIN");
        echo "</p>

<form id=\"acp_contact\" method=\"post\" action=\"";
        // line 21
        echo ($context["U_ACTION"] ?? null);
        echo "\">
\t<fieldset>
\t\t<legend>";
        // line 23
        echo $this->extensions['phpbb\template\twig\extension']->lang("GENERAL_OPTIONS");
        echo "</legend>
\t\t<dl>
\t\t\t<dt><label for=\"contact_admin_form_enable\">";
        // line 25
        echo $this->extensions['phpbb\template\twig\extension']->lang("CONTACT_US_ENABLE");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("CONTACT_US_ENABLE_EXPLAIN");
        echo "</span></dt>
\t\t\t<dd>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" id=\"contact_admin_form_enable\" name=\"contact_admin_form_enable\" value=\"1\"";
        // line 27
        if (($context["CONTACT_ENABLED"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->extensions['phpbb\template\twig\extension']->lang("ENABLED");
        echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"contact_admin_form_enable\" value=\"0\"";
        // line 28
        if ( !($context["CONTACT_ENABLED"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->extensions['phpbb\template\twig\extension']->lang("DISABLED");
        echo "</label>
\t\t\t</dd>
\t\t</dl>
\t</fieldset>

\t";
        // line 33
        if (($context["CONTACT_US_INFO_PREVIEW"] ?? null)) {
            // line 34
            echo "\t<fieldset>
\t\t<legend>";
            // line 35
            echo $this->extensions['phpbb\template\twig\extension']->lang("CONTACT_US_INFO_PREVIEW");
            echo "</legend>
\t\t<p>";
            // line 36
            echo ($context["CONTACT_US_INFO_PREVIEW"] ?? null);
            echo "</p>
\t</fieldset>
\t";
        }
        // line 39
        echo "
\t<fieldset>
\t\t<legend>";
        // line 41
        echo $this->extensions['phpbb\template\twig\extension']->lang("CONTACT_US_INFO");
        echo "</legend>
\t\t<p>";
        // line 42
        echo $this->extensions['phpbb\template\twig\extension']->lang("CONTACT_US_INFO_EXPLAIN");
        echo "</p>

\t\t";
        // line 44
        $location = "acp_posting_buttons.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("acp_posting_buttons.html", "acp_contact.html", 44)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 45
        echo "
\t\t<dl class=\"responsive-columns\">
\t\t\t<dt style=\"width: 90px;\" id=\"color_palette_placeholder\" data-color-palette=\"v\" data-height=\"12\" data-width=\"15\" data-bbcode=\"true\">
\t\t\t</dt>

\t\t\t<dd style=\"margin-";
        // line 50
        echo ($context["S_CONTENT_FLOW_BEGIN"] ?? null);
        echo ": 90px;\">
\t\t\t\t<textarea name=\"contact_admin_info\" rows=\"10\" cols=\"60\" style=\"width: 95%;\" onselect=\"storeCaret(this);\" onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\" onfocus=\"initInsertions();\" data-bbcode=\"true\">";
        // line 51
        echo ($context["CONTACT_US_INFO"] ?? null);
        echo "</textarea>
\t\t\t</dd>

\t\t\t<dd style=\"margin-";
        // line 54
        echo ($context["S_CONTENT_FLOW_BEGIN"] ?? null);
        echo ": 90px; margin-top: 5px;\">
\t\t\t\t";
        // line 55
        if (($context["S_BBCODE_ALLOWED"] ?? null)) {
            // line 56
            echo "\t\t\t\t<label><input type=\"checkbox\" class=\"radio\" name=\"disable_bbcode\"";
            if (($context["S_BBCODE_DISABLE_CHECKED"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("DISABLE_BBCODE");
            echo "</label>
\t\t\t\t";
        }
        // line 58
        echo "\t\t\t\t";
        if (($context["S_SMILIES_ALLOWED"] ?? null)) {
            // line 59
            echo "\t\t\t\t<label><input type=\"checkbox\" class=\"radio\" name=\"disable_smilies\"";
            if (($context["S_SMILIES_DISABLE_CHECKED"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("DISABLE_SMILIES");
            echo "</label>
\t\t\t\t";
        }
        // line 61
        echo "\t\t\t\t";
        if (($context["S_LINKS_ALLOWED"] ?? null)) {
            // line 62
            echo "\t\t\t\t<label><input type=\"checkbox\" class=\"radio\" name=\"disable_magic_url\"";
            if (($context["S_MAGIC_URL_DISABLE_CHECKED"] ?? null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("DISABLE_MAGIC_URL");
            echo "</label>
\t\t\t\t";
        }
        // line 64
        echo "\t\t\t</dd>
\t\t\t<dd style=\"margin-";
        // line 65
        echo ($context["S_CONTENT_FLOW_BEGIN"] ?? null);
        echo ": 90px; margin-top: 10px;\"><strong>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("OPTIONS");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo " </strong>";
        echo ($context["BBCODE_STATUS"] ?? null);
        echo " :: ";
        echo ($context["IMG_STATUS"] ?? null);
        echo " :: ";
        echo ($context["FLASH_STATUS"] ?? null);
        echo " :: ";
        echo ($context["URL_STATUS"] ?? null);
        echo " :: ";
        echo ($context["SMILIES_STATUS"] ?? null);
        echo "</dd>
\t\t</dl>
\t</fieldset>

\t<fieldset>
\t\t<legend>";
        // line 70
        echo $this->extensions['phpbb\template\twig\extension']->lang("ACP_SUBMIT_CHANGES");
        echo "</legend>
\t\t<p class=\"submit-buttons\">
\t\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
        // line 72
        echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
        echo "\" />&nbsp;
\t\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
        // line 73
        echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
        echo "\" />
\t\t</p>
\t\t";
        // line 75
        echo ($context["S_FORM_TOKEN"] ?? null);
        echo "
\t</fieldset>
</form>

";
        // line 79
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_contact.html", 79)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_contact.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  258 => 79,  251 => 75,  246 => 73,  242 => 72,  237 => 70,  216 => 65,  213 => 64,  203 => 62,  200 => 61,  190 => 59,  187 => 58,  177 => 56,  175 => 55,  171 => 54,  165 => 51,  161 => 50,  154 => 45,  142 => 44,  137 => 42,  133 => 41,  129 => 39,  123 => 36,  119 => 35,  116 => 34,  114 => 33,  102 => 28,  94 => 27,  86 => 25,  81 => 23,  76 => 21,  71 => 19,  66 => 17,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_contact.html", "");
    }
}
