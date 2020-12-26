<html lang="en">

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>colposcopyapp - diagnosi</title>



<style>

pre {

font-size: 10px;

padding: 0px 5px 5px 0px;

}



/* ---------------------------------titles row  */

th {

    background-color:#999999;

    font-weight:bold;

    text-align: center;

    margin-bottom:10px;

    padding: 5px 5px 5px 5px;

}



td {

padding: 3px 5px 3px 5px;

}



.tr_bg_green {

    background-color:#D0DDDD;

}



.tr_bg_grey {

    background-color:#DDDDDD;

}



/* ---------------------------------forms in-row titles  */

.td_form_right {

    font-family: "verdana";

    font-size: 12px;

    padding: 5px 0px 5px 5px;

    text-align: right;

}

</style> 

</head>

<body> 

  <pre>

    <table cellpadding="3" cellspacing="3">

      <tr>

        <th></th>

        <th>nome</th>

        <th></th>

            



<?php

/*-----------------------------------

 DATABASE connection

 ----------------------------------*/

/*

DEFINE ('DB_USER', 'root');

DEFINE ('DB_PASSWORD', '');

DEFINE ('DB_HOST', 'localhost');

DEFINE ('DB_NAME', 'applicaz_colposcopy_test_2019');





DEFINE ('DB_USER', 'applicaz_oleao');

DEFINE ('DB_PASSWORD', 'ozzyem');

DEFINE ('DB_HOST', 'localhost');

DEFINE ('DB_NAME', 'applicaz_colposcopy_test_2019');
*/


DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'colposcopy_test_veneto_2020');



$link = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );





/*-----------------------------------

test data to be analysed 

 ----------------------------------*/



$_test_name = "'COLPO SCREENING_2'"; // $_test_name = "'COLPO SCREENING'";

$_number_casi = 50; // must be set according number of cases in test

$_group_name = "'VENETO2'";





/*-----------------------------------

loop cases questions titles

 ----------------------------------*/

for ($i=1; $i < ($_number_casi+1); $i++) {

?>



      

  <th><?php echo $i; ?></th>

    



<?php 

}

echo '</tr>'; 





/*-----------------------------------

array participants answers

 ----------------------------------*/

$query = "

select 

id_user

from

risposte

inner join casi on risposte.caso = casi.id_caso

inner join test on casi.test = test.id_test

inner join users on risposte.user = users.id_user

inner join codici on users.codice = codici.id_codice

inner join gruppi_codici on codici.id_codice = gruppi_codici.id_codice

inner join gruppi on gruppi_codici.id_gruppo = gruppi.id

where casi.num_caso = 1

and test.titolo = $_test_name

and gruppi.name = $_group_name

order by users.cognome

";

$result = mysqli_query($link, $query);



//$row = mysqli_fetch_row($result); COUNT(risposte.caso)

//$_num_table_rows = $row[0];



if (mysqli_num_rows($result) > 0) {

  while ($row = mysqli_fetch_array($result)) {

    $_names_users_test[] = $row['id_user'];

  }

}





/*-----------------------------------

array answers participants

 ----------------------------------*/

 // ini loop & utilities table

$_users_number = count($_names_users_test);

$_counter_nomi = 0;

$_color_bg = 'class="tr_bg_green"';

$_cases_stats = array();



// loop users

foreach ($_names_users_test as $key => $value) {

  $_flag = 0;

  $_counter_nomi++;

  $_punteggio1 = 0;

  $_punteggio2 = 0;

  $_punteggio3 = 0;

  $_punteggio4 = 0;

  $_counter_bx_si = 0;

  

  

  $_color_bg = ($_color_bg == 'class="tr_bg_green"') ? 'style="background-color:#FFDBFF"' : 'class="tr_bg_green"' ;

  

  // loop casi

  echo '<tr>';  

  for ($i=1; $i < ($_number_casi+1); $i++) {

    $query = "

    select 

    gruppi.name, test.titolo, casi.num_caso, users.cognome, users.nome, risposte.risposta_1, risposte.risposta_2, risposte.risposta_3, risposte.risposta_bio, casi.soluzione_1, casi.soluzione_2, casi.soluzione_3

    from

    risposte

    inner join casi on risposte.caso = casi.id_caso

    inner join test on casi.test = test.id_test

    inner join users on risposte.user = users.id_user

    inner join codici on users.codice = codici.id_codice

    inner join gruppi_codici on codici.id_codice = gruppi_codici.id_codice

    inner join gruppi on gruppi_codici.id_gruppo = gruppi.id

    where casi.num_caso = $i

    and test.titolo = $_test_name

    and gruppi.name = $_group_name

    and users.id_user = $value

    ";

    $result = mysqli_query($link, $query);

    

    if (mysqli_num_rows($result) > 0) {

      while ($row = mysqli_fetch_array($result)) {

       

        if ($row['soluzione_3'] == 1 AND $row['risposta_3'] == 1) {

          if ($row['risposta_bio'] == 1 ) $_punteggio4++;

        }               

                        

  

        $_score1 = $row['risposta_1'];

        $_score2 = $row['risposta_2'];

        $_score3 = $row['risposta_3'];

        

        $_score4 = $row['risposta_bio'];

        

        

        // visualize participant name only in first column of row

        if ($_flag == 0) echo '<th>' . $_counter_nomi . '</th>

                               <td class="tr_bg_grey">' . strtoupper($row['cognome']) . '</td>

                               <th>Diagnosi</th>';

        $_flag = 1;

        

        echo '<td ' . $_color_bg . '>' . $_score2 . '</td>';

      } 

    } else {

      echo '<td style="background-color:#FFDBFF">' . 'x' . '</td>';

    }

  }

  echo '</tr>'; 

}

?>





    </table> 

  </body>

</html>