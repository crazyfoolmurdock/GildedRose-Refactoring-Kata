<?php
namespace GildedRose\Interfaces;


use GildedRose\Item;

interface ItemDegradeStrategyInterface
{

    public function degrade(): Item;
}
