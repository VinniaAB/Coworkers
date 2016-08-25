<?php
/**
 * Created by PhpStorm.
 * User: joakimcarlsten
 * Date: 25/08/16
 * Time: 16:00
 */

/**
 * @var \Vinnia\Coworkers\Coworker $coworker
 */
?>
<table>
    <tr>
        <td><label class="control-label" for="position">Position</label></td>
        <td><input class ="form-control" type="text" name="position" id="position" placeholder="CEO/CFO" value="<?= $coworker->position; ?>"/></td>
    </tr>
    <tr>
        <td><label class="control-label" for="email">Email</label></td>
        <td><input class="form-control" type="text" name="email" id="email" placeholder="john@doe.com" value="<?= $coworker->email; ?>"/></td>
    </tr>
    <tr>
        <td><label class="control-label" for="phone">Phone</label></td>
        <td><input class="form-control" type="text" name="phone" id="phone" placeholder="+46 70 123 45 67" value="<?= $coworker->phone; ?>"/></td>
    </tr>
</table>
