<?php
require 'base.php';
require 'start.php';
?>
<div style="display:flex;justify-content: center;align-items: center; position: relative;">
    <div class="row">
        <h2 align="center">Choose Option</h2>
        <div class="col s12">
            <!--  SHOWN FOR CUSTOMER  -->
            <?php if (!$_SESSION["manager"]) : ?>
                <div class="collection">
                    <a href="make-reservation.php" class="collection-item">Make a new reservation</a>
                    <a href="update-reservation.php" class="collection-item">Update your reservation</a>
                    <a href="cancel-reservation.php" class="collection-item">Cancel reservation</a>
                    <a href="give-review.php" class="collection-item">Provide feedback</a>
                    <a href="view-review.php" class="collection-item">View feedback</a>
                </div>
            <?php endif; ?>
        </div>

        <div class="col s12">
            <!--  SHOWN FOR MANAGEMENT  -->
            <?php if ($_SESSION["manager"]) : ?>
                <div class="collection">
                    <a href="view-reservation-report.php" class="collection-item">View Reservation report</a>
                    <a href="view-popular-category.php" class="collection-item">View popular room category report</a>
                    <a href="view-revenue-report.php" class="collection-item">View revenue report</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require 'end.php';