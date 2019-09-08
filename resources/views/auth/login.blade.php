@extends('layouts.app')

@section('content')
    <div class="form-area bg-white rounded-lg p-8 lg:px-20 lg:w-2/3 mx-auto shadow-md">
        <h1 class="font-normal text-center is-1 mb-8">Login</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label class="block mb-2" for="email">{{ __('E-Mail Address') }}</label>
                <div class="mb-8">
                    <input id="email" type="email"
                           class="input shadow appearance-none border rounded w-full py-2 px-3 @error('email') text-red @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <div class="mt-1">
                        <span class="text-red text-xs italic mt-24">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>

            <div class="mb-8">
                <label for="password"
                       class="block mb-2">{{ __('Password') }}</label>
                <div>
                    <input id="password" type="password"
                           class="input shadow appearance-none border rounded w-full py-2 px-3 @error('password') text-red @enderror"
                           name="password" required autocomplete="current-password">
                    @error('password')
                    <div class="mt-1">
                        <span class="text-red text-xs italic mt-24">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>

            <div class="mb-8">
                <input class="mr-2 leading-tight" type="checkbox" name="remember"
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
                    <a class="text-grey align-end" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
@endsection
