{{ content() }}
{% include "layouts/cabecera.volt" %}
<div class="w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-2"><p class="btn btn-success">CLIENTES</p></div>
            <div class="col col-md-3">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("customer/index", "&larr; Atras", "class": "btn btn-warning") }}
                    {{ link_to("customer/new", "Agregar Cliente" , "class": "btn btn-info") }}
                </div>
            </div>
            <div class="col col-md-4">
                <div class="btn-group " role="group" aria-label="Basic example">
                    {{ link_to("customer/search", '<i class="icon-fast-backward"></i> Inicio', "class": "btn btn-warning") }}
                    {{ link_to("customer/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Ant.', "class": "btn btn-info") }}
                    {{ link_to("customer/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Prox.', "class": "btn btn-warning") }}
                    {{ link_to("customer/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Fin', "class": "btn btn-info") }}

                </div>
            </div>
            <div class="col col-md-3">
                <p class="btn btn-info">Pagina {{ page.current }} de {{ page.total_pages }} paginas</p>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="col-md-12">
            <table id="table-search" class="table coqueirosb table-responsive table-bordered table-striped table-hover w-auto" align="center">
                <thead class="font-weight-bold">
                    <tr class="table-warning">
                        <th class="tb-gen tb-c25">Nombre Comercial</th>
                        <th class="tb-gen tb-c25">Direccion</th>
                        <th class="tb-gen tb-c5">Phone</th>
                        <th class="tb-gen tb-c5">Mobile</th>
                        <th class="tb-gen tb-c10">Email</th>
                        <th class="tb-gen tb-c5">RUC/Ced</th>
                        <th class="tb-gen tb-c3">Nuevo Pedido</th>
                        <th class="tb-gen tb-c2">Consulta Pedidos</th>
                    </tr>
                </thead>
                <tbody>
                    {% if page.items is defined %}
                        {% for customer in page.items %}
                            <tr>
                                <td>{{ customer.getCompanyname() }}</td>
                                <td>{{ customer.getBilladdressAddr1() ~ ' ' ~ customer.getBilladdressCity() ~ ' ' ~ customer.getBilladdressState() ~ ' ' ~ customer.getBilladdressPostalcode() ~ customer.getBilladdressCountry() }}</td>
                                <td>{{ customer.getPhone() }}</td>
                                <td>{{ customer.getMobile() }}</td>
                                <td>{{ customer.getEmail() }}</td>
                                <td>{{ customer.getAccountnumber() }}</td>
                                <td style="text-align:center;">{{ link_to("ventas/index/"~customer.getListid(), '<i class="fa fa-plus-square-o" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
                                <td style="text-align:center;">{{ link_to("pedidos/searchventas/"~customer.getListid(), '<i class="fa fa-list" aria-hidden="true" style="font-size:24px;color:green;"></i>') }}</td>
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
