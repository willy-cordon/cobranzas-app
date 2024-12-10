<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Billing;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillingFactory extends Factory
{
    protected $model = Billing::class;

    public function definition(): array
    {
        $totalAmount = $this->faker->randomFloat(2, 100, 5000);
        $paidAmount = $this->faker->randomFloat(2, 0, $totalAmount);
        $remainingBalance = $totalAmount - $paidAmount;

        return [
            'user_id' => User::factory(), // Relaciona con un usuario existente
            'customer_name' => $this->faker->name(),
            'customer_email' => $this->faker->unique()->safeEmail(),
            'company' => $this->faker->company(),
            'invoice_id' => $this->faker->unique()->bothify('INV-#####'),
            'total_amount' => $totalAmount,
            'paid_amount' => $paidAmount,
            'remaining_balance' => $remainingBalance,
            'installments' => $this->faker->numberBetween(1, 12),
            'next_due_date' => $this->faker->optional()->dateTimeBetween('now', '+2 months'),
            'status' => $this->faker->randomElement(['pending', 'paid', 'overdue']),
        ];
    }
}

