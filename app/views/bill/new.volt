<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("bill", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create bill
    </h1>
</div>

{{ content() }}

{{ form("bill/create", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldTxnid" class="col-sm-2 control-label">TxnID</label>
    <div class="col-sm-10">
        {{ text_field("TxnID", "size" : 30, "class" : "form-control", "id" : "fieldTxnid") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldTimecreated" class="col-sm-2 control-label">TimeCreated</label>
    <div class="col-sm-10">
        {{ text_field("TimeCreated", "size" : 30, "class" : "form-control", "id" : "fieldTimecreated") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldTimemodified" class="col-sm-2 control-label">TimeModified</label>
    <div class="col-sm-10">
        {{ text_field("TimeModified", "size" : 30, "class" : "form-control", "id" : "fieldTimemodified") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldEditsequence" class="col-sm-2 control-label">EditSequence</label>
    <div class="col-sm-10">
        {{ text_field("EditSequence", "type" : "numeric", "class" : "form-control", "id" : "fieldEditsequence") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldTxnnumber" class="col-sm-2 control-label">TxnNumber</label>
    <div class="col-sm-10">
        {{ text_field("TxnNumber", "type" : "numeric", "class" : "form-control", "id" : "fieldTxnnumber") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldVendorrefListid" class="col-sm-2 control-label">VendorRef Of ListID</label>
    <div class="col-sm-10">
        {{ text_field("VendorRef_ListID", "size" : 30, "class" : "form-control", "id" : "fieldVendorrefListid") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldVendorrefFullname" class="col-sm-2 control-label">VendorRef Of FullName</label>
    <div class="col-sm-10">
        {{ text_field("VendorRef_FullName", "size" : 30, "class" : "form-control", "id" : "fieldVendorrefFullname") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldVendoraddressAddr1" class="col-sm-2 control-label">VendorAddress Of Addr1</label>
    <div class="col-sm-10">
        {{ text_field("VendorAddress_Addr1", "size" : 30, "class" : "form-control", "id" : "fieldVendoraddressAddr1") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldVendoraddressAddr2" class="col-sm-2 control-label">VendorAddress Of Addr2</label>
    <div class="col-sm-10">
        {{ text_field("VendorAddress_Addr2", "size" : 30, "class" : "form-control", "id" : "fieldVendoraddressAddr2") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldVendoraddressAddr3" class="col-sm-2 control-label">VendorAddress Of Addr3</label>
    <div class="col-sm-10">
        {{ text_field("VendorAddress_Addr3", "size" : 30, "class" : "form-control", "id" : "fieldVendoraddressAddr3") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldVendoraddressAddr4" class="col-sm-2 control-label">VendorAddress Of Addr4</label>
    <div class="col-sm-10">
        {{ text_field("VendorAddress_Addr4", "size" : 30, "class" : "form-control", "id" : "fieldVendoraddressAddr4") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldVendoraddressAddr5" class="col-sm-2 control-label">VendorAddress Of Addr5</label>
    <div class="col-sm-10">
        {{ text_field("VendorAddress_Addr5", "size" : 30, "class" : "form-control", "id" : "fieldVendoraddressAddr5") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldVendoraddressCity" class="col-sm-2 control-label">VendorAddress Of City</label>
    <div class="col-sm-10">
        {{ text_field("VendorAddress_City", "size" : 30, "class" : "form-control", "id" : "fieldVendoraddressCity") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldVendoraddressState" class="col-sm-2 control-label">VendorAddress Of State</label>
    <div class="col-sm-10">
        {{ text_field("VendorAddress_State", "size" : 30, "class" : "form-control", "id" : "fieldVendoraddressState") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldVendoraddressPostalcode" class="col-sm-2 control-label">VendorAddress Of PostalCode</label>
    <div class="col-sm-10">
        {{ text_field("VendorAddress_PostalCode", "size" : 30, "class" : "form-control", "id" : "fieldVendoraddressPostalcode") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldVendoraddressCountry" class="col-sm-2 control-label">VendorAddress Of Country</label>
    <div class="col-sm-10">
        {{ text_field("VendorAddress_Country", "size" : 30, "class" : "form-control", "id" : "fieldVendoraddressCountry") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldVendoraddressNote" class="col-sm-2 control-label">VendorAddress Of Note</label>
    <div class="col-sm-10">
        {{ text_field("VendorAddress_Note", "size" : 30, "class" : "form-control", "id" : "fieldVendoraddressNote") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldApaccountrefListid" class="col-sm-2 control-label">APAccountRef Of ListID</label>
    <div class="col-sm-10">
        {{ text_field("APAccountRef_ListID", "size" : 30, "class" : "form-control", "id" : "fieldApaccountrefListid") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldApaccountrefFullname" class="col-sm-2 control-label">APAccountRef Of FullName</label>
    <div class="col-sm-10">
        {{ text_field("APAccountRef_FullName", "size" : 30, "class" : "form-control", "id" : "fieldApaccountrefFullname") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldTxndate" class="col-sm-2 control-label">TxnDate</label>
    <div class="col-sm-10">
        {{ text_field("TxnDate", "size" : 30, "class" : "form-control", "id" : "fieldTxndate") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldDuedate" class="col-sm-2 control-label">DueDate</label>
    <div class="col-sm-10">
        {{ text_field("DueDate", "size" : 30, "class" : "form-control", "id" : "fieldDuedate") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldAmountdue" class="col-sm-2 control-label">AmountDue</label>
    <div class="col-sm-10">
        {{ text_field("AmountDue", "type" : "numeric", "class" : "form-control", "id" : "fieldAmountdue") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCurrencyrefListid" class="col-sm-2 control-label">CurrencyRef Of ListID</label>
    <div class="col-sm-10">
        {{ text_field("CurrencyRef_ListID", "size" : 30, "class" : "form-control", "id" : "fieldCurrencyrefListid") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCurrencyrefFullname" class="col-sm-2 control-label">CurrencyRef Of FullName</label>
    <div class="col-sm-10">
        {{ text_field("CurrencyRef_FullName", "size" : 30, "class" : "form-control", "id" : "fieldCurrencyrefFullname") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldExchangerate" class="col-sm-2 control-label">ExchangeRate</label>
    <div class="col-sm-10">
        {{ text_field("ExchangeRate", "size" : 30, "class" : "form-control", "id" : "fieldExchangerate") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldAmountdueinhomecurrency" class="col-sm-2 control-label">AmountDueInHomeCurrency</label>
    <div class="col-sm-10">
        {{ text_field("AmountDueInHomeCurrency", "type" : "numeric", "class" : "form-control", "id" : "fieldAmountdueinhomecurrency") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldRefnumber" class="col-sm-2 control-label">RefNumber</label>
    <div class="col-sm-10">
        {{ text_field("RefNumber", "size" : 30, "class" : "form-control", "id" : "fieldRefnumber") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldTermsrefListid" class="col-sm-2 control-label">TermsRef Of ListID</label>
    <div class="col-sm-10">
        {{ text_field("TermsRef_ListID", "size" : 30, "class" : "form-control", "id" : "fieldTermsrefListid") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldTermsrefFullname" class="col-sm-2 control-label">TermsRef Of FullName</label>
    <div class="col-sm-10">
        {{ text_field("TermsRef_FullName", "size" : 30, "class" : "form-control", "id" : "fieldTermsrefFullname") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldMemo" class="col-sm-2 control-label">Memo</label>
    <div class="col-sm-10">
        {{ text_field("Memo", "size" : 30, "class" : "form-control", "id" : "fieldMemo") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldIstaxincluded" class="col-sm-2 control-label">IsTaxIncluded</label>
    <div class="col-sm-10">
        {{ text_field("IsTaxIncluded", "size" : 30, "class" : "form-control", "id" : "fieldIstaxincluded") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldSalestaxcoderefListid" class="col-sm-2 control-label">SalesTaxCodeRef Of ListID</label>
    <div class="col-sm-10">
        {{ text_field("SalesTaxCodeRef_ListID", "size" : 30, "class" : "form-control", "id" : "fieldSalestaxcoderefListid") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldSalestaxcoderefFullname" class="col-sm-2 control-label">SalesTaxCodeRef Of FullName</label>
    <div class="col-sm-10">
        {{ text_field("SalesTaxCodeRef_FullName", "size" : 30, "class" : "form-control", "id" : "fieldSalestaxcoderefFullname") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldIspaid" class="col-sm-2 control-label">IsPaID</label>
    <div class="col-sm-10">
        {{ text_field("IsPaID", "size" : 30, "class" : "form-control", "id" : "fieldIspaid") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldOpenamount" class="col-sm-2 control-label">OpenAmount</label>
    <div class="col-sm-10">
        {{ text_field("OpenAmount", "type" : "numeric", "class" : "form-control", "id" : "fieldOpenamount") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCustomfield1" class="col-sm-2 control-label">CustomField1</label>
    <div class="col-sm-10">
        {{ text_field("CustomField1", "size" : 30, "class" : "form-control", "id" : "fieldCustomfield1") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCustomfield2" class="col-sm-2 control-label">CustomField2</label>
    <div class="col-sm-10">
        {{ text_field("CustomField2", "size" : 30, "class" : "form-control", "id" : "fieldCustomfield2") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCustomfield3" class="col-sm-2 control-label">CustomField3</label>
    <div class="col-sm-10">
        {{ text_field("CustomField3", "size" : 30, "class" : "form-control", "id" : "fieldCustomfield3") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldStatus" class="col-sm-2 control-label">Status</label>
    <div class="col-sm-10">
        {{ text_field("Status", "size" : 30, "class" : "form-control", "id" : "fieldStatus") }}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Save', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
