<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ProjectTest extends TestCase
{

    use RefreshDatabase, WithFaker;
    /**
     * @test
     */

     public function it_has_a_path() {

        $project = Project::factory('App\Project')->create();

        $this->assertEquals('/projects/' . $project->id, $project->path());
     }
}
