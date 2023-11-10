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

/* view/template/catalog/vehicle4parts_form.twig */
class __TwigTemplate_042422f43a514e74369aaa02c59692828fc197a656e2379d36415d10b542a544 extends Template
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
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-body\">
\t\t<ul class=\"nav nav-tabs flex-nowrap mb-3\" id=\"tabs\" role=\"tablist\">
\t\t  <li class=\"nav-item\" role=\"presentation\">
\t\t\t<a
\t\t\t  class=\"nav-link active\"
\t\t\t  id=\"tabs-tab-main\"
\t\t\t  data-mdb-toggle=\"tab\"
\t\t\t  href=\"#tabs-tabs-main\"
\t\t\t  role=\"tab\"
\t\t\t  aria-controls=\"tabs-tabs-main\"
\t\t\t  aria-selected=\"true\"
\t\t\t  >";
        // line 21
        echo ($context["tab_main"] ?? null);
        echo "</a
\t\t\t>
\t\t  </li>
\t\t  <li class=\"nav-item\" role=\"presentation\">
\t\t\t<a
\t\t\t  class=\"nav-link\"
\t\t\t  id=\"tabs-tab-webview\"
\t\t\t  data-mdb-toggle=\"tab\"
\t\t\t  href=\"#tabs-tabs-webview\"
\t\t\t  role=\"tab\"
\t\t\t  aria-controls=\"tabs-tabs-webview\"
\t\t\t  aria-selected=\"false\"
\t\t\t  >";
        // line 33
        echo ($context["tab_webview"] ?? null);
        echo "</a
\t\t\t>
\t\t  </li>
\t\t</ul>
\t\t<form action=\"";
        // line 37
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-vehicle4parts\" class=\"form-horizontal\">
\t\t<div class=\"tab-content\" id=\"tabs-content\">
\t\t  <div class=\"tab-pane fade show active\" id=\"tabs-tabs-main\" role=\"tabpanel\" aria-labelledby=\"tabs-tab-main\">
\t\t\t  <div class=\"input-group input-group-lg mb-3 justify-content-end\">
\t\t\t\t<span class=\"input-group-text text-warning fs-4 border-0\" style=\"color:#386bc0!important\">";
        // line 41
        echo ($context["text_sku"] ?? null);
        echo "</span>
\t\t\t\t<input type=\"text\" class=\"form-control fs-4 text-warning\" id=\"input-sku\" maxlength=\"7\" name=\"sku\" style=\"max-width: 175px;color:#386bc0!important\" placeholder=\"";
        // line 42
        echo ($context["placeholder_sku"] ?? null);
        echo "\" value=\"";
        echo ($context["sku"] ?? null);
        echo "\" ";
        if ((($context["new"] ?? null) == 0)) {
            echo "readonly";
        }
        echo "/>
\t\t\t  </div>
\t\t\t  <div class=\"dropzone border d-flex flex-column justify-content-center rounded mb-3\" ondrop=\"fileDrop(event)\" ondragover=\"return false\">
\t\t\t\t<div class=\"dropmsg bg-dark bg-opacity-75 text-white\"></div>
\t\t\t\t<div id=\"dropzone-files\" class=\"w-100 dropzone-body\">
\t\t\t\t  ";
        // line 47
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["vehicle4parts_images"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["vehicle4parts_image"]) {
            // line 48
            echo "\t\t\t\t\t<div class=\"m-2 dropzone-image\" href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts_image"], "path", [], "any", false, false, false, 48);
            echo "\" style=\"background-image: url(";
            echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts_image"], "path", [], "any", false, false, false, 48);
            echo ")\"><i class=\"fas fa-fast-backward p-1\"></i><i class=\"fa fa-minus-circle p-1\"></i><input type=\"hidden\" name=\"vehicle4parts_image[]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["vehicle4parts_image"], "image", [], "any", false, false, false, 48);
            echo "\" /></div>
\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['vehicle4parts_image'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        echo "\t\t\t\t\t<div class=\"m-2 add-dropzone-image\" onclick=\"fileExplorer();\" style=\"background-image: url(";
        echo ($context["server"] ?? null);
        echo "view/img/photo-plus.png)\"></div>
\t\t\t\t  ";
        // line 51
        if (($context["vehicle4parts_video"] ?? null)) {
            // line 52
            echo "\t\t\t\t\t<div class=\"m-2 dropzone-video\" href=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["vehicle4parts_video"] ?? null), "path", [], "any", false, false, false, 52);
            echo "\"><video ondragstart=\"return false\" controls><source src=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["vehicle4parts_video"] ?? null), "path", [], "any", false, false, false, 52);
            echo "\" type=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["vehicle4parts_video"] ?? null), "mime", [], "any", false, false, false, 52);
            echo "\"></video><i class=\"fa fa-minus-circle p-1\"></i><input type=\"hidden\" name=\"vehicle4parts_video[video]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["vehicle4parts_video"] ?? null), "video", [], "any", false, false, false, 52);
            echo "\" /><input type=\"hidden\" name=\"vehicle4parts_video[mime]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["vehicle4parts_video"] ?? null), "mime", [], "any", false, false, false, 52);
            echo "\" /></div>
\t\t\t\t  ";
        }
        // line 54
        echo "\t\t\t\t\t<div class=\"m-2 add-dropzone-video\" onclick=\"fileExplorer();\" style=\"background-image: url(";
        echo ($context["server"] ?? null);
        echo "view/img/video-plus.png)\"></div>
\t\t\t\t</div>
\t\t\t\t<input type=\"file\" multiple id=\"selectfile\">
\t\t\t  </div>
\t\t\t  <div id=\"input-note-container\" class=\"mb-2\">
\t\t\t\t<textarea id=\"input-note\" name=\"note\">";
        // line 59
        echo ($context["note"] ?? null);
        echo "</textarea>
\t\t\t  </div>
\t\t\t  <div class=\"mb-3 d-flex justify-content-end align-items-center\">
\t\t\t\t<button type=\"button\" id=\"btn-translate\" class=\"btn btn-primary d-none\"><i class=\"fas fa-globe me-3\"></i>";
        // line 62
        echo ($context["button_translate"] ?? null);
        echo "</button>
\t\t\t  </div>
\t\t\t  <div class=\"form-outline mb-3\">
\t\t\t\t<input type=\"text\" id=\"input-win\" name=\"win\" value=\"";
        // line 65
        echo ($context["win"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t\t<label class=\"form-label\" for=\"input-win\">";
        // line 66
        echo ($context["entry_win"] ?? null);
        echo "</label>
\t\t\t  </div>
\t\t\t  <div class=\"mb-3\">
\t\t\t\t<select class=\"select\" id=\"select-brand\" data-mdb-filter=\"true\" name=\"brand_id\" class=\"form-control\">
\t\t\t\t  <option value=\"\"></option>
\t\t\t\t  ";
        // line 71
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["brands"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["brand"]) {
            // line 72
            echo "\t\t\t\t  <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["brand"], "id", [], "any", false, false, false, 72);
            echo "\" ";
            if ((($context["brand_id"] ?? null) == twig_get_attribute($this->env, $this->source, $context["brand"], "id", [], "any", false, false, false, 72))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["brand"], "name", [], "any", false, false, false, 72);
            echo "</option>
\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['brand'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 74
        echo "\t\t\t\t</select>
\t\t\t\t<label class=\"form-label select-label\">";
        // line 75
        echo ($context["select_brand"] ?? null);
        echo "</label>
\t\t\t  </div>
\t\t\t  <div class=\"mb-3\">
\t\t\t\t<select class=\"select\" id=\"select-model\" data-mdb-filter=\"true\" name=\"model_id\" class=\"form-control\">
\t\t\t\t  <option value=\"\"></option>
\t\t\t\t  ";
        // line 80
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["models"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["model"]) {
            // line 81
            echo "\t\t\t\t  <option id = \"vehicle";
            echo twig_get_attribute($this->env, $this->source, $context["model"], "id", [], "any", false, false, false, 81);
            echo "\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["model"], "id", [], "any", false, false, false, 81);
            echo "\" ";
            if ((($context["model_id"] ?? null) == twig_get_attribute($this->env, $this->source, $context["model"], "id", [], "any", false, false, false, 81))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["model"], "name", [], "any", false, false, false, 81);
            echo "</option>
\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['model'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 83
        echo "\t\t\t\t</select>
\t\t\t\t<label class=\"form-label select-label\">";
        // line 84
        echo ($context["select_model"] ?? null);
        echo "</label>
\t\t\t  </div>
\t\t\t  <div class=\"mb-3\">
\t\t\t\t<select class=\"select\" id=\"select-engine\" name=\"engine_id\" class=\"form-control\">
\t\t\t\t  <option value=\"\"></option>
\t\t\t\t  ";
        // line 89
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["engines"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["engine"]) {
            // line 90
            echo "\t\t\t\t    <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["engine"], "id", [], "any", false, false, false, 90);
            echo "\" ";
            if ((($context["engine_id"] ?? null) == twig_get_attribute($this->env, $this->source, $context["engine"], "id", [], "any", false, false, false, 90))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["engine"], "name", [], "any", false, false, false, 90);
            echo "</option>
\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['engine'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 92
        echo "\t\t\t\t</select>
\t\t\t\t<label class=\"form-label select-label\">";
        // line 93
        echo ($context["select_engine"] ?? null);
        echo "</label>
\t\t\t  </div>
\t\t\t  <div class=\"form-outline mb-3\">
\t\t\t\t<input type=\"text\" id=\"input-engine_code\" name=\"engine_code\" value=\"";
        // line 96
        echo ($context["engine_code"] ?? null);
        echo "\" class=\"form-control\"/>
\t\t\t\t<label class=\"form-label\" for=\"input-engine_code\">";
        // line 97
        echo ($context["entry_engine_code"] ?? null);
        echo "</label>
\t\t\t  </div>
\t\t\t  <div class=\"form-outline mb-3\">
\t\t\t\t<input type=\"number\" id=\"input-year\" name=\"year\" value=\"";
        // line 100
        echo ($context["year"] ?? null);
        echo "\" class=\"form-control\" max=\"9999\"/>
\t\t\t\t<label class=\"form-label\" for=\"input-year\">";
        // line 101
        echo ($context["entry_year"] ?? null);
        echo "</label>
\t\t\t  </div>
\t\t\t  <div class=\"mb-3\">
\t\t\t\t<select class=\"select\" name=\"color_id\" id=\"select-color_id\" class=\"form-control\">
\t\t\t\t  <option value=\"\"></option>
\t\t\t\t  ";
        // line 106
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["colors"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["color"]) {
            // line 107
            echo "\t\t\t\t  <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["color"], "vehicle_color_id", [], "any", false, false, false, 107);
            echo "\" ";
            if ((($context["color_id"] ?? null) == twig_get_attribute($this->env, $this->source, $context["color"], "vehicle_color_id", [], "any", false, false, false, 107))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["color"], "text", [], "any", false, false, false, 107);
            echo "</option>
\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['color'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 109
        echo "\t\t\t\t</select>
\t\t\t\t<label class=\"form-label select-label\">";
        // line 110
        echo ($context["select_color"] ?? null);
        echo "</label>
\t\t\t  </div>
\t\t\t  <div class=\"form-outline mb-3\">
\t\t\t\t<input type=\"text\" id=\"input-color_code\" name=\"color_code\" value=\"";
        // line 113
        echo ($context["color_code"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t\t<label class=\"form-label\" for=\"input-color_code\">";
        // line 114
        echo ($context["entry_color_code"] ?? null);
        echo "</label>
\t\t\t  </div>
\t\t\t  <div class=\"mb-3\">
\t\t\t\t<select class=\"select\" id=\"select-transmission_id\" name=\"transmission_id\" class=\"form-control\">
\t\t\t\t  <option value=\"\"></option>
\t\t\t\t  ";
        // line 119
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["transmissions"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["transmission"]) {
            // line 120
            echo "\t\t\t\t  <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["transmission"], "vehicle_transmission_id", [], "any", false, false, false, 120);
            echo "\" ";
            if ((($context["transmission_id"] ?? null) == twig_get_attribute($this->env, $this->source, $context["transmission"], "vehicle_transmission_id", [], "any", false, false, false, 120))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["transmission"], "text", [], "any", false, false, false, 120);
            echo "</option>
\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transmission'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 122
        echo "\t\t\t\t</select>
\t\t\t\t<label class=\"form-label select-label\">";
        // line 123
        echo ($context["select_transmission"] ?? null);
        echo "</label>
\t\t\t  </div>
\t\t\t  <div class=\"form-outline mb-3\">
\t\t\t\t<input type=\"text\" id=\"input-gb_code\" name=\"gb_code\" value=\"";
        // line 126
        echo ($context["gb_code"] ?? null);
        echo "\" class=\"form-control\"/>
\t\t\t\t<label class=\"form-label\" for=\"input-gb_code\">";
        // line 127
        echo ($context["entry_gb_code"] ?? null);
        echo "</label>
\t\t\t  </div>
\t\t\t  <div class=\"mb-3\">
\t\t\t\t<select class=\"select\" id=\"select-gb_speed_level\" name=\"gb_speed_level\" class=\"form-control\">
\t\t\t\t  <option value=\"\"></option>
\t\t\t\t  ";
        // line 132
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["gb_speed_levels"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["gb_speed_level_data"]) {
            // line 133
            echo "\t\t\t\t  <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["gb_speed_level_data"], "text", [], "any", false, false, false, 133);
            echo "\" ";
            if ((($context["gb_speed_level"] ?? null) == twig_get_attribute($this->env, $this->source, $context["gb_speed_level_data"], "text", [], "any", false, false, false, 133))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["gb_speed_level_data"], "text", [], "any", false, false, false, 133);
            echo "</option>
\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['gb_speed_level_data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 135
        echo "\t\t\t\t</select>
\t\t\t\t<label class=\"form-label select-label\">";
        // line 136
        echo ($context["select_gb_speed_level"] ?? null);
        echo "</label>
\t\t\t  </div>
\t\t\t  <div class=\"mb-3\">
\t\t\t\t<select class=\"select\" id=\"select-drive_id\" name=\"drive_id\" class=\"form-control\">
\t\t\t\t  <option value=\"\"></option>
\t\t\t\t  ";
        // line 141
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["drives"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["drive"]) {
            // line 142
            echo "\t\t\t\t  <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["drive"], "vehicle_drive_id", [], "any", false, false, false, 142);
            echo "\" ";
            if ((($context["drive_id"] ?? null) == twig_get_attribute($this->env, $this->source, $context["drive"], "vehicle_drive_id", [], "any", false, false, false, 142))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["drive"], "text", [], "any", false, false, false, 142);
            echo "</option>
\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['drive'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 144
        echo "\t\t\t\t</select>
\t\t\t\t<label class=\"form-label select-label\">";
        // line 145
        echo ($context["select_drive"] ?? null);
        echo "</label>
\t\t\t  </div>
\t\t\t  <div class=\"form-outline mb-3\">
\t\t\t\t<input type=\"number\" id=\"input-km\" name=\"km\" value=\"";
        // line 148
        echo ($context["km"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t\t<label class=\"form-label\" for=\"input-km\">";
        // line 149
        echo ($context["entry_km"] ?? null);
        echo "</label>
\t\t\t  </div>
\t\t\t  <div class=\"form-outline\">
\t\t\t\t<input type=\"number\" id=\"input-price\" name=\"price\" value=\"";
        // line 152
        echo ($context["price"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t\t<label class=\"form-label\" for=\"input-price\">";
        // line 153
        echo ($context["entry_price"] ?? null);
        echo "</label>
\t\t\t  </div>
\t\t\t  <div class=\"mt-3\">
\t\t\t\t<select class=\"select\" name=\"warehouse_id\">
\t\t\t\t  <option value=\"\"></option>
\t\t\t\t  ";
        // line 158
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["warehouses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["warehouse"]) {
            // line 159
            echo "\t\t\t\t  <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["warehouse"], "warehouse_id", [], "any", false, false, false, 159);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["warehouse"], "warehouse_id", [], "any", false, false, false, 159) == ($context["warehouse_id"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["warehouse"], "name", [], "any", false, false, false, 159);
            echo "</option>
\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['warehouse'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 161
        echo "\t\t\t\t</select>
\t\t\t\t<label class=\"form-label select-label\">";
        // line 162
        echo ($context["select_warehouse"] ?? null);
        echo "</label>
\t\t\t  </div>
\t\t\t  <div class=\"text-start mt-3 mb-3\">
\t\t\t\t<button type=\"submit\" form=\"form-vehicle4parts\" data-toggle=\"tooltip\" title=\"";
        // line 165
        echo ($context["button_save"] ?? null);
        echo "\" class=\"btn btn-primary\" style=\"min-width: 150px;\"><i class=\"fa fa-save me-2\"></i>";
        echo ($context["button_save"] ?? null);
        echo "</button>
\t\t\t\t<a href=\"";
        // line 166
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply me-2\"></i>";
        echo ($context["button_cancel"] ?? null);
        echo "</a>
\t\t\t  </div>
\t\t  </div>
\t\t  <div class=\"tab-pane fade\" id=\"tabs-tabs-webview\" role=\"tabpanel\" aria-labelledby=\"tabs-tab-webview\">
\t\t  
\t\t\t<ul class=\"nav nav-pills mb-3\" id=\"description\" role=\"tablist\">
\t\t\t  ";
        // line 172
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 173
            echo "\t\t\t  <li class=\"nav-item\" role=\"presentation\">
\t\t\t\t<a
\t\t\t\t  class=\"nav-link me-0 ";
            // line 175
            if ((twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 175) == ($context["user_language"] ?? null))) {
                echo "active";
            }
            echo "\"
\t\t\t\t  id=\"description-tab-";
            // line 176
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 176);
            echo "\"
\t\t\t\t  data-mdb-toggle=\"pill\"
\t\t\t\t  href=\"#description-pills-";
            // line 178
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 178);
            echo "\"
\t\t\t\t  role=\"tab\"
\t\t\t\t  aria-controls=\"description-pills-";
            // line 180
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 180);
            echo "\"
\t\t\t\t  aria-selected=\"true\"
\t\t\t\t  ><img src=\"";
            // line 182
            echo ($context["server"] ?? null);
            echo "language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 182);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 182);
            echo ".png\" alt=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 182);
            echo "\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 182);
            echo "\" /></a
\t\t\t\t>
\t\t\t  </li>
\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 186
        echo "\t\t\t</ul>
\t\t\t<div class=\"tab-content\" id=\"description-content\">
\t\t\t  ";
        // line 188
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 189
            echo "\t\t\t  <div class=\"tab-pane fade ";
            if ((twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 189) == ($context["user_language"] ?? null))) {
                echo "show active";
            }
            echo "\" id=\"description-pills-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 189);
            echo "\" role=\"tabpanel\" aria-labelledby=\"description-tab-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 189);
            echo "\">
\t\t\t\t<div class=\"form-outline\">
\t\t\t\t  <input type=\"text\" id=\"input-vehicle4parts_description-title-";
            // line 191
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 191);
            echo "\" name=\"vehicle4parts_description[";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 191);
            echo "][title]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_0 = ($context["vehicle4parts_description"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 191)] ?? null) : null), "title", [], "any", false, false, false, 191);
            echo "\" class=\"form-control\"/>
\t\t\t\t  <label class=\"form-label\" for=\"input-title\">";
            // line 192
            echo ($context["entry_title"] ?? null);
            echo "</label>
\t\t\t\t</div>

\t\t\t\t<ul class=\"nav nav-pills mb-3 mt-2\" role=\"tablist\">
\t\t\t\t  <li class=\"nav-item col-12 col-sm-4\" role=\"presentation\">
\t\t\t\t\t<a
\t\t\t\t\t  class=\"nav-link active nowrap text-center me-0\"
\t\t\t\t\t  id=\"wv-tab-specifications-";
            // line 199
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 199);
            echo "\"
\t\t\t\t\t  data-mdb-toggle=\"pill\"
\t\t\t\t\t  href=\"#wv-pills-specifications-";
            // line 201
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 201);
            echo "\"
\t\t\t\t\t  role=\"tab\"
\t\t\t\t\t  aria-controls=\"wv-pills-specifications-";
            // line 203
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 203);
            echo "\"
\t\t\t\t\t  aria-selected=\"true\"
\t\t\t\t\t  >";
            // line 205
            echo ($context["tab_specifications"] ?? null);
            echo "</a
\t\t\t\t\t>
\t\t\t\t  </li>
\t\t\t\t  <li class=\"nav-item col-12 col-sm-4\" role=\"presentation\">
\t\t\t\t\t<a
\t\t\t\t\t  class=\"nav-link nowrap text-center me-0\"
\t\t\t\t\t  id=\"wv-tab-product_list-";
            // line 211
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 211);
            echo "\"
\t\t\t\t\t  data-mdb-toggle=\"pill\"
\t\t\t\t\t  href=\"#wv-pills-product_list-";
            // line 213
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 213);
            echo "\"
\t\t\t\t\t  role=\"tab\"
\t\t\t\t\t  aria-controls=\"wv-pills-product_list-";
            // line 215
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 215);
            echo "\"
\t\t\t\t\t  aria-selected=\"false\"
\t\t\t\t\t  >";
            // line 217
            echo ($context["tab_product_list"] ?? null);
            echo "</a
\t\t\t\t\t>
\t\t\t\t  </li>
\t\t\t\t  <li class=\"nav-item col-12 col-sm-4\" role=\"presentation\">
\t\t\t\t\t<a
\t\t\t\t\t  class=\"nav-link nowrap text-center me-0\"
\t\t\t\t\t  id=\"wv-tab-description-";
            // line 223
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 223);
            echo "\"
\t\t\t\t\t  data-mdb-toggle=\"pill\"
\t\t\t\t\t  href=\"#wv-pills-description-";
            // line 225
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 225);
            echo "\"
\t\t\t\t\t  role=\"tab\"
\t\t\t\t\t  aria-controls=\"wv-pills-description-";
            // line 227
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 227);
            echo "\"
\t\t\t\t\t  aria-selected=\"false\"
\t\t\t\t\t  >";
            // line 229
            echo ($context["tab_description"] ?? null);
            echo "</a
\t\t\t\t\t>
\t\t\t\t  </li>
\t\t\t\t</ul>
\t\t\t\t<div class=\"tab-content\" id=\"wv-content-";
            // line 233
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 233);
            echo "\">
\t\t\t\t  <div class=\"tab-pane fade show active\" id=\"wv-pills-specifications-";
            // line 234
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 234);
            echo "\" role=\"tabpanel\" aria-labelledby=\"wv-tab-specifications-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 234);
            echo "\">
\t\t\t\t\t<textarea id=\"input-vehicle4parts_description-specifications-";
            // line 235
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 235);
            echo "\" name=\"vehicle4parts_description[";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 235);
            echo "][specifications]\">";
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_1 = ($context["vehicle4parts_description"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 235)] ?? null) : null), "specifications", [], "any", false, false, false, 235);
            echo "</textarea>
\t\t\t\t  </div>
\t\t\t\t  <div class=\"tab-pane fade\" id=\"wv-pills-product_list-";
            // line 237
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 237);
            echo "\" role=\"tabpanel\" aria-labelledby=\"wv-tab-product_list-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 237);
            echo "\">
\t\t\t\t\t";
            // line 238
            if (($context["product_list"] ?? null)) {
                // line 239
                echo "\t\t\t\t\t  <ol class=\"list-group list-group-light list-group-numbered\">
\t\t\t\t\t\t";
                // line 240
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["product_list"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                    // line 241
                    echo "\t\t\t\t\t\t<li class=\"list-group-item d-flex align-items-center border-0\"><a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "link", [], "any", false, false, false, 241);
                    echo "\" target=\"blank\" class=\"ms-3 me-auto\">";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 241);
                    echo "</a><span class=\"badge badge-primary rounded-pill fs-7\">";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 241);
                    echo "</span></li>
\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 243
                echo "\t\t\t\t\t  </ol>
\t\t\t\t\t";
            } else {
                // line 245
                echo "\t\t\t\t\t";
                echo ($context["text_no_results"] ?? null);
                echo "
\t\t\t\t\t";
            }
            // line 247
            echo "\t\t\t\t  </div>
\t\t\t\t  <div class=\"tab-pane fade\" id=\"wv-pills-description-";
            // line 248
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 248);
            echo "\" role=\"tabpanel\" aria-labelledby=\"wv-tab-description-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 248);
            echo "\">
\t\t\t\t\t<div id=\"input-description-wv-container\" class=\"mb-3\">
\t\t\t\t\t  <textarea id=\"input-vehicle4parts_description-note-";
            // line 250
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 250);
            echo "\" name=\"vehicle4parts_description[";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 250);
            echo "][note]\">";
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_2 = ($context["vehicle4parts_description"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 250)] ?? null) : null), "note", [], "any", false, false, false, 250);
            echo "</textarea>
\t\t\t\t\t</div>
\t\t\t\t  </div>
\t\t\t\t</div>
\t\t\t  </div>
\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 256
        echo "\t\t\t  <div class=\"text-start mt-4 mb-3\">
\t\t\t\t<button type=\"submit\" form=\"form-vehicle4parts\" data-toggle=\"tooltip\" title=\"";
        // line 257
        echo ($context["button_save"] ?? null);
        echo "\" class=\"btn btn-primary\" style=\"min-width: 150px;\"><i class=\"fa fa-save me-2\"></i>";
        echo ($context["button_save"] ?? null);
        echo "</button>
\t\t\t\t<a href=\"";
        // line 258
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply me-2\"></i>";
        echo ($context["button_cancel"] ?? null);
        echo "</a>
\t\t\t  </div>
\t\t\t</div>
\t\t</div>
\t\t</form>
      </div>
    </div>
</div>
</main>
";
        // line 267
        echo ($context["footer"] ?? null);
        echo " 
<script>
\$(document).ready(function() {
  dropRefresh();
  magnificPopupInit();
  
  \$('#input-note').summernote({
\theight: 150,
\ttoolbar: false,
\tdisableDragAndDrop: true,
\ttabDisable: true,
\tplaceholder: '";
        // line 278
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
  
  ";
        // line 290
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 291
            echo "  \$('#input-vehicle4parts_description-note-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 291);
            echo "').summernote({
\theight: 300,
\ttoolbar: false,
\tdisableDragAndDrop: true,
\ttabDisable: true,
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
  
  \$('#input-vehicle4parts_description-specifications-";
            // line 307
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 307);
            echo "').summernote({
\theight: 300,
\ttoolbar: false,
\tdisableDragAndDrop: true,
\ttabDisable: true,
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
        // line 323
        echo "  
  \$('#input-note-container').addVoiceTrigger(function(msg) {
\t\$('#input-note').summernote('insertText', msg);
  });
  
  \$('#input-note').on('summernote.blur', function() {
\tif(\$('#input-note').summernote('code') === \$('#input-vehicle4parts_description-note-";
        // line 329
        echo ($context["user_language"] ?? null);
        echo "').summernote('code')) {
\t\treturn;
\t}
\t
\t\$('#input-vehicle4parts_description-note-";
        // line 333
        echo ($context["user_language"] ?? null);
        echo "').summernote('code', \$('#input-note').summernote('code'));
\t
\t\$('#btn-translate').removeClass('d-none');
  });
});

async function translate(text, languageTo) {
  let translatedText;
  
  await \$.ajax({
\turl: '";
        // line 343
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

  let note = \$('#input-note').summernote('code');
  
  ";
        // line 365
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 366
            echo "\t";
            if ((twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 366) != ($context["user_language"] ?? null))) {
                // line 367
                echo "\t  await translate(note, '";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 367);
                echo "').then(function(translatedText) {
\t\t\$('#input-vehicle4parts_description-note-";
                // line 368
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 368);
                echo "').summernote('code', translatedText);
\t  });
\t";
            }
            // line 371
            echo "  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 372
        echo "  
  \$('#btn-translate').before('<div class=\"text-success me-3\"><i class=\"fas fa-check\"></i></div>');
  loading(false);
});


function generateWebViewSpecifications() {
  let specifications;
  
  let win = \$('#input-win').val();
  let brandId = \$('#select-brand').val();
  let brandName = false;
  
  if(brandId) {
    brandName = \$(\"#select-brand option[value=\\'\"+brandId+\"'\\]\").html();
  }
 
  let modelId = \$('#select-model').val();
  let modelName = false;
  
  if(modelId != '0') {
\tmodelName = \$(\"#select-model option[value=\\'\"+modelId+\"'\\]\").html();
  }
  
  let engineId = \$('#select-engine').val();
  let engineName = false;
  
  if(engineId != '0') {
\tengineName = \$(\"#select-engine option[value=\\'\"+engineId+\"'\\]\").html();
  }
  
  let engineCode = \$('#input-engine_code').val();
  let year = \$('#input-year').val();
  
  let colorId = \$('#select-color_id').val();
  let colorName = false;
  
  if(colorId != '0') {
\tcolorName = \$(\"#select-color_id option[value=\\'\"+colorId+\"'\\]\").html();
  }
  
  let colorCode = \$('#input-color_code').val();
  
  let transmissionId = \$('#select-transmission_id').val();
  let transmissionName = false;
  
  if(transmissionId != '0') {
\ttransmissionName = \$(\"#select-transmission_id option[value=\\'\"+transmissionId+\"'\\]\").html();
  }
  
  let gbCode = \$('#input-gb_code').val();
  let gbSpeedLevel = \$('#select-gb_speed_level').val();
  
  let driveId = \$('#select-drive_id').val();
  let driveName = false;
  
  if(driveId != '0') {
    driveName = \$(\"#select-drive_id option[value=\\'\"+driveId+\"'\\]\").html();
  }
  
  let km = \$('#input-km').val();
  
  ";
        // line 434
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 435
            echo "    specifications = '';
  
\tif(win) {
\t  specifications += '<p>- ";
            // line 438
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_3 = ($context["translates"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 438)] ?? null) : null), "text_win", [], "any", false, false, false, 438);
            echo "'+win+'</p>';
\t}

\tif(brandName) {
\t  specifications += '<p>- ";
            // line 442
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_4 = ($context["translates"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 442)] ?? null) : null), "text_brand", [], "any", false, false, false, 442);
            echo "'+brandName+'</p>';
\t}
\t
\tif(modelName) {
\t  specifications += '<p>- ";
            // line 446
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_5 = ($context["translates"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 446)] ?? null) : null), "text_model", [], "any", false, false, false, 446);
            echo "'+modelName+'</p>';
\t}
\t
\tif(engineName) {
\t  specifications += '<p>- ";
            // line 450
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_6 = ($context["translates"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 450)] ?? null) : null), "text_engine", [], "any", false, false, false, 450);
            echo "'+engineName+'</p>';
\t}
\t
\tif(engineCode) {
\t  specifications += '<p>- ";
            // line 454
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_7 = ($context["translates"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 454)] ?? null) : null), "text_engine_code", [], "any", false, false, false, 454);
            echo "'+engineCode+'</p>';
\t}
\t
\tif(Number(year)) {
\t  specifications += '<p>- ";
            // line 458
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_8 = ($context["translates"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 458)] ?? null) : null), "text_year", [], "any", false, false, false, 458);
            echo "'+year+'</p>';
\t}
\t
\tif(colorName) {
\t  specifications += '<p>- ";
            // line 462
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_9 = ($context["translates"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 462)] ?? null) : null), "text_color", [], "any", false, false, false, 462);
            echo "'+colorName+'</p>';
\t}
\t
\tif(colorCode) {
\t  specifications += '<p>- ";
            // line 466
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_10 = ($context["translates"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 466)] ?? null) : null), "text_color_code", [], "any", false, false, false, 466);
            echo "'+colorCode+'</p>';
\t}
\t
\tif(transmissionName) {
\t  specifications += '<p>- ";
            // line 470
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_11 = ($context["translates"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 470)] ?? null) : null), "text_transmission", [], "any", false, false, false, 470);
            echo "'+transmissionName+'</p>';
\t}
\t
\tif(gbCode) {
\t  specifications += '<p>- ";
            // line 474
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_12 = ($context["translates"] ?? null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 474)] ?? null) : null), "text_gb_code", [], "any", false, false, false, 474);
            echo "'+gbCode+'</p>';
\t}
\t
\tif(gbSpeedLevel != 0) {
\t  specifications += '<p>- ";
            // line 478
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_13 = ($context["translates"] ?? null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 478)] ?? null) : null), "text_gb_speed_level", [], "any", false, false, false, 478);
            echo "'+gbSpeedLevel+'</p>';
\t}
\t
\tif(driveName) {
\t  specifications += '<p>- ";
            // line 482
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_14 = ($context["translates"] ?? null)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 482)] ?? null) : null), "text_drive", [], "any", false, false, false, 482);
            echo "'+driveName+'</p>';
\t}
\t
\tif(km) {
\t  specifications += '<p>- ";
            // line 486
            echo twig_get_attribute($this->env, $this->source, (($__internal_compile_15 = ($context["translates"] ?? null)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 486)] ?? null) : null), "text_km", [], "any", false, false, false, 486);
            echo "'+km+'</p>';
\t}
\t
\t\$('#input-vehicle4parts_description-specifications-";
            // line 489
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 489);
            echo "').summernote('code', specifications);
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 491
        echo "}

function generateWebViewTitle() {
  let title = '';
  
  let brandId = \$('#select-brand').val();

  if(brandId) {
\tlet brandName = \$(\"#select-brand option[value=\\'\"+brandId+\"'\\]\").html();
\ttitle += brandName;
  }
  
  let modelId = \$('#select-model').val();
  
  if(modelId != '0') {
\tlet modelName = \$(\"#select-model option[value=\\'\"+modelId+\"'\\]\").html();
\ttitle += ' '+modelName;
  }
  
  let engineId = \$('#select-engine').val();

  if(engineId != '0') {
\tlet engineName = \$(\"#select-engine option[value=\\'\"+engineId+\"'\\]\").html();
\ttitle += ' '+engineName;
  }
  
  ";
        // line 517
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 518
            echo "\t \$('#input-vehicle4parts_description-title-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 518);
            echo "').val(title.trim());
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 520
        echo "}

\$('select[name=\\'brand_id\\']').change(function(event) {
  \$.ajax({
\turl: '";
        // line 524
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/vehicle4parts.getModels&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&brand_id=' + encodeURIComponent(event.target.value),
\tdataType: 'json',
\tsuccess: function(json) {
\t  \$('select[name=\\'model_id\\'] option[value!=\"\"]').remove();

\t  \$.each(json, function (i, item) {
\t\t\$('select[name=\\'model_id\\']').append(\$('<option>', { 
\t\t  value: item.id,
\t\t  text : item.name
\t\t}));
\t\tgenerateWebViewSpecifications();
\t\tgenerateWebViewTitle();
\t  });
\t}
  })
});

\$('select[name=\\'model_id\\']').change(function(event) {
  \$.ajax({
\turl: '";
        // line 543
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/vehicle4parts.getEngines&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&model_id=' + encodeURIComponent(event.target.value),
\tdataType: 'json',
\tsuccess: function(json) {
\t  \$('#select-engine option[value!=\"\"]').remove();

\t  \$.each(json, function (i, item) {
\t\t\$('#select-engine').append(\$('<option>', { 
\t\t  value: item.id,
\t\t  text : item.name
\t\t}));
\t\tgenerateWebViewSpecifications();
\t\tgenerateWebViewTitle();
\t  });
\t}
  })
});

\$('#select-engine').change(function() {
  generateWebViewTitle();
  generateWebViewSpecifications();
});

\$('#input-engine_code').change(function() {
  generateWebViewSpecifications();
});

\$('#input-year').change(function() {
  generateWebViewSpecifications();
});

\$('#select-color_id').change(function() {
  generateWebViewSpecifications();
});

\$('#input-color_code').change(function() {
  generateWebViewSpecifications();
});

\$('#select-transmission_id').change(function() {
  generateWebViewSpecifications();
});

\$('#input-gb_code').change(function() {
  generateWebViewSpecifications();
});

\$('#select-gb_speed_level').change(function() {
  generateWebViewSpecifications();
});

\$('#select-drive_id').change(function() {
  generateWebViewSpecifications();
});

\$('#input-km').change(function() {
  generateWebViewSpecifications();
});

\$('#input-win').change(function() {
  generateWebViewSpecifications();
});

\$('#input-sku').change(function(event) {
  if(event.target.value.length < 5 || event.target.value.length > 7) {
\tevent.target.classList.add('text-danger');
\tevent.target.focus();
  } else {
\tevent.target.classList.remove('text-danger');
  }
  
  productSpecificationsInit();
});


// FILE DROP

let files;
let countImages = \$('#dropzone-files .dropzone-image').length;
let countVideos = \$('#dropzone-files .dropzone-video').length;

function fileDrop(e) {
  e.preventDefault();
  let files = e.dataTransfer.files;
  
  for(let i = 0; i < files.length; i++) {
\tif(files[i].type.match(/image.*/)) {
\t  if(countImages < 8) {
\t\tuploadImage(files[i]);
\t  }
\t  
\t  countImages++;
\t} else if(files[i].type.match(/video.*/)) {
\t  if(countVideos < 1) {
\t\tuploadVideo(files[i]);
\t  }
\t  
\t  countVideos++;
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
\t\tif(countImages < 8) {
\t\t  uploadImage(files[i]);
\t\t}
\t\t
\t\tcountImages++;
\t  } else if(files[i].type.match(/video.*/)) {
\t\tif(countVideos < 1) {
\t\t  uploadVideo(files[i]);
\t\t}
\t\t
\t\tcountVideos++;
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
  if(countVideos) {
\t\$('.add-dropzone-video').addClass('hide');
  } else {
\t\$('.add-dropzone-video').removeClass('hide');
  }
}

async function uploadImage(file) {
  if (file.type.match(/image.*/)) {
\t\$('.dropmsg').html('<div class=\"spinner-border\" role=\"status\"><span class=\"visually-hidden\">Loading...</span></div>');
\t\$('.dropmsg').addClass('d-flex');
\t
\timgFile = await imageResize(file, '";
        // line 685
        echo ($context["MAX_IMAGE_WIDTH"] ?? null);
        echo "', '";
        echo ($context["MAX_IMAGE_HEIGHT"] ?? null);
        echo "');

\tlet formData = new FormData();
\tformData.append('file', imgFile);
 
\t\$.ajax({
\t  type: 'POST',
\t  url: '";
        // line 692
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/vehicle4parts.uploadImage&user_token=";
        echo ($context["user_token"] ?? null);
        echo "',
\t  contentType: false,
\t  processData: false,
\t  data: formData,
\t  success:function(response) {
\t\tif(response.error !== undefined) {
\t\t  alert(response.error);
\t\t  countImages = \$('#dropzone-files .dropzone-image').length;
\t\t  return;
\t\t}

\t\t\$('#selectfile').val('');
\t
\t\t\$('.add-dropzone-image').before('<div class=\"m-2 dropzone-image\" href=\"' + response['path'] + '\" style=\"background-image: url(' + response['path'] + ')\"><i class=\"fas fa-fast-backward p-1\"></i><i class=\"fa fa-minus-circle p-1\"></i><input type=\"hidden\" name=\"vehicle4parts_image[]\" value=\"' + response['image'] + '\" /></div>');
\t\tdropRefresh();
\t\tmagnificPopupInit();
\t  }
\t});
  }
}

function uploadVideo(file) {
  if (file.type.match(/video.*/)) {
\t\$('.dropmsg').html('<div class=\"spinner-border\" role=\"status\"><span class=\"visually-hidden\">";
        // line 715
        echo ($context["text_loading"] ?? null);
        echo "</span></div>');
\t\$('.dropmsg').addClass('d-flex');

\tlet formData = new FormData();
\tformData.append('file', file);

\t\$.ajax({
\ttype: 'POST',
\turl: '";
        // line 723
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/vehicle4parts.uploadVideo&user_token=";
        echo ($context["user_token"] ?? null);
        echo "',
\tcontentType: false,
\tprocessData: false,
\tdata: formData,
\tsuccess:function(response) {
\t\tif(response.error !== undefined) {
\t\t  alert(response.error);
\t\t  countVideos = \$('#dropzone-files .dropzone-video').length;
\t\t  return;
\t\t}

\t\t\$('#selectfile').val('');
\t\t
\t\t\$('.add-dropzone-video').before('<div class=\"m-2 dropzone-video\" href=\"' + response['path'] + '\">' + '<video ondragstart=\"return false\" controls><source src=\"' + response['path'] + '\" type=\"' + response['mime'] + '\"></video><i class=\"fa fa-minus-circle p-1\"></i><input type=\"hidden\" name=\"vehicle4parts_video[video]\" value=\"' + response['video'] + '\" /><input type=\"hidden\" name=\"vehicle4parts_video[mime]\" value=\"' + response['mime'] + '\" /></div>');
\t\tdropRefresh();
\t\tmagnificPopupInit();
\t  }
\t});
  }
}

\$('#dropzone-files').delegate('.fa-minus-circle', 'click', function() {
  \$.magnificPopup.close();
  \$(this).parent().remove();
  countImages = \$('#dropzone-files .dropzone-image').length;
  countVideos = \$('#dropzone-files .dropzone-video').length;
  dropRefresh();
  magnificPopupInit();
  return false;
});

\$('#dropzone-files').delegate('.fa-fast-backward', 'click', function() {
  \$.magnificPopup.close();
  let element = \$(this).parent();
  \$(this).parent().remove();
  \$('#dropzone-files').prepend(element);
  magnificPopupInit();
});

document.ondragenter = function() {
  \$('.dropmsg').html('";
        // line 763
        echo ($context["text_drop"] ?? null);
        echo "');
  \$('.dropmsg').addClass('d-flex');
};

document.onclick = function() {
  \$('.dropmsg').removeClass('d-flex');
};

\$(document).ajaxStop(function() {
  \$('.dropmsg').removeClass('d-flex');
});

function magnificPopupInit() {
  \$('.dropzone-image, .dropzone-video').magnificPopup({
\ttype:'image',
\tgallery: {
\t\tenabled: true
\t},
\tcallbacks: {
\t  elementParse: function(item) {
\t\tif(item.el['0'].className.match('dropzone-video')) {
\t\t   item.type = 'iframe';
\t\t} else {
\t\t   item.type = 'image';
\t\t}
\t  }
\t}
  });
}
</script>
";
    }

    public function getTemplateName()
    {
        return "view/template/catalog/vehicle4parts_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1407 => 763,  1362 => 723,  1351 => 715,  1323 => 692,  1311 => 685,  1164 => 543,  1140 => 524,  1134 => 520,  1125 => 518,  1121 => 517,  1093 => 491,  1085 => 489,  1079 => 486,  1072 => 482,  1065 => 478,  1058 => 474,  1051 => 470,  1044 => 466,  1037 => 462,  1030 => 458,  1023 => 454,  1016 => 450,  1009 => 446,  1002 => 442,  995 => 438,  990 => 435,  986 => 434,  922 => 372,  916 => 371,  910 => 368,  905 => 367,  902 => 366,  898 => 365,  871 => 343,  858 => 333,  851 => 329,  843 => 323,  821 => 307,  801 => 291,  797 => 290,  782 => 278,  768 => 267,  752 => 258,  746 => 257,  743 => 256,  727 => 250,  720 => 248,  717 => 247,  711 => 245,  707 => 243,  694 => 241,  690 => 240,  687 => 239,  685 => 238,  679 => 237,  670 => 235,  664 => 234,  660 => 233,  653 => 229,  648 => 227,  643 => 225,  638 => 223,  629 => 217,  624 => 215,  619 => 213,  614 => 211,  605 => 205,  600 => 203,  595 => 201,  590 => 199,  580 => 192,  572 => 191,  560 => 189,  556 => 188,  552 => 186,  534 => 182,  529 => 180,  524 => 178,  519 => 176,  513 => 175,  509 => 173,  505 => 172,  492 => 166,  486 => 165,  480 => 162,  477 => 161,  462 => 159,  458 => 158,  450 => 153,  446 => 152,  440 => 149,  436 => 148,  430 => 145,  427 => 144,  412 => 142,  408 => 141,  400 => 136,  397 => 135,  382 => 133,  378 => 132,  370 => 127,  366 => 126,  360 => 123,  357 => 122,  342 => 120,  338 => 119,  330 => 114,  326 => 113,  320 => 110,  317 => 109,  302 => 107,  298 => 106,  290 => 101,  286 => 100,  280 => 97,  276 => 96,  270 => 93,  267 => 92,  252 => 90,  248 => 89,  240 => 84,  237 => 83,  220 => 81,  216 => 80,  208 => 75,  205 => 74,  190 => 72,  186 => 71,  178 => 66,  174 => 65,  168 => 62,  162 => 59,  153 => 54,  139 => 52,  137 => 51,  132 => 50,  119 => 48,  115 => 47,  101 => 42,  97 => 41,  90 => 37,  83 => 33,  68 => 21,  54 => 9,  46 => 5,  44 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/catalog/vehicle4parts_form.twig", "/home/partsmanager/public_html/view/template/catalog/vehicle4parts_form.twig");
    }
}
