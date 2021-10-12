<?php include('topNavigation.php'); 
?>
<link rel="stylesheet" href="styles.css"/>

<table class="tableStock">
    <tr>
        <th>Symbol</th>
        <th>Company Name</th>
        <th>Price</th>
    </tr>

      <?php foreach ($stock as $oneStock) { ?>
           <tr>
            <td><?php echo $oneStock['symbol'] ?></td>
            <td><?php echo $oneStock['companyName'] ?></td>
            <td><?php echo "$ " . number_format($oneStock['currentPrice'], 4) ?></td>
        </tr>
    <?php } ?>
</table>

<h2>Search by company name</h2>
<form action="stocks.php" method="get">
    <div> 
        <label>Company Name</label>
        <input type="text" name="companyName"/></br> 
    </div>
    <div>
        <input id="button" type='submit' value='Search Company'/></br>
    </div>
</form>