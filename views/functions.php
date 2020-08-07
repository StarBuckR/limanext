<?php
    function index() {
        $all = runCommand("curl -s http://localhost:3000/users");
        
        $json = json_decode($all, true);
        $users = $json["users"];
        
        return view('index',[
            "array" => $users
        ]);
    }

    function replyWithMessage() {
        $machineName = request('machineName');
        $message = request('messageText');
        
        $respond = runCommand("curl -d 'machine_name={$machineName}&message={$message}' -X POST http://localhost:3000/notifications");

        if(strpos($respond, "error") == true) {
            return respond($respond, 201);
        }
        else {
            return respond("Başarılı", 200);
        }
    }