<?php 
const ERROR_REQUIRED = "Veuillez renseigner ce champ.";
const ERROR_TITLE_TO_SHORT = "Le titre est trop court. "; 
const ERROR_CONTENT_TO_SHORT = "L'article est trop court.";
const ERROR_IMAGE_URL = 'L\'image doit être une url valide.'; 

$filename = __DIR__ .'/data/articles.json';

$errors = [
    'title' => '',
    'image' => '',
    'category' => '',
    'content' => ''

];
$articles = [];

// Initialiser les variables pour pré-remplir le formulaire en cas d'erreur
$title = '';
$image = '';
$category = '';
$content = '';

if($_SERVER['REQUEST_METHOD'] === 'POST')
{   
    if(file_exists($filename)){
        $articles = json_decode (file_get_contents($filename), true) ?? [];
    }
    $_POST = filter_input_array(INPUT_POST,[
        'title' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 
        'image' => FILTER_SANITIZE_URL, 
        'category' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 
        'content' => [
            'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES,
            
        ]  
        
    ]);
    $title = $_POST['title'] ?? ''; 
    $image = $_POST['image'] ?? '';
    $category = $_POST['category'] ?? ''; // ERREUR CORRIGÉE
    $content = $_POST['content'] ?? '';   // ERREUR CORRIGÉE

    if(!$title)
    {
        $errors['title'] = ERROR_REQUIRED;
    }
    else if(mb_strlen($title) < 5)
    {
        $errors['title'] = ERROR_TITLE_TO_SHORT;
    }

    if(!$image)
    {
        $errors['image'] = ERROR_REQUIRED;
    }
    else if(!filter_var($image, FILTER_VALIDATE_URL))
    {
        $errors['image'] = ERROR_IMAGE_URL;
    }
    if(!$category)
    {
        $errors['category'] = ERROR_REQUIRED;
    }
    if(!$content) // ERREUR CORRIGÉE : Vérification de $content
    {
        $errors['content'] = ERROR_REQUIRED;
    }
    else if(mb_strlen($content) < 50) // ERREUR CORRIGÉE : Vérification de $content
    {
        $errors['content'] = ERROR_CONTENT_TO_SHORT;
    }
    echo '<pre>';

    if(empty(array_filter($errors, fn($e) => $e !== ''))){
        
        $articles = [...$articles,[
            'title' => $title, 
            'iamge' => $image, 
            'category' => $category, 
            'content' => $content
            
        ]];
        file_put_contents($filename, json_encode($articles));
        header('Location:/');
    } 


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="/public/Css/add-article.css">
    <title>Blog</title>
</head>
<body>
    <div class="container">
        <?php require_once 'includes/header.php' ?>
        <div class="content">
            <div class="block p-20 form-container">
                <h1>Ecrire un article</h1>
                <form action="/add-article.php" method="POST">
                    <div class="form-control">
                        <label for="title">Titre</label>
                        <input type="text" name="title" id="title" value=<?= $title ?? '' ?>>
                        <?php  if ($errors ['title']): ?>
                        <p class="text-error"><?= ($errors ['title']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-control">
                        <label for="image">Image</label>
                        <input type="text" name="image" id="image" value=<?= $image ?? '' ?>>
                        <?php  if ($errors ['image']): ?>
                        <p class="text-error"><?= ($errors ['image']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-control">
                        <label for="category">Categories</label>
                        <select name="category" id="category">
                            <option value="technologie">Technologies</option>
                            <option value="nature">Nature</option>
                            <option value="ppolitique">Politique</option>
                        </select>
                        <?php  if ($errors ['category']): ?>
                        <p class="text-error"><?= ($errors ['category']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-control">
                        <label for="content">Contenu</label>
                        <textarea name="content" id="content" value=<?= $content ?? '' ?>></textarea>
                        <?php  if ($errors ['content']): ?>
                        <p class="text-error"><?= ($errors ['content']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-action">
                        <a href="/"class="btn btn-secondary" type="button">Annuler</a>
                        <button class="btn btn-primary" type="submit">Sauvegarder</button>
                    </div>
                </form>
            </div>
            
        </div>
        <?php require_once 'includes/footer.php' ?>
    </div>
</body>
</html>