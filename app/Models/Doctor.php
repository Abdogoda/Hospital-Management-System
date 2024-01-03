<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doctor extends Authenticatable{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable=['name','appointments','email','email_verified_at', 'password','phone', 'status', 'section_id'];

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
    public function section(): BelongsTo{
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
}