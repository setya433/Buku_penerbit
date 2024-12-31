<?php

namespace Database\Factories;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Support\Facades\Storage;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author_id' => Author::inRandomOrder()->first()->id,
            'publisher_id' => Publisher::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'cover_image' => $this->saveCoverImage(),
        ];
    }

    public function saveCoverImage(){
        $image = $this->faker->image(storage_path('app/public/cover'), 400, 300, null, false);

        if (!Storage::exists('public/cover/' . basename($image))) {
            throw new \Exception('Image file does not exist after moving.');
        }

        $imagepath = 'cover/'.basename($image);

        Storage::move('public/cover/' . basename($image), 'public/' . $imagepath);

        return $imagepath;
    }
}
