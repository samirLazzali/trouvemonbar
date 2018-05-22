<?php
// Start Session
session_start();

// Application library ( with Library class )
require __DIR__ . '/library.php'; // Ce situe dans le meme dossier que index.php
$app = new Library();

$register_error_message = '';

if (!empty($_POST['btnRegister'])) {
        if ($_POST['name'] == "") {
        $register_error_message = 'Name field is required!';
        } else if ($_POST['email'] == "") {
        $register_error_message = 'Email field is required!';
        } else if ($_POST['username'] == "") {
        $register_error_message = 'Username field is required!';
        } else if ($_POST['password'] == "") {
        $register_error_message = 'Password field is required!';
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $register_error_message = 'Invalid email address!';
        } else if ($app->isEmail($_POST['email'])) {
        $register_error_message = 'Email is already in use!';
        } else if ($app->isUsername($_POST['username'])) {
        $register_error_message = 'Username is already in use!';
        }else {
        $user_id = $app->Register($_POST['name'], $_POST['email'], $_POST['username'], $_POST['password'] , 'member');
        // set session and redirect user to the profile page
        $_SESSION['user_id'] = $user_id;
        header("Location: profile.php");
        }
}
?>


<!DOCTYPE html>

<html lang="fr">


<?php
$title = "HealtCare";
include("head.php"); ?>

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    </head>


<body class="body--black">

<!-- barre de navigation / navbar -->
<?php include('navMenu.php') ?>


<!-- header section -->
<section class="home-head home-head--black cc-4 ">
    <div class="container cc-2 cc-hp">
        <div class="hp-head cc-video">
            <div class="hp-head__copy cc-2">
                <h1 class="hp-head-headline">Nous vous venons en aide </h1>
                <p class="hp-head-subhead">Vous n'avez plus a vous inquiéter de savoir quoi manger, ou quoi boire, nous vous aidons a choisir en fonction de ce que vous avez besoin</p>
            </div>

            <div class="form-wrap form-wrap__horizontal cc-hp w-form">

                <form action="index.php" method="POST" name="Home-Form" data-name="Home Form " autocomplete="off" class="sign-up-form sign-up-form__horizontal">
                    <div class="input-wrapper input-wrapper--horizontal">
                        <div class="float-label">Nom Complet</div>

                        <input type="text" class="form-input form-input__on-black w-input" maxlength="256" name="name" data-name="Name" placeholder="Name: James Smith">

                    </div>
                    <div class="input-wrapper input-wrapper--horizontal">
                        <div class="float-label">Nom utilisateur</div>

                        <input type="text" class="form-input form-input__on-black w-input" maxlength="256" name="username" data-name="Name" placeholder="Username: Isssssouuu">

                    </div>

                    <div class="input-wrapper input-wrapper--horizontal">
                        <div class="float-label">Adresse mail</div>

                        <input type="email" class="form-input form-input__on-black w-input" autocomplete="off" maxlength="256" name="email" data-name="Email" placeholder="something@mail.com" required>

                    </div>

                    <div class="input-wrapper input-wrapper--horizontal">
                        <div class="float-label">Mot de passe</div>
                        <input type="password" class="form-input form-input__on-black w-input" autocomplete="off" maxlength="256" name="password" data-name="Password" placeholder="mot de passe" required>

                        <div class="validator">
                            <div class="tooltip-arrow"></div>
                            <div>Too ez mamen</div>
                        </div>
                    </div>

                    <input type="submit" name="btnRegister" value="commencer gratuitement" data-wait="Creating account..." wait="Creating account..." class="button home-head-form-button w-button" value="Register">

                    <div class="tos-copy right">En vous inscrivant vous accepter nos <a target="_blank" href="https://healthcare.ensiie.fr/terms" class="tos-link">Terms of Service</a></div>

                </form>

                <div class="w-form-done">
                    <p>Bravo! Vous faite maintenannt partit de notre grande famille !</p>
                </div>
                <div class="w-form-fail">
                    <p>Oops! Un probleme est survenue</p>
                </div>
            </div>

            <div class="trusted-by__logos cc-under-form">
                <img src="/File/partenariat/foodb.png" width="80" alt="" class="trusted-by__logo">

                <img src="/File/partenariat/ensiie.png" width="70" alt="" class="trusted-by__logo">

                <img src="/File/partenariat/evry.jpg" width="60" alt="" class="trusted-by__logo">

                <img src="/File/partenariat/AVF.png" width="80" alt="" classs="trusted-by__logo">

                <img src="/File/partenariat/valkyriie.png" width="80" alt="" class="trusted-by__logo">
            </div>
        </div>
    </div>
</section>


<!-- video presentation -->
<section class="home-head home-head--black cc-3">
    <div class="container cc-2 cc-hp">
        <div class="hp-head cc-video">

            <div class="ui__wrap screenshot cc-hp-vid-center w-embed">
                <video playsinline="" loop="" style="max-width: 100%; max-height: 100%; display: block; overflow: hidden; border-radius: 5px;" poster="/File/image/example-dashboard.jpg">
                    <source src="/File/image/Vegetable%20footage%20(youtubemp4.to).mp4" type="video/mp4">
                </video>
            </div>

            <div class="hp-buttons__wrap">
                <a href="https://healthcare.ensiie.fr/" class="hp-view-btn cc-dark w-inline-block">
                    <div class="hp-view-btn__icon cc-1-light"></div>
                    <div class="hp-view-btn__text">Decouvrer notre application</div>
                </a>
                <a href="https://healtcare.ensiie.fr/" target="_blank" class="hp-view-btn cc-dark cc-3 w-inline-block">
                    <div class="hp-view-btn__icon cc-2-light"></div>
                    <div class="hp-view-btn__text">En savoir plus</div>
                </a>
            </div>


        </div>
    </div>
</section>



<!-- Price Table -->
<section class="section-flex-center cc-pricing-home">
    <div class="container cc-pricing-home">
        <div class="pricing-home-inner">
            <a href="healthcare.ensiie.fr" class="pricing-panel pricing-panel--link w-inline-block">
                <div class="pricing-panel__top"><img src="/File/image/entry_table_price.png" width="100" alt="Personel">
                    <h4 class="pricing_black-text">Personel</h4>
                    <p class="pricing-panel__desc pricing-panel-home">Gratuit et sans aucune charge supplementaire</p>
                    <div class="pricing-panel__feature-wrap">
                        <div class="pricing-panel__feature pricing-panel-home">
                            <p class="pricing-panel__feature-text">Recherche dans notre base de donnée</p>
                        </div>
                        <div class="pricing-panel__feature pricing-panel-home">
                            <p class="pricing-panel__feature-text">Determination de vos carence</p>
                        </div>
                        <div class="pricing-panel__feature pricing-panel-home">
                            <p class="pricing-panel__feature-text">Constitution d'un menu personalisé</p>
                        </div>
                    </div>
                </div>
                <div class="button stretch pricing">
                    <div class="button__text">Gratuit</div>
                </div>
            </a>

            <a href="healthcare.ensiie.fr" class="pricing-panel pricing-panel--link w-inline-block">
                <div class="pricing-panel__top"><img src="/File/image/dessert_table_price.png" width="100" alt="Medecin">
                    <h4 class="pricing_black-text">Médecin &amp; Professionel</h4>

                    <p class="pricing-panel__desc pricing-panel-home">Pour les professionel de santé</p>
                    <div class="pricing-panel__feature-wrap">
                        <div class="pricing-panel__feature pricing-panel-home">
                            <p class="pricing-panel__feature-text">Recherche dans notre base de donnée</p>
                        </div>
                        <div class="pricing-panel__feature pricing-panel-home">
                            <p class="pricing-panel__feature-text">Determination de vos carence</p>
                        </div>
                        <div class="pricing-panel__feature pricing-panel-home">
                            <p class="pricing-panel__feature-text">Constitution d'un menu personalisé</p>
                        </div>
                        <div class="pricing-panel__feature pricing-panel-home">
                            <p class="pricing-panel__feature-text">Constituer les menus de vos client grace au personne ayant les mêmes carences</p>
                        </div>
                    </div>
                </div>
                <div class="button stretch pricing purple">
                    <div class="button__text">Essai gratuit</div>
                </div>
            </a>

            <a href="http://healthcare.ensiie.fr" class="pricing-panel pricing-panel--link w-inline-block">
                <div class="pricing-panel__top"><img src="/File/image/dessert_table_price.png" width="100" alt="Medecin">
                    <h4 class="pricing_black-text">Entreprise &amp; Laboratoire</h4>

                    <p class="pricing-panel__desc pricing-panel-home">Pour les laboratoires et medicaux</p>
                    <div class="pricing-panel__feature-wrap">
                        <div class="pricing-panel__feature pricing-panel-home">
                            <p class="pricing-panel__feature-text">Recherche dans notre base de donnée</p>
                        </div>
                        <div class="pricing-panel__feature pricing-panel-home">
                            <p class="pricing-panel__feature-text">Determination de vos carence</p>
                        </div>
                        <div class="pricing-panel__feature pricing-panel-home">
                            <p class="pricing-panel__feature-text">Constitution d'un menu personalisé</p>
                        </div>
                        <div class="pricing-panel__feature pricing-panel-home">
                            <p class="pricing-panel__feature-text">Constituer des menus grace au personne ayant les mêmes carences</p>
                        </div>
                        <div class="pricing-panel__feature pricing-panel-home">
                            <p class="pricing-panel__feature-text">Recuperation statistique des données</p>
                        </div>

                        <div class="pricing-panel__feature pricing-panel-home">
                            <p class="pricing-panel__feature-text">Elaboration de complements alimentaires et médicaments ciblés</p>
                        </div>
                    </div>
                </div>
                <div class="button stretch pricing vertblue">
                    <div class="button__text">Contacter-nous</div>
                </div>
            </a>
        </div>
    </div>
</section>


<!--Form section -->
<section class="form-section">
    <div class="container less">
        <div class="form-section__top">
            <h2 class="form-section__heading">Commencer gratuitement</h2>
            <p class="form-section__sub">Deja plus de 10000 personnes nous font confiances</p>
        </div>
        <div class="form-wrap form-wrap__horizontal w-form">
            <form action="index.php" method="post" name="Form-Bottom" data-name="Form Bottom" autocomplete="off" class="sign-up-form sign-up-form__horizontal">
                <div class="input-wrapper input-wrapper--horizontal">
                    <div class="float-label">Full name</div>
                    <input type="text" class="form-input form-input__color w-input" maxlength="256" name="name" data-name="Name" placeholder="Name: James Smith">
                </div>

                <div class="input-wrapper input-wrapper--horizontal">
                    <div class="float-label">Email address</div>
                    <input type="email" class="form-input form-input__color w-input" autocomplete="off" maxlength="256" name="email" data-name="Email" placeholder="something@mail.com" required>

                    <!-- js check -->
                    <div class="validator">
                        <div class="validator-text">Plutot : ...</div>
                        <div class="tooltip-arrow"></div><a href="https://healthcare.ensiie.fr/#" class="suggestion">name@mail.com</a>
                    </div>
                </div>

                <!-- js check -->
                <div class="input-wrapper input-wrapper--horizontal">
                    <div class="float-label">Create password</div>
                    <input type="password" class="form-input form-input__color w-input" autocomplete="off" maxlength="256" name="Password" data-name="Password" placeholder="Mot de passe" required>
                    <div class="validator weak-password">
                        <div class="tooltip-arrow"></div>
                        <div>Too ez mamen</div>
                    </div>
                </div>

                <input type="submit" value="Start" data-wait="Creating account..." wait="Creating account..." class="button form-section__button w-button">

                <div class="tos-copy right">En vous inscrivant vous accepter nos <a target="_blank" href="https://healthcare.ensiie.com/terms" class="tos-link">Terms of Service</a></div>

            </form>
            <div class="w-form-done">
                <p>Bravo! Vous faite maintenannt partit de notre grande famille !</p>
            </div>
            <div class="w-form-fail">
                <p>Oops! Un problème est survenu </p>
            </div>
        </div>

    </div>
</section>



<!-- Custom carency profil -->
<section class="section-basic black-background">
    <div class="text-img__cell left">
        <div class="text-img__copy left">
            <h3>Trouver des personnes avec les memes carence que vous</h3>
            <p class="grey-text">Partager et construiser ensemble votre menu anti-carence</p>
            <a href="https://healthcare.com/customers" class="button button__no-background w-inline-block">
                <div class="button__text">Découvrer notre communauté</div><img src="File/svg/right_arrow.svg" width="150" class="button__arrow"></a>
        </div>
    </div>
    <!-- left image pres -->
    <div class="text-img__cell img w-clearfix">
        <div class="text-img home-community"></div>
    </div>
</section>

<!-- footer -->

<footer class="footer-wrap">
    <div class="footer__contain">
        <div class="footer__link-column footer__link-column--logo">
            <a href="https://healthcare.com/" class="footer__logo-link w-inline-block w--current">
                <img src="default/HealthCare.svg" width="63" alt="HealthCare Logo - White" class="footer__logo">
            </a>
        </div>

        <!-- Categorie Produit -->
        <div class="footer__link-wrap">
            <div class="footer__link-column">
                <h5 class="footer__heading">Produit</h5>
                <a href="userDashboard.php" class="footer__link">Dashboard</a>
                <a href="https://healthcare.ensiie.fr/" class="footer__link">Client</a>
                <a href="https://healthcare.ensiie.fr/" class="footer__link">Prix</a>
                <a href="https://healthcare.ensiie.fr/" class="footer__link">Pre-Build</a>
            </div>

            <!-- Categorie Entreprise -->
            <div class="footer__link-column">
                <h5 class="footer__heading">Entreprise</h5>
                <a href="https://healthcare.ensiie.fr/" class="footer__link">A propos</a>
                <a href="https://healthcare.ensiie.fr/" class="footer__link">Blog</a>
                <a href="https://healthcare.ensiie.fr/" class="footer__link">Terms of Service</a>
                <a href="https://healthcare.ensiie.com/" class="footer__link">Privacy Policy</a>
            </div>

            <!-- Categorie Support -->
            <div class="footer__link-column">
                <h5 class="footer__heading">Support</h5>
                <a href="https://healthcare.ensiie.com/" class="footer__link">Forum</a>
                <a href="https://healthcare.ensiie.com/" class="footer__link">Service Status</a>
                <a href="https://healthcare.ensiie.com/" class="footer__link">Contact Support</a>
            </div>


            <div class="footer__link-column footer__link-column--social">

                <h5 class="footer__heading">Social</h5>

                <a href="https://www.youtube.com/" target="_blank" class="footer__link footer__link--icon footer__link--youtube"></a>
                <a href="https://twitter.com/" target="_blank" class="footer__link footer__link--icon footer__link--twitter w-inline-block"></a>
                <a href="https://www.facebook.com/" target="_blank" class="footer__link footer__link--icon footer__link--fb w-inline-block"></a>
                <a href="https://www.instagram.com/" target="_blank" class="footer__link footer__link--icon footer__link--insta w-inline-block"></a>
                <a href="https://plus.google.com/" target="_blank" class="footer__link footer__link--icon footer__link--g-plus w-inline-block"></a>
            </div>
        </div>
    </div>
</footer>

<script src="js/video_play.js" type="text/javascript"></script>
<script src="js/onScrollHeader.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


</body>

</html>
