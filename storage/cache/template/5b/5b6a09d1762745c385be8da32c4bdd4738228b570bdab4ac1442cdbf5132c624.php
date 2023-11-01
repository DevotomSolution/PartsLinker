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

/* view/template/catalog/vehicle4parts_list.twig */
class __TwigTemplate_e50ba15efd6b9ab53f62cde52cbb5aebb816cd316803645fa2716d6023ee07a1 extends Template
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
\t";
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
        echo "\t<div class=\"d-flex flex-wrap align-items-center\">
\t  <div class=\"flex-fill d-flex align-items-center\">
\t\t<div class=\"me-3\">
\t\t  <select class=\"select\" id=\"select-warehouse_id\">
\t\t    <option value=\"\">";
        // line 18
        echo ($context["text_all_warehouses"] ?? null);
        echo "</option>
\t\t\t";
        // line 19
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["warehouses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["warehouse"]) {
            // line 20
            echo "\t\t\t<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["warehouse"], "warehouse_id", [], "any", false, false, false, 20);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["warehouse"], "warehouse_id", [], "any", false, false, false, 20) == ($context["warehouse_id"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["warehouse"], "name", [], "any", false, false, false, 20);
            echo "</option>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['warehouse'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        echo "\t\t  </select>
\t\t</div>
\t\t<div class=\"flex-fill d-none d-md-block position-relative me-3\">
\t\t  <div id=\"search\" class=\"form-outline\">
\t\t\t<input type=\"text\" name=\"search\" value=\"";
        // line 26
        echo ($context["search"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t<label class=\"form-label\">";
        // line 27
        echo ($context["text_search"] ?? null);
        echo "</label>
\t\t  </div>
\t\t  <button type=\"button\" id=\"btn-search\" class=\"btn btn-outline-primary fs-7 border-0 position-absolute ps-3 pe-3 h-100\" style=\"top: 0; right: 0;\" data-mdb-color=\"dark\"><i class=\"fas fa-search\"></i></button>
\t\t</div>
\t  </div>
\t  <div><a href=\"";
        // line 32
        echo ($context["add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fas fa-plus\"></i><span class=\"ms-2\">";
        echo ($context["button_add"] ?? null);
        echo "</span></a></div>
\t</div>
\t<div class=\"d-block d-md-none mt-3 position-relative\">
\t  <div id=\"search-m\" class=\"form-outline\">
\t\t<input type=\"text\" name=\"search-m\" value=\"";
        // line 36
        echo ($context["search"] ?? null);
        echo "\" class=\"form-control\" />
\t\t<label class=\"form-label\">";
        // line 37
        echo ($context["text_search"] ?? null);
        echo "</label>
\t  </div>
\t  <button type=\"button\" id=\"btn-search-m\" class=\"btn btn-outline-primary fs-7 border-0 position-absolute ps-3 pe-3 h-100\" style=\"top: 0; right: 0;\" data-mdb-color=\"dark\"><i class=\"fas fa-search\"></i></button>
\t</div>
\t";
        // line 41
        if (($context["vehicles4parts"] ?? null)) {
            // line 42
            echo "\t  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["vehicles4parts"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["vehicle4parts"]) {
                // line 43
                echo "\t  <div class=\"card shadow-3 mt-3\">
\t\t<div class=\"card-body row align-items-center\">
\t\t\t<div class=\"d-none d-lg-flex col-lg-11 align-items-center\">
\t\t\t  <img src=\"";
                // line 46
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "image_min", [], "any", false, false, false, 46);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "title", [], "any", false, false, false, 46);
                echo "\" href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "image", [], "any", false, false, false, 46);
                echo "\" style=\"min-width: 75px;\" class=\"img-thumbnail vehicle4parts-image me-4\" />
\t\t\t  <a href=\"";
                // line 47
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "label_url", [], "any", false, false, false, 47);
                echo "\" class=\"me-4\"><img src=\"";
                echo ($context["server"] ?? null);
                echo "view/img/qr.png\" style=\"min-width: 75px;\" class=\"img-thumbnail\" /></a>
\t\t\t  <div class=\"me-4\">";
                // line 48
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "sku", [], "any", false, false, false, 48);
                echo "</div>
\t\t\t  <a href=\"";
                // line 49
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "edit", [], "any", false, false, false, 49);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "title", [], "any", false, false, false, 49);
                echo "</a>
\t\t\t</div>
\t\t\t<div class=\"d-none d-lg-flex col-lg-1 text-end\">
\t\t\t  <div class=\"dropdown\">
\t\t\t\t<button\tclass=\"btn btn-primary\"\ttype=\"button\" id=\"";
                // line 53
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "sku", [], "any", false, false, false, 53);
                echo "dropdownMenuButton\" data-mdb-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fas fa-bars\"></i></button>
\t\t\t\t<ul id=\"";
                // line 54
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "sku", [], "any", false, false, false, 54);
                echo "menu\" class=\"dropdown-menu\" aria-labelledby=\"";
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "sku", [], "any", false, false, false, 54);
                echo "dropdownMenuButton\">
\t\t\t\t  <li><a class=\"dropdown-item\" href=\"";
                // line 55
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "add_product", [], "any", false, false, false, 55);
                echo "\"><i class=\"fas fa-plus me-2\"></i>";
                echo ($context["button_add_product"] ?? null);
                echo "</a></li>
\t\t\t\t  <li><a class=\"dropdown-item\" href=\"";
                // line 56
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "edit", [], "any", false, false, false, 56);
                echo "\"><i class=\"fas fa-pencil-alt me-2\"></i>";
                echo ($context["button_edit"] ?? null);
                echo "</a></li>
\t\t\t\t  <li><a class=\"dropdown-item\" href=\"";
                // line 57
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "list_products", [], "any", false, false, false, 57);
                echo "\"><i class=\"fas fa-list me-2\"></i>";
                echo ($context["button_list_products"] ?? null);
                echo "</a></li>
\t\t\t\t  <li><a class=\"dropdown-item text-danger\" href=\"";
                // line 58
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "delete", [], "any", false, false, false, 58);
                echo "\"><i class=\"fas fa-trash me-2\"></i>";
                echo ($context["button_delete"] ?? null);
                echo "</a></li>
\t\t\t\t  <li><button data-sku=\"";
                // line 59
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "sku", [], "any", false, false, false, 59);
                echo "\" class=\"dropdown-item btn-upload-file\"><i class=\"fas fa-file-upload me-2\"></i>";
                echo ($context["button_upload"] ?? null);
                echo "</button></li>
\t\t\t\t  ";
                // line 60
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "files", [], "any", false, false, false, 60));
                foreach ($context['_seq'] as $context["_key"] => $context["file"]) {
                    // line 61
                    echo "\t\t\t\t  <li class=\"dropdown-item d-flex align-items-center justify-content-between\"><a target=\"blank\" href=\"";
                    echo ($context["dir_upload"] ?? null);
                    echo twig_get_attribute($this->env, $this->source, $context["file"], "file", [], "any", false, false, false, 61);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["file"], "title", [], "any", false, false, false, 61);
                    echo "</a><i class=\"close fas fa-times fs-6 float-end\" onclick=\"deleteFile('";
                    echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "sku", [], "any", false, false, false, 61);
                    echo "', '";
                    echo twig_get_attribute($this->env, $this->source, $context["file"], "vehicle4parts_file_id", [], "any", false, false, false, 61);
                    echo "'); this.parentNode.remove();\"></i></li>
\t\t\t\t  ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['file'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 63
                echo "\t\t\t\t</ul>
\t\t\t  </div>
\t\t\t</div>
\t\t\t<div class=\"d-flex d-lg-none col-lg-12 align-items-center mb-3\">
\t\t\t  <div><img src=\"";
                // line 67
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "image_min", [], "any", false, false, false, 67);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "title", [], "any", false, false, false, 67);
                echo "\" href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "image", [], "any", false, false, false, 67);
                echo "\" style=\"min-width: 75px;\" class=\"img-thumbnail vehicle4parts-image me-4\" /></div>
\t\t\t  <div class=\"flex-fill d-flex flex-column\">
\t\t\t\t<a href=\"";
                // line 69
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "edit", [], "any", false, false, false, 69);
                echo "\" class=\"fs-7\" style=\"min-height: 30px;\"><span class=\"text-dark me-3\">";
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "sku", [], "any", false, false, false, 69);
                echo "</span>";
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "title_min", [], "any", false, false, false, 69);
                echo "</a>
\t\t\t\t<div>
\t\t\t\t  <a class=\"btn btn-primary btn-floating me-1 mt-2\" href=\"";
                // line 71
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "add_product", [], "any", false, false, false, 71);
                echo "\"><i class=\"fas fa-plus\"></i></a>
\t\t\t\t  <a class=\"btn btn-primary btn-floating me-1 mt-2\" href=\"";
                // line 72
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "edit", [], "any", false, false, false, 72);
                echo "\"><i class=\"fas fa-pencil-alt\"></i></a>
\t\t\t\t  <a class=\"btn btn-primary btn-floating me-1 mt-2\" href=\"";
                // line 73
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "list_products", [], "any", false, false, false, 73);
                echo "\"><i class=\"fas fa-list\"></i></a>
\t\t\t\t  <a class=\"btn btn-danger btn-floating me-1 mt-2\" href=\"";
                // line 74
                echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "delete", [], "any", false, false, false, 74);
                echo "\"><i class=\"fas fa-trash\"></i></a>
\t\t\t\t</div>
\t\t\t  </div>\t\t\t  
\t\t\t</div>
\t\t</div>
\t  </div>
\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['vehicle4parts'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 81
            echo "\t";
        }
        // line 82
        echo "\t<div class=\"row mt-3 mb-3\">
\t  <div class=\"col-sm-6 text-start\">";
        // line 83
        echo ($context["pagination"] ?? null);
        echo "</div>
\t  <div class=\"col-sm-6 text-end\">";
        // line 84
        echo ($context["results"] ?? null);
        echo "</div>
\t</div>
</div>
</main>
<input type=\"file\" id=\"selectfile\" class=\"d-none\" />
<script>
\$(document).ready(function() {
  \$('.vehicle4parts-image').magnificPopup({
\ttype:'image',
\tgallery: {
\t\tenabled: false
\t}
  });
});

\$('.btn-upload-file').on('click', function(e) {
  let sku = e.currentTarget.attributes['data-sku'].value;

  document.getElementById('selectfile').click();
  document.getElementById('selectfile').onchange = function() {
\tfile = document.getElementById('selectfile').files[0];
\tuploadFile(sku, file);
  };
});

function uploadFile(sku, file) {
  loading();

  let formData = new FormData();
  formData.append('file', file);

  \$.ajax({
\ttype: 'POST',
\turl: '";
        // line 117
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/vehicle4parts.uploadFile&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&sku=' + encodeURIComponent(sku),
\tcontentType: false,
\tprocessData: false,
\tdata: formData,
\tsuccess:function(response) {
\t  \$('#selectfile').val('');
\t  
\t  if(response.error !== undefined) {
\t\taddAlert('";
        // line 125
        echo ($context["text_error"] ?? null);
        echo "', response.error, 'danger');
\t\treturn;
\t  }
\t  
\t  \$('#'+sku+'menu').append('<li class=\"dropdown-item d-flex align-items-center justify-content-between\"><a target=\"blank\" href=\"'+response['path']+'\">'+response['title']+'</a><i class=\"close fas fa-times fs-6 float-end\" onclick=\"deleteFile('+\"'\"+sku+\"'\"+', '+\"'\"+response['id']+\"'\"+'); this.parentNode.remove();\"></i></li>');
\t  
\t  addAlert('";
        // line 131
        echo ($context["text_success"] ?? null);
        echo "', '";
        echo ($context["text_file_uploaded"] ?? null);
        echo "', 'success', 5000);
\t}
  }).then(function() {
\tloading(false);
  });
}

function deleteFile(sku, file_id) {
  \$.ajax({
\turl: '";
        // line 140
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/vehicle4parts.deleteFile&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&file_id=' + encodeURIComponent(file_id) + '&sku=' + encodeURIComponent(sku),
\tsuccess:function(response) {
\t  addAlert('";
        // line 142
        echo ($context["text_success"] ?? null);
        echo "', '";
        echo ($context["text_file_deleted"] ?? null);
        echo "', 'success', 5000);
\t}
  });
}

\$('#select-warehouse_id').change(function() {
\tlet url = '';

\tlet warehouseId = \$('#select-warehouse_id').val();

\tif (warehouseId) {
\t\turl += '&warehouse_id=' + encodeURIComponent(warehouseId);
\t}
\t
\tlocation = '";
        // line 156
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/vehicle4parts&user_token=";
        echo ($context["user_token"] ?? null);
        echo "' + url;
});

\$('#btn-search').on('click', function() {
\tlet url = '';

\tlet search = \$('input[name=\\'search\\']').val();

\tif (search) {
\t\turl += '&search=' + encodeURIComponent(search);
\t}
\t
\tlet warehouseId = \$('#select-warehouse_id').val();

\tif (warehouseId) {
\t\turl += '&warehouse_id=' + encodeURIComponent(warehouseId);
\t}
\t
\tlocation = '";
        // line 174
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/vehicle4parts&user_token=";
        echo ($context["user_token"] ?? null);
        echo "' + url;
});

\$('#btn-search-m').on('click', function() {
\tlet url = '';

\tlet search = \$('input[name=\\'search-m\\']').val();

\tif (search) {
\t\turl += '&search=' + encodeURIComponent(search);
\t}
\t
\tlet warehouseId = \$('#select-warehouse_id').val();

\tif (warehouseId) {
\t\turl += '&warehouse_id=' + encodeURIComponent(warehouseId);
\t}
\t
\tlocation = '";
        // line 192
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/vehicle4parts&user_token=";
        echo ($context["user_token"] ?? null);
        echo "' + url;
});

\$('input[name=\\'search\\']').keydown(function(e) {
\tif(e.keyCode == 13) {
\t\t\$('#btn-search').trigger('click');
\t}
});

\$('input[name=\\'search-m\\']').keydown(function(e) {
\tif(e.keyCode == 13) {
\t\t\$('#btn-search-m').trigger('click');
\t}
});

function filter() {
  let url = '';
\t
  let filterBrand = \$('select[name=\\'filter_vehicle_brand\\']').val();

  if (filterBrand != '0') {
\turl += '&filter_vehicle_brand=' + encodeURIComponent(filterBrand);
  }

  let filterModel = \$('select[name=\\'filter_vehicle_model\\']').val();

  if (filterBrand != '0' && filterModel != '0') {
\turl += '&filter_vehicle_model=' + encodeURIComponent(filterModel);
  }
\t
  let filterEngine = \$('select[name=\\'filter_vehicle_engine\\']').val();

  if (filterBrand != '0' && filterModel != '0' && filterEngine != '0') {
\turl += '&filter_vehicle_engine=' + encodeURIComponent(filterEngine);
  }
  
  let warehouseId = \$('#select-warehouse_id').val();

  if (warehouseId != '0') {
\turl += '&warehouse_id=' + encodeURIComponent(warehouseId);
  }
  
  let sort = '";
        // line 234
        echo ($context["sort"] ?? null);
        echo "';
  
  if (sort) {
\turl += '&sort=' + encodeURIComponent(sort);
  }
  
  let order = '";
        // line 240
        echo ($context["order"] ?? null);
        echo "';
  
  if (order) {
\turl += '&order=' + encodeURIComponent(order);
  }
\t
  location = '";
        // line 246
        echo ($context["product"] ?? null);
        echo "' + url;
}
</script> 
";
        // line 249
        echo ($context["footer"] ?? null);
        echo " ";
    }

    public function getTemplateName()
    {
        return "view/template/catalog/vehicle4parts_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  505 => 249,  499 => 246,  490 => 240,  481 => 234,  434 => 192,  411 => 174,  388 => 156,  369 => 142,  362 => 140,  348 => 131,  339 => 125,  326 => 117,  290 => 84,  286 => 83,  283 => 82,  280 => 81,  267 => 74,  263 => 73,  259 => 72,  255 => 71,  246 => 69,  237 => 67,  231 => 63,  215 => 61,  211 => 60,  205 => 59,  199 => 58,  193 => 57,  187 => 56,  181 => 55,  175 => 54,  171 => 53,  162 => 49,  158 => 48,  152 => 47,  144 => 46,  139 => 43,  134 => 42,  132 => 41,  125 => 37,  121 => 36,  112 => 32,  104 => 27,  100 => 26,  94 => 22,  79 => 20,  75 => 19,  71 => 18,  65 => 14,  57 => 10,  54 => 9,  46 => 5,  44 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/catalog/vehicle4parts_list.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/catalog/vehicle4parts_list.twig");
    }
}
