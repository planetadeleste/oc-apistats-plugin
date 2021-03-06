<?php namespace PlanetaDelEste\ApiStats\Controllers\Api;

use Lovata\Buddies\Models\User;
use PlanetaDelEste\ApiStats\Classes\Stat\UserStats;
use PlanetaDelEste\ApiStats\Traits\Controllers\StatsControllerTrait;
use PlanetaDelEste\ApiToolbox\Classes\Api\Base;

/**
 * Class Users
 *
 * @package PlanetaDelEste\ApiStats\Controllers\Api
 */
class Users extends Base
{
    use StatsControllerTrait;

    public function getStatClass(): string
    {
        return UserStats::class;
    }

    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return User::class;
    }
}
