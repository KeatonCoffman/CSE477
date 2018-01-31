<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/13/17
 * Time: 12:57 PM
 */

namespace Felis;


class HomeView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct() {
        $this->setTitle("Felis Investigations");
        $this->addLink("login.php", "Log in");
    }

    /**
     * Add content to the header
     * @return string Any additional comment to put in the header
     */
    protected function headerAdditional() {
        return <<<HTML
<p>Welcome to Felis Investigations!</p>
<p>Domestic, divorce, and carousing investigations conducted without publicity. People and cats shadowed
	and investigated by expert inspectors. Katnapped kittons located. Missing cats and witnesses located.
	Accidents, furniture damage, losses by theft, blackmail, and murder investigations.</p>
<p><a href="">Learn more</a></p>
HTML;
    }


    private $test_left = array();
    private $test_right = array();
    private $test_num = 0;


    public function addTestimonial($content, $writer){
        if ($this->test_num % 2 == 0){
            $this->test_left[]  =array("content"=>$content, "author" => $writer);
        }
        else {
            $this->test_right[] = array("content" => $content, "author" => $writer);
        }
        $this->test_num++;
    }

    public function testimonials(){
        $html =<<<HTML
<section class="testimonials">
<h2>TESTIMONIALS</h2>
<div class="left">
HTML;
        foreach ($this->test_left as $left){
            $html .= '<blockquote><p>' . $left['content']. '</p><cite>' . $left['writer'] .'</cite></blockquote>';
        }
        $html .= '</div><div class="right">';
        foreach ($this->test_right as $right){
            $html .='<blockquote><p>' . $right['content'] . '</p><cite>'. $right['writer'] .'</cite></blockquote>';
        }
        $html .='</div></section>';
        return $html;

    }

}