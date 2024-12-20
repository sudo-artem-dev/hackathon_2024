<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../connexion"); 
    exit();
}

include_once '../../../back/modeles/Chanson.php';

$chanson = new Chanson();
$allChansons = $chanson->getAllChansons();
?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styleAdmin.css"></link>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
        <title>Admin</title>
    </head>
    <body>
    <header>
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

    <main>
        <div>
            <h2>Liste des chansons</h2>
            <ul>
                <?php foreach ($allChansons as $chanson): ?>
                    <?php $audioUrl = $chanson['chemin'] ?>
                    <li>
                        <h3>Nom de la musique : <?php echo htmlspecialchars($chanson['nom']) ?></h3>
                        <p>Chemin : <?php echo htmlspecialchars($chanson['chemin']); ?></p>
                        <p>Votes : <?php echo htmlspecialchars($chanson['vote']); ?></p>
                        <audio controls>
                        <source src="../<?php echo htmlspecialchars($audioUrl); ?>" type="audio/mpeg">
                        Votre navigateur ne supporte pas l'élément audio.
                        </audio>
                        <form method="POST" action="../../../back/controller/isValid.php" class="chanson-form">
                            <input type="hidden" name="chanson_id" value="<?php echo $chanson['id']; ?>">
                            <input type="hidden" name="isValid" value="1">
                            <button type="submit">Valider</button>
                        </form>

                        <form method="POST" action="../../../back/controller/isValid.php" class="chanson-form">
                            <input type="hidden" name="chanson_id" value="<?php echo $chanson['id']; ?>">
                            <input type="hidden" name="isValid" value="0">
                            <button type="submit">Refuser</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </main>

    </body>
    </html>
<script src="scriptAdmin.js"></script>
<?php
