<?php

class Inventar {
    private $_db;
    
    function __construct() {
        $this->_db = new Database();
        $this->_user = new User();
    }

    public function getAllItems() {
        $sql = "SELECT * FROM servicedesk_inv_items";
        $result = $this->_db->custom_query($sql);

        foreach($result as $row) {
            echo '<tr>';
            echo '<td>' . $row->item_navn . '</td>';
            echo '<td>' . $row->item_antal . ' (' . 0 . ')</td>';
            echo '<td>' . $row->item_placering . '</td>';
            echo '<td><img class="item_foto" src="' . $row->item_foto . '"></td>';
            echo '<td>' . $row->item_beskrivelse . '</td>';
            echo '<td><a class="btn btn-outline-success full-width" href="">Rediger</a><a class="btn btn-outline-success full-width" style="margin-top: 10px;" href="">Udlån</a><a class="btn btn-outline-danger full-width" style="margin-top: 10px;" href="">Slet</a></td>';
            
            echo '</tr>';
        }

        return true;
    }
}