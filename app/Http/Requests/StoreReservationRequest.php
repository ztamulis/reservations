<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'restaurant_id' => 'required|integer',
            'start_from' => 'required|date|after:now()',
            'length' => 'required|integer',
            'orderer_first_name' => 'required|string',
            'orderer_last_name' => 'required|string',
            'orderer_email' => 'required|email',
            'orderer_phone' => 'required|string',
            'costumer_first_name' => 'required|array|nullable',
            'costumer_last_name' => 'required|array|nullable',
            'costumer_email' => 'required|array|nullable',
        ];
    }
}
