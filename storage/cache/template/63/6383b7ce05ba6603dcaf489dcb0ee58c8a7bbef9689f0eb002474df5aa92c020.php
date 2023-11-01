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

/* view/template/sale/order_list.twig */
class __TwigTemplate_dec27a040823f664d0368800be9f3adf2e910503d06eb04dac667f3b869d73ab extends Template
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
\t  <div class=\"flex-fill d-flex align-items-center position-relative me-3\">
\t\t<div id=\"search\" class=\"form-outline\">
\t\t  <input type=\"text\" name=\"search\" value=\"";
        // line 18
        echo ($context["search"] ?? null);
        echo "\" class=\"form-control\" />
\t\t  <label class=\"form-label\">";
        // line 19
        echo ($context["text_search"] ?? null);
        echo "</label>
\t\t</div>
\t\t<button type=\"button\" id=\"btn-search\" class=\"btn btn-outline-primary fs-7 border-0 position-absolute ps-3 pe-3 h-100\" style=\"top: 0; right: 0;\" data-mdb-color=\"dark\"><i class=\"fas fa-search\"></i></button>
\t  </div>
\t  <div><a href=\"";
        // line 23
        echo ($context["add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fas fa-plus\"></i><span class=\"ms-2\">";
        echo ($context["button_add"] ?? null);
        echo "</span></a></div>
\t</div>
\t<div class=\"row\">
\t  <div class=\"col-12 col-md-6 col-lg-3 mt-3\">
\t\t<select class=\"select\" name=\"filter_order_status_id\" id=\"input-order-status\" class=\"form-control\">
\t\t  <option value=\"\"></option>
\t\t  ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 30
            echo "\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 30) == ($context["filter_order_status_id"] ?? null))) {
                // line 31
                echo "\t\t  <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 31);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 31);
                echo "</option>
\t\t  ";
            } else {
                // line 33
                echo "\t\t  <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 33);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 33);
                echo "</option>
\t\t  ";
            }
            // line 35
            echo "\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo "            
\t\t</select>
\t\t<label class=\"form-label select-label\">";
        // line 37
        echo ($context["select_order_status"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"col-12 col-md-6 col-lg-3 mt-3\">
\t\t<select class=\"select\" name=\"filter_onlineshop\" id=\"input-onlineshop\" class=\"form-control\">
\t\t  <option value=\"\"></option>
\t\t  ";
        // line 42
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["onlineshops"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["onlineshop"]) {
            // line 43
            echo "\t\t   <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["onlineshop"], "code", [], "any", false, false, false, 43);
            echo "\" ";
            if ((($context["filter_onlineshop"] ?? null) == twig_get_attribute($this->env, $this->source, $context["onlineshop"], "code", [], "any", false, false, false, 43))) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["onlineshop"], "title", [], "any", false, false, false, 43);
            echo "</option>
\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['onlineshop'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        echo " 
\t\t</select>
\t\t<label class=\"form-label select-label\">";
        // line 46
        echo ($context["select_onlineshop"] ?? null);
        echo "</label>
\t  </div>
\t  <div class=\"col-12 col-md-4 col-lg-2 mt-3\">
\t\t<div class=\"form-outline datepicker\" data-mdb-format=\"yyyy-mm-dd\">
\t\t  <input type=\"text\" name=\"filter_date_added\" value=\"";
        // line 50
        echo ($context["filter_date_added"] ?? null);
        echo "\" class=\"form-control\" id=\"input-date-added\" />
\t\t  <label for=\"input-date-added\" class=\"form-label\">";
        // line 51
        echo ($context["entry_date_added"] ?? null);
        echo "</label>
\t\t</div>
\t  </div>
\t  <div class=\"col-12 col-md-4 col-lg-2 mt-3\">
\t\t<div class=\"form-outline datepicker\" data-mdb-format=\"yyyy-mm-dd\">
\t\t  <input type=\"text\" name=\"filter_date_modified\" value=\"";
        // line 56
        echo ($context["filter_date_modified"] ?? null);
        echo "\" class=\"form-control\" id=\"input-date-modified\" />
\t\t  <label for=\"input-date-modified\" class=\"form-label\">";
        // line 57
        echo ($context["entry_date_modified"] ?? null);
        echo "</label>
\t\t</div>
\t  </div>
\t  <div class=\"col-12 col-md-4 col-lg-2 mt-3\">
\t\t<button type=\"button\" id=\"button-filter\" class=\"btn btn-outline-primary w-100\"><i class=\"fa fa-filter me-2\"></i>";
        // line 61
        echo ($context["button_filter"] ?? null);
        echo "</button>
\t  </div>
\t</div>
\t";
        // line 64
        if (($context["orders"] ?? null)) {
            // line 65
            echo "\t  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["orders"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
                // line 66
                echo "\t  <div class=\"card shadow-3 mt-3\">
\t\t<div class=\"card-body row align-items-center\">
\t\t  <div class=\"col-12 col-sm-3 col-lg-1 text-center text-sm-start\">
\t\t    <a href=\"";
                // line 69
                echo twig_get_attribute($this->env, $this->source, $context["order"], "view", [], "any", false, false, false, 69);
                echo "\" data-mdb-toggle=\"tooltip\"  title=\"";
                echo ($context["text_view"] ?? null);
                echo "\">#";
                echo twig_get_attribute($this->env, $this->source, $context["order"], "order_id", [], "any", false, false, false, 69);
                echo "</a>
\t\t\t<div class=\"d-lg-none ";
                // line 70
                if ((twig_get_attribute($this->env, $this->source, $context["order"], "order_status_id", [], "any", false, false, false, 70) == ($context["fraud_status_id"] ?? null))) {
                    echo "text-danger";
                }
                echo " ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["complete_status"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["complete_status_id"]) {
                    if ((twig_get_attribute($this->env, $this->source, $context["order"], "order_status_id", [], "any", false, false, false, 70) == $context["complete_status_id"])) {
                        echo "text-success";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['complete_status_id'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                echo " ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["processing_status"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["processing_status_id"]) {
                    if ((twig_get_attribute($this->env, $this->source, $context["order"], "order_status_id", [], "any", false, false, false, 70) == $context["processing_status_id"])) {
                        echo "text-warning";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['processing_status_id'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["order"], "order_status", [], "any", false, false, false, 70);
                echo "</div>
\t\t  </div>
\t\t  <div class=\"col-12 col-sm-5 col-lg-5 text-center text-sm-start\">";
                // line 72
                echo twig_get_attribute($this->env, $this->source, $context["order"], "customer", [], "any", false, false, false, 72);
                if (twig_get_attribute($this->env, $this->source, $context["order"], "onlineshop", [], "any", false, false, false, 72)) {
                    echo "<br/><span class=\"text-muted\">";
                    echo twig_get_attribute($this->env, $this->source, $context["order"], "onlineshop", [], "any", false, false, false, 72);
                    if (twig_get_attribute($this->env, $this->source, $context["order"], "onlineshop_order_id", [], "any", false, false, false, 72)) {
                        echo " (";
                        echo twig_get_attribute($this->env, $this->source, $context["order"], "onlineshop_order_id", [], "any", false, false, false, 72);
                        echo ")</span>";
                    }
                }
                echo "</div>
\t\t  <div class=\"col-lg-2 d-sm-none d-lg-block text-center text-sm-end text-danger\">";
                // line 73
                echo twig_get_attribute($this->env, $this->source, $context["order"], "total", [], "any", false, false, false, 73);
                echo "</div>
\t\t  <div class=\"col-lg-1 d-none d-lg-block text-center text-sm-start ";
                // line 74
                if ((twig_get_attribute($this->env, $this->source, $context["order"], "order_status_id", [], "any", false, false, false, 74) == ($context["fraud_status_id"] ?? null))) {
                    echo "text-danger";
                }
                echo " ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["complete_status"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["complete_status_id"]) {
                    if ((twig_get_attribute($this->env, $this->source, $context["order"], "order_status_id", [], "any", false, false, false, 74) == $context["complete_status_id"])) {
                        echo "text-success";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['complete_status_id'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                echo " ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["processing_status"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["processing_status_id"]) {
                    if ((twig_get_attribute($this->env, $this->source, $context["order"], "order_status_id", [], "any", false, false, false, 74) == $context["processing_status_id"])) {
                        echo "text-warning";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['processing_status_id'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["order"], "order_status", [], "any", false, false, false, 74);
                echo "</div>
\t\t  <div class=\"col-lg-1 d-none d-lg-flex text-center text-sm-end\">
\t\t    ";
                // line 76
                if (twig_get_attribute($this->env, $this->source, $context["order"], "invoice", [], "any", false, false, false, 76)) {
                    echo "<a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["order"], "invoice", [], "any", false, false, false, 76);
                    echo "\" target=\"blank\" class=\"btn btn-primary btn-sm me-1\" data-mdb-toggle=\"tooltip\" title=\"";
                    echo ($context["text_invoice"] ?? null);
                    echo "\"><i class=\"fas fa-file-invoice\"></i></a>";
                }
                // line 77
                echo "\t\t  </div>
\t\t  <div class=\"col-12 col-sm-4 col-lg-2 text-center text-sm-end text-lg-end\"><span>";
                // line 78
                echo twig_get_attribute($this->env, $this->source, $context["order"], "date_added", [], "any", false, false, false, 78);
                echo "</span><br/><span class=\"";
                if ((twig_get_attribute($this->env, $this->source, $context["order"], "order_status_id", [], "any", false, false, false, 78) == ($context["fraud_status_id"] ?? null))) {
                    echo "text-danger";
                }
                echo " ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["complete_status"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["complete_status_id"]) {
                    if ((twig_get_attribute($this->env, $this->source, $context["order"], "order_status_id", [], "any", false, false, false, 78) == $context["complete_status_id"])) {
                        echo "text-success";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['complete_status_id'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                echo " ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["processing_status"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["processing_status_id"]) {
                    if ((twig_get_attribute($this->env, $this->source, $context["order"], "order_status_id", [], "any", false, false, false, 78) == $context["processing_status_id"])) {
                        echo "text-warning";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['processing_status_id'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["order"], "date_modified", [], "any", false, false, false, 78);
                echo "</span></div>
\t\t  <div class=\"col-12 d-flex d-lg-none\">
\t\t\t<div class=\"text-start d-none d-sm-block text-danger\">";
                // line 80
                echo twig_get_attribute($this->env, $this->source, $context["order"], "total", [], "any", false, false, false, 80);
                echo "</div>
\t\t\t<div class=\"text-center text-sm-end flex-fill\">
\t\t\t  ";
                // line 82
                if (twig_get_attribute($this->env, $this->source, $context["order"], "edit", [], "any", false, false, false, 82)) {
                    echo "<a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["order"], "edit", [], "any", false, false, false, 82);
                    echo "\" class=\"me-2\"><i class=\"fas fa-edit me-2\"></i>";
                    echo ($context["text_edit"] ?? null);
                    echo "</a>";
                }
                // line 83
                echo "\t\t\t  ";
                if (twig_get_attribute($this->env, $this->source, $context["order"], "invoice", [], "any", false, false, false, 83)) {
                    echo "<a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["order"], "invoice", [], "any", false, false, false, 83);
                    echo "\"><i class=\"fas fa-file-invoice me-2\"></i>";
                    echo ($context["text_invoice"] ?? null);
                    echo "</a>";
                }
                // line 84
                echo "\t\t\t</div>
\t\t  </div>
\t\t</div>
\t  </div>
\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 89
            echo "\t";
        }
        // line 90
        echo "\t<div class=\"row mt-3\">
\t  <div class=\"col-sm-6 text-start\">";
        // line 91
        echo ($context["pagination"] ?? null);
        echo "</div>
\t  <div class=\"col-sm-6 text-end\">";
        // line 92
        echo ($context["results"] ?? null);
        echo "</div>
\t</div>
  </div>
</main>
<script>
\$(document).ready(function() {
  loading();
  
  \$.ajax({
\turl: '";
        // line 101
        echo ($context["server"] ?? null);
        echo "index.php?route=sale/order.getOrdersFromOnlineshops&user_token=";
        echo ($context["user_token"] ?? null);
        echo "',
\tdataType: 'json'
  }).done(function(json) {
\tif(json['total'] > 0) {
\t  location.reload();
\t}
\t
\tloading(false);
  });
});

\$('#button-filter').on('click', function() {
  url = '';

  let filter_order_status_id = \$('select[name=\\'filter_order_status_id\\']').val();

  if (filter_order_status_id !== '') {
\turl += '&filter_order_status_id=' + encodeURIComponent(filter_order_status_id);
  }
\t
  let filter_onlineshop = \$('select[name=\\'filter_onlineshop\\']').val();

  if (filter_onlineshop !== '') {
\turl += '&filter_onlineshop=' + encodeURIComponent(filter_onlineshop);
  }

  let filter_date_added = \$('input[name=\\'filter_date_added\\']').val();

  if (filter_date_added) {
\turl += '&filter_date_added=' + encodeURIComponent(filter_date_added);
  }

  let filter_date_modified = \$('input[name=\\'filter_date_modified\\']').val();

  if (filter_date_modified) {
\turl += '&filter_date_modified=' + encodeURIComponent(filter_date_modified);
  }

  location = '";
        // line 139
        echo ($context["server"] ?? null);
        echo "index.php?route=sale/order&user_token=";
        echo ($context["user_token"] ?? null);
        echo "' + url;
});
</script>
";
        // line 142
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "view/template/sale/order_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  440 => 142,  432 => 139,  389 => 101,  377 => 92,  373 => 91,  370 => 90,  367 => 89,  357 => 84,  348 => 83,  340 => 82,  335 => 80,  302 => 78,  299 => 77,  291 => 76,  260 => 74,  256 => 73,  243 => 72,  212 => 70,  204 => 69,  199 => 66,  194 => 65,  192 => 64,  186 => 61,  179 => 57,  175 => 56,  167 => 51,  163 => 50,  156 => 46,  152 => 44,  137 => 43,  133 => 42,  125 => 37,  116 => 35,  108 => 33,  100 => 31,  97 => 30,  93 => 29,  82 => 23,  75 => 19,  71 => 18,  66 => 15,  58 => 11,  55 => 10,  47 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/sale/order_list.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/sale/order_list.twig");
    }
}
