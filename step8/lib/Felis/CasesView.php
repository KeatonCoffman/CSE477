<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/15/17
 * Time: 6:13 PM
 */

namespace Felis;


class CasesView extends View
{
    public function __construct(Site $site, $get, $session) {
        parent::__construct($site, $get, $session);
        $this->setTitle("Felis Investigations Cases");
        $this->addLink("staff.php","Staff");
    }

    public function present(){
        $html = <<<HTML
<form method="post" action="post/cases.php" class="table">
	<p>
	<input type="submit" name="add" id="add" value="Add">
	<input type="submit" name="delete" id="delete" value="Delete">
	</p>
	<table>
		<tr>
			<th>&nbsp;</th>
			<th>Case Number</th>
			<th>Client</th>
			<th>Agent In Charge</th>
			<th class="desc">Description</th>
			<th>Most Recent Report</th>
			<th>Status</th>
		</tr>
HTML;
        $site_cases = new Cases($this->site);
        $all_cases = $site_cases->getCases();

        foreach($all_cases as $client_case) {
            $caseNum = $client_case->getNumber();
            $clientName = $client_case->getClientName();
            $agentName = $client_case->getAgentName();
            $status = $client_case->getStatus() === ClientCase::STATUS_OPEN ?
                "Open" : "Closed";
            $summary = $client_case->getSummary();
            $html .= <<<HTML
<tr><td><input type="radio" value="$caseNum" name="id"></td>
<td><a href="case.php?id=$caseNum">$caseNum</a></td><td>$clientName</td><td>$agentName</td><td>$summary</td><td>&nbsp;</td><td>$status</td>
</tr>
HTML;
        }
        $html .= <<<HTML
</table></form>
HTML;

        return $html;
    }



}