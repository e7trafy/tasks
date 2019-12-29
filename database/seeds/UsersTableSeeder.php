<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([[
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'password' => Hash::make('admin123'),
            'remember_token' => Str::random(10),
        ],[
            'name' => 'member',
            'email' => 'member@tasks.com',
            'email_verified_at' => now(),
            'role' => 'member',
            'password' => Hash::make('member'),
            'remember_token' => Str::random(10),
        ]]);
        factory(App\User::class, 10)->create();
    }
}
