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

/* display_options.html */
class __TwigTemplate_24e77387baf71bef1fb25b6c5443ef1e33ee931424657e67b0dcf95e1889b8c9 extends \Twig\Template
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
        echo "<div class=\"dropdown-container dropdown-container-left dropdown-button-control sort-tools\">
\t<span title=\"";
        // line 2
        echo $this->extensions['phpbb\template\twig\extension']->lang("SORT_OPTIONS");
        echo "\" class=\"button button-secondary dropdown-trigger dropdown-select\">
\t\t<i class=\"icon fa-sort-amount-asc fa-fw\" aria-hidden=\"true\"></i>
\t\t<span class=\"caret\"><i class=\"icon fa-sort-down fa-fw\" aria-hidden=\"true\"></i></span>
\t</span>
\t<div class=\"dropdown hidden\">
\t\t<div class=\"pointer\"><div class=\"pointer-inner\"></div></div>
\t\t<div class=\"dropdown-contents\">
\t\t\t<fieldset class=\"display-options\">
\t\t\t";
        // line 10
        if (($context["S_SORT_OPTIONS"] ?? null)) {
            // line 11
            echo "\t\t\t\t<label>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("SORT_BY");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo " <select name=\"sk\" id=\"sk\">";
            echo ($context["S_SORT_OPTIONS"] ?? null);
            echo "</select></label>
\t\t\t\t<label>";
            // line 12
            echo $this->extensions['phpbb\template\twig\extension']->lang("SORT_DIRECTION");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo " <select name=\"sd\" id=\"sd\">";
            echo ($context["S_ORDER_SELECT"] ?? null);
            echo "</select></label>
\t\t\t\t<hr class=\"dashed\" />
\t\t\t\t<input type=\"submit\" class=\"button2\" name=\"sort\" value=\"";
            // line 14
            echo $this->extensions['phpbb\template\twig\extension']->lang("SORT");
            echo "\" />
\t\t\t";
        } else {
            // line 16
            echo "\t\t\t\t<label>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("DISPLAY");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo " ";
            echo ($context["S_SELECT_SORT_DAYS"] ?? null);
            echo "</label>
\t\t\t\t";
            // line 17
            if (($context["S_SELECT_SORT_KEY"] ?? null)) {
                // line 18
                echo "\t\t\t\t<label>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("SORT_BY");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo " ";
                echo ($context["S_SELECT_SORT_KEY"] ?? null);
                echo "</label>
\t\t\t\t<label>";
                // line 19
                echo $this->extensions['phpbb\template\twig\extension']->lang("SORT_DIRECTION");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo " ";
                echo ($context["S_SELECT_SORT_DIR"] ?? null);
                echo "</label>
\t\t\t\t";
            }
            // line 21
            echo "\t\t\t\t<hr class=\"dashed\" />
\t\t\t\t<input type=\"submit\" class=\"button2\" name=\"sort\" value=\"";
            // line 22
            echo $this->extensions['phpbb\template\twig\extension']->lang("GO");
            echo "\" />
\t\t\t";
        }
        // line 24
        echo "\t\t\t</fieldset>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "display_options.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  108 => 24,  103 => 22,  100 => 21,  92 => 19,  84 => 18,  82 => 17,  74 => 16,  69 => 14,  61 => 12,  53 => 11,  51 => 10,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "display_options.html", "");
    }
}
