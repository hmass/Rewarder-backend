<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use  App\Models\User;

/**
 * Tetsing for customer endpoints
 */
class CustomerTest extends TestCase
{

    /**
     * The test that tries to create a customer without an authentication token.
     * It will act as if a user who is not logged in tries to create a Customer. For this test to pass, 
     * the test must return a 401 Unauthenticated HTTP code and will not create a new customer
     *
     * @return void
     */
    public function test_Create_Customer_WithMiddleware()
    {
                $data = [
                        'name' => "New Customer",
                        'name' => "Hezron",
                        'customer_id' => "9",
                        'order_value' => 6000
                      ];

            $response = $this->json('POST', '/api/customers',$data);
            $response->assertStatus(401);
            $response->assertJson(['message' => "Unauthenticated."]);
    }


     /**
     * The test that tries to create a customer with an authentication token.
     * It will act as if a user who is not logged in tries to create a Customer. For this test to pass, 
     * the test must return a 200 Ok HTTP code and will not create a new customer
     *
     * @return void
     */

    public function test_Create_Customer()
    {
        $data = [
            'name' => "New Customer",
            'name' => "Hezron",
            'customer_id' => "9",
            'order_value' => 6000
          ];

            $user = factory(User::class)->create();
            $response = $this->actingAs($user, 'api')->json('POST', '/api/customers',$data);
            $response->assertStatus(200);
            $response->assertJson(['message' => "Customer created successfully."]);
            $response->assertJson(['data' => $data]);
      }

    
}
