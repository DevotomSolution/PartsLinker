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

/* view/template/common/language.twig */
class __TwigTemplate_3e9fca55476044e99d72a34ca1bd6189a75f2113b2ca10b6ee1a109224e65f77 extends Template
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
  <a class=\"btn btn-link me-3 me-lg-0 dropdown-toggle hidden-arrow\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-mdb-toggle=\"dropdown\" aria-expanded=\"false\"><img src=\"";
        // line 2
        echo ($context["server"] ?? null);
        echo "language/";
        echo twig_get_attribute($this->env, $this->source, ($context["current_language"] ?? null), "code", [], "any", false, false, false, 2);
        echo "/";
        echo twig_get_attribute($this->env, $this->source, ($context["current_language"] ?? null), "code", [], "any", false, false, false, 2);
        echo ".png\" alt=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["current_language"] ?? null), "name", [], "any", false, false, false, 2);
        echo "\" title=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["current_language"] ?? null), "name", [], "any", false, false, false, 2);
        echo "\" style=\"vertical-align: baseline;\"/></a>
  <ul class=\"dropdown-menu dropdown-menu-end overflow-hidden\" aria-labelledby=\"navbarDropdown\">
  ";
        // line 4
        if (($context["current_language"] ?? null)) {
            // line 5
            echo "\t<li>
\t  <button class=\"btn btn-link btn-block text-start language-select\" type=\"button\" name=\"";
            // line 6
            echo twig_get_attribute($this->env, $this->source, ($context["current_language"] ?? null), "id", [], "any", false, false, false, 6);
            echo "\"><img src=\"";
            echo ($context["server"] ?? null);
            echo "language/";
            echo twig_get_attribute($this->env, $this->source, ($context["current_language"] ?? null), "code", [], "any", false, false, false, 6);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, ($context["current_language"] ?? null), "code", [], "any", false, false, false, 6);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["current_language"] ?? null), "name", [], "any", false, false, false, 6);
            echo "\" /> ";
            echo twig_get_attribute($this->env, $this->source, ($context["current_language"] ?? null), "name", [], "any", false, false, false, 6);
            echo "</button>
\t</li>
  ";
        }
        // line 9
        echo "\t<li><hr class=\"dropdown-divider\" /></li>
  ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 11
            echo "\t<li>
\t  <button class=\"btn btn-link btn-block text-start language-select\" type=\"button\" name=\"";
            // line 12
            echo twig_get_attribute($this->env, $this->source, $context["language"], "id", [], "any", false, false, false, 12);
            echo "\"><img src=\"";
            echo ($context["server"] ?? null);
            echo "language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 12);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 12);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 12);
            echo "\" /> ";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 12);
            echo "</button>
\t</li> 
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "  </ul>
</div>
<script>
\$('.language-select').on('click', function(e) {
  \$.ajax({
\turl: '";
        // line 20
        echo ($context["server"] ?? null);
        echo "index.php?route=common/language.setLanguage',
\ttype: 'POST',
\tdata: {'language_id': \$(this).attr('name')},
\tsuccess: function() {
\t  location.reload();
\t}
  });
});
</script>";
    }

    public function getTemplateName()
    {
        return "view/template/common/language.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  110 => 20,  103 => 15,  84 => 12,  81 => 11,  77 => 10,  74 => 9,  58 => 6,  55 => 5,  53 => 4,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/common/language.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/common/language.twig");
    }
}
