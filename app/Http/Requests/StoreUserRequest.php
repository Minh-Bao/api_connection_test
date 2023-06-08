<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'company_siret' =>Str::remove(' ', $this->company_siret),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:20',
            'email' => 'required|email|max:40',
            'gender' => 'required|string|max:1|min:1',
            'statut' => 'required|string|max:30',
            'company' => 'required|string|max:30',
            'company_siret' => 'required|string|max:14|min:9',
            'company_tva' => 'required|string|max:30',
            'country' => 'required|string|max:2',
            'address1' => 'required|string|max:60',
            'address2' => 'nullable|string|max:60',
            'zipcode' => 'required|string|max:7',
            'city' => 'required|string|max:30',
            'password' => 'required|string|min:4',
            'confirmed' => 'boolean|max:1',
            'billing_email' => 'nullable|email|max:30',
            'notify_ev' => 'boolean|max:1',
            'notify_ar' => 'boolean|max:1',
            'notify_ng' =>  'boolean|max:1',
            'notify_consent' =>  'boolean|max:1',
            'notify_eidas_to_valid' => 'boolean|max:1',
            'notify_recipient_update' =>  'boolean|max:1',
            'notify_waiting_ar_answer' =>  'boolean|max:1', 
            'is_legal_entity' =>  'boolean|max:1'
        ];
    }
}
