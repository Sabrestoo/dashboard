<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     */

    public function a_user_can_create_a_project() {

        $this->withoutExceptionHandling();

        $attributes = Project::factory('App\Projects')->raw();

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /**
     * @test
     */

    public function a_user_can_view_a_project() {

        $this->withoutExceptionHandling();

        $project = Project::factory('App\Projects')->create();

        $this->get($project->path())
        ->assertSee($project->title)
        ->assertSee($project->description);
    }


    /**
     * @test
     */

    public function a_project_requires_a_title() {

        $attributes = Project::factory('App\Projects')->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /**
     * @test
     */

    public function a_project_requires_a_description() {

        $attributes = Project::factory('App\Projects')->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
