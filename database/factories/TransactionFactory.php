<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => date('Y-m-d'),
            'user_id' => 1,
            'reference_number' => 'CHIVES/0001',
            'income' => 1000000,
            'expense' => 0,
            'title' => 'Initial Investment',
            'remarks' => 'Strating balance of the restaurant',
        ];
    }
}
