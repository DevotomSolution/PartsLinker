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

/* view/template/catalog/market_product_form.twig */
class __TwigTemplate_d4c5de5dde48fd12064275ff504b65d42d3d85e1a5bb50d99ce80613a809254e extends Template
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
            echo "  <div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
    <button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button>
  </div>
  ";
        }
        // line 9
        echo "\t<form action=\"";
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-product\" class=\"form-horizontal\">
\t\t<div class=\"row\">
\t\t\t<ul class=\"nav nav-tabs flex-nowrap mb-3 ms-3\" id=\"tabs\" role=\"tablist\">
\t\t\t  <li class=\"nav-item\" role=\"presentation\">
\t\t\t\t<a
\t\t\t\t  class=\"nav-link ";
        // line 14
        if ((($context["edit"] ?? null) != 1)) {
            echo "active";
        }
        echo "\"
\t\t\t\t  id=\"tabs-tab-preview\"
\t\t\t\t  data-mdb-toggle=\"tab\"
\t\t\t\t  href=\"#tabs-tabs-preview\"
\t\t\t\t  role=\"tab\"
\t\t\t\t  aria-controls=\"tabs-tabs-preview\"
\t\t\t\t  aria-selected=\"";
        // line 20
        if ((($context["edit"] ?? null) != 1)) {
            echo "true";
        } else {
            echo "false";
        }
        echo "\"
\t\t\t\t  >";
        // line 21
        echo ($context["tab_preview"] ?? null);
        echo "</a
\t\t\t\t>
\t\t\t  </li>
\t\t\t  <li class=\"nav-item\" role=\"presentation\">
\t\t\t\t<a
\t\t\t\t  class=\"nav-link ";
        // line 26
        if (($context["edit"] ?? null)) {
            echo "active";
        }
        echo "\"
\t\t\t\t  id=\"tabs-tab-edit\"
\t\t\t\t  data-mdb-toggle=\"tab\"
\t\t\t\t  href=\"#tabs-tabs-edit\"
\t\t\t\t  role=\"tab\"
\t\t\t\t  aria-controls=\"tabs-tabs-edit\"
\t\t\t\t  aria-selected=\"";
        // line 32
        if (($context["edit"] ?? null)) {
            echo "true";
        } else {
            echo "false";
        }
        echo "\"
\t\t\t\t  >";
        // line 33
        echo ($context["tab_edit"] ?? null);
        echo "</a
\t\t\t\t>
\t\t\t  </li>
\t\t\t  <li class=\"nav-item\" role=\"presentation\">
\t\t\t\t<a
\t\t\t\t  class=\"nav-link\"
\t\t\t\t  id=\"tabs-tab-onlineshops\"
\t\t\t\t  data-mdb-toggle=\"tab\"
\t\t\t\t  href=\"#tabs-tabs-onlineshops\"
\t\t\t\t  role=\"tab\"
\t\t\t\t  aria-controls=\"tabs-tabs-onlineshops\"
\t\t\t\t  aria-selected=\"false\"
\t\t\t\t  >";
        // line 45
        echo ($context["tab_onlineshops"] ?? null);
        echo "</a
\t\t\t\t>
\t\t\t  </li>
\t\t\t</ul>
\t\t\t<div class=\"tab-content\" id=\"tabs-content\">
\t\t\t  <div class=\"tab-pane fade ";
        // line 50
        if ((($context["edit"] ?? null) != 1)) {
            echo "show active";
        }
        echo "\" id=\"tabs-tabs-preview\" role=\"tabpanel\" aria-labelledby=\"tabs-tab-preview\">
\t\t\t\t<div class=\"dropzone border d-flex flex-column justify-content-center rounded\" ondrop=\"fileDrop(event);\" ondragover=\"return false\">
\t\t\t\t\t<div class=\"dropmsg bg-dark bg-opacity-50 text-white\"></div>
\t\t\t\t\t<div id=\"dropzone-images\" class=\"w-100 dropzone-body\">
\t\t\t\t\t  ";
        // line 54
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["product_image"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
            // line 55
            echo "\t\t\t\t\t\t<div class=\"m-2 dropzone-image\" href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["image"], "path", [], "any", false, false, false, 55);
            echo "\" style=\"background-image: url(";
            echo twig_get_attribute($this->env, $this->source, $context["image"], "path", [], "any", false, false, false, 55);
            echo ")\"><i class=\"fas fa-fast-backward p-1\"></i><i class=\"fa fa-minus-circle p-1\"></i><input type=\"hidden\" name=\"product_image[";
            echo twig_get_attribute($this->env, $this->source, $context["image"], "image", [], "any", false, false, false, 55);
            echo "]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["image"], "image", [], "any", false, false, false, 55);
            echo "\" /></div>
\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 57
        echo "\t\t\t\t\t\t<div class=\"m-2 add-dropzone-image\" onclick=\"fileExplorer();\" style=\"background-image: url(";
        echo ($context["server"] ?? null);
        echo "view/img/photo-plus.png)\"></div>
\t\t\t\t\t</div>
\t\t\t\t\t<input type=\"file\" multiple accept=\"image/png,image/jpeg,image/jpg\" id=\"selectfile\">
\t\t\t\t</div>
\t\t\t\t<ul class=\"nav nav-pills mb-3 mt-3\" id=\"description\" role=\"tablist\">
\t\t\t\t  ";
        // line 62
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 63
            echo "\t\t\t\t  <li class=\"nav-item\" role=\"presentation\">
\t\t\t\t\t<a
\t\t\t\t\t  class=\"nav-link me-0 ";
            // line 65
            if ((twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 65) == ($context["user_language"] ?? null))) {
                echo "active";
            }
            echo "\"
\t\t\t\t\t  id=\"description-tab-";
            // line 66
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 66);
            echo "\"
\t\t\t\t\t  data-mdb-toggle=\"pill\"
\t\t\t\t\t  href=\"#description-pills-";
            // line 68
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 68);
            echo "\"
\t\t\t\t\t  role=\"tab\"
\t\t\t\t\t  aria-controls=\"description-pills-";
            // line 70
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 70);
            echo "\"
\t\t\t\t\t  aria-selected=\"true\"
\t\t\t\t\t  ><img src=\"";
            // line 72
            echo ($context["server"] ?? null);
            echo "language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 72);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 72);
            echo ".png\" alt=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 72);
            echo "\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 72);
            echo "\" /></a
\t\t\t\t\t>
\t\t\t\t  </li>
\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        echo "\t\t\t\t</ul>
\t\t\t\t<div class=\"tab-content\" id=\"description-content\">
\t\t\t\t  ";
        // line 78
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 79
            echo "\t\t\t\t  <div class=\"tab-pane fade ";
            if ((twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 79) == ($context["user_language"] ?? null))) {
                echo "show active";
            }
            echo "\" id=\"description-pills-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 79);
            echo "\" role=\"tabpanel\" aria-labelledby=\"description-tab-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 79);
            echo "\">
\t\t\t\t\t<div class=\"form-outline\">
\t\t\t\t\t  <input type=\"text\" id=\"input-product_description-name-";
            // line 81
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 81);
            echo "\" name=\"product_description[";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 81);
            echo "][name]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_0 = ($context["product_description"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 81)] ?? null) : null), "name", [], "any", false, false, false, 81);
            echo "\" class=\"form-control\"/>
\t\t\t\t\t  <label class=\"form-label\" for=\"input-product_description-name-";
            // line 82
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 82);
            echo "\">";
            echo ($context["entry_name"] ?? null);
            echo "</label>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"mt-3\">
\t\t\t\t\t  <textarea id=\"input-product_description-description-";
            // line 85
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 85);
            echo "\" name=\"product_description[";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 85);
            echo "][description]\">";
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_1 = ($context["product_description"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 85)] ?? null) : null), "description", [], "any", false, false, false, 85);
            echo "</textarea>
\t\t\t\t\t</div>
\t\t\t\t  </div>
\t\t\t\t  <input type=\"hidden\" id=\"input-product_description-note-";
            // line 88
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 88);
            echo "\" name=\"product_description[";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 88);
            echo "][note]\" value='";
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_2 = ($context["product_description"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 88)] ?? null) : null), "note", [], "any", false, false, false, 88);
            echo "'/>
\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 90
        echo "\t\t\t\t</div>
\t\t\t\t<div class=\"row\">
\t\t\t\t  <div class=\"col-sm-4 col-12 mt-3\">
\t\t\t\t\t<div class=\"form-outline\">
\t\t\t\t\t  <input type=\"number\" id=\"input-price\" name=\"price\" max=\"9999999\" min=\"0\" step=\"0.01\" value=\"";
        // line 94
        echo ($context["price"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t\t\t  <label class=\"form-label\" for=\"input-price\">";
        // line 95
        echo ($context["entry_price"] ?? null);
        echo "</label>
\t\t\t\t\t</div>
\t\t\t\t  </div>
\t\t\t\t  <div class=\"col-sm-4 col-12 mt-3\">
\t\t\t\t\t<select class=\"select\" id=\"select-used\" name=\"used\">
\t\t\t\t\t\t<option value=\"1\" ";
        // line 100
        if ((($context["used"] ?? null) == "1")) {
            echo "selected";
        }
        echo ">";
        echo ($context["text_used"] ?? null);
        echo "</option>
\t\t\t\t\t\t<option value=\"0\" ";
        // line 101
        if ((($context["used"] ?? null) == "0")) {
            echo "selected";
        }
        echo ">";
        echo ($context["text_new"] ?? null);
        echo "</option>
\t\t\t\t\t</select>
\t\t\t\t\t<label class=\"form-label select-label\">";
        // line 103
        echo ($context["select_quality"] ?? null);
        echo "</label>
\t\t\t\t  </div>
\t\t\t\t  <div class=\"col-sm-4 col-12 mt-3\">
\t\t\t\t\t<div class=\"form-outline\">
\t\t\t\t\t  <input type=\"number\" id=\"input-quantity\" name=\"quantity\" value=\"";
        // line 107
        echo ($context["quantity"] ?? null);
        echo "\" max=\"9999\" class=\"form-control\" />
\t\t\t\t\t  <label class=\"form-label\" for=\"input-quantity\">";
        // line 108
        echo ($context["entry_quantity"] ?? null);
        echo "</label>
\t\t\t\t\t</div>
\t\t\t\t  </div>
\t\t\t\t</div>
\t\t\t\t<div class=\"text-start mb-3 mt-2 pb-1\">
\t\t\t\t  <button type=\"submit\" form=\"form-product\" class=\"btn btn-primary mt-1\" style=\"min-width: 150px;\"><i class=\"fa fa-save me-2\"></i>";
        // line 113
        echo ($context["button_save"] ?? null);
        echo "</button>
\t\t\t\t  <a href=\"";
        // line 114
        echo ($context["cancel"] ?? null);
        echo "\" class=\"btn btn-default mt-1\"><i class=\"fa fa-reply me-2\"></i>";
        echo ($context["button_cancel"] ?? null);
        echo "</a>
\t\t\t\t</div>
\t\t\t  </div>
\t\t\t  <div class=\"tab-pane fade ";
        // line 117
        if (($context["edit"] ?? null)) {
            echo "show active";
        }
        echo "\" id=\"tabs-tabs-edit\" role=\"tabpanel\" aria-labelledby=\"tabs-tab-edit\">
\t\t\t    <div class=\"input-group input-group-lg mb-3 justify-content-end\">
\t\t\t\t  <span class=\"input-group-text text-warning fs-4 border-0\" style=\"color:#386bc0!important;\">";
        // line 119
        echo ($context["text_sku"] ?? null);
        echo "</span>
\t\t\t\t  <input type=\"text\" class=\"form-control fs-4 text-warning\" id=\"input-sku\" maxlength=\"10\" name=\"sku\" style=\"max-width: 175px;color:#386bc0!important\" placeholder=\"";
        // line 120
        echo ($context["placeholder_sku"] ?? null);
        echo "\" value=\"";
        echo ($context["sku"] ?? null);
        echo "\" ";
        if ((($context["new_product"] ?? null) == 0)) {
            echo "readonly";
        }
        echo "/>
\t\t\t\t</div>
\t\t\t\t<div class=\"dropzone border d-flex flex-column justify-content-center rounded\" ondrop=\"fileDrop(event);\" ondragover=\"return false\">
\t\t\t\t\t<div class=\"dropmsg bg-dark bg-opacity-50 text-white\"></div>
\t\t\t\t\t<div id=\"dropzone-images-edit\" class=\"w-100 dropzone-body\">
\t\t\t\t\t  ";
        // line 125
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["product_image"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
            // line 126
            echo "\t\t\t\t\t\t<div class=\"m-2 dropzone-image\" href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["image"], "path", [], "any", false, false, false, 126);
            echo "\" style=\"background-image: url(";
            echo twig_get_attribute($this->env, $this->source, $context["image"], "path", [], "any", false, false, false, 126);
            echo ")\"><i class=\"fas fa-fast-backward p-1\"></i><i class=\"fa fa-minus-circle p-1\"></i><input type=\"hidden\" name=\"product_image[";
            echo twig_get_attribute($this->env, $this->source, $context["image"], "image", [], "any", false, false, false, 126);
            echo "]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["image"], "image", [], "any", false, false, false, 126);
            echo "\" /></div>
\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 128
        echo "\t\t\t\t\t\t<div class=\"m-2 add-dropzone-image\" onclick=\"fileExplorer();\" style=\"background-image: url(";
        echo ($context["server"] ?? null);
        echo "view/img/photo-plus.png)\"></div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"row align-items-end\">
\t\t\t\t  <div class=\"col-12 col-md-8 mt-3\">
\t\t\t\t\t<ul class=\"nav nav-pills\" id=\"name_product\" role=\"tablist\">
\t\t\t\t\t  ";
        // line 134
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 135
            echo "\t\t\t\t\t  <li class=\"nav-item\" role=\"presentation\">
\t\t\t\t\t\t<a
\t\t\t\t\t\t  class=\"nav-link me-0 ";
            // line 137
            if ((twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 137) == ($context["user_language"] ?? null))) {
                echo "active";
            }
            echo "\"
\t\t\t\t\t\t  id=\"name_product-tab-";
            // line 138
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 138);
            echo "\"
\t\t\t\t\t\t  data-mdb-toggle=\"pill\"
\t\t\t\t\t\t  href=\"#name_product-pills-";
            // line 140
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 140);
            echo "\"
\t\t\t\t\t\t  role=\"tab\"
\t\t\t\t\t\t  aria-controls=\"name_product-pills-";
            // line 142
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 142);
            echo "\"
\t\t\t\t\t\t  aria-selected=\"true\"
\t\t\t\t\t\t  ><img src=\"";
            // line 144
            echo ($context["server"] ?? null);
            echo "language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 144);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 144);
            echo ".png\" alt=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 144);
            echo "\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 144);
            echo "\" /></a
\t\t\t\t\t\t>
\t\t\t\t\t  </li>
\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 148
        echo "\t\t\t\t\t</ul>
\t\t\t\t\t<div class=\"tab-content\" id=\"name_product-content\">
\t\t\t\t\t  ";
        // line 150
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 151
            echo "\t\t\t\t\t  <div class=\"tab-pane fade ";
            if ((twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 151) == ($context["user_language"] ?? null))) {
                echo "show active";
            }
            echo "\" id=\"name_product-pills-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 151);
            echo "\" role=\"tabpanel\" aria-labelledby=\"name_product-tab-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 151);
            echo "\">
\t\t\t\t\t    <div class=\"d-flex\">
\t\t\t\t\t\t  <div id=\"name_product-";
            // line 153
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 153);
            echo "\" class=\"form-outline\">
\t\t\t\t\t\t\t<input type=\"text\" id=\"input-name_product-";
            // line 154
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 154);
            echo "\" name=\"product_description[";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 154);
            echo "][name_product]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_3 = ($context["product_description"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 154)] ?? null) : null), "name_product", [], "any", false, false, false, 154);
            echo "\" class=\"form-control\" />
\t\t\t\t\t\t\t<label class=\"form-label\">";
            // line 155
            echo ($context["entry_name"] ?? null);
            echo "</label>
\t\t\t\t\t\t  </div>
\t\t\t\t\t\t  ";
            // line 157
            if ((twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 157) == ($context["user_language"] ?? null))) {
                // line 158
                echo "\t\t\t\t\t\t  <div id=\"name_product-translate\" class=\"ms-2 d-none\"><button type=\"button\" data-mdb-toggle=\"tooltip\" title=\"";
                echo ($context["button_translate"] ?? null);
                echo "\" id=\"btn-translate-name_product\" class=\"btn btn-primary\"><i class=\"fa fa-globe\"></i></button></div>
\t\t\t\t\t\t  ";
            }
            // line 160
            echo "\t\t\t\t\t\t</div>
\t\t\t\t\t  </div>
\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 163
        echo "\t\t\t\t\t  <input type=\"hidden\" id=\"input-category_id\" name=\"product_category\" value=\"";
        echo ($context["category_id"] ?? null);
        echo "\"/>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"d-md-none\"><small id=\"msg-category-sm\" class=\"text-primary\">";
        // line 165
        if (($context["category_id"] ?? null)) {
            echo ($context["text_category_detected"] ?? null);
            echo ": ";
            echo ($context["category_path"] ?? null);
        } else {
            echo ($context["text_category_not_detected"] ?? null);
        }
        echo "</small></div>
\t\t\t\t  </div>
\t\t\t\t  <div class=\"col-12 col-md-4 mt-2 mt-mb-3\">
\t\t\t\t\t<select class=\"select\" id=\"select-vehicle_position_id\" name=\"vehicle_position_id\" class=\"form-control\">
\t\t\t\t\t  <option value=\"\"></option>
\t\t\t\t\t  ";
        // line 170
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["vehicle_positions"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["position"]) {
            // line 171
            echo "\t\t\t\t\t\t<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["position"], "vehicle_position_id", [], "any", false, false, false, 171);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["position"], "vehicle_position_id", [], "any", false, false, false, 171) == ($context["vehicle_position_id"] ?? null))) {
                echo " selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["position"], "text", [], "any", false, false, false, 171);
            echo "</option>
\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['position'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 173
        echo "\t\t\t\t\t</select>
\t\t\t\t\t<label class=\"form-label select-label\">";
        // line 174
        echo ($context["select_vehicle_position"] ?? null);
        echo "</label>
\t\t\t\t  </div>
\t\t\t\t</div>
\t\t\t\t<div class=\"d-none d-md-block\"><small id=\"msg-category-md\" class=\"text-primary\">";
        // line 177
        if (($context["category_id"] ?? null)) {
            echo ($context["text_category_detected"] ?? null);
            echo ": ";
            echo ($context["category_path"] ?? null);
        } else {
            echo ($context["text_category_not_detected"] ?? null);
        }
        echo "</small></div>
\t\t\t\t<div id=\"product-vehicle4parts\">
\t\t\t\t  ";
        // line 179
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["product_vehicle4parts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["vehicle4parts"]) {
            // line 180
            echo "\t\t\t\t  <input id=\"vehicle4parts";
            echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "sku", [], "any", false, false, false, 180);
            echo "\" type=\"hidden\" name=\"product_vehicle4parts[]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts"], "sku", [], "any", false, false, false, 180);
            echo "\"/>
\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['vehicle4parts'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 182
        echo "\t\t\t\t</div>
\t\t\t\t<div class=\"row\">
\t\t\t\t  <div class=\"col-12 col-md-8 mt-3 mt-md-2\">
\t\t\t\t\t<div id=\"vehicle\" class=\"form-outline\">
\t\t\t\t\t  <input type=\"text\" id=\"input-vehicle\" data-vehicle-id=\"0\" data-vehicle-name=\"\" name=\"vehicle\" value=\"\" class=\"form-control\" />
\t\t\t\t\t  <label class=\"form-label\" id=\"label-input-vehicle\" for=\"input-vehicle\">";
        // line 187
        echo ($context["entry_vehicle"] ?? null);
        echo "</label>
\t\t\t\t\t</div>
\t\t\t\t  </div>
\t\t\t\t  <div class=\"col-12 col-md-4 mt-3 mt-md-2\">
\t\t\t\t\t<select data-mdb-filter=\"true\" id=\"select-vehicle_engine\" name=\"vehicle_engine\" class=\"form-control\">
\t\t\t\t\t  <option value=\"\">";
        // line 192
        echo ($context["option_all_engines"] ?? null);
        echo "</option>
\t\t\t\t\t  ";
        // line 193
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["vehicle_engines"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["engine"]) {
            // line 194
            echo "\t\t\t\t\t\t<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["engine"], "id", [], "any", false, false, false, 194);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["engine"], "name", [], "any", false, false, false, 194);
            echo "</option>
\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['engine'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 196
        echo "\t\t\t\t\t</select>
\t\t\t\t\t<label class=\"form-label select-label\">";
        // line 197
        echo ($context["select_vehicle_engine"] ?? null);
        echo "</label>
\t\t\t\t  </div>
\t\t\t\t  <div id=\"product-vehicle\" class=\"d-flex flex-wrap\">
\t\t\t\t\t";
        // line 200
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["product_vehicle"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["vehicle"]) {
            // line 201
            echo "\t\t\t\t\t<div id=\"product-vehicle";
            echo twig_get_attribute($this->env, $this->source, $context["vehicle"], "vehicle_id", [], "any", false, false, false, 201);
            echo "\" class=\"chip text-nowrap mt-3\"><span>";
            echo twig_get_attribute($this->env, $this->source, $context["vehicle"], "title", [], "any", false, false, false, 201);
            if (twig_get_attribute($this->env, $this->source, $context["vehicle"], "engine", [], "any", false, false, false, 201)) {
                echo " ";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["vehicle"], "engine", [], "any", false, false, false, 201), "name", [], "any", false, false, false, 201);
            }
            echo "</span><i class=\"close fas fa-times\"></i><input type=\"hidden\" name=\"product_vehicle[]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["vehicle"], "vehicle_id", [], "any", false, false, false, 201);
            echo "\"/>";
            if (twig_get_attribute($this->env, $this->source, $context["vehicle"], "engine", [], "any", false, false, false, 201)) {
                echo "<input type=\"hidden\" name=\"product_vehicle_engine[";
                echo twig_get_attribute($this->env, $this->source, $context["vehicle"], "vehicle_id", [], "any", false, false, false, 201);
                echo "]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["vehicle"], "engine", [], "any", false, false, false, 201), "id", [], "any", false, false, false, 201);
                echo "\"/>";
            }
            echo "</div>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['vehicle'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 203
        echo "\t\t\t\t  </div>
\t\t\t\t</div>
\t\t\t\t<div class=\"form-outline mt-3\">
\t\t\t\t  <input type=\"text\" id=\"input-oe\" name=\"oe\" value=\"";
        // line 206
        echo ($context["oe"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t\t  <label class=\"form-label\" for=\"input-oe\">";
        // line 207
        echo ($context["entry_oe"] ?? null);
        echo "</label>
\t\t\t\t</div>
\t\t\t\t<div id=\"brand\" class=\"form-outline mt-3\">
\t\t\t\t  <input type=\"text\" id=\"input-brand\" name=\"brand\" value=\"";
        // line 210
        echo ($context["brand"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t\t  <label class=\"form-label\" for=\"input-brand\">";
        // line 211
        echo ($context["entry_manufacturer"] ?? null);
        echo "</label>
\t\t\t\t</div>
\t\t\t\t<div class=\"form-outline mt-3\">
\t\t\t\t  <input type=\"text\" id=\"input-mpn\" name=\"mpn\" value=\"";
        // line 214
        echo ($context["mpn"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t\t  <label class=\"form-label\" for=\"input-mpn\">";
        // line 215
        echo ($context["entry_mpn"] ?? null);
        echo "</label>
\t\t\t\t</div>
\t\t\t\t<div class=\"form-outline mt-3\">
\t\t\t\t  <input type=\"text\" id=\"input-ean\" name=\"ean\" value=\"";
        // line 218
        echo ($context["ean"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t\t  <label class=\"form-label\" for=\"input-ean\">";
        // line 219
        echo ($context["entry_ean"] ?? null);
        echo "</label>
\t\t\t\t</div>
\t\t\t\t<div class=\"form-outline mt-3\">
\t\t\t\t  <input type=\"text\" id=\"input-others\" name=\"others\" value=\"";
        // line 222
        echo ($context["others"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t\t  <label class=\"form-label\" for=\"input-others\">";
        // line 223
        echo ($context["entry_others"] ?? null);
        echo "</label>
\t\t\t\t</div>
\t\t\t\t<div class=\"form-outline mt-3\">
\t\t\t\t  <input type=\"number\" id=\"input-weight\" name=\"weight\" step=\"0.001\" value=\"";
        // line 226
        echo ($context["weight"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t\t  <label class=\"form-label\" for=\"input-weight\">";
        // line 227
        echo ($context["entry_weight"] ?? null);
        echo "</label>
\t\t\t\t</div>
\t\t\t\t<div class=\"mt-3\">
\t\t\t\t  <select class=\"select\" name=\"used-edit\">
\t\t\t\t\t<option value=\"1\" ";
        // line 231
        if ((($context["used"] ?? null) == "1")) {
            echo "selected";
        }
        echo ">";
        echo ($context["text_used"] ?? null);
        echo "</option>
\t\t\t\t\t<option value=\"0\" ";
        // line 232
        if ((($context["used"] ?? null) == "0")) {
            echo "selected";
        }
        echo ">";
        echo ($context["text_new"] ?? null);
        echo "</option>
\t\t\t\t  </select>
\t\t\t\t  <label class=\"form-label select-label\">";
        // line 234
        echo ($context["select_quality"] ?? null);
        echo "</label>
\t\t\t\t</div>
\t\t\t\t<div class=\"mt-3\">
\t\t\t\t  <select class=\"select\" name=\"warehouse_id\">
\t\t\t\t\t<option value=\"\"></option>
\t\t\t\t\t";
        // line 239
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["warehouses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["warehouse"]) {
            // line 240
            echo "\t\t\t\t\t<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["warehouse"], "warehouse_id", [], "any", false, false, false, 240);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["warehouse"], "warehouse_id", [], "any", false, false, false, 240) == ($context["warehouse_id"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["warehouse"], "name", [], "any", false, false, false, 240);
            echo "</option>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['warehouse'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 242
        echo "\t\t\t\t  </select>
\t\t\t\t  <label class=\"form-label select-label\">";
        // line 243
        echo ($context["select_warehouse"] ?? null);
        echo "</label>
\t\t\t\t</div>
\t\t\t\t<div class=\"form-outline mt-3\">
\t\t\t\t  <input type=\"text\" name=\"location\" value=\"";
        // line 246
        echo ($context["location"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t\t  <label class=\"form-label\">";
        // line 247
        echo ($context["entry_location"] ?? null);
        echo "</label>
\t\t\t\t</div>
\t\t\t\t<div class=\"mt-3 d-flex\">
\t\t\t\t\t<div class=\"form-outline flex-fill\">
\t\t\t\t\t  <input type=\"number\" id=\"input-quantity-edit\" name=\"quantity-edit\" value=\"";
        // line 251
        echo ($context["quantity"] ?? null);
        echo "\" max=\"9999\" class=\"form-control\" />
\t\t\t\t\t  <label class=\"form-label\" for=\"input-quantity-edit\">";
        // line 252
        echo ($context["entry_quantity"] ?? null);
        echo "</label>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"form-outline flex-fill ms-3\">
\t\t\t\t\t  <input type=\"number\" id=\"input-price-edit\" name=\"price-edit\" max=\"9999999\" min=\"0\" step=\"0.01\" value=\"";
        // line 255
        echo ($context["price"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t\t\t  <label class=\"form-label\" for=\"input-price-edit\">";
        // line 256
        echo ($context["entry_price"] ?? null);
        echo "</label>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div id=\"note\" class=\"mt-3\">
\t\t\t\t  <textarea id=\"input-note\" name=\"note\">";
        // line 260
        echo ($context["note"] ?? null);
        echo "</textarea>
\t\t\t\t  <div class=\"text-end\">
\t\t\t\t\t<button type=\"button\" id=\"btn-translate\" class=\"btn btn-primary d-none mt-2\"><i class=\"fa fa-globe me-2\"></i>";
        // line 262
        echo ($context["button_translate"] ?? null);
        echo "</button>
\t\t\t\t  </div>
\t\t\t\t</div>
\t\t\t\t<div class=\"text-start mt-2 pb-1 mb-3\">
\t\t\t\t  <button type=\"submit\" form=\"form-product\" class=\"btn btn-primary mt-1\" style=\"min-width: 150px;\"><i class=\"fa fa-save me-2\"></i>";
        // line 266
        echo ($context["button_save"] ?? null);
        echo "</button>
\t\t\t\t  <a href=\"";
        // line 267
        echo ($context["cancel"] ?? null);
        echo "\" class=\"btn btn-default mt-1\"><i class=\"fa fa-reply me-2\"></i>";
        echo ($context["button_cancel"] ?? null);
        echo "</a>
\t\t\t\t</div>
\t\t\t  </div>
\t\t\t  <div class=\"tab-pane fade\" id=\"tabs-tabs-onlineshops\" role=\"tabpanel\" aria-labelledby=\"tabs-tab-onlineshops\">
\t\t\t    <table class=\"table table-hover table-bordered\">
\t\t\t\t  <tbody>
\t\t\t\t\t";
        // line 273
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["onlineshops"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["onlineshop"]) {
            // line 274
            echo "\t\t\t\t\t<tr>
\t\t\t\t\t  <td>";
            // line 275
            echo twig_get_attribute($this->env, $this->source, $context["onlineshop"], "title", [], "any", false, false, false, 275);
            echo "</td>
\t\t\t\t\t  <td><input class=\"form-check-input\" type=\"checkbox\" name=\"";
            // line 276
            echo twig_get_attribute($this->env, $this->source, $context["onlineshop"], "code", [], "any", false, false, false, 276);
            echo "\" value=\"1\" ";
            if (twig_get_attribute($this->env, $this->source, $context["onlineshop"], "status", [], "any", false, false, false, 276)) {
                echo "checked";
            }
            echo " ";
            if (twig_get_attribute($this->env, $this->source, $context["onlineshop"], "always_on", [], "any", false, false, false, 276)) {
                echo "disabled";
            }
            echo "/></td>
\t\t\t\t\t</tr>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['onlineshop'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 279
        echo "\t\t\t\t  </tbody>
\t\t\t    </table>
\t\t\t\t<div class=\"text-start mt-3 mb-3\">
\t\t\t\t  <button type=\"submit\" form=\"form-product\" class=\"btn btn-primary\" style=\"min-width: 150px;\"><i class=\"fa fa-save me-2\"></i>";
        // line 282
        echo ($context["button_save"] ?? null);
        echo "</button>
\t\t\t\t  <a href=\"";
        // line 283
        echo ($context["cancel"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply me-2\"></i>";
        echo ($context["button_cancel"] ?? null);
        echo "</a>
\t\t\t\t</div>
\t\t\t  </div>
\t\t\t</div>
\t\t</div>
\t</form>
</div>
</main>
<script>
let vehiclePositionsTranslates = JSON.parse('";
        // line 292
        echo ($context["vehicle_positions_translates"] ?? null);
        echo "');

\$(document).ready(function() {
  const nameProductAutocomplete = document.querySelector('#name_product-";
        // line 295
        echo ($context["user_language"] ?? null);
        echo "');

  const nameProductFilter = async (query) => {
\tconst url = `";
        // line 298
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/product.autocompleteCategory&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&search=\${encodeURI(query)}`;
\tconst response = await fetch(url);
\tconst data = await response.json();
\treturn data.categories;
  };
  
  new mdb.Autocomplete(nameProductAutocomplete, {
\tfilter: nameProductFilter,
\tnoResults: '',
\tthreshold: 1,
\tdisplayValue: (value) => value.name
  });
  
  \$('#name_product-";
        // line 311
        echo ($context["user_language"] ?? null);
        echo "').on('close.mdb.autocomplete', async function() {
    const url = `";
        // line 312
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/product.getCategoryByText&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&text=\${encodeURI(\$('#input-name_product-";
        echo ($context["user_language"] ?? null);
        echo "').val())}`;
\tconst response = await fetch(url);
\tconst data = await response.json();
\t
\t\$('#name_product-translate').addClass('d-none');
\t
\tif (data.category !== undefined) {
      \$('#input-category_id').val(data.category.category_id);

\t  ";
        // line 321
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 322
            echo "\t    ";
            if ((twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 322) != ($context["user_language"] ?? null))) {
                // line 323
                echo "\t\t  \$('#input-name_product-";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 323);
                echo "').val(data.category.translates[";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 323);
                echo "]);
\t    ";
            }
            // line 325
            echo "\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 326
        echo "\t  
\t  \$('#msg-category-sm').html('";
        // line 327
        echo ($context["text_category_detected"] ?? null);
        echo ": ' + data.category.path);
\t  \$('#msg-category-md').html('";
        // line 328
        echo ($context["text_category_detected"] ?? null);
        echo ": ' + data.category.path);
\t  
\t  if (\$('#input-name_product-";
        // line 330
        echo ($context["user_language"] ?? null);
        echo "').val() !== data.category.name) {
\t    \$('#name_product-translate').removeClass('d-none');
\t  }
\t} else {
\t  \$('#input-category_id').val(0);
\t  
\t  \$('#msg-category-sm').html('";
        // line 336
        echo ($context["text_category_not_detected"] ?? null);
        echo "');
\t  \$('#msg-category-md').html('";
        // line 337
        echo ($context["text_category_not_detected"] ?? null);
        echo "');
\t  
\t  \$('#name_product-translate').removeClass('d-none');
\t}
\t
\tgenerateProductDescriptionName();
\tgenerateProductDescription;
  });
  
  const brandAutocomplete = document.querySelector('#brand');
  
  const brandFilter = async (query) => {
\tconst url = `";
        // line 349
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/product.autocompleteBrand&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&search=\${encodeURI(query)}`;
\tconst response = await fetch(url);
\tconst data = await response.json();
\treturn data.brands;
  };

  new mdb.Autocomplete(brandAutocomplete, {
\tfilter: brandFilter,
\tnoResults: '',
\tthreshold: 1,
\tdisplayValue: (value) => value.name
  });
  
  \$('#input-brand').focusout(function(e) {
\tgenerateProductDescriptionName();
\tgenerateProductDescription();
  });
  
  const vehicleAutocomplete = document.querySelector('#vehicle');
  
  const vehicleFilter = async (query) => {
\tconst url = `";
        // line 370
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/product.autocompleteVehicle&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&search=\${encodeURI(query)}`;
\tconst response = await fetch(url);
\tconst data = await response.json();
\treturn data.vehicles;
  };

  new mdb.Autocomplete(vehicleAutocomplete, {
\tfilter: vehicleFilter,
\tnoResults: '',
\tthreshold: 1,
\tdisplayValue: (value) => value.name
  });
  
  const engineSelect = new mdb.Select(document.getElementById('select-vehicle_engine'));
  
  \$('#select-vehicle_engine').on('close.mdb.select', function(e) {
\tlet vehicleId = \$('#input-vehicle').attr('data-vehicle-id');
\t
\tif (vehicleId == '0') {
\t  return;
\t}
\t
\tlet vehicleTitle = \$('#input-vehicle').attr('data-vehicle-name');

\tlet engineId = \$('select[name=\\'vehicle_engine\\']').val();
\tlet engineTitle = '';
  
\tif(engineId != '') {
\t  engineTitle = \$('select[name=\\'vehicle_engine\\'] option[value=\"' + engineId + '\"]').html();
\t}
  
\tlet warehouseId = \$('select[name=\\'warehouse_id\\']').val();
\t
\tif(engineId != '') {
\t  addVehicle(vehicleId, vehicleTitle, warehouseId, engineId, engineTitle).then(function() {
\t\tgenerateProductDescriptionName();
\t\tgenerateProductDescription();
\t  });
\t} else {
\t\taddVehicle(vehicleId, vehicleTitle, warehouseId).then(function() {
\t\t  generateProductDescriptionName();
\t\t  generateProductDescription();
\t\t});
\t}
\t
\t\$('#input-vehicle').val('');

    \$('#input-vehicle').attr('data-vehicle-id', 0);
    \$('#input-vehicle').attr('data-vehicle-name', '');
\t
\t\$('select[name=\\'vehicle_engine\\'] option[value!=\"\"]').remove();
\t\$('#label-input-vehicle').removeClass('active');
  });

  \$('#vehicle').on('itemSelect.mdb.autocomplete', function(e) {
    \$('#input-vehicle').attr('data-vehicle-id', e.value.id);
    \$('#input-vehicle').attr('data-vehicle-name', e.value.name);
\t
\t\$.ajax({
\t  url: '";
        // line 429
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/product.getEngines&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&model_id=' + encodeURIComponent(e.value.model_id),
\t  dataType: 'json',
\t  success: function(json) {
\t\t\$('select[name=\\'vehicle_engine\\'] option[value!=\"\"]').remove();

\t\t\$.each(json, function (i, item) {
\t\t  \$('select[name=\\'vehicle_engine\\']').append(\$('<option>', { 
\t\t\tvalue: item.id,
\t\t\ttext : item.name
\t\t  }));
\t\t});
\t\t
\t\tengineSelect.open();
\t  }
\t});
  });
  
  magnificPopupInit();
  dropRefresh();
  
  ";
        // line 449
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 450
            echo "  \$('#input-product_description-description-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 450);
            echo "').summernote({
\theight: 300,
\ttoolbar: false,
\tdisableDragAndDrop: true,
\ttabDisable: true,
\tplaceholder: '";
            // line 455
            echo ($context["entry_description"] ?? null);
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
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 467
        echo "  
  \$('#input-note').summernote({
\theight: 250,
\ttoolbar: false,
\tdisableDragAndDrop: true,
\ttabDisable: true,
\tplaceholder: '";
        // line 473
        echo ($context["entry_note"] ?? null);
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
  
  \$('#note').addVoiceTrigger(function(msg) {
\t\$('#input-note').summernote('insertText', msg);
  });
  
  if(\$('#input-product_description-description-";
        // line 489
        echo ($context["user_language"] ?? null);
        echo "').val() == '') {
\tgenerateProductDescriptionName();
\tgenerateProductDescription();
  }
});

\$('#input-sku').change(function(event) {
  if(event.target.value.length < 5 || event.target.value.length > 8) {
\tevent.target.classList.remove('text-warning');
\tevent.target.classList.add('text-danger');
\tevent.target.focus();
  } else {
\tevent.target.classList.remove('text-danger');
\tevent.target.classList.add('text-warning');
  }
  
  generateProductDescription();
});

";
        // line 508
        if ((($context["new_product"] ?? null) == 1)) {
            // line 509
            echo "\$('select[name=\\'warehouse_id\\']').change(function(e) {
  \$.ajax({
\turl: '";
            // line 511
            echo ($context["server"] ?? null);
            echo "index.php?route=catalog/product.getNewSku&user_token=";
            echo ($context["user_token"] ?? null);
            echo "&warehouse_id=' + encodeURIComponent(e.target.value),
\tdataType: 'json',
\tsuccess: function(json) {
\t  if (json['sku'] !== undefined) {
\t    \$('#input-sku').val(json['sku']);
\t  }
\t}
  });
});
";
        }
        // line 521
        echo "
\$('select[name=\\'used\\']').change(function(event) {
  \$('select[name=\\'used-edit\\']').val(event.target.value);
  generateProductDescription();
});

\$('select[name=\\'used-edit\\']').change(function(event) {
  \$('select[name=\\'used\\']').val(event.target.value);
  generateProductDescription();
});

\$('#input-quantity').change(function(event) {
  \$('#input-quantity-edit').val(event.target.value);
});

\$('#input-quantity-edit').change(function(event) {
  \$('#input-quantity').val(event.target.value);
});

\$('#input-price').change(function(event) {
\t\$('#input-price-edit').val(event.target.value);
});

\$('#input-price-edit').change(function(event) {
  \$('#input-price').val(event.target.value);
});

\$('#input-note').on('summernote.blur', function() {
  noteMain = \$('#input-note').summernote('code');
  
  ";
        // line 551
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 552
            echo "\t\$('#input-product_description-note-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 552);
            echo "').val(noteMain);
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 554
        echo "
  generateProductDescription();
  \$('#btn-translate').removeClass('d-none');
});

\$('#select-vehicle_position_id').change(function() {
  generateProductDescriptionName();
});

\$('#input-mpn').change(function() {
  generateProductDescriptionName();
  generateProductDescription();
});

\$('#input-ean').change(function(event) {
  generateProductDescription()
});

\$('#input-oe').change(function(event) {
  generateProductDescriptionName();
  generateProductDescription();
});

\$('#input-others').change(function(event) {
  generateProductDescription();
});

//
// FILE DROP
//

let files;
let countImages = \$('#dropzone-images .dropzone-image').length;

function fileDrop(e) {
  e.preventDefault();
  let files = e.dataTransfer.files;
  
  for(let i = 0; i < files.length; i++) {
\tif(files[i].type.match(/image.*/)) {
\t  countImages++;
\t  
\t  if(countImages <= 8) {
\t\tuploadImage(files[i]);
\t  }
\t}
  }
}

function fileExplorer() {
  document.getElementById('selectfile').click();
  document.getElementById('selectfile').onchange = function() {
\tfiles = document.getElementById('selectfile').files;
\t
\tfor(let i = 0; i < files.length; i++) {
\t  if(files[i].type.match(/image.*/)) {
\t\tcountImages++;
\t
\t\tif(countImages <= 8) {
\t\t  uploadImage(files[i]);
\t\t}
\t  }
\t}
  };
}

function dropRefresh() {
  if(countImages >= 8) {
\t\$('.add-dropzone-image').addClass('hide');
  } else {
\t\$('.add-dropzone-image').removeClass('hide');
  }
}

async function uploadImage(file) {
  if (file.type.match(/image.*/)) {
\t\$('.dropmsg').html('<div class=\"spinner-border\" role=\"status\"><span class=\"visually-hidden\">";
        // line 630
        echo ($context["text_loading"] ?? null);
        echo "</span></div>');
\t\$('.dropmsg').addClass('d-flex');
\t
\timgFile = await imageResize(file, '";
        // line 633
        echo ($context["MAX_IMAGE_WIDTH"] ?? null);
        echo "', '";
        echo ($context["MAX_IMAGE_HEIGHT"] ?? null);
        echo "');
\t
\tlet formData = new FormData();
\tformData.append('file', imgFile);

\t\$.ajax({
\t  type: 'POST',
\t  url: '";
        // line 640
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/product.uploadImage&user_token=";
        echo ($context["user_token"] ?? null);
        echo "',
\t  contentType: false,
\t  processData: false,
\t  data: formData,
\t  success:function(response) {
\t\tif(response.error !== undefined) {
\t\t  addAlert('";
        // line 646
        echo ($context["text_error"] ?? null);
        echo "', response.error, 'danger');
\t\t  return;
\t\t}

\t\t\$('#selectfile').val('');
\t\t
\t\t\$('.add-dropzone-image').before('<div class=\"m-2 dropzone-image\" href=\"' + response['path'] + '\" style=\"background-image: url(' + response['path'] + ')\"><i class=\"fas fa-fast-backward p-1\"></i><i class=\"fa fa-minus-circle p-1\"></i><input type=\"hidden\" name=\"product_image[' + response['image'] + ']\" value=\"' + response['image'] + '\" /></div>');
\t\t\$('#dropzone-images-edit').html(\$('#dropzone-images').html());
\t\tdropRefresh();
\t\tmagnificPopupInit();
\t  }
\t});
  }
}

\$('#dropzone-images').delegate('.fa-minus-circle', 'click', function() {
  \$.magnificPopup.close();
  \$(this).parent().remove();
  \$('#dropzone-images-edit').html(\$('#dropzone-images').html());
  countImages = \$('#dropzone-images .dropzone-image').length;
  dropRefresh();
  magnificPopupInit();
});

\$('#dropzone-images').delegate('.fa-fast-backward', 'click', function() {
  \$.magnificPopup.close();
  let element = \$(this).parent();
  \$(this).parent().remove();
  \$('#dropzone-images').prepend(element);
  \$('#dropzone-images-edit').html(\$('#dropzone-images').html());
  magnificPopupInit();
});

\$('#dropzone-images-edit').delegate('.fa-minus-circle', 'click', function() {
  \$.magnificPopup.close();
  \$(this).parent().remove();
  \$('#dropzone-images').html(\$('#dropzone-images-edit').html());
  countImages = \$('#dropzone-images .dropzone-image').length;
  dropRefresh();
  magnificPopupInit();
});

\$('#dropzone-images-edit').delegate('.fa-fast-backward', 'click', function() {
  \$.magnificPopup.close();
  let element = \$(this).parent();
  \$(this).parent().remove();
  \$('#dropzone-images-edit').prepend(element);
  \$('#dropzone-images').html(\$('#dropzone-images-edit').html());
  magnificPopupInit();
});

document.ondragenter = function() {
  \$('.dropmsg').html('";
        // line 698
        echo ($context["text_drop"] ?? null);
        echo "');
  \$('.dropmsg').addClass('d-flex');
}

document.onclick = function() {
  \$('.dropmsg').removeClass('d-flex');
}

\$( document ).ajaxStop(function() {
  \$('.dropmsg').removeClass('d-flex');
});

//
// TRANSLATE
//

async function translate(text, languageTo) {
  let translatedText;
  
  await \$.ajax({
\turl: '";
        // line 718
        echo ($context["server"] ?? null);
        echo "index.php?route=tool/translate&user_token=";
        echo ($context["user_token"] ?? null);
        echo "',
\tmethod: 'POST',
\tdata: {language_to: languageTo, text: text},
\tdataType: 'json',
  }).done(function(json) {
\tif(json['success']) {
\t  translatedText = json['text'];
\t} else {
\t  translatedText = '';
\t}
  });
  
  return translatedText;
}

\$('#btn-translate').click(async function() {
  loading();
  
  \$('#btn-translate').prop('disabled', true);

  let note = \$('#input-note').val();
  
  ";
        // line 740
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 741
            echo "  ";
            if ((twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 741) != ($context["user_language"] ?? null))) {
                // line 742
                echo "\tawait translate(note, '";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 742);
                echo "').then(async function(translatedText) {
\t  \$('#input-product_description-note-";
                // line 743
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 743);
                echo "').val(translatedText);
\t});
  ";
            } else {
                // line 746
                echo "    \$('#input-product_description-note-";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 746);
                echo "').val(note);
  ";
            }
            // line 748
            echo "  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 749
        echo "  
  generateProductDescription();

  loading(false);
});

\$('#btn-translate-name_product').click(async function(e) {
  loading();

  let name_product = \$('#input-name_product-";
        // line 758
        echo ($context["user_language"] ?? null);
        echo "').val();
  
  ";
        // line 760
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 761
            echo "  ";
            if ((twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 761) != ($context["user_language"] ?? null))) {
                // line 762
                echo "\tawait translate(name_product, '";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 762);
                echo "').then(async function(translatedText) {
\t  \$('#input-name_product-";
                // line 763
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 763);
                echo "').val(translatedText);
\t});
  ";
            }
            // line 766
            echo "  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 767
        echo "  
  generateProductDescriptionName();
  
  \$('#name_product-translate').addClass('d-none');

  loading(false);
});

//
// FUNCTIONS
//

function generateProductDescriptionName() {
  let nameVehicle = '';

  let vehicles = \$('#product-vehicle input[name=\\'product_vehicle[]\\']');
\t
  for(let i = 0; i < vehicles.length; i++) {
\tlet vehicleId = vehicles[i].value;
\t
\tif(i > 0) {
\t  nameVehicle += ', ';
\t}
\t
\tnameVehicle += \$('#product-vehicle'+vehicleId+' span').text();
  }
  
  let nameSuffix = '';
  
  if(nameVehicle) {
\tnameSuffix += nameVehicle + ' ';
  }
  
  let brand = \$('#input-brand').val();

  if(brand) {
\tnameSuffix += brand + ' ';
  }
  
  let mpn = \$('#input-mpn').val();

  if(mpn) {
\tnameSuffix += mpn + ' ';
  }
\t
  let oe = \$('#input-oe').val();

  if(oe) {
\tnameSuffix += 'OEM ' + oe;
  }
  
  let name;
  
  let vehiclePositionId = \$('#select-vehicle_position_id').val();
  
  ";
        // line 822
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 823
            echo "  name = \$('#input-name_product-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 823);
            echo "').val() + ' ';
  
  if(vehiclePositionId != '') {
\tname += vehiclePositionsTranslates[vehiclePositionId][";
            // line 826
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 826);
            echo "] + ' ';
  }
  
  name += nameSuffix;

  \$('#input-product_description-name-";
            // line 831
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 831);
            echo "').val(name.trim());
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 833
        echo "}

let vehicles4partsCache = {};

async function generateProductDescription() {
  let description;
  let note;
  let name;
  
  let sku = \$('#input-sku').val();
  let brand = \$('#input-brand').val();
  let mpn = \$('#input-mpn').val();
  let ean = \$('#input-ean').val();
  let oe = \$('#input-oe').val();
  let others = \$('#input-others').val();
  let used = \$('#select-used').val();
  
  let vehicles = \$('#product-vehicle input[name=\\'product_vehicle[]\\']');
  
  let vehicles4parts = \$('#product-vehicle4parts input[type=\\'hidden\\']');
  
  let vehicles4partsData = [];
  
  for(let i = 0; i < vehicles4parts.length; i++) {
\tlet vehicle4parts = vehicles4parts[i].value;

\tif(vehicles4partsCache[vehicle4parts]) {
\t  vehicles4partsData.push(vehicles4partsCache[vehicle4parts]);
\t  continue;
\t}

\tawait \$.ajax({
\t  url: '";
        // line 865
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/product.getVehicle4Parts&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&sku=' + encodeURIComponent(vehicle4parts),
\t  dataType: 'json'
\t}).done(function(json) {
\t  vehicles4partsData.push(json);
\t  vehicles4partsCache[vehicle4parts] = json;
\t});
  }
  
  ";
        // line 873
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 874
            echo "    description = '';
\t
\tnote = \$('#input-product_description-note-";
            // line 876
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 876);
            echo "').val();

\tif(note !== '<p><br></p>' && note !== '') {
\t  description += '<p>- ";
            // line 879
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_4 = ($context["translates"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 879)] ?? null) : null), "text_note", [], "any", false, false, false, 879);
            echo "</p>';
\t  description += note;
\t  //description += '<p><br></p>';
\t}

\tif(sku) {
\t  description += '<p>- ";
            // line 885
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_5 = ($context["translates"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 885)] ?? null) : null), "text_sku", [], "any", false, false, false, 885);
            echo "'+sku+'</p>';
\t}

\tif(brand) {
\t  description += '<p>- ";
            // line 889
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_6 = ($context["translates"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 889)] ?? null) : null), "text_brand", [], "any", false, false, false, 889);
            echo "'+brand+'</p>';
\t}

\tif(mpn) {
\t  description += '<p>- ";
            // line 893
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_7 = ($context["translates"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 893)] ?? null) : null), "text_mpn", [], "any", false, false, false, 893);
            echo "'+mpn+'</p>';
\t}

\tif(ean) {
\t  description += '<p>- ";
            // line 897
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_8 = ($context["translates"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 897)] ?? null) : null), "text_ean", [], "any", false, false, false, 897);
            echo "'+ean+'</p>';
\t}

\tif(oe) {
\t  description += '<p>- ";
            // line 901
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_9 = ($context["translates"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 901)] ?? null) : null), "text_oe", [], "any", false, false, false, 901);
            echo "'+oe+'</p>';
\t}

\tif(others) {
\t  description += '<p>- ";
            // line 905
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_10 = ($context["translates"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 905)] ?? null) : null), "text_others", [], "any", false, false, false, 905);
            echo "'+others+'</p>';
\t}

\tif(vehicles.length) {
\t  description += '<p>- ";
            // line 909
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_11 = ($context["translates"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 909)] ?? null) : null), "text_vehicles", [], "any", false, false, false, 909);
            echo "</p>';
\t  description += '<ul>';
\t}

\tfor(let i = 0; i < vehicles.length; i++) {
\t  let vehicleId = vehicles[i].value;
\t  description += '<li>'+\$('#product-vehicle'+vehicleId).text()+'</li>';
\t}

\tif(vehicles.length) {
\t  description += '</ul>';
\t}

\tif(vehicles4parts.length) {
\t  description += '<p>- ";
            // line 923
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_12 = ($context["translates"] ?? null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 923)] ?? null) : null), "text_vehicles4parts", [], "any", false, false, false, 923);
            echo "</p>';
\t}

\tfor(let i = 0; i < vehicles4partsData.length; i++) {
\t\tdescription += '<ul>';

\t\tdescription += '<li>";
            // line 929
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_13 = ($context["translates"] ?? null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 929)] ?? null) : null), "text_vehicle4parts_sku", [], "any", false, false, false, 929);
            echo "'+vehicles4partsData[i]['sku']+'</li>';

\t\tif(vehicles4partsData[i]['win']) {
\t\t  description += '<li>";
            // line 932
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_14 = ($context["translates"] ?? null)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 932)] ?? null) : null), "text_win", [], "any", false, false, false, 932);
            echo "'+vehicles4partsData[i]['win']+'</li>';
\t\t}
\t  
\t\tif(vehicles4partsData[i]['brand']) {
\t\t  description += '<li>";
            // line 936
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_15 = ($context["translates"] ?? null)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 936)] ?? null) : null), "text_brand", [], "any", false, false, false, 936);
            echo "'+vehicles4partsData[i]['brand']+'</li>';
\t\t}
\t  
\t\tif(vehicles4partsData[i]['model']) {
\t\t  description += '<li>";
            // line 940
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_16 = ($context["translates"] ?? null)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 940)] ?? null) : null), "text_model", [], "any", false, false, false, 940);
            echo "'+vehicles4partsData[i]['model']+'</li>';
\t\t}
\t  
\t\tif(vehicles4partsData[i]['engine']) {
\t\t  description += '<li>";
            // line 944
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_17 = ($context["translates"] ?? null)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 944)] ?? null) : null), "text_engine", [], "any", false, false, false, 944);
            echo "'+vehicles4partsData[i]['engine']+'</li>';
\t\t}
\t  
\t\tif(vehicles4partsData[i]['engine_code']) {
\t\t  description += '<li>";
            // line 948
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_18 = ($context["translates"] ?? null)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 948)] ?? null) : null), "text_engine_code", [], "any", false, false, false, 948);
            echo "'+vehicles4partsData[i]['engine_code']+'</li>';
\t\t}
\t  
\t\tif(Number(vehicles4partsData[i]['year'])) {
\t\t  description += '<li>";
            // line 952
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_19 = ($context["translates"] ?? null)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 952)] ?? null) : null), "text_year", [], "any", false, false, false, 952);
            echo "'+vehicles4partsData[i]['year']+'</li>';
\t\t}
\t  
\t\tif(vehicles4partsData[i]['color']) {
\t\t  description += '<li>";
            // line 956
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_20 = ($context["translates"] ?? null)) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 956)] ?? null) : null), "text_color", [], "any", false, false, false, 956);
            echo "'+vehicles4partsData[i]['color']+'</li>';
\t\t}
\t  
\t\tif(vehicles4partsData[i]['color_code']) {
\t\t  description += '<li>";
            // line 960
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_21 = ($context["translates"] ?? null)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 960)] ?? null) : null), "text_color_code", [], "any", false, false, false, 960);
            echo "'+vehicles4partsData[i]['color_code']+'</li>';
\t\t}
\t  
\t\tif(vehicles4partsData[i]['transmission']) {
\t\t  description += '<li>";
            // line 964
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_22 = ($context["translates"] ?? null)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 964)] ?? null) : null), "text_transmission", [], "any", false, false, false, 964);
            echo "'+vehicles4partsData[i]['transmission']+'</li>';
\t\t}
\t  
\t\tif(vehicles4partsData[i]['gb_code']) {
\t\t  description += '<li>";
            // line 968
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_23 = ($context["translates"] ?? null)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 968)] ?? null) : null), "text_gb_code", [], "any", false, false, false, 968);
            echo "'+vehicles4partsData[i]['gb_code']+'</li>';
\t\t}
\t  
\t\tif(Number(vehicles4partsData[i]['gb_speed_level'])) {
\t\t  description += '<li>";
            // line 972
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_24 = ($context["translates"] ?? null)) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 972)] ?? null) : null), "text_gb_speed_level", [], "any", false, false, false, 972);
            echo "'+vehicles4partsData[i]['gb_speed_level']+'</li>';
\t\t}

\t\tif(vehicles4partsData[i]['drive']) {
\t\t  description += '<li>";
            // line 976
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_25 = ($context["translates"] ?? null)) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 976)] ?? null) : null), "text_drive", [], "any", false, false, false, 976);
            echo "'+vehicles4partsData[i]['drive']+'</li>';
\t\t}
\t  
\t\tif(Number(vehicles4partsData[i]['km'])) {
\t\t  description += '<li>";
            // line 980
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_26 = ($context["translates"] ?? null)) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 980)] ?? null) : null), "text_km", [], "any", false, false, false, 980);
            echo "'+vehicles4partsData[i]['km']+'</li>';
\t\t}
\t  
\t\tdescription += '</ul>';
\t}
\t
\tif (used === '1') {
\t  description += '<p>- ";
            // line 987
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_27 = ($context["translates"] ?? null)) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 987)] ?? null) : null), "text_quality", [], "any", false, false, false, 987);
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_28 = ($context["translates"] ?? null)) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 987)] ?? null) : null), "text_used", [], "any", false, false, false, 987);
            echo "</p>';
\t} else {
\t  description += '<p>- ";
            // line 989
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_29 = ($context["translates"] ?? null)) && is_array($__internal_compile_29) || $__internal_compile_29 instanceof ArrayAccess ? ($__internal_compile_29[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 989)] ?? null) : null), "text_quality", [], "any", false, false, false, 989);
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_30 = ($context["translates"] ?? null)) && is_array($__internal_compile_30) || $__internal_compile_30 instanceof ArrayAccess ? ($__internal_compile_30[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 989)] ?? null) : null), "text_new", [], "any", false, false, false, 989);
            echo "</p>';
\t}
\t
\t\$('#input-product_description-description-";
            // line 992
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 992);
            echo "').summernote('code', description);
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 994
        echo "}

function addVehicle4Parts(sku, name) {
  \$('#vehicle4parts' + sku).remove();
  \$('#product-vehicle4parts').prepend('<input id=\"vehicle4parts' + sku + '\" type=\"hidden\" name=\"product_vehicle4parts[]\" value=\"' + sku + '\" />');
}

function deleteVehicle4Parts(sku) {
  \$('#vehicle4parts' + sku).remove();
}


async function addVehicle(id, name, warehouse_id, engineId = false, engineTitle = false) {
  \$('#product-vehicle' + id).remove();
  
  if(engineTitle !== false) {
\tname += ' ' + engineTitle;
  }
  
  let html = '<div id=\"product-vehicle' + id + '\" data-id=\"' + id + '\" class=\"chip text-nowrap mt-3\"><span>' + name + '</span><i class=\"close fas fa-times\"></i><input type=\"hidden\" name=\"product_vehicle[]\" value=\"' + id + '\"/>';
  
  if(engineId !== false) {
\thtml += '<input type=\"hidden\" name=\"product_vehicle_engine[' + id + ']\" value=\"' + engineId + '\"/>';
  }
  
  html += '</div>';
  
  \$('#product-vehicle').prepend(html);
  
  await \$.ajax({
\turl: '";
        // line 1024
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/product.getVehicle4PartsByVehicle&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&vehicle_id=' + encodeURIComponent(id) + '&engine_id=' + encodeURIComponent(engineId) + '&warehouse_id=' + encodeURIComponent(warehouse_id),
\tdataType: 'json',
\tsuccess: function(json) {
\t  \$.each(json, function (i, item) {
\t\taddVehicle4Parts(item['sku'], item['name']);
\t  });
\t}
  });
  
  \$('#product-vehicle .chip .close').click(function(e) {
\tdeleteVehicle(e.currentTarget);
  });
}

\$('#product-vehicle .chip .close').click(function(e) {
  deleteVehicle(e.currentTarget);
});

async function deleteVehicle(target) {
  let vehicleId = target.parentElement.getElementsByTagName('input')[0].value;
  let engineId = 0;
  
  if(target.parentElement.getElementsByTagName('input')[1] !== undefined) {
\tengineId = target.parentElement.getElementsByTagName('input')[1].value;
  }

  await \$.ajax({
\turl: '";
        // line 1051
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/product.getVehicle4PartsByVehicle&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&vehicle_id=' + encodeURIComponent(vehicleId) + '&engine_id=' + encodeURIComponent(engineId) + '&warehouse_id=0',
\tdataType: 'json',
\tsuccess: function(json) {
\t  \$.each(json, function (i, item) {
\t\tdeleteVehicle4Parts(item['sku']);
\t  });
\t}
  });

  target.parentElement.remove();
  generateProductDescriptionName();
  generateProductDescription();
}

function magnificPopupInit() {
  \$('.dropzone-image').magnificPopup({
\ttype:'image',
\tgallery: {
\t  enabled: true
\t}
  });\t
}
</script>
";
        // line 1074
        echo ($context["footer"] ?? null);
        echo " ";
    }

    public function getTemplateName()
    {
        return "view/template/catalog/market_product_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1958 => 1074,  1930 => 1051,  1898 => 1024,  1866 => 994,  1858 => 992,  1851 => 989,  1845 => 987,  1835 => 980,  1828 => 976,  1821 => 972,  1814 => 968,  1807 => 964,  1800 => 960,  1793 => 956,  1786 => 952,  1779 => 948,  1772 => 944,  1765 => 940,  1758 => 936,  1751 => 932,  1745 => 929,  1736 => 923,  1719 => 909,  1712 => 905,  1705 => 901,  1698 => 897,  1691 => 893,  1684 => 889,  1677 => 885,  1668 => 879,  1662 => 876,  1658 => 874,  1654 => 873,  1641 => 865,  1607 => 833,  1599 => 831,  1591 => 826,  1584 => 823,  1580 => 822,  1523 => 767,  1517 => 766,  1511 => 763,  1506 => 762,  1503 => 761,  1499 => 760,  1494 => 758,  1483 => 749,  1477 => 748,  1471 => 746,  1465 => 743,  1460 => 742,  1457 => 741,  1453 => 740,  1426 => 718,  1403 => 698,  1348 => 646,  1337 => 640,  1325 => 633,  1319 => 630,  1241 => 554,  1232 => 552,  1228 => 551,  1196 => 521,  1181 => 511,  1177 => 509,  1175 => 508,  1153 => 489,  1134 => 473,  1126 => 467,  1108 => 455,  1099 => 450,  1095 => 449,  1070 => 429,  1006 => 370,  980 => 349,  965 => 337,  961 => 336,  952 => 330,  947 => 328,  943 => 327,  940 => 326,  934 => 325,  926 => 323,  923 => 322,  919 => 321,  903 => 312,  899 => 311,  881 => 298,  875 => 295,  869 => 292,  855 => 283,  851 => 282,  846 => 279,  829 => 276,  825 => 275,  822 => 274,  818 => 273,  807 => 267,  803 => 266,  796 => 262,  791 => 260,  784 => 256,  780 => 255,  774 => 252,  770 => 251,  763 => 247,  759 => 246,  753 => 243,  750 => 242,  735 => 240,  731 => 239,  723 => 234,  714 => 232,  706 => 231,  699 => 227,  695 => 226,  689 => 223,  685 => 222,  679 => 219,  675 => 218,  669 => 215,  665 => 214,  659 => 211,  655 => 210,  649 => 207,  645 => 206,  640 => 203,  615 => 201,  611 => 200,  605 => 197,  602 => 196,  591 => 194,  587 => 193,  583 => 192,  575 => 187,  568 => 182,  557 => 180,  553 => 179,  542 => 177,  536 => 174,  533 => 173,  518 => 171,  514 => 170,  500 => 165,  494 => 163,  486 => 160,  480 => 158,  478 => 157,  473 => 155,  465 => 154,  461 => 153,  449 => 151,  445 => 150,  441 => 148,  423 => 144,  418 => 142,  413 => 140,  408 => 138,  402 => 137,  398 => 135,  394 => 134,  384 => 128,  369 => 126,  365 => 125,  351 => 120,  347 => 119,  340 => 117,  332 => 114,  328 => 113,  320 => 108,  316 => 107,  309 => 103,  300 => 101,  292 => 100,  284 => 95,  280 => 94,  274 => 90,  262 => 88,  252 => 85,  244 => 82,  236 => 81,  224 => 79,  220 => 78,  216 => 76,  198 => 72,  193 => 70,  188 => 68,  183 => 66,  177 => 65,  173 => 63,  169 => 62,  160 => 57,  145 => 55,  141 => 54,  132 => 50,  124 => 45,  109 => 33,  101 => 32,  90 => 26,  82 => 21,  74 => 20,  63 => 14,  54 => 9,  46 => 5,  44 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/catalog/market_product_form.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/catalog/market_product_form.twig");
    }
}
