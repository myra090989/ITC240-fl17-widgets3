<?php include 'includes/config.php'?>
<?php get_header();?>`
<?php
if(isset($_GET['day']))
{//from the querystring
    $day = $_GET['day'];
    
}else{//from the system clock
 $day = date('l');
}


?>

<h3> Welcome to Widgetville</h3>
<p>Current contents of the variable day: <?=$day?></p>
<p><a href="?day=Monday">Monday</a></p>
<p><a href="?day=Tuesday">Tuesday</a></p>
<p><a href="?day=Wednesday">Wednesday</a></p>




<?php get_footer();?>