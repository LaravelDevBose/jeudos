<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin', 'influencer', 'fan'
        ];
        foreach($roles as $serial => $role){
            \Spatie\Permission\Models\Role::create(['name' => $role]);
        }
    }
}
