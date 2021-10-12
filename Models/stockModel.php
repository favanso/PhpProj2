<?php

function listStock($companyName) {

    require('database.php');

    if ($companyName == "") {
        $query = 'select * from stock';
        $statement = $db->prepare($query);
    } else {
        $query = 'select * from stock where companyName like :companyName';
        $statement = $db->prepare($query);
        $companyName = '%' . $companyName . '%';
        $statement->bindValue(':companyName', $companyName);
    }

    $statement->execute();

    $stock = $statement->fetchAll();

    $statement->closeCursor();
   
    return $stock;
}

function update_stock($symbol, $companyName, $currentPrice) {
    require('database.php');

    $query = "update stock set symbol = :symbol, "
            . " companyName = :companyName, "
            . " currentPrice = :currentPrice "
            . " where symbol = :symbol";

    $statement = $db->prepare($query);
    $statement->bindValue(':symbol', $symbol);
    $statement->bindValue(':companyName', $companyName);
    $statement->bindValue(':currentPrice', $currentPrice);

    $statement->execute();

    $statement->closeCursor();
}

function delete_stock($symbol) {
    require('database.php');

    $query = "delete from stock "
            . " where symbol = :symbol";

    $statement = $db->prepare($query);

    $statement->bindValue(':symbol', $symbol);

    $statement->execute();

    $statement->closeCursor();
}

function add_stock($symbol, $companyName, $currentPrice) {
     require('database.php');
        
        $query = "insert into stock (symbol, companyName, currentPrice )"
                . " values ( :symbol, :companyName, :currentPrice)";
        
        
        $statement = $db->prepare($query);
        $statement->bindValue(':symbol', $symbol);
        $statement->bindValue(':companyName', $companyName);
        $statement->bindValue(':currentPrice', $currentPrice);
        
        $statement->execute();
        
        $statement->closeCursor();
}
