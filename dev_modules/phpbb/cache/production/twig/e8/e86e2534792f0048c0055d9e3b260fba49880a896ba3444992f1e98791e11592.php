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

/* memberlist_email.html */
class __TwigTemplate_07bf5ef477cac4081a722ed7d02cb6a82b6f58316ec6a06b1b3a9c62894c5ef0 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "memberlist_email.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
";
        // line 3
        // line 4
        echo "
";
        // line 5
        if (($context["S_CONTACT_ADMIN"] ?? null)) {
            // line 6
            echo "<h2 class=\"titlespace\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("CONTACT_ADMIN");
            echo "</h2>
";
        } elseif (        // line 7
($context["S_SEND_USER"] ?? null)) {
            // line 8
            echo "<h2 class=\"titlespace\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("SEND_EMAIL_USER");
            echo "</h2>
";
        } else {
            // line 10
            echo "<h2 class=\"titlespace\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("EMAIL_TOPIC");
            echo "</h2>
";
        }
        // line 12
        echo "
<form method=\"post\" action=\"";
        // line 13
        echo ($context["S_POST_ACTION"] ?? null);
        echo "\" id=\"post\">

\t";
        // line 15
        if (($context["CONTACT_INFO"] ?? null)) {
            // line 16
            echo "\t<div class=\"panel\">
\t\t<div class=\"inner\">
\t\t\t<div class=\"postbody\">
\t\t\t\t<div class=\"content\">
\t\t\t\t\t";
            // line 20
            echo ($context["CONTACT_INFO"] ?? null);
            echo "
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t\t<br class=\"clear\" />
\t";
        }
        // line 27
        echo "
\t<div class=\"panel\">
\t\t<div class=\"inner\">
\t<div class=\"content\">

\t\t";
        // line 32
        if (($context["ERROR_MESSAGE"] ?? null)) {
            echo "<p class=\"error\">";
            echo ($context["ERROR_MESSAGE"] ?? null);
            echo "</p>";
        }
        // line 33
        echo "\t\t<fieldset class=\"fields2\">
\t\t";
        // line 34
        if (($context["S_SEND_USER"] ?? null)) {
            // line 35
            echo "\t\t\t<dl>
\t\t\t\t<dt><label>";
            // line 36
            echo $this->extensions['phpbb\template\twig\extension']->lang("RECIPIENT");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t\t<dd><strong>";
            // line 37
            echo ($context["USERNAME_FULL"] ?? null);
            echo "</strong></dd>
\t\t\t</dl>
\t\t\t<dl>
\t\t\t\t<dt><label for=\"subject\">";
            // line 40
            echo $this->extensions['phpbb\template\twig\extension']->lang("SUBJECT");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t\t<dd><input class=\"inputbox autowidth\" type=\"text\" name=\"subject\" id=\"subject\" size=\"50\" tabindex=\"1\" value=\"";
            // line 41
            echo ($context["SUBJECT"] ?? null);
            echo "\" /></dd>
\t\t\t</dl>
\t\t";
        } elseif (        // line 43
($context["S_CONTACT_ADMIN"] ?? null)) {
            // line 44
            echo "\t\t\t<dl>
\t\t\t\t<dt><label>";
            // line 45
            echo $this->extensions['phpbb\template\twig\extension']->lang("RECIPIENT");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t\t<dd><strong>";
            // line 46
            echo $this->extensions['phpbb\template\twig\extension']->lang("ADMINISTRATOR");
            echo "</strong></dd>
\t\t\t</dl>
\t\t\t";
            // line 48
            if ( !($context["S_IS_REGISTERED"] ?? null)) {
                // line 49
                echo "\t\t\t<dl>
\t\t\t\t<dt><label for=\"email\">";
                // line 50
                echo $this->extensions['phpbb\template\twig\extension']->lang("SENDER_EMAIL_ADDRESS");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t\t\t<dd><input class=\"inputbox autowidth\" type=\"text\" name=\"email\" id=\"email\" size=\"50\" maxlength=\"100\" tabindex=\"1\" value=\"";
                // line 51
                echo ($context["EMAIL"] ?? null);
                echo "\" /></dd>
\t\t\t</dl>
\t\t\t<dl>
\t\t\t\t<dt><label for=\"name\">";
                // line 54
                echo $this->extensions['phpbb\template\twig\extension']->lang("SENDER_NAME");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t\t\t<dd><input class=\"inputbox autowidth\" type=\"text\" name=\"name\" id=\"name\" size=\"50\" tabindex=\"2\" value=\"";
                // line 55
                echo ($context["NAME"] ?? null);
                echo "\" /></dd>
\t\t\t</dl>
\t\t\t";
            }
            // line 58
            echo "\t\t\t<dl>
\t\t\t\t<dt><label for=\"subject\">";
            // line 59
            echo $this->extensions['phpbb\template\twig\extension']->lang("SUBJECT");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t\t<dd><input class=\"inputbox autowidth\" type=\"text\" name=\"subject\" id=\"subject\" size=\"50\" tabindex=\"3\" value=\"";
            // line 60
            echo ($context["SUBJECT"] ?? null);
            echo "\" /></dd>
\t\t\t</dl>
\t\t";
        } else {
            // line 63
            echo "\t\t\t<dl>
\t\t\t\t<dt><label for=\"email\">";
            // line 64
            echo $this->extensions['phpbb\template\twig\extension']->lang("EMAIL_ADDRESS");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t\t<dd><input class=\"inputbox autowidth\" type=\"email\" name=\"email\" id=\"email\" size=\"50\" maxlength=\"100\" tabindex=\"2\" value=\"";
            // line 65
            echo ($context["EMAIL"] ?? null);
            echo "\" /></dd>
\t\t\t</dl>
\t\t\t<dl>
\t\t\t\t<dt><label for=\"name\">";
            // line 68
            echo $this->extensions['phpbb\template\twig\extension']->lang("REAL_NAME");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label></dt>
\t\t\t\t<dd><input class=\"inputbox autowidth\" type=\"text\" name=\"name\" id=\"name\" size=\"50\" tabindex=\"3\" value=\"";
            // line 69
            echo ($context["NAME"] ?? null);
            echo "\" /></dd>
\t\t\t</dl>
\t\t\t<dl>
\t\t\t\t<dt><label for=\"lang\">";
            // line 72
            echo $this->extensions['phpbb\template\twig\extension']->lang("DEST_LANG");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br />
\t\t\t\t\t<span>";
            // line 73
            echo $this->extensions['phpbb\template\twig\extension']->lang("DEST_LANG_EXPLAIN");
            echo "</span></dt>
\t\t\t\t<dd><select name=\"lang\" id=\"lang\">";
            // line 74
            echo ($context["S_LANG_OPTIONS"] ?? null);
            echo "</select></dd>
\t\t\t</dl>
\t\t";
        }
        // line 77
        echo "\t\t<dl>
\t\t\t<dt><label for=\"message\">";
        // line 78
        echo $this->extensions['phpbb\template\twig\extension']->lang("MESSAGE_BODY");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br />
\t\t\t<span>";
        // line 79
        echo $this->extensions['phpbb\template\twig\extension']->lang("EMAIL_BODY_EXPLAIN");
        echo "</span></dt>
\t\t\t<dd><textarea class=\"inputbox\" name=\"message\" id=\"message\" rows=\"15\" cols=\"76\" tabindex=\"4\">";
        // line 80
        echo ($context["MESSAGE"] ?? null);
        echo "</textarea></dd>
\t\t</dl>
\t\t";
        // line 82
        if (($context["S_REGISTERED_USER"] ?? null)) {
            // line 83
            echo "\t\t<dl>
\t\t\t<dt>&nbsp;</dt>
\t\t\t<dd><label for=\"cc_sender\"><input type=\"checkbox\" name=\"cc_sender\" id=\"cc_sender\" value=\"1\" checked=\"checked\" tabindex=\"5\" /> ";
            // line 85
            echo $this->extensions['phpbb\template\twig\extension']->lang("CC_SENDER");
            echo "</label></dd>
\t\t</dl>
\t\t";
        }
        // line 88
        echo "\t\t</fieldset>
\t</div>

\t</div>
</div>

<div class=\"panel\">
\t<div class=\"inner\">
\t<div class=\"content\">
\t\t<fieldset class=\"submit-buttons\">
\t\t\t<input type=\"submit\" tabindex=\"6\" name=\"submit\" class=\"button1\" value=\"";
        // line 98
        echo $this->extensions['phpbb\template\twig\extension']->lang("SEND_EMAIL");
        echo "\" />
\t\t</fieldset>
\t</div>
\t</div>
";
        // line 102
        echo ($context["S_FORM_TOKEN"] ?? null);
        echo "
</div>

</form>

";
        // line 107
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "memberlist_email.html", 107)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "memberlist_email.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  297 => 107,  289 => 102,  282 => 98,  270 => 88,  264 => 85,  260 => 83,  258 => 82,  253 => 80,  249 => 79,  244 => 78,  241 => 77,  235 => 74,  231 => 73,  226 => 72,  220 => 69,  215 => 68,  209 => 65,  204 => 64,  201 => 63,  195 => 60,  190 => 59,  187 => 58,  181 => 55,  176 => 54,  170 => 51,  165 => 50,  162 => 49,  160 => 48,  155 => 46,  150 => 45,  147 => 44,  145 => 43,  140 => 41,  135 => 40,  129 => 37,  124 => 36,  121 => 35,  119 => 34,  116 => 33,  110 => 32,  103 => 27,  93 => 20,  87 => 16,  85 => 15,  80 => 13,  77 => 12,  71 => 10,  65 => 8,  63 => 7,  58 => 6,  56 => 5,  53 => 4,  52 => 3,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "memberlist_email.html", "");
    }
}
