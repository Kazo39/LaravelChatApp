<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "first_name" => "Filip",
                "last_name" => "Filipovic",
                "email" => "filip@mail.com",
                "password" => Hash::make('12345')
            ],
            [
                "first_name" => "Janko",
                "last_name" => "Jankovic",
                "email" => "janko@mail.com",
                "password" => Hash::make('12345')
            ],
            [
                "first_name" => "Marko",
                "last_name" => "Markovic",
                "email" => "marko@mail.com",
                "password" => Hash::make('12345')
            ]
        ];

        foreach ($users as $user){
            User::query()->create($user);
        }
    }
}
