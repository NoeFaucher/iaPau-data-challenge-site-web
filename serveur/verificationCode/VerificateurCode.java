package verificationCode;


public interface VerificateurCode {
    
    
    /**
     * 
     * @return int nombre ligne de code
     */
    public int nbLigne();

    /**
     * 
     * @return int nombre de fonction
     */
    public int nbFonction();

    /**
     * 
     * @return int
     */
    public int nbLigneMinFonction();
    
    /**
     * 
     * @return int
     */
    public int nbLigneMaxFonction();

    /**
     * 
     * @return double
     */
    public double nbLigneMoyenFonction();

    /**
     * 
     * @param str
     * @return int
     */
    public int nbOccurences(String str);

}
