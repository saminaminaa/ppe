<?php

class UtilisateurEquipe{

    private $db;

    private $selectByEquipe;

    public function __construct($db){

        $this->db = $db;
        $this->selectByEquipe = $db->prepare("SELECT u.nom as nom , u.prenom as prenom FROM utilisateur u, UtilisateurEquipe e WHERE e.utilisateur_email = u.email AND e.id_equipe = :id");
    }

    public function selectByEquipe($id) {
        $this->selectByEquipe->execute(array(':id' => $id));
        if ($this->selectByEquipe->errorCode() != 0) {
            print_r($this->selectByEquipe->errorInfo());
        }
        return $this->selectByEquipe->fetchAll();
    }
}