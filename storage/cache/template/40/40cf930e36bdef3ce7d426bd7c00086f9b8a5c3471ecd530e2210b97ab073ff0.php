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

/* view/template/admin/autovit_types.twig */
class __TwigTemplate_446abb63de7c1eeb71fa6d33646e280e4ec40b3ee4da82171e2d914eef42883e extends Template
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
        if (($context["error_warning"] ?? null)) {
            // line 6
            echo "\t  <div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
\t\t<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button>
\t  </div>
\t";
        }
        // line 10
        echo "\t";
        if (($context["success"] ?? null)) {
            // line 11
            echo "\t  <div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"success\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
\t\t<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button>
\t  </div>
\t";
        }
        // line 15
        echo "\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["product_categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product_category"]) {
            // line 16
            echo "\t<div class=\"mt-3\">
\t  <select class=\"select\" name=\"";
            // line 17
            echo twig_get_attribute($this->env, $this->source, $context["product_category"], "category_id", [], "any", false, false, false, 17);
            echo "\" class=\"form-control\">
\t\t<option value=\"\"></option>
\t    ";
            // line 19
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["autovit_types"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["autovit_type"]) {
                // line 20
                echo "\t\t<option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["autovit_type"], "code", [], "any", false, false, false, 20);
                echo "\"";
                if ((twig_get_attribute($this->env, $this->source, $context["autovit_type"], "code", [], "any", false, false, false, 20) == (($__internal_compile_0 = ($context["product_category_2_autovit_type"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["product_category"], "category_id", [], "any", false, false, false, 20)] ?? null) : null))) {
                    echo " selected";
                }
                echo ">";
                echo twig_get_attribute($this->env, $this->source, $context["autovit_type"], "name", [], "any", false, false, false, 20);
                echo "</option>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['autovit_type'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            echo "\t  </select>
\t  <label class=\"form-label select-label\">";
            // line 23
            echo twig_get_attribute($this->env, $this->source, $context["product_category"], "path", [], "any", false, false, false, 23);
            echo "</label>
\t</div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "\t<div class=\"row mt-3\">
\t  <div class=\"col-sm-6 text-start\">";
        // line 27
        echo ($context["pagination"] ?? null);
        echo "</div>
\t  <div class=\"col-sm-6 text-end\">";
        // line 28
        echo ($context["results"] ?? null);
        echo "</div>
\t</div>
  </div>
</main>
";
        // line 32
        echo ($context["footer"] ?? null);
        echo "
<script>
\$('select').change(function(e) {
  \$.ajax({
\turl: '";
        // line 36
        echo ($context["server"] ?? null);
        echo "index.php?route=admin/onlineshop/autovit.write&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&product_category=' +  encodeURIComponent(e.target.name) + '&autovit_type_code=' +  encodeURIComponent(e.target.value)
  });
});
</script>";
    }

    public function getTemplateName()
    {
        return "view/template/admin/autovit_types.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  131 => 36,  124 => 32,  117 => 28,  113 => 27,  110 => 26,  101 => 23,  98 => 22,  83 => 20,  79 => 19,  74 => 17,  71 => 16,  66 => 15,  58 => 11,  55 => 10,  47 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/admin/autovit_types.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/admin/autovit_types.twig");
    }
}
