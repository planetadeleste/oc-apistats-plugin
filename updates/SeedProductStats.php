<?php namespace PlanetaDelEste\ApiStats\Updates;

use Lovata\Shopaholic\Models\Product;
use October\Rain\Database\Updates\Seeder;
use PlanetaDelEste\ApiStats\Classes\Stat\ProductStats;
use Symfony\Component\Console\Helper\ProgressBar;

/**
 * Class SeedProductStats
 *
 * @package PlanetaDelEste\ApiStats\Updates
 * @mixin \Illuminate\Database\Seeder
 *
 */
class SeedProductStats extends Seeder
{
    /**
     * @var \Symfony\Component\Console\Helper\ProgressBar
     */
    protected $bar;

    public function run()
    {
        $obProducts = Product::all();
        ProgressBar::setFormatDefinition('custom', ' %current%/%max% [%bar%] %percent:3s%% -- %message%');
        $this->bar = new ProgressBar($this->command->getOutput(), $obProducts->count());
        $this->bar->setFormat('custom');
        $this->bar->setMessage('Starting seed migration');
        $this->bar->start();

        $obProducts->each(function (Product $obProduct) {
            ProductStats::instance()->model($obProduct)->increase(1, $obProduct->created_at);
            $this->bar->advance();
        });

        $this->command->line('End seed migration');
    }

}
