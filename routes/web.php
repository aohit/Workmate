<?php

use App\Http\Controllers\User\CertificateController;
use App\Http\Controllers\User\EmergencycontactController;
use App\Http\Controllers\User\WagesBenefitsController;
use App\Http\Controllers\User\DisciplinaryController;
use App\Http\Controllers\User\TaskController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\LeaveController;
use App\Http\Controllers\User\EmployeeController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\DepartmentController;
use App\Http\Controllers\User\GoalController;
use App\Http\Controllers\User\UserLeaveController;
use App\Http\Controllers\User\LeaveTypeController;
use App\Http\Controllers\User\CalendarController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\HolidayController;
use App\Http\Controllers\User\PerformanceController;
use App\Http\Controllers\User\AppraisalController;
use App\Http\Controllers\User\CompetenceController;
use App\Http\Controllers\User\DevelopmentController;
use App\Http\Controllers\User\MyTrainingController;
use App\Http\Controllers\User\TrainingController;
use App\Http\Controllers\User\MyResourseController;
use App\Http\Controllers\User\ResponsibilityController;
use App\Http\Controllers\User\GoalReviewController;
use App\Http\Controllers\User\EmployeeLeaveController;
use App\Http\Controllers\User\TalentSearchController;
use App\Http\Controllers\CronGoalReviewStoreUpdateController;
use App\Http\Controllers\CronAppraisalRatingController;
use App\Http\Controllers\CronStartSession;
use App\Http\Controllers\CronAnnualLeave;
use App\Http\Controllers\CronCarryOverLeaveCron;
use App\Http\Controllers\CronNewLeaveHistory;
use App\Http\Controllers\CronExpireCarryOverLeaveCron;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CronAppraisalRatingUpdateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/cron-goal-review', [CronGoalReviewStoreUpdateController::class, 'index'])
    ->name('goal.review');
Route::get('/cron-appraisal-rating', [CronAppraisalRatingController::class, 'index'])
    ->name('appraisal.rating');
Route::get('/cron-start-session', [CronStartSession::class, 'index'])
    ->name('start.session');
Route::get('/cron-accumul-leave', [CronAnnualLeave::class, 'index'])
    ->name('accumul.leave');
Route::get('/cron-newleave-history', [CronNewLeaveHistory::class, 'index'])
    ->name('accumul.leave');
Route::get('/cron-carryover-leave', [CronCarryOverLeaveCron::class, 'index'])
    ->name('carryover.leave');
Route::get('/cron-expire-carryover-leave', [CronExpireCarryOverLeaveCron::class, 'index'])
    ->name('carryover.expire.leave');
    Route::get('/cron-appraisal-rating-update', [CronAppraisalRatingUpdateController::class, 'index'])
    ->name('appraisal.rating.update');

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('optimize:clear');
    return 'Application cache has been cleared';
});
//Clear route cache:

Route::get('/route-cache', function () {
    Artisan::call('route:cache');
    return 'Routes cache has been cleared';
});
//Clear config cache:

Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return 'Config cache has been cleared';
});
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware('auth')->group(function () {

    Route::get('dashboard', [UserDashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/chart', [ProfileController::class, 'DashboardChart'])->name('dashboardchart');
    Route::post('/profile/goals', [ProfileController::class, 'DashboardQuickOverView'])->name('dashboardorverview');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.update');
    Route::post('/mydashboard-tab', [ProfileController::class, 'myDashboardTabs'])->name('mydashboard.tabs');
    Route::post('/document-list', [ProfileController::class, 'list'])->name('document-profile.list');

    Route::get('team-list', [ProfileController::class, 'myTeam'])->name('team.list');
    Route::get('my-training', [ProfileController::class, 'myTraining'])->name('training.list');
    Route::get('my-perform', [ProfileController::class, 'myPerformance'])->name('perform.list');
    Route::get('my-leave', [ProfileController::class, 'myleave'])->name('my_leave');
    Route::get('my-profile', [ProfileController::class, 'myprofile'])->name('my_profile');
    Route::post('leave-type', [ProfileController::class, 'leaveTypeData'])->name('leaves.leavetype');

    // Route::get('my-training',[MyTrainingController::class,'index'])->name('training');
    // Route::post('my-training',[MyTrainingController::class,'list'])->name('training-list');
    // Route::get('my-training/create',[MyTrainingController::class,'create'])->name('training-create');
    // Route::post('my-training/create',[MyTrainingController::class,'store'])->name('training-store');
    // Route::get('my-training/update',[MyTrainingController::class,'update'])->name('training-update');
    // Route::post('my-training/delete',[MyTrainingController::class,'destroy'])->name('training-delete');
    // Route::post('my-training/status',[MyTrainingController::class,'status'])->name('training-status');

    // Route::get('getTabContent', [ProfileController::class, 'employeesProfile'])->name('employee_profile');

    Route::get('employee-skills', [ProfileController::class, 'empSkills'])->name('employee_skills');

    // Route::get('get-TabContent', [ProfileController::class, 'getTabContent'])->name('employee_tab');
    

    // Route::get('/getTabContent', 'ProfileController@getTabContent');

    Route::get('employee', [EmployeeController::class, 'index'])
        ->name('employee');
    Route::post('employee/list', [EmployeeController::class, 'list'])
        ->name('employee.list');
    Route::get('employee/create', [EmployeeController::class, 'create'])
        ->name('employee.create');
    Route::post('employee/store', [EmployeeController::class, 'store'])
        ->name('employee.store');
    Route::get('employee/update', [EmployeeController::class, 'update'])
        ->name('employee.update');
    Route::post('employee/delete', [EmployeeController::class, 'destroy'])
        ->name('employee.delete');
    Route::get('employee/show', [EmployeeController::class, 'show'])
        ->name('employee.show');

    Route::get('roles', [RoleController::class, 'index'])
        ->name('roles');
    Route::post('roles/list', [RoleController::class, 'list'])
        ->name('roles.list');
    Route::get('roles/create', [RoleController::class, 'create'])
        ->name('roles.create');
    Route::post('roles/store', [RoleController::class, 'store'])
        ->name('roles.store');
    Route::get('roles/update', [RoleController::class, 'update'])
        ->name('roles.update');
    Route::post('roles/delete', [RoleController::class, 'destroy'])
        ->name('roles.delete');

    Route::get('department', [DepartmentController::class, 'index'])
        ->name('department');
    Route::post('department/list', [DepartmentController::class, 'list'])
        ->name('department.list');
    Route::get('department/create', [DepartmentController::class, 'create'])
        ->name('department.create');
    Route::post('department/store', [DepartmentController::class, 'store'])
        ->name('department.store');
    Route::get('department/update', [DepartmentController::class, 'update'])
        ->name('department.update');
    Route::post('department/delete', [DepartmentController::class, 'destroy'])
        ->name('department.delete');
    Route::post('department/status', [DepartmentController::class, 'status'])
        ->name('department.status');


    Route::get('leave', [LeaveController::class, 'index'])
        ->name('leave');
    Route::post('leave/list', [LeaveController::class, 'list'])
        ->name('leave.list');
    Route::get('leave/create', [LeaveController::class, 'create'])
        ->name('leave.create');
    Route::post('leave/store', [LeaveController::class, 'store'])
        ->name('leave.store');
    Route::get('leave/update/{id}', [LeaveController::class, 'update'])
        ->name('leave.update');
    Route::post('leave/delete', [LeaveController::class, 'destroy'])
        ->name('leave.delete');
    Route::post('leave/file-upload', [LeaveController::class, 'upload'])
        ->name('leave.file.upload');
    Route::post('leave/file-remove', [LeaveController::class, 'removeUpload'])
        ->name('leave.file.remove');
    Route::post('leave/dates', [LeaveController::class, 'dates'])
        ->name('leave.dates');
    Route::post('leave/comment', [LeaveController::class, 'comment'])
        ->name('leave.comment');



    Route::get('userleave', [UserLeaveController::class, 'index'])
        ->name('userleave');
    Route::post('userleave/list', [UserLeaveController::class, 'list'])
        ->name('userleave.list');
    Route::get('userleave/create', [UserLeaveController::class, 'create'])
        ->name('userleave.create');
    Route::post('userleave/store', [UserLeaveController::class, 'store'])
        ->name('userleave.store');
    Route::get('userleave/update/{id}', [UserLeaveController::class, 'update'])
        ->name('userleave.update');
    Route::post('userleave/delete', [UserLeaveController::class, 'destroy'])
        ->name('userleave.delete');
    Route::post('userleave/file-upload', [UserLeaveController::class, 'upload'])
        ->name('userleave.file.upload');
    Route::post('userleave/file-remove', [UserLeaveController::class, 'removeUpload'])
        ->name('userleave.file.remove');
    Route::post('userleave/dates', [UserLeaveController::class, 'dates'])
        ->name('userleave.dates');
    Route::post('userleave/request', [UserLeaveController::class, 'userLeaveRequest'])
        ->name('userleave.request');
    Route::post('userleave/request/update', [UserLeaveController::class, 'leaveApproveReject'])
        ->name('userleave.request.update');
    Route::post('userleave/comment', [UserLeaveController::class, 'comment'])
        ->name('userleave.comment');


    Route::get('leave-type', [LeaveTypeController::class, 'index'])
        ->name('leavetype');
    Route::post('leavetype/list', [LeaveTypeController::class, 'list'])
        ->name('leavetype.list');
    Route::get('leavetype/create', [LeaveTypeController::class, 'create'])
        ->name('leavetype.create');
    Route::post('leavetype/store', [LeaveTypeController::class, 'store'])
        ->name('leavetype.store');
    Route::get('leavetype/update', [LeaveTypeController::class, 'update'])
        ->name('leavetype.update');
    Route::post('leavetype/delete', [LeaveTypeController::class, 'destroy'])
        ->name('leavetype.delete');
    Route::post('leavetype/status', [LeaveTypeController::class, 'status'])
        ->name('leavetype.status');



    Route::get('calendar', [CalendarController::class, 'index'])
        ->name('calendar');
    Route::get('calendar/get-employee', [CalendarController::class, 'getEmployee'])
        ->name('calendar.getemployee');
    Route::get('/calendar/get-leave', [CalendarController::class, 'getLeaveDates'])
        ->name('calendar.getleave');
    Route::post('get-leave', [CalendarController::class, 'fullcalender'])->name('calendar.fullcalendar');
    Route::post('fullcalender/dates', [CalendarController::class, 'showdates'])
    ->name('fullcalender.dates'); 
    Route::post('/calendar/filter-employees', [CalendarController::class, 'filterEmployees'])->name('calendar.filterEmployees');


    Route::get('holiday', [HolidayController::class, 'index'])
        ->name('holiday');
    Route::post('holiday/list', [HolidayController::class, 'list'])
        ->name('holiday.list');
    Route::get('holiday/create', [HolidayController::class, 'create'])
        ->name('holiday.create');
    Route::post('holiday/store', [HolidayController::class, 'store'])
        ->name('holiday.store');
    Route::get('holiday/update', [HolidayController::class, 'update'])
        ->name('holiday.update');
    Route::post('holiday/delete', [HolidayController::class, 'destroy'])
        ->name('holiday.delete');
    Route::post('holiday/status', [HolidayController::class, 'status'])
        ->name('holiday.status');

    Route::get('task', [AppraisalController::class, 'index'])->name('user.appraisal');
    Route::get('appraisals', [AppraisalController::class, 'appraisalindex'])->name('user.appraisal.index');
    Route::get('pending/tasks', [AppraisalController::class, 'pendingTask'])->name('appraisalPendingtask');
    Route::get('completed/tasks', [AppraisalController::class, 'completedTask'])->name('appraisalCompletedtask');
    Route::post('appraisal-list', [AppraisalController::class, 'list'])->name('user.appraisal.list');
    Route::post('appraisals-list', [AppraisalController::class, 'AppraisalList'])->name('user.appraisalList');
    Route::post('completed-list', [AppraisalController::class, 'completedlist'])->name('user.appraisal.completedlist');
    Route::get('appraisal-respond/{id}', [AppraisalController::class, 'create'])->name('user.appraisal.create');
    Route::get('appraisal/create', [AppraisalController::class, 'genrate'])->name('user.appraisal.genrate');
    Route::post('appraisal-store',[AppraisalController::class, 'storeCreateAppraisal'])->name('user.store-create-appraisal');
    Route::get('appraisal-update',[AppraisalController::class, 'update'])->name('user.appraisal.update');
    Route::post('appraisal-respond', [AppraisalController::class, 'store'])->name('user.appraisal.store');
    Route::post('appraisal-response-share', [AppraisalController::class, 'shareResult'])->name('user.appraisal.shareresult');
    Route::get('appraisal-result/{id}',[AppraisalController::class, 'result'])->name('user.appraisal.result');
    Route::post('updatepop',[AppraisalController::class, 'updatePopStatus'])->name('appraisal.popstatus');
    Route::post('getpdf',[AppraisalController::class, 'appraisalPDF'])->name('appraisal.pdf');

    Route::get('training',[TrainingController::class,'index'])->name('user.training');
    Route::post('training',[TrainingController::class,'list'])->name('user.training-list');
    Route::get('training/create',[TrainingController::class,'create'])->name('user.training-create');
    Route::get('training/create-my',[TrainingController::class,'createMy'])->name('user.training-createmy');
    
	Route::post('training/create',[TrainingController::class,'store'])->name('user.training-store');
    Route::get('training/update',[TrainingController::class,'update'])->name('user.training-update');
    Route::get('training/update-my',[TrainingController::class,'updateMy'])->name('user.training-update-my');
    Route::post('training/delete',[TrainingController::class,'destroy'])->name('user.training-delete');
    Route::post('training/status',[TrainingController::class,'status'])->name('user.training-status');
    Route::post('training/user/create',[TrainingController::class,'userdatastore'])->name('user.training-user-store');
   
    Route::get('myTraining',[TrainingController::class,'myTrainingIndex'])->name('user.myTraining');
    Route::post('my-training/list',[TrainingController::class,'myTrainingList'])->name('user.my-training-list');

    Route::post('team-list-show', [ProfileController::class, 'myTeamList'])->name('team.list.show');
	Route::post('team-profile-tab', [ProfileController::class, 'myTeamProfileTab'])->name('team.profile.tab');
	Route::post('team-department-tab', [ProfileController::class, 'departmentTab'])->name('team.department.tab');
	Route::get('team-profile/{id}', [ProfileController::class, 'teamProfile'])->name('team.profile');
	Route::post('team-profile-tabs', [ProfileController::class, 'teamProfileTab'])->name('team.profile.tabs');
    Route::get('leave-sidebar/{id}', [ProfileController::class, 'myLeaveSideModal'])->name('leave.sidemodal');

    Route::get('basic-info', [ProfileController::class, 'basicinfo'])->name('basic_info');
    Route::get('login-info', [ProfileController::class, 'loginInfo'])->name('login_info');
    Route::post('user-reset-password', [ProfileController::class, 'ResetPassword'])->name('userReset-password');


    Route::get('employee-profileedit', [EmployeeController::class, 'employeeProfileEdit'])->name('employee_profileedit');
    Route::post('employee-detail-update', [EmployeeController::class, 'employeeDetailsupdate'])->name('employee_detailsupdate');

    Route::get('employee/image', [EmployeeController::class, 'addImage'])->name('add_image');
    // Route::get('imageupload', [EmployeeController::class, 'imageupload'])->name('imageupload');
    Route::post('saveimage',[EmployeeController::class, 'imageupload'])->name('saveimage');
    Route::post('employeeImage',[EmployeeController::class, 'employeeImage'])->name('employeeImage');
    Route::get('imagedestroy',[EmployeeController::class, 'imagedestroy'])->name('imagedestroy');

    Route::get('employee-profile', [EmployeeController::class, 'employeesProfile'])->name('employee_profile');
    Route::get('employee-skills', [EmployeeController::class, 'empSkills'])->name('employee_skills');
    Route::get('Wages-Benefits', [EmployeeController::class, 'employeeEducation'])->name('wages-benefits');
    Route::get('employee-certificate', [EmployeeController::class, 'employeeCertificate'])->name('employee_certificate');
    Route::get('employee-language', [EmployeeController::class, 'employeelanguage'])->name('employee_language');
    Route::get('employee-dependents', [EmployeeController::class, 'employeedependents'])->name('employee_dependents');
    Route::get('employee-emergency', [EmployeeController::class, 'employeeEmergencyContact'])->name('employee_emergency');
    Route::post('employee-emergency', [EmployeeController::class, 'EmergencyContactUpdate'])->name('employee_emergency_update');
    Route::post('employee-emergency-store', [EmployeeController::class, 'EmergencyContactStore'])->name('employee_emergency_store');
    Route::post('employee-remove-emergency', [EmployeeController::class, 'EmergencyContactRemove'])->name('employee_emergency_remove');
    Route::get('add-skill', [EmployeeController::class, 'addEmployeeSkill'])->name('employee.add_skill');
    Route::post('delete-skill', [EmployeeController::class, 'removeEmployeeSkill'])->name('employee.remove_skill');
    Route::post('store-user-skill', [EmployeeController::class, 'StoreEmployeeSkill'])->name('employee.store_skill');
    Route::get('add-certificate', [EmployeeController::class, 'addEmployeecertificate'])->name('employee.add_certificate');
    Route::post('store-certificate', [EmployeeController::class, 'storeEmployeecertificate'])->name('employee.store_certificate');
    Route::post('delete-certificate', [EmployeeController::class, 'deleteEmployeecertificate'])->name('employee.delete_certificate');

    // Route::get('goal', [GoalController::class, 'index'])->name('goal');
    Route::post('goal/list', [GoalController::class, 'list'])->name('goal.list');
    Route::post('goal/store', [GoalController::class, 'store'])->name('goal.store');
    // Route::get('goal/update', [GoalController::class, 'update'])->name('goal.update');
    Route::post('goal/delete', [GoalController::class, 'destroy'])->name('goal.delete');
    Route::post('goal/status', [GoalController::class, 'status'])->name('goal.status');
    Route::get('goal/show', [GoalController::class, 'show'])->name('goal.show');

    // Route::get('/generate-pdf', [GoalController::class, 'generatePdf']);
    // Route::get('generatePdf', [GoalController::class, 'generatePdf'])->name('generatePdf');
    Route::get('/pdf', [GoalController::class, 'getPdf'])->name('get.pdf');

    Route::get('goal/add-competencies', [CompetenceController::class, 'create'])->name('creatcompetence');
    Route::post('goal/competencies/store-key', [CompetenceController::class, 'StoreGoalKey'])->name('storecompetenciedskey');
   Route::post('goals/competencies/store', [CompetenceController::class, 'store'])->name('storecompetencied');
    Route::get('competencies/edit/{id}', [CompetenceController::class, 'update'])->name('updatecompetencied');
    Route::post('competencies/delete', [CompetenceController::class, 'destory'])->name('destoryompetencied');
    Route::post('competencies/history', [CompetenceController::class, 'histories'])->name('competencieshistory');

      Route::get('goals/add-responsibility', [ResponsibilityController::class, 'create'])->name('creatresponsibility');
    Route::post('goal/responsibility/store-key', [ResponsibilityController::class, 'StoreresponsibilityKey'])->name('storeresponsibilitykey');
    Route::post('goal/responsibility/store', [ResponsibilityController::class, 'store'])->name('storeresponsibility');
    Route::get('responsibility/edit/{id}', [ResponsibilityController::class, 'update'])->name('updateresponsibility');
    Route::post('responsibility/delete', [ResponsibilityController::class, 'destory'])->name('destoryresponsibility');
    Route::post('responsibility/history', [ResponsibilityController::class, 'histories'])->name('responsibilityhistory');


    Route::get('goals/add-development', [DevelopmentController::class, 'create'])->name('creatdevelopment');
    Route::post('goal/development/store-key', [DevelopmentController::class, 'StoredevelopmentkeyKey'])->name('storedevelopmentkey');
    Route::post('goal/development/store', [DevelopmentController::class, 'store'])->name('storedevelopment');
    Route::get('development/edit/{id}', [DevelopmentController::class, 'update'])->name('updatedevelopment');
    Route::post('development/delete', [DevelopmentController::class, 'destory'])->name('destorydevelopment');
    Route::post('development/history', [DevelopmentController::class, 'histories'])->name('developmenthistory');


     Route::get('myGoals/{id}', [GoalController::class, 'myGoals'])->name('my_goals');
    Route::get('goals/competencies', [CompetenceController::class, 'indexs'])->name('goal.competencies');
    Route::get('goals/responsibility', [ResponsibilityController::class, 'indexs'])->name('goal.responsibility');
    Route::get('goals/development', [DevelopmentController::class, 'indexs'])->name('goal.development');
    
    
    Route::get('pending/task', [PerformanceController::class, 'pendingTask'])->name('pending_task');    

    Route::get('completed/task', [PerformanceController::class, 'completeTask'])->name('completed_task');    
    // Route::get('disciplinary/action', [PerformanceController::class, 'disciplinaryAction'])->name('disciplinary_action');
    
    // Route::get('task',[TaskController::class,'index'])->name('task');
    // Route::post('task',[TaskController::class,'list'])->name('task-list');
    // Route::get('task-create',[TaskController::class,'create'])->name('task-create');
    // Route::post('task-status',[TaskController::class,'changedStatus'])->name('task-status');
    // Route::post('status',[TaskController::class,'statusStore'])->name('status-store');
    // Route::post('task-store',[TaskController::class,'store'])->name('task-stor');
    // Route::post('task/update',[TaskController::class,'update'])->name('task-update');
    // Route::post('task/delete', [TaskController::class, 'destroy'])->name('task-delete');

   Route::get('disciplinary/action', [DisciplinaryController::class, 'disciplinaryAction'])->name('disciplinary_action');
    Route::post('disciplinary/list', [DisciplinaryController::class, 'list'])->name('disciplinary.list');
    Route::get('disciplinary/create', [DisciplinaryController::class, 'create'])->name('disciplinary.create');
    Route::post('disciplinary/store', [DisciplinaryController::class, 'store'])->name('disciplinary.store');   
    Route::get('disciplinary/update', [DisciplinaryController::class, 'update'])->name('disciplinary.update');    
    Route::post('disciplinary/delete', [DisciplinaryController::class, 'destroy'])->name('disciplinary.delete');

    Route::get('disciplinary', [DisciplinaryController::class, 'index'])->name('disciplinary');
    Route::post('disciplinary/teamlist', [DisciplinaryController::class, 'teamList'])->name('disciplinary.teamlist');
    Route::get('disciplinary/teamcreate', [DisciplinaryController::class, 'createTeamDisciplinary'])->name('disciplinary.teamcreate');
    Route::post('disciplinary/teamstore', [DisciplinaryController::class, 'storeTeamDisciplinary'])->name('disciplinary.teamstore');   
    Route::post('disciplinary/teamdelete', [DisciplinaryController::class, 'destroyteam'])->name('disciplinary.teamdelete');
    Route::post('disciplianary/get-state', [DisciplinaryController::class, 'disGetStateData'])->name('disciplinary.getStateData');


    Route::get('my-resources', [MyResourseController::class, 'index'])->name('resources');
    Route::post('my-resources/list', [MyResourseController::class, 'list'])->name('resources.list');
    Route::get('my-resources/create', [MyResourseController::class, 'create'])->name('resources.create');
    Route::post('my-resources/store', [MyResourseController::class, 'store'])->name('resources.store');   
    Route::post('my-resources/delete', [MyResourseController::class, 'destroy'])->name('resources.delete');

    Route::get('wagesbenefits',[WagesBenefitsController::class,'index'])->name('wagesbenefits');
    Route::post('wages-benefits/list',[WagesBenefitsController::class,'list'])->name('wages-benefits.list');
    Route::get('wages-benefits/create',[WagesBenefitsController::class,'create'])->name('wages-benefits.create');
    Route::post('wages-benefits/store',[WagesBenefitsController::class,'store'])->name('wages-benefits.store');
    Route::post('wages-benefits/update',[WagesBenefitsController::class,'update'])->name('wages-benefits.update');
    Route::post('wages-benefits/delete', [WagesBenefitsController::class, 'destroy'])->name('wages-benefits.delete');
    
    
    Route::get('goal/{id}', [GoalController::class, 'indexs']) ->name('goal');
    Route::post('goal/list', [GoalController::class, 'list'])->name('goal.list');
    Route::get('goals/create', [GoalController::class, 'create'])->name('goal.create');
    Route::post('goal/store', [GoalController::class, 'store'])->name('goal.store');
    Route::get('goal/update/{id}', [GoalController::class, 'update'])->name('goal.update');
    Route::post('goal/delete', [GoalController::class, 'destroy'])->name('goal.delete');
    Route::post('goal/status', [GoalController::class, 'status'])->name('goal.status');
    Route::get('goal/show', [GoalController::class, 'show'])->name('goal.show');
    Route::post('goal/add-key', [GoalController::class, 'GoalKey'])->name('addgoalkey');
    Route::post('goal/edit-key', [GoalController::class, 'EditGoalKey'])->name('editgoalkey');
    Route::post('goal/store-key', [GoalController::class, 'StoreGoalKey'])->name('storegoalkey');
    Route::post('goal/delete-key', [GoalController::class, 'deleteGoalKey'])->name('deletegoalkey');
    Route::post('goal/history', [GoalController::class, 'histories'])->name('goalhistory');
    Route::get('goals/goal-orverview',[GoalController::class,'goalOverView'])->name('goalorderview');
    Route::get('goal-orverview/list/{id}',[GoalController::class,'goalOverViewList'])->name('goalorderviewList');
    
    Route::get('/employee-goal-overview/filter', [GoalController::class, 'employee_goaloverview_filter'])->name('employee.goaloverview.filter'); 

    Route::get('/hr-goal-overview', [GoalController::class, 'hrGoalOverView'])->name('hrgoaloverview'); 
    Route::get('/hr-goal-overview/filter', [GoalController::class, 'hrSearchFilter'])->name('hrgoaloverview.filter');
    
    Route::get('performance', [PerformanceController::class, 'index'])
    ->name('performance');
    Route::post('performance/tab', [PerformanceController::class, 'performanceTab'])
    ->name('performance.tab');
  
    Route::post('performance/list', [PerformanceController::class, 'list'])
        ->name('performance.list');
    Route::get('performance/create', [PerformanceController::class, 'create'])
        ->name('performance.create');
    Route::post('performance/store', [PerformanceController::class, 'store'])
        ->name('performance.store');
    Route::get('performance/update', [PerformanceController::class, 'update'])
        ->name('performance.update');
    Route::post('performance/delete', [PerformanceController::class, 'destroy'])
        ->name('performance.delete');
    Route::post('performance/status', [PerformanceController::class, 'status'])
        ->name('performance.status');
    Route::get('performance/show', [PerformanceController::class, 'show'])
        ->name('performance.show');
    
    Route::post('performance/employee/status', [PerformanceController::class, 'acceptEmployee'])
        ->name('performance.employee.review.update');
    
    Route::get('performance/request/{id}', [PerformanceController::class, 'performanceReviewRequest'])
        ->name('performance.request');
    Route::get('performance/request/complete/{id}', [PerformanceController::class, 'performanceReviewRequestComplete'])
        ->name('performance.request.complete');
    
    Route::post('performance/manager/status', [PerformanceController::class, 'acceptManager'])
        ->name('performance.manager.review.update');
    
    Route::post('performance/review/goal', [PerformanceController::class, 'updateGoal'])
        ->name('performance.review.goal.update');


    Route::get('goalreview',[GoalReviewController::class,'index'])->name('goalreview');
    Route::get('goalreview/team/list',[GoalReviewController::class,'managerindex'])->name('goalreview.team.list');
    Route::post('goal-review/list',[GoalReviewController::class,'list'])->name('goal-review.list');
    Route::get('goal-review/create',[GoalReviewController::class,'create'])->name('goal-review.create');
    Route::post('goal-review/store',[GoalReviewController::class,'store'])->name('user.goal-review.store');
    Route::post('goal-review/update',[GoalReviewController::class,'update'])->name('goal-review.update');
   
    Route::get('pending/review', [GoalReviewController::class, 'pendingReview'])->name('goalPendingreview');
    Route::get('completed/review', [GoalReviewController::class, 'completedReview'])->name('goalCompletedreview');
    Route::post('goalreview-pending-list', [GoalReviewController::class, 'Pendinglist'])->name('user.goalreview.pendinglist');
    Route::post('goalreview-completed-list', [GoalReviewController::class, 'Completedlist'])->name('user.goalreview.completedlist');


    Route::get('goal-review-respond/{id}', [GoalReviewController::class, 'result'])->name('goal-review.respond');
    Route::get('goal-review-manager-response/{id}', [GoalReviewController::class, 'managerResponse'])->name('goal-review-manager.respond');
    
    Route::get('goal-review-result/{id}',[GoalReviewController::class, 'goalResult'])->name('goal-review.result');
    Route::post('goal-review-team-list',[GoalReviewController::class, 'teamGoalReviewList'])->name('goal-review.team-list');
    Route::post('goal-result/getpdf',[GoalReviewController::class, 'goalResultPDF'])->name('goalresult.pdf');
    
    Route::get('hr-goal-review',[GoalReviewController::class,'hrindex'])->name('hr-goal-review');
    Route::post('hr/goal-review/list',[GoalReviewController::class,'employeelist'])->name('hr.goalreview.list');
    Route::get('hr/goal-review/create',[GoalReviewController::class,'hrAddGoalReview'])->name('hr.goal-review.create');
    Route::post('hr/goal-review/store',[GoalReviewController::class,'hrstoredata'])->name('hr.goal-review.store');
    Route::post('hr/goal-review/update',[GoalReviewController::class,'hrUpdateData'])->name('hr.goal-review.update');
    Route::post('goal-review/delete', [GoalReviewController::class, 'destroy'])->name('goal-review.delete');
  
    Route::get('certificate', [CertificateController::class, 'index'])->name('certificate'); 
    Route::post('certificate/list', [CertificateController::class, 'list'])->name('certificate.list'); 
    Route::get('certificate/create', [CertificateController::class, 'create'])->name('certificate.create'); 
    Route::post('certificate/store', [CertificateController::class, 'store'])->name('certificate.store'); 
    Route::get('certificate/update', [CertificateController::class, 'update'])->name('certificate.update');
    Route::post('saveimage',[CertificateController::class, 'imageupload'])->name('saveimage');
    Route::post('certificate/delete', [CertificateController::class, 'destroy'])->name('certificate.delete');
    
    Route::get('myCertificate', [CertificateController::class, 'myCertificateIndex'])->name('myCertificate'); 
    Route::post('mycertificate/list', [CertificateController::class, 'myCertificateList'])->name('myCertificate.list');
    Route::get('teamcertificate/create', [CertificateController::class, 'createTeamCertificate'])->name('teamcertificate.create'); 
    Route::post('teamcertificate/store', [CertificateController::class, 'storeTeamCertificates'])->name('teamcertificate.store');  
    Route::post('teamcertificate/delete', [CertificateController::class, 'destroyTeam'])->name('teamcertificate.delete'); 
   
    Route::get('talent_search', [TalentSearchController::class, 'index'])->name('talent_search');

    Route::post('get-state', [CertificateController::class, 'getStateData'])->name('getStateData');

    // Route::post('goal/updatepopStatus',[GoalController::class, 'updatePopStatus'])->name('goal.popstatus');

    Route::post('goalReview/updatepopStatus',[GoalReviewController::class, 'updatePopStatus'])->name('goalreview.popstatus');

    Route::get('myPrformanceReview', [ProfileController::class, 'myPerformanceReview'])->name('myPrformanceReview');
    Route::get('myTeamPrformanceReview', [ProfileController::class, 'myTeamPerformanceReview'])->name('myTeamPerformanceReview');
    Route::get('hrteamPerformanceReview', [ProfileController::class, 'hrTeamPerformance'])->name('hrTeamPerformanceReview');

    Route::get('employee/pending/review', [GoalReviewController::class, 'employeePendingReview'])->name('allGoalPendingreview');
    Route::get('employee/completed/review', [GoalReviewController::class, 'employeeCompletedReview'])->name('allGoalCompletedreview');
    Route::post('employee/goalreview-pending-list', [GoalReviewController::class, 'EmployeeGaolPendinglist'])->name('employee.goalreview.pendinglist');
    Route::post('employee/goalreview-completed-list', [GoalReviewController::class, 'EmployeeGoalCompletedlist'])->name('employee.goalreview.completedlist');

    
    Route::get('employee-leave-history', [EmployeeLeaveController::class, 'index'])->name('employee-leave-history');
    Route::post('employee-leave-history/leave-tab', [EmployeeLeaveController::class, 'leaveProfileTab'])->name('employeehistory.leave.tab');
    Route::post('employee-leave-history/department-tab', [EmployeeLeaveController::class, 'leaveTypeTab'])->name('employee-leave-history.department.tab');
    Route::post('employee-leave-history/list-show', [EmployeeLeaveController::class, 'departmentLeaveList'])->name('leavehistory.list.show');
});

require __DIR__ . '/auth.php';

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

// Route::middleware('auth:admin')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/adminAuth.php';

Route::get('master/dashboard', function () {
    return view('master.dashboard');
})->middleware(['auth:master', 'verified'])->name('master.dashboard');

// Route::middleware('auth:master')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/masterAuth.php';
