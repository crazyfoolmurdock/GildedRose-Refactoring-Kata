<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{


    public function test_it_updates_the_quality_and_sellIn_values_of_multiple_itesm(): void
    {

        $items = [
            new Item('+5 Dexterity Vest', 10, 20),
            new Item('+5 Dexterity Vest', 10, 20),
        ];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $expected = "{$items[0]->name}, 9, 19";

        $this->assertSame($expected, $items[0]->__toString());
        $this->assertSame($expected, $items[1]->__toString());
    }


    public function itemProvider(): array
    {
        return [
            'reduces_quality_and_sellIn_by_one' => ['startSellIn' => 10, 'startQuality' => 20, 'expectedSellIn' => 9, 'expectedQuality' => 19],
            'sellIn_date_passed_so_reduce_quality_by_double' => ['startSellIn' => -1, 'startQuality' => 20, 'expectedSellIn' => -2, 'expectedQuality' => 18],
            'quality_is_never_negative' => ['startSellIn' => 1, 'startQuality' => 0, 'expectedSellIn' => 0, 'expectedQuality' => 0],
        ];
    }


    /**
     * @test
     * @dataProvider itemProvider
     */
    public function test_it_updates_the_quality_and_sellIn_values_of_a_normal_item(int $sellIn, int $quality,int  $expectedSellIn, int $expectedQuality): void
    {

        $this->runUpdateQualityTest(new Item('+5 Dexterity Vest', $sellIn, $quality), $expectedSellIn, $expectedQuality);

    }

    public function agedBrieItemProvider(): array
    {
        return [
            'increases_quality_and_decreases_sellIn_by_one' => ['startSellIn' => 10, 'startQuality' => 20, 'expectedSellIn' => 9, 'expectedQuality' => 21],
            'sellIn_date_passed_so_increase_quality_by_double' => ['startSellIn' => -1, 'startQuality' => 20, 'expectedSellIn' => -2, 'expectedQuality' => 22],
            'quality_is_never_over_fifty' => ['startSellIn' => 1, 'startQuality' => 50, 'expectedSellIn' => 0, 'expectedQuality' => 50],
        ];
    }


    /**
     * @test
     * @dataProvider agedBrieItemProvider
     */
    public function test_it_updates_the_quality_and_sellIn_values_of_aged_brie(int $sellIn, int $quality,int  $expectedSellIn, int $expectedQuality): void
    {

        $this->runUpdateQualityTest(new Item('Aged Brie', $sellIn, $quality), $expectedSellIn, $expectedQuality);

    }


    public function legendaryItemProvider(): array
    {
        return [
            'quality_and_sellIn_dont_change' => ['startSellIn' => 10, 'startQuality' => 80, 'expectedSellIn' => 10, 'expectedQuality' => 80],
            'sellIn_date_passed_but_nothing_changes' => ['startSellIn' => -1, 'startQuality' => 80, 'expectedSellIn' => -1, 'expectedQuality' => 80],
        ];
    }


    /**
     * @test
     * @dataProvider legendaryItemProvider
     */
    public function test_it_updates_the_quality_and_sellIn_values_of_a_legendary_item(int $sellIn, int $quality,int  $expectedSellIn, int $expectedQuality): void
    {

        $this->runUpdateQualityTest(new Item('Sulfuras, Hand of Ragnaros', $sellIn, $quality), $expectedSellIn, $expectedQuality);

    }


    public function backstagePassItemProvider(): array
    {
        return [
            'increases_quality_and_decreases_sellIn_by_one' => ['startSellIn' => 15, 'startQuality' => 20, 'expectedSellIn' => 14, 'expectedQuality' => 21],
            'sellIn_date_ten_days_so_increase_quality_by_double' => ['startSellIn' => 10, 'startQuality' => 20, 'expectedSellIn' => 9, 'expectedQuality' => 22],
            'sellIn_date_less_than_ten_days_so_increase_quality_by_double' => ['startSellIn' => 9, 'startQuality' => 20, 'expectedSellIn' => 8, 'expectedQuality' => 22],
            'sellIn_date_five_days_so_increase_quality_by_triple' => ['startSellIn' => 5, 'startQuality' => 20, 'expectedSellIn' => 4, 'expectedQuality' => 23],
            'sellIn_date_less_than_five_days_so_increase_quality_by_triple' => ['startSellIn' => 4, 'startQuality' => 20, 'expectedSellIn' => 3, 'expectedQuality' => 23],
            'after_concert_so_quality_is_zero' => ['startSellIn' => -1, 'startQuality' => 20, 'expectedSellIn' => -2, 'expectedQuality' => 0],
            'quality_is_never_negative' => ['startSellIn' => -2, 'startQuality' => 0, 'expectedSellIn' => -3, 'expectedQuality' => 0],
            'quality_is_never_over_fifty_when_less_than_ten_days' => ['startSellIn' => 10, 'startQuality' => 49, 'expectedSellIn' => 9, 'expectedQuality' => 50],
            'quality_is_never_over_fifty_when_less_than_five_days' => ['startSellIn' => 4, 'startQuality' => 49, 'expectedSellIn' => 3, 'expectedQuality' => 50],
        ];
    }


    /**
     * @test
     * @dataProvider backstagePassItemProvider
     */
    public function test_it_updates_the_quality_and_sellIn_values_of_a_backstage_pass_item(int $sellIn, int $quality,int  $expectedSellIn, int $expectedQuality): void
    {

        $this->runUpdateQualityTest(new Item('Backstage passes to a TAFKAL80ETC concert', $sellIn, $quality), $expectedSellIn, $expectedQuality);

    }

    public function conjuredItemProvider(): array
    {
        return [
            'reduces_quality_and_sellIn_by_double' => ['startSellIn' => 10, 'startQuality' => 20, 'expectedSellIn' => 9, 'expectedQuality' => 18],
            'sellIn_date_passed_so_reduce_quality_by_quadruple' => ['startSellIn' => -1, 'startQuality' => 20, 'expectedSellIn' => -2, 'expectedQuality' => 16],
            'quality_is_never_negative' => ['startSellIn' => 1, 'startQuality' => 0, 'expectedSellIn' => 0, 'expectedQuality' => 0],
        ];
    }


    /**
     * @test
     * @dataProvider conjuredItemProvider
     */
    public function test_it_updates_the_quality_and_sellIn_values_of_a_conjured_item(int $sellIn, int $quality,int  $expectedSellIn, int $expectedQuality): void
    {

        $this->runUpdateQualityTest(new Item('Conjured Mana Cake', $sellIn, $quality), $expectedSellIn, $expectedQuality);

    }


    public function runUpdateQualityTest(Item $item, int  $expectedSellIn, int $expectedQuality)
    {

        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();

        $expected = "{$item->name}, {$expectedSellIn}, {$expectedQuality}";

        $this->assertSame($expected, $item->__toString());

    }





}
