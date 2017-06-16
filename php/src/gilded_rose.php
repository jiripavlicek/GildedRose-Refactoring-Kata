<?php

class GildedRose
{

    private $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function update_item($item)
    {
        $this->repeatableUpdate($item, function ($item) {
            $this->update1($item);
        });
        if ($item->name !== 'Sulfuras, Hand of Ragnaros') {
            $item->sell_in--;
        }
        if ($item->sell_in >= 0) {
            return;
        }
        $this->repeatableUpdate($item, function ($item) {
            $item->quality = 0;
        });
    }

    private function update1($item)
    {
        $item->increaseQuality();
        if ($item->sell_in < 11) {
            $item->increaseQuality();
        }
        if ($item->sell_in < 6) {
            $item->increaseQuality();
        }
    }

    private function repeatableUpdate($item, $greet)
    {
        if ($item->name === 'Aged Brie') {
            $item->increaseQuality();
        } elseif ($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
            $greet($item);
        } elseif ($item->name !== 'Sulfuras, Hand of Ragnaros') {
            $item->decreasequality();
        }
    }

    public function update_quality()
    {
        foreach ($this->items as $item) {
            $this->update_item($item);
        }
    }
}

class Item {

    public $name;
    public $sell_in;
    public $quality;

    public function __construct($name, $sell_in, $quality)
    {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString()
    {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

    public function increaseQuality()
    {
        $this->quality++;
        $this->quality = min($this->quality, 50);
    }

    public function decreaseQuality()
    {
        $this->quality--;
        $this->quality = max($this->quality, 0);
    }
}
