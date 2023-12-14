<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datatables_model extends CI_Model{
    
    function __construct() {
            $this->load->database();
            $this->load->model('Universal_model','unicon');
    }
    
    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */
    public function getRows($postData,$sqlQuery,$fdata){

        $this->column_order = $fdata['column_order'];
        $this->column_search = $fdata['column_search'];
        $this->order = $fdata['order'];

        $this->_get_datatables_query($postData,$sqlQuery);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        if($query){
            return $query->result();
        }else{
            $errorData = $this->db->error();
            $userCon = sessionUserData();
            $errDataArr = array(
                            "ELF_ERROR_CODE" =>$errorData['code'],
                            "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                            "ELF_WEB_CONT" =>current_url(),
                            "ELF_CRE_DATE" =>dateTime(),
                            "ELF_CRE_BY" =>$userCon->USERNAME,
                        );
            $this->unicon->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
            return false;
        }
    }
    
    /*
     * Count all records
     */
    public function countAll($sqlQuery){
        $this->getTableData($sqlQuery);
        return $this->db->count_all_results();
    }
    
    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData,$sqlQuery){
        $this->_get_datatables_query($postData,$sqlQuery);
        $query = $this->db->get();
        if($query){
            return $query->num_rows();
        }else{
            $errorData = $this->db->error();
            $userCon = sessionUserData();
            $errDataArr = array(
                            "ELF_ERROR_CODE" =>$errorData['code'],
                            "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                            "ELF_WEB_CONT" =>current_url(),
                            "ELF_CRE_DATE" =>dateTime(),
                            "ELF_CRE_BY" =>$userCon->USERNAME,
                        );
            $this->unicon->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
            return false;
        }
    }

    private function getTableData($sqlQuery){

        $this->db->select($sqlQuery['SELECT']);

        $this->db->from($sqlQuery['FROM']);
        
        // JOIN 1
        if($sqlQuery['JOIN_1_CONTROL']){
		    $this->db->join($sqlQuery['JOIN_1_TABLE_NAME'],$sqlQuery['JOIN_1_TABLE_CONN']);
        }

        //JOIN 2
        if($sqlQuery['JOIN_2_CONTROL']){
		    $this->db->join($sqlQuery['JOIN_2_TABLE_NAME'],$sqlQuery['JOIN_2_TABLE_CONN']);
        }

        //JOIN 3
        if($sqlQuery['JOIN_3_CONTROL']){
		    $this->db->join($sqlQuery['JOIN_3_TABLE_NAME'],$sqlQuery['JOIN_3_TABLE_CONN']);
        }

        //JOIN 4
        if($sqlQuery['JOIN_4_CONTROL']){
		    $this->db->join($sqlQuery['JOIN_4_TABLE_NAME'],$sqlQuery['JOIN_4_TABLE_CONN']);
        }

        //JOIN 5
        if($sqlQuery['JOIN_5_CONTROL']){
		    $this->db->join($sqlQuery['JOIN_5_TABLE_NAME'],$sqlQuery['JOIN_5_TABLE_CONN']);
        }
        
        //WHERE CLAUSE 1
        if($sqlQuery['WHERE_1_CONTROL']){
		    $this->db->where($sqlQuery['WHERE_1_COL_NAME'],$sqlQuery['WHERE_1_DATA']);
        }

        //WHERE CLAUSE 2
        if($sqlQuery['WHERE_2_CONTROL']){
		    $this->db->where($sqlQuery['WHERE_2_COL_NAME'],$sqlQuery['WHERE_2_DATA']);
        }

        //WHERE CLAUSE 3
        if($sqlQuery['WHERE_3_CONTROL']){
		    $this->db->where($sqlQuery['WHERE_3_COL_NAME'],$sqlQuery['WHERE_3_DATA']);
        }

        //CORE WHERE CLAUSE 1
        if($sqlQuery['CORE_WHERE_1_CONTROL']){
		    $this->db->where($sqlQuery['CORE_WHERE_1_DATA']);
        }

        //CORE WHERE CLAUSE 2
        if($sqlQuery['CORE_WHERE_2_CONTROL']){
		    $this->db->where($sqlQuery['CORE_WHERE_2_DATA']);
        }

        //CORE WHERE CLAUSE 3
        if($sqlQuery['CORE_WHERE_3_CONTROL']){
		    $this->db->where($sqlQuery['CORE_WHERE_3_DATA']);
        }

        //WHERE_IN CLAUSE 1
        if($sqlQuery['WHERE_IN_1_CONTROL']){
		    $this->db->where_in($sqlQuery['WHERE_IN_1_COL_NAME'],$sqlQuery['WHERE_IN_1_DATA']);
        }

        //GROUP_BY CLAUSE 1
        if($sqlQuery['GROUP_1_CONTROL']){

		    $this->db->group_by($sqlQuery['GROUP_1_DATA']);
        }

        //HAVING CLAUSE 1
        if($sqlQuery['HAVING_1_CONTROL']){

		    $this->db->having($sqlQuery['HAVING_1_DATA']);
        }

    }
    
    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_datatables_query($postData,$sqlQuery){

        $this->getTableData($sqlQuery);
 
        $i = 0;

        // loop searchable columns 
        foreach($this->column_search as $item){
            // if datatable send POST for search
            if($postData['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                
                // last loop
                if(count($this->column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
        
         
        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

}