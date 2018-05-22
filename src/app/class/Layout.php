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
     * functions corresponding to each layout
     */

    /**
     * layout for logged in users : _layout/users.php
     * @param $layout string name of the desired layout
     * @param $title string title for the page
     */

    public function users($layout, $title='')
    {
        /*
         * Generate navbar for logged in users
         */

        Auth::get_user();
        $user = Auth::user();

        //link to index page
        $index_button = Navbar::generate_navbar_button("index.php", "Calendrier");

        //link to game page
        $games_button = Navbar::generate_navbar_button("games.php", "Tables");

        //link to userlist page
        $users_button = Navbar::generate_navbar_button("userlist.php", "Joueurs");

        //link to profile page
        $profile_button = Navbar::generate_navbar_button("user_profile.php?user=".$user->getId(), $user->getNick() );

        //link to logout action
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
     * @param string title for the page
     */
    public function visitors($layout, $title='')
    {
        /*
         * Generate navbar for visitors
         */
        $index_button = Navbar::generate_navbar_button("index.php", "Accueil");
        $login_button = Navbar::generate_navbar_button("authentication.php", "Se connecter");
        $games_button = Navbar::generate_navbar_button("games.php","Tables");
        $subscribe_button = Navbar::generate_navbar_button("subscribe.php", "S'inscrire");
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

        //if there is a function corresponding to the layout
        if(method_exists($this, $this->layout))
            //call this func
            call_user_func_array([$this, $this->layout], array_merge([$path], func_get_args()));
        else
            //if function not found, instead include layout
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




















