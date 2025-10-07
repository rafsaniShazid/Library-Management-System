@if (session('status'))
  <div role="status" aria-live="polite" style="background:#ecfdf5;color:#065f46;padding:8px 12px;border-radius:6px;margin-bottom:12px;">
    {{ session('status') }}
  </div>
@endif
