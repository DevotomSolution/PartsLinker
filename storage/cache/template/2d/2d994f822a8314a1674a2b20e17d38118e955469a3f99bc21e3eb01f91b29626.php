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

/* view/template/catalog/cart.twig */
class __TwigTemplate_720433bce681a1b77eaa7430430d6021ad25ccee907e8e67cef7cc31c8e1f5b2 extends Template
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
        echo "<div class=\"dropdown\">
  <button class=\"btn btn-link position-relative\" type=\"button\" data-mdb-toggle=\"dropdown\" aria-expanded=\"false\">
\t<i class=\"fas fa-shopping-cart fs-5\"></i>
\t<span id=\"cart-total\" style=\"position: absolute; top: 5px; right: 13px;\" class=\"badge bg-danger ms-2\">";
        // line 4
        echo ($context["cart_total"] ?? null);
        echo "</span>
  </button>
  <ul id=\"cart-products\" class=\"dropdown-menu dropdown-menu-end\" style=\"width: 320px;\">
\t";
        // line 7
        if (($context["cart_products"] ?? null)) {
            // line 8
            echo "\t  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["cart_products"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 9
                echo "\t  <li id=\"cart-product";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 9);
                echo "\" class=\"pb-3\">
\t    <div class=\"d-flex align-items-center pe-3 ps-3\">
\t\t  <div class=\"flex-fill\">
\t\t    <img src=\"";
                // line 12
                echo twig_get_attribute($this->env, $this->source, $context["product"], "image", [], "any", false, false, false, 12);
                echo "\" height=\"40px\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 12);
                echo "\"/>
\t\t\t<a href=\"";
                // line 13
                echo twig_get_attribute($this->env, $this->source, $context["product"], "link", [], "any", false, false, false, 13);
                echo "\" target=\"blank\">";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 13);
                echo "</a>
\t\t  </div>
\t\t  <div>
\t\t\t<span>";
                // line 16
                echo twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 16);
                echo "x";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "price_formated", [], "any", false, false, false, 16);
                echo "</span>
\t\t\t<a data-sku=\"";
                // line 17
                echo twig_get_attribute($this->env, $this->source, $context["product"], "sku", [], "any", false, false, false, 17);
                echo "\" class=\"cart-remove text-danger ms-3 me-1\" style=\"cursor: pointer;\"><i class=\"fas fa-times\"></i></a>
\t\t  </div>
\t\t</div>
\t  </li>
\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            echo "\t";
        }
        // line 23
        echo "\t<li class=\"text-end p-3\"><a class=\"btn btn-primary\" href=\"";
        echo ($context["add_order"] ?? null);
        echo "\">";
        echo ($context["button_add_order"] ?? null);
        echo "</a></li>
  </ul>
</div>
<script>
\$(document).ready(function() {
\t\$('.btn-cart').click(function(e) {
\t  \$.ajax({
\t\turl: '";
        // line 30
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/cart.add&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&sku=' +  e.currentTarget.attributes['data-sku'].value,
\t\tdataType: 'json',
\t\tsuccess: function(json) {
\t\t  if(json['total'] !== undefined) {
\t\t\t\$('#cart-total').html(json['total']);
\t\t  }
\t\t\t
\t\t  if(json['product'] !== undefined) {
\t\t\t\$('#cart-product'+json['product']['sku']).remove();
\t\t
\t\t\tlet html = '';
\t\t\t
\t\t\thtml += '<li id=\"cart-product'+json['product']['sku']+'\" class=\"pb-3\">';
\t\t\t  html += '<div class=\"d-flex align-items-center pe-3 ps-3\">';
\t\t\t\thtml += '<div class=\"flex-fill\">';
\t\t\t\t  html += '<img src=\"'+json['product']['image']+'\" height=\"40px\" alt=\"'+json['product']['name']+'\"/>';
\t\t\t\t  html += '<a href=\"'+json['product']['link']+'\" target=\"blank\">'+json['product']['name']+'</a>';
\t\t\t\thtml += '</div>';
\t\t\t\thtml += '<div>';
\t\t\t\t  html += '<span>'+json['product']['quantity']+'x'+json['product']['price_formated']+'</span>';
\t\t\t\t  html += '<a data-sku=\"'+json['product']['sku']+'\" class=\"cart-remove text-danger ms-3 me-1\" style=\"cursor: pointer;\"><i class=\"fas fa-times\"></i></a>';
\t\t\t\thtml += '</div>';
\t\t\t  html += '</div>';
\t\t\thtml += '</li>';
\t\t\t\t
\t\t\t\$('#cart-products').prepend(html);
\t\t\t\t
\t\t\t\$('.cart-remove').click(function(e) {
\t\t\t  \$.ajax({
\t\t\t\turl: '";
        // line 59
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/cart.remove&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&sku=' +  e.currentTarget.attributes['data-sku'].value,
\t\t\t\tdataType: 'json',
\t\t\t\tsuccess: function(json) {
\t\t\t\t\tif(json['total'] !== undefined) {
\t\t\t\t\t\t\$('#cart-total').html(json['total']);
\t\t\t\t\t}
\t\t\t\t}
\t\t\t  });
\t\t\t  e.currentTarget.parentNode.parentNode.remove();
\t\t\t  return false;
\t\t\t});
\t\t  }
\t\t}
\t  });
\t});

\t\$('.cart-remove').click(function(e) {
\t  \$.ajax({
\t\turl: '";
        // line 77
        echo ($context["server"] ?? null);
        echo "index.php?route=catalog/cart.remove&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&sku=' +  e.currentTarget.attributes['data-sku'].value,
\t\tdataType: 'json',
\t\tsuccess: function(json) {
\t\t\tif(json['total'] !== undefined) {
\t\t\t\t\$('#cart-total').html(json['total']);
\t\t\t}
\t\t}
\t  });
\t  e.currentTarget.parentNode.parentNode.remove();
\t  return false;
\t});
});
</script>";
    }

    public function getTemplateName()
    {
        return "view/template/catalog/cart.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  166 => 77,  143 => 59,  109 => 30,  96 => 23,  93 => 22,  82 => 17,  76 => 16,  68 => 13,  62 => 12,  55 => 9,  50 => 8,  48 => 7,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/catalog/cart.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/catalog/cart.twig");
    }
}
