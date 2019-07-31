{% extends "layouts/adicional_1.volt" %}
{% block forma %}
    {{ content() }}
    <div class="body bg-blue">
    {% endblock %}
    {% block cabecera %}

        {{ form("bodegas/save", "method":"post", "autocomplete" : "off", "class" : "sky-form") }}
    {% endblock %}
    {% block cuerpoforma %}
        <fieldset>
            <section>
                <div class="form-group">
                    {{ hidden_field("ListID") }}
                </div>
            </section>

            <section>
                <div class="form-group">
                    <label for="fieldName" class="col-sm-4 control-label">Name</label>
                    <div class="col-sm-8">
                        {{ text_field("Name", "size" : 30, "class" : "form-control", "id" : "fieldName") }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="fieldFullname" class="col-sm-4 control-label">FullName</label>
                    <div class="col-sm-8">
                        {{ text_field("FullName", "size" : 30, "class" : "form-control", "id" : "fieldFullname") }}
                    </div>
                </div>
            </section>
        </fieldset>
        <fieldset>                    

            <section>
                <div class="form-group">
                    <label for="fieldBodegaaddress" class="col-sm-4 control-label">BodegaAddress</label>
                    <div class="col-sm-8">
                        {{ text_field("BodegaAddress", "size" : 30, "class" : "form-control", "id" : "fieldBodegaaddress") }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="fieldTipoid" class="col-sm-4 control-label">TipoID</label>
                    <div class="col-sm-8">
                        {{ text_field("TipoID", "size" : 30, "class" : "form-control", "id" : "fieldTipoid") }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="fieldNumeroid" class="col-sm-4 control-label">RUC</label>
                    <div class="col-sm-8">
                        {{ text_field("NumeroID", "size" : 30, "class" : "form-control", "id" : "fieldNumeroid") }}
                    </div>
                </div>
            </section>
            <section>
                <div class="form-group">
                    <label for="fieldEstablecimiento" class="col-sm-4 control-label">Establecimiento</label>
                    <div class="col-sm-8">
                        {{ text_field("Establecimiento", "size" : 3, "class" : "form-control", "id" : "fieldEstablecimiento") }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="fieldPuntoEmision" class="col-sm-4 control-label">Punto Emision</label>
                    <div class="col-sm-8">
                        {{ text_field("PuntoEmision", "size" : 3, "class" : "form-control", "id" : "fieldPuntoEmision") }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="fieldNumeroid" class="col-sm-4 control-label">RUC</label>
                    <div class="col-sm-8">
                        {{ text_field("NumeroID", "size" : 30, "class" : "form-control", "id" : "fieldNumeroid") }}
                    </div>
                </div>
            </section>
        </fieldset>
        <fieldset>

            <section>
                <div class="form-group">
                    <label for="fieldEmail" class="col-sm-4 control-label">Email</label>
                    <div class="col-sm-8">
                        {{ text_field("Email", "size" : 30, "class" : "form-control", "id" : "fieldEmail") }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="fieldContacto" class="col-sm-4 control-label">Contacto</label>
                    <div class="col-sm-8">
                        {{ text_field("Contacto", "size" : 30, "class" : "form-control", "id" : "fieldContacto") }}
                    </div>
                </div>

            </section>
        </fieldset>
        <footer>
            {{ submit_button('Submit', 'class': 'btn btn-primary') }}
            <p class="help-block">Usted esta modificando las clases del QB (Bodegas).</p>
        </footer>
    </form>
{% endblock %}