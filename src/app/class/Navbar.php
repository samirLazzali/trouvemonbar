<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 18:19
 */

/**
 * Class Navbar
 * @package Navbar
 * The navbar to be displayed on the top of the website on each page
 */
class Navbar
{

    /**
     * @var string html code representing a navbar
     */
    public $html = '';

    /**
     * Navbar constructor.
     * @param $buttons_left array of string buttons aligned on the left in the navbar
     * @param $buttons_right array of string buttons aligned on the right in the navbar
     * @todo afficher le logo à la place de logo_guiilde
     */
    public function __construct($buttons_left, $buttons_right)
    {
        $this->html =
            '<nav class = "navbar navbar-expand-lg navbar-light bg-light" > 
                <a class="navbar-brand" href="index.php" width="30%"> <img class="navbar-brand" src="logos/logo.png" width="200px"/></a>
                <button class="navbar-toggler" type = "button" data-toggle="collapse" 
                data-target="navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="nabar-toggler-icon"> </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">';

        foreach ($buttons_left as $button) {
            $this->html .= $button;
        }

        $this->html .= '</ul> 
                        </div>';

        $this->html .= '<div class="pull-right">
                        <ul class="navbar-nav"> ';
        foreach($buttons_right as $button) {
            $this->html .= $button;
        }
        $this->html .= '</ul>
                        </div>
                        </nav>';
    }

    /**
     * @return string html code for the navbar
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param $action string action for the button
     * @param $name string does the button display
     * @param $aligned_left bool is the button left aligned (if set to false, it's aligned right)
     * @return string code for a simple navbar button
     */
    static function generate_navbar_button($action, $name, $aligned_left=true)
    {
        $li = '<li class="nav-item active';
        $li .= '">
                <a class="nav-link" href="'.$action.'">
                    '.$name.'
                </a>
             </li> ';
        return $li;
    }


}











