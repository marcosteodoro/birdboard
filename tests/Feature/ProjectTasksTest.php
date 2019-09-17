<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_project_can_have_tasks()
    {
//        $this->signIn();
//
//        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', ['body' => 'Test task`']);

        $this->get($project->path())
            ->assertSee('Test task');
    }

    public function test_a_task_can_be_updated()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(),  [
                'body' => 'changed'
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed'
        ]);
    }

    public function test_a_task_can_be_completed()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(),  [
                'body' => 'changed',
                'completed' => true
            ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);
    }

    public function test_a_task_can_be_marked_as_incomplete()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(),  [
                'body' => 'changed',
                'completed' => true
        ]);

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(),  [
                'body' => 'changed',
                'completed' => false
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => false
        ]);
    }

    public function test_only_the_owner_of_a_project_may_add_task()
    {
        $this->signIn();
        $project = factory(Project::class)->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test task`'])
             ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    public function test_only_the_owner_of_a_project_may_update_a_task()
    {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();

        $this->patch($project->tasks->first()->path(), ['body' => 'changed`'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }

    public function test_a_task_requires_a_body()
    {
        $project = ProjectFactory::create();

        $attributes = factory(Task::class)->raw(['body' => '']);

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
