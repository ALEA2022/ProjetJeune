<!DOCTYPE html>
<html>
  <head>
    <title>Mon Site</title>
    <meta charset="UTF-8">
    <meta name="description" content="Description de mon site.">
    <meta name="keywords" content="Mots-clés, pour, mon, site.">
    <link rel="stylesheet" href="projetsite.css">
  </head>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var referentLink = document.querySelector('.referent');
      var consultantLink = document.querySelector('.consultant');
      var jeunesLink = document.querySelector('.jeunes');
      var administrateurLink = document.querySelector('.administrateur');

      // Fonction qui remplace le curseur par le symbole d'interdiction pour le lien référent
      function setForbiddenCursorReferent() {
        referentLink.classList.add('forbidden-cursor');
      }

      // Fonction qui restaure le curseur par défaut pour le lien référent
      function restoreDefaultCursorReferent() {
        referentLink.classList.remove('forbidden-cursor');
      }

      // Événement lorsque la souris entre dans la zone du lien référent
      referentLink.addEventListener('mouseenter', setForbiddenCursorReferent);

      // Événement lorsque la souris quitte la zone du lien référent
      referentLink.addEventListener('mouseleave', restoreDefaultCursorReferent);

      // Désactive le clic sur le lien référent
      referentLink.addEventListener('click', function(event) {
        event.preventDefault();
      });

      // Fonction qui remplace le curseur par le symbole d'interdiction pour le lien consultant
      function setForbiddenCursorConsultant() {
        consultantLink.classList.add('forbidden-cursor');
      }

      // Fonction qui restaure le curseur par défaut pour le lien consultant
      function restoreDefaultCursorConsultant() {
        consultantLink.classList.remove('forbidden-cursor');
      }

      // Événement lorsque la souris entre dans la zone du lien consultant
      consultantLink.addEventListener('mouseenter', setForbiddenCursorConsultant);

      // Événement lorsque la souris quitte la zone du lien consultant
      consultantLink.addEventListener('mouseleave', restoreDefaultCursorConsultant);

      // Désactive le clic sur le lien consultant
      consultantLink.addEventListener('click', function(event) {
        event.preventDefault();
      });
       // Fonction qui remplace le curseur par le symbole d'interdiction pour le lien "jeunes"
  function setForbiddenCursorJeunes() {
    jeunesLink.classList.add('forbidden-cursor');
  }

  // Fonction qui restaure le curseur par défaut pour le lien "jeunes"
  function restoreDefaultCursorJeunes() {
    jeunesLink.classList.remove('forbidden-cursor');
  }

  // Événement lorsque la souris entre dans la zone du lien "jeunes"
  jeunesLink.addEventListener('mouseenter', setForbiddenCursorJeunes);

  // Événement lorsque la souris quitte la zone du lien "jeunes"
  jeunesLink.addEventListener('mouseleave', restoreDefaultCursorJeunes);

  // Désactive le clic sur le lien "jeunes"
  jeunesLink.addEventListener('click', function(event) {
    event.preventDefault();
  });
  // Fonction qui remplace le curseur par le symbole d'interdiction pour le lien "administrateur"
  function setForbiddenCursorAdministrateur() {
    administrateurLink.classList.add('forbidden-cursor');
  }

  // Fonction qui restaure le curseur par défaut pour le lien "administrateur"
  function restoreDefaultCursorAdministrateur() {
    administrateurLink.classList.remove('forbidden-cursor');
  }

  // Événement lorsque la souris entre dans la zone du lien "administrateur"
  administrateurLink.addEventListener('mouseenter', setForbiddenCursorAdministrateur);

  // Événement lorsque la souris quitte la zone du lien "administrateur"
  administrateurLink.addEventListener('mouseleave', restoreDefaultCursorAdministrateur);

  // Désactive le clic sur le lien "administrateur"
  administrateurLink.addEventListener('click', function(event) {
    event.preventDefault();
  });
});
   
    
  </script>
  
  <body>
    
      
      <header class="top-bar">
        <div class="element">

          <img src="logoJeunes.png" alt="Image">
        </div>
        <footer>
          <p class="footer-text">Pour faire de l'engagement une valeur</p>
        </footer>
      </header>
       

        <ul class="menu">
          <li class="menuj">
            <a href="" class="jeunes">JEUNES</a>
          </li>
          <li class="menur">
            <a href="" class="referent">REFERENT</a>
          </li>
          <li class="menuc">
            <a href="" class="consultant">CONSULTANT</a>
          </li>
          <li class="menup">
            <a href="partenaires.php" class="partenaires">PARTENAIRES</a>
          </li>
          <li class="menua">
            <a href="" class="administrateur">ADMINISTRATEUR</a>
          </li>
        </ul>
        

        <div class="container">
          <div class="left">
            <p><span style="font-size: 25px";> De quoi s’agit-il ? <br> </span>
              D’une opportunité : celle qu’un engagement quel qu’il soit puisse être considéré à sa juste valeur ! Toute expérience est source d’enrichissement et doit être reconnue largement. Elle révèle un potentiel, l’expression d’un savoir-être à concrétiser. </p>
          </div>
          <div class="center">
            <p><span style="font-size: 25px";> A qui s'adresse-t-il ? <br></span>
              A vous, jeunes entre 16 et 30 ans, qui vous êtes investis spontanément dans une association ou dans tout type d’action formelle ou informelle, et qui avez partagé de votre temps, de votre énergie, pour apporter un soutien, une aide, une compétence. A vous, responsables de structures ou référents d’un jour, qui avez croisé la route de ces jeunes et avez bénéficié même ponctuellement de cette implication citoyenne ! C’est l’occasion de vous engager à votre tour pour ces jeunes en confirmant leur richesse pour en avoir été un temps les témoins mais aussi les bénéficiaires ! </p>
          </div>
          <div class="right">
            <p>A vous, employeurs, recruteurs en ressources humaines, représentants d’organismes de formation, qui recevez ces jeunes, pour un emploi, un stage, un cursus de qualification, pour qui le savoir-être constitue le premier fondement de toute capacité humaine. Cet engagement est une ressource à valoriser au fil d'un parcours en 3 étapes : </p>
            <p><span style="font-size: 16px";> Cet engagement est une ressource à valoriser au fil d'un parcours en 3 étapes : </span>
          </div>
        </div>
        <div class="frame-container">
          <div class="frame frame-1">
            <div class="inner-frame inner-frame-1">
              <p class="frame-text">1<sup>ère</sup> étape <br>la valorisation</p>
            </div>
            <p class="frame-textb">Décrivez votre experience et mettez en avant ce que vous en avez retiré.</p>
          </div>
          <div class="frame frame-2">
            <div class="inner-frame inner-frame-2">
              <p class="frame-text">2<sup>ème</sup> étape <br> la confirmation</p>
            </div>
            <p class="frame-textb">Confirmez cette expérience et ce que vous avez pu constater au contact de ce jeune.</p>
          </div>
          <div class="frame frame-3">
            <div class="inner-frame inner-frame-3">
              <p class="frame-text">3<sup>ème</sup> étape <br> la consultation</p>
            </div>
            <p class="frame-textb">Validez cet engagement en prenant en compte sa valeur.</p>
          </div>
        </div>
      
         <a href="crea.php" class="btn" id="signup">Inscription</a>
         
         <a href="connex.php" class="btn" id="signin">Connexion</a>


  </body>
</html>