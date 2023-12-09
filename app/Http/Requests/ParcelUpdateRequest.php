<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParcelUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $parcelId = $this->parcel->id;
        return [
            'code' => "required|string|max:255|unique:parcels,code,$parcelId",
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'address' => 'required|string|max:255',
            'comment' => 'required'
        ];
    }
}
