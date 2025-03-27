<!DOCTYPE html> <html>
<head> 
    <title> <?php echo $titlePage ?> </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?= PUBLIC_URL?>css/admin.css">
</head>
<body>    
    <div class="container">
    <header><?php include "views/admin/header.php"; ?></header>
    <main> <?php include $mainview; ?> </main>
</div>
</body></html>
