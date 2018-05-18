<?php
  require('config.php');
  session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style media="screen">
    th, td {
      padding: 7px;
      color: rgb(61, 59, 57);
      text-align: center;
    }
    a{
      color: rgb(61, 59, 57);
    }
    table {
      display: table;
      border-collapse: separate;
      border-spacing: 2px;
      border-color: gray;
    }

  </style>
  </head>
  <body>
    <div class="container">

    <?php
    // echo "osma.php <hr>";
    $link = mysqli_connect($servername, $username, $password, $dbname)
        or die("ERROR " . mysqli_connect_error($link));
    $link->set_charset('utf8');

    // echo $_SESSION['id_uzivatel'] . "<br>";
    // echo $_SESSION['admin'] . "<br>";
    // echo $_SESSION['id_trasa'] . "<br>";

    $user_id = $_SESSION['id_uzivatel'];
    $trasa_id = $_SESSION['id_trasa'];
    $admin = $_SESSION['administrator'];

    $query = "SELECT * FROM prejdena_trasa WHERE id_uzivatel = $user_id
              AND id_celkova_trasa = $trasa_id";
    // $query . = ORDER BY id .... ;
    // SELECT * FROM prejdena_trasa WHERE id_uzivatel = $_SESSION['id_user']
    //           AND id_celkova_trasa = $_SESSION['id_route']";

    $sortVzd = "vzdialenostASC";
    $sortDat = "datumASC";
    $sortCasStart = "cassASC";
    $sortCasEnd = "caseASC";
    $sortGpsStart = "gpssASC";
    $sortGpsEnd = "gpseASC";
    $sortHod = "hodnotenieASC";
    $sortPoz = "poznamkaASC";

    if($_GET['sort'] == 'vzdialenostASC'){
      $query .= " ORDER BY vzdialenost";
      $sortVzd = 'vzdialenostDESC';
    }
    elseif($_GET['sort'] == 'vzdialenostDESC'){
      $query .= " ORDER BY vzdialenost DESC";
      $sortVzd = 'vzdialenostASC';
    }
    elseif($_GET['sort'] == 'datumASC'){
      $query .= " ORDER BY datum";
      $sortDat = 'datumDESC';
    }
    elseif($_GET['sort'] == 'datumDESC'){
      $query .= " ORDER BY datum DESC";
      $sortDat = 'datumASC';
    }
    elseif($_GET['sort'] == 'cassASC'){
      $query .= " ORDER BY datum, cas_start";
      $sortCasStart = 'cassDESC';
    }
    elseif($_GET['sort'] == 'cassDESC'){
      $query .= " ORDER BY datum, cas_start DESC";
      $sortCasStart = 'cassASC';
    }
    elseif($_GET['sort'] == 'caseASC'){
      $query .= " ORDER BY datum, cas_end";
      $sortCasEnd = 'caseDESC';
    }
    elseif($_GET['sort'] == 'caseDESC'){
      $query .= " ORDER BY datum, cas_end DESC";
      $sortCasEnd = 'caseASC';
    }
    elseif($_GET['sort'] == 'gpssASC'){
      $query .= " ORDER BY GPS_Start";
      $sortGpsStart = 'gpssDESC';
    }
    elseif($_GET['sort'] == 'gpssDESC'){
      $query .= " ORDER BY GPS_Start DESC";
      $sortGpsStart = 'gpssASC';
    }
    elseif($_GET['sort'] == 'gpseASC'){
      $query .= " ORDER BY GPS_End";
      $sortGpsEnd = 'gpseDESC';
    }
    elseif($_GET['sort'] == 'gpseDESC'){
      $query .= " ORDER BY GPS_End DESC";
      $sortGpsEnd = 'gpseASC';
    }
    elseif($_GET['sort'] == 'hodnotenieASC'){
      $query .= " ORDER BY hodnotenie";
      $sortHod = 'hodnotenieDESC';
    }
    elseif($_GET['sort'] == 'hodnotenieDESC'){
      $query .= " ORDER BY hodnotenie DESC";
      $sortHod = 'hodnotenieASC';
    }
    elseif($_GET['sort'] == 'poznamkaASC'){
      $query .= " ORDER BY poznamka";
      $sortPoz = 'poznamkaDESC';
    }
    elseif($_GET['sort'] == 'poznamkaDESC'){
      $query .= " ORDER BY poznamka DESC";
      $sortPoz = 'poznamkaASC';
    }

    $result = mysqli_query($link,$query);
    $count = 0;
    $km = 0;
    $tabulka = '';

    echo "<h3>Treningy na aktivnej trase</h3>";
    // $tabluka .= "<table class='table table-bordered table-hover table-responsive' id='myTable'>
      $tabulka .="<tr>
                  <th> <a href='?sort=$sortVzd'>Vzdialenost</a> </th>
                  <th> <a href='?sort=$sortDat'>Datum</a> </th>
                  <th> <a href='?sort=$sortCasStart'>Cas Start</a> </th>
                  <th> <a href='?sort=$sortCasEnd'>Cas End</a> </th>
                  <th> <a href='?sort=$sortGpsStart'>GPS Start</a> </th>
                  <th> <a href='?sort=$sortGpsEnd'>GPS End</a> </th>
                  <th> <a href='?sort=$sortHod'>Hodnotenie</a> </th>
                  <th> <a href='?sort=$sortPoz'>Poznamka</a> </th>
                  <th onclick='sortTable()'>Priemerna rychlost</th>
                  </tr>";

    while($row = mysqli_fetch_array($result)){
      $tabulka .= "<tr>
            <td>$row[vzdialenost]</td>
            <td>$row[datum]</td>
            <td>$row[cas_start]</td> <td>$row[cas_end]</td>
            <td>$row[GPS_Start]</td> <td>$row[GPS_End]</td>
            <td>$row[hodnotenie]</td>
            <td>$row[poznamka]</td>
            <td>" . $row[vzdialenost]/((strtotime($row[cas_end])-strtotime($row[cas_start]))/60/60) . "</td>
            </tr>";
            $count++;
            $km += $row[vzdialenost];
    }
    // $tabulka .= "</table> <hr>";
    // echo $tabulka;
    ?>

    <form method="post">
      <input type="submit" name="generate_pdf" class="btn btn-success" value="Generuj PDF" />
    </form>
    <table class="table table-border" id='myTable'>
      <?php echo $tabulka; ?>
    </table>

    <?php
    echo "<hr> Priemer odbehnutých/odjazdených kilometrov " . $km/$count . "<br> <br>";

    if($admin == 1){
      // echo "deviata.php <hr>";
      $query = "SELECT uzivatel.id, uzivatel.Meno, uzivatel.Priezvysko, uzivatel.Email
                FROM uzivatel";

      // SELECT uzivatel.id, uzivatel.Meno, uzivatel.Priezvysko, uzivatel.Email,
      //druzstvo.id, druzstvo.meno FROM uzivatel, druzstvo WHERE uzivatel.druzstvo_id = druzstvo.id

      $result = mysqli_query($link,$query);
      echo "<h3>Vypis pre admina</h3>";
      echo '<table class="table table-bordered ">
            <tr>
            <th>Meno</th>
            <th>Priezvisko</th>
            <th>Email</th>
            </tr>';

      while($row = mysqli_fetch_array($result)){
        echo "<tr>
              <td>$row[Meno]</td>
              <td>$row[Priezvisko]</td>
              <td><a href='?id=" . $row['id'] . "'> $row[Email]</a></td>
              </tr>";
      }
    }
    if(isset($_GET['id'])){
      $query = "SELECT * FROM prejdena_trasa WHERE id_uzivatel ='" . $_GET['id'] . " ' ";
      $result = mysqli_query($link, $query);
      echo "<table class='table'>";
      echo "<tr>
            <th>Vzdialenost</th>
            <th>Datum</th>
            <th>Cas Start</th>
            <th>Cas End</th>
            <th>GPS Start</th>
            <th>GPS End</th>
            <th>Hodnotenie</th>
            <th>Poznamka</th>
            <th>Priemerna rychlost</th>
            <tr>";
      while($info = mysqli_fetch_array($result)){
        echo "<tr>
              <td>$info[vzdialenost]</td>
              <td>$info[datum]</td>
              <td>$info[cas_start]</td> <td>$info[cas_end]</td>
              <td>$info[GPS_Start]</td> <td>$info[GPS_End]</td>
              <td>$info[hodnotenie]</td>
              <td>$info[poznamka]</td>
              <td>" . $info[vzdialenost]/((strtotime($info[cas_end])-strtotime($info[cas_start]))/60/60) . "</td>
              </tr>";
      }
      echo "</table>";
    }

    if(isset($_POST['generate_pdf'])){
      require_once('tcpdf/tcpdf.php');
      $obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      $obj_pdf->SetCreator(PDF_CREATOR);
      $obj_pdf->SetTitle("Podrobna tabulka vykonov");
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $obj_pdf->SetDefaultMonospacedFont('helvetica');
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
      $obj_pdf->setPrintHeader(false);
      $obj_pdf->setPrintFooter(false);
      $obj_pdf->SetAutoPageBreak(TRUE, 10);
      $obj_pdf->SetFont('helvetica', '', 11);
      $obj_pdf->AddPage();
      $content = '';
      $content .= '<h3 align="center">Podrobna tabulka vykonov</h3></br>
                   <table border="1" cellspacing="0" cellpadding="2">';
      $content .= $tabulka;
      $content .= '</table>';
      $obj_pdf->writeHTML($content);
      ob_end_clean();
      $obj_pdf->Output('file.pdf', 'I');
    }
    ?>

    </div>

    <script type="text/javascript">
    function sortTable() {
      var table, rows, switching, i, x, y, shouldSwitch, switchCount = 0;
      table = document.getElementById("myTable");
      switching = true;
      dir = "asc";
      while (switching) {
        switching = false;
        rows = table.getElementsByTagName("TR");
        for (i = 1; i < (rows.length - 1); i++) {
          shouldSwitch = false;
          x = rows[i].getElementsByTagName("TD")[8];
          y = rows[i + 1].getElementsByTagName("TD")[8];
          if (dir == "asc"){
            if (Number(x.innerHTML) > Number(y.innerHTML)) {
              shouldSwitch = true;
              break;
            }
          }
          else if(dir == "desc"){
            if (Number(x.innerHTML) < Number(y.innerHTML)) {
              shouldSwitch = true;
              break;
            }
          }
        }
        if (shouldSwitch) {
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
          switchCount++;
        }
        else{
          if (switchCount == 0 && dir == "asc") {
              dir = "desc";
              switching = true;
          }
        }
      }
    }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
