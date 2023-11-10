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

/* view/template/admin/vehicle_drive.twig */
class __TwigTemplate_51de5ee8679890b31a05e92061017aa1a51d615036bd5c30e09e5d6c1455865a extends Template
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
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 16
            echo "\t<div class=\"form-outline mb-2\">
\t  <img src=\"";
            // line 17
            echo ($context["server"] ?? null);
            echo "language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 17);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 17);
            echo ".png\" class=\"trailing\"/>
\t  <input type=\"text\" name=\"drive_description[";
            // line 18
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 18);
            echo "]\" id=\"drive_description-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 18);
            echo "\" class=\"form-control\" />
\t  <label class=\"form-label\" for=\"rive_description-";
            // line 19
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 19);
            echo "\">";
            echo ($context["text_drive"] ?? null);
            echo "</label>
\t</div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        echo "\t<div class=\"text-end\"><button type=\"button\" id=\"add\" class=\"btn btn-primary\"><i class=\"fas fa-plus me-2\"></i>";
        echo ($context["button_add"] ?? null);
        echo "</button></div>
\t<div id=\"drives\" class=\"mt-3\">
\t  ";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["vehicle_drives"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["drive"]) {
            // line 25
            echo "\t  <div class=\"chip me-0\">";
            echo twig_get_attribute($this->env, $this->source, $context["drive"], "text", [], "any", false, false, false, 25);
            echo "<i id=\"";
            echo twig_get_attribute($this->env, $this->source, $context["drive"], "vehicle_drive_id", [], "any", false, false, false, 25);
            echo "\" class=\"close fas fa-times\"></i></div>
\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['drive'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "\t</div>
  </div>
</main>
<script>
closeInit();

\$('#add').click(function() {
  let data = {drive_description: {}};

  ";
        // line 36
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 37
            echo "  data.drive_description[";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 37);
            echo "] = \$('#drive_description-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 37);
            echo "').val();
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "
  \$.ajax({  
\turl: '";
        // line 41
        echo ($context["server"] ?? null);
        echo "index.php?route=admin/vehicle/drive.add&user_token=";
        echo ($context["user_token"] ?? null);
        echo "',
\tmethod: 'POST',
\tdata: data,
\tdataType: 'json'
  }).done(function(json) {
    if(json['drive_id'] !== undefined) {
\t  \$('#drives').append('<div class=\"chip me-0\">'+json['text']+'<i id=\"'+json['drive_id']+'\" class=\"close fas fa-times\"></i></div>');
\t  
\t  ";
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 50
            echo "\t  \$('#drive_description-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 50);
            echo "').val('');
\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "\t}
\t
\tcloseInit();
  });
});

function closeInit() {
  \$('.close').click(function(e) {
\t\$.ajax({
\t  url: '";
        // line 61
        echo ($context["server"] ?? null);
        echo "index.php?route=admin/vehicle/drive.remove&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&drive_id=' + encodeURIComponent(e.target.id),
\t});
\t
\te.target.parentElement.remove();
  });
}
</script>
";
        // line 68
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "view/template/admin/vehicle_drive.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  199 => 68,  187 => 61,  176 => 52,  167 => 50,  163 => 49,  150 => 41,  146 => 39,  135 => 37,  131 => 36,  120 => 27,  109 => 25,  105 => 24,  99 => 22,  88 => 19,  82 => 18,  74 => 17,  71 => 16,  66 => 15,  58 => 11,  55 => 10,  47 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/admin/vehicle_drive.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/admin/vehicle_drive.twig");
    }
}
