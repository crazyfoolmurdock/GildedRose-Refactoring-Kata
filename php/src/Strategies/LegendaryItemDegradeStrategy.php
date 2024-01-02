<?php
namespace GildedRose\Strategies;

use GildedRose\Interfaces\ItemDegradeStrategyInterface;
use GildedRose\Item;

class LegendaryItemDegradeStrategy implements ItemDegradeStrategyInterface
{

    protected Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;

    }

    public function degrade(): Item
    {
        return $this->item;
    }

}
