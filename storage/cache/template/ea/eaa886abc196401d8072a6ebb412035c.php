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

/* view/template/sale/order_invoice2.twig */
class __TwigTemplate_19797589b0b398ab87e0013ee01a8ac2 extends Template
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
        echo "<!DOCTYPE html>
<style>
#invoice-container {
\theight: 100vh;
}
</style>
<html dir=\"";
        // line 7
        echo ($context["direction"] ?? null);
        echo "\" lang=\"";
        echo ($context["lang"] ?? null);
        echo "\">
<head>
<meta charset=\"UTF-8\" />
<title>";
        // line 10
        echo ($context["title"] ?? null);
        echo "</title>
<base href=\"";
        // line 11
        echo ($context["base"] ?? null);
        echo "\" />
<link rel=\"stylesheet\" href=\"view/css/mdb.min.css\" />
</head>
<body>
<div id=\"invoice-container\" class=\"container-xxl d-flex flex-column\">
  <div class=\"row\">
\t<div class=\"col-3 d-flex align-items-center justify-content-center\">
\t  <img src=\"";
        // line 18
        echo ($context["logo"] ?? null);
        echo "\" class=\"mw-100\" />
\t</div>
\t<div class=\"col-9\">
\t  <div class=\"row\">
\t\t<div class=\"col\">
\t\t  <h2>";
        // line 23
        echo ($context["store_name"] ?? null);
        echo "</h2>
\t\t  <hr class=\"mt-0 mb-2\" />
\t\t  <p class=\"mb-0\">";
        // line 25
        echo ($context["store_address"] ?? null);
        echo "</p>
\t\t  <p class=\"mb-0\">";
        // line 26
        echo ($context["text_email"] ?? null);
        echo " ";
        echo ($context["user_email"] ?? null);
        echo "</p>
\t\t  <p>";
        // line 27
        echo ($context["user_vat"] ?? null);
        echo "</p>
\t\t</div>
\t  </div>
\t</div>
  </div>
  <div class=\"row\">
\t<div class=\"col-6\"><hr/></div>
\t<div class=\"col-6 d-flex align-items-center justify-content-end\">
\t  <span>";
        // line 35
        echo ($context["text_invoice_no"] ?? null);
        echo "</span>
\t  <div class=\"border ms-2 ps-2 pe-2 pt-1 pb-1\"><strong>";
        // line 36
        echo ($context["invoice_no"] ?? null);
        echo "</strong></div>
\t  <span class=\"ms-2\">";
        // line 37
        echo ($context["text_date"] ?? null);
        echo "</span>
\t  <div class=\"border ms-2 ps-2 pe-2 pt-1 pb-1\"><strong>";
        // line 38
        echo ($context["date_added"] ?? null);
        echo "</strong></div>
\t</div>
  </div>
  <div class=\"row align-items-stretch mt-3\">
    <div class=\"col-6 d-flex flex-column\">
\t  <strong>";
        // line 43
        echo ($context["text_recipient"] ?? null);
        echo "</strong>
\t  <div class=\"border flex-fill p-2\">";
        // line 44
        echo ($context["recepient"] ?? null);
        echo "</div>
\t</div>
\t<div class=\"col-6 d-flex flex-column\">
\t  <strong>";
        // line 47
        echo ($context["text_payment_method"] ?? null);
        echo "</strong>
\t  <div class=\"border flex-fill p-2\">";
        // line 48
        echo ($context["payment_method"] ?? null);
        echo "</div>
\t</div>
  </div>
  <table class=\"table table-sm table-borderless mt-3 mb-0\">
\t<thead>
      <tr class=\"border-bottom\">
        <th><strong>";
        // line 54
        echo ($context["column_sku"] ?? null);
        echo "</strong></th>
        <th><strong>";
        // line 55
        echo ($context["column_name"] ?? null);
        echo "</strong></th>
        <th class=\"text-center\"><strong>";
        // line 56
        echo ($context["column_quantity"] ?? null);
        echo "</strong></th>
        <th class=\"text-end\"><strong>";
        // line 57
        echo ($context["column_price"] ?? null);
        echo "</strong></th>
        <th class=\"text-end\"><strong>";
        // line 58
        echo ($context["column_total"] ?? null);
        echo "</strong></th>
        <th class=\"text-end\"><strong>";
        // line 59
        echo ($context["column_tax"] ?? null);
        echo "</strong></th>
      </tr>
    </thead>
\t<tbody>
\t";
        // line 63
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_product"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 64
            echo "\t  <tr>
\t\t<td>";
            // line 65
            echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 65);
            echo "</td>
\t\t<td>";
            // line 66
            echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 66);
            echo "</td>
\t\t<td class=\"text-center\">";
            // line 67
            echo twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 67);
            echo "</td>
\t\t<td class=\"text-end\">";
            // line 68
            echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 68);
            echo "</td>
\t\t<td class=\"text-end\">";
            // line 69
            echo twig_get_attribute($this->env, $this->source, $context["product"], "total", [], "any", false, false, false, 69);
            echo "</td>
\t\t<td class=\"text-end\">";
            // line 70
            echo ($context["tax"] ?? null);
            echo "%</td>
\t  </tr>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 73
        echo "\t</tbody>
  </table>
  <div class=\"flex-fill d-flex flex-column justify-content-end\">
    <div class=\"row border-top border-bottom ms-0 me-0\">
\t  <div class=\"col-7 pt-2 border-end\">
\t    
\t  </div>
\t  <div class=\"col-5 pt-2\">
\t\t";
        // line 81
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_totals"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_total"]) {
            // line 82
            echo "\t\t";
            if ((twig_get_attribute($this->env, $this->source, $context["order_total"], "code", [], "any", false, false, false, 82) != "total")) {
                // line 83
                echo "\t\t<div class=\"d-flex pb-2\">
\t\t  <div>";
                // line 84
                echo twig_get_attribute($this->env, $this->source, $context["order_total"], "title", [], "any", false, false, false, 84);
                echo "</div>
\t\t  <div class=\"text-end flex-fill\">";
                // line 85
                echo twig_get_attribute($this->env, $this->source, $context["order_total"], "text", [], "any", false, false, false, 85);
                echo "</div>
\t\t</div>
\t\t";
            }
            // line 88
            echo "\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_total'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 89
        echo "\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_totals"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_total"]) {
            // line 90
            echo "\t\t";
            if ((twig_get_attribute($this->env, $this->source, $context["order_total"], "code", [], "any", false, false, false, 90) == "total")) {
                // line 91
                echo "\t\t<div class=\"d-flex border-top pt-2\">
\t\t  <div class=\"h3\">";
                // line 92
                echo twig_get_attribute($this->env, $this->source, $context["order_total"], "title", [], "any", false, false, false, 92);
                echo "</div>
\t\t  <div class=\"text-end flex-fill h3\">";
                // line 93
                echo twig_get_attribute($this->env, $this->source, $context["order_total"], "text", [], "any", false, false, false, 93);
                echo "</div>
\t\t</div>
\t\t";
            }
            // line 96
            echo "\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_total'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 97
        echo "\t  </div>
\t</div>
  </div>
</div>
</body>
</html>
<script>
window.print();
</script>
";
    }

    public function getTemplateName()
    {
        return "view/template/sale/order_invoice2.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  270 => 97,  264 => 96,  258 => 93,  254 => 92,  251 => 91,  248 => 90,  243 => 89,  237 => 88,  231 => 85,  227 => 84,  224 => 83,  221 => 82,  217 => 81,  207 => 73,  198 => 70,  194 => 69,  190 => 68,  186 => 67,  182 => 66,  178 => 65,  175 => 64,  171 => 63,  164 => 59,  160 => 58,  156 => 57,  152 => 56,  148 => 55,  144 => 54,  135 => 48,  131 => 47,  125 => 44,  121 => 43,  113 => 38,  109 => 37,  105 => 36,  101 => 35,  90 => 27,  84 => 26,  80 => 25,  75 => 23,  67 => 18,  57 => 11,  53 => 10,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/sale/order_invoice2.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/sale/order_invoice2.twig");
    }
}
