<?php

namespace App\Http\Requests\Rent;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
//    public function authorize(): bool
//    {
//        return true;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules(): array
    {
        return [
            'client_id' => 'required|integer|exists:clients,id',
            'employee_id' =>'required|integer|exists:employees,id',
            'inventory_id' =>'required|integer|exists:inventories,id',
            'price_day'=>'required|boolean'
        ];
    }
}
