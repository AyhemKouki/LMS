<?php

namespace App\Http\Controllers\Admin\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Lesson;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('users.admin.dashboard.index');
    }

    public function users()
    {
        $users = User::paginate(5);
        return view('users.admin.dashboard.allUsers' , compact('users'));
    }

    public function students()
    {
        $students = User::where('role', 'student')->paginate(5);
        return view('users.admin.dashboard.students' , compact('students'));
    }

    public function instructors()
    {
        $instructors = User::where('role', 'instructor')->paginate(5);
        return view('users.admin.dashboard.instructors' , compact('instructors'));

    }

    public function destroy(User $user)
    {
        Storage::delete($user->profile_image);
        $role = $user->role;
        if ($role == 'student') {
            $user->delete();
            flash()->options(['position'=>'bottom-right'])->success('Student Deleted Successfully');
            return redirect()->route('admin.student.index');
        }
        else{
            Lesson::where('user_id', $user->id)->delete();
            Course::where('user_id', $user->id)->delete();
            $user->delete();
            flash()->options(['position' => 'bottom-right'])->success('Instructor Deleted Successfully');
            return redirect()->route('admin.instructor.index');
        }


    }
}
