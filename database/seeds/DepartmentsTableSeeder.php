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
                'created_at' => '2019-08-27 13:14:28',
                'updated_at' => '2019-08-27 13:14:28',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Budget Branch',
                'department_code' => 'BGTBR',
                'created_at' => '2019-08-27 13:14:51',
                'updated_at' => '2019-08-27 13:14:51',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Internal Service Branch',
                'department_code' => 'ISBR',
                'created_at' => '2019-08-27 13:15:10',
                'updated_at' => '2019-08-27 13:15:10',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Organisational Support & Innovation Wing',
                'department_code' => 'OSIW',
                'created_at' => '2019-08-27 13:15:27',
                'updated_at' => '2019-08-27 13:15:27',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Organisational Support & Innovation Branch',
                'department_code' => 'OSIBR',
                'created_at' => '2019-08-27 13:15:45',
                'updated_at' => '2019-08-27 13:15:45',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Planning & Development Wing',
                'department_code' => 'PDW',
                'created_at' => '2019-08-27 13:15:57',
                'updated_at' => '2019-08-27 13:15:57',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Planning Branch',
                'department_code' => 'PBR',
                'created_at' => '2019-08-27 13:16:17',
                'updated_at' => '2019-08-27 13:16:17',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Development Brunch',
                'department_code' => 'DEVBR',
                'created_at' => '2019-08-27 13:16:30',
                'updated_at' => '2019-08-27 13:16:30',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
            'name' => 'Ict Wing (Additional Secretary)',
                'department_code' => 'IctW',
                'created_at' => '2019-08-27 13:16:56',
                'updated_at' => '2019-08-27 13:16:56',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'System Development & operation Branch',
                'department_code' => 'SDOBR',
                'created_at' => '2019-08-27 13:17:11',
                'updated_at' => '2019-08-27 13:17:11',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'e-Service Delivery Branch',
                'department_code' => 'eSDBR',
                'created_at' => '2019-08-27 13:17:26',
                'updated_at' => '2019-08-27 13:17:26',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'e-Service Policy Act branch',
                'department_code' => 'eSPABR',
                'created_at' => '2019-08-27 13:17:40',
                'updated_at' => '2019-08-27 13:17:40',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}