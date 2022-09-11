<?php

namespace cotcotfarm\jeu\controller;
use cotcotfarm\jeu\entities\Player;

class playerController
{
    private $pdo;
    private $message;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insertPlayer(Player $player) : void
    {
        try{
            $player->insert($this->pdo);
            $this->message = "Player ajouté avec succès";
        }
        catch(\PDOException $e){
            throw new \PDOException($e->getMessage());//"Erreur lors de l'insertion du joueur");
        }
    }

    /**
     * @return Player
     */
    public function searchPlayer(Player $player) : Player
    {
        try{
            if($player->getid() !=0){
                return $player->searchWithId($this->pdo);
            }
            else{
                return $player->searchWithCriteria($this->pdo);
            }
            
        }
        catch(\PDOException $e){
            throw new \PDOException("Erreur lors de la recherche du joueur");
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function UpdatePlayer(Player $player) : void
    {
        try{
            $player->update($this->pdo);
            $this->message = "Player mis à jour avec succès";
        }
        catch(\PDOException $e){
            throw new \PDOException($e->getMessage());//"Erreur lors de la mise à jour du joueur");
        }
    }
}