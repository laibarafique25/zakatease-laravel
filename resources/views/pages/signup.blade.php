@extends('layouts.app')
@section('content')


<section class="section" id="signup-page">
  <div class="section-header reveal">
    <div class="section-label">Join</div>
    <h2>Create Your Account</h2>
    <p class="section-sub">Register quickly to track donations, campaigns, and support activity.</p>
  </div>
  <div class="section-inner reveal" style="max-width:520px;margin:0 auto;background:var(--card-bg);border:1px solid var(--border);border-radius:24px;padding:2rem;box-shadow:var(--shadow)">
    @if(session('success'))
      <div class="alert success" style="margin-bottom:1rem;padding:1rem;border-radius:14px;background:rgba(36,138,95,0.12);color:#194d2c">{{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div class="alert error" style="margin-bottom:1rem;padding:1rem;border-radius:14px;background:rgba(182,28,28,0.12);color:#7f1d1d">
        <ul style="margin:0;padding-left:1.2rem;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('signup.submit') }}">
      @csrf
      <label> Full Name </label>
      <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name" style="width:100%;padding:14px;border:1px solid var(--border);border-radius:14px;margin-bottom:1rem;font-size:0.95rem">
      <label> Email </label>
      <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" style="width:100%;padding:14px;border:1px solid var(--border);border-radius:14px;margin-bottom:1rem;font-size:0.95rem">
      <label> Password </label>
      <input type="password" name="password" placeholder="••••••••" style="width:100%;padding:14px;border:1px solid var(--border);border-radius:14px;margin-bottom:1rem;font-size:0.95rem">
      <label> Confirm Password </label>
      <input type="password" name="password_confirmation" placeholder="••••••••" style="width:100%;padding:14px;border:1px solid var(--border);border-radius:14px;margin-bottom:1.5rem;font-size:0.95rem">
      <button class="btn-primary" type="submit" style="width:100%;padding:14px 0;font-size:1rem">Sign Up</button>
    </form>

    <p style="margin-top:1rem;text-align:center;color:var(--text-light)">Already have an account? <a href="{{ route('login') }}" style="color:var(--emerald);text-decoration:none">Login</a></p>
  </div>
</section>


@endsection

