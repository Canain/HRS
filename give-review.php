<?php
require 'base.php';
if (isset($_POST["location-dropdown"]) && isset($_POST["rating-dropdown"]) && isset($_POST["comment"])) {
    $id = round(microtime(true) * 1000);
    $location = $_POST["location-dropdown"];
    $rating = $_POST["rating-dropdown"];
    $comment = $_POST["comment"];
    $username = $_SESSION["username"];
    $sql = 'INSERT INTO review VALUE (:id, :location, :rating, :comment, :username)';
    $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $st->execute(array(':id' => $id, ':location' => $location, ':rating' => $rating,
        ':comment' => $comment, ':username' => $username));
} else {
    print "Not all of the options are set";
}
require 'start.php';
?>
<a class='dropdown-button btn' href='#' data-activates='dropdown1'>Locations</a>

<!-- Dropdown Structure -->
<ul id='dropdown1' class='dropdown-content'>
    <li><a href="#!">Atlanta</a></li>
    <li><a href="#!">Charlotte</a></li>
    <li><a href="#!">Savannah</a></li>
    <li><a href="#!">Orlando</a></li>
    <li><a href="#!">Miami</a></li>
</ul>

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
    <option value="Excellent">Atlanta</option>
    <option value="Good">Charlotte</option>
    <option value="Bad">Savannah</option>
    <option value="Very Bad">Orlando</option>
    <option value="Neutral">Miami</option>
</select>

<div class="row">
    <form class="col s12">
        <div class="row">
            <div class="input-field col s12">
                <textarea id="textarea1" name="comment" class="materialize-textarea"></textarea>
                <label for="textarea1">Comment</label>
            </div>
        </div>
        <a class="waves-effect waves-light btn">Submit</a>
    </form>
</div>
<?php require 'end.php';