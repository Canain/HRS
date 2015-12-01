<?php
require 'base.php';
require 'start.php';
?>
<div id="selectrooms">
    <form>
        <table class="striped">
            <thead>
            <th data-field='roomnum'>Room Number</th>
            <th data-field='category'>Room Category</th>
            <th data-field='numallowed'># persons allowed</th>
            <th data-field='costperday'>cost per day</th>
            <th data-field='costextrabed'>cost of extra bed per day</th>
            <th data-field='select'>Select Room</th>
            <th data-field="selectextrabed">Select Extra Bed</th>
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
                    <input type="checkbox" class="filled-in" id="select-room-1"/>
                    <label for="select-room-1"></label>
                </td>
                <td>
                    <input type="checkbox" class="filled-in" id="select-extra-bed-1"/>
                    <label for="select-extra-bed-1"></label>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

<div id="confirm">
    <form>
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                        <input type="date" class="validate"/>
                        <label for="start_date"></label>
                    </div>
                    <div class="input-field col s6">
                        <input type="date" class="validate"/>
                        <label for="end_date"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input disabled id="total_cost" type="number" class="validate"/>
                        <label for="total_cost">Total Cost</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <!-- fill with payement options -->
                        <select class="browser-default">
                            <option value="" disabled selected>Select a card</option>
                            <option value="1">2931</option> <!--last 4 digits of variable card_no-->
                        </select>
                    </div>
                    <div class="input-field col s6">
                        <a href="#" class="waves-effect waves-light btn">Add card</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="waves-effect waves-light btn">Submit</a>
    </form>
</div>
<?php require 'end';