<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $aaron = \App\User::where('name', 'Aaron')->first();
        $aaronVcard = \App\Vcard::where('name_first', 'Aaron')->first();

        $chris = \App\User::where('name', 'Chris')->first();
        $chrisVcard = \App\Vcard::where('name_first', 'Robert')->first();

        $erik = \App\User::where('name', 'Erik')->first();
        $erikVcard = \App\Vcard::where('name_first', 'Erik')->first();

        DB::table('contacts')->insert([
            'user_id' => $chris->id,
            'vcard_id' => $chrisVcard->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('contacts')->insert([
            'user_id' => $chris->id,
            'vcard_id' => $erikVcard->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('contacts')->insert([
            'user_id' => $chris->id,
            'vcard_id' => $aaronVcard->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('contacts')->insert([
            'user_id' => $erik->id,
            'vcard_id' => $chrisVcard->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}
