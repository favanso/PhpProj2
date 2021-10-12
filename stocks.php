<link rel="stylesheet" href="Views/styles.css"/>
<?php
$action = filter_input(INPUT_GET, 'action');

if ($action == "") {
    $action = filter_input(INPUT_POST, 'action');
}

// default action
if ($action == "" || $action == 'listStocks') {

    $companyName = htmlspecialchars(filter_input(INPUT_GET, 'companyName'));

    include('Models/stockModel.php');

    $stock = listStock($companyName);

    include('Views/listStocks.php');
} else if ($action == 'updateStock') {
    $symbol = htmlspecialchars(filter_input(INPUT_POST, 'symbol'));
    $companyName = htmlspecialchars(filter_input(INPUT_POST, 'companyName'));
    $currentPrice = filter_input(INPUT_POST, 'currentPrice', FILTER_VALIDATE_FLOAT);
    

    if ($symbol == '' || $companyName == '') {
        $error = "You must submit symbol and Company name, try again";
        include("Views/error.php");
    } else {
        include('Models/stockModel.php');
        update_stock($symbol, $companyName, $currentPrice);
        header("Location: stocks.php");
    }
} else if ($action == 'deleteStock') {

    $symbol = filter_input(INPUT_POST, 'symbol');

    if ($symbol == '') {
        $error = "You must submit a valid symbol";
        include('Views/error.php');
    } else {
        include('Models/stockModel.php');
        delete_stock($symbol);
        header("Location: stocks.php");
    }
} else if ($action == 'addStock') {

    $symbol = htmlspecialchars(filter_input(INPUT_POST, 'symbol'));
    $companyName = htmlspecialchars(filter_input(INPUT_POST, 'companyName'));
    $currentPrice = filter_input(INPUT_POST, 'currentPrice', FILTER_VALIDATE_FLOAT);

   if ($symbol == '' || $companyName == '') {
        $error = "You must submit symbol and Company name, try again";
        include('Views/error.php');
    } else {
        include('Models/stockModel.php');
        add_stock($symbol, $companyName, $currentPrice);
        header("Location: stocks.php");
    }
}

include('Views/stockView.php');
