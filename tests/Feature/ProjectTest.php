<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Project;

class ProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_guests_cannot_create_a_project()
    {
        $attributes = factory(Project::class)->raw();

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    public function test_guests_may_not_view_projects()
    {
        $this->get('/projects')->assertRedirect('login');
    }

    public function test_guests_cannot_see_a_single_project()
    {
        $project = factory(Project::class)->create();
        $this->get($project->path())->assertRedirect('login');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create());
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');
        $this->assertDatabaseHas('projects', $attributes);
        $this->get('/projects')->assertSee($attributes['title']);
    }

    public function test_a_user_can_view_their_project()
    {
        $this->be(factory(User::class)->create());
        $this->withoutExceptionHandling();

        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function test_an_authenticated_user_cannot_see_the_projects_of_others()
    {
        $this->be(factory(User::class)->create());
        // $this->withoutExceptionHandling();

        $project = factory(Project::class)->create();
        
        $this->get($project->path())->assertStatus(403);
    }

    public function test_a_project_requires_a_title()
    {
        $this->actingAs(factory(User::class)->create());
        $attributes = factory(Project::class)->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $this->actingAs(factory(User::class)->create());
        $attributes = factory(Project::class)->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
