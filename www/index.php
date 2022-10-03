<!DOCTYPE html>
<html>
<head>
  <meta content="Author: Adrian Lewis" name="Hanover Soccer Score reporter">
  <meta content="width=device-width, initial-scale=0.86, maximum-scale=5.0, minimum-scale=0.86" name="viewport">
  <link href="/i/style.css"  rel="stylesheet">
  <script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
  <title>Hanover Soccer - Fall Score Reporter tool</title>
  <?php
  // Check all selects are valid before posting (Leave at top of code)
  $N1 = $N2 = $N3 = $N4 = $S1 = $S2 = $T1 = $T2 = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if ("---" == ($_POST["T1"])) { $T1= "Hanover Team is required"; $N1=1;  } else { $T1 = test_input($_POST["T1"]); $N1=0; }    if ("---" == ($_POST["T2"])) { $T2= "Opposition Team is required"; $N2=1;  } else { $T2 = test_input($_POST["T2"]); $N2=0;}
    if ("---" == ($_POST["S1"])) { $S1= "Hanover Score is required"; $N3=1;  } else { $S1 = test_input($_POST["S1"]); $N3=0;}    if ("---" == ($_POST["S2"])) { $S2 = "Opposition Score is required"; $N4=1;  } else { $S2 = test_input($_POST["S2"]); $N4=0;}
  }
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $N1 = $N2 = $N3 = $N4 = $S1 = $S2 = $T1 = $T2 = ""; // Reset the form data so people don't double-post
    return $data;
  }
  ?>
</head>
<body>
  <h1 style="text-align: left">HYAA Score reporter</h1>
  <img src="/i/hhawks.gif" style="width:400px;height:auto"><br>
  <table><tbody><tr>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['SCRIPT_NAME']);?>">
    <select class="HomeTeam" id="T1" name="T1">
      <option selected="selected" value="---"> Hanover Team </option>
      <option disabled>──────────</option>
      <!-- vv Only bit that changes year to year vv -->
      <option value="B12_1_Coach1"> Boys 1st/2nd Coach 1 </option>
      <option disabled>  ────────── </option>
      <option value="G12_1_Coach1"> Girls 1st/2nd Coach 1 </option>
      <!-- ^^ Only bit that changes year to year ^^-->
      <option disabled>  ────────── </option>
    </select>
    <select class="HomeTeam"  id="S1" name="S1">
      <option selected="selected"  value="---"> Hanover Score  </option>
      <option value="Not_played"> NOT PLAYED </option>
      <option value="Rescheduled">   Rescheduled </option>
      <option value="Forfeited">  Forfeited </option>
      <option disabled>   ────────  </option>
      <option value="0"> 0 </option>
      <option value="1"> 1 </option>
      <option value="2"> 2 </option>
      <option value="3"> 3 </option>
      <option value="4"> 4 </option>
      <option value="5"> 5 </option>
      <option value="6"> 6 </option>
      <option value="7"> 7 </option>
      <option value="8"> 8 </option>
      <option value="9"> 9 </option>
      <option value="10"> 10 </option>
      <option disabled>  ────────── </option>
      <option value="10+"> Over 10</option>
    </select>
    <br>
    <select class="OppositionTeam" id="T2"  name="T2">
      <option selected="selected"  value="---">  Opponent Town </option>
      <option value="CARVER"> CARVER  </option>
      <option value="COHASSET">  COHASSET  </option>
      <option value="DUXBURY">  DUXBURY </option>
      <option value="HALIFAX"> HALIFAX  </option>
      <option disabled>  ──────────  </option>
      <option value="HANOVER">  HANOVER </option>
      <option disabled>  ──────────  </option>
      <option value="HINGHAM">  HINGHAM </option>
      <option value="HULL">  HULL  </option>
      <option value="KINGSTON">  KINGSTON </option>
      <option value="MARSHFIELD"> MARSHFIELD </option>
      <option value="MIDDLEBORO">  MIDDLEBORO </option>
      <option value="NORWELL">  NORWELL  </option>
      <option value="PEMBROKE"> PEMBROKE </option>
      <option value="PLYMOUTH">  PLYMOUTH </option>
      <option value="PLYMPTON">  PLYMPTON </option>
      <option value="SACRED_HEART">  SACRED HEART  </option>
      <option value="SCITUATE">  SCITUATE </option>
      <option value="SIVERLAKE">  SIVER LAKE </option>
    </select>
    <select class="OppositionTeam" id="S2"  name="S2">
        <option selected="selected"  value="---">  Opponent Score </option>
        <option value="Not_played"> NOT PLAYED </option>
        <option value="Rescheduled">   Rescheduled </option>
        <option value="Forfeited">  Forfeited </option>
        <option disabled>   ────────  </option>
        <option value="0"> 0 </option>
        <option value="1"> 1 </option>
        <option value="2"> 2 </option>
        <option value="3"> 3 </option>
        <option value="4"> 4 </option>
        <option value="5"> 5 </option>
        <option value="6"> 6 </option>
        <option value="7"> 7 </option>
        <option value="8"> 8 </option>
        <option value="9"> 9 </option>
        <option value="10"> 10 </option>
        <option disabled>  ────────── </option>
        <option value="10+"> Over 10</option>
    </select>
    <br>
    <button class="GoButton" id="submit-form" type="submit">SEND SCORES</button>
  </form>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $message = $T1 . "," . $S1."\r\n".$T2 . ", " . $S2."\r\n";
    $message = wordwrap($message, 70, "\r\n");
    if (($N1+$N2+$N3+$N4) < 1)
    {
      echo "<br><font color='GREEN'>Report submitted to</font> <font color='BLUE'><b>soccerhanover@gmail.com</b></font>";
      mail('soccerhanover@gmail.com', $T1, $message);
      $message = $N1 = $N2 = $N3 = $N4 = $S1 = $S2 = $T1 = $T2 = ""; //clear the message 
    } else {
      echo "<br><font color='red'>Please fix missing data</font><br>";
    }
  }
  ?>
  <h3>GO HAWKS!</h3>
 <pre style="text-align: left">
Game format Cheat sheet:
===============================================
Grade - Ball   - Fielded - max roster - Halves
 3/4  - size 4 -  7v7    - 13 players - 30mins
 5/6  - size 4 -  9v9    - 16 players - 30mins
 7/8  - size 5 - 11v11   - 22 players - 35mins
 9/10 - size 5 - 11v11   - 25 players - 40mins
11/12 - size 5 - 11v11   - 25 players - 40mins

Sub only if ref allows:
- Throw in
- before goal kick
- after goal
- after injury
- at 1/2 time

Town             Kit Colors
===============================================
Carver           Cranberry
Cohasset         Blue / White
Duxbury          Green / Black 
Halifax          Red
Hanover          White / Blue
Hingham          White / Red Stripes
Hull             Blue / Gold
Kingston         Grey
Marshfield       Green / White
Middleboro       Orange / Black
Norwell          Yellow / Navy Blue [[white]
Pembroke         Red / Navy Blue
Plymouth         Navy Blue
Plympton         Navy / Gray / White
Sacred Heart     Royal Blue
Scituate         Blue 

In case of color clash, home team wears pinnies
</pre>
<a href="https://docs.google.com/spreadsheets/d/1H1WWeQgPW_unliT_moChv629j2ACWAO8Oia885jLquA/edit#gid=0">Coach contacts</a>
<?php  echo "<h5>Today is <b>" . date("Y-m-d") . "</b></h5>"; ?>
</body>
</html>