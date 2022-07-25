<?php

namespace cotcotfarm\controller;
use cotcotfarm\entities\News;

class NewsController
{

    private $pdo;
    private $message;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insertNews(News $news) : void
    {
        try{
            $news->insert($this->pdo);
            $this->message = "News ajoutée avec succès";
        }
        catch(\PDOException $e){
            throw new \PDOException($e->getMessage());//"Erreur lors de l'insertion de la news");
        }
    }

    /**
     * @return News
     */
    public function searchNews(News $news) : News
    {
        try{
            if($news->getid() !=0){
                return $news->searchWithId($this->pdo);
            }
            else{
                return $news->searchWithCriteria($this->pdo);
            }
            
        }
        catch(\PDOException $e){
            throw new \PDOException("Erreur lors de la recherche de la news");
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @return array<News>
     */
    public function getSeveralNews(int $nbrNewsToGet) : array
    {
        try{
            $news = News::getSeveralNews($this->pdo, $nbrNewsToGet);
            if(count($news) == 0){
                $this->message = "Aucune news trouvée";
            }
            return $news;
        }
        catch(\PDOException $e){
            throw new \PDOException("Erreur lors de la récupération des news");
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteNews(News $news) : void
    {
        try{
            $foundNews = $this->searchNews($news);
            $foundNews->delete($this->pdo);
            $this->message = "News supprimée avec succès";
        }
        catch(\PDOException $e){
            throw new \PDOException("Erreur lors de la suppression de la news");
        }
        catch(\Error $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function updateNews(News $news,array $newData = null) : void
    {
        try{
            $foundNews = $this->searchNews($news);
            if($newData != null){
                $foundNews = $this->updateInfoNews($foundNews,$newData);
            }
            $foundNews->update($this->pdo);
            $this->message = "News modifiée avec succès";
        }
        catch(\PDOException $e){
            throw new \PDOException("Erreur lors de la modification de la news");
        }
        catch(\Error $e){
            throw new \Exception($e->getMessage());
        }
        catch(\Exception $e){
            throw new \Exception("La news à mettre à jour n'a pas été trouvée");
        }
    }

    /**
     * @return News
     */
    private function updateInfoNews(News $news, array $newdata) : News
    {
        if(isset($newdata['title'])){
            $news->setTitle($newdata['title']);
        }
        if(isset($newdata['content'])){
            $news->setContent($newdata['content']);
        }
        if(isset($newdata['author'])){
            $news->setAuthor($newdata['author']);
        }
        if(isset($newdata['publishedDate'])){
            $news->setPublishedDate($newdata['publishedDate']);
        }
        return $news;

    }
    
    /**
     * @return string
     */
    public function getMessage() : string
    {
        return $this->message;
    }
}