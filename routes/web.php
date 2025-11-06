<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HR\HiringLeadController;
use App\Http\Controllers\HR\EmployeeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PerformaController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PayrollController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // HR
    Route::resource('leads', HiringLeadController::class);
    Route::resource('employees', EmployeeController::class);

    // Inquiries & Quotations
    Route::resource('inquiries', InquiryController::class);
    Route::match(['get','post'], 'inquiries/{inquiry}/followups', [InquiryController::class, 'followups'])->name('inquiries.followups');
    Route::resource('quotations', QuotationController::class);
    Route::match(['get','post'], 'quotations/{quotation}/followups', [QuotationController::class, 'followups'])->name('quotations.followups');

    // Company & Projects
    Route::resource('companies', CompanyController::class);
    Route::resource('projects', ProjectController::class);

    // Performa / Invoice / Receipts / Vouchers
    Route::resource('performas', PerformaController::class);
    Route::get('performas/{performa}/print', [PerformaController::class, 'print'])->name('performas.print');
    Route::resource('invoices', InvoiceController::class);
    Route::get('invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print');
    Route::resource('receipts', ReceiptController::class);
    Route::get('receipts/{receipt}/print', [ReceiptController::class, 'print'])->name('receipts.print');
    Route::resource('vouchers', VoucherController::class);
    Route::get('vouchers/{voucher}/print', [VoucherController::class, 'print'])->name('vouchers.print');

    // Tickets
    Route::resource('tickets', TicketController::class);
    Route::post('tickets/{ticket}/assign', [TicketController::class, 'assign'])->name('tickets.assign');
    Route::post('tickets/{ticket}/resolve', [TicketController::class, 'resolve'])->name('tickets.resolve');

    // Attendance & Leaves
    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('attendance/export', [AttendanceController::class, 'export'])->name('attendance.export');
    Route::post('attendance/leave/{leave}', [AttendanceController::class, 'approveLeave'])->name('attendance.leave.approve');

    // Events
    Route::resource('events', EventController::class);

    // Roles & Settings (restricted)
    Route::resource('roles', RoleController::class)->middleware('role:Super_Admin');
    Route::resource('settings', SettingController::class)->only(['index','update'])->middleware('role:Super_Admin');

    // Payroll (profile tab usage)
    Route::get('employees/{employee}/payrolls', [PayrollController::class, 'index'])->name('employees.payrolls.index');
});

require __DIR__.'/auth.php';
