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
    private $html = '';

    /**
     * Navbar constructor.
     * @param $buttons_left array of string buttons aligned on the left in the navbar
     * @param $buttons_right array of string buttons aligned on the right in the navbar
     */
    public function __construct($buttons_left, $buttons_right)
    {
        //general navbar code
        $this->html =
            '<nav class = "navbar navbar-expand-lg navbar-light flex-column flex-md-row bg-dark bd-navbar" > 
                <a class="navbar-brand" href="index.php" width="10%"> <img class="navbar-brand" src="logos/logo.png" width="160px"/></a>
                <button class="navbar-toggler" type = "button" data-toggle="collapse" 
                data-target="navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"> </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">';
        //add buttons on the left
        foreach ($buttons_left as $button) {
            $this->html .= $button;
        }

        $this->html .= '</ul> 
                        </div>';

        $this->html .= '<div class="pull-right">
                        <ul class="navbar-nav"> ';

        //add buttons on the right
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
     * @return string code for a simple navbar button
     */
    static function generate_navbar_button($action, $name)
    {
        $li = '<li class="nav-item active';
        $li .= '">
                <a class="nav-link text-light " href="'.$action.'">
                    '.$name.'
                </a>
             </li> ';
        return $li;
    }



}











