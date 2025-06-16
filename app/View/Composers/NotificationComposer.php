<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\InstructorRequest;

class NotificationComposer
{
    public function compose(View $view)
    {
        // Récupérer le nombre de demandes en attente
        $pendingInstructorRequests = InstructorRequest::where('status', 'pending')->count();

        // Récupérer les 5 dernières demandes pour les notifications
        $recentInstructorRequests = InstructorRequest::with('user')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        $view->with([
            'pendingInstructorRequests' => $pendingInstructorRequests,
            'recentInstructorRequests' => $recentInstructorRequests
        ]);
    }
}
