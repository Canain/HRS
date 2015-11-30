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
                              <input type="checkbox" class="filled-in" id="row1"/>
                              <label for="row1"></label>
                          </td>
                      </tr>
                  </tbody>
              </table>
              <a class="waves-effect waves-light btn">Check Details</a>
          </form>
      </div>

      <div id="confirm">
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
                              <input type="checkbox" class="filled-in" id="row2"/>
                              <label for="row2"></label>
                          </td>
                      </tr>
                  </tbody>
              </table>
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
                              <a href="#!">Add card</a>
                          </div>
                      </div>
                  </div>
              </div>
              <a class="waves-effect waves-light btn">Submit</a>
          </form>
      </div>


    </body>
  </html>
