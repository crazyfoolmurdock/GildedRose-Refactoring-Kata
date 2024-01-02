<?php
namespace GildedRose\Strategies;

use GildedRose\Interfaces\ItemDegradeStrategyInterface;
use GildedRose\Item;

abstract class BaseDegradeStrategy implements ItemDegradeStrategyInterface
{

    protected Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;

    }

    abstract protected function calculateQuality(): int;

    protected function calculateSellIn(): int
    {
        return $this->item->sellIn - 1;
    }

    public function degrade(): Item
    {

        $this->item->sellIn = $this->calculateSellIn();
        $this->item->quality = $this->calculateQuality();

        return $this->item;
    }

}
