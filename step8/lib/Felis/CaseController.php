<?php
namespace Felis;

class CaseController
{
    /**
     * CaseController constructor.
     * @param Site $site
     * @param $post
     */
    public function __construct(Site $site, $post)
    {
        $all_cases = new Cases($site);
        $all_cases->update($post);
        $site_root = $site->getRoot();
        $this->redirect = "$site_root/cases.php";
    }
    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }


    private $redirect;
}