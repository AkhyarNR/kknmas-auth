<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $date = Carbon::now();
        // $createdDate = clone($date);
        DB::table('acd_kkn_users')->insert([
            'Username' => 'adminumy',
            'Password' => Hash::make('password'),
            'Role_Id' => 1,
            'University_Id' => 1,
            // 'created_at' => Carbon::now(),
            // 'updated_at' => $createdDate,
        ]);
    }
}
