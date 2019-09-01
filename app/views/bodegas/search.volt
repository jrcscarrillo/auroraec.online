{% include "layouts/cabecera.volt" %}
<div class="w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-2"><p class="btn btn-success">BODEGAS</p></div>
            <div class="col col-md-3">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("bodegas/index", "&larr; Atras", "class": "btn btn-warning") }}
                    {{ link_to("bodegas/new", "Agregar Contribuyente" , "class": "btn btn-info") }}
                </div>
            </div>
            <div class="col col-md-4">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("bodegas/search", '<i class="icon-fast-backward"></i> Inicio', "class": "btn btn-warning") }}
                    {{ link_to("bodegas/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Ant.', "class": "btn btn-info") }}
                    {{ link_to("bodegas/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Prox.', "class": "btn btn-warning") }}
                    {{ link_to("bodegas/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Fin', "class": "btn btn-info") }}

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

                        <th class="tb-gen tb-c10">Nombre Corto</th>
                        <th class="tb-gen tb-c30">Nombre Completo</th>
                        <th class="tb-gen tb-c30">Direccion</th>
                        <th class="tb-gen tb-c2">Activo?</th>
                        <th class="tb-gen tb-c2">Status</th>
                        <th class="tb-gen tb-c2">Estado</th>
                        <th class="tb-gen tb-c4">Editar</th>
                        <th class="tb-gen tb-c4">SIN-MOV</th>
                        <th class="tb-gen tb-c4">CON-MOV</th>
                    </tr>
                </thead>
                <tbody>
                    {% if page.items is defined %}
                        {% for bodegas in page.items %}
                            <tr>
                                <td>{{ bodegas.getName() }}</td>
                                <td>{{ bodegas.getFullname() }}</td>
                                <td>{{ bodegas.getBodegaAddress() }}</td>
                                <td>{{ bodegas.getIsactive() }}</td>
                                <td>{{ bodegas.getStatus() }}</td>
                                <td>{{ bodegas.getEstado() }}</td>
                                <td style="text-align:center;">{{ link_to("bodegas/edit/"~bodegas.getListid(), '<i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                                <td style="text-align:center;">{{ link_to("bodegas/sinmov/"~bodegas.getListid(), '<i class="fa fa-trash-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                                <td style="text-align:center;">{{ link_to("bodegas/conmov/"~bodegas.getListid(), '<i class="fa fa-check-circle-o" aria-hidden="true"  style="font-size:24px;color:green;"></i>') }}</td>

                            </tr>
                        {% endfor %}
                    {% else %}
                        No se han encontrado a la bodega o bodegas con esos parametros
                    {% endif %}
                </tbody>
            </table>
        </div>
    </div>
    {% include "layouts/footer.volt" %}
</div> 