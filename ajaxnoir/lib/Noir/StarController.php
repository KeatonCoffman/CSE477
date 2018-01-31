<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/27/17
 * Time: 2:53 PM
 */

namespace Noir;


class StarController extends Controller {
    /**
     * StarController constructor.
     * @param Site $site Site object
     * @param $user User object
     * @param array $post $_POST
     */
    public function __construct(Site $site, $user, $post) {
        parent::__construct($site);



        if(isset($post['rating']) && isset($post['id'])) {
            $id = strip_tags($post['id']);
            $rating = strip_tags($post['rating']);


            $movies = new Movies($site);
            $movie = $movies->get($user, $id);

            if ($movie === null) {
                $this->result = json_encode(array('ok' => false, 'message' => 'Failed to update database!'));
                return;
            }
            $movies->updateRating($user,$id,$rating);

        }

        $view = new HomeView($site,$user);
        $this->result = json_encode(array('ok' => true, 'table' => $view->presentTable()));

    }

}