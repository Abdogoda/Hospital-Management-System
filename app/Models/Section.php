<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name','description'];
    protected $fillable=['name','description'];


    public function doctors(): HasMany{
        return $this->hasMany(Doctor::class);
    }
}