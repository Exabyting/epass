<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin')->delete();
        
        \DB::table('admin')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'shutdown',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2019-12-11 02:47:34',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'special',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2019-12-11 02:47:29',
            ),
        ));
        
        
    }
}