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

/* posting_layout.html */
class __TwigTemplate_5220938f40a30ca482dcb455ea107f390fe35548dd459e994cf7e763bbb8e5b6 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "posting_layout.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
";
        // line 3
        if (($context["TOPIC_TITLE"] ?? null)) {
            // line 4
            echo "\t<h2 class=\"posting-title\">";
            echo "<a href=\"";
            echo ($context["U_VIEW_TOPIC"] ?? null);
            echo "\">";
            echo ($context["TOPIC_TITLE"] ?? null);
            echo "</a>";
            echo "</h2>
";
        } else {
            // line 6
            echo "\t<h2 class=\"posting-title\"><a href=\"";
            echo ($context["U_VIEW_FORUM"] ?? null);
            echo "\">";
            echo ($context["FORUM_NAME"] ?? null);
            echo "</a></h2>
 ";
        }
        // line 8
        echo "
";
        // line 9
        if (($context["S_FORUM_RULES"] ?? null)) {
            // line 10
            echo "\t<div class=\"rules";
            if (($context["U_FORUM_RULES"] ?? null)) {
                echo " rules-link";
            }
            echo "\">
\t\t<div class=\"inner\">

\t\t";
            // line 13
            if (($context["U_FORUM_RULES"] ?? null)) {
                // line 14
                echo "\t\t\t<a href=\"";
                echo ($context["U_FORUM_RULES"] ?? null);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_RULES");
                echo "</a>
\t\t";
            } else {
                // line 16
                echo "\t\t\t<strong>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_RULES");
                echo "</strong><br />
\t\t\t";
                // line 17
                echo ($context["FORUM_RULES"] ?? null);
                echo "
\t\t";
            }
            // line 19
            echo "
\t\t</div>
\t</div>
";
        }
        // line 23
        echo "
<form id=\"postform\" method=\"post\" action=\"";
        // line 24
        echo ($context["S_POST_ACTION"] ?? null);
        echo "\"";
        echo ($context["S_FORM_ENCTYPE"] ?? null);
        echo ">

";
        // line 26
        if (($context["S_DRAFT_LOADED"] ?? null)) {
            // line 27
            echo "\t<div class=\"panel\">
\t\t<div class=\"inner\">

\t\t<h3>";
            // line 30
            echo $this->extensions['phpbb\template\twig\extension']->lang("INFORMATION");
            echo "</h3>
\t\t<p>";
            // line 31
            echo $this->extensions['phpbb\template\twig\extension']->lang("DRAFT_LOADED");
            echo "</p>

\t\t</div>
\t</div>
";
        }
        // line 36
        echo "
";
        // line 37
        if (($context["S_SHOW_DRAFTS"] ?? null)) {
            $location = "drafts.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("drafts.html", "posting_layout.html", 37)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 38
        echo "
";
        // line 39
        if (($context["S_POST_REVIEW"] ?? null)) {
            $location = "posting_review.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("posting_review.html", "posting_layout.html", 39)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 40
        echo "
";
        // line 41
        if (($context["S_DISPLAY_PREVIEW"] ?? null)) {
            $location = "posting_preview.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("posting_preview.html", "posting_layout.html", 41)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 42
        echo "
<div class=\"panel\" id=\"postingbox\">
\t<div class=\"inner\">

\t<h3>";
        // line 46
        echo $this->extensions['phpbb\template\twig\extension']->lang("POST_A");
        echo "</h3>

\t";
        // line 48
        $value = 1;
        $context['definition']->set('EXTRA_POSTING_OPTIONS', $value);
        // line 49
        echo "\t";
        $location = "posting_editor.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("posting_editor.html", "posting_layout.html", 49)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 50
        echo "\t<input type=\"hidden\" name=\"show_panel\" value=\"options-panel\" />
\t";
        // line 51
        echo ($context["S_FORM_TOKEN"] ?? null);
        echo "
\t</div>
</div>

";
        // line 55
        if ((($context["S_SHOW_ATTACH_BOX"] ?? null) && ($context["FILTERS"] ?? null))) {
            $location = "posting_attach_body.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("posting_attach_body.html", "posting_layout.html", 55)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 56
        echo "
";
        // line 57
        if ((($context["S_SHOW_POLL_BOX"] ?? null) || ($context["S_POLL_DELETE"] ?? null))) {
            $location = "posting_poll_body.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("posting_poll_body.html", "posting_layout.html", 57)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 58
        echo "
";
        // line 59
        // line 60
        echo "
";
        // line 61
        if (($context["S_DISPLAY_REVIEW"] ?? null)) {
            $location = "posting_topic_review.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("posting_topic_review.html", "posting_layout.html", 61)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 62
        echo "
</form>

";
        // line 65
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "posting_layout.html", 65)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "posting_layout.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  286 => 65,  281 => 62,  267 => 61,  264 => 60,  263 => 59,  260 => 58,  246 => 57,  243 => 56,  229 => 55,  222 => 51,  219 => 50,  206 => 49,  203 => 48,  198 => 46,  192 => 42,  178 => 41,  175 => 40,  161 => 39,  158 => 38,  144 => 37,  141 => 36,  133 => 31,  129 => 30,  124 => 27,  122 => 26,  115 => 24,  112 => 23,  106 => 19,  101 => 17,  96 => 16,  88 => 14,  86 => 13,  77 => 10,  75 => 9,  72 => 8,  64 => 6,  54 => 4,  52 => 3,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "posting_layout.html", "");
    }
}
