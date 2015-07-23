<?php	
if(function_exists('current_user_can'))
//if(!current_user_can('manage_options')) {
    
if(!current_user_can('delete_pages')) {
    die('Access Denied');
}	
if(!function_exists('current_user_can')){
	die('Access Denied');
}

function html_showgallery($rows, $pageNav,$sort){
	global $wpdb;
	?>

<div class="wrap">
	<?php $path_site2 = plugins_url("images", __FILE__); ?>
	<div class="slider-options-head">
		<div style="float: right;">
			<a class="header-logo-text" href="http://www.templaza.com/" target="_blank">
				<div><img src="<?php echo $path_site2; ?>/tz_plusgallery.png" /></div>
			</a>
		</div>
	</div>
	<div style="clear:both;"></div>
	<div id="poststuff">
        <div class="md-modal md-effect-1" id="modal-1">
            <div class="md-content">
                <h3>Create New Album</h3>
                <div>
                    <p>Please click your album type you want to create.</p>
                    <ul>
                        <li><a class="tzbutton  button--rayen button--inverted tz-face" data-text="Add Album" onclick="window.location.href='admin.php?page=tz_plusgallery&task=add_gallery&type=facebook'">
                                <span><?php echo __('Facebook Album','TZGALLERY');?></span></a>
                        </li>
                        <li><a class="tzbutton  button--rayen button--inverted tz-google" data-text="Add Album"  onclick="window.location.href='admin.php?page=tz_plusgallery&task=add_gallery&type=googleplus'">
                                <span><?php echo __('Google Album','TZGALLERY');?></span></a>
                        </li>
                        <li><a class="tzbutton  button--rayen button--inverted tz-flickr" data-text="Add Album" onclick="window.location.href='admin.php?page=tz_plusgallery&task=add_gallery&type=flickr'">
                                <span><?php echo __('Flickr Album','TZGALLERY');?></span></a>
                        </li>
                        <li><a class="tzbutton  button--rayen button--inverted tz-instagram" data-text="Add Album" onclick="window.location.href='admin.php?page=tz_plusgallery&task=add_gallery&type=instagram'">
                                <span><?php echo __('Instagram Album','TZGALLERY');?></span></a>
                        </li>
                    </ul>
                    <div class="clr"></div>
                    <button class="md-close"><img src="<?php echo $path_site2; ?>/cancel.png" alt="close"/> </button>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-1" id="modal-2">
            <div class="md-content">
                <h3>Delete Album</h3>
                <div>
                    <p>Are you sure want to delete your album?</p>
                    <ul>
                        <li><a class="tzbutton button--rayen button--inverted tz-delete tz-face tz-delete-yes"
                               href="admin.php?page=tz_plusgallery&task=remove_album&id=">
                                <span><?php echo __('Delete','TZGALLERY');?></span></a>
                        </li>
                        <li><a class="tzbutton button--rayen  tz-delete tz-delete-no button--inverted tz-google">
                                <span><?php echo __('Cancel','TZGALLERY');?></span></a>
                        </li>

                    </ul>
                    <div class="clr"></div>
                    <button class="md-close"><img src="<?php echo $path_site2; ?>/cancel.png" alt="close"/> </button>
                </div>
            </div>
        </div>
		<div id="albums-list-page">
			<form method="post"  action="admin.php?page=tz_plusgallery" id="admin_form" name="admin_form">
                <h2>TZ Plus Gallery
                    <a class="md-trigger tz_album_addnew" data-modal="modal-1"><?php echo __('Add new album','TZGALLERY');?></a>
                </h2>
			<table class="wp-list-table widefat fixed pages" style="width:95%">
				<thead>
				 <tr>
					<th scope="col" id="id" style="width:30px" ><span><?php echo __('ID','TZGALLERY');?></span><span class="sorting-indicator"></span></th>
					<th scope="col" id="type" style="width:30px" ><span><?php echo __('Album Type','TZGALLERY');?></span><span class="sorting-indicator"></span></th>
					<th scope="col" id="name" style="width:85px" ><span><?php echo __('Name','TZGALLERY');?></span><span class="sorting-indicator"></span></th>
					<th scope="col" id="prod_count"  style="width:75px;" ><span><?php echo __('User ID','TZGALLERY');?></span><span class="sorting-indicator"></span></th>
					<th scope="col" id="shortcode"  style="width:75px;" ><span><?php echo __('Shortcode','TZGALLERY');?></span><span class="sorting-indicator"></span></th>
					<th style="width:10px"><?php echo __('Delete','TZGALLERY');?></th>
				 </tr>
				</thead>
				<tbody>
				 <?php $count = 1; foreach($rows as $row_item){
                     ?>
                     <tr <?php if($count%2==0){ echo 'class="has-background"';}?>>
                         <td><?php echo esc_attr($row_item->id); ?></td>
                         <td><?php  if($row_item->data_type=='facebook'){ ?>
                                 <img src="<?php echo $path_site2; ?>/Facebook_logo_24.png" alt="facebook"/>
                             <?php } ?>
                             <?php  if($row_item->data_type=='flickr'){ ?>
                                 <img src="<?php echo $path_site2; ?>/Flickr__24.png" alt="Flickr"/>
                             <?php } ?>
                             <?php  if($row_item->data_type=='instagram'){ ?>
                                 <img src="<?php echo $path_site2; ?>/Instagram_logo_24.png" alt="Instagram"/>
                             <?php } ?>
                             <?php  if($row_item->data_type=='googleplus'){ ?>
                                 <img src="<?php echo $path_site2; ?>/google_plus_24.png" alt="Google+"/>
                             <?php } ?>

                         </td>
                         <td><a  href="admin.php?page=tz_plusgallery&task=edit_cat&id=<?php echo esc_attr($row_item->id);?>"><?php echo esc_html(stripslashes($row_item->name)); ?></a></td>
                         <td><?php echo esc_attr($row_item->data_userid);?></td>
                         <td><textarea class="full" readonly="readonly">[tz_plusgallery id="<?php echo $row_item->id; ?>"]</textarea></td>
                         <td><a class="md-trigger tz_delete" data-modal="modal-2" data-value="<?php echo esc_attr($row_item->id)?>"><?php echo __('Delete','TZGALLERY');?></a></td>
                     </tr>
                 <?php

                     $count++; }

                 ?>
				</tbody>
			</table>
			 <input type="hidden" name="oreder_move" id="oreder_move" value="" />
			 <input type="hidden" name="asc_or_desc" id="asc_or_desc" value="<?php if(isset($_POST['asc_or_desc'])) echo esc_html($_POST['asc_or_desc']);?>"  />
			 <input type="hidden" name="order_by" id="order_by" value="<?php if(isset($_POST['order_by'])) echo esc_html($_POST['order_by']);?>"  />
			 <input type="hidden" name="saveorder" id="saveorder" value="" />

			 <?php
			?>
			
			
		   
			</form>
		</div>
        <div class="md-overlay"></div>

    </div>
</div>
    <script type="text/javascript">
        jQuery('.tz-delete-no').on('click', function(){
            jQuery('#modal-2').removeClass('md-show');
        })
    </script>
    <?php

}

/*
 * Function edit TZ Plus gallery
 * */

function Html_edit_tzplusgallery($row, $row_items,$row_options)

{
 global $wpdb;

?>
<script type="text/javascript">
function submitbutton(pressbutton) 
{
	if(!document.getElementById('name').value){
	alert("Name is required.");
	return;
	}
	
	document.getElementById("adminForm").action=document.getElementById("adminForm").action+"&task="+pressbutton;
	document.getElementById("adminForm").submit();
	
}
function change_select()
{
		submitbutton('apply'); 
	
}
</script>
<div class="wrap">
	<?php $path_site2 = plugins_url("images", __FILE__); ?>
	<div class="albums-options-head">
		<div style="float: left;">
			<div><h3><a href="javascript: " onclick="window.location.href='admin.php?page=tz_plusgallery'">TZ Plus Gallery</a></h3></div>
		</div>
		<div style="float: right;">
			<a class="header-logo-text" href="http://www.templaza.com/" target="_blank">
				<div><img src="<?php echo $path_site2; ?>/tz_plusgallery.png" /></div>
			</a>
		</div>
	</div>
	<div style="clear:both;"></div>
    <div class="md-modal md-effect-1" id="modal-1">
        <div class="md-content">
            <h3>Create New Album</h3>
            <div>
                <p>Please click your album type you want to create.</p>
                <ul>
                    <li><a class="tzbutton  button--rayen button--inverted tz-face" data-text="Add Album" onclick="window.location.href='admin.php?page=tz_plusgallery&task=add_gallery&type=facebook'">
                            <span><?php echo __('Facebook Album','TZGALLERY');?></span></a>
                    </li>
                    <li><a class="tzbutton  button--rayen button--inverted tz-google" data-text="Add Album"  onclick="window.location.href='admin.php?page=tz_plusgallery&task=add_gallery&type=googleplus'">
                            <span><?php echo __('Google Album','TZGALLERY');?></span></a>
                    </li>
                    <li><a class="tzbutton  button--rayen button--inverted tz-flickr" data-text="Add Album" onclick="window.location.href='admin.php?page=tz_plusgallery&task=add_gallery&type=flickr'">
                            <span><?php echo __('Flickr Album','TZGALLERY');?></span></a>
                    </li>
                    <li><a class="tzbutton  button--rayen button--inverted tz-instagram" data-text="Add Album" onclick="window.location.href='admin.php?page=tz_plusgallery&task=add_gallery&type=instagram'">
                            <span><?php echo __('Instagram Album','TZGALLERY');?></span></a>
                    </li>
                </ul>
                <div class="clr"></div>
                <button class="md-close"><img src="<?php echo $path_site2; ?>/cancel.png" alt="close"/> </button>
            </div>
        </div>
    </div>
    <div class="md-overlay"></div>

    <div class="md-modal md-effect-1" id="modal-2">
        <div class="md-content">
            <h3>Delete Album</h3>
            <div>
                <p>Are you sure want to delete your album?</p>
                <ul>
                    <li><a class="tzbutton button--rayen button--inverted tz-delete tz-face tz-delete-yes"
                           href="admin.php?page=tz_plusgallery&task=remove_album&id=">
                            <span><?php echo __('Delete','TZGALLERY');?></span></a>
                    </li>
                    <li><a class="tzbutton button--rayen  tz-delete tz-delete-no button--inverted tz-google">
                            <span><?php echo __('Cancel','TZGALLERY');?></span></a>
                    </li>

                </ul>
                <div class="clr"></div>
                <button class="md-close"><img src="<?php echo $path_site2; ?>/cancel.png" alt="close"/> </button>
            </div>
        </div>
    </div>
    <div class="md-overlay"></div>

<form action="admin.php?page=tz_plusgallery&id=<?php echo $row->id; ?>" method="post" name="adminForm" id="adminForm">
	<div id="poststuff" >
        <?php
            if(isset($_GET["save"])){
                $save = $_GET["save"];
                if($save==1){?>
                    <div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
        <?php
                }
            }

        ?>


        <div id="slider-header">
		<ul id="albums-list">

			<?php
			foreach($row_items as $row_item){
				if($row_item->id != $row->id){
				?>
					<li>
						<a href="#" onclick="window.location.href='admin.php?page=tz_plusgallery&task=edit_cat&id=<?php echo $row_item->id; ?>'" ><?php echo $row_item->name; ?></a>
					</li>
				<?php
				}
				else{ ?>
					<li class="active" style="background-image:url(<?php echo plugins_url('images/edit.png', __FILE__) ;?>)">
						<input class="text_area" onfocus="this.style.width = ((this.value.length + 1) * 8) + 'px'" type="text"  readonly="readonly" name="name" id="tzname" maxlength="250" value="<?php echo esc_attr($row_item->name);?>" />
					</li>
				<?php
				}
			}
		?>
			<li class="add-new">
				<a class="md-trigger" data-modal="modal-1" >+</a>
			</li>
		</ul>
		</div>
		<div id="post-body" class="metabox-holder columns-2">
			<!-- Content -->
			<div id="post-body-content">
				<div id="gallery-body">
					<ul id="gallery-content">
                        <li>
                            <label for="name">Album Name</label>
                            <input type="text" name="name" id="name" value="<?php echo $row->name; ?>" class="text_area" />
                            <div class="clr"></div>
                        </li>
                        <li>
                            <?php if($row->data_type=='instagram'){ ?>
                            <label for="data_userid">Instagram ID</label>
                            <div class="info">
                                Please insert Your Instagram ID <a href="http://jelled.com/instagram/lookup-user-id" target="_blank">Get Instagram ID </a>
                            </div>
                            <?php } ?>
                            <?php if($row->data_type=='googleplus'){ ?>
                            <label for="data_userid">Google+ ID</label>
                            <div class="info">
                                Please insert Your Google+ ID <a href="<?php echo plugins_url( '/images/googleID.jpg' , __FILE__ );?>" target="_blank">Get Google+ ID </a>
                            </div>
                            <?php } ?>
                            <?php if($row->data_type=='flickr'){ ?>
                            <label for="data_userid">Flickr ID</label>
                            <div class="info">
                                Please insert Your Flickr ID <a href="http://idgettr.com/" target="_blank">Get Flickr ID </a>
                            </div>
                            <?php } ?>
                            <?php if($row->data_type=='facebook'){ ?>
                            <label for="data_userid">Facebook ID</label>
                            <div class="info">
                                Your ID Fanpage Facebook<a href="<?php echo plugins_url( '/images/facebookID.jpg' , __FILE__ );?>" target="_blank">Get Fanpage ID </a>
                            </div>
                            <?php } ?>
                            <input type="text" name="data_userid" id="data_userid" value="<?php echo $row->data_userid; ?>" class="text_area" />

                            <div class="clr"></div>

                        </li>
                        <?php if($row->data_type=='flickr' || $row->data_type=='googleplus' || $row->data_type=='facebook'){ ?>
                        <li>
                            <label for="album_type">Album Type</label>
                            <select name="album_type" class="album_type">
                                <option value="single_album" <?php if($row->album_type=='single_album'){?>selected<?php }?>>Single Album</option>
                                <option value="multi_album" <?php if($row->album_type=='multi_album'){?>selected<?php }?>>Multiple Albums</option>
                                <option value="all_albums" <?php if($row->album_type=='all_albums'){?>selected<?php }?>>Show all Albums</option>
                            </select>
                            <div class="single_album gallery_padding">
                                <label for="album_id">Album ID</label>
                                <input type="text" name="album_id" id="album_id" value="<?php echo $row->album_id; ?>" class="text_area" />
                                <?php if($row->data_type=='flickr'){ ?>
                                <div class="info">
                                    Insert only one Album ID <a href="<?php echo plugins_url( '/images/flickr_album_id.jpg' , __FILE__ );?>" target="_blank">Get Flickr Album ID </a>
                                </div>
                                <?php } ?>
                                <?php if($row->data_type=='googleplus'){ ?>
                                    <div class="info">
                                        Insert only one Album ID <a href="<?php echo plugins_url( '/images/google_album_id.jpg' , __FILE__ );?>" target="_blank">Get Google Album ID </a>
                                    </div>
                                <?php } ?>
                                <?php if($row->data_type=='facebook'){ ?>
                                    <div class="info">
                                        Insert only one Album ID <a href="<?php echo plugins_url( '/images/facebook_album.jpg' , __FILE__ );?>" target="_blank">Get facebook Album ID </a>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="multi_album gallery_padding">
                                <label for="album_include">Include Album ID</label>
                                <input type="text" name="album_include" id="album_include" value="<?php echo $row->album_include; ?>" class="text_area" />
                                <?php if($row->data_type=='flickr'){ ?>
                                    <div class="info">
                                        Insert multiple Albums ID to display: Example (Album1 ID, Album2 ID,...) <a href="<?php echo plugins_url( '/images/flickr_album_id.jpg' , __FILE__ );?>" target="_blank">Get Flickr Album ID </a>
                                    </div>
                                <?php } ?>
                                <?php if($row->data_type=='googleplus'){ ?>
                                    <div class="info">
                                        Insert multiple Albums ID to display: Example (Album1 ID, Album2 ID,...) <a href="<?php echo plugins_url( '/images/google_album_id.jpg' , __FILE__ );?>" target="_blank">Get Google Album ID </a>
                                    </div>
                                <?php } ?>
                                <?php if($row->data_type=='facebook'){ ?>
                                    <div class="info">
                                        Insert multiple Albums ID to display: Example (Album1 ID, Album2 ID,...) <a href="<?php echo plugins_url( '/images/facebook_album.jpg' , __FILE__ );?>" target="_blank">Get facebook Album ID </a>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="multi_album gallery_padding">
                                <label for="album_exclude">Exclude Album ID</label>
                                <input type="text" name="album_exclude" id="album_exclude" value="<?php echo $row->album_exclude; ?>" class="text_area" />
                                <?php if($row->data_type=='flickr'){ ?>
                                    <div class="info">
                                        Insert Albums ID you don't want to display: Example (Album1 ID, Album2 ID,...) <a href="<?php echo plugins_url( '/images/flickr_album_id.jpg' , __FILE__ );?>" target="_blank">Get Flickr Album ID </a>
                                    </div>
                                <?php } ?>
                                <?php if($row->data_type=='googleplus'){ ?>
                                    <div class="info">
                                        Insert Albums ID you don't want to display: Example (Album1 ID, Album2 ID,...) <a href="<?php echo plugins_url( '/images/google_album_id.jpg' , __FILE__ );?>" target="_blank">Get Google Album ID </a>
                                    </div>
                                <?php } ?>
                                <?php if($row->data_type=='facebook'){ ?>
                                    <div class="info">
                                        Insert Albums ID you don't want to display: Example (Album1 ID, Album2 ID,...) <a href="<?php echo plugins_url( '/images/facebook_album.jpg' , __FILE__ );?>" target="_blank">Get facebook Album ID </a>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="single_album gallery_padding">
                                <label for="data_limit">Photo Limit</label>
                                <input type="text" name="album_limit" id="album_limit" value="<?php echo $row->album_limit; ?>" class="text_area" />
                                <div class="info">
                                    An integer to limit the number of photos in album.
                                    </br> <em>If value (0) it will display all photos.</em>
                                </div>
                            </div>
                            <div class="multi_album gallery_padding">
                                <label for="data_limit">Album Limit</label>
                                <input type="text" name="data_limit" id="data_limit" value="<?php echo $row->data_limit; ?>" class="text_area" />
                                <div class="info">
                                    An integer to limit the number of albums in gallery.
                                    </br> <em>If value (0) it will display all photos.</em>
                                </div>
                            </div>

                        </li>
                        <?php } ?>
                        <?php if($row->data_type=='instagram'){ ?>
                        <li>
                            <div class="single_album gallery_padding">
                                <label for="data_limit">Photo Limit</label>
                                <input type="text" name="album_limit" id="album_limit" value="<?php echo $row->album_limit; ?>" class="text_area" />
                                <div class="info">
                                    An integer to limit the number of photos in album.
                                    </br> <em>If value (0) it will display all photos.</em>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                        <li>
                            <label for="description">Description</label>
                            <textarea  name="description" id="description" value="<?php echo $row->description; ?>" class="text_area"><?php echo $row->description; ?></textarea>
                            <div class="clr"></div>
                        </li>
                        <input type="button" onclick="submitbutton('apply')" value="Save Album" id="save-buttom" class="button button-primary button-large">
                        <a class="md-trigger button_delete_album button button-primary button-large" data-modal="modal-2" data-value="<?php echo esc_attr($row->id)?>" >Delete Album</a>
                        <li class="clr"></li>
					</ul>
<!--                    <a class="tz_gallery_cancel" href="admin.php?page=tz_plusgallery"><img src="--><?php //echo $path_site2; ?><!--/cancel.png"/> </a>-->
				</div>
			</div>
				
			<!-- SIDEBAR -->
			<div id="tz_gallery-container-1" class="tz_gallery-container">
                <div id="tz_gallery-shortcode-box" class="tz_gallery_box shortcode ms-toggle">

                </div>

				<div id="tz_gallery-shortcode-box" class="tz_gallery_box shortcode ms-toggle tz_gallery-shortcode-box">
                    <div class="tz_gallery_box_options">
                        <h3 class="hndle"><span>Basic Options</span></h3>
                        <div class="inside">
                            <ul>
                                <li rel="tab-1" class="selected">
                                    <h4>Box Color</h4>
                                    <input data-default-color="#38beea" type="text" id="boxColor" value="<?php echo esc_attr($row_options->options_color);?>" name="options_color" />
                                    <p class="description"><?php _e('Set color for box gallery thumbnails.') ?></p>
                                    <script type="text/javascript">
                                        jQuery(document).ready(function($){
                                            $("#boxColor").wpColorPicker();
                                        });
                                    </script>
                                </li>
                                <li rel="tab-2">
                                    <h4>Columns Layout</h4>
                                    <select name="options_columns" class="options_columns">
                                        <option value="2" <?php if($row_options->options_columns==2){?>selected <?php }?>>2 Columns</option>
                                        <option value="3" <?php if($row_options->options_columns==3){?>selected <?php }?>>3 Columns</option>
                                        <option value="4" <?php if($row_options->options_columns==4){?>selected <?php }?>>4 Columns</option>
                                        <option value="5" <?php if($row_options->options_columns==5){?>selected <?php }?>>5 Columns</option>
                                        <option value="6" <?php if($row_options->options_columns==6){?>selected <?php }?>>6 Columns</option>
                                        <option value="7" <?php if($row_options->options_columns==7){?>selected <?php }?>>7 Columns</option>
                                        <option value="8" <?php if($row_options->options_columns==8){?>selected <?php }?>>8 Columns</option>
                                    </select>
                                </li>

                                <li rel="tab-3">
                                    <h4>Album Padding</h4>
                                    <input type="text" value="<?php echo esc_attr($row_options->options_padding);?>" name="options_padding" class="text_area"/>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="tz_gallery_box_options">
                        <h3 class="hndle"><span>Usage</span></h3>
                        <div class="inside">
                            <ul>
                                <li rel="tab-3" class="selected">
                                    <h4>Shortcode</h4>
                                    <p>Copy &amp; paste the shortcode directly into any WordPress post or page.</p>
                                    <textarea class="full" readonly="readonly">[tz_plusgallery id="<?php echo $row->id; ?>"]</textarea>
                                </li>
                                <li rel="tab-4">
                                    <h4>Template Include</h4>
                                    <p>Copy &amp; paste this code into a template file to include the slideshow within your theme.</p>
                                    <textarea class="full" readonly="readonly">&lt;?php echo do_shortcode("[tz_plusgallery id='<?php echo $row->id; ?>']"); ?&gt;</textarea>
                                </li>
                            </ul>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="task" value="" />
</form>
</div>

    <script type="text/javascript">
        jQuery('.tz-delete-no').on('click', function(){
            jQuery('#modal-2').removeClass('md-show');
        })

        var album_type_val = jQuery('.album_type').val();
        var xTriggered = 0;
        if(album_type_val=='multi_album'){
            jQuery('.single_album').addClass('album_hide');
        }
        if(album_type_val=='single_album'){
            jQuery('.multi_album').addClass('album_hide');
        }
        if(album_type_val=='all_albums'){
            jQuery('.multi_album').addClass('album_hide');
            jQuery('.single_album').addClass('album_hide');
        }
        jQuery('.album_type').on('change',function(){
            var album_type = jQuery(this).val();
            if(album_type=='multi_album'){
                jQuery('.multi_album').slideDown();
                jQuery('.single_album').slideUp();
            }
            if(album_type=='single_album'){
                jQuery('.single_album').slideDown();
                jQuery('.multi_album').slideUp();
            }
            if(album_type=='all_albums'){
                jQuery('.single_album').slideUp();
                jQuery('.multi_album').slideUp();
            }
        })

        jQuery('#gallery-content input.text_area').on('focus',function(){
            jQuery(this).parent().find('.info').addClass('info_active');
        })

        jQuery('#gallery-content input.text_area').on('focusout',function(){
            jQuery(this).parent().find('.info').removeClass('info_active');
        })

        jQuery( "#gallery-content input.text_area" ).keydown(function( event ) {
            xTriggered++;
            if(xTriggered>3){
                jQuery(this).parent().find('.info').removeClass('info_active');
            }
        })
    </script>

<?php

}
