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

/* view/template/integration/fancourier_wb_form.twig */
class __TwigTemplate_9930f702cac5207dee54c1f8436a5ce5e886705e880e7bfd88ee41eac5260381 extends Template
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
            echo "            <div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
                <button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button>
            </div>
        ";
        }
        // line 9
        echo "        <form method=\"POST\" action=\"";
        echo ($context["action"] ?? null);
        echo "\">
            <p class=\"lead text-primary\">Recipient</p>
            <div class=\"row\">
                <div class=\"col-md-6\">
                    <div class=\"form-outline mb-3\">
                        <input type=\"text\" name=\"phone1\" value=\"";
        // line 14
        echo ($context["phone1"] ?? null);
        echo "\" class=\"form-control\" />
                        <label class=\"form-label\"><span class='text-danger'>*</span> ";
        // line 15
        echo ($context["entry_phone"] ?? null);
        echo "</label>
                    </div>
                    <div class=\"d-flex align-items-center mb-3\">
                        <div class=\"form-outline me-3\">
                            <input type=\"text\" name=\"name\" value=\"";
        // line 19
        echo ($context["name"] ?? null);
        echo "\" class=\"form-control\" />
                            <label class=\"form-label\"><span class='text-danger'>*</span> ";
        // line 20
        echo ($context["entry_name"] ?? null);
        echo "</label>
                        </div>
                        <div class=\"form-check\">
                            <input class=\"form-check-input\" name=\"private\" type=\"checkbox\" value=\"1\" id=\"private\" checked/>
                            <label class=\"form-check-label\" for=\"private\">";
        // line 24
        echo ($context["entry_private"] ?? null);
        echo "</label>
                        </div>
                    </div>
                    <div id=\"contact\" class=\"form-outline d-none mb-3\">
                        <input type=\"text\" name=\"contact\" value=\"";
        // line 28
        echo ($context["contact"] ?? null);
        echo "\" class=\"form-control\" />
                        <label class=\"form-label\">";
        // line 29
        echo ($context["entry_contact"] ?? null);
        echo "</label>
                    </div>
                </div>
                <div class=\"col-md-6\">
                    <div class=\"form-outline mb-3\">
                        <input type=\"text\" name=\"phone2\" value=\"";
        // line 34
        echo ($context["phone2"] ?? null);
        echo "\" class=\"form-control\" />
                        <label class=\"form-label\">";
        // line 35
        echo ($context["entry_phone2"] ?? null);
        echo "</label>
                    </div>
                    <div class=\"form-outline mb-3\">
                        <input type=\"text\" name=\"email\" value=\"";
        // line 38
        echo ($context["email"] ?? null);
        echo "\" class=\"form-control\" />
                        <label class=\"form-label\">";
        // line 39
        echo ($context["entry_email"] ?? null);
        echo "</label>
                    </div>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"col-md-6\">
                    <div id=\"country\" class=\"form-outline autocomplete mb-3\">
                        <input type=\"text\" id=\"input-country\" name=\"country_name\" value=\"";
        // line 46
        echo ($context["country_name"] ?? null);
        echo "\" class=\"form-control\" />
                        <label class=\"form-label\" for=\"input-country\"><span class='text-danger'>*</span> ";
        // line 47
        echo ($context["select_country"] ?? null);
        echo "</label>
                    </div>
                    <input type=\"hidden\" id=\"input-country_id\" name=\"country_id\" value=\"";
        // line 49
        echo ($context["country_id"] ?? null);
        echo "\"/>
                    <input type=\"hidden\" id=\"input-address_type\" name=\"address_type\" value=\"";
        // line 50
        echo ($context["address_type"] ?? null);
        echo "\"/>
                </div>
                <div class=\"col-md-6\">
                    <div id=\"state\" class=\"form-outline autocomplete mb-3 ";
        // line 53
        if ((($context["state_id"] ?? null) == "")) {
            echo "d-none";
        }
        echo "\">
                        <input type=\"text\" id=\"input-state\" name=\"state_name\" value=\"";
        // line 54
        echo ($context["state_name"] ?? null);
        echo "\" class=\"form-control\" />
                        <label class=\"form-label\" for=\"input-state\"><span class='text-danger'>*</span> ";
        // line 55
        echo ($context["select_state"] ?? null);
        echo "</label>
                    </div>
                    <input type=\"hidden\" id=\"input-state_id\" name=\"state_id\" value=\"";
        // line 57
        echo ($context["state_id"] ?? null);
        echo "\"/>
                </div>
            </div>
            <div id=\"block-site\" class=\"row ";
        // line 60
        if ((($context["address_type"] ?? null) == "")) {
            echo "d-none";
        }
        echo "\">
                <div class=\"col-md-8\">
                    <div id=\"site\" class=\"form-outline autocomplete mb-3\">
                        <input type=\"text\" id=\"input-site\" name=\"site_name\" value=\"";
        // line 63
        echo ($context["site_name"] ?? null);
        echo "\" class=\"form-control\" />
                        <label class=\"form-label\" id=\"input-site-label\" for=\"input-site\"><span class='text-danger'>*</span> ";
        // line 64
        echo ($context["entry_site"] ?? null);
        echo "</label>
                        <input type=\"hidden\" id=\"input-site_id\" name=\"site_id\" value=\"";
        // line 65
        echo ($context["site_id"] ?? null);
        echo "\"/>
                    </div>
                </div>
                <div class=\"col-md-4\">
                    <div class=\"form-outline mb-3\">
                        <input type=\"text\" name=\"postcode\" id=\"input-postcode\" value=\"";
        // line 70
        echo ($context["postcode"] ?? null);
        echo "\" class=\"form-control\" />
                        <label class=\"form-label\"><span class='text-danger'>*</span> ";
        // line 71
        echo ($context["entry_postcode"] ?? null);
        echo "</label>
                    </div>
                </div>
            </div>
            <div id=\"address-type-1\" ";
        // line 75
        if ((($context["address_type"] ?? null) != "1")) {
            echo "class=\"d-none\"";
        }
        echo ">
                <div class=\"row\">
                    <div class=\"col d-flex\">
                        <div id=\"street\" class=\"form-outline autocomplete mb-3 me-4\">
                            <input type=\"text\" name=\"street_name\" value=\"";
        // line 79
        echo ($context["street_name"] ?? null);
        echo "\" id=\"input-street\" class=\"form-control\" ";
        if ((($context["site_id"] ?? null) == "")) {
            echo "disabled";
        }
        echo "/>
                            <label class=\"form-label\" for=\"input-street\">";
        // line 80
        echo ($context["select_street"] ?? null);
        echo "</label>
                        </div>
                        <input type=\"hidden\" id=\"input-street_id\" name=\"street_id\" value=\"";
        // line 82
        echo ($context["street_id"] ?? null);
        echo "\"/>
                        <div class=\"form-outline mb-3\" style=\"max-width: 100px;\">
                            <input type=\"text\" id=\"input-street_no\" name=\"street_no\" value=\"";
        // line 84
        echo ($context["street_no"] ?? null);
        echo "\" class=\"form-control\" ";
        if ((($context["site_id"] ?? null) == "")) {
            echo "disabled";
        }
        echo "/>
                            <label class=\"form-label\">";
        // line 85
        echo ($context["entry_street_no"] ?? null);
        echo "</label>
                        </div>
                    </div>
                </div>
                <div class=\"form-outline mb-3\">
                    <input type=\"text\" name=\"address_note\" value=\"";
        // line 90
        echo ($context["address_note"] ?? null);
        echo "\" class=\"form-control\" />
                    <label class=\"form-label\">";
        // line 91
        echo ($context["entry_address_note"] ?? null);
        echo "</label>
                </div>
            </div>
            <div id=\"address-type-2\" ";
        // line 94
        if ((($context["address_type"] ?? null) != "2")) {
            echo "class=\"d-none\"";
        }
        echo ">
                <div id=\"address1\" class=\"form-outline mb-3\">
                    <input type=\"text\" name=\"address1\" value=\"";
        // line 96
        echo ($context["address1"] ?? null);
        echo "\" class=\"form-control\" />
                    <label class=\"form-label\"><span class='text-danger'>*</span> ";
        // line 97
        echo ($context["entry_address1"] ?? null);
        echo "</label>
                </div>
                <div id=\"address2\" class=\"form-outline mb-3\">
                    <input type=\"text\" name=\"address2\" value=\"";
        // line 100
        echo ($context["address2"] ?? null);
        echo "\" class=\"form-control\" />
                    <label class=\"form-label\">";
        // line 101
        echo ($context["entry_address2"] ?? null);
        echo "</label>
                </div>
            </div>
            <p class=\"lead text-primary\">Shipment details</p>
            <div class=\"mb-3\">
                <select class=\"select\" name=\"pickup_date\">
                    <option value=\"\">";
        // line 107
        echo ($context["option_default"] ?? null);
        echo "</option>
                    ";
        // line 108
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["pickup_dates"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["date"]) {
            // line 109
            echo "                        <option value=\"";
            echo $context["date"];
            echo "\" ";
            if (($context["date"] == ($context["pickup_date"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo $context["date"];
            echo "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['date'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 111
        echo "                </select>
                <label class=\"form-label select-label\">";
        // line 112
        echo ($context["select_pickup_date"] ?? null);
        echo "</label>
            </div>
            <div class=\"mb-3\">
                <select class=\"select\" id=\"select-service_id\" name=\"service_id\">
                    <option value=\"\"></option>
                    ";
        // line 117
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["services"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["service"]) {
            // line 118
            echo "                        <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["service"], "id", [], "any", false, false, false, 118);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["service"], "id", [], "any", false, false, false, 118) == ($context["service_id"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["service"], "nameEn", [], "any", false, false, false, 118);
            echo "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['service'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 120
        echo "                </select>
                <label class=\"form-label select-label\"><span class='text-danger'>*</span> ";
        // line 121
        echo ($context["select_service"] ?? null);
        echo "</label>
            </div>
            <div class=\"mb-3\">
                <div class=\"form-outline\">
                    <input type=\"number\" id=\"input-cod\" name=\"cod\" value=\"";
        // line 125
        echo ($context["cod"] ?? null);
        echo "\" class=\"form-control\" disabled/>
                    <label class=\"form-label\">";
        // line 126
        echo ($context["entry_cod"] ?? null);
        echo "</label>
                </div>
            </div>
            <div class=\"mb-3\">
                <select id=\"select-service_payer\" class=\"select\" name=\"service_payer\">
                    <option value=\"SENDER\" ";
        // line 131
        if ((($context["service_payer"] ?? null) == ($context["SENDER"] ?? null))) {
            echo "selected";
        }
        echo ">";
        echo ($context["option_sender"] ?? null);
        echo "</option>
                    <option value=\"RECIPIENT ";
        // line 132
        if ((($context["service_payer"] ?? null) == ($context["RECIPIENT"] ?? null))) {
            echo "selected";
        }
        echo "\">";
        echo ($context["option_recipient"] ?? null);
        echo "</option>
                    ";
        // line 133
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["clients"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["client"]) {
            // line 134
            echo "                        <option value=\"";
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
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['client'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 136
        echo "                </select>
                <label class=\"form-label select-label\"><span class='text-danger'>*</span> ";
        // line 137
        echo ($context["select_service_payer"] ?? null);
        echo "</label>
            </div>
            <div class=\"mb-3\">
                <div id=\"contents\" class=\"form-outline\">
                    <input type=\"text\" name=\"contents\" value=\"";
        // line 141
        echo ($context["contents"] ?? null);
        echo "\" class=\"form-control\" />
                    <label class=\"form-label\"><span class='text-danger'>*</span> ";
        // line 142
        echo ($context["entry_contents"] ?? null);
        echo "</label>
                </div>
            </div>
            <div class=\"mb-3\">
                <div id=\"package\" class=\"form-outline\">
                    <input type=\"text\" name=\"package\" value=\"";
        // line 147
        echo ($context["package"] ?? null);
        echo "\" class=\"form-control\" />
                    <label class=\"form-label\"><span class='text-danger'>*</span> ";
        // line 148
        echo ($context["entry_package"] ?? null);
        echo "</label>
                </div>
            </div>
            <div class=\"mb-3\">
                <div id=\"parcels_count\" class=\"form-outline\">
                    <input type=\"number\" name=\"parcels_count\" value=\"";
        // line 153
        echo ($context["parcels_count"] ?? null);
        echo "\" class=\"form-control\" />
                    <label class=\"form-label\"><span class='text-danger'>*</span> ";
        // line 154
        echo ($context["entry_parcels_count"] ?? null);
        echo "</label>
                </div>
            </div>
            <div class=\"mb-3\">
                <div id=\"total_weight\" class=\"form-outline\">
                    <input type=\"number\" step=\"0.001\" min=\"0\" name=\"total_weight\" value=\"";
        // line 159
        echo ($context["total_weight"] ?? null);
        echo "\" class=\"form-control\" />
                    <label class=\"form-label\"><span class='text-danger'>*</span> ";
        // line 160
        echo ($context["entry_total_weight"] ?? null);
        echo "</label>
                </div>
            </div>
            <div class=\"mb-3\">
                <div class=\"form-outline\">
                    <textarea name=\"note\" rows=\"3\" class=\"form-control\">";
        // line 165
        echo ($context["note"] ?? null);
        echo "</textarea>
                    <label class=\"form-label\">";
        // line 166
        echo ($context["entry_note"] ?? null);
        echo "</label>
                </div>
            </div>
            <button type=\"submit\" class=\"btn btn-primary ps-5 pe-5 mb-3\"><i class=\"fa fa-save me-2\"></i>";
        // line 169
        echo ($context["button_save"] ?? null);
        echo "</button>
            <a href=\"";
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
            if (\$('#input-site').val() !== siteVal) {
                \$('#input-site_id').val('');
            }

            const url = `";
        // line 189
        echo ($context["server"] ?? null);
        echo "index.php?route=integration/delivery/fancourier.getSites&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&country_id=\${encodeURI(\$('#input-country_id').val())}&search=\${encodeURI(query)}`;
            const response = await fetch(url);
            const data = await response.json();

            if (data.sites !== undefined) {
                return data.sites;
            } else {
                return [];
            }
        };

        let siteAutocompleteInstance = null;

        if (siteNomen == 1) {
            siteAutocompleteInstance = new mdb.Autocomplete(siteAutocomplete, {
                filter: siteFilter,
                noResults: '',
                threshold: 1,
                displayValue: (value) => value.name
            });
        }

        \$('#site').on('itemSelect.mdb.autocomplete', function(e) {
            \$('#input-site_id').val(e.value.id);
            \$('#input-street').attr('disabled', false);
            \$('#input-street_no').attr('disabled', false);
            siteVal = e.value.value;

            window.setTimeout(function() {
                \$('#input-site').val(e.value.value);
            }, 50);
        });

        \$('#input-site').focusout(function() {
            if (\$('#input-site_id').val() == '' && siteNomen == 1) {
                \$('#input-site').val('');
            }
        });

        const countryAutocomplete = document.querySelector('#country');

        const countryFilter = async (query) => {
            if (\$('#input-country').val() !== countryVal) {
                \$('#input-country_id').val('');
            }

            const url = `";
        // line 235
        echo ($context["server"] ?? null);
        echo "index.php?route=integration/delivery/fancourier.getCountries&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&search=\${encodeURI(query)}`;
            const response = await fetch(url);
            const data = await response.json();

            if (data.countries !== undefined) {
                return data.countries;
            } else {
                return [];
            }
        };

        new mdb.Autocomplete(countryAutocomplete, {
            filter: countryFilter,
            noResults: '',
            threshold: 1,
            displayValue: (value) => value.nameEn
        });

        \$('#country').on('itemSelect.mdb.autocomplete', function(e) {
            \$('#input-country_id').val(e.value.id);
            countryVal = e.value.nameEn;

            \$('#input-state_id').val('');
            \$('#input-site_id').val('');

            \$('#input-postcode').attr('value', '');
            \$('#input-postcode').removeClass('active');

            window.setTimeout(function() {
                \$('#input-site').val('');
                \$('#input-site').removeClass('active');
                \$('#input-site-label').removeClass('active');
            }, 50);

            if (e.value.requireState == true) {
                \$('#state').removeClass('d-none');
            } else {
                \$('#state').addClass('d-none');
            }

            \$('#block-site').removeClass('d-none');

            if (e.value.siteNomen == 1) {
                siteNomen = 1;

                siteAutocompleteInstance = new mdb.Autocomplete(siteAutocomplete, {
                    filter: siteFilter,
                    noResults: '',
                    threshold: 1,
                    displayValue: (value) => value.name
                });
            } else {
                siteNomen = 0;
                siteAutocompleteInstance.dispose();
            }

            let addressType = e.value.addressType;

            if (addressType == 1) {
                \$('#address-type-1').removeClass('d-none');
                \$('#address-type-2').addClass('d-none');
            } else {
                \$('#address-type-1').addClass('d-none');
                \$('#address-type-2').removeClass('d-none');
            }

            \$('#input-address_type').val(addressType);
        });

        \$('#input-country').focusout(function() {
            if (\$('#input-country_id').val() == '') {
                \$('#input-country').val('');
            }
        });

        const stateAutocomplete = document.querySelector('#state');

        const stateFilter = async (query) => {
            const url = `";
        // line 313
        echo ($context["server"] ?? null);
        echo "index.php?route=integration/delivery/fancourier.getStates&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&country_id=\${encodeURI(\$('#input-country_id').val())}&search=\${encodeURI(query)}`;
            const response = await fetch(url);
            const data = await response.json();

            if (data.states !== undefined) {
                return data.states;
            } else {
                return [];
            }
        };

        new mdb.Autocomplete(stateAutocomplete, {
            filter: stateFilter,
            noResults: '',
            threshold: 1,
            displayValue: (value) => value.name
        });

        \$('#state').on('itemSelect.mdb.autocomplete', function(e) {
            \$('#input-state_id').val(e.value.id);
        });

        \$('#input-state').focusout(function() {
            if (\$('#input-state_id').val() == '') {
                \$('#input-state').val('');
            }
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
            const url = `";
        // line 352
        echo ($context["server"] ?? null);
        echo "index.php?route=integration/delivery/fancourier.getStreets&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&site_id=\${encodeURI(\$('#input-site_id').val())}&search=\${encodeURI(query)}`;
            const response = await fetch(url);
            const data = await response.json();

            if (data.streets !== undefined) {
                return data.streets;
            } else {
                return [];
            }
        };

        new mdb.Autocomplete(streetAutocomplete, {
            filter: streetFilter,
            noResults: '',
            threshold: 1,
            displayValue: (value) => value.name
        });

        \$('#street').on('itemSelect.mdb.autocomplete', function(e) {
            \$('#input-street_id').val(e.value.id);

            window.setTimeout(function() {
                \$('#input-street').val(e.value.value);
            }, 50);
        });

        /*\$('#input-street').focusout(function() {
          if (\$('#input-street_id').val() == '') {
            \$('#input-street').val('');
          }
        });*/

        \$('#private').on('change', function(e) {
            if (\$('#private').prop('checked')) {
                \$('#contact').addClass('d-none');
            } else {
                \$('#contact').removeClass('d-none');
            }
        });

        \$('#select-service_id').change(function() {
            let service_id = \$('#select-service_id').val();
            let service_data = false;

            for (key in services) {
                if (services[key]['id'] == service_id) {
                    service_data = services[key];
                    break;
                }
            }

            if (service_data == false) {
                return;
            }

            if (service_data['additionalServices']['cod']['allowance'] === 'ALLOWED') {
                \$('#input-cod').attr('disabled', false);
            } else {
                \$('#input-cod').val('');
                \$('#input-cod').removeClass('active');
                \$('#input-cod').attr('disabled', true);
            }
        });

        \$('#select-service_id').trigger('change');

        const contentsAutocomplete = document.querySelector('#contents');
        const contentsData = ['AUTO PARTS', 'ELECTRONICS'];

        const contentsFilter = (value) => {
            return contentsData.filter((item) => {
                return item.toLowerCase().startsWith(value.toLowerCase());
            });
        };

        new mdb.Autocomplete(contentsAutocomplete, {
            filter: contentsFilter
        });

        const packageAutocomplete = document.querySelector('#package');
        const packageData = ['CARTON BOX', 'PALLET', 'ENVELOPE', 'BAG', 'BOX', 'FOIL'];

        const packageFilter = (value) => {
            return packageData.filter((item) => {
                return item.toLowerCase().startsWith(value.toLowerCase());
            });
        };

        new mdb.Autocomplete(packageAutocomplete, {
            filter: packageFilter
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
        return "view/template/integration/fancourier_wb_form.twig";
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
        return new Source("", "view/template/integration/fancourier_wb_form.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/integration/fancourier_wb_form.twig");
    }
}
