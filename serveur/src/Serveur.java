import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpHandler;
import com.sun.net.httpserver.HttpServer;

import verificationCode.VerificateurCodePython;

import java.io.IOException;
import java.io.OutputStream;
import java.io.UnsupportedEncodingException;
import java.net.InetSocketAddress;
import java.net.URLDecoder;
import java.nio.charset.StandardCharsets;
import java.util.concurrent.ThreadPoolExecutor;
import java.util.HashMap;
import java.util.Map;
import java.util.concurrent.Executors;
import java.util.logging.Logger;
import java.util.stream.Stream;





public class Serveur {
    // logger pour trace
    private static final Logger LOGGER = Logger.getLogger( Serveur.class.getName() );
    private static final String SERVEUR = "localhost"; // url de base du service
    private static final int PORT = 8001; // port serveur
    private static final String URL = "/"; // url de base du service
    
    /** 
     * @param args
     */
    // boucle principale qui lance le serveur sur le port 8001, à l'url test
    public static void main(String[] args) {
        HttpServer server = null;
        try {
            server = HttpServer.create(new InetSocketAddress(SERVEUR, PORT), 0);

            server.createContext(URL, new  MyHttpHandler());
            ThreadPoolExecutor threadPoolExecutor = (ThreadPoolExecutor) Executors.newFixedThreadPool(10);
            server.setExecutor(threadPoolExecutor);
            server.start();
            LOGGER.info(" Server started on port " + PORT);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private static class MyHttpHandler implements HttpHandler {
        /**
         * Manage GET request param
         * @param httpExchange
         * @return la map de la get requete
         */
        private Map<String,String> handleGetRequest(HttpExchange httpExchange) throws UnsupportedEncodingException{
            String[] codedCoupleValues = httpExchange.getRequestURI()
                    .toString()
                    .split("\\?")[1]
                    .split("&");

            String[] codedValues = new String[(codedCoupleValues.length) *2];

            for (int i = 0; i < codedCoupleValues.length; i++) {
                String[] couple = codedCoupleValues[i].split("=");
                

                codedValues[2*i] = couple[0];
                codedValues[2*i+1] = couple[1];

            }

            // decode les valeurs données en paramètre 
            String[] decodedValues = new String[codedValues.length];

            for (int i = 0; i < decodedValues.length; i++) {
                if (i % 2 != 0) {
                    decodedValues[i] = URLDecoder.decode(codedValues[i],StandardCharsets.UTF_8.toString());
                }else {
                    decodedValues[i] = codedValues[i];
                }
            }

            
            Map<String,String> map = new HashMap<String,String>();
            
            if (decodedValues.length < 2) {
                return map;
            }

            String prev = decodedValues[0];
            for (int i = 1; i < decodedValues.length; i++) {
                if (i%2 != 0) {
                    map.put(prev, decodedValues[i]);
                }else {
                    prev = decodedValues[i];
                }
            }
            
            return map;
        }


        /** 
         * Genere un json avec les resultats de la verification de code
         * @param httpExchange
         * @param requestParamValue
         */
        private void handleResponseRendu(HttpExchange httpExchange, String requestParamValue)  throws  IOException {
            OutputStream outputStream = httpExchange.getResponseBody();

            String code = requestParamValue;

            String htmlResponse = (new VerificateurCodePython(code)).jsonResult();


           
            LOGGER.info(htmlResponse);

            // this line is a must
            httpExchange.sendResponseHeaders(200, htmlResponse.length());
            outputStream.write(htmlResponse.getBytes());
            outputStream.flush();
            outputStream.close();
        }
        
        /** 
         * Genere un json avec les resultats du calcul d'occurence dans le code
         * @param httpExchange
         * @param requestParamValue
         */
        private void handleResponseOccurence(HttpExchange httpExchange, Map<String,String> requestParamValue)  throws  IOException {
            OutputStream outputStream = httpExchange.getResponseBody();

            String code = requestParamValue.get("src_code");
            // le format de jsonStringOcc est "["x","y"...]"
            String jsonStringOcc = requestParamValue.get("occ"); 

            String[] strQuoted = jsonStringOcc.split("\\[")[1].split("\\]")[0].split(",");

            String[] strUnQuoted = Stream.of(strQuoted).map(str -> str.split("\"")[1].split("\"")[0]).toArray(String[]::new);



            String htmlResponse = (new VerificateurCodePython(code)).jsonOcc(strUnQuoted);


           
            LOGGER.info(htmlResponse);

            // this line is a must
            httpExchange.sendResponseHeaders(200, htmlResponse.length());
            outputStream.write(htmlResponse.getBytes());
            outputStream.flush();
            outputStream.close();
        }

        @Override
        public void handle(HttpExchange httpExchange) throws IOException {
            Map<String,String> requestParamValue=null;
            
            if("GET".equals(httpExchange.getRequestMethod())) {
                try {
                    requestParamValue = handleGetRequest(httpExchange);
                } catch (UnsupportedEncodingException e) {
                    return;
                }
            }else {
                return;
            }
            

            String endPoint = httpExchange.getRequestURI()
                    .toString()
                    .split("\\?")[0];

            // gere les differents end point
            if (endPoint.equals("/rendu")) {
                if (requestParamValue.containsKey("src_code")) handleResponseRendu(httpExchange,requestParamValue.get("src_code"));
            }else if (endPoint.equals("/occurence")){
                if (requestParamValue.containsKey("src_code") && requestParamValue.containsKey("occ")) handleResponseOccurence(httpExchange,requestParamValue);
            }

        }
    }
}