<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,100) as $index) {
            DB::table('students')->insert([
                'name' => Str::random(8),
                'email' => Str::random(12).'@mail.com',
                'username' => Str::random(4),
                'phone' => Str::random(11),
                'dob' => \Carbon::now()->subMinutes(rand(1, 55)),
            ]);
        }
    }
}
