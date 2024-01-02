<?php
namespace GildedRose\Factories;

use GildedRose\Interfaces\ItemDegradeStrategyInterface;
use GildedRose\Item;
use GildedRose\Strategies\BackstagePassItemDegradeStrategy;
use GildedRose\Strategies\ConjuredItemDegradeStrategy;
use GildedRose\Strategies\IncreasingQualityItemDegradeStrategy;
use GildedRose\Strategies\ItemDegradeStrategy;
use GildedRose\Strategies\LegendaryItemDegradeStrategy;

class ItemDegradeStrategyFactory
{

    public static function getUpdateStrategy(Item $item): ItemDegradeStrategyInterface
    {

        switch ($item->name) {
            case 'Aged Brie':return new IncreasingQualityItemDegradeStrategy($item);
            case 'Sulfuras, Hand of Ragnaros':return new LegendaryItemDegradeStrategy($item);
            case 'Backstage passes to a TAFKAL80ETC concert':return new BackstagePassItemDegradeStrategy($item);
            case str_contains($item->name, 'Conjured'): return new ConjuredItemDegradeStrategy($item);
            default:return new ItemDegradeStrategy($item);

        }

    }

}
