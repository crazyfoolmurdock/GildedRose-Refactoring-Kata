<?php
namespace GildedRose\Strategies;

use GildedRose\Interfaces\ItemDegradeStrategyInterface;

class BackstagePassItemDegradeStrategy extends IncreasingQualityItemDegradeStrategy implements ItemDegradeStrategyInterface
{

    protected function calculateQuality(): int
    {

        if ($this->item->sellIn < 0) {
            return 0;
        }

        if ($this->item->sellIn <= 5) {
            return $this->limitMaximumQuality($this->item->quality + 3);
        }

        if ($this->item->sellIn <= 10) {
            return $this->limitMaximumQuality($this->item->quality + 2);
        }

        return $this->limitMaximumQuality($this->item->quality + 1);
    }

}
