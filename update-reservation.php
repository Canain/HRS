<?php
require 'base.php';
if (isset($_POST['reservation_id'])) {
    $reservation_id = $_POST['reservation_id'];
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM reservation WHERE reservation_id = :reservation_id AND username = :username";
    $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $st->execute(array(':reservation_id' => $reservation_id, ':username' => $username));
    $row = $st->fetch();
    if (!$row) {
        print 'No reservation found';
        exit;
    }
    $start_date = $row['start_date'];
    $end_date = $row['end_date'];
    $is_cancelled = $row['is_cancelled'];
    $total_cost = $row['total_cost'];
    $cur_start_date = $start_date;
    $cur_end_date = $end_date;
}
require 'start.php';
?>
    <div id="reservation_search">
        <form method="post" class="col s12">
            <div class="row">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="reservation_id" name="reservation_id" type="text" class="validate">
                        <label for="reservation_id">Reservation ID</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="waves-effect waves-light btn">Search</button>
        </form>
    </div>

    <div id="change_dates">
        <form class="col s12">
            <div class="row">
                <div class="row">
                    <div class="input-field col s6">
                        Current start date: <?php if (isset($cur_start_date)) print $cur_start_date; ?>
                    </div>
                    <div class="input-field col s6">
                        Current end date: <?php if (isset($cur_end_date)) print $cur_end_date; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="new_start_date" type="text" class="validate">
                        <label for="new_start_date">New start date</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="new_end_date" type="text" class="validate">
                        <label for="new_end_date">New end date</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="waves-effect waves-light btn">Search Availability</button>
        </form>
    </div>

    <div id="confirm_changes">
        <h6>Rooms are available. Please confirm details below before submitting.</h6>

        <form>
            <table class="striped">
                <thead>
                <th data-field='roomnum'>Room Number</th>
                <th data-field='category'>Room Category</th>
                <th data-field='numallowed'># persons allowed</th>
                <th data-field='costperday'>cost per day</th>
                <th data-field='costextrabed'>cost of extra bed per day</th>
                <th data-field='select'>Extra bed</th>
                <thead>

                <tbody>
                <?php
                $sql = "SELECT reservation_id, num, extra_bed, cost, category, people, cost_extra_bed FROM reservation_has_room, room WHERE num = room_no AND reservation_id = :reservation_id";
                $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $st->execute(array(':reservation_id' => $reservation_id));
                foreach ($st->fetchAll() as $row) {
                    $num = $row['num'];
                    $category = $row['category'];
                    $people = $row['people'];
                    $cost = $row['cost'];
                    $cost_extra_bed = $row['cost_extra_bed'];
                    $extra_bed = $row['extra_bed'];
                    $checked = $extra_bed ? "checked='checked'" : "";
                    print "<tr>
                    <td>{$num}</td>          <!-- variable num -->
                    <td>{$category}</td>     <!-- variable category -->
                    <td>{$people}</td>            <!-- variable people -->
                    <td>{$cost}</td>          <!-- variable cost -->
                    <td>{$cost_extra_bed}</td>           <!-- variable cost_extra_bed -->
                    <td>
                        <!-- variable extra_bed must be disabled -->
                        <input type='checkbox' id='extra-bed-{$num}' {$checked} disabled='disabled'/>
                        <label for='extra-bed-{$num}'></label>
                    </td>
                </tr>";
                }
                ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                            <input disabled id="total_cost" type="number" class="validate"/>
                            <label for="total_cost">Total Cost Updated</label>
                        </div>
                    </div>
                </div>
            </div>
            <a class="waves-effect waves-light btn">Submit</a>
        </form>
    </div>
<?php require 'end.php';