<?php

namespace Tests\Feature;

use App\Models\CartItem;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function test_user_has_customer(): void
    {
        $user = User::factory()->create();
        Customer::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Customer::class, $user->customer);

        $this->assertEquals(1, $user->customer->count());
    }

    public function test_customer_has_address(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create(['user_id' => $user->id]);
        $country = Country::factory()->create();
        CustomerAddress::factory()->create(['customer_id' => $customer->id, 'country_code' => $country->code]);

        $this->assertInstanceOf(CustomerAddress::class, $customer->address);

        $this->assertEquals(1, $customer->address->count());
    }

}
