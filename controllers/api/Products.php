<?php namespace PlanetaDelEste\ApiStats\Controllers\Api;

use Lovata\Shopaholic\Models\Product;
use PlanetaDelEste\ApiStats\Classes\Stat\ProductStats;
use PlanetaDelEste\ApiStats\Traits\Controllers\StatsControllerTrait;
use PlanetaDelEste\ApiToolbox\Classes\Api\Base;

/**
 * Class Products
 *
 * @package PlanetaDelEste\ApiStats\Controllers\Api
 */
class Products extends Base
{
    use StatsControllerTrait;

    public function getStatClass(): string
    {
        return ProductStats::class;
    }

    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return Product::class;
    }
}
