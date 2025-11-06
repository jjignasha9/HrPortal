<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Models\HR\Employee;
use Yajra\DataTables\DataTables;

class PayrollController extends Controller
{
    public function index(Request $request, Employee $employee)
    {
        if ($request->ajax()) {
            $q = Payroll::query()->where('employee_id', $employee->id)->orderByDesc('payment_date')->orderByDesc('id');
            return DataTables::of($q)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '<button class="text-sky-600 hover:text-sky-800" title="View"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z"/></svg></button>';
                })
                ->editColumn('payment_amount', fn($r) => '₹ '.number_format($r->payment_amount, 0))
                ->make(true);
        }
        abort(404);
    }
}
