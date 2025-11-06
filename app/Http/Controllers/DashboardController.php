<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HR\Employee;
use App\Models\Company;
use App\Models\Ticket;
use App\Models\Inquiry;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $summary = [
            'employees' => Employee::count(),
            'companies' => Company::count(),
            'tickets_open' => Ticket::where('status','open')->count(),
            'tickets_resolved' => Ticket::where('status','resolved')->count(),
            'inquiries' => Inquiry::count(),
        ];
        $recentInquiries = Inquiry::latest()->limit(5)->get(['code','name','status']);
        $recentTickets = Ticket::latest()->limit(5)->get(['code','title','status','priority']);

        // Chart data: companies created per month for last 6 months
        $labels = [];
        $data = [];
        for ($i = 5; $i >= 0; $i--) {
            $start = Carbon::now()->subMonths($i)->startOfMonth();
            $end = (clone $start)->endOfMonth();
            $labels[] = $start->format('M Y');
            $data[] = Company::whereBetween('created_at', [$start, $end])->count();
        }
        $chart = [ 'labels' => $labels, 'data' => $data ];

        return view('dashboard', compact('summary','recentInquiries','recentTickets','chart'));
    }
}
