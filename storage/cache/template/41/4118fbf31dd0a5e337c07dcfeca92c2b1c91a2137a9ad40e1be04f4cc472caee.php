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

/* view/template/info/label.twig */
class __TwigTemplate_c90dc293d1801aecd93691ebb63d4138b971fd3fe9fd3de0ecf0a5355740a7d4 extends Template
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
   <div id=\"label\">
\t<div style=\"width: ";
        // line 5
        echo ($context["label_width"] ?? null);
        echo "px; height: ";
        echo ($context["label_height"] ?? null);
        echo "px; color: #000; overflow: hidden;\">
\t  ";
        // line 6
        if ((($context["label_type"] ?? null) == 1)) {
            // line 7
            echo "\t  <table>
\t\t<tr>
\t\t  <td id=\"qr\" rowspan=\"2\"></td>
\t\t  <td style=\"padding-left: 5px; text-align: center; font-size: ";
            // line 10
            echo ($context["font_size"] ?? null);
            echo "px; line-height: ";
            echo ($context["font_size"] ?? null);
            echo "px; font-weight: bold;\">";
            echo ($context["text"] ?? null);
            echo "</td>
\t\t</tr>
\t\t<tr>
\t\t  <td style=\"padding-left: 5px; line-height: ";
            // line 13
            echo ($context["barcode_height"] ?? null);
            echo "px;\"><svg id=\"barcode\"></svg></td>
\t\t</tr>
\t  </table>
\t  ";
        } elseif ((        // line 16
($context["label_type"] ?? null) == 2)) {
            // line 17
            echo "\t  <table>
\t\t<tr>
\t\t  <td colspan=\"2\" style=\"padding-left: 5px; text-align: center; font-size: ";
            // line 19
            echo ($context["font_size"] ?? null);
            echo "px; line-height: ";
            echo ($context["font_size"] ?? null);
            echo "px; font-weight: bold;\">";
            echo ($context["text"] ?? null);
            echo "</td>
\t\t</tr>
\t\t<tr>
\t\t  <td id=\"qr\"></td>
\t\t  <td style=\"padding-left: 5px; line-height: ";
            // line 23
            echo ($context["barcode_height"] ?? null);
            echo "px;\"><svg id=\"barcode\"></svg></td>
\t\t</tr>
\t  </table>
\t  ";
        }
        // line 27
        echo "\t</div>
  </div>
  <div id=\"qr-hover\" class=\"d-none\"></div>
  <button id=\"btn-print\" class=\"btn btn-primary ms-1 mt-1\"><i class=\"fas fa-print\"></i> ";
        // line 30
        echo ($context["button_print"] ?? null);
        echo "</button>
  <a href=\"";
        // line 31
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"btn btn-default mt-1\"><i class=\"fa fa-reply\"></i> ";
        echo ($context["button_cancel"] ?? null);
        echo "</a>
</div>
</main>
<script>
\$(document).ready(function(){
  JsBarcode(\"#barcode\", \"";
        // line 36
        echo ($context["text"] ?? null);
        echo "\", {
\twidth: ";
        // line 37
        echo ($context["barcode_width"] ?? null);
        echo ",
\theight: ";
        // line 38
        echo ($context["barcode_height"] ?? null);
        echo ",
\tmargin: 0,
\tdisplayValue: false,
  });

  \$('#qr-hover').qrcode({
\tsize: ";
        // line 44
        echo ($context["qrcode_size"] ?? null);
        echo ",
\ttext: '";
        // line 45
        echo ($context["link"] ?? null);
        echo "',
\tecLevel: 'L',
  });

  let canvas = document.getElementById('qr-hover').children['0'];
  let dataUrl = canvas.toDataURL();
\t
  \$('#qr').html('<img src=\"' + dataUrl + '\">');
});

\$('#btn-print').click(function(){
  let contentPrint = \$('#label').html();

  \$('header').hide();
  \$('main').hide();
  \$('footer').hide();
  
  \$(document.body).append('<div id=\"toPrint\">' + contentPrint + '</div>');
  window.print();
  
  \$('#toPrint').remove();
  
  \$('header').show();
  \$('main').show();
  \$('footer').show();
})
</script>
";
        // line 72
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "view/template/info/label.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 72,  140 => 45,  136 => 44,  127 => 38,  123 => 37,  119 => 36,  107 => 31,  103 => 30,  98 => 27,  91 => 23,  80 => 19,  76 => 17,  74 => 16,  68 => 13,  58 => 10,  53 => 7,  51 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "view/template/info/label.twig", "/var/www/vhosts/partsmanager.it/httpdocs/view/template/info/label.twig");
    }
}
