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

/* view/template/catalog/vehicle_brand_list.twig */
class __TwigTemplate_13e00feff3b09e95cd7424076317b6d6b404144655031a90df157fbd74df5c1f extends Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["vehicle_brands"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["vehicle_brand"]) {
            // line 6
            echo "\t<label class=\"d-flex vehicle_brand cursor-pointer p-1\">
\t  <div class=\"flex-fill\">";
            // line 7
            echo twig_get_attribute($this->env, $this->source, $context["vehicle_brand"], "name", [], "any", false, false, false, 7);
            echo "</div>
\t  <div><input class=\"form-check-input vehicle_brand-check\" type=\"checkbox\" id=\"";
            // line 8
            echo twig_get_attribute($this->env, $this->source, $context["vehicle_brand"], "id", [], "any", false, false, false, 8);
            echo "\" value=\"1\" ";
            if ((($__internal_compile_0 = ($context["user_vehicle_brands"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["vehicle_brand"], "id", [], "any", false, false, false, 8)] ?? null) : null)) {
                echo "checked";
            }
            echo " /></div>
\t</label>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['vehicle_brand'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "\t<div class=\"row mt-3\">
\t  <div class=\"col-sm-6 text-start\">";
        // line 12
        echo ($context["pagination"] ?? null);
        echo "</div>
\t  <div class=\"col-sm-6 text-end\">";
        // line 13
        echo ($context["results"] ?? null);
        echo "</div>
\t</div>
  </div>
</main>
";
        // line 17
        echo ($context["footer"] ?? null);
        echo "
<script>
\$('.vehicle_brand-check').change(function(e) {
  let url = '';
  
  if(e.currentTarget.checked) {
\turl += '";
        // line 23
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/vehicle_brand.enableVehicleBrand&user_token=";
        echo ($context["user_token"] ?? null);
        echo "';
  } else {
    url += '";
        // line 25
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/vehicle_brand.disableVehicleBrand&user_token=";
        echo ($context["user_token"] ?? null);
        echo "';
  }
  
  url += '&vehicle_brand_id=' + e.currentTarget.id;
  
  \$.ajax({
\turl: url
  });
});
</script>
<style>
.vehicle_brand {
  cursor: pointer;
}
.vehicle_brand:hover {
  background-color: rgb(0, 0, 0, 0.05);
}
</style>";
    }

    public function getTemplateName()
    {
        return "view/template/catalog/vehicle_brand_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 25,  92 => 23,  83 => 17,  76 => 13,  72 => 12,  69 => 11,  56 => 8,  52 => 7,  49 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/catalog/vehicle_brand_list.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/catalog/vehicle_brand_list.twig");
    }
}
