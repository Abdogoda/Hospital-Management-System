<?php

namespace App\Http\Requests;

use App\Models\Services;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSingleServiceRequest extends FormRequest{

    public function rules(): array
    {
        return [
            'name' => 'required|unique:service_translations,name,'.$this->id.'service_id',
            'price' => 'numeric|required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('Dashboard/validation.required'),
            'name.unique' => trans('Dashboard/validation.unique'),
            'price.required' => trans('Dashboard/validation.required'),
            'price.numeric' => trans('Dashboard/validation.numeric'),
        ];
    }
}