<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/css/accueil.css">
        <title>Accueil - IA Pau</title>
    </head>
        <body>
            <img id="atriumImg" src="/img/atrium.JPG" alt="atrium">


            <div id="content">
                <div>
                    <img id="logoA" src="/img/iapau_round.png" alt="logo">
                </div>
                <h1>Présentation de l'association</h1>     
             </div>
             <div id="content2">
                <p>L’association IA PAU rassemble dans la bonne humeur chercheurs, enseignants, étudiants, entrepreneurs, particuliers autour de la thématique du traitement des données et propose de rapprocher la sphère économique, le monde académique et le grand public en organisant des événements et des projets collaboratifs. Son objectif est de vulgariser et partager les connaissances autour de ce progrès majeur du XXIème siècle qui suscite de nombreuses interrogations scientifiques, technologiques, éthiques, et démocratiques.</p>
                <p>L’ association IA PAU a pour ambition de démystifier l’intelligence artificielle en la rendant accessible au plus grand nombre en proposant des événements d’acculturation, d’information et de partage. Elle favorise et accompagne également des projets collaboratifs entre entreprises, associations, collectivités et étudiants pour faciliter les échanges dans le domaine de l’Intelligence Artificielle et pour instaurer une dynamique collective pérenne dans le territoire.
                </p>
            </div>
            <div id="grad1"></div>
            <div id="content3">
                <h1>
                    Vous souhaitez participer à nos data challenges?
                </h1>
                <p style="border-bottom-right-radius: 30px;border-bottom-left-radius: 30px; max-width:65%; padding-left: 8vh;">
                IA Pau organise des Data Challenges avec les entreprises partenaires pour amener les meilleurs étudiants de la francophonie à travailler sur des projets concrets liés à leurs données. Les Data Challenges permettent d'explorer des ensembles de données réels, appliquer des techniques avancées d'analyse et de modélisation, et collaborer avec des professionnels. C'est une occasion unique de mettre en pratique vos connaissances et de développer de nouvelles compétences tout en travaillant sur des problèmes concrets.
                </p>
                <br>
                <a href="/php/liste-data-events.php?typeDataEvent=challenge" id="btnDataChall">nos data challenges</a>
                <?php if($_SESSION["estConnecte"]) : ?>
                    <a href="/php/connexion/deconnexion.php" id="btnDataChall">Déconnexion</a>
                <?php else: ?>
                    <a href="/php/connexion/connexion.php" id="btnDataChall">Se connecter</a>
                    <a href="/php/connexion/inscription.php" id="btnDataChall">S'inscrire</a>
                <?php endif ?>

                <div id="imageContainer">

                    <img id="pyr" src="/img/pyrenee.webp" alt="pyrenee">

                    <div id="imageText">
                    <table>
                        <tr>
                            <td><img id="pouce" src="/img/couple.png"></td>
                            <td><img id="pouce" src="/img/justice.png"></td>
                            <td><img id="pouce" src="/img/homme.png"></td>
                        </tr>
                        <tr style= "font-weight: bold;">
                            <td>Soutenez</td>
                            <td>Valorisez</td>
                            <td>Créez</td>
                        </tr>
                        <tr>
                            <td>Un écosystème, l’innovation, la vulgarisation, le partage des connaissances</td>
                            <td>Votre marque, vos valeurs, vos actions, vos données</td>
                            <td>Des liens, des rencontres, des projets, des opportunités</td>
                        </tr>
                    </table>
                    </div>

                </div>

        </body>
</html>