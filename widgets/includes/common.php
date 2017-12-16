<?php
/*
common.php - a place to store our favorite functions
*/


/*
Used for error handling

*/
function myerror($myFile, $myLine, $errorMsg)
{
    if(defined('DEBUG') && DEBUG)
    {
       echo "Error in file: <b>" . $myFile . "</b> on line: <b>" . $myLine . "</b><br />";
       echo "Error Message: <b>" . $errorMsg . "</b><br />";
       die();
    }else{
		echo "I'm sorry, we have encountered an error.  Would you like to buy some socks?";
		die();
    }
}



/*
 loads header include file from theme folder 

*/

function get_header($file=''){
    global $config;
    static $header_loaded = false;
    if($file == ''){//load included file
        if(!$header_loaded)
        {//header loads first time
            $file = 'header.php'; 
            $header_loaded = true;
        }else{
            $file = 'footer.php';
        }
           
    }
    
    $file = $config->physical_path . '/themes/' . $config->theme . '/' . $file;
    
    if(file_exists($file)){
        include $file;
    }else{
        myerror(__FILE__,__LINE__,'include file not found: ' . $file);
    }
    }#end get_header()

function get_footer()
{
    global $config;
    get_header();
}#get_footer() is same function, run second time with footer file

/**
 * Wrapper function for processing data pulled from db
 *
 * Forward slashes are added to MySQL data upon entry to prevent SQL errors.  
 * Using our dbOut() function allows us to encapsulate the most common functions for removing  
 * slashes with the PHP stripslashes() function, plus the trim() function to remove spaces.
 *
 * @param string $str data as pulled from MySQL
 * @return $str data cleaned of slashes, spaces around string, etc.
 * @see dbIn()
 * @todo none
 */
function dbOut($str)
{
	if($str!=""){$str = stripslashes(trim($str));}//strip out slashes entered for SQL safety
	return $str;
} #End dbOut()

/**
 * returns a random item from an array sent to it.
 *
 * Uses count of array to determine highest legal random number.
 *
 * Used to show random HTML segments in sidebar, etc.
 *
 * <code>
 * $arr[] = '<img src="mypic1.jpg" />';
 * $arr[] = '<img src="mypic2.jpg" />';
 * $arr[] = '<img src="mypic3.jpg" />';  
 * echo randomize($arr); #will show one of three random images
 * </code>
 *
 * @param array array of HTML strings to display randomly
 * @return string HTML at random index of array
 * @see rotate() 
 * @todo none
 */
function randomize ($arr)
{//randomize function is called in the right sidebar - an example of random (on page reload)
	if(is_array($arr))
	{//Generate random item from array and return it
		return $arr[mt_rand(0, count($arr) - 1)];
	}else{
		return $arr;
	}
}#end randomize()

/**
 * returns a daily item from an array sent to it.
 *
 * Uses count of array to determine highest legal rotated item.
 *
 * Uses day of month and modulus to rotate through daily items in sidebar, etc.
 *
 * <code>
 * $arr[] = '<img src="mypic1.jpg" />';
 * $arr[] = '<img src="mypic2.jpg" />';
 * $arr[] = '<img src="mypic3.jpg" />';  
 * echo rotate($arr); #will return a different image each day for three days
 * </code>
 * 
 * @param array array of HTML strings to display on a daily rotation
 * @return string HTML at specific index of array based on day of month
 * @see rotate() 
 * @todo none
 */
function rotate ($arr)
{//rotate function is called in the right sidebar - an example of rotation (on day of month)
	if(is_array($arr))
	{//Generate item in array using date and modulus of count of the array
		return $arr[((int)date("j")) % count($arr)];
	}else{
		return $arr;
	}
}#end rotate
