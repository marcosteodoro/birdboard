@extends('layouts.app')

@section('content')
    <div class="form-area">
        <h1 class="heading">Login</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label class="label" for="email">{{ __('E-Mail Address') }}</label>
                <div class="field">
                    <input id="email" type="email" class="input @error('email') text-error @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <div class="mt-1">
                        <span class="input-error">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>

            <div class="field">
                <label for="password"
                       class="label">{{ __('Password') }}</label>
                <div>
                    <input id="password" type="password" class="input @error('password') text-error @enderror"
                           name="password" required autocomplete="current-password">
                    @error('password')
                    <div class="mt-1">
                        <span class="input-error">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>

            <div class="field">
                <input class="input checkbox" type="checkbox" name="remember"
                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            <div>
                <button type="submit" class="button">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="text-default align-end" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
@endsection
