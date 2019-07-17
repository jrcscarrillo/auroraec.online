{% extends "layouts/fullscreen_1.volt" %}
{% block forma %}
{% endblock %}
{% block cabecera %}

    <div class="l-container w-50" id="solid-form-container" style="border-radius: 0; margin-top: 120px;">
        <div class="l-row">
            <div class="form-body">        
                {{ form('ventas/aprobarcaja/' ~ caja.RefNumber ~ '/' ~ '1', 'id':'cashier')}}
                <fieldset>
                    <legend> Abrir la Caja </legend>
                    <div class="l-row">
                        <div class="l-col-3">
                            <div class="form-group">
                                <label for="fecha"> Fecha</label> 
                                <div class="l-pos-r">
                                    {{ caja.TxnDate }}
                                </div>                                                
                            </div>
                        </div>
                        <div class="l-col-3">
                            <div class="form-group">
                                <label for="recibo"> Referencia </label> 
                                <div class="l-pos-r">
                                    {{ caja.RefNumber }}
                                </div>                                                
                            </div>
                        </div>
                        <div class="l-col-6">
                            <div class="form-group">
                                <label for="cajero"> Responsable </label> 
                                <div class="l-pos-r">
                                    {{ caja.EmployeeRefFullName }}
                                </div>                                                
                            </div>
                        </div>
                    </div>
                    <div class="l-row">
                        <div class="l-col-3">
                            <div class="form-group">
                                <label for="Efectivo"> Efectivo </label> 
                                <div class="l-pos-r">
                                    <input name="Efectivo" id="Efectivo" type="number" step="any" />
                                </div>                                                
                            </div>
                        </div>
                        <div class="l-col-1">
                        </div>
                        <div class="l-col-3">
                            <div class="form-group">
                                <label for="Cheques"> Cheques </label> 
                                <div class="l-pos-r">
                                    <input name="Cheques" id="Cheques" type="number" step="any" />
                                </div>                                                
                            </div>
                        </div>
                        <div class="l-col-1">
                        </div>
                        <div class="l-col-3">
                            <div class="form-group">
                                <label for="Depositos"> Depositos </label> 
                                <div class="l-pos-r">
                                    <input name="Depositos" id="Depositos" type="number" step="any" />
                                </div>                                                
                            </div>
                        </div>
                    </div>
                    <div class="l-row">
                        <div class="l-col-6">
                            <div class="form-group">
                                <label for="CierreAuditor"> Quien Entrega </label> 
                                <div class="l-pos-r">
                                    {{ form.render('CierreAuditor')  }}
                                </div>                                                
                            </div>
                        </div>
                        <div class="l-col-6">
                            <div class="form-group">
                                <label for="CierreNotas"> Notas </label> 
                                <div class="l-pos-r">
                                    {{ form.render('CierreNotas')  }}
                                </div>                                                
                            </div>
                        </div>
                    </div>
                    <div class="l-row">
                        <div class="l-col-12">
                            <div class="form-group">
                                {{ submit_button('Aceptar', 'class': 'btn btn-default') }}
                            {{ link_to("#" , 'Atras', "class": "btn btn-default") }}
                            </div>
                        </div>
                    </div>
                </fieldset>

            </div>

        </div>

    </div>

{% endblock %}
{% block cuerpoforma %}                            
{% endblock %}
