<?php
namespace Controller;

class Controller{

    private $db;

    public function __construct(){
        
        $this->db = new \Model\EntityRepository;
    }

    public function redirect($location){
        header('location:' . $location);
        exit();
    }
    
    // la méthode pour lancer l'application
    public function run(){
         //  la condition en  forme ternaire
        // $op = (isset($_GET['op'])) ? $_GET['op'] : 'list';

        $op = $_GET['op'] ?? 'list'; // si existe op dans $GET si non j'affiche  'list'
        switch($op){
            case 'list' : $this->listALL();
        break;
            case 'new' :
            case 'edit':
                 $this->register();
        break;
            case'delete' :$this->delete();
        break;
        }

    }

    public function listAll(){
        $donnees = $this->db->selectAll();
        $title  = '|Liste'; //pour afficher " liste " dans le title en haut du navigateur
        require('View/employes.php');
    }


    public function register(){
        // on va gérer insertion et modification d'un employé

        // si je suis en modif, je dois charger les information de l'employé
        if ($_GET['op'] == 'edit' && !empty($_GET['id']) && is_numeric($_GET['id'])) {
            // modification
            $current = $this->db->select($_GET['id']);
        }

        if (!empty($_POST)) {

            $current = (object)$_POST; // current :enregistrement courant  // transformation du tableu post en objet
            var_dump($_POST);
            // traite les infos du formulaire dans le but d'appeler l'insertion en BDD
            // controles
            $errors = array();
            $champs_vides = 0;
                foreach ($_POST as $key => $value) {
                    $_POST[$key] = htmlspecialchars($value);
                    if (trim($_POST[$key]) == '') $champs_vides++;
                    // j'incremente mon compteur de champs vides chaque fois que je detecte un champ non rempli                
                }
                    if ($champs_vides > 0) {
                        $errors[] = 'Il manque ' . $champs_vides . ' information(s)';
                    }
            // autres controles

            if (empty($errors)) {
                // Cas d'ajout d'un employé
                if ($_GET['op'] == 'new') {
                    // insertion
                    $this->db->insert($_POST);
                }
                // Cas de modif d'un employé existant
                if ($_GET['op'] == 'edit' && !empty($_GET['id']) && is_numeric($_GET['id'])) {
                    // modification
                    $this->db->update($_GET['id'], $_POST);
                }
                $this->redirect('?op=list');
            }
        }          
        require('View/formulaire.php');
    }

    public function delete(){
        // ex : ?op=delete$id=
        // id existe et n'est pas vide, et est de nature numérique 
        if(!empty($_GET['id']) && is_numeric($_GET['id'])){
        $donnees =$this->db->delete($_GET['id']);
        }

        $this->redirect('?op=list');
        
    }
  
}