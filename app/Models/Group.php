<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name', 'notes'];
    protected $fillable=['name','notes','total_before_discount','discount_value', 'total_after_discount','tax_rate', 'total_with_tax'];

    public function service_group(){
        return $this->belongsToMany(Service::class,'group_services')->withPivot('quantity');
    }
}