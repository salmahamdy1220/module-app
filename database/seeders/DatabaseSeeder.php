<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        $this->call([

            SuperAdminSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            SuperRolesAndPermissionsSeeder::class,
            AdminRolesAndPermissionsSeeder::class,
        ]);

        // foreach (Module::allEnabled() as $module) {
        //     $moduleName = $module->getName();
        //     $seederClass = "Modules\\$moduleName\\Database\\Seeders\\{$moduleName}DatabaseSeeder";

        //     if (class_exists($seederClass)) {
        //         $this->call($seederClass);
        //     }
        // }
    }
}
