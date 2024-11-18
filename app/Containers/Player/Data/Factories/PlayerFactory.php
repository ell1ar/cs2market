<?php

namespace App\Containers\Player\Data\Factories;

use App\Containers\Player\Events\PlayerRegisteredEvent;
use App\Containers\Player\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function configure(): static
    {
        return $this->afterCreating(function (Player $player) {
            event(new PlayerRegisteredEvent($player));
        });
    }

    public function definition()
    {
        $faker = app(\Faker\Generator::class);
        $images = array_map(fn($image) => str_replace(public_path(), '', $image), glob(public_path('img/avatars/*')));

        return [
            'name' => $faker->name(),
            'image' => $images[rand(0, count($images) - 1)],
        ];
    }

    public function zeroBalance()
    {
        return $this->state(function () {
            return [
                'balance' => 0.00,
            ];
        });
    }

    public function rich()
    {
        return $this->state(function () {
            return [
                'balance' => 100.00,
            ];
        });
    }
}
