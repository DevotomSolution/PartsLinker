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

/* view/template/admin/category_list.twig */
class __TwigTemplate_3cb0f0a7a000ba5b5e8708ea62357ff18701f96ecd377ae70c43f4d167d7ec76 extends Template
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
<!--Main layout-->
<main style=\"margin-top: 58px\" class=\"pt-3\">
  <div class=\"container-fluid\">
\t";
        // line 5
        if (($context["success"] ?? null)) {
            // line 6
            echo "\t  <div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"success\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
\t\t<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button>
\t  </div>
\t";
        }
        // line 10
        echo "\t<div class=\"d-flex flex-wrap align-items-center\">
\t  <div class=\"flex-fill d-flex align-items-center\">
\t\t<div class=\"flex-fill d-none d-md-block position-relative me-3\">
\t\t  <div id=\"search\" class=\"form-outline\">
\t\t\t<input type=\"text\" name=\"search\" value=\"";
        // line 14
        echo ($context["search"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t<label class=\"form-label\">";
        // line 15
        echo ($context["text_search"] ?? null);
        echo "</label>
\t\t  </div>
\t\t  <button type=\"button\" id=\"btn-search\" class=\"btn btn-outline-primary fs-7 border-0 position-absolute ps-3 pe-3 h-100\" style=\"top: 0; right: 0;\" data-mdb-color=\"dark\"><i class=\"fas fa-search\"></i></button>
\t\t</div>
\t  </div>
\t  <div><a href=\"";
        // line 20
        echo ($context["add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fas fa-plus\"></i><span class=\"ms-2\">";
        echo ($context["button_add"] ?? null);
        echo "</span></a></div>
\t</div>
\t<div class=\"mt-3\">
\t  <table class=\"table table-sm\">
\t  ";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 25
            echo "\t\t<tr>
\t\t  <td><a href=\"";
            // line 26
            echo twig_get_attribute($this->env, $this->source, $context["category"], "edit", [], "any", false, false, false, 26);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["category"], "path", [], "any", false, false, false, 26);
            echo "<i class=\"fas fa-pen ms-3\"></i></a></td>
\t\t  <td class=\"text-end\"><button type=\"button\" class=\"btn btn-danger btn-sm btn-delete\" data-category_id=\"";
            // line 27
            echo twig_get_attribute($this->env, $this->source, $context["category"], "category_id", [], "any", false, false, false, 27);
            echo "\"><i class=\"fas fa-trash\"></i></button></td>
\t\t</tr>
\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "\t  </table>
\t</div>
\t<div class=\"row mt-3\">
\t  <div class=\"col-sm-6 text-start\">";
        // line 33
        echo ($context["pagination"] ?? null);
        echo "</div>
\t  <div class=\"col-sm-6 text-end\">";
        // line 34
        echo ($context["results"] ?? null);
        echo "</div>
\t</div>
  </div>
</main>
<script>
\$('.btn-delete').click(function(e) {
  let data = {};
  data.category_id = e.currentTarget.getAttribute('data-category_id');
  
  answear = confirm('";
        // line 43
        echo ($context["text_confirm_delete"] ?? null);
        echo "');
  
  if (!answear) {
    return;
  }

  \$.ajax({
\turl: '";
        // line 50
        echo ($context["server"] ?? null);
        echo "index.php?route=admin/tool/category.delete&user_token=";
        echo ($context["user_token"] ?? null);
        echo "',
\tmethod: 'POST',
\tdata: data,
\tdataType: 'json',
  }).done(function(json) {
    location.reload();
  });
});

\$('#btn-search').on('click', function() {
  let url = '';

  let search = \$('input[name=\\'search\\']').val();

  if (search) {
\turl += '&search=' + encodeURIComponent(search);
  }
\t
  location = '";
        // line 68
        echo ($context["action"] ?? null);
        echo "' + url;
});

\$('input[name=\\'search\\']').keydown(function(e) {
  if(e.keyCode == 13) {
\t\$('#btn-search').trigger('click');
  }
});
</script>
";
        // line 77
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "view/template/admin/category_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 77,  158 => 68,  135 => 50,  125 => 43,  113 => 34,  109 => 33,  104 => 30,  95 => 27,  89 => 26,  86 => 25,  82 => 24,  73 => 20,  65 => 15,  61 => 14,  55 => 10,  47 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/admin/category_list.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/admin/category_list.twig");
    }
}
