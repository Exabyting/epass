<?php

use Illuminate\Database\Seeder;

class SystemConfigTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('system_config')->delete();

        \DB::table('system_config')->insert(
            [
                [
                    'key' => 'title',
                    'value' => 'Input Title',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ],
                [
                    'key' => 'address',
                    'value' => 'Input Address',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ],
                [
                    'key' => 'contact',
                    'value' => '+880-1234-123456',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ],
                [
                    'key' => 'email',
                    'value' => 'name@domain.com',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ],
                [
                    'key' => 'copyright-title',
                    'value' => 'Owner Title',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ],
                [
                    'key' => 'copyright-link',
                    'value' => 'Owner Web Address',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ],
                [
                    'key' => 'menu-title-en',
                    'value' => 'English Title Short Code',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ],
                [
                    'key' => 'menu-title-bn',
                    'value' => 'বাংলা টাইটেল শর্ট কোড',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ],
                [
                    'key' => 'site-icon',
                    'value' => 'Upload Icon Image',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ],
                [
                    'key' => 'site-logo',
                    'value' => 'Upload Logo Image',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ],
                [
                    'key' => 'site-banner',
                    'value' => 'Upload Banner Image ',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ],
                [
                    'key' => 'site-background',
                    'value' => 'Upload Login Background Image',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ],
            ]
        );


    }
}
