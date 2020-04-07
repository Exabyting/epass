<?php

use Illuminate\Database\Seeder;
use Symfony\Component\Debug\Debug;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepartmentsTableSeeder::class);
        $this->call(DesignationsTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(StateDetailsTableSeeder::class);
        $this->call(StateHistoryTableSeeder::class);
        $this->call(StateRecipientsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(NotificationTypesTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
//        $this->call(AppraisalRequestJobHistoriesTableSeeder::class);
//        $this->call(AppraisalRequestsTableSeeder::class);
//        $this->call(AppraisalRequestActionsTableSeeder::class);
//        $this->call(AppraisalRequestEvaluationsTableSeeder::class);
//        $this->call(AppraisalRequestSummarizedEvaluationsTableSeeder::class);
        $this->call(EvaluationQuestionsTableSeeder::class);
        $this->call(GcoEvaluationQuestionsTableSeeder::class);
        $this->call(NgEvaluationQuestionsTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(SystemConfigTableSeeder::class);
    }
}
