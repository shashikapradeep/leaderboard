<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ApiLeaderUpdateScoreTest extends TestCase
{
    public function test_reset_databases(){
        Init::resetDatabases();
        $this->assertDatabaseCount('leaders', 2);
    }

    public function test_is_json_response_for_valid_request(): void
    {
        $response = $this->get(route('api.leader.update.score', ['id' => 1, 'context' => INCREASE_LEADER_SCORE]));
        $response->assertJsonFragment($response->json());
    }

    public function test_is_json_response_for_invalid_request(): void
    {
        $response = $this->get(route('api.leader.update.score', ['id' => 'hello', 'context' => INCREASE_LEADER_SCORE]));
        $response->assertJsonFragment($response->json());
    }

    public function test_is_200_for_valid_request(): void
    {
        $response = $this->get(route('api.leader.update.score', ['id' => 1, 'context' => DECREASE_LEADER_SCORE]));
        $response->assertStatus(200);
    }

    public function test_is_422_for_invalid_request(): void
    {
        $response = $this->get(route('api.leader.update.score', ['id' => 'red', 'context' => INCREASE_LEADER_SCORE]));
        $response->assertStatus(422);
    }

    public function test_response_is_correct(): void
    {
        $response = $this->get(route('api.leader.update.score', ['id' => 1, 'context' => DECREASE_LEADER_SCORE]));
        $response->assertSee('name');
    }

    public function test_response_is_correct_for_non_existent_id(): void
    {
        $response = $this->get(route('api.leader.update.score', ['id' => 1000, 'context' => INCREASE_LEADER_SCORE]));
        $response->assertDontSee('name');
    }
}
