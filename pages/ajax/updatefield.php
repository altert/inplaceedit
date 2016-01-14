<?php 
include ('../../../../include/config.php');
include('../../../../include/db.php');
include('../../../../include/general.php');
include('../../../../include/resource_functions.php');
$value=getvalescaped("value","");
$oldvalue=getvalescaped("oldvalue","");
$ref=getvalescaped("ref","");
$userref=getvalescaped("userref","");
$field=getvalescaped("field","");
debug("save:".$field.",".$ref.",".$value);
update_field($ref,$field,$value);
resource_log($ref,'e',$field,"",unescape($oldvalue),unescape($value));
echo "saved";

?>