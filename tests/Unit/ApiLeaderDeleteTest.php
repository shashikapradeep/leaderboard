<?php

namespace Tests\Unit;

use Tests\TestCase;

class ApiLeaderDeleteTest extends TestCase
{

    public function test_is_json_response_for_valid_request(): void
    {
        $response = $this->get(route('api.leader.delete', ['id' => 1]));
        $response->assertJsonFragment($response->json());
    }

    public function test_is_json_response_for_invalid_request(): void
    {
        $response = $this->get(route('api.leader.delete', ['id' => 'red']));
        $response->assertJsonFragment($response->json());
    }

    public function test_is_200_for_valid_request(): void
    {
        $response = $this->get(route('api.leader.delete', ['id' => 1]));
        $response->assertStatus(200);
    }

    public function test_is_422_for_invalid_request(): void
    {
        $response = $this->get(route('api.leader.delete', ['id' => 'red']));
        $response->assertStatus(422);
    }

    public function test_response_is_correct(): void
    {
        $response = $this->get(route('api.leader.delete', ['id' => 1]));
        $response->assertSee('name');
    }

    public function test_response_is_correct_for_non_existent_id(): void
    {
        $response = $this->get(route('api.leader.delete', ['id' => 1000]));
        $response->assertDontSee('name');
    }
}
