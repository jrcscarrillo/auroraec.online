{{ content() }}
{% include "layouts/cabecera.volt" %}
<div class="w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-2"><p class="btn btn-success">PRODUCTOS</p></div>
            <div class="col col-md-3">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("items/index", "&larr; Atras", "class": "btn btn-warning") }}
                </div>
            </div>
            <div class="col col-md-4">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("items/search", '<i class="icon-fast-backward"></i> Inicio', "class": "btn btn-warning") }}
                    {{ link_to("items/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Ant.', "class": "btn btn-info") }}
                    {{ link_to("items/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Prox.', "class": "btn btn-warning") }}
                    {{ link_to("items/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Fin', "class": "btn btn-info") }}

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
                        <th>Nombre Corto</th>
                        <th>Nombre Largo</th>
                        <th>Descripcion de Ventas</th>
                        
                        <th>Codigo</th>

                        <th>Precio de Venta</th>

                        <th>Cambiar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    {% if page.items is defined %}
                        {% for item in page.items %}
                            <tr>
                                <td>{{ item.fullname }}</td>
                                <td>{{ item.description }}</td>
                                <td>{{ item.sales_desc }}</td>
                                
                                <td>{{ item.name }}</td>

                                <td>{{ item.sales_price }}</td>
                                <td style="text-align:center;">{{ link_to("items/edit/"~item.id, '<i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                                <td style="text-align:center;">{{ link_to("items/delete/"~item.id, '<i class="fa fa-trash-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>                        
                            </tr>
                        {% endfor %}
                    {% endif %}
                </tbody>
            </table>
        </div>
    </div>
    {% include "layouts/footer.volt" %}
</div> 
