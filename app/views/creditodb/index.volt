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
                            <h1 class="margin-bottom-0"> NOTA DE CREDITO </h1>
                            <h5> Configuracion del tipo de nota de credito. </h5>
                        </div>
                    </div>
                </div>

                <div class="form-body pad-0">
                    {{ form('id':'cabecera')}}

                    <fieldset>
                        <legend> GENERAL </legend>

                        <div class="l-row">

                            <div class="l-col-4">

                                <div class="form-group form-group-select" data-icon="&#xf078">

                                    <label for="tiponotacr"> NOTA DE CREDITO DE: </label>

                                    <div class="l-pos-r">

                                        {{ form.render('tiponotacr', ['class': 'form-element form-element-icon multi-select']) }}
                                        <i class="fa fa-file-text-o fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('tiponotacr') }}

                                </div>

                            </div>
                            <div class="l-col-4">
                                <div class="form-group form-group-select" data-icon="&#xf078">

                                    <label for="aplica"> MOTIVO: </label>

                                    <div class="l-pos-r">

                                        {{ form.render('aplica', ['class': 'form-element form-element-icon multi-select']) }}
                                        <i class="fa fa-file-text fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('aplica') }}

                                </div>
                            </div>


                            <div class="l-col-4">

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

                            <div class="l-col-4">

                                <div class="form-group">

                                    <label for="numerofactura"> NRO. FACTURA </label>

                                    <div class="l-pos-r">
                                        {{ form.render('numerofactura', ['class': 'form-element form-element-icon']) }}
                                        <i class="fa fa-file-o fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('numerofactura') }}

                                </div>

                            </div>
                            <div class="l-col-4">

                                <div class="form-group">

                                    <label for="numeronotacr"> NRO. NOTA DE CREDITO</label>

                                    <div class="l-pos-r">
                                        {{ form.render('numeronotacr', ['class': 'form-element form-element-icon']) }}
                                        <i class="fa fa-file fa-absolute fa-background"></i>
                                    </div>

                                    {{ form.messages('numeronotacr') }}

                                </div>

                            </div>

                            <div class="l-col-4">

                                <div class="form-group form-group-textarea">

                                    <label for="referencia"> REFERENCIA </label>

                                    <div class="l-pos-r">
                                        {{ form.render('referencia', ['class': 'form-element form-element-icon']) }}
                                        <i class="fa fa-text-width fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('referencia') }}

                                </div>

                            </div>
                        </div>

                        <div class="l-row">

                            <div class="l-col-12">

                                <div class="form-group form-group-textarea">

                                    <label for="notacomprador"> NOTA COMPRADOR </label>

                                    <div class="l-pos-r">
                                        {{ form.render('notacomprador', ['class': 'form-element form-element-icon multi-select']) }}
                                        <i class="fa fa-comments-o  fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('notacomprador') }}

                                </div>

                            </div>
                        </div>
                        <div class="l-row">

                            <div class="l-col-12">

                                <div class="form-group form-group-textarea">

                                    <label for="condiciones"> TERMINOS Y CONDICIONES</label>

                                    <div class="l-pos-r">
                                        {{ form.render('condiciones', ['class': 'form-element form-element-icon multi-select']) }}
                                        <i class="fa fa-comments  fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('condiciones') }}

                                </div>

                            </div>
                        </div>

                </div>
                </fieldset>

                <div class="l-row">
                    <div class="l-col-12">
                        <div class="form-group">
                            {{ submit_button('Detalles', 'class': 'btn btn-success btn-flat') }}
                        </div>
                    </div>

                </div>


                </form>


            </div>


        </div>                                    
        {% include "layouts/pie_1.volt" %}
    </div>
</div>
{% include "layouts/footer.volt" %}
