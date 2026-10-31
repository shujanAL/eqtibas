<?php
namespace Database\Factories; use App\Models\Quote; use App\Models\User; use Illuminate\Database\Eloquent\Factories\Factory;
class QuoteFactory extends Factory { protected $model=Quote::class; public function definition(){return ['user_id'=>User::factory(),'content'=>$this->faker->sentence(10)];} }
