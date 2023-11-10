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

/* view/template/catalog/import_export.twig */
class __TwigTemplate_0d643f68b432513f296d3a1c71a944be2274d1859d66cedfe910e0a180f86ed1 extends Template
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
        echo "\t<ul class=\"nav nav-tabs mb-3\" id=\"navtabs\" role=\"tablist\">
\t  <li class=\"nav-item\" role=\"presentation\">
\t\t<a class=\"nav-link active\" id=\"navtabs-tab-import\" data-mdb-toggle=\"tab\" href=\"#navtabs-tabs-import\" role=\"tab\" aria-controls=\"navtabs-tabs-import\" aria-selected=\"true\">";
        // line 17
        echo ($context["tab_import"] ?? null);
        echo "</a>
\t  </li>
\t  <li class=\"nav-item\" role=\"presentation\">
\t\t<a class=\"nav-link\" id=\"navtabs-tab-export\" data-mdb-toggle=\"tab\" href=\"#navtabs-tabs-export\" role=\"tab\" aria-controls=\"navtabs-tabs-export\" aria-selected=\"false\">";
        // line 20
        echo ($context["tab_export"] ?? null);
        echo "</a>
\t  </li>
\t  <li class=\"nav-item\" role=\"presentation\">
\t\t<a class=\"nav-link\" id=\"navtabs-tab-backup\" data-mdb-toggle=\"tab\" href=\"#navtabs-tabs-backup\" role=\"tab\" aria-controls=\"navtabs-tabs-backup\" aria-selected=\"false\">";
        // line 23
        echo ($context["tab_backup"] ?? null);
        echo "</a>
\t  </li>
\t</ul>
\t<div class=\"tab-content\" id=\"navtabs-content\">
\t  <div class=\"tab-pane fade show active\" id=\"navtabs-tabs-import\" role=\"tabpanel\" aria-labelledby=\"navtabs-tab-import\">
\t\t<div class=\"mb-3\">
\t\t  <button type=\"button\" class=\"btn btn-primary\" data-mdb-toggle=\"modal\" data-mdb-target=\"#upload-modal\"><i class=\"fas fa-upload me-2\"></i>";
        // line 29
        echo ($context["text_upload_csv"] ?? null);
        echo "</button>
\t\t  ";
        // line 30
        if (($context["import_total"] ?? null)) {
            echo "<button type=\"button\" class=\"btn btn-primary\" data-mdb-toggle=\"modal\" data-mdb-target=\"#example-modal\"><i class=\"far fa-eye me-2\"></i>";
            echo ($context["text_csv_preview"] ?? null);
            echo "</button>";
        }
        // line 31
        echo "\t\t</div>
\t\t<div class=\"modal fade\" id=\"upload-modal\" tabindex=\"-1\" aria-labelledby=\"upload-modal-label\" aria-hidden=\"true\">
\t\t  <div class=\"modal-dialog modal-xl\">
\t\t\t<div class=\"modal-content\">
\t\t\t  <form action=\"";
        // line 35
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-import\" class=\"form-horizontal mb-3\">
\t\t\t  <div class=\"modal-header\">
\t\t\t\t<h5 class=\"modal-title\" id=\"upload-modal-label\">";
        // line 37
        echo ($context["text_upload_csv"] ?? null);
        echo "</h5>
\t\t\t\t<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"modal\" aria-label=\"";
        // line 38
        echo ($context["button_close"] ?? null);
        echo "\"></button>
\t\t\t  </div>
\t\t\t  <div class=\"modal-body\">
\t\t\t\t<div class=\"alert\" role=\"alert\" data-mdb-color=\"primary\"><i class=\"fas fa-info-circle me-3\"></i>";
        // line 41
        echo ($context["alert_charset"] ?? null);
        echo "</div>
\t\t\t\t<div class=\"mb-3\">
\t\t\t\t  <label class=\"form-label\" for=\"input-import_csv_list\">";
        // line 43
        echo ($context["text_select_csv"] ?? null);
        echo "</label>
\t\t\t\t  <input type=\"file\" name=\"import_csv_list\" class=\"form-control\" accept=\".csv\" id=\"input-import_csv_list\"/>
\t\t\t\t</div>
\t\t\t\t<div>
\t\t\t\t  <select class=\"select\" name=\"import_csv_separator\">
\t\t\t\t\t<option value=\"coma\">,</option>
\t\t\t\t\t<option value=\"coma_point\">;</option>
\t\t\t\t\t<option value=\"tab\">tab</option>
\t\t\t\t  </select>
\t\t\t\t  <label class=\"form-label select-label\">";
        // line 52
        echo ($context["text_select_csv_separator"] ?? null);
        echo "</label>
\t\t\t\t</div>
\t\t\t  </div>
\t\t\t  <div class=\"modal-footer\">
\t\t\t\t<button type=\"button\" class=\"btn btn-secondary\" data-mdb-dismiss=\"modal\">";
        // line 56
        echo ($context["button_close"] ?? null);
        echo "</button>
\t\t\t\t<button type=\"submit\" class=\"btn btn-primary\" onclick=\"loading();\"><i class=\"fa fa-save me-2\"></i>";
        // line 57
        echo ($context["button_save"] ?? null);
        echo "</button>
\t\t\t  </div>
\t\t\t  </form>
\t\t\t</div>
\t\t  </div>
\t\t</div>
\t\t";
        // line 63
        if (($context["import_total"] ?? null)) {
            // line 64
            echo "\t\t<div class=\"modal fade\" id=\"example-modal\" tabindex=\"-1\" aria-labelledby=\"example-modal-label\" aria-hidden=\"true\">
\t\t  <div class=\"modal-dialog modal-xl\">
\t\t\t<div class=\"modal-content\">
\t\t\t  <div class=\"modal-header\">
\t\t\t\t<h5 class=\"modal-title\" id=\"example-modal-label\">";
            // line 68
            echo ($context["text_csv_preview"] ?? null);
            echo "</h5>
\t\t\t\t<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"modal\" aria-label=\"";
            // line 69
            echo ($context["button_close"] ?? null);
            echo "\"></button>
\t\t\t  </div>
\t\t\t  <div class=\"modal-body overflow-auto\">
\t\t\t\t<table class=\"table table-bordered\">
\t\t\t\t  <tbody>
\t\t\t\t\t";
            // line 74
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["import_csv_values"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["values"]) {
                // line 75
                echo "\t\t\t\t\t<tr>
\t\t\t\t\t  ";
                // line 76
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["values"]);
                foreach ($context['_seq'] as $context["_key"] => $context["csv_value"]) {
                    // line 77
                    echo "\t\t\t\t\t  <td>";
                    echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "value", [], "any", false, false, false, 77);
                    echo "</td>
\t\t\t\t\t  ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['csv_value'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 79
                echo "\t\t\t\t\t</tr>
\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['values'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 81
            echo "\t\t\t\t  </tbody>
\t\t\t\t</table>
\t\t\t  </div>
\t\t\t  <div class=\"modal-footer\">
\t\t\t\t<button type=\"button\" class=\"btn btn-secondary\" data-mdb-dismiss=\"modal\">";
            // line 85
            echo ($context["button_close"] ?? null);
            echo "</button>
\t\t\t  </div>
\t\t\t</div>
\t\t  </div>
\t\t</div>
\t\t<div class=\"mb-3\">
\t\t  <select class=\"select\" id=\"import-product_name\" name=\"product_name\">
\t\t\t<option value=\"\"></option>
\t\t\t";
            // line 93
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["import_csv_values"] ?? null), 0, [], "any", false, false, false, 93));
            foreach ($context['_seq'] as $context["_key"] => $context["csv_value"]) {
                // line 94
                echo "\t\t\t<option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "key", [], "any", false, false, false, 94);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "value", [], "any", false, false, false, 94);
                echo "</option>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['csv_value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 96
            echo "\t\t  </select>
\t\t  <label class=\"form-label select-label\">";
            // line 97
            echo ($context["text_product_name"] ?? null);
            echo "</label>
\t\t</div>
\t\t<div class=\"mb-3\">
\t\t  <select class=\"select\" id=\"import-product_description\" name=\"product_description\">
\t\t\t<option value=\"\"></option>
\t\t\t";
            // line 102
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["import_csv_values"] ?? null), 0, [], "any", false, false, false, 102));
            foreach ($context['_seq'] as $context["_key"] => $context["csv_value"]) {
                // line 103
                echo "\t\t\t<option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "key", [], "any", false, false, false, 103);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "value", [], "any", false, false, false, 103);
                echo "</option>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['csv_value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 105
            echo "\t\t  </select>
\t\t  <label class=\"form-label select-label\">";
            // line 106
            echo ($context["text_product_description"] ?? null);
            echo "</label>
\t\t</div>
\t\t<div class=\"mb-3\">
\t\t  <select class=\"select\" id=\"import-price\" name=\"price\">
\t\t\t<option value=\"\"></option>
\t\t\t";
            // line 111
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["import_csv_values"] ?? null), 0, [], "any", false, false, false, 111));
            foreach ($context['_seq'] as $context["_key"] => $context["csv_value"]) {
                // line 112
                echo "\t\t\t<option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "key", [], "any", false, false, false, 112);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "value", [], "any", false, false, false, 112);
                echo "</option>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['csv_value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 114
            echo "\t\t  </select>
\t\t  <label class=\"form-label select-label\">";
            // line 115
            echo ($context["text_price"] ?? null);
            echo "</label>
\t\t</div>
\t\t<div class=\"mb-3\">
\t\t  <select class=\"select\" id=\"import-currency\" name=\"currency\">
\t\t\t";
            // line 119
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["currencies"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["currency"]) {
                // line 120
                echo "\t\t\t<option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 120);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 120);
                echo " ";
                echo ($context["text_for_all_products"] ?? null);
                echo "</option>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['currency'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 122
            echo "\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["import_csv_values"] ?? null), 0, [], "any", false, false, false, 122));
            foreach ($context['_seq'] as $context["_key"] => $context["csv_value"]) {
                // line 123
                echo "\t\t\t<option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "key", [], "any", false, false, false, 123);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "value", [], "any", false, false, false, 123);
                echo "</option>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['csv_value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 125
            echo "\t\t  </select>
\t\t  <label class=\"form-label select-label\">";
            // line 126
            echo ($context["text_currency"] ?? null);
            echo "</label>
\t\t</div>
\t\t<div class=\"mb-3\">
\t\t  <select class=\"select\" id=\"import-quantity\" name=\"quantity\">
\t\t\t<option value=\"\"></option>
\t\t\t";
            // line 131
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["import_csv_values"] ?? null), 0, [], "any", false, false, false, 131));
            foreach ($context['_seq'] as $context["_key"] => $context["csv_value"]) {
                // line 132
                echo "\t\t\t<option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "key", [], "any", false, false, false, 132);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "value", [], "any", false, false, false, 132);
                echo "</option>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['csv_value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 134
            echo "\t\t  </select>
\t\t  <label class=\"form-label select-label\">";
            // line 135
            echo ($context["text_quantity"] ?? null);
            echo "</label>
\t\t</div>
\t\t<div class=\"mb-3\">
\t\t  <select class=\"select\" id=\"import-quality\" name=\"quality\">
\t\t\t<option value=\"new\">";
            // line 139
            echo ($context["text_quality_new"] ?? null);
            echo " ";
            echo ($context["text_for_all_products"] ?? null);
            echo "</option>
\t\t\t<option value=\"used\">";
            // line 140
            echo ($context["text_quality_used"] ?? null);
            echo " ";
            echo ($context["text_for_all_products"] ?? null);
            echo "</option>
\t\t\t";
            // line 141
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["import_csv_values"] ?? null), 0, [], "any", false, false, false, 141));
            foreach ($context['_seq'] as $context["_key"] => $context["csv_value"]) {
                // line 142
                echo "\t\t\t<option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "key", [], "any", false, false, false, 142);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "value", [], "any", false, false, false, 142);
                echo "</option>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['csv_value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 144
            echo "\t\t  </select>
\t\t  <label class=\"form-label select-label\">";
            // line 145
            echo ($context["text_quality"] ?? null);
            echo "</label>
\t\t</div>
\t\t<div class=\"mb-3\">
\t\t  <select class=\"select\" id=\"import-product_image\" name=\"product_image\">
\t\t\t<option value=\"\"></option>
\t\t\t";
            // line 150
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["import_csv_values"] ?? null), 0, [], "any", false, false, false, 150));
            foreach ($context['_seq'] as $context["_key"] => $context["csv_value"]) {
                // line 151
                echo "\t\t\t<option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "key", [], "any", false, false, false, 151);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "value", [], "any", false, false, false, 151);
                echo "</option>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['csv_value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 153
            echo "\t\t  </select>
\t\t  <label class=\"form-label select-label\">";
            // line 154
            echo ($context["text_product_image"] ?? null);
            echo "</label>
\t\t</div>
\t\t<div class=\"form-outline mb-3\">
\t\t  <input type=\"text\" id=\"import-product_image_separator\" name=\"product_image_separator\" class=\"form-control\" />
\t\t  <label class=\"form-label\" for=\"input-product_image_separator\">";
            // line 158
            echo ($context["text_product_image_separator"] ?? null);
            echo "</label>
\t\t</div>
\t\t<div class=\"mb-3\">
\t\t\t<select class=\"select\" id=\"import-sku\" name=\"sku\">
\t\t\t  <option value=\"\"></option>
\t\t\t  ";
            // line 163
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["import_csv_values"] ?? null), 0, [], "any", false, false, false, 163));
            foreach ($context['_seq'] as $context["_key"] => $context["csv_value"]) {
                // line 164
                echo "\t\t\t  <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "key", [], "any", false, false, false, 164);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "value", [], "any", false, false, false, 164);
                echo "</option>
\t\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['csv_value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 166
            echo "\t\t\t</select>
\t\t\t<label class=\"form-label select-label\">";
            // line 167
            echo ($context["text_sku"] ?? null);
            echo "</label>
\t\t</div>
\t\t<button class=\"btn btn-primary\" type=\"button\" data-mdb-toggle=\"collapse\" data-mdb-target=\"#collapse\" aria-expanded=\"false\" aria-controls=\"collapse\">";
            // line 169
            echo ($context["button_more"] ?? null);
            echo "</button>
\t\t<div class=\"collapse mt-3\" id=\"collapse\">
\t\t  <div class=\"mb-3\">
\t\t\t<select class=\"select\" id=\"import-product_category\" name=\"product_category\">
\t\t\t  <option value=\"\"></option>
\t\t\t  ";
            // line 174
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["import_csv_values"] ?? null), 0, [], "any", false, false, false, 174));
            foreach ($context['_seq'] as $context["_key"] => $context["csv_value"]) {
                // line 175
                echo "\t\t\t  <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "key", [], "any", false, false, false, 175);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "value", [], "any", false, false, false, 175);
                echo "</option>
\t\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['csv_value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 177
            echo "\t\t\t</select>
\t\t\t<label class=\"form-label select-label\">";
            // line 178
            echo ($context["text_product_category"] ?? null);
            echo "</label>
\t\t  </div>
\t\t  <div class=\"mb-3\">
\t\t\t<select class=\"select\" id=\"import-product_vehicle\" name=\"product_vehicle\">
\t\t\t  <option value=\"\"></option>
\t\t\t  ";
            // line 183
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["import_csv_values"] ?? null), 0, [], "any", false, false, false, 183));
            foreach ($context['_seq'] as $context["_key"] => $context["csv_value"]) {
                // line 184
                echo "\t\t\t  <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "key", [], "any", false, false, false, 184);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "value", [], "any", false, false, false, 184);
                echo "</option>
\t\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['csv_value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 186
            echo "\t\t\t</select>
\t\t\t<label class=\"form-label select-label\">";
            // line 187
            echo ($context["text_product_vehicle"] ?? null);
            echo "</label>
\t\t  </div>
\t\t  <div class=\"mb-3\">
\t\t\t<select class=\"select\" id=\"import-brand\" name=\"brand\">
\t\t\t  <option value=\"\"></option>
\t\t\t  ";
            // line 192
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["import_csv_values"] ?? null), 0, [], "any", false, false, false, 192));
            foreach ($context['_seq'] as $context["_key"] => $context["csv_value"]) {
                // line 193
                echo "\t\t\t  <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "key", [], "any", false, false, false, 193);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "value", [], "any", false, false, false, 193);
                echo "</option>
\t\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['csv_value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 195
            echo "\t\t\t</select>
\t\t\t<label class=\"form-label select-label\">";
            // line 196
            echo ($context["text_brand"] ?? null);
            echo "</label>
\t\t  </div>
\t\t  <div class=\"mb-3\">
\t\t\t<select class=\"select\" id=\"import-mpn\" name=\"mpn\">
\t\t\t  <option value=\"\"></option>
\t\t\t  ";
            // line 201
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["import_csv_values"] ?? null), 0, [], "any", false, false, false, 201));
            foreach ($context['_seq'] as $context["_key"] => $context["csv_value"]) {
                // line 202
                echo "\t\t\t  <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "key", [], "any", false, false, false, 202);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "value", [], "any", false, false, false, 202);
                echo "</option>
\t\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['csv_value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 204
            echo "\t\t\t</select>
\t\t\t<label class=\"form-label select-label\">";
            // line 205
            echo ($context["text_mpn"] ?? null);
            echo "</label>
\t\t  </div>
\t\t  <div class=\"mb-3\">
\t\t\t<select class=\"select\" id=\"import-oe\" name=\"oe\">
\t\t\t  <option value=\"\"></option>
\t\t\t  ";
            // line 210
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["import_csv_values"] ?? null), 0, [], "any", false, false, false, 210));
            foreach ($context['_seq'] as $context["_key"] => $context["csv_value"]) {
                // line 211
                echo "\t\t\t  <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "key", [], "any", false, false, false, 211);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "value", [], "any", false, false, false, 211);
                echo "</option>
\t\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['csv_value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 213
            echo "\t\t\t</select>
\t\t\t<label class=\"form-label select-label\">";
            // line 214
            echo ($context["text_oe"] ?? null);
            echo "</label>
\t\t  </div>
\t\t  <div class=\"mb-3\">
\t\t\t<select class=\"select\" id=\"import-others\" name=\"others\">
\t\t\t  <option value=\"\"></option>
\t\t\t  ";
            // line 219
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["import_csv_values"] ?? null), 0, [], "any", false, false, false, 219));
            foreach ($context['_seq'] as $context["_key"] => $context["csv_value"]) {
                // line 220
                echo "\t\t\t  <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "key", [], "any", false, false, false, 220);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "value", [], "any", false, false, false, 220);
                echo "</option>
\t\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['csv_value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 222
            echo "\t\t\t</select>
\t\t\t<label class=\"form-label select-label\">";
            // line 223
            echo ($context["text_others"] ?? null);
            echo "</label>
\t\t  </div>
\t\t  <div class=\"mb-3\">
\t\t\t<select class=\"select\" id=\"import-weight\" name=\"weight\">
\t\t\t  <option value=\"\"></option>
\t\t\t  ";
            // line 228
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["import_csv_values"] ?? null), 0, [], "any", false, false, false, 228));
            foreach ($context['_seq'] as $context["_key"] => $context["csv_value"]) {
                // line 229
                echo "\t\t\t  <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "key", [], "any", false, false, false, 229);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["csv_value"], "value", [], "any", false, false, false, 229);
                echo "</option>
\t\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['csv_value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 231
            echo "\t\t\t</select>
\t\t\t<label class=\"form-label select-label\">";
            // line 232
            echo ($context["text_weight"] ?? null);
            echo "</label>
\t\t  </div>
\t\t</div>
\t\t<div class=\"input-group mt-3 mb-3\">
\t\t  <span class=\"input-group-text border-0\">";
            // line 236
            echo ($context["text_import_start_from"] ?? null);
            echo "</span>
\t\t  <input type=\"number\" id=\"input-import-start\" value=\"1\" min=\"1\" class=\"form-control rounded\" />
\t\t  <span class=\"input-group-text border-0\">/ ";
            // line 238
            echo ($context["import_total"] ?? null);
            echo "</span>
\t\t  <button class=\"btn btn-primary rounded\" type=\"button\" id=\"btn-import\" data-mdb-ripple-color=\"dark\"><i class=\"fas fa-file-import me-2\"></i>";
            // line 239
            echo ($context["button_import"] ?? null);
            echo "</button>
\t\t</div>
\t\t";
        }
        // line 242
        echo "\t\t<div class=\"row mb-3\"><div class=\"col\"><div id=\"history\"></div></div></div>
\t  </div>
\t  <div class=\"tab-pane fade\" id=\"navtabs-tabs-export\" role=\"tabpanel\" aria-labelledby=\"navtabs-tab-export\">
\t\t<label class=\"d-flex cursor-pointer p-1\">
\t\t  <div class=\"flex-fill\">";
        // line 246
        echo ($context["text_sku"] ?? null);
        echo "</div>
\t\t  <div><input class=\"form-check-input\" type=\"checkbox\" id=\"export-sku\" value=\"1\" checked/></div>
\t\t</label>
\t\t<label class=\"d-flex cursor-pointer p-1\">
\t\t  <div class=\"flex-fill\">";
        // line 250
        echo ($context["text_product_name"] ?? null);
        echo "</div>
\t\t  <div><input class=\"form-check-input\" type=\"checkbox\" id=\"export-product_name\" value=\"1\" checked/></div>
\t\t</label>
\t\t<label class=\"d-flex cursor-pointer p-1\">
\t\t  <div class=\"flex-fill\">";
        // line 254
        echo ($context["text_product_description"] ?? null);
        echo "</div>
\t\t  <div><input class=\"form-check-input\" type=\"checkbox\" id=\"export-product_description\" value=\"1\" checked/></div>
\t\t</label>
\t\t<label class=\"d-flex cursor-pointer p-1\">
\t\t  <div class=\"flex-fill\">";
        // line 258
        echo ($context["text_price"] ?? null);
        echo "</div>
\t\t  <div><input class=\"form-check-input\" type=\"checkbox\" id=\"export-price\" value=\"1\" checked/></div>
\t\t</label>
\t\t<label class=\"d-flex cursor-pointer p-1\">
\t\t  <div class=\"flex-fill\">";
        // line 262
        echo ($context["text_currency"] ?? null);
        echo "</div>
\t\t  <div><input class=\"form-check-input\" type=\"checkbox\" id=\"export-currency\" value=\"1\" checked/></div>
\t\t</label>
\t\t<label class=\"d-flex cursor-pointer p-1\">
\t\t  <div class=\"flex-fill\">";
        // line 266
        echo ($context["text_quantity"] ?? null);
        echo "</div>
\t\t  <div><input class=\"form-check-input\" type=\"checkbox\" id=\"export-quantity\" value=\"1\" checked/></div>
\t\t</label>
\t\t<label class=\"d-flex cursor-pointer p-1\">
\t\t  <div class=\"flex-fill\">";
        // line 270
        echo ($context["text_quality"] ?? null);
        echo "</div>
\t\t  <div><input class=\"form-check-input\" type=\"checkbox\" id=\"export-quality\" value=\"1\" checked/></div>
\t\t</label>
\t\t<label class=\"d-flex cursor-pointer p-1\">
\t\t  <div class=\"flex-fill\">";
        // line 274
        echo ($context["text_product_image"] ?? null);
        echo "</div>
\t\t  <div><input class=\"form-check-input\" type=\"checkbox\" id=\"export-product_image\" value=\"1\" checked/></div>
\t\t</label>
\t\t<label class=\"d-flex cursor-pointer p-1\">
\t\t  <div class=\"flex-fill\">";
        // line 278
        echo ($context["text_product_category"] ?? null);
        echo "</div>
\t\t  <div><input class=\"form-check-input\" type=\"checkbox\" id=\"export-product_category\" value=\"1\"/></div>
\t\t</label>
\t\t<label class=\"d-flex cursor-pointer p-1\">
\t\t  <div class=\"flex-fill\">";
        // line 282
        echo ($context["text_product_vehicle"] ?? null);
        echo "</div>
\t\t  <div><input class=\"form-check-input\" type=\"checkbox\" id=\"export-product_vehicle\" value=\"1\"/></div>
\t\t</label>
\t\t<label class=\"d-flex cursor-pointer p-1\">
\t\t  <div class=\"flex-fill\">";
        // line 286
        echo ($context["text_brand"] ?? null);
        echo "</div>
\t\t  <div><input class=\"form-check-input\" type=\"checkbox\" id=\"export-brand\" value=\"1\"/></div>
\t\t</label>
\t\t<label class=\"d-flex cursor-pointer p-1\">
\t\t  <div class=\"flex-fill\">";
        // line 290
        echo ($context["text_mpn"] ?? null);
        echo "</div>
\t\t  <div><input class=\"form-check-input\" type=\"checkbox\" id=\"export-mpn\" value=\"1\"/></div>
\t\t</label>
\t\t<label class=\"d-flex cursor-pointer p-1\">
\t\t  <div class=\"flex-fill\">";
        // line 294
        echo ($context["text_oe"] ?? null);
        echo "</div>
\t\t  <div><input class=\"form-check-input\" type=\"checkbox\" id=\"export-oe\" value=\"1\"/></div>
\t\t</label>
\t\t<label class=\"d-flex cursor-pointer p-1\">
\t\t  <div class=\"flex-fill\">";
        // line 298
        echo ($context["text_others"] ?? null);
        echo "</div>
\t\t  <div><input class=\"form-check-input\" type=\"checkbox\" id=\"export-others\" value=\"1\"/></div>
\t\t</label>
\t\t<label class=\"d-flex cursor-pointer p-1\">
\t\t  <div class=\"flex-fill\">";
        // line 302
        echo ($context["text_weight"] ?? null);
        echo "</div>
\t\t  <div><input class=\"form-check-input\" type=\"checkbox\" id=\"export-weight\" value=\"1\"/></div>
\t\t</label>
\t\t<div class=\"mt-3 mb-3\">
\t\t  <select class=\"select\" id=\"export-csv_separator\">
\t\t\t<option value=\"coma\">,</option>
\t\t\t<option value=\"coma_point\">;</option>
\t\t\t<option value=\"tab\">tab</option>
\t\t  </select>
\t\t  <label class=\"form-label select-label\">";
        // line 311
        echo ($context["text_select_csv_separator"] ?? null);
        echo "</label>
\t\t</div>
\t\t<button class=\"btn btn-primary mb-3\" type=\"button\" id=\"btn-export\"><i class=\"fas fa-file-export me-2\"></i>";
        // line 313
        echo ($context["button_export"] ?? null);
        echo "</button>
\t  </div>
\t  <div class=\"tab-pane fade\" id=\"navtabs-tabs-backup\" role=\"tabpanel\" aria-labelledby=\"navtabs-tab-backup\">
\t\tIn progress...
\t  </div>
\t</div>
  </div>
</main>
<script>
\$('#history').load('";
        // line 322
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/import_export.importHistory&user_token=";
        echo ($context["user_token"] ?? null);
        echo "');

const total = Number(";
        // line 324
        echo ($context["import_total"] ?? null);
        echo ");

const importButtonHtml = \$('#btn-import').html();

function importStep(start = 0) {
  let data = {};
  data.product_name = \$('#import-product_name').val();
  data.product_description = \$('#import-product_description').val();
  data.price = \$('#import-price').val();
  data.currency = \$('#import-currency').val();
  data.quantity = \$('#import-quantity').val();
  data.quality = \$('#import-quality').val();
  data.product_image = \$('#import-product_image').val();
  data.product_image_separator = \$('#import-product_image_separator').val();
  data.sku = \$('#import-sku').val();
  data.product_category = \$('#import-product_category').val();
  data.product_vehicle = \$('#import-product_vehicle').val();
  data.brand = \$('#import-brand').val();
  data.mpn = \$('#import-mpn').val();
  data.oe = \$('#import-oe').val();
  data.others = \$('#import-others').val();
  data.weight = \$('#import-weight').val();

  \$.ajax({
    type: \"POST\",
\turl: '";
        // line 349
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/import_export.import&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&start=' + start,
\tdata: data,
\tdataType: 'json',
\tsuccess: function(json) {
\t  if (json['total'] === undefined) {
\t\t\$('#btn-import').html(importButtonHtml);
\t\treturn;
\t  }
\t  
\t  start = Number(start) + 20;
\t  
\t  if (start > total) {
\t\tstart = total;
\t  }
\t
\t  \$('#input-import-start').val(start);
\t
\t  if(json['total'] > 0 && start < total) {
\t\timportStep(start);
\t\treturn;
\t  }
\t  
\t  document.location = '";
        // line 371
        echo ($context["action"] ?? null);
        echo "';
\t},
\terror: function () {
\t  addAlert('";
        // line 374
        echo ($context["text_import"] ?? null);
        echo "', '";
        echo ($context["text_aborted"] ?? null);
        echo "', 'danger');
\t   
\t  \$('#history').load('";
        // line 376
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/import_export.importHistory&user_token=";
        echo ($context["user_token"] ?? null);
        echo "');
\t
\t  \$('#btn-import').html(importButtonHtml);
\t}
  });
}

\$('#btn-import').click(async function() {
  \$('#btn-import').addClass('disabled');
  \$('#btn-import').html('<div class=\"spinner-border spinner-border-sm me-1\" role=\"status\"></div>";
        // line 385
        echo ($context["text_loading"] ?? null);
        echo "');
  
  if (\$('#import-product_name').val() == '') {
    addAlert('";
        // line 388
        echo ($context["text_error"] ?? null);
        echo "', '";
        echo ($context["error_required_product_name"] ?? null);
        echo "', 'danger');
\t\$('#btn-import').html(importButtonHtml);
\t\$('#btn-import').removeClass('disabled');
\treturn;
  }
  
  if (\$('#import-product_description').val() != '') {
    if (await checkProductDescription() == false) {
\t  addAlert('";
        // line 396
        echo ($context["text_error"] ?? null);
        echo "', '";
        echo ($context["error_product_description"] ?? null);
        echo "', 'danger');
\t  \$('#btn-import').html(importButtonHtml);
\t  \$('#btn-import').removeClass('disabled');
\t  return;
\t}
  }
  
  if (\$('#import-price').val() == '') {
    addAlert('";
        // line 404
        echo ($context["text_error"] ?? null);
        echo "', '";
        echo ($context["error_required_price"] ?? null);
        echo "', 'danger');
\t\$('#btn-import').html(importButtonHtml);
\t\$('#btn-import').removeClass('disabled');
\treturn;
  }
  
  if (\$('#import-currency').val() == '') {
    addAlert('";
        // line 411
        echo ($context["text_error"] ?? null);
        echo "', '";
        echo ($context["error_required_currency"] ?? null);
        echo "', 'danger');
\t\$('#btn-import').html(importButtonHtml);
\t\$('#btn-import').removeClass('disabled');
\treturn;
  }
  
  if (await checkCurrency() == false) {
\taddAlert('";
        // line 418
        echo ($context["text_error"] ?? null);
        echo "', '";
        echo ($context["error_currency"] ?? null);
        echo "', 'danger');
\t\$('#btn-import').html(importButtonHtml);
\t\$('#btn-import').removeClass('disabled');
\treturn;
  }
  
  if (\$('#import-quantity').val() == '') {
    addAlert('";
        // line 425
        echo ($context["text_error"] ?? null);
        echo "', '";
        echo ($context["error_required_quantity"] ?? null);
        echo "', 'danger');
\t\$('#btn-import').html(importButtonHtml);
\t\$('#btn-import').removeClass('disabled');
\treturn;
  }
  
  if (\$('#import-quality').val() == '') {
    addAlert('";
        // line 432
        echo ($context["text_error"] ?? null);
        echo "', '";
        echo ($context["error_required_quality"] ?? null);
        echo "', 'danger');
\t\$('#btn-import').html(importButtonHtml);
\t\$('#btn-import').removeClass('disabled');
\treturn;
  } 
  
  if (await checkQuality() == false) {
\taddAlert('";
        // line 439
        echo ($context["text_error"] ?? null);
        echo "', '";
        echo ($context["error_quality"] ?? null);
        echo "', 'danger');
\t\$('#btn-import').html(importButtonHtml);
\t\$('#btn-import').removeClass('disabled');
\treturn;
  }
  
  if (\$('#import-product_image').val() == '') {
    addAlert('";
        // line 446
        echo ($context["text_error"] ?? null);
        echo "', '";
        echo ($context["error_required_product_image"] ?? null);
        echo "', 'danger');
\t\$('#btn-import').html(importButtonHtml);
\t\$('#btn-import').removeClass('disabled');
\treturn;
  }
  
  if (await checkProductImage() == false) {
\taddAlert('";
        // line 453
        echo ($context["text_error"] ?? null);
        echo "', '";
        echo ($context["error_product_image"] ?? null);
        echo "', 'danger');
\t\$('#btn-import').html(importButtonHtml);
\t\$('#btn-import').removeClass('disabled');
\treturn;
  }
  
  if (\$('#import-sku').val() != '') {
    if (await checkSku() == false) {
\t  addAlert('";
        // line 461
        echo ($context["text_error"] ?? null);
        echo "', '";
        echo ($context["error_sku"] ?? null);
        echo "', 'danger');
\t  \$('#btn-import').html(importButtonHtml);
\t  \$('#btn-import').removeClass('disabled');
\t  return;
\t}
  }

  importStep(\$('#input-import-start').val());
});

async function checkQuality() {
  let json = await \$.ajax({
\turl: '";
        // line 473
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/import_export.checkQuality&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&quality=' + \$('#import-quality').val(),
\tdataType: 'json',
  });
  
  if (json.success === undefined || json.success == 0) {
    return false;
  } else {
\treturn true;
  }
}

async function checkCurrency() {
  let json = await \$.ajax({
\turl: '";
        // line 486
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/import_export.checkCurrency&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&currency=' + \$('#import-currency').val(),
\tdataType: 'json',
  });
  
  if (json.success === undefined || json.success == 0) {
    return false;
  } else {
\treturn true;
  }
}

async function checkSku() {
  let json = await \$.ajax({
\turl: '";
        // line 499
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/import_export.checkSku&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&sku=' + \$('#import-sku').val(),
\tdataType: 'json',
  });
  
  if (json.success === undefined || json.success == 0) {
    return false;
  } else {
\treturn true;
  }
}

async function checkProductDescription() {
  let json = await \$.ajax({
\turl: '";
        // line 512
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/import_export.checkProductDescription&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&product_description=' + \$('#import-product_description').val(),
\tdataType: 'json',
  });
  
  if (json.success === undefined || json.success == 0) {
    return false;
  } else {
\treturn true;
  }
}

async function checkProductImage() {
  let data = {};
  data.product_image = \$('#import-product_image').val();
  data.product_image_separator = \$('#import-product_image_separator').val();
  
  let json = await \$.ajax({
\ttype: \"POST\",
\turl: '";
        // line 530
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/import_export.checkProductImage&user_token=";
        echo ($context["user_token"] ?? null);
        echo "',
\tdata: data,
\tdataType: 'json',
  });
  
  if (json.success === undefined || json.success == 0) {
    return false;
  } else {
\treturn true;
  }
}

\$('#btn-export').click(function() {
  let url = '";
        // line 543
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/import_export.export&user_token=";
        echo ($context["user_token"] ?? null);
        echo "';
  
  if (\$('#export-product_name').is(\":checked\")) {
\turl += '&product_name=1';
  }
  
  if (\$('#export-product_description').is(\":checked\")) {
\turl += '&product_description=1';
  }

  if (\$('#export-price').is(\":checked\")) {
\turl += '&price=1';
  }
  
  if (\$('#export-currency').is(\":checked\")) {
\turl += '&currency=1';
  }

  if (\$('#export-quantity').is(\":checked\")) {
\turl += '&quantity=1';
  }
  
  if (\$('#export-quality').is(\":checked\")) {
\turl += '&quality=1';
  }
  
  if (\$('#export-product_image').is(\":checked\")) {
\turl += '&product_image=1';
  }
  
  if (\$('#export-sku').is(\":checked\")) {
\turl += '&sku=1';
  }
  
  if (\$('#export-product_category').is(\":checked\")) {
\turl += '&product_category=1';
  }
  
  if (\$('#export-product_vehicle').is(\":checked\")) {
\turl += '&product_vehicle=1';
  }
  
  if (\$('#export-brand').is(\":checked\")) {
\turl += '&brand=1';
  }
  
  if (\$('#export-mpn').is(\":checked\")) {
\turl += '&mpn=1';
  }
  
  if (\$('#export-oe').is(\":checked\")) {
\turl += '&oe=1';
  }
  
  if (\$('#export-others').is(\":checked\")) {
\turl += '&others=1';
  }
  
  if (\$('#export-weight').is(\":checked\")) {
\turl += '&weight=1';
  }
  
  url += '&separator=' + \$('#export-csv_separator').val();

  window.open(url);
});
</script>
<style>
#navtabs-tabs-export label:hover {
  background-color: rgb(0, 0, 0, 0.05);
}
</style>
";
        // line 615
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "view/template/catalog/import_export.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1207 => 615,  1130 => 543,  1112 => 530,  1089 => 512,  1071 => 499,  1053 => 486,  1035 => 473,  1018 => 461,  1005 => 453,  993 => 446,  981 => 439,  969 => 432,  957 => 425,  945 => 418,  933 => 411,  921 => 404,  908 => 396,  895 => 388,  889 => 385,  875 => 376,  868 => 374,  862 => 371,  835 => 349,  807 => 324,  800 => 322,  788 => 313,  783 => 311,  771 => 302,  764 => 298,  757 => 294,  750 => 290,  743 => 286,  736 => 282,  729 => 278,  722 => 274,  715 => 270,  708 => 266,  701 => 262,  694 => 258,  687 => 254,  680 => 250,  673 => 246,  667 => 242,  661 => 239,  657 => 238,  652 => 236,  645 => 232,  642 => 231,  631 => 229,  627 => 228,  619 => 223,  616 => 222,  605 => 220,  601 => 219,  593 => 214,  590 => 213,  579 => 211,  575 => 210,  567 => 205,  564 => 204,  553 => 202,  549 => 201,  541 => 196,  538 => 195,  527 => 193,  523 => 192,  515 => 187,  512 => 186,  501 => 184,  497 => 183,  489 => 178,  486 => 177,  475 => 175,  471 => 174,  463 => 169,  458 => 167,  455 => 166,  444 => 164,  440 => 163,  432 => 158,  425 => 154,  422 => 153,  411 => 151,  407 => 150,  399 => 145,  396 => 144,  385 => 142,  381 => 141,  375 => 140,  369 => 139,  362 => 135,  359 => 134,  348 => 132,  344 => 131,  336 => 126,  333 => 125,  322 => 123,  317 => 122,  304 => 120,  300 => 119,  293 => 115,  290 => 114,  279 => 112,  275 => 111,  267 => 106,  264 => 105,  253 => 103,  249 => 102,  241 => 97,  238 => 96,  227 => 94,  223 => 93,  212 => 85,  206 => 81,  199 => 79,  190 => 77,  186 => 76,  183 => 75,  179 => 74,  171 => 69,  167 => 68,  161 => 64,  159 => 63,  150 => 57,  146 => 56,  139 => 52,  127 => 43,  122 => 41,  116 => 38,  112 => 37,  107 => 35,  101 => 31,  95 => 30,  91 => 29,  82 => 23,  76 => 20,  70 => 17,  66 => 15,  58 => 11,  55 => 10,  47 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/catalog/import_export.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/catalog/import_export.twig");
    }
}
