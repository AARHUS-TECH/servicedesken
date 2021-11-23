<?php
require_once('../core/init.php');

$user = new User();


if(!Session::exists('userID')) {
    Session::flash('index_error', 'Du skal være logget ind for at kunne tilgå denne side!');
    Redirect::to('/');
}



$userdata = $user->getInfo(Session::get('userID'));

require_once("../assets/tpl/splash_header.php");

if ( $user->isAdmin(Session::get('userID')) ) 
{
 ?>
                                    <div class="form-group text-center">
                                        <a class="btn btn-outline-success full-width" href="/admin/bruger/">Bruger systemet</a>
                                    </div>
<?php 
}
	require_once("../assets/tpl/splash_footer.php"); 
?>

