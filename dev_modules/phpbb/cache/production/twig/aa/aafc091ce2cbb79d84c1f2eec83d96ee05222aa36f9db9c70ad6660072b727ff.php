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

/* simple_header.html */
class __TwigTemplate_4f122119201cef8ff510b4792aba2a9aa755249ec6bba5646896f88d6ac43444 extends \Twig\Template
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
        echo "<!DOCTYPE html>
<html dir=\"";
        // line 2
        echo ($context["S_CONTENT_DIRECTION"] ?? null);
        echo "\" lang=\"";
        echo ($context["S_USER_LANG"] ?? null);
        echo "\">
<head>
<meta charset=\"utf-8\" />
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />
";
        // line 7
        echo ($context["META"] ?? null);
        echo "
<title>";
        // line 8
        echo ($context["SITENAME"] ?? null);
        echo " &bull; ";
        if (($context["S_IN_MCP"] ?? null)) {
            echo $this->extensions['phpbb\template\twig\extension']->lang("MCP");
            echo " &bull; ";
        } elseif (($context["S_IN_UCP"] ?? null)) {
            echo $this->extensions['phpbb\template\twig\extension']->lang("UCP");
            echo " &bull; ";
        }
        echo ($context["PAGE_TITLE"] ?? null);
        echo "</title>

";
        // line 10
        if (($context["S_ALLOW_CDN"] ?? null)) {
            // line 11
            echo "<script>
\tWebFontConfig = {
\t\tgoogle: {
\t\t\tfamilies: ['Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese']
\t\t}
\t};

\t(function(d) {
\t\tvar wf = d.createElement('script'), s = d.scripts[0];
\t\twf.src = 'https://cdn.jsdelivr.net/npm/webfontloader@1.6.28/webfontloader.min.js';
\t\twf.async = true;
\t\ts.parentNode.insertBefore(wf, s);
\t})(document);
</script>
";
        }
        // line 26
        echo "<link href=\"";
        echo ($context["T_FONT_AWESOME_LINK"] ?? null);
        echo "\" rel=\"stylesheet\">
<link href=\"";
        // line 27
        echo ($context["T_STYLESHEET_LINK"] ?? null);
        echo "\" rel=\"stylesheet\">
<link href=\"";
        // line 28
        echo ($context["T_STYLESHEET_LANG_LINK"] ?? null);
        echo "\" rel=\"stylesheet\">

";
        // line 30
        if ((($context["S_CONTENT_DIRECTION"] ?? null) == "rtl")) {
            // line 31
            echo "\t<link href=\"";
            echo ($context["T_THEME_PATH"] ?? null);
            echo "/bidi.css?assets_version=";
            echo ($context["T_ASSETS_VERSION"] ?? null);
            echo "\" rel=\"stylesheet\">
";
        }
        // line 33
        echo "
<!--[if lte IE 8]>
\t<link href=\"";
        // line 35
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/tweaks.css?assets_version=";
        echo ($context["T_ASSETS_VERSION"] ?? null);
        echo "\" rel=\"stylesheet\">
<![endif]-->

";
        // line 38
        $value = 1;
        $context['definition']->set('POPUP', $value);
        // line 39
        echo "
";
        // line 40
        // line 41
        echo "
";
        // line 42
        echo twig_get_attribute($this->env, $this->source, ($context["definition"] ?? null), "STYLESHEETS", [], "any", false, false, false, 42);
        echo "

";
        // line 44
        // line 45
        echo "
</head>

<body id=\"phpbb\" class=\"nojs ";
        // line 48
        echo ($context["S_CONTENT_DIRECTION"] ?? null);
        echo " ";
        echo ($context["BODY_CLASS"] ?? null);
        echo "\">

";
        // line 50
        // line 51
        echo "
<div id=\"wrap\" class=\"wrap\">
\t<a id=\"top\" class=\"top-anchor\" accesskey=\"t\"></a>
\t<div id=\"page-body\" class=\"page-body\" role=\"main\">
";
    }

    public function getTemplateName()
    {
        return "simple_header.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  152 => 51,  151 => 50,  144 => 48,  139 => 45,  138 => 44,  133 => 42,  130 => 41,  129 => 40,  126 => 39,  123 => 38,  115 => 35,  111 => 33,  103 => 31,  101 => 30,  96 => 28,  92 => 27,  87 => 26,  70 => 11,  68 => 10,  54 => 8,  50 => 7,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "simple_header.html", "");
    }
}
