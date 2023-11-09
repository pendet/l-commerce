<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerAddress>
 */
class CustomerAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => 'shipping',
            'address1' => fake('id_ID')->streetAddress(),
            'address2' => fake('id_ID')->streetAddress(),
            'city' => fake('id_ID')->city(),
            'state' => fake('id_ID')->state(),
            'zipcode' => '17147',
            'country_code' => fake()->countryISOAlpha3(),
            'customer_id' => Customer::factory(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
