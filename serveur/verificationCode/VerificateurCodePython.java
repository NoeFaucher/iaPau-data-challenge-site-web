package verificationCode;

import java.util.ArrayList;
import java.util.regex.*;


public class VerificateurCodePython implements VerificateurCode{
    private String strCode;

    private ArrayList<String> lignes = new ArrayList<String>();
    private ArrayList<ArrayList<String>> fonctions = new ArrayList<ArrayList<String>>();

    public int nbLigne;
    public int nbFonction;

    /**
     * 
     * @param strCode code source python
     */    
    public VerificateurCodePython(String strCode) {
        this.strCode = strCode;

        for (String ligne : this.strCode.split("\n")) {
            if (estValideLigne(ligne))
                lignes.add(ligne);
        }

        nbLigne = nbLigne();





    }

    private boolean estValideLigne(String ligne) {
        if (ligne == "" ) {
            return false;
        }

        return true;
    }
    
    /** 
     * @return int
     */
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


    @Override
    public String toString() {
        String json = "{}";

        return strCode;
    }




    public static void main(String[] args) {
        VerificateurCodePython vcp = new VerificateurCodePython("def on_reaction_add(reaction, user):\n\tif user == client.user:\n\t\treturn\n\tif reaction.message.id != id_mess_react :\n\t\treturn\n\tif reaction.emoji.id == 1041748771790397470:\n\t\trole = discord.utils.get(user.guild.roles, name=\"Apprenti Technicien\")\n\t\tawait user.add_roles(role)\nclient.run(\"MTA0NDIyMDk1NjE2MTM2Mzk5OA.GDDK_7.rK0WfdRyEtSxKo0SfRI0rHQc2qTXJnCGtQEuaw\")");
    
        // System.out.println(vcp.nbFonction);
        System.out.println(vcp.nbOccurences("="));
        
    
    }

    
}

