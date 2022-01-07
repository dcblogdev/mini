<?php
namespace Modules\Contacts\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Contacts\Models\Contact;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
        ];
    }
}

