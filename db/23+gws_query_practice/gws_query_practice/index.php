<?php 

/**
 * Version file for component 'local_gws_query_practice'
 * 
 * @package    local_gws_query_practice
 * @copyright  2019 onwards GWS
 * @developer  Brian kremer (greatwallstudio.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/  

//Includes
require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
global $DB;

//Set page object
$PAGE->set_context(context_system::instance());
$url = new moodle_url('/local/gws_query_practice/index.php');
$PAGE->set_url($url);
$PAGE->set_pagelayout('report');
require_login();
$context = context_system::instance();

//Bread crumb trail
$previewnode = $PAGE->navigation->add(get_string('pluginname', 'local_gws_query_practice'), new moodle_url('index.php'), navigation_node::TYPE_CONTAINER);
$previewnode->make_active();
require_capability('local/gws_query_practice:accessquerypractice',$context);

//Navigation and header 
$strpluginname = $SITE->fullname . ' query practice - index.php';
$PAGE->set_title($strpluginname);
$PAGE->set_heading($strpluginname);
echo $OUTPUT->header();
echo html_writer::nonempty_tag('h3', 'GWS query practice'); 

echo html_writer::nonempty_tag('p', 'Page to practice writing queries... find moodle/local/gws_query_practice/index.php, and edit it! '); 

// ********** ********** SECTION 1 ********** ********** 
/**
//example of get_records_sql
echo '<hr><p>Example of get_records_sql() function</p>'; 

//put query in a variable
$sql = "SELECT * FROM `mdl_user` WHERE `username` LIKE \"r%\"";

//display the query
echo '<p>Query: <b>' . $sql . '</b></p>';

//send the query to the get_records_sql() function
$results = $DB->get_records_sql($sql);

//display the results of the function call
echo 'Query results: ';
print_r($results);
*/

$getuser = $DB->get_record_select('user', 'username = ?', array('nbettencourt')); 
echo $getuser->firstname . ' ' . $getuser->lastname . ' '; 
$getroleassignments = $DB->get_records_select('role_assignments', 'userid = ?', array($getuser->id)); 
foreach ($getroleassignments as $showroleassignments) {
	$getassignedrolename = $DB->get_record_select('role', 'id = ?', array($showroleassignments->roleid)); 
	echo 'is assigned to the ' . $getassignedrolename->shortname . ' role. <br>'; 
	$countassignmentperms = $DB->count_records_select('role_allow_assign', "roleid = {$getassignedrolename->id}"); 
	echo $getuser->firstname . ' can assign ' . $countassignmentperms . ' roles: <br>'; 
	echo $getuser->firstname . ' can assign these roles: <br>';
	$getassignmentperms = $DB->get_records_select('role_allow_assign', 'roleid = ?', array($showroleassignments->roleid)); 
	foreach($getassignmentperms as $showassignmentperms) {
		$getassignmentrolenames = $DB->get_record_select('role', 'id = ?', array($showassignmentperms->allowassign)); 
		echo $getassignmentrolenames->shortname . '<br>'; 
	} 
	echo '<br>'; 
	$countoverrideperms = $DB->count_records_select('role_allow_override', "roleid = {$getassignedrolename->id}"); 
	echo $getuser->firstname . ' can override ' . $countoverrideperms . ' roles: <br>'; 
	$getoverrideperms = $DB->get_records_select('role_allow_override', 'roleid = ?', array($showroleassignments->roleid)); 
	foreach($getoverrideperms as $showoverrideperms) {
		$getoverriderolenames = $DB->get_record_select('role', 'id = ?', array($showoverrideperms->allowoverride)); 
		echo $getoverriderolenames->shortname . '<br>'; 
	} 
	echo '<br>'; 
	$countswitchperms = $DB->count_records_select('role_allow_switch', "roleid = {$getassignedrolename->id}"); 
	echo $getuser->firstname . ' can switch ' . $countswitchperms . ' roles: <br>'; 
	$getswitchperms = $DB->get_records_select('role_allow_switch', 'roleid = ?', array($showroleassignments->roleid)); 
	foreach($getswitchperms as $showswitchperms) {
		$getswitchrolenames = $DB->get_record_select('role', 'id = ?', array($showswitchperms->allowswitch)); 
		echo $getswitchrolenames->shortname . '<br>'; 
	} 
	echo '<br>'; 	
	$countviewperms = $DB->count_records_select('role_allow_view', "roleid = {$getassignedrolename->id}"); 
	echo $getuser->firstname . ' can view ' . $countviewperms . ' roles: <br>'; 
	$getviewperms = $DB->get_records_select('role_allow_view', 'roleid = ?', array($showroleassignments->roleid)); 
	foreach($getviewperms as $showviewperms) {
		$getviewrolenames = $DB->get_record_select('role', 'id = ?', array($showviewperms->allowview)); 
		echo $getviewrolenames->shortname . '<br>'; 
	} 
	echo '<br>'; 	
}


// ********** ********** SECTION 2 ********** **********  
/**
//Query the role table
$roletablerecords = $DB->get_records_select('role', 'id != ?', array('0'), 'id');

echo '<p></p>';

//Make a heading 
echo '<b>id     -     shortname </b><br>'; 
	
//Loop through the query results
foreach ($roletablerecords as $showroletablerecords) {    
	
	//Show role id and shortname
	echo $showroletablerecords->id . '     -     ' . $showroletablerecords->shortname .  '<br>';
}
*/
// ********** ********** ********** ********** ********** 

//Show page footer
echo $OUTPUT->footer();