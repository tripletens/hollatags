<?php

class BillingApiThread extends Thread {

    private $apicall_id;

    public function __construct($id){
        $this->apicall_id = $id;
    }

    public function run() {
        sleep(rand(0,3));
        
        // call the api 
        $ch = curl_init();
        $curl_config = array(
            CURLOPT_URL => "",
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POSTFIELDS => array()
        );
        curl_setopt_array($ch,$curl_config);
        $result = curl_exec($ch);
        curl_close($ch);
        
        echo nl2br("Thread with id {$this->apicall_id}");

    }
}

$api_call = [];

for($i=0; $i < 10000 ; $i++){
    $api_call[$i] = new BillingApiThread($i);
    $api_call[$i]->start($i);
}   

foreach (range(1,10000) as $i){
    $api_call[$i]->join();
}

?>