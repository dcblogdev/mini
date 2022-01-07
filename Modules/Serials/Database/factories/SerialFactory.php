<?php
namespace Modules\Serials\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Serials\Models\Serial;

class SerialFactory extends Factory
{
    protected $model = Serial::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'serial' => Str::random(32),
            'notes' => $this->faker->sentence(),
        ];
    }
}