<?php

namespace App\Http\Controllers;

use App\Models\InstructorRequest;
use App\Models\Admin;
use App\Mail\InstructorRequestNotification;
use App\Mail\InstructorRequestStatusNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



class InstructorRequestController extends Controller
{

    public function create()
    {
        // Vérifier si l'utilisateur a déjà fait une demande
        if (auth()->user()->instructorRequest) {
            flash()->options(["position"=>"bottom-right"])->info('your last request was reject by an admin');
            return view('instructor-requests.create');
        }
        else{
            return view('instructor-requests.create');
        }


    }

    public function store(Request $request)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $cvPath = $request->file('cv')->store('instructor-cvs', 'public');

        $instructorRequest = InstructorRequest::create([
            'user_id' => auth()->id(),
            'cv_file' => $cvPath,
        ]);

        // Envoyer notification aux admins
        $this->notifyAdmins($instructorRequest);

        flash()->options(["position" => "bottom-right"])->success( 'Your instructor request has been submitted successfully !');

        return redirect()->route('dashboard');
    }

    public function index()
    {
        $requests = InstructorRequest::with(['user', 'reviewer'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.instructor-requests.index', compact('requests'));
    }

    public function show(InstructorRequest $instructorRequest)
    {
        // Vérifier que les relations existent avant de les charger
        $relations = ['user'];

        // Seulement charger 'reviewer' si la relation existe et qu'il y a un reviewer
        if ($instructorRequest->reviewer_id) {
            $relations[] = 'reviewer';
        }

        $instructorRequest->load($relations);
        return view('admin.instructor-requests.show', compact('instructorRequest'));
    }

    public function updateStatus(Request $request, InstructorRequest $instructorRequest)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'admin_notes' => 'nullable|string'
        ]);

        $instructorRequest->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'reviewed_at' => now(),
            'reviewed_by' => auth()->guard('admin')->id()
        ]);

        // Si approuvé, changer le rôle de l'utilisateur
        if ($request->status === 'approved') {
            $instructorRequest->user->syncRoles(['instructor']);
            $instructorRequest->user->role = 'instructor';
            $instructorRequest->user->save();
        }

        // Notifier l'utilisateur
        Mail::to($instructorRequest->user->email)
            ->queue(new InstructorRequestStatusNotification($instructorRequest));

        flash()->options(["position" => "bottom-right"])->success( 'Request status updated successfully !');

        return redirect()->route('admin.instructor-requests.index');
    }

    private function notifyAdmins(InstructorRequest $instructorRequest)
    {
        $admins = Admin::all(); // Récupérer tous les admins de la table admins

        foreach ($admins as $admin) {
            Mail::to($admin->email)
                ->queue(new InstructorRequestNotification($instructorRequest));
        }
    }
}
