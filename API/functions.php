<?php
   function getAccessToken($len=30)
   {
       $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
       $charactersLength = strlen($characters);
       $token = '';
       for ($i = 0; $i < $len; $i++) {
           $token .= $characters[rand(0, $charactersLength - 1)];
       }
       return $token;
   }

?>