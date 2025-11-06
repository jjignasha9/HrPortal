<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $q = Attendance::query();
            return DataTables::of($q)
                ->make(true);
        }
        return view('attendance.index');
    }

    public function export(Request $request)
    {
        return Excel::download(new AttendanceExport, 'attendance.xlsx');
    }

    public function approveLeave(Request $request, LeaveRequest $leave)
    {
        $leave->update(['status' => $request->boolean('approve') ? 'approved' : 'rejected']);
        return response()->json(['message' => 'Leave status updated']);
    }
}
