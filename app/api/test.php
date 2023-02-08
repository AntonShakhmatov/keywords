<?php
 
$mysqli = new mysqli('db', 'test', 'test', 'user');
 
if ($mysqli->connect_error) {
    die('Ошибка подключения (' . $mysqli->connect_errno . ') '
     . $mysqli->connect_error);
}
echo '<p>Соединение установлено... ' . $mysqli->host_info . "</p>";
$result = $mysqli->query("SHOW TABLES;");
while ($row = $result->fetch_row()) {
    echo "<p>Таблица: {$row[0]}</p>";
}
echo 'Версия MYSQL сервера: ' . $mysqli->server_info . "\n";
$mysqli->close();
 
?>