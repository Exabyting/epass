<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('departments')->delete();

        \DB::table('departments')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'General Service Wing',
                'department_code' => 'GSW',
                'created_at' => '2020-04-13 13:14:28',
                'updated_at' => '2020-04-13 13:14:28',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Planning & Development Wing',
                'department_code' => 'PDW',
                'created_at' => '2020-04-13 13:14:51',
                'updated_at' => '2020-04-13 13:14:51',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Internal Service Branch',
                'department_code' => 'ISBR',
                'created_at' => '2020-04-13 13:15:10',
                'updated_at' => '2020-04-13 13:15:10',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Organisational Support & Innovation Wing',
                'department_code' => 'OSIW',
                'created_at' => '2020-04-13 13:15:27',
                'updated_at' => '2020-04-13 13:15:27',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Organisational Support & Innovation Branch',
                'department_code' => 'OSIBR',
                'created_at' => '2020-04-13 13:15:45',
                'updated_at' => '2020-04-13 13:15:45',
                'deleted_at' => NULL,
            )

        ));


    }
}
