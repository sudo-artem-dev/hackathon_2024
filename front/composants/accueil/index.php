<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../connexion"); 
    exit();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concours de Noël</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="header">
    <nav class="navbar">
        <a href="../../../back/controller/logout.php" class="btn">Se déconnecter</a>
        <ul>   
            <li><a href="../accueil/index.php" class="btn">Accueil</a></li>
            <li><a href="../vote/vote.php" class="btn">Vote</a></li>
            <li><a href="../chanson/indexChanson.php" class="btn">Ajouter une chanson</a></li>
            <li><a href="../classement/classement.php" class="btn">Classement</a></li>
            <li><a href="../admin/indexAdmin.php" class="btn">Admin</a></li>

        </ul>
    </nav>
</header>

</div>
    <div class="container">
        <div class="header">
            <h1>🎄 Joyeux Noël 🎁</h1>
        </div>
        
        <main class="main-content">
            <div class="welcome-div">
                <h1>Bienvenue sur Chantons Noël, <?php echo $_SESSION['nom']; ?>!</h1>                
                <p>L’association "Chantons Noël" propose chaque année un concours de chant permettant au vainqueur de voir sa chanson promue et 
                    diffusée lors des marchés de Noël d'Alsace et être sélectionnée pour un prime spécial "Noël" de la Star Academy.</p>
                <p>Vous êtes connecté avec l'adresse e-mail : <?php echo $_SESSION['email']; ?></p>

            </div>
        </main>
        <footer class="footer">

        </footer>
    </div>

    <!-- Animation des flocons -->
    <div class="snowflakes" aria-hidden="true">
        
        <div class="snowflake">❄</div>
        <div class="snowflake">❄</div>
        <div class="snowflake">❄</div>
        <div class="snowflake">❄</div>
        <div class="snowflake">❄</div>
        <div class="snowflake">❄</div>
        
    </div>
</body>
</html>
