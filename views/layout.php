<!DOCTYPE html>
<html>
<head> 
    <title> <?=$titlePage?> </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?=PUBLIC_URL?>/css/c1.css">
    <script src="<?=PUBLIC_URL?>/js/js1.js"></script>
</head>
<body>    
    <div class="container">
        <header><?php include "views/header.php"; ?></header>
        <nav> <?php include "views/nav.php"; ?> </nav>
        <main> <?php include $mainview ?> </main>
        <footer><?php include "views/footer.php";?> </footer>
    </div>
</body>
</html>
