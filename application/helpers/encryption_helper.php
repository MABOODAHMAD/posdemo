<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('dataEncypt'))
{
    function dataEncypt($data,$type){

        $CI =get_instance();
        $CI->load->library('encryption');

        $CI->encryption->initialize(
            array(
                    'cipher' => 'aes-256',
                    'mode' => 'ctr',
                    'key' => 'qzxcvbnmasdfghjklqwertyuiop1234%^',
                    'driver' => 'openssl'
            )
        );
        // $type = encrypt and decrypt
        if($type == 'encrypt'){
            $encrptData = $CI->encryption->encrypt($data);
            if($CI->encryption->decrypt($encrptData) == $data){
                $returnData = $encrptData;
            }else{
                $j = 1;
                for ($i=0; $i<$j ; $i++) { 
                    $checkEncrypt = $CI->encryption->encrypt($data);
                    if($CI->encryption->decrypt($checkEncrypt) == $data ){
                        $returnData = $checkEncrypt;
                    }else{
                        $j++;
                    }
                }
            }
        }elseif($type == 'decrypt'){
            $returnData = $CI->encryption->decrypt($data);
        }
        return $returnData;
    }
}

if(!function_exists('dataEncyptManual'))
{
    function dataEncyptManual($data,$type){

        if ($type == 'encrypt') {
            
            $returnData = random_strings(32) . $data . random_strings(32);

        }elseif ($type == 'decrypt') {
            $stp1 = substr($data, 32);
            $returnData = substr_replace($stp1,"",-32);
        }

        return $returnData;
    }
}

if(!function_exists('dataEncyptbase64'))
{
    function dataEncyptbase64($data,$type){

        
// $data = base64_decode($base_64);


        if ($type == 'encrypt') {
            
            $base_64 = base64_encode($data);
            $url_param = rtrim($base_64, '=');
            $returnData = $url_param . str_repeat('=', strlen($url_param) % 4);

        }elseif ($type == 'decrypt') {
            $returnData = base64_decode($data);
        }

        return $returnData;
    }
}
