{% include "layouts/cabecera.volt" %}
<div class="w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-3"><p class="btn btn-success">CONCEPTOS RETENCION</p></div>
            <div class="col col-md-6">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("sricodes/index", "&larr; Atras", "class": "btn btn-warning") }}
                    {{ link_to("sricodes/new", "Agregar Concepto Retencion" , "class": "btn btn-info") }}
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="col-md-12">
            <table id="table-search" class="table coqueirosb table-responsive table-bordered table-striped table-hover" align="center">
                <thead>
                    <tr>
                        <th class="tb-gen tb-c5">ListID</th>
                        <th class="tb-gen tb-c10">Fecha Actualizacion</th>
                        <th class="tb-gen tb-c20">Nombre</th>
                        <th class="tb-gen tb-c10">Codigo Item en QB</th>
                        <th class="tb-gen tb-c20">Nombre Item en QB</th>
                        <th class="tb-gen tb-c5">Codigo Concepto SRI</th>
                        <th class="tb-gen tb-c5">Tipo Concepto</th>
                        <th class="tb-gen tb-c5">Porcentaje</th>
                        <th class="tb-gen tb-c5">Estado</th>

                        <th class="tb-gen tb-c5">Edit</th>
                        <th class="tb-gen tb-c5">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    {% if page.items is defined %}
                        {% for sricode in page.items %}
                            <tr>
                                <td>{{ sricode.getListid() }}</td>
                                <td>{{ sricode.getTimemodified() }}</td>
                                <td>{{ sricode.getFullname() }}</td>
                                <td>{{ sricode.getItemrefListid() }}</td>
                                <td>{{ sricode.getItemrefFullname() }}</td>
                                <td>{{ sricode.getValuecode() }}</td>
                                <td>{{ sricode.getCodetype() }}</td>
                                <td>{{ sricode.getPercentaje() }}</td>
                                <td>{{ sricode.getEstado() }}</td>
                                <td style="text-align:center;">{{ link_to("sricodes/edit/"~sricode.getListid(), '<i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                                <td style="text-align:center;">{{ link_to("sricodes/delete/"~sricode.getListid(), '<i class="fa fa-trash-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                            </tr>
                        {% endfor %}
                    {% endif %}
                </tbody>
            </table>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-3"><p class="btn btn-success">CONCEPTOS RETENCION</p></div>
            <div class="col col-md-6">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("sricodes/search", '<i class="icon-fast-backward"></i> Inicio', "class": "btn btn-warning") }}
                    {{ link_to("sricodes/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Ant.', "class": "btn btn-info") }}
                    {{ link_to("sricodes/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Prox.', "class": "btn btn-warning") }}
                    {{ link_to("sricodes/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Fin', "class": "btn btn-info") }}

                </div>
            </div>
            <div class="col col-md-3">
                <p class="btn btn-info">Pagina {{ page.current }} de {{ page.total_pages }} paginas</p>
            </div>
        </div>
    </div>
</div>