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
            <div class="block">
                <h1>Ecrire un article</h1>
                <form action="/add-article.php" method="POST">
                    <div class="form-control">
                        <label for="title">Titre</label>
                        <input type="text" name="title" id="title">
                        <p class="text-error"></p>
                    </div>
                    <div class="form-control">
                        <label for="image">Image</label>
                        <img src="#" alt="image d'article dans le blog">
                        <p class="text-error"></p>
                    </div>
                    <div class="form-control">
                        <label for="category">Categories</label>
                        <select name="category" id="category">
                            <option value="technologie">Technologies</option>
                            <option value="nature">Nature</option>
                            <option value="ppolitique">Politique</option>
                        </select>
                        <p class="text-error"></p>
                    </div>
                    <div class="form-control">
                        <label for="content">Contenu</label>
                        <textarea name="content" id="content"></textarea>
                        <p class="text-error"></p>
                    </div>
                    <div class="form-action">
                        <button class="btn btn-secondary" type="button">Annuler</button>
                        <button class="btn btn-primary" type="button">Sauvegarder</button>
                    </div>
                </form>
            </div>
            
        </div>
        <?php require_once 'includes/footer.php' ?>
    </div>
</body>
</html>