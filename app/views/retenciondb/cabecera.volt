{{ content() }}
{{ elements.getModelosAdicional() }}
{% include "layouts/cabecera.volt" %}
<div class="container-fluid">
    <div class="l-row">
        <div class="col-md-6">
            <div class="solid-form l-container w-100" id="solid-form-container">

                <div class="l-row">

                    <div class="l-col-12 pad-0">

                        <div class="form-header">
                            <div class="l-row">
                                <div class="l-col-4">
                                    <br>
                                    <h4> {{ ruc['NombreComercial']}} </h4>
                                    <h5> {{ ruc['ruc'] }} </h5>
                                    <h5>Establecimiento {{ ruc['estab'] }} Punto de Emision {{ ruc['punto'] }} </h5>
                                </div>
                                <div class="l-col-4">
                                    <h1 class="margin-bottom-0"> NOTAS DE CREDITO </h1>
                                    <h5> Configuracion del tipo de nota de credito. </h5>
                                </div>
                                <div class="l-col-4">
                                    <br>
                                </div>
                            </div>
                        </div>

                        <div class="form-body pad-0">
                            {{ form('id':'cabecera')}}

                            <fieldset>
                                <legend> GENERAL </legend>

                                <div class="l-row">

                                    <div class="l-col-3">

                                        <div class="form-group form-group-select" data-icon="&#xf078">

                                            <label for="tiponotacr"> NOTA DE CREDITO: </label>

                                            <div class="l-pos-r">

                                                {{ form.render('tiponotacr', ['class': 'form-element form-element-icon multi-select']) }}
                                                <i class="fa fa-list fa-absolute fa-background"></i>
                                            </div>
                                            {{ form.messages('tiponotacr') }}

                                        </div>

                                    </div>
                                    <div class="l-col-3">
                                        <div class="form-group form-group-select" data-icon="&#xf078">

                                            <label for="aplica"> APLICACION </label>

                                            <div class="l-pos-r">

                                                {{ form.render('aplica', ['class': 'form-element form-element-icon multi-select']) }}
                                                <i class="fa fa-list fa-absolute fa-background"></i>
                                            </div>
                                            {{ form.messages('aplica') }}

                                        </div>
                                    </div>


                                    <div class="l-col-3">

                                        <div class="form-group">

                                            <label for="fechaemision"> FECHA EMISION </label>

                                            <div class="l-pos-r">
                                                {{ form.render("fechaemision", ['class': 'form-element form-element-icon']) }}
                                                <i class="fa fa-calendar fa-absolute fa-background"></i>
                                            </div>
                                            {{ form.messages('fechaemision') }}

                                        </div>

                                    </div>

                                </div>
                                <div class="l-row">

                                    <div class="l-col-3">

                                        <div class="form-group">

                                            <label for="numeronotacr"> NRO. NOTA CR</label>

                                            <div class="l-pos-r">
                                                {{ form.render('numeronotacr', ['class': 'form-element form-element-icon']) }}
                                                <i class="fa fa-arrows-v fa-absolute fa-background"></i>
                                            </div>
                                            {{ form.messages('numeronotacr') }}

                                        </div>

                                    </div>

                                </div>


                            </fieldset>

                            <div class="l-row">
                                <div class="l-col-12">
                                    <div class="form-group">
                                        {{ submit_button('Detalle', 'class': 'btn btn-success btn-flat') }}
                                    </div>
                                </div>

                            </div>


                            </form>

                        </div>


                    </div>                                    
                </div>
            </div>
        </div>
        {% include "layouts/pie.volt" %}
    </div>
    {% include "layouts/footer.volt" %}
</div>

