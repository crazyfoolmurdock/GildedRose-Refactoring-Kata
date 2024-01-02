<?php
namespace GildedRose\Strategies;

use GildedRose\Strategies\BaseDegradeStrategy;
use GildedRose\Interfaces\ItemDegradeStrategyInterface;

class ItemDegradeStrategy extends BaseDegradeStrategy implements ItemDegradeStrategyInterface
{
    public const QUALITYMODIFIER = 1;

    protected function calculateQuality(): int
    {

        if ($this->item->quality === 0) {
            return 0;
        }

        if ($this->item->sellIn < 0) {
            return $this->item->quality - (static::QUALITYMODIFIER * 2);
        }

        return $this->item->quality - static::QUALITYMODIFIER;

    }



}
