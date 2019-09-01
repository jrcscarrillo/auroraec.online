{{ content() }}
{{ elements.getModelosAdicional() }}
{% include "layouts/cabecera.volt" %}
<div style="background-color: #C1C1C1">

    <div class="solid-form l-container w-100" id="solid-form-container">

        <div class="l-row">
            <div class="l-col-6">
                <div class="form-body pad-0">        
                    {{ form( 'id':'consumo')}}
                    <fieldset>
                        <legend> Clientes </legend>
                        <div class="l-row">
                            <div class="l-col-12">

                                <div class="form-group">

                                    <label for="CustomerRefListID"> Cliente </label>

                                    <div class="l-pos-r">
                                        {{ form.render('CustomerRefListID', ['class': 'form-element form-element-icon','id':'CustomerRefListID', 'name':'CustomerRefListID', 'placeholder':'Seleccione' ]) }}
                                        <i class="fa fa-product-hunt fa-absolute fa-background"></i>
                                    </div>
                                        {{ form.messages('CustomerRefListID') }}
                                </div>

                            </div>
                        </div>
                        <div class="l-row">
                            <div class="l-col-3">

                                <div class="form-group">

                                    <label for="TxnDate"> Fecha Emision </label>

                                    <div class="l-pos-r">
                                        {{ form.render('TxnDate', ['class': 'form-element form-element-icon','id':'TxnDate', 'name':'TxnDate' ]) }}
                                        <i class="fa fa-clone fa-absolute fa-background"></i>
                                    </div>
                                        {{ form.messages('TxnDate') }}
                                </div>

                            </div>

                        </div>

                        <div class="l-row">
                            <div class="l-col-12">
                                <div class="form-group">
                                    {{ submit_button('Generar Venta', 'class': 'btn btn-default') }}
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    </form>
                </div>
            </div> <!-- end col -->    
            <div class="l-col-6">

                <div class="form-body pad-0">
                    {{ form() }}
                    <fieldset>
                        <legend> ULTIMA FACTURA </legend>
                        {% if hayonohay === "SI" %}
                            <section>
                                <div class="l-row">
                                    <div class="l-col-6">
                                        <div class="form-group">
                                            <label>  Cliente </label>
                                            <div class="cuadro-gen cuadro-c20 l-pos-r">
                                                {{ invoice.getCustomerRefFullName() }}
                                            </div>
                                            <br>
                                            <label>  Numero de la Factura</label>
                                            <div class="cuadro-gen cuadro-c20 l-pos-r">
                                                {{ invoice.getTxnID() }}
                                            </div>
                                            <br>
                                            <label>  Fecha de Emision </label>
                                            <div class="cuadro-gen cuadro-c20 l-pos-r">
                                                {% set fecha = date('F j, Y', strtotime(invoice.getTxnDate())) %} 
                                                {{ fecha }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="l-col-6">
                                        <div class="form-group">
                                            <label>  Sub Total</label>
                                            <div class="cuadro-gen cuadro-c20 l-pos-r">{{ invoice.getSubtotal() | number_format(2, ',', '.')  }}
                                            </div>
                                            <br>
                                            <label>  IVA </label>
                                            <div class="cuadro-gen cuadro-c20 l-pos-r">{{ invoice.getSalesTaxTotal() | number_format(2, ',', '.') }}
                                            </div>
                                            <br>
                                            <label>  Total </label>
                                            <div class="cuadro-gen cuadro-c20 l-pos-r"> {{ invoice.getAppliedAmount() | number_format(2, ',', '.') }}
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="l-row">
                                    <div class="l-col-12">
                                        <div class="form-group">
                                            <label for="referencia">  Referencia </label>
                                            <div class="cuadro-gen cuadro-c40 l-pos-r">{{ invoice.getMemo() }}
                                            </div>
                                            <br>
                                            <label for="notascomprador">  Notas al Comprador </label>
                                            <div class="cuadro-gen cuadro-c40 l-pos-r">{{ invoice.getCustomField2() }}
                                            </div>
                                            <br>
                                            <label for="condiciones">  Terminos y Condiciones </label>
                                            <div class="cuadro-gen cuadro-c40 l-pos-r">{{ invoice.getCustomField3() }}
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>        
                            </section>
                            <section>
                                <div class="l-row">
                                    <div class="l-col-12">
                                        <div class="form-group">
                                            <br>
                                            <label for="fehaautorizacion">  Fecha de Autorizacion </label>
                                            <div class="cuadro-gen cuadro-c20">{{ invoice.getCustomField13() }}
                                            </div>
                                            <br>
                                            <label for="numeroautorizacion">  Numero Autorizacion </label>
                                            <div class="cuadro-gen cuadro-c20">{{ invoice.getCustomField14() }}
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>  
                            </section>
                        {% endif %}
                    </fieldset>
                    </form>


                </div>


            </div>                                    
            {% include "layouts/pie_1.volt" %}
        </div>
    </div>
    {% include "layouts/footer.volt" %}

</div>            
