<?php

function listTransaction($id, $personId) {

    require('database.php');

    if ($id == "" && $personId == "") {
        $query = 'select * from purchase';
        $statement = $db->prepare($query);
    } elseif ($id != "" && $personId == "") {
        $query = 'select * from purchase where id like :id';
        $statement = $db->prepare($query);
        $id = '%' . $id . '%';
        $statement->bindValue(':id', $id);
    } elseif ($personId != "" && $id == "") {
        $query = 'select * from purchase where personId like :personId';
        $statement = $db->prepare($query);
        $personId = '%' . $personId . '%';
        $statement->bindValue(':personId', $personId);
    }


    $statement->execute();

    $transactions = $statement->fetchAll();

    $statement->closeCursor();

    return $transactions;
}

function update_transaction($id, $symbol, $personId, $purchasePrice, $quantity) {
    require('database.php');

    $query = "update purchase set symbol = :symbol,"
            . " personId = :personId, "
            . " purchasePrice = :purchasePrice,"
            . " quantity = :quantity "
            . " where id = :id";

    $statement = $db->prepare($query);
    $statement->bindValue(':symbol', $symbol);
    $statement->bindValue(':personId', $personId);
    $statement->bindValue(':purchasePrice', $purchasePrice);
    $statement->bindValue(':quantity', $quantity);
    $statement->bindValue(':id', $id);

    $statement->execute();

    $statement->closeCursor();
}

function delete_transaction($id) {
    require('database.php');

    $query = "delete from purchase "
            . " where id = :id";

    $statement = $db->prepare($query);

    $statement->bindValue(':id', $id);

    $statement->execute();

    $statement->closeCursor();
}

function add_transaction($symbol, $personId, $purchasePrice, $quantity) {
    require('database.php');
    $date = gmdate('Y-m-d h:i:s \G\M\T');
        
        $queryStock = 'select * from stock where symbol like :symbol';
        $statementStock = $db->prepare($queryStock);
        $statementStock->bindValue(':symbol', $symbol);    
        $statementStock->execute();
        $stockInfos = $statementStock->fetchAll();
        $statementStock->closeCursor();
        foreach ($stockInfos as $infoStocks) {
            $stockValue = $infoStocks['currentPrice'];
        }
        
        $query1 = 'select * from person where id like :id';
        $statement1 = $db->prepare($query1);
        $statement1->bindValue(':id', $personId);    
        $statement1->execute();
        $personInfos = $statement1->fetchAll();
        $statement1->closeCursor();
        foreach ($personInfos as $info) {
            $balance = $info['balance'];
        }
        $totalPurchase = $purchasePrice * $quantity;
        
        if($totalPurchase > $balance || $purchasePrice < $stockValue){
            $error = "Balance too low or value payed less than Stock Price";
        include('Views/error.php');
        }else{
        $newBalance = $balance - $totalPurchase;
        $query = "insert into purchase (symbol, personId, purchasePrice, quantity, dateTime)"
                . " values ( :symbol, :id, :purchasePrice, :quantity, :dateTime)";
        
        $balanceQuery = "update person set balance = :newBalance "
                . " where id = :id";
        
        $statementBalance = $db->prepare($balanceQuery);
        $statementBalance->bindValue(':id', $personId);
        $statementBalance->bindValue(':newBalance', $newBalance);
        $statementBalance->execute();
        $statementBalance->closeCursor();

        $statement = $db->prepare($query);
        $statement->bindValue(':symbol', $symbol);
        $statement->bindValue(':id', $personId);
        $statement->bindValue(':purchasePrice', $purchasePrice);
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':dateTime', $date);
       

        $statement->execute();

        $statement->closeCursor();
        header("Location: transaction.php");
    }
}
