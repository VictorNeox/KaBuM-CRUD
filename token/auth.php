<?php
    function generateToken($id, $access) 
    {
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];
        $payload = [
            'uid' => $id,
            'access' => $access
        ];
         
        $header = json_encode($header);
        $header = base64_encode($header);
         
        $payload = json_encode($payload);
        $payload = base64_encode($payload);
         
        $signature = hash_hmac('sha256',"$header.$payload",'KaBuMCRUD',true);
        $signature = base64_encode($signature);
         

        return "$header.$payload.$signature";
    }
    
    function validateToken($token) 
    {

        $part = explode(".",$token);
        $header = $part[0];
        $payload = $part[1];
        $signature = $part[2];
        
        
        $valid = hash_hmac('sha256',"$header.$payload",'KaBuMCRUD',true);
        $valid = base64_encode($valid);
        
        if($signature != $valid){
            return 0;
            exit();
        }

        $payload = base64_decode($payload);
        $payload = json_decode($payload);

        $userData = [
            'id' => $payload->uid,
            'access' => $payload->access
        ];
        
        return $userData;
    }