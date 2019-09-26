<?php
    spl_autoload_register(function ($class_name) {
        include 'classes/' . $class_name . '.php';
    });
    $characters = new Character();

    // ADD
    if (isset($_POST['submit'])) {
        $characters->insert(
            $_POST['name'],
            $_POST['class'],
            $_POST['mana'],
            $_POST['hp'],
            $_POST['weapon']
        );
    }

    // DELETE
    if (isset($_POST['delete'])) {
        $characters->delete(
            $_POST['id']
        );
    }
    if (isset($_POST['edit'])) {
        $edit = $characters->selectId(
            $_POST['id']
        );
        
    }
    if (isset($_POST['validEdit'])) {
        $characters->update(
            $_POST['id'],
            $_POST['name'],
            $_POST['class'],
            $_POST['mana'],
            $_POST['hp'],
            $_POST['weapon']
        );
        
    }

    
    
        
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./public/style.css">
    <title>LOL</title>
</head>
<body>
    <!-- LISTE DES HEROS -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="jumbotron">
                    <?php
                    $object = new Database;
                    $object->connect();
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Héro</th>
                                <th scope="col">Rôle</th>
                                <th scope="col">Arme</th>
                                <th scope="col">Vie</th>
                                <th scope="col">Mana</th>
                                <th>Mettre à jour</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $rows = $characters->select();
                                foreach ($rows as $row) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $row['id'] ?></th>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['class'] ?></td>
                                        <td><?php echo $row['weapon'] ?></td>
                                        <td><?php echo $row['hp'] ?></td>
                                        <td><?php echo $row['mana'] ?></td>
                                        <form method="POST" action="update.php">
                                            <input type="hidden" name="id" value="<?php echo $row['id']?>">
                                            <td><input name="edit" type="submit" class="edit btn btn-sm btn-primary" value="Editer"></td>
                                        </form>
                                        <form method="POST" action="./">
                                            <input type="hidden" name="id" value="<?php echo $row['id']?> ">
                                            <td><input name="delete" type="submit" class="btn btn-sm btn-danger" value="X"></td>
                                        </form>
                                    </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        

        <!-- AJOUTER UN HEROS -->                           
        <div class="col-lg-12">
            <div class="jumbotron">
                <h4 class="mb-4">Ajouter un nouvel héros...</h4>
                <form method="POST" action="./">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Héro</label>
                        <input type="text" name="name" class="form-control" placeholder="Nom du Héro...">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Rôle</label>
                        <select name="class" class="form-control">
                            <?php
                           
                                foreach ($rows as $row) {  ?>
                                    <option value="<?php echo $row['class_id'] ?>" selected><?php echo $row['class'] ?></option>
                                <?php } ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>HP</label>
                        <input type="number" name="hp" class="form-control" placeholder="Points de vie...">
                        </div>
                    
                        <div class="form-group col-md-6">
                        <label>Mana</label>
                        <input type="number" name="mana" class="form-control" placeholder="Points de magie...">
                        </div>

                        <label>Equipement</label>
                        <select name="weapon" class="form-control">
                            <?php
                                foreach ($rows as $row) { ?>
                                    <option value="<?php echo $row['weapon_id'] ?>" selected><?php echo $row['weapon'] ?></option>
                                <?php } ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="./public/main.js"></script>
</html>
