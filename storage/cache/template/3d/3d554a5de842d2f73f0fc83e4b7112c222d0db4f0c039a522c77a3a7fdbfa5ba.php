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

/* view/template/integration/pieseauto.twig */
class __TwigTemplate_bfc67364f125fa585ce87e185400772b8f538c360bd9cdf28f35e97a18f52807 extends Template
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
  ";
        // line 4
        if (($context["error_warning"] ?? null)) {
            // line 5
            echo "\t<div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
\t  <button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button>
\t</div>
  ";
        }
        // line 9
        echo "  ";
        if (($context["success"] ?? null)) {
            // line 10
            echo "\t<div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"success\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
\t  <button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button>
\t</div>
  ";
        }
        // line 14
        echo "  <form method=\"POST\" action=\"";
        echo ($context["action"] ?? null);
        echo "\">
\t<input type=\"hidden\" name=\"secret\" value=\"";
        // line 15
        echo ($context["secret"] ?? null);
        echo "\" />
\t<div class=\"mt-3 d-flex align-items-center\">
\t  <div class=\"form-outline flex-fill me-2\">
\t\t<input type=\"text\" id=\"url\" name=\"url\" value=\"";
        // line 18
        echo ($context["url"] ?? null);
        echo "\" class=\"form-control\" readonly/>
\t\t<label class=\"form-label\">";
        // line 19
        echo ($context["text_url"] ?? null);
        echo "</label>
\t  </div>
\t  <button type=\"button\" class=\"btn btn-primary btn-sm btn-floating\" onclick=\"copy(this);\"><i class=\"fas fa-copy\"></i></button>
\t</div>
\t<div class=\"mt-3\">
\t  <div class=\"form-outline\">
\t\t<input type=\"text\" name=\"auth_code\" value=\"";
        // line 25
        echo ($context["auth_code"] ?? null);
        echo "\" class=\"form-control\"/>
\t\t<label class=\"form-label\">";
        // line 26
        echo ($context["entry_auth_code"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<div class=\"d-flex align-items-center mt-3\">
\t\t<span class=\"me-2\">+</span>
\t\t<div class=\"form-outline flex-fill\">
\t\t  <input type=\"number\" id=\"input-price_percent\" name=\"price_percent\" value=\"";
        // line 32
        echo ($context["price_percent"] ?? null);
        echo "\" class=\"form-control\" />
\t\t  <label class=\"form-label\" for=\"input-price_percent\">";
        // line 33
        echo ($context["entry_price_percent"] ?? null);
        echo "</label>
\t\t</div>
\t\t<span class=\"ms-2\">%</span>
\t</div>
\t<div class=\"d-flex align-items-center mt-3\">
\t\t<span class=\"me-2\">+</span>
\t\t";
        // line 39
        if (twig_get_attribute($this->env, $this->source, ($context["currency"] ?? null), "symbol_left", [], "any", false, false, false, 39)) {
            echo "<span class=\"me-2\">";
            echo twig_get_attribute($this->env, $this->source, ($context["currency"] ?? null), "symbol_left", [], "any", false, false, false, 39);
            echo "</span>";
        }
        // line 40
        echo "\t\t<div class=\"form-outline flex-fill\">
\t\t  <input type=\"number\" step=\"0.01\" id=\"input-transport_price_fixed\" name=\"transport_price_fixed\" value=\"";
        // line 41
        echo ($context["transport_price_fixed"] ?? null);
        echo "\" class=\"form-control\" />
\t\t  <label class=\"form-label\" for=\"input-transport_price_fixed\">";
        // line 42
        echo ($context["entry_transport_price_fixed"] ?? null);
        echo "</label>
\t\t</div>
\t\t";
        // line 44
        if (twig_get_attribute($this->env, $this->source, ($context["currency"] ?? null), "symbol_right", [], "any", false, false, false, 44)) {
            echo "<span class=\"ms-2\">";
            echo twig_get_attribute($this->env, $this->source, ($context["currency"] ?? null), "symbol_right", [], "any", false, false, false, 44);
            echo "</span>";
        }
        // line 45
        echo "\t</div>
\t<div class=\"row\">
\t\t<div class=\"col-12 col-lg-2 mt-3\">";
        // line 47
        echo ($context["text_price_by_weight"] ?? null);
        echo "</div>
\t\t<div id=\"container-transport_price_by_weight\" class=\"col-12 col-lg-10\">
\t\t  ";
        // line 49
        $context["i"] = 0;
        // line 50
        echo "\t\t  ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["transport_price_by_weight"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["price"]) {
            // line 51
            echo "\t\t  <div class=\"d-flex mt-3\">
\t\t    <div class=\"d-flex flex-fill align-items-center\">
\t\t\t\t<div class=\"form-outline flex-fill\">
\t\t\t\t  <input type=\"number\" step=\"0.001\" name=\"transport_price_by_weight[";
            // line 54
            echo ($context["i"] ?? null);
            echo "][weight_from]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["price"], "weight_from", [], "any", false, false, false, 54);
            echo "\" class=\"form-control\" />
\t\t\t\t  <label class=\"form-label\">";
            // line 55
            echo ($context["entry_from"] ?? null);
            echo "</label>
\t\t\t\t</div>
\t\t\t\t<span class=\"ms-2 me-2\">";
            // line 57
            echo ($context["text_kg"] ?? null);
            echo "</span>
\t\t\t</div>
\t\t\t<div class=\"d-flex flex-fill align-items-center\">
\t\t\t\t<div class=\"form-outline flex-fill\">
\t\t\t\t  <input type=\"number\" step=\"0.001\" name=\"transport_price_by_weight[";
            // line 61
            echo ($context["i"] ?? null);
            echo "][weight_to]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["price"], "weight_to", [], "any", false, false, false, 61);
            echo "\" class=\"form-control\" />
\t\t\t\t  <label class=\"form-label\">";
            // line 62
            echo ($context["entry_to"] ?? null);
            echo "</label>
\t\t\t\t</div>
\t\t\t\t<span class=\"ms-2 me-2\">";
            // line 64
            echo ($context["text_kg"] ?? null);
            echo "</span>
\t\t\t</div>
\t\t\t<div class=\"d-flex flex-fill align-items-center\">
\t\t\t\t";
            // line 67
            if (twig_get_attribute($this->env, $this->source, ($context["currency"] ?? null), "symbol_left", [], "any", false, false, false, 67)) {
                echo "<span class=\"ms-2 me-2\">";
                echo twig_get_attribute($this->env, $this->source, ($context["currency"] ?? null), "symbol_left", [], "any", false, false, false, 67);
                echo "</span>";
            }
            // line 68
            echo "\t\t\t\t<div class=\"form-outline flex-fill\">
\t\t\t\t  <input type=\"number\" step=\"0.01\" name=\"transport_price_by_weight[";
            // line 69
            echo ($context["i"] ?? null);
            echo "][price]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["price"], "price", [], "any", false, false, false, 69);
            echo "\" class=\"form-control\" />
\t\t\t\t  <label class=\"form-label\">";
            // line 70
            echo ($context["entry_price"] ?? null);
            echo "</label>
\t\t\t\t</div>
\t\t\t\t";
            // line 72
            if (twig_get_attribute($this->env, $this->source, ($context["currency"] ?? null), "symbol_right", [], "any", false, false, false, 72)) {
                echo "<span class=\"ms-2 me-2\">";
                echo twig_get_attribute($this->env, $this->source, ($context["currency"] ?? null), "symbol_right", [], "any", false, false, false, 72);
                echo "</span>";
            }
            // line 73
            echo "\t\t\t</div>
\t\t\t<div class=\"d-flex align-items-center delete\">
\t\t\t\t<button type=\"button\" class=\"btn btn-link text-danger\"><i class=\"fas fa-times\"></i></button>
\t\t\t</div>
\t\t  </div>
\t\t  ";
            // line 78
            $context["i"] = (($context["i"] ?? null) + 1);
            // line 79
            echo "\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['price'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 80
        echo "\t\t  
\t\t  ";
        // line 81
        if ((($context["transport_price_by_weight"] ?? null) == 0)) {
            // line 82
            echo "\t\t  <div class=\"d-flex mt-3\">
\t\t    <div class=\"d-flex flex-fill align-items-center\">
\t\t\t\t<div class=\"form-outline flex-fill\">
\t\t\t\t  <input type=\"number\" step=\"0.001\" name=\"transport_price_by_weight[0][weight_from]\" value=\"\" class=\"form-control\" />
\t\t\t\t  <label class=\"form-label\">";
            // line 86
            echo ($context["entry_from"] ?? null);
            echo "</label>
\t\t\t\t</div>
\t\t\t\t<span class=\"ms-2 me-2\">";
            // line 88
            echo ($context["text_kg"] ?? null);
            echo "</span>
\t\t\t</div>
\t\t\t<div class=\"d-flex flex-fill align-items-center\">
\t\t\t\t<div class=\"form-outline flex-fill\">
\t\t\t\t  <input type=\"number\" step=\"0.001\" name=\"transport_price_by_weight[0][weight_to]\" value=\"\" class=\"form-control\" />
\t\t\t\t  <label class=\"form-label\">";
            // line 93
            echo ($context["entry_to"] ?? null);
            echo "</label>
\t\t\t\t</div>
\t\t\t\t<span class=\"ms-2 me-2\">";
            // line 95
            echo ($context["text_kg"] ?? null);
            echo "</span>
\t\t\t</div>
\t\t\t<div class=\"d-flex flex-fill align-items-center\">
\t\t\t\t";
            // line 98
            if (twig_get_attribute($this->env, $this->source, ($context["currency"] ?? null), "symbol_left", [], "any", false, false, false, 98)) {
                echo "<span class=\"ms-2 me-2\">";
                echo twig_get_attribute($this->env, $this->source, ($context["currency"] ?? null), "symbol_left", [], "any", false, false, false, 98);
                echo "</span>";
            }
            // line 99
            echo "\t\t\t\t<div class=\"form-outline flex-fill\">
\t\t\t\t  <input type=\"number\" step=\"0.01\" name=\"transport_price_by_weight[0][price]\" value=\"\" class=\"form-control\" />
\t\t\t\t  <label class=\"form-label\">";
            // line 101
            echo ($context["entry_price"] ?? null);
            echo "</label>
\t\t\t\t</div>
\t\t\t\t";
            // line 103
            if (twig_get_attribute($this->env, $this->source, ($context["currency"] ?? null), "symbol_right", [], "any", false, false, false, 103)) {
                echo "<span class=\"ms-2 me-2\">";
                echo twig_get_attribute($this->env, $this->source, ($context["currency"] ?? null), "symbol_right", [], "any", false, false, false, 103);
                echo "</span>";
            }
            // line 104
            echo "\t\t\t</div>
\t\t\t<div class=\"d-flex align-items-center delete\">
\t\t\t\t<button type=\"button\" class=\"btn btn-link text-danger\"><i class=\"fas fa-times\"></i></button>
\t\t\t</div>
\t\t  </div>
\t\t  ";
            // line 109
            $context["i"] = 1;
            // line 110
            echo "\t\t  ";
        }
        // line 111
        echo "\t\t  <div class=\"text-end mt-3\"><button type=\"button\" id=\"weight-add\" class=\"btn btn-secondary\"><i class=\"fa fa-plus me-2\"></i>";
        echo ($context["button_add"] ?? null);
        echo "</button></div>
\t\t</div>
\t</div>
\t<div class=\"mt-3\">
\t  <textarea id=\"input-general_description\" name=\"general_description\">";
        // line 115
        echo ($context["general_description"] ?? null);
        echo "</textarea>
\t</div>
\t<button type=\"submit\" class=\"btn btn-primary ps-5 pe-5 mt-3 mb-3\"><i class=\"fa fa-save me-2\"></i>";
        // line 117
        echo ($context["button_save"] ?? null);
        echo "</button>
  </form>
</div>
</main>
<script>
\$(document).ready(function() {
 \$('#input-general_description').summernote({
\theight: 175,
\ttoolbar: false,
\tdisableDragAndDrop: true,
\ttabDisable: true,
\tplaceholder: '";
        // line 128
        echo ($context["entry_general_description"] ?? null);
        echo "',
\tcallbacks: {
\t  onPaste: function(e) {
\t\tvar bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
\t\te.preventDefault();
\t\tsetTimeout( function(){
\t\t  document.execCommand( 'insertText', false, bufferText );
\t\t}, 10 );
\t  }
\t}
  });
});

let i = ";
        // line 141
        echo ($context["i"] ?? null);
        echo ";

\$('#weight-add').click(function() {
  let html = '';
\thtml += '<div class=\"d-flex mt-3\">';
\t\thtml += '<div class=\"d-flex flex-fill align-items-center\">';
\t\t\thtml += '<div class=\"form-outline flex-fill\">';
\t\t\t\thtml += '<input type=\"number\" step=\"0.001\" name=\"transport_price_by_weight['+i+'][weight_from]\" value=\"\" class=\"form-control\" />';
\t\t\t\thtml += '<label class=\"form-label\">";
        // line 149
        echo ($context["entry_from"] ?? null);
        echo "</label>';
\t\t\thtml += '</div>';
\t\t\thtml += '<span class=\"ms-2 me-2\">";
        // line 151
        echo ($context["text_kg"] ?? null);
        echo "</span>';
\t\thtml += '</div>';
\t\thtml += '<div class=\"d-flex flex-fill align-items-center\">';
\t\t\thtml += '<div class=\"form-outline flex-fill\">';
\t\t\t\thtml += '<input type=\"number\" step=\"0.001\" name=\"transport_price_by_weight['+i+'][weight_to]\" value=\"\" class=\"form-control\" />';
\t\t\t\thtml += '<label class=\"form-label\">";
        // line 156
        echo ($context["entry_to"] ?? null);
        echo "</label>';
\t\t\thtml += '</div>';
\t\t\thtml += '<span class=\"ms-2 me-2\">";
        // line 158
        echo ($context["text_kg"] ?? null);
        echo "</span>';
\t\thtml += '</div>';
\t\thtml += '<div class=\"d-flex flex-fill align-items-center\">';
\t\t\thtml += '";
        // line 161
        if (twig_get_attribute($this->env, $this->source, ($context["currency"] ?? null), "symbol_left", [], "any", false, false, false, 161)) {
            echo "<span class=\"ms-2 me-2\">";
            echo twig_get_attribute($this->env, $this->source, ($context["currency"] ?? null), "symbol_left", [], "any", false, false, false, 161);
            echo "</span>";
        }
        echo "';
\t\t\thtml += '<div class=\"form-outline flex-fill\">';
\t\t\t\thtml += '<input type=\"number\" step=\"0.01\" name=\"transport_price_by_weight['+i+'][price]\" value=\"\" class=\"form-control\" />';
\t\t\t\thtml += '<label class=\"form-label\">";
        // line 164
        echo ($context["entry_price"] ?? null);
        echo "</label>';
\t\t\thtml += '</div>';
\t\t\thtml += '";
        // line 166
        if (twig_get_attribute($this->env, $this->source, ($context["currency"] ?? null), "symbol_right", [], "any", false, false, false, 166)) {
            echo "<span class=\"ms-2 me-2\">";
            echo twig_get_attribute($this->env, $this->source, ($context["currency"] ?? null), "symbol_right", [], "any", false, false, false, 166);
            echo "</span>";
        }
        echo "';
\t\thtml += '</div>';
\t\thtml += '<div class=\"d-flex align-items-center delete\">';
\t\t\thtml += '<button type=\"button\" class=\"btn btn-link text-danger\"><i class=\"fas fa-times\"></i></button>';
\t\thtml += '</div>';
\thtml += '</div>';
\t
  \$('#weight-add').parent().before(html);
  i++;
  
  document.querySelectorAll('.form-outline').forEach((formOutline) => {
\tnew mdb.Input(formOutline).init();
  });
});

\$('#container-transport_price_by_weight').delegate('.delete', 'click', function() {
  \$(this).parent().remove();
});

function copy(e) {
  e.innerHTML = \"<i class='fas fa-check'></i>\";
\t
  let el = document.getElementById('url');
  el.select();
  document.execCommand('copy');
}
</script>
";
        // line 193
        echo ($context["footer"] ?? null);
        echo " 
";
    }

    public function getTemplateName()
    {
        return "view/template/integration/pieseauto.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  431 => 193,  397 => 166,  392 => 164,  382 => 161,  376 => 158,  371 => 156,  363 => 151,  358 => 149,  347 => 141,  331 => 128,  317 => 117,  312 => 115,  304 => 111,  301 => 110,  299 => 109,  292 => 104,  286 => 103,  281 => 101,  277 => 99,  271 => 98,  265 => 95,  260 => 93,  252 => 88,  247 => 86,  241 => 82,  239 => 81,  236 => 80,  230 => 79,  228 => 78,  221 => 73,  215 => 72,  210 => 70,  204 => 69,  201 => 68,  195 => 67,  189 => 64,  184 => 62,  178 => 61,  171 => 57,  166 => 55,  160 => 54,  155 => 51,  150 => 50,  148 => 49,  143 => 47,  139 => 45,  133 => 44,  128 => 42,  124 => 41,  121 => 40,  115 => 39,  106 => 33,  102 => 32,  93 => 26,  89 => 25,  80 => 19,  76 => 18,  70 => 15,  65 => 14,  57 => 10,  54 => 9,  46 => 5,  44 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/integration/pieseauto.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/integration/pieseauto.twig");
    }
}
