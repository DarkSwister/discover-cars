<?php

namespace App\Http\Requests;

use App\Services\Discovercars\ValueObjects\Price;
use App\Services\Discovercars\ValueObjects\Vehicle;
use App\Services\Discovercars\ValueObjects\Vendor;
use Illuminate\Foundation\Http\FormRequest;

class SingleOfferRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'offer' => [
                'offerUId' => ['required', 'string'],
                Price::rules(),
                Vehicle::rules(),
                Vendor::rules(),
            ]];
    }
}
