<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Project;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;


    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'introduction' => $this->faker->sentence(10),
            'body' => $this->faker->paragraph(5),
            'url' => $this->faker->url,
            'github' => $this->faker->url,
            'user_id' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
