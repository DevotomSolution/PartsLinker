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

/* view/template/account/register.twig */
class __TwigTemplate_f1c95af33ae6adb304720269be8b7721ff5545ba41000ec737d42a916d2d30b2 extends Template
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
            echo "\t\t<div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
\t\t  <button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button>
\t\t</div>
\t  ";
        }
        // line 15
        echo "\t  <h5 class=\"fw-normal text-body mb-3 pb-3\" style=\"letter-spacing: 1px;\">";
        echo ($context["text_register"] ?? null);
        echo "</h5>
\t  <form action=\"";
        // line 16
        echo ($context["action"] ?? null);
        echo "\" class=\"needs-validation\" method=\"post\" enctype=\"multipart/form-data\" novalidate>
\t\t<div class=\"form-outline mb-4\">
\t\t  <i class=\"fas fa-envelope trailing\"></i>
\t\t  <input type=\"email\" name=\"email\" value=\"";
        // line 19
        echo ($context["email"] ?? null);
        echo "\" class=\"form-control\" required/>
\t\t  <label class=\"form-label\">";
        // line 20
        echo ($context["entry_email"] ?? null);
        echo "</label>
\t\t</div>
\t\t<div class=\"form-outline mb-4\">
\t\t  <i class=\"fas fa-key trailing\"></i>
\t\t  <input type=\"password\" name=\"password\" value=\"";
        // line 24
        echo ($context["password"] ?? null);
        echo "\" class=\"form-control\" required/>
\t\t  <label class=\"form-label\">";
        // line 25
        echo ($context["entry_password"] ?? null);
        echo "</label>
\t\t</div>
\t\t<div class=\"form-outline mb-4\">
\t\t  <i class=\"fas fa-check-circle trailing\"></i>
\t\t  <input type=\"password\" name=\"confirm\" value=\"";
        // line 29
        echo ($context["confirm"] ?? null);
        echo "\" class=\"form-control\" required/>
\t\t  <label class=\"form-label\">";
        // line 30
        echo ($context["entry_confirm"] ?? null);
        echo "</label>
\t\t</div>
\t\t<div class=\"mb-4\">
\t\t  <select class=\"select\" name=\"currency\">
\t\t\t";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["currencies"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["currency_data"]) {
            // line 35
            echo "\t\t\t<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["currency_data"], "code", [], "any", false, false, false, 35);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["currency_data"], "code", [], "any", false, false, false, 35) == ($context["currency"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["currency_data"], "title", [], "any", false, false, false, 35);
            echo "</option>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['currency_data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "\t\t  </select>
\t\t  <label class=\"form-label select-label\">";
        // line 38
        echo ($context["select_currency"] ?? null);
        echo "</label>
\t\t</div>
\t\t<div class=\"mb-4\">
\t\t  <select class=\"select\" name=\"language_id\">
\t\t\t";
        // line 42
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language_data"]) {
            // line 43
            echo "\t\t\t<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language_data"], "language_id", [], "any", false, false, false, 43);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["language_data"], "language_id", [], "any", false, false, false, 43) == ($context["language_id"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["language_data"], "name", [], "any", false, false, false, 43);
            echo "</option>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language_data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 45
        echo "\t\t  </select>
\t\t  <label class=\"form-label select-label\">";
        // line 46
        echo ($context["select_language"] ?? null);
        echo "</label>
\t\t</div>
\t\t<div class=\"form-check mb-4\" style=\"margin-left: 1px;\">
\t\t  <input class=\"form-check-input\" type=\"checkbox\" name=\"agree\" value=\"1\" required";
        // line 49
        if (($context["agree"] ?? null)) {
            echo " checked";
        }
        echo "/>
\t\t  <label class=\"form-check-label mb-0\">";
        // line 50
        echo ($context["text_agree"] ?? null);
        echo "</label>
\t\t</div>
\t\t<div class=\"pt-1 mb-4\">
          <button class=\"btn btn-dark btn-lg btn-block\" type=\"submit\">";
        // line 53
        echo ($context["button_save"] ?? null);
        echo "</button>
        </div>
\t\t";
        // line 55
        if (($context["redirect"] ?? null)) {
            // line 56
            echo "\t\t<input type=\"hidden\" name=\"redirect\" value=\"";
            echo ($context["redirect"] ?? null);
            echo "\" />
\t\t";
        }
        // line 58
        echo "\t  </form>
\t</div>
  </div>
</div>

<div class=\"modal fade\" id=\"modal\" tabindex=\"-1\" aria-labelledby=\"modalLabel\" aria-hidden=\"true\">
  <div class=\"modal-dialog modal-lg\">
\t<div class=\"modal-content\">
\t  <div class=\"modal-header\">
\t\t<h5 class=\"modal-title\" id=\"modalLabel\">";
        // line 67
        echo ($context["title_agree"] ?? null);
        echo "</h5>
\t\t<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"modal\" aria-label=\"Close\"></button>
\t  </div>
\t  <div class=\"modal-body\">
\t\t";
        // line 71
        echo ($context["description_agree"] ?? null);
        echo "
\t  </div>
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
        // line 90
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "view/template/account/register.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  237 => 90,  215 => 71,  208 => 67,  197 => 58,  191 => 56,  189 => 55,  184 => 53,  178 => 50,  172 => 49,  166 => 46,  163 => 45,  148 => 43,  144 => 42,  137 => 38,  134 => 37,  119 => 35,  115 => 34,  108 => 30,  104 => 29,  97 => 25,  93 => 24,  86 => 20,  82 => 19,  76 => 16,  71 => 15,  63 => 11,  61 => 10,  56 => 8,  50 => 5,  45 => 3,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/account/register.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/account/register.twig");
    }
}
