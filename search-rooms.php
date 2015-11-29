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


    </body>
  </html>