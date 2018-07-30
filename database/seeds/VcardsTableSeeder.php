<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VcardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */






    public function run()
    {


        $aaron = \App\User::where('name', 'Aaron')->first();
        $chris = \App\User::where('name', 'Chris')->first();
        $erik = \App\User::where('name', 'Erik')->first();




        DB::table('vcards')->insert([
            'user_id' => $erik->id,

            'name_first' => 'Aaron',
            'name_last' => 'Carter',

            'organization_name' => 'NSYNC',
            'organization_title' => 'NSYNC',

            'phone_cell' => '1234567890',

            'address_home' => '234 Walk This Way',

            'email_personal' => 'aaroncarter@example.com',

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('vcards')->insert([
            'user_id' => $erik->id,

            'name_first' => 'Robert',
            'name_middle' => 'Christopher',
            'name_last' => 'Browder',

            'organization_title' => 'Awesome',

            'phone_cell' => '8595823333',

            'address_home' => '234 Don\'t Ask Drive',


            'email_personal' => 'rcbrowder@example.com',

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        DB::table('vcards')->insert([
            'user_id' => $chris->id,


            'name_first' => 'Erik',
            'name_middle' => 'Christian',
            'name_last' => 'Wolfe',

            'organization_name' => 'Wolfe Boys LLC',
            'organization_title' => 'Wolfers',

            'phone_home' => '4927201091',
            'phone_work' => '9283742023',
            'phone_cell' => '8595823333',

            'address_work' => '69 Wolfe Daddy Drive',
            'address_home' => '420 Wolfenstein Way',


            'email_personal' => 'erikwolfe@example.com',
            'email_work' => 'wolfedaddy@example.com',

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }


}
