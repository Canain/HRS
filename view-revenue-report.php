<?php
require 'base.php';
require 'start.php';
try {
    $sql = 'SELECT MONTHNAME(start_date) as month, location, sum(total_cost) as total_revenue FROM reservation NATURAL JOIN reservation_has_room';
    $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $st->execute();
    $total_revenue = $st->fetch()['total_revenue'];
    $location = $st->fetch()['location'];
    $month = $st->fetch()['month'];
} catch (PDOException $ex) {
    print $ex;
}
?>
<div id="selectrooms">
    <form>
        <table class="striped">
            <thead>
            <th>Month</th>
            <th>Location</th>
            <th>Total Revenue</th>
            <thead>

            <tbody>
            <!--Example row with data from room table-->
                <tr>
                    <td name="month"><?php print $month ?></td>                                    <!-- variable month -->
                    <td name="location"><?php print $location ?></td>                                <!-- variable location -->
                    <td name="totalrevenue"><?php print $total_revenue ?></td>      <!-- variable totalrevenue -->
                </tr>
            </tbody>
        </table>
    </form>
</div>
<?php require 'end.php';