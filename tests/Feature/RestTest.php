<?php

namespace Tests\Feature;

use App\Author;
use App\Book;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestTest extends TestCase
{

    public function testsCreateAuthorsAndBooks()
    {
        DB::table('books')->truncate();
        DB::table('authors')->truncate();

        for($i = 1; $i <= 5; $i++){
            // создание автора
            $data = [
                'name' => 'John '.$i,
            ];

            $this->json('POST', '/api/authors', $data)
                ->assertStatus(201);
        }

        for($i = 1; $i <= 20; $i++) {
            // создание книги (название, код, автор)
            $data = [
                'title' => 'Book of the number ' . $i,
                'author_id' => rand(1, 5),
                'status' => Book::STATUS_IS_IN_PLACE,
            ];

            $this->json('POST', '/api/books', $data)
                ->assertStatus(201);
        }
    }

    // изменение статуса книги (выдана, на месте)
    public function testsChangeBookStatus()
    {
        $book = DB::table('books')->first();

        $data = [
            'status' => Book::STATUS_ISSUED,
        ];

        $this->put(route('books.update', $book->id), $data)
            ->assertStatus(200);
    }

    // удаление книги
    public function testsBookDelete()
    {
        $book = DB::table('books')->first();

        $this->json('DELETE', route('books.delete', $book->id))
            ->assertStatus(204);
    }

    //удаление автора и всех его книг
    public function testsAuthorDelete()
    {
        $author = DB::table('authors')->first();

        $this->json('DELETE', route('authors.delete', $author->id))
            ->assertStatus(204);
    }

    //поиск книги по названию
    public function testsSearchBook()
    {
        $bookName = '7';

        var_dump(route('books.search', $bookName));

        $this->json('GET', route('books.search', $bookName))
            ->assertStatus(200);
    }

    //поиск всех книг по автору
    public function testsSearchByAuthor()
    {
        $author = DB::table('authors')->first();

        $this->json('GET', route('books.searchByAuthor', $author->id))
            ->assertStatus(200);
    }
}
