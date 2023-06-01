   <?php
        $curent_user = $_SESSION["idUtilisateur "];
    ?>

    <script src="/js/messagerie.js"></script>


    <div id="selecteur-vision" >
        <label for="selecteur-vision">Selectionnez votre messagerie :</label>
        <select name="selecteur-vision" id="select-selecteur-vision" onchange="recuperationDestinataire();recuperationMessage()">

            <option value="1">GROUPE 1</option>
        </select>
    </div>
    <!-- div qui contient les messages -->
    <div class="message-conteneur" id="message-conteneur">
    </div>
    
    <!-- Formulaire d'evoie des messages -->
    <form id="messagerie-form" action="envoiMessage.php" method="post">

        <label for="objet">Objet:</label>
        <input type="text" name="objet" id="in-objet" required style="width:60%;> 

        <label for="list-destinataire">Destinataires:</label>

        <div class="gestion-destinataire">
            <input type="text" id="input-current-destinataire" name="list-destinataire" list="destinataires-list" autocomplete="on" style="width:60%;">
            <datalist id="destinataires-list">
            
            </datalist>
            <input type="button" value="Ajouter destinataire" onclick="ajouterDestinataire()">
            <p>
                Destinataires sélectionnés : 
                <span id="destinataire-selectionne">
                
                </span>
            </p>
            
            <input id="input-destinataires" type="hidden" name="destinataires" value="[]" required >

        </div>

    
        <label for="contenu">Message:</label>
        <textarea name="contenu" id="input-message" cols="30" rows="10" style="resize:none"></textarea>
        <input type="button" onclick="envoyerMessage()" value="Envoyer">
        
        <p id="retour-sur-envoi-mess"></p>

    </form>


    
