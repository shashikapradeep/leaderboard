<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ApiLeaderUpdateTest extends TestCase
{
    public function test_reset_databases(){
        Init::resetDatabases();
        $this->assertDatabaseCount('leaders', 2);
    }

    public function test_is_json_response_for_valid_request(): void
    {
        $response = $this->put(route('api.leader.update', ['id' => 1]),[
            'name' => 'Martin',
            'age' => 20,
            'points' => 50,
            'address' => 'Canada'
        ]);
        $response->assertJsonFragment($response->json());
    }

    public function test_is_422_response_for_invalid_age_request(): void
    {
        $response = $this->put(route('api.leader.update', ['id' => 1]),[
            'name' => 'Martin',
            'age' => 'Hello',
            'points' => 50,
            'address' => 'Canada'
        ]);
        $response->assertStatus(422);
    }

    public function test_is_422_response_for_invalid_points_request(): void
    {
        $response = $this->put(route('api.leader.update', ['id' => 1]),[
            'name' => 'Martin',
            'age' => 30,
            'points' => 'no',
            'address' => 'Canada'
        ]);
        $response->assertStatus(422);
    }

    public function test_is_422_response_for_invalid_minus_points_request(): void
    {
        $response = $this->put(route('api.leader.update', ['id' => 1]),[
            'name' => 'Martin',
            'age' => 30,
            'points' => -4,
            'address' => 'Canada'
        ]);
        $response->assertStatus(422);
    }

    public function test_is_422_response_for_invalid_max_age_request(): void
    {
        $response = $this->put(route('api.leader.update', ['id' => 1]),[
            'name' => 'Martin',
            'age' => 130,
            'points' => 4,
            'address' => 'Canada'
        ]);
        $response->assertStatus(422);
    }

    public function test_is_200_for_valid_request(): void
    {
        $response = $this->put(route('api.leader.update', ['id' => 1]),[
            'name' => 'Martin',
            'age' => 20,
            'points' => 50,
            'address' => 'Canada'
        ]);
        $response->assertStatus(200);
    }

    public function test_response_is_correct_for_valid_request(): void
    {
        $response = $this->put(route('api.leader.update', ['id' => 1]),[
            'name' => 'Martin',
            'age' => 20,
            'points' => 50,
            'address' => 'Canada'
        ]);
        $response->assertSee('name');
    }
}
