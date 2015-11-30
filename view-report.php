  <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>

      <h2>
        Hotel Location
      </h2>

      <!-- Dropdown Trigger -->
      <a class='dropdown-button btn' href='#' data-activates='dropdown1'>Locations</a>

      <!-- Dropdown Structure -->
      <ul id='dropdown1' class='dropdown-content'>
        <li><a href="#!">Atlanta</a></li>
        <li><a href="#!">Charlotte</a></li>
        <li><a href="#!">Savannah</a></li>
        <li><a href="#!">Orlando</a></li>
        <li><a href="#!">Miami</a></li>
      </ul>

      <p></p>

      <a class="waves-effect waves-light btn-large">Check Reviews</a>

      <table class="striped">
        <thead>
            <th data-field='rating'>Rating</th>
            <th data-field='comment'>Comment</th>
        <thead>
      
        <tbody>
          <!--Example row with data from room table-->
          <tr>
              <td>Rating</td>       <!-- variable rating -->
              <td>Comment</td>      <!-- variable comment -->
            </tr>
        </tbody>
      </table>

    </body>
  </html>