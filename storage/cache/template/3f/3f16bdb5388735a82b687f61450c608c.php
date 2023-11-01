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

/* view/template/account/setting.twig */
class __TwigTemplate_ca4825868345cb7a310ac858d280bb1d extends Template
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
    <span class=\"btn btn-link text-dark\" data-mdb-ripple-color=\"dark\"><i class=\"fas fa-user me-2\"></i>";
        // line 5
        echo ($context["text_account"] ?? null);
        echo "</span>
    <a href=\"";
        // line 6
        echo ($context["warehouse"] ?? null);
        echo "\" class=\"btn btn-link \" data-mdb-ripple-color=\"dark\"><i class=\"fas fa-warehouse me-2\"></i>";
        echo ($context["text_warehouse"] ?? null);
        echo "</a>
    <a href=\"";
        // line 7
        echo ($context["invoice"] ?? null);
        echo "\" class=\"btn btn-link \" data-mdb-ripple-color=\"dark\"><i class=\"fas fa-file-lines me-2\"></i>";
        echo ($context["text_invoice"] ?? null);
        echo "</a>
\t<a href=\"";
        // line 8
        echo ($context["password"] ?? null);
        echo "\" class=\"btn btn-link\" data-mdb-ripple-color=\"dark\"><i class=\"fas fa-key me-2\"></i>";
        echo ($context["text_password"] ?? null);
        echo "</a>
  </div>
  ";
        // line 10
        if (($context["error_warning"] ?? null)) {
            // line 11
            echo "  <div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"danger\"><i class=\"fa fa-exclamation-circle me-2\"></i>";
            echo ($context["error_warning"] ?? null);
            echo "<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button></div>
  ";
        }
        // line 13
        echo "  ";
        if (($context["success"] ?? null)) {
            // line 14
            echo "  <div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"success\"><i class=\"fa fa-exclamation-circle me-2\"></i>";
            echo ($context["success"] ?? null);
            echo "<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button></div>
  ";
        }
        // line 16
        echo "\t<form action=\"";
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-setting\" class=\"form-horizontal mb-3\">
\t  <div id=\"preview-logo\" onclick=\"fileExplorer();\" class=\"border rounded overflow-hidden d-inline-block\" style=\"height: 120px;\"><img src=\"";
        // line 17
        echo ($context["logo_preview"] ?? null);
        echo "\" class=\"h-100\" /></div>
\t  <input type=\"file\" class=\"d-none\" accept=\"image/png,image/jpeg,image/jpg\" id=\"selectfile\" />
\t  <input type=\"hidden\" value=\"";
        // line 19
        echo ($context["logo"] ?? null);
        echo "\" id=\"input-logo\" name=\"logo\"/>
\t  <div class=\"form-outline mt-3\">
\t\t<input type=\"text\" name=\"company\" value=\"";
        // line 21
        echo ($context["company"] ?? null);
        echo "\" class=\"form-control\" />
\t\t<label class=\"form-label\">";
        // line 22
        echo ($context["entry_company"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"form-outline mt-3\">
\t\t<input type=\"text\" name=\"vat\" value=\"";
        // line 25
        echo ($context["vat"] ?? null);
        echo "\" class=\"form-control\" />
\t\t<label class=\"form-label\">";
        // line 26
        echo ($context["entry_vat"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"form-outline mt-3\">
\t\t<input type=\"text\" name=\"website\" value=\"";
        // line 29
        echo ($context["website"] ?? null);
        echo "\" class=\"form-control\" />
\t\t<label class=\"form-label\">";
        // line 30
        echo ($context["entry_website"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"form-outline mt-3\">
\t\t<input type=\"text\" name=\"phone\" value=\"";
        // line 33
        echo ($context["phone"] ?? null);
        echo "\" class=\"form-control\" />
\t\t<label class=\"form-label\">";
        // line 34
        echo ($context["entry_phone"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"form-outline mt-3\">
\t\t<input type=\"text\" name=\"address_1\" value=\"";
        // line 37
        echo ($context["address_1"] ?? null);
        echo "\" class=\"form-control\" />
\t\t<label class=\"form-label\">";
        // line 38
        echo ($context["entry_address_1"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"form-outline mt-3\">
\t\t<input type=\"text\" name=\"address_2\" value=\"";
        // line 41
        echo ($context["address_2"] ?? null);
        echo "\" class=\"form-control\" />
\t\t<label class=\"form-label\">";
        // line 42
        echo ($context["entry_address_2"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"form-outline mt-3\">
\t\t<input type=\"text\" name=\"city\" value=\"";
        // line 45
        echo ($context["city"] ?? null);
        echo "\" class=\"form-control\" />
\t\t<label class=\"form-label\">";
        // line 46
        echo ($context["entry_city"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"form-outline mt-3\">
\t\t<input type=\"text\" name=\"postcode\" value=\"";
        // line 49
        echo ($context["postcode"] ?? null);
        echo "\" class=\"form-control\" />
\t\t<label class=\"form-label\">";
        // line 50
        echo ($context["entry_postcode"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"mt-3\">
\t\t<select class=\"select\" data-mdb-filter=\"true\" name=\"country_id\" id=\"input-country_id\">
\t\t  <option value=\"\" selected>";
        // line 54
        echo ($context["text_select"] ?? null);
        echo "</option>
\t\t  ";
        // line 55
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["countries"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["country"]) {
            // line 56
            echo "\t\t  <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 56);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 56) == ($context["country_id"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["country"], "name", [], "any", false, false, false, 56);
            echo "</option>
\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['country'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 58
        echo "\t\t</select>
\t\t<label class=\"form-label select-label\">";
        // line 59
        echo ($context["select_country"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"mt-3\">
\t\t<select class=\"select\" data-mdb-filter=\"true\" name=\"zone_id\" id=\"input-zone_id\">
\t\t  <option value=\"\" selected>";
        // line 63
        echo ($context["text_select"] ?? null);
        echo "</option>
\t\t  ";
        // line 64
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["zones"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["zone"]) {
            // line 65
            echo "\t\t  <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["zone"], "zone_id", [], "any", false, false, false, 65);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["zone"], "zone_id", [], "any", false, false, false, 65) == ($context["zone_id"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["zone"], "name", [], "any", false, false, false, 65);
            echo "</option>
\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['zone'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        echo "\t\t</select>
\t\t<label class=\"form-label select-label\">";
        // line 68
        echo ($context["select_zone"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"mt-3\">
\t\t<select class=\"select\" name=\"currency\">
\t\t  <option value=\"\" selected disabled>";
        // line 72
        echo ($context["text_select"] ?? null);
        echo "</option>
\t\t  ";
        // line 73
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["currencies"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["currency_data"]) {
            // line 74
            echo "\t\t  <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["currency_data"], "code", [], "any", false, false, false, 74);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["currency_data"], "code", [], "any", false, false, false, 74) == ($context["currency"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["currency_data"], "title", [], "any", false, false, false, 74);
            echo "</option>
\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['currency_data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        echo "\t\t</select>
\t\t<label class=\"form-label select-label\">";
        // line 77
        echo ($context["select_currency"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"mt-3\">
\t\t<select class=\"select\" name=\"language_id\">
\t\t  <option value=\"\" selected disabled>";
        // line 81
        echo ($context["text_select"] ?? null);
        echo "</option>
\t\t  ";
        // line 82
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 83
            echo "\t\t  <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 83);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 83) == ($context["language_id"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 83);
            echo "</option>
\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 85
        echo "\t\t</select>
\t\t<label class=\"form-label select-label\">";
        // line 86
        echo ($context["select_language"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"mt-3\">
\t\t<select class=\"select\" name=\"catalog\">
\t\t\t<option value=\"market\" selected>";
        // line 90
        echo ($context["option_catalog_market"] ?? null);
        echo "</option>
\t\t\t<option value=\"carparts\" ";
        // line 91
        if ((($context["catalog"] ?? null) == "carparts")) {
            echo "selected";
        }
        echo ">";
        echo ($context["option_catalog_carparts"] ?? null);
        echo "</option>
\t\t</select>
\t\t<label class=\"form-label select-label\">";
        // line 93
        echo ($context["select_catalog"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"mt-3\">
\t\t<select class=\"select\" name=\"label\">
\t\t  ";
        // line 97
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["labels"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["label_data"]) {
            // line 98
            echo "\t\t  <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["label_data"], "code", [], "any", false, false, false, 98);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["label_data"], "code", [], "any", false, false, false, 98) == ($context["label"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["label_data"], "title", [], "any", false, false, false, 98);
            echo "</option>
\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['label_data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 100
        echo "\t\t</select>
\t\t<label class=\"form-label select-label\">";
        // line 101
        echo ($context["select_label"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"form-outline mt-3\">
\t\t<input type=\"number\" name=\"default_product_delivery\" value=\"";
        // line 104
        echo ($context["default_product_delivery"] ?? null);
        echo "\" max=\"99\" class=\"form-control\" />
\t\t<label class=\"form-label\">";
        // line 105
        echo ($context["entry_default_product_delivery"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"mt-3\">
\t\t<select class=\"select\" name=\"default_product_used\">
\t\t  <option value=\"0\" selected>";
        // line 109
        echo ($context["option_quality_new"] ?? null);
        echo "</option>
\t\t  <option value=\"1\" ";
        // line 110
        if ((($context["default_product_used"] ?? null) == "1")) {
            echo "selected";
        }
        echo ">";
        echo ($context["option_quality_used"] ?? null);
        echo "</option>
\t\t</select>
\t\t<label class=\"form-label select-label\">";
        // line 112
        echo ($context["select_default_product_used"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"mt-3\">
\t\t<select class=\"select\" name=\"default_brand\" data-mdb-filter=\"true\">
\t\t  <option value=\"\" selected>";
        // line 116
        echo ($context["text_select"] ?? null);
        echo "</option>
\t\t  ";
        // line 117
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["brands"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["brand"]) {
            // line 118
            echo "\t\t  <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["brand"], "name", [], "any", false, false, false, 118);
            echo "\"";
            if ((($context["default_brand"] ?? null) == twig_get_attribute($this->env, $this->source, $context["brand"], "name", [], "any", false, false, false, 118))) {
                echo " selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["brand"], "name", [], "any", false, false, false, 118);
            echo "</option>
\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['brand'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 120
        echo "\t\t</select>
\t\t<label class=\"form-label select-label\">";
        // line 121
        echo ($context["select_default_brand"] ?? null);
        echo "</label>
\t  </div>
\t  <button type=\"submit\" form=\"form-product\" class=\"btn btn-primary submit mt-3\" style=\"min-width: 150px;\"><i class=\"fa fa-save me-2\"></i>";
        // line 123
        echo ($context["button_save"] ?? null);
        echo "</button>
\t</form>
</div>
</main>
<script>
\$('.submit').click(function() {
  \$('#form-setting').submit();
});

\$('#input-country_id').change(function(event) {
  \$.ajax({
\turl: '";
        // line 134
        echo ($context["server"] ?? null);
        echo "index.php?route=account/setting.getZones&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&country_id=' + encodeURIComponent(event.target.value),
\tdataType: 'json',
\tsuccess: function(json) {
\t  \$('#input-zone_id option[value!=\"\"]').remove();
\t  
\t  \$.each(json, function (i, item) {
\t\t\$('#input-zone_id').append(\$('<option>', { 
\t\t  value: item.zone_id,
\t\t  text : item.name
\t\t}));
\t  });
\t}
  })
});

function fileExplorer() {
  document.getElementById('selectfile').click();
  document.getElementById('selectfile').onchange = function() {
\tfile = document.getElementById('selectfile').files[0];
\tuploadImage(file);
  }
}

async function uploadImage(file) {
  if (file.type.match(/image.*/)) {
\timgFile = await imageResize(file, '";
        // line 159
        echo ($context["MAX_IMAGE_WIDTH"] ?? null);
        echo "', '";
        echo ($context["MAX_IMAGE_HEIGHT"] ?? null);
        echo "');
\t
\tlet formData = new FormData();
\tformData.append('logo', imgFile);

\t\$.ajax({
\t  type: 'POST',
\t  url: '";
        // line 166
        echo ($context["server"] ?? null);
        echo "index.php?route=account/setting.uploadImage&user_token=";
        echo ($context["user_token"] ?? null);
        echo "',
\t  contentType: false,
\t  processData: false,
\t  data: formData,
\t  success:function(response) {
\t\tif(response.error !== undefined) {
\t\t  alert(response.error);
\t\t  return;
\t\t}
\t\t
\t\t\$('#selectfile').val('');
\t\t\$('#preview-logo').html('<img src=\"' + response['preview'] + '\" class=\"h-100\" />');
\t\t\$('#input-logo').val(response['logo']);
\t  }
\t});
  }
}
</script>
";
        // line 184
        echo ($context["footer"] ?? null);
        echo " ";
    }

    public function getTemplateName()
    {
        return "view/template/account/setting.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  502 => 184,  479 => 166,  467 => 159,  437 => 134,  423 => 123,  418 => 121,  415 => 120,  400 => 118,  396 => 117,  392 => 116,  385 => 112,  376 => 110,  372 => 109,  365 => 105,  361 => 104,  355 => 101,  352 => 100,  337 => 98,  333 => 97,  326 => 93,  317 => 91,  313 => 90,  306 => 86,  303 => 85,  288 => 83,  284 => 82,  280 => 81,  273 => 77,  270 => 76,  255 => 74,  251 => 73,  247 => 72,  240 => 68,  237 => 67,  222 => 65,  218 => 64,  214 => 63,  207 => 59,  204 => 58,  189 => 56,  185 => 55,  181 => 54,  174 => 50,  170 => 49,  164 => 46,  160 => 45,  154 => 42,  150 => 41,  144 => 38,  140 => 37,  134 => 34,  130 => 33,  124 => 30,  120 => 29,  114 => 26,  110 => 25,  104 => 22,  100 => 21,  95 => 19,  90 => 17,  85 => 16,  79 => 14,  76 => 13,  70 => 11,  68 => 10,  61 => 8,  55 => 7,  49 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/account/setting.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/account/setting.twig");
    }
}
