<?php namespace PlanetaDelEste\ApiStats\Updates;

use Lovata\Buddies\Models\User;
use October\Rain\Database\Updates\Seeder;
use PlanetaDelEste\ApiStats\Classes\Stat\UserStats;
use Symfony\Component\Console\Helper\ProgressBar;

/**
 * Class SeedUserStats
 *
 * @package PlanetaDelEste\ApiStats\Updates
 * @mixin \Illuminate\Database\Seeder
 *
 */
class SeedUserStats extends Seeder
{
    /**
     * @var \Symfony\Component\Console\Helper\ProgressBar
     */
    protected $bar;

    public function run()
    {
        $obUsers = User::all();
        ProgressBar::setFormatDefinition('custom', ' %current%/%max% [%bar%] %percent:3s%% -- %message%');
        $this->bar = new ProgressBar($this->command->getOutput(), $obUsers->count());
        $this->bar->setFormat('custom');
        $this->bar->setMessage('Starting seed migration');
        $this->bar->start();

        $obUsers->each(function(User $obUser) {
            UserStats::instance()->model($obUser)->increase(1, $obUser->created_at);
            $this->bar->advance();
        });

        $this->command->line('End seed');
    }

}
