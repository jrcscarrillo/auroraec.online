{{ content() }}
{% include "layouts/cabecera.volt" %}
<div class="w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-2"><p class="btn btn-success">FACTURAS</p></div>
            <div class="col col-md-3">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("facturas/index", "&larr; Atras", "class": "btn btn-warning") }}
                    {{ link_to("ventasdb/index", "Agregar Factura" , "class": "btn btn-info") }}
                </div>
            </div>
            <div class="col col-md-4">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("facturas/search", '<i class="icon-fast-backward"></i> Inicio', "class": "btn btn-warning") }}
                    {{ link_to("facturas/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Ant.', "class": "btn btn-info") }}
                    {{ link_to("facturas/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Prox.', "class": "btn btn-warning") }}
                    {{ link_to("facturas/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Fin', "class": "btn btn-info") }}

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
                        <th class="tb-gen tb-c15">Numero Factura</th>

                        <th class="tb-gen tb-c2">Vendedor</th>
                        <th class="tb-gen tb-c5">Subtotal</th>
                        <th class="tb-gen tb-c5">Valor IVA</th>
                        <th class="tb-gen tb-c5">Total</th>
                        <th class="tb-gen tb-c2">Estado QB</th>

                        <th class="tb-gen tb-c2">Sync</th>
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
                                <td>{{ miscodigos.getStatus() }}</td>

                                <td style="text-align:center;">{{ link_to("facturas/sincronizar/" ~ miscodigos.getTxnid(), '<i class="fa fa-refresh" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                            </tr>
                        {% endfor %}
                    {% else %}
                        No se han encontrado facturas sincronizadas desde el Quickbooks
                    {% endif %}
                </tbody>
            </table>
        </div>
    </div>
    {% include "layouts/footer.volt" %}
</div>
