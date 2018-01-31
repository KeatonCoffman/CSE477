<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/16/17
 * Time: 12:16 AM
 */

namespace Felis;


class CaseView extends View
{
    private $id;
    private $case;

    public function __construct(Site $site, array $post) {
        $this->site = $site;

        $this->setTitle("Felis Investigations Cases");
        $this->addLink("staff.php","Staff");
        $this->addlink("cases.php","Cases");
        $this->addlink("cases.php","Cases");
        if(isset($post['id'])){
            $this->id = $post['id'];
        }

        $cases = new Cases($this->site);
        $this->case = $cases->get($this->id);

    }

    public function present(){

        $caseNum = '';
        $clientName = '';
        $agentName = null;
        $status = '';
        $hidden = '';
        $summary = '';
        if(isset($this->get['id'])) {

            $cases = new Cases($this->site);
            $caseNum = $this->get['id'];
            $id = $cases->fetchID($caseNum);
            $case = $cases->get($id);

            if($case !== null) {
                $clientName = $case->getClientName();
                $agentName = $case->getAgentName();
                $status = $case->getStatus();
                $summary = $case->getSummary();
                $hidden = '<input type="hidden" name="id" value="' . $id . '">';
            }
            else{
                $clientName = $this->client;
                $agentName = "";
                $status = "";
                $summary = "";
            }
        }

        $html = <<<HTML
<form method="post" action="post/case.php">
$hidden
	<fieldset>
		<legend>Case</legend>
		<p>Client: $clientName</p>
		<p>
			<label for="number">Case Number: </label>
			<input type="text" id="number" name="number" placeholder="$caseNum"
				   value="$caseNum">
		</p>
		<p>
			<label for="summary">Summary</label><br>
			<input type="text" id="summary" name="summary" placeholder="Summary"
				   value="$summary">
		</p>
		<p>
			<label for="agent">Agent in Charge: </label>
			<select id="agent" name="agent">
HTML;
        $new_users = new Users($this->site);
        $all_agents  = $new_users->getAgents();
        // add the agents to the dropdown
        foreach ($all_agents as $agent){
            $addition = '';
            if($this->case->getAgent() == $agent['id']){
                $addition = 'selected';
            }
            $html .= "<option value='{$agent['id']}' $addition>{$agent['name']}</option>";
        }
        $html .= <<<HTML
			</select>
		</p>
		<p>
			<label for="status">Status: </label>
			<select id="status" name="status">
				<option selected>Open</option>
				<option>Closed</option>
			</select>
		</p>
		<p>
			<input type="submit" name="update" value="Update">
		</p>
		<div class="notes">
		<h2>Notes</h2>
		<div class="timelist">
			<div class="report">
				<div class="info">
					<p class="time">2/10/2016 11:35am</p>
					<p class="agent">Martin, Harvey</p>
				</div>
				<p>Initial meeting with client. He's very concerned
					Felix will just not shut up at night. It's not like him to caterwaul so much, so there
					must be something going on in the neighborhood.</p>
			</div>
			<div class="report">
				<div class="info">
					<p class="time">2/14/2016 2:15pm</p>
					<p class="agent">Martin, Harvey</p>
				</div>
				<p>Met with the client to discuss the case.</p>
			</div>
		</div>
		<p>
			<label for="note">Notes</label><br>
			<textarea id="note" name="note" placeholder="Note"></textarea>
		</p>
		<p>
			<input type="submit" value="Add Note">
		</p>
		</div>
		<div class="reports">
			<h2>Reports</h2>
			<div class="timelist">
				<div class="report">
					<div class="info">
						<p class="time"><a href="report.php">2/12/2016 1:35am</a></p>
						<p class="agent">Martin, Harvey</p>
					</div>
					<p>Surveillance of neighborhood for three hours. Nothing untoward spotted.</p>
				</div>
			</div>
			<div class="timelist">
				<div class="report">
					<div class="info">
						<p class="time"><a href="report.php">2/13/2016 2:15am</a></p>
						<p class="agent">Martin, Harvey</p>
					</div>
					<p>Surveillance of neighborhood for two hours. Spotted a very attractive
						Siamese cat wandering though. Caterwauling commenced.</p>
				</div>
			</div>
			<p>
				<input type="submit" value="Add Report">
			</p>
		</div>
	</fieldset>
</form>
HTML;
        return $html;
    }

    private $client;



}