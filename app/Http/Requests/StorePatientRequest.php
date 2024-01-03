<?php

namespace App\Http\Requests;

use App\Models\Services;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePatientRequest extends FormRequest{

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:patients,email,'.$this->id,
            'phone' => 'required|unique:patients,phone,'.$this->id,
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:0,1',
            'blood_type' => 'required',
            'address' => 'required',
            'name' => 'required|unique:patient_translations,name,'.$this->id.',patient_id',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => trans('Dashboard/validation.required'),
            'email.email' => trans('Dashboard/validation.email'),
            'email.unique' => trans('Dashboard/validation.unique'),
            'phone.required' => trans('Dashboard/validation.required'),
            'phone.unique' => trans('Dashboard/validation.unique'),
            'date_of_birth.required' => trans('Dashboard/validation.required'),
            'date_of_birth.date' => trans('Dashboard/validation.date'),
            'gender.required' => trans('Dashboard/validation.required'),
            'gender.range' => trans('Dashboard/validation.range'),
            'blood_type.required' => trans('Dashboard/validation.required'),
            'blood_type.max' => trans('Dashboard/validation.max'),
            'address.required' => trans('Dashboard/validation.required'),
            'name.required' => trans('Dashboard/validation.required'),
            'name.unique' => trans('Dashboard/validation.unique'),
        ];
    }
}