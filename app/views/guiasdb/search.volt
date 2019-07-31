{{ content() }}
{% include "layouts/cabecera.volt" %}
<div class="w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-2"><p class="btn btn-success">GUIAS X FACTURAS</p></div>
            <div class="col col-md-3">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("guiasdb/index", "&larr; Atras", "class": "btn btn-warning") }}
                </div>
            </div>
            <div class="col col-md-4">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("guiasdb/search", '<i class="icon-fast-backward"></i> Inicio', "class": "btn btn-warning") }}
                    {{ link_to("guiasdb/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Ant.', "class": "btn btn-info") }}
                    {{ link_to("guiasdb/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Prox.', "class": "btn btn-warning") }}
                    {{ link_to("guiasdb/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Fin', "class": "btn btn-info") }}

                </div>
            </div>
            <div class="col col-md-3">
                <p class="btn btn-info">Pagina {{ page.current }} de {{ page.total_pages }} paginas</p>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="col-md-12">
            <table id="table-search" class="table coqueirosy table-responsive table-bordered table-striped table-hover" align="center">
                <thead>
                    <tr>
                        <th class="tb-gen tb-c25">Direccion</th>
                        <th class="tb-gen tb-c25">Nombres/Razon </th>
                        <th class="tb-gen tb-c10">Fecha Emision</th>
                        <th class="tb-gen tb-c10">Numero Factura</th>

                        <th class="tb-gen tb-c4">Vendedor</th>
                        <th class="tb-gen tb-c5" style="text-align:right;">Subtotal</th>
                        <th class="tb-gen tb-c5" style="text-align:right;">Valor IVA</th>
                        <th class="tb-gen tb-c5" style="text-align:right;">Total</th>
                        <th class="tb-gen tb-c5">Estado SRI</th>

                        <th class="tb-gen tb-c5">Generar Guia</th>
                    </tr>
                </thead>
                <tbody>
                    {% if page.items is defined%}
                        {% for miscodigos in page.items %}
                            {% set fecha = date('F j, Y', strtotime(miscodigos.getTxnDate()))%}
                            <tr>
                                <td>{{ miscodigos.getBilladdressAddr1() }}</td>
                                <td>{{ miscodigos.getCustomerrefFullname() }}</td>
                                <td>{{ fecha }}</td>
                                <td>{{ miscodigos.getTxnNumber() }}</td>

                                <td>{{ miscodigos.getSalesreprefFullname() }}</td>
                                <td>{{ miscodigos.getSubtotal() | number_format(2, ',', '.') }}</td>
                                <td>{{ miscodigos.getSalestaxtotal() | number_format(2, ',', '.') }}</td>
                                <td>{{ miscodigos.getAppliedamount() | number_format(2, ',', '.') }}</td>
                                <td>{{ miscodigos.getCustomField15() }}</td>

                                <td style="text-align:center;">{{ link_to("guiasdb/cabecera/" ~ miscodigos.getTxnID(), '<i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                            </tr>
                        {% endfor %}
                    {% else %}
                        No se han encontrado facturas con numeros de guias pendientes
                    {% endif %}
                </tbody>
            </table>
        </div>
    </div>
    {% include "layouts/footer.volt" %}
</div>
