<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['default_controller'] = 'layout';
$route['(:any)'] = "layout/$1"; 

/* 
------------ Item Routes Start ------------------
*/

//Item Insert in database
$route['item/item-add-db'] = 'item/itemAdddb';
//item trait insert in database
$route['item/item-trait-add-db'] = 'item/itemTraitAdddb';
//Item trait list
$route['item/item-trait-table-list'] = 'item/itemTraitListJson';

//Item Table List
$route['item/item-table-list'] = 'item/itemListJson';

//Item Bulk Upload
$route['upload/item-bulk-upload'] = 'upload/bulkItemAdddb';

//Item Trait Bulk Upload
$route['upload/item-trait-bulk-upload'] = 'upload/bulkItemTraitAdddb';
/* ------------ Item Routes end ------------------*/

/* ------------ Inventory Routes Start ------------------*/

//Inventory Table List
// $route['inventory/inventory-table-list'] = 'inventory/inventoryListJson';
$route['inventory/inventory-table-list'] = 'inventory/inventoryInvListJson';

//Stock transfer Order
$route['inventory/stock-transfer-order-add'] = 'inventory/stockTransOrderAdd';

//Stock transfer Transit
$route['inventory/stock-transfer-in-transit-update'] = 'inventory/stockTransTransotUpdate';

//Stock transfer table list
$route['inventory/stock-transfer-order-table-list'] = 'inventory/stockTransOrderListJson';

//PHYSICAL INVENTORY COUNT ADD DB
$route['inventory/physical-inventory-count-add-db'] = 'inventory/phyInvCountAdddb';

//PHYSICAL INVENTORY COUNT LIST
$route['inventory/physical-inventory-count-table-list'] = 'inventory/physicalInventoryCountListJson';

/* ------------ Inventory Routes end ------------------*/


/* 
------------ Authenticate Routes Start ------------------
*/
//Login
$route['auth/login-auth'] = 'auth/login';
/* 
------------ Authenticate Routes end ------------------
*/
/* 
------------ Master Routes Start ------------------
*/
//Country Add and List View
$route['master/country-add'] = 'master/countryAdd';
$route['master/country-table-list'] = 'master/countryListJson';

//State Add and List View
$route['master/state-add'] = 'master/stateAdd';
$route['master/state-table-list'] = 'master/stateListJson';

//City Add and List View
$route['master/city-add'] = 'master/cityAdd';
$route['master/city-table-list'] = 'master/cityListJson';

//Currency Add and List View
$route['master/currency-add'] = 'master/currencyAdd';
$route['master/currency-table-list'] = 'master/currencyListJson';

//Ship category
$route['master/Ship-via-add'] = 'master/ShipviaAdd';
$route['master/Ship-via-table-list'] = 'master/ShipviaListJson';

//Trait category
$route['master/trait-category-add'] = 'master/traitCategoryAdd';
$route['master/trait-category-table-list'] = 'master/traitCategoryListJson';

//Trait sub category
$route['master/trait-sub-category-add'] = 'master/traitSubCategoryAdd';
$route['master/trait-sub-category-table-list'] = 'master/traitSubCategoryListJson';

//Item class
$route['master/item-class-add'] = 'master/itemClassAdd';
$route['master/item-class-table-list'] = 'master/itemClassListJson';

//Generate Password
$route['master/Pass-add'] = 'master/PassAdd';
$route['master/Pass-table-list'] = 'master/passListJson';
$route['master/Passused-table-list'] = 'master/passusedListJson';

//Item Category
$route['master/item-category-add'] = 'master/itemCategoryAdd';
$route['master/item-category-table-list'] = 'master/itemCategoryListJson';

//Unit of measurement
$route['master/uom-add'] = 'master/uomAdd';
$route['master/uom-table-list'] = 'master/uomListJson';

//Free on Board FOB
$route['master/fob-add'] = 'master/fobAdd';
$route['master/fob-table-list'] = 'master/fobListJson';

//FREIGHT
$route['master/freight-add'] = 'master/freightAdd';
$route['master/freight-table-list'] = 'master/freightListJson';

//TERMS
$route['master/term-add'] = 'master/termAdd';
$route['master/term-table-list'] = 'master/termListJson';

//PO_PREFIXES
$route['master/po-prefixes-add'] = 'master/poPrefixesAdd';
$route['master/po-prefixes-table-list'] = 'master/poPrefixesListJson';


//BUSINESS_UNIT
$route['master/business-unit-add-db'] = 'master/busUnitAdd';
$route['master/business-table-list'] = 'master/businessListJson';

//WHAREHOUSE
$route['master/whse-add-db'] = 'master/whseAdd';
$route['master/wharehouse-table-list'] = 'master/wharehouseListJson';

//EXCHANGE CURRENCY
$route['master/ext-cur-add'] = 'master/extCurAdd';
$route['master/ext-cur-table-list'] = 'master/extCurListJson';

//PAYMENT METHODS
$route['master/pay-method-add'] = 'master/payMethAdd';
$route['master/pay-method-table-list'] = 'master/payMethListJson';

//PO CHARGE
$route['master/po-charge-add'] = 'master/poChargeAdd';
$route['master/po-charge-table-list'] = 'master/poChargeListJson';

//FINENCIAL YEAR PERIODS
$route['master/fiscal-year-period-add'] = 'master/finsalYearPeriodAdd';
$route['master/fiscal-year-period-table-list'] = 'master/finsalYearPeriodListJson';

//FINENCIAL YEAR
$route['master/fiscal-year-add'] = 'master/finsalYearAdd';
$route['master/fiscal-year-table-list'] = 'master/finsalYearListJson';

//GL PREFIXES
$route['master/gl-prefixes-update'] = 'master/glPrefixesUpdate';

//SYSTEM SETTING
$route['master/system-setting-update-db'] = 'master/systemSettingUpdate';

//BANK DETAIL
$route['master/bank-detail-update'] = 'master/bankDelUpdate';

/*================================ EMPLOYEE CREATE ==============================*/
$route['master/emp-create'] = 'master/empCreate';

/*================================ EMPLOYEE TABLE LIST ==============================*/
$route['master/employee-table-list'] = 'master/empListJson';


/*================================ SALESMAN ASSIGN ==============================*/
$route['master/salesman-assign-create'] = 'master/salemanAsignCreate';

/*================================ SALESMAN TABLE LIST ==============================*/
$route['master/salesman-table-list'] = 'master/salesManListJson';



/* 
------------ Master Routes end ------------------
*/

/* 
------------ Parties Routes Start ------------------
*/

//VENDOR
$route['parties/vendor-add'] = 'parties/vendorAdd';
$route['parties/vendor-table-list'] = 'parties/vendorListJson';

//CUSTOMER
$route['parties/customre-add-db'] = 'parties/customeraddDb';
$route['parties/customer-table-list'] = 'parties/customerListJson';


/* 
------------ Parties Routes end ------------------
*/

/* 
------------ Purchase Routes Start ------------------
*/

    //PO Add
    $route['purchase/purchase-add'] = 'purchase/purchaseAdddb';
  
    //PO_List
    $route['purchase/purchase-order-table-list'] = 'purchase/purchaseOrderListJson';

    //PO_List
    $route['purchase/landed-cost-add'] = 'purchase/landedCostAdddb';

    //PO_RECEVIED
    $route['purchase/purchase-recevied'] = 'purchase/purchaseRecevied';

    //PRICE CHANGER UPDATE
    $route['purchase/price-update-changer'] = 'purchase/priceUpdateChanger';

    //PRICE CHANGER TABLE LIST
    $route['purchase/price-changer-table-list'] = 'purchase/priceChangerListJson';

    /*================================ PAYMENTOUT CREATE ==============================*/
    $route['purchase/payment-out-create'] = 'purchase/payOutCreate';

    //Item Bulk Upload
    $route['upload/vendor-price-upload'] = 'upload/vendorPriceUpload';
    
/* 
------------ Purchase Routes end ------------------
*/

/* 
------------ Sale Routes Start ------------------
*/

    //*================== SALE ADD =================*/
    
    $route['sale/sale-add'] = 'sale/saleAdddb';

    //*================== SALE RETURN ADD =================*/
    
    $route['sale/sale-return'] = 'sale/saleReturnAdddb';

    //*================== SALE RETURN TABLE LIST =================*/

    $route['sale/sale-return-table-list'] = 'sale/saleReturnListJson';

    //*================== SALE ORDER TABLE LIST =================*/
    
    $route['sale/sale-order-table-list'] = 'sale/saleOrderListJson';

    //*================================ VALIDATE USERNAME AND PASSWORD ==============================*/
    
    $route['sale/validate-user-pass'] = 'sale/validUserPass';

    //*================================ PAYMENTOUT CREATE ==============================*/
    $route['sale/payment-in-create'] = 'sale/payInCreate';
    
  
/* 
------------ Sale Routes end ------------------
*/

/**=======================================================================================================================
 *                                                    PAYMENT ROUTE START
 *=======================================================================================================================**/

    //*================== PAYMENT SALE ADD =================*/
        
    $route['payment/sale-payment-add'] = 'payment/addSalePayment';

 /**=======================================================================================================================
  *                                                    PAYMENT ROUTE END
  *=======================================================================================================================**/

/**=======================================================================================================================
 *                                                    COMMON TABLE LIST START
 *=======================================================================================================================**/

/*================================ PAYMENTOUT TABLE LIST ==============================*/
$route['common/payment-out-table-list'] = 'common/paymentOutListJson';

 /**=======================================================================================================================
 *                                                    COMMON TABLE LIST END
 *=======================================================================================================================**/

/* 
/**========================================================================
 *                           COMMON FUNCTIONS START
 *========================================================================**/
    /*================== SALESMAN AUTH =================*/
        $route['common/salesman-auth'] = 'common/salesmanAuth';

    /*================== USER AUTH =================*/
        $route['common/user-auth'] = 'common/userAuth';

/**========================================================================
 *                           COMMON FUNCTIONS END
 *========================================================================**/
/*

/**========================================================================
 *                           ROLE MANAGEMENT START
 *========================================================================**/
    /*================== ADD GROUP ASSIGN =================*/
        $route['role/group-role-assign'] = 'role/roleGrp';
    /*================== USER ROLE ASSIGN =================*/
        $route['role/user-role-assign'] = 'role/userRoleAssign';
    /*================================ ROLE GROUP TABLE LIST ==============================*/
        $route['role/role-group-table-list'] = 'role/roleGrpListJson';
    /*================================ USER ASSIGN ROLE TABLE LIST ==============================*/
        $route['role/user-assign-table-list'] = 'role/userAssignListJson';
    
    
 /**========================================================================
 *                           ROLE MANAGEMENT END
 *========================================================================**/
/**========================================================================
 *                           ACCOUNT START
 *========================================================================**/
    /*================== NEW ACCOUNT SETUP =================*/
    $route['account/new-acc-setup-add'] = 'account/newAccSetAdd';
    /*================================ NEW ACCOUNT TABLE LIST ==============================*/
    $route['account/new-acc-setup-table-list'] = 'account/newAccSetupListJson';
    
    /*================================ GL PROFILE MODULE TABLE LIST TEST==============================*/
    $route['account/gl-profile-module-table-list-test'] = 'account/glProfileModuleTestListJson';
    /*================== GL PROFILE MODULE ADD =================*/
    $route['account/gl-profile-module-add'] = 'account/glProfileMOduleAdddb';

    /*================== GL ENTRY CREATE =================*/
    $route['account/gl-entry-db'] = 'account/glEntryCreate';
    /*================================ GL PROFILE MODULE TABLE LIST TEST==============================*/
    $route['account/gl-entry-table-list'] = 'account/glEntryListJson';

    /*================== GL PROFILE MODULE ADD TEST=================*/
    $route['account/gl-profile-module-add-test'] = 'account/glProfileMOduleAdddbtest';
    /*================================ GL PROFILE MODULE TABLE LIST==============================*/
    $route['account/gl-profile-module-table-list'] = 'account/glProfileModuleListJson';

    /*================== SYSTEM GL ENTRY CREATE =================*/
    $route['account/system-gl-create-db'] = 'account/systemGlCreate';

    /*================== POST GL ENTRY CREATE =================*/
    $route['account/post-gl-entry-create-db'] = 'account/postGlEntryCreate';
    
    
    
 /**========================================================================
 *                          ACCOUNT END
 *========================================================================**/

 /**========================================================================
  *                           REPORT START
  *========================================================================**/

    /*================== ICM =================*/
  
        /*================== STOCK STATUS ORDER BY CLASS =================*/
        $route['report/stock-status-order-by-class'] = 'report/stockStatusOrderByClass';

        /*================== STOCK BY VENDOR PRICE =================*/
        $route['report/stock-by-vendor-price-report'] = 'report/stkByVenPrice';

        /*================== VENDOR STOCK REPORT =================*/
        $route['report/vendor-stock-report'] = 'report/vendorStockReport';

        /*================== ITEM WITH PICTURE REPORT =================*/
        $route['report/item-with-picture-report'] = 'report/itemWithPicReport';

        /*================== ITEM STOCK WITH PICTURE REPORT =================*/
        $route['report/item-stock-with-picture-report'] = 'report/itemStockWithPicReport';

        /*================== MANUAL INVENTORY TRANSACTION REPORT =================*/
        $route['report/manual-inventory-transaction'] = 'report/manualInvTransReport';

        /*================== STOCK STATUS AS OF DATE REPORT =================*/
        $route['report/stock-status-date-report'] = 'report/stkStaDateReport';

        /*================== INVENTORY TRANSFER ORDER WITH PICTURE REPORT =================*/
        $route['report/inventory-transfer-order-with-pic-report'] = 'report/invTransfOrderWithPicReport';

        /*================== YEAR SALES COMP MONTH REPORT =================*/
        $route['report/year-sale-comp-mon-report'] = 'report/yearSaleCompMonReport';
    
    /*================== PO =================*/
  
        /*================== VENDOR PURCHASE BY DATE REPORT =================*/
        $route['report/vendor-purchase-by-date-report'] = 'report/venPurBydateReport';

        /*================== CUSTOM & MISC. CHARGES REPORT =================*/
        $route['report/custom-misc-charge-report'] = 'report/custMiscChargeReport';

        /*================== PRINT PURCHASE ORDER RETAIL PRICE REPORT =================*/
        $route['report/print-purchase-order-retail-price-report'] = 'report/purOderRPReport';

    /*================== AP =================*/
  
        /*================== PAYMENT ACCOUNT LIST REPORT =================*/
        $route['report/pay-acc-list-report'] = 'report/payAccListReport';

        /*================== VENDOR STATEMENT REPORT =================*/
        $route['report/vendor-statement-report'] = 'report/venStateReport';

        /*================== VENDOR STATEMENT REPORT =================*/
        $route['report/vendor-balance-amount-due-report'] = 'report/vendBalAmtDueReport';

    /*================== AR =================*/
  
        /*================== CUSTOMER STATEMENT REPORT =================*/
        $route['report/customer-statement-report'] = 'report/custStateReport';

        /*================== CUSTOMER TRAIL BALANCE REPORT =================*/
        $route['report/customer-trail-balance-report'] = 'report/custTrailBalReport';

    /*================== SO =================*/
        
        /*================== DAILY SALE REPORT =================*/
        $route['report/daily-sale-report'] = 'report/dailySaleReport';

        /*================== CONSIGNMENT SALES REPORT =================*/
        $route['report/consign-sales-report'] = 'report/consignSaleReport';

        /*================== MONTHLY SALES BY VENDOR BY CATEGORY REPORT =================*/
        $route['report/month-sale-vendor-cate-report'] = 'report/monthSaleByVendorCateReport';

    /*================== ACCOUNT TRAIL BALANCE =================*/
    $route['report/account-trail-balance'] = 'report/accountTrailBalance';
    
   /**========================================================================
  *                           REPORT END
  *========================================================================**/


/*
Important Note :    $route['method/(:any)/(:any)'] = 'controller/method/$1/$2';
                    $route['method/(:any)'] = 'controller/method/$1';  
*/
