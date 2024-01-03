<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorie extends Model
{
    use HasFactory;
    public function Images(){
        return $this->morphMany(Image::class, 'imageable');
    }
    public function Doctor(){
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    public function LaboratoryEmployee(){
        return $this->belongsTo(LaboratoryEmployee::class, 'employee_id');
    }
    public function Patient(){
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}