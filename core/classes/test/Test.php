<?php


namespace Core\test;


//class Test
//{
//    private $number_one;
//    private $number_two;
//
//    public function __construct($number_one, $number_two)
//    {
//        $this->number_one = $number_one;
//        $this->number_two = $number_two;
//    }
//
//    public function add() {
//        return $this->number_one +  $this->number_two;
//    }
//
//    public function minus() {
//
//    }
//
//
//}

$result = new Test(3, 4);
class Test
{
    private string $name;
    private string $code;
    private int $quantity;
    private float $price;

    public function __construct($name, $code, $quantity, $price)
    {
        $this->name = $name;
        $this->code = $code;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function quantityDecrease()
    {
        $this->quantity--;
    }


}

