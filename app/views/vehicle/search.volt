{% include "layouts/cabecera.volt" %}
<div class="w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-2"><p class="btn btn-success">TRANSPORTE</p></div>
            <div class="col col-md-3">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("vehicle/index", "&larr; Atras", "class": "btn btn-warning") }}
                    {{ link_to("vehicle/new", "Agregar Transporte" , "class": "btn btn-info") }}
                </div>
            </div>
            <div class="col col-md-4">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("vehicle/search", '<i class="icon-fast-backward"></i> Inicio', "class": "btn btn-warning") }}
                    {{ link_to("vehicle/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Ant.', "class": "btn btn-info") }}
                    {{ link_to("vehicle/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Prox.', "class": "btn btn-warning") }}
                    {{ link_to("vehicle/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Fin', "class": "btn btn-info") }}

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
                        <th class="tb-gen tb-c4">Placa</th>
                        <th class="tb-gen tb-c30">Nombre Largo</th>
                        <th class="tb-gen tb-c30">Direccion</th>
                        <th class="tb-gen tb-c5">Telefono</th>
                        <th class="tb-gen tb-c20">Email</th>
                        <th class="tb-gen tb-c4">TipoId</th>
                        <th class="tb-gen tb-c4">NumeroId</th>
                        <th class="tb-gen tb-c4">Modificar</th>
                        <th class="tb-gen tb-c4">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    {% if page.items is defined %}
                        {% for vehicle in page.items %}
                            <tr>
                                <td>{{ vehicle.getname() }}</td>
                                <td>{{ vehicle.getdescription() }}</td>
                                <td>{{ vehicle.getaddress() }}</td>
                                <td>{{ vehicle.getphone() }}</td>
                                <td>{{ vehicle.getemail() }}</td>
                                <td>{{ vehicle.gettipoId() }}</td>
                                <td>{{ vehicle.getnumeroId() }}</td>
                                <td style="text-align:center;">{{ link_to("vehicle/edit/"~vehicle.getlistID(), '<i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                                <td style="text-align:center;">{{ link_to("vehicle/delete/"~vehicle.getlistID(), '<i class="fa fa-trash-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                            </tr>
                        {% endfor %}
                    {% else %}
                        No se han encontrado vehicuos de transporte con esos parametros
                    {% endif %}
                </tbody>
            </table>
        </div>
    </div>
    {% include "layouts/footer.volt" %}
</div> 


