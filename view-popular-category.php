<?php
require 'base.php';
require 'start.php';
?>
<div id="selectrooms">
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
            <tr>
                <td>August</td>       <!-- variable month -->
                <td>Family</td>       <!-- variable top-room-category -->
                <td>Charlotte</td>    <!-- variable location -->
                <td>45</td>            <!-- variable num-res-category -->
            </tr>
            </tbody>
        </table>
    </form>
</div>
<?php require 'end.php';