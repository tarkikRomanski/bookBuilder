<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Book;
use App\User;
use Faker\Generator as Faker;

$factory->define(Book::class, static function (Faker $faker) {
    return [
        'name' => $faker->sentence(4),
        'archived_at' => null,
    ];
});

$factory->state(Book::class, 'archived', static function (Faker $faker) {
    return [
        'archived_at' => $faker->dateTime,
    ];
});

$factory->state(Book::class, 'mixedArchivedUnarchived', static function (Faker $faker) {
    return [
        'archived_at' => $faker->randomElement([ null, $faker->dateTime ]),
    ];
});

$factory->afterCreating(Book::class, static function (Book $book, Faker $faker) {
    $book->users()->save(factory(User::class)->make());
});

$factory->afterCreatingState(Book::class, 'ownBooks', function (Book $book, Faker $faker) {
    $book->users()->save(User::find(1));
});
