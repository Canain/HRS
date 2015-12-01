<?php
require 'base.php';
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

<div class="row">
    <form class="col s12">
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="icon_prefix" type="text" class="validate">
                <label for="icon_view_day">Start Date</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">phone</i>
                <input id="icon_telephone" type="tel" class="validate">
                <label for="icon_telephone">End Date</label>
            </div>
        </div>
    </form>
</div>

<a class="waves-effect waves-light btn">Search</a>

<div>
    <!-- LIST OF OPEN ROOMS GO HERE -->
</div>
<?php require 'end.php';