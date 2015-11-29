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
      <!-- <div class="valign-wrapper"> -->
        <div class="row">
        <form class="col s8">
          <div class="row">
            <div class="input-field col s8">
              <input id="first_name" type="text" class="validate">
              <label for="first_name">First Name</label>
            </div>
            <div class="input-field col s8">
              <input id="last_name" type="text" class="validate">
              <label for="last_name">Last Name</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s8">
              <input id="password" type="password" class="validate">
              <label for="disabled">Password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s8">
              <input id="password" type="password" class="validate">
              <label for="password">Confirm Password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s8">
              <input id="email" type="email" class="validate">
              <label for="email">Email</label>
            </div>
          </div>
          <a class="waves-effect waves-light btn">Create Account</a>
        </form>
      </div>
    <!-- </div> -->

    </body>
  </html>