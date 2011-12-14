<?php
    $url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

    $parse_url = parse_url($url, PHP_URL_PATH);
    
    // get last arg of path (contact id)
    $case_id = arg(2);
    $results = civicrm_api("Case","get", 
                    array ( 'sequential' =>'1', 
                            'version'=>3, 
                            'case_id' => $case_id) 
                            );
    $case = $results['values'][0];
    
    $source_contact_result = civicrm_api("Contact","get", 
                    array ( 'sequential' =>'1', 
                            'version'=>3, 
                            'contact_id' => $case['source_contact_id'], 
                            'return' =>'display_name')
                            );
    $source_contact_name = $source_contact_result['values'][0]['display_name'];
    
    include('civimobile.header.php');
?>
<div data-role="page" data-theme="c" id="jqm-contacts">

 <div data-role="header" data-theme="a">
    <a href="#" data-rel="back" class="ui-btn-left" data-icon="arrow-l">Back</a>
    <h3>View Case</h3>
    	    <a href="<?php print url('civimobile') ?>" data-ajax="false" data-direction="reverse" data-role="button" data-icon="home" data-iconpos="notext" class="ui-btn-right jqm-home">Home</a>
  
  </div><!-- /header -->
  
	<div data-role="content" id="case-content"> 
        <div data-role="content"> 
          <ul id="main-case-list" data-role="listview" data-inset="true" >
              <li data-role="list-divider"><?php print $allActivityType[$activity['activity_type_id']];?></li>
              <li role="option" tabindex="-1" data-theme="c">Subject: <?php print $activity['subject'];?></li>
              <li role="option" tabindex="-1" data-theme="c">Added by: <?php print $source_contact_name; ?></li>
              <li role="option" tabindex="-1" data-theme="c">Status: <?php print $allActivityStatuses[$activity['status_id']];?></li>
              <li role="option" tabindex="-1" data-theme="c">Date: <?php print CRM_Utils_Date::customFormat( $activity['activity_date_time'] , null, null );?></li>
          </ul>
         </div>
    </div> 
</div> 

<?php require('civimobile.footer.php'); ?>
                                                                    