<?php

namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('vat', array($this, 'computeVat'))
        );
    }

    public function computeVat($priceHT, $vat)
    {
        return round($priceHT / $vat, 2);
    }
}
