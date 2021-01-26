<?php namespace PlanetaDelEste\ApiStats\Traits\Controllers;

use Kharanenka\Helper\Result;

/**
 * Trait StatsControllerTrait
 *
 * @package PlanetaDelEste\ApiStats\Traits\Controllers
 */
trait StatsControllerTrait
{
    public function stats(): \Illuminate\Http\JsonResponse
    {
        $arStats = $this->collectStats();

        return response()->json(Result::setTrue($arStats)->get());
    }

    protected function collectStats(): array
    {
        /** @var \Model|\Eloquent $sModelClass */
        $sModelClass = $this->getModelClass();
        $iTotal = $sModelClass::count();
        $obDate = now()->subMonthsNoOverflow(11);
        $arStats = [
            'total' => $iTotal,
            'months' => []
        ];
        for ($n = 1; $n <= 12; $n++) {
            $iCount = $sModelClass::whereYear($this->getDateColumn(), $obDate->year)
                ->whereMonth($this->getDateColumn(), $obDate->month)
                ->count();

            $sKey = $obDate->year.'-'.$obDate->month;
            $arStats = array_add($arStats, 'months.'.$sKey, $iCount);
            $obDate->addMonth();
        }

        return $arStats;
    }

    public function getDateColumn(): string
    {
        return 'created_at';
    }

    abstract public function getModelClass(): string;
}
