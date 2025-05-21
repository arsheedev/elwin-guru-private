<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Load users who are students or teachers
        $users = User::whereIn('role', ['student', 'teacher'])->with(['student', 'teacher'])->get();

        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        if ($user->role === 'student') {
            $user->student()->delete(); // delete from students table
        }

        if ($user->role === 'teacher') {
            $user->teacher()->delete(); // delete from teachers table
        }

        $user->delete(); // delete user itself

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}

