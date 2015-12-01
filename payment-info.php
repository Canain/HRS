<?php
require 'base.php';
require 'start.php';
?>
<div class="row">
    <div class="col s6">
        <h2>Add Card</h2>
        <div class="row">
            <form class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="first_name" type="text" class="validate">
                        <label for="first_name">Name on card</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="last_name" type="text" class="validate">
                        <label for="last_name">Card Number</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="expiration_date" type="text" class="validate">
                        <label for="expiration_date">Expiration Date</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" class="validate">
                        <label for="password">CVV</label>
                    </div>
                </div>
                <a class="waves-effect waves-light btn">Save</a>
            </form>
        </div>
    </div>

    <div class="col s6">
        <h2>Delete Card</h2>
        <form method="post">
            <div class="row">
                <div class="input-field col s12">
                    <select class="browser-default">
                        <option value="" disabled selected>Choose your option</option>
                        <?php
                        $sql = "SELECT card_no % 10000 as last, card_no FROM payment WHERE username = :username";
                        $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                        $st->execute(array(':username' => $_SESSION['username']));
                        $rows = $st->fetchAll();
                        foreach ($rows as $row) {
                            $card_no = $row['card_no'];
                            $last = $row['last'];
                            print "<option value='{$card_no}'>*{$last}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <button type="submit" class="waves-effect waves-light btn">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php require 'end.php';