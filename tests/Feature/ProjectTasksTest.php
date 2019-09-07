<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_project_can_have_tasks()
    {
        $this->signIn();

        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);

        $this->post($project->path() . '/tasks', ['body' => 'Test task`']);

        $this->get($project->path())
            ->assertSee('Test task');
    }

    public function test_only_the_owner_of_a_project_may_add_task()
    {
        $this->signIn();
        $project = factory(Project::class)->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test task`'])
             ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    public function test_a_task_requires_a_body()
    {
        $this->signIn();

        $project = factory(Project::class)->create([
            'owner_id' => auth()->id()
        ]);

        $attributes = factory(Task::class)->raw(['body' => '']);
        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
