<?php 
   $filename = __DIR__ .'/data/articles.json';
   $articles = []; 
   if(file_exists($filename))
   {
        $articles = json_decode(file_get_contents($filename), true) ?? []; 
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="/public/Css/index.css">
    <title>Blog</title>
</head>
<body>
    <div class="container">
        <?php require_once 'includes/header.php' ?>
        <div class="content">
            <div class="articles-container">
                <?php foreach ($articles as $a): ?>
                    <div class="articles block">
                        <div class="overflow">
                            <div class="img-container" style="background-image: url('<?=($a['image']) ?>')"></div>
                        </div>
                        <h2><?= htmlspecialchars($a['title']) ?></h2>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php require_once 'includes/footer.php' ?>
    </div>
</body>
</html>
