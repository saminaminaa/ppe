<?php

class Utilisateur {    //majuscule importante pour le nom d'une classe

    private $db;      // $db = seules les méthodes de la classe pourront y avoir accès. Cette variable va nous permettre de mémoriser la connexion à la base de données afin que la classe puisse y avoir accès. 
    private $insert; // Étape 1 (declaration d1 variable)
    private $connect;
    private $select;
    private $selectByEmail;
    private $updateValider;
    private $updateDate;
    private $update;
    private $updateMdp;
    private $delete;

    public function __construct($db) { //construct=constructeur de la classe
        $this->db = $db;    //$this=nous parlons à l'attribut de la classe
        $this->insert = $db->prepare("insert into utilisateur(email, mdp, nom, prenom, idRole,valider, idUnique, date, photo) values (:email, :mdp, :nom, :prenom, :role, :valider, :idUnique, :date, :photo)");   // Étape 2 (on met les valeurs qu'on veut insérer)le code est ici en SQL
        $this->connect = $db->prepare("select email, idRole, mdp, valider from utilisateur where email=:email");
        $this->select = $db->prepare("select email, idRole, nom, prenom, date, photo, r.libelle as libellerole from utilisateur u, role r where u.idRole = r.id order by nom");   // libelle pr la jointure avc role //as c pr renommé
        $this->selectByEmail = $db->prepare("select email, nom, prenom, valider, idUnique,date, r.libelle as libellerole from role r, utilisateur u where email=:email and r.id=u.idRole"); // attention chaque requete est independante donc mm si elle a été renommé avant elle n'est pas renommé pr la requete suivante
        $this->updateValider = $db->prepare("update utilisateur set valider=1 where email=:email");
        $this->updateDate = $db->prepare("update utilisateur set date=:date where email=:email");
        $this->update = $db->prepare("update utilisateur set nom=:nom, prenom=:prenom, idRole=:role where email=:email");
        $this->updateMdp = $db->prepare("update utilisateur set mdp=:mdp where email=:email");
        $this->delete = $db->prepare("delete from utilisateur where email=:email");
    }

    public function insert($email, $mdp, $role, $nom, $prenom, $valider, $unique, $date, $photo) { // Étape 3 
        $r = true;
        $this->insert->execute(array(':email' => $email, ':mdp' => $mdp, ':role' => $role, ':nom' => $nom, ':prenom' => $prenom, ':valider' => $valider, ':idUnique' => $unique, ':date' => $date, ':photo'=>$photo));
        if ($this->insert->errorCode() != 0) {
            print_r($this->insert->errorInfo());
            $r = false;
        }
        return $r;
    }

    public function connect($email) {
        $this->connect->execute(array(':email' => $email));
        if ($this->connect->errorCode() != 0) {
            print_r($this->connect->errorInfo());
        }
        return $this->connect->fetch();
    }

    public function select() {
        $liste = $this->select->execute();
        if ($this->select->errorCode() != 0) {
            print_r($this->select->errorInfo());
        }
        return $this->select->fetchAll();   //fetchAll pour obtenir ttes les lignes
    }

    public function selectByEmail($email) {
        $this->selectByEmail->execute(array(':email' => $email));
        if ($this->selectByEmail->errorCode() != 0) {
            print_r($this->selectByEmail->errorInfo());
        }
        return $this->selectByEmail->fetch();
    }

    public function updateValider($email) {
        $r = true;
        $this->updateValider->execute(array(':email' => $email));
        if ($this->updateValider->errorCode() != 0) {
            print_r($this->updateValider->errorInfo());
            $r = false;
        }
        return $r;
    }
    
    
    public function updateDate($email, $date) {
        $r = true;
        $this->updateDate->execute(array(':email' => $email, ':date' => $date));
        if ($this->updateDate->errorCode() != 0) {
            print_r($this->updateDate->errorInfo());
            $r = false;
        }
        return $r;
    }
    
     public function update($email, $role, $nom, $prenom){
        $r = true;
        $this->update->execute(array(':email'=>$email, ':role'=>$role, ':nom'=>$nom, ':prenom'=>$prenom));
        if ($this->update->errorCode()!=0){
            print_r($this->update->errorInfo());
            $r=false;
            }
            return $r;
            }
       
    public function updateMdp($email, $mdp){
        $r = true;
        $this->updateMdp->execute(array(':email'=>$email, ':mdp'=>$mdp));
        if ($this->updateMdp->errorCode()!=0){
            print_r($this->updateMdp->errorInfo());
            $r=false;
            }
            return $r;
            }
            
            public function delete($email) {
                $r = true;
                $this->delete->execute(array(':email' => $email));
                if ($this->delete->errorCode() != 0) {
                    print_r($this->delete->errorInfo());
                    $r = false;
                }
                return $r;
            }     

}
