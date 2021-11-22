<?php
require_once('../../core/init.php');

if (Session::exists('userID')) {
    Session::delete('userID');
    Session::flash('home_success', 'Du blev logget ud!');
	Redirect::to('/');

}

Session::delete('userID');
Redirect::to("http://servicedesken.skp");
