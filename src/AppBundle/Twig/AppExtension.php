<?php

namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('ttc', array($this, 'computeTTC')),
            new \Twig_SimpleFilter('vat', array($this, 'computeVAT'))
        );
    }

    public function computeTTC($priceHT, $vat)
    {
        return round($priceHT * (1 + $vat/100), 2);
    }

    public function computeVAT($priceHT, $vat)
    {
        return round($priceHT * ($vat/100), 2);
    }
}
