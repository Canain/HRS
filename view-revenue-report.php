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
            <th data-field='totalrevenue'>Total Revenue</th>
            <thead>

            <tbody>
            <!--Example row with data from room table-->
            <tr>
                <td>August</td>       <!-- variable month -->
                <td>Orlando</td>      <!-- variable location -->
                <td>21000</td>    <!-- variable totalrevenue -->
            </tr>
            </tbody>
        </table>
    </form>
</div>
<?php require 'end.php';