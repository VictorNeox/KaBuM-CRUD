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