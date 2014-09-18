<?php

function wp_lic_mgr_manage_licenses_menu()
{
	if(!wp_lic_mgr_is_license_valid())
	{		
		return;	//Do not display the page if licese key is invalid	
	}
		
    echo '<div class="wrap">';
    echo '<h2>Manage Licenses</h2>';
    echo '<div id="poststuff"><div id="post-body">';

    ?>
    <br />
    <div class="postbox">
    <h3><label for="title">Existing Licenses</label></h3>
    <div class="inside">
<?php
        include_once 'wp-lic-mgr-list-licenses.php'; //For rendering the license List Table
        $license_list = new WPLM_List_Licenses();
        if(isset($_REQUEST['action'])) //Do list table form row action tasks
        {
            if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'delete'){ //Delete link was clicked for a row in list table
                $license_list->delete_licnses(strip_tags($_REQUEST['id']));
            }
        }
        //Fetch, prepare, sort, and filter our data...
        $license_list->prepare_items();
        //echo "put table of locked entries here"; 
        ?>
        <form id="tables-filter" method="get" onSubmit="return confirm('Are you sure you want to perform this bulk operation on the selected entries?');">
        <!-- For plugins, we also need to ensure that the form posts back to our current page -->
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>" />
        <!-- Now we can render the completed list table -->
        <?php $license_list->display(); ?>
        </form>
        
    </div></div>

    <?php
    echo '</div></div>';
    echo '</div>';
}

