<?php
require("../../conf/config.php");
require("book.php");
  if ($_SERVER['REQUEST_METHOD']=="POST"){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $descr = $_POST['descr'];
    $book = new Book;
    $book->setTitle($title);
    $book->setAuthor($author);
    $book->setDescription($descr);
    $book->saveToDB($conn);
    return null;
  }

  if($_SERVER['REQUEST_METHOD'] == 'PUT'){
  parse_str(file_get_contents("php://input"), $put_vars);
  $id = intval($put_vars['id']);
  $title = $put_vars['title'];
  $author = $put_vars['author'];
  $descr = $put_vars['descr'];
  $book = new Book;
  $book->setID($id);
  $book->setTitle($title);
  $book->setAuthor($author);
  $book->setDescription($descr);
  $book->saveToDB($conn);
  return null;
  }

  if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
  parse_str(file_get_contents("php://input"), $del_vars);
  $id = $del_vars['id'];
  $sql = "DELETE FROM Books WHERE id=$id";
  $conn->query($sql);
  return null;
  }

  if(isset($_GET['id'])){
    $book = Book::loadBookByID($conn, intval($_GET['id']));
    $bookDetails = ["id" => $book->getID(),
                    "title" => $book->getTitle(),
                    "author" => $book->getAuthor(),
                    "description" => $book->getDescription()
                   ];
    $bookJSON = json_encode($bookDetails);
    header('Content-type: application/json');
    echo $bookJSON;
  }
  else{

  $allBooks = Book::loadAllBooks($conn);
  $bookTable =[];
  foreach ($allBooks as $key=>$value){
    $bookTable[] = ["id" => $value->getID(),
                    "title" => $value->getTitle(),
                    "author" => $value->getAuthor(),
                    "description" => $value->getDescription()
                   ];
  }
  $booksJSON = json_encode($bookTable);
  header('Content-type: application/json');
  echo $booksJSON;
}
