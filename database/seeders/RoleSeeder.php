<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Role::create(['name'=>'Suber-Admin','guard_name'=>'admin']);
       Role::create(['name'=>'Hr-Admin','guard_name'=>'admin']);
       Role::create(['name'=>'content-Manager','guard_name'=>'admin']);
       Role::create(['name'=>'Suber-User','guard_name'=>'web']);
      
     
    }
}
