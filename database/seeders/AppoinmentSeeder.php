<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\AppointmentTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppoinmentSeeder extends Seeder{

    public function run(): void{
        DB::table('appointments')->delete();
        $Apppointments = [
            ['name' => 'Saturday'],
            ['name' => 'Sunday'],
            ['name' => 'Monday'],
            ['name' => 'Tuesday'],
            ['name' => 'Wednesday'],
            ['name' => 'Thursday'],
            ['name' => 'Friday'],
        ];
        $Apppointment_translations = [
            ['locale' => 'ar', 'name' => 'السبت', 'appointment_id' => 1],
            ['locale' => 'ar', 'name' => 'الاحد', 'appointment_id' => 2],
            ['locale' => 'ar', 'name' => 'الاثنين', 'appointment_id' => 3],
            ['locale' => 'ar', 'name' => 'الثلاثاء', 'appointment_id' => 4],
            ['locale' => 'ar', 'name' => 'الاربعاء', 'appointment_id' => 5],
            ['locale' => 'ar', 'name' => 'الخميس', 'appointment_id' => 6],
            ['locale' => 'ar', 'name' => 'الجمعة', 'appointment_id' => 7],
        ];
        foreach($Apppointments as $appointment){
            Appointment::create($appointment);
        }
        foreach($Apppointment_translations as $Apppointment_translation){
            AppointmentTranslation::create($Apppointment_translation);
        }
    }
}