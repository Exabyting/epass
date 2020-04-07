<?php

use App\Models\SystemConfig;
use App\Utilities\BanglaConverter;
use Illuminate\Support\Facades\Auth;
use Modules\HRM\Entities\Department;
use Modules\HRM\Entities\Designation;
use Modules\IMS\Constants\InventoryFixedLocation;
use Modules\IMS\Entities\Inventory;
use App\Entities\User;

if (!function_exists('in_designation')) {
    /**
     * Check Is Designation Matched
     *
     * expecting the short codes of Designation in a comma separated manner
     * @return mixed
     *
     * @uses in_designation('DG', 'DA', 'PD')
     */
    function in_designation()
    {
        $haystack = func_get_args();
        $result = 0;

        if (Auth::user()->user_type == 'Employee') {
            $needle = Auth::user()->employee->designation->short_name;
            $result = in_array($needle, $haystack) ? 1 : 0;
        }

        return $result;
    }
}

if (!function_exists('get_user_designation')) {
    /**
     * get Users Designation Object
     *
     * @param $user User|null
     * @return Designation
     */
    function get_user_designation($user = null)
    {
        $user = $user ?: Auth::user();

        return $user->user_type == 'Employee'
            ? ($user->employee->designation
                ? $user->employee->designation
                : new Designation()
            )
            : new Designation();
    }
}

if (!function_exists('get_user_department')) {
    /**
     * get Users Department Object
     *
     * @param $user User|null
     * @return Department
     */
    function get_user_department($user = null)
    {
        $user = $user ?: Auth::user();

        return $user->user_type == 'Employee'
            ? ($user->employee->department
                ? $user->employee->department
                : new Department()
            )
            : new Department();
    }
}

if (!function_exists('state_actor')) {
    function state_actor($user_id)
    {
        return User::findOrFail($user_id);
    }
}


if (!function_exists('get_localization_config')) {
    function get_localization_config()
    {
        $current = App::getLocale();

        $current = Session::has('locale') ? Session::get('locale') : $current;
        $key = $current == 'bn' ? 'en' : 'bn';
        $value = ($key == 'en') ? 'English' : 'বাংলা';

        $data = (object)[
            'key' => $key,
            'value' => $value
        ];

        return $data;
    }
}

if (!function_exists('bn2en')) {
    function bn2en(string $number): void
    {
        echo BanglaConverter::bn2en($number);
    }
}

if (!function_exists('en2bn')) {
    function en2bn(string $number): void
    {
        echo BanglaConverter::en2bn($number);
    }
}


//Site Config Methods

if (!function_exists('get_favicon_url')) {
    function get_favicon_url()
    {
        $result = SystemConfig::all()->where('key' , 'site-icon')->first();
        $iconName = optional($result)->value;
        $url = 'file/get?filePath='.$iconName;
        return $url;
    }
}

if (!function_exists('get_site_logo')) {
    function get_site_logo()
    {
        $result = SystemConfig::all()->where('key' , 'site-logo')->first();
        $iconName = optional($result)->value;
        $url = 'file/get?filePath='.$iconName;
        return $url;
    }
}

if (!function_exists('get_site_banner')) {
    function get_site_banner()
    {
        $result = SystemConfig::all()->where('key' , 'site-banner')->first();
        $iconName = optional($result)->value;
        $url = 'file/get?filePath='.$iconName;
        return $url;
    }
}

if (!function_exists('get_site_background')) {
    function get_site_background()
    {
        $result = SystemConfig::all()->where('key' , 'site-background')->first();
        $iconName = optional($result)->value;
        $url = 'file/get?filePath='.$iconName;
        return $url;
    }
}

if (!function_exists('get_contact_no')) {
    function get_contact_no()
    {
        $result = SystemConfig::all()->where('key' , 'contact')->first();
        return optional($result)->value;
    }
}

if (!function_exists('get_email')) {
    function get_email()
    {
        $result = SystemConfig::all()->where('key' , 'email')->first();
        return optional($result)->value;
    }
}

if (!function_exists('get_address')) {
    function get_address()
    {
        $result = SystemConfig::all()->where('key' , 'address')->first();
        return optional($result)->value;
    }
}

if (!function_exists('get_menu_title')) {
    function get_menu_title()
    {
        $current = App::getLocale();

        $current = Session::has('locale') ? Session::get('locale') : $current;
        $key = $current == 'bn' ? 'bn' : 'en';

        $result = SystemConfig::all()->where('key' , 'menu-title-'.$key)->first();

        return optional($result)->value;
    }
}

if (!function_exists('copyright_title')) {
    function copyright_title()
    {
        $result = SystemConfig::all()->where('key' , 'copyright-title')->first();
        return optional($result)->value;
    }
}

if (!function_exists('copyright_link')) {
    function copyright_link()
    {
        $result = SystemConfig::all()->where('key' , 'copyright-link')->first();
        return optional($result)->value;
    }
}


