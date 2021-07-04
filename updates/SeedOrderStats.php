<?php namespace PlanetaDelEste\ApiStats\Updates;

use Lovata\OrdersShopaholic\Models\Order;
use October\Rain\Database\Updates\Seeder;
use PlanetaDelEste\ApiStats\Classes\Stat\OrderStats;
use Symfony\Component\Console\Helper\ProgressBar;

/**
 * Class SeedOrderStats
 *
 * @package PlanetaDelEste\ApiStats\Updates
 * @mixin \Illuminate\Database\Seeder
 *
 */
class SeedOrderStats extends Seeder
{
    /**
     * @var \Symfony\Component\Console\Helper\ProgressBar
     */
    protected $bar;

    public function run()
    {
        $obOrders = Order::all();

        ProgressBar::setFormatDefinition('custom', ' %current%/%max% [%bar%] %percent:3s%% -- %message%');
        $this->bar = new ProgressBar($this->command->getOutput(), $obOrders->count());
        $this->bar->setFormat('custom');
        $this->bar->setMessage('Starting seed migration');
        $this->bar->start();

        $obOrders->each(function (Order $obOrder) {
            OrderStats::instance()
                ->model($obOrder)
                ->update()
                ->increase($obOrder->position_total_price_value, $obOrder->created_at);

            $this->bar->advance();
        });

        $this->command->line('End seed');
    }

}
