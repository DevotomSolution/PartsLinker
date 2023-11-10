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

/* view/template/integration/opencart_connect.twig */
class __TwigTemplate_723334c1ee46536eeb614a013034a893a68fb74daf4e3f80c070d7393e10f4af extends Template
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
  <div class=\"text-end mb-3\">
\t<span class=\"btn btn-link text-dark\" data-mdb-ripple-color=\"dark\"><i class=\"fas fa-link me-2\"></i>";
        // line 5
        echo ($context["text_connect"] ?? null);
        echo "</span>
\t<a href=\"";
        // line 6
        echo ($context["setting"] ?? null);
        echo "\" class=\"btn btn-link \" data-mdb-ripple-color=\"dark\"><i class=\"fas fa-tools me-2\"></i>";
        echo ($context["text_setting"] ?? null);
        echo "</a>
\t<a href=\"";
        // line 7
        echo ($context["home"] ?? null);
        echo "\" class=\"btn btn-link \" data-mdb-ripple-color=\"dark\"><i class=\"fas fa-home me-2\"></i>";
        echo ($context["text_home"] ?? null);
        echo "</a>
  </div>
  ";
        // line 9
        if (($context["error_warning"] ?? null)) {
            // line 10
            echo "  <div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"danger\"><i class=\"fa fa-exclamation-circle me-2\"></i>";
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
            echo "<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button></div>
  ";
        }
        // line 15
        echo "  <form method=\"POST\" action=\"";
        echo ($context["action"] ?? null);
        echo "\">
\t<div class=\"mt-3\">
\t  <div class=\"form-outline\">
\t\t<input type=\"text\" name=\"website\" value=\"";
        // line 18
        echo ($context["website"] ?? null);
        echo "\" class=\"form-control\"/>
\t\t<label class=\"form-label\">";
        // line 19
        echo ($context["entry_website"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<div class=\"mt-3\">
\t  <select class=\"select\" name=\"version\">
\t\t<option value=\"3\" ";
        // line 24
        if ((($context["version"] ?? null) == 3)) {
            echo "selected";
        }
        echo ">OC 3</option>
\t  </select>
\t  <label class=\"form-label select-label\">";
        // line 26
        echo ($context["select_version"] ?? null);
        echo "</label>
\t</div>
\t<div class=\"mt-3\">
\t  <div class=\"form-outline\">
\t\t<input type=\"text\" name=\"username\" value=\"";
        // line 30
        echo ($context["username"] ?? null);
        echo "\" class=\"form-control\"/>
\t\t<label class=\"form-label\">";
        // line 31
        echo ($context["entry_username"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<div class=\"mt-3\">
\t  <div class=\"form-outline\">
\t\t<textarea name=\"key\" class=\"form-control\">";
        // line 36
        echo ($context["key"] ?? null);
        echo "</textarea>
\t\t<label class=\"form-label\">";
        // line 37
        echo ($context["entry_key"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<div class=\"alert mt-3\" role=\"alert\" data-mdb-color=\"primary\">
\t  <i class=\"fas fa-info-circle me-1\"></i>";
        // line 41
        echo ($context["text_ip"] ?? null);
        echo " 
\t  <b id=\"ip\">";
        // line 42
        echo ($context["ip"] ?? null);
        echo "</b> 
\t  <button type=\"button\" class=\"btn btn-primary btn-sm btn-floating\" onclick=\"copy(this);\"><i class=\"fas fa-copy text-light\"></i></button>
\t</div>
\t<div class=\"d-flex mt-3\">
\t  <a class=\"chip chip-md\" data-mdb-toggle=\"tooltip\" title=\"";
        // line 46
        echo ($context["tooltip_download_api_oc3"] ?? null);
        echo "\" href=\"";
        echo ($context["server"] ?? null);
        echo "storage/download/plapioc3x.ocmod.zip\" download><img src=\"";
        echo ($context["server"] ?? null);
        echo "view/img/winrar.jpg\" />";
        echo ($context["text_download_api_oc3"] ?? null);
        echo "</a>
\t  <a class=\"chip chip-md\" href=\"https://www.opencart.com/index.php?route=onlineshop/extension/info&extension_id=40663\" target=\"blanc\"><img src=\"";
        // line 47
        echo ($context["server"] ?? null);
        echo "view/img/winrar.jpg\" />";
        echo ($context["text_download_localcopy"] ?? null);
        echo "</a>
\t</div>
\t<button type=\"submit\" class=\"btn btn-primary ps-5 pe-5 mt-3 mb-3\"><i class=\"fa fa-save me-2\"></i>";
        // line 49
        echo ($context["button_save"] ?? null);
        echo "</button>
  </form>
</div>
</main>
<script>
function copy(e) {
  e.innerHTML = \"<i class='fas fa-check text-light'></i>\";
\t
  let copyText = document.getElementById('ip').innerText;
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
        // line 68
        echo ($context["footer"] ?? null);
        echo " 
";
    }

    public function getTemplateName()
    {
        return "view/template/integration/opencart_connect.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  185 => 68,  163 => 49,  156 => 47,  146 => 46,  139 => 42,  135 => 41,  128 => 37,  124 => 36,  116 => 31,  112 => 30,  105 => 26,  98 => 24,  90 => 19,  86 => 18,  79 => 15,  73 => 13,  70 => 12,  64 => 10,  62 => 9,  55 => 7,  49 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/integration/opencart_connect.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/integration/opencart_connect.twig");
    }
}
