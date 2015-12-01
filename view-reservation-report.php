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
            <tr>
                <td>August</td>       <!-- variable month -->
                <td>Atlanta</td>      <!-- variable location -->
                <td>2</td>            <!-- variable numreservations -->
            </tr>
            </tbody>
        </table>
    </form>
</div>
<?php require 'end.php';
