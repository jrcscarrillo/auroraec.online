{{ elements.getModelosAdicional() }}
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="bg-blue">
                {{ form("", "class" : "sky-form") }}
                <fieldset>
                    <header> Guia Remision </header>
                    <section>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="label_g" for="refNumber">  Numero de la guia</label>
                                    <div class="centro">
                                        {{ guiacab.refNumber }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="label_g" for="txnDate">  Fecha Emision</label>
                                    <div class="centro">{{ guiacab.txnDate }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="label_g" for="dateBegin">Inicia Transporte</label>
                                    <div class="centro"> {{ guiacab.dateBegin }} </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="label_g" for="dateEnd">Fin Transporte</label>
                                    <div class="centro"> {{ guiacab.dateEnd }} </div>
                                </div>
                            </div>                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="label_g" for="origenId">Bodega Origen</label>
                                    <div> {{ guiacab.origenName }} 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="label_g" for="destinoId">Bodega Destino</label>
                                    <div> {{ guiacab.destinoName }} </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="label_g" for="driverId">Chofer</label>
                                    <div> {{ guiacab.driverName }} </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="label_g" for="routeId">Ruta</label>
                                    <div> {{ guiacab.routeName }} </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="label_g" for="vehicleId">Placa</label>
                                    <div> {{ guiacab.vehicleName }} </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label_g" for="motive">Adicionales</label>
                                    <div> {{ guiacab.motive }} </div>
                                </div>
                            </div>

                        </div>        
                    </section>
                </fieldset>
                </form>
            </div>
        </div>
    </div>
                                <br>
    <div class="row">
        <div class="col-md-6">
            <div class="bg-blue">
                {{ form("guiacab/masproductos/" ~ guiacab.refNumber, "class" : "sky-form") }}
                <fieldset>
                    <header> Guia Producto </header>
                    <section>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="label" for="ItemRefListID">Producto</label>
                                    <div class="input">
                                        {{ form.render('ItemRefListID', ['class': 'form-element','id':'ItemRefListID', 'name':'ItemRefListID', 'placeholder':'Seleccione' ]) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                                    <br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="label" for="qty">Cantidad</label>
                                    <div class="input">
                                        {{ form.render('qty', ['class': 'form-element form-element-icon','id':'qty', 'name':'qty', 'placeholder':'0' ]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="label" for="numeroLote">Lotes</label>
                                    <div class="input">
                                        {{ form.render('numeroLote', ['class': 'form-element form-element-icon','id':'numeroLote', 'name':'numeroLote', 'placeholder':'Separados por ;' ]) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </fieldset>
                <footer>

                    <div class="row">
                        <div class="col-12"> 
                            <div class="form-group">
                                {{ submit_button("Aumentar Producto", "class": "btn btn-primary mb-2", "id":"submit", "name":"submit" ) }}
                            </div>
                        </div>
                    </div>
                </footer>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="bg-blue">

                {{ form("guiacab/aprobar/" ~ guiacab.refNumber, "class" : "sky-form") }}
                <fieldset>
                    <header> Guia Detalle </header>
                    <div class="l-row">
                        <table class="table table-bordered table-striped" align="center">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Qty</th>
                                    <th>Lote</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                {% for trx in guiatrx %}
                                    <tr>
                                        <td> {{ trx.ItemRefFullName}} </td>
                                        <td> {{ trx.qty}} </td>
                                        <td> {{ trx.numeroLote}} </td>
                                        <td width="2%"> {{ link_to('guiacab/delproducto/' ~ trx.gettxnID() ~ '/'~ guiacab.refNumber, 'X') }} </td>
                                    </tr>
                                {% endfor %}
                            </tbody>
                        </table>


                    </div>


                </fieldset>
                <footer>
                    <div class="row">
                        <div class="form-group">
                            {{ submit_button("Aprobar Guia", "class": "btn btn-primary mb-2", "id":"submit", "name":"submit" ) }}
                        </div>
                    </div>
                </footer>
                </form>

            </div>                    
        </div>
    </div>
</div>

