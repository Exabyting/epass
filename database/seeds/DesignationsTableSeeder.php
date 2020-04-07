<?php

use Illuminate\Database\Seeder;

class DesignationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('designations')->delete();
        
        \DB::table('designations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Joint Secretary',
                'short_name' => 'JS',
                'created_at' => '2019-08-27 13:38:14',
                'updated_at' => '2019-08-27 13:38:14',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
            'name' => 'Personal Officer (P.O)',
                'short_name' => 'P.O',
                'created_at' => '2019-08-27 13:39:51',
                'updated_at' => '2019-08-27 13:39:51',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Office support staff',
                'short_name' => 'O.S.S',
                'created_at' => '2019-08-27 13:40:35',
                'updated_at' => '2019-08-27 13:40:35',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Additional Secretary',
                'short_name' => 'A.S',
                'created_at' => '2019-08-27 13:41:05',
                'updated_at' => '2019-08-27 13:41:05',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Deputy Secretary',
                'short_name' => 'D.S',
                'created_at' => '2019-08-27 13:41:37',
                'updated_at' => '2019-08-27 13:41:37',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Senior System Analyst',
                'short_name' => 'Sr.A',
                'created_at' => '2019-08-27 13:42:19',
                'updated_at' => '2019-08-27 13:42:19',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Computer Operator',
                'short_name' => 'Comp.O',
                'created_at' => '2019-08-27 13:43:01',
                'updated_at' => '2019-08-27 13:43:01',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'SAS/AS',
                'short_name' => 'SAS/AS',
                'created_at' => '2019-08-27 13:43:39',
                'updated_at' => '2019-08-27 13:43:39',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
            'name' => 'Administrative office (A.O)',
                'short_name' => 'A.O',
                'created_at' => '2019-08-27 13:44:09',
                'updated_at' => '2019-08-27 13:44:09',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Office assistant-cum-Computer Operator',
                'short_name' => 'Off.Comp.O',
                'created_at' => '2019-08-27 13:44:46',
                'updated_at' => '2019-08-27 13:44:46',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Accounts Officer',
                'short_name' => 'Acc.O',
                'created_at' => '2019-08-27 13:45:16',
                'updated_at' => '2019-08-27 13:45:16',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
            'name' => 'Assistant Accounts Office (Former Accountant)',
                'short_name' => 'A.A.O',
                'created_at' => '2019-08-27 13:45:53',
                'updated_at' => '2019-08-27 13:45:53',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Cashier',
                'short_name' => 'Cash.',
                'created_at' => '2019-08-27 13:46:22',
                'updated_at' => '2019-08-27 13:46:22',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Cash Sorker',
                'short_name' => 'Ca.S',
                'created_at' => '2019-08-27 13:46:51',
                'updated_at' => '2019-08-27 13:46:51',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Security Gaurd',
                'short_name' => NULL,
                'created_at' => '2019-08-27 13:47:27',
                'updated_at' => '2019-08-27 13:47:27',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Cleaner',
                'short_name' => NULL,
                'created_at' => '2019-08-27 13:47:48',
                'updated_at' => '2019-08-27 13:47:48',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'SAS/AC',
                'short_name' => 'SAS/AC',
                'created_at' => '2019-08-27 13:48:16',
                'updated_at' => '2019-08-27 13:48:16',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Programmer',
                'short_name' => 'Prg.',
                'created_at' => '2019-08-27 13:48:49',
                'updated_at' => '2019-08-27 13:48:49',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Assistant Programmer',
                'short_name' => 'Ass.Prg',
                'created_at' => '2019-08-27 13:49:18',
                'updated_at' => '2019-08-27 13:49:18',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Data Entry Operator',
                'short_name' => 'Dat.Op',
                'created_at' => '2019-08-27 13:50:02',
                'updated_at' => '2019-08-27 13:50:02',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Maintenance Engineer',
                'short_name' => 'Main.Eng',
                'created_at' => '2019-08-27 13:50:49',
                'updated_at' => '2019-08-27 13:50:49',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Assistant Maintenance Engineer',
                'short_name' => 'AMain.Eng',
                'created_at' => '2019-08-27 13:51:19',
                'updated_at' => '2019-08-27 13:51:19',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'System Analyst',
                'short_name' => 'SA1',
                'created_at' => '2019-08-29 12:23:42',
                'updated_at' => '2019-08-29 12:23:42',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}