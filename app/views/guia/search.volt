{{ content() }}
{{ elements.getModelosAdicional() }}
{% include "layouts/cabecera.volt" %}
<div class="w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-2"><p class="btn btn-success">GUIAS DE REMISION</p></div>
            <div class="col col-md-3">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("guia/index", "&larr; Atras", "class": "btn btn-warning") }}
                    {{ link_to("guiacab/new", "Agregar Guia" , "class": "btn btn-info") }}
                </div>
            </div>
            <div class="col col-md-4">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("guia/search", '<i class="icon-fast-backward"></i> Inicio', "class": "btn btn-warning") }}
                    {{ link_to("guia/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Ant.', "class": "btn btn-info") }}
                    {{ link_to("guia/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Prox.', "class": "btn btn-warning") }}
                    {{ link_to("guia/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Fin', "class": "btn btn-info") }}

                </div>
            </div>
            <div class="col col-md-3">
                <p class="btn btn-info">Pagina {{ page.current }} de {{ page.total_pages }} paginas</p>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="col-md-12">
            <table id="table-search" class="table coqueirosb table-responsive table-bordered table-striped table-hover" align="center">
                <thead>
                    <tr>
                        <th class="tb-gen tb-c10">Fecha Emision</th>
                        <th class="tb-gen tb-c10">Numero Guia</th>
                        <th class="tb-gen tb-c20">Origen</th>
                        <th class="tb-gen tb-c20">Destino</th>
                        <th class="tb-gen tb-c10">Fecha Inicio</th>
                        <th class="tb-gen tb-c10">Fecha Fin</th>
                        <th class="tb-gen tb-c10">Estado SRI</th>
                        <th class="tb-gen tb-c3">Firmar</th>
                        <th class="tb-gen tb-c3">Autorizar</th>
                        <th class="tb-gen tb-c3">Imprimir</th>
                    </tr>
                </thead>
                <tbody>
                    {% if page.items is defined %}
                        {% for guia in page.items %}
                            <tr>
                                <td>{{ guia.txnDate }}</td>
                                <td>{{ guia.refNumber }}</td>
                                <td>{{ guia.origenName }}</td>
                                <td>{{ guia.destinoName }}</td>
                                <td>{{ guia.dateBegin }}</td>
                                <td>{{ guia.dateEnd }}</td>
                                <td>{{ guia.CustomField15 }}</td>
                                <td style="text-align:center;">{{ link_to("guia/firmar/"~guia.refNumber, '<i class="fa fa-pencil" aria-hidden="true"  style="font-size:24px;color:green;"></i>') }}</td>
                                <td style="text-align:center;">{{ link_to("guia/autorizar/"~guia.refNumber, '<i class="fa fa-certificate" aria-hidden="true"  style="font-size:24px;color:green;"></i>') }}</td>
                                <td style="text-align:center;">{{ link_to("guia/impresion/"~guia.refNumber, '<i class="fa fa-print" aria-hidden="true"  style="font-size:24px;color:green;"></i>') }}</td>

                            </tr>
                        {% endfor %}
                    {% endif %}
                </tbody>
            </table>
        </div>
    </div>
</div>

