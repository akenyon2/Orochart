<?php
class Debugger{

	public function __construct(){
		die('Debugger constructor is not allowed.');
	}
	
	public static function debug($temp){
		if ( is_array( $temp ) )
			$output = "<script>console.log( 'Debug Objects: " . implode( ',', $temp) . "' );</script>";
		else
			$output = "<script>console.log( 'Debug Objects: " . $temp . "' );</script>";

		echo $output;
	}
}
?>