<?php declare(strict_types=1);

namespace App\Faker;

use Faker\Provider\Lorem;

class PostFaker
{
    private Lorem $fakerFactory;

    public function __construct(Lorem $fakerFactory)
    {
        $this->fakerFactory = $fakerFactory;
    }

    public function generateText(): string
    {
        return $this->fakerFactory->sentence();
    }
}