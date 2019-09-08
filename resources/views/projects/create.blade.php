@extends('layouts.app')

@section('content')
    <div class="form-area">
        <form action="/projects" method="POST">
            @csrf
            <h1 class="heading is-1">Create a Project</h1>
            <div class="field">
                <label class="label" for="title">Title</label>
                <input type="text" class="input @error('title') is-invalid @enderror" name="title" placeholder="Title" value="{{ old('title') }}">
                @error('title')
                <div class="mt-1">
                    <span class="input-error">{{ $message }}</span>
                </div>
                @enderror
            </div>

            <div class="field">
                <label class="label" for="description">Description</label>
                <textarea name="description" class="input textarea @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                <div class="mt-1">
                    <span class="input-error">{{ $message }}</span>
                </div>
                @enderror
            </div>

            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-link">Create Project</button>
                    <a href="/projects">Cancel</a>
                </div>
            </div>

        </form>
    </div>
@endsection

