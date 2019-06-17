<?php

namespace Tests\Feature;

use App\Book;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Tests\TestCase;

class BooksTest extends TestCase
{
    use DatabaseMigrations;

    /** @var User */
    private $user;

    /**
     * Processes before the tests run
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = \factory(User::class)->create();
    }

    /**
     * @group books
     */
    public function testCanCreateABook(): void
    {
        $token = \auth()->login($this->user);
        $book = \factory(Book::class)->make();

        $response = $this->json(
            'POST',
            'api/books',
            [
                'name' => $book->name,
            ],
            [
                'Authorization' => "Bearer {$token}",
            ]
        );

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'book' => [
                    'id',
                    'name',
                    'authors',
                    'chapters',
                    'archived',
                ]
            ]);

        $this->assertDatabaseHas('books', [
            'name' => $book->name,
        ]);
    }

    /**
     * @group books
     */
    public function testCantCreateTheBookForUnauthorizedUsers(): void
    {
        $book = \factory(Book::class)->make();

        $response = $this->json(
            'POST',
            'api/books',
            [
                'name' => $book->name,
            ]
        );

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $this->assertDatabaseMissing('books', [
            'name' => $book->name,
        ]);
    }

    /**
     * @group books
     */
    public function testValidationOfRequiredNameField(): void
    {
        $token = \auth()->login($this->user);

        $response = $this->json(
            'POST',
            'api/books',
            [
                'name' => '',
            ],
            [
                'Authorization' => "Bearer {$token}",
            ]
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors('name')
            ->assertJsonFragment(['The name field is required.']);
    }

    /**
     * @group books
     */
    public function testShowTheBook(): void
    {
        $token = \auth()->login($this->user);
        $book = \factory(Book::class)->create();

        $response = $this->json(
            'GET',
            "api/books/{$book->id}",
            [],
            [
                'Authorization' => "Bearer {$token}",
            ]
        );

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                'name' => $book->name,
            ])
            ->assertJsonStructure([
                'book' => [
                    'name',
                    'id',
                    'authors',
                    'chapters',
                    'archived',
                ],
            ]);
    }

    /**
     * @group books
     */
    public function testNotShowTheBookForUnauthorizedUsers(): void
    {
        $book = \factory(Book::class)->create();

        $response = $this->json(
            'GET',
            "api/books/{$book->id}"
        );

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @group books
     */
    public function testCanShowListOfUnarchivedBooks(): void
    {
        $token = \auth()->login($this->user);

        try {
            $unarchivedBooksQuantity = \random_int(2, 10);
        } catch (\Exception $e) {
            $unarchivedBooksQuantity = 5;
        }

        \factory(Book::class, $unarchivedBooksQuantity)->state('ownBooks')->create();
        \factory(Book::class, 50)->states(['archived', 'ownBooks'])->create();

        $response = $this->json(
            'GET',
            'api/books',
            [],
            [
                'Authorization' => "Bearer {$token}",
            ]
        );

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data',
                'pagination' => $this->getPaginationStructure(),
            ])
            ->assertJsonCount($unarchivedBooksQuantity, 'data');
    }

    /**
     * @group books
     */
    public function testCanShowListOfArchivedBooks(): void
    {
        $token = \auth()->login($this->user);

        try {
            $archivedBooksQuantity = \random_int(2, 10);
        } catch (\Exception $e) {
            $archivedBooksQuantity = 5;
        }

        \factory(Book::class, 50)->state('ownBooks')->create();
        \factory(Book::class, $archivedBooksQuantity)->states(['archived', 'ownBooks'])->create();

        $response = $this->json(
            'GET',
            'api/books',
            [
                'archived' => 1,
            ],
            [
                'Authorization' => "Bearer {$token}",
            ]
        );

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data',
                'pagination' => $this->getPaginationStructure(),
            ])
            ->assertJsonCount($archivedBooksQuantity, 'data');
    }

    /**
     * @group books
     */
    public function testCanUpdateABook(): void
    {
        $token = \auth()->login($this->user);
        $book = \factory(Book::class)->create();
        $updatedName = 'New book name';

        $response = $this->json(
            'PUT',
            "api/books/{$book->id}",
            [
                'name' => $updatedName,
            ],
            [
                'Authorization' => "Bearer {$token}",
            ]
        );

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('books', [
            'name' => $updatedName,
        ])->assertDatabaseMissing('books', [
            'name' => $book->name,
        ]);
    }

    /**
     * @group books
     */
    public function testCanDeleteABook(): void
    {
        $token = \auth()->login($this->user);
        $book = \factory(Book::class)->create();

        $response = $this->json(
            'DELETE',
            "api/books/{$book->id}",
            [],
            [
                'Authorization' => "Bearer {$token}",
            ]
        );

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseMissing('books', [
            'name' => $book->name,
        ]);
    }

    /**
     * @group books
     */
    public function testCanArchivedABook(): void
    {
        $token = \auth()->login($this->user);
        /** @var Book $book */
        $book = \factory(Book::class)->create();

        $response = $this->json(
            'PUT',
            "api/books/{$book->id}/archive",
            [],
            [
                'Authorization' => "Bearer {$token}",
            ]
        );

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['book' => [
                'name',
                'id',
                'authors',
                'chapters',
                'archived',
            ]]);

        $updatedBook = Book::find($book->id);
        $this->assertNotNull($updatedBook->archived_at);
    }

    /**
     * @group books
     */
    public function testCanUnarchivedABook(): void
    {
        $token = \auth()->login($this->user);
        /** @var Book $book */
        $book = \factory(Book::class)->state('archived')->create();

        $response = $this->json(
            'PUT',
            "api/books/{$book->id}/unarchive",
            [],
            [
                'Authorization' => "Bearer {$token}",
            ]
        );

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['book' => [
                'name',
                'id',
                'authors',
                'chapters',
                'archived',
            ]]);

        $updatedBook = Book::find($book->id);
        $this->assertNull($updatedBook->archived_at);
    }
}
