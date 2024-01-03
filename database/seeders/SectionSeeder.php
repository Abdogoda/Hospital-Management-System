<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\SectionTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder{

    public function run(): void{
        DB::table('sections')->delete();
        $Sections = [
            ['name' => 'Department of Surgery'],
            ['name' => 'Operations department'],
            ['name' => 'x_ray place'],
            ['name' => 'Laboratory department'],
            ['name' => 'Department of Neurology'],
            ['name' => 'Department of Cardiology'],
            ['name' => 'children section'],
        ];
        $Section_translations = [
            ['locale' => 'ar', 'name' => 'قسم الجراحة', 'section_id' => 1],
            ['locale' => 'ar', 'name' => 'قسم العمليات', 'section_id' => 2],
            ['locale' => 'ar', 'name' => 'قسم الاشعة', 'section_id' => 3],
            ['locale' => 'ar', 'name' => 'قسم المختبرات', 'section_id' => 4],
            ['locale' => 'ar', 'name' => 'قسم المخ والاعصاب', 'section_id' => 5],
            ['locale' => 'ar', 'name' => 'قسم امراض القلب', 'section_id' => 6],
            ['locale' => 'ar', 'name' => 'قسم الاطفال', 'section_id' => 7],
        ];
        foreach($Sections as $section){
            Section::create($section);
        }
        foreach($Section_translations as $section_translation){
            SectionTranslation::create($section_translation);
        }
    }
}