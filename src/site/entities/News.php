<?php

namespace cotcotfarm\site\entities;

class News{

    private string $title;
    private string $content;
    private string $author;
    private string $publishedDate;
    private int $id;

    public function __construct($id, $title, $content = "" , $author, $publishedDate = ""){
            
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $date = $publishedDate ?? new \DateTime();
        if($date instanceof \DateTime){
            $this->publishedDate = $date->format("Y-m-d");
        }
        else{
            $this->publishedDate = $date;
        }
    }

    public function insert(\PDO $pdo) : void
    {
        $stmt = $pdo->prepare('INSERT INTO news (title, content, author, publishedDate) VALUES (:title, :content, :author, :publishedDate)');
        $stmt->execute([
            ':title' => $this->getTitle(),
            ':content' => $this->getContent(),
            ':author' => $this->getAuthor(),
            ':publishedDate' => $this->getPublishedDate()
        ]);
    }

    /**
     * @return News
     */
    public function searchWithCriteria(\PDO $pdo) : News
    {
        $stmt = $pdo->prepare('SELECT id,title,content,author,publishedDate FROM news WHERE title = :title');
        $stmt->execute([
            ':title' => $this->getTitle(),
        ]);
        $rslt = $stmt->fetchAll();
        if(count($rslt) == 0){
            throw new \Exception("Aucune news trouvée");
        }
        else{
            return new News($rslt[0]['id'],$rslt[0]['title'], $rslt[0]['content'], $rslt[0]['author'], $rslt[0]['publisheddate']);
        }
    }

    /**
     * @return array<News>
     */
    public static function getSeveralNews(\PDO $pdo, int $nbrNewsToGet) : array
    { 
        $stmt = $pdo->prepare('SELECT id,title,content,author,publishedDate FROM news ORDER BY publishedDate DESC LIMIT :nbrNewsToGet');
        $stmt->execute([
            ':nbrNewsToGet' => $nbrNewsToGet,
        ]);
        $rslt = $stmt->fetchAll();
        $news = [];
        foreach($rslt as $row){
            $news[] = new News($row['id'],$row['title'], $row['content'], $row['author'], $row['publisheddate']);
        }
        return $news;
    }

    /**
     * @return News
     */
    public function searchWithId(\PDO $pdo) : News
    {
        $stmt = $pdo->prepare('SELECT id,title,content,author,publishedDate FROM news WHERE id = :id');
        $stmt->execute([
            ':id' => $this->getId(),
        ]);
        $rslt = $stmt->fetchAll();
        if(count($rslt) == 0){
            throw new \Exception("Aucune news trouvée");
        }
        else{
            return new News($rslt[0]['id'],$rslt[0]['title'], $rslt[0]['content'], $rslt[0]['author'], $rslt[0]['publisheddate']);
        }
    }

    public function delete(\PDO $pdo) : void
    {
        $stmt = $pdo->prepare('DELETE FROM news WHERE id = :id');
        $stmt->execute([
            ':id' => $this->getId(),
        ]);
        if($stmt->rowCount() == 0){
            throw new \Exception("aucune news ne correspond à ce titre");
        }
    }

    public function update(\PDO $pdo) : void
    {
        $stmt = $pdo->prepare('UPDATE news SET title = :title, content = :content, author = :author, publishedDate = :publishedDate WHERE id = :id');
        $stmt->execute([
            ':title' => $this->getTitle(),
            ':content' => $this->getContent(),
            ':author' => $this->getAuthor(),
            ':publishedDate' => $this->getPublishedDate(),
            ':id' => $this->getId(),
        ]);
        if($stmt->rowCount() == 0){
            throw new \Exception("aucune news ne correspond à ce titre");
        }
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent() : string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getPublishedDate() : string
    {
        return $this->publishedDate;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    public function setContent(string $content) : void
    {
        $this->content = $content;
    }
   
    public function setAuthor(string $author) : void
    {
        $this->author = $author;
    }

    public function setPublishedDate(string $publishedDate) : void
    {
        $this->publishedDate = $publishedDate;
    }
}