<?php

class Vendor extends \Phalcon\Mvc\Model {

// **********************
// ATTRIBUTE DECLARATION
// **********************

    protected $ListID;
    protected $TimeCreated;
    protected $TimeModified;
    protected $EditSequence;
    protected $Name;
    protected $IsActive;
    protected $ClassRef_ListID;
    protected $ClassRef_FullName;
    protected $CompanyName;
    protected $Salutation;
    protected $FirstName;
    protected $MiddleName;
    protected $LastName;
    protected $JobTitle;
    protected $Suffix;
    protected $VendorAddress_Addr1;
    protected $VendorAddress_Addr2;
    protected $VendorAddress_Addr3;
    protected $VendorAddress_Addr4;
    protected $VendorAddress_Addr5;
    protected $VendorAddress_City;
    protected $VendorAddress_State;
    protected $VendorAddress_PostalCode;
    protected $VendorAddress_Country;
    protected $VendorAddress_Note;
    protected $ShipAddress_Addr1;
    protected $ShipAddress_Addr2;
    protected $ShipAddress_Addr3;
    protected $ShipAddress_Addr4;
    protected $ShipAddress_Addr5;
    protected $ShipAddress_City;
    protected $ShipAddress_State;
    protected $ShipAddress_PostalCode;
    protected $ShipAddress_Country;
    protected $ShipAddress_Note;
    protected $Phone;
    protected $Mobile;
    protected $Pager;
    protected $AltPhone;
    protected $Fax;
    protected $Email;
    protected $Cc;
    protected $Contact;
    protected $AltContact;
    protected $NameOnCheck;
    protected $Notes;
    protected $AccountNumber;
    protected $VendorTypeRef_ListID;
    protected $VendorTypeRef_FullName;
    protected $TermsRef_ListID;
    protected $TermsRef_FullName;
    protected $CreditLimit;
    protected $VendorTaxIdent;
    protected $IsVendorEligibleFor1099;
    protected $Balance;
    protected $CurrencyRef_ListID;
    protected $CurrencyRef_FullName;
    protected $BillingRateRef_ListID;
    protected $BillingRateRef_FullName;
    protected $SalesTaxCodeRef_ListID;
    protected $SalesTaxCodeRef_FullName;
    protected $SalesTaxCountry;
    protected $IsSalesTaxAgency;
    protected $SalesTaxReturnRef_ListID;
    protected $SalesTaxReturnRef_FullName;
    protected $TaxRegistrationNumber;
    protected $ReportingPeriod;
    protected $IsTaxTrackedOnPurchases;
    protected $TaxOnPurchasesAccountRef_ListID;
    protected $TaxOnPurchasesAccountRef_FullName;
    protected $IsTaxTrackedOnSales;
    protected $TaxOnSalesAccountRef_ListID;
    protected $TaxOnSalesAccountRef_FullName;
    protected $IsTaxOnTax;
    protected $PrefillAccountRef_ListID;
    protected $PrefillAccountRef_FullName;
    protected $CustomField1;
    protected $CustomField2;
    protected $CustomField3;
    protected $CustomField4;
    protected $CustomField5;
    protected $CustomField6;
    protected $CustomField7;
    protected $CustomField8;
    protected $CustomField9;
    protected $CustomField10;
    protected $CustomField11;
    protected $CustomField12;
    protected $CustomField13;
    protected $CustomField14;
    protected $CustomField15;
    protected $Status;

// **********************
// GETTER METHODS
// **********************


    function getListID() {
        return $this->ListID;
    }

    function getTimeCreated() {
        return $this->TimeCreated;
    }

    function getTimeModified() {
        return $this->TimeModified;
    }

    function getEditSequence() {
        return $this->EditSequence;
    }

    function getName() {
        return $this->Name;
    }

    function getIsActive() {
        return $this->IsActive;
    }

    function getClassRefListID() {
        return $this->ClassRef_ListID;
    }

    function getClassRefFullName() {
        return $this->ClassRef_FullName;
    }

    function getCompanyName() {
        return $this->CompanyName;
    }

    function getSalutation() {
        return $this->Salutation;
    }

    function getFirstName() {
        return $this->FirstName;
    }

    function getMiddleName() {
        return $this->MiddleName;
    }

    function getLastName() {
        return $this->LastName;
    }

    function getJobTitle() {
        return $this->JobTitle;
    }

    function getSuffix() {
        return $this->Suffix;
    }

    function getVendorAddress_Addr1() {
        return $this->VendorAddress_Addr1;
    }

    function getVendorAddress_Addr2() {
        return $this->VendorAddress_Addr2;
    }

    function getVendorAddress_Addr3() {
        return $this->VendorAddress_Addr3;
    }

    function getVendorAddress_Addr4() {
        return $this->VendorAddress_Addr4;
    }

    function getVendorAddress_Addr5() {
        return $this->VendorAddress_Addr5;
    }

    function getVendorAddress_City() {
        return $this->VendorAddress_City;
    }

    function getVendorAddress_State() {
        return $this->VendorAddress_State;
    }

    function getVendorAddress_PostalCode() {
        return $this->VendorAddress_PostalCode;
    }

    function getVendorAddress_Country() {
        return $this->VendorAddress_Country;
    }

    function getVendorAddress_Note() {
        return $this->VendorAddress_Note;
    }

    function getShipAddress_Addr1() {
        return $this->ShipAddress_Addr1;
    }

    function getShipAddress_Addr2() {
        return $this->ShipAddress_Addr2;
    }

    function getShipAddress_Addr3() {
        return $this->ShipAddress_Addr3;
    }

    function getShipAddress_Addr4() {
        return $this->ShipAddress_Addr4;
    }

    function getShipAddress_Addr5() {
        return $this->ShipAddress_Addr5;
    }

    function getShipAddress_City() {
        return $this->ShipAddress_City;
    }

    function getShipAddress_State() {
        return $this->ShipAddress_State;
    }

    function getShipAddress_PostalCode() {
        return $this->ShipAddress_PostalCode;
    }

    function getShipAddress_Country() {
        return $this->ShipAddress_Country;
    }

    function getShipAddress_Note() {
        return $this->ShipAddress_Note;
    }

    function getPhone() {
        return $this->Phone;
    }

    function getMobile() {
        return $this->Mobile;
    }

    function getPager() {
        return $this->Pager;
    }

    function getAltPhone() {
        return $this->AltPhone;
    }

    function getFax() {
        return $this->Fax;
    }

    function getEmail() {
        return $this->Email;
    }

    function getCc() {
        return $this->Cc;
    }

    function getContact() {
        return $this->Contact;
    }

    function getAltContact() {
        return $this->AltContact;
    }

    function getNameOnCheck() {
        return $this->NameOnCheck;
    }

    function getNotes() {
        return $this->Notes;
    }

    function getAccountNumber() {
        return $this->AccountNumber;
    }

    function getVendorTypeRefListID() {
        return $this->VendorTypeRef_ListID;
    }

    function getVendorTypeRefFullName() {
        return $this->VendorTypeRef_FullName;
    }

    function getTermsRefListID() {
        return $this->TermsRef_ListID;
    }

    function getTermsRefFullName() {
        return $this->TermsRef_FullName;
    }

    function getCreditLimit() {
        return $this->CreditLimit;
    }

    function getVendorTaxIdent() {
        return $this->VendorTaxIdent;
    }

    function getIsVendorEligibleFor1099() {
        return $this->IsVendorEligibleFor1099;
    }

    function getBalance() {
        return $this->Balance;
    }

    function getCurrencyRefListID() {
        return $this->CurrencyRef_ListID;
    }

    function getCurrencyRefFullName() {
        return $this->CurrencyRef_FullName;
    }

    function getBillingRateRefListID() {
        return $this->BillingRateRef_ListID;
    }

    function getBillingRateRefFullName() {
        return $this->BillingRateRef_FullName;
    }

    function getSalesTaxCodeRefListID() {
        return $this->SalesTaxCodeRef_ListID;
    }

    function getSalesTaxCodeRefFullName() {
        return $this->SalesTaxCodeRef_FullName;
    }

    function getSalesTaxCountry() {
        return $this->SalesTaxCountry;
    }

    function getIsSalesTaxAgency() {
        return $this->IsSalesTaxAgency;
    }

    function getSalesTaxReturnRefListID() {
        return $this->SalesTaxReturnRef_ListID;
    }

    function getSalesTaxReturnRefFullName() {
        return $this->SalesTaxReturnRef_FullName;
    }

    function getTaxRegistrationNumber() {
        return $this->TaxRegistrationNumber;
    }

    function getReportingPeriod() {
        return $this->ReportingPeriod;
    }

    function getIsTaxTrackedOnPurchases() {
        return $this->IsTaxTrackedOnPurchases;
    }

    function getTaxOnPurchasesAccountRefListID() {
        return $this->TaxOnPurchasesAccountRef_ListID;
    }

    function getTaxOnPurchasesAccountRefFullName() {
        return $this->TaxOnPurchasesAccountRef_FullName;
    }

    function getIsTaxTrackedOnSales() {
        return $this->IsTaxTrackedOnSales;
    }

    function getTaxOnSalesAccountRefListID() {
        return $this->TaxOnSalesAccountRef_ListID;
    }

    function getTaxOnSalesAccountRefFullName() {
        return $this->TaxOnSalesAccountRef_FullName;
    }

    function getIsTaxOnTax() {
        return $this->IsTaxOnTax;
    }

    function getPrefillAccountRefListID() {
        return $this->PrefillAccountRef_ListID;
    }

    function getPrefillAccountRefFullName() {
        return $this->PrefillAccountRef_FullName;
    }

    function getCustomField1() {
        return $this->CustomField1;
    }

    function getCustomField2() {
        return $this->CustomField2;
    }

    function getCustomField3() {
        return $this->CustomField3;
    }

    function getCustomField4() {
        return $this->CustomField4;
    }

    function getCustomField5() {
        return $this->CustomField5;
    }

    function getCustomField6() {
        return $this->CustomField6;
    }

    function getCustomField7() {
        return $this->CustomField7;
    }

    function getCustomField8() {
        return $this->CustomField8;
    }

    function getCustomField9() {
        return $this->CustomField9;
    }

    function getCustomField10() {
        return $this->CustomField10;
    }

    function getCustomField11() {
        return $this->CustomField11;
    }

    function getCustomField12() {
        return $this->CustomField12;
    }

    function getCustomField13() {
        return $this->CustomField13;
    }

    function getCustomField14() {
        return $this->CustomField14;
    }

    function getCustomField15() {
        return $this->CustomField15;
    }

    function getStatus() {
        return $this->Status;
    }

// **********************
// SETTER METHODS
// **********************


    function setListID($val) {
        $this->ListID = $val;
    }

    function setTimeCreated($val) {
        $this->TimeCreated = $val;
    }

    function setTimeModified($val) {
        $this->TimeModified = $val;
    }

    function setEditSequence($val) {
        $this->EditSequence = $val;
    }

    function setName($val) {
        $this->Name = $val;
    }

    function setIsActive($val) {
        $this->IsActive = $val;
    }

    function setClassRefListID($val) {
        $this->ClassRef_ListID = $val;
    }

    function setClassRefFullName($val) {
        $this->ClassRef_FullName = $val;
    }

    function setCompanyName($val) {
        $this->CompanyName = $val;
    }

    function setSalutation($val) {
        $this->Salutation = $val;
    }

    function setFirstName($val) {
        $this->FirstName = $val;
    }

    function setMiddleName($val) {
        $this->MiddleName = $val;
    }

    function setLastName($val) {
        $this->LastName = $val;
    }

    function setJobTitle($val) {
        $this->JobTitle = $val;
    }

    function setSuffix($val) {
        $this->Suffix = $val;
    }

    function setVendorAddress_Addr1($val) {
        $this->VendorAddress_Addr1 = $val;
    }

    function setVendorAddress_Addr2($val) {
        $this->VendorAddress_Addr2 = $val;
    }

    function setVendorAddress_Addr3($val) {
        $this->VendorAddress_Addr3 = $val;
    }

    function setVendorAddress_Addr4($val) {
        $this->VendorAddress_Addr4 = $val;
    }

    function setVendorAddress_Addr5($val) {
        $this->VendorAddress_Addr5 = $val;
    }

    function setVendorAddress_City($val) {
        $this->VendorAddress_City = $val;
    }

    function setVendorAddress_State($val) {
        $this->VendorAddress_State = $val;
    }

    function setVendorAddress_PostalCode($val) {
        $this->VendorAddress_PostalCode = $val;
    }

    function setVendorAddress_Country($val) {
        $this->VendorAddress_Country = $val;
    }

    function setVendorAddress_Note($val) {
        $this->VendorAddress_Note = $val;
    }

    function setShipAddress_Addr1($val) {
        $this->ShipAddress_Addr1 = $val;
    }

    function setShipAddress_Addr2($val) {
        $this->ShipAddress_Addr2 = $val;
    }

    function setShipAddress_Addr3($val) {
        $this->ShipAddress_Addr3 = $val;
    }

    function setShipAddress_Addr4($val) {
        $this->ShipAddress_Addr4 = $val;
    }

    function setShipAddress_Addr5($val) {
        $this->ShipAddress_Addr5 = $val;
    }

    function setShipAddress_City($val) {
        $this->ShipAddress_City = $val;
    }

    function setShipAddress_State($val) {
        $this->ShipAddress_State = $val;
    }

    function setShipAddress_PostalCode($val) {
        $this->ShipAddress_PostalCode = $val;
    }

    function setShipAddress_Country($val) {
        $this->ShipAddress_Country = $val;
    }

    function setShipAddress_Note($val) {
        $this->ShipAddress_Note = $val;
    }

    function setPhone($val) {
        $this->Phone = $val;
    }

    function setMobile($val) {
        $this->Mobile = $val;
    }

    function setPager($val) {
        $this->Pager = $val;
    }

    function setAltPhone($val) {
        $this->AltPhone = $val;
    }

    function setFax($val) {
        $this->Fax = $val;
    }

    function setEmail($val) {
        $this->Email = $val;
    }

    function setCc($val) {
        $this->Cc = $val;
    }

    function setContact($val) {
        $this->Contact = $val;
    }

    function setAltContact($val) {
        $this->AltContact = $val;
    }

    function setNameOnCheck($val) {
        $this->NameOnCheck = $val;
    }

    function setNotes($val) {
        $this->Notes = $val;
    }

    function setAccountNumber($val) {
        $this->AccountNumber = $val;
    }

    function setVendorTypeRefListID($val) {
        $this->VendorTypeRef_ListID = $val;
    }

    function setVendorTypeRefFullName($val) {
        $this->VendorTypeRef_FullName = $val;
    }

    function setTermsRefListID($val) {
        $this->TermsRef_ListID = $val;
    }

    function setTermsRefFullName($val) {
        $this->TermsRef_FullName = $val;
    }

    function setCreditLimit($val) {
        $this->CreditLimit = $val;
    }

    function setVendorTaxIdent($val) {
        $this->VendorTaxIdent = $val;
    }

    function setIsVendorEligibleFor1099($val) {
        $this->IsVendorEligibleFor1099 = $val;
    }

    function setBalance($val) {
        $this->Balance = $val;
    }

    function setCurrencyRefListID($val) {
        $this->CurrencyRef_ListID = $val;
    }

    function setCurrencyRefFullName($val) {
        $this->CurrencyRef_FullName = $val;
    }

    function setBillingRateRefListID($val) {
        $this->BillingRateRef_ListID = $val;
    }

    function setBillingRateRefFullName($val) {
        $this->BillingRateRef_FullName = $val;
    }

    function setSalesTaxCodeRefListID($val) {
        $this->SalesTaxCodeRef_ListID = $val;
    }

    function setSalesTaxCodeRefFullName($val) {
        $this->SalesTaxCodeRef_FullName = $val;
    }

    function setSalesTaxCountry($val) {
        $this->SalesTaxCountry = $val;
    }

    function setIsSalesTaxAgency($val) {
        $this->IsSalesTaxAgency = $val;
    }

    function setSalesTaxReturnRefListID($val) {
        $this->SalesTaxReturnRef_ListID = $val;
    }

    function setSalesTaxReturnRefFullName($val) {
        $this->SalesTaxReturnRef_FullName = $val;
    }

    function setTaxRegistrationNumber($val) {
        $this->TaxRegistrationNumber = $val;
    }

    function setReportingPeriod($val) {
        $this->ReportingPeriod = $val;
    }

    function setIsTaxTrackedOnPurchases($val) {
        $this->IsTaxTrackedOnPurchases = $val;
    }

    function setTaxOnPurchasesAccountRefListID($val) {
        $this->TaxOnPurchasesAccountRef_ListID = $val;
    }

    function setTaxOnPurchasesAccountRefFullName($val) {
        $this->TaxOnPurchasesAccountRef_FullName = $val;
    }

    function setIsTaxTrackedOnSales($val) {
        $this->IsTaxTrackedOnSales = $val;
    }

    function setTaxOnSalesAccountRefListID($val) {
        $this->TaxOnSalesAccountRef_ListID = $val;
    }

    function setTaxOnSalesAccountRefFullName($val) {
        $this->TaxOnSalesAccountRef_FullName = $val;
    }

    function setIsTaxOnTax($val) {
        $this->IsTaxOnTax = $val;
    }

    function setPrefillAccountRefListID($val) {
        $this->PrefillAccountRef_ListID = $val;
    }

    function setPrefillAccountRefFullName($val) {
        $this->PrefillAccountRef_FullName = $val;
    }

    function setCustomField1($val) {
        $this->CustomField1 = $val;
    }

    function setCustomField2($val) {
        $this->CustomField2 = $val;
    }

    function setCustomField3($val) {
        $this->CustomField3 = $val;
    }

    function setCustomField4($val) {
        $this->CustomField4 = $val;
    }

    function setCustomField5($val) {
        $this->CustomField5 = $val;
    }

    function setCustomField6($val) {
        $this->CustomField6 = $val;
    }

    function setCustomField7($val) {
        $this->CustomField7 = $val;
    }

    function setCustomField8($val) {
        $this->CustomField8 = $val;
    }

    function setCustomField9($val) {
        $this->CustomField9 = $val;
    }

    function setCustomField10($val) {
        $this->CustomField10 = $val;
    }

    function setCustomField11($val) {
        $this->CustomField11 = $val;
    }

    function setCustomField12($val) {
        $this->CustomField12 = $val;
    }

    function setCustomField13($val) {
        $this->CustomField13 = $val;
    }

    function setCustomField14($val) {
        $this->CustomField14 = $val;
    }

    function setCustomField15($val) {
        $this->CustomField15 = $val;
    }

    function setStatus($val) {
        $this->Status = $val;
    }

    public function initialize() {
        $this->setSchema("coopdb");
        $this->setSource("vendor");
                $this->hasMany('listID', 'Vendorcredit', 'VendorRef_ListID');
                $this->hasMany('listID', 'Bill', 'VendorRef_ListID');
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'vendor';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Vendor[]|Vendor|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null) {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Vendor|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }

}
