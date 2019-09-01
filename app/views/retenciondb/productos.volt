{{ content() }}
{{ elements.getModelosAdicional() }}
{% include "layouts/cabecera.volt" %}
<div class="wrapper solid-form">

    <div class="l-container w-100" id="solid-formve-container">

        <div class="l-row">
            <div class="l-col-6">
                <div class="form-body pad-0">        
                    {{ form('retenciondb/masproductos/' ~ retencion.TxnID, 'id':'consumo')}}
                    <fieldset>
                        <legend> Productos </legend>
                        <div class="l-row">
                            <div class="l-col-7">

                                <div class="form-group">

                                    <label for="ItemRefListID"> Producto </label>

                                    <div class="l-pos-r">
                                        {{ form.render('ItemRefListID', ['class': 'form-element form-element-icon','id':'ItemRefListID', 'name':'ItemRefListID', 'placeholder':'Seleccione' ]) }}
                                        <i class="fa fa-product-hunt fa-absolute fa-background"></i>
                                    </div>

                                </div>

                            </div>
                            <div class="l-col-3">

                                <div class="form-group">

                                    <label for="base"> Base Imponible </label>

                                    <div class="l-pos-r">
                                        {{ form.render('base', ['class': 'form-element form-element-icon','id':'base', 'name':'base', 'placeholder':'0' ]) }}
                                        <i class="fa fa-clone fa-absolute fa-background"></i>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="l-row">
                            <div class="l-col-12">
                                <div class="form-group">
                                    {{ submit_button('Aumentar Retencion', 'class': 'btn btn-default') }}
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    </form>
                </div>
            </div> <!-- end col -->    
            <div class="l-col-6">
                <div class="form-body pad-0">
                    {{ form('retenciondb/cliente/' ~ retencion.RefNumber, 'id':'cliente')}}
                    <fieldset>
                        <legend> Caja </legend>

                        <div class="l-row">
                            <div class="l-col-12">
                                <table class="table table-responsive table-bordered table-striped table-hover" align="center">
                                    <thead>
                                            <tr class="table-active">
                                                <th class="tb-gen tb-c15"  style="font-size:120%; color:#686868; text-align:center;">Producto</th>
                                                <th class="tb-gen tb-c15"  style="font-size:120%; color:#686868; text-align:center;">Base</th>
                                                <th class="tb-gen tb-c3"  style="font-size:120%; color:#686868; text-align:center;">%</th>
                                                <th class="tb-gen tb-c5"  style="font-size:120%; color:#686868; text-align:center;">Retenido</th>
                                                <th class="tb-gen tb-c5"  style="font-size:120%; color:#686868; text-align:center;">Eliminar</th>
                                                <th class="tb-gen tb-c2"></th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        {% set subtotal = 0 %}
                                        {% set total = 0 %}
                                        {% for lineas in retencionline %}

                                                <tr>
                                                    <td> {{ lineas.ItemRefFullName }} </td>
                                                    <td> {{ lineas.Quantity | number_format(2, ',', '.') }} </td>
                                                    <td> {{ lineas.Cost  | number_format(2, ',', '.') }} </td>
                                                    {% set calculado = lineas.Cost * lineas.Quantity / 100 %}
                                                    <td> {{ calculado  | number_format(2, ',', '.') }} </td>
                                                    <td> {{ link_to('retenciondb/delproducto/'~lineas.TxnLineID, '<i class="fa fa-times" aria-hidden="true"></i>') }} </td>
                                                    <td></td>
                                                </tr>

                                                {% set subtotal = subtotal + lineas.Quantity %}
                                                {% set total = total + calculado %}

                                        {% endfor %}     

                                            <tr>
                                                <td colspan="3">Total Base Imponible</td>
                                                <td> {{ subtotal | number_format(2, '.', '.') }} </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">Valor Retenido</td>
                                                <td> {{ total  | number_format(2, ',', '.') }} </td>
                                            </tr>
                                            <tr></tr>

                                    <tbody>
                                </table>
                                {{ link_to("retenciondb/facturar/" ~ retencion.RefNumber, 'Procesar', "class": "btn btn-success") }}

                            </div>
                        </div>


                    </fieldset>

                    </form>

                </div>

            </div> <!-- end col -->

        </div> <!-- end row -->

        <div class="l-row">

            <div class="l-col-12">
                <div class="form-body pad-0">
                    {{ form("ventasdb/index") }}
                    <fieldset>
                        <legend> RETENCION </legend>
                        <section>
                            <div class="l-row">
                                <div class="l-col-3">
                                    <h4> {{ ruc['NombreComercial']}} </h4>
                                    <h5> {{ ruc['ruc'] }} </h5>
                                    <h5>Establecimiento {{ ruc['estab'] }} Punto de Emision {{ ruc['punto'] }} </h5>
                                </div>
                                <div class="l-col-2">
                                    <div class="form-group">
                                        <label for="refNumber">  Numero de la retencion </label>
                                        <div class="l-pos-r">
                                            {{ retencion.RefNumber }}
                                        </div>
                                        <br>
                                        <label for="fnumero">  Numero de la Factura</label>
                                        <div class="l-pos-r">
                                            {{ retencion.CustomField4 }}
                                        </div>
                                        <br>
                                    </div>
                                </div>
                                <div class="l-col-2">
                                    <div class="form-group">
                                        <label for="txnDate">  Fecha Emision</label>
                                        <div class="l-pos-r">{{ retencion.TxnDate }}
                                        </div>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                                <div class="l-col-5">
                                    <div class="form-group">
                                        <label for="referencia">  Referencia </label>
                                        <div class="l-pos-r">{{ retencion.Memo}}
                                        </div>
                                        <br>
                                        <label for="notasproveedor">  Notas al Proveedor </label>
                                        <div class="l-pos-r">{{ retencion.CustomField2 }}
                                        </div>
                                        <br>
                                        <label for="condiciones">  Terminos y Condiciones </label>
                                        <div class="l-pos-r">{{ retencion.CustomField3 }}
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
