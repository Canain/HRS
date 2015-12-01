<?php
require 'base.php';
require 'start.php';
if (isset($_POST["name"])) {
    $name = $_POST["name"];
    $card_no = $_POST["card_no"];
    $exp_date = $_POST["exp_date"];
    $cvv = $_POST["cvv"];
    $username = $_SESSION["username"];
    try {
        $sql = 'INSERT INTO payment VALUES (:card_no, :cvv, :exp_date, :name, :username)';
        $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $st->execute(array(':card_no' => $card_no, ':cvv' => $cvv, ':exp_date' => $exp_date, ':name' => $name, ':username' => $username));
        header('Location: make-reservation.php');
    } catch (PDOException $ex) {
        print $ex;
    }
}
if (isset($_POST['card_no_del'])) {
    $card_no = $_POST['card_no_del'];
    $username = $_SESSION['username'];
    try {
        $sql = 'delete from payment where card_no=:card_no and username=:username';
        $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $st->execute(array(':card_no' => $card_no, ':username' => $username));
    } catch (PDOException $ex) {
        print $ex;
    }
}
?>
<div class="row">
    <div class="col s6">
        <h2>Add Card</h2>
        <div class="row">
            <form class="col s12" method="post">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="name" type="text" name="name" class="validate">
                        <label for="name">Name on card</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="card_no" name="card_no" type="text" class="validate">
                        <label for="card_no">Card Number</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="expiration_date" name="exp_date" type="text" class="validate">
                        <label for="expiration_date">Expiration Date</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="cvv" name="cvv" type="text" class="validate">
                        <label for="cvv">CVV</label>
                    </div>
                </div>
                <button class="waves-effect waves-light btn">Save</button>
            </form>
        </div>
    </div>

    <div class="col s6">
        <h2>Delete Card</h2>
        <form method="post">
            <div class="row">
                <div class="input-field col s12">
                    <select class="browser-default" name="card_no_del">
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