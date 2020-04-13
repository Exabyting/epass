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
                'created_at' => '2020-04-13  13:38:14',
                'updated_at' => '2020-04-13  13:38:14',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
            'name' => 'Personal Officer (P.O)',
                'short_name' => 'P.O',
                'created_at' => '2020-04-13  13:39:51',
                'updated_at' => '2020-04-13  13:39:51',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Office support staff',
                'short_name' => 'O.S.S',
                'created_at' => '2020-04-13  13:40:35',
                'updated_at' => '2020-04-13  13:40:35',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Additional Secretary',
                'short_name' => 'A.S',
                'created_at' => '2020-04-13  13:41:05',
                'updated_at' => '2020-04-13  13:41:05',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Deputy Secretary',
                'short_name' => 'D.S',
                'created_at' => '2020-04-13  13:41:37',
                'updated_at' => '2020-04-13 13:41:37',
                'deleted_at' => NULL,
            ),
        ));


    }
}
