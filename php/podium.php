<?php 
    // scores fictifs pour le moment
    $scorePremier = 10;
    $scoreSecond = 9;
    $scoreTroisieme = 8;

    $scoreRelatifSecond = $scoreSecond/$scorePremier;
    $scoreRelatifTroisieme = $scoreTroisieme/$scorePremier;

    $nomPremier = "DMF";
    $nomSecond = "PFC";
    $nomTroisieme = "MPG";

    echo "
    <div id='podium'>
        <div id='seconde-place' class='place'>
            <div class='barre-score' id='barre-score-second' style='height: calc(".$scoreRelatifSecond."*300px - ".$scoreRelatifTroisieme."*200px + 100px);'></div>
            <div class='infos-score'>
                <div class='rang'>
                    <span>2nd</span>
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
                    <span>1er</span>
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
                    <span>3eme</span>
                </div>
                <div class='nom-equipe'>
                    <span>".$nomTroisieme."</span>
                </div>
                <div class='score'>
                    <span>".$scoreTroisieme." points</span>
                </div>
            </div>
        </div>";
?>