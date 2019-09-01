{{ content() }}
{{ elements.getModelosAdicional() }}
{% include "layouts/cabecera.volt" %}
<div class="solid-form" style="background-color: #C1C1C1">

    <div class="l-container w-100" id="solid-formve-container">

        <div class="l-row">
            <div class="l-col-6">
                <div class="form-body pad-0">        
                    {{ form('guiacab/masproductos/' ~ guiacab.refNumber, 'id':'consumo')}}
                    <fieldset>
                        <legend> Productos </legend>
                        <div class="l-row">
                            <div class="l-col-7">

                                <div class="form-group">

                                    <label for="ItemRefListID"> PRODUCTO : </label>

                                    <div class="l-pos-r">
                                        {{ form.render('ItemRefListID', ['class': 'form-element form-element-icon','id':'ItemRefListID', 'name':'ItemRefListID', 'placeholder':'Seleccione' ]) }}
                                        <i class="fa fa-product-hunt fa-absolute fa-background"></i>
                                    </div>

                                </div>

                            </div>
                            <div class="l-col-3">

                                <div class="form-group">

                                    <label for="qty"> CANTIDAD : </label>

                                    <div class="l-pos-r">
                                        {{ form.render('qty', ['class': 'form-element form-element-icon','id':'qty', 'name':'qty', 'placeholder':'0' ]) }}
                                        <i class="fa fa-clone fa-absolute fa-background"></i>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="l-row">
                            <div class="l-col-7">

                                <div class="form-group">

                                    <label for="numeroLote"> LOTES : </label>

                                    <div class="l-pos-r">
                                        {{ form.render('numeroLote', ['class': 'form-element form-element-icon','id':'numeroLote', 'name':'numeroLote', 'placeholder':'Seleccione' ]) }}
                                        <i class="fa fa-product-hunt fa-absolute fa-background"></i>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="l-row">
                            <div class="l-col-12">
                                <div class="form-group">
                                    {{ submit_button('Aumentar Producto', 'class': 'btn btn-default') }}
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    </form>
                </div>
            </div> <!-- end col -->    
            <div class="l-col-6">
                <div class="form-body pad-0">
                    {{ form('guiacab/aprobar/' ~ guiacab.refNumber, 'id':'cliente')}}
                    <fieldset>
                        <legend> PRODUCTOS EN GUIA </legend>

                        <div class="l-row">
                            <div class="l-col-12">
                                <table class="table table-responsive table-bordered table-striped table-hover" align="center">
                                    <thead>
                                    <th class="tb-gen tb-c20" style="font-size:120%; color:#686868; text-align:center;">Producto</th>
                                    <th class="tb-gen tb-c5" style="font-size:120%; color:#686868; text-align:center;">Qty</th>
                                    <th class="tb-gen tb-c15" style="font-size:120%; color:#686868; text-align:center;">Lote</th>
                                    <th class="tb-gen tb-c5" style="font-size:120%; color:#686868; text-align:center;">Eliminar</th>
                                    </thead>
                                    <tbody>
                                        {% for trx in guiatrx %}
                                            <tr>
                                                <td> {{ trx.ItemRefFullName}} </td>
                                                <td> {{ trx.qty}} </td>
                                                <td> {{ trx.numeroLote}} </td>
                                                <td> {{ link_to('guiacab/delproducto/' ~ trx.gettxnID() ~ '/'~ guiacab.refNumber, 'X') }} </td>
                                            </tr>
                                        {% endfor %}
                                    <tbody>
                                </table>

                            </div>
                        </div>


                    </fieldset>
                    <footer>
                        <div class="row">
                            <div class="form-group">
                                {{ link_to("guiacab/aprobar/" ~ guiacab.refNumber, 'Aprobar Guia', "class": "btn btn-primary") }}
                            </div>
                        </div>
                    </footer>
                    </form>

                </div>

            </div> <!-- end col -->

        </div> <!-- end row -->

        <div class="l-row">

            <div class="l-col-12">
                <div class="form-body pad-0">
                    {{ form("guiacab/index") }}
                    <fieldset>
                        <legend> FACTURA </legend>
                        <section>
                            <div class="l-row">
                                <div class="l-col-3">
                                    <h4> {{ ruc['NombreComercial']}} </h4>
                                    <h5> {{ ruc['ruc'] }} </h5>
                                    <h5>Establecimiento {{ ruc['estab'] }} Punto de Emision {{ ruc['punto'] }} </h5>
                                </div>
                                <div class="l-col-3">
                                    <div class="form-group">
                                        <label for="refNumber">  NUMERO DE GUIA :</label>
                                        <div class="l-pos-r">
                                            {{ guiacab.refNumber }}
                                        </div>
                                        <br>
                                        <label for="txnDate">  FECHA EMISION : </label>
                                        <div class="l-pos-r">
                                            {{ guiacab.txnDate }}
                                        </div>
                                        <br>
                                        <label for="dateBegin">  FECHA INICIO RUTA :</label>
                                        <div class="l-pos-r">
                                            {{ guiacab.dateBegin }}
                                        </div>
                                    </div>
                                </div>
                                <div class="l-col-3">
                                    <div class="form-group">
                                        <label for="dateEnd">  FECHA FIN RUTA :</label>
                                        <div class="l-pos-r">{{ guiacab.dateEnd }}
                                        </div>
                                        <br>
                                        <label for="origenId">  BODEGA ORIGEN :  </label>
                                        <div class="l-pos-r">{{ guiacab.origenName }} 
                                        </div>
                                        <br>
                                        <label for="destinoId">  BODEGA DESTINO: </label>
                                        <div class="l-pos-r">{{ guiacab.destinoName }} 
                                        </div>
                                        <br>
                                    </div>
                                </div>
                                <div class="l-col-3">
                                    <div class="form-group">
                                        <label for="driverId">  CHOFER : </label>
                                        <div class="l-pos-r">{{ guiacab.driverName }} 
                                        </div>
                                        <br>
                                        <label for="routeId">  RUTA : </label>
                                        <div class="l-pos-r">{{ guiacab.routeName }} 
                                        </div>
                                        <br>
                                        <label for="vehicleId">  TRANSPORTE : </label>
                                        <div class="l-pos-r">{{ guiacab.vehicleName }} 
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="l-row">
                                <div class="l-col-3">
                                </div>
                                <div class="l-col-9">
                                    <div class="form-group">
                                        <label for="motive"> ADICIONALES : </label>
                                        <div class="l-pos-r">{{ guiacab.motive }} 
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>        
                        </section>
                    </fieldset>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>            


