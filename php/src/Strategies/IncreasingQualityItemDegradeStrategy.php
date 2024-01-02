<?php
namespace GildedRose\Strategies;

use GildedRose\Interfaces\ItemDegradeStrategyInterface;
use GildedRose\Strategies\BaseDegradeStrategy;

class IncreasingQualityItemDegradeStrategy extends BaseDegradeStrategy implements ItemDegradeStrategyInterface
{

    protected function limitMaximumQuality(int $quality): int
    {

        if ($quality > 50) {
            return 50;
        }

        return $quality;
    }

    protected function calculateQuality(): int
    {

        if ($this->item->sellIn < 0) {
            return $this->limitMaximumQuality($this->item->quality + 2);
        }

        return $this->limitMaximumQuality($this->item->quality + 1);

    }

}
