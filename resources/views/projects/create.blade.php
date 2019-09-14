@extends('layouts.app')

@section('content')
<div class="form-area">
    <form
        method="POST"
        action="/projects">

        @csrf

        <h1 class="heading is-1">Let's start something new</h1>

        @include('projects._form', [
            'project' => new App\Project,
            'buttonText' => 'Create Project'
         ])
    </form>
</div>
@endsection

