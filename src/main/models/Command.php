<?php
include_once 'Command.php';

class Command
{
    private $id;
    private $client_id;
    private $date;

    /*public function set_id($id) {
        $this->id=$id;
    }*/
    public function set_client_id($client_id) {
        $this->client_id=$client_id;
    }
    public function set_date($date) {
        $this->date=$date;
    }

    public function get_id() { return $this->id; }
    public function get_client_id() { return $this->client_id; }
    public function get_date() { return $this->date; }
}