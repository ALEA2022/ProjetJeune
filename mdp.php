<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="crea.css">
    <title>Connexion</title>
</head>

<body>
    <div class="container">
        <img src="logoJeunes.png" alt="Image" class="logo">
        <form method="post" action="">
            <h4><i>Entrez votre mail</i></h4>
            <br><br> <br>
            <input type="text" name="email" placeholder="Email"><br>
            <input name="submit" type="submit" value="Envoyer"><br>
            <form action="connex.php" method="post">
            <input type="submit" name="connex" value="Se connecter"><br>
            </form>

        </form><br>
    </div>
    <?php
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/Exception.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    if (isset($_POST['connex'])) {
        header('Location:connex.php');
    }


    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        // Ouvrir le fichier CSV en lecture
        $file = fopen('comptes.csv', 'r');
        $trouvé=0;
        // Parcourir chaque ligne du fichier
        while (($data = fgetcsv($file)) !== FALSE) {
            // Vérifier si l'e-mail existe dans la première colonne
            if ($data[0] == $email) {
                    $mail = new PHPMailer(true);
                    try{ 
                        $mail->isSMTP();                                           
                        $mail->Host       = 'smtp.gmail.com';                  
                        $mail->Port       = 587;
                        $mail->SMTPAuth   = true;                                
                        $mail->Username   = 'mailjeunes6.4@gmail.com';                     
                        $mail->Password   = 'hlddoflplovfftkd';                              
                        $mail->SMTPSecure = 'tls'; 
                        
                        $mail->setFrom('mailjeunes6.4@gmail.com');
                        $mail->addAddress($email, 'alexandre');
                        $mail->Subject = 'Mot de passe oublie';
                        $mail->Body = 'Votre mot de passe est : '.$data[3];

                        $mail->SMTPOptions = array(
                            'ssl' => array (
                                'verify_peer' => false,
                                'verify_peer_name' =>false,
                                'allow_self_signed' =>true
                            )
                        );
                        $mail->send();
                        
                        echo"<p style='color: white; margin-top:40%; margin-left:-19%;'>Email envoyé</p>";

                    } 
                    catch(Exception $e) {
                        echo "<p style='color: white; margin-top:40%; margin-left:-19%;'>Erreur envoi </p>" . $mail->ErrorInfo;
                    
                    }
                    $trouvé=1;

                
                break;
            }
        }
        // Fermer le fichier CSV
        fclose($file);
        if($trouvé==0){
            echo "<p style='color: white; margin-top:40%; margin-left:-19%;'>Votre adresse mail est incorrecte</p>";
        }
    }
    ?>
</body>

</html>




