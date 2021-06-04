<?php namespace PlanetaDelEste\ApiStats\Classes\Event\Order;

use Lovata\OrdersShopaholic\Classes\Item\OrderItem;
use Lovata\Toolbox\Classes\Event\ModelHandler;
use Lovata\OrdersShopaholic\Models\Order;
use PlanetaDelEste\ApiStats\Classes\Stat\OrderStats;
use PlanetaDelEste\Stats\Models\Stat;

/**
 * Class OrderModelHandler
 *
 * @package PlanetaDelEste\ApiStats\Classes\Event\Order
 */
class OrderModelHandler extends ModelHandler
{
    /** @var Order */
    protected $obElement;

    public function subscribe($obEvent)
    {
        parent::subscribe($obEvent);
        $obEvent->listen(
            'shopaholic.order.created',
            function (Order $obOrder) {
                OrderStats::instance()
                    ->model($obOrder)
                    ->increase($obOrder->position_total_price_value, $obOrder->created_at);
            }
        );
    }

    /**
     * Get model class name
     *
     * @return string
     */
    protected function getModelClass(): string
    {
        return Order::class;
    }

    /**
     * Get item class name
     *
     * @return string
     */
    protected function getItemClass(): string
    {
        return OrderItem::class;
    }

    /**
     * After create event handler
     */
    protected function afterCreate()
    {
        parent::afterCreate();
    }

    /**
     * After save event handler
     */
    protected function afterSave()
    {
        parent::afterSave();
        if ($this->obElement->wasChanged('status_id')) {
            $obStats = Stat::getByName(OrderStats::class)->getByItem($this->obElement->id)->get();
            $obStats->each(
                function (Stat $obStat) {
                    $obStat->update(['code' => $this->obElement->status->code]);
                }
            );
        }
    }

    /**
     * After delete event handler
     */
    protected function afterDelete()
    {
        parent::afterDelete();
    }
}
