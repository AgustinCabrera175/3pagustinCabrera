<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Assist;
use App\Models\Student;
use Database\Factories\StudentFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assist>
 */
class AssistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return ['students_id'=> function () {
            $student = Student::inRandomOrder()->first();
            return $student ? $student->id : null;
        }
        ];
    }
}
