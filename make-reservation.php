<?php
require 'base.php';
require 'start.php';
?>
    <div id="selectrooms">
        <form>
            <table class="striped">
                <thead>
                <th data-field='roomnum'>Room Number</th>
                <th data-field='category'>Room Category</th>
                <th data-field='numallowed'># persons allowed</th>
                <th data-field='costperday'>cost per day</th>
                <th data-field='costextrabed'>cost of extra bed per day</th>
                <th data-field='select'>Select Room</th>
                <th data-field="selectextrabed">Select Extra Bed</th>
                <thead>

                <tbody>
                <!--Example row with data from room table-->
                <?php
                if (isset($_POST["location"])) {
                    $location = $_POST["location"];
                    $start_date = $_POST["start_date"];
                    $end_date = $_POST["end_date"];
                        $sql = "SELECT * FROM room WHERE location = 'Atlanta' AND NOT EXISTS (SELECT *
FROM reservation_has_room
WHERE room_no = num AND reservation_id NOT IN
(SELECT reservation_id FROM reservation
WHERE (DATE(start_date) > :start_date AND DATE(end_date) < :start_date OR (DATE(start_date) < :end_date AND DATE(end_date) > :end_date))))";
                        $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                        $st->execute(array(':start_date' => date("Y-m-d H:i:s", strtotime($start_date)), ':end_date' => date("Y-m-d H:i:s", strtotime($end_date))));
                        $rows = $st->fetchAll();
                        foreach ($rows as $row) {
                            $num = $row['num'];
                            $category = $row['category'];
                            $people = $row['people'];
                            $cost = $row['cost'];
                            $cost_extra_bed = $row['cost_extra_bed'];
                            print "<tr>
    <td>{$num}</td>          <!-- variable num -->
    <td>{$category}</td>     <!-- variable category -->
    <td>{$people}</td>            <!-- variable people -->
    <td>{$cost}</td>          <!-- variable cost -->
    <td>{$cost_extra_bed}</td>           <!-- variable cost_extra_bed -->
    <td>
        <input type='checkbox' class='filled-in' id='select-room-{$num}' name='select-room-{$num}'/>
        <label for='select-room-{$num}'></label>
    </td>
    <td>
        <input type='checkbox' class='filled-in' id='select-extra-bed-{$num}' name='select-room-{$num}'/>
        <label for='select-extra-bed-{$num}'></label>
    </td>
</tr>";
                        }
                }
                ?>
                </tbody>
            </table>
        </form>
    </div>
    <div id="confirm">
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <form method="post">
                        <div class="input-field col s6">
                            <input type="date" id="start_date" name="start_date" class="validate"/>
                            <label for="start_date"></label>
                        </div>
                        <div class="input-field col s6">
                            <input type="date" id="end_date" name="end_date" class="validate"/>
                            <label for="end_date"></label>
                        </div>
                        <div class="input-field col s6">
                            <select name="location" class="browser-default">
                                <option value="" disabled selected>Select a Location</option>
                                <option value="Atlanta">Atlanta</option>
                                <option value="Charlotte">Charlotte</option>
                                <option value="Savannah">Savannah</option>
                                <option value="Orlando">Orlando</option>
                                <option value="Miami">Miami</option>
                            </select>
                        </div>
                        <div class="col s6">
                            <button type="submit" class="waves-effect waves-light btn">Search</button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input disabled id="total_cost" type="number" class="validate"/>
                        <label for="total_cost">Total Cost</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <!-- fill with payement options -->
                        <select class="browser-default">
                            <option value="" disabled selected>Select a card</option>
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
                    <div class="input-field col s6">
                        <a href="payment-info.php" class="waves-effect waves-light btn">Add card</a>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="waves-effect waves-light btn">Submit</button>
    </div>
<?php require 'end.php';