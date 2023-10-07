<?php
class HomeView
{
    public function show($data): void
    {
        ob_start();
        ?>
        <!--<p>-->
        <!--    Home Page WIP<br>-->
        <!--    You are logged in as --><?php //echo $data['name'] ?><!--<br>-->
        <!--    Email: --><?php //echo $data['email'] ?>
        <!--    Number: --><?php //echo $data['phone'] ?>
        <!--    Location: --><?php //echo $data['location'] ?>
        <!--    Gender: --><?php //echo $data['gender'] ?>
        <!--    Admin Status: --><?php //echo $data['admin'] ?>
        <!--    Last connection: --><?php //echo $data['lastco'] ?>
        <!--</p>-->
        <head>
            <link rel="stylesheet" href="/assets/styles/home.css">
        </head>
        <body>
        <div id="marginLeft"></div>
        <div id="center">
            <img src="assets/images/logoblanc.png" id="logo" alt="Logo pasX" width="50" height="60">
            <div id="posts">
                <p>Bacon ipsum dolor amet rump ball tip pig, ham hock pork chop drumstick leberkas pastrami biltong beef ribs sausage venison tongue spare ribs. Ham hock short ribs shoulder, venison turducken beef leberkas shankle kevin pork boudin ground round landjaeger salami meatball. Rump capicola fatback meatloaf meatball hamburger jowl biltong. Beef beef ribs meatloaf, frankfurter ham andouille tenderloin tail shankle ball tip. Alcatra bresaola ham prosciutto brisket chuck, beef ribs buffalo. Short loin brisket pancetta ground round, tail salami beef. Pork t-bone shank, corned beef ball tip doner pig meatball tongue fatback flank picanha beef boudin jerky.

                    Prosciutto flank meatball frankfurter. Venison landjaeger sirloin buffalo pork chop sausage, kielbasa porchetta picanha meatloaf shankle corned beef chislic. Bacon spare ribs sirloin beef kielbasa bresaola, chislic picanha shoulder. Jerky turkey rump sausage meatloaf tail jowl tongue fatback cupim t-bone flank spare ribs strip steak.

                    Landjaeger pastrami beef, burgdoggen ham hock buffalo chicken fatback drumstick capicola frankfurter chislic. Beef ribs tenderloin chislic filet mignon chicken venison spare ribs tongue. Tri-tip brisket chislic, strip steak fatback shankle pig beef pork kevin sausage. Pork chop brisket picanha, cupim tri-tip rump tongue alcatra short ribs andouille buffalo pastrami leberkas. Beef pork tenderloin andouille biltong. Meatloaf pork pork belly tenderloin bacon beef ribs kielbasa jerky boudin shoulder jowl tail. Short ribs pastrami chislic, buffalo pork chop spare ribs tongue strip steak chicken jerky.

                    Ribeye pork loin kielbasa meatball chuck shankle ground round biltong flank picanha pork chop. Pork capicola pork belly, filet mignon pastrami ball tip fatback swine shankle doner ham. Meatball venison beef ham jowl jerky sausage beef ribs alcatra biltong chicken pork brisket. Turducken tail venison kielbasa bresaola. Capicola drumstick tail ground round boudin doner.

                    Tri-tip hamburger porchetta buffalo tail, venison cupim ball tip meatloaf meatball fatback. Picanha pig capicola tail t-bone. Short loin corned beef porchetta ham, pork loin pork belly jerky. Short ribs ribeye pork chop, doner prosciutto shank corned beef andouille landjaeger. Swine cow buffalo jowl filet mignon kielbasa pork corned beef drumstick pancetta pork chop salami.
                    Bacon ipzarezal tip pig, ham hock pork chop drumstick leberkas pastrami biltong beef ribs sausage venison tongue spare ribs. Ham hock short ribs shoulder, venison turducken beef leberkas shankle kevin pork boudin ground round landjaeger salami meatball. Rump capicola fatback meatloaf meatball hamburger jowl biltong. Beef beef ribs meatloaf, frankfurter ham andouille tenderloin tail shankle ball tip. Alcatra bresaola ham prosciutto brisket chuck, beef ribs buffalo. Short loin brisket pancetta ground round, tail salami beef. Pork t-bone shank, corned beef ball tip doner pig meatball tongue fatback flank picanha beef boudin jerky.

                    Prosciutto flank meatball frankfurter. Venison landjaeger sirloin buffalo pork chop sausage, kielbasa porchetta picanha meatloaf shankle corned beef chislic. Bacon spare ribs sirloin beef kielbasa bresaola, chislic picanha shoulder. Jerky turkey rump sausage meatloaf tail jowl tongue fatback cupim t-bone flank spare ribs strip steak.

                    Landjaeger pastrami beef, burgdoggen ham hock buffalo chicken fatback drumstick capicola frankfurter chislic. Beef ribs tenderloin chislic filet mignon chicken venison spare ribs tongue. Tri-tip brisket chislic, strip steak fatback shankle pig beef pork kevin sausage. Pork chop brisket picanha, cupim tri-tip rump tongue alcatra short ribs andouille buffalo pastrami leberkas. Beef pork tenderloin andouille biltong. Meatloaf pork pork belly tenderloin bacon beef ribs kielbasa jerky boudin shoulder jowl tail. Short ribs pastrami chislic, buffalo pork chop spare ribs tongue strip steak chicken jerky.

                    Ribeye pork loin kielbasa meatball chuck shankle ground round biltong flank picanha pork chop. Pork capicola pork belly, filet mignon pastrami ball tip fatback swine shankle doner ham. Meatball venison beef ham jowl jerky sausage beef ribs alcatra biltong chicken pork brisket. Turducken tail venison kielbasa bresaola. Capicola drumstick tail ground round boudin doner.

                    Tri-tip hamburger porchetta buffalo tail, venison cupim ball tip meatloaf meatball fatback. Picanha pig capicola tail t-bone. Short loin corned beef porchetta ham, pork loin pork belly jerky. Short ribs ribeye pork chop, doner prosciutto shank corned beef andouille landjaeger. Swine cow buffalo jowl filet mignon kielbasa pork corned beef drumstick pancetta pork chop salami.
                    Bacon ipsum dolor amet rump ball tip pig, ham hock pork chop drumstick leberkas pastrami biltong beef ribs sausage venison tongue spare ribs. Ham hock short ribs shoulder, venison turducken beef leberkas shankle kevin pork boudin ground round landjaeger salami meatball. Rump capicola fatback meatloaf meatball hamburger jowl biltong. Beef beef ribs meatloaf, frankfurter ham andouille tenderloin tail shankle ball tip. Alcatra bresaola ham prosciutto brisket chuck, beef ribs buffalo. Short loin brisket pancetta ground round, tail salami beef. Pork t-bone shank, corned beef ball tip doner pig meatball tongue fatback flank picanha beef boudin jerky.

                    Prosciutto flank meatball frankfurter. Venison landjaeger sirloin buffalo pork chop sausage, kielbasa porchetta picanha meatloaf shankle corned beef chislic. Bacon spare ribs sirloin beef kielbasa bresaola, chislic picanha shoulder. Jerky turkey rump sausage meatloaf tail jowl tongue fatback cupim t-bone flank spare ribs strip steak.

                    Landjaeger pastrami beef, burgdoggen ham hock buffalo chicken fatback drumstick capicola frankfurter chislic. Beef ribs tenderloin chislic filet mignon chicken venison spare ribs tongue. Tri-tip brisket chislic, strip steak fatback shankle pig beef pork kevin sausage. Pork chop brisket picanha, cupim tri-tip rump tongue alcatra short ribs andouille buffalo pastrami leberkas. Beef pork tenderloin andouille biltong. Meatloaf pork pork belly tenderloin bacon beef ribs kielbasa jerky boudin shoulder jowl tail. Short ribs pastrami chislic, buffalo pork chop spare ribs tongue strip steak chicken jerky.

                    Ribeye pork loin kielbasa meatball chuck shankle ground round biltong flank picanha pork chop. Pork capicola pork belly, filet mignon pastrami ball tip fatback swine shankle doner ham. Meatball venison beef ham jowl jerky sausage beef ribs alcatra biltong chicken pork brisket. Turducken tail venison kielbasa bresaola. Capicola drumstick tail ground round boudin doner.

                    Tri-tip hamburger porchetta buffalo tail, venison cupim ball tip meatloaf meatball fatback. Picanha pig capicola tail t-bone. Short loin corned beef porchetta ham, pork loin pork belly jerky. Short ribs ribeye pork chop, doner prosciutto shank corned beef andouille landjaeger. Swine cow buffalo jowl filet mignon kielbasa pork corned beef drumstick pancetta pork chop salami.
                    Bacon ipsum dolor amet rump ball tip pig, ham hock pork chop drumstick leberkas pastrami biltong beef ribs sausage venison tongue spare ribs. Ham hock short ribs shoulder, venison turducken beef leberkas shankle kevin pork boudin ground round landjaeger salami meatball. Rump capicola fatback meatloaf meatball hamburger jowl biltong. Beef beef ribs meatloaf, frankfurter ham andouille tenderloin tail shankle ball tip. Alcatra bresaola ham prosciutto brisket chuck, beef ribs buffalo. Short loin brisket pancetta ground round, tail salami beef. Pork t-bone shank, corned beef ball tip doner pig meatball tongue fatback flank picanha beef boudin jerky.

                    Prosciutto flank meatball frankfurter. Venison landjaeger sirloin buffalo pork chop sausage, kielbasa porchetta picanha meatloaf shankle corned beef chislic. Bacon spare ribs sirloin beef kielbasa bresaola, chislic picanha shoulder. Jerky turkey rump sausage meatloaf tail jowl tongue fatback cupim t-bone flank spare ribs strip steak.

                    Landjaeger pastrami beef, burgdoggen ham hock buffalo chicken fatback drumstick capicola frankfurter chislic. Beef ribs tenderloin chislic filet mignon chicken venison spare ribs tongue. Tri-tip brisket chislic, strip steak fatback shankle pig beef pork kevin sausage. Pork chop brisket picanha, cupim tri-tip rump tongue alcatra short ribs andouille buffalo pastrami leberkas. Beef pork tenderloin andouille biltong. Meatloaf pork pork belly tenderloin bacon beef ribs kielbasa jerky boudin shoulder jowl tail. Short ribs pastrami chislic, buffalo pork chop spare ribs tongue strip steak chicken jerky.

                    Ribeye pork loin kielbasa meatball chuck shankle ground round biltong flank picanha pork chop. Pork capicola pork belly, filet mignon pastrami ball tip fatback swine shankle doner ham. Meatball venison beef ham jowl jerky sausage beef ribs alcatra biltong chicken pork brisket. Turducken tail venison kielbasa bresaola. Capicola drumstick tail ground round boudin doner.

                    Tri-tip hamburger porchetta buffalo tail, venison cupim ball tip meatloaf meatball fatback. Picanha pig capicola tail t-bone. Short loin corned beef porchetta ham, pork loin pork belly jerky. Short ribs ribeye pork chop, doner prosciutto shank corned beef andouille landjaeger. Swine cow buffalo jowl filet mignon kielbasa pork corned beef drumstick pancetta pork chop salami.</p>
            </div>
        </div>
        <div id="right_informations">
            photo de profil du mec
            <?php echo $data['name']?>
            <?php include('partials/navbar.php')?>
        </div>
        </body>
        <?php
    }
}
?>
