<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'client_id' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required',
        ];

        if ($this->isMethod('put')) {
            $rules['client_id'] = '';
        }

        return $rules;
    }
}
