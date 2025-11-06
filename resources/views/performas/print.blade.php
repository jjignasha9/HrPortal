<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        @vite(['resources/css/app.css'])
        <title>Performa {{ $performa->number }}</title>
        <style>
            @media print { .no-print { display:none } }
        </style>
    </head>
    <body class="bg-slate-50 p-6">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow ring-1 ring-slate-200 p-6">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-xl font-bold">Performa Invoice</div>
                    <div class="text-slate-500">#{{ $performa->number }}</div>
                </div>
                <div class="text-right">
                    <div class="font-semibold">Date</div>
                    <div>{{ $performa->date->format('d M, Y') }}</div>
                </div>
            </div>
            <div class="mt-6 grid grid-cols-2 gap-4">
                <div>
                    <div class="font-semibold">Bill To</div>
                    <div>{{ $performa->client_name }}</div>
                    <div class="text-slate-600 text-sm">{{ $performa->client_email }}</div>
                    <div class="text-slate-600 text-sm">{{ $performa->client_phone }}</div>
                    <div class="text-slate-600 text-sm">{{ $performa->client_address }}</div>
                </div>
            </div>
            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="bg-slate-100 text-slate-700">
                            <th class="text-left px-3 py-2">Item</th>
                            <th class="text-right px-3 py-2">Qty</th>
                            <th class="text-right px-3 py-2">Price</th>
                            <th class="text-right px-3 py-2">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($performa->items as $it)
                            <tr class="border-t">
                                <td class="px-3 py-2">{{ $it['name'] ?? '' }}</td>
                                <td class="px-3 py-2 text-right">{{ $it['qty'] ?? 1 }}</td>
                                <td class="px-3 py-2 text-right">{{ number_format($it['price'] ?? 0,2) }}</td>
                                <td class="px-3 py-2 text-right">{{ number_format(($it['qty'] ?? 1) * ($it['price'] ?? 0),2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6 flex justify-end">
                <div class="w-64">
                    <div class="flex justify-between py-1"><span class="text-slate-600">Subtotal</span><span>{{ number_format($performa->subtotal,2) }}</span></div>
                    <div class="flex justify-between py-1"><span class="text-slate-600">Tax</span><span>{{ number_format($performa->tax,2) }}</span></div>
                    <div class="flex justify-between py-2 border-t mt-2 font-semibold"><span>Total</span><span>{{ number_format($performa->total,2) }}</span></div>
                </div>
            </div>
            <div class="no-print mt-6 flex justify-end">
                <button onclick="window.print()" class="px-4 py-2 rounded-xl border border-slate-200">Print</button>
            </div>
        </div>
    </body>
 </html>


