{{ content() }}
{% include "layouts/cabecera.volt" %}
<div class="w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-2"><p class="btn btn-success">NOTAS DE CREDITO</p></div>
            <div class="col col-md-3">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("notacredito/index", "&larr; Atras", "class": "btn btn-warning") }}
                    {{ link_to("creditodb/index", "Agregar NotaCR" , "class": "btn btn-info") }}
                </div>
            </div>
            <div class="col col-md-4">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("notacredito/search", '<i class="icon-fast-backward"></i> Inicio', "class": "btn btn-warning") }}
                    {{ link_to("notacredito/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Ant.', "class": "btn btn-info") }}
                    {{ link_to("notacredito/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Prox.', "class": "btn btn-warning") }}
                    {{ link_to("notacredito/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Fin', "class": "btn btn-info") }}

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
                        <th class="tb-gen tb-c25">Cliente Nombres/Razon </th>
                        <th class="tb-gen tb-c25">Direccion</th>
                        <th class="tb-gen tb-c10">Numero NotaCR</th>
                        <th class="tb-gen tb-c5">Fecha Emision</th>
                        <th class="tb-gen tb-c5">Vendedor</th>
                        <th class="tb-gen tb-c5">Subtotal</th>
                        <th class="tb-gen tb-c2">%</th>
                        <th class="tb-gen tb-c5">Valor IVA</th>
                        <th class="tb-gen tb-c5">Total</th>
                        <th class="tb-gen tb-c5">Estado QB</th>

                        <th class="tb-gen tb-c2">Sincroniza</th>
                    </tr>
                </thead>
                <tbody>
                    {% if page.items is defined%}
                        {% for miscodigos in page.items %}
                            <tr>
                                <td>{{ miscodigos.getCustomerrefFullname() }}</td>
                                <td>{{ miscodigos.getBilladdressAddr1() }}</td>
                                <td>{{ miscodigos.getRefnumber() }}</td>
                                <td>{{ miscodigos.getTxndate() }}</td>
                                <td>{{ miscodigos.getSalesreprefFullname() }}</td>
                                <td>{{ miscodigos.getSubtotal() | number_format(2, ',', '.') }}</td>
                                <td>{{ miscodigos.getSalestaxpercentage() }}</td>
                                <td>{{ miscodigos.getSalestaxtotal() | number_format(2, ',', '.') }}</td>
                                <td>{{ miscodigos.getTotalamount() | number_format(2, ',', '.') }}</td>
                                <td>{{ miscodigos.getStatus() }}</td>
                                <td style="text-align:center;">{{ link_to("notacredito/sincronizar/" ~ miscodigos.getTxnid(), '<i class="fa fa-refresh" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>

                            {% endfor %}
                        {% else %}
                            No se han encontrado notas de credito sincronizadas desde el Quickbooks
                        {% endif %}
                </tbody>
            </table>
        </div>
    </div>
                 {% include "layouts/footer.volt" %}
</div>
