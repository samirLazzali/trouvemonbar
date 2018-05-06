<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 06/05/18
 * Time: 11:53
 */

class Layout
{
    /*
     * fonctions correspondantes à chaque layout
     */

    /**
     * layout for logged in users : _layout/users.php
     * @param $layout
     * @throws Exception
     */

    public function users($layout, $title='')
    {
        /*
         * Generate navbar for logged in users
         */

        Auth::get_user();
        $user = Auth::user();

        //@todo create static function Navbar::generate_user_navbar to hold this code
        $index_button = Navbar::generate_navbar_button("index.php", "Calendrier");
        $games_button = Navbar::generate_navbar_button("games.php", "Tables");
        $users_button = Navbar::generate_navbar_button("userlist.php", "Joueurs");
        $profile_button = Navbar::generate_navbar_button("user_profile.php", $user->getNick() );
        $logout_button = Navbar::generate_navbar_button("actions/disconnect.php", "Se déconnecter");
        $this->navbar = new Navbar(array($index_button, $games_button, $users_button), array($profile_button, $logout_button));

        /*
        * display desired layout
        */
        include $layout;
    }

    /**
     * layout for visitors : _layout/visitors.php
     * @param string name of the desired layout
     */
    public function visitors($layout, $title='')
    {
        /*
         * Generate navbar for visitors
         */

        //@todo create static function Navbar::generate_visitor_navbar to hold this code
        $index_button = Navbar::generate_navbar_button("index.php", "Accueil");
        $login_button = Navbar::generate_navbar_button("authentication.php", "Se connecter", false);
        $games_button = Navbar::generate_navbar_button("games.php", "Tables");
        $subscribe_button = Navbar::generate_navbar_button("subscribe.php", "S'inscrire", false);
        $this->navbar = new Navbar(array($index_button, $games_button),  array( $login_button , $subscribe_button) );

        /*
         * display desired layout
         */
        include $layout;
    }

    private $layout, $contents, $navbar;

    /**
     * Layout constructor. Start creating the layout via ob stack
     * @param $layout string name of the desired layout
     */
    public function __construct($layout)
    {
        $this->layout = $layout;
        ob_start();
    }

    /**
     * @brief display the contents in the layout
     * @param string title
     */
    public function show() {
        $this->contents = ob_get_contents();
        ob_end_clean();
        $path = view('_layouts/'.$this->layout.'.php');

        //si la fonction correspondante au layout demandé existe
        if(method_exists($this, $this->layout))
            //appeler cette fonction
            call_user_func_array([$this, $this->layout], array_merge([$path], func_get_args()));
        else
            //sinon on inclut simplement le layout demandé
            include $path;

    }

    /**
     * contents accessor
     * @return mixed
     */
    public function contents()
    {
        return $this->contents;
    }


}




















