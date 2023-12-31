<?php

namespace Database\Seeders;

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
        $user = \App\Models\User::create([
            'name'  =>  'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin1'),
	'authority' => 'admin',
        ]);
    }
}
