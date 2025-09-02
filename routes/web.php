<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\DataImportController;
use App\Models\Student;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('home.search');
});

Route::get('/admin', function () {
    return view('home.login');
});

//User

Route::get('/dashboard', [UserController::class, 'Dashboard']);
Route::get('/userManagement', [UserController::class, 'UserManagement']);
Route::post('/addUser', [UserController::class, 'AddUser']);
Route::post('/login', [UserController::class, 'Login']);
Route::get('/logout', [UserController::class, 'Logout']);
Route::get('/changePasswordView{id}', [UserController::class, 'ChangePasswordView']);
Route::post('/changePassword', [UserController::class, 'ChangePassword']);
Route::get('/editProfileView{id}', [UserController::class, 'EditProfileView']);
Route::post('/editProfile', [UserController::class, 'EditProfile']);
// Route::post('/resetPassword', [UserController::class, 'ResetPassword'])->name('users.resetPassword');
// Route::get('/disableUser{id}',[UserController::class,'DisableUser']);
Route::get('/disableUser/{id}', [UserController::class, 'DisableUser']);
Route::post('/users/{id}/password', [UserController::class, 'ResetPassword'])->name('users.resetPassword');


Route::post('/students/store', [StudentController::class, 'storeStudent'])->name('students.store');
Route::get('/pendingStudents', [StudentController::class, 'pendingStudents'])->name('students.pending');

//Branch
Route::get('/branchManagement', [BranchController::class, 'BranchManagement']);
Route::post('/addBranch', [BranchController::class, 'AddBranch']);
Route::post('/editBranch', [BranchController::class, 'EditBranch']);
Route::get('/deleteBranch{branch_id}', [BranchController::class, 'DeleteBranch']);

//Course
Route::get('/courseManagement', [CourseController::class, 'CourseManagement']);
Route::post('/addCourse', [CourseController::class, 'AddCourse']);
Route::post('/editCourse', [CourseController::class, 'EditCourse']);
Route::get('/deleteCourse{course_id}', [CourseController::class, 'DeleteCourse']);

//Student
Route::get('/studentManagement', [StudentController::class, 'StudentManagement']);
Route::post('/addStudent', [StudentController::class, 'AddStudent']);
Route::post('/editStudent', [StudentController::class, 'EditStudent']);
Route::get('/deleteStudent{student_id}', [StudentController::class, 'DeleteStudent']);

// batch
Route::get('/batchManagement', [BatchController::class, 'BatchManagement']);
Route::post('/addBatch', [BatchController::class, 'AddBatch']);
Route::post('/editBatch', [BatchController::class, 'EditBatch']);
Route::get('/deleteBatch{batch_id}', [BatchController::class, 'DeleteBatch']);

Route::get('/search', [StudentController::class, 'SearchStudent']);
Route::get('/dataImportPage', [DataImportController::class, 'DataImportPage']);
Route::post('/importData', [DataImportController::class, 'ImportData']);

// Filtering Students (Import Data)
Route::get('/filterStudentDetails', [DataImportController::class, 'FilterStudentDetails']);
Route::post('/filter-students', [DataImportController::class, 'filterStudents'])->name('filter-students');

// Fetch Student Data
Route::get('/get-students', [StudentController::class, 'getStudents']);
Route::get('/student-details/{encoded_id}', [StudentController::class, 'StudentDetails'])
    ->where('encoded_id', '.*'); // Prevent issues with encoded parameters

// students
// Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
// Route::post('/students/update-ids', [StudentController::class, 'updateIds'])->name('students.updateIds');

// enrollments
// Route::post('/enrollments/assign-batch', [StudentController::class, 'assignBatch'])->name('enrollments.assignBatch');
// Route::delete('/enrollments/{id}', [StudentController::class, 'destroy'])->name('enrollments.destroy');





// Student Status Management
// Route::post('/update-status', [StudentController::class, 'updateStatus'])->name('students.updateStatus');
// Route::post('/update-statuscertified', [StudentController::class, 'updateStatuscertified'])->name('students.updateStatuscertified');
// Route::post('/update-statusongoing', [StudentController::class, 'updateStatusongoing'])->name('students.updateStatusongoing');
// Route::post('/update-statusregistered', [StudentController::class, 'updateStatusbackregistered'])->name('students.updateStatusbackregistered');

// Routes for Different Status Views
// Route::get('/certificateLoad', [StudentController::class, 'certificateLoad'])->name('students.certificateLoad');
// Route::get('/ongoingStudentDetails', [StudentController::class, 'ongoingStudentDetails'])->name('students.ongoing');
// Route::get('/certifiedStudentDetails', [StudentController::class, 'certifiedStudentDetails'])->name('students.certified');

// Route::post('/registeredFilterStudents', [DataImportController::class, 'registeredFilterStudents'])->name('registeredFilterStudents');
// Route::post('/ongoingFilterStudents', [DataImportController::class, 'ongoingFilterStudents'])->name('ongoingFilterStudents');
// Route::post('/certifiedFilterStudents', [DataImportController::class, 'certifiedFilterStudents'])->name('certifiedFilterStudents');

// Individual Student Details
Route::get('/studentDetails', [StudentController::class, 'indStudentDetailsex'])->name('students.individual');
Route::get('/students/form', [StudentController::class, 'showForm'])->name('students.form');
Route::get('/student-registration-public', [StudentController::class, 'publicForm'])->name('students.publicForm');
Route::post('/students/update-ids', [StudentController::class, 'updateIds'])->name('students.updateIds');
Route::post('/students/assign-batch', [StudentController::class, 'assignBatch'])
    ->name('students.assignBatch');
Route::post('/students/update-full', [StudentController::class, 'updateFull'])
    ->name('students.updateFull');
