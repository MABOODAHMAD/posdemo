<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_library {

	// function __construct()
	// 	{
	// 		// parent::__construct();
	// 		$this->load->model('Trans_model', 'transdcon');
	// 		$this->load->model('Site_model', 'dbcon');
	// 	}

	  function supautocode($pre="CZP"){

	  		$this->load->model('Trans_model', 'transdcon');

			$lastid = $this->transdcon->supcode();

			$yr = date('Y');

			$midb = substr($lastid, 9);

			$r = (int)$midb;

            $a = $r+1;

            return $pre.'-'.$yr.'-'.sprintf("%'05d", $a);

		}
}