{{ content() }}
{{ elements.getModelosAdicional() }}
{% include "layouts/cabecera.volt" %}
<div class="solid-form">

    <div class="l-container w-70">

        <div class="l-row">

            <div class="l-col-12">
                <div class="form-body pad-0">
                    {{ form('creditmemo/firmar/' ~ paraforma['numeronotacr'], 'method': 'post') }}
                    <fieldset>
                        <legend> Productos </legend>

                        <div class="l-row">
                            <div class="l-col-12">
                                <table class="table coqueirosy table-responsive table-bordered table-striped table-hover" align="center">
                                    <thead>
                                            <tr class="table-active">
                                                <th style="font-size:120%; color:#686868; text-align:center; width:50%;">Producto</th>
                                                <th style="font-size:120%; color:#686868; text-align:center;">QtyCR</th>
                                                <th style="font-size:120%; color:#686868; text-align:center;">PrecioCR</th>
                                                <th style="font-size:120%; color:#686868; text-align:center;">TotalCR</th>
                                                <th style="font-size:120%; color:#686868; text-align:center;">Qty</th>
                                                <th style="font-size:120%; color:#686868; text-align:center;">Uni</th>
                                                <th style="font-size:120%; color:#686868; text-align:center;">Total</th>

                                            </tr>

                                    </thead>
                                    <tbody>
                                        {% set l = 1 %}
                                        {% set subtotal = 0 %}
                                        {% set iva = 0 %}
                                        {% set total = 0 %}
                                        {% set subtotalCR = 0 %}
                                        {% set ivaCR = 0 %}
                                        {% set totalCR = 0 %}
                                        {% set productos = paraforma['items'] %}
                                        {% for lineas in productos %}
                                            {% set campo1 = 'cantidad' ~ l %}
                                            {% set campo2 = 'preciounitario' ~ l %}
                                            {% set campo3 = 'preciototal' ~ l %}
                                                <tr>
                                                    <td> {{ lineas['ItemRefFullName'] }} </td>
                                                        <td> {{ lineas[campo1] }} </td>
                                                        <td> {{ lineas[campo2] }} </td>
                                                        <td> {{ lineas[campo3] }} </td>
                                                        <td> {{ lineas['Rate']  | number_format(2, ',', '.') }} </td>
                                                        <td> {{ lineas['Quantity'] }} </td>
                                                    {% set lineastot = lineas['Rate'] * lineas['Quantity'] %}
                                                    <td> {{  lineastot | number_format(2, ',', '.') }} </td>
                                                </tr>

                                                {% set subtotalCR = subtotalCR + lineas[campo3] %}
                                                {% set ivaCR = ivaCR + (12/100 * lineas[campo3]) %}
                                                {% set totalCR = subtotalCR + ivaCR %}
                                                {% set subtotal = subtotal + (lineas['Quantity'] * lineas['Rate'] ) %}
                                                {% set iva = iva + (12/100 * lineas['Quantity'] * lineas['Rate']) %}
                                                {% set total = subtotal + iva %}

                                            {% set l = l + 1 %}
                                        {% endfor %}     
                                            <tr>
                                                <td colspan="3">Subtotal</td>
                                                <td> {{ subtotalCR | number_format(2, '.', '.') }} </td>
                                                <td colspan="3"> {{ subtotal | number_format(2, '.', '.') }} </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">IVA</td>
                                                <td> {{ ivaCR  | number_format(2, ',', '.') }} </td>
                                                <td colspan="3"> {{ iva  | number_format(2, ',', '.') }} </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">A Pagar</td>
                                                <td> {{ totalCR  | number_format(2, ',', '.') }} </td>
                                                <td colspan="3"> {{ total  | number_format(2, ',', '.') }} </td>
                                            </tr>
                                            <tr></tr>

                                    <tbody>
                                </table>
                                    {{ submit_button('Autorizar', 'class': 'btn btn-success btn-flat') }}
                            </div>
                        </div>


                    </fieldset>

                    </form>

                </div>

            </div> <!-- end col -->
            {{ elements.getCreditoErrors() }}
        </div> <!-- end row -->

        <div class="l-row">

            <div class="l-col-12">
                <div class="form-body pad-0">
                    {{ form("creditodb/index") }}
                    <fieldset>
                        <legend> NOTA DE CREDITO </legend>
                        <section>
                            <div class="l-row">
                                <div class="l-col-3">
                                    <h4> {{ ruc['NombreComercial']}} </h4>
                                    <h5> {{ ruc['ruc'] }} </h5>
                                    <h5>Establecimiento {{ ruc['estab'] }} Punto de Emision {{ ruc['punto'] }} </h5>
                                </div>
                                <div class="l-col-2">
                                    <div class="form-group">
                                        <label for="creditNumber">  Numero de la nota de credito </label>
                                        <div class="l-pos-r">
                                            {{ paraforma['numeronotacr'] }}
                                        </div>
                                        <br>
                                        <label for="fnumero">  Numero de la Factura</label>
                                        <div class="l-pos-r">
                                            {{ paraforma['numerofactura'] }}
                                        </div>
                                        <br>
                                        <label for="gnumero">  Numero Transaccion </label>
                                        <div class="l-pos-r">
                                            {{ paraforma['txnnumber'] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="l-col-2">
                                    <div class="form-group">
                                        <label for="txnDate">  Fecha Emision</label>
                                        <div class="l-pos-r">{{ paraforma['fechanotacr'] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="l-col-5">
                                    <div class="form-group">
                                        <label for="referencia">  Referencia </label>
                                        <div class="l-pos-r">{{ paraforma['referencia'] }}
                                        </div>
                                        <br>
                                        <label for="notascomprador">  Notas al Comprador </label>
                                        <div class="l-pos-r">{{ paraforma['notas'] }}
                                        </div>
                                        <br>
                                        <label for="condiciones">  Terminos y Condiciones </label>
                                        <div class="l-pos-r">{{ paraforma['condiciones'] }}
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
