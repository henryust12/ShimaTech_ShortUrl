<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShimaTech Short URL: Is short url web aplication build with PHP</title>
</head>
<body>
    <?php
    echo $_POST['urlA'];
    $request = $_SERVER['REQUEST_URI'];
    switch ($request) {
        case '/' :
            require __DIR__ . '/home/index.php';
            break;
        case '' :
            require __DIR__ . '/home/index.php';
            break;
        case '/generate' :
            require __DIR__ . '/generate/';
            break;
        case '/custom' :
            require __DIR__ . '/custom/';
            break;
        default:
            session_start();
            $_SESSION['q']=substr($request,1);
            http_response_code(404);
            // check url from Database
            require __DIR__ . '/check/chk.php';
            break;
    }
    ?>
</body>
</html>