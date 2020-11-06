<?php
require_once 'header.php';



?>

<div class="container">
    <div class="row">
        <div class="col py-4">
            <?php
                if(!empty($errors)):
                    ?>
                        <div class="alert alert-danger my-2"><?= implode('<br>',$errors)?></div>
                    <?php


                endif;
            ?>
            <form action="" method="post">
                <div class="form-row">
                    <!-- .form-group*3>label+input.form-control -->
                    <div class="form-group col-2">
                        <label for="sexe">Civilité</label>
                        <select  class="form-control" name="sexe" id="sexe">
                            <option value="m">M</option>
                            <option value="f" <?= (isset($current->sexe) && $current->sexe == 'f') ? 'selected' : '' ?>>Mme</option>
                        </select>
                    </div>
                    <div class="form-group col-5">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" name="nom" id="nom" value="<?= $current->nom ??'' ?>">
                    </div>
                    <div class="form-group col-5">
                        <label for="prenom">Prenom</label>
                        <input type="text" class="form-control" name="prenom" id="prenom" value="<?= $current->prenom ??'' ?>">
                    </div>
                </div>
                <div class="form-row">
                    <!-- .form-group*3>label+input.form-control -->
                    <div class="form-group col-12 col-md-4">
                        <label for="service">Service</label>
                        <input type="text" class="form-control" name="service" id="service" value="<?= $current->service ??'' ?>">
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <label for="date_embauche">Date d'embauche</label>
                        <input type="date" class="form-control" name="date_embauche" id="date_embauche" value="<?= $current->date_embauche ??'' ?>">
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <label for="salaire">Salaire</label>
                        <input type="number" class="form-control" min="0" name="salaire" id="salaire" value="<?= $current->salaire ??'' ?>">
                    </div>
                    
                </div>
                <div class="d-flex justify-content-end">
                        <a href="?op=list" class="btn btn-warning mr-4">Retour</a>
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                </div>
            </form>
        </div>
    </div>
</div>













<?php
require_once 'footer.php';