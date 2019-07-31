{{ content() }}
{{ elements.getModelosAdicional() }}
{% include "layouts/cabecera.volt" %}
<div class="solid-form">
    <div class="solid-form l-container w-70" id="solid-form-container">


        <div class="l-row">

            <div class="l-col-12 pad-0">

                <div class="form-header">
                    <div class="l-row">
                        <div class="l-col-6">
                            <br>
                            <h4> {{ ruc['NombreComercial']}} </h4>
                            <h5> {{ ruc['ruc'] }} </h5>
                            <h5>Establecimiento {{ ruc['estab'] }} Punto de Emision {{ ruc['punto'] }} </h5>
                        </div>
                        <div class="l-col-6">
                            <h1 class="margin-bottom-0"> GUIA DE REMISION </h1>
                            <h5> Configuracion de las guias de remision </h5>
                        </div>
                    </div>
                </div>

                <div class="form-body pad-0">
                    {{ form("guiacab/create",  "id":"cabecera") }}
                    <fieldset>
                        <section>
                            <div class="l-row">
                                <div class="l-col-3">

                                    <div class="form-group">

                                        <label for="refNumber"> NUMERO DE LA GUIA: </label>

                                        <div class="l-pos-r">
                                            {{ form.render("refNumber", ['class': 'form-element form-element-icon', 'id':'refNumber', 'name':'refNumber', 'placeholder':'111-111-111111111' ]) }}
                                            <i class="fa fa-calendar fa-absolute fa-background"></i>
                                        </div>
                                        {{ form.messages('refNumber') }}

                                    </div>

                                </div>   
                                <div class="l-col-3">

                                    <div class="form-group">

                                        <label for="txnDate"> FECHA EMISION </label>

                                        <div class="l-pos-r">
                                            {{ form.render("txnDate", ['class': 'form-element form-element-icon', 'id':'txnDate', 'name':'txnDate', 'placeholder':'dd-mm-aaaa' ]) }}
                                            <i class="fa fa-calendar fa-absolute fa-background"></i>
                                        </div>
                                        {{ form.messages('txnDate') }}

                                    </div>

                                </div>                                    
                                <div class="l-col-3">

                                    <div class="form-group">

                                        <label for="dateBegin"> FECHA INICIO RUTA :</label>

                                        <div class="l-pos-r">
                                            {{ form.render("dateBegin", ['class': 'form-element form-element-icon', 'id':'dateBegin', 'name':'dateBegin', 'placeholder':'dd-mm-aaaa' ]) }}
                                            <i class="fa fa-calendar fa-absolute fa-background"></i>
                                        </div>
                                        {{ form.messages('dateBegin') }}

                                    </div>

                                </div>                                    
                                <div class="l-col-3">

                                    <div class="form-group">

                                        <label for="dateEnd"> FECHA FIN RUTA : </label>

                                        <div class="l-pos-r">
                                            {{ form.render("dateEnd", ['class': 'form-element form-element-icon', 'id':'dateEnd', 'name':'dateEnd', 'placeholder':'dd-mm-aaaa' ]) }}
                                            <i class="fa fa-calendar fa-absolute fa-background"></i>
                                        </div>
                                        {{ form.messages('dateEnd') }}

                                    </div>

                                </div>                                    
                            </div>                                    
                        </section>
                    </fieldset>
                    <fieldset>
                        <section>
                            <div class="l-row">
                                <div class="l-col-4">

                                    <div class="form-group form-group-select" data-icon="&#xf078">

                                        <label for="origenId"> BODEGA ORIGEN : </label>

                                        <div class="l-pos-r">

                                            {{ form.render('origenId', ['class': 'form-element form-element-icon multi-select']) }}
                                            <i class="fa fa-file-text-o fa-absolute fa-background"></i>
                                        </div>
                                        {{ form.messages('origenId') }}

                                    </div>

                                </div>                                
                                <div class="l-col-4">

                                    <div class="form-group form-group-select" data-icon="&#xf078">

                                        <label for="destinoId"> BODEGA DESTINO : </label>

                                        <div class="l-pos-r">

                                            {{ form.render('destinoId', ['class': 'form-element form-element-icon multi-select']) }}
                                            <i class="fa fa-file-text-o fa-absolute fa-background"></i>
                                        </div>
                                        {{ form.messages('destinoId') }}

                                    </div>

                                </div>                                
                                <div class="l-col-4">

                                    <div class="form-group form-group-select" data-icon="&#xf078">

                                        <label for="driverId"> CHOFER : </label>

                                        <div class="l-pos-r">

                                            {{ form.render('driverId', ['class': 'form-element form-element-icon multi-select']) }}
                                            <i class="fa fa-file-text-o fa-absolute fa-background"></i>
                                        </div>
                                        {{ form.messages('driverId') }}

                                    </div>

                                </div>                                
                            </div>                                

                        </section>
                    </fieldset> 
                    <fieldset>
                        <section>
                            <div class="l-row">
                                <div class="l-col-4">

                                    <div class="form-group form-group-select" data-icon="&#xf078">

                                        <label for="routeId"> RUTA : </label>

                                        <div class="l-pos-r">

                                            {{ form.render('routeId', ['class': 'form-element form-element-icon multi-select']) }}
                                            <i class="fa fa-file-text-o fa-absolute fa-background"></i>
                                        </div>
                                        {{ form.messages('routeId') }}

                                    </div>

                                </div>                                
                                <div class="l-col-4">

                                    <div class="form-group form-group-select" data-icon="&#xf078">

                                        <label for="vehicleId"> TRANSPORTE : </label>

                                        <div class="l-pos-r">

                                            {{ form.render('vehicleId', ['class': 'form-element form-element-icon multi-select']) }}
                                            <i class="fa fa-file-text-o fa-absolute fa-background"></i>
                                        </div>
                                        {{ form.messages('vehicleId') }}

                                    </div>

                                </div>                                
                                <div class="l-col-4">

                                    <div class="form-group form-group-textarea">

                                        <label for="motive"> ADICIONALES :</label>

                                        <div class="l-pos-r">
                                            {{ form.render('motive', ['class': 'form-element form-element-icon']) }}
                                            <i class="fa fa-text-width fa-absolute fa-background"></i>
                                        </div>
                                        {{ form.messages('motive') }}

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


            </div>                                    
        </div>                                    
        {% include "layouts/pie_1.volt" %}
    </div>
</div>
{% include "layouts/footer.volt" %}
