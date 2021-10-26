<?php
    class Tickets {
        private $_db;
        
        function __construct() {
            $this->_db = new Database();
            $this->_user = new User();
        }

        public static function getDiscordKategori($value) {
            switch ($value) {
                case 1:
                    return 'Servicedesk';
                    break;
                case 2:
                    return 'Elektronik';
                    break;
                case 3:
                    return 'Programmør';
                    break;
                case 4:
                    return 'Techdesk';
                    break;
                case 5:
                    return 'Ekstern';
                    break;
                case 1000:
                    return 'Andet';
                    break;
                
                default:
                    return 'Ukendt';
                    break;
            }
        }


        public static function discordNotification($kategori, $prioritet) {
            // Replace the URL with your own webhook url
            $url = "https://discordapp.com/api/webhooks/619497988586340353/U_fIYkX-8tzRszQ3qoVS7AnWL-H3MJ3u83j-0zH_rFHz8zDsC2SeK6YwHWb0BJKkevj7";

            $hookObject = json_encode([
                /*
                * The general "message" shown above your embeds
                */
                "content" => "@everyone der er blevet oprettet en ny ticket i ticket-systemet!",
                /*
                * The username shown in the message
                */
                "username" => "Ticket System Notifikation",
                /*
                * The image location for the senders image
                */
                "avatar_url" => "",
                /*
                * File contents to send to upload a file
                */
                // "file" => "",
                /*
                * An array of Embeds
                */
                "embeds" => [
                    /*
                    * Our first embed
                    */
                    [
                        // Set the title for your embed
                        "title" => "Ny sag i ticket-systemet!",

                        // The type of your embed, will ALWAYS be "rich"
                        "type" => "rich",

                        // A description for your embed
                        "description" => "",

                        // The URL of where your title will be a link to
                        "url" => "http://servicedesken.skp/",

                        // The integer color to be used on the left side of the embed
                        "color" => hexdec( "FF0000" ),

                        // Footer object
                        "footer" => [
                            "text" => "Skolepraktikken Aarhus Tech",
                        ],

                        // Thumbnail object
                        "thumbnail" => [
                            "url" => "https://pbs.twimg.com/profile_images/972154872261853184/RnOg6UyU_400x400.jpg"
                        ],

                        // Author object
                        "author" => [
                            "name" => "Ny sag!",
                        ],

                        // Field array of objects
                        "fields" => [
                            [
                                "name" => "Kategori",
                                "value" => Self::getDiscordKategori($kategori),
                                "inline" => true
                            ],
                            // Field 3
                            [
                                "name" => "Prioritet",
                                "value" => $prioritet,
                                "inline" => true
                            ]
                        ]
                    ]
                ]

            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

            $ch = curl_init();

            curl_setopt_array( $ch, [
                CURLOPT_URL => $url,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $hookObject,
                CURLOPT_HTTPHEADER => [
                    "Length" => strlen( $hookObject ),
                    "Content-Type" => "application/json"
                ]
            ]);

            $response = curl_exec( $ch );
            curl_close( $ch );
        }


        public function create($modtagerID, $kategori, $priortet, $produktNavn, $produktModel, $produktFejlbeskrivelse, $kontaktNavn, $kontaktEmail, $kontaktTelefon) {
            $data = array(
                'sags_kategori'             => $kategori,
                'status'                    => 'Afventer',
                'priortet'                  => $priortet,
                'kontakt_navn'              => $kontaktNavn,
                'kontakt_tlf'               => $kontaktTelefon,
                'kontakt_email'             => $kontaktEmail,
                'modtagerID'                => $modtagerID,
                'modtager_dato'             => date('Y-m-d H:i:s'),
                'produkt_navn'              => $produktNavn,
                'produkt_model'             => $produktModel,
                'produkt_antal'             => 1,
                'produkt_fejlbeskrivelse'   => $produktFejlbeskrivelse
            );

            $this->_db->insert('servicedesk_sager', $data);
            Self::discordNotification($kategori, $priortet);
            Session::flash('dashboard_success', 'Sagen blev oprettet med succes!');
            Redirect::to('/elev/tickets/');
        }


        public function update($kategori, $priortet, $produktNavn, $produktModel, $produktFejlbeskrivelse, $kontaktNavn, $kontaktEmail, $kontaktTelefon, $repareretID, $repareretDato, $repareretBeskrivelse, $status, $sagsID) {
            $data = array(
                'sags_kategori'             => $kategori,
                'status'                    => $status,
                'priortet'                  => $priortet,
                'kontakt_navn'              => $kontaktNavn,
                'kontakt_tlf'               => $kontaktTelefon,
                'kontakt_email'             => $kontaktEmail,
                'produkt_navn'              => $produktNavn,
                'produkt_model'             => $produktModel,
                'produkt_antal'             => 1,
                'produkt_fejlbeskrivelse'   => $produktFejlbeskrivelse,
                'repareretID'               => $repareretID,
                'repareret_dato'            => $repareretDato,
                'repareret_beskrivelse'     => $repareretBeskrivelse
            );

            $this->_db->update('servicedesk_sager', $data, 'sagsID', $sagsID);

            Session::flash('dashboard_success', 'Sagen blev opdateret med succes!');
        }


        public function getStatusClass($value) {
            switch($value) {
                case 'Afventer':
                    $statusClass = 'badge-primary';
                break;
                case 'Påbegyndt':
                    $statusClass = 'badge-warning';
                break;
                case 'Færdig (Klar til afhentning)':
                    $statusClass = 'badge-success';
                break;
                case 'Lukket':
                    $statusClass = 'badge-danger';
                break;
                default:
                    $statusClass = 'badge-danger';
                break;
            }

            return $statusClass;
        }


        public function getPriortetClass($value) {
            switch($value) {
                case 'Lav':
                    $priortetClass = 'badge-success';
                break;
                case 'Middel':
                    $priortetClass = 'badge-warning';
                break;
                case 'Høj':
                    $priortetClass = 'badge-primary';
                break;
                case 'Haster':
                    $priortetClass = 'badge-danger';
                break;
                default:
                    $priortetClass = 'badge-danger';
                break;
            }

            return $priortetClass;
        }


        public function getAllKategorier() {
            $sql = "SELECT * FROM servicedesk_kategorier";
            $result = $this->_db->custom_query($sql);

            echo '<option selected disabled value="">Vælg</option>';

            foreach($result as $row) {
                echo '<option value="' . $row->id . '">' . $row->kategori . '</option>';
            }
        }


        public function getAllSelectedKategorier($id) {
            $sql = "SELECT * FROM servicedesk_kategorier";
            $sql2 = "SELECT * FROM servicedesk_sager WHERE sagsID = $id";
            $result = $this->_db->custom_query($sql);
            $result2 = $this->_db->custom_query($sql2);

            foreach($result2 as $row2) {
                foreach($result as $row) {
                    if($row->id == $row2->sags_kategori) {
                        echo '<option value="' . $row->id . '" selected>' . $row->kategori . '</option>';
                    } else {
                        echo '<option value="' . $row->id . '">' . $row->kategori . '</option>';
                    }
                }
            }
        }


        public function getAllSelectedPriortet($id) {
            $sql = "SELECT * FROM servicedesk_sager INNER JOIN servicedesk_kategorier ON servicedesk_sager.sags_kategori = servicedesk_kategorier.id WHERE sagsID = $id";
            $result = $this->_db->custom_query($sql);

            foreach($result as $row) {
                switch($row->priortet) {
                    case 'Lav':
                        $priortet  = '<option value="Lav" selected>Lav</option>';
                        $priortet .= '<option value="Middel">Middel</option>';
                        $priortet .= '<option value="Høj">Høj</option>';
                        $priortet .= '<option value="Haster">Haster</option>';
                    break;
                    case 'Middel':
                        $priortet  = '<option value="Lav">Lav</option>';
                        $priortet .= '<option value="Middel" selected>Middel</option>';
                        $priortet .= '<option value="Høj">Høj</option>';
                        $priortet .= '<option value="Haster">Haster</option>';
                    break;
                    case 'Høj':
                        $priortet  = '<option value="Lav">Lav</option>';
                        $priortet .= '<option value="Middel">Middel</option>';
                        $priortet .= '<option value="Høj" selected>Høj</option>';
                        $priortet .= '<option value="Haster">Haster</option>';
                    break;
                    case 'Haster':
                        $priortet  = '<option value="Lav">Lav</option>';
                        $priortet .= '<option value="Middel">Middel</option>';
                        $priortet .= '<option value="Høj">Høj</option>';
                        $priortet .= '<option value="Haster" selected>Haster</option>';
                    break;
                    default:
                    break;
                }
            }

            return $priortet;
        }


        public function getAllSelectedStatus($id) {
            $sql = "SELECT * FROM servicedesk_sager INNER JOIN servicedesk_kategorier ON servicedesk_sager.sags_kategori = servicedesk_kategorier.id WHERE sagsID = $id";
            $result = $this->_db->custom_query($sql);

            foreach($result as $row) {
                switch($row->status) {
                    case 'Afventer':
                        $status  = '<option value="Afventer" selected>Afventer</option>';
                        $status .= '<option value="Påbegyndt">Påbegyndt</option>';
                        $status .= '<option value="Færdig (Klar til afhentning)">Færdig (Klar<br/> til afhentning)</option>';
                        $status .= '<option value="Lukket">Lukket</option>';
                    break;
                    case 'Påbegyndt':
                        $status  = '<option value="Afventer">Afventer</option>';
                        $status .= '<option value="Påbegyndt" selected>Påbegyndt</option>';
                        $status .= '<option value="Færdig (Klar til afhentning)">Færdig (Klar til afhentning)</option>';
                        $status .= '<option value="Lukket">Lukket</option>';
                    break;
                    case 'Færdig (Klar til afhentning)':
                        $status  = '<option value="Afventer">Afventer</option>';
                        $status .= '<option value="Påbegyndt">Påbegyndt</option>';
                        $status .= '<option value="Færdig (Klar til afhentning)" selected>Færdig (Klar til afhentning)</option>';
                        $status .= '<option value="Lukket">Lukket</option>';
                    break;
                    case 'Lukket':
                        $status  = '<option value="Afventer">Afventer</option>';
                        $status .= '<option value="Påbegyndt">Påbegyndt</option>';
                        $status .= '<option value="Færdig (Klar til afhentning)">Færdig (Klar til afhentning)</option>';
                        $status .= '<option value="Lukket" selected>Lukket</option>';
                    break;
                    default:
                    break;
                }
            }

            return $status;
        }


        public function getSelectedUsers($ticketId) {
            $sql = "SELECT * FROM servicedesk_bruger";
            $result = $this->_db->custom_query($sql);

            $sql2 = "SELECT * FROM servicedesk_sager WHERE sagsID = $ticketId LIMIT 1";
            $result2 = $this->_db->custom_query($sql2);

            foreach($result2 as $row2) {
                $repID = $row2->repareretID;
            }

            if(!$repID) {
                echo '<option value="0" disabled selected>Vælg</option>';
            }

            foreach($result as $row) {
                    if($row->userID == $repID) {
                        echo '<option value="' . $row->userID . '" selected>' . $row->navn . '</option>';
                    } else {
                        echo '<option value="' . $row->userID . '">' . $row->navn . '</option>';
                    }
            }
        }


        public function getAllTickets() {
             $sql = "SELECT * FROM servicedesk_sager INNER JOIN servicedesk_kategorier ON servicedesk_sager.sags_kategori = servicedesk_kategorier.id WHERE status <> 'Lukket' ORDER BY servicedesk_sager.priortet DESC, servicedesk_sager.status ASC, servicedesk_sager.sags_kategori ASC";
            $result = $this->_db->custom_query($sql);

            foreach($result as $row) {
                echo '<tr>';
                $temp_date = new DateTime($row->modtager_dato);       
                echo '<td><nobr>' . $temp_date->format('d-m-Y') . '</nobr><br />'. $temp_date->format('H:i') . '</td>';
                echo '<td><span class="badge ' . $this->getPriortetClass($row->priortet) . '">' . $row->priortet . '</span></td>';
                echo '<td><span class="badge ' . $this->getStatusClass($row->status) . '">' . $row->status . '</span></td>';
                echo '<td>' . $row->kategori . '</td>'; 

                if(strlen($row->produkt_fejlbeskrivelse) > 110) {
                    $fejlbeskrivelse = substr($row->produkt_fejlbeskrivelse, 0, 110) . ' ...';
                } else {
                    $fejlbeskrivelse = $row->produkt_fejlbeskrivelse;
                }

                echo '<td title="' . $row->produkt_fejlbeskrivelse . '">' . $fejlbeskrivelse . '<br /><a href="/elev/tickets/opdaterSag.php?id=' . $row->sagsID . '">Rediger</a></td>'; 
                echo '<td>' . $row->kontakt_navn . '</td>';
                echo '</tr>';         
            }
            return true;
        }


        public function getAllLukketTickets() {
            $sql = "SELECT * FROM servicedesk_sager INNER JOIN servicedesk_kategorier ON servicedesk_sager.sags_kategori = servicedesk_kategorier.id WHERE status = 'Lukket' ORDER BY servicedesk_sager.modtager_dato DESC";
            $result = $this->_db->custom_query($sql);
            
            foreach($result as $row) {
                echo '<tr>';
                //echo '<td>' . $row->sagsID .'</td>';
                $temp_date = new DateTime($row->modtager_dato);       
                echo '<td>' . $temp_date->format('d-m-Y H:i') .'</td>';
                echo '<td><span class="badge ' . $this->getStatusClass($row->status) . '">' . $row->status . '</span></td>';
                echo '<td><span class="badge ' . $this->getPriortetClass($row->priortet) . '">' . $row->priortet . '</span></td>';
                echo '<td>' . $row->kategori . '</td>'; 

                if(strlen($row->produkt_fejlbeskrivelse) > 110) {
                    $fejlbeskrivelse = substr($row->produkt_fejlbeskrivelse, 0, 110) . ' ...';
                } else {
                    $fejlbeskrivelse = $row->produkt_fejlbeskrivelse;
                }

                echo '<td title="' . $row->produkt_fejlbeskrivelse . '">' . $fejlbeskrivelse . '</td>'; 
                echo '<td><a class="btn btn-outline-success full-width" href="/elev/tickets/opdaterSag.php?id=' . $row->sagsID . '">Rediger</a></td>';
                echo '</tr>';         
            }
        }


        public function getAllAdminTickets() {
            $sql = "SELECT * FROM servicedesk_sager INNER JOIN servicedesk_kategorier ON servicedesk_sager.sags_kategori = servicedesk_kategorier.id WHERE status <> 'Lukket' ORDER BY servicedesk_sager.priortet DESC, servicedesk_sager.status ASC, servicedesk_sager.sags_kategori ASC";
            $result = $this->_db->custom_query($sql);
            
            foreach($result as $row) {
                echo '<tr>';
                $temp_date = new DateTime($row->modtager_dato);       
                echo '<td><nobr>' . $temp_date->format('d-m-Y') . '</nobr><br />'. $temp_date->format('H:i') . '</td>';
                echo '<td><span class="badge ' . $this->getPriortetClass($row->priortet) . '">' . $row->priortet . '</span></td>';
                echo '<td><span class="badge ' . $this->getStatusClass($row->status) . '">' . $row->status . '</span></td>';
                echo '<td>' . $row->kategori . '</td>'; 

                if(strlen($row->produkt_fejlbeskrivelse) > 110) {
                    $fejlbeskrivelse = substr($row->produkt_fejlbeskrivelse, 0, 110) . ' ...';
                } else {
                    $fejlbeskrivelse = $row->produkt_fejlbeskrivelse;
                }

                echo '<td title="' . $row->produkt_fejlbeskrivelse . '">' . $fejlbeskrivelse . '<br /><div style="text-align: right;"><a class="badge badge-primary" href="/admin/tickets/opdaterSag.php?id=' . $row->sagsID . '">Rediger</a></div></td>'; 
                echo '<td>' . $row->kontakt_navn . '</td>';
                echo '</tr>';         
            }
        }


        public function getAllLukketAdminTickets() {
            $sql = "SELECT * FROM servicedesk_sager INNER JOIN servicedesk_kategorier ON servicedesk_sager.sags_kategori = servicedesk_kategorier.id WHERE servicedesk_sager.status = 'Lukket' ORDER BY servicedesk_sager.modtager_dato DESC";
            $result = $this->_db->custom_query($sql);
            
            foreach($result as $row) {
                echo '<tr>';
                //echo '<td>' . $row->sagsID .'</td>';
                echo '<td>' . $row->modtager_dato .'</td>';
                echo '<td><span class="badge ' . $this->getStatusClass($row->status) . '">' . $row->status . '</span></td>';
                echo '<td><span class="badge ' . $this->getPriortetClass($row->priortet) . '">' . $row->priortet . '</span></td>';
                echo '<td>' . $row->kategori . '</td>'; 

                if(strlen($row->produkt_fejlbeskrivelse) > 110) {
                    $fejlbeskrivelse = substr($row->produkt_fejlbeskrivelse, 0, 110) . ' ...';
                } else {
                    $fejlbeskrivelse = $row->produkt_fejlbeskrivelse;
                }

                echo '<td title="' . $row->produkt_fejlbeskrivelse . '">' . $fejlbeskrivelse . '<br /><a href="/elev/tickets/opdaterSag.php?id=' . $row->sagsID . '">Rediger</a></td>'; 
                echo '<td><a class="btn btn-outline-success full-width" href="/admin/tickets/opdaterSag.php?id=' . $row->sagsID . '">Rediger</a></td>';
                echo '</tr>';         
            }
        }


        public function getTicket($id) {
            $sql = "SELECT * FROM servicedesk_sager INNER JOIN servicedesk_kategorier ON servicedesk_sager.sags_kategori = servicedesk_kategorier.id WHERE sagsID = $id";
            $result = $this->_db->custom_query($sql);

            foreach($result as $row) {
                $modtagerdata = $this->_user->getInfo($row->modtagerID);
                if(!$modtagerdata) {
                    die('Modtager findes ikke i databasen! (Modtager ID: ' . $row->modtagerID . ')');
                }
                if($row->repareretID) {
                    $repareretdata = $this->_user->getInfo($row->repareretID);
                } else {
                    $repareretdata = array(
                        'navn'  => '&nbsp;'
                    );
                }

                if($row->repareret_beskrivelse) {
                    $repareret_beskrivelse = $row->repareret_beskrivelse;
                } else {
                    $repareret_beskrivelse = '';
                }

                if($row->repareret_dato) {
                    if(strtotime($row->repareret_dato) != 0) {
                        $repareret_dato = date('d-m-Y', strtotime($row->repareret_dato));
                        $repareret_dato2 = date('Y-m-d\TH:i', strtotime($row->repareret_dato));
                    } else {
                        $repareret_dato  = NULL;
                        $repareret_dato2 = NULL;
                    }
                } else {
                    $repareret_dato  = NULL;
                    $repareret_dato2 = NULL;
                }

                $ticketData = array(
                    'modtagerNavn'              => $modtagerdata['navn'],
                    'modtagerID'                => $row->modtagerID,
                    'modtagerDato'              => date('d-m-Y', strtotime($row->modtager_dato)),
                    'kontaktNavn'               => $row->kontakt_navn,
                    'kontaktTlf'                => $row->kontakt_tlf,
                    'kontaktEmail'              => $row->kontakt_email,
                    'sagsID'                    => $row->sagsID,
                    'priortet'                  => $row->priortet,
                    'produktAntal'              => $row->produkt_antal,
                    'produktNavn'               => $row->produkt_navn,
                    'produktModel'              => $row->produkt_model,
                    'produktFejlbeskrivelse'    => $row->produkt_fejlbeskrivelse,
                    'repareretNavn'             => $repareretdata['navn'],
                    'repareretDato'             => $repareret_dato,
                    'repareretDato2'            => $repareret_dato2,
                    'repareretBeskrivelse'      => $repareret_beskrivelse
                );
            }

            return $ticketData;
        }
    }