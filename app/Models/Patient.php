<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['name', 'address'];
    protected $fillable = ['name', 'address', 'email', 'phone', 'password', 'gender', 'date_of_birth', 'blood_type'];
}