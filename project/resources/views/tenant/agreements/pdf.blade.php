<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Agreement PDF</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 12px; color: #111; }
        h1 { font-size: 20px; margin-bottom: 10px; }
        .meta { margin-bottom: 15px; }
        .box { border: 1px solid #ddd; padding: 12px; border-radius: 6px; }
        .muted { color: #666; }
        .row { display: flex; gap: 20px; }
        .row .col { flex: 1; }
    </style>
    </head>
<body>
    <h1>{{ $agreement->title }}</h1>
    <div class="meta muted">
        <div class="row">
            <div class="col">Tenant: {{ $agreement->tenant->name ?? 'N/A' }}</div>
            <div class="col">Admin: {{ $agreement->admin->name ?? 'N/A' }}</div>
            <div class="col">Created: {{ $agreement->created_at->format('M d, Y') }}</div>
        </div>
        <div>Status: {{ ucfirst($agreement->status) }}</div>
    </div>
    <div class="box">
        {!! nl2br(e($agreement->content)) !!}
    </div>
</body>
</html>


