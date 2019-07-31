{% extends "layouts/adicional.volt" %}
{% block forma %}
    {{ content() }}
    <p>
        {{ link_to("route", "Regresar", "class": "btn btn-primary") }}
    </p>
{% endblock %}
{% block cabecera %}
    {{ form('route/save', 'id': 'routenewForm', 'class': 'sky-form') }}
{% endblock %}
{% block cuerpoforma %}
    <fieldset>
        <section>
            <div class="row">
                <div class="col col-8">
                    {{ hidden_field('listID') }}
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <label class="label col col-4">Descripcion Corta</label>
                <div class="col col-8">
                    <label class="input">
                        <i class="icon-append fa fa-user"></i>
                        {{ text_field("name", "size" : 30, "class" : "form-control", "id" : "fieldTimecreated") }}                            
                    </label>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <label class="label col col-4">Descripcion Larga</label>
                <div class="col col-8">
                    <label class="input">
                        <i class="icon-append fa fa-user"></i>
                        {{ text_field("description", "size" : 30, "class" : "form-control", "id" : "fieldTimecreated") }}
                    </label>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <label class="label col col-4">Direccion</label>
                <div class="col col-8">
                    <label class="input">
                        <i class="icon-append fa fa-user"></i>
                        {{ text_field("address", "size" : 30, "class" : "form-control", "id" : "fieldTimecreated") }}
                    </label>
                </div>
            </div>
        </section>
    </fieldset>
    <fieldset>
        <section>
            <div class="row">
                <label class="label col col-4">Telefono Contacto</label>
                <div class="col col-8">
                    <label class="input">
                        <i class="icon-append fa fa-user"></i>
                        {{ text_field("phone", "size" : 30, "class" : "form-control", "id" : "fieldTimecreated") }}
                    </label>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <label class="label col col-4">Direccion Electronica</label>
                <div class="col col-8">
                    <label class="input">
                        <i class="icon-append fa fa-user"></i>
                        {{ text_field("email", "size" : 30, "class" : "form-control", "id" : "fieldTimecreated") }}
                    </label>
                </div>
            </div>
        </section>
    </fieldset>
    <fieldset>
        <section>
            <div class="row">
                <label class="label col col-2">Tipo Identificacion</label>
                <div class="col col-4">
                    <label class="select">
                        <i class="icon-append fa fa-user"></i>
                        {{ text_field("tipoId", "size" : 30, "class" : "form-control", "id" : "fieldTimecreated") }}
                    </label>
                </div>
                <label class="label col col-2">Numero Identificacion</label>
                <div class="col col-4">
                    <label class="input">
                        <i class="icon-append fa fa-user"></i>
                        {{ text_field("numeroId", "size" : 30, "class" : "form-control", "id" : "fieldTimecreated") }}
                    </label>
                </div>
            </div>
        </section>
    </fieldset>
    <fieldset>
        <section>
            <div class="row">
                <label class="label col col-2">notas</label>
                <div class="col col-4">
                    <label class="input">
                        <i class="icon-append fa fa-user"></i>
                        {{ text_field("customField1", "size" : 30, "class" : "form-control", "id" : "fieldTimecreated") }}
                    </label>
                </div>
            </div>
        </section>
    </fieldset>
    <footer>
        {{ submit_button('Submit', 'class': 'btn btn-primary') }}
        <p class="help-block">Usted esta modificando una ruta.</p>
    </footer>
</form>
{% endblock %}