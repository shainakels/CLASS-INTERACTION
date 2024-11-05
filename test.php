<?php

class Book {
    public $title;
    public $author;
    public $isbn;
    public $isBorrowed;

    public function __construct($title, $author, $isbn) {
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->isBorrowed = false;
    }

    public function displayInfo() {
        $status = $this->isBorrowed ? "Borrowed" : "Available";
        echo "Title: {$this->title} | Author: {$this->author} | ISBN: {$this->isbn} | Status: {$status}<br>";
    }

    public function borrow() {
        if(!$this->isBorrowed) {
            $this->isBorrowed = true;
            echo "The book '{$this->title}' has been borrowed<br>";
        } else {
            echo "The book '{$this->title}' has already been borrowed<br>";
        }
    }

    public function return() {
        if($this->isBorrowed) {
            $this->isBorrowed = false;
            echo "The book '{$this->title}' has been returned<br>";
        } else {
            echo "The book '{$this->title}' was not borrowed<br>";
        }
    }
}

class Library {
    public $books = [];

    public function addBook($book) {
        $this->books[] = $book;
        echo "The book '{$book->title}' has been added to the library<br>";
    }

    public function listBooks() {
        echo "<br>Listing all books in the library:<br>";
        foreach($this->books as $book) {
            $book->displayInfo();
        }
    }

    public function borrowBook($isbn) {
        foreach($this->books as $book) {
            if($book->isbn === $isbn) {
                $book->borrow();
                return;
            }
        }
        echo "Book with ISBN '{$isbn}' not found in the library.<br>";
    }

    public function returnBook($isbn) {
        foreach($this->books as $book) {
            if($book->isbn === $isbn) {
                $book->return();
                return;
            }
        }
        echo "Book with ISBN '{$isbn}' not found in the library.<br>";
    }
}


$book1 = new Book("Little Women", "Louisa May Alcott", "12345");
$book2 = new Book("Percy Jackson", "Rick Riordan", "12346");


$book1->displayInfo();
$book1->borrow();
$book1->displayInfo();
$book1->return();
$book1->displayInfo();


$library = new Library();
$library->addBook($book1);
$library->addBook($book2);
$library->listBooks();

$library->borrowBook("12345");
$library->listBooks();

$library->returnBook("12345");
$library->listBooks();
