@extends('layouts.app')

@section('content')
    <div class="form-area">
        <h1 class="heading">Register</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

           <div>
                <label for="name" class="block mb-2">{{ __('Name') }}</label>

                <div class="field">
                    <input id="name" type="text" class="input @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <div class="mt-1">
                        <span class="input-error">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>

            <div>
                <label for="email" class="block mb-2">{{ __('E-Mail Address') }}</label>

                <div class="field">
                    <input id="email" type="email" class="input @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                    <div class="mt-1">
                        <span class="input-error">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password" class="block mb-2">{{ __('Password') }}</label>

                <div class="field">
                    <input id="password" type="password"
                           class="input @error('password') is-invalid @enderror"
                           name="password" required autocomplete="new-password">
                    @error('password')
                    <div class="mt-1">
                        <span class="input-error">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password-confirm" class="block mb-2">{{ __('Confirm Password') }}</label>

                <div class="field">
                    <input id="password-confirm" type="password"
                           class="input" name="password_confirmation"
                           required autocomplete="new-password">
                </div>
            </div>

            <div>
                <div class="">
                    <button type="submit" class="button">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
