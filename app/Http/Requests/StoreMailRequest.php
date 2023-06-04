<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'custom_name_sender' => 'string|max:20' ,
            'to_lastname' => 'string|max:20' ,
            'to_firstname' => 'string|max:20' ,
            'to_company' => 'string|max:20' ,
            'to_email' => 'string|max:20' ,
            'dest_statut' => 'string|max:20' ,
            'content' => 'string|max:20' ,
            'ref_dossier' => 'string|max:20' ,
            'attachment' => 'string|max:20' ,
    ];
    }
}
