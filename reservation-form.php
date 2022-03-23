<?php
session_start();

// On récupère les infos de la session en cours
$dataUser = $_SESSION['data'][0];
$id_user = $dataUser['id'];




//Conditions pour vérifier le post
if (isset($_POST['Valider'])) {

    //  Connexion à la BDD
//    $bdd = mysqli_connect('localhost', 'root', '', 'reservationsalles') or die("Impossible de se connecter : " . mysqli_connect_error());
    $bdd = mysqli_connect("localhost", "yasmine", "yasmine", "yasmine-rouabhia_reservationsalles") or die("Impossible de se connecter : " . mysqli_connect_error());



    if (!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['datedebut']) && !empty($_POST['datedefin'])) {

        //  Conditions pour vérifier les Post


        //      Stockage des variable Post
        $titre = htmlspecialchars($_POST['titre']);
        $description = htmlspecialchars($_POST['description']);
        $datedebut = htmlspecialchars($_POST['datedebut']);
        $datedefin = htmlspecialchars($_POST['datedefin']);
        //      Requête d'insertion de donné dans la table reservations
        $addevent = "INSERT INTO reservations (titre , description , debut , fin , id_utilisateur) VALUES ('$titre','$description','$datedebut','$datedefin','$id_user')";

        if (mysqli_query($bdd, $addevent)) {

            header('Location: planning.php');
            exit;
        }
    } else {

        $erreur = "<p>Veuillez verifier tous les champs</p>";
    }
}
ob_start();
?>


<div class="main2_reservation-form">
                <article>
                    <h1>Reservation</h1>
                    <span class="condition">Durée maximum de 1H par réservervation</span>
                    <p>Veuillez préciser les informations de votre évènement :</p>

                </article>
                    
                
                <div class="big_box_reservation-form">
                    <div class="reservation-form">
                        <div class="box2_reservation-form">

                            <form method="POST" action="">

                                <div>
                                    <label for="Login : "></label>
                                    <input type="text" name="titre" placeholder="Titre de l'évènement" size="25" />
                                </div>

                                <div>
                                    <textarea name="description" cols="50" rows="5" placeholder="Description"></textarea>
                                </div>

                                <div>
                                    <label for="Date de début : "></label>
                                    <p>Date et Heure de début</p>
                                    <input type="datetime" name="datedebut" placeholder=" ex : 2022-01-21 08:00" size="25" />
                                </div>

                                <div>
                                    <label for="Date de fin : "></label>
                                    <p>Date et Heure de fin</p>
                                    <input type="datetime" name="datedefin" placeholder=" ex : 2022-01-21 09:00" size="25" />
                                </div>


                                <input type="submit" name="Valider" value="Reserver" class="bouton_valider" />

                            </form>

                        </div>
                    </div>
                </div>


<?php
$content = ob_get_clean();
require_once 'template.php';
?>