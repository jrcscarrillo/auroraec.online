{{ content() }}
{% include "layouts/cabecera.volt" %}
<div class="w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-2"><p class="btn btn-success">FACTURAS</p></div>
            <div class="col col-md-3">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("vendorcredit/index", "&larr; Atras", "class": "btn btn-warning") }}
                    {{ link_to("retenciondb/index", "Agregar Retencion" , "class": "btn btn-info") }}
                </div>
            </div>
            <div class="col col-md-4">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("vendorcredit/search", '<i class="icon-fast-backward"></i> Inicio', "class": "btn btn-warning") }}
                    {{ link_to("vendorcredit/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Ant.', "class": "btn btn-info") }}
                    {{ link_to("vendorcredit/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Prox.', "class": "btn btn-warning") }}
                    {{ link_to("vendorcredit/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Fin', "class": "btn btn-info") }}

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
                        <th class="tb-gen tb-c30">Proveedor Nombres/Razon </th>
                        <th class="tb-gen tb-c10">Fecha Emision</th>
                        <th class="tb-gen tb-c10">Numero Retencion</th>
                        <th class="tb-gen tb-c10">Valor Retencion</th>
                        <th class="tb-gen tb-c10">Estado SRI</th>

                        <th class="tb-gen tb-c10">Firma</th>
                        <th class="tb-gen tb-c10">Autoriza</th>
                        <th class="tb-gen tb-c10">Imprime</th>
                    </tr>
                </thead>
                <tbody>
                    {% if page.items is defined%}
                        {% for miscodigos in page.items %}
                            <tr>
                                <td>{{ miscodigos.getVendorrefFullname() }}</td>
                                <td>{{ miscodigos.getTxndate() }}</td>
                                <td>{{ miscodigos.getRefnumber() }}</td>
                                <td>{{ miscodigos.getCreditamount() | number_format(2, ',', '.') }}</td>
                                <td>{{ miscodigos.getCustomField15() }}</td>
                                <td style="text-align:center;">{{ link_to("vendorcredit/firmar/" ~ miscodigos.getTxnid(), '<i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                                <td style="text-align:center;">{{ link_to("vendorcredit/autorizar/" ~ miscodigos.getTxnid(), '<i class="fa fa-certificate" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                                <td style="text-align:center;">{{ link_to("vendorcredit/impresion/" ~ miscodigos.getTxnid(), '<i class="fa fa-print" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
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