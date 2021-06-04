<?php namespace PlanetaDelEste\ApiStats\Controllers\Api;

use Lovata\OrdersShopaholic\Models\Order;
use PlanetaDelEste\ApiStats\Classes\Stat\OrderStats;
use PlanetaDelEste\ApiStats\Traits\Controllers\StatsControllerTrait;
use PlanetaDelEste\ApiToolbox\Classes\Api\Base;

/**
 * Class Orders
 *
 * @package PlanetaDelEste\ApiStats\Controllers\Api
 */
class Orders extends Base
{
    use StatsControllerTrait;

    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return Order::class;
    }

    /**
     * @return string
     */
    public function getStatClass(): string
    {
        return OrderStats::class;
    }
}
