<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        @vite(['resources/css/app.css'])
        <title>Voucher {{ $voucher->number }}</title>
        <style>@media print{ .no-print{ display:none } }</style>
    </head>
    <body class="bg-slate-50 p-6">
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow ring-1 ring-slate-200 p-6">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-xl font-bold">Payment Voucher</div>
                    <div class="text-slate-500">#{{ $voucher->number }}</div>
                </div>
                <div class="text-right">
                    <div class="font-semibold">Date</div>
                    <div>{{ \Carbon\Carbon::parse($voucher->date)->format('d M, Y') }}</div>
                </div>
            </div>
            <div class="mt-6 grid grid-cols-2 gap-4">
                <div>
                    <div class="font-semibold">Payee</div>
                    <div>{{ $voucher->payee_name }}</div>
                </div>
                <div class="text-right">
                    <div class="font-semibold">Amount</div>
                    <div class="text-2xl font-bold">{{ number_format($voucher->amount,2) }}</div>
                </div>
            </div>
            <div class="mt-4 text-sm text-slate-600">Mode: {{ $voucher->mode }} | Ref: {{ $voucher->reference }}</div>
            <div class="mt-2 text-sm">{{ $voucher->notes }}</div>
            <div class="no-print mt-6 flex justify-end"><button onclick="window.print()" class="px-4 py-2 rounded-xl border border-slate-200">Print</button></div>
        </div>
    </body>
</html>


