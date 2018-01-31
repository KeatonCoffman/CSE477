<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/15/17
 * Time: 7:00 PM
 */

namespace Felis;


class NewCaseView extends View
{


    public function __construct(Site $site) {
        $this->site = $site;
        $this->addLink("cases.php","Cases");
        $this->addLink("./","Logout");
        $this->addLink("staff.php","Staff");
        $this->setTitle("Felis New Case");

    }


    public function present() {
        $html = <<<HTML
    <form method="post" action="post/newcase.php" >
	    <fieldset>
		<legend>New Case</legend>
		<p>Client:
		<select name="client">
HTML;

        $users = new Users($this->site);

        $client_list = $users->getClients();
        foreach($client_list as $entry) {
            $name = $entry['name'];
            $id = $entry['id'];
            $html .= '<option name="client" value="' . $id . '">' . $name . '</option>';
        }
        $html .= <<<HTML
			</select>
		</p>
		<p>
		<label for="number">Case Number: </label>
		<input type="text" id="number" name="number" placeholder="Case Number">
		</p>
		<p><input type="submit" value="OK" name="ok"> <input type="submit" value="Cancel" name="cancel"></p>
	</fieldset>
</form>
HTML;
        return $html;
    }

}