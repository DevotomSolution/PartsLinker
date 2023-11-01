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

/* view/template/integration/integration.twig */
class __TwigTemplate_3083678962b3df23a31b18b12d3bf8bf extends Template
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
            echo "\t<div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"danger\"><i class=\"fa fa-exclamation-circle me-2\"></i>";
            echo ($context["error_warning"] ?? null);
            echo "<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button></div>
  ";
        }
        // line 7
        echo "  ";
        if (($context["success"] ?? null)) {
            // line 8
            echo "\t<div class=\"alert alert-dismissible fade show\" role=\"alert\" data-mdb-color=\"success\"><i class=\"fa fa-exclamation-circle me-2\"></i>";
            echo ($context["success"] ?? null);
            echo "<button type=\"button\" class=\"btn-close\" data-mdb-dismiss=\"alert\" aria-label=\"Close\"></button></div>
  ";
        }
        // line 10
        echo "  <div>
\t<p class=\"lead text-primary\">";
        // line 11
        echo ($context["text_marketplace"] ?? null);
        echo "</p>
\t";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["marketplace"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["marketplace_data"]) {
            // line 13
            echo "\t<div class=\"d-inline-block me-3 mb-3\" style=\"height: 90px; width: 150px;\">
\t  <a class=\"btn btn-light shadow-1-strong bg-image hover-zoom p-3 w-100 h-100 position-relative\" href=\"";
            // line 14
            echo twig_get_attribute($this->env, $this->source, $context["marketplace_data"], "link", [], "any", false, false, false, 14);
            echo "\">
\t    ";
            // line 15
            if (twig_get_attribute($this->env, $this->source, $context["marketplace_data"], "active", [], "any", false, false, false, 15)) {
                // line 16
                echo "\t\t<div class=\"position-absolute text-primary fs-6\" style=\"top: 0; right: 4px;\"><i class=\"far fa-square-check\"></i></div>
\t\t";
            } else {
                // line 18
                echo "\t\t<div class=\"position-absolute text-primary fs-6\" style=\"top: 0; right: 4px;\"><i class=\"far fa-square\"></i></div>
\t\t";
            }
            // line 20
            echo "\t\t<img src=\"";
            echo twig_get_attribute($this->env, $this->source, $context["marketplace_data"], "image", [], "any", false, false, false, 20);
            echo "\" class=\"w-100 h-100\" alt=\"";
            echo twig_get_attribute($this->env, $this->source, $context["marketplace_data"], "title", [], "any", false, false, false, 20);
            echo "\"/>
\t\t<div class=\"position-absolute text-secondary\" style=\"bottom: 0; right: 4px;\">";
            // line 21
            echo twig_get_attribute($this->env, $this->source, $context["marketplace_data"], "country", [], "any", false, false, false, 21);
            echo "</div>
\t  </a>
\t</div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['marketplace_data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        echo "  </div>
  <div>
\t<p class=\"lead text-primary\">";
        // line 27
        echo ($context["text_onlineshop"] ?? null);
        echo "</p>
\t";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["onlineshop"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["onlineshop_data"]) {
            // line 29
            echo "\t<div class=\"d-inline-block me-3 mb-3\" style=\"height: 90px; width: 150px;\">
\t  <a class=\"btn btn-light shadow-1-strong bg-image hover-zoom p-3 w-100 h-100 position-relative\" href=\"";
            // line 30
            echo twig_get_attribute($this->env, $this->source, $context["onlineshop_data"], "link", [], "any", false, false, false, 30);
            echo "\">
\t\t";
            // line 31
            if (twig_get_attribute($this->env, $this->source, $context["onlineshop_data"], "active", [], "any", false, false, false, 31)) {
                // line 32
                echo "\t\t<div class=\"position-absolute text-primary fs-6\" style=\"top: 0; right: 4px;\"><i class=\"far fa-square-check\"></i></div>
\t\t";
            } else {
                // line 34
                echo "\t\t<div class=\"position-absolute text-primary fs-6\" style=\"top: 0; right: 4px;\"><i class=\"far fa-square\"></i></div>
\t\t";
            }
            // line 36
            echo "\t\t<img src=\"";
            echo twig_get_attribute($this->env, $this->source, $context["onlineshop_data"], "image", [], "any", false, false, false, 36);
            echo "\" class=\"w-100 h-100\" alt=\"";
            echo twig_get_attribute($this->env, $this->source, $context["onlineshop_data"], "title", [], "any", false, false, false, 36);
            echo "\"/>
\t\t<div class=\"position-absolute text-secondary\" style=\"bottom: 0; right: 4px;\">";
            // line 37
            echo twig_get_attribute($this->env, $this->source, $context["onlineshop_data"], "country", [], "any", false, false, false, 37);
            echo "</div>
\t  </a>
\t</div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['onlineshop_data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        echo "  </div>
  <div>
\t<p class=\"lead text-primary\">";
        // line 43
        echo ($context["text_delivery"] ?? null);
        echo "</p>
\t";
        // line 44
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["delivery"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["delivery_method"]) {
            // line 45
            echo "\t<div class=\"d-inline-block me-3 mb-3\" style=\"height: 90px; width: 150px;\">
\t  <a class=\"btn btn-light shadow-1-strong bg-image hover-zoom p-3 w-100 h-100 position-relative\" href=\"";
            // line 46
            echo twig_get_attribute($this->env, $this->source, $context["delivery_method"], "link", [], "any", false, false, false, 46);
            echo "\">
\t\t";
            // line 47
            if (twig_get_attribute($this->env, $this->source, $context["delivery_method"], "active", [], "any", false, false, false, 47)) {
                // line 48
                echo "\t\t<div class=\"position-absolute text-primary fs-6\" style=\"top: 0; right: 4px;\"><i class=\"far fa-square-check\"></i></div>
\t\t";
            } else {
                // line 50
                echo "\t\t<div class=\"position-absolute text-primary fs-6\" style=\"top: 0; right: 4px;\"><i class=\"far fa-square\"></i></div>
\t\t";
            }
            // line 52
            echo "\t\t<img src=\"";
            echo twig_get_attribute($this->env, $this->source, $context["delivery_method"], "image", [], "any", false, false, false, 52);
            echo "\" class=\"w-100 h-100\" alt=\"";
            echo twig_get_attribute($this->env, $this->source, $context["delivery_method"], "title", [], "any", false, false, false, 52);
            echo "\"/>
\t\t<div class=\"position-absolute text-secondary\" style=\"bottom: 0; right: 4px;\">";
            // line 53
            echo twig_get_attribute($this->env, $this->source, $context["delivery_method"], "country", [], "any", false, false, false, 53);
            echo "</div>
\t  </a>
\t</div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['delivery_method'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 57
        echo "  </div>
  <div>
\t<p class=\"lead text-primary\">";
        // line 59
        echo ($context["text_other"] ?? null);
        echo "</p>
\t";
        // line 60
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["other"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["other_data"]) {
            // line 61
            echo "\t<div class=\"d-inline-block me-3 mb-3\" style=\"height: 90px; width: 150px;\">
\t  <a class=\"btn btn-light shadow-1-strong bg-image hover-zoom p-3 w-100 h-100 position-relative\" href=\"";
            // line 62
            echo twig_get_attribute($this->env, $this->source, $context["other_data"], "link", [], "any", false, false, false, 62);
            echo "\">
\t\t";
            // line 63
            if (twig_get_attribute($this->env, $this->source, $context["other_data"], "active", [], "any", false, false, false, 63)) {
                // line 64
                echo "\t\t<div class=\"position-absolute text-primary fs-6\" style=\"top: 0; right: 4px;\"><i class=\"far fa-square-check\"></i></div>
\t\t";
            } else {
                // line 66
                echo "\t\t<div class=\"position-absolute text-primary fs-6\" style=\"top: 0; right: 4px;\"><i class=\"far fa-square\"></i></div>
\t\t";
            }
            // line 68
            echo "\t\t<img src=\"";
            echo twig_get_attribute($this->env, $this->source, $context["other_data"], "image", [], "any", false, false, false, 68);
            echo "\" class=\"w-100 h-100\" alt=\"";
            echo twig_get_attribute($this->env, $this->source, $context["other_data"], "title", [], "any", false, false, false, 68);
            echo "\"/>
\t\t<div class=\"position-absolute text-secondary\" style=\"bottom: 0; right: 4px;\">";
            // line 69
            echo twig_get_attribute($this->env, $this->source, $context["other_data"], "country", [], "any", false, false, false, 69);
            echo "</div>
\t  </a>
\t</div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['other_data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 73
        echo "  </div>
</div>
</main>
<script>
</script>
";
        // line 78
        echo ($context["footer"] ?? null);
        echo " 
";
    }

    public function getTemplateName()
    {
        return "view/template/integration/integration.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  251 => 78,  244 => 73,  234 => 69,  227 => 68,  223 => 66,  219 => 64,  217 => 63,  213 => 62,  210 => 61,  206 => 60,  202 => 59,  198 => 57,  188 => 53,  181 => 52,  177 => 50,  173 => 48,  171 => 47,  167 => 46,  164 => 45,  160 => 44,  156 => 43,  152 => 41,  142 => 37,  135 => 36,  131 => 34,  127 => 32,  125 => 31,  121 => 30,  118 => 29,  114 => 28,  110 => 27,  106 => 25,  96 => 21,  89 => 20,  85 => 18,  81 => 16,  79 => 15,  75 => 14,  72 => 13,  68 => 12,  64 => 11,  61 => 10,  55 => 8,  52 => 7,  46 => 5,  44 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/integration/integration.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/integration/integration.twig");
    }
}
