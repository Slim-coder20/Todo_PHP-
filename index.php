<?php 
   $filename = __DIR__ .'/data/articles.json';
   $articles = []; 
   $categories = [];
   if(file_exists($filename))
   {
        $articles = json_decode(file_get_contents($filename), true) ?? []; 
        $cattmp = array_map(fn($a) => $a['category'], $articles); // cette méthode array_map va regroouper toutes les catégories // 
        $categories = array_reduce($cattmp, function($acc, $cat){
            if(isset($acc[$cat])){
                $acc[$cat]++;
            
            } else {
                $acc[$cat] = 1;
            }
            return $acc; 
        } ,[]); 
        $articlesPerCategories = array_reduce($articles, function($acc, $article) {
            if(isset($acc [$article ['category']])){
                $acc[$article['category']] = [...$acc[$article['category']], $article];
            
            } else {
                $acc[$article['category']] = [$article];
            
            }
            return $acc;
        },[]);
        //echo "<pre>"; 

        // print_r($articlesPerCategories);


        // echo"</pre>"; 
        
        // La fonction array_reduce est une fonction très puissante en PHP. Son but est de "réduire" un tableau à une seule et unique valeur en appliquant de manière répétée une fonction de rappel (callback) à chaque élément.// 
        
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
            <div class="category-container">
                
                <?php foreach ($categories as $cat => $num): ?> 
                        <h2><?= $cat ?></h2>
                <div class="articles-container">
                <?php foreach ($articlesPerCategories[$cat] as $a): ?>
                    <div class="articles block">
                        <div class="overflow">
                            <div class="img-container" style="background-image: url('<?=($a['image']) ?>')"></div>
                        </div>
                        <h3><?= htmlspecialchars($a['title']) ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
                <?php endforeach; ?> 

            </div>
            
        </div>
        <?php require_once 'includes/footer.php' ?>
    </div>
</body>
</html>
