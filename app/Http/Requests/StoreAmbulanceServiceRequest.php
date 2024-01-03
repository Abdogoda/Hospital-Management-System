<?php

namespace App\Http\Requests;

use App\Models\Services;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAmbulanceServiceRequest extends FormRequest{

    public function rules(): array
    {
        return [
            'car_number' => 'required|numeric',
            'car_model' => 'required',
            'car_year_made' => 'required|date',
            'driver_license_number' => 'required|numeric',
            'driver_phone' => 'required|numeric',
            'car_type' => 'required|in:0,1',
            'driver_name' => 'required|unique:ambulance_translations,driver_name,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'car_number.required' => trans('Dashboard/validation.required'),
            'car_number.numeric' => trans('Dashboard/validation.numeric'),
            'car_model.required' => trans('Dashboard/validation.required'),
            'car_year_made.required' => trans('Dashboard/validation.required'),
            'car_year_made.date' => trans('Dashboard/validation.date'),
            'driver_license_number.required' => trans('Dashboard/validation.required'),
            'driver_license_number.numeric' => trans('Dashboard/validation.numeric'),
            'driver_phone.required' => trans('Dashboard/validation.required'),
            'driver_phone.numeric' => trans('Dashboard/validation.numeric'),
            'car_type.required' => trans('Dashboard/validation.required'),
            'car_type.range' => trans('Dashboard/validation.range'),
            'driver_name.required' => trans('Dashboard/validation.required'),
            'driver_name.unique' => trans('Dashboard/validation.unique'),
        ];
    }
}