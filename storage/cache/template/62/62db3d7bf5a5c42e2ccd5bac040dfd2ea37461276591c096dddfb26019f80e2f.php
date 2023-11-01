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

/* view/template/error/not_found.twig */
class __TwigTemplate_8691bb1d6e74ac8e0bf2a26bd09abcbf822f64f5704cff5b712fddbd938debe0 extends Template
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
        echo ($context["header"] ?? null);
        echo ($context["navigation"] ?? null);
        echo "
<main style=\"margin-top: 58px\" class=\"pt-3\">
  <div class=\"container-fluid\">
    <p class=\"text-center\">";
        // line 4
        echo ($context["text_not_found"] ?? null);
        echo "</p>
  </div>
</main>  
";
        // line 7
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "view/template/error/not_found.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 7,  44 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/error/not_found.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/error/not_found.twig");
    }
}
