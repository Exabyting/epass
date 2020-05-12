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
                    'description' => 'Can see Approved Report',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            3 =>
                array (
                    'id' => 5,
                    'name' => 'ROLE_HRM_SETTING_ACCESS',
                    'description' => 'Can access settings of HRM',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            4 =>
                array (
                    'id' => 6,
                    'name' => 'ROLE_SPECIAL_ACCESS',
                    'description' => 'Can access HRM when system is shutdown',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),

            5 =>
                array (
                    'id' => 9,
                    'name' => 'ROLE_SITE_ADMIN',
                    'description' => 'Can access system configurations',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
        ));


    }
}
