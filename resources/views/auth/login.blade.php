@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('login') }}">
@csrf
    <div class="details centered">
        <div class="form-group">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>

        <div class="form-group">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
        </div>

        <div class="form-group-inline">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">
                Remember Me
            </label>
        </div>
        <button type="submit" class="btn btn-primary">
            Login
        </button>

        <a class="btn btn-link" href="{{ route('password.request') }}">
            Forgot your password
        </a>
    </div>
</form>

@endsection



@section('styles')
<link href="{{ asset('css/partial/form.css') }}" rel="stylesheet">
@endsection
