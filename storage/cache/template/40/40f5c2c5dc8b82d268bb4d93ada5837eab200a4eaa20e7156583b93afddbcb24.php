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

/* view/template/integration/autovit_authorization.twig */
class __TwigTemplate_7964a1eba334d4c2800cce9aed63195afa3242f160421fb81fc58f5888886c0e extends Template
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
  <div class=\"text-end\">
\t<span class=\"btn btn-link text-dark\" data-mdb-ripple-color=\"dark\"><i class=\"fas fa-user-circle me-2\"></i>";
        // line 5
        echo ($context["link_authorization"] ?? null);
        echo "</span>
\t<a href=\"";
        // line 6
        echo ($context["url_setting"] ?? null);
        echo "\" class=\"btn btn-link \" data-mdb-ripple-color=\"dark\"><i class=\"fas fa-tools me-2\"></i>";
        echo ($context["link_setting"] ?? null);
        echo "</a>
\t<a href=\"";
        // line 7
        echo ($context["url_home"] ?? null);
        echo "\" class=\"btn btn-link \" data-mdb-ripple-color=\"dark\"><i class=\"fas fa-home me-2\"></i>";
        echo ($context["link_home"] ?? null);
        echo "</a>
  </div>
  ";
        // line 9
        if (($context["error_warning"] ?? null)) {
            // line 10
            echo "\t<div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
\t  <button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button>
\t</div>
  ";
        }
        // line 14
        echo "  ";
        if (($context["success"] ?? null)) {
            // line 15
            echo "\t<div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"success\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
\t  <button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button>
\t</div>
  ";
        }
        // line 19
        echo "  <form method=\"POST\" action=\"";
        echo ($context["url_authorization"] ?? null);
        echo "\">
\t<div class=\"mt-3\">
\t  <div class=\"form-outline\">
\t\t<input type=\"text\" name=\"client_id\" value=\"";
        // line 22
        echo ($context["client_id"] ?? null);
        echo "\" class=\"form-control\"/>
\t\t<label class=\"form-label\">";
        // line 23
        echo ($context["entry_client_id"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<div class=\"mt-3\">
\t  <div class=\"form-outline\">
\t\t<input type=\"text\" name=\"client_secret\" value=\"";
        // line 28
        echo ($context["client_secret"] ?? null);
        echo "\" class=\"form-control\"/>
\t\t<label class=\"form-label\">";
        // line 29
        echo ($context["entry_client_secret"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<div class=\"mt-3\">
\t  <select class=\"select\" id=\"select-grant_type\" name=\"grant_type\" class=\"form-control\">
\t\t<option value=\"password\"";
        // line 34
        if ((($context["grant_type"] ?? null) == "password")) {
            echo " selected";
        }
        echo ">";
        echo ($context["option_grant_type_password"] ?? null);
        echo "</option>
\t\t<option value=\"partner\"";
        // line 35
        if ((($context["grant_type"] ?? null) == "partner")) {
            echo " selected";
        }
        echo ">";
        echo ($context["option_grant_type_partner"] ?? null);
        echo "</option>
\t  </select>
\t  <label class=\"form-label select-label\">";
        // line 37
        echo ($context["select_grant_type"] ?? null);
        echo "</label>
\t</div>
\t<div id=\"container-email\" class=\"mt-3\">
\t  <div class=\"form-outline\">
\t\t<input type=\"text\" name=\"email\" value=\"";
        // line 41
        echo ($context["email"] ?? null);
        echo "\" class=\"form-control\"/>
\t\t<label class=\"form-label\">";
        // line 42
        echo ($context["entry_email"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<div id=\"container-password\" class=\"mt-3";
        // line 45
        if ((($context["grant_type"] ?? null) == "partner")) {
            echo " d-none";
        }
        echo "\">
\t  <div class=\"form-outline\">
\t\t<input type=\"password\" name=\"password\" value=\"";
        // line 47
        echo ($context["password"] ?? null);
        echo "\" class=\"form-control\"/>
\t\t<label class=\"form-label\">";
        // line 48
        echo ($context["entry_password"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<div id=\"container-partner_code\" class=\"mt-3";
        // line 51
        if ((($context["grant_type"] ?? null) == "password")) {
            echo " d-none";
        }
        echo "\">
\t  <div class=\"form-outline\">
\t\t<input type=\"text\" name=\"partner_code\" value=\"";
        // line 53
        echo ($context["partner_code"] ?? null);
        echo "\" class=\"form-control\"/>
\t\t<label class=\"form-label\">";
        // line 54
        echo ($context["entry_partner_code"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<div id=\"container-partner_secret\" class=\"mt-3";
        // line 57
        if ((($context["grant_type"] ?? null) == "password")) {
            echo " d-none";
        }
        echo "\">
\t  <div class=\"form-outline\">
\t\t<input type=\"text\" name=\"partner_secret\" value=\"";
        // line 59
        echo ($context["partner_secret"] ?? null);
        echo "\" class=\"form-control\"/>
\t\t<label class=\"form-label\">";
        // line 60
        echo ($context["entry_partner_secret"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<button type=\"submit\" class=\"btn btn-primary ps-5 pe-5 mt-3 mb-3\"><i class=\"fa fa-save me-2\"></i>";
        // line 63
        echo ($context["button_save"] ?? null);
        echo "</button>
  </form>
</div>
</main>
<script>
\$('#select-grant_type').change(function(event) {
  if (event.target.value === 'partner') {
\t\$('#container-password').addClass('d-none');
\t\$('#container-partner_code').removeClass('d-none');
\t\$('#container-partner_secret').removeClass('d-none');
  } else {
\t\$('#container-password').removeClass('d-none');
\t\$('#container-partner_code').addClass('d-none');
\t\$('#container-partner_secret').addClass('d-none');
  }
});
</script>
";
        // line 80
        echo ($context["footer"] ?? null);
        echo " 
";
    }

    public function getTemplateName()
    {
        return "view/template/integration/autovit_authorization.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  219 => 80,  199 => 63,  193 => 60,  189 => 59,  182 => 57,  176 => 54,  172 => 53,  165 => 51,  159 => 48,  155 => 47,  148 => 45,  142 => 42,  138 => 41,  131 => 37,  122 => 35,  114 => 34,  106 => 29,  102 => 28,  94 => 23,  90 => 22,  83 => 19,  75 => 15,  72 => 14,  64 => 10,  62 => 9,  55 => 7,  49 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/integration/autovit_authorization.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/integration/autovit_authorization.twig");
    }
}
