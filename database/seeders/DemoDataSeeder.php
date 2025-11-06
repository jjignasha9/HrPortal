<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Company;
use App\Models\HR\Employee;
use App\Models\Inquiry;
use App\Models\Quotation;
use App\Models\Receipt;
use App\Models\Voucher;
use App\Models\Project;
use App\Models\Performa;
use App\Models\Invoice;
use App\Models\Ticket;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\Event;
use App\Models\Payroll;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Companies
        foreach ([['CMS-001','Acme Inc'], ['CMS-002','Globex LLC'], ['CMS-003','Innotech Ltd']] as [$code, $name]) {
            Company::updateOrCreate(['code' => $code], [
                'name' => $name,
                'email' => Str::slug($name).'@example.com',
                'phone' => '99999'.rand(10000,99999),
                'city' => 'Metro City',
                'country' => 'India',
            ]);
        }

        // Employees
        foreach ([['EMP-101','John','Doe','john.doe@example.com'], ['EMP-102','Jane','Smith','jane.smith@example.com']] as $e) {
            Employee::updateOrCreate(['code' => $e[0]], [
                'first_name' => $e[1],
                'last_name' => $e[2],
                'email' => $e[3],
                'designation' => 'Developer',
                'salary' => 60000,
            ]);
        }

        // Inquiries
        foreach (range(1,5) as $i) {
            Inquiry::updateOrCreate(['code' => 'INQ-'.str_pad($i,3,'0',STR_PAD_LEFT)], [
                'name' => 'Prospect '.$i,
                'email' => 'prospect'.$i.'@example.com',
                'phone' => '88888'.rand(10000,99999),
                'source' => 'Website',
                'message' => 'Looking for services',
                'status' => $i % 2 ? 'open' : 'closed',
            ]);
        }

        // Quotations
        foreach (range(1,3) as $i) {
            Quotation::updateOrCreate(['code' => 'QTN-'.str_pad($i,3,'0',STR_PAD_LEFT)], [
                'type' => $i % 2 ? 'standard' : 'premium',
                'client_name' => 'Client '.$i,
                'client_email' => 'client'.$i.'@example.com',
                'amount' => 1000 * $i,
                'status' => 'draft',
            ]);
        }

        // Projects
        foreach (range(1,3) as $i) {
            Project::updateOrCreate(['code' => 'PRJ-'.str_pad($i,3,'0',STR_PAD_LEFT)], [
                'name' => 'Project '.$i,
                'company_id' => Company::inRandomOrder()->value('id'),
                'status' => 'active',
                'budget' => 50000 * $i,
                'start_date' => Carbon::now()->subDays(30 * $i),
            ]);
        }

        // Performa & Invoice samples
        $items = [ ['name' => 'Design', 'qty' => 1, 'price' => 1000], ['name' => 'Development', 'qty' => 1, 'price' => 2500] ];
        Performa::updateOrCreate(['number' => 'PF-1001'], [
            'date' => now(), 'client_name' => 'Acme Inc', 'items' => $items, 'subtotal' => 3500, 'tax' => 315, 'total' => 3815
        ]);
        Invoice::updateOrCreate(['number' => 'INV-2001'], [
            'date' => now(), 'client_name' => 'Globex LLC', 'items' => $items, 'subtotal' => 3500, 'tax' => 315, 'total' => 3815
        ]);

        // Receipts & Vouchers
        Receipt::updateOrCreate(['number' => 'RCPT-3001'], [ 'date' => now(), 'payer_name' => 'Globex LLC', 'amount' => 2000, 'mode' => 'NEFT' ]);
        Voucher::updateOrCreate(['number' => 'VCH-4001'], [ 'date' => now(), 'payee_name' => 'John Doe', 'amount' => 1500, 'mode' => 'Cash' ]);

        // Tickets
        foreach (range(1,4) as $i) {
            Ticket::updateOrCreate(['code' => 'TKT-'.str_pad($i,3,'0',STR_PAD_LEFT)], [
                'title' => 'Support ticket '.$i,
                'priority' => ['low','medium','high'][array_rand(['l','m','h'])],
                'status' => $i % 3 ? 'open' : 'resolved',
            ]);
        }

        // Payroll demo rows for first employee
        if ($emp = Employee::first()) {
            $rows = [];
            for ($i=1; $i<=4; $i++) {
                $rows[] = [
                    'employee_id' => $emp->id,
                    'serial_no' => $i,
                    'unique_no' => 'CMS/LEAD/00'.($i+1),
                    'salary_month' => now()->format('M - Y'),
                    'format_type' => 'Salary',
                    'payment_date' => now()->subDays($i*7)->toDateString(),
                    'payment_amount' => 10000*$i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            Payroll::insertOrIgnore($rows);
        }

        // Attendance for last 5 days for first employee
        if ($emp = Employee::first()) {
            foreach (range(0,4) as $d) {
                $date = Carbon::now()->subDays($d)->toDateString();
                Attendance::updateOrCreate(['employee_id' => $emp->id, 'date' => $date], [
                    'check_in' => '09:30:00', 'check_out' => '18:00:00', 'hours' => 8.5, 'status' => 'present'
                ]);
            }
        }

        // Leaves
        if ($emp = Employee::inRandomOrder()->first()) {
            LeaveRequest::updateOrCreate(['employee_id' => $emp->id, 'from_date' => now()->addDays(2)->toDateString()], [
                'to_date' => now()->addDays(3)->toDateString(), 'type' => 'casual', 'status' => 'pending', 'reason' => 'Personal'
            ]);
        }

        // Event sample
        Event::updateOrCreate(['title' => 'Town Hall'], [ 'event_date' => now(), 'description' => 'Quarterly town hall', 'media_paths' => [] ]);
    }
}


