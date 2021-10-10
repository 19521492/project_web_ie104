<?php
define('HOST', 'localhost');
define('USENAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'PROJECT_WEB_TRUYEN');



$connect = mysqli_connect(HOST, USENAME, PASSWORD, DATABASE);

if(!$connect) {
    require_once('./create_database.php');
} else {
    mysqli_close($connect);
}




function EXECUTE($sql_query) {
    $connect = mysqli_connect(HOST, USENAME, PASSWORD, DATABASE);
    mysqli_query($connect, $sql_query);
    mysqli_close($connect);
}

function EXECUTE_RESULT($sql_query) {
    $connect = mysqli_connect(HOST, USENAME, PASSWORD, DATABASE);
    $result = mysqli_query($connect, $sql_query);
    $data = [];
    while ($row = mysqli_fetch_array($result, 1)) {
        $data[] = $row;
    }
    mysqli_close($connect);
    return $data;
}




function timtenruyen($tentruyen) {
    $arr_ktu = explode(' ', $tentruyen);
    $sql_query = "SELECT * FROM TRUYEN WHERE TENTRUYEN LIKE '.$tentruyen.'
    ";
    $dstruyen = [];
    $dstruyen = EXECUTE_RESULT($sql_query);
    return $dstruyen;
}


