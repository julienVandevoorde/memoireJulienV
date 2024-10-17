<?php

namespace App\Http\Controllers;

use App\Models\TattooReport;
use App\Models\UserReport;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Récupérer tous les signalements de tatouages et d'utilisateurs
        $tattooReports = TattooReport::with(['portfolio', 'user'])->get();
        $userReports = UserReport::with('reportedUser')->get();

        return view('admin.reports.index', compact('tattooReports', 'userReports'));
    }

    public function showTattooReport(TattooReport $tattooReport)
    {
        return view('admin.reports.show_tattoo', compact('tattooReport'));
    }

    public function showUserReport(UserReport $userReport)
    {
        return view('admin.reports.show_user', compact('userReport'));
    }
}
