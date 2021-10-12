

<label>Stocks</label>
<select name="symbol">
    <?php foreach ($stock as $oneStock) { ?>
        <option value=<?php echo $oneStock['symbol']; ?> > <?php echo $oneStock['companyName']; ?></option>
    <?php } ?>
</select>
