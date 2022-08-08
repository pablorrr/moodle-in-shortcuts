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

echo html_writer::nonempty_tag('h4', 'Detective case #1: Show all capabilities for student role.'); 

$getrole = $DB->get_record_select('role', 'shortname = ?', array('student'));

echo '<b>The id for the student role is </b>';
echo $getrole->id;
echo '<br>';

$getcapabilities = $DB->get_records_select('role_capabilities', 'roleid = ?', array($getrole->id));

foreach($getcapabilities as $showcapabilities) {
	
	echo '<b>Context ID: </b>';
	echo $showcapabilities->contextid; 
	echo ': ';

	echo '<b>Capability: </b>';
	echo $showcapabilities->capability; 
	echo ' - ';

	echo '<b>Time Modified: </b>';
	echo date('r', $showcapabilities->timemodified); 
	echo '<br>';
	
}

echo html_writer::nonempty_tag('h4', 'Detective case #2: Show all capabilities for Robert Johnson'); 

$getuser = $DB->get_record_select('user', 'username = ?', array('rjohnson'));

echo '<b>rjohnson user record id is </b>'; 
echo $getuser->id; 
echo '<br>'; 

$getrobertsrole = $DB->get_record_select('role_assignments', 'userid = ?', array($getuser->id));

echo '<b>rjohnson is assigned to the role with this id: </b>'; 
echo $getrobertsrole->roleid; 
echo '<br>'; 

$getrolename = $DB->get_record_select('role', 'id = ?', array($getrobertsrole->roleid));

echo '<b>The name of Robert Johnsons role is: </b>'; 
echo $getrolename->shortname; 
echo '<br>'; 

$getrobertscapabilities = $DB->get_records_select('role_capabilities', 'roleid = ?', array($getrobertsrole->roleid)); 

foreach($getrobertscapabilities as $showrobertscapabilities) {
	
	echo '<b>Context ID: </b>'; 
	echo $showrobertscapabilities->contextid; 
	echo ': '; 
	
	echo '<b>Capability: </b>'; 
	echo $showrobertscapabilities->capability; 
	echo ' - '; 

	echo '<b>Time Modified: </b>'; 
	echo date('m-d-Y H:i', $showrobertscapabilities->timemodified); 
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