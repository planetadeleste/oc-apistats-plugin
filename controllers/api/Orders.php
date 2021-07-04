<?php namespace PlanetaDelEste\ApiStats\Controllers\Api;

use Kharanenka\Helper\Result;
use Lovata\OrdersShopaholic\Models\Order;
use Lovata\OrdersShopaholic\Models\Status;
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

    public function stats(): \Illuminate\Http\JsonResponse
    {
        $arStats = $this->collectStats();
        $arListStatus = Status::lists('code');
        if (!empty($arListStatus)) {
            foreach ($arListStatus as $sStatus) {
                $iCount = $this->statsQuery()->getCountByCode($sStatus);
                array_set($arStats, 'status.'.$sStatus, $iCount);
            }
        }

        return response()->json(Result::setTrue($arStats)->get());
    }

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
