



<!-- barre de navigation / navbar -->


<nav class="navbar navbar-expand-lg navbar-dark bg-black">
 
  <a class="navbar-brand" href="index.php">
        HEALTHCARE
      </a>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
         <a href="https://healthcare.ensiie.fr/" class="nav-link">Caracteristique<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
             <a href="https://healthcare.ensiie.fr/" class="nav-link">Nos Clients</a>
      </li>
      <li class="nav-item">
           <a href="https://healthcare.ensiie.fr/" class="nav-link">Documentation</a>
      </li>
      <li class="nav-item">
            <a href="https://healthcare.ensiie.fr/" class="nav-link">Blog</a>
      </li>
    </ul>
    
    <ul class="navbar-nav navbar-right">
        <?php if($app->logged()): ?>

                <li><a href="selectNutriment.php" rel="nofollow" class="nav__sign-up w-button"><?php echo mb_strtoupper($_SESSION['username']) ?></a>
                        
                <a href="profile.php" rel="nofollow" class="nav__sign-up w-button">MyAccount</a>
                       
                    <?php if($_SESSION['role'] == 'admin'): ?>
                        <a href="admin.php" rel="nofollow" class="nav__sign-up w-button">Admin Dashboard</a>      
                    <?php endif; ?>

        <?php else : ?>
            <div class="nav-right">
                <a href="login.php" rel="nofollow" class="nav__sign-up w-button">Se connecter</a>
                <a href="Register.php" rel="nofollow" class="nav__sign-up w-button">Essai Gratuit</a>
            </div>
      <?php endif; ?>
        </ul>
  </div>
</nav>

