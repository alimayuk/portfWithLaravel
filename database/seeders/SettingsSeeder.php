<?php

namespace Database\Seeders;

use App\Models\create_settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        create_settings::create([
            "logo"=> "lorem",
            "footerText"=> "lorem",
            "aboutText"=> "lorem",
            "feature_cat_is_active"=> 1,
        ]);
    }
}
