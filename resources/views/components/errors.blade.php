@if ($errors->any())
  <div role="alert" aria-live="assertive" style="background:#fef2f2;color:#991b1b;padding:8px 12px;border-radius:6px;margin-bottom:12px;">
    <ul style="margin:0;padding-left:18px;">
      @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif
