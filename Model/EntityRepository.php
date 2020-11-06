<?php

namespace Model;

use PDO, PDOException, Exception; // je déclare que je vais avoir besoin de la classe PDO de l'espace global de PHP

class EntityRepository {

    private $db;
    private $table;
    // nom de la colonne qui contient l'identifiant
    private $idColumnName;

    public function getDb()
    {
        // On rentre ici une seule fois : le tout premier appel à getDb() // alternative au Singleton
        if (!$this->db) {
            // si db n'est pas défini,il faut réaliser la connexion 
            try {
                $xml = simplexml_load_file('App/config.xml');
                $this->table = $xml->table;
                try {
                    $this->db = new PDO(
                        'mysql:host=' . $xml->host . ';dbname=' . $xml->dbname,
                        $xml->user,
                        $xml->password,
                        array(
                            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                        )
                    );
                } catch (PDOException $e) {
                    die('Problème connexion BDD');
                }
            } catch (Exception $e) {
                die('Problème : fichier xml manquant');
            }
        }
        return $this->db;
    }

    //Méthodes du CRUD
    public function selectAll()
    {
        $query = $this->getDb()->query("SELECT * FROM " . $this->table);
        $result = $query->fetchAll();
        return $result;
    }
    
    public function select($id)
    {
        $query = $this->getDb()->prepare("SELECT * FROM " . $this->table. " WHERE " . $this->getIdColumnNAme(). "=:id");
        $query->execute(array(
            ':id'   => $id // dans l'execute, les : sont facultatifs
        ));
        $result =$query->fetch();
        return $result;
    }


    public function delete($id){
        $query = $this->getDb()->prepare("DELETE FROM " . $this->table. " WHERE " . $this->getIdColumnNAme(). "=:id");
        return $query->execute(array(
            ':id'   => $id // dans l'execute, les : sont facultatifs
        ));
    }


    public function insert($infos){
        $liste_colonnes =  implode(',',array_keys($infos)); //array_keys méthode pour récupérer les index du tableau et les transforme en tableau
        $liste_marqueurs =  implode(',:',array_keys($infos));

        $query = $this->getDb()->prepare("INSERT INTO " . $this->table ." ($liste_colonnes) VALUES (:$liste_marqueurs) ");
        if($query->execute($infos)){
            return $this->getDb()->lastInsertId(); 
        }else{
            return false;
        }
    }


    public function update($id, $infos){
        $setListe = array();
        foreach(array_keys($infos) as $key){
            $setListe[] = "$key = :$key";

        }
        
        $newValue = implode(',',$setListe);
        $query = $this->getDb()->prepare("UPDATE " . $this->table . " SET $newValue WHERE ".$this->getIdColumnNAme()."=:id");
        $infos['id'] = $id;
       
        return $query->execute($infos);
       

    }


    public function getIdColumnNAme(){
        $query = $this->getDb()->query("DESC " . $this->table);
        $result = $query->fetch();
        $this->idColumnName = $result->Field; //Filed ici c'est un chanps dans la base de données 
        return $this->idColumnName;
    }




}
