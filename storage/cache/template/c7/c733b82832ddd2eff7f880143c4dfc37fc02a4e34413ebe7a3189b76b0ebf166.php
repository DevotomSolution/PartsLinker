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

/* view/template/catalog/warehouse.twig */
class __TwigTemplate_a2f18281b3f2625976d0f05b380e3c76862ba0f6aeade3a2859f97951019a635 extends Template
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
    ";
        // line 4
        if (($context["error_warning"] ?? null)) {
            // line 5
            echo "\t  <div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
\t\t<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button>
\t  </div>
\t";
        }
        // line 9
        echo "\t";
        if (($context["success"] ?? null)) {
            // line 10
            echo "\t  <div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"success\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
\t\t<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button>
\t  </div>
\t";
        }
        // line 14
        echo "\t<div class=\"d-flex flex-column flex-sm-row align-items-sm-center flex-wrap\">
\t  <div class=\"me-sm-3\">
\t\t<select class=\"select\" id=\"select-warehouse_id\">
\t\t  <option value=\"0\">";
        // line 17
        echo ($context["text_all_warehouses"] ?? null);
        echo "</option>
\t\t  ";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["warehouses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["warehouse"]) {
            // line 19
            echo "\t\t  <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["warehouse"], "warehouse_id", [], "any", false, false, false, 19);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["warehouse"], "warehouse_id", [], "any", false, false, false, 19) == ($context["warehouse_id"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["warehouse"], "name", [], "any", false, false, false, 19);
            echo "</option>
\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['warehouse'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "\t\t</select>
\t  </div>
\t  <div class=\"flex-fill position-relative mt-sm-0 mt-3\">
\t\t<div class=\"form-outline\">
\t\t  <input type=\"text\" name=\"search\" value=\"";
        // line 25
        echo ($context["search"] ?? null);
        echo "\" class=\"form-control\" />
\t\t  <label class=\"form-label\">";
        // line 26
        echo ($context["text_search"] ?? null);
        echo "</label>
\t\t</div>
\t\t<button type=\"button\" id=\"btn-search\" class=\"btn btn-outline-primary fs-7 border-0 position-absolute ps-3 pe-3 h-100\" style=\"top: 0; right: 0;\" data-mdb-color=\"dark\"><i class=\"fas fa-search\"></i></button>
\t  </div>
\t</div>
\t<div class=\"row mt-3\">
\t  <div class=\"col-6 pe-0\">
\t\t<div class=\"form-outline\">
\t\t  <input type=\"text\" name=\"cod\" value=\"\" id=\"input-cod\" class=\"form-control\" />
\t\t  <label class=\"form-label\" for=\"input-cod\">";
        // line 35
        echo ($context["entry_cod"] ?? null);
        echo "</label>
\t\t</div>
\t  </div>
\t  <div class=\"col-6\">
\t\t<div class=\"form-outline\">
\t\t  <input type=\"text\" name=\"location\" value=\"\" id=\"input-location\" class=\"form-control\" />
\t\t  <label class=\"form-label\" for=\"input-location\">";
        // line 41
        echo ($context["entry_location"] ?? null);
        echo "</label>
\t\t</div>
\t  </div>
\t</div>
\t";
        // line 45
        if (($context["products"] ?? null)) {
            // line 46
            echo "\t  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["products"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 47
                echo "\t  <div class=\"card shadow-3 mt-3\">
\t\t<div class=\"card-body row align-items-center\">
\t\t\t<div class=\"col-12 d-lg-none\">";
                // line 49
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 49);
                echo "<span class=\"text-primary ps-2\">";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "warehouse", [], "any", false, false, false, 49);
                echo "</span></div>
\t\t\t<div class=\"col-4 col-lg-4 d-flex align-items-center\">
\t\t\t  <img src=\"";
                // line 51
                echo twig_get_attribute($this->env, $this->source, $context["product"], "image", [], "any", false, false, false, 51);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 51);
                echo "\" class=\"img-thumbnail me-4\" style=\"min-width: 75px;\"/>
\t\t\t  <a href=\"";
                // line 52
                echo twig_get_attribute($this->env, $this->source, $context["product"], "label", [], "any", false, false, false, 52);
                echo "\" class=\"d-none d-lg-inline-block\"><img src=\"";
                echo ($context["server"] ?? null);
                echo "view/img/qr.png\" class=\"img-thumbnail me-4\" style=\"min-width: 75px;\"/></a>
\t\t\t  <div class=\"d-none d-lg-block\"><div>";
                // line 53
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 53);
                echo "</div><div class=\"text-primary\">";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "warehouse", [], "any", false, false, false, 53);
                echo "</div></div>
\t\t\t</div>
\t\t\t<div id=\"";
                // line 55
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 55);
                echo "location\" class=\"col-4 col-lg-2 text-center text-success\">";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "location", [], "any", false, false, false, 55);
                echo "</div>
\t\t\t<div class=\"col-4 col-lg-2 text-end text-lg-center\"><input type=\"number\" class=\"form-control d-inline-block product-quantity text-center\" data-sku=\"";
                // line 56
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 56);
                echo "\" min=\"0\" max=\"999\" style=\"width: 70px;\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 56);
                echo "\"/></div>
\t\t\t<div id=\"";
                // line 57
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 57);
                echo "date_modified\" class=\"d-none d-lg-block col-lg-2 text-end text-lg-center\">";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "date_modified", [], "any", false, false, false, 57);
                echo "</div>
\t\t\t<div class=\"d-none d-lg-block col-lg-2 text-end\"><a href=\"";
                // line 58
                echo twig_get_attribute($this->env, $this->source, $context["product"], "edit", [], "any", false, false, false, 58);
                echo "\" data-mdb-toggle=\"tooltip\" title=\"";
                echo ($context["button_edit"] ?? null);
                echo "\" class=\"btn btn-primary mt-1\"><i class=\"fas fa-pencil-alt\"></i></a></div>
\t\t</div>
\t  </div>
\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 62
            echo "\t";
        }
        // line 63
        echo "\t<div class=\"row mt-3\">
\t  <div class=\"col-sm-6 text-start\">";
        // line 64
        echo ($context["pagination"] ?? null);
        echo "</div>
\t  <div class=\"col-sm-6 text-end\">";
        // line 65
        echo ($context["results"] ?? null);
        echo "</div>
\t</div>
\t<div class=\"row mt-3\">
\t  <div class=\"col-9 pe-0\">
\t\t<div class=\"form-outline\">
          <input type=\"text\" name=\"text_location\" value=\"\" id=\"input-text_location\" class=\"form-control\" />
\t\t  <label class=\"form-label\" for=\"input-text_location\">";
        // line 71
        echo ($context["entry_location"] ?? null);
        echo "</label>
        </div>
\t  </div>
\t  <div class=\"col-3\">
\t\t<button type=\"button\" id=\"button-print_location\" class=\"btn btn-primary w-100\"><i class=\"fas fa-print me-2\"></i><span class=\"d-none d-md-inline\">";
        // line 75
        echo ($context["button_print"] ?? null);
        echo "</span></button>
\t  </div>
\t</div>
</div>
</main>
<div id=\"toPrint\"><svg id=\"barcode\"></svg></div>
<script type=\"text/javascript\">
\$('#select-warehouse_id').on('change', function() {
  filter();
});

\$('#btn-search').on('click', function() {
  filter();
});

\$('input[name=\\'search\\']').keydown(function(e) {
  if(e.keyCode == 13) {
\tfilter();
  }
});

function filter() {
  let url = '';
  
  let warehouseId = \$('#select-warehouse_id').val();

  if (warehouseId != '0') {
\turl += '&warehouse_id=' + encodeURIComponent(warehouseId);
  }

  let search = \$('input[name=\\'search\\']').val();

  if(search) {
\turl += '&search=' + encodeURIComponent(search);
  }
\t
  location = '";
        // line 111
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/warehouse&user_token=";
        echo ($context["user_token"] ?? null);
        echo "' + url;
}

\$('.product-quantity').on('focusout', function(e) {
  \$.ajax({
\turl: '";
        // line 116
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/warehouse.editQuantity&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&sku=' + encodeURIComponent(e.target.attributes['data-sku'].value) + '&quantity=' + encodeURIComponent(e.target.value),
\tdataType: 'json',
\tsuccess: function(json) {
\t  if(json['date'] !== undefined) {
\t\t\$('#'+e.target.attributes['data-sku'].value+'date_modified').html(json['date']);
\t  }
\t}
  })
});

function beep() {
  let snd = new Audio(\"data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=\");  
  snd.play();
}

function beepError() {
  let snd = new Audio(\"";
        // line 132
        echo ($context["server"] ?? null);
        echo "view/audio/error.mp3\");  
  snd.play();
}

\$('#input-cod').keydown(function(event) {
  if(event.keyCode == 13) {
\t\$('#input-location').val('');
\t\$('#input-location').focus();
  }
});

\$('#button-print_location').click(function(event) {
  if(!\$('#input-text_location').val().match(/[a-zA-Z0-9]{1,24}/)) {
\treturn;
  }

  \$('header').hide();
  \$('main').hide();
  \$('footer').hide();
  \$('#toPrint').show();
  
  JsBarcode(\"#barcode\", \$('#input-text_location').val(), {
\ttextPosition: \"top\",
\theight: 52,
\twidth: 2.5,
\tfontSize: 50,
\ttextMargin: 6,
\tfontOptions: \"bold\",
\tmargin: 0,
  });
  window.print();
  
  \$('#toPrint').hide();
  \$('header').show();
  \$('main').show();
  \$('footer').show();
});

\$('#input-location').keydown(function(event) {
  if(event.keyCode == 13) {
\t\$.ajax({
\t  url: '";
        // line 173
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/warehouse.editLocation&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&cod=' + encodeURIComponent(\$('#input-cod').val()) + '&location=' + encodeURIComponent(\$('#input-location').val()),
\t  dataType: 'json',
\t  success: function(json) {
\t\tif(json['sku'] !== undefined) {
\t\t  \$('#'+json['sku']+'location').html(\$('#input-location').val());
\t\t  addAlert('";
        // line 178
        echo ($context["text_success"] ?? null);
        echo "', json['sku'], 'success', 1000);
\t\t  beep();
\t\t} else {
\t\t  addAlert('";
        // line 181
        echo ($context["text_error"] ?? null);
        echo "', \$('#input-cod').val(), 'danger', 1000);
\t\t  beepError();
\t\t}
\t\t
\t\t\$('#input-cod').val('');
\t\t\$('#input-location').val('');
\t\t\$('#input-cod').focus();
\t  }
\t})
  }
});
</script>
";
        // line 193
        echo ($context["footer"] ?? null);
        echo " ";
    }

    public function getTemplateName()
    {
        return "view/template/catalog/warehouse.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  369 => 193,  354 => 181,  348 => 178,  338 => 173,  294 => 132,  273 => 116,  263 => 111,  224 => 75,  217 => 71,  208 => 65,  204 => 64,  201 => 63,  198 => 62,  186 => 58,  180 => 57,  174 => 56,  168 => 55,  161 => 53,  155 => 52,  149 => 51,  142 => 49,  138 => 47,  133 => 46,  131 => 45,  124 => 41,  115 => 35,  103 => 26,  99 => 25,  93 => 21,  78 => 19,  74 => 18,  70 => 17,  65 => 14,  57 => 10,  54 => 9,  46 => 5,  44 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/catalog/warehouse.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/catalog/warehouse.twig");
    }
}
