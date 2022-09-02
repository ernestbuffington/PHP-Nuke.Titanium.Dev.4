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

/* attachment.html */
class __TwigTemplate_118977002f096bcc3b836c75928c429ab068e9e5f766bfb0846c91082ae929ea extends \Twig\Template
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
        // line 2
        echo "
";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "_file", [], "any", false, false, false, 3));
        foreach ($context['_seq'] as $context["_key"] => $context["_file"]) {
            // line 4
            echo "\t";
            if (twig_get_attribute($this->env, $this->source, $context["_file"], "S_DENIED", [], "any", false, false, false, 4)) {
                // line 5
                echo "\t<p>[";
                echo twig_get_attribute($this->env, $this->source, $context["_file"], "DENIED_MESSAGE", [], "any", false, false, false, 5);
                echo "]</p>
\t";
            } else {
                // line 7
                echo "\t\t";
                // line 8
                echo "
\t\t";
                // line 9
                if (twig_get_attribute($this->env, $this->source, $context["_file"], "S_THUMBNAIL", [], "any", false, false, false, 9)) {
                    // line 10
                    echo "\t\t<dl class=\"thumbnail\">
\t\t\t<dt><a href=\"";
                    // line 11
                    echo twig_get_attribute($this->env, $this->source, $context["_file"], "U_DOWNLOAD_LINK", [], "any", false, false, false, 11);
                    echo "\"><img src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["_file"], "THUMB_IMAGE", [], "any", false, false, false, 11);
                    echo "\" class=\"postimage\" alt=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["_file"], "COMMENT", [], "any", false, false, false, 11)) {
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["_file"], "COMMENT", [], "any", false, false, false, 11), "html");
                    } else {
                        echo twig_get_attribute($this->env, $this->source, $context["_file"], "DOWNLOAD_NAME", [], "any", false, false, false, 11);
                    }
                    echo "\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["_file"], "DOWNLOAD_NAME", [], "any", false, false, false, 11);
                    echo " (";
                    echo twig_get_attribute($this->env, $this->source, $context["_file"], "FILESIZE", [], "any", false, false, false, 11);
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["_file"], "SIZE_LANG", [], "any", false, false, false, 11);
                    echo ") ";
                    echo twig_get_attribute($this->env, $this->source, $context["_file"], "L_DOWNLOAD_COUNT", [], "any", false, false, false, 11);
                    echo "\" /></a></dt>
\t\t\t";
                    // line 12
                    if (twig_get_attribute($this->env, $this->source, $context["_file"], "COMMENT", [], "any", false, false, false, 12)) {
                        echo "<dd> ";
                        echo twig_get_attribute($this->env, $this->source, $context["_file"], "COMMENT", [], "any", false, false, false, 12);
                        echo "</dd>";
                    }
                    // line 13
                    echo "\t\t</dl>
\t\t";
                }
                // line 15
                echo "
\t\t";
                // line 16
                if (twig_get_attribute($this->env, $this->source, $context["_file"], "S_IMAGE", [], "any", false, false, false, 16)) {
                    // line 17
                    echo "\t\t<dl class=\"file\">
\t\t\t<dt class=\"attach-image\"><img src=\"";
                    // line 18
                    echo twig_get_attribute($this->env, $this->source, $context["_file"], "U_INLINE_LINK", [], "any", false, false, false, 18);
                    echo "\" class=\"postimage\" alt=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["_file"], "COMMENT", [], "any", false, false, false, 18)) {
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["_file"], "COMMENT", [], "any", false, false, false, 18), "html");
                    } else {
                        echo twig_get_attribute($this->env, $this->source, $context["_file"], "DOWNLOAD_NAME", [], "any", false, false, false, 18);
                    }
                    echo "\" onclick=\"viewableArea(this);\" /></dt>
\t\t\t";
                    // line 19
                    if (twig_get_attribute($this->env, $this->source, $context["_file"], "COMMENT", [], "any", false, false, false, 19)) {
                        echo "<dd><em>";
                        echo twig_get_attribute($this->env, $this->source, $context["_file"], "COMMENT", [], "any", false, false, false, 19);
                        echo "</em></dd>";
                    }
                    // line 20
                    echo "\t\t\t<dd>";
                    echo twig_get_attribute($this->env, $this->source, $context["_file"], "DOWNLOAD_NAME", [], "any", false, false, false, 20);
                    echo " (";
                    echo twig_get_attribute($this->env, $this->source, $context["_file"], "FILESIZE", [], "any", false, false, false, 20);
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["_file"], "SIZE_LANG", [], "any", false, false, false, 20);
                    echo ") ";
                    echo twig_get_attribute($this->env, $this->source, $context["_file"], "L_DOWNLOAD_COUNT", [], "any", false, false, false, 20);
                    echo "</dd>
\t\t</dl>
\t\t";
                }
                // line 23
                echo "
\t\t";
                // line 24
                if (twig_get_attribute($this->env, $this->source, $context["_file"], "S_FILE", [], "any", false, false, false, 24)) {
                    // line 25
                    echo "\t\t<dl class=\"file\">
\t\t\t<dt>";
                    // line 26
                    if (twig_get_attribute($this->env, $this->source, $context["_file"], "UPLOAD_ICON", [], "any", false, false, false, 26)) {
                        echo twig_get_attribute($this->env, $this->source, $context["_file"], "UPLOAD_ICON", [], "any", false, false, false, 26);
                        echo " ";
                    }
                    echo "<a class=\"postlink\" href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["_file"], "U_DOWNLOAD_LINK", [], "any", false, false, false, 26);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["_file"], "DOWNLOAD_NAME", [], "any", false, false, false, 26);
                    echo "</a></dt>
\t\t\t";
                    // line 27
                    if (twig_get_attribute($this->env, $this->source, $context["_file"], "COMMENT", [], "any", false, false, false, 27)) {
                        echo "<dd><em>";
                        echo twig_get_attribute($this->env, $this->source, $context["_file"], "COMMENT", [], "any", false, false, false, 27);
                        echo "</em></dd>";
                    }
                    // line 28
                    echo "\t\t\t<dd>(";
                    echo twig_get_attribute($this->env, $this->source, $context["_file"], "FILESIZE", [], "any", false, false, false, 28);
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["_file"], "SIZE_LANG", [], "any", false, false, false, 28);
                    echo ") ";
                    echo twig_get_attribute($this->env, $this->source, $context["_file"], "L_DOWNLOAD_COUNT", [], "any", false, false, false, 28);
                    echo "</dd>
\t\t</dl>
\t\t";
                }
                // line 31
                echo "
\t\t";
                // line 32
                // line 33
                echo "\t";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['_file'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
    }

    public function getTemplateName()
    {
        return "attachment.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  178 => 35,  171 => 33,  170 => 32,  167 => 31,  156 => 28,  150 => 27,  139 => 26,  136 => 25,  134 => 24,  131 => 23,  118 => 20,  112 => 19,  102 => 18,  99 => 17,  97 => 16,  94 => 15,  90 => 13,  84 => 12,  64 => 11,  61 => 10,  59 => 9,  56 => 8,  54 => 7,  48 => 5,  45 => 4,  41 => 3,  38 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "attachment.html", "");
    }
}
