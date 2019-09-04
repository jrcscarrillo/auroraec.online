{{ content() }}
{% include "layouts/cabecera.volt" %}
<div class="w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-2"><p class="btn btn-success">CONTRIBUYENTES</p></div>
            <div class="col col-md-3">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("contribuyente/index", "&larr; Atras", "class": "btn btn-warning") }}
                    {{ link_to("contribuyente/new", "Agregar Contribuyente" , "class": "btn btn-info") }}
                </div>
            </div>
            <div class="col col-md-4">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("contribuyente/search", '<i class="icon-fast-backward"></i> Inicio', "class": "btn btn-warning") }}
                    {{ link_to("contribuyente/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Ant.', "class": "btn btn-info") }}
                    {{ link_to("contribuyente/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Prox.', "class": "btn btn-warning") }}
                    {{ link_to("contribuyente/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Fin', "class": "btn btn-info") }}

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
                        <th class="tb-gen tb-c4">Ruc</th>
                        <th class="tb-gen tb-c15">Razon</th>
                        <th class="tb-gen tb-c20">NombreComercial</th>
                        <th class="tb-gen tb-c20">DirMatriz</th>
                        <th class="tb-gen tb-c20">DirEmisor</th>
                        <th class="tb-gen tb-c2">Estab</th>
                        <th class="tb-gen tb-c2">Punto</th>
                        <th class="tb-gen tb-c2">Ambiente</th>
                        <th class="tb-gen tb-c2">Emision</th>
                        <th class="tb-gen tb-c2">Editar</th>
                        <th class="tb-gen tb-c2">Borrar</th>
                        <th class="tb-gen tb-c2">Selecc</th>
                    </tr>
                </thead>
                <tbody>
                    {% if page.items is defined %}
                        {% for contribuyente in page.items %}
                            <tr>
                                <td>{{ contribuyente.Ruc }}</td>
                                <td>{{ contribuyente.Razon }}</td>
                                <td>{{ contribuyente.NombreComercial }}</td>
                                <td>{{ contribuyente.DirMatriz }}</td>
                                <td>{{ contribuyente.DirEmisor }}</td>
                                <td>{{ contribuyente.CodEmisor }}</td>
                                <td>{{ contribuyente.Punto }}</td>
                                <td>{{ contribuyente.Ambiente }}</td>
                                <td>{{ contribuyente.Emision }}</td>

                                <td style="text-align:center;">{{ link_to("contribuyente/edit/"~contribuyente.Id, '<i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                                <td style="text-align:center;">{{ link_to("contribuyente/delete/"~contribuyente.Id, '<i class="fa fa-trash-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                                <td style="text-align:center;">{{ link_to("contribuyente/seleccion/"~contribuyente.Id, '<i class="fa fa-check-circle-o" aria-hidden="true"  style="font-size:24px;color:green;"></i>') }}</td>
                            </tr>
                        {% endfor %}
                    {% else %}
                        No se han encontrado al cliente o clientes con esos parametros
                    {% endif %}
                </tbody>
            </table>
        </div>
    </div>
    {% include "layouts/footer.volt" %}
</div> 
