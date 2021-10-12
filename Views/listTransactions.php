<?php include('topNavigation.php');
?>
<link rel="stylesheet" href="styles.css"/>

<table class="tableTransaction">
    <tr>
        <th>ID</th>
        <th>Symbol</th>
        <th>Person Id</th>
        <th>Purchase Price</th>
        <th>Quantity</th>
        <th>Date</th>
    </tr>

    <?php foreach ($transaction as $purchases) { ?>
        <tr>
            <td><?php echo $purchases['id'] ?></td>
            <td><?php echo $purchases['symbol'] ?></td>
            <td><?php echo $purchases['personId'] ?></td>
            <td><?php echo number_format($purchases['purchasePrice'], 4) ?></td>
            <td><?php echo $purchases['quantity'] ?></td>
            <td><?php echo $purchases['dateTime'] ?></td>
        </tr>
    <?php } ?>
</table>

<h2>Search by Id</h2>
<form action="transaction.php" method="post">
    <div> 
        <label>ID</label>
        <input type="text" name="id"/></br> 
    </div>
    <div>
        <input id= "button" type='submit' value='Search Transaction'/></br>
    </div>
</form>
<div></div>

<h2>Search by User Id</h2>
<form action="transaction.php" method="post">
    <div> 
        <label>User ID</label>
        <input type="text" name="personId"/></br> 
    </div>
    <div>
        <input id= "button" type='submit' value='Search Transaction by User'/></br>
    </div>
</form>