<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("bill/index", "Go Back") }}</li>
            <li class="next">{{ link_to("bill/new", "Create ") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search result</h1>
</div>

{{ content() }}

<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>TxnID</th>
            <th>TimeCreated</th>
            <th>TimeModified</th>
            <th>EditSequence</th>
            <th>TxnNumber</th>
            <th>VendorRef Of ListID</th>
            <th>VendorRef Of FullName</th>
            <th>VendorAddress Of Addr1</th>
            <th>VendorAddress Of Addr2</th>
            <th>VendorAddress Of Addr3</th>
            <th>VendorAddress Of Addr4</th>
            <th>VendorAddress Of Addr5</th>
            <th>VendorAddress Of City</th>
            <th>VendorAddress Of State</th>
            <th>VendorAddress Of PostalCode</th>
            <th>VendorAddress Of Country</th>
            <th>VendorAddress Of Note</th>
            <th>APAccountRef Of ListID</th>
            <th>APAccountRef Of FullName</th>
            <th>TxnDate</th>
            <th>DueDate</th>
            <th>AmountDue</th>
            <th>CurrencyRef Of ListID</th>
            <th>CurrencyRef Of FullName</th>
            <th>ExchangeRate</th>
            <th>AmountDueInHomeCurrency</th>
            <th>RefNumber</th>
            <th>TermsRef Of ListID</th>
            <th>TermsRef Of FullName</th>
            <th>Memo</th>
            <th>IsTaxIncluded</th>
            <th>SalesTaxCodeRef Of ListID</th>
            <th>SalesTaxCodeRef Of FullName</th>
            <th>IsPaID</th>
            <th>OpenAmount</th>
            <th>CustomField1</th>
            <th>CustomField2</th>
            <th>CustomField3</th>
            <th>Status</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for bill in page.items %}
            <tr>
                <td>{{ bill.getTxnid() }}</td>
            <td>{{ bill.getTimecreated() }}</td>
            <td>{{ bill.getTimemodified() }}</td>
            <td>{{ bill.getEditsequence() }}</td>
            <td>{{ bill.getTxnnumber() }}</td>
            <td>{{ bill.getVendorrefListid() }}</td>
            <td>{{ bill.getVendorrefFullname() }}</td>
            <td>{{ bill.getVendoraddressAddr1() }}</td>
            <td>{{ bill.getVendoraddressAddr2() }}</td>
            <td>{{ bill.getVendoraddressAddr3() }}</td>
            <td>{{ bill.getVendoraddressAddr4() }}</td>
            <td>{{ bill.getVendoraddressAddr5() }}</td>
            <td>{{ bill.getVendoraddressCity() }}</td>
            <td>{{ bill.getVendoraddressState() }}</td>
            <td>{{ bill.getVendoraddressPostalcode() }}</td>
            <td>{{ bill.getVendoraddressCountry() }}</td>
            <td>{{ bill.getVendoraddressNote() }}</td>
            <td>{{ bill.getApaccountrefListid() }}</td>
            <td>{{ bill.getApaccountrefFullname() }}</td>
            <td>{{ bill.getTxndate() }}</td>
            <td>{{ bill.getDuedate() }}</td>
            <td>{{ bill.getAmountdue() }}</td>
            <td>{{ bill.getCurrencyrefListid() }}</td>
            <td>{{ bill.getCurrencyrefFullname() }}</td>
            <td>{{ bill.getExchangerate() }}</td>
            <td>{{ bill.getAmountdueinhomecurrency() }}</td>
            <td>{{ bill.getRefnumber() }}</td>
            <td>{{ bill.getTermsrefListid() }}</td>
            <td>{{ bill.getTermsrefFullname() }}</td>
            <td>{{ bill.getMemo() }}</td>
            <td>{{ bill.getIstaxincluded() }}</td>
            <td>{{ bill.getSalestaxcoderefListid() }}</td>
            <td>{{ bill.getSalestaxcoderefFullname() }}</td>
            <td>{{ bill.getIspaid() }}</td>
            <td>{{ bill.getOpenamount() }}</td>
            <td>{{ bill.getCustomfield1() }}</td>
            <td>{{ bill.getCustomfield2() }}</td>
            <td>{{ bill.getCustomfield3() }}</td>
            <td>{{ bill.getStatus() }}</td>

                <td>{{ link_to("bill/edit/"~bill.getTxnid(), "Edit") }}</td>
                <td>{{ link_to("bill/delete/"~bill.getTxnid(), "Delete") }}</td>
            </tr>
        {% endfor %}
        {% endif %}
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            {{ page.current~"/"~page.total_pages }}
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li>{{ link_to("bill/search", "First") }}</li>
                <li>{{ link_to("bill/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("bill/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("bill/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
