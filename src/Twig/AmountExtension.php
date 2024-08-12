<?php 

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AmountExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('amount', [$this, 'amount'])
        ];
    }

    public function amount($value, string $symbol = '€', string $decsep = ',', string $thousandsep = ' ')
    {
        //19299 => 192.99 
        $finalValue = $value / 100;

        //192.99 => 192,99 
        $finalValue = number_format($finalValue, 2, $decsep, $thousandsep);

        // 192,99 €
        return $finalValue . ' ' . $symbol; 
    }
}