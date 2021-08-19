<div class="container my-4"> <a href="<?= $router->generate('student-list')?>" class="btn btn-success float-right">Retour</a>
        <h2><?= $student->getId() === null ?'Ajouter' : 'Modifier'?> un étudiant</h2>

        <form action="" method="POST" class="mt-5">
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" value="<?= $student->getFirstname()?>">
            </div>
            <div class="form-group">
                <label for="lastname">Nom</label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="" value="<?= $student->getLastname()?>">
            </div>
            <div class="form-group">
                <label for="teacher">Prof</label>
                <select name="teacher" id="teacher" class="form-control">
                    <option value="0">-</option>
                    <?php foreach($teachers as $teacher): ?>
                    <option value="<?= $teacher->getId()?>" selected> <?= $teacher->getFirstname().' '.$teacher->getLastname() .' - '.$teacher->getJob()?></option>
                    <?php endforeach; ?>

                </select>
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <select name="status" id="status" class="form-control">
                    <option value="0">-</option>
                    <option value="1"
                    <?= $student->getStatus() == 1 ? 'selected':''?>
                    >actif</option>
                    <option value="2"
                    <?= $student->getStatus() == 2 ? 'selected':''?>
                    >désactivé</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form>
    </div>