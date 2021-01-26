<?php namespace PlanetaDelEste\ApiStats\Controllers\Api;

use PlanetaDelEste\ApiStats\Traits\Controllers\StatsControllerTrait;
use PlanetaDelEste\ApiToolbox\Classes\Api\Base;
use Lovata\Buddies\Models\User;

/**
 * Class Users
 *
 * @package PlanetaDelEste\ApiStats\Controllers\Api
 */
class Users extends Base
{
    use StatsControllerTrait;

    public function getModelClass(): string
    {
        return User::class;
    }
}
