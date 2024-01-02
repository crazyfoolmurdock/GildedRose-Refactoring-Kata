<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Factories\ItemDegradeStrategyFactory;


final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $strategy = ItemDegradeStrategyFactory::getUpdateStrategy($item);
            $item = $strategy->degrade();

        }
    }
}
