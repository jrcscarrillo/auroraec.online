{{ content() }}
{{ elements.getModelosAdicional() }}
{% include "layouts/cabecera.volt" %}
<div class="jumbotron jumbotron-fluid" style="background-color: #C1C1C1">
    <div class="container-fluid">
        <div class="l-row">
            {% include "layouts/pie.volt" %}
            <div class="col-md-6">
                <div class="solid-form l-container w-100" id="solid-form-container">

                    <div class="l-row">

                        <div class="l-col-12 pad-0">

                            <div class="form-header">
                                <h1 class="margin-bottom-0"><?php echo $this->view->descriptivo['cabecera']; ?></h1>
                                <h5> <?php echo $this->view->descriptivo['subtitulo']; ?>. </h5>
                            </div>

                            <div class="form-body pad-0">
                                {{ form('users/search', 'id': 'usersForm') }}
                                <fieldset>
                                    <legend> USUARIO </legend>

                                    <div class="l-row">

                                        <div class="l-col-6">

                                            <div class="form-group form-group-select" data-icon="&#xf078">

                                                <label for="tipo"> TIPO USUARIO: </label>

                                                <div class="l-pos-r">
                                                    {{ form.render('tipo', ['class': 'form-element form-element-icon']) }}
                                                    <i class="fa fa-list fa-absolute fa-background"></i>
                                                </div>

                                            </div>                                                
                                        </div>                                                

                                        <div class="l-col-6">

                                            <div class="form-group form-group-select" data-icon="&#xf078">

                                                <label for="numeroId"> TIPO USUARIO: </label>

                                                <div class="l-pos-r">
                                                    {{ form.render('numeroId', ['class': 'form-element form-element-icon']) }}
                                                    <i class="fa fa-list fa-absolute fa-background"></i>
                                                </div>

                                            </div>                                                
                                        </div>                                                
                                    </div>                                                

                                    <div class="l-row">

                                        <div class="l-col-6">

                                            <div class="form-group form-group-select" data-icon="&#xf078">

                                                <label for="username"> NOMBRE USUARIO: </label>

                                                <div class="l-pos-r">
                                                    {{ form.render('username', ['class': 'form-element form-element-icon']) }}
                                                    <i class="fa fa-list fa-absolute fa-background"></i>
                                                </div>

                                            </div>                                                
                                        </div>                                                

                                        <div class="l-col-6">

                                            <div class="form-group form-group-select" data-icon="&#xf078">

                                                <label for="name"> RAZON SOCIAL/NOMBRES: </label>

                                                <div class="l-pos-r">
                                                    {{ form.render('name', ['class': 'form-element form-element-icon']) }}
                                                    <i class="fa fa-list fa-absolute fa-background"></i>
                                                </div>

                                            </div>                                                
                                        </div>                                                
                                    </div>                                                

                                    <div class="l-row">

                                        <div class="l-col-12">

                                            <div class="form-group form-group-select" data-icon="&#xf078">

                                                <label for="email"> EMAIL USUARIO: </label>

                                                <div class="l-pos-r">
                                                    {{ form.render('email', ['class': 'form-element form-element-icon']) }}
                                                    <i class="fa fa-list fa-absolute fa-background"></i>
                                                </div>

                                            </div>                                                
                                        </div>                                                

                                    </div>                                                

                                </fieldset>
                                <fieldset>
                                    <section>
                                        <div class="l-row">
                                            <div class="l-col-12">
                                                <div class="form-group">
                                                    {{ submit_button('Buscar', 'class': 'btn btn-primary') }}
                                                    <p class="help-block">Con estos valores se realizara la busqueda de usuarios registrados en nuestra base de datos.</p>
                                                </div>
                                            </div>
                                    </section>
                                </fieldset>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {% include "layouts/footer.volt" %}
</div>

