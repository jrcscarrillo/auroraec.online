{{ content() }}
{{ elements.getModelosAdicional() }}
{% include "layouts/cabecera.volt" %}
<div class="jumbotron jumbotron-fluid" style="background-color: #C1C1C1">
    <div class="container-fluid">
        <div class="l-row">
            <div class="col-md-6">
                <div class="solid-form l-container w-100" id="solid-form-container">

                    <div class="l-row">

                        <div class="l-col-12 pad-0">

                            <div class="form-header">
                                <h1 class="margin-bottom-0"><?php echo $this->view->descriptivo['cabecera']; ?></h1>
                                <h5> <?php echo $this->view->descriptivo['subtitulo']; ?>. </h5>
                            </div>

                            <div class="form-body pad-0">
                                {{ form('contact/send', 'id': 'contactForm') }}

                                <fieldset>
                                    <legend> CONTACTENOS </legend>
                                    <section>
                                        <div class="l-row">

                                            <div class="l-col-12">

                                                <div class="form-group form-group-select" data-icon="&#xf078">

                                                    <label for="name"> NOMBRES: </label>

                                                    <div class="l-pos-r">
                                                        {{ form.render('name', ['class': 'form-element form-element-icon']) }}
                                                        <i class="fa fa-list fa-absolute fa-background"></i>
                                                    </div>
                                                    {{ form.messages('name') }}
                                                </div>                                                
                                            </div>                                                
                                        </div> 
                                    </section>
                                    <section>
                                        <div class="l-row">
                                            <div class="l-col-12">

                                                <div class="form-group form-group-select" data-icon="&#xf078">

                                                    <label for="email"> CORREO ELECTRONICO: </label>

                                                    <div class="l-pos-r">
                                                        {{ form.render('email', ['class': 'form-element form-element-icon']) }}
                                                        <i class="fa fa-list fa-absolute fa-background"></i>
                                                    </div>
                                                    {{ form.messages('email') }}
                                                </div>                                                
                                            </div>                                                
                                        </div>                                                
                                    </section>
                                    <section>
                                        <div class="l-row">

                                            <div class="l-col-12">

                                                <div class="form-group form-group-select" data-icon="&#xf078">

                                                    <label for="comments"> SU MENSAJE: </label>

                                                    <div class="l-pos-r">
                                                        {{ form.render('comments', ['class': 'form-element form-element-icon']) }}
                                                        <i class="fa fa-list fa-absolute fa-background"></i>
                                                    </div>
                                                    {{ form.messages('comments') }}
                                                </div>                                                
                                            </div>                                                

                                        </div>                                                

                                    </section>
                                </fieldset>
                                <fieldset>
                                    <section>
                                        <div class="l-row">
                                            <div class="l-col-12">
                                                <div class="form-group">
                                                    {{ submit_button('Enviar', 'class': 'btn btn-primary') }}
                                                    <span class="btn btn-flat">Nuestros clientes son importantes. (nuestro tiempo de respuesta es de 4 horas)</span>
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
        {% include "layouts/pie.volt" %}
    </div>
</div>
{% include "layouts/footer.volt" %}
