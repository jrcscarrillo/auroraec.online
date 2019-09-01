<div class="row">
    <div class="col-sm-3">
        <p></p>
    </div>
    <div class="col-sm-6">
        <nav>
            <ul class="pagination">
                <li class="previous">{{ link_to("retenciondb/index", "Atras") }}</li>
                <li>{{ link_to("retenciondb/search", "Primera") }}</li>
                <li>{{ link_to("retenciondb/search?page="~page.before, "Ant.") }}</li>
                <li>{{ link_to("retenciondb/search?page="~page.next, "Sig.") }}</li>
                <li>{{ link_to("retenciondb/search?page="~page.last, "Fin") }}</li>
            </ul>
        </nav>
    </div>
    <div class="col-sm-3">
        <nav>
            <ul class="pagination pagination-lg">
                <li class="btn btn-success">{{ "Pag.  "~page.current ~"  de  " }}</li>
                <li class="btn btn-warning">{{ page.total_pages ~ "  Pags." }}</li>
            </ul>
        </nav>
    </div>
</div>
{{ content() }}
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-responsive table-bordered table-striped" align="center">
                <thead class="coloreando" style="background-color: black">
                    <tr>
                        <th class="tb-gen tb-c30">Proveedor Nombres/Razon </th>
                        <th>Fecha Emision</th>
                        <th>Numero Retencion</th>
                        <th>Valor Retencion</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    {% if page.items is defined%}
                        {% for vendorcredit in page.items %}
                            <tr>
                                <td>{{ vendorcredit.getVendorrefFullname() }}</td>
                                <td>{{ vendorcredit.getTxndate() }}</td>
                                <td>{{ vendorcredit.getRefnumber() }}</td>
                                <td>{{ vendorcredit.getCreditAmount() | number_format(2, ',', '.') }}</td>
                                <td style="text-align:center;">{{ link_to("retenciondb/edit/"~vendorcredit.getTxnID(), '<i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                                <td style="text-align:center;">{{ link_to("retenciondb/delete/"~vendorcredit.getTxnID(), '<i class="fa fa-trash-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                            </tr>
                        </tbody>


                        {% endfor %}
                    {% else %}
                        No se han encontrado retenciones generadas desde AURORA
                    {% endif %}
            </table>
        </div>
    </div>
</div>