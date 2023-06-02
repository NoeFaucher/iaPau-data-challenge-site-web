package verificationCode;


import java.util.ArrayList;
import java.util.LinkedList;
import java.util.regex.*;



public class VerificateurCodePython implements VerificateurCode{
    private String strCode;

    private ArrayList<String> lignes = new ArrayList<String>();
    private ArrayList<ArrayList<String>> fonctions = new ArrayList<ArrayList<String>>();

    public int nbLigne;
    public int nbFonction;

    /**
     * Constructeur du verificateur de code
     * @param strCode code source python
     */    
    public VerificateurCodePython(String strCode) {

        this.strCode = strCode;

        String[] tempslignes = this.strCode.split("\n"); 

        for (String ligne : tempslignes) {
            if (estValideLigne(ligne)) {
                String ligneSansCommentaire = ligne.replaceAll("#.*","");
                String ligneSansCommentaireSansTab = ligneSansCommentaire.replaceAll("\t"," ");
                lignes.add(ligneSansCommentaireSansTab);
            }
        }

        nbLigne = nbLigne();

        findFonctions();

        nbFonction = nbFonction();
    }

    /**
     * Fonction qui verifie si une ligne est valide
     * @param ligne String répresentant un ligne de code pyhton
     * @return true si la ligne est un ligne de code, false si la ligne est un commentaire ou est vide
     */
    private boolean estValideLigne(String ligne) {

        // Verifie si la ligne est vide ou si la ligne est un commentaire
        if (Pattern.matches("^\\s*", ligne) || Pattern.matches("^\\s*#.*", ligne)) {
            return false;
        }
        return true;
    }

    /**
     * 
     * @return
     */
    private void findFonctions() {
        LinkedList<Integer> indexFonctionQueue = new LinkedList<Integer>();

        // Ajoute dans la file l'indice de chaque début de fonction
        for (int i = 0; i < nbLigne; i++) {
            String ligne = lignes.get(i);

            if (Pattern.matches(".*\\bdef\\b.*", ligne)) {
                indexFonctionQueue.add(i);
            }
        }

        for (int indexFonction : indexFonctionQueue) {
            ArrayList<String> fonction = new ArrayList<String>();
            int index = indexFonction;
            fonction.add(lignes.get(index));
            int nombreIndentFonction = lignes.get(index+1).replaceAll("\\b\\S.*","").length();
            int nombreIndentLigne = nombreIndentFonction;
            index++;
            
            do {
                fonction.add(lignes.get(index));
                index++;

                if (index == nbLigne) break;

                nombreIndentLigne = lignes.get(index).replaceAll("\\b\\S.*","").length();
            }while (nombreIndentFonction <= nombreIndentLigne);

            fonctions.add(fonction);
        }
    }

    
    @Override
    public int nbLigne(){
        return lignes.size(); 
    }


    @Override
    public int nbFonction() {
        return fonctions.size(); 
    }


    @Override
    public int nbLigneMinFonction() {
        if (nbFonction == 0) {
            return 0;
        }

        int res = Integer.MAX_VALUE;
        for (ArrayList<String> fonction : fonctions) {
            if (fonction.size() < res) {
                res = fonction.size();
            }
        } 
        return res;
    }


    @Override
    public int nbLigneMaxFonction() {
        if (nbFonction == 0) {
            return 0;
        }

        int res = 0;
        
        for (ArrayList<String> fonction : fonctions) {
            if (fonction.size() > res) {
                res = fonction.size();
            }
        } 

        return res; 
    }


    @Override
    public double nbLigneMoyenFonction() {
        if (nbFonction == 0) {
            return 0;
        }

        double sum = 0;

        for (ArrayList<String> fonction : fonctions) {
            sum += fonction.size();
        } 


        return sum/nbFonction; 
    }


    @Override
    public int nbOccurences(String str) {
        return strCode.split(str,-1).length -1;
    }
    /** 
     *  Creer le json du nombre d'occurence des mots donnés
     * @param occs tableau de mots
     * @return le nombre d'occurence de chaque mot donné
     */
    public String jsonOcc(String[] occs){
        String res = "{";
        for (int i = 0; i < occs.length; i++) {
            
            res+=  "\""+occs[i]+"\" : "+ nbOccurences(occs[i]);

            if (i!=occs.length -1 ) {
                res += ',';
            }
        }

        res += "}";
        return res;
    }

    /**
     *  Creer le json des resultats de la verification
     * @return le resultat du code (nb de ligne, nb de fonction, nb ligne max,min,moyen dans les fonctions)
     */
    public String jsonResult() {
        return toString();
    }

    @Override
    public String toString() {
        String res = "{";

        res+=  "\"nbLigne\" : "+ nbLigne+",";
        res+=  "\"nbFonction\" : "+ nbFonction+",";
        res+=  "\"nbLigneMinFonction\" : "+ nbLigneMinFonction()+",";
        res+=  "\"nbLigneMaxFonction\" : "+ nbLigneMaxFonction()+",";
        res+=  "\"nbLigneMoyenFonction\" : "+ nbLigneMoyenFonction();



        res += "}";

        return res;
    }

    
}

