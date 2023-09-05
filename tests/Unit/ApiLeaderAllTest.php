<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ApiLeaderAllTest extends TestCase
{
    public function test_reset_databases(){
        Init::resetDatabases();
        $this->assertDatabaseCount('leaders', 2);
    }

    public function test_is_json_response_for_valid_request(): void
    {
        $response = $this->get(route('api.leader.all', ['id', 'asc']));
        $response->assertJsonFragment($response->json());
    }

    public function test_is_json_response_for_invalid_request(): void
    {
        $response = $this->get(route('api.leader.all', ['ids', 'ascs']));
        $response->assertJsonFragment($response->json());
    }

    public function test_is_200_for_valid_request(): void
    {
        $response = $this->get(route('api.leader.all', ['id', 'asc']));
        $response->assertStatus(200);
    }

    public function test_is_422_for_invalid_request(): void
    {
        $response = $this->get(route('api.leader.all', ['id', 'ascx']));
        $response->assertStatus(422);
    }

    public function test_response_is_correct(): void
    {
        $response = $this->get(route('api.leader.all', ['id', 'asc']));
        $response->assertSee('name');
    }

    public function test_response_is_correct_for_non_existent_id(): void
    {
        $response = $this->get(route('api.leader.all', ['id', 'ascs']));
        $response->assertDontSee('name');
    }
}
