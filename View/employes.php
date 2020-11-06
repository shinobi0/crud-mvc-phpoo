<?php
require_once 'header.php';

?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="text-center pt-4">Liste des employés</h2>
            <div class="py-3">
                <a href="?op=new" class="btn btn-primary">Ajouter un employé</a>
            </div>
            <table class="table table-bordered table-striped table-responsive-md ">
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Sex</th>
                <th>Service</th>
                <th>Date d'embauche</th>
                <th>Salaire</th>
                <th colspan="2">Actions</th>
            </tr>
            <?php
            // var_dump($donnees);
            foreach($donnees as $employe):
                ?>
                <tr>
                    <td><?=$employe->id_employes ?></td>
                    <td><?=$employe->prenom ?></td>
                    <td><?=$employe->nom ?></td>
                    <td><?=$employe->sexe ?></td>
                    <td><?=$employe->service ?></td>
                    <td><?=$employe->date_embauche ?></td>
                    <td><?=$employe->salaire ?>&euro;</td>
                    <td class="text-center"><a href="?op=edit&id=<?=$employe->id_employes?>"><i class="fas fa-user-edit"></i></a></td>
                    <td class="text-center"><a class="confirm" href="?op=delete&id=<?=$employe->id_employes?>"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
                <?php
            endforeach;
            ?>

            </table>
        </div>
    </div>
</div>














<?php
require_once 'footer.php';
