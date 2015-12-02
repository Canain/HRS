<?php
require 'base.php';
require 'start.php';
?>
<div id="selectrooms">
    <h2>View Popular Categories</h2>
    <form method="post">
        <p>
            <input type="checkbox" id="January" name="January"/>
            <label for="January">January</label>
        </p>
        <p>
            <input type="checkbox" id="February" name="February"/>
            <label for="February">February</label>
        </p>
        <p>
            <input type="checkbox" id="March" name="March"/>
            <label for="March">March</label>
        </p>
        <p>
            <input type="checkbox" id="April" name="April"/>
            <label for="April">April</label>
        </p>
        <p>
            <input type="checkbox" id="May" name="May"/>
            <label for="May">May</label>
        </p>
        <p>
            <input type="checkbox" id="June" name="June"/>
            <label for="June">June</label>
        </p>
        <p>
            <input type="checkbox" id="July" name="July"/>
            <label for="July">July</label>
        </p>
        <p>
            <input type="checkbox" id="August" name="August"/>
            <label for="August">August</label>
        </p>
        <p>
            <input type="checkbox" id="September" name="September"/>
            <label for="September">September</label>
        </p>
        <p>
            <input type="checkbox" id="October" name="October"/>
            <label for="October">October</label>
        </p>
        <p>
            <input type="checkbox" id="November" name="November"/>
            <label for="November">November</label>
        </p>
        <p>
            <input type="checkbox" id="December" name="December"/>
            <label for="December">December</label>
        </p>
        <button type="submit" class="waves-effect waves-light btn">Submit</button>
    </form>
    <form>
        <table class="striped">
            <thead>
            <th data-field='month'>Month</th>
            <th data-field='top-room-category'>Top Room Category</th>
            <th data-field='location'>Location</th>
            <th data-field='num-res-category'>Total Number of Reservations for room category</th>
            <thead>

            <tbody>
            <!--Example row with data from room table-->
            <?php
            $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
            foreach ($months as $month) {
                if (isset($_POST[$month])) {
                    $month_name = $month;
                    try {
                        $sql = 'SELECT month, category, location, max(num_reservations) as res
                            FROM
                            (SELECT monthname(start_date) AS month, category, location, count(reservation_id) AS num_reservations
                             FROM reservation NATURAL JOIN reservation_has_room NATURAL JOIN room
                             WHERE monthname(start_date)=:month_name
                             GROUP BY category, location
                             ORDER BY location) AS s
                             GROUP BY location';
                        $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                        $st->execute(array(':month_name' => $month_name));
                        $rows = $st->fetchAll();
                        foreach ($rows as $row) {
                            $num_reservations = $row['res'];
                            $location = $row['location'];
                            $month = $row['month'];
                            $category = $row['category'];
                            print "<tr> <td>$month</td> <td>$category</td> </td><td>$location</td> <td>$num_reservations</td></tr>";
                        }
                    } catch (PDOException $ex) {
                        print $ex;
                    }
                }
            }
            ?>
            </tbody>
        </table>
    </form>
</div>
<?php require 'end.php';