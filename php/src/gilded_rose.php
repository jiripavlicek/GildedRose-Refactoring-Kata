<?php

class GildedRose {

    private $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function update_item($item)
    {
        if ($item->name == 'Aged Brie') {
            $item->increaseQuality();
        } elseif ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
            $item->increaseQuality();
            if ($item->sell_in < 11) {
                $item->increaseQuality();
            }
            if ($item->sell_in < 6) {
                $item->increaseQuality();
            }
        } elseif ($item->name != 'Sulfuras, Hand of Ragnaros') {
            $item->decreasequality();
        }
        if ($item->name != 'Sulfuras, Hand of Ragnaros') {
            $item->sell_in--;
        }            
        if ($item->sell_in >= 0) {
            return;
        }
        if ($item->name == 'Aged Brie') {
            $item->increaseQuality();
        } elseif ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
            $item->quality = 0;
        } elseif ($item->name != 'Sulfuras, Hand of Ragnaros') {
            $item->decreaseQuality();
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

    function __construct($name, $sell_in, $quality) {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString() {
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

