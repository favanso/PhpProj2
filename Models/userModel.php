<?php

function listPerson($last_name) {

    require('database.php');

    if ($last_name == "") {
        $query = 'select * from person';
        $statement = $db->prepare($query);
    } else {
        $query = 'select * from person where lastName like :lastName';
        $statement = $db->prepare($query);
        $last_name = '%' . $last_name . '%';
        $statement->bindValue(':lastName', $last_name);
    }

    $statement->execute();

    $people = $statement->fetchAll();

    $statement->closeCursor();

    return $people;
}

function updatePerson($id, $last_name, $first_name, $balance) {
    require('database.php');
    $query = "update person set firstName = :firstName, "
            . " lastName = :lastName, "
            . " balance = :balance "
            . " where id = :id";

    $statement = $db->prepare($query);
    $statement->bindValue(':firstName', $first_name);
    $statement->bindValue(':lastName', $last_name);
    $statement->bindValue(':balance', $balance);
    $statement->bindValue(':id', $id);

    $statement->execute();

    $statement->closeCursor();
}

function delete_person($id) {
    require('database.php');

    $query = "delete from person "
            . " where id = :id";

    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);

    $statement->execute();

    $statement->closeCursor();
}

function add_person($last_name, $first_name, $balance) {
    require('database.php');

    $query = "insert into person (firstName, lastName, balance )"
            . " values ( :firstName, :lastName, :balance)";

    $statement = $db->prepare($query);
    $statement->bindValue(':firstName', $first_name);
    $statement->bindValue(':lastName', $last_name);
    $statement->bindValue(':balance', $balance);

    $statement->execute();

    $statement->closeCursor();
}
