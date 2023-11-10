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

/* view/template/catalog/import_history.twig */
class __TwigTemplate_0b70b384dd4fd44f64e62db7449a5f209b7ce4596de7b824180ab193cfc55e03 extends Template
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
        echo "<p class=\"lead\">";
        echo ($context["text_import_history"] ?? null);
        echo "</p>
<table class=\"table table-bordered mb-1\">
  <thead>
\t<tr>
\t  <td class=\"text-start\"><strong>";
        // line 5
        echo ($context["column_date"] ?? null);
        echo "</strong></td>
\t  <td class=\"text-start\"><strong>";
        // line 6
        echo ($context["column_filename"] ?? null);
        echo "</strong></td>
\t  <td class=\"text-start\"><strong>";
        // line 7
        echo ($context["column_result"] ?? null);
        echo "</strong></td>
\t</tr>
  </thead>
    <tbody>
      ";
        // line 11
        if (($context["histories"] ?? null)) {
            // line 12
            echo "      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["histories"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["history"]) {
                // line 13
                echo "      <tr>
        <td class=\"text-start\">";
                // line 14
                echo twig_get_attribute($this->env, $this->source, $context["history"], "date", [], "any", false, false, false, 14);
                echo "</td>
        <td class=\"text-start\">";
                // line 15
                echo twig_get_attribute($this->env, $this->source, $context["history"], "filename", [], "any", false, false, false, 15);
                echo "</td>
        <td class=\"text-start\">";
                // line 16
                echo twig_get_attribute($this->env, $this->source, $context["history"], "result", [], "any", false, false, false, 16);
                echo "</td>
      </tr>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['history'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 19
            echo "      ";
        } else {
            // line 20
            echo "      <tr>
        <td class=\"text-center\" colspan=\"3\">";
            // line 21
            echo ($context["text_no_results"] ?? null);
            echo "</td>
      </tr>
      ";
        }
        // line 24
        echo "    </tbody>
</table>";
    }

    public function getTemplateName()
    {
        return "view/template/catalog/import_history.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 24,  93 => 21,  90 => 20,  87 => 19,  78 => 16,  74 => 15,  70 => 14,  67 => 13,  62 => 12,  60 => 11,  53 => 7,  49 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/catalog/import_history.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/catalog/import_history.twig");
    }
}
