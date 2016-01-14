<?php  
function HookInplaceeditAllBeforesearchresults(){
	global $baseurl,$k,$baseurl_short,$css_reload_key, $local, $search, $order_by, $collection, $archive, $sort, $offset, $userref, $editable_empty_text;
?>
<link rel="stylesheet" type="text/css" media="screen,projection,print" href="<?php echo $baseurl_short?>plugins/inplaceedit/css/jqueryui-editable.css?css_reload_key=<?php echo $css_reload_key?>"/>

<script type="text/javascript" src="<?php echo $baseurl_short?>plugins/inplaceedit/lib/js/jquery-editable-poshytip.js?css_reload_key=<?php echo $css_reload_key?>"></script>
<script language="javascript">
//turn to inline mode
jQuery.fn.editable.defaults.mode = 'inline';
jQuery(document).ready(function() {
    jQuery('.editablefield').editable({
        emptytext: '<?php echo $editable_empty_text?>',
        url: function(params) {
            jQuery(this).editable('submit', {  
                    url: '<?php echo $baseurl_short?>plugins/inplaceedit/pages/ajax/updatefield.php?ref='+jQuery(this).attr('rel')+'&value='+encodeURIComponent(params.value)+'&oldvalue='+jQuery(this).attr('olddata-pk')+'&userref=<?php echo $userref?>&field='+jQuery(this).attr('data-pk')   
                    });
        }
    });

});

</script>
<?php }

function HookInplaceeditAllReplaceresourcepanelinfo(){
global $x, $value, $show_extension_in_search, $infobox, $url, $result, $ref, $df, $in_place_editable, $n;
if (!in_array($df[$x]['ref'], $in_place_editable)) return false;
# Should this field be displayed?
if 
	((!in_array($df[$x]['ref'], $in_place_editable))
//	||
//		# Field is an archive only field
//		(($result[$n]["archive"]==0) && ($df[$x]["resource_type"]==999))
	||
		# Field has write access denied
		(checkperm("F*") && !checkperm("F-" . $df[$x]["ref"])
		&& !($ref<0 && checkperm("P" . $df[$x]["ref"])) # Upload only field
		)
	||			
		checkperm("F" . $df[$x]["ref"])
	||
		($ref<0 && $df[$x]["hide_when_uploading"] && $df[$x]["required"]==0)		) return false;
?>
<div class="ResourcePanelInfo"><div class="extended">
<a class="editablefield" olddata-pk="<?php echo htmlspecialchars($value)?>" data-pk="<?php echo $df[$x]['ref'] ?>" rel="<?php echo urlencode($ref); ?>" id="title<?php echo htmlspecialchars($ref)?>" href="#">
<?php echo format_display_field($value);
?><?php if ($show_extension_in_search) { ?><?php echo " " . str_replace_formatted_placeholder("%extension", $result[$n]["file_extension"], $lang["fileextension-inside-brackets"])?><?php } ?></a></div></div>
<?php 
return true;
} 
function HookInplaceeditAllReplaceresourcepanelinfolarge(){
global $x, $value, $show_extension_in_search, $infobox, $url, $result, $ref, $df, $in_place_editable, $n;

if (!in_array($df[$x]['ref'], $in_place_editable)) return false;
# Should this field be displayed?
if 
	((!in_array($df[$x]['ref'], $in_place_editable))
//	||
//		# Field is an archive only field
//		(($result[$n]["archive"]==0) && ($df[$x]["resource_type"]==999))
	||
		# Field has write access denied
		(checkperm("F*") && !checkperm("F-" . $df[$x]["ref"])
		&& !($ref<0 && checkperm("P" . $df[$x]["ref"])) # Upload only field
		)
	||			
		checkperm("F" . $df[$x]["ref"])
	||
		($ref<0 && $df[$x]["hide_when_uploading"] && $df[$x]["required"]==0)		) return false;
?>
<div class="ResourcePanelInfo"><div class="extended">
<a class="editablefield" olddata-pk="<?php echo htmlspecialchars($value)?>" data-pk="<?php echo $df[$x]['ref'] ?>" rel="<?php echo urlencode($ref); ?>" id="title<?php echo htmlspecialchars($ref)?>" href="#">
<?php echo format_display_field($value);
?><?php if ($show_extension_in_search) { ?><?php echo " " . str_replace_formatted_placeholder("%extension", $result[$n]["file_extension"], $lang["fileextension-inside-brackets"])?><?php } ?></a></div></div>
<?php 
return true;
} 