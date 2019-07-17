{{ content() }}
{% include "layouts/cabecera.volt" %}
<div class="jumbotron jumbotron-fluid" style="background-color: #C1C1C1">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-6">
                {{ form('session/start', 'role': 'form', 'class': 'sky-form') }}
                <header>Log in</header>
                <fieldset>
                    <section>
                        <div class="col col-md-4">
                            <label class="label">E-mail</label>
                        </div>
                        <div class="col col-md-8">
                            <label class="input">
                                {{ form.render("email", ['class': 'form-element form-element-icon']) }}
                            </label>
                            {{ form.messages('email') }}
                        </div>
                    </section>
                </fieldset>
                <fieldset>
                    <section>
                        <div class="col col-md-4">
                            <label class="label">Password</label>
                        </div>
                        <div class="col col-md-8">
                            <label class="input">
                                {{ form.render("password", ['class': 'form-element form-element-icon']) }}
                            </label>
                            {{ form.messages('password') }}
                        </div>
                    </section>
                </fieldset>
                <footer>
                    {{ submit_button('Login', 'class': 'btn btn-primary btn-large') }}
                    {{ link_to('register', ' Registrarse ', 'class': 'btn btn-success btn-large', 'style':'color:white') }}
                </footer>
                </form>
            </div>

            <div class="col col-md-6">

                <div class="card" style="background-color: #C1C1C1">
                    <div class="card-body">
                        <h2 class="card-title">Ha creado una cuenta con nosotros?</h2>
                    </div>

                    <p>Estas son las opciones que podra realizar si se registra:</p>
                    <ul>
                        <li>Podra crear, envir y recibir mensajes.</li>
                        <li>Podra revisar el estado actual de su cuenta.</li>
                        <li>Podra bajar o imprimir uno o varios documentos electronicos</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
{% include "layouts/footer.volt" %}

