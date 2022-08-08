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

echo html_writer::nonempty_tag('h4', 'Detective case #1: Show the context types where the manager role may be assigned.'); 

$getmanagerroleid = $DB->get_field_select('role', 'id', 'shortname = ?', array('manager')); 

echo 'The id for the manager role is: '; 
echo $getmanagerroleid; 
echo '<br>'; 
echo '<p>These are the context levels where you can assign the manager role:</p>'; 

$getcontextlevels = $DB->get_records_select('role_context_levels', 'roleid = ?', array($getmanagerroleid)); 

if (!empty($getcontextlevels)) {
	
	foreach ($getcontextlevels as $showcontextlevels) {
		
		echo $showcontextlevels->contextlevel; 
		echo '<br>'; 
		
	}
}

echo html_writer::nonempty_tag('h4', 'Detective case #2: List all roles. If someone is assigned to the role, then show their name and show the context levels for the assignment.'); 

$getroles = $DB->get_records_select('role', '1 = ?', array(1)); 

foreach ($getroles as $showroles) {
	
	echo '<b>'; 
	echo $showroles->shortname; 
	echo '</b><br>'; 
	
	$getrolemembership = $DB->get_records_select('role_assignments', 'roleid = ?', array($showroles->id)); 
	
	if (!empty($getrolemembership)) {
		
		foreach($getrolemembership as $showrolemembership) { 
			
			$getmemberinfo = $DB->get_record_select('user', 'id = ?', array($showrolemembership->userid)); 
			
			echo $getmemberinfo->username; 
			echo ' was assigned at a context level of '; 
			
			$getcontextlevel = $DB->get_record_select('context', 'id = ?', array($showrolemembership->contextid)); 
			
			echo $getcontextlevel->contextlevel; 
			echo '<br>'; 
			
		}
		
	} else {
		
		echo 'No users are assigned to this role.'; 
		echo '<br>'; 
		
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