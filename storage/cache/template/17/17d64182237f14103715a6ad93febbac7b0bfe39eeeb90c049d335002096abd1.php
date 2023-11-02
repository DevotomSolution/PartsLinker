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

/* view/template/integration/dpd.twig */
class __TwigTemplate_749699647f53b4767a5dac0deb7889047fd42d56584f79efeac8a3d892fe5ef6 extends Template
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
<main style=\"margin-top: 58px\" class=\"pt-4\">
<div class=\"container-fluid\">
  ";
        // line 4
        if (($context["error_warning"] ?? null)) {
            // line 5
            echo "\t<div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"danger\"><i class=\"fa fa-exclamation-circle me-2\"></i>";
            echo ($context["error_warning"] ?? null);
            echo "<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button></div>
  ";
        }
        // line 7
        echo "  ";
        if (($context["success"] ?? null)) {
            // line 8
            echo "\t<div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"success\"><i class=\"fa fa-exclamation-circle me-2\"></i>";
            echo ($context["success"] ?? null);
            echo "<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button></div>
  ";
        }
        // line 10
        echo "  <form method=\"POST\" action=\"";
        echo ($context["action"] ?? null);
        echo "\">
\t<div class=\"form-outline mb-3\">
\t  <input type=\"text\" name=\"username\" value=\"";
        // line 12
        echo ($context["username"] ?? null);
        echo "\" class=\"form-control\"/>
\t  <label class=\"form-label\">";
        // line 13
        echo ($context["entry_username"] ?? null);
        echo "</label>
\t</div>
\t<div class=\"form-outline mb-3\">
\t  <input type=\"password\" name=\"password\" value=\"";
        // line 16
        echo ($context["password"] ?? null);
        echo "\" class=\"form-control\"/>
\t  <label class=\"form-label\">";
        // line 17
        echo ($context["entry_password"] ?? null);
        echo "</label>
\t</div>
\t<button type=\"submit\" class=\"btn btn-primary ps-5 pe-5 mb-3\"><i class=\"fa fa-save me-2\"></i>";
        // line 19
        echo ($context["button_save"] ?? null);
        echo "</button>
  </form>
</div>
</main>
";
        // line 23
        echo ($context["footer"] ?? null);
        echo " 
";
    }

    public function getTemplateName()
    {
        return "view/template/integration/dpd.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 23,  86 => 19,  81 => 17,  77 => 16,  71 => 13,  67 => 12,  61 => 10,  55 => 8,  52 => 7,  46 => 5,  44 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/integration/dpd.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/integration/dpd.twig");
    }
}
