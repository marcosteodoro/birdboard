
<div class="field">
    <label class="label" for="title">Title</label>
    <input type="text"
           class="input @error('title') is-invalid @enderror"
           name="title"
           placeholder="My next awesome project"
           value="{{ $project->title }}">
    @error('title')
    <div class="mt-1">
        <span class="input-error">{{ $message }}</span>
    </div>
    @enderror
</div>

<div class="field">
    <label class="label" for="description">Description</label>
    <textarea
        name="description"
        class="input textarea @error('description') is-invalid @enderror"
        placeholder="Description of project">{{ $project->description }}</textarea>
    @error('description')
    <div class="mt-1">
        <span class="input-error">{{ $message }}</span>
    </div>
    @enderror
</div>

<div class="field">
    <div class="control">
        <button type="submit" class="button is-link">{{ $buttonText }}</button>
        <a href="{{ $project->path() }}">Cancel</a>
    </div>
</div>
