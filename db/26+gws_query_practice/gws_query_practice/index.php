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

//Show all role assignments: who made the assignment, what role they assigned, who they assigned the role to, and the date

$getrolelogrecords = $DB->get_recordset_select('logstore_standard_log', 'target = ?', array('role')); 

foreach($getrolelogrecords as $showrolelogrecords) {
	
	$getassignor = $DB->get_record_select('user', 'id = ?', array($showrolelogrecords->userid)); 
	$getassignee = $DB->get_record_select('user', 'id = ?', array($showrolelogrecords->relateduserid)); 
	$getrole = $DB->get_record_select('role', 'id = ?', array($showrolelogrecords->objectid)); 
	
	echo 'On ' . date('m-d-Y', $showrolelogrecords->timecreated) . ', ' . $getassignor->username . ' assigned the role of ' . $getrole->shortname . ' to ' . $getassignee->username . '.<br>';  
}

$getrolelogrecords->close(); 

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