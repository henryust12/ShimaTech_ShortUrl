<?php
session_start();

include 'getServerName.php';
if($ServerName=='sshort.tk'){
    $host = 'localhost';
    $db   = '-';
    $user = '-';
    $pass = '--';
    $port = "-";
    $charset = 'utf8mb4';
} else {
    $host = 'localhost';
    $db   = 'myblog';
    $user = 'root';
    $pass = '';
    $port = "3306";
    $charset = 'utf8mb4';
}

    

    $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
    try {
        $pdo = new \PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
    $sql='SELECT * FROM `sshort_url`';
    $uid=$_SESSION['q'];
    $long_url='';
    $stmt = $pdo->prepare('SELECT * FROM `sshort_view` WHERE id_url=?');
    $stmt->execute([$uid]); 
    while ($row = $stmt->fetch()) {
        $long_url=$row['long_url'];
    }
    if($long_url=='' or $long_url==null){
        echo '<h1>Links Unknown. The link has not been registered or the Long URL is invalid when generating.</h1>';
    } else {
        header('Location: '.$long_url);
    }
    
?>
