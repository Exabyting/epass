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

        #---------------- Appraisal Urls-----------------------------#
        Route::prefix('appraisal')->group(function () {
            Route::get('/', 'AppraisalController@index');
            Route::get('/create', 'AppraisalController@create');
            Route::get('/{id}', 'AppraisalController@show')->where('id', '[0-9]+');
            Route::delete('/{id}', 'AppraisalController@destroy');
            Route::get('/edit/{id}', 'AppraisalController@edit');
            //Gazetted
            Route::prefix('gazetted')->group(function () {
                Route::prefix('request')->group(function () {
                    Route::get('/', 'AppraisalRequestController@index')->name('appraisal-request.index');
                    Route::get('/create', 'AppraisalRequestController@create')->name('appraisal-request.create')->middleware(['can:acr-request-access']);
                    Route::post('/create', 'AppraisalRequestController@store')->name('appraisal-request.store')->middleware(['can:acr-request-access']);

                    Route::get('detail/{appraisalRequest}', 'AppraisalRequestController@show')->name('appraisal-request.show');
                    Route::get('edit/{appraisalRequest}', 'AppraisalRequestController@edit')->name('appraisal-request.edit')->middleware(['appraisal_requester']);

                    Route::post('edit/{appraisalRequest}', 'AppraisalRequestController@update')->name('appraisal-request.update');
                    Route::get('submit/{appraisalRequest}', 'AppraisalRequestController@submit')->name('appraisal-request.submit');

                    Route::get('first-evaluation/{appraisalRequest}', 'AppraisalRequestEvaluationController@firstEvaluation')->name('appraisal-request.first-evaluation')->middleware(['appraisal_receiver']);
                    Route::post('first-evaluation/{appraisalRequest}', 'AppraisalRequestEvaluationController@firstEvaluationStore')->name('appraisal-request.first-evaluation-store');
                    Route::get('first-evaluation/edit/{appraisalRequest}', 'AppraisalRequestEvaluationController@firstEvaluationEdit')->name('appraisal-request.first-evaluation-edit')->middleware(['appraisal_receiver']);
                    Route::post('first-evaluation/edit/{appraisalRequest}', 'AppraisalRequestEvaluationController@firstEvaluationUpdate')->name('appraisal-request.first-evaluation-update');

                    Route::get('second-evaluation/{appraisalRequest}', 'AppraisalRequestEvaluationController@secondEvaluation')->name('appraisal-request.second-evaluation')->middleware(['appraisal_receiver']);
                    Route::post('second-evaluation/{appraisalRequest}', 'AppraisalRequestEvaluationController@secondEvaluationStore')->name('appraisal-request.second-evaluation-store');
                    Route::get('second-evaluation/edit/{appraisalRequest}', 'AppraisalRequestEvaluationController@secondEvaluationEdit')->name('appraisal-request.second-evaluation-edit');
                    Route::post('second-evaluation/edit/{appraisalRequest}', 'AppraisalRequestEvaluationController@secondEvaluationUpdate')->name('appraisal-request.second-evaluation-update');

                    Route::get('second-evaluation/detail/{appraisalRequest}', 'AppraisalRequestEvaluationController@secondEvaluationShow')->name('appraisal-request.second-evaluation-show');

                    Route::get('evaluation-action/{appraisalRequest}', 'AppraisalRequestActionController@action')->name('appraisal-request.action');
                    Route::post('evaluation-action/{appraisalRequest}', 'AppraisalRequestActionController@storeAction')->name('appraisal-request.action-store');
                    Route::get('evaluation-action/edit/{appraisalRequest}', 'AppraisalRequestActionController@actionEdit')->name('appraisal-request.action-edit');

                    Route::get('evaluation-action-list', 'AppraisalRequestActionController@index')->name('appraisal-request.action-list');
                    Route::get('evaluation-action-view/{appraisalRequest}', 'AppraisalRequestActionController@actionView')->name('appraisal-request.action-approved-view');

                    Route::get('acr-print/{appraisalRequest}', 'AppraisalRequestActionController@formPrint')->name('acr.print');
                    Route::get('acr-print/{appraisalRequest}/preview', 'AppraisalRequestActionController@formPrintPreview')->name('acr.print.preview');
                    Route::get('evaluated-acr-print/{appraisalRequest}', 'AppraisalRequestActionController@evaluatedFormPrint')->name('evaluated-acr.print');
                    Route::get('evaluated-acr-print/{appraisalRequest}/preview', 'AppraisalRequestActionController@evaluatedFormPrintPreview')->name('evaluated-acr.print.preview');

                    //System Admin Approval
                    Route::get('system-admin/approval/{appraisalRequest}', 'AppraisalRequestApprovalController@create')->name('appraisal-request-approval.create');
                    Route::post('system-admin/approval/{appraisalRequest}', 'AppraisalRequestApprovalController@store')->name('appraisal-request-approval.store');
                });
            });

            //Non-Gazetted
            Route::prefix('non-gazetted')->group(function () {
                Route::prefix('request')->group(function () {
                    Route::get('/', 'NGAppraisalRequestController@index')->name('ng-appraisal-request.index');
                    Route::get('/create', 'NGAppraisalRequestController@create')->name('ng-appraisal-request.create')
                        ->middleware(['can:acr-request-access']);
                    Route::post('/create', 'NGAppraisalRequestController@store')->name('ng-appraisal-request.store')
                        ->middleware(['can:acr-request-access']);
                    Route::get('detail/{ngAppraisalRequest}', 'NGAppraisalRequestController@show')->name('ng-appraisal-request.show');
                    Route::get('edit/{ngAppraisalRequest}', 'NGAppraisalRequestController@edit')->name('ng-appraisal-request.edit');//->middleware(['appraisal_requester']);
                    Route::post('edit/{ngAppraisalRequest}', 'NGAppraisalRequestController@update')->name('ng-appraisal-request.update');
                    Route::get('submit/{ngAppraisalRequest}', 'NGAppraisalRequestController@submit')->name('ng-appraisal-request.submit');

                    //First Evaluation
                    Route::get('first-evaluation/{ngAppraisalRequest}', 'NGAppraisalRequestEvaluationController@firstEvaluation')
                        ->name('ng-appraisal-request.first-evaluation');//->middleware(['appraisal_receiver']);
                    Route::post('first-evaluation/{ngAppraisalRequest}', 'NGAppraisalRequestEvaluationController@firstEvaluationStore')
                        ->name('ng-appraisal-request.first-evaluation-store');
                    Route::get('first-evaluation/edit/{ngAppraisalRequest}', 'NGAppraisalRequestEvaluationController@firstEvaluationEdit')
                        ->name('ng-appraisal-request.first-evaluation-edit');//->middleware(['appraisal_receiver']);
                    Route::post('first-evaluation/edit/{ngAppraisalRequest}', 'NGAppraisalRequestEvaluationController@firstEvaluationUpdate')
                        ->name('ng-appraisal-request.first-evaluation-update');

                    //Second Evaluation
                    Route::get('second-evaluation/{ngAppraisalRequest}', 'NGAppraisalRequestEvaluationController@secondEvaluation')
                        ->name('ng-appraisal-request.second-evaluation');//->middleware(['appraisal_receiver']);
                    Route::post('second-evaluation/{ngAppraisalRequest}', 'NGAppraisalRequestEvaluationController@secondEvaluationStore')
                        ->name('ng-appraisal-request.second-evaluation-store');
                    Route::get('second-evaluation/edit/{ngAppraisalRequest}', 'NGAppraisalRequestEvaluationController@secondEvaluationEdit')
                        ->name('ng-appraisal-request.second-evaluation-edit');
                    Route::post('second-evaluation/edit/{ngAppraisalRequest}', 'NGAppraisalRequestEvaluationController@secondEvaluationUpdate')
                        ->name('ng-appraisal-request.second-evaluation-update');
                    Route::get('second-evaluation/detail/{ngAppraisalRequest}', 'NGAppraisalRequestEvaluationController@secondEvaluationShow')
                        ->name('ng-appraisal-request.second-evaluation-show');

                    // Final Evaluation
                    Route::get('evaluation-action/{ngAppraisalRequest}', 'NGAppraisalRequestActionController@action')
                        ->name('ng-appraisal-request.action');
                    Route::post('evaluation-action/{ngAppraisalRequest}', 'NGAppraisalRequestActionController@storeAction')
                        ->name('ng-appraisal-request.action-store');
                    Route::get('evaluation-action/edit/{ngAppraisalRequest}', 'NGAppraisalRequestActionController@actionEdit')
                        ->name('ng-appraisal-request.action-edit');
                    Route::get('evaluation-action-view/{ngAppraisalRequest}', 'NGAppraisalRequestActionController@actionView')
                        ->name('ng-appraisal-request.action-approved-view');
                    Route::get('evaluation-action-list', 'NGAppraisalRequestActionController@index')
                        ->name('ng-appraisal-request.action-list');

                    //System Admin Approval
                    Route::get('system-admin/approval/{ngAppraisalRequest}', 'NGAppraisalRequestApprovalController@create')->name('ng-appraisal-request-approval.create');
                    Route::post('system-admin/approval/{ngAppraisalRequest}', 'NGAppraisalRequestApprovalController@store')->name('ng-appraisal-request-approval.store');

                    //Print Preview
                    Route::get('acr-print/{ngAppraisalRequest}', 'NGAppraisalRequestActionController@formPrint')->name('ng-acr.print');
                    Route::get('acr-print/{ngAppraisalRequest}/preview', 'NGAppraisalRequestActionController@formPrintPreview')->name('ng-acr.print.preview');
                    Route::get('evaluated-acr-print/{ngAppraisalRequest}', 'NGAppraisalRequestActionController@evaluatedFormPrint')->name('ng-evaluated-acr.print');
                    Route::get('evaluated-acr-print/{ngAppraisalRequest}/preview', 'NGAppraisalRequestActionController@evaluatedFormPrintPreview')->name('ng-evaluated-acr.print.preview');

                });

            });

            //Gazetted-cadre-officer

            Route::prefix('gazetted-cadre-officer')->group(function () {
                Route::prefix('request')->group(function () {
                    Route::get('/', 'GCOAppraisalRequestController@index')->name('gco-appraisal-request.index');
                    Route::get('/create', 'GCOAppraisalRequestController@create')->name('gco-appraisal-request.create')
                        ->middleware(['can:acr-request-access']);
                    Route::get('/download', 'GCOAppraisalRequestController@getDownload')->name('download')
                        ->middleware(['can:acr-request-access']);

                   Route::post('/create', 'GCOAppraisalRequestController@store')->name('gco-appraisal-request.store')
                        ->middleware(['can:acr-request-access']);
                    Route::get('detail/{gcoAppraisalRequest}', 'GCOAppraisalRequestController@show')->name('gco-appraisal-request.show');
                    Route::get('submit/{gcoAppraisalRequest}', 'GCOAppraisalRequestController@submit')->name('gco-appraisal-request.submit');
                    Route::get('edit/{gcoAppraisalRequest}', 'GCOAppraisalRequestController@edit')->name('gco-appraisal-request.edit');//->middleware(['appraisal_requester']);
                    Route::post('edit/{gcoAppraisalRequest}', 'GCOAppraisalRequestController@update')->name('gco-appraisal-request.update');

                    //Personal Info
                    Route::get('/create-personal/{gcoAppraisalRequestId}', 'GCOAppraisalPersonalRequestController@create')->name('gco-appraisal-personal-request.create')
                        ->middleware(['can:acr-request-access']);
                    Route::post('/create-personal/', 'GCOAppraisalPersonalRequestController@store')->name('gco-appraisal-personal-request.store')
                        ->middleware(['can:acr-request-access']);
                    Route::get('detail-personal/{gcoAppraisalRequest}', 'GCOAppraisalPersonalRequestController@show')->name('gco-appraisal-personal-request.show');
                    Route::get('submit-personal/{gcoAppraisalRequest}', 'GCOAppraisalPersonalRequestController@submit')->name('gco-appraisal-personal-request.submit');
                    Route::get('edit-personal/{gcoAppraisalRequest}', 'GCOAppraisalPersonalRequestController@edit')->name('gco-appraisal-personal-request.edit');//->middleware(['appraisal_requester']);
                    Route::post('edit-personal/{gcoAppraisalRequest}', 'GCOAppraisalPersonalRequestController@update')->name('gco-appraisal-personal-request.update');


                    //First Evaluation
                    Route::get('first-evaluation/{gcoAppraisalRequest}', 'GCOAppraisalRequestEvaluationController@firstEvaluation')
                        ->name('gco-appraisal-request.first-evaluation');//->middleware(['appraisal_receiver']);
                     Route::post('first-evaluation/{gcoAppraisalRequest}', 'GCOAppraisalRequestEvaluationController@firstEvaluationStore')
                         ->name('gco-appraisal-request.first-evaluation-store');
                     Route::get('first-evaluation/edit/{gcoAppraisalRequest}', 'GCOAppraisalRequestEvaluationController@firstEvaluationEdit')
                         ->name('gco-appraisal-request.first-evaluation-edit');//->middleware(['appraisal_receiver']);
                     Route::post('first-evaluation/edit/{gcoAppraisalRequest}', 'GCOAppraisalRequestEvaluationController@firstEvaluationUpdate')
                         ->name('gco-appraisal-request.first-evaluation-update');

                    //Second Evaluation
                    Route::get('second-evaluation/{gcoAppraisalRequest}', 'GCOAppraisalRequestEvaluationController@secondEvaluation')
                        ->name('gco-appraisal-request.second-evaluation');//->middleware(['appraisal_receiver']);
                    Route::post('second-evaluation/{gcoAppraisalRequest}', 'GCOAppraisalRequestEvaluationController@secondEvaluationStore')
                        ->name('gco-appraisal-request.second-evaluation-store');
                    Route::get('second-evaluation/edit/{gcoAppraisalRequest}', 'GCOAppraisalRequestEvaluationController@secondEvaluationEdit')
                        ->name('gco-appraisal-request.second-evaluation-edit');
                    Route::post('second-evaluation/edit/{gcoAppraisalRequest}', 'GCOAppraisalRequestEvaluationController@secondEvaluationUpdate')
                        ->name('gco-appraisal-request.second-evaluation-update');
                    Route::get('second-evaluation/detail/{gcoAppraisalRequest}', 'GCOAppraisalRequestEvaluationController@secondEvaluationShow')
                        ->name('gco-appraisal-request.second-evaluation-show');
                    //Third Evaluation
                    Route::get('third-evaluation/{gcoAppraisalRequest}', 'GCOAppraisalRequestEvaluationController@thirdEvaluation')
                        ->name('gco-appraisal-request.third-evaluation');//->middleware(['appraisal_receiver']);
                    Route::post('third-evaluation/{gcoAppraisalRequest}', 'GCOAppraisalRequestEvaluationController@thirdEvaluationStore')
                        ->name('gco-appraisal-request.third-evaluation-store');
                   /* Route::get('second-evaluation/edit/{gcoAppraisalRequest}', 'GCOAppraisalRequestEvaluationController@secondEvaluationEdit')
                        ->name('gco-appraisal-request.second-evaluation-edit');
                    Route::post('second-evaluation/edit/{gcoAppraisalRequest}', 'GCOAppraisalRequestEvaluationController@secondEvaluationUpdate')
                        ->name('gco-appraisal-request.second-evaluation-update');*/
                    Route::get('third-evaluation/detail/{gcoAppraisalRequest}', 'GCOAppraisalRequestEvaluationController@thirdEvaluationShow')
                        ->name('gco-appraisal-request.third-evaluation-show');

                    // Final Evaluation
                    Route::get('evaluation-action/{gcoAppraisalRequest}', 'GCOAppraisalRequestActionController@action')
                        ->name('gco-appraisal-request.action');
                    Route::post('evaluation-action/{gcoAppraisalRequest}', 'GCOAppraisalRequestActionController@storeAction')
                        ->name('gco-appraisal-request.action-store');
                    Route::get('evaluation-action/edit/{gcoAppraisalRequest}', 'GCOAppraisalRequestActionController@actionEdit')
                        ->name('gco-appraisal-request.action-edit');
                    Route::get('evaluation-action-view/{gcoAppraisalRequest}', 'GCOAppraisalRequestActionController@actionView')
                        ->name('gco-appraisal-request.action-approved-view');
                    Route::get('evaluation-action-list', 'GCOAppraisalRequestActionController@index')
                        ->name('gco-appraisal-request.action-list');

                    //System Admin Approval
                    Route::get('system-admin/approval/{gcoAppraisalRequest}', 'GCOAppraisalRequestApprovalController@create')->name('gco-appraisal-request-approval.create');
                    Route::post('system-admin/approval/{gcoAppraisalRequest}', 'GCOAppraisalRequestApprovalController@store')->name('gco-appraisal-request-approval.store');

                    //Print Preview
                    Route::get('acr-print/{gcoAppraisalRequest}', 'GCOAppraisalRequestActionController@formPrint')->name('gco-acr.print');
                    Route::get('acr-print/{gcoAppraisalRequest}/preview', 'GCOAppraisalRequestActionController@formPrintPreview')->name('gco-acr.print.preview');
                    Route::get('evaluated-acr-print/{gcoAppraisalRequest}', 'GCOAppraisalRequestActionController@evaluatedFormPrint')->name('gco-evaluated-acr.print');
                    Route::get('evaluated-acr-print/{gcoAppraisalRequest}/preview', 'GCOAppraisalRequestActionController@evaluatedFormPrintPreview')->name('gco-evaluated-acr.print.preview');

                });

            });


            Route::prefix('report')->group(function () {
                Route::get('/', 'AppraisalReportController@index')->name('appraisal-report.index');
                Route::get('/create', 'AppraisalReportController@create')->name('appraisal-report.create');
                Route::post('/create', 'AppraisalReportController@store')->name('appraisal-report.store');
                Route::get('detail/{appraisalReport}', 'AppraisalReportController@show')->name('appraisal-report.show');

                Route::get('report-print/{appraisalReport}', 'AppraisalReportController@formPrint')->name('report.print');
                Route::get('report-print/{appraisalReport}/preview', 'AppraisalReportController@formPrintPreview')->name('report.print.preview');
            });

            Route::prefix('reporting')->group(function () {
                Route::get('/all-acr-request', 'ReportingController@allAcrRequest')->name('appraisal-reporting.all-acr-request');
                Route::get('/submitter-non-submitter', 'ReportingController@submitterAndNonSubmitterList')->name('appraisal-reporting.submitter-non-submitter');
            });

        });

        #--------------- // Appraisal Urls ---------------------------------

        // Section
        Route::get('get-sections-by-dept-id/{deptId}', 'SectionController@getAllByDeptId')->name('get-sections');


    });
});

Route::get('/hrm/test', 'HRMController@test')->name('test');
