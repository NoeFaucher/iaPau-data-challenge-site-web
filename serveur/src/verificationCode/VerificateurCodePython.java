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

        for (String ligne : this.strCode.split("\n")) {
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



    // public static void main(String[] args) {
    //     String code = "async def addition(a, b):\n    return a + b\n\ndef soustraction(a, b):\n    return a - b\n\ndef multiplication(a, b):\n    return a * b\n\ndef division(a, b):\n    return a / b\n\ndef calculatrice():\n    def modulo(a, b):\n        return a % b\n    \n    def puissance(a, b):\n        return a ** b\n\n    print('Bienvenue dans la calculatrice !')\n    print('Veuillez choisir une opération :')\n    print('1. Addition')\n    print('2. Soustraction')\n    print('3. Multiplication')\n    print('4. Division')\n    print('5. Modulo')\n    print('6. Puissance')\n\n    choix = int(input('Entrez votre choix : '))\n\n    if choix == 1:\n        num1 = float(input('Entrez le premier nombre : '))\n        num2 = float(input('Entrez le deuxième nombre : '))\n        resultat = addition(num1, num2)\n        print('Le résultat de l\'addition est :', resultat)\n    elif choix == 2:\n        num1 = float(input('Entrez le premier nombre : '))\n        num2 = float(input('Entrez le deuxième nombre : '))\n        resultat = soustraction(num1, num2)\n        print('Le résultat de la soustraction est :', resultat)\n    elif choix == 3:\n        num1 = float(input('Entrez le premier nombre : '))\n        num2 = float(input('Entrez le deuxième nombre : '))\n        resultat = multiplication(num1, num2)\n        print('Le résultat de la multiplication est :', resultat)\n    elif choix == 4:\n        num1 = float(input('Entrez le premier nombre : '))\n        num2 = float(input('Entrez le deuxième nombre : '))\n        resultat = division(num1, num2)\n        print('Le résultat de la division est :', resultat)\n    elif choix == 5:\n        num1 = int(input('Entrez le premier nombre : '))\n        num2 = int(input('Entrez le deuxième nombre : '))\n        resultat = modulo(num1, num2)\n        print('Le résultat du modulo est :', resultat)\n    elif choix == 6:\n        num1 = float(input('Entrez le premier nombre : '))\n        num2 = float(input('Entrez le deuxième nombre : '))\n        resultat = puissance(num1, num2)\n        print('Le résultat de la puissance est :', resultat)\n    else:\n        print('Choix invalide. Veuillez réessayer.')\n\ncalculatrice()";


    //     VerificateurCodePython vcp = new VerificateurCodePython(code);
    
    //     // System.out.println(vcp.nbFonction);
    //     // System.out.println(vcp.nbFonction);

    //     // System.out.println("Nb ligne Fonction MAX : " + vcp.nbLigneMaxFonction());
    //     // System.out.println("Nb ligne Fonction MIN : " + vcp.nbLigneMinFonction());
    //     // System.out.println("Nb ligne Fonction moyen : " + vcp.nbLigneMoyenFonction());
        
    //     System.out.println(vcp);

        
    // }

    
}

