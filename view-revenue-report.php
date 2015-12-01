<?php
require 'base.php';
require 'start.php';
try {
    $sql = 'select monthname(start_date) as month, location, sum(total_cost) as total_revenue
            from reservation natural join reservation_has_room
            group by month, location
            order by month, location';
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
            <?php
                try {
                    $sql = 'select monthname(start_date) as month, location, sum(total_cost) as total_revenue
                from reservation natural join reservation_has_room
                group by month, location
                order by month, location';
                    $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $st->execute();
                    $rows = $st->fetchAll();
                    foreach ($rows as $row) {
                        $total_revenue = $row['total_revenue'];
                        $location = $row['location'];
                        $month = $row['month'];
                        print "<tr> <td>$month</td> <td>$location</td> <td>$total_revenue</td></tr>";
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