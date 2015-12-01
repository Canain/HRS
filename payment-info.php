<?php
require 'base.php';
require 'start.php';
?>
<div class="row">

    <div class="col s6">
        <h2>Add Card</h2>

        <div class="row">
            <form class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="first_name" type="text" class="validate">
                        <label for="first_name">Name on card</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="last_name" type="text" class="validate">
                        <label for="last_name">Card Number</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="expiration_date" type="text" class="validate">
                        <label for="expiration_date">Expiration Date</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" class="validate">
                        <label for="password">CVV</label>
                    </div>
                </div>
                <a class="waves-effect waves-light btn">Save</a>
            </form>
        </div>
    </div>

    <div class="col s6">
        <h2>Delete Card</h2>
        <!-- Dropdown Trigger -->
        <div class="input-field col s12">
            <select>
                <option value="" disabled selected>Choose your option</option>
                <option value="1"><!-- VARIABLE: CARD NO1 -->8219</option>
                <option value="2"><!-- VARIABLE: CARD NO2 -->1234</option>
                <option value="3"><!-- VARIABLE: CARD NO3 -->4321</option>
            </select>
            <label>Card Number</label>
        </div>
    </div>
</div>
<?php require 'end.php';