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

/* view/template/account/forgotten.twig */
class __TwigTemplate_7b149af153492d78fc7968a2b225721c0de1fec44091b976a995714c3e698031 extends Template
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
        echo "
<div class=\"bg-image overflow-auto d-flex justify-content-center align-items-start align-items-md-center\" style=\"background-image: url('";
        // line 2
        echo ($context["server"] ?? null);
        echo "view/img/bg.jpg'); min-height: 100vh;\">
  <div class=\"position-absolute\" style=\"top: 4px; right: 0;\">";
        // line 3
        echo ($context["language_selector"] ?? null);
        echo "</div>
  <div class=\"rounded-4 row overflow-hidden mw-100 m-1\" style=\"width: 800px;\">
\t<div class=\"col-12 col-md-5 d-flex align-items-center justify-content-center bg-dark bg-opacity-75 text-white p-1 fs-4\"><b>";
        // line 5
        echo ($context["text_welcome"] ?? null);
        echo "</b></div>
\t<div class=\"col-12 col-md-7 bg-light p-5 text-dark\">
\t  <div class=\"d-flex align-items-center mb-3 pb-2\">
\t\t<img src=\"";
        // line 8
        echo ($context["server"] ?? null);
        echo "view/img/logo.png\" class=\"w-100\" style=\"margin-left: -5px;\"/>
\t  </div>
\t  ";
        // line 10
        if (($context["error_warning"] ?? null)) {
            // line 11
            echo "\t  <div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"danger\"><i class=\"fa fa-exclamation-circle me-2\"></i>";
            echo ($context["error_warning"] ?? null);
            echo "<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button></div>
\t  ";
        }
        // line 13
        echo "\t  <h5 class=\"fw-normal text-body mb-3 pb-3\" style=\"letter-spacing: 1px;\">";
        echo ($context["text_email"] ?? null);
        echo "</h5>
\t  <form action=\"";
        // line 14
        echo ($context["action"] ?? null);
        echo "\" class=\"needs-validation\" method=\"post\" enctype=\"multipart/form-data\" novalidate>
\t\t<div class=\"form-outline mb-4\">
\t\t  <i class=\"fas fa-envelope trailing\"></i>
\t\t  <input type=\"email\" name=\"email\" value=\"";
        // line 17
        echo ($context["email"] ?? null);
        echo "\" class=\"form-control\" required/>
\t\t  <label class=\"form-label\">";
        // line 18
        echo ($context["entry_email"] ?? null);
        echo "</label>
\t\t</div>
\t\t<div class=\"pt-1 mb-4\">
          <button class=\"btn btn-dark btn-lg btn-block\" type=\"submit\">";
        // line 21
        echo ($context["button_submit"] ?? null);
        echo "</button>
        </div>
\t\t";
        // line 23
        if (($context["redirect"] ?? null)) {
            // line 24
            echo "\t\t<input type=\"hidden\" name=\"redirect\" value=\"";
            echo ($context["redirect"] ?? null);
            echo "\" />
\t\t";
        }
        // line 26
        echo "\t  </form>
\t  <a class=\"small text-muted\" href=\"";
        // line 27
        echo ($context["cancel"] ?? null);
        echo "\">";
        echo ($context["text_cancel"] ?? null);
        echo "</a>
\t</div>
  </div>
</div>
<script>
const forms = document.querySelectorAll('.needs-validation');

Array.prototype.slice.call(forms).forEach((form) => {
  form.addEventListener('submit', (event) => {
\tif (!form.checkValidity()) {
\t  event.preventDefault();
\t  event.stopPropagation();
\t}
\tform.classList.add('was-validated');
  }, false);
});
</script>
";
        // line 44
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "view/template/account/forgotten.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  128 => 44,  106 => 27,  103 => 26,  97 => 24,  95 => 23,  90 => 21,  84 => 18,  80 => 17,  74 => 14,  69 => 13,  63 => 11,  61 => 10,  56 => 8,  50 => 5,  45 => 3,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/account/forgotten.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/account/forgotten.twig");
    }
}
