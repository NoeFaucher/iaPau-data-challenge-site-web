<!DOCTYPE html>
<html
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/css/accueil.css">
        <title>Accueil - IA Pau</title>
    </head>
        <body>
            <img id="atriumImg" src="/img/atrium.JPG" alt="atrium">


            <div id="content">
                <div>
                    <img id="logoA" src="/img/iapau_round.png" alt="logo">
                </div>
                <h1>Courte présentation de l'association...</h1>     
             </div>
             <div id="content2">
                <p>Lorem ipsum dolor sit esn facilis. Maias placeat iusto enim saepe, atque accusamus quibusdam incidunt nesciunt dolore sint labore quae quas. Voluptatum accusantium explicabo, dolore consectetur eos et amet consequatur consequuntur eum esse error nulla dolores assumenda quod id velit quibusdam temporibus! Eveniet tempora excepturi, enim minima, numquam, suscipit ad itaque explicabo vitae tenetur maxime iure labore quae delectus praesentium impedit quis aut recusandae aliquid debitis animi voluptatum aliquam nostrum. Iste perferendis veniam ipsam fugiat odit corrupti doloribus necessitatibus! Voluptatem, harum qui? Ad magni perferendis porro minima, ex, officia ipsam nihil ea nemo facere iure explicabo ab, veniam aliquid et culpa excepturi corporis! Tempora numquam nam ipsum sequi. Numquam vero, natus perspiciatis pariatur unde debitis ipsum dolorem earum eaque dignissimos est ullam eligendi expedita aperiam ipsam praesentium sunt blanditiis reiciendis commodi placeat. Nobis quibusdam iure, possimus fuga cum voluptate nihil itaque a, et obcaecati fugit corrupti pariatur tempora veritatis, eaque minus ea voluptatum assumenda consequatur provident alias. Dicta dolores, animi, ut eum ipsa, commodi soluta sit deserunt consequatur exercitationem aut.</p>
            </div>zit amet consectetur, adipisicing elit. Excepturi debitis cum modi doloremque odio voluptas dolores mollitia possimus alias fuga! Incidunt tempore sint voluptatum ullam iste quam perspiciatis reiciendis quasi voluptatibus voluptate? Eum voluptatum id at qui quos rem, sed earum quia ad, quisquam voluptatibus distinctio ullam labore ex provident dolorum necessitatibus voluptate repellendus velit tempora delectus perspiciatis, assumenda in sequi. Suscipit accusantium natus maxime nobis saepe quis voluptatum officia. Quasi a aspernatur ipsa sapiente sit! Molestiae sapiente fuga tempora facere totam! Exercitationem distinctio eligendi, porro rerum quo impedit eius consequatur aperiam autem odio possimus esse. Hic asperiores exercitationem corrupti.
                </p>
                <br>
                <a href="/php/liste-data-events.php?typeDataEvent=challenge" id="btnDataChall">nos data challenges</a>
                <?php if($_SESSION["estConnecte"]) : ?>
                    <a href="/php/connexion/deconnexion.php" id="btnDataChall">Déconnexion</a>
                <?php else: ?>
                    <a href="/php/connexion/connexion.php" id="btnDataChall">Se connecter</a>
                    <a href="/php/connexion/inscription.php" id="btnDataChall">S'inscrire</a>
                <?php endif ?>
            </div>
            <img id="pyr" src="/img/pyrenee.webp" alt="pyrenee" >


        </body>
</html>