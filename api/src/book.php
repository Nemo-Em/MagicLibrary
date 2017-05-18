<?php
class Book {
private $id;
private $title;
private $author;
private $description;

  public function __construct(){
    $this->id=-1;
    $this->title="";
    $this->author="";
    $this->description = "";
  }
  public function getID(){
    return $this->id;
  }
  public function setID($id){
    if (is_integer($id) && $id>=0){
      $this->id=$id;
    }
  }
  public function getTitle(){
    return $this->title;
  }
  public function setTitle($title){
    if (is_string($title)){
      $this->title=$title;
    }
  }
  public function getAuthor(){
    return $this->author;
  }
  public function setAuthor($author){
    if (is_string($author)){
      $this->author=$author;
    }
  }
  public function getDescription(){
    return $this->description;
  }
  public function setDescription($descr){
    if (is_string($descr)){
      $this->description=$descr;
    }
  }

  public function saveToDB(mysqli $conn){
    if($this->id== -1) {
      $sql = 'INSERT INTO Books (title, author, description) VALUES'
            . '("'.$this->title.'","'.$this->author.'","'.$this->description.'")';
      $result = $conn->query($sql);
      if ($result == true) {
        $this->id = $conn->insert_id;
        return true;
      }
      if ($result == false){
        echo "could not add book" . $conn->error;
        return false;
      }
    }
    else{
      $sql = 'UPDATE Books SET '
      .'title = "'.$this->title.'", '
      .'author = "'.$this->author.'", '
      .'description = "'.$this->description.'" '
      .'WHERE id = '.$this->id;
      $result=$conn->query($sql);
      if ($result == true){
        return true;
      }
      if ($result == false){
        echo "could not make changes to book" . $conn->error;
        return false;
      }
    }
    return false;
  }

  public function deleteBook(mysqli $conn){
    if ($this->id !=-1){
      $sql = "DELETE FROM Books where id = $this->id";
      $result=$conn->query($sql);
      if ($result==true){
        $this->id =-1;
        return true;
      }
      else{
        return false;
      }
    }
  return true;
  }
  static public function loadBookByID(mysqli $conn, $id){
    $sql = "SELECT * FROM Books WHERE id=$id";
    $result = $conn->query($sql);
    if($result==true && $result->num_rows ==1){
      $row = $result->fetch_assoc();
      $loadedBook = new Book;
      $loadedBook->id = $row['id'];
      $loadedBook->title = $row['title'];
      $loadedBook->author = $row['author'];
      $loadedBook->description = $row['description'];

      return $loadedBook;
    }
    echo "no such book";
    return null;
  }
  static public function loadAllBooks(mysqli $conn){
    $sql = "SELECT * FROM Books ORDER BY id";
    $bookTable = array();
    $result=$conn->query($sql);
    if ($result == true && $result->num_rows>0){
      foreach ($result as $row){
        $loadedBook = new Book;
        $loadedBook->id = $row['id'];
        $loadedBook->title = $row['title'];
        $loadedBook->author = $row['author'];
        $loadedBook->description = $row['description'];
        $bookTable[] = $loadedBook;
      }
    }
    return $bookTable;
  }
}
