<?php namespace PlanetaDelEste\ApiStats\Traits\Controllers;

use Kharanenka\Helper\Result;
use Lovata\Buddies\Models\Group;
use PHPUnit\Exception;
use PlanetaDelEste\Stats\Classes\Stats\StatsQuery;

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

    /**
     * @return \PlanetaDelEste\Stats\Classes\Stats\StatsQuery
     */
    public function statsQuery()
    {
        /** @var \PlanetaDelEste\Stats\Classes\Stats\StatsBase $sModelClass */
        $sModelClass = $this->getStatClass();
        return $sModelClass::query()
            ->start(now()->subMonthsNoOverflow(11))
            ->end(now()->subSecond())
            ->groupByMonth();
    }

    protected function collectStats($sCode = null): array
    {
        $obStatsQuery = $this->statsQuery();
        $this->statsByUser($obStatsQuery);
        $this->statsByCode($obStatsQuery, $sCode);

        $obStats = $obStatsQuery->get();
        return [
            'total'  => $obStats->max('value'),
            'months' => $obStats->toArray(),
            'count'  => $obStats->first()->count
        ];
    }

    protected function statsByUser(StatsQuery $obStatsQuery)
    {
        $iUserID = input('user_id');
        $obAdminGroup = Group::getByCode('admin')->first();

        try {
            if ($obUser = $this->currentUser()) {
                if (!$obUser->inGroup($obAdminGroup)) {
                    $iUserID = $obUser->id;
                }
            }
        } catch (\Exception $ex) {
        }

        if ($iUserID) {
            $obStatsQuery->byUser($iUserID);
        }
    }

    protected function statsByCode(StatsQuery $obStatsQuery, $sCode = null)
    {
        if (!$sCode) {
            $sCode = input('code');
        }

        if ($sCode) {
            $obStatsQuery->byCode($sCode);
        }
    }

    public function getDateColumn(): string
    {
        return 'created_at';
    }

    abstract public function getStatClass(): string;
}
