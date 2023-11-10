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

/* view/template/admin/pieseauto_categories.twig */
class __TwigTemplate_337f07ab61024fb31b39fddab843c682b37b26fafe87546b277ea44c589ceb34 extends Template
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
\t  <select class=\"select\" data-mdb-filter=\"true\" name=\"";
            // line 17
            echo twig_get_attribute($this->env, $this->source, $context["product_category"], "category_id", [], "any", false, false, false, 17);
            echo "\" class=\"form-control\">
\t\t<option value=\"0\">";
            // line 18
            echo ($context["text_select"] ?? null);
            echo "</option>
\t    ";
            // line 19
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["pieseauto_categories"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["pieseauto_category"]) {
                // line 20
                echo "\t\t<option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["pieseauto_category"], "pieseauto_category_id", [], "any", false, false, false, 20);
                echo "\"";
                if ((twig_get_attribute($this->env, $this->source, $context["pieseauto_category"], "pieseauto_category_id", [], "any", false, false, false, 20) == (($__internal_compile_0 = ($context["product_category_2_pieseauto_category"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["product_category"], "category_id", [], "any", false, false, false, 20)] ?? null) : null))) {
                    echo " selected";
                }
                echo ">";
                echo twig_get_attribute($this->env, $this->source, $context["pieseauto_category"], "pieseauto_category", [], "any", false, false, false, 20);
                echo "</option>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pieseauto_category'], $context['_parent'], $context['loop']);
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
        echo "index.php?route=admin/onlineshop/pieseauto.write&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&product_category=' +  encodeURIComponent(e.target.name) + '&pieseauto_category_id=' +  encodeURIComponent(e.target.value)
  });
});
</script>";
    }

    public function getTemplateName()
    {
        return "view/template/admin/pieseauto_categories.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  134 => 36,  127 => 32,  120 => 28,  116 => 27,  113 => 26,  104 => 23,  101 => 22,  86 => 20,  82 => 19,  78 => 18,  74 => 17,  71 => 16,  66 => 15,  58 => 11,  55 => 10,  47 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/admin/pieseauto_categories.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/admin/pieseauto_categories.twig");
    }
}
