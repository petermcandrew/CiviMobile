
<?
 require_once('civimobile.header.php'); 
 global $base_url;
?>
<div data-role="page" data-theme="b" id="participants"> 
	<div id="jqm-participants" data-role="header">
	    <h3>Participants</h3>
	    <a href="/civimobile" data-ajax="false" data-direction="reverse" data-role="button" data-icon="home" data-iconpos="notext" class="ui-btn-right jqm-home">Home</a>
	</div> 
	
	<div data-role="content" id="participants-content"> 
        <ul class="participants-list" data-role="listview" data-filter="true"></ul>
	</div>
	<?php require_once('civimobile.navbar.php'); ?>
</div> 

<? require('civimobile.footer.php'); ?>
