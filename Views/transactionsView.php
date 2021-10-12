<h2>Add Transaction</h2>
<form action="transaction.php" method="post">
    <div>
         <?php include("Views/stockSelector.php"); ?></br>
        <?php include("Views/userSelector.php"); ?></br>
        <label>Purchase Price</label>
        <input type="text" name="purchasePrice"/></br>
        <label>Quantity</label>
        <input type="text" name="quantity"/></br> 
    </div>
    <div>
        <input type='hidden' name='action' value='addTransaction'/>
        <input id="button" type='submit' value='Add Transaction'/></br>
    </div>
</form>

<h2>Update Transaction</h2>
<form action="transaction.php" method="post">
    <div>
       <?php include("Views/transactionSelector.php"); ?></br>
        <label>Symbol</label>
        <input type="text" name="symbol"/></br> 
        <label>Person Id</label>
        <input type="text" name="personId"/></br> 
        <label>Purchase Price</label>
        <input type="text" name="purchasePrice"/></br>
        <label>Quantity</label>
        <input type="text" name="quantity"/></br> 
    </div>
    <div>
        <input type='hidden' name='action' value='updateTransaction'/>
        <input id="button" type='submit' value='Update Transaction'/></br>
    </div>
</form>


<h2>Delete Transaction</h2>
<form action="transaction.php" method="post">
    <div>
         <?php include("Views/transactionSelector.php"); ?></br>
    </div>
    <div>
        <input type='hidden' name='action' value='deleteTransaction'/>
        <input id="buttonDelete" type='submit' value='Delete Transaction'/></br>
    </div>
</form>

</body>
</html>