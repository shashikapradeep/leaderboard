<?php

namespace Tests\Unit;

use Tests\TestCase;

class ApiLeaderOneTest extends TestCase
{
    public function test_is_json_response_for_valid_request(): void
    {
        $response = $this->get(route('api.leader.one', ['id' => 1]));
        $response->assertJsonFragment($response->json());
    }

    public function test_is_json_response_for_invalid_request(): void
    {
        $response = $this->get(route('api.leader.one', ['id' => 'red']));
        $response->assertJsonFragment($response->json());
    }

    public function is_200_for_valid_request(): void
    {
        $response = $this->get(route('api.leader.one', ['id' => 1]));
        $response->assertStatus(200);
    }

    public function is_200_for_invalid_request(): void
    {
        $response = $this->get(route('api.leader.one', ['id' => 'red']));
        $response->assertStatus(200);
    }
}
