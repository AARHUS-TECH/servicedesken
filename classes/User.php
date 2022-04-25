<?php 

    class User {

        private $_db;

        function __construct() {
            $this->_db = new Database();
        }

        public function exists($value) {
            if(is_numeric($value)) {
                $data = array(
                    'userID'        => $value
                );
            } else if(is_string($value)) {

                $data = array(
                    'brugernavn'            => $value
                );

                $result = $this->_db->check_exist('servicedesk_bruger', $data);

                return $result;
            }
        }


        public function opretBruger($navn, $brugernavn, $password = null, $user_level) {

            if(!empty($navn) && !empty($brugernavn) && isset($password)) {
                if($this->exists($brugernavn)) {
                    Session::flash('bruger_error', 'Der eksisterer allerede en bruger med den valgte brugernavn!');
                    Redirect::to('/admin/bruger/opretBruger.php');
                }
                
                $data = array(
                    'navn'              => $navn,
                    'brugernavn'        => $brugernavn,  
                    'password'          => password_hash($password, PASSWORD_DEFAULT),
                    'user_level'        => $user_level
                );
    
                $this->_db->insert('servicedesk_bruger', $data);
                Session::flash('dashboard_success', 'Brugeren <b>' . $navn . '</b> blev registreret i systemet!' );
                Redirect::to('/admin/bruger/');
            } else {
                die($navn . ' ' . $brugernavn . ' ' . $password . ' ' . $user_level);
                Session::flash('bruger_error', 'Alle felter skal udfyldes!');
                Redirect::to('/admin/bruger/opretBruger.php');
            }
        }


        public function update($userID, $navn, $brugernavn, $password = null, $user_level) {
            if(!$password == null) {
                $data = array(
                    'navn'              => $navn,
                    'brugernavn'        => $brugernavn,
                    'password'          => password_hash($password, PASSWORD_BCRYPT),
                    'user_level'        => $user_level
                );
            } else {
                $data = array(
                    'navn'              => $navn,
                    'brugernavn'        => $brugernavn,
                    'user_level'        => $user_level
                );
            }

            $this->_db->update('servicedesk_bruger', $data, 'userID', $userID);
            Session::flash('dashboard_success', 'Du redigerede brugeren <b>' . $data['navn'] . '</b>!');
            Redirect::to('/admin/bruger/');

        }


        public function delete($id) {
            //$this->_db->delete('servicedesk_bruger', 'id', $id);

            $sql = "DELETE FROM servicedesk_bruger WHERE userID='$id' LIMIT 1";
            echo $sql;

            $result = $this->_db->custom_query($sql);
        }


        public function auth() {
            if(Input::get('brugernavn')) {
                $this->login(Input::get('brugernavn'), Input::get('adgangskode'));
            }
        }


        private function login($value1, $value2) {
            $sql = "SELECT userID, password FROM servicedesk_bruger WHERE brugernavn='$value1' LIMIT 1";
                
            $result = $this->_db->custom_query($sql);
                
            foreach($result as $row) {
                $userID = $row->userID;
                $passwd = $row->password;
            }

            if(empty($userID)) {
                Session::flash('index_error', 'Det brugte brugernavn og adgangskode er ikke registreret i systemet!');
                Redirect::to('/');
            }

            if(password_verify($value2, $passwd)) {
                if($this->isAdmin($userID)) {
                    $_SESSION['userID'] = $userID;
                    Redirect::to('/admin/');
                } else {
                    $_SESSION['userID'] = $userID;
                    Redirect::to('/admin/');
                }
            } else {
                Session::flash('index_error', 'Det brugte brugernavn og adgangskode er ikke registreret i systemet!');
                Redirect::to('/');
            }
        }


        public function getInfo($value) {
            if(is_numeric($value)) {
                $sql = "SELECT * FROM servicedesk_bruger WHERE userID='$value'";
                $result = $this->_db->custom_query($sql);
                
                foreach($result as $row) {
                    $userdata = array(
                        'userID' => $row->userID,
                        'navn' => $row->navn,
                        'brugernavn' => $row->brugernavn,
                        'user_level' => $row->user_level,
                    );
                }
                return $userdata;
            } else {
                die('Value given is not numeric! getInfo(> ! <)');
            }

        }


        public function getStatusString($value) {
            switch($value) {
                case '0':
                    $status = 'Tjekket ud';
                    break;
                case '1':
                    $status = 'Tjekket ind';
                    break;
                case '2':
                    $status = 'Tjekket ind (Forsinket)';
                    break;
                default:
                    $status = 'Ukendt';
            }

            return $status;
        }


        public function getStatusClass($value) {
            switch($value) {
                case '0':
                    $status = 'danger';
                    break;
                case '1':
                    $status = 'success';
                    break;
                case '2':
                    $status = 'warning';
                    break;
                default:
                    $status = 'default';
            }

            return $status;
        }


        public function isAdmin($userID) {
            $data = array(
                'userID' => $userID,
                'user_level' => '1'
            );

            return $this->_db->check_exist('servicedesk_bruger', $data);
        }

        
        public function getAllUsers() {
            $sql = "SELECT * FROM servicedesk_bruger ORDER BY user_level DESC";
            $result = $this->_db->custom_query($sql);

            foreach($result as $row) {
                echo '<tr>';
                echo '<td>' . $row->navn .'</td>';
                echo '<td>' . $row->brugernavn . '</td>';
                if($row->user_level == 1) {
                    echo '<td>Instruktør</td>';
                } else {
                    echo '<td>Elev</td>';
                }

                echo '<td><a class="btn btn-outline-success full-width" href="/admin/bruger/opdaterBruger.php?id=' . $row->userID . '">Rediger</a></td>';
                echo '</tr>'; 
            }
        }

        
        public function getSelectedUserLevel($user_level) {
            switch($user_level) {
                case '0':
                   echo '<option value="" disabled>Vælg</option>';
                   echo '<option value="1">Instruktør</option>';
                   echo '<option value="0" selected>Elev</option>';
                break;
                case '1':
                    echo '<option value="" disabled>Vælg</option>';
                    echo '<option value="1" selected>Instruktør</option>';
                    echo '<option value="0">Elev</option>';
                break;
                default:
                break;
            }

            return 1;
        }
    }

?>