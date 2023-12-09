<?php

namespace App\DTOs;

class ParcelDTO
{

    public string $code;
    public float $price;
    public int $quantity;
    public string $address;
    public string $comment;

    public function __construct(string $code, float $price, int $quantity, string $address, string $comment)
    {
        $this->code = $code;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->address = $address;
        $this->comment = $comment;
    }
}
