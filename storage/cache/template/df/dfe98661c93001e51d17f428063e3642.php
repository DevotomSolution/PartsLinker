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

/* view/template/sale/order_form.twig */
class __TwigTemplate_c02ccdf9e33f4627af410324a901a36c extends Template
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
<main style=\"margin-top: 58px;\" class=\"pt-3\">
<div class=\"container-fluid\">
  ";
        // line 4
        if (($context["error_warning"] ?? null)) {
            // line 5
            echo "  <div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"danger\">";
            echo ($context["error_warning"] ?? null);
            echo "<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button></div>
  ";
        }
        // line 7
        echo "  <div class=\"row\">
\t<div class=\"col-6\"><p class=\"lead text-primary\">";
        // line 8
        echo ($context["text_order_id"] ?? null);
        echo ($context["order_id"] ?? null);
        echo "</p></div>
    <div class=\"col-6 text-end\"><a href=\"";
        // line 9
        echo ($context["cancel"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply me-2\"></i>";
        echo ($context["button_back"] ?? null);
        echo "</a></div>
  </div>
  <input type=\"hidden\" id=\"order_id\" value=\"";
        // line 11
        echo ($context["order_id"] ?? null);
        echo "\" />
  <div class=\"card\">
\t<div class=\"card-body p-0 overflow-auto\">
\t\t<table id=\"table-product\" class=\"table table-borderless mt-1 mb-1\">
\t\t  <thead class=\"border-bottom\">
\t\t\t<tr>
\t\t\t  <th scope=\"col\" class=\"text-center\"><i class=\"fas fa-camera\"></i></th>
\t\t\t  <th scope=\"col\" class=\"text-center\">";
        // line 18
        echo ($context["column_sku"] ?? null);
        echo "</th>
\t\t\t  <th scope=\"col\">";
        // line 19
        echo ($context["column_name"] ?? null);
        echo "</th>
\t\t\t  <th scope=\"col\" class=\"text-center\">";
        // line 20
        echo ($context["column_quantity"] ?? null);
        echo "</th>
\t\t\t  <th scope=\"col\" class=\"text-center\">";
        // line 21
        echo ($context["column_price"] ?? null);
        echo "</th>
\t\t\t  <th scope=\"col\" class=\"text-center\">";
        // line 22
        echo ($context["column_weight"] ?? null);
        echo "</th>
\t\t\t  <th scope=\"col\" class=\"text-center\">";
        // line 23
        echo ($context["column_action"] ?? null);
        echo "</th>
\t\t\t</tr>
\t\t  </thead>
\t\t  <tbody id=\"order-products\">
\t\t    ";
        // line 27
        if (($context["order_product"] ?? null)) {
            // line 28
            echo "\t\t\t  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["order_product"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 29
                echo "\t\t\t\t<tr id=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "order_product_id", [], "any", false, false, false, 29);
                echo "\" class=\"order_product\">
\t\t\t\t  <td class=\"text-center\">
\t\t\t\t    <img src=\"";
                // line 31
                echo twig_get_attribute($this->env, $this->source, $context["product"], "image_min", [], "any", false, false, false, 31);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 31);
                echo "\" style=\"min-width: 50px;\" class=\"img-thumbnail\" />
\t\t\t\t\t<input type=\"hidden\" id=\"";
                // line 32
                echo twig_get_attribute($this->env, $this->source, $context["product"], "order_product_id", [], "any", false, false, false, 32);
                echo "-price\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 32);
                echo "\" />
\t\t\t\t  </th>
\t\t\t\t  <td id=\"";
                // line 34
                echo twig_get_attribute($this->env, $this->source, $context["product"], "order_product_id", [], "any", false, false, false, 34);
                echo "-sku class=\"text-center\">";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 34);
                echo "</td>
\t\t\t\t  <td id=\"";
                // line 35
                echo twig_get_attribute($this->env, $this->source, $context["product"], "order_product_id", [], "any", false, false, false, 35);
                echo "-name\">";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 35);
                echo "</td>
\t\t\t\t  <td id=\"";
                // line 36
                echo twig_get_attribute($this->env, $this->source, $context["product"], "order_product_id", [], "any", false, false, false, 36);
                echo "-quantity\" class=\"text-center\">";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 36);
                echo "</td>
\t\t\t\t  <td id=\"";
                // line 37
                echo twig_get_attribute($this->env, $this->source, $context["product"], "order_product_id", [], "any", false, false, false, 37);
                echo "-price_formated\" class=\"text-center\">";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "price_formated", [], "any", false, false, false, 37);
                echo "</td>
\t\t\t\t  <td id=\"";
                // line 38
                echo twig_get_attribute($this->env, $this->source, $context["product"], "order_product_id", [], "any", false, false, false, 38);
                echo "-weight\" class=\"text-center\">";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "weight", [], "any", false, false, false, 38);
                echo "</td>
\t\t\t\t  <td class=\"text-center\">
\t\t\t\t    <div class=\"dropdown\">
\t\t\t\t\t  <button class=\"btn btn-primary dropdown-button\" type=\"button\" id=\"";
                // line 41
                echo twig_get_attribute($this->env, $this->source, $context["product"], "order_product_id", [], "any", false, false, false, 41);
                echo "dropdownMenuButton\" data-mdb-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fas fa-bars\"></i></button>
\t\t\t\t\t  <ul class=\"dropdown-menu\" aria-labelledby=\"";
                // line 42
                echo twig_get_attribute($this->env, $this->source, $context["product"], "order_product_id", [], "any", false, false, false, 42);
                echo "dropdownMenuButton\">
\t\t\t\t\t\t<li><button class=\"dropdown-item btn-edit_order_product-manual\" data-order_product_id=\"";
                // line 43
                echo twig_get_attribute($this->env, $this->source, $context["product"], "order_product_id", [], "any", false, false, false, 43);
                echo "\" data-mdb-toggle=\"modal\" data-mdb-target=\"#manualProductModal\"><i class=\"fas fa-pencil-alt me-2\"></i>";
                echo ($context["button_edit"] ?? null);
                echo "</button></li>
\t\t\t\t\t\t<li><button class=\"dropdown-item text-danger btn-delete_order_product\" data-order_product_id=\"";
                // line 44
                echo twig_get_attribute($this->env, $this->source, $context["product"], "order_product_id", [], "any", false, false, false, 44);
                echo "\"><i class=\"fas fa-trash me-2\"></i>";
                echo ($context["button_delete"] ?? null);
                echo "</button></li>
\t\t\t\t\t  </ul>
\t\t\t\t    </div>
\t\t\t\t  </td>
\t\t\t\t</tr>
\t\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 50
            echo "\t\t\t  <tr id=\"no-products\" class=\"d-none\">
\t\t\t    <td colspan=\"7\" class=\"text-center\">";
            // line 51
            echo ($context["text_no_products"] ?? null);
            echo "</td>
\t\t\t  </tr>
\t\t\t";
        } else {
            // line 54
            echo "\t\t\t  <tr id=\"no-products\">
\t\t\t    <td colspan=\"7\" class=\"text-center\">";
            // line 55
            echo ($context["text_no_products"] ?? null);
            echo "</td>
\t\t\t  </tr>
\t\t\t";
        }
        // line 58
        echo "\t\t  </tbody>
\t\t</table>
\t</div>
  </div>
  <div class=\"btn-group mt-3\">
\t<button type=\"button\" class=\"btn btn-primary\" data-mdb-toggle=\"modal\" data-mdb-target=\"#productModal\"><i class=\"fas fa-plus me-2\"></i>";
        // line 63
        echo ($context["button_add_product"] ?? null);
        echo "</button>
\t<button\ttype=\"button\" class=\"btn btn-primary dropdown-toggle dropdown-toggle-split\"\tdata-mdb-toggle=\"dropdown\" aria-expanded=\"false\"><span class=\"visually-hidden\">Toggle Dropdown</span></button>
\t<ul class=\"dropdown-menu\">
\t  <li><a class=\"dropdown-item\" href=\"#\" data-mdb-toggle=\"modal\" data-mdb-target=\"#productModal\"><i class=\"fas fa-plus me-2\"></i>";
        // line 66
        echo ($context["button_add_product"] ?? null);
        echo "</a></li>
\t  <li><a class=\"dropdown-item\" id=\"btn-add_order_product-manual\" href=\"#\" data-mdb-toggle=\"modal\" data-mdb-target=\"#manualProductModal\"><i class=\"fas fa-plus me-2\"></i>";
        // line 67
        echo ($context["button_add_product_manual"] ?? null);
        echo "</a></li>
\t</ul>
  </div>

  <div class=\"modal fade\" id=\"productModal\" tabindex=\"-1\" aria-labelledby=\"productModalLabel\" aria-hidden=\"true\">
\t<div class=\"modal-dialog modal-lg\">
\t  <div class=\"modal-content\">
\t\t<div class=\"modal-header\">
\t\t  <h5 class=\"modal-title\" id=\"productModalLabel\">";
        // line 75
        echo ($context["text_add_product"] ?? null);
        echo "</h5>
\t\t  <button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"modal\" aria-label=\"Close\"></button>
\t\t</div>
\t\t<div class=\"modal-body\">
\t\t  <div class=\"d-flex\">
\t\t\t<div class=\"col-8 pe-3\">
\t\t\t  <div id=\"add_order_product-name\" class=\"form-outline mb-3\">
\t\t\t\t<input type=\"text\" value=\"\" id=\"input-add_order_product-name\" class=\"form-control\" />
\t\t\t\t<label class=\"form-label\" for=\"input-add_order_product-name\">";
        // line 83
        echo ($context["entry_product_name"] ?? null);
        echo "</label>
\t\t\t  </div>
\t\t\t</div>
\t\t\t<div class=\"col-4\">
\t\t\t  <div class=\"form-outline\">
\t\t\t\t<input type=\"text\" value=\"\" id=\"input-add_order_product-sku\" class=\"form-control\" />
\t\t\t\t<label class=\"form-label\" for=\"input-add_order_product-sku\">";
        // line 89
        echo ($context["entry_sku"] ?? null);
        echo "</label>
\t\t\t  </div>
\t\t\t</div>
\t\t  </div>
\t\t  <div class=\"input-group mb-3\">
\t\t    <span class=\"input-group-text\">";
        // line 94
        echo ($context["text_product_price"] ?? null);
        echo "</span>
\t\t\t";
        // line 95
        if (($context["currency_symbol_left"] ?? null)) {
            // line 96
            echo "\t\t\t  <span class=\"input-group-text\">";
            echo ($context["currency_symbol_left"] ?? null);
            echo "</span>
\t\t\t";
        }
        // line 98
        echo "\t\t\t<input type=\"number\" min=\"0\" step=\"0.01\" id=\"input-add_order_product-price\" class=\"form-control\" />
\t\t\t";
        // line 99
        if (($context["currency_symbol_right"] ?? null)) {
            // line 100
            echo "\t\t\t  <span class=\"input-group-text\">";
            echo ($context["currency_symbol_right"] ?? null);
            echo "</span>
\t\t\t";
        }
        // line 102
        echo "\t\t  </div>
\t\t  <div class=\"input-group mb-3\">
\t\t    <span class=\"input-group-text\">";
        // line 104
        echo ($context["text_product_weight"] ?? null);
        echo "</span>
\t\t\t<input type=\"text\" id=\"input-add_order_product-weight\" class=\"form-control\" />
\t\t\t<span class=\"input-group-text\">";
        // line 106
        echo ($context["text_kg"] ?? null);
        echo "</span>
\t\t  </div>
\t\t  <div class=\"input-group\">
\t\t    <span class=\"input-group-text\">";
        // line 109
        echo ($context["text_product_quantity"] ?? null);
        echo "</span>
\t\t\t<input type=\"number\" id=\"input-add_order_product-quantity\" class=\"form-control\" />
\t\t  </div>
\t\t</div>
\t\t<div class=\"modal-footer\">
\t\t  <button type=\"button\" class=\"btn btn-secondary\" data-mdb-dismiss=\"modal\">";
        // line 114
        echo ($context["button_close"] ?? null);
        echo "</button>
\t\t  <button type=\"button\" id=\"btn-add_order_product-save\" class=\"btn btn-primary\" data-mdb-dismiss=\"modal\">";
        // line 115
        echo ($context["button_save"] ?? null);
        echo "</button>
\t\t</div>
\t  </div>
\t</div>
  </div>
  
  <div class=\"modal fade\" id=\"manualProductModal\" tabindex=\"-1\" aria-labelledby=\"manualProductModalLabel\" aria-hidden=\"true\">
\t<div class=\"modal-dialog modal-lg\">
\t  <div class=\"modal-content\">
\t\t<div class=\"modal-header\">
\t\t  <h5 class=\"modal-title\" id=\"manualProductModalLabel\">";
        // line 125
        echo ($context["text_product_info"] ?? null);
        echo "</h5>
\t\t  <button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"modal\" aria-label=\"Close\"></button>
\t\t</div>
\t\t<div class=\"modal-body\">
\t\t  <input type=\"hidden\" id=\"input-order_product_id\" value=\"0\"/>
\t\t  <div class=\"input-group mb-3\">
\t\t\t<input type=\"text\" id=\"input-order_product_name\" placeholder=\"";
        // line 131
        echo ($context["text_product_name"] ?? null);
        echo "\" class=\"form-control\" />
\t\t  </div>
\t\t  <div class=\"input-group mb-3\">
\t\t    <span class=\"input-group-text\">";
        // line 134
        echo ($context["text_product_price"] ?? null);
        echo "</span>
\t\t\t";
        // line 135
        if (($context["currency_symbol_left"] ?? null)) {
            // line 136
            echo "\t\t\t  <span class=\"input-group-text\">";
            echo ($context["currency_symbol_left"] ?? null);
            echo "</span>
\t\t\t";
        }
        // line 138
        echo "\t\t\t<input type=\"number\" min=\"0\" step=\"0.01\" id=\"input-order_product_price\" class=\"form-control\" />
\t\t\t";
        // line 139
        if (($context["currency_symbol_right"] ?? null)) {
            // line 140
            echo "\t\t\t  <span class=\"input-group-text\">";
            echo ($context["currency_symbol_right"] ?? null);
            echo "</span>
\t\t\t";
        }
        // line 142
        echo "\t\t  </div>
\t\t  <div class=\"input-group mb-3\">
\t\t    <span class=\"input-group-text\">";
        // line 144
        echo ($context["text_product_weight"] ?? null);
        echo "</span>
\t\t\t<input type=\"text\" id=\"input-order_product_weight\" class=\"form-control\" />
\t\t\t<span class=\"input-group-text\">";
        // line 146
        echo ($context["text_kg"] ?? null);
        echo "</span>
\t\t  </div>
\t\t  <div class=\"input-group\">
\t\t    <span class=\"input-group-text\">";
        // line 149
        echo ($context["text_product_quantity"] ?? null);
        echo "</span>
\t\t\t<input type=\"number\" id=\"input-order_product_quantity\" class=\"form-control\" />
\t\t  </div>
\t\t</div>
\t\t<div class=\"modal-footer\">
\t\t  <button type=\"button\" class=\"btn btn-secondary\" data-mdb-dismiss=\"modal\">";
        // line 154
        echo ($context["button_close"] ?? null);
        echo "</button>
\t\t  <button type=\"button\" id=\"btn-edit_order_product-manual-save\" class=\"btn btn-primary\" data-mdb-dismiss=\"modal\">";
        // line 155
        echo ($context["button_save"] ?? null);
        echo "</button>
\t\t</div>
\t  </div>
\t</div>
  </div>
  
  <div class=\"card mt-3\">
\t<div class=\"card-body\">
\t  <div class=\"row mb-3\">
\t    <div class=\"col-12 col-md-6\">
\t      <h5 class=\"card-title d-inline-block\">";
        // line 165
        echo ($context["text_order_info"] ?? null);
        echo "</h5>
\t      <a href=\"#\" id=\"edit-order_info\" class=\"ms-3 float-end\"><i class=\"fas fa-pencil-alt\"></i></a>
\t\t</div>
\t  </div>
\t  <div class=\"row\">
\t\t<div class=\"col-md-6\">
\t\t  <div class=\"row\">
\t\t    <div class=\"col-4\">";
        // line 172
        echo ($context["text_total"] ?? null);
        echo "</div>
\t\t\t<div class=\"col-8\"><strong id=\"total\">";
        // line 173
        echo ($context["total"] ?? null);
        echo "</strong></div>
\t\t  </div>
\t\t  <hr/>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-4\">";
        // line 177
        echo ($context["text_email"] ?? null);
        echo "</div>
\t\t\t<div id=\"email-value\" class=\"col-8\"><span id=\"email\">";
        // line 178
        echo ($context["email"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"email-edit\" class=\"col-8 d-none\"><input type=\"text\" class=\"form-control\" id=\"input-email\" value=\"";
        // line 179
        echo ($context["email"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-4\">";
        // line 182
        echo ($context["text_telephone"] ?? null);
        echo "</div>
\t\t\t<div id=\"telephone-value\" class=\"col-8\"><span id=\"telephone\">";
        // line 183
        echo ($context["telephone"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"telephone-edit\" class=\"col-8 d-none\"><input type=\"text\" class=\"form-control\" id=\"input-telephone\" value=\"";
        // line 184
        echo ($context["telephone"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <hr/>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-4\">";
        // line 188
        echo ($context["text_shipping_method"] ?? null);
        echo "</div>
\t\t\t<div id=\"shipping_method-value\" class=\"col-8\"><span id=\"shipping_method\">";
        // line 189
        echo ($context["shipping_method"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"shipping_method-edit\" class=\"col-8 d-none\"><input type=\"text\" class=\"form-control\" id=\"input-shipping_method\" value=\"";
        // line 190
        echo ($context["shipping_method"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-4\">";
        // line 193
        echo ($context["text_shipping_cost"] ?? null);
        echo "</div>
\t\t\t<div id=\"shipping_cost-value\" class=\"col-8\"><span id=\"shipping_cost\">";
        // line 194
        echo ($context["shipping_cost"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"shipping_cost-edit\" class=\"col-8 d-none\"><input type=\"number\" min=\"0\" step=\"0.01\" class=\"form-control\" id=\"input-shipping_cost\" value=\"";
        // line 195
        echo ($context["shipping_cost"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-4\">";
        // line 198
        echo ($context["text_payment_method"] ?? null);
        echo "</div>
\t\t\t<div id=\"payment_method-value\" class=\"col-8\"><span id=\"payment_method\">";
        // line 199
        echo ($context["payment_method"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"payment_method-edit\" class=\"col-8 d-none\"><input type=\"text\" class=\"form-control\" id=\"input-payment_method\" value=\"";
        // line 200
        echo ($context["payment_method"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <hr/>
\t\t  <div class=\"row mb-2\">
\t\t\t<div class=\"col-4\">";
        // line 204
        echo ($context["text_comment"] ?? null);
        echo "</div>
\t\t\t<div id=\"comment-value\" class=\"col-8\"><span id=\"comment\">";
        // line 205
        echo ($context["comment"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"comment-edit\" class=\"col-8 d-none\"><textarea class=\"form-control\" id=\"input-comment\" rows=\"2\">";
        // line 206
        echo ($context["comment"] ?? null);
        echo "</textarea></div>
\t\t  </div>
\t\t  <div class=\"row mt-3 mb-3\">
\t\t\t<div class=\"col\"><button type=\"button\" class=\"btn btn-primary d-none me-2\" id=\"save-order_info\"><i class=\"fa fa-save me-2\"></i>";
        // line 209
        echo ($context["button_save"] ?? null);
        echo "</button><button type=\"button\" class=\"btn d-none\" id=\"cancel-order_info\">";
        echo ($context["button_cancel"] ?? null);
        echo "</button></div>
\t\t  </div>
\t\t</div>
\t\t<div class=\"col-md-6\">
\t\t  <div class=\"row align-items-center mb-4\">
\t\t\t<div class=\"col-4\"><i class=\"far fa-flag me-2\"></i>";
        // line 214
        echo ($context["text_status"] ?? null);
        echo "</div>
\t\t\t<div class=\"col-8 d-flex align-items-center\">
\t\t\t  <div class=\"me-2 flex-fill\">
\t\t\t\t<select class=\"select\" id=\"select-order_status\">
\t\t\t\t  <option value=\"0\" disabled selected>";
        // line 218
        echo ($context["text_select"] ?? null);
        echo "</option>
\t\t\t\t  ";
        // line 219
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 220
            echo "\t\t\t\t  <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 220);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 220) == ($context["order_status_id"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 220);
            echo "</option>
\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 222
        echo "\t\t\t\t</select>
\t\t\t  </div>
\t\t\t  <button type=\"button\" class=\"btn btn-primary me-2\" id=\"save-order_status\"><i class=\"fa fa-save\"></i></button>
\t\t\t</div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-4\">
\t\t    <div class=\"col-4\">";
        // line 228
        echo ($context["text_invoice"] ?? null);
        echo "</div>
\t\t\t<div id=\"invoice\" class=\"col-8\">";
        // line 229
        if ( !($context["invoice_no"] ?? null)) {
            echo "<button id=\"button-invoice\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_generate"] ?? null);
            echo "\" class=\"btn btn-success btn-sm\"><i class=\"fa fa-cog\"></i></button>";
        } else {
            echo "<a href=\"";
            echo ($context["invoice"] ?? null);
            echo "\" target=\"blank\" class=\"text-primary\">";
            echo ($context["invoice_no"] ?? null);
            echo "</a>";
        }
        echo "</div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-4\">";
        // line 232
        echo ($context["text_date_added"] ?? null);
        echo "</div>
\t\t\t<div class=\"col-8\">";
        // line 233
        echo ($context["date_added"] ?? null);
        echo "</div>
\t\t  </div>
\t\t  <div class=\"row align-items-center\">
\t\t\t<div class=\"col-4\">";
        // line 236
        echo ($context["text_date_modified"] ?? null);
        echo "</div>
\t\t\t<div class=\"col-8\" id=\"date_modified\">";
        // line 237
        echo ($context["date_modified"] ?? null);
        echo "</div>
\t\t  </div>
\t\t</div>
\t  </div>
\t</div>
  </div>
  
  <div class=\"row mb-3\">
    <div class=\"col-md-6 mt-3\">
\t  <div class=\"card\">
\t\t<div class=\"card-body\">
\t\t  <div class=\"row mb-3\">
\t\t\t<div class=\"col\">
\t\t\t  <h5 class=\"card-title d-inline-block\">";
        // line 250
        echo ($context["text_shipping_address"] ?? null);
        echo "</h5>
\t\t\t  <a href=\"#\" id=\"copy-shipping_address\" class=\"ms-3 float-end\"><i class=\"far fa-clone\"></i></a>
\t\t\t  <a href=\"#\" id=\"edit-shipping_address\" class=\"ms-3 float-end\"><i class=\"fas fa-pencil-alt\"></i></a>
\t\t\t</div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-5\">";
        // line 256
        echo ($context["text_fullname"] ?? null);
        echo "</div>
\t\t\t<div id=\"fullname-value\" class=\"col-7\"><span id=\"fullname\">";
        // line 257
        echo ($context["fullname"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"fullname-edit\" class=\"col-7 d-none\"><input type=\"text\" class=\"form-control\" id=\"input-fullname\" value=\"";
        // line 258
        echo ($context["fullname"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-5\">";
        // line 261
        echo ($context["text_company"] ?? null);
        echo "</div>
\t\t\t<div id=\"shipping_company-value\" class=\"col-7\"><span id=\"shipping_company\">";
        // line 262
        echo ($context["shipping_company"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"shipping_company-edit\" class=\"col-7 d-none\"><input type=\"text\" class=\"form-control\" id=\"input-shipping_company\" value=\"";
        // line 263
        echo ($context["shipping_company"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-5\">";
        // line 266
        echo ($context["text_address_1"] ?? null);
        echo "</div>
\t\t\t<div id=\"shipping_address_1-value\" class=\"col-7\"><span id=\"shipping_address_1\">";
        // line 267
        echo ($context["shipping_address_1"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"shipping_address_1-edit\" class=\"col-7 d-none\"><input type=\"text\" class=\"form-control\" id=\"input-shipping_address_1\" value=\"";
        // line 268
        echo ($context["shipping_address_1"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-5\">";
        // line 271
        echo ($context["text_address_2"] ?? null);
        echo "</div>
\t\t\t<div id=\"shipping_address_2-value\" class=\"col-7\"><span id=\"shipping_address_2\">";
        // line 272
        echo ($context["shipping_address_2"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"shipping_address_2-edit\" class=\"col-7 d-none\"><input type=\"text\" class=\"form-control\" id=\"input-shipping_address_2\" value=\"";
        // line 273
        echo ($context["shipping_address_2"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-5\">";
        // line 276
        echo ($context["text_city"] ?? null);
        echo "</div>
\t\t\t<div id=\"shipping_city-value\" class=\"col-7\"><span id=\"shipping_city\">";
        // line 277
        echo ($context["shipping_city"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"shipping_city-edit\" class=\"col-7 d-none\"><input type=\"text\" class=\"form-control\" id=\"input-shipping_city\" value=\"";
        // line 278
        echo ($context["shipping_city"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-5\">";
        // line 281
        echo ($context["text_postcode"] ?? null);
        echo "</div>
\t\t\t<div id=\"shipping_postcode-value\" class=\"col-7\"><span id=\"shipping_postcode\">";
        // line 282
        echo ($context["shipping_postcode"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"shipping_postcode-edit\" class=\"col-7 d-none\"><input type=\"text\" class=\"form-control\" id=\"input-shipping_postcode\" value=\"";
        // line 283
        echo ($context["shipping_postcode"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-5\">";
        // line 286
        echo ($context["text_country"] ?? null);
        echo "</div>
\t\t\t<div id=\"shipping_country_id-value\" class=\"col-7\"><span id=\"shipping_country\">";
        // line 287
        echo ($context["shipping_country"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"shipping_country_id-edit\" class=\"col-7 d-none\">
\t\t\t  <select class=\"select\" id=\"select-shipping_country_id\" data-mdb-filter=\"true\">
\t\t\t\t<option value=\"0\" disabled selected></option>
\t\t\t\t";
        // line 291
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["countries"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["country"]) {
            // line 292
            echo "\t\t\t\t<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 292);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 292) == ($context["shipping_country_id"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["country"], "name", [], "any", false, false, false, 292);
            echo "</option>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['country'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 294
        echo "\t\t\t  </select>
\t\t\t</div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-5\">";
        // line 298
        echo ($context["text_zone"] ?? null);
        echo "</div>
\t\t\t<div id=\"shipping_zone_id-value\" class=\"col-7\"><span id=\"shipping_zone\">";
        // line 299
        echo ($context["shipping_zone"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"shipping_zone_id-edit\" class=\"col-7 d-none\">
\t\t\t  <select class=\"select\" id=\"select-shipping_zone_id\" data-mdb-filter=\"true\">
\t\t\t\t";
        // line 302
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["shipping_zones"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["zone"]) {
            // line 303
            echo "\t\t\t\t<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["zone"], "zone_id", [], "any", false, false, false, 303);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["zone"], "zone_id", [], "any", false, false, false, 303) == ($context["shipping_zone_id"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["zone"], "name", [], "any", false, false, false, 303);
            echo "</option>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['zone'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 305
        echo "\t\t\t  </select>
\t\t\t</div>
\t\t  </div>
\t\t  <div class=\"row mt-3\">
\t\t\t<div class=\"col\"><button type=\"button\" class=\"btn btn-primary d-none me-2\" id=\"save-shipping_address\"><i class=\"fa fa-save me-2\"></i>";
        // line 309
        echo ($context["button_save"] ?? null);
        echo "</button><button type=\"button\" class=\"btn d-none\" id=\"cancel-shipping_address\">";
        echo ($context["button_cancel"] ?? null);
        echo "</button></div>
\t\t  </div>
\t\t</div>
\t  </div>
\t</div>
    <div class=\"col-md-6 mt-3\">
\t  <div class=\"card\">
\t\t<div class=\"card-body\">
\t\t  <div class=\"row mb-3\">
\t\t\t<div class=\"col\">
\t\t\t  <h5 class=\"card-title d-inline-block\">";
        // line 319
        echo ($context["text_payment_address"] ?? null);
        echo "</h5>
\t\t\t  <a href=\"#\" id=\"copy-payment_address\" class=\"ms-3 float-end\"><i class=\"far fa-clone\"></i></a>
\t\t\t  <a href=\"#\" id=\"edit-payment_address\" class=\"ms-3 float-end\"><i class=\"fas fa-pencil-alt\"></i></a>
\t\t\t</div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-5\">";
        // line 325
        echo ($context["text_fullname"] ?? null);
        echo "</div>
\t\t\t<div id=\"payment_fullname-value\" class=\"col-7\"><span id=\"payment_fullname\">";
        // line 326
        echo ($context["payment_fullname"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"payment_fullname-edit\" class=\"col-7 d-none\"><input type=\"text\" class=\"form-control\" id=\"input-payment_fullname\" value=\"";
        // line 327
        echo ($context["payment_fullname"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-5\">";
        // line 330
        echo ($context["text_company"] ?? null);
        echo "</div>
\t\t\t<div id=\"payment_company-value\" class=\"col-7\"><span id=\"payment_company\">";
        // line 331
        echo ($context["payment_company"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"payment_company-edit\" class=\"col-7 d-none\"><input type=\"text\" class=\"form-control\" id=\"input-payment_company\" value=\"";
        // line 332
        echo ($context["payment_company"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-5\">";
        // line 335
        echo ($context["text_address_1"] ?? null);
        echo "</div>
\t\t\t<div id=\"payment_address_1-value\" class=\"col-7\"><span id=\"payment_address_1\">";
        // line 336
        echo ($context["payment_address_1"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"payment_address_1-edit\" class=\"col-7 d-none\"><input type=\"text\" class=\"form-control\" id=\"input-payment_address_1\" value=\"";
        // line 337
        echo ($context["payment_address_1"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-5\">";
        // line 340
        echo ($context["text_address_2"] ?? null);
        echo "</div>
\t\t\t<div id=\"payment_address_2-value\" class=\"col-7\"><span id=\"payment_address_2\">";
        // line 341
        echo ($context["payment_address_2"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"payment_address_2-edit\" class=\"col-7 d-none\"><input type=\"text\" class=\"form-control\" id=\"input-payment_address_2\" value=\"";
        // line 342
        echo ($context["payment_address_2"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-5\">";
        // line 345
        echo ($context["text_city"] ?? null);
        echo "</div>
\t\t\t<div id=\"payment_city-value\" class=\"col-7\"><span id=\"payment_city\">";
        // line 346
        echo ($context["payment_city"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"payment_city-edit\" class=\"col-7 d-none\"><input type=\"text\" class=\"form-control\" id=\"input-payment_city\" value=\"";
        // line 347
        echo ($context["payment_city"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-5\">";
        // line 350
        echo ($context["text_postcode"] ?? null);
        echo "</div>
\t\t\t<div id=\"payment_postcode-value\" class=\"col-7\"><span id=\"payment_postcode\">";
        // line 351
        echo ($context["payment_postcode"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"payment_postcode-edit\" class=\"col-7 d-none\"><input type=\"text\" class=\"form-control\" id=\"input-payment_postcode\" value=\"";
        // line 352
        echo ($context["payment_postcode"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-5\">";
        // line 355
        echo ($context["text_country"] ?? null);
        echo "</div>
\t\t\t<div id=\"payment_country_id-value\" class=\"col-7\"><span id=\"payment_country\">";
        // line 356
        echo ($context["payment_country"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"payment_country_id-edit\" class=\"col-7 d-none\">
\t\t\t  <select class=\"select\" id=\"select-payment_country_id\" data-mdb-filter=\"true\">
\t\t\t\t<option value=\"0\" disabled selected></option>
\t\t\t\t";
        // line 360
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["countries"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["country"]) {
            // line 361
            echo "\t\t\t\t<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 361);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 361) == ($context["payment_country_id"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["country"], "name", [], "any", false, false, false, 361);
            echo "</option>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['country'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 363
        echo "\t\t\t  </select>
\t\t\t</div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-5\">";
        // line 367
        echo ($context["text_zone"] ?? null);
        echo "</div>
\t\t\t<div id=\"payment_zone_id-value\" class=\"col-7\"><span id=\"payment_zone\">";
        // line 368
        echo ($context["payment_zone"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"payment_zone_id-edit\" class=\"col-7 d-none\">
\t\t\t  <select class=\"select\" id=\"select-payment_zone_id\" data-mdb-filter=\"true\">
\t\t\t\t";
        // line 371
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["payment_zones"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["zone"]) {
            // line 372
            echo "\t\t\t\t<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["zone"], "zone_id", [], "any", false, false, false, 372);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["zone"], "zone_id", [], "any", false, false, false, 372) == ($context["payment_zone_id"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["zone"], "name", [], "any", false, false, false, 372);
            echo "</option>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['zone'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 374
        echo "\t\t\t  </select>
\t\t\t</div>
\t\t  </div>
\t\t  <div class=\"row align-items-center mb-2\">
\t\t\t<div class=\"col-5\">";
        // line 378
        echo ($context["text_fiscal_code"] ?? null);
        echo "</div>
\t\t\t<div id=\"fiscal_code-value\" class=\"col-7\"><span id=\"fiscal_code\">";
        // line 379
        echo ($context["fiscal_code"] ?? null);
        echo "</span></div>
\t\t\t<div id=\"fiscal_code-edit\" class=\"col-7 d-none\"><input type=\"text\" class=\"form-control\" id=\"input-fiscal_code\" value=\"";
        // line 380
        echo ($context["fiscal_code"] ?? null);
        echo "\" /></div>
\t\t  </div>
\t\t  <div class=\"row mt-3\">
\t\t\t<div class=\"col\"><button type=\"button\" class=\"btn btn-primary d-none me-2\" id=\"save-payment_address\"><i class=\"fa fa-save me-2\"></i>";
        // line 383
        echo ($context["button_save"] ?? null);
        echo "</button><button type=\"button\" class=\"btn d-none\" id=\"cancel-payment_address\">";
        echo ($context["button_cancel"] ?? null);
        echo "</button></div>
\t\t  </div>
\t\t</div>
\t  </div>
\t</div>
  </div>
  <div class=\"card mb-3\">
\t<div class=\"card-body\">
\t  <h5 class=\"card-title mb-3\">";
        // line 391
        echo ($context["text_integretions"] ?? null);
        echo "</h5>
\t  ";
        // line 392
        if ((($context["print_waybill"] ?? null) != "")) {
            // line 393
            echo "\t  <a href=\"";
            echo ($context["print_waybill"] ?? null);
            echo "\" class=\"btn btn-lg btn-primary\"><i class=\"fas fa-print me-2\"></i>";
            echo ($context["tracking"] ?? null);
            echo " (";
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_0 = ($context["delivery_integrations"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[($context["shipping_code"] ?? null)] ?? null) : null), "title", [], "any", false, false, false, 393);
            echo ")</a>
\t  ";
        } else {
            // line 395
            echo "\t    ";
            if (($context["delivery_integrations"] ?? null)) {
                // line 396
                echo "\t\t  ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["delivery_integrations"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["integration"]) {
                    // line 397
                    echo "\t\t  <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["integration"], "url", [], "any", false, false, false, 397);
                    echo "\" class=\"btn btn-lg btn-primary me-2\" onclick=\"loading();\">";
                    echo twig_get_attribute($this->env, $this->source, $context["integration"], "title", [], "any", false, false, false, 397);
                    echo "</a>
\t\t  ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['integration'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 399
                echo "\t\t";
            } else {
                // line 400
                echo "\t\t<div class=\"text-center\">";
                echo ($context["text_no_integrations"] ?? null);
                echo "</div>
\t\t";
            }
            // line 402
            echo "\t  ";
        }
        // line 403
        echo "\t</div>
  </div>
</div>
</main>
<script>
\$('#copy-payment_address').click(function(e) {
  e.currentTarget.innerHTML = \"<i class='fas fa-clone'></i>\";
  
  \$('#input-fullname').val(\$('#payment_fullname').html());
  \$('#input-shipping_company').val(\$('#payment_company').html());
  \$('#input-shipping_address_1').val(\$('#payment_address_1').html());
  \$('#input-shipping_address_2').val(\$('#payment_address_2').html());
  \$('#input-shipping_city').val(\$('#payment_city').html());
  \$('#input-shipping_postcode').val(\$('#payment_postcode').html());
  
  \$('#select-shipping_country_id').html(\$('#select-payment_country_id').html());
  
  \$('#select-shipping_country_id option[value=\"' + \$('#select-payment_country_id').val() + '\"]').attr('selected', true);
  
  \$('#select-shipping_zone_id').html(\$('#select-payment_zone_id').html());
 
  \$('#select-shipping_zone_id option[value=\"' + \$('#select-payment_zone_id').val() + '\"]').attr('selected', true);
  
  if (\$('#fullname-edit').hasClass('d-none')) {
\t\$('#fullname').html(\$('#payment_fullname').html());
\t\$('#shipping_company').html(\$('#payment_company').html());
\t\$('#shipping_address_1').html(\$('#payment_address_1').html());
\t\$('#shipping_address_2').html(\$('#payment_address_2').html());
\t\$('#shipping_city').html(\$('#payment_city').html());
\t\$('#shipping_postcode').html(\$('#payment_postcode').html());
\t\$('#shipping_zone').html(\$('#payment_zone').html());
\t\$('#shipping_country').html(\$('#payment_country').html());

\t\$('#save-shipping_address').trigger('click');
  }
  
  return false;
});

\$('#copy-shipping_address').click(function(e) {
  e.currentTarget.innerHTML = \"<i class='fas fa-clone'></i>\";
  
  \$('#input-payment_fullname').val(\$('#fullname').html());
  \$('#input-payment_company').val(\$('#shipping_company').html());
  \$('#input-payment_address_1').val(\$('#shipping_address_1').html());
  \$('#input-payment_address_2').val(\$('#shipping_address_2').html());
  \$('#input-payment_city').val(\$('#shipping_city').html());
  \$('#input-payment_postcode').val(\$('#shipping_postcode').html());
  
  \$('#select-payment_country_id').html(\$('#select-shipping_country_id').html());
  
  \$('#select-payment_country_id option[value=\"' + \$('#select-shipping_country_id').val() + '\"]').attr('selected', true);
  
  \$('#select-payment_zone_id').html(\$('#select-shipping_zone_id').html());
  
  \$('#select-payment_zone_id option[value=\"' + \$('#select-shipping_zone_id').val() + '\"]').attr('selected', true);
  
  if (\$('#payment_fullname-edit').hasClass('d-none')) {
\t\$('#payment_fullname').html(\$('#fullname').html());
\t\$('#payment_company').html(\$('#shipping_company').html());
\t\$('#payment_address_1').html(\$('#shipping_address_1').html());
\t\$('#payment_address_2').html(\$('#shipping_address_2').html());
\t\$('#payment_city').html(\$('#shipping_city').html());
\t\$('#payment_postcode').html(\$('#shipping_postcode').html());
\t\$('#payment_zone').html(\$('#shipping_zone').html());
\t\$('#payment_country').html(\$('#shipping_country').html());

\t\$('#save-payment_address').trigger('click');
  }
  
  return false;
});

\$(document).ready(function() {
  resizeProductTable();
});

function resizeProductTable() {
  if (\$(window).width() < 800) {
\t\$('#table-product').addClass('table-sm');
  } else {
    \$('#table-product').removeClass('table-sm');
  }
}

\$(window).on('resize', function() {
  resizeProductTable();
});

//Payment address
\$('#save-payment_address').click(function(e) {
  let post = {};
  
  post.payment_fullname = \$('#input-payment_fullname').val();
  post.payment_company = \$('#input-payment_company').val();
  post.payment_address_1 = \$('#input-payment_address_1').val();
  post.payment_address_2 = \$('#input-payment_address_2').val();
  post.payment_city = \$('#input-payment_city').val();
  post.payment_postcode = \$('#input-payment_postcode').val();
  post.payment_country_id = \$('#select-payment_country_id').val();
  post.payment_country = \$('#select-payment_country_id option[value=\"'+post.payment_country_id+'\"]').html();
  post.payment_zone_id = \$('#select-payment_zone_id').val();
  post.payment_zone = \$('#select-payment_zone_id option[value=\"'+post.payment_zone_id+'\"]').html();
  post.fiscal_code = \$('#input-fiscal_code').val();
  
  \$.ajax({
\turl: '";
        // line 509
        echo ($context["server"] ?? null);
        echo "index.php?route=sale/order.editOrderInfo&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&order_id=";
        echo ($context["order_id"] ?? null);
        echo "',
\tmethod: 'POST',
\tdata: post,
\tdataType: 'json',
  }).done(function(json) {
    if (json.error !== undefined) {
\t  addAlert('";
        // line 515
        echo ($context["text_error"] ?? null);
        echo "', json.error, 'danger');
\t  return;
\t}
\t
\tif (json.date_modified === undefined) {
\t  return;
\t}
\t
\t\$('#date_modified').html(json.date_modified);
  
\t\$('#payment_fullname-value').removeClass('d-none');
\t\$('#payment_fullname-edit').addClass('d-none');
  
\t\$('#payment_fullname').html(\$('#input-payment_fullname').val());
  
\t\$('#payment_company-value').removeClass('d-none');
\t\$('#payment_company-edit').addClass('d-none');
  
\t\$('#payment_company').html(\$('#input-payment_company').val());
  
\t\$('#payment_address_1-value').removeClass('d-none');
\t\$('#payment_address_1-edit').addClass('d-none');
  
\t\$('#payment_address_1').html(\$('#input-payment_address_1').val());
\t
\t\$('#payment_address_2-value').removeClass('d-none');
\t\$('#payment_address_2-edit').addClass('d-none');
  
\t\$('#payment_address_2').html(\$('#input-payment_address_2').val());
  
\t\$('#payment_city-value').removeClass('d-none');
\t\$('#payment_city-edit').addClass('d-none');
  
\t\$('#payment_city').html(\$('#input-payment_city').val());
  
\t\$('#payment_postcode-value').removeClass('d-none');
\t\$('#payment_postcode-edit').addClass('d-none');
  
\t\$('#payment_postcode').html(\$('#input-payment_postcode').val());
  
\t\$('#payment_country_id-value').removeClass('d-none');
\t\$('#payment_country_id-edit').addClass('d-none');
\t
\t\$('#payment_country').html(post.payment_country);
\t
\t\$('#payment_zone_id-value').removeClass('d-none');
\t\$('#payment_zone_id-edit').addClass('d-none');
\t
\t\$('#payment_zone').html(post.payment_zone);
\t
\t\$('#fiscal_code-value').removeClass('d-none');
\t\$('#fiscal_code-edit').addClass('d-none');
\t
\t\$('#fiscal_code').html(post.fiscal_code);
  
\t\$('#save-payment_address').addClass('d-none');
\t\$('#cancel-payment_address').addClass('d-none');
\t
\taddAlert('";
        // line 573
        echo ($context["text_success"] ?? null);
        echo "', '";
        echo ($context["text_success_order_info"] ?? null);
        echo "', 'success', 4000);
  });
});

let selectPaymentZoneIdHTML = '';
let selectPaymentCountryIdHTML = '';

\$('#edit-payment_address').click(function(e) {
  \$('#payment_fullname-value').addClass('d-none');
  \$('#payment_fullname-edit').removeClass('d-none');
  
  \$('#payment_company-value').addClass('d-none');
  \$('#payment_company-edit').removeClass('d-none');
  
  \$('#payment_address_1-value').addClass('d-none');
  \$('#payment_address_1-edit').removeClass('d-none');
  
  \$('#payment_address_2-value').addClass('d-none');
  \$('#payment_address_2-edit').removeClass('d-none');
  
  \$('#payment_city-value').addClass('d-none');
  \$('#payment_city-edit').removeClass('d-none');
  
  \$('#payment_postcode-value').addClass('d-none');
  \$('#payment_postcode-edit').removeClass('d-none');
  
  \$('#payment_zone_id-value').addClass('d-none');
  \$('#payment_zone_id-edit').removeClass('d-none');
  
  \$('#payment_country_id-value').addClass('d-none');
  \$('#payment_country_id-edit').removeClass('d-none');
  
  \$('#fiscal_code-value').addClass('d-none');
  \$('#fiscal_code-edit').removeClass('d-none');
  
  selectPaymentZoneIdHTML = \$('#select-payment_zone_id').html();
  selectPaymentCountryIdHTML = \$('#select-payment_country_id').html();
  
  \$('#save-payment_address').removeClass('d-none');
  \$('#cancel-payment_address').removeClass('d-none');
  
  return false;
});

\$('#cancel-payment_address').click(function(e) {
  \$('#payment_fullname-value').removeClass('d-none');
  \$('#payment_fullname-edit').addClass('d-none');
  
  \$('#input-payment_fullname').val(\$('#payment_fullname').html());
  
  \$('#payment_company-value').removeClass('d-none');
  \$('#payment_company-edit').addClass('d-none');
  
  \$('#input-payment_company').val(\$('#payment_company').html());
  
  \$('#payment_address_1-value').removeClass('d-none');
  \$('#payment_address_1-edit').addClass('d-none');
  
  \$('#input-payment_address_1').val(\$('#payment_address_1').html());
  
  \$('#payment_address_2-value').removeClass('d-none');
  \$('#payment_address_2-edit').addClass('d-none');
  
  \$('#input-payment_address_2').val(\$('#payment_address_2').html());
  
  \$('#payment_city-value').removeClass('d-none');
  \$('#payment_city-edit').addClass('d-none');
  
  \$('#input-payment_city').val(\$('#payment_city').html());
  
  \$('#payment_postcode-value').removeClass('d-none');
  \$('#payment_postcode-edit').addClass('d-none');
  
  \$('#input-payment_postcode').val(\$('#payment_postcode').html());
  
  \$('#payment_zone_id-value').removeClass('d-none');
  \$('#payment_zone_id-edit').addClass('d-none');
  
  \$('#select-payment_zone_id').html(selectPaymentZoneIdHTML);
  
  \$('#payment_country_id-value').removeClass('d-none');
  \$('#payment_country_id-edit').addClass('d-none');
  
  \$('#select-payment_country_id').html(selectPaymentCountryIdHTML);
  
  \$('#fiscal_code-value').removeClass('d-none');
  \$('#fiscal_code-edit').addClass('d-none');
  
  \$('#input-fiscal_code').val(\$('#fiscal_code').html());
  
  \$('#save-payment_address').addClass('d-none');
  \$('#cancel-payment_address').addClass('d-none');
});

\$('#select-payment_country_id').change(function(event) {
  \$.ajax({
\turl: '";
        // line 669
        echo ($context["server"] ?? null);
        echo "index.php?route=sale/order.getZones&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&country_id=' + encodeURIComponent(event.target.value),
\tdataType: 'json',
\tsuccess: function(json) {
\t  \$('#select-payment_zone_id option').remove();
\t  \$.each(json, function (i, item) {
\t\t\$('#select-payment_zone_id').append(\$('<option>', { 
\t\t  value: item.id,
\t\t  text : item.name
\t\t}));
\t  });
\t}
  })
});

//Shipping address
\$('#save-shipping_address').click(function(e) {
  let post = {};
  
  post.fullname = \$('#input-fullname').val();
  post.shipping_company = \$('#input-shipping_company').val();
  post.shipping_address_1 = \$('#input-shipping_address_1').val();
  post.shipping_address_2 = \$('#input-shipping_address_2').val();
  post.shipping_city = \$('#input-shipping_city').val();
  post.shipping_postcode = \$('#input-shipping_postcode').val();
  post.shipping_country_id = \$('#select-shipping_country_id').val();
  post.shipping_country = \$('#select-shipping_country_id option[value=\"'+post.shipping_country_id+'\"]').html();
  post.shipping_zone_id = \$('#select-shipping_zone_id').val();
  post.shipping_zone = \$('#select-shipping_zone_id option[value=\"'+post.shipping_zone_id+'\"]').html();
  
  \$.ajax({
\turl: '";
        // line 699
        echo ($context["server"] ?? null);
        echo "index.php?route=sale/order.editOrderInfo&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&order_id=";
        echo ($context["order_id"] ?? null);
        echo "',
\tmethod: 'POST',
\tdata: post,
\tdataType: 'json',
  }).done(function(json) {
    if (json.error !== undefined) {
\t  addAlert('";
        // line 705
        echo ($context["text_error"] ?? null);
        echo "', json.error, 'danger');
\t  return;
\t}
\t
\tif (json.date_modified === undefined) {
\t  return;
\t}
\t
\t\$('#date_modified').html(json.date_modified);
  
\t\$('#fullname-value').removeClass('d-none');
\t\$('#fullname-edit').addClass('d-none');
  
\t\$('#fullname').html(\$('#input-fullname').val());
  
\t\$('#shipping_company-value').removeClass('d-none');
\t\$('#shipping_company-edit').addClass('d-none');
  
\t\$('#shipping_company').html(\$('#input-shipping_company').val());
  
\t\$('#shipping_address_1-value').removeClass('d-none');
\t\$('#shipping_address_1-edit').addClass('d-none');
  
\t\$('#shipping_address_1').html(\$('#input-shipping_address_1').val());
\t
\t\$('#shipping_address_2-value').removeClass('d-none');
\t\$('#shipping_address_2-edit').addClass('d-none');
  
\t\$('#shipping_address_2').html(\$('#input-shipping_address_2').val());
  
\t\$('#shipping_city-value').removeClass('d-none');
\t\$('#shipping_city-edit').addClass('d-none');
  
\t\$('#shipping_city').html(\$('#input-shipping_city').val());
  
\t\$('#shipping_postcode-value').removeClass('d-none');
\t\$('#shipping_postcode-edit').addClass('d-none');
  
\t\$('#shipping_postcode').html(\$('#input-shipping_postcode').val());
  
\t\$('#shipping_country_id-value').removeClass('d-none');
\t\$('#shipping_country_id-edit').addClass('d-none');
\t
\t\$('#shipping_country').html(post.shipping_country);
\t
\t\$('#shipping_zone_id-value').removeClass('d-none');
\t\$('#shipping_zone_id-edit').addClass('d-none');
\t
\t\$('#shipping_zone').html(post.shipping_zone);
  
\t\$('#save-shipping_address').addClass('d-none');
\t\$('#cancel-shipping_address').addClass('d-none');
\t
\taddAlert('";
        // line 758
        echo ($context["text_success"] ?? null);
        echo "', '";
        echo ($context["text_success_order_info"] ?? null);
        echo "', 'success', 4000);
  });
});

let selectShippingZoneIdHTML = '';
let selectShippingCountryIdHTML = '';

\$('#edit-shipping_address').click(function(e) {
  \$('#fullname-value').addClass('d-none');
  \$('#fullname-edit').removeClass('d-none');
  
  \$('#shipping_company-value').addClass('d-none');
  \$('#shipping_company-edit').removeClass('d-none');
  
  \$('#shipping_address_1-value').addClass('d-none');
  \$('#shipping_address_1-edit').removeClass('d-none');
  
  \$('#shipping_address_2-value').addClass('d-none');
  \$('#shipping_address_2-edit').removeClass('d-none');
  
  \$('#shipping_city-value').addClass('d-none');
  \$('#shipping_city-edit').removeClass('d-none');
  
  \$('#shipping_postcode-value').addClass('d-none');
  \$('#shipping_postcode-edit').removeClass('d-none');
  
  \$('#shipping_zone_id-value').addClass('d-none');
  \$('#shipping_zone_id-edit').removeClass('d-none');
  
  \$('#shipping_country_id-value').addClass('d-none');
  \$('#shipping_country_id-edit').removeClass('d-none');
  
  selectShippingZoneIdHTML = \$('#select-shipping_zone_id').html();
  selectShippingCountryIdHTML = \$('#select-shipping_country_id').html();
  
  \$('#save-shipping_address').removeClass('d-none');
  \$('#cancel-shipping_address').removeClass('d-none');
  
  return false;
});

\$('#cancel-shipping_address').click(function(e) {
  \$('#fullname-value').removeClass('d-none');
  \$('#fullname-edit').addClass('d-none');
  
  \$('#input-fullname').val(\$('#fullname').html());
  
  \$('#shipping_company-value').removeClass('d-none');
  \$('#shipping_company-edit').addClass('d-none');
  
  \$('#input-shipping_company').val(\$('#shipping_company').html());
  
  \$('#shipping_address_1-value').removeClass('d-none');
  \$('#shipping_address_1-edit').addClass('d-none');
  
  \$('#input-shipping_address_1').val(\$('#shipping_address_1').html());
  
  \$('#shipping_address_2-value').removeClass('d-none');
  \$('#shipping_address_2-edit').addClass('d-none');
  
  \$('#input-shipping_address_2').val(\$('#shipping_address_2').html());
  
  \$('#shipping_city-value').removeClass('d-none');
  \$('#shipping_city-edit').addClass('d-none');
  
  \$('#input-shipping_city').val(\$('#shipping_city').html());
  
  \$('#shipping_postcode-value').removeClass('d-none');
  \$('#shipping_postcode-edit').addClass('d-none');
  
  \$('#input-shipping_postcode').val(\$('#shipping_postcode').html());
  
  \$('#shipping_zone_id-value').removeClass('d-none');
  \$('#shipping_zone_id-edit').addClass('d-none');
  
  \$('#select-shipping_zone_id').html(selectShippingZoneIdHTML);
  
  \$('#shipping_country_id-value').removeClass('d-none');
  \$('#shipping_country_id-edit').addClass('d-none');
  
  \$('#select-shipping_country_id').html(selectShippingCountryIdHTML);
  
  \$('#save-shipping_address').addClass('d-none');
  \$('#cancel-shipping_address').addClass('d-none');
});

\$('#select-shipping_country_id').change(function(event) {
  \$.ajax({
\turl: '";
        // line 846
        echo ($context["server"] ?? null);
        echo "index.php?route=sale/order.getZones&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&country_id=' + encodeURIComponent(event.target.value),
\tdataType: 'json',
\tsuccess: function(json) {
\t  \$('#select-shipping_zone_id option').remove();
\t  \$.each(json, function (i, item) {
\t\t\$('#select-shipping_zone_id').append(\$('<option>', { 
\t\t  value: item.id,
\t\t  text : item.name
\t\t}));
\t  });
\t}
  })
});

//Order info
\$('#save-order_status').click(function(e) {
  let post = {};
  
  post.order_status_id = \$('#select-order_status').val();
  
  \$.ajax({
\turl: '";
        // line 867
        echo ($context["server"] ?? null);
        echo "index.php?route=sale/order.editOrderInfo&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&order_id=";
        echo ($context["order_id"] ?? null);
        echo "',
\tmethod: 'POST',
\tdata: post,
\tdataType: 'json',
  }).done(function(json) {
    if (json.error !== undefined) {
\t  addAlert('";
        // line 873
        echo ($context["text_error"] ?? null);
        echo "', json.error, 'danger');
\t  return;
\t}
\t
\tif (json.date_modified === undefined) {
\t  return;
\t}
\t
\t\$('#date_modified').html(json.date_modified);
\t
\taddAlert('";
        // line 883
        echo ($context["text_success"] ?? null);
        echo "', '";
        echo ($context["text_success_order_info"] ?? null);
        echo "', 'success', 4000);
  });
});

\$('#edit-order_info').click(function(e) {
  \$('#email-value').addClass('d-none');
  \$('#email-edit').removeClass('d-none');
  
  \$('#telephone-value').addClass('d-none');
  \$('#telephone-edit').removeClass('d-none');
  
  \$('#shipping_method-value').addClass('d-none');
  \$('#shipping_method-edit').removeClass('d-none');
  
  \$('#shipping_cost-value').addClass('d-none');
  \$('#shipping_cost-edit').removeClass('d-none');
  
  \$('#payment_method-value').addClass('d-none');
  \$('#payment_method-edit').removeClass('d-none');
  
  \$('#comment-value').addClass('d-none');
  \$('#comment-edit').removeClass('d-none');
  
  \$('#save-order_info').removeClass('d-none');
  \$('#cancel-order_info').removeClass('d-none');
  
  return false;
});

\$('#cancel-order_info').click(function(e) {
  \$('#email-value').removeClass('d-none');
  \$('#email-edit').addClass('d-none');
  
  \$('#input-email').val(\$('#email').html());
  
  \$('#telephone-value').removeClass('d-none');
  \$('#telephone-edit').addClass('d-none');
  
  \$('#input-telephone').val(\$('#telephone').html());
  
  \$('#shipping_method-value').removeClass('d-none');
  \$('#shipping_method-edit').addClass('d-none');
  
  \$('#input-shipping_method').val(\$('#shipping_method').html());
  
  \$('#shipping_cost-value').removeClass('d-none');
  \$('#shipping_cost-edit').addClass('d-none');
  
  \$('#input-shipping_cost').val(\$('#shipping_cost').html());
  
  \$('#payment_method-value').removeClass('d-none');
  \$('#payment_method-edit').addClass('d-none');
  
  \$('#input-payment_method').val(\$('#payment_method').html());
  
  \$('#comment-value').removeClass('d-none');
  \$('#comment-edit').addClass('d-none');
  
  \$('#input-comment').val(\$('#comment').html());
  
  \$('#save-order_info').addClass('d-none');
  \$('#cancel-order_info').addClass('d-none');
});

\$('#save-order_info').click(function(e) {
  let post = {};
  
  post.email = \$('#input-email').val();
  post.telephone = \$('#input-telephone').val();
  post.shipping_method = \$('#input-shipping_method').val();
  post.shipping_cost = \$('#input-shipping_cost').val();
  post.payment_method = \$('#input-payment_method').val();
  post.comment = \$('#input-comment').val();
  
  \$.ajax({
\turl: '";
        // line 958
        echo ($context["server"] ?? null);
        echo "index.php?route=sale/order.editOrderInfo&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&order_id=";
        echo ($context["order_id"] ?? null);
        echo "',
\tmethod: 'POST',
\tdata: post,
\tdataType: 'json',
  }).done(function(json) {
    if (json.error !== undefined) {
\t  addAlert('";
        // line 964
        echo ($context["text_error"] ?? null);
        echo "', json.error, 'danger');
\t  return;
\t}
\t
\tif (json.date_modified === undefined) {
\t  return;
\t}
\t
\t\$('#date_modified').html(json.date_modified);
\t\$('#total').html(json.total);
  
\t\$('#email-value').removeClass('d-none');
\t\$('#email-edit').addClass('d-none');
  
\t\$('#email').html(\$('#input-email').val());
  
\t\$('#telephone-value').removeClass('d-none');
\t\$('#telephone-edit').addClass('d-none');
  
\t\$('#telephone').html(\$('#input-telephone').val());
  
\t\$('#shipping_method-value').removeClass('d-none');
\t\$('#shipping_method-edit').addClass('d-none');
  
\t\$('#shipping_method').html(\$('#input-shipping_method').val());
  
\t\$('#shipping_cost-value').removeClass('d-none');
\t\$('#shipping_cost-edit').addClass('d-none');
  
\t\$('#shipping_cost').html(\$('#input-shipping_cost').val());
  
\t\$('#payment_method-value').removeClass('d-none');
\t\$('#payment_method-edit').addClass('d-none');
  
\t\$('#payment_method').html(\$('#input-payment_method').val());
  
\t\$('#comment-value').removeClass('d-none');
\t\$('#comment-edit').addClass('d-none');
  
\t\$('#comment').html(\$('#input-comment').val());
  
\t\$('#save-order_info').addClass('d-none');
\t\$('#cancel-order_info').addClass('d-none');
\t
\taddAlert('";
        // line 1008
        echo ($context["text_success"] ?? null);
        echo "', '";
        echo ($context["text_success_order_info"] ?? null);
        echo "', 'success', 4000);
  });
});

\$(document).delegate('#button-invoice', 'click', function() {
  \$.ajax({
\turl: '";
        // line 1014
        echo ($context["server"] ?? null);
        echo "index.php?route=sale/order.createInvoiceNo&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&order_id=";
        echo ($context["order_id"] ?? null);
        echo "',
\tdataType: 'json',
\tbeforeSend: function() {
\t},
\tcomplete: function() {
\t},
\tsuccess: function(json) {
\t  \$('.alert-dismissible').remove();
\t  if (json['error']) {
\t\t\$('#container').prepend('<div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"danger\">' + json['error'] + '<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button></div>');
\t\tdocument.querySelectorAll('.alert').forEach((alert) => {
\t\t  new mdb.Alert(alert);
\t\t});
\t  }
\t  if (json['invoice_no']) {
\t\t\$('#invoice').html('<a href=\"'+json['invoice']+'\" target=\"blank\" class=\"text-primary\">'+json['invoice_no']+'</a>');
\t  }
\t},
\terror: function(xhr, ajaxOptions, thrownError) {
\t  alert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t}
  });
});

//Order product
\$(document).ready(function() {
  orderProductsInit();
  
  const asyncFilter = async (query) => {
\tconst url = `";
        // line 1043
        echo ($context["server"] ?? null);
        echo "index.php?route=sale/order.autocompleteProduct&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&search=\${encodeURI(query)}`;
\tconst response = await fetch(url);
\tconst data = await response.json();
\treturn data;
  };
  
  \$('#add_order_product-name').autocomplete({
\tfilter: asyncFilter,
\tnoResults: '',
\tdisplayValue: function(value) {
\t  return value.name;
\t}
  });
  
  \$('#add_order_product-name').on('itemSelect.mdb.autocomplete', function(e) {
    \$('#input-add_order_product-sku').val(e.value.sku);
    \$('#input-add_order_product-price').val(e.value.price);
    \$('#input-add_order_product-weight').val(e.value.weight);
\t
\t\$('#input-add_order_product-sku').addClass('active');
\t\$('#input-add_order_product-price').addClass('active');
\t\$('#input-add_order_product-weight').addClass('active');
\t
    window.setTimeout(function() {
\t  \$('#input-add_order_product-quantity').focus();
\t}, 50);
  });
  
  \$('#input-add_order_product-sku').change(function() {
    let sku = \$('#input-add_order_product-sku').val();
  
\t\$.ajax({
\t\turl: '";
        // line 1075
        echo ($context["server"] ?? null);
        echo "index.php?route=sale/order.getProductBySku&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&sku=' + encodeURIComponent(sku),
\t\tdataType: 'json',
\t  }).done(function(json) {
\t\tif(json['price'] === undefined) {
\t\t  \$('#input-add_order_product-sku').val('');
\t\t  return;
\t\t}
\t\t
\t\t\$('#date_modified').html(json.date_modified);
\t\t\$('#total').html(json.total);
\t\t
\t\t\$('#input-add_order_product-name').val(json['name']);
\t\t\$('#input-add_order_product-price').val(json['price']);
\t\t\$('#input-add_order_product-weight').val(json['weight']);
\t\t
\t\t\$('#input-add_order_product-name').addClass('active');
\t\t\$('#input-add_order_product-price').addClass('active');
\t\t\$('#input-add_order_product-weight').addClass('active');
\t\t
\t\twindow.setTimeout(function() {
\t\t  \$('#input-add_order_product-quantity').focus();
\t\t}, 50);
\t  });
  });
});


\$('#btn-add_order_product-save').click(function() {
  let order_product_sku = \$('#input-add_order_product-sku').val();
  let order_product_name = \$('#input-add_order_product-name').val();
  let order_product_price = \$('#input-add_order_product-price').val();
  let order_product_quantity = \$('#input-add_order_product-quantity').val();
  let order_product_weight = \$('#input-add_order_product-weight').val();

  \$.ajax({
\turl: '";
        // line 1110
        echo ($context["server"] ?? null);
        echo "index.php?route=sale/order.addOrderProduct&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&order_id=";
        echo ($context["order_id"] ?? null);
        echo "',
\tmethod: 'POST',
\tdata: {sku: order_product_sku, name: order_product_name, price: order_product_price, quantity: order_product_quantity, weight: order_product_weight},
\tdataType: 'json',
  }).done(function(json) {
    if(json.error !== undefined) {
\t  addAlert('";
        // line 1116
        echo ($context["text_error"] ?? null);
        echo "', json.error, 'danger');
\t  return;
\t}
  
\tif(json['success'] != 1) {
\t  return;
\t}
\t
\t\$('#date_modified').html(json.date_modified);
\t\$('#total').html(json.total);
  
\tlet html = '';
  
\thtml += '<tr id=\"'+json['order_product_id']+'\" class=\"order_product\">';
\t  html += '<td class=\"text-center\"><input type=\"hidden\" id=\"'+json['order_product_id']+'-price\" value=\"'+json['price']+'\" /><img src=\"'+json['image']+'\" alt=\"'+json['name']+'\" style=\"min-width: 50px;\" class=\"img-thumbnail\" /></th>';
\t  html += '<td id=\"'+json['order_product_id']+'-sku\" class=\"text-center\">'+json['sku']+'</td>';
\t  html += '<td id=\"'+json['order_product_id']+'-name\">'+json['name']+'</td>';
\t  html += '<td id=\"'+json['order_product_id']+'-quantity\" class=\"text-center\">'+json['quantity']+'</td>';
\t  html += '<td id=\"'+json['order_product_id']+'-price_formated\" class=\"text-center\">'+json['price_formated']+'</td>';
\t  html += '<td id=\"'+json['order_product_id']+'-weight\" class=\"text-center\">'+json['weight']+'</td>';
\t  html += '<td class=\"text-center\">';
\t\thtml += '<div class=\"dropdown\">';
\t\t  html += '<button class=\"btn btn-primary dropdown-button\" type=\"button\" id=\"'+json['order_product_id']+'dropdownMenuButton\" data-mdb-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fas fa-bars\"></i></button>';
\t\t  html += '<ul class=\"dropdown-menu\" aria-labelledby=\"'+json['order_product_id']+'dropdownMenuButton\">';
\t\t\thtml += '<li><button class=\"dropdown-item btn-edit_order_product-manual\" data-order_product_id=\"'+json['order_product_id']+'\" data-mdb-toggle=\"modal\" data-mdb-target=\"#manualProductModal\"><i class=\"fas fa-pencil-alt me-2\"></i>";
        // line 1140
        echo ($context["button_edit"] ?? null);
        echo "</button></li>';
\t\t\thtml += '<li><button class=\"dropdown-item text-danger btn-delete_order_product\" data-order_product_id=\"'+json['order_product_id']+'\"><i class=\"fas fa-trash me-2\"></i>";
        // line 1141
        echo ($context["button_delete"] ?? null);
        echo "</button></li>';
\t\t  html += '</ul>';
\t\thtml += '</div>';
\t  html += '</td>';
\thtml += '</tr>';
  
\t\$('#order-products').append(html);
  
\torderProductsInit();
\t
\taddAlert('";
        // line 1151
        echo ($context["text_success"] ?? null);
        echo "', '";
        echo ($context["text_success_order_info"] ?? null);
        echo "', 'success', 4000);
  });

  \$('#no-products').addClass('d-none');

  window.setTimeout(function() {
\t\$('#input-add_order_product-quantity').val(1);
\t\$('#input-add_order_product-price').val('');
\t\$('#input-add_order_product-weight').val('');
\t\$('#input-add_order_product-sku').val('');
\t\$('#input-add_order_product-name').val('');
  }, 50);
});

\$('#btn-add_order_product-manual').click(function() {
  \$('#input-order_product_id').val(0);
  \$('#input-order_product_name').val('');
  \$('#input-order_product_price').val('');
  \$('#input-order_product_quantity').val('');
  \$('#input-order_product_weight').val('');
});

\$('#btn-edit_order_product-manual-save').click(function() {
  let order_product_id = \$('#input-order_product_id').val();
  let order_product_name = \$('#input-order_product_name').val();
  let order_product_price = \$('#input-order_product_price').val();
  let order_product_quantity = \$('#input-order_product_quantity').val();
  let order_product_weight = \$('#input-order_product_weight').val();
  
  if (order_product_id != 0) {
    \$.ajax({
\t  url: '";
        // line 1182
        echo ($context["server"] ?? null);
        echo "index.php?route=sale/order.editOrderProduct&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&order_id=";
        echo ($context["order_id"] ?? null);
        echo "&order_product_id=' + encodeURIComponent(order_product_id),
\t  method: 'POST',
\t  data: {name: order_product_name, price: order_product_price, quantity: order_product_quantity, weight: order_product_weight},
\t  dataType: 'json',
\t}).done(function(json) {
\t  if(json.error !== undefined) {
\t\taddAlert('";
        // line 1188
        echo ($context["text_error"] ?? null);
        echo "', json.error, 'danger');
\t\treturn;
\t  }
\t  
\t  if(json['success'] != 1) {
\t\treturn;
\t  }
\t  
\t  \$('#date_modified').html(json.date_modified);
\t  \$('#total').html(json.total);
\t\t
\t  \$('#'+order_product_id+'-name').html(json['name']);
\t  \$('#'+order_product_id+'-price_formated').html(json['price_formated']);
\t  \$('#'+order_product_id+'-price').val(json['price']);
\t  \$('#'+order_product_id+'-quantity').html(json['quantity']);
\t  \$('#'+order_product_id+'-weight').html(json['weight']);
\t  
\t  addAlert('";
        // line 1205
        echo ($context["text_success"] ?? null);
        echo "', '";
        echo ($context["text_success_order_info"] ?? null);
        echo "', 'success', 4000);
\t});
  } else {
\t\$.ajax({
\t  url: '";
        // line 1209
        echo ($context["server"] ?? null);
        echo "index.php?route=sale/order.addOrderProduct&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&order_id=";
        echo ($context["order_id"] ?? null);
        echo "',
\t  method: 'POST',
\t  data: {name: order_product_name, price: order_product_price, quantity: order_product_quantity, weight: order_product_weight},
\t  dataType: 'json',
\t}).done(function(json) {
\t  if(json.error !== undefined) {
\t\taddAlert('";
        // line 1215
        echo ($context["text_error"] ?? null);
        echo "', json.error, 'danger');
\t\treturn;
\t  }
\t  
\t  if(json['success'] != 1) {
\t\treturn;
\t  }
\t  
\t  \$('#date_modified').html(json.date_modified);
\t  \$('#total').html(json.total);
\t  
\t  let html = '';
\t  
\t  html += '<tr id=\"'+json['order_product_id']+'\" class=\"order_product\">';
\t\thtml += '<td class=\"text-center\"><input type=\"hidden\" id=\"'+json['order_product_id']+'-price\" value=\"'+json['price']+'\" /><img src=\"'+json['image']+'\" alt=\"'+json['name']+'\" style=\"min-width: 50px;\" class=\"img-thumbnail\" /></th>';
\t\thtml += '<td class=\"text-center\"></td>';
\t\thtml += '<td id=\"'+json['order_product_id']+'-name\">'+json['name']+'</td>';
\t\thtml += '<td id=\"'+json['order_product_id']+'-quantity\" class=\"text-center\">'+json['quantity']+'</td>';
\t\thtml += '<td id=\"'+json['order_product_id']+'-price_formated\" class=\"text-center\">'+json['price_formated']+'</td>';
\t\thtml += '<td id=\"'+json['order_product_id']+'-weight\" class=\"text-center\">'+json['weight']+'</td>';
\t\thtml += '<td class=\"text-center\">';
\t\t  html += '<div class=\"dropdown\">';
\t\t\thtml += '<button class=\"btn btn-primary dropdown-button\" type=\"button\" id=\"'+json['order_product_id']+'dropdownMenuButton\" data-mdb-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fas fa-bars\"></i></button>';
\t\t\thtml += '<ul class=\"dropdown-menu\" aria-labelledby=\"'+json['order_product_id']+'dropdownMenuButton\">';
\t\t\t  html += '<li><button class=\"dropdown-item btn-edit_order_product-manual\" data-order_product_id=\"'+json['order_product_id']+'\" data-mdb-toggle=\"modal\" data-mdb-target=\"#manualProductModal\"><i class=\"fas fa-pencil-alt me-2\"></i>";
        // line 1239
        echo ($context["button_edit"] ?? null);
        echo "</button></li>';
\t\t\t  html += '<li><button class=\"dropdown-item text-danger btn-delete_order_product\" data-order_product_id=\"'+json['order_product_id']+'\"><i class=\"fas fa-trash me-2\"></i>";
        // line 1240
        echo ($context["button_delete"] ?? null);
        echo "</button></li>';
\t\t\thtml += '</ul>';
\t\t  html += '</div>';
\t\thtml += '</td>';
\t  html += '</tr>';
\t  
\t  \$('#order-products').append(html);
\t  
\t  orderProductsInit();
\t  
\t  addAlert('";
        // line 1250
        echo ($context["text_success"] ?? null);
        echo "', '";
        echo ($context["text_success_order_info"] ?? null);
        echo "', 'success', 4000);
\t});
  }
  
  \$('#no-products').addClass('d-none');
});

function orderProductsInit() {
  \$('.btn-delete_order_product').click(function(e) {
\tlet order_product_id = e.currentTarget.getAttribute('data-order_product_id');
\tlet order_id = \$('#order_id').val();
\t  
\t\$.ajax({
\t  url: '";
        // line 1263
        echo ($context["server"] ?? null);
        echo "index.php?route=sale/order.deleteOrderProduct&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&order_id=";
        echo ($context["order_id"] ?? null);
        echo "&order_product_id=' + encodeURIComponent(order_product_id),
\t}).done(function(json) {
\t  \$('#'+order_product_id).remove();
\t  
\t  if (\$('.order_product').length == 0) {
\t\t\$('#no-products').removeClass('d-none');
\t  }
\t  
\t  addAlert('";
        // line 1271
        echo ($context["text_success"] ?? null);
        echo "', '";
        echo ($context["text_success_order_info"] ?? null);
        echo "', 'success', 4000);
\t});
  });

  \$('.btn-edit_order_product-manual').click(function(e) {
\tlet order_product_id = e.currentTarget.getAttribute('data-order_product_id');

\tlet order_product_name = \$('#'+order_product_id+'-name').html();
\tlet order_product_price = \$('#'+order_product_id+'-price').val();
\tlet order_product_quantity = \$('#'+order_product_id+'-quantity').html();
\tlet order_product_weight = \$('#'+order_product_id+'-weight').html();

\t\$('#input-order_product_id').val(order_product_id);
\t\$('#input-order_product_name').val(order_product_name);
\t\$('#input-order_product_price').val(order_product_price);
\t\$('#input-order_product_quantity').val(order_product_quantity);
\t\$('#input-order_product_weight').val(order_product_weight);
  });

  const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-button'));
  const dropdownList = dropdownElementList.map((dropdownToggleEl) => {
\treturn new mdb.Dropdown(dropdownToggleEl);
  });
}
</script>
";
        // line 1296
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "view/template/sale/order_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  2078 => 1296,  2048 => 1271,  2033 => 1263,  2015 => 1250,  2002 => 1240,  1998 => 1239,  1971 => 1215,  1958 => 1209,  1949 => 1205,  1929 => 1188,  1916 => 1182,  1880 => 1151,  1867 => 1141,  1863 => 1140,  1836 => 1116,  1823 => 1110,  1783 => 1075,  1746 => 1043,  1710 => 1014,  1699 => 1008,  1652 => 964,  1639 => 958,  1559 => 883,  1546 => 873,  1533 => 867,  1507 => 846,  1414 => 758,  1358 => 705,  1345 => 699,  1310 => 669,  1209 => 573,  1148 => 515,  1135 => 509,  1027 => 403,  1024 => 402,  1018 => 400,  1015 => 399,  1004 => 397,  999 => 396,  996 => 395,  986 => 393,  984 => 392,  980 => 391,  967 => 383,  961 => 380,  957 => 379,  953 => 378,  947 => 374,  932 => 372,  928 => 371,  922 => 368,  918 => 367,  912 => 363,  897 => 361,  893 => 360,  886 => 356,  882 => 355,  876 => 352,  872 => 351,  868 => 350,  862 => 347,  858 => 346,  854 => 345,  848 => 342,  844 => 341,  840 => 340,  834 => 337,  830 => 336,  826 => 335,  820 => 332,  816 => 331,  812 => 330,  806 => 327,  802 => 326,  798 => 325,  789 => 319,  774 => 309,  768 => 305,  753 => 303,  749 => 302,  743 => 299,  739 => 298,  733 => 294,  718 => 292,  714 => 291,  707 => 287,  703 => 286,  697 => 283,  693 => 282,  689 => 281,  683 => 278,  679 => 277,  675 => 276,  669 => 273,  665 => 272,  661 => 271,  655 => 268,  651 => 267,  647 => 266,  641 => 263,  637 => 262,  633 => 261,  627 => 258,  623 => 257,  619 => 256,  610 => 250,  594 => 237,  590 => 236,  584 => 233,  580 => 232,  564 => 229,  560 => 228,  552 => 222,  537 => 220,  533 => 219,  529 => 218,  522 => 214,  512 => 209,  506 => 206,  502 => 205,  498 => 204,  491 => 200,  487 => 199,  483 => 198,  477 => 195,  473 => 194,  469 => 193,  463 => 190,  459 => 189,  455 => 188,  448 => 184,  444 => 183,  440 => 182,  434 => 179,  430 => 178,  426 => 177,  419 => 173,  415 => 172,  405 => 165,  392 => 155,  388 => 154,  380 => 149,  374 => 146,  369 => 144,  365 => 142,  359 => 140,  357 => 139,  354 => 138,  348 => 136,  346 => 135,  342 => 134,  336 => 131,  327 => 125,  314 => 115,  310 => 114,  302 => 109,  296 => 106,  291 => 104,  287 => 102,  281 => 100,  279 => 99,  276 => 98,  270 => 96,  268 => 95,  264 => 94,  256 => 89,  247 => 83,  236 => 75,  225 => 67,  221 => 66,  215 => 63,  208 => 58,  202 => 55,  199 => 54,  193 => 51,  190 => 50,  176 => 44,  170 => 43,  166 => 42,  162 => 41,  154 => 38,  148 => 37,  142 => 36,  136 => 35,  130 => 34,  123 => 32,  117 => 31,  111 => 29,  106 => 28,  104 => 27,  97 => 23,  93 => 22,  89 => 21,  85 => 20,  81 => 19,  77 => 18,  67 => 11,  60 => 9,  55 => 8,  52 => 7,  46 => 5,  44 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/sale/order_form.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/sale/order_form.twig");
    }
}
