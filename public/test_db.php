<?php
define("HOST", 'localhost');
define("DATABASENAME", 'mvc_oop');
define("USER", 'root');
define("PASS", '');

$conn = new mysqli(HOST, USER, PASS, DATABASENAME);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
echo "Kết nối thành công!";
?>
