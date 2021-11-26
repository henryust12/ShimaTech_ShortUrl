<h1>Request Short Url</h1>
<form action="/generate/" method="POST">
<input type="text" name="urlA" id="">
<input type="submit" value="REQUEST">
</form>

<?php
if($_POST['urlA']!=null or $_POST['urlA']!=''){
    echo '<hr>Long URL : '.$_POST['urlA'].'<hr>';
include_once('Generate.php');

include '../check/getServerName.php';
if($ServerName=='sshort.tk'){
    $host = 'localhost';
    $db   = '-';
    $user = '-';
    $pass = '-';
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
    // $surl=$_POST['urlA'];
    $surl=$_POST['urlA'];
    $suid=generate($_POST['urlA']);
    $sdate=date('Y-m-d');

    $uid=$suid;
    $long_url='';
    $stmt = $pdo->prepare('SELECT * FROM `sshort_view` WHERE id_url=?');
    $stmt->execute([$uid]); 
    while ($row = $stmt->fetch()) {
        $long_url=$row['long_url'];
    }
    if($long_url=='' or $long_url==null){
        $data = [
            'id_url' => $suid,
            'long_url' => $surl,
            'create_date' => $sdate,
        ];
    
        $sql = 'INSERT INTO `sshort_url` (`id_url`, `long_url`, `create_date`) VALUES (:id_url, :long_url, :create_date)';
        $pdo->prepare($sql)->execute($data);
        echo '<h2 style="color: red;">data Created</h2>';
    } else {
        echo '<h2 style="color: red;">data exist</h2>';
    }

    echo '<hr>Your Url is: <a href="http://sshort.tk/'.$uid.'" target="_blank">http://sshort.tk/'.$uid.'</a><br>';
    echo '<small>Note: The short link will be active for 5 days from the moment it is created.</small>';

}
?>
