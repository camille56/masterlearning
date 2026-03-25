<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('register', [AuthController::class, 'create'])->name('register');
Route::post('register', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/login', function () {
    return "<h1>Blog</h1>";
})->name('blog');


Route::apiResource('schools', SchoolController::class);
Route::apiResource('classrooms', ClassroomController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('subjects', SubjectController::class);
Route::apiResource('courses', CourseController::class);


//Les classes appartenant à une école spécifique
Route::get('schools/{school}/classes', [SchoolController::class, 'getClasses']);

//Les élèves appartenant à une classe spécifique.
Route::get('classes/{schoolclasses}/students', [ClassroomController::class, 'getStudents']);

//Les cours d'une matière spécifique.
Route::get('subjects/{subject}/courses', [SubjectController::class, 'getCourses']);

Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');
