<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


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
