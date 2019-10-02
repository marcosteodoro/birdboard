@extends('layouts.app')
@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-grey text-sm font-normal">
                <a  class="text-grey text-sm font-normal no-underline" href="/projects">My projects</a> / {{ $project->title }}
            </p>

            <div class="flex items-center">
                @foreach($project->members as $member)
                    <img
                        src="{{ gravatar_url($member->email) }}"
                        alt="{{ $member->name }}'s avatar"
                        class="rounded-full w-8 mr-2">
                @endforeach

                <img
                    src="{{ gravatar_url($project->owner->email) }}"
                    alt="{{ $member->name }}'s avatar"
                    class="rounded-full w-8 mr-2">
                <a href="{{ $project->path() . '/edit'}}" class="button ml-4">Edit Project</a>
            </div>
        </div>

    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-grey font-normal mb-3">Tasks</h2>
                    @foreach($project->tasks as $task)
                        <div class="card mb-3">
                            <form action="{{ $task->path() }}" method="POST">
                                @method('PATCH')
                                @csrf
                                <div class="flex">
                                    <input type="text" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-grey' : '' }}" name="body">
                                    <input type="checkbox" {{ $task->completed ? 'checked' : '' }} name="completed" onchange="this.form.submit()">
                                </div>
                            </form>
                        </div>
                    @endforeach
                    <div class="card mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf
                            <input type="text" placeholder="Add a new task" class="w-full" name="body">
                        </form>
                    </div>
                </div>
                <div>
                    <h2 class="text-lg text-grey font-normal mb-3">General Notes</h2>
                    <form action="{{ $project->path() }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <textarea class="card w-full mb-4" style="min-height: 200px;"placeholder="Anything special hat you want to make a note of?" name="notes">{{ $project->notes }}</textarea>
                        <button type="submit" class="button">Save</button>
                    </form>

                    @if ($errors->any())
                        <div class="field mt-6">
                            @foreach($errors->all() as $error)
                                <li class="text-sm text-red">{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="lg:w-1/4 px-3 lg:py-8">
                @include('projects.card')
                @include('projects.activity.card')
            </div>
        </div>
    </main>
@endsection
