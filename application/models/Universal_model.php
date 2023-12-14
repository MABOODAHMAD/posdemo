<?php 

   Class Universal_model extends CI_model{

       public function __Construct(){

           $this->load->database();

       }

    public function fetchData($data,$row='result_array',$data3=null,$select='*'){
      $table = $data['table'];
        $this->db->select($select);
        $this->db->from($data['table']);
        if ($data['data1']) {
          $w1=$data['where1'];
          $this->db->where("$table.$w1",$data['data1']);
        }
        if ($data['data2']) {
          $this->db->where($data['where2'],$data['data2']);
        }
        if ($data3) {
            $this->db->where($data['where3'],$data3);
          }
        if ($data['table_join']) {
          $table_join1 = $data['table_join'];
          $join_d2 = $data['join_d2'];
          $join_d1 = $data['join_d1'];
         $this->db->join("$table_join1 as t2","t2.$join_d2 = $table.$join_d1");
        }
        if ($data['table_join2']) {
          $table_join2 = $data['table_join2'];
          $join_d3 = $data['join_d3'];
          $tb1_join_d1  = $data['tb1_join_d1'];
          $this->db->join("$table_join2 as t3","t3.$join_d3 = $table.$tb1_join_d1");
        }
        
        if ($data['order_data']) {
          $order_data = $data['order_data'];
          $order_by = $data['order_by'];
          if ($data['order_no'] == 1) {
            $this->db->order_by("$table.$order_data","$");
          }else if ($data['order_no'] == 2) {
            $this->db->order_by("t2.$order_data","$order_by");
          }else if ($data['order_no'] == 3) {
            $this->db->order_by("t3.$order_data","$order_by");
          }
          
        }
        $query = $this->db->get();
        if($query){
          return $query->$row();
        }else{
          $errorData = $this->db->error();
          $userCon = sessionUserData();    
          $errDataArr = array(
                            "ELF_ERROR_CODE" =>$errorData['code'],
                            "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                            "ELF_WEB_CONT" =>current_url(),
                            "ELF_CRE_DATE" =>dateTime(),
                            "ELF_CRE_BY" => $userCon->USERNAME,
                          );
              $this->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
          return false;
        }
    }

    public function fetchDataSum1($data=array()){
        $select = $data['select'];
        $row = $data['row'];

        $this->db->select("$select")->from($data['table']);
        $query = $this->db->get();
        if($query){
          return $query->$row();
        }else{
          $errorData = $this->db->error();
          $userCon = sessionUserData();    
          $errDataArr = array(
                            "ELF_ERROR_CODE" =>$errorData['code'],
                            "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                            "ELF_WEB_CONT" =>current_url(),
                            "ELF_CRE_DATE" =>dateTime(),
                            "ELF_CRE_BY" => $userCon->USERNAME,
                          );
              $this->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
          return false;
        }
        
    }

    public function fetchDataSum($data1=null,$table=null,$where1=null,$table_join1=null,$join_d1=null,$join_d2=null,$table_join2=null,$join_d3=null,$tb1_join_d1=null,$order_by=null,$order_no=null,$order_data=null,$sum=null){
        $this->db->select("SUM($sum) as sum");
        $this->db->from($table);
        if ($where1) {
          $this->db->where($where1,$data1);
        }
        if ($table_join1) {
         $this->db->join("$table_join1 as t2","t2.$join_d2 = $table.$join_d1");
        }
        if ($table_join2) {
          $this->db->join("$table_join2 as t3","t3.$join_d3 = $table.$tb1_join_d1");
        }
        
        if ($order_by) {
          if ($order_no == 1) {
            $this->db->order_by("$table.$order_data","$order_by");
          }else if ($order_no == 2) {
            $this->db->order_by("t2.$order_data","$order_by");
          }else if ($order_no == 3) {
            $this->db->order_by("t3.$order_data","$order_by");
          }
          
        }
        $query = $this->db->get();
        if($query){
          return $query->result_array();
        }else{
          $errorData = $this->db->error();
          $userCon = sessionUserData();    
          $errDataArr = array(
                            "ELF_ERROR_CODE" =>$errorData['code'],
                            "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                            "ELF_WEB_CONT" =>current_url(),
                            "ELF_CRE_DATE" =>dateTime(),
                            "ELF_CRE_BY" => $userCon->USERNAME,
                          );
              $this->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
          return false;
        }
    }
    public function dataUpdate($data){
      // print_r($data);
      $col1 = $data['col1'];
      $data1 = $data['data1'];
      $col2 = $data['col2'];
      $col3 = $data['col3'];
      $data2 = $data['data2'];
      $data3 = $data['data3'];
    
        
        if($data1){
          $data1 == 'on'?'0':$data1;
          $this->db->set("$col1","$data1");
        }
      if($data2){
        $this->db->set("$col2","$data2");
      }

      if($data3){
        $this->db->set("$col3","$data3");
      }
      if($this->db->update($data['table'])){
        return true;
      }else{
        $errorData = $this->db->error();
        $userCon = sessionUserData();      
        $errDataArr = array(
                            "ELF_ERROR_CODE" =>$errorData['code'],
                            "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                            "ELF_WEB_CONT" =>current_url(),
                            "ELF_CRE_DATE" =>dateTime(),
                            "ELF_CRE_BY" => $userCon->USERNAME,
                          );
              $this->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
        return false;
      }
    }

    public function fetchDataSumWhere($data=array(),$ebleJson=1){
        $select = $data['select'];
        $row = $data['row'];
        $where1 = $data['where1'];
        $where2 = $data['where2'];
        $where3 = $data['where3'];
        $coreWhere = $data['coreWhere'];

        $this->db->select("$select")->from($data['table']);

        if($where1){
            $data1 = $data['data1'];
            $this->db->where($where1,$data1);
        }
        if($where2){
            $data2 = $data['data2'];
            $this->db->where($where2,$data2);
        }
        if($where3){
            $data3 = $data['data3'];
            $this->db->where($where3,$data3);
        }
        if($coreWhere){
            $this->db->where("$coreWhere");
        }
        if($ebleJson){
          $query = $this->db->get();
          if($query){
            return $query->$row();
          }else{
            $errorData = $this->db->error();
            $userCon = sessionUserData();  
            $errDataArr = array(
                            "ELF_ERROR_CODE" =>$errorData['code'],
                            "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                            "ELF_WEB_CONT" =>current_url(),
                            "ELF_CRE_DATE" =>dateTime(),
                            "ELF_CRE_BY" => $userCon->USERNAME,
                          );
              $this->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
            return false;
          }
        }
       
    }
    public function generateUuId($name){   //Step 2
        $paySeq = $this->UUID($name);
        $genId = $paySeq['seq'].$paySeq['no'];
        return $genId;
    }
    public function UUID($id){ //Step 3
		$this->db->select('SEQUENCE as seq,SEQ_NO as no');
		$this->db->from('UUID');
		$this->db->where('NAME',$id);
		$query = $this->db->get();
    if($query){
      return $query->row_array();
    }else{
      $errorData = $this->db->error();
      $userCon = sessionUserData();        
      $errDataArr = array(
                            "ELF_ERROR_CODE" =>$errorData['code'],
                            "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                            "ELF_WEB_CONT" =>current_url(),
                            "ELF_CRE_DATE" =>dateTime(),
                            "ELF_CRE_BY" => $userCon->USERNAME,
                          );
              $this->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
      return false;
    }
	}
    public function updateUUID($name){ //Step 4
        $Count_no = $this->UUID($name);
        $Count_no = $Count_no['no'] +1;
        $Count_no = str_pad($Count_no, 4, '0', STR_PAD_LEFT);
        $this->db->where('NAME',$name);
        if($this->db->update('UUID',array('SEQ_NO' => $Count_no))){
          return true;
        }else{
          $errorData = $this->db->error();
          $userCon = sessionUserData();    
          $errDataArr = array(
                            "ELF_ERROR_CODE" =>$errorData['code'],
                            "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                            "ELF_WEB_CONT" =>current_url(),
                            "ELF_CRE_DATE" =>dateTime(),
                            "ELF_CRE_BY" => $userCon->USERNAME,
                          );
              $this->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
          return false;
        }
    }

    public function insertUniversal($table,$dataDB,$lastInsertId=null){
        if($lastInsertId){
            if($this->db->insert($table,$dataDB)){
              return $this->db->insert_id();
            }else{
              $errorData = $this->db->error();
              $userCon = sessionUserData();
              $errDataArr = array(
                            "ELF_ERROR_CODE" =>$errorData['code'],
                            "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                            "ELF_WEB_CONT" =>current_url(),
                            "ELF_CRE_DATE" =>dateTime(),
                            "ELF_CRE_BY" => $userCon->USERNAME,
                          );
              $this->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
              return false;
            }
        }else{
            
            // return $this->db->insert($table,$dataDB);
            if($this->db->insert($table,$dataDB)){
              return true;
            }else{
              $errorData = $this->db->error();
              $userCon = sessionUserData();
              $errDataArr = array(
                            "ELF_ERROR_CODE" =>$errorData['code'],
                            "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                            "ELF_WEB_CONT" =>current_url(),
                            "ELF_CRE_DATE" =>dateTime(),
                            "ELF_CRE_BY" => $userCon->USERNAME,
                          );
              $this->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
              return false;
            }
        }

    }

    public function updateArrayUniversal($table,$updateFile,$where){
      if($where){
        $this->db->where($where);
      }
      if($this->db->update($table,$updateFile)){
        return $this->db->affected_rows();
      }else{
        $errorData = $this->db->error();
        $userCon = sessionUserData();      
        $errDataArr = array(
                            "ELF_ERROR_CODE" =>$errorData['code'],
                            "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                            "ELF_WEB_CONT" =>current_url(),
                            "ELF_CRE_DATE" =>dateTime(),
                            "ELF_CRE_BY" => $userCon->USERNAME,
                          );
              $this->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
        return false;
      }
    }

    public function updateUniversal($data){
          //   Reference Function
            // 1-  inven/confirmorder
             // 2-  
              // 3-  
               // 4-  
                // 5-  
                 // 6-  
                  // 7-  
                   // 8-  
                    // 9-  
                     // 10-  
      //WHERE
      $where1 = $data['where1'];
      $where2 = $data['where2'];
      $where3 = $data['where3'];
      $where4 = $data['where4'];
      $whereCore = $data['whereCore'];
      //SET
      $set1 = $data['set1'];
      $set2 = $data['set2'];
      $set3 = $data['set3'];

      if($where1){
        $data1 = $data['data1'];
        $this->db->where($where1,$data1);
      }
      if($where2){
        $data2 = $data['data2'];
        $this->db->where($where2,$data2);
      }
      if($where3){
        $data3 = $data['data3'];
        $this->db->where($where3,$data3);
      }
      if($where4){
        $data4 = $data['data4'];
        $this->db->where($where4,$data4);
      }
      if($whereCore){
        $dataCore = $data['dataCore'];
        $this->db->where("$whereCore");
      }

      if($set1){
        $setdata1 = $data['setdata1'];
        $this->db->set("$set1","$setdata1");
      }

      if($set2){
        $setdata2 = $data['setdata2'];
        $this->db->set("$set2","$setdata2");
      }

      if($set3){
        $setdata3 = $data['setdata3'];
        $this->db->set("$set3","$setdata3");
      }
      
      if($this->db->update($data['table'])){
        return true;
      }else{
        $errorData = $this->db->error();
        $userCon = sessionUserData();      
        $errDataArr = array(
                            "ELF_ERROR_CODE" =>$errorData['code'],
                            "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                            "ELF_WEB_CONT" =>current_url(),
                            "ELF_CRE_DATE" =>dateTime(),
                            "ELF_CRE_BY" => $userCon->USERNAME,
                          );
              $this->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
        return false;
      }
    }

    public function deleteUniversal($data=array()){
      $where1 = isset($data['where1'])?$data['where1']:NULL;
      $where2 = isset($data['where2'])?$data['where2']:NULL;
      $where3 = isset($data['where3'])?$data['where3']:NULL;
      $where4 = isset($data['where4'])?$data['where4']:NULL;
      $whereCore = isset($data['whereCore'])?$data['whereCore']:NULL;
      if($where1){
        $data1 = $data['data1'];
        $this->db->where($where1,$data1);
      }
      if($where2){
        $data2 = $data['data2'];
        $this->db->where($where2,$data2);
      }
      if($where3){
        $data3 = $data['data3'];
        $this->db->where($where3,$data3);
      }
      if($where4){
        $data4 = $data['data4'];
        $this->db->where($where4,$data4);
      }
      if($whereCore){
        $dataCore = $data['dataCore'];
        $this->db->where($whereCore,$dataCore);
      }
      $table = $data['table'];
      
      if($this->db->delete($table)){
        return true;
      }else{
        $errorData = $this->db->error();
        $userCon = sessionUserData();
        $errDataArr = array(
                      "ELF_ERROR_CODE" =>$errorData['code'],
                      "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                      "ELF_WEB_CONT" =>current_url(),
                      "ELF_CRE_DATE" =>dateTime(),
                      "ELF_CRE_BY" => $userCon->USERNAME,
                    );
        $this->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
        return false;
      }
    }
    public function CoreQuery($data,$row=null){
      $sql=$data; 

      if($query = $this->db->query($sql)){
        if($row){
          return $query->$row();
        }else{
  
        }
      }else{
        $errorData = $this->db->error();
        $userCon = sessionUserData();
        $errDataArr = array(
                      "ELF_ERROR_CODE" =>$errorData['code'],
                      "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                      "ELF_WEB_CONT" =>current_url(),
                      "ELF_CRE_DATE" =>dateTime(),
                      "ELF_CRE_BY" => $userCon->USERNAME,
                    );
        $this->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
        return false;
      }

      
      
    }

    public function deleteUniversalbyId($tableName,$where,$id){
        $this->db->where($where,$id);
        if($this->db->delete($tableName)){
          return true;
        }else{
          $errorData = $this->db->error();
          $userCon = sessionUserData();
          $errDataArr = array(
                        "ELF_ERROR_CODE" =>$errorData['code'],
                        "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                        "ELF_WEB_CONT" =>current_url(),
                        "ELF_CRE_DATE" =>dateTime(),
                        "ELF_CRE_BY" => $userCon->USERNAME,
                      );
          $this->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
          return false;
        }
    }

    public function universalJsonCountCore($data){
      $this->CoreQuery($data);
      return $this->db->count_all_results();
    }

    public function universalJsonCount($profilt){
      $this->fetchDataSumWhere($profilt,0);
      return $this->db->count_all_results();
    }

    function resizeimg($fpath,$filename,$qlty="90",$iwidth="120",$iheight="90",$thumb=FALSE){
			$config = array(
				'image_library' => 'gd2',
				'source_image' => $fpath.$filename,
				'maintain_ratio' => TRUE,
				'quality' => $qlty."%",
				'width' => $iwidth,
				'height' => $iheight
			);
			if($thumb){
				$config['new_image'] = $fpath."thumb/".$filename;
				$config['create_thumb'] = TRUE;
				$config['thumb_marker'] = '';
			}else{
				$config['new_image'] = $fpath.$filename;
				$config['create_thumb'] = FALSE;
			}
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			if (! $this->image_lib->resize()) {
				return $this->image_lib->display_errors();
			}
			$this->image_lib->clear();
		}
   }

