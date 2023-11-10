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

/* view/template/admin/vehicle_gb_speed_level.twig */
class __TwigTemplate_39f1b53bfbdb21cc450f09b1d810824fbe61117e404b0e536080fe9c2985fbae extends Template
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
        echo "\t<div class=\"form-outline mb-2\">
\t  <input type=\"number\" name=\"gb_speed_level_text\" id=\"gb_speed_level\" class=\"form-control\" />
\t  <label class=\"form-label\" for=\"gb_speed_level\">";
        // line 17
        echo ($context["text_gb_speed_level"] ?? null);
        echo "</label>
\t</div>
\t<div class=\"text-end\"><button type=\"button\" id=\"add\" class=\"btn btn-primary\"><i class=\"fas fa-plus me-2\"></i>";
        // line 19
        echo ($context["button_add"] ?? null);
        echo "</button></div>
\t<div id=\"gb_speed_levels\" class=\"mt-3\">
\t  ";
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["vehicle_gb_speed_levels"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["gb_speed_level"]) {
            // line 22
            echo "\t  <div class=\"chip me-0\">";
            echo twig_get_attribute($this->env, $this->source, $context["gb_speed_level"], "text", [], "any", false, false, false, 22);
            echo "<i id=\"";
            echo twig_get_attribute($this->env, $this->source, $context["gb_speed_level"], "vehicle_gb_speed_level_id", [], "any", false, false, false, 22);
            echo "\" class=\"close fas fa-times\"></i></div>
\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['gb_speed_level'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        echo "\t</div>
  </div>
</main>
<script>
closeInit();

\$('#add').click(function() {
  let data = {};
  data.gb_speed_level_text = \$('#gb_speed_level').val();
  
  \$.ajax({  
\turl: '";
        // line 35
        echo ($context["server"] ?? null);
        echo "index.php?route=admin/vehicle/gb_speed_level.add&user_token=";
        echo ($context["user_token"] ?? null);
        echo "',
\tmethod: 'POST',
\tdata: data,
\tdataType: 'json'
  }).done(function(json) {
    if(json['gb_speed_level_id'] !== undefined) {
\t  \$('#gb_speed_levels').append('<div class=\"chip me-0\">'+json['text']+'<i id=\"'+json['gb_speed_level_id']+'\" class=\"close fas fa-times\"></i></div>');
\t  \$('#gb_speed_level').val('');
\t  closeInit();
\t}
  });
});


function closeInit() {
  \$('.close').click(function(e) {
\t\$.ajax({
\t  url: '";
        // line 52
        echo ($context["server"] ?? null);
        echo "index.php?route=admin/vehicle/gb_speed_level.remove&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&gb_speed_level_id=' + encodeURIComponent(e.target.id),
\t});
\t
\te.target.parentElement.remove();
  });
}
</script>
";
        // line 59
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "view/template/admin/vehicle_gb_speed_level.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  142 => 59,  130 => 52,  108 => 35,  95 => 24,  84 => 22,  80 => 21,  75 => 19,  70 => 17,  66 => 15,  58 => 11,  55 => 10,  47 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/admin/vehicle_gb_speed_level.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/admin/vehicle_gb_speed_level.twig");
    }
}
