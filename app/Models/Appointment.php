<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    // use Translatable;
    // public $translatedAttributes = ['name'];
    public $fillable = ['name', 'email', 'phone', 'notes', 'section_id', 'doctor_id', 'type','date'];

    public function Section(){
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function Doctor(){
        return $this->belongsTo(Doctor::class, 'section_id', 'id');
    }
}