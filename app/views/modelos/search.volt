{{ content() }}
{% include "layouts/cabecera.volt" %}
<div class="w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-2"><p class="btn btn-success">PAGINAS</p></div>
            <div class="col col-md-3">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("modelos/index", "&larr; Atras", "class": "btn btn-warning") }}
                    {{ link_to("modelos/new", "Agregar Pagina" , "class": "btn btn-info") }}
                </div>
            </div>
            <div class="col col-md-4">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("modelos/search", '<i class="icon-fast-backward"></i> Inicio', "class": "btn btn-warning") }}
                    {{ link_to("modelos/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Ant.', "class": "btn btn-info") }}
                    {{ link_to("modelos/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Prox.', "class": "btn btn-warning") }}
                    {{ link_to("modelos/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Fin', "class": "btn btn-info") }}

                </div>
            </div>
            <div class="col col-md-3">
                <p class="btn btn-info">Pagina {{ page.current }} de {{ page.total_pages }} paginas</p>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="col-xs-12">
            <table class="table table-responsive table-bordered table-striped table-hover w-auto" align="center">
                <thead class="thead-dark font-weight-bold">
                    <tr>

                        <th class="tb-gen tb-c30">Descripcion en la pantalla</th>                                
                        <th class="tb-gen tb-c30">Programa</th>
                        <th class="tb-gen tb-c30">Accion</th>
                        <th class="tb-gen tb-c5">Editar</th>
                        <th class="tb-gen tb-c5">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    {% if page.items is defined %}       
                        {% for miscodigos in page.items %}
                            <tr>
                                <td>{{ miscodigos.modelDes }}</td>
                                <td>{{ miscodigos.modelName }}</td>
                                <td>{{ miscodigos.actionName }}</td>
                                <td style="text-align:center;">{{ link_to("modelos/edit/" ~ miscodigos.id, '<i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                                <td style="text-align:center;">{{ link_to("modelos/delete/" ~ miscodigos.id, '<i class="fa fa-trash-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                            </tr>
                        {% endfor %}
                    {% else %}
                        No se han encontrado descripciones
                    {% endif %}
                </tbody>
            </table>
        </div>
    </div>
    {% include "layouts/footer.volt" %}
</div>
