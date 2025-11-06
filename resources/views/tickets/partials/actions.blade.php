<div class="flex items-center gap-2">
    <button class="btn-assign inline-flex items-center px-2 py-1 rounded-lg border border-sky-200 text-sky-700 hover:bg-sky-50" data-id="{{ $row->id }}">Assign</button>
    <button class="btn-resolve inline-flex items-center px-2 py-1 rounded-lg border border-emerald-200 text-emerald-700 hover:bg-emerald-50" data-id="{{ $row->id }}">Resolve</button>
    <button class="btn-edit inline-flex items-center px-2 py-1 rounded-lg border border-slate-200 hover:bg-slate-50" data-row='@json($row)'>Edit</button>
    <button class="btn-delete inline-flex items-center px-2 py-1 rounded-lg border border-rose-200 text-rose-600 hover:bg-rose-50" data-id="{{ $row->id }}">Delete</button>
</div>

