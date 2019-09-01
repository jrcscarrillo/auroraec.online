{{ content() }}
{{ elements.getModelosAdicional() }}
{% include "layouts/cabecera.volt" %}
<div class="solid-form">
    <div class="solid-form l-container w-50" id="solid-form-container">

        <div class="l-row">

            <div class="l-col-12 pad-0">

                <div class="form-body">
                    
                    {{ form('sricodes/save', 'role': 'form', 'class': 'sky-form') }}

                    <fieldset>
                        <legend> CONCEPTO RETENCION </legend>

                        <div class="l-row">

                            <div class="l-col-6">

                                <div class="form-group form-group-select" data-icon="&#xf078">

                                    <label for="tipoconcepto"> CONCEPTO RETENCION : </label>

                                    <div class="l-pos-r">

                                        {{ form.render('tipoconcepto', ['class': 'form-element form-element-icon multi-select']) }}
                                        <i class="fa fa-list fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('tipoconcepto') }}

                                </div>

                            </div>
                            <div class="l-col-6">
                                <div class="form-group form-group-select" data-icon="&#xf078">

                                    <label for="ItemRef"> ITEM DEL QB :</label>

                                    <div class="l-pos-r">

                                        {{ form.render('ItemRef', ['class': 'form-element form-element-icon multi-select']) }}
                                        <i class="fa fa-list fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('ItemRef') }}

                                </div>
                            </div>

                        </div>
                        <div class="l-row">
                            <div class="l-col-6">

                                <div class="form-group">

                                    <label for="CodigoConcepto"> CODIGO RETENCION SRI :</label>

                                    <div class="l-pos-r">
                                        {{ form.render("CodigoConcepto", ['class': 'form-element form-element-icon']) }}
                                        <i class="fa fa-calendar fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('CodigoConcepto') }}

                                </div>

                            </div>
                            <div class="l-col-6">

                                <div class="form-group form-group-select" data-icon="&#xf078">

                                    <label for="Percentaje"> PORCENTAJE RETENCION: </label>

                                    <div class="l-pos-r">

                                        {{ form.render('Percentaje', ['class': 'form-element form-element-icon multi-select']) }}
                                        <i class="fa fa-arrows-v fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('Percentaje') }}

                                </div>

                            </div>
                        </div>
                        <div class="l-row">
                            <div class="l-col-6">

                                <div class="form-group">

                                    <label for="NombreConcepto"> NOMBRE DEL CONCEPTO  :</label>

                                    <div class="l-pos-r">
                                        {{ form.render("NombreConcepto", ['class': 'form-element form-element-icon']) }}
                                        <i class="fa fa-calendar fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('NombreConcepto') }}

                                </div>

                            </div>

                        </div>

                    </fieldset>
                                    
                                    {{ hidden_field('ListID') }}

                    <div class="l-row">
                        <div class="l-col-12">
                            <div class="form-group">
                                {{ submit_button('Save', 'class': 'btn btn-success btn-flat') }}
                            </div>
                        </div>

                    </div>


                    </form>

                </div>


            </div>                                    
        </div>
    </div>
</div>

