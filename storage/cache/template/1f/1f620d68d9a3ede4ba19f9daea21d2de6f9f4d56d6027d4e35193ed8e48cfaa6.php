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

/* view/template/integration/dpd_wb_form.twig */
class __TwigTemplate_62df97891b3d18d439aa42eeb7201713882c6844391bfadba90642e2d593620e extends Template
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
            echo "\t<div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
\t  <button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button>
\t</div>
  ";
        }
        // line 9
        echo "  <form method=\"POST\" action=\"";
        echo ($context["action"] ?? null);
        echo "\">
    <p class=\"lead text-primary\">Recipient</p>
\t<div class=\"row\">
\t  <div class=\"col-md-6\">
\t    <div class=\"form-outline mb-3\">
\t\t  <input type=\"text\" name=\"phone1\" value=\"";
        // line 14
        echo ($context["phone1"] ?? null);
        echo "\" class=\"form-control\" />
\t\t  <label class=\"form-label\"><span class='text-danger'>*</span> ";
        // line 15
        echo ($context["entry_phone"] ?? null);
        echo "</label>
\t\t</div>
\t\t<div class=\"d-flex align-items-center mb-3\">
\t\t  <div class=\"form-outline me-3\">
\t\t\t<input type=\"text\" name=\"name\" value=\"";
        // line 19
        echo ($context["name"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t<label class=\"form-label\"><span class='text-danger'>*</span> ";
        // line 20
        echo ($context["entry_name"] ?? null);
        echo "</label>
\t\t  </div>
\t\t  <div class=\"form-check\">
\t\t\t<input class=\"form-check-input\" name=\"private\" type=\"checkbox\" value=\"1\" id=\"private\" checked/>
\t\t\t<label class=\"form-check-label\" for=\"private\">";
        // line 24
        echo ($context["entry_private"] ?? null);
        echo "</label>
\t\t  </div>
\t\t</div>
\t\t<div id=\"contact\" class=\"form-outline d-none mb-3\">
\t\t  <input type=\"text\" name=\"contact\" value=\"";
        // line 28
        echo ($context["contact"] ?? null);
        echo "\" class=\"form-control\" />
\t\t  <label class=\"form-label\">";
        // line 29
        echo ($context["entry_contact"] ?? null);
        echo "</label>
\t\t</div>
\t  </div>
\t  <div class=\"col-md-6\">
\t    <div class=\"form-outline mb-3\">
\t\t  <input type=\"text\" name=\"phone2\" value=\"";
        // line 34
        echo ($context["phone2"] ?? null);
        echo "\" class=\"form-control\" />
\t\t  <label class=\"form-label\">";
        // line 35
        echo ($context["entry_phone2"] ?? null);
        echo "</label>
\t\t</div>
\t\t<div class=\"form-outline mb-3\">
\t\t  <input type=\"text\" name=\"email\" value=\"";
        // line 38
        echo ($context["email"] ?? null);
        echo "\" class=\"form-control\" />
\t\t  <label class=\"form-label\">";
        // line 39
        echo ($context["entry_email"] ?? null);
        echo "</label>
\t\t</div>
\t  </div>
\t</div>
\t<div class=\"row\">
\t  <div class=\"col-md-6\">
\t    <div id=\"country\" class=\"form-outline autocomplete mb-3\">
\t\t  <input type=\"text\" id=\"input-country\" name=\"country_name\" value=\"";
        // line 46
        echo ($context["country_name"] ?? null);
        echo "\" class=\"form-control\" />
\t\t  <label class=\"form-label\" for=\"input-country\"><span class='text-danger'>*</span> ";
        // line 47
        echo ($context["select_country"] ?? null);
        echo "</label>
\t\t</div>
\t\t<input type=\"hidden\" id=\"input-country_id\" name=\"country_id\" value=\"";
        // line 49
        echo ($context["country_id"] ?? null);
        echo "\"/>
\t\t<input type=\"hidden\" id=\"input-address_type\" name=\"address_type\" value=\"";
        // line 50
        echo ($context["address_type"] ?? null);
        echo "\"/>
\t  </div>
\t  <div class=\"col-md-6\">
\t    <div id=\"state\" class=\"form-outline autocomplete mb-3 ";
        // line 53
        if ((($context["state_id"] ?? null) == "")) {
            echo "d-none";
        }
        echo "\">
\t\t  <input type=\"text\" id=\"input-state\" name=\"state_name\" value=\"";
        // line 54
        echo ($context["state_name"] ?? null);
        echo "\" class=\"form-control\" />
\t\t  <label class=\"form-label\" for=\"input-state\"><span class='text-danger'>*</span> ";
        // line 55
        echo ($context["select_state"] ?? null);
        echo "</label>
\t\t</div>
\t\t<input type=\"hidden\" id=\"input-state_id\" name=\"state_id\" value=\"";
        // line 57
        echo ($context["state_id"] ?? null);
        echo "\"/>
\t  </div>
\t</div>
\t<div id=\"block-site\" class=\"row ";
        // line 60
        if ((($context["address_type"] ?? null) == "")) {
            echo "d-none";
        }
        echo "\">
\t  <div class=\"col-md-8\">
\t\t<div id=\"site\" class=\"form-outline autocomplete mb-3\">
\t\t  <input type=\"text\" id=\"input-site\" name=\"site_name\" value=\"";
        // line 63
        echo ($context["site_name"] ?? null);
        echo "\" class=\"form-control\" />
\t\t  <label class=\"form-label\" id=\"input-site-label\" for=\"input-site\"><span class='text-danger'>*</span> ";
        // line 64
        echo ($context["entry_site"] ?? null);
        echo "</label>
\t\t  <input type=\"hidden\" id=\"input-site_id\" name=\"site_id\" value=\"";
        // line 65
        echo ($context["site_id"] ?? null);
        echo "\"/>
\t\t</div>
\t  </div>
\t  <div class=\"col-md-4\">
\t\t<div class=\"form-outline mb-3\">
\t\t  <input type=\"text\" name=\"postcode\" id=\"input-postcode\" value=\"";
        // line 70
        echo ($context["postcode"] ?? null);
        echo "\" class=\"form-control\" />
\t\t  <label class=\"form-label\"><span class='text-danger'>*</span> ";
        // line 71
        echo ($context["entry_postcode"] ?? null);
        echo "</label>
\t\t</div>
\t  </div>
\t</div>
\t<div id=\"address-type-1\" ";
        // line 75
        if ((($context["address_type"] ?? null) != "1")) {
            echo "class=\"d-none\"";
        }
        echo ">
\t  <div class=\"row\">
\t\t<div class=\"col d-flex\">
\t\t  <div id=\"street\" class=\"form-outline autocomplete mb-3 me-4\">
\t\t\t<input type=\"text\" name=\"street_name\" value=\"";
        // line 79
        echo ($context["street_name"] ?? null);
        echo "\" id=\"input-street\" class=\"form-control\" ";
        if ((($context["site_id"] ?? null) == "")) {
            echo "disabled";
        }
        echo "/>
\t\t\t<label class=\"form-label\" for=\"input-street\">";
        // line 80
        echo ($context["select_street"] ?? null);
        echo "</label>
\t\t  </div>
\t\t  <input type=\"hidden\" id=\"input-street_id\" name=\"street_id\" value=\"";
        // line 82
        echo ($context["street_id"] ?? null);
        echo "\"/>
\t\t  <div class=\"form-outline mb-3\" style=\"max-width: 100px;\">
\t\t\t<input type=\"text\" id=\"input-street_no\" name=\"street_no\" value=\"";
        // line 84
        echo ($context["street_no"] ?? null);
        echo "\" class=\"form-control\" ";
        if ((($context["site_id"] ?? null) == "")) {
            echo "disabled";
        }
        echo "/>
\t\t\t<label class=\"form-label\">";
        // line 85
        echo ($context["entry_street_no"] ?? null);
        echo "</label>
\t\t  </div>
\t\t</div>
\t  </div>
\t  <div class=\"form-outline mb-3\">
\t\t<input type=\"text\" name=\"address_note\" value=\"";
        // line 90
        echo ($context["address_note"] ?? null);
        echo "\" class=\"form-control\" />
\t\t<label class=\"form-label\">";
        // line 91
        echo ($context["entry_address_note"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<div id=\"address-type-2\" ";
        // line 94
        if ((($context["address_type"] ?? null) != "2")) {
            echo "class=\"d-none\"";
        }
        echo ">
\t  <div id=\"address1\" class=\"form-outline mb-3\">
\t\t<input type=\"text\" name=\"address1\" value=\"";
        // line 96
        echo ($context["address1"] ?? null);
        echo "\" class=\"form-control\" />
\t\t<label class=\"form-label\"><span class='text-danger'>*</span> ";
        // line 97
        echo ($context["entry_address1"] ?? null);
        echo "</label>
\t  </div>
\t  <div id=\"address2\" class=\"form-outline mb-3\">
\t\t<input type=\"text\" name=\"address2\" value=\"";
        // line 100
        echo ($context["address2"] ?? null);
        echo "\" class=\"form-control\" />
\t\t<label class=\"form-label\">";
        // line 101
        echo ($context["entry_address2"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<p class=\"lead text-primary\">Shipment details</p>
\t<div class=\"mb-3\">
\t  <select class=\"select\" name=\"pickup_date\">
\t    <option value=\"\">";
        // line 107
        echo ($context["option_default"] ?? null);
        echo "</option>
\t\t";
        // line 108
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["pickup_dates"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["date"]) {
            // line 109
            echo "\t\t<option value=\"";
            echo $context["date"];
            echo "\" ";
            if (($context["date"] == ($context["pickup_date"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo $context["date"];
            echo "</option>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['date'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 111
        echo "\t  </select>
\t  <label class=\"form-label select-label\">";
        // line 112
        echo ($context["select_pickup_date"] ?? null);
        echo "</label>
\t</div>
\t<div class=\"mb-3\">
\t  <select class=\"select\" id=\"select-service_id\" name=\"service_id\">
\t\t<option value=\"\"></option>
\t\t";
        // line 117
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["services"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["service"]) {
            // line 118
            echo "\t\t<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["service"], "id", [], "any", false, false, false, 118);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["service"], "id", [], "any", false, false, false, 118) == ($context["service_id"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["service"], "nameEn", [], "any", false, false, false, 118);
            echo "</option>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['service'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 120
        echo "\t  </select>
\t  <label class=\"form-label select-label\"><span class='text-danger'>*</span> ";
        // line 121
        echo ($context["select_service"] ?? null);
        echo "</label>
\t</div>
\t<div class=\"mb-3\">
\t  <div class=\"form-outline\">
\t\t<input type=\"number\" id=\"input-cod\" name=\"cod\" value=\"";
        // line 125
        echo ($context["cod"] ?? null);
        echo "\" class=\"form-control\" disabled/>
\t\t<label class=\"form-label\">";
        // line 126
        echo ($context["entry_cod"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<div class=\"mb-3\">
\t  <select id=\"select-service_payer\" class=\"select\" name=\"service_payer\">
\t\t<option value=\"SENDER\" ";
        // line 131
        if ((($context["service_payer"] ?? null) == ($context["SENDER"] ?? null))) {
            echo "selected";
        }
        echo ">";
        echo ($context["option_sender"] ?? null);
        echo "</option>
\t\t<option value=\"RECIPIENT ";
        // line 132
        if ((($context["service_payer"] ?? null) == ($context["RECIPIENT"] ?? null))) {
            echo "selected";
        }
        echo "\">";
        echo ($context["option_recipient"] ?? null);
        echo "</option>
\t\t";
        // line 133
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["clients"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["client"]) {
            // line 134
            echo "\t\t<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["client"], "clientId", [], "any", false, false, false, 134);
            echo "\" ";
            if ((($context["service_payer"] ?? null) == twig_get_attribute($this->env, $this->source, $context["client"], "clientId", [], "any", false, false, false, 134))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["client"], "clientName", [], "any", false, false, false, 134);
            echo " ";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["client"], "address", [], "any", false, false, false, 134), "siteAddressString", [], "any", false, false, false, 134);
            echo "</option>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['client'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 136
        echo "\t  </select>
\t  <label class=\"form-label select-label\"><span class='text-danger'>*</span> ";
        // line 137
        echo ($context["select_service_payer"] ?? null);
        echo "</label>
\t</div>
\t<div class=\"mb-3\">
\t  <div id=\"contents\" class=\"form-outline\">
\t\t<input type=\"text\" name=\"contents\" value=\"";
        // line 141
        echo ($context["contents"] ?? null);
        echo "\" class=\"form-control\" />
\t\t<label class=\"form-label\"><span class='text-danger'>*</span> ";
        // line 142
        echo ($context["entry_contents"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<div class=\"mb-3\">
\t  <div id=\"package\" class=\"form-outline\">
\t\t<input type=\"text\" name=\"package\" value=\"";
        // line 147
        echo ($context["package"] ?? null);
        echo "\" class=\"form-control\" />
\t\t<label class=\"form-label\"><span class='text-danger'>*</span> ";
        // line 148
        echo ($context["entry_package"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<div class=\"mb-3\">
\t  <div id=\"parcels_count\" class=\"form-outline\">
\t\t<input type=\"number\" name=\"parcels_count\" value=\"";
        // line 153
        echo ($context["parcels_count"] ?? null);
        echo "\" class=\"form-control\" />
\t\t<label class=\"form-label\"><span class='text-danger'>*</span> ";
        // line 154
        echo ($context["entry_parcels_count"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<div class=\"mb-3\">
\t  <div id=\"total_weight\" class=\"form-outline\">
\t\t<input type=\"number\" step=\"0.001\" min=\"0\" name=\"total_weight\" value=\"";
        // line 159
        echo ($context["total_weight"] ?? null);
        echo "\" class=\"form-control\" />
\t\t<label class=\"form-label\"><span class='text-danger'>*</span> ";
        // line 160
        echo ($context["entry_total_weight"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<div class=\"mb-3\">
\t  <div class=\"form-outline\">
\t    <textarea name=\"note\" rows=\"3\" class=\"form-control\">";
        // line 165
        echo ($context["note"] ?? null);
        echo "</textarea>
\t\t<label class=\"form-label\">";
        // line 166
        echo ($context["entry_note"] ?? null);
        echo "</label>
\t  </div>
\t</div>
\t<button type=\"submit\" class=\"btn btn-primary ps-5 pe-5 mb-3\"><i class=\"fa fa-save me-2\"></i>";
        // line 169
        echo ($context["button_save"] ?? null);
        echo "</button>
\t<a href=\"";
        // line 170
        echo ($context["cancel"] ?? null);
        echo "\" class=\"btn btn-default mb-3\"><i class=\"fa fa-reply me-2\"></i>";
        echo ($context["button_cancel"] ?? null);
        echo "</a>
  </form>
</div>
</main>
<script>
let siteNomen = ";
        // line 175
        echo ($context["site_nomen"] ?? null);
        echo ";
let siteVal = '";
        // line 176
        echo ($context["site_name"] ?? null);
        echo "';
let countryVal = '";
        // line 177
        echo ($context["country_name"] ?? null);
        echo "';

const services = JSON.parse('";
        // line 179
        echo ($context["services_json"] ?? null);
        echo "');

\$(document).ready(function() {
  const siteAutocomplete = document.querySelector('#site');

  const siteFilter = async (query) => {
\tif (\$('#input-site').val() !== siteVal) {
\t  \$('#input-site_id').val('');
\t}
  
\tconst url = `";
        // line 189
        echo ($context["server"] ?? null);
        echo "index.php?route=integration/delivery/dpdro.getSites&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&country_id=\${encodeURI(\$('#input-country_id').val())}&search=\${encodeURI(query)}`;
\tconst response = await fetch(url);
\tconst data = await response.json();
\t
\tif (data.sites !== undefined) {
\t  return data.sites;
\t} else {
\t  return [];
\t}
  };
  
  let siteAutocompleteInstance = null;
  
  if (siteNomen == 1) {
    siteAutocompleteInstance = new mdb.Autocomplete(siteAutocomplete, {
\t  filter: siteFilter,
\t  noResults: '',
\t  threshold: 1,
\t  displayValue: (value) => value.name
\t});
  }
  
  \$('#site').on('itemSelect.mdb.autocomplete', function(e) {
\t\$('#input-site_id').val(e.value.id);
\t\$('#input-street').attr('disabled', false);
\t\$('#input-street_no').attr('disabled', false);
\tsiteVal = e.value.value;
\t
\twindow.setTimeout(function() {
\t  \$('#input-site').val(e.value.value);
\t}, 50);
  });
  
  \$('#input-site').focusout(function() {
\tif (\$('#input-site_id').val() == '' && siteNomen == 1) {
\t  \$('#input-site').val('');
\t}
  });
  
  const countryAutocomplete = document.querySelector('#country');
  
  const countryFilter = async (query) => {
    if (\$('#input-country').val() !== countryVal) {
\t  \$('#input-country_id').val('');
\t}
  
\tconst url = `";
        // line 235
        echo ($context["server"] ?? null);
        echo "index.php?route=integration/delivery/dpdro.getCountries&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&search=\${encodeURI(query)}`;
\tconst response = await fetch(url);
\tconst data = await response.json();
\t
\tif (data.countries !== undefined) {
\t  return data.countries;
\t} else {
\t  return [];
\t}
  };

  new mdb.Autocomplete(countryAutocomplete, {
\tfilter: countryFilter,
\tnoResults: '',
\tthreshold: 1,
\tdisplayValue: (value) => value.nameEn
  });
  
  \$('#country').on('itemSelect.mdb.autocomplete', function(e) {
\t\$('#input-country_id').val(e.value.id);
\tcountryVal = e.value.nameEn;
\t
\t\$('#input-state_id').val('');
\t\$('#input-site_id').val('');
\t
\t\$('#input-postcode').attr('value', '');
\t\$('#input-postcode').removeClass('active');
\t
\twindow.setTimeout(function() {
\t  \$('#input-site').val('');
\t  \$('#input-site').removeClass('active');
\t  \$('#input-site-label').removeClass('active');
\t}, 50);
\t
\tif (e.value.requireState == true) {
\t  \$('#state').removeClass('d-none');
\t} else {
\t  \$('#state').addClass('d-none');
\t}
\t
\t\$('#block-site').removeClass('d-none');
\t
\tif (e.value.siteNomen == 1) {
\t  siteNomen = 1;
\t  
\t  siteAutocompleteInstance = new mdb.Autocomplete(siteAutocomplete, {
\t\tfilter: siteFilter,
\t\tnoResults: '',
\t\tthreshold: 1,
\t\tdisplayValue: (value) => value.name
\t  });
\t} else {
\t  siteNomen = 0;
\t  siteAutocompleteInstance.dispose();
\t}
\t
\tlet addressType = e.value.addressType;
\t
\tif (addressType == 1) {
\t\t\$('#address-type-1').removeClass('d-none');
\t\t\$('#address-type-2').addClass('d-none');
\t} else {
\t\t\$('#address-type-1').addClass('d-none');
\t\t\$('#address-type-2').removeClass('d-none');
\t}
\t
\t\$('#input-address_type').val(addressType);
  });
  
  \$('#input-country').focusout(function() {
\tif (\$('#input-country_id').val() == '') {
\t  \$('#input-country').val('');
\t}
  });
  
  const stateAutocomplete = document.querySelector('#state');
  
  const stateFilter = async (query) => {
\tconst url = `";
        // line 313
        echo ($context["server"] ?? null);
        echo "index.php?route=integration/delivery/dpdro.getStates&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&country_id=\${encodeURI(\$('#input-country_id').val())}&search=\${encodeURI(query)}`;
\tconst response = await fetch(url);
\tconst data = await response.json();
\t
\tif (data.states !== undefined) {
\t  return data.states;
\t} else {
\t  return [];
\t}
  };

  new mdb.Autocomplete(stateAutocomplete, {
\tfilter: stateFilter,
\tnoResults: '',
\tthreshold: 1,
\tdisplayValue: (value) => value.name
  });
  
  \$('#state').on('itemSelect.mdb.autocomplete', function(e) {
\t\$('#input-state_id').val(e.value.id);
  });
  
  \$('#input-state').focusout(function() {
\tif (\$('#input-state_id').val() == '') {
\t  \$('#input-state').val('');
\t}
  });
  
 \$('#private').on('change', function(e) {
   if (\$('#private').prop('checked')) {
    \$('#contact').addClass('d-none');
   } else {
    \$('#contact').removeClass('d-none');
   }
  });
  
  const streetAutocomplete = document.querySelector('#street');
  
  const streetFilter = async (query) => {
\tconst url = `";
        // line 352
        echo ($context["server"] ?? null);
        echo "index.php?route=integration/delivery/dpdro.getStreets&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&site_id=\${encodeURI(\$('#input-site_id').val())}&search=\${encodeURI(query)}`;
\tconst response = await fetch(url);
\tconst data = await response.json();
\t
\tif (data.streets !== undefined) {
\t  return data.streets;
\t} else {
\t  return [];
\t}
  };

  new mdb.Autocomplete(streetAutocomplete, {
\tfilter: streetFilter,
\tnoResults: '',
\tthreshold: 1,
\tdisplayValue: (value) => value.name
  });
  
  \$('#street').on('itemSelect.mdb.autocomplete', function(e) {
\t\$('#input-street_id').val(e.value.id);
\t
\twindow.setTimeout(function() {
\t  \$('#input-street').val(e.value.value);
\t}, 50);
  });
  
  /*\$('#input-street').focusout(function() {
\tif (\$('#input-street_id').val() == '') {
\t  \$('#input-street').val('');
\t}
  });*/
  
 \$('#private').on('change', function(e) {
   if (\$('#private').prop('checked')) {
    \$('#contact').addClass('d-none');
   } else {
    \$('#contact').removeClass('d-none');
   }
  });
  
  \$('#select-service_id').change(function() {
\tlet service_id = \$('#select-service_id').val();
\tlet service_data = false;
\t
\tfor (key in services) {
\t  if (services[key]['id'] == service_id) {
\t\tservice_data = services[key];
\t\tbreak;
\t  }
\t}

\tif (service_data == false) {
\t  return;
\t}
\t
\tif (service_data['additionalServices']['cod']['allowance'] === 'ALLOWED') {
\t  \$('#input-cod').attr('disabled', false);
\t} else {
\t  \$('#input-cod').val('');
\t  \$('#input-cod').removeClass('active');
\t  \$('#input-cod').attr('disabled', true);
\t}
  });
  
  \$('#select-service_id').trigger('change');
  
  const contentsAutocomplete = document.querySelector('#contents');
  const contentsData = ['AUTO PARTS', 'ELECTRONICS'];
  
  const contentsFilter = (value) => {
\treturn contentsData.filter((item) => {
\t  return item.toLowerCase().startsWith(value.toLowerCase());
\t});
  };

  new mdb.Autocomplete(contentsAutocomplete, {
\tfilter: contentsFilter
  });
  
  const packageAutocomplete = document.querySelector('#package');
  const packageData = ['CARTON BOX', 'PALLET', 'ENVELOPE', 'BAG', 'BOX', 'FOIL'];
  
  const packageFilter = (value) => {
\treturn packageData.filter((item) => {
\t  return item.toLowerCase().startsWith(value.toLowerCase());
\t});
  };

  new mdb.Autocomplete(packageAutocomplete, {
\tfilter: packageFilter
  });
});


</script>
";
        // line 447
        echo ($context["footer"] ?? null);
        echo " ";
    }

    public function getTemplateName()
    {
        return "view/template/integration/dpd_wb_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  784 => 447,  684 => 352,  640 => 313,  557 => 235,  506 => 189,  493 => 179,  488 => 177,  484 => 176,  480 => 175,  470 => 170,  466 => 169,  460 => 166,  456 => 165,  448 => 160,  444 => 159,  436 => 154,  432 => 153,  424 => 148,  420 => 147,  412 => 142,  408 => 141,  401 => 137,  398 => 136,  381 => 134,  377 => 133,  369 => 132,  361 => 131,  353 => 126,  349 => 125,  342 => 121,  339 => 120,  324 => 118,  320 => 117,  312 => 112,  309 => 111,  294 => 109,  290 => 108,  286 => 107,  277 => 101,  273 => 100,  267 => 97,  263 => 96,  256 => 94,  250 => 91,  246 => 90,  238 => 85,  230 => 84,  225 => 82,  220 => 80,  212 => 79,  203 => 75,  196 => 71,  192 => 70,  184 => 65,  180 => 64,  176 => 63,  168 => 60,  162 => 57,  157 => 55,  153 => 54,  147 => 53,  141 => 50,  137 => 49,  132 => 47,  128 => 46,  118 => 39,  114 => 38,  108 => 35,  104 => 34,  96 => 29,  92 => 28,  85 => 24,  78 => 20,  74 => 19,  67 => 15,  63 => 14,  54 => 9,  46 => 5,  44 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/integration/dpd_wb_form.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/integration/dpd_wb_form.twig");
    }
}
