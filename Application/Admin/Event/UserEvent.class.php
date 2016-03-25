<?php 
namespace Admin\Event;
use \Think\Controller;

class UserEvent extends Controller{

	public function filter(){
		echo "Event filter<br>";
	}
}