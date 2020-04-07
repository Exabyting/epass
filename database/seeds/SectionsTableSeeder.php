<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sections')->delete();
        
        \DB::table('sections')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Revenue Section',
                'section_code' => 'RSCE',
                'section_head_employee_id' => NULL,
                'department_id' => 2,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:19:03',
                'updated_at' => '2019-08-27 13:19:03',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Development Section',
                'section_code' => 'DSEC',
                'section_head_employee_id' => NULL,
                'department_id' => 2,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:19:37',
                'updated_at' => '2019-08-27 13:19:37',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Accounts section',
                'section_code' => 'ASC',
                'section_head_employee_id' => NULL,
                'department_id' => 2,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:20:10',
                'updated_at' => '2019-08-27 13:20:10',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Personnel Service Section',
                'section_code' => 'PSEC',
                'section_head_employee_id' => NULL,
                'department_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:20:35',
                'updated_at' => '2019-08-27 13:20:35',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Logistic Service Section',
                'section_code' => 'LOGSEC',
                'section_head_employee_id' => NULL,
                'department_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:21:18',
                'updated_at' => '2019-08-27 13:21:18',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'National Parliament & Inter-Ministrial Section',
                'section_code' => 'NPISEC',
                'section_head_employee_id' => NULL,
                'department_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:21:52',
                'updated_at' => '2019-08-27 13:21:52',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Organisation-1 Section',
                'section_code' => 'O1SC',
                'section_head_employee_id' => NULL,
                'department_id' => 5,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:22:21',
                'updated_at' => '2019-08-27 13:22:21',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Organisation-2 Section',
                'section_code' => 'O2SC',
                'section_head_employee_id' => NULL,
                'department_id' => 5,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:23:24',
                'updated_at' => '2019-08-27 13:23:24',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'International Affairs & Events Section',
                'section_code' => 'IAESC',
                'section_head_employee_id' => NULL,
                'department_id' => 5,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:24:36',
                'updated_at' => '2019-08-27 13:24:36',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'ICT Promotion Section',
                'section_code' => 'ICTPSEC',
                'section_head_employee_id' => NULL,
                'department_id' => 5,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:25:03',
                'updated_at' => '2019-08-27 13:25:03',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Program Section',
                'section_code' => 'PrSC',
                'section_head_employee_id' => NULL,
                'department_id' => 7,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:25:39',
                'updated_at' => '2019-08-27 13:25:39',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Project Section',
                'section_code' => 'PSC',
                'section_head_employee_id' => NULL,
                'department_id' => 7,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:26:21',
                'updated_at' => '2019-08-27 13:26:21',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Coordinate Section',
                'section_code' => 'CSEC',
                'section_head_employee_id' => NULL,
                'department_id' => 8,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:26:50',
                'updated_at' => '2019-08-27 13:26:50',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Evaluation & Monitoring Section',
                'section_code' => 'EMSEC',
                'section_head_employee_id' => NULL,
                'department_id' => 8,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:28:17',
                'updated_at' => '2019-08-27 13:28:17',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'e-Service operation Section',
                'section_code' => 'eSoSEC',
                'section_head_employee_id' => NULL,
                'department_id' => 10,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:29:09',
                'updated_at' => '2019-08-27 13:29:09',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'e-Service Development & Maintenance Section',
                'section_code' => 'eSDMSEC',
                'section_head_employee_id' => NULL,
                'department_id' => 10,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:30:00',
                'updated_at' => '2019-08-27 13:30:00',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Research & Scholarship Section',
                'section_code' => 'RScSEC',
                'section_head_employee_id' => NULL,
                'department_id' => 11,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:30:48',
                'updated_at' => '2019-08-27 13:30:48',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Standard & Security Section',
                'section_code' => 'SSSEC',
                'section_head_employee_id' => NULL,
                'department_id' => 11,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:34:24',
                'updated_at' => '2019-08-27 13:34:24',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Act, Rules & Regulations Section',
                'section_code' => 'ARRSEC',
                'section_head_employee_id' => NULL,
                'department_id' => 12,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:34:50',
                'updated_at' => '2019-08-27 13:34:50',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Policy Section',
                'section_code' => 'Posec',
                'section_head_employee_id' => NULL,
                'department_id' => 12,
                'deleted_at' => NULL,
                'created_at' => '2019-08-27 13:35:27',
                'updated_at' => '2019-08-27 13:35:27',
            ),
        ));
        
        
    }
}