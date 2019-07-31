{% extends "layouts/adicional.volt" %}
{% block forma %}
    {{ content() }}
    <p>
        {{ link_to("vehicle", "Regresar", "class": "btn btn-primary") }}
    </p>
{% endblock %}
{% block cabecera %}
    {{ form('vehicle/save',  'class': 'sky-form') }}
{% endblock %}
{% block cuerpoforma %}

    <fieldset>
        <section>
            <div class="form-group">
                <div class="col-sm-8">
                    {{ hidden_field("listID") }}
                </div>
            </div>
        </section>
    </fieldset>
    <fieldset>
        <section>    
            <div class="form-group">
                <label for="fieldName" class="col-sm-4 control-label">Placa</label>
                <div class="col-sm-8">
                    {{ text_field("name", "size" : 30, "class" : "form-control", "id" : "fieldName") }}
                </div>
            </div>

            <div class="form-group">
                <label for="fieldDescription" class="col-sm-4 control-label">Descripcion</label>
                <div class="col-sm-8">
                    {{ text_field("description", "size" : 30, "class" : "form-control", "id" : "fieldDescription") }}
                </div>
            </div>
        </section>
    </fieldset>
    <fieldset>
        <section> 
            <div class="form-group">
                <label for="fieldAddress" class="col-sm-4 control-label">Direccion</label>
                <div class="col-sm-8">
                    {{ text_field("address", "size" : 30, "class" : "form-control", "id" : "fieldAddress") }}
                </div>
            </div>

            <div class="form-group">
                <label for="fieldPhone" class="col-sm-4 control-label">Telefonos</label>
                <div class="col-sm-8">
                    {{ text_field("phone", "size" : 30, "class" : "form-control", "id" : "fieldPhone") }}
                </div>
            </div>

            <div class="form-group">
                <label for="fieldEmail" class="col-sm-4 control-label">Email</label>
                <div class="col-sm-8">
                    {{ text_field("email", "size" : 30, "class" : "form-control", "id" : "fieldEmail") }}
                </div>
            </div>
        </section>
    </fieldset>
    <fieldset>
        <section> 
            <div class="form-group">
                <label for="fieldTipoid" class="col-sm-4 control-label">RUC/Ced/Pas</label>
                <div class="col-sm-8">
                    {{ text_field("tipoId", "size" : 30, "class" : "form-control", "id" : "fieldTipoid") }}
                </div>
            </div>

            <div class="form-group">
                <label for="fieldNumeroid" class="col-sm-4 control-label">Numero</label>
                <div class="col-sm-8">
                    {{ text_field("numeroId", "size" : 30, "class" : "form-control", "id" : "fieldNumeroid") }}
                </div>
            </div>

        </section>
    </fieldset>

    <footer>
        {{ submit_button('Submit', 'class': 'btn btn-primary') }}
        <p class="help-block">Usted esta actualizando un vehiculo.</p>
    </footer>
</form>
{% endblock %}