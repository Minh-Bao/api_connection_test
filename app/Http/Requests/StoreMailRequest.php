<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMailRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'eidas' => 'boolean|max:1',   
            'custom_name_sender' => 'nullable|string|max:30' ,
            'to_lastname' => 'required_unless:dest_statut,professionnel|nullable|string|max:30' ,
            'to_firstname' => 'required_unless:dest_statut,professionnel|nullable|string|max:20' ,
            'to_company' => 'required_if:dest_statut,professionnel|nullable|string|max:20' ,
            'to_email' => 'required|email|max:30' ,
            'dest_statut' => [Rule::in(['particulier', 'professionnel']), 'required', 'string'] ,
            'content' => 'nullable|string|max:8000' ,
            'attachment' => 'sometimes|array' ,
    ];
    }
}
