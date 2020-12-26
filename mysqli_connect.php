<?php # Script 8.2 - mysqli_connect.php

// This file contains the database access information. 
// This file also establishes a connection to MySQL 
// and selects the database.

// Set the database access information as constants:
/*-----------------------------------
 DATABASE connection remote
 ----------------------------------*/
/* DEFINE ('DB_USER', 'applicaz_oleao');
DEFINE ('DB_PASSWORD', 'ozzyem');
DEFINE ('DB_HOST', 'sql.byethost36.org');
DEFINE ('DB_NAME', 'applicaz_colposcopia'); */


/*-----------------------------------
 DATABASE connection local
 ----------------------------------*/
 /* DEFINE ('DB_USER', 'root');
 DEFINE ('DB_PASSWORD', '');
 DEFINE ('DB_HOST', 'localhost');
 DEFINE ('DB_NAME', 'colposcopy_test_veneto_2020'); */
 

if($_SERVER['HTTP_HOST'] == 'localhost'){
    DEFINE ('DB_USER', 'root');
    DEFINE ('DB_PASSWORD', '');
    DEFINE ('DB_HOST', 'localhost');
    DEFINE ('DB_NAME', 'colposcopy_test_veneto_2020');
} else {
    DEFINE ('DB_USER', 'applicaz_oleao');
    DEFINE ('DB_PASSWORD', 'ozzyem');
    DEFINE ('DB_HOST', 'sql.byethost36.org');
    DEFINE ('DB_NAME', 'applicaz_colposcopia');
}

 
 $link = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

?>