<?php namespace PlanetaDelEste\ApiStats\Classes\Stat;


use Lovata\OrdersShopaholic\Models\Order;
use October\Rain\Support\Traits\Singleton;
use PlanetaDelEste\Stats\Classes\Stats\StatsBase;

/**
 * Class OrderStats
 *
 * @package PlanetaDelEste\ApiStats\Classes\Stat
 *
 * @property Order $obElement
 */
class OrderStats extends StatsBase
{
    public function getCode(): ?string
    {
        return $this->obElement ? $this->obElement->status->code : null;
    }
}
