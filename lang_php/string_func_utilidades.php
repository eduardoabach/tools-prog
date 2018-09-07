<?php

function bootstrap_input_class_by_size($length){
	switch ($length):
		case ($length < 6):
			$class = 'input-mini';
			break;
		case($length < 10):
			$class = 'input-small';
			break;
		case($length < 17):
			$class = 'input-medium';
			break;
		case($length < 21):
			$class = 'input-large';
			break;
		case($length < 42):
			$class = 'input-xlarge';
			break;
		default:
			$class = 'input-xxlarge';
			break;
	endswitch;

	return $class;
}

?>