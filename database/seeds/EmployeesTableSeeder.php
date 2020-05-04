<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('employees')->delete();

        \DB::table('employees')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'employee_id' => 'admin',
                    'first_name' => 'Selina',
                    'last_name' => 'Ahmed',
                    'photo' => 'employee/15670592785522155776f935b968ee033b378c7dce.png',
                    'email' => 'salina.pervez@ictd.gov.bd',
                    'gender' => 'female',
                    'department_id' => 2,
                    'designation_id' => 1,
                    'status' => 'present',
                    'mobile' => '01726731208',
                    'created_at' => '2019-08-27 16:35:38',
                    'updated_at' => '2019-08-29 12:14:39',
                    'deleted_at' => NULL,
                ),
            1 =>
                array (
                    'id' => 2,
                    'employee_id' => 'DS1',
                    'first_name' => 'Golam Mohammad',
                    'last_name' => 'Bhuaia',
                    'photo' => 'employee/156705941442c4d08885da7d7e25b043ef0a6a209c.png',
                    'email' => 'gmb@ictd.gov.bd',
                    'gender' => 'male',
                    'department_id' => 2,
                    'designation_id' => 5,
                    'status' => 'present',
                    'mobile' => '01716094068',
                    'created_at' => '2019-08-27 16:37:08',
                    'updated_at' => '2019-08-29 12:16:54',
                    'deleted_at' => NULL,
                ),
            2 =>
                array (
                    'id' => 3,
                    'employee_id' => 'AO1',
                    'first_name' => 'Fakhar Uddin',
                    'last_name' => 'Ahmed',
                    'photo' => 'employee/156705974111c232bfeb2eb19425cee2f4461c11ed.jpeg',
                    'email' => 'shakhsadee@hotmail.com',
                    'gender' => 'male',
                    'department_id' => 2,
                    'designation_id' => 10,
                    'status' => 'present',
                    'mobile' => '01670688668',
                    'created_at' => '2019-08-27 16:38:26',
                    'updated_at' => '2019-08-29 12:22:21',
                    'deleted_at' => NULL,
                ),
            3 =>
                array (
                    'id' => 5,
                    'employee_id' => 'ME1',
                    'first_name' => 'Md. Nabir',
                    'last_name' => 'Uddin',
                    'photo' => 'employee/156706012211c232bfeb2eb19425cee2f4461c11ed.jpeg',
                    'email' => 'nobir@ictd.gov.bd',
                    'gender' => 'male',
                    'department_id' => 1,
                    'designation_id' => 23,
                    'status' => 'present',
                    'mobile' => '01717178030',
                    'created_at' => '2019-08-27 18:59:27',
                    'updated_at' => '2019-08-29 12:28:42',
                    'deleted_at' => NULL,
                ),
            4 =>
                array (
                    'id' => 6,
                    'employee_id' => 'J.S.1',
                    'first_name' => 'Md. Khairul',
                    'last_name' => 'Amin',
                    'photo' => 'employee/1569738499f19d7e468865a22bb1a0851f29e6006c.png',
                    'email' => 'khairul.amin@ictd.gov.bd',
                    'gender' => 'male',
                    'department_id' => 12,
                    'designation_id' => 1,
                    'status' => 'present',
                    'mobile' => '01727674265',
                    'created_at' => '2019-09-11 14:34:40',
                    'updated_at' => '2019-09-29 12:28:19',
                    'deleted_at' => NULL,
                ),
            5 =>
                array (
                    'id' => 7,
                    'employee_id' => 'J.S.2',
                    'first_name' => 'Md.Saarker',
                    'last_name' => 'Alam',
                    'photo' => 'employee/1568191200b5375f0fd9fe388a0dcc9e6bb775b847.jpeg',
                    'email' => 'ssarker@ictd.gov.bd',
                    'gender' => 'male',
                    'department_id' => 11,
                    'designation_id' => 1,
                    'status' => 'present',
                    'mobile' => '01550150635',
                    'created_at' => '2019-09-11 14:40:01',
                    'updated_at' => '2019-09-11 14:40:01',
                    'deleted_at' => NULL,
                ),
            6 =>
                array (
                    'id' => 8,
                    'employee_id' => 'J.S.3',
                    'first_name' => 'Md.Amzad Ahmed',
                    'last_name' => 'Bapari',
                    'photo' => 'employee/1568191394aa6269625f7bae7357c4a9053b7a6922.jpeg',
                    'email' => 'amjadbapari@gmail.com',
                    'gender' => 'male',
                    'department_id' => 6,
                    'designation_id' => 1,
                    'status' => 'present',
                    'mobile' => '01711909766',
                    'created_at' => '2019-09-11 14:43:14',
                    'updated_at' => '2019-09-11 14:43:14',
                    'deleted_at' => NULL,
                ),
            7 =>
                array (
                    'id' => 9,
                    'employee_id' => 'J.S.4',
                    'first_name' => 'Ahesanul',
                    'last_name' => 'Parvez',
                    'photo' => 'employee/15681915597c64cf68b15737306723cf42484c1005.jpeg',
                    'email' => 'parvez770@ictd.gov.bd',
                    'gender' => 'male',
                    'department_id' => 4,
                    'designation_id' => 1,
                    'status' => 'present',
                    'mobile' => '01715087778',
                    'created_at' => '2019-09-11 14:45:59',
                    'updated_at' => '2019-09-11 14:45:59',
                    'deleted_at' => NULL,
                ),
            8 =>
                array (
                    'id' => 10,
                    'employee_id' => 'D.S.2',
                    'first_name' => 'Mehedi',
                    'last_name' => 'Hasan',
                    'photo' => 'employee/156819208267711f42c6d295e60d2b69659c9dd6f7.jpeg',
                    'email' => 'mehedi@ictd.gov.bd',
                    'gender' => 'male',
                    'department_id' => 5,
                    'designation_id' => 5,
                    'status' => 'present',
                    'mobile' => '01552476487',
                    'created_at' => '2019-09-11 14:54:42',
                    'updated_at' => '2019-09-11 14:54:42',
                    'deleted_at' => NULL,
                ),
            9 =>
                array (
                    'id' => 11,
                    'employee_id' => 'D.S.3',
                    'first_name' => 'Moynul',
                    'last_name' => 'Bhuaiya',
                    'photo' => 'employee/15681925855f9ec7564ecdcb4756fdce03d1d66525.jpeg',
                    'email' => 'moynul@ictd.gov.bd',
                    'gender' => 'male',
                    'department_id' => 5,
                    'designation_id' => 5,
                    'status' => 'present',
                    'mobile' => '01711385917',
                    'created_at' => '2019-09-11 15:03:05',
                    'updated_at' => '2019-09-11 15:03:05',
                    'deleted_at' => NULL,
                ),
            10 =>
                array (
                    'id' => 12,
                    'employee_id' => 'D.S.4',
                    'first_name' => 'Md Monirul',
                    'last_name' => 'Islam',
                    'photo' => 'employee/156819282305077df8f59d3d44f14d8185800a3895.jpeg',
                    'email' => 'monirul@ictd.gov.bd',
                    'gender' => 'male',
                    'department_id' => 3,
                    'designation_id' => 5,
                    'status' => 'present',
                    'mobile' => '01882406482',
                    'created_at' => '2019-09-11 15:07:03',
                    'updated_at' => '2019-09-11 15:07:03',
                    'deleted_at' => NULL,
                ),
            11 =>
                array (
                    'id' => 13,
                    'employee_id' => 'A.O.2',
                    'first_name' => 'Md. Shorif',
                    'last_name' => 'Islam',
                    'photo' => 'employee/1568193214ed478974e5245f08e235d1e7622fdfbc.jpeg',
                    'email' => 'shorifislam11@gmail.com',
                    'gender' => 'male',
                    'department_id' => 3,
                    'designation_id' => 9,
                    'status' => 'present',
                    'mobile' => '01922275654',
                    'created_at' => '2019-09-11 15:13:34',
                    'updated_at' => '2019-09-11 15:13:34',
                    'deleted_at' => NULL,
                ),
            12 =>
                array (
                    'id' => 14,
                    'employee_id' => 'A.O.3',
                    'first_name' => 'Chaina',
                    'last_name' => 'Akter',
                    'photo' => 'employee/15681933598d9283592f9577967dab74f4fded6c17.jpeg',
                    'email' => 'rimimoict@gmail.com',
                    'gender' => 'female',
                    'department_id' => 2,
                    'designation_id' => 9,
                    'status' => 'present',
                    'mobile' => '01923410711',
                    'created_at' => '2019-09-11 15:15:59',
                    'updated_at' => '2019-09-11 15:15:59',
                    'deleted_at' => NULL,
                ),
        ));


    }
}
