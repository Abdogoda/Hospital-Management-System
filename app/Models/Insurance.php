<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['name', 'notes'];
    protected $fillable = ['name', 'notes', 'insurance_code', 'discount_percentage', 'company_rate', 'status'];
}