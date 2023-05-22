<?php 

    // le podium ne s'affiche que pour une data battle, pas pour les data challenges
    // il est accessible à tous, même aux utilisateurs non connectés
    if ($_SESSION["typeDataEvent"] == "battle") {

        // scores fictifs pour le moment
        $scorePremier = 20;
        $scoreSecond = 17;
        $scoreTroisieme = 14;

        $scoreRelatifSecond = $scoreSecond/$scorePremier;
        $scoreRelatifTroisieme = $scoreTroisieme/$scorePremier;

        $nomPremier = "Équipe 1";
        $nomSecond = "Équipe 2";
        $nomTroisieme = "Équipe 3";

        // titre de la section du podium
        echo "
        <div class='sous-titre-evenement'>
            <span>Podium de la semaine</span>
        </div>";
        
        // texte "d'introduction" du podium
        echo "
        <div id='texte-podium'>
            <p class='paragraphe-presentation'>".$loremIpsum."</p>
        </div>";

        // affichage du podium
        echo "
        <div id='podium'>
            <div id='seconde-place' class='place'>
                <div class='barre-score' id='barre-score-second' style='height: calc(".$scoreRelatifSecond."*300px - ".$scoreRelatifTroisieme."*200px + 100px);'></div>
                <div class='infos-score'>
                    <div class='rang'>
                        <span id='second'>2<sup>nd</sup></span>
                    </div>
                    <div class='nom-equipe'>
                        <span>".$nomSecond."</span>
                    </div>
                    <div class='score'>
                        <span>".$scoreSecond." points</span>
                    </div>
                </div>
            </div>
            <div id='premiere-place' class='place'>
                <div class='barre-score' id='barre-score-premier' style='height: calc(300px - ".$scoreRelatifTroisieme."*200px + 100px);'></div>
                <div class='infos-score'>
                    <div class='rang'>
                        <span id='premier'>1<sup>er</sup></span>
                    </div>
                    <div class='nom-equipe'>
                        <span>".$nomPremier."</span>
                    </div>
                    <div class='score'>
                        <span>".$scorePremier." points</span>
                    </div>
                </div>
            </div>
            <div id='troisieme-place' class='place'>
                <div class='barre-score' id='barre-score-troisieme' style='height: calc(".$scoreRelatifTroisieme."*300px - ".$scoreRelatifTroisieme."*200px + 100px);'></div>
                <div class='infos-score'>
                    <div class='rang'>
                        <span id='troisieme'>3<sup>e</sup></span>
                    </div>
                    <div class='nom-equipe'>
                        <span>".$nomTroisieme."</span>
                    </div>
                    <div class='score'>
                        <span>".$scoreTroisieme." points</span>
                    </div>
                </div>
            </div>
        </div>";
        
    }
   
?>