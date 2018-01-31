<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/16/17
 * Time: 5:57 PM
 */

namespace Felis;


class DeleteView extends View
{
    public function __construct(Site $site, array $get)
    {
        $this->setTitle("Felis Delete?");
        $this->addLink("./post/logout.php","Log out");
        $this->addLink("./cases.php","Cases");
        $this->addLink("./staff.php","Staff");
        $del_cases = new Cases($site);
        if(isset($get['id'])) {
            $case = $del_cases->get($get['id']);
            if($case === null){
                $this->Numbercase = null;
            }
            else {
                $this->Numbercase = $case->getNumber();
                $this->case_id = $case->getId();
            }
        }
    }

    public function present(){
        if($this->Numbercase === null){
            return "<h1>No such a case!</h1>";
        }
        $html = <<<HTML
<form method="post" action="./post/deletecase.php?id=$this->case_id">
	<fieldset>
		<legend>Delete?</legend>
		<p>Are you sure absolutely certain beyond a shadow of
			a doubt that you want to delete case $this->Numbercase?</p>

		<p>Speak now or forever hold your peace.</p>

		<p><input type="submit" name ="delete" value="Yes"> <input type="submit" value="No"></p>

	</fieldset>
</form>
HTML;
        return $html;

    }


    private $Numbercase;

}