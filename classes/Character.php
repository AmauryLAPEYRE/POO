<?php 

class Character extends Database
{
    public function select()
    {
        $sql = "SELECT characters.id, characters.name ,characters.hp, characters.mana, classes.id class_id, classes.name class, weapons.id weapon_id, weapons.name weapon
                FROM characters
                INNER JOIN classes
                ON characters.id = classes.id
                INNER JOIN weapons
                ON characters.id = weapons.id";
        $result =  $this->connect()->query($sql);
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }

    public function insert($name, $class, $mana, $hp, $weapon)
    {

        $sql = "INSERT INTO characters (name, hp, mana, class_id, weapon_id) VALUES (?, ?, ?, ?, ?)";
        $prepared = $this->connect()->prepare($sql);
        $prepared->bindParam(1, $name);
        $prepared->bindParam(2, $hp);
        $prepared->bindParam(3, $mana);
        $prepared->bindParam(4, $class);
        $prepared->bindParam(5, $weapon);
        $prepared->execute();
    }
    public function selectId($id)
    {
        $sql = "SELECT * FROM characters WHERE id='$id'";
        return $this->connect()->query($sql)->fetchAll();
    }
    public function delete($id)
    {
        $sql = "DELETE FROM characters WHERE id='$id'";
        $prepared = $this->connect()->prepare($sql);
        $prepared->execute();   
    }

    public function update($id, $name, $class, $mana, $hp, $weapon)
    {
        $sql = "UPDATE characters SET name='$name', class_id=$class, mana=$mana, hp=$hp, weapon_id=$weapon WHERE id=$id";
        $this->connect()->query($sql)->execute();
        var_dump($sql);die;
    }
}
