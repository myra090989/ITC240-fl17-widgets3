<?php include 'includes/config.php'?>
<?php include 'includes/planets.php'?>
<?php get_header()?>


<h3>Randomize & Rotate</h3>
<p>Code to use to 'widgetize' your header/footer & sidebar areas</p>
<h3>Random SuperHero</h3>
<p>Uses <b>randomize()</b> function and an array named <b>$heros</b> to 
display a random hero icon on page reloads.</p>
<p>
<?php
$heros[] = '<img src="images/coulson.png" />';
$heros[] = '<img src="images/fury.png" />';
$heros[] = '<img src="images/hulk.png" />';
$heros[] = '<img src="images/thor.png" />';
$heros[] = '<img src="images/black-widow.png" />';
$heros[] = '<img src="images/captain-america.png" />';
$heros[] = '<img src="images/machine.png" />';
$heros[] = '<img src="images/iron-man.png" />';
$heros[] = '<img src="images/loki.png" />';
$heros[] = '<img src="images/giant.png" />';
$heros[] = '<img src="images/hawkeye.png" />';
echo randomize($heros);
?>
</p>
<p>The hero icons come from <a href="http://icongal.com/gallery/iconset/2503/avengers_superhero_avatar" target="_blank">here</a></p>


<h3>Daily Planet</h3>
<p>Uses <b>rotate()</b> function and an array named <b>$planets</b> from an include file to 
display a different planet and astrological info for each day.</p>
<p>
There are 8 planets in the array, so after 8 days the planets start again from the beginning.
</p>
<p>
<?php
echo rotate($planets);
?>
</p>

<?php get_footer()?>