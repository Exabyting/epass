<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['system_auth'])->group(function () {
    Route::middleware(['auth', 'can:hrm-access'])->prefix('hrm')->group(function () {
        Route::get('/', 'HRMController@index')->name('hrm');


        #--------------- // Contact Type Urls ---------------------------       ------
        Route::resources(
            [
                'employee' => 'EmployeeController',
                'department' => 'DepartmentController',
                'designation' => 'DesignationController',
                'sections' => 'SectionController',
            ]
        );

        Route::prefix('employee')->group(function () {
            Route::post('general-info', 'EmployeeController@store');
            Route::get('employee-officer/create','EmployeeOfficerController@create')->name('employee-officer.create');
            Route::post('employee-officer','EmployeeOfficerController@store')->name('employee-officer.store');
            Route::get('employee-officer/{employeeOfficer}/edit', 'EmployeeOfficerController@edit')->name('employee-officer.edit');
            Route::post('employee-officer/{employeeOfficer}', 'EmployeeOfficerController@update')->name('employee-officer.update');
        });
    });
});

Route::get('/hrm/test', 'HRMController@test')->name('test');
