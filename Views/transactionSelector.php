<label>Company/ Person ID</label>
<select name="id">
    <?php foreach ($transaction as $purchases) { ?>
        <option value=<?php echo $purchases['id']; ?> > 
            <?php echo $purchases['symbol'] . " " . $purchases['personId']; ?>
        </option>
    <?php } ?>
</select>