

<label>Person</label>
<select name="id">
    <?php foreach ($people as $person) { ?>
        <option value=<?php echo $person['id']; ?> > <?php echo $person['firstName'] . " " . $person['lastName']; ?></option>
    <?php } ?>
</select>

