@extends('layouts.app')

@section('content')
    <div class="form-area">
        <form
            method="POST"
            action="{{ $project->path() }}">

            @csrf
            @method('PATCH')

            <h1 class="heading is-1">Edit Your Project</h1>

            @include('projects._form', [
                'buttonText' => 'Update Project'
            ])
        </form>
    </div>
@endsection

