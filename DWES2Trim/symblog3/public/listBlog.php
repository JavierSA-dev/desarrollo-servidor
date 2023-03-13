<?php
include '../vendor/autoload.php';
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' =>DBHOST,
    'database' =>  DBNAME,
    'username' =>  DBUSER,
    'password' =>  DBPASS,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();

if (isset($_POST['send'])) {
    $blog = new Blog();
    $blog->title = $_POST['title'];
    $blog->author = $_POST['author'];
    $blog->blog = $_POST['blog'];
    $blog->image = $_POST['image'];
    $blog->tags = $_POST['tags'];
    $blog->save();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="title" id="title" placeholder="Title">
        <input type="text" name="author" id="author" placeholder="Author">
        <input type="text" name="blog" id="blog" placeholder="Blog">
        <input type="text" name="image" id="image" placeholder="Image">
        <input type="text" name="tags" id="tags" placeholder="Tags">
        <input type="submit" value="Submit" name="send">
    </form>    
</body>
</html>