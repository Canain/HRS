<?php
require 'base.php';
require 'start.php';
?>
<h2>
    Hotel Location
</h2>

<form method="post">
    <select name="location-dropdown" class="browser-default">
        <option disabled selected value="">Location</option>
        <option value="Atlanta">Atlanta</option>
        <option value="Charlotte">Charlotte</option>
        <option value="Savannah">Savannah</option>
        <option value="Orlando">Orlando</option>
        <option value="Miami">Miami</option>
    </select>

    <p></p>

    <button type="submit" class="waves-effect waves-light btn-large">Check Reviews</button>
</form>

<table class="striped">
    <thead>
    <th data-field='rating'>Rating</th>
    <th data-field='comment'>Comment</th>
    <thead>

    <tbody>
    <!--Example row with data from room table-->
    <?php
    if (isset($_POST["location-dropdown"])) {
        $location = $_POST["location-dropdown"];
        try {
            $sql = 'SELECT rating, comment FROM review WHERE location = :location';
            $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $st->execute(array(':location' => $location));
            $reviews = $st->fetchAll();
            foreach ($reviews as $review) {
                echo "<tr><td>" . $review['rating'] . "</td><td>" . $review['comment'] . "</td></tr>";
            }
        } catch (PDOException $ex) {
            print $ex;
        }
    } else {
        echo "Location not set";
    }
    ?>
    <tr>
        <td>Rating</td>       <!-- variable rating -->
        <td>Comment</td>      <!-- variable comment -->
    </tr>
    </tbody>
</table>
<?php require 'end.php';