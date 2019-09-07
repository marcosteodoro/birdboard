<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Project;

class ManageProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_guests_cannot_manage_project()
    {
        $project = factory(Project::class)->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $response = $this->post('/projects', $attributes);
        $response->assertRedirect(Project::where($attributes)->first()->path());

        $this->assertDatabaseHas('projects', $attributes);
        $this->get('/projects')->assertSee($attributes['title']);
    }

    public function test_a_user_can_view_their_project()
    {
        $this->signIn();
        $this->withoutExceptionHandling();

        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee(str_limit($project->description));
    }

    public function test_an_authenticated_user_cannot_see_the_projects_of_others()
    {
        $this->signIn();
        // $this->withoutExceptionHandling();

        $project = factory(Project::class)->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function test_a_project_requires_a_title()
    {
        $this->signIn();
        $attributes = factory(Project::class)->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $this->signIn();
        $attributes = factory(Project::class)->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
