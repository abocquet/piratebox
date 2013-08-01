<?php 
	
	if($config['display_welcome_text']) 
	{

?>

<article>
	<p>
		<?php echo  $config["welcome_text"]; ?>
	</p>
</article>

<?php 
	} 

	if($config['display_file_explorer']) 
	{
		include("consulter.php");
	}

	if($config['display_file_adder']) 
	{
		include("deposer.php");
	}  

?>
