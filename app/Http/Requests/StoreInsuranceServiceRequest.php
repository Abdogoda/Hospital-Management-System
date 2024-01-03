<?php

namespace App\Http\Requests;

use App\Models\Services;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInsuranceServiceRequest extends FormRequest{

    public function rules(): array
    {
        return [
            'insurance_code' => 'required',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'company_rate' => 'required|numeric|min:0|max:100',
            'name' => 'required|unique:insurance_translations,name,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('Dashboard/validation.required'),
            'name.unique' => trans('Dashboard/validation.unique'),
            'insurance_code.required' => trans('Dashboard/validation.required'),
            'discount_percentage.required' => trans('Dashboard/validation.required'),
            'discount_percentage.numeric' => trans('Dashboard/validation.numeric'),
            'company_rate.required' => trans('Dashboard/validation.required'),
            'discount_percentage.min' => trans('Dashboard/validation.min'),
            'company_rate.min' => trans('Dashboard/validation.min'),
            'discount_percentage.max' => trans('Dashboard/validation.max'),
            'company_rate.max' => trans('Dashboard/validation.max'),
            'company_rate.numeric' => trans('Dashboard/validation.numeric'),
        ];
    }
}