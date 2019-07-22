<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("guiatrx/index", "Go Back") }}</li>
            <li class="next">{{ link_to("guiatrx/new", "Create ") }}</li>
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
            <th>NumeroLote</th>
            <th>ItemRefListID</th>
            <th>ItemRefFullName</th>
            <th>ObsLote</th>
            <th>OrigenTrx</th>
            <th>DestinoTrx</th>
            <th>Qty</th>
            <th>IDKEY</th>
            <th>Estado</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for guiatrx in page.items %}
            <tr>
                <td>{{ guiatrx.getTxnid() }}</td>
            <td>{{ guiatrx.getTimecreated() }}</td>
            <td>{{ guiatrx.getTimemodified() }}</td>
            <td>{{ guiatrx.getEditsequence() }}</td>
            <td>{{ guiatrx.getNumerolote() }}</td>
            <td>{{ guiatrx.getItemreflistid() }}</td>
            <td>{{ guiatrx.getItemreffullname() }}</td>
            <td>{{ guiatrx.getObslote() }}</td>
            <td>{{ guiatrx.getOrigentrx() }}</td>
            <td>{{ guiatrx.getDestinotrx() }}</td>
            <td>{{ guiatrx.getQty() }}</td>
            <td>{{ guiatrx.getIdkey() }}</td>
            <td>{{ guiatrx.getEstado() }}</td>

                <td>{{ link_to("guiatrx/edit/"~guiatrx.getTxnid(), "Edit") }}</td>
                <td>{{ link_to("guiatrx/delete/"~guiatrx.getTxnid(), "Delete") }}</td>
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
                <li>{{ link_to("guiatrx/search", "First") }}</li>
                <li>{{ link_to("guiatrx/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("guiatrx/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("guiatrx/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
