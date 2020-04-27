<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'ROLE_SUPER_ADMIN',
                'description' => 'Can Access system users info',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'ROLE_HRM_ACCESS',
                'description' => 'Can access HRM',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'ROLE_SYSTEM_ANALYST',
                'description' => 'Can see Approved Request',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'ROLE_OFFICER_REQUEST_ACCESS',
                'description' => 'Can request for Officer',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}
