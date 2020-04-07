<?php

use Illuminate\Database\Seeder;

class NotificationTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notification_types')->delete();
        
        \DB::table('notification_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'ACR Request Notification',
                'description' => 'Annual Confidential Report Request',
                'is_application_notification' => 1,
                'is_email_notification' => 0,
                'is_sms_notification' => 0,
                'icon_name' => '',
                'created_at' => '2019-06-18 10:24:00',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'ACR Request Evaluation Submitted',
                'description' => 'Annual Confidential Report Evaluation Submitted',
                'is_application_notification' => 1,
                'is_email_notification' => 0,
                'is_sms_notification' => 0,
                'icon_name' => '',
                'created_at' => '2019-06-18 10:24:00',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}