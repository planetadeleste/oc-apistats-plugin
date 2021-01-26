<?php namespace PlanetaDelEste\ApiStats\Controllers\Api;

use PlanetaDelEste\ApiStats\Traits\Controllers\StatsControllerTrait;
use PlanetaDelEste\ApiToolbox\Classes\Api\Base;
use Lovata\Shopaholic\Models\Product;

/**
 * Class Products
 *
 * @package PlanetaDelEste\ApiStats\Controllers\Api
 */
class Products extends Base
{
    use StatsControllerTrait;

    public function getModelClass(): string
    {
        return Product::class;
    }
}
