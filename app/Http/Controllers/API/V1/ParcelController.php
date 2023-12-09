<?php

namespace App\Http\Controllers\API\V1;

use App\DTOs\ParcelDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParcelStoreRequest;
use App\Http\Requests\ParcelUpdateRequest;
use App\Models\Parcel;
use App\Services\ParcelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ParcelController extends Controller
{

    protected ParcelService $parcelService;

    public function __construct(ParcelService $parcelService)
    {
        $this->parcelService = $parcelService;
    }

    public function store(ParcelStoreRequest $request): JsonResponse
    {
        $parcelDTO = new ParcelDTO(
            code: $request->code,
            price: $request->price,
            quantity: $request->quantity,
            address: $request->address,
            comment: $request->comment
        );
        $parcel = $this->parcelService->storeParcel($parcelDTO);
        return response()->json([
            'success' => true,
            'message' => $parcel['message']
        ]);
    }

    public function update(ParcelUpdateRequest $request, Parcel $parcel): JsonResponse
    {
        $parcelDTO = new ParcelDTO(
            code: $request->code,
            price: $request->price,
            quantity: $request->quantity,
            address: $request->address,
            comment: $request->comment
        );
        $updatedParcel = $this->parcelService->updateParcel($parcelDTO, $parcel);
        return response()->json([
            'success' => true,
            'message' => $updatedParcel['message']
        ]);
    }

}
