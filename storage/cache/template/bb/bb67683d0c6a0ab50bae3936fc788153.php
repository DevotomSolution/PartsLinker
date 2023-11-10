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

/* view/template/common/footer.twig */
class __TwigTemplate_2b8cc4e174053c31c54bf3f18ef62b49 extends Template
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
        echo "</body></html>
";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["styles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["style"]) {
            // line 3
            echo "<link href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["style"], "href", [], "any", false, false, false, 3);
            echo "\" type=\"text/css\" rel=\"";
            echo twig_get_attribute($this->env, $this->source, $context["style"], "rel", [], "any", false, false, false, 3);
            echo "\" media=\"";
            echo twig_get_attribute($this->env, $this->source, $context["style"], "media", [], "any", false, false, false, 3);
            echo "\" />
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['style'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["scripts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["script"]) {
            // line 6
            echo "<script src=\"";
            echo twig_get_attribute($this->env, $this->source, $context["script"], "href", [], "any", false, false, false, 6);
            echo "\" type=\"text/javascript\"></script>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['script'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "<script>
let delay;
  
";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["alerts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["alert"]) {
            // line 12
            echo "  delay = 0;
  
  if('";
            // line 14
            echo twig_get_attribute($this->env, $this->source, $context["alert"], "type", [], "any", false, false, false, 14);
            echo "' === 'success') {
\tdelay = 5000;
  }
\t
  addAlert(\"";
            // line 18
            echo twig_get_attribute($this->env, $this->source, $context["alert"], "title", [], "any", false, false, false, 18);
            echo "\", \"";
            echo twig_get_attribute($this->env, $this->source, $context["alert"], "alert", [], "any", false, false, false, 18);
            echo "\", \"";
            echo twig_get_attribute($this->env, $this->source, $context["alert"], "type", [], "any", false, false, false, 18);
            echo "\", delay);
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['alert'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "</script>";
    }

    public function getTemplateName()
    {
        return "view/template/common/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  102 => 20,  90 => 18,  83 => 14,  79 => 12,  75 => 11,  70 => 8,  61 => 6,  57 => 5,  44 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/common/footer.twig", "C:\\laragon\\www\\partslinkerv1\\view\\template\\common\\footer.twig");
    }
}
