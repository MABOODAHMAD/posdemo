<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
class pdf {
	function load($param = NULL)
    {
        require_once APPPATH . '/third_party/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'margin_left' => 5, 'margin_right' => 5, 'margin_top' => 45, 'margin_bottom' => 12]);
        //$mpdf->SetDirectionality('RTL');
        // $mpdf->SetAutoFont(AUTOFONT_ALL);
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        return $mpdf;
    }
}