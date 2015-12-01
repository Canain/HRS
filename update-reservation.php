<?php
require 'base.php';
require 'start.php';
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

<div id="reservation_search">
    <div class="row">
        <form class="col s12">
            <div class="row">
                <div class="input-field col s6">
                    <input id="reservation_id" type="text" class="validate">
                    <label for="reservation_id">Reservation ID</label>
                </div>
            </div>
        </form>
    </div>

    <a class="waves-effect waves-light btn">Search</a>
</div>

<div id="change_dates">
    <div class="row">
        <form class="col s12">
            <div class="row">
                <div class="input-field col s6">
                    <input id="cur_start_date" type="text" class="validate" disabled>
                    <label for="cur_start_date">Current start date</label>   <!-- variable start_date -->
                </div>
                <div class="input-field col s6">
                    <input id="cur_end_date" type="text" class="validate" disabled>
                    <label for="cur_end_date">Current end date</label>      <!-- variable end_date -->
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="new_start_date" type="text" class="validate">
                    <label for="new_start_date">New start date</label>
                </div>
                <div class="input-field col s6">
                    <input id="new_end_date" type="text" class="validate">
                    <label for="new_end_date">New end date</label>
                </div>
            </div>
        </form>
    </div>

    <a class="waves-effect waves-light btn">Search Availability</a>
</div>

<div id="confirm_changes">
    <h6>Rooms are available. Please confirm details below before submitting.</h6>

    <form>
        <table class="striped">
            <thead>
            <th data-field='roomnum'>Room Number</th>
            <th data-field='category'>Room Category</th>
            <th data-field='numallowed'># persons allowed</th>
            <th data-field='costperday'>cost per day</th>
            <th data-field='costextrabed'>cost of extra bed per day</th>
            <th data-field='select'>Extra bed</th>
            <thead>

            <tbody>
            <!--Example row with data from room table-->
            <tr>
                <td>111</td>          <!-- variable num -->
                <td>Standard</td>     <!-- variable category -->
                <td>2</td>            <!-- variable people -->
                <td>100</td>          <!-- variable cost -->
                <td>70</td>           <!-- variable cost_extra_bed -->
                <td>
                    <!-- variable extra_bed must be disabled -->
                    <input type="checkbox" id="row2" checked="checked" disabled="disabled"/>
                    <label for="row2"></label>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <div class="input-field col s12">
                        <input disabled id="total_cost" type="number" class="validate"/>
                        <label for="total_cost">Total Cost Updated</label>
                    </div>
                </div>
            </div>
        </div>
        <a class="waves-effect waves-light btn">Submit</a>
    </form>
</div>
<?php require 'end.php';