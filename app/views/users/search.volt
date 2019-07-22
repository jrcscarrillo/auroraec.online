{{ content() }}
{% include "layouts/cabecera.volt" %}
<div class="w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-2"><p class="btn btn-success">USUARIOS</p></div>
            <div class="col col-md-3">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("users/index", "&larr; Atras", "class": "btn btn-warning") }}
                </div>
            </div>
            <div class="col col-md-4">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("users/search", '<i class="icon-fast-backward"></i> Inicio', "class": "btn btn-warning") }}
                    {{ link_to("users/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Ant.', "class": "btn btn-info") }}
                    {{ link_to("users/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Prox.', "class": "btn btn-warning") }}
                    {{ link_to("users/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Fin', "class": "btn btn-info") }}

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
                        <th class="tb-gen tb-c5">Tipo</th>
                        <th class="tb-gen tb-c10">Username</th>
                        <th class="tb-gen tb-c2">TipoId</th>
                        <th class="tb-gen tb-c10">NumeroId</th>
                        <th class="tb-gen tb-c25">Name</th>
                        <th class="tb-gen tb-c25">Email</th>
                        <th class="tb-gen tb-c2">Active</th>
                        <th class="tb-gen tb-c10">Qbid</th>
                        <th class="tb-gen tb-c2">Habilitar</th>
                        <th class="tb-gen tb-c2">Editar</th>
                        <th class="tb-gen tb-c2">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    {% if page.items is defined %}
                        {% for miscodigos in page.items %}
                            <tr>
                                <td>{{ miscodigos.tipo }}</td>
                                <td>{{ miscodigos.username }}</td>
                                <td>{{ miscodigos.tipoId }}</td>
                                <td>{{ miscodigos.numeroId }}</td>
                                <td>{{ miscodigos.name }}</td>
                                <td>{{ miscodigos.email }}</td>
                                <td>{{ miscodigos.active }}</td>
                                <td>{{ miscodigos.qbid }}</td>
                                <td style="text-align:center;">{{ link_to("users/habilitar/" ~ miscodigos.id, '<i class="fa fa-check-circle-o" aria-hidden="true"  style="font-size:24px;color:green;"></i>')}}</td>
                                <td style="text-align:center;">{{ link_to("users/edit/" ~ miscodigos.id, '<i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                                <td style="text-align:center;">{{ link_to("users/delete/" ~ miscodigos.id, '<i class="fa fa-chain-broken" aria-hidden="true"  style="font-size:24px;color:green;"></i>') }}</td>
                            </tr>
                        {% endfor %}
                    {% else %}
                        No se han encontrado al usuario o usuarios con esos parametros
                    {% endif %}
                </tbody>

            </table>
        </div>
    </div>
    {% include "layouts/footer.volt" %}
</div>


