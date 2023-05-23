<p>Inscrivez-vous !</p>
<form method="POST">
    <div class="champ">   
        <label for="nom">Nom :</label>
        <input type="text" name="nom_participant" id="nom" required>
    </div>
    <div class="champ">   
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom_participant" id="prenom" required>
    </div>
    <div class="champ">   
        <label for="email">E-mail :</label>
        <input type="text" name="mail_participant" id="email" required>
    </div>
    <div class="champ">   
        <label for="niveau-etude">Niveau d'étude :</label>
        <select id="niveau-etude" name="niveau_etude_participant">
            <option value="L1">L1</option>
            <option value="L2">L2</option>
            <option value="L3">L3</option>
            <option value="M1">M1</option>
            <option value="M2">M2</option>
            <option value="D">D</option>
        </select>
    </div>
    <div class="champ">   
        <label for="ecole" id="ecole">École :</label><input type="text" name="ecole_participant">
    </div>
    <div class="champ">   
        <label for="ville" id="ville">Ville :</label><input type="text" name="ville_participant">
    </div>
    <button type="submit">S'inscrire</button>
</form>