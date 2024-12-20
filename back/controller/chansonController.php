<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include_once '../modeles/Chanson.php';

class ChansonController
{
    public function handlePost()
    {
        if (!isset($_SESSION['id'])) {
            header("Location: ../connexion");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
            $userId = $_SESSION['id'];
            $file = $_FILES['file'];
            $nom = $_POST['nom']; 

            // Vérification si l'utilisateur a déjà téléchargé une chanson
            $chansonExistante = Chanson::trouverChansonParUtilisateur($userId);
            if ($chansonExistante) {
                echo "Vous avez déjà téléchargé une chanson.";
                exit();
            }

            $uploadDir = '../../uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = basename($file['name']);
            $targetFilePath = $uploadDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            $allowedTypes = ['mp3', 'wav', 'ogg', 'mp4', 'webm'];

            if (!in_array($fileType, $allowedTypes)) {
                echo "Format de fichier non autorisé.";
                exit();
            }

            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                try {
                    $chanson = new Chanson();
                    $chanson->ajouterChanson($nom, $targetFilePath, $userId);
                    header("Location: ../../front/composants/vote/vote.php"); 
                    echo "La chanson a été téléchargée avec succès.";
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                echo "Erreur lors du téléchargement du fichier.";
            }
        } else {
            echo "Aucun fichier n'a été téléchargé.";
        }
    }
}

$controller = new ChansonController();
$controller->handlePost();
?>
