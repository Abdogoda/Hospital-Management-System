<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder{

    public function run(): void{
        DB::table('services')->delete();
        $services = [
            ['name' => 'Radiation on the heart', 'price' => 100],
            ['name' => 'Blood analysis', 'price' => 150],
            ['name' => 'Bones detection', 'price' => 200],
            ['name' => 'Stomach detection', 'price' => 250],
            ['name' => 'Brain detection', 'price' => 300],
            ['name' => 'Heart disease Detection', 'price' => 400],
            ['name' => 'Childrens disease Detection', 'price' => 450],
            ['name' => 'Gynecological disease Detection', 'price' => 500],
            ['name' => 'Nose and ear detection', 'price' => 350],
        ];
        $service_translations = [
            ['locale' => 'ar', 'name' => 'اشعة علي القلب', 'service_id' => 1],
            ['locale' => 'ar', 'name' => 'تحليل دم', 'service_id' => 2],
            ['locale' => 'ar', 'name' => 'كشف عظام', 'service_id' => 3],
            ['locale' => 'ar', 'name' => 'كشف باطنة', 'service_id' => 4],
            ['locale' => 'ar', 'name' => 'كشف مخ والاعصاب', 'service_id' => 5],
            ['locale' => 'ar', 'name' => 'كشف امراض القلب', 'service_id' => 6],
            ['locale' => 'ar', 'name' => 'كشف الاطفال', 'service_id' => 7],
            ['locale' => 'ar', 'name' => 'كشف امراض النساء', 'service_id' => 8],
            ['locale' => 'ar', 'name' => 'كشف انف واذن', 'service_id' => 9],
        ];
        foreach($services as $service){
            Service::create($service);
        }
        foreach($service_translations as $service_translation){
            ServiceTranslation::create($service_translation);
        }
    }
}