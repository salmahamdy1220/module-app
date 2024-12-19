<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {



        $admin  = Admin::create([
            'name' =>'Sara Ahmed',
            'email'=>'sara@s.com',
            'password'=>Hash::make('123456789'),

         ]);

         $admin  = Admin::create([
            'name' =>'Omer Khaled',
            'email'=>'omer@o.com',
            'password'=>Hash::make('123456789'),

         ]);


         $admin  = Admin::create([
            'name' =>'Angham Hassan',
            'email'=>'angham@a.com',
            'password'=>Hash::make('123456789'),

         ]);


    }
}
