<link rel="stylesheet" href="Views/styles.css"/>
<?php
$action = filter_input(INPUT_GET, 'action');

if ($action == "") {
    $action = filter_input(INPUT_POST, 'action');
}

// default action
if ($action == "" || $action == 'listTransaction') {

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $personId = filter_input(INPUT_POST, 'personId', FILTER_VALIDATE_INT);
    $companyName = "";
    $lastName = "";

    include('Models/transactionModel.php');
    include('Models/userModel.php');
    include('Models/stockModel.php');

    $transaction = listTransaction($id, $personId);
    $stock = listStock($companyName);
    $people = listPerson($lastName);

    include('Views/listTransactions.php');
} else if ($action == 'updateTransaction') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $symbol = htmlspecialchars(filter_input(INPUT_POST, 'symbol'));
    $personId = filter_input(INPUT_POST, 'personId', FILTER_VALIDATE_INT);
    $purchasePrice = filter_input(INPUT_POST, 'purchasePrice', FILTER_VALIDATE_FLOAT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

    if ($id == 0 || $symbol == '' || $personId == '' || $purchasePrice == 0 || $quantity == 0) {
        $error = "You must update all fields";
        include("Views/error.php");
    } else {
        include('Models/transactionModel.php');
        update_transaction($id, $symbol, $personId, $purchasePrice, $quantity);
        header("Location: transaction.php");
    }
} else if ($action == 'deleteTransaction') {

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($id == 0) {
        $error = "you must submit a valid user id to delete";
        include('Views/error.php');
    } else {
        include('Models/transactionModel.php');
        delete_transaction($id);
        header("Location: transaction.php");
    }
} else if ($action == 'addTransaction') {

    $symbol = htmlspecialchars(filter_input(INPUT_POST, 'symbol'));
    $personId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $purchasePrice = filter_input(INPUT_POST, 'purchasePrice', FILTER_VALIDATE_FLOAT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

    if ($symbol == '' || $personId == '' || $purchasePrice == 0 || $quantity == 0) {
        $error = "Try again";
        include('Views/error.php');
    } else {
        include('Models/transactionModel.php');
        add_transaction($symbol, $personId, $purchasePrice, $quantity);
        
    }
}

include('Views/transactionsView.php');
