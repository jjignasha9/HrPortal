<div class="flex items-center gap-2">
    <button class="btn-edit inline-flex items-center px-2 py-1 rounded-lg border border-slate-200 hover:bg-slate-50"
        data-row='@json($row)'>Edit</button>
    <button class="btn-delete inline-flex items-center px-2 py-1 rounded-lg border border-rose-200 text-rose-600 hover:bg-rose-50"
        data-id="{{ $row->id }}">Delete</button>
</div>

