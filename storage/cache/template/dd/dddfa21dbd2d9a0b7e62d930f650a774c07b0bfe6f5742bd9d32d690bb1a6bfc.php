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

/* view/template/common/navigation.twig */
class __TwigTemplate_f77083752d143d56e60da6d005b1ca0e29c9a70165902e303a8b7d15e6018ccf extends Template
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
        echo "<header>
  <nav id=\"sidenav\" class=\"sidenav\" data-mdb-hidden=\"false\" data-mdb-accordion=\"true\"style=\"background-color: #242d37;\">
    <img src=\"";
        // line 3
        echo ($context["server"] ?? null);
        echo "view/img/logo-white.png\" class=\"w-100\" style=\"margin-left: -5px;\"/>
    <!--<a class=\"ripple d-flex justify-content-center align-items-center py-4 fs-4\" href=\"";
        // line 4
        echo ($context["home"] ?? null);
        echo "\" data-mdb-ripple-color=\"primary\" style=\"background-color: #19222E!important;color: #FFFFFF!important;\"><i class=\"fas fa-tachometer-alt me-3\" style=\"color:#3b71ca\"></i>";
        echo ($context["text_dashboard"] ?? null);
        echo "</a>-->
    <ul class=\"sidenav-menu\" style=\"color:#b3cbdd;\">
\t";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["navigaton"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 7
            echo "\t  ";
            if (twig_get_attribute($this->env, $this->source, $context["item"], "collapse", [], "any", false, false, false, 7)) {
                // line 8
                echo "\t  <li class=\"sidenav-item\">
        <a class=\"sidenav-link fs-5\">";
                // line 9
                echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 9);
                echo "</a>
        <ul class=\"sidenav-collapse\">
\t\t  ";
                // line 11
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["item"], "collapse", [], "any", false, false, false, 11));
                foreach ($context['_seq'] as $context["_key"] => $context["collapse_item"]) {
                    // line 12
                    echo "          <li class=\"sidenav-item\">
            <a href=\"";
                    // line 13
                    echo twig_get_attribute($this->env, $this->source, $context["collapse_item"], "link", [], "any", false, false, false, 13);
                    echo "\" class=\"sidenav-link fs-6\">";
                    echo twig_get_attribute($this->env, $this->source, $context["collapse_item"], "title", [], "any", false, false, false, 13);
                    echo "</a>
          </li>
\t\t  ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['collapse_item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 16
                echo "\t\t</ul>
      </li>
\t  ";
            } else {
                // line 19
                echo "\t  <li class=\"sidenav-item\">
        <a class=\"sidenav-link fs-5\" href=\"";
                // line 20
                echo twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 20);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 20);
                echo "</a>
      </li>
\t  ";
            }
            // line 23
            echo "\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        echo "\t  <li class=\"sidenav-item d-lg-none\">
        <a class=\"sidenav-link fs-5\"><i class=\"fas fa-user-cog fa-fw me-3\"></i><span>";
        // line 25
        echo ($context["text_account"] ?? null);
        echo "</span></a>
        <ul class=\"sidenav-collapse\">
          <li class=\"sidenav-item\">
            <a href=\"";
        // line 28
        echo ($context["setting"] ?? null);
        echo "\" class=\"sidenav-link fs-6\"><i class=\"fa fa-cog me-3\"></i>";
        echo ($context["text_setting"] ?? null);
        echo "</a>
          </li>
\t\t  <li class=\"sidenav-item\">
            <a class=\"sidenav-link fs-6\" href=\"";
        // line 31
        echo ($context["logout"] ?? null);
        echo "\"><i class=\"fa fa-lock me-3\"></i><span>";
        echo ($context["button_logout"] ?? null);
        echo "</span></a>
\t\t  </li>
        </ul>
      </li>
    </ul>
  </nav>
  <nav id=\"main-navbar\" class=\"navbar navbar-expand-lg navbar-light bg-white fixed-top\">
    <div class=\"container-fluid\">
      <button data-mdb-toggle=\"sidenav\" data-mdb-target=\"#sidenav\" class=\"btn btn-lg shadow-0 pe-3 ps-3 d-flex d-xxl-none\" aria-controls=\"#sidenav\" aria-haspopup=\"true\"><i class=\"fas fa-bars fa-lg fs-3\"></i></button>
\t  <a class=\"ripple\" href=\"";
        // line 40
        echo ($context["home"] ?? null);
        echo "\" data-mdb-ripple-color=\"primary\"><img src=\"";
        echo ($context["logo"] ?? null);
        echo "\"/></a>
      <ul class=\"navbar-nav ms-auto d-flex flex-row align-items-center\">
\t\t<li class=\"nav-item\">";
        // line 42
        echo ($context["cart"] ?? null);
        echo "</li>
\t\t<li class=\"nav-item\">
\t\t  <div class=\"dropdown d-none d-lg-block\">
\t\t\t<a class=\"btn btn-link me-3 me-lg-0 dropdown-toggle hidden-arrow\" href=\"#\" id=\"navbarDropdownAccount\" role=\"button\" data-mdb-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fas fa-user fa-fw me-3\"></i><span>";
        // line 45
        echo ($context["text_account"] ?? null);
        echo "</span></a>
\t\t\t<ul class=\"dropdown-menu dropdown-menu-end\" aria-labelledby=\"navbarDropdownAccount\">
\t\t\t  <li>
\t\t\t\t<a class=\"btn btn-link btn-block text-start\" href=\"";
        // line 48
        echo ($context["setting"] ?? null);
        echo "\"><i class=\"fa fa-cog me-3\"></i><span>";
        echo ($context["text_setting"] ?? null);
        echo "</span></a>
\t\t\t  </li>
\t\t\t  <li>
\t\t\t\t<a class=\"btn btn-link btn-block text-start\" href=\"";
        // line 51
        echo ($context["logout"] ?? null);
        echo "\"><i class=\"fa fa-lock me-3\"></i><span>";
        echo ($context["button_logout"] ?? null);
        echo "</span></a>
\t\t\t  </li> 
\t\t\t</ul>
\t\t  </div>
        </li>
        <li class=\"nav-item d-none d-lg-block\">";
        // line 56
        echo ($context["language_selector"] ?? null);
        echo "</li>
      </ul>
    </div>
  </nav>
</header>";
    }

    public function getTemplateName()
    {
        return "view/template/common/navigation.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  175 => 56,  165 => 51,  157 => 48,  151 => 45,  145 => 42,  138 => 40,  124 => 31,  116 => 28,  110 => 25,  107 => 24,  101 => 23,  93 => 20,  90 => 19,  85 => 16,  74 => 13,  71 => 12,  67 => 11,  62 => 9,  59 => 8,  56 => 7,  52 => 6,  45 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/common/navigation.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/common/navigation.twig");
    }
}
