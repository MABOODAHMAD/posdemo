<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**=======================================================================================================================
 * ?                                                     ABOUT
 * @author         :  USMAN AHMAD
 * @email          :  usmanahmad9999@gmail.com
 * @repo           :  CODEIGNITER 3.2
 * @createdOn      :  15 MARCH 2023
 * @description    :  DYNAMIC HTML LAYOUT GENERATE
 *=======================================================================================================================**/
/**========================================================================
 **                           FUNCTION ARRAY-OBJECT
 *?  FIRST CREATE INDEX ARRAY?
    *@index_array LIKE  array(array(),array(),array(),array(),array(),array(),.......)

 *? INSIDE INDEX ARRAY CREATE ASSOCIATIVE ARRAY?
    *@L_DISPLAY (DESCRIPTION : FORM COMPONENT ON AND OFF DATATYPE:ENUM(Y,N) , KEY : FIXED)
    *@L_UNIQUE_ID (DESCRIPTION : ONLY UNIQUE VALUE HOLD DATATYPE:STRING,INTEGER , KEY : UNIQUE)
    *@L_TITLE (DESCRIPTION : FORM COMPONENT LABEL HEADING DATATYPE:STRING , KEY : ANY)
    *@DB_NAME (DESCRIPTION : FORM NAME DATA IS HOLD UNIQUE VALUE FOR DATABASE INSERTING DATA DATATYPE:STRING , KEY : UNIQUE)
    *@L_TYPE (DESCRIPTION : FORM COMPONENT TYPE INPUT AND SELECT DATA DATATYPE:ENUM(SELECT,INPUT) , KEY : FIXED)
        *? IF L_TYPE IS SELECT THEN 4 ARGUMENT PASS
            @L_SEL_DATA_LOOP (DESCRIPTION : HTML SELECT->OPTION DATA HOLD DATATYPE:(OBJECT)ARRAY , KEY : ANY)
            @L_SEL_DATA_LOOP_VALUE (DESCRIPTION : HTML SELECT->OPTION VALUE DATATYPE:STRING , KEY : ANY)
            @L_SEL_DATA_LOOP_DISP (DESCRIPTION : HTML SELECT->OPTION DISPLAY DATATYPE:STRING , KEY : ANY)
            @L_SEL_DATA_LOOP_CUST_DISP (DESCRIPTION : HTML SELECT->OPTION CUSTOM OPTION IF ANY DATATYPE:ENUM(TRUE,FALSE) , KEY : FIXED)
        *? IF L_TYPE IS INPUT THEN MULTIPLE DATA ATTRIBUTES PASS AS PER YOUR REQUIREMENT LIKE JQUERY FUNCTION DATA-ATTRIBUTE
            *? IF REQUIRE JQUERY FUNCTION THEN
                @JFUNC_CONT (DESCRIPTION : EVENT ON AND OFF DATATYPE:ENUM(TRUE,FALSE) , KEY : FIXED)
                @JFUNC_TYPE (DESCRIPTION : EVENT TYPE LIKE onClick,onInput DATATYPE:ENUM(INPUT) , KEY : FIXED)
                @JFUNC_NAME (DESCRIPTION : FUNCTION NAME YOU WANT TO CALL ON JQUERY DATATYPE:STRING , KEY : ANY) EXAMPLE = myFunction(this)
            *? IF REQUIRE HTML DATA ATTRIBUTE THEN
                @DATA_ATTRIBUTE_CON (DESCRIPTION : HTML DATA ATTRIBUTE ON AND OFF DATATYPE:ENUM(TRUE,FALSE) , KEY : FIXED)
                @FIRST_ATT_NAME (DESCRIPTION : HTML DATA ATTRIBUTE NAME DATATYPE:STRING , KEY : UNIQUE) NOTE THIS DATA ATTRIBUTE INSIDE JQUERY MAKE SURE IT SHOULD BE SMALL LETTER
    
    **                   FUNCTION STRUCTURE
        *? FOR SELECT
            array(
                (object)array(
                    "L_UNIQUE_ID"=>"STRING", -->UNIQUE VALUE
                    "L_TITLE"=>"STRING",   ---> ANY VALUE
                    "DB_NAME"=>"STRING", -->UNIQUE VALUE
                    "L_TYPE"=>'SELECT', FIXED VALUE
                    "L_SEL_DATA_LOOP" =>array(
                                                (object)array('STRING_1'=>'STRING_UNIQUE','STRING_2'=>'STRING_ANY'),
                                                (object)array('STRING_1'=>'STRING_UNIQUE','STRING_2'=>'STRING_ANY'),
                                                
                                            ),
                    "L_SEL_DATA_LOOP_VALUE"=>'STRING_1',
                    "L_SEL_DATA_LOOP_DISP" =>'STRING_2',
                    "L_DISPLAY" =>'Y', ---> Y/N  Y STAND ON AND N STAND OFF
                )
            )
        *? FOR INPUT
            array(
                (object)array(
                    "L_UNIQUE_ID"=>"STRING", -->UNIQUE VALUE
                    "L_TITLE"=>"STRING",   ---> ANY VALUE
                    "DB_NAME"=>"STRING", -->UNIQUE VALUE
                    "L_TYPE"=>'INPUT', --> FIXED VALUE
                    "JFUNC_CONT"=>TRUE, -->TRUE/FALSE TRUE STAND ON AND FALSE STAND OFF
                    "JFUNC_TYPE"=>'INPUT', --> JQUERY EVENT onInput
                    "JFUNC_NAME"=>'myFunction(this)', --> JQUERY FUNCTION
                    "DATA_ATTRIBUTE_CON" => TRUE, -->TRUE/FALSE TRUE STAND ON AND FALSE STAND OFF
                    "FIRST_ATT_NAME" => "UNIQUE_VALUE",
                    "L_DISPLAY" =>'Y', ---> Y/N  Y STAND ON AND N STAND OFF
                )
            )
    
 *========================================================================**/
if(!function_exists('glModuleProfileLayout'))
{
    function glModuleProfileLayout(){
        // $CI =get_instance();
        // $CI->load->library('session');
        // $sessionData = $CI->session->userdata();
        // $CI->load->model('universal_model');
        // $data =  $CI->universal_model->CoreQuery("SELECT * FROM USERS WHERE ID='{$sessionData['userId']}'","row");
   

        $dataLayout = array(
                                (object)array(
                                                "L_UNIQUE_ID"=>"GLMP_BUS_UNIT",
                                                "L_TITLE"=>"Business Unit",
                                                "DB_NAME"=>"GLMP_BUS_UNIT",
                                                "L_TYPE"=>'SELECT',
                                                "L_SEL_DATA_LOOP" =>busUnit(['dataType'=>'result']),
                                                "L_SEL_DATA_LOOP_VALUE"=>'BU_CODE',
                                                "L_SEL_DATA_LOOP_DISP" =>'BU_NAME1',
                                                "L_DISPLAY" =>'Y',
                                            ),
                                (object)array(
                                                "L_UNIQUE_ID"=>"GLMP_MODULE",
                                                "L_TITLE"=>"Module Name",
                                                "DB_NAME"=>"GLMP_MODULE",
                                                "L_TYPE"=>'SELECT',
                                                "L_SEL_DATA_LOOP" =>array(
                                                                            (object)array('MODULE_VAL'=>'','MODULE_DIS'=>'Select'),
                                                                            (object)array('MODULE_VAL'=>'SO','MODULE_DIS'=>'SALE ORDER'),
                                                                            (object)array('MODULE_VAL'=>'AR','MODULE_DIS'=>'ACCOUNT RECEIVEABLE'),
                                                                            (object)array('MODULE_VAL'=>'AP','MODULE_DIS'=>'ACCOUNT PAYABLE'),
                                                                            (object)array('MODULE_VAL'=>'INV','MODULE_DIS'=>'INVENTORY'),
                                                                        ),
                                                "L_SEL_DATA_LOOP_VALUE"=>'MODULE_VAL',
                                                "L_SEL_DATA_LOOP_DISP" =>'MODULE_DIS',   
                                                "JFUNC_CONT"=>TRUE, 
                                                "JFUNC_TYPE"=>'CHANGE',
                                                "JFUNC_NAME"=>'muduleSel(this)',      
                                                "L_DISPLAY" =>'Y',
                                            ),
                                (object)array(
                                                "L_UNIQUE_ID"=>"GLMP_TYPE",
                                                "L_TITLE"=>"Type",
                                                "DB_NAME"=>"GLMP_TYPE",
                                                "L_TYPE"=>'SELECT',
                                                "L_SEL_DATA_LOOP" =>array(
                                                                            (object)array('MTYPE_VAL'=>'','MTYPE_DIS'=>'Select'),
                                                                            (object)array('MTYPE_VAL'=>'CASH','MTYPE_DIS'=>'CASH'),
                                                                            (object)array('MTYPE_VAL'=>'RECEIVEABLE','MTYPE_DIS'=>'RECEIVEABLE'),
                                                                        ),
                                                "L_SEL_DATA_LOOP_VALUE"=>'MTYPE_VAL',
                                                "L_SEL_DATA_LOOP_DISP" =>'MTYPE_DIS',
                                                "L_DISPLAY" =>'Y',
                                            ),
                                (object)array(
                                                "L_UNIQUE_ID"=>"GLMP_RTN",
                                                "L_TITLE"=>"Return",
                                                "DB_NAME"=>"GLMP_RTN",
                                                "L_TYPE"=>'SELECT',
                                                "L_SEL_DATA_LOOP" =>array(
                                                                            (object)array('RET_VAL'=>'','RET_DIS'=>'Select'),
                                                                            (object)array('RET_VAL'=>'Y','RET_DIS'=>'Y'),
                                                                            (object)array('RET_VAL'=>'N','RET_DIS'=>'N'),
                                                                        ),
                                                "L_SEL_DATA_LOOP_VALUE"=>'RET_VAL',
                                                "L_SEL_DATA_LOOP_DISP" =>'RET_DIS',
                                                "L_DISPLAY" =>'Y',
                                            ),
                                (object)array(
                                                "L_UNIQUE_ID"=>"GLMP_RECV_IN",
                                                "L_TITLE"=>"Received By",
                                                "DB_NAME"=>"GLMP_RECV_IN",
                                                "L_TYPE"=>'SELECT',
                                                "L_SEL_DATA_LOOP" =>array(
                                                                            (object)array('REC_VAL'=>'','REC_DIS'=>'Select'),
                                                                            (object)array('REC_VAL'=>'D','REC_DIS'=>'Debitor'),
                                                                            (object)array('REC_VAL'=>'C','REC_DIS'=>'Cash On hand'),
                                                                        ),
                                                "L_SEL_DATA_LOOP_VALUE"=>'REC_VAL',
                                                "L_SEL_DATA_LOOP_DISP" =>'REC_DIS',
                                                "L_DISPLAY" =>'Y',
                                            ),
                                (object)array(
                                                "L_UNIQUE_ID"=>"CASH_ON_HAND_AC",
                                                "L_TITLE"=>"Cash on Hand Account No",
                                                "DB_NAME"=>"CASH_ON_HAND_AC",
                                                "L_TYPE"=>'INPUT',
                                                "JFUNC_CONT"=>TRUE,
                                                "JFUNC_TYPE"=>'INPUT',
                                                "DATA_ATTRIBUTE_CON" => TRUE,
                                                "FIRST_ATT_NAME" => "CASH_ON_HAND_AC",
                                                "JFUNC_NAME"=>'accDet(this)',
                                                "L_DISPLAY" =>'Y',
                                            ),
                                (object)array(
                                                "L_UNIQUE_ID"=>"GLMP_VAT_AC",
                                                "L_TITLE"=>"Vat Account No",
                                                "DB_NAME"=>"GLMP_VAT_AC",
                                                "L_TYPE"=>'INPUT',
                                                "JFUNC_CONT"=>TRUE,
                                                "JFUNC_TYPE"=>'INPUT',
                                                "DATA_ATTRIBUTE_CON" => TRUE,
                                                "FIRST_ATT_NAME" => "GLMP_VAT_AC",
                                                "JFUNC_NAME"=>'accDet(this)',
                                                "L_DISPLAY" =>'Y',
                                            ),
                                (object)array(
                                                "L_UNIQUE_ID"=>"GLMP_COGS_AC",
                                                "L_TITLE"=>"Cost goods Account No",
                                                "DB_NAME"=>"GLMP_COGS_AC",
                                                "L_TYPE"=>'INPUT',
                                                "JFUNC_CONT"=>TRUE,
                                                "JFUNC_TYPE"=>'INPUT',
                                                "DATA_ATTRIBUTE_CON" => TRUE,
                                                "FIRST_ATT_NAME" => "GLMP_COGS_AC",
                                                "JFUNC_NAME"=>'accDet(this)',
                                                "L_DISPLAY" =>'Y',
                                            ),
                                (object)array(
                                                "L_UNIQUE_ID"=>"GLMP_INVENTORY_AC",
                                                "L_TITLE"=>"Inventory Account No",
                                                "DB_NAME"=>"GLMP_INVENTORY_AC",
                                                "L_TYPE"=>'INPUT',
                                                "JFUNC_CONT"=>TRUE,
                                                "JFUNC_TYPE"=>'INPUT',
                                                "DATA_ATTRIBUTE_CON" => TRUE,
                                                "FIRST_ATT_NAME" => "GLMP_INVENTORY_AC",
                                                "JFUNC_NAME"=>'accDet(this)',
                                                "L_DISPLAY" =>'Y',
                                            ),
                                (object)array(
                                                "L_UNIQUE_ID"=>"GLMP_INCOME_AC",
                                                "L_TITLE"=>"Income Account No",
                                                "DB_NAME"=>"GLMP_INCOME_AC",
                                                "L_TYPE"=>'INPUT',
                                                "JFUNC_CONT"=>TRUE,
                                                "JFUNC_TYPE"=>'INPUT',
                                                "DATA_ATTRIBUTE_CON" => TRUE,
                                                "FIRST_ATT_NAME" => "GLMP_INCOME_AC",
                                                "JFUNC_NAME"=>'accDet(this)',
                                                "L_DISPLAY" =>'Y',
                                            ),
                                (object)array(
                                                "L_UNIQUE_ID"=>"GLMP_DISCOUNT_AC",
                                                "L_TITLE"=>"Discount Account No",
                                                "DB_NAME"=>"GLMP_DISCOUNT_AC",
                                                "L_TYPE"=>'INPUT',
                                                "JFUNC_CONT"=>TRUE,
                                                "JFUNC_TYPE"=>'INPUT',
                                                "DATA_ATTRIBUTE_CON" => TRUE,
                                                "FIRST_ATT_NAME" => "GLMP_DISCOUNT_AC",
                                                "JFUNC_NAME"=>'accDet(this)',
                                                "L_DISPLAY" =>'Y',
                                            ),
                                (object)array(
                                                "L_UNIQUE_ID"=>"GLMP_ADS_AC",
                                                "L_TITLE"=>"Ads Account No",
                                                "DB_NAME"=>"GLMP_ADS_AC",
                                                "L_TYPE"=>'INPUT',
                                                "JFUNC_CONT"=>TRUE,
                                                "JFUNC_TYPE"=>'INPUT',
                                                "DATA_ATTRIBUTE_CON" => TRUE,
                                                "FIRST_ATT_NAME" => "GLMP_ADS_AC",
                                                "JFUNC_NAME"=>'accDet(this)',
                                                "L_DISPLAY" =>'Y',
                                            ),
                                (object)array(
                                                "L_UNIQUE_ID"=>"GLMP_ENTRY_TYPE",
                                                "L_TITLE"=>"Entry Type",
                                                "DB_NAME"=>"GLMP_ENTRY_TYPE",
                                                "L_TYPE"=>'SELECT',
                                                "L_SEL_DATA_LOOP" =>array(
                                                                            (object)array('EN_TY_VAL'=>'','EN_TY_DIS'=>'Select'),
                                                                            (object)array('EN_TY_VAL'=>'C','EN_TY_DIS'=>'CREDIT'),
                                                                            (object)array('EN_TY_VAL'=>'D','EN_TY_DIS'=>'DEBIT'),
                                                                        ),
                                                "L_SEL_DATA_LOOP_VALUE"=>'EN_TY_VAL',
                                                "L_SEL_DATA_LOOP_DISP" =>'EN_TY_DIS',
                                                "L_DISPLAY" =>'Y'
                                            ),
                                (object)array(
                                                "L_UNIQUE_ID"=>"COST_CENTER",
                                                "L_TITLE"=>"Cost Center",
                                                "DB_NAME"=>"GLMP_COST_CENTER",
                                                "L_TYPE"=>'SELECT',
                                                "L_SEL_DATA_LOOP" =>costCenter(['dataType'=>'result']),
                                                "L_SEL_DATA_LOOP_VALUE"=>'CC_CODE',
                                                "L_SEL_DATA_LOOP_DISP" =>'CC_AR_TITLE',
                                                "L_SEL_DATA_LOOP_CUST_DISP" =>TRUE,
                                                "L_DISPLAY" =>'Y'
                                                )
        );

        return $dataLayout;
    }
}

?>