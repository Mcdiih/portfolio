<!-- include le head et le header... -->
<?php include("top.php") ?>

<!-- le menu à gauche -->
<div class="menu-contenu">
    <nav class="menu">
        <div class="block">
                <div class="iconeMenu">MENU</div>
        </div>
        <div class="block">
            <a href="#profil" style="display: flex; flex-direction: row;">
                <div class="pageActuelle">Camille Desens</div>
            </a>
        </div>
        <div class="block">
            <a href="#parcours" style="display: flex; flex-direction: row;">
                <div>Parcours</div>
            </a>
        </div>
        <div class="block">
            <a href="#competences" style="display: flex; flex-direction: row;">
                <div>Compétences</div>
            </a>
        </div>
        <div class="block">
            <a href="#experiences" style="display: flex; flex-direction: row;">
                <div>Expériences</div>
            </a>
        </div>
        <div class="block">
            <a href="#contact" style="display: flex; flex-direction: row;">
                <div>Contact</div>
            </a>
        </div>
    </nav>


<!-- profil -->
    <div class="contenu">
        <div id="profil" class="profil">
            <div class="texte">
                <h3>« Ne pensez pas à l'échec,
                pensez aux opportunités que vous risquez de manquer
                si vous n'essayez pas. »
                </h3>
                <h5>- Jack Canfield</h5>
            </div>
            <div class="texte">
            Camille Desens, 27 ans.
            En reconversion professionnelle dans le monde de l'informatique et du developpement.
            Actuellement en Bachelor 1 Informatique.
            </div>
        </div>


<!-- parcours -->

        <div id="parcours" class="parcours">
            <div class="texte">
            <h3>2010 Bac scientifique S</h3>
            <h3>2010-2012 Prépa environnement</h3>
            <h3>2012-2013 Fac de biologie</h3>
            <h3>2013-2014 Formation Henriman</h3>
            <h3>2014-2019 Barmaid</h3>
            <h3>2019-2020 bachelor 1 DevOps</h3>
            </div>
        </div>


<!-- compétences -->

        <div id="competences" class="competences">
            <div class="texte">
                <h1>Mes Compétences techniques :</h1>
                Notion en Python, Html, CSS, 
                base de données et gestion de projets        

                <h1>Mes Compétences transverses :</h1>
                travail en équipe
                capacité à communiquer en anglais
                organisation de mon temps de travail
                autonomie
                capacité d’analyse
                communication
                méthodologie et respect des délais
            </div>
        </div>


<!-- expériences -->

        <div id="experiences" class="experiences">
            <div class="texte">
                <h1>Stage en entreprise :</h1>
                journée d’immersion
                entreprise ?

                <h1>Projet Campus Factory :</h1>
                Création en groupe d’une application 
                au sein de l’école Campus Academy
            </div>
        </div>


<!-- contact -->
<!-- on inclue la base de données -->
<?php 
    include("../bdd.php");
?>

<!-- ajouter un message -->
<?php
        //écrire ma requete SQL pour récupérer les messages
        $sql = "SELECT * FROM post";
    
        //envoyer la requete à MySQL
        $stmt = $pdo->prepare($sql);
    
        //exécuter la requete
        $stmt->execute();
    
        //récupérer le resultat avec ->fetch()
        $post = $stmt->fetchAll();
    ?>


    <?php 

    //pour appeler une fonction

    //function debug($var){
        //echo '<pre style="background-color: #000; color: lightgreen; padding: 100px;">';
        //print_r($var);
        //echo '</pre>';
    //}

    //debug($_POST);


    if(!empty($_POST)){
        $formIsValid = true;
        $nom = strip_tags($_POST['nom']);
        $prenom = strip_tags($_POST['prenom']);
        $email = strip_tags($_POST['email']);
        $entreprise = strip_tags($_POST['entreprise']);
        $message = strip_tags($_POST['message']);


        //tableau qui stocke nos éventuels messages derreur
        $errors = [];

        //si le nom est vide
        if(empty($nom)){
            $formIsValid = false;
            $errors[] = "Merci de remplir le champs \"Votre NOM\"";
        }

        //si le nom est trop court
        elseif(mb_strlen($nom) <= 1){
            $formIsValid = false;
            $errors[] = "Votre NOM est trop court";
        }    


        //si le nom est vide
        if(empty($prenom)){
            $formIsValid = false;
            $errors[] = "Merci de remplir le champs \"Votre PRENOM\"";
        }

        //si le nom est trop court
        elseif(mb_strlen($prenom) <= 1){
            $formIsValid = false;
            $errors[] = "Votre PRENOM est trop court";
        }   

        //validation de l'email
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $formIsValid = false;
            $errors[] = "Votre EMAIL n'est pas valide !";
        }

        //si le nom est vide
        if(empty($entreprise)){
            $formIsValid = false;
            $errors[] = "Merci de remplir le champs \"Votre ENTREPRISE\"";
        }   

        //si le champs du message est vide
        if(empty($message)){
            $formIsValid = false;
            $errors[] = "Merci d'écrire quelque chose dans le champs \"MESSAGE\" !!";
        }


        //si le formulaire est toujours valide
        if($formIsValid == true){
        $sql = "INSERT INTO post 
                (nom, prenom, email, entreprise, message, date)
                VALUES 
                (:nom, :prenom, :email, :entreprise, :message, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":nom" => $nom,
            ":prenom" => $prenom,
            ":email" => $email,
            ":entreprise" => $entreprise,
            ":message" => $message,
        ]);
        }

        //var_dump($_POST);
    }

  ?>
        <div id="contact" class="contact">
	        <div class="container">
		        <form method="post">
	                    <div> 
	                        <label for="nom"><h4>VOTRE NOM</h4></label>
	                        <input type="text" name="nom" id="nom">
                        </div>
                        <div> 
	                        <label for="prenom"><h4>VOTRE PRENOM</h4></label>
	                        <input type="text" name="prenom" id="prenom">
	                    </div>
	                    <div> 
	                        <label for="email"><h4>VOTRE EMAIL</h4></label>
	                        <input type="email" name="email" id="email">
                        </div>
                        <div> 
	                        <label for="entreprise"><h4>VOTRE ENTREPRISE</h4></label>
	                        <input type="text" name="entreprise" id="entreprise">
	                    </div>
	                    <div> 
	                        <label for="message"><h4>VOTRE MESSAGE</h4></label>
	                        <textarea name="message" id="message"></textarea>
	                    </div>
            
                <?php 
                    //affiche les éventuelles erreurs de validations
                    //if (!empty($errors)) {
                        //foreach ($errors as $error) {
                        //echo '<div>' . $error . '</div>';
                        //}
                    //}   
                ?>

	                <button>Envoyer !</button>
	            </form>
	        </div>
            




<!-- la liste des messages -->
            <div class="container">	
		        <form method="post">
                    <h3>Affichage des <?php echo count($post);?> messages.</h3>
                    <?php
                    foreach($post as $posts){
                        ?>
                        <h4> Message de <?php echo $posts['nom'] . ' ' . $posts['prenom'] ;?> (<?php echo $posts['entreprise']?> ) </h4>
                        <article class="message"> <?php echo $posts['message']?> </article> 
                        <h5> <?php ; echo $posts['date'] ?> </h5> <?php ;
                        }
                    ?>
	            </form>
            </div>
        </div>
    </div>
</div>

<!-- inclue le footer et les fermetures de balises -->
<?php include("bottom.php") ?>