<script type="text/javascript">
<?php //style object: an array called style of objects->id = style id objects->name=style name objects->image = link to an example image objects->description = style description ?>
var style = [];
<?php 
$q = "SELECT * FROM `style` WHERE `status` = 1 ORDER BY `style`;";
$r = mysqli_query($dbc, $q);
if($r){
	$i = 0;
	while($results = mysqli_fetch_assoc($r)){
		echo "style[$i] = {id:'".$results['style_id']."', name:'".$results['style']."', image:'".$results['image']."', description:'".$results['description']."'};";
		$i++;
	}
}
?>

</script>

