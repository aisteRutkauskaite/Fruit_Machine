<?php


namespace Core\test;

use Core\test\Test;

class VendingMachine
{
    private $data;

    public function __construct($items)
    {
        $this->data = $items;
    }

    public function makeArray()
    {
        $array = [];
        foreach ($this->data as $item_key => $item) {
            $array[$item_key]['name'] = $item->getName();
            $array[$item_key]['code'] = $item->getCode();
            $array[$item_key]['quantity'] = $item->getQuantity();
            $array[$item_key]['price'] = $item->getPrice();
        }
        return $array;
    }

    public function getData()
    {
        return $this->data ?? [];
    }

    private function itemExist($code)
    {
        foreach ($this->data as $item) {
            if ($item->getCode() === $code) {
                return $item;
            }
        }
        return false;
    }

    public function vend($code, $money)
    {
        $item = $this->itemExist($code);
        if (!$item) {
            return 'Prekė neagzistuoja';
        } elseif ($item) {
            if ($item->getQuantity() >= 1) {
                if ($money == $item->getPrice()) {
                    $item->quantityDecrease();
                    return "Pinigų tiek kiek reikia";
                } elseif ($money > $item->getPrice()) {
                    $answer = $money - $item->getPrice();
                    $item->quantityDecrease();
                    return 'Jūsų graža: ' . $answer;
                } else {
                    return "Neužtenka pinigų";
                }
            } else {
                return $item->getName() . ' prekes nebėra';
            }

        }
    }

}