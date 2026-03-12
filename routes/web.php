<?php

use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::apiResource('schools', SchoolController::class);
Route::apiResource('classrooms', ClasseroomController::class);
Route::apiResource('users', StudentController::class);
Route::apiResource('subjects', SubjectController::class);
Route::apiResource('courses', CourseController::class);


// Les classes appartenant à une école spécifique
Route::get('schools/{school}/classes', [SchoolController::class, 'getClasses']);

// Les élèves appartenant à une classe spécifique
Route::get('classes/{schoolclasses}/students', [ClasseController::class, 'getStudents']);

// Les cours (leçons/vidéos) d'une matière spécifique
Route::get('subjects/{subject}/courses', [SubjectController::class, 'getCourses']);
