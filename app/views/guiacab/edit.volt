{% extends "layouts/fullscreen.volt" %}
{% block forma %}
    {{ content() }}
{% endblock %}
{% block cabecera %}
    <div class="bg-blue">
        {{ form("guiacab/save", "class" : "sky-form", "id":"solid-form") }}
    {% endblock %}
    {% block cuerpoforma %}
        <fieldset>
            <section>
                <div class="row">
                    <div class="col col-3">
                        <div class="form-group">
                            <label class="label" for="refNumber">  Numero de la guia</label>
                            <div class="input">
                                {{ form.render('refNumber', ['class': 'form-element form-element-icon','id':'refNumber', 'name':'refNumber', 'placeholder':'111-111-111111111' ]) }}
                            </div>
                        </div>
                    </div>
                    <div class="col col-3">
                        <div class="form-group">
                            <label class="label" for="txnDate">  Fecha Emision</label>
                            <div class="input">
                                {{ form.render('txnDate', ['class': 'form-element form-element-icon','id':'txnDate', 'name':'txnDate', 'placeholder':'dd-mm-aaaa' ]) }}
                            </div>
                        </div>
                    </div>
                    <div class="col col-3">
                        <div class="form-group">
                            <label class="label" for="dateBegin">  Fecha que se inicia el transporte</label>
                            <div class="input">
                                {{ form.render('dateBegin', ['class': 'form-element form-element-icon','id':'dateBegin', 'name':'dateBegin', 'placeholder':' Fecha que se inicia el transporte' ]) }}
                            </div>
                        </div>
                    </div>
                    <div class="col col-3">
                        <div class="form-group">
                            <label class="label" for="dateEnd">  Fecha fin del transporte</label>
                            <div class="input">
                                {{ form.render('dateEnd', ['class': 'form-element form-element-icon','id':'dateEnd', 'name':'dateEnd', 'placeholder':' Fecha fin del transporte' ]) }}
                            </div>
                        </div>
                    </div>                            

                </div>
            </section>
        </fieldset>
        <fieldset>
            <section>
                <div class="row">
                    <div class="col col-4">
                        <div class="form-group">
                            <label class="label" for="origenId">Bodega Origen</label>
                            <div class="input">
                                {{ form.render('origenId', ['class': 'form-element form-element-icon','id':'origenId', 'name':'origenId', 'placeholder':'Bodega' ]) }}
                            </div>
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="form-group">
                            <label class="label" for="destinoId">Bodega Destino</label>
                            <div class="input">
                                {{ form.render('destinoId', ['class': 'form-element form-element-icon','id':'destinoId', 'name':'destinoId', 'placeholder':' ListID de la bodega destino' ]) }}
                            </div>
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="form-group">
                            <label class="label" for="driverId">Chofer</label>
                            <div class="input">
                                {{ form.render('driverId', ['class': 'form-element form-element-icon','id':'driverId', 'name':'driverId', 'placeholder':' ListID del chofer' ]) }}
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </fieldset> 
        <fieldset>
            <section>
                <div class="row">
                    <div class="col col-4">
                        <div class="form-group">
                            <label class="label" for="routeId">Ruta</label>
                            <div class="input">
                                {{ form.render('routeId', ['class': 'form-element form-element-icon','id':'routeId', 'name':'routeId', 'placeholder':'Ruta' ]) }}
                            </div>
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="form-group">
                            <label class="label" for="vehicleId">Transporte</label>
                            <div class="input">
                                {{ form.render('vehicleId', ['class': 'form-element form-element-icon','id':'vehicleId', 'name':'vehicleId', 'placeholder':'Vehiculo' ]) }}
                            </div>
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="form-group">
                            <label class="label" for="motive">Adicionales</label>
                            <div class="input textarea-expandable">
                                {{ form.render('motive', ['class': 'form-element form-element-icon','id':'motive', 'name':'motive', 'placeholder':'Digitar al menos n/a' ]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </fieldset>
        <footer>
            <div class="row">
                <div class="col col-12">
                    <h5 class="titulopie"> ENVIAR ESTA INFORMACION </h5>
                    <p>Al presionar el boton de GUARDAR, certifico que la informacion ingresada del cliente ha sido comprobado de acuerdo con los requisitos del SRI. </p><br>
                    <p> En consideracion el cliente esta de acuerdo en que la informacion proporcionada sera utilizada para efectos de ventas y reporte al SRI. </p><br>
                </div>
            </div>

            <div class="row">
                <div class="col col-12"> 
                    <div class="form-group">
                        {{ submit_button("GUARDAR", "class": "btn btn-success btn-flat", "id":"submit", "name":"submit" ) }}
                    </div>
                </div>
            </div>
        </footer>
    </form>
</div>

{% endblock %}