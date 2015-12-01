<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

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
</body>
</html>
