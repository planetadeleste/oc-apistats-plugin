<?php namespace PlanetaDelEste\ApiStats;

use PlanetaDelEste\ApiStats\Classes\Event\Order\OrderModelHandler;
use System\Classes\PluginBase;

/**
 * Class Plugin
 * @package PlanetaDelEste\ApiStats
 */
class Plugin extends PluginBase
{
    public function boot()
    {
        \Event::subscribe(OrderModelHandler::class);
    }
}
