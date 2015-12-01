<?php
require 'base.php';
require 'start.php';
?>
<div id="selectrooms">
    <form>
        <table class="striped">
            <thead>
            <th data-field='month'>Month</th>
            <th data-field='location'>Location</th>
            <th data-field='numreservations'>Total # Reservations</th>
            <thead>

            <tbody>
            <!--Example row with data from room table-->

            <?php
            try {
                $sql = 'select monthname(start_date) as month, location, count(reservation_id) as num_reservations
                from reservation natural join reservation_has_room
                group by month, location
                order by month, location';
                $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $st->execute();
                $rows = $st->fetchAll();
                foreach ($rows as $row) {
                    $num_reservations = $row['num_reservations'];
                    $location = $row['location'];
                    $month = $row['month'];
                    print "<tr> <td>$month</td> <td>$location</td> <td>$num_reservations</td></tr>";
                }
            } catch (PDOException $ex) {
                print $ex;
            }
            ?>
            </tbody>
        </table>
    </form>
</div>
<?php require 'end.php';
