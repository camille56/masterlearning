<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\School;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $school = School::create([
            'name' => 'Lycée Saint-Exupéry',
            'address' => '12 rue de la Paix, Paris'
        ]);

        $classroom = Classroom::create([
            'name' => 'Terminale Générale A',
            'school_id' => $school->id
        ]);

        User::create([
            'name' => 'M. Dupont',
            'email' => 'dupont@ecole.fr',
            'role' => 'Professeur',
            'password' =>\Illuminate\Support\Facades\Hash::make('password123'),
            'classroom_id' => $classroom->id
        ]);

        User::create([
            'name' => 'Alice Martin',
            'email' => 'alice@etudiant.fr',
            'role' => 'Etudiant',
            'password' =>\Illuminate\Support\Facades\Hash::make('password123'),
            'classroom_id' => $classroom->id
        ]);

        $subject = Subject::create([
            'name' => 'Informatique'
        ]);

        Course::create([
            'title' => 'Introduction aux API REST',
            'content' => 'Dans ce cours, nous allons apprendre Laravel...',
            'subject_id' => $subject->id
        ]);
    }
}
