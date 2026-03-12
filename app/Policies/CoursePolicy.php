<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    /**
     * Autorise à voir la liste des cours (index)
     */
    public function viewAny(User $user): bool
    {
        return true; // Tout le monde peut voir la liste
    }

    /**
     * Autorise à voir un cours précis (show)
     */
    public function view(User $user, Course $course): bool
    {
        return true; // Tout le monde peut lire le contenu d'un cours
    }

    /**
     * Autorise la création (store)
     */
    public function create(User $user): bool
    {
        return $user->isTeacher(); // Seuls les profs créent
    }

    /**
     * Autorise la modification (update)
     */
    public function update(User $user, Course $course): bool
    {
        // On vérifie que c'est un prof ET que c'est SON cours
        return $user->isTeacher() && $user->id === $course->teacher_id;
    }

    /**
     * Autorise la suppression (destroy)
     */
    public function delete(User $user, Course $course): bool
    {
        // Même logique que pour la modification
        return $user->isTeacher() && $user->id === $course->teacher_id;
    }
}
