<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTenant extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(3);

        return [
            'name'  => ['required', 'min:4', 'max:32', "unique:tenants,name,{$id},id"],
            'cnpj'  => ['required', 'regex:/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/', "unique:tenants,cnpj,{$id},id"],
            'email' => ['required', 'email', "unique:tenants,email,{$id},id"],
        ];
    }
}
