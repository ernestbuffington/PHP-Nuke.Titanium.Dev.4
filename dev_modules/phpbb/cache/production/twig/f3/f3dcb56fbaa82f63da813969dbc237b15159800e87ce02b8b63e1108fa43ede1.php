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

/* login_body.html */
class __TwigTemplate_f207591886d378be73a4ad8374ee992ec4a990c2a7bf00adfc31e1971daeae57 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "login_body.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<form action=\"";
        // line 3
        echo ($context["S_LOGIN_ACTION"] ?? null);
        echo "\" method=\"post\" id=\"login\" data-focus=\"";
        if (($context["S_ADMIN_AUTH"] ?? null)) {
            echo ($context["PASSWORD_CREDENTIAL"] ?? null);
        } else {
            echo ($context["USERNAME_CREDENTIAL"] ?? null);
        }
        echo "\">
<div class=\"panel\">
\t<div class=\"inner\">

\t<div class=\"content\">
\t\t<h2 class=\"login-title\">";
        // line 8
        if (($context["LOGIN_EXPLAIN"] ?? null)) {
            echo ($context["LOGIN_EXPLAIN"] ?? null);
        } else {
            echo $this->extensions['phpbb\template\twig\extension']->lang("LOGIN");
        }
        echo "</h2>

\t\t<fieldset ";
        // line 10
        if ( !($context["S_CONFIRM_CODE"] ?? null)) {
            echo "class=\"fields1\"";
        } else {
            echo "class=\"fields2\"";
        }
        echo ">
\t\t";
        // line 11
        if (($context["LOGIN_ERROR"] ?? null)) {
            echo "<div class=\"error\">";
            echo ($context["LOGIN_ERROR"] ?? null);
            echo "</div>";
        }
        // line 12
        echo "\t\t<dl>
\t\t\t<dt><label for=\"";
        // line 13
        echo ($context["USERNAME_CREDENTIAL"] ?? null);
        echo "\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("USERNAME");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label></dt>
\t\t\t<dd><input type=\"text\" tabindex=\"1\" name=\"";
        // line 14
        echo ($context["USERNAME_CREDENTIAL"] ?? null);
        echo "\" id=\"";
        echo ($context["USERNAME_CREDENTIAL"] ?? null);
        echo "\" size=\"25\" value=\"";
        echo ($context["USERNAME"] ?? null);
        echo "\" class=\"inputbox autowidth\" /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"";
        // line 17
        echo ($context["PASSWORD_CREDENTIAL"] ?? null);
        echo "\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("PASSWORD");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label></dt>
\t\t\t<dd><input type=\"password\" tabindex=\"2\" id=\"";
        // line 18
        echo ($context["PASSWORD_CREDENTIAL"] ?? null);
        echo "\" name=\"";
        echo ($context["PASSWORD_CREDENTIAL"] ?? null);
        echo "\" size=\"25\" class=\"inputbox autowidth\" autocomplete=\"off\" /></dd>
\t\t\t";
        // line 19
        if ((($context["S_DISPLAY_FULL_LOGIN"] ?? null) && (($context["U_SEND_PASSWORD"] ?? null) || ($context["U_RESEND_ACTIVATION"] ?? null)))) {
            // line 20
            echo "\t\t\t\t";
            if (($context["U_SEND_PASSWORD"] ?? null)) {
                echo "<dd><a href=\"";
                echo ($context["U_SEND_PASSWORD"] ?? null);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("FORGOT_PASS");
                echo "</a></dd>";
            }
            // line 21
            echo "\t\t\t\t";
            if (($context["U_RESEND_ACTIVATION"] ?? null)) {
                echo "<dd><a href=\"";
                echo ($context["U_RESEND_ACTIVATION"] ?? null);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("RESEND_ACTIVATION");
                echo "</a></dd>";
            }
            // line 22
            echo "\t\t\t";
        }
        // line 23
        echo "\t\t</dl>
\t\t";
        // line 24
        if ((($context["CAPTCHA_TEMPLATE"] ?? null) && ($context["S_CONFIRM_CODE"] ?? null))) {
            // line 25
            echo "\t\t\t";
            $value = 3;
            $context['definition']->set('CAPTCHA_TAB_INDEX', $value);
            // line 26
            echo "\t\t\t";
            $location = (("" . ($context["CAPTCHA_TEMPLATE"] ?? null)) . "");
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate((("" . ($context["CAPTCHA_TEMPLATE"] ?? null)) . ""), "login_body.html", 26)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 27
            echo "\t\t";
        }
        // line 28
        echo "\t\t";
        if (($context["S_DISPLAY_FULL_LOGIN"] ?? null)) {
            // line 29
            echo "\t\t<dl>
\t\t\t<dt>&nbsp;</dt>
\t\t\t";
            // line 31
            if (($context["S_AUTOLOGIN_ENABLED"] ?? null)) {
                echo "<dd><label for=\"autologin\"><input type=\"checkbox\" name=\"autologin\" id=\"autologin\" tabindex=\"4\" /> ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("LOG_ME_IN");
                echo "</label></dd>";
            }
            // line 32
            echo "\t\t\t<dd><label for=\"viewonline\"><input type=\"checkbox\" name=\"viewonline\" id=\"viewonline\" tabindex=\"5\" /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("HIDE_ME");
            echo "</label></dd>
\t\t</dl>
\t\t";
        }
        // line 35
        echo "
\t\t";
        // line 36
        echo ($context["S_LOGIN_REDIRECT"] ?? null);
        echo "
\t\t";
        // line 37
        echo ($context["S_FORM_TOKEN_LOGIN"] ?? null);
        echo "
\t\t<dl>
\t\t\t<dt>&nbsp;</dt>
\t\t\t<dd>";
        // line 40
        echo ($context["S_HIDDEN_FIELDS"] ?? null);
        echo "<input type=\"submit\" name=\"login\" tabindex=\"6\" value=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("LOGIN");
        echo "\" class=\"button1\" /></dd>
\t\t</dl>
\t\t</fieldset>
\t</div>

\t";
        // line 45
        if (( !($context["S_ADMIN_AUTH"] ?? null) && ($context["PROVIDER_TEMPLATE_FILE"] ?? null))) {
            // line 46
            echo "\t\t";
            $location = (("" . ($context["PROVIDER_TEMPLATE_FILE"] ?? null)) . "");
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate((("" . ($context["PROVIDER_TEMPLATE_FILE"] ?? null)) . ""), "login_body.html", 46)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 47
            echo "\t";
        }
        // line 48
        echo "\t</div>
</div>


";
        // line 52
        if (( !($context["S_ADMIN_AUTH"] ?? null) && ($context["S_REGISTER_ENABLED"] ?? null))) {
            // line 53
            echo "\t<div class=\"panel\">
\t\t<div class=\"inner\">

\t\t<div class=\"content\">
\t\t\t<h3>";
            // line 57
            echo $this->extensions['phpbb\template\twig\extension']->lang("REGISTER");
            echo "</h3>
\t\t\t<p>";
            // line 58
            echo $this->extensions['phpbb\template\twig\extension']->lang("LOGIN_INFO");
            echo "</p>
\t\t\t<p><strong><a href=\"";
            // line 59
            echo ($context["U_TERMS_USE"] ?? null);
            echo "\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("TERMS_USE");
            echo "</a> | <a href=\"";
            echo ($context["U_PRIVACY"] ?? null);
            echo "\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("PRIVACY");
            echo "</a></strong></p>
\t\t\t<hr class=\"dashed\" />
\t\t\t<p><a href=\"";
            // line 61
            echo ($context["U_REGISTER"] ?? null);
            echo "\" class=\"button2\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("REGISTER");
            echo "</a></p>
\t\t</div>

\t\t</div>
\t</div>
";
        }
        // line 67
        echo "
</form>

";
        // line 70
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "login_body.html", 70)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "login_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  280 => 70,  275 => 67,  264 => 61,  253 => 59,  249 => 58,  245 => 57,  239 => 53,  237 => 52,  231 => 48,  228 => 47,  215 => 46,  213 => 45,  203 => 40,  197 => 37,  193 => 36,  190 => 35,  183 => 32,  177 => 31,  173 => 29,  170 => 28,  167 => 27,  154 => 26,  150 => 25,  148 => 24,  145 => 23,  142 => 22,  133 => 21,  124 => 20,  122 => 19,  116 => 18,  109 => 17,  99 => 14,  92 => 13,  89 => 12,  83 => 11,  75 => 10,  66 => 8,  52 => 3,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "login_body.html", "");
    }
}
