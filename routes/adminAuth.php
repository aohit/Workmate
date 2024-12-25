<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\YearSessionsController;
use App\Http\Controllers\Admin\AdminDashboardController; 
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LeaveController; 
use App\Http\Controllers\Admin\DepartmentController; 
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\LeaveTypeController; 
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\DocumentCategoryController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\AppraisalController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CompanyAnnouncementController;
use App\Http\Controllers\Admin\CompetenceController;
use App\Http\Controllers\Admin\DevelopmentController;
use App\Http\Controllers\Admin\DisciplinaryController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\GoalCategoryController;
use App\Http\Controllers\Admin\GoalController;
use App\Http\Controllers\Admin\GoalStatusController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\MyTrainingController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProfileController; 
use App\Http\Controllers\Admin\PerformanceController;
use App\Http\Controllers\Admin\QueFormController;
use App\Http\Controllers\Admin\Questionnaire;
use App\Http\Controllers\Admin\ResourseFilesController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\RatingScaleController;
use App\Http\Controllers\Admin\ResponsibilityController;
use App\Http\Controllers\Admin\ReviwCycleController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\WagesBenefitsController;
use App\Http\Controllers\Admin\GoalReviewController;
use App\Http\Controllers\Admin\EmergencycontactController;
use App\Http\Controllers\Admin\TalentSearchController;
use App\Http\Controllers\Admin\DisciplinaryActionTypeController;


// Route::middleware('guest')->group(function () {
    // Route::group(['middleware' => ['guest:admin'], 'prefix' => 'admin', 'as' => 'admin'], function(){
 
Route::middleware('guest:admin')->group(function () {
    
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('admin.register');

    Route::post('register', [RegisteredUserController::class, 'store'])->name('register');

    Route::get('admin/login', [AuthenticatedSessionController::class, 'create'])
                ->name('admin.login');

    Route::post('admin/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('admin/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('admin.password.request');

    Route::post('admin/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('admin.password.email');

    Route::get('admin/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('admin.password.reset');

    Route::post('admin/reset-password', [NewPasswordController::class, 'store'])
                ->name('admin.password.store');
});



Route::middleware('auth:admin')->group(function () {
    
    Route::get('admin', [AdminDashboardController::class, 'index']);
               
    Route::get('admin/verify-email', EmailVerificationPromptController::class)
                ->name('admin.verification.notice');

    Route::get('admin/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('admin.verification.verify');

    Route::post('admin/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('admin.verification.send');

    Route::get('admin/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('admin.password.confirm');

    Route::post('admin/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('admin/password', [PasswordController::class, 'update'])->name('admin.password.update');

    Route::post('admin/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('admin.logout');

    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])
                ->name('admin.dashboard');
       
});

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {


        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/profile-image', [ProfileController::class, 'imageupload'])->name('profile.image');
        Route::post('/profile', [ProfileController::class, 'store'])->name('profile.update'); 
        Route::post('/profile/images', [ProfileController::class, 'storeImages'])->name('profile.images'); 
        Route::get('/admin-goal-overview', [ProfileController::class, 'adminGoalOverView'])->name('goaloverview'); 
        
        Route::get('/user-goal-overview', [ProfileController::class, 'userSearch'])->name('usergoaloverview'); 
 
        Route::get('admin-user', [AdminUserController::class, 'index'])
        ->name('admin_user');
    Route::post('admin-user/list', [AdminUserController::class, 'list'])
        ->name('admin_user.list');
    Route::get('admin-user/create', [AdminUserController::class, 'create'])
        ->name('admin_user.create');
    Route::post('admin-user/store', [AdminUserController::class, 'store'])
        ->name('admin_user.store');   
    Route::get('admin-user/update', [AdminUserController::class, 'update'])
        ->name('admin_user.update');    
    Route::post('admin-user/delete', [AdminUserController::class, 'destroy'])
        ->name('admin_user.delete');       

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


                Route::get('calendar', [CalendarController::class, 'index'])
                ->name('calendar');
                Route::get('calendar/get-employee', [CalendarController::class, 'getEmployee'])
                ->name('calendar.getemployee');
                Route::get('/calendar/get-leave', [CalendarController::class, 'getLeaveDates'])
                ->name('calendar.getleave');

                Route::post('/calendar/filter-employees', [CalendarController::class, 'filterEmployees'])->name('calendar.filterEmployees');
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
                Route::get('holiday/addcolors', [HolidayController::class, 'addColors'])->name('holiday.coloradd'); 
                Route::post('holiday/colorsupdate', [HolidayController::class, 'colorsUpdate'])->name('holiday.colorsupdate'); 

                Route::get('document-category', [DocumentCategoryController::class, 'index'])
                ->name('document-category');
            Route::post('document-category/list', [DocumentCategoryController::class, 'list'])
                ->name('document-category.list');
            Route::get('document-category/create', [DocumentCategoryController::class, 'create'])
                ->name('document-category.create');
            Route::post('document-category/store', [DocumentCategoryController::class, 'store'])
                ->name('document-category.store');   
            Route::get('document-category/update', [DocumentCategoryController::class, 'update'])
                ->name('document-category.update');    
            Route::post('document-category/delete', [DocumentCategoryController::class, 'destroy'])
                ->name('document-category.delete');
            Route::post('document-category/status', [DocumentCategoryController::class, 'status'])
                ->name('document-category.status');

                Route::get('document', [DocumentController::class, 'index'])
                ->name('document');
            Route::post('document/list', [DocumentController::class, 'list'])
                ->name('document.list');
            Route::get('document/create', [DocumentController::class, 'create'])
                ->name('document.create');
            Route::post('document/store', [DocumentController::class, 'store'])
                ->name('document.store');   
            Route::get('document/update', [DocumentController::class, 'update'])
                ->name('document.update');    
            Route::post('document/delete', [DocumentController::class, 'destroy'])
                ->name('document.delete');
            Route::post('document/status', [DocumentController::class, 'status'])
                ->name('document.status');
            Route::post('document/upload', [DocumentController::class, 'upload'])
                ->name('document.upload');


                Route::get('performance', [PerformanceController::class, 'index'])
                ->name('performance');
                Route::post('performance/tab', [PerformanceController::class, 'tabClick'])
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

                Route::post('performance/request', [PerformanceController::class, 'performanceReviewRequest'])
                ->name('performance.request');


                Route::get('resources', [ResourseFilesController::class, 'index'])->name('resources');
	        	Route::post('resources/list', [ResourseFilesController::class, 'list'])->name('resources.list');
		        Route::get('resources/create', [ResourseFilesController::class, 'create'])->name('resources.create');
		        Route::post('resources/store', [ResourseFilesController::class, 'store'])->name('resources.store');   
		        Route::post('resources/delete', [ResourseFilesController::class, 'destroy'])->name('resources.delete');

                Route::get('team-list', [ProfileController::class, 'myTeam'])->name('team.list');
		        Route::post('team-list-show', [ProfileController::class, 'myTeamList'])->name('team.list.show');
	        	Route::post('team-profile-tab', [ProfileController::class, 'myTeamProfileTab'])->name('team.profile.tab');
		        Route::post('team-department-tab', [ProfileController::class, 'departmentTab'])->name('team.department.tab');
		        Route::get('team-profile', [ProfileController::class, 'myTeamProfile'])->name('team.profile');

                Route::get('skills', [SkillController::class, 'employeeIndex'])
                ->name('skills');
            Route::post('skills/list', [SkillController::class, 'list'])
                ->name('skills.list');
            Route::get('skills/create', [SkillController::class, 'create'])
                ->name('skills.create');
            Route::post('skills/store', [SkillController::class, 'store'])
                ->name('skills.store');   
            Route::get('skills/update', [SkillController::class, 'update'])
                ->name('skills.update');    
            Route::post('skills/delete', [SkillController::class, 'destroy'])
                ->name('skills.delete'); 
                
           Route::get('skills/export/', [SkillController::class, 'export'])->name('skill.export');
           
           Route::get('education', [EducationController::class, 'educationIndex'])->name('education');
           Route::post('education/list', [EducationController::class, 'list'])->name('education.list');
           Route::get('education/create', [EducationController::class, 'create'])->name('education.create');
           Route::post('education/store', [EducationController::class, 'store'])->name('education.store');
           Route::get('education/update', [EducationController::class, 'update'])->name('education.update');
           Route::post('education/delete', [EducationController::class, 'destroy'])->name('education.delete');
         
           Route::get('certificate', [CertificateController::class, 'index'])->name('certificate'); 
           Route::post('certificate/list', [CertificateController::class, 'list'])->name('certificate.list'); 
           Route::get('certificate/create', [CertificateController::class, 'create'])->name('certificate.create'); 
           Route::post('certificate/store', [CertificateController::class, 'store'])->name('certificate.store'); 
           Route::get('certificate/update', [CertificateController::class, 'update'])->name('certificate.update');
           Route::post('saveimage',[CertificateController::class, 'imageupload'])->name('saveimage');
           Route::post('certificate/delete', [CertificateController::class, 'destroy'])->name('certificate.delete');
           Route::post('get-state', [CertificateController::class, 'getStateData'])->name('getStateData');
           Route::get('certificate/show',[CertificateController::class,'show'])->name('certificate.show');
           
          Route::get('language', [LanguageController::class, 'index'])->name('language'); 
           Route::post('languages/list', [LanguageController::class, 'list'])->name('languages.list'); 
           Route::get('languages/create', [LanguageController::class, 'create'])->name('languages.create'); 
           Route::post('languages/store', [LanguageController::class, 'store'])->name('languages.store'); 
           Route::get('languages/update', [LanguageController::class, 'update'])->name('languages.update');
           Route::post('languages/delete', [LanguageController::class, 'destroy'])->name('languages.delete');
           
           Route::resource('rating-scales', RatingScaleController::class);
           Route::get('rating-scales', [RatingScaleController::class,'index'])->name('rating-scales');
           Route::post('rating-scales', [RatingScaleController::class,'list'])->name('rating-scales.list');
           Route::get('rating-scalescreate', [RatingScaleController::class,'create'])->name('rating-scalescreate');
           Route::get('rating-scales-create', [RatingScaleController::class,'create'])->name('rating-scales.create');
           Route::post('rating-scales-store', [RatingScaleController::class,'store'])->name('rating-scales.store');
           Route::get('rating-scales-edit/{id}', [RatingScaleController::class,'edit'])->name('rating-scales.edit');
           Route::post('rating-scales-update', [RatingScaleController::class,'update'])->name('rating-scales.update');
           Route::delete('rating-scales/{id}', [RatingScaleController::class,'destroy'])->name('rating-scales.destroy');
         

                Route::get('appraisal',[AppraisalController::class, 'index'])->name('appraisal');
                Route::post('appraisal-list',[AppraisalController::class, 'list'])->name('appraisal.list');
                Route::get('appraisal-create',[AppraisalController::class, 'create'])->name('appraisal.create');
                Route::post('appraisal-store',[AppraisalController::class, 'store'])->name('appraisal.store');
                Route::get('appraisal-update',[AppraisalController::class, 'update'])->name('appraisal.update');
                Route::get('appraisal-result/{id}',[AppraisalController::class, 'result'])->name('appraisal.result');
                Route::post('get/appraisal/pdf',[AppraisalController::class, 'appraisalPDF'])->name('appraisal.pdf');
                 
                Route::get('admin/my-training',[MyTrainingController::class,'index'])->name('training');
                Route::post('admin/my-training',[MyTrainingController::class,'list'])->name('training-list');
                Route::get('admin/my-training/create',[MyTrainingController::class,'create'])->name('training-create');
                Route::post('admin/my-training/create',[MyTrainingController::class,'store'])->name('training-store');
                Route::get('admin/my-training/update',[MyTrainingController::class,'update'])->name('training-update');
                Route::post('admin/my-training/delete',[MyTrainingController::class,'destroy'])->name('training-delete');
                Route::post('admin/my-training/status',[MyTrainingController::class,'status'])->name('training-status');

                Route::get('admin/my-training/export', [MyTrainingController::class, 'export'])->name('my-training.export');
                
                Route::get('questionnaire',[QueFormController::class,'index'])->name('questionnaire');
                Route::post('questionnaire',[QueFormController::class,'list'])->name('questionnaire-list');
                Route::get('questionnaire/create',[QueFormController::class,'create'])->name('questionnaire-create');
                Route::post('questionnaire/add-inlput',[QueFormController::class,'AddInput'])->name('questionnaire-addInput');
                Route::post('questionnaire/stor-inlput',[QueFormController::class,'storeInput'])->name('questionnaire-storInput');
                Route::post('questionnaire/stor',[QueFormController::class,'store'])->name('questionnaire-stor');
                Route::post('questionnaire/delete',[QueFormController::class,'destroy'])->name('questionnaire-delete');
                Route::get('questionnaire/show/{id}',[QueFormController::class,'show'])->name('questionnaire-show');
                Route::post('questionnaire/status',[QueFormController::class,'status'])->name('questionnaire-status');
                Route::post('questionnaire/duplication',[QueFormController::class,'duplication'])->name('questionnaire-duplication');
                Route::get('questionnaire/edit/{id}',[QueFormController::class,'Edit'])->name('questionnaire-edit');
                Route::post('questionnaire/edit/inputs',[QueFormController::class,'EditInputs'])->name('questionnaire-edit-inputs');
                Route::post('questionnaire/edit/sotore',[QueFormController::class,'EditInputStore'])->name('questionnaire-edit-store');
                Route::post('questionnaire/delete-input',[QueFormController::class,'DeleteInput'])->name('questionnaire-delete-input');
                Route::post('questionnaire/delete-section',[QueFormController::class,'DeleteSection'])->name('questionnaire-delete-section');
                Route::post('questionnaire/edit-add-section',[QueFormController::class,'AddSections'])->name('questionnaire-add-section');
                Route::post('questionnaire/edit-add-inputs',[QueFormController::class,'AddSectionInput'])->name('questionnaire-add-sectionInput');
                Route::post('questionnaire/edit-add-store',[QueFormController::class,'AddSectionInputStore'])->name('questionnaire-add-sectionInputStore');

                Route::get('task',[TaskController::class,'index'])->name('task');
                Route::post('task',[TaskController::class,'list'])->name('task-list');
                Route::get('task-create',[TaskController::class,'create'])->name('task-create');
                Route::post('task-store',[TaskController::class,'store'])->name('task-stor');
                Route::post('task/update',[TaskController::class,'update'])->name('task-update');
                Route::post('task/delete', [TaskController::class, 'destroy'])->name('task-delete');

                Route::get('review-cycle',[ReviwCycleController::class,'index'])->name('review-cycle');
                Route::post('review-cycle',[ReviwCycleController::class,'list'])->name('review-cycle-list');
                Route::get('create-review-cycle',[ReviwCycleController::class,'create'])->name('create-review-cycle');
                Route::post('store-review-cycle',[ReviwCycleController::class,'store'])->name('store-review-cycle');
                Route::post('review-cycle-status',[ReviwCycleController::class,'status'])->name('review-cycle-status');
                Route::post('update-review-cycle',[ReviwCycleController::class,'update'])->name('update-review-cycle');
                Route::post('delete-review-cycle', [ReviwCycleController::class, 'destroy'])->name('delete-review-cycle');
                Route::get('review-cycle/export', [ReviwCycleController::class, 'export'])->name('review-cycle.export');

                Route::get('goal-category',[GoalCategoryController::class,'index'])->name('goal-category');
                Route::post('goal-category-list',[GoalCategoryController::class,'list'])->name('goal-categorylist');
                Route::get('create-goal-category',[GoalCategoryController::class,'create'])->name('goal-category-create');
                Route::post('store-goal-category',[GoalCategoryController::class,'store'])->name('goal-category-store');
                Route::post('goal-category-status',[GoalCategoryController::class,'status'])->name('goal-category-status');
                Route::post('update-goal-category',[GoalCategoryController::class,'update'])->name('update-goal-category');
                Route::post('delete-goal-category', [GoalCategoryController::class, 'destroy'])->name('delete-goal-category');

                Route::get('goal-status',[GoalStatusController::class,'index'])->name('goal-status');
                Route::post('goal-status-list',[GoalStatusController::class,'list'])->name('list-goal-status');
                Route::get('create-goal-status',[GoalStatusController::class,'create'])->name('create-goal-status');
                Route::post('store-goal-status',[GoalStatusController::class,'store'])->name('store-goal-status');
                Route::post('goal-status-status',[GoalStatusController::class,'status'])->name('goalstatus-status');
                Route::post('update-goal-status',[GoalStatusController::class,'update'])->name('update-goal-status');
                Route::post('delete-goal-status', [GoalStatusController::class, 'destroy'])->name('delete-goal-status');

                Route::get('goal', [GoalController::class, 'index']) ->name('goal');
                Route::post('goal/list', [GoalController::class, 'list'])->name('goal.list');
                Route::get('goal/create', [GoalController::class, 'create'])->name('goal.create');
                Route::post('goal/store', [GoalController::class, 'store'])->name('goal.store');
                Route::get('goal/update/{id}', [GoalController::class, 'update'])->name('goal.update');
                Route::post('goal/delete', [GoalController::class, 'destroy'])->name('goal.delete');
                Route::post('goal/status', [GoalController::class, 'status'])->name('goal.status');
                Route::get('goal/show', [GoalController::class, 'show'])->name('goal.show');
                Route::post('goal/add-key', [GoalController::class, 'GoalKey'])->name('addgoalkey');
                Route::post('goal/edit-key', [GoalController::class, 'EditGoalKey'])->name('editgoalkey');
                Route::post('goal/store-key', [GoalController::class, 'StoreGoalKey'])->name('storegoalkey');
                Route::post('goal/delete-key', [GoalController::class, 'deleteGoalKey'])->name('deletegoalkey');
                Route::post('goal/history', [GoalController::class, 'histories'])->name('history');

                Route::get('myGoals', [GoalController::class, 'myGoals'])->name('my_goals');

                Route::get('goal/competencies', [CompetenceController::class, 'index'])->name('goal.competencies');
                Route::post('goal/competencies-list', [CompetenceController::class, 'list'])->name('goal.competencies.list');
                Route::get('goal/add-competencies', [CompetenceController::class, 'create'])->name('creatcompetence');
                Route::post('goal/competencies/store-key', [CompetenceController::class, 'StoreGoalKey'])->name('storecompetenciedskey');
                Route::post('goal/competencies/store', [CompetenceController::class, 'store'])->name('storecompetencied');
                Route::get('competencies/edit/{id}', [CompetenceController::class, 'update'])->name('updatecompetencied');
                Route::post('competencies/delete', [CompetenceController::class, 'destory'])->name('destoryompetencied');
                Route::post('competencies/history', [CompetenceController::class, 'histories'])->name('competencieshistory');

                Route::get('goal/responsibility', [ResponsibilityController::class, 'index'])->name('goal.responsibility');
                Route::post('goal/responsibility/list', [ResponsibilityController::class, 'list'])->name('goal.responsibility.list');
                Route::get('goal/add-responsibility', [ResponsibilityController::class, 'create'])->name('creatresponsibility');
                Route::post('goal/responsibility/store-key', [ResponsibilityController::class, 'StoreresponsibilityKey'])->name('storeresponsibilitykey');
                Route::post('goal/responsibility/store', [ResponsibilityController::class, 'store'])->name('storeresponsibility');
                Route::get('responsibility/edit/{id}', [ResponsibilityController::class, 'update'])->name('updateresponsibility');
                Route::post('responsibility/delete', [ResponsibilityController::class, 'destory'])->name('destoryresponsibility');
                Route::post('responsibility/history', [ResponsibilityController::class, 'histories'])->name('responsibilityhistory');


                Route::get('goal/development', [DevelopmentController::class, 'index'])->name('goal.development');
                Route::post('goal/development/list', [DevelopmentController::class, 'list'])->name('goal.development.list');
                Route::get('goal/add-development', [DevelopmentController::class, 'create'])->name('creatdevelopment');
                Route::post('goal/development/store-key', [DevelopmentController::class, 'StoredevelopmentkeyKey'])->name('storedevelopmentkey');
                Route::post('goal/development/store', [DevelopmentController::class, 'store'])->name('storedevelopment');
                Route::get('development/edit/{id}', [DevelopmentController::class, 'update'])->name('updatedevelopment');
                Route::post('development/delete', [DevelopmentController::class, 'destory'])->name('destorydevelopment');
                Route::post('development/history', [DevelopmentController::class, 'histories'])->name('developmenthistory');


                // Route::get('admin/color',[ColorController::class,'index'])->name('color');
                // Route::post('admin/color',[ColorController::class,'list'])->name('color-list');
                // Route::get('admin/color/create',[ColorController::class,'create'])->name('color-create');
                // Route::post('admin/color/create',[ColorController::class,'store'])->name('color-store');
                // Route::get('admin/color/update',[ColorController::class,'update'])->name('color-update');
                // Route::post('admin/color/delete',[ColorController::class,'destroy'])->name('color-delete');

                Route::get('announcement', [CompanyAnnouncementController::class, 'index'])->name('announcement'); 
                Route::post('admin/announcement',[CompanyAnnouncementController::class,'list'])->name('announcement-list');
                Route::get('admin/announcement/create',[CompanyAnnouncementController::class,'create'])->name('announcement-create');
                Route::post('admin/announcement/create',[CompanyAnnouncementController::class,'store'])->name('announcement-store');
                Route::get('admin/announcement/update',[CompanyAnnouncementController::class,'update'])->name('announcement-update');
                Route::post('admin/announcement/delete',[CompanyAnnouncementController::class,'destroy'])->name('announcement-delete');
                Route::get('admin/announcement/show', [CompanyAnnouncementController::class, 'show'])->name('announcement-show'); 
                Route::post('admin/announcement/status',[CompanyAnnouncementController::class,'status'])->name('announcement-status');
                
                 Route::get('users/export/', [EmployeeController::class, 'export'])->name('export');
	            Route::get('team-profile/{id}', [ProfileController::class, 'teamProfile'])->name('team.profile');
	            Route::post('team-profile-tabs', [ProfileController::class, 'teamProfileTab'])->name('team.profile.tabs');

                
            Route::get('disciplinary', [DisciplinaryController::class, 'index'])
            ->name('disciplinary');
        Route::post('disciplinary/list', [DisciplinaryController::class, 'list'])
            ->name('disciplinary.list');
        Route::get('disciplinary/create', [DisciplinaryController::class, 'create'])
            ->name('disciplinary.create');
        Route::post('disciplinary/store', [DisciplinaryController::class, 'store'])
            ->name('disciplinary.store');   
        Route::get('disciplinary/update', [DisciplinaryController::class, 'update'])
            ->name('disciplinary.update');    
        Route::post('disciplinary/delete', [DisciplinaryController::class, 'destroy'])
            ->name('disciplinary.delete');
        Route::get('disciplinary/export', [DisciplinaryController::class, 'export'])->name('disciplinary.export');

            Route::get('wagesbenefits',[WagesBenefitsController::class,'index'])->name('wagesbenefits');
            Route::post('wages-benefits/list',[WagesBenefitsController::class,'list'])->name('wages-benefits.list');
            Route::get('wages-benefits/create',[WagesBenefitsController::class,'create'])->name('wages-benefits.create');
            Route::post('wages-benefits/store',[WagesBenefitsController::class,'store'])->name('wages-benefits.store');
            Route::post('wages-benefits/update',[WagesBenefitsController::class,'update'])->name('wages-benefits.update');
            Route::post('wages-benefits/delete', [WagesBenefitsController::class, 'destroy'])->name('wages-benefits.delete');

            Route::post('get-leave', [CalendarController::class, 'fullcalender'])->name('calendar.fullcalendar');
            Route::post('fullcalender/dates', [CalendarController::class, 'showdates'])
            ->name('fullcalender.dates'); 
            Route::post('calendar/store', [CalendarController::class, 'store'])
            ->name('calendar.store');  
            
            Route::get('goalreview',[GoalReviewController::class,'index'])->name('goalreview');
            Route::post('goal-review/list',[GoalReviewController::class,'list'])->name('goal-review.list');
            Route::get('goal-review/create',[GoalReviewController::class,'create'])->name('goal-review.create');
            Route::post('goal-review/store',[GoalReviewController::class,'store'])->name('goal-review.store');
            Route::post('goal-review/update',[GoalReviewController::class,'update'])->name('goal-review.update');
            Route::post('goal-review/delete', [GoalReviewController::class, 'destroy'])->name('goal-review.delete');


        
            Route::get('emergencycontact',[EmergencycontactController::class,'index'])->name('emergencycontact');
            Route::post('emergency-contact/list',[EmergencycontactController::class,'list'])->name('emergency-contact.list');
            Route::get('emergency-contact/create',[EmergencycontactController::class,'create'])->name('emergency-contact.create');
            Route::post('emergency-contact/store',[EmergencycontactController::class,'store'])->name('emergency-contact.store');
            Route::post('emergency-contact/update',[EmergencycontactController::class,'update'])->name('emergency-contact.update');
            Route::post('emergency-contact/delete', [EmergencycontactController::class, 'destroy'])->name('emergency-contact.delete');
            Route::get('emergency-contact/export/', [EmergencycontactController::class, 'export'])->name('emergency-contact.export');
        
            Route::get('admin/emergency-contact/export', [EmergencyContactController::class, 'export'])->name('admin.emergency-contact.export');

            Route::get('talent_search', [TalentSearchController::class, 'index'])->name('talent_search');

            Route::get('disciplinaryactiontype', [DisciplinaryActionTypeController::class, 'index'])->name('disciplinaryactiontype');
            Route::post('disciplinaryactiontype/list', [DisciplinaryActionTypeController::class, 'list'])->name('disciplinaryactiontype.list');
            Route::get('disciplinaryactiontype/create', [DisciplinaryActionTypeController::class, 'create'])->name('disciplinaryactiontype.create');
            Route::post('disciplinaryactiontype/store', [DisciplinaryActionTypeController::class, 'store'])->name('disciplinaryactiontype.store');   
            Route::get('disciplinaryactiontype/update', [DisciplinaryActionTypeController::class, 'update'])->name('disciplinaryactiontype.update');    
            Route::post('disciplinaryactiontype/delete', [DisciplinaryActionTypeController::class, 'destroy'])->name('disciplinaryactiontype.delete');
            Route::post('disciplinaryactiontype/status', [DisciplinaryActionTypeController::class, 'status'])
                ->name('disciplinaryactiontype.status'); 

            Route::get('year-session',[YearSessionsController::class,'index'])->name('year-session');
            Route::post('year-session/list',[YearSessionsController::class,'list'])->name('year-session.list'); 
            Route::post('year-session-status',[YearSessionsController::class,'status'])->name('year-session-status');   
});      