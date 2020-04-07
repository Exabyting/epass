<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('role_user')->delete();

        \DB::table('role_user')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'role_id' => 2,
                    'user_id' => 1,
                    'created_at' => '2019-07-28 20:33:59',
                    'updated_at' => '2019-07-28 20:33:59',
                ),
            1 =>
                array(
                    'id' => 2,
                    'role_id' => 2,
                    'user_id' => 2,
                    'created_at' => '2019-08-27 16:43:48',
                    'updated_at' => '2019-08-27 16:43:48',
                ),
            2 =>
                array(
                    'id' => 3,
                    'role_id' => 2,
                    'user_id' => 3,
                    'created_at' => '2019-08-27 16:43:56',
                    'updated_at' => '2019-08-27 16:43:56',
                ),
            3 =>
                array(
                    'id' => 4,
                    'role_id' => 1,
                    'user_id' => 5,
                    'created_at' => '2019-08-27 19:01:01',
                    'updated_at' => '2019-08-27 19:01:01',
                ),
            4 =>
                array(
                    'id' => 5,
                    'role_id' => 2,
                    'user_id' => 5,
                    'created_at' => '2019-08-27 19:01:01',
                    'updated_at' => '2019-08-27 19:01:01',
                ),
            5 =>
                array(
                    'id' => 6,
                    'role_id' => 3,
                    'user_id' => 5,
                    'created_at' => '2019-08-27 19:01:01',
                    'updated_at' => '2019-08-27 19:01:01',
                ),
            6 =>
                array(
                    'id' => 7,
                    'role_id' => 4,
                    'user_id' => 3,
                    'created_at' => '2019-09-08 15:06:06',
                    'updated_at' => '2019-09-08 15:06:06',
                ),
            7 =>
                array(
                    'id' => 8,
                    'role_id' => 5,
                    'user_id' => 5,
                    'created_at' => '2019-09-10 13:00:00',
                    'updated_at' => '2019-09-10 13:00:00',
                ),
            8 =>
                array(
                    'id' => 9,
                    'role_id' => 1,
                    'user_id' => 1,
                    'created_at' => '2019-07-28 20:33:59',
                    'updated_at' => '2019-07-28 20:33:59',
                ),
            9 =>
                array(
                    'id' => 10,
                    'role_id' => 9,
                    'user_id' => 1,
                    'created_at' => '2019-07-28 20:33:59',
                    'updated_at' => '2019-07-28 20:33:59',
                ),
        ));


    }
}
