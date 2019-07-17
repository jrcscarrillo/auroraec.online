{{ content() }}
{{ elements.getModelosAdicional() }}
{% include "layouts/cabecera.volt" %}
<div class="solid-form">
    <div class="solid-form l-container w-50" id="solid-form-container">

        <div class="l-row">

            <div class="l-col-12 pad-0">

                <div class="form-header">
                    <h1 class="margin-bottom-0"> REGISTRO DE USUARIOS </h1>
                    <h5> Pueden registrarse empleados, clientes o proveedores de la empresa. </h5>
                </div>

                <div class="form-body pad-0">
                    {{ form('register', 'id': 'registerForm') }}
                    <fieldset>
                        <legend> USUARIO </legend>

                        <div class="l-row">

                            <div class="l-col-4">

                                <div class="form-group form-group-select" data-icon="&#xf078">

                                    <label for="tipo"> TIPO USUARIO: </label>

                                    <div class="l-pos-r">
                                        {{ form.render('tipo', ['class': 'form-element form-element-icon multi-select']) }}
                                        <i class="fa fa-list fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('tipo') }}

                                </div>

                            </div>
                            <div class="l-col-4">
                                <div class="form-group form-group-select" data-icon="&#xf078">

                                    <label for="tipoId"> TIPO IDENTIFICACION: </label>

                                    <div class="l-pos-r">

                                        {{ form.render('tipoId', ['class': 'form-element form-element-icon multi-select']) }}
                                        <i class="fa fa-list fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('tipoId') }}

                                </div>
                            </div>


                            <div class="l-col-4">

                                <div class="form-group">

                                    <label for="numeroId"> NUMERO IDENTIFICACION: </label>

                                    <div class="l-pos-r">
                                        {{ form.render("numeroId", ['class': 'form-element form-element-icon']) }}
                                        <i class="fa fa-calendar fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('numeroId') }}

                                </div>

                            </div>
                        </div>
                        <div class="l-row">
                            <div class="l-col-12">

                                <div class="form-group form-group-select" data-icon="&#xf078">

                                    <label for="name"> RAZON SOCIAL/NOMBRES: </label>

                                    <div class="l-pos-r">

                                        {{ form.render('name', ['class': 'form-element form-element-icon multi-select']) }}
                                        <i class="fa fa-arrows-v fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('name') }}

                                </div>

                            </div>
                        </div>
                        <div class="l-row">


                            <div class="l-col-12">

                                <div class="form-group">

                                    <label for="email"> CORREO ELECTRONICO: </label>

                                    <div class="l-pos-r">
                                        {{ form.render('email', ['class': 'form-element form-element-icon']) }}
                                        <i class="fa fa-arrows-v fa-absolute fa-background"></i>
                                    </div>

                                    {{ form.messages('email') }}

                                </div>

                            </div>
                        </div>
                        <div class="l-row">
                            <div class="l-col-4">

                                <div class="form-group">

                                    <label for="username"> NOMBRE USUARIO: </label>

                                    <div class="l-pos-r">
                                        {{ form.render('username', ['class': 'form-element form-element-icon']) }}
                                        <i class="fa fa-arrows-v fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('username') }}

                                </div>

                            </div>
                            <div class="l-col-4">

                                <div class="form-group form-group-select">

                                    <label for="password"> PALABRA CLAVE: </label>

                                    <div class="l-pos-r">
                                        {{ form.render('password', ['class': 'form-element form-element-icon']) }}
                                        <i class="fa fa-arrows-v fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('password') }}

                                </div>

                            </div>
                            <div class="l-col-4">

                                <div class="form-group form-group-select" data-icon="&#xf078">

                                    <label for="repeatPassword"> REINGRESO CLAVE: </label>

                                    <div class="l-pos-r">

                                        {{ form.render('repeatPassword', ['class': 'form-element form-element-icon multi-select']) }}
                                        <i class="fa fa-list fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('repeatPassword') }}

                                </div>

                            </div>
                        </div>

                    </fieldset>

                    <div class="l-row">
                        <div class="l-col-12">
                            <div class="form-group">
                                {{ submit_button('Registrarse', 'class': 'btn btn-primary') }}
                                <p class="help-block">Al ingresar al sistema, usted acepta los terminos y condiciones de su uso.</p>
                            </div>
                        </div>

                    </div>


                    </form>

                </div>


            </div>                                    
        </div>
        {% include "layouts/pie.volt" %}
    </div>
        {% include "layouts/footer.volt" %}
</div>

