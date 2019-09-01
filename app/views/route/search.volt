{% include "layouts/cabecera.volt" %}
<div class="w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-2"><p class="btn btn-success">RUTAS</p></div>
            <div class="col col-md-3">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("route/index", "&larr; Atras", "class": "btn btn-warning") }}
                    {{ link_to("route/new", "Agregar Ruta" , "class": "btn btn-info") }}
                </div>
            </div>
            <div class="col col-md-4">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("route/search", '<i class="icon-fast-backward"></i> Inicio', "class": "btn btn-warning") }}
                    {{ link_to("route/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Ant.', "class": "btn btn-info") }}
                    {{ link_to("route/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Prox.', "class": "btn btn-warning") }}
                    {{ link_to("route/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Fin', "class": "btn btn-info") }}

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
                        <th class="tb-gen tb-c30">Nombre Largo</th>
                        <th class="tb-gen tb-c30">Direccion</th>
                        <th class="tb-gen tb-c10">Telefono</th>
                        <th class="tb-gen tb-c20">Email</th>
                        <th class="tb-gen tb-c5">TipoId</th>
                        <th class="tb-gen tb-c5">NumeroId</th>
                        <th class="tb-gen tb-c5">Editar</th>
                        <th class="tb-gen tb-c5">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    {% if page.items is defined %}
                        {% for route in page.items %}
                            <tr>
                                <td>{{ route.getname() }}</td>
                                <td>{{ route.getdescription() }}</td>
                                <td>{{ route.getaddress() }}</td>
                                <td>{{ route.getphone() }}</td>
                                <td>{{ route.getemail() }}</td>
                                <td>{{ route.gettipoId() }}</td>
                                <td>{{ route.getnumeroId() }}</td>
                                <td style="text-align:center;">{{ link_to("route/edit/"~route.getlistID(), '<i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                                <td style="text-align:center;">{{ link_to("route/delete/"~route.getlistID(), '<i class="fa fa-trash-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                            </tr>
                        {% endfor %}
                    {% else %}
                        No se han encontrado la ruta o rutas con esos parametros
                    {% endif %}
                </tbody>
            </table>
        </div>
    </div>
    {% include "layouts/footer.volt" %}
</div> 


