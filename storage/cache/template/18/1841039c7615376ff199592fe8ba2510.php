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

/* view/template/catalog/product_list.twig */
class __TwigTemplate_75e2cc7b934df23f7924f0e2b716e946 extends Template
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
<main style=\"margin-top: 58px\" class=\"pt-4\">
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
        echo "\t<div class=\"d-flex flex-wrap align-items-center\">
\t  <div class=\"flex-fill d-flex align-items-center\">
\t\t<div class=\"me-3\">
\t\t  <select class=\"select\" id=\"select-warehouse_id\">
\t\t    <option value=\"0\">";
        // line 19
        echo ($context["text_all_warehouses"] ?? null);
        echo "</option>
\t\t\t";
        // line 20
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["warehouses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["warehouse"]) {
            // line 21
            echo "\t\t\t<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["warehouse"], "warehouse_id", [], "any", false, false, false, 21);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["warehouse"], "warehouse_id", [], "any", false, false, false, 21) == ($context["warehouse_id"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["warehouse"], "name", [], "any", false, false, false, 21);
            echo "</option>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['warehouse'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "\t\t  </select>
\t\t</div>
\t\t<div class=\"flex-fill d-none d-md-block position-relative me-3\">
\t\t  <div id=\"search\" class=\"form-outline\">
\t\t\t<input type=\"text\" name=\"search\" value=\"";
        // line 27
        echo ($context["search"] ?? null);
        echo "\" class=\"form-control\" autofocus/>
\t\t\t<label class=\"form-label\">";
        // line 28
        echo ($context["text_search"] ?? null);
        echo "</label>
\t\t  </div>
\t\t  <button type=\"button\" id=\"btn-search\" class=\"btn btn-outline-primary fs-7 border-0 position-absolute ps-3 pe-3 h-100\" style=\"top: 0; right: 0;\" data-mdb-color=\"dark\"><i class=\"fas fa-search\"></i></button>
\t\t</div>
\t  </div>
\t  <div><a href=\"";
        // line 33
        echo ($context["add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fas fa-plus\"></i><span class=\"ms-2\">";
        echo ($context["button_add"] ?? null);
        echo "</span></a></div>
\t</div>
\t<div class=\"d-block d-md-none position-relative mt-3\">
\t  <div id=\"search-m\" class=\"form-outline\">
\t\t<input type=\"text\" name=\"search-m\" value=\"";
        // line 37
        echo ($context["search"] ?? null);
        echo "\" class=\"form-control\"/>
\t\t<label class=\"form-label\">";
        // line 38
        echo ($context["text_search"] ?? null);
        echo "</label>
\t  </div>
\t  <button type=\"button\" id=\"btn-search-m\" class=\"btn btn-outline-primary fs-7 border-0 position-absolute ps-3 pe-3 h-100\" style=\"top: 0; right: 0;\" data-mdb-color=\"dark\"><i class=\"fas fa-search\"></i></button>
\t</div>
\t";
        // line 42
        if ((($context["filter_off"] ?? null) == 0)) {
            // line 43
            echo "\t<div class=\"row\">
\t  <div class=\"col-12 col-md-4 mt-3\">
\t\t<select class=\"select\" data-mdb-filter=\"true\" name=\"filter_vehicle_brand\" class=\"form-control\">
\t\t  <option value=\"\"></option>
\t\t  ";
            // line 47
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["vehicle_brands"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["brand"]) {
                // line 48
                echo "\t\t  <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["brand"], "id", [], "any", false, false, false, 48);
                echo "\" ";
                if ((($context["filter_vehicle_brand"] ?? null) == twig_get_attribute($this->env, $this->source, $context["brand"], "id", [], "any", false, false, false, 48))) {
                    echo "selected";
                }
                echo ">";
                echo twig_get_attribute($this->env, $this->source, $context["brand"], "name", [], "any", false, false, false, 48);
                echo "</option>
\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['brand'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 50
            echo "\t\t</select>
\t\t<label class=\"form-label select-label\">";
            // line 51
            echo ($context["select_vehicle_brand"] ?? null);
            echo "</label>
\t  </div>
\t  <div class=\"col-12 col-md-4 mt-3\">
\t\t<select class=\"select\" data-mdb-filter=\"true\" name=\"filter_vehicle_model\" class=\"form-control\">
\t\t  <option value=\"\"></option>
\t\t  ";
            // line 56
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["vehicle_models"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["model"]) {
                // line 57
                echo "\t\t  <option id = \"vehicle";
                echo twig_get_attribute($this->env, $this->source, $context["model"], "id", [], "any", false, false, false, 57);
                echo "\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["model"], "id", [], "any", false, false, false, 57);
                echo "\" ";
                if ((($context["filter_vehicle_model"] ?? null) == twig_get_attribute($this->env, $this->source, $context["model"], "id", [], "any", false, false, false, 57))) {
                    echo "selected";
                }
                echo ">";
                echo twig_get_attribute($this->env, $this->source, $context["model"], "name", [], "any", false, false, false, 57);
                echo "</option>
\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['model'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 59
            echo "\t\t</select>
\t\t<label class=\"form-label select-label\">";
            // line 60
            echo ($context["select_vehicle_model"] ?? null);
            echo "</label>
\t  </div>
\t  <div class=\"col-12 col-md-4 mt-3\">
\t\t<select class=\"select\" data-mdb-filter=\"true\" id=\"filter-engine\" name=\"filter_vehicle_engine\" class=\"form-control\">
\t\t  <option value=\"\"></option>
\t\t  ";
            // line 65
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["vehicle_engines"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["engine"]) {
                // line 66
                echo "\t\t\t<option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["engine"], "id", [], "any", false, false, false, 66);
                echo "\" ";
                if ((($context["filter_vehicle_engine"] ?? null) == twig_get_attribute($this->env, $this->source, $context["engine"], "id", [], "any", false, false, false, 66))) {
                    echo "selected";
                }
                echo ">";
                echo twig_get_attribute($this->env, $this->source, $context["engine"], "name", [], "any", false, false, false, 66);
                echo "</option>
\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['engine'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 68
            echo "\t\t</select>
\t\t<label class=\"form-label select-label\">";
            // line 69
            echo ($context["select_vehicle_engine"] ?? null);
            echo "</label>
\t  </div>
\t</div>
\t<div id=\"categories-carousel\"></div>
\t";
        }
        // line 74
        echo "\t";
        if (($context["products"] ?? null)) {
            // line 75
            echo "\t  <div class=\"d-flex justify-content-end flex-wrap mt-3\">
\t    <div class=\"dropdown d-flex d-md-none\">
\t\t  <a class=\"btn btn-primary dropdown-toggle\" href=\"#\" role=\"button\" id=\"sort\" data-mdb-toggle=\"dropdown\" aria-expanded=\"false\">Sort by </a>
\t\t  <ul class=\"dropdown-menu\" aria-labelledby=\"sort\">
\t\t    ";
            // line 79
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["sort_url"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["sort_url_data"]) {
                // line 80
                echo "\t\t\t<li><a class=\"dropdown-item\" href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["sort_url_data"], "url", [], "any", false, false, false, 80);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["sort_url_data"], "title", [], "any", false, false, false, 80);
                echo "</a></li>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sort_url_data'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 82
            echo "\t\t  </ul>
\t\t</div>
\t\t<div class=\"btn-group d-md-flex d-none\">
\t\t  ";
            // line 85
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["sort_url"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["sort_url_data"]) {
                // line 86
                echo "\t\t  <a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["sort_url_data"], "url", [], "any", false, false, false, 86);
                echo "\" class=\"btn btn-primary";
                if (twig_get_attribute($this->env, $this->source, $context["sort_url_data"], "active", [], "any", false, false, false, 86)) {
                    echo " active";
                }
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["sort_url_data"], "title", [], "any", false, false, false, 86);
                echo "</a>
\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sort_url_data'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 88
            echo "\t\t</div>
\t  </div>
\t  ";
            // line 90
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["products"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 91
                echo "\t  <div id=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 91);
                echo "\" class=\"card shadow-3 mt-3 bg-opacity-10 ";
                if ((twig_get_attribute($this->env, $this->source, $context["product"], "status", [], "any", false, false, false, 91) == "0")) {
                    echo "bg-dark";
                }
                echo "\">
\t\t<div class=\"card-body row align-items-center\">
\t\t\t<div class=\"d-none d-lg-flex col-lg-8 align-items-center\">
\t\t\t\t<img src=\"";
                // line 94
                echo twig_get_attribute($this->env, $this->source, $context["product"], "image_min", [], "any", false, false, false, 94);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 94);
                echo "\" href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "image", [], "any", false, false, false, 94);
                echo "\" style=\"min-width: 75px;\" class=\"img-thumbnail product-image me-4\" />
\t\t\t\t<a href=\"";
                // line 95
                echo twig_get_attribute($this->env, $this->source, $context["product"], "label", [], "any", false, false, false, 95);
                echo "\" class=\"me-4\"><img src=\"";
                echo ($context["server"] ?? null);
                echo "view/img/qr.png\" style=\"min-width: 75px;\" class=\"img-thumbnail\"/></a>
\t\t\t\t<div class=\"me-4\">";
                // line 96
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 96);
                echo "</div>
\t\t\t    <a href=\"";
                // line 97
                echo twig_get_attribute($this->env, $this->source, $context["product"], "preview", [], "any", false, false, false, 97);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 97);
                echo "</a>
\t\t\t</div>
\t\t\t<div class=\"col-lg-2 d-none d-lg-block text-center text-danger\">";
                // line 99
                if (twig_get_attribute($this->env, $this->source, $context["product"], "special", [], "any", false, false, false, 99)) {
                    echo "<span style=\"text-decoration: line-through;\">";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 99);
                    echo "</span><br/><div>";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "special", [], "any", false, false, false, 99);
                    echo "</div>";
                } else {
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 99);
                }
                echo "</div>
\t\t\t<div class=\"col-lg-1 d-none d-lg-block text-center\">";
                // line 100
                if ((twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 100) <= 0)) {
                    echo "<span class=\"text-warning\">";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 100);
                    echo "</span>";
                } elseif ((twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 100) <= 5)) {
                    echo "<span class=\"text-danger\">";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 100);
                    echo "</span>";
                } else {
                    echo "<span class=\"text-success\">";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 100);
                    echo "</span>";
                }
                echo "</div>
\t\t\t<div class=\"col-3 col-lg-1 d-none d-lg-block text-end\">
\t\t\t  <div class=\"dropdown\">
\t\t\t\t<button\tclass=\"btn btn-primary\"\ttype=\"button\" id=\"";
                // line 103
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 103);
                echo "dropdownMenuButton\" data-mdb-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fas fa-bars\"></i></button>
\t\t\t\t<ul class=\"dropdown-menu\" aria-labelledby=\"";
                // line 104
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 104);
                echo "dropdownMenuButton\">
\t\t\t\t  <li><a class=\"dropdown-item\" href=\"";
                // line 105
                echo twig_get_attribute($this->env, $this->source, $context["product"], "edit", [], "any", false, false, false, 105);
                echo "\"><i class=\"fas fa-pencil-alt me-2\"></i>";
                echo ($context["button_edit"] ?? null);
                echo "</a></li>
\t\t\t\t  <li><button data-sku=\"";
                // line 106
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 106);
                echo "\" class=\"dropdown-item btn-cart\"><i class=\"fas fa-shopping-cart me-2\"></i>";
                echo ($context["button_cart"] ?? null);
                echo "</button></li>
\t\t\t\t  <li><button data-sku=\"";
                // line 107
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 107);
                echo "\" data-status=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "status", [], "any", false, false, false, 107);
                echo "\" class=\"dropdown-item btn-disable\">";
                if ((twig_get_attribute($this->env, $this->source, $context["product"], "status", [], "any", false, false, false, 107) == "0")) {
                    echo "<i class=\"fas fa-eye me-2\"></i>";
                    echo ($context["button_enable"] ?? null);
                } else {
                    echo "<i class=\"fas fa-eye-slash me-2\"></i>";
                    echo ($context["button_disable"] ?? null);
                }
                echo "</button></li>
\t\t\t\t  <li><button data-sku=\"";
                // line 108
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 108);
                echo "\" id=\"btn-onlineshop-synchronization-";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 108);
                echo "-mob\" class=\"dropdown-item btn-onlineshop-synchronization\"><i class=\"fas fa-sync me-2\"></i>";
                echo ($context["button_onlineshop_synchronization"] ?? null);
                echo "</button></li>
\t\t\t\t  <li><a class=\"dropdown-item text-danger\" href=\"";
                // line 109
                echo twig_get_attribute($this->env, $this->source, $context["product"], "delete", [], "any", false, false, false, 109);
                echo "\"><i class=\"fas fa-trash me-2\"></i>";
                echo ($context["button_delete"] ?? null);
                echo "</a></li>
\t\t\t\t</ul>
\t\t\t  </div>
\t\t\t</div>
\t\t\t<div class=\"d-flex d-lg-none col-lg-12 align-items-center mb-3\">
\t\t\t  <div><img src=\"";
                // line 114
                echo twig_get_attribute($this->env, $this->source, $context["product"], "image_min", [], "any", false, false, false, 114);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 114);
                echo "\" href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "image", [], "any", false, false, false, 114);
                echo "\" style=\"min-width: 75px; top: 0;\" class=\"img-thumbnail product-image me-4\" /></div>
\t\t\t  <div class=\"flex-fill d-flex flex-column\">
\t\t\t\t<a href=\"";
                // line 116
                echo twig_get_attribute($this->env, $this->source, $context["product"], "preview", [], "any", false, false, false, 116);
                echo "\" class=\"fs-7\" style=\"min-height: 30px;\">";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name_min", [], "any", false, false, false, 116);
                echo "</a>
\t\t\t\t<div>
\t\t\t\t  <a class=\"btn btn-primary btn-floating me-1 mt-2\" href=\"";
                // line 118
                echo twig_get_attribute($this->env, $this->source, $context["product"], "edit", [], "any", false, false, false, 118);
                echo "\"><i class=\"fas fa-pencil-alt\"></i></a>
\t\t\t\t  <button data-sku=\"";
                // line 119
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 119);
                echo "\" class=\"btn btn-primary btn-floating btn-cart me-1 mt-2\"><i class=\"fas fa-shopping-cart\"></i></button>
\t\t\t\t  <button data-sku=\"";
                // line 120
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 120);
                echo "\" id=\"btn-onlineshop-synchronization-";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 120);
                echo "\" class=\"btn btn-primary btn-floating btn-onlineshop-synchronization me-1 mt-2\"><i class=\"fas fa-sync\"></i></button>
\t\t\t\t  <a class=\"btn btn-danger btn-floating mt-2\" href=\"";
                // line 121
                echo twig_get_attribute($this->env, $this->source, $context["product"], "delete", [], "any", false, false, false, 121);
                echo "\"><i class=\"fas fa-trash\"></i></a>
\t\t\t\t</div>
\t\t\t  </div>\t\t\t  
\t\t\t</div>
\t\t\t<div class=\"col-4 d-lg-none text-center\">";
                // line 125
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 125);
                echo "</div>
\t\t\t<div class=\"col-4 d-lg-none text-center\">";
                // line 126
                if ((twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 126) <= 0)) {
                    echo "<span class=\"text-warning\">";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 126);
                    echo "</span>";
                } elseif ((twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 126) <= 5)) {
                    echo "<span class=\"text-danger\">";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 126);
                    echo "</span>";
                } else {
                    echo "<span class=\"text-success\">";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 126);
                    echo "</span>";
                }
                echo "</div>
\t\t\t<div class=\"col-4 d-lg-none text-center text-danger\">";
                // line 127
                if (twig_get_attribute($this->env, $this->source, $context["product"], "special", [], "any", false, false, false, 127)) {
                    echo "<span style=\"text-decoration: line-through;\">";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 127);
                    echo "</span><br/><div>";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "special", [], "any", false, false, false, 127);
                    echo "</div>";
                } else {
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 127);
                }
                echo "</div>
\t\t</div>
\t  </div>
\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 131
            echo "\t";
        }
        // line 132
        echo "\t<div class=\"row mt-3 mb-3\">
\t  <div class=\"col-sm-6 text-start\">";
        // line 133
        echo ($context["pagination"] ?? null);
        echo "</div>
\t  <div class=\"col-sm-6 text-end\">";
        // line 134
        echo ($context["results"] ?? null);
        echo "</div>
\t</div>
  </div>
</main>
";
        // line 138
        echo ($context["footer"] ?? null);
        echo "
<script>
\$(document).ready(function() {
  ";
        // line 141
        if (($context["sync_product"] ?? null)) {
            // line 142
            echo "    \$('#btn-onlineshop-synchronization-";
            echo ($context["sync_product"] ?? null);
            echo "').trigger('click');
  ";
        }
        // line 144
        echo "
  \$('.product-image').magnificPopup({
\ttype:'image',
\tgallery: {
\t\tenabled: false
\t}
  });
  
  filterCategoryInit([
    ";
        // line 153
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 154
            echo "\t{id: \"";
            echo twig_get_attribute($this->env, $this->source, $context["category"], "category_id", [], "any", false, false, false, 154);
            echo "\", image: \"";
            echo twig_get_attribute($this->env, $this->source, $context["category"], "image", [], "any", false, false, false, 154);
            echo "\", name: \"";
            echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 154);
            echo "\"";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["filter_category"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["category_id"]) {
                if (($context["category_id"] == twig_get_attribute($this->env, $this->source, $context["category"], "category_id", [], "any", false, false, false, 154))) {
                    echo ", active: 1";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category_id'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "},
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 156
        echo "  ]);
  
  const asyncFilter = async (query) => {
\tconst url = `";
        // line 159
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/product.autocompleteSearch&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&search=\${encodeURI(query)}`;
\tconst response = await fetch(url);
\tconst data = await response.json();
\t
\treturn data;
  };
  
  \$('#search,#search-m').autocomplete({
\tfilter: asyncFilter,
\tautoSelect: true,
\tnoResults: '',
\tdisplayValue: function(value) {
\t  return value.name;
\t}
  });
  
  \$('#search,#search-m').on('itemSelect.mdb.autocomplete', function(e) {
\tif(e.value.sku !== undefined) {
\t  location = '";
        // line 177
        echo ($context["product"] ?? null);
        echo "&search=' + e.value.sku;
\t}
  });
  
  \$('input[name=\\'search\\']').keydown(function(e) {
    window.setTimeout(function() {
\t  if(e.keyCode == 13 && e.target.classList.contains('focused') === true) {
\t\t\$('#btn-search').trigger('click');
\t  }
\t}, 50);
  });
  
  \$('input[name=\\'search-m\\']').keydown(function(e) {
\twindow.setTimeout(function() {
\t  if(e.keyCode == 13 && e.target.classList.contains('focused') === true) {
\t\t\$('#btn-search-m').trigger('click');
\t  }
\t}, 50);
  });
});

\$('.btn-disable').click(function(e) {
  e.currentTarget.disabled = true;
  
  let url;
  
  if(e.currentTarget.attributes['data-status'].value === '1') {
\turl = '";
        // line 204
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/product.disableProduct&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&sku=' + e.currentTarget.attributes['data-sku'].value;
  } else {
\turl = '";
        // line 206
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/product.enableProduct&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&sku=' + e.currentTarget.attributes['data-sku'].value;
  }

  \$.ajax({
\turl: url,
\tdataType: 'json',
\tsuccess: function(json) {
\t  if(e.currentTarget.attributes['data-status'].value === '1') {
\t\te.currentTarget.attributes['data-status'].value = 0;
\t\te.currentTarget.innerHTML = '<i class=\"fas fa-eye me-2\"></i>";
        // line 215
        echo ($context["button_enable"] ?? null);
        echo "';
\t\t\$('#'+e.currentTarget.attributes['data-sku'].value).addClass('bg-dark');
\t  } else {
\t\te.currentTarget.attributes['data-status'].value = 1;
\t\te.currentTarget.innerHTML = '<i class=\"fas fa-eye-slash me-2\"></i>";
        // line 219
        echo ($context["button_disable"] ?? null);
        echo "';
\t\t\$('#'+e.currentTarget.attributes['data-sku'].value).removeClass('bg-dark');
\t  }
\t  
\t  if(json['alerts'] !== undefined) {
\t\tfor(let i = 0; i < json['alerts'].length; i++) {
\t\t  addAlert(json['alerts'][i]['title'], json['alerts'][i]['alert'], json['alerts'][i]['type']);
\t\t}
\t  }
\t  
\t  e.currentTarget.disabled = false;
\t}
  });
});

\$('.btn-onlineshop-synchronization').click(function(e) {
  ";
        // line 235
        if ((($context["sync_product"] ?? null) == "")) {
            // line 236
            echo "  loading();
  ";
        }
        // line 238
        echo "  
  \$('#btn-onlineshop-synchronization-' + e.currentTarget.attributes['data-sku'].value).attr('disabled', true);
  \$('#btn-onlineshop-synchronization-' +  e.currentTarget.attributes['data-sku'].value + '-mob').attr('disabled', true);
  
  let delay;

  \$.ajax({
\turl: '";
        // line 245
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/product.onlineshopSynchronization&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&sku=' + e.currentTarget.attributes['data-sku'].value,
\tdataType: 'json',
\tsuccess: function(json) {
\t  if(json['alerts'] !== undefined) {
\t\tfor(let i = 0; i < json['alerts'].length; i++) {
\t\t  delay = 0;
  
\t\t  if(json['alerts'][i]['type'] === 'success') {
\t\t\tdelay = 5000;
\t\t  }

\t\t  addAlert(json['alerts'][i]['title'], json['alerts'][i]['alert'], json['alerts'][i]['type'], delay);
\t\t  
\t\t  \$('#btn-onlineshop-synchronization-' + e.currentTarget.attributes['data-sku'].value).attr('disabled', false);
\t\t  \$('#btn-onlineshop-synchronization-' +  e.currentTarget.attributes['data-sku'].value + '-mob').attr('disabled', false);
\t\t  
\t\t  ";
        // line 261
        if ((($context["sync_product"] ?? null) == "")) {
            // line 262
            echo "\t\t  loading(false);
\t\t  ";
        }
        // line 264
        echo "\t\t}
\t  }
\t}
  });
});

\$('select[name=\\'filter_vehicle_brand\\']').change(function() {
  filter();
});

\$('select[name=\\'filter_vehicle_model\\']').change(function() {
  filter();
});

\$('select[name=\\'filter_vehicle_engine\\']').change(function() {
  filter();
});

\$('#select-warehouse_id').change(function() {
  filter();
});

function filter() {
  let url = '';
\t
  let filterBrand = \$('select[name=\\'filter_vehicle_brand\\']').val();

  if (filterBrand != '') {
\turl += '&filter_vehicle_brand=' + encodeURIComponent(filterBrand);
  }

  let filterModel = \$('select[name=\\'filter_vehicle_model\\']').val();

  if (filterBrand != '' && filterModel != '') {
\turl += '&filter_vehicle_model=' + encodeURIComponent(filterModel);
  }
\t
  let filterEngine = \$('select[name=\\'filter_vehicle_engine\\']').val();

  if (filterBrand != '' && filterModel != '' && filterEngine != '') {
\turl += '&filter_vehicle_engine=' + encodeURIComponent(filterEngine);
  }
  
  let warehouseId = \$('#select-warehouse_id').val();

  if (warehouseId != '0') {
\turl += '&warehouse_id=' + encodeURIComponent(warehouseId);
  }
  
  let sort = '";
        // line 313
        echo ($context["sort"] ?? null);
        echo "';
  
  if (sort) {
\turl += '&sort=' + encodeURIComponent(sort);
  }
  
  let order = '";
        // line 319
        echo ($context["order"] ?? null);
        echo "';
  
  if (order) {
\turl += '&order=' + encodeURIComponent(order);
  }
\t
  location = '";
        // line 325
        echo ($context["product"] ?? null);
        echo "' + url;
}

\$('#btn-search').on('click', function() {
  let url = '';

  let search = \$('input[name=\\'search\\']').val();

  if (search) {
\turl += '&search=' + encodeURIComponent(search);
  }
  
  let warehouseId = \$('#select-warehouse_id').val();

  if (warehouseId != '0') {
\turl += '&warehouse_id=' + encodeURIComponent(warehouseId);
  }
\t
  let sort = '";
        // line 343
        echo ($context["sort"] ?? null);
        echo "';
  
  if (sort) {
\turl += '&sort=' + encodeURIComponent(sort);
  }
  
  let order = '";
        // line 349
        echo ($context["order"] ?? null);
        echo "';
  
  if (order) {
\turl += '&order=' + encodeURIComponent(order);
  }
\t
  location = '";
        // line 355
        echo ($context["product"] ?? null);
        echo "' + url;
});

\$('#btn-search-m').on('click', function() {
  let url = '';

  let search = \$('input[name=\\'search-m\\']').val();

  if (search) {
\turl += '&search=' + encodeURIComponent(search);
  }
  
  let warehouseId = \$('#select-warehouse_id').val();

  if (warehouseId != '0') {
\turl += '&warehouse_id=' + encodeURIComponent(warehouseId);
  }
\t
  let sort = '";
        // line 373
        echo ($context["sort"] ?? null);
        echo "';
  
  if (sort) {
\turl += '&sort=' + encodeURIComponent(sort);
  }
  
  let order = '";
        // line 379
        echo ($context["order"] ?? null);
        echo "';
  
  if (order) {
\turl += '&order=' + encodeURIComponent(order);
  }
\t
  location = '";
        // line 385
        echo ($context["product"] ?? null);
        echo "' + url;
});

function filterCategoryInit(items) {
  if(items.length) {
\t\$('#categories-carousel').addClass('mt-3');
  } else {
\t\$('#categories-carousel').removeClass('mt-3');
\treturn;
  }

  let url = '';
\t
  let filterBrand = \$('select[name=\\'filter_vehicle_brand\\']').val();

  if (filterBrand != '') {
\turl += '&filter_vehicle_brand=' + encodeURIComponent(filterBrand);
  }

  let filterModel = \$('select[name=\\'filter_vehicle_model\\']').val();

  if (filterBrand != '' && filterModel != '') {
\turl += '&filter_vehicle_model=' + encodeURIComponent(filterModel);
  }
\t
  let filterEngine = \$('select[name=\\'filter_vehicle_engine\\']').val();

  if (filterBrand != '' && filterModel != '' && filterEngine != '') {
\turl += '&filter_vehicle_engine=' + encodeURIComponent(filterEngine);
  }
  
  let warehouseId = \$('#select-warehouse_id').val();

  if (warehouseId != '0') {
\turl += '&warehouse_id=' + encodeURIComponent(warehouseId);
  }
\t
  let sort = '";
        // line 422
        echo ($context["sort"] ?? null);
        echo "';
  
  if (sort) {
\turl += '&sort=' + encodeURIComponent(sort);
  }
  
  let order = '";
        // line 428
        echo ($context["order"] ?? null);
        echo "';
  
  if (order) {
\turl += '&order=' + encodeURIComponent(order);
  }
\t
  url += '&filter_category='
  
  let carouselItems = [];
  let item;
  
  for(let i = 0; i < items.length; i++) {
\titem = {};
\titem.url = '";
        // line 441
        echo ($context["product"] ?? null);
        echo "' + url + items[i].id;
\titem.image = items[i].image != '' ? '";
        // line 442
        echo ($context["url_image"] ?? null);
        echo "' + items[i].image : '';
\titem.title = items[i].name;
\t
\tif(items[i].active) {
\t  item.active = 1;
\t}
  
\tcarouselItems.push(item);
  }
  
  \$('#categories-carousel').carousel2(carouselItems);
}
</script>";
    }

    public function getTemplateName()
    {
        return "view/template/catalog/product_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  915 => 442,  911 => 441,  895 => 428,  886 => 422,  846 => 385,  837 => 379,  828 => 373,  807 => 355,  798 => 349,  789 => 343,  768 => 325,  759 => 319,  750 => 313,  699 => 264,  695 => 262,  693 => 261,  672 => 245,  663 => 238,  659 => 236,  657 => 235,  638 => 219,  631 => 215,  617 => 206,  610 => 204,  580 => 177,  557 => 159,  552 => 156,  528 => 154,  524 => 153,  513 => 144,  507 => 142,  505 => 141,  499 => 138,  492 => 134,  488 => 133,  485 => 132,  482 => 131,  464 => 127,  448 => 126,  444 => 125,  437 => 121,  431 => 120,  427 => 119,  423 => 118,  416 => 116,  407 => 114,  397 => 109,  389 => 108,  375 => 107,  369 => 106,  363 => 105,  359 => 104,  355 => 103,  337 => 100,  325 => 99,  318 => 97,  314 => 96,  308 => 95,  300 => 94,  289 => 91,  285 => 90,  281 => 88,  266 => 86,  262 => 85,  257 => 82,  246 => 80,  242 => 79,  236 => 75,  233 => 74,  225 => 69,  222 => 68,  207 => 66,  203 => 65,  195 => 60,  192 => 59,  175 => 57,  171 => 56,  163 => 51,  160 => 50,  145 => 48,  141 => 47,  135 => 43,  133 => 42,  126 => 38,  122 => 37,  113 => 33,  105 => 28,  101 => 27,  95 => 23,  80 => 21,  76 => 20,  72 => 19,  66 => 15,  58 => 11,  55 => 10,  47 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/catalog/product_list.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/catalog/product_list.twig");
    }
}
