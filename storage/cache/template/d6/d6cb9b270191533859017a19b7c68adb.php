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

/* view/template/integration/ebay_authorize.twig */
class __TwigTemplate_31710a11514dc3ed67773efd2a906520 extends Template
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
  <div class=\"text-end\">
\t<span class=\"btn btn-link text-dark\" data-mdb-ripple-color=\"dark\"><i class=\"fas fa-user-circle me-2\"></i>";
        // line 5
        echo ($context["text_authorize"] ?? null);
        echo "</span>
\t<a href=\"";
        // line 6
        echo ($context["setting"] ?? null);
        echo "\" class=\"btn btn-link\" data-mdb-ripple-color=\"dark\"><i class=\"fas fa-tools me-2\"></i>";
        echo ($context["text_setting"] ?? null);
        echo "</a>
\t<a href=\"";
        // line 7
        echo ($context["home"] ?? null);
        echo "\" class=\"btn btn-link\" data-mdb-ripple-color=\"dark\"><i class=\"fas fa-home me-2\"></i>";
        echo ($context["text_home"] ?? null);
        echo "</a>
  </div>
  ";
        // line 9
        if (($context["error_warning"] ?? null)) {
            // line 10
            echo "\t<div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"danger\"><i class=\"fa fa-exclamation-circle me-2\"></i>";
            echo ($context["error_warning"] ?? null);
            echo "<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button></div>
  ";
        }
        // line 12
        echo "  ";
        if (($context["success"] ?? null)) {
            // line 13
            echo "\t<div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"success\"><i class=\"fa fa-exclamation-circle me-2\"></i>";
            echo ($context["success"] ?? null);
            echo "<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button> </div>
  ";
        }
        // line 15
        echo "  <div class=\"mt-4\">
\t<div class=\"col-12 col-lg-6\" style=\"margin: 0 auto;\">
\t  <form method=\"POST\" action=\"";
        // line 17
        echo ($context["action"] ?? null);
        echo "\">
\t\t  <h3 class=\"text-center\">";
        // line 18
        echo ($context["text_authorize"] ?? null);
        echo "</h3>
\t\t  <div class=\"form-outline mt-4\">
\t\t\t<input type=\"text\" id=\"input-app_id\" name=\"app_id\" value=\"";
        // line 20
        echo ($context["app_id"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t<label class=\"form-label\" for=\"input-app_id\">";
        // line 21
        echo ($context["entry_app_id"] ?? null);
        echo "</label>
\t\t  </div>
\t\t  <div class=\"form-outline mt-4\">
\t\t\t<input type=\"text\" id=\"input-cert_id\" name=\"cert_id\" value=\"";
        // line 24
        echo ($context["cert_id"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t<label class=\"form-label\" for=\"input-cert_id\">";
        // line 25
        echo ($context["entry_cert_id"] ?? null);
        echo "</label>
\t\t  </div>
\t\t  <div class=\"form-outline mt-4\">
\t\t\t<input type=\"text\" id=\"input-ru_name\" name=\"ru_name\" value=\"";
        // line 28
        echo ($context["ru_name"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t<label class=\"form-label\" for=\"input-ru_name\">";
        // line 29
        echo ($context["entry_ru_name"] ?? null);
        echo "</label>
\t\t  </div>
\t\t  <div class=\"alert mt-4\" role=\"alert\" data-mdb-color=\"primary\">
\t\t\t<i class=\"fas fa-info-circle me-1\"></i>";
        // line 32
        echo ($context["text_ru_name_url"] ?? null);
        echo " 
\t\t\t<b id=\"ru_name-link\">";
        // line 33
        echo ($context["ru_name_url"] ?? null);
        echo "</b> 
\t\t\t<button type=\"button\" class=\"btn btn-primary btn-sm btn-floating\" onclick=\"copy(this);\"><i class=\"fas fa-copy text-light\"></i></button>
\t\t  </div>
\t\t  <div class=\"text-center mt-4\">
\t\t\t<div class=\"form-check form-check-inline\">
\t\t\t  <input class=\"form-check-input\" type=\"radio\" name=\"sandbox\" value=\"0\" id=\"sandbox0\" ";
        // line 38
        if ((($context["sandbox"] ?? null) == 0)) {
            echo "checked";
        }
        echo "/>
\t\t\t  <label class=\"form-check-label\" for=\"sandbox0\">";
        // line 39
        echo ($context["text_production"] ?? null);
        echo "</label>
\t\t\t</div>
\t\t\t<div class=\"form-check form-check-inline\">
\t\t\t  <input class=\"form-check-input\" type=\"radio\" name=\"sandbox\" value=\"1\" id=\"sandbox1\" ";
        // line 42
        if ((($context["sandbox"] ?? null) == 1)) {
            echo "checked";
        }
        echo "/>
\t\t\t  <label class=\"form-check-label\" for=\"sandbox1\">";
        // line 43
        echo ($context["text_sandbox"] ?? null);
        echo "</label>
\t\t\t</div>
\t\t  </div>
\t\t  <button type=\"submit\" class=\"btn btn-primary btn-lg btn-block mt-4 mb-3\">";
        // line 46
        echo ($context["text_authorize"] ?? null);
        echo "</button>
\t  </form>
\t</div>
  </div>
</div>
</main>
<script>
function copy(e) {
  e.innerHTML = \"<i class='fas fa-check text-light'></i>\";
\t
  let copyText = document.getElementById('ru_name-link').innerText;
  let el = document.createElement('textarea');
  el.value = copyText;
  el.style.position = 'absolute';
  el.style.opacity = '0';
  document.body.appendChild(el);
  el.select();
  document.execCommand('copy');
  document.body.removeChild(el);
}
</script>
";
        // line 67
        echo ($context["footer"] ?? null);
        echo " 
";
    }

    public function getTemplateName()
    {
        return "view/template/integration/ebay_authorize.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  182 => 67,  158 => 46,  152 => 43,  146 => 42,  140 => 39,  134 => 38,  126 => 33,  122 => 32,  116 => 29,  112 => 28,  106 => 25,  102 => 24,  96 => 21,  92 => 20,  87 => 18,  83 => 17,  79 => 15,  73 => 13,  70 => 12,  64 => 10,  62 => 9,  55 => 7,  49 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/integration/ebay_authorize.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/integration/ebay_authorize.twig");
    }
}
