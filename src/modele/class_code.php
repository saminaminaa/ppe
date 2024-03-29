<?php

class Code{    //majuscule importante pour le nom d'une classe
    private $db;      // $db = seules les méthodes de la classe pourront y avoir accès. Cette variable va nous permettre de mémoriser la connexion à la base de données afin que la classe puisse y avoir accès. 
    
    private $insert; // Étape 1 (declaration d1 variable)
    
    private $select;
    
    private $delete;
    
    
    public function __construct($db){ //construct=constructeur de la classe
        $this->db = $db ;    //$this=nous parlons à l'attribut de la classe
        $this->insert = $db->prepare("insert into code(idEmail, idLangage) values (:idEmail, :idLangage)");   // Étape 2 (on met les valeurs qu'on veut insérer)le code est ici en SQL
        $this->select = $db->prepare("select idLangage,l.libelle as langages from code c, langage l where c.idLangage = l.id order by idLangage");   // libelle pr la jointure avc role //as c pr renommé
        $this->delete = $db->prepare("delete from code where idEmail=:idEmail and idLangage=:idLangage"); //supprimer 1angage
        
    }
 public function insert($idEmail, $idLangage){ // Étape 3 
     $r = true;
     $this->insert->execute(array(':idEmail'=>$idEmail, ':idLangage'=>$idLangage));
     if ($this->insert->errorCode()!=0){
         print_r($this->insert->errorInfo());
         $r=false;
         }
         return $r;
         }
         
          
   public function select(){
       $liste = $this->select->execute();
       if ($this->select->errorCode()!=0){
           print_r($this->select->errorInfo());
           }
           return $this->select->fetchAll();   //fetchAll pour obtenir ttes les lignes
           }
                
    public function delete($idEmail, $idLangage){
        $r = true;
        $this->delete->execute(array(':idEmail'=>$idEmail, ':idLangage'=>$idLangage));
        if ($this->delete->errorCode()!=0){
            print_r($this->delete->errorInfo());
            $r=false;
            }
            return $r;
            }
         
             
             
}  

