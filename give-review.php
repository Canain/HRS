<?php
require 'base.php';
if (isset($_POST["location-dropdown"]) && isset($_POST["rating-dropdown"]) && isset($_POST["comment"])) {
    $location = $_POST["location-dropdown"];
    $rating = $_POST["rating-dropdown"];
    $comment = $_POST["comment"];
    $username = $_SESSION["username"];
    try {
        $sql = 'INSERT INTO review VALUES (DEFAULT, :location, :rating, :comment, :username)';
        $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $st->execute(array(':location' => $location, ':rating' => $rating,
            ':comment' => $comment, ':username' => $username));
        header('Location: choose-functionality.php');
        exit;
    } catch (PDOException $ex) {
        print $ex;
    }
} else {
    print "Not all of the options are set";
}
require 'start.php';
?>


<div class="row">
    <form method="post" class="col s12">
        <select name="location-dropdown" class="browser-default">
            <option disabled selected value="">Location</option>
            <option value="Atlanta">Atlanta</option>
            <option value="Charlotte">Charlotte</option>
            <option value="Savannah">Savannah</option>
            <option value="Orlando">Orlando</option>
            <option value="Miami">Miami</option>
        </select>

        <p></p>

        <select name="rating-dropdown" class="browser-default">
            <option disabled selected value="">Rating</option>
            <option value="Excellent">Excellent</option>
            <option value="Good">Good</option>
            <option value="Bad">Bad</option>
            <option value="Very Bad">Very Bad</option>
            <option value="Neutral">Neutral</option>
        </select>

        <div class="row">
            <div class="input-field col s12">
                <textarea id="textarea1" name="comment" class="materialize-textarea"></textarea>
                <label for="textarea1">Comment</label>
            </div>
        </div>
        <button type="submit" class="waves-effect waves-light btn">Submit</button>
    </form>
</div>
<?php require 'end.php';
