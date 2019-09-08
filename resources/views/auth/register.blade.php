@extends('layouts.app')

@section('content')
    <div class="form-area bg-white rounded-lg p-8 lg:px-20 lg:w-2/3 mx-auto shadow-md">
        <h1 class="font-normal text-center is-1 mb-8">Register</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

{{--            <div>--}}
{{--                <label class="block mb-2" for="email">{{ __('E-Mail Address') }}</label>--}}
{{--                <div class="mb-8">--}}
{{--                    <input id="email" type="email"--}}
{{--                           class="input shadow appearance-none border rounded w-full py-2 px-3 @error('email') text-red @enderror"--}}
{{--                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}
{{--                    @error('email')--}}
{{--                    <div class="mt-1">--}}
{{--                        <span class="text-red text-xs italic mt-24">{{ $message }}</span>--}}
{{--                    </div>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--            </div>--}}

            <div>
                <label for="name" class="block mb-2">{{ __('Name') }}</label>

                <div class="mb-8">
                    <input id="name" type="text"
                           class="input shadow appearance-none border rounded w-full py-2 px-3 @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <div class="mt-1">
                        <span class="text-red text-xs italic mt-24">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>

            <div>
                <label for="email" class="block mb-2">{{ __('E-Mail Address') }}</label>

                <div class="mb-8">
                    <input id="email" type="email"
                           class="input shadow appearance-none border rounded w-full py-2 px-3 @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <div class="mt-1">
                        <span class="text-red text-xs italic mt-24">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password" class="block mb-2">{{ __('Password') }}</label>

                <div class="mb-8">
                    <input id="password" type="password"
                           class="input shadow appearance-none border rounded w-full py-2 px-3 @error('password') is-invalid @enderror"
                           name="password" required autocomplete="new-password">
                    @error('password')
                    <div class="mt-1">
                        <span class="text-red text-xs italic mt-24">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password-confirm" class="block mb-2">{{ __('Confirm Password') }}</label>

                <div class="mb-8">
                    <input id="password-confirm" type="password"
                           class="input shadow appearance-none border rounded w-full py-2 px-3" name="password_confirmation"
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
