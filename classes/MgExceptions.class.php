<?php

class MgExceptions {
	
	public static $error1 = "<b>Error 01:</b> Missing configuration file.<br>
							Please create a file called '<i>DBOConfiguration.xml</i>' 
							and fill it with your database information.";

	public static $error2 = "<b>Error 02:</b> Failed to connect to MySql.<br>
							Please check your configuration file.";

	public static $error3 = "<b>Error 03:</b> Failed to connect to database.<br>
							Please check your configuration file.";

	public static $error4 = "<b>Error 04:</b> You need to configure() before initialize.";

	public static $error5 = "<b>Error 05:</b> You didn't defined this connection.";

	public static function ExceptionThrower($e){

        $trace  = $e->getTrace();

        echo "<div style='
        			background-color:#eee;
        			padding:5px'>";

		echo "<b>Caught exception: </b>\n<blockquote>"
	    		.$e->getMessage()
	    		."</blockquote>";

	    echo "<b>Stack trace:</b>";

	    reset($trace);

        foreach($trace as $t){
        	echo "<blockquote>";
        }

		echo "\n"."on line <b>"
		.$e->getLine()
		."</b> of <i>"
		.$e->getFile()
		."</i></blockquote>";

        next($trace);

	    foreach($trace as $t){
    		echo "\n"."on line <b>"
    		.$t["line"]
    		."</b> of <i>"
    		.$t["file"]
    		."</i></blockquote>";
	    }

	    echo "</div><br/>";

	}

}

?>