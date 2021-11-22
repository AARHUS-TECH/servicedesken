<?php  

class Errors {

    public static function getErrorMessage($session) {
        if(Session::exists($session)) {
            $message  = '<div class="row">';
            $message .= '<div class="alert alert-dismissible alert-danger full-width">';
            $message .= '<p class="text-center no-margin">' . Session::get($session) . '</p>';
            $message .= '</div>';
            $message .= '</div>';

            Session::delete($session);

            return $message;
        }
        return false;
    }

    public static function getSuccessMessage($session) {
        if(Session::exists($session)) {
            $message  = '<div class="alert alert-dismissible alert-success full-width">';
            $message .= '<p class="text-center no-margin">' . Session::get($session) . '</p>';
            $message .= '</div>';

            Session::delete($session);

            return $message;
        }
        return false;
    }

}

?>