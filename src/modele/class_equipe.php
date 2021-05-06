<?php

class Equipe{

    private $db;

    private $insert;

    private $select;

    private $selectById;

    public function __construct($db){

        $this->db = $db;
        $this->insert = $db->prepare("insert into equipe(libelle) values (:libelle)");
        $this->select = $db->prepare("select id, libelle from equipe order by libelle");
        $this->selectByEmail = $db->prepare("select id, libelle from equipe where id = :id");
    }

    public function insert($libelle){
        $r = true;
        $this->insert->execute(array(':libelle'=>$libelle));
        if ($this->insert->errorCode()!=0){
            print_r($this->insert->errorInfo());
            $r=false;
        }
        return $r;
    }

    public function select(){
        $this->select->execute();
        if ($this->select->errorCode()!=0){
            print_r($this->select->errorInfo());
            }
        return $this->select->fetchAll();     
    }

    public function selectById($id) {
        $this->selectById->execute(array(':id' => $id));
        if ($this->selectById->errorCode() != 0) {
            print_r($this->selectById->errorInfo());
        }
        return $this->selectById->fetch();
    }
}
