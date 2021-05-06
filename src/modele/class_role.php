<?php

class Role{
    
    private $db;
    
    
    private $select;

    private $selectTri;
    
    public function __construct($db){
        
        $this->db = $db ;
        $this->select = $db->prepare("select id, libelle from role r order by libelle");

        $this->selectTri = $db->prepare("select r.id, r.libelle, COUNT(u.email) AS NbrUser from role r, utilisateur u where u.idRole = r.id group by r.libelle");
        
    }
    
    public function select(){
       $this->select->execute();
       if ($this->select->errorCode()!=0){
           print_r($this->select->errorInfo());
           }
           return $this->select->fetchAll();      
         
     }

     public function selectTri(){
        $this->selectTri->execute();
        if ($this->selectTri->errorCode()!=0){
            print_r($this->selectTri->errorInfo());
            }
            return $this->selectTri->fetchAll();      
          
      }


}