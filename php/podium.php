<?php 

    // le podium ne s'affiche que pour une data battle, pas pour les data challenges
    // il est accessible à tous, même aux utilisateurs non connectés
    if ($_SESSION["typeDataEvent"] == "DataBattle") {

        // scores relatifs
        $scoreRelatifSecond = $resultatScoresEquipes[1]["score"]/$resultatScoresEquipes[0]["score"];
        $scoreRelatifTroisieme = $resultatScoresEquipes[2]["score"]/$resultatScoresEquipes[0]["score"];

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
                <div class='barre-score' id='barre-score-second' style='height: calc(".$scoreRelatifSecond."*300px - ".$scoreRelatifTroisieme."*200px + 50px);'></div>
                <div class='infos-score'>
                    <div class='rang'>
                        <span id='second'>2<sup>nd</sup></span>
                    </div>
                    <div class='nom-equipe'>
                        <span>".$resultatScoresEquipes[1]["nomEquipe"]."</span>
                    </div>
                    <div class='score'>
                        <span>".$resultatScoresEquipes[1]["score"]." points</span>
                    </div>
                </div>
            </div>
            <div id='premiere-place' class='place'>
                <div class='barre-score' id='barre-score-premier' style='height: calc(300px - ".$scoreRelatifTroisieme."*200px + 50px);'></div>
                <div class='infos-score'>
                    <div class='rang'>
                        <span id='premier'>1<sup>er</sup></span>
                    </div>
                    <div class='nom-equipe'>
                        <span>".$resultatScoresEquipes[0]["nomEquipe"]."</span>
                    </div>
                    <div class='score'>
                        <span>".$resultatScoresEquipes[0]["score"]." points</span>
                    </div>
                </div>
            </div>
            <div id='troisieme-place' class='place'>
                <div class='barre-score' id='barre-score-troisieme' style='height: calc(".$scoreRelatifTroisieme."*300px - ".$scoreRelatifTroisieme."*200px + 50px);'></div>
                <div class='infos-score'>
                    <div class='rang'>
                        <span id='troisieme'>3<sup>e</sup></span>
                    </div>
                    <div class='nom-equipe'>
                        <span>".$resultatScoresEquipes[2]["nomEquipe"]."</span>
                    </div>
                    <div class='score'>
                        <span>".$resultatScoresEquipes[2]["score"]." points</span>
                    </div>
                </div>
            </div>
        </div>";
        
    }
   
?>