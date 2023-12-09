<?php

namespace App\Services;

use App\DTOs\ParcelDTO;
use App\Models\Parcel;

class ParcelService
{

    public function storeParcel(ParcelDTO $parcelDTO): array
    {
        Parcel::create([
            'code' => $parcelDTO->code,
            'price' => $parcelDTO->price,
            'quantity' => $parcelDTO->quantity,
            'comment' => $parcelDTO->comment,
            'address' => $parcelDTO->address
        ]);
        return [
            'message' => 'Parcel successfully created!'
        ];
    }

    public function updateParcel(ParcelDTO $parcelDTO, Parcel $parcel): array
    {
        $parcel->update([
            'code' => $parcelDTO->code,
            'price' => $parcelDTO->price,
            'quantity' => $parcelDTO->quantity,
            'comment' => $parcelDTO->comment,
            'address' => $parcelDTO->address
        ]);
        return [
            'message' => 'Parcel successfully updated!'
        ];
    }

}
