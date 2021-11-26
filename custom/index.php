<h1>Request Short Url</h1>
<form action="/custom/" method="POST">
LONG URL: &#8195;&#8195;
<input type="text" name="urlA" id=""><br>
CustomName : &#8195;
<input type="text" name="customurl" id=""><br>
<input type="submit" value="REQUEST">
</form>

<?php
if($_POST['urlA']!=null or $_POST['urlA']!='' or $_POST['customurl']!=null or $_POST['customurl']!=''){
    echo '<hr>Long URL : '.$_POST['urlA'].'<hr>';
    echo '<hr>custom URL : '.$_POST['customurl'].'<hr>';

/*
u730565153_blog 
u730565153_henryust12 
localhost 

*/
include '../check/getServerName.php';
if($ServerName=='sshort.tk'){
    $host = 'localhost';
    $db   = 'u730565153_blog';
    $user = 'u730565153_henryust12';
    $pass = 'Sahabatnoah4ever-';
    $port = "3306";
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
    $suid=$_POST['customurl'];
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
