{{ content() }}
{{ elements.getModelosAdicional() }}
{% include "layouts/cabecera.volt" %}
<div class="solid-form">
    <div class="solid-form l-container w-50" id="solid-form-container">

        <div class="l-row">

            <div class="l-col-12 pad-0">
                <div class="previous pull-left">
                    {{ link_to("items/index", "&larr; Atras") }}
                </div>

                <div class="form-header">
                    <h1 class="margin-bottom-0"><?php echo $this->view->descriptivo['cabecera']; ?></h1>
                    <h5><?php echo $this->view->descriptivo['subtitulo']; ?></h5>
                </div>

                <div class="form-body pad-0">
                    {{ form( 'id': 'registerForm') }}        


                    <fieldset>
                        <section>
                            <div class="row">
                                <div class="col col-4">
                                    <label class="hidden">
                                        <i class="icon-append fa fa-user"></i>
                                        {{ form.render('id', ['class': 'form-control']) }}
                                    </label>
                                </div>
                            </div>
                        </section>
                        <section>

                            <div class="l-col-6">

                                <div class="form-group">

                                    <label for="name"> DESCRIPCION CORTA: </label>

                                    <div class="l-pos-r">
                                        {{ form.render("name", ['class': 'form-element form-element-icon']) }}
                                        <i class="fa fa-calendar fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('name') }}

                                </div>

                            </div>                               

                        </section>
                        <section>

                            <div class="l-col-6">

                                <div class="form-group">

                                    <label for="sales_desc"> DESCRIPCION EN Punto de Ventas: </label>

                                    <div class="l-pos-r">
                                        {{ form.render("sales_desc", ['class': 'form-element form-element-icon']) }}
                                        <i class="fa fa-calendar fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('sales_desc') }}

                                </div>

                            </div>                               

                        </section>                                    
                    </fieldset>
                    <fieldset>
                        <section>

                            <div class="l-col-12">

                                <div class="form-group">

                                    <label for="fullname"> DESCRIPCION LARGA: </label>

                                    <div class="l-pos-r">
                                        {{ form.render("fullname", ['class': 'form-element form-element-icon']) }}
                                        <i class="fa fa-calendar fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('fullname') }}

                                </div>

                            </div>                               

                        </section>
                    </fieldset>
                    <fieldset>

                        <section>

                            <div class="l-col-8">

                                <div class="form-group">

                                    <label for="description"> DESCRIPCION EN Reportes: </label>

                                    <div class="l-pos-r">
                                        {{ form.render("description", ['class': 'form-element form-element-icon']) }}
                                        <i class="fa fa-calendar fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('description') }}

                                </div>

                            </div>                                  

                        </section>

                        <section>

                            <div class="l-col-4">

                                <div class="form-group">

                                    <label for="sales_price"> PRECIO DE VENTA: </label>

                                    <div class="l-pos-r">
                                        {{ form.render("sales_price", ['class': 'form-element form-element-icon']) }}
                                        <i class="fa fa-calendar fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('sales_price') }}

                                </div>

                            </div>                               

                        </section>
                    </fieldset>
                    <fieldset>

                        <section>

                            <div class="l-col-6">

                                <div class="form-group">

                                    <label for="barcode"> CODIGO DE BARRAS: </label>

                                    <div class="l-pos-r">
                                        {{ form.render("barcode", ['class': 'form-element form-element-icon']) }}
                                        <i class="fa fa-calendar fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('barcode') }}

                                </div>

                            </div>                            

                        </section>
                        <section>

                            <div class="l-col-6">
                                <div class="form-group form-group-select" data-icon="&#xf078">

                                    <label for="tipoIva"> IVA DEL PRODUCTO: </label>

                                    <div class="l-pos-r">

                                        {{ form.render('tipoIva', ['class': 'form-element form-element-icon multi-select']) }}
                                        <i class="fa fa-list fa-absolute fa-background"></i>
                                    </div>
                                    {{ form.messages('tipoIva') }}

                                </div>
                            </div>                            

                        </section>
                    </fieldset>
                    <footer>
                        {{ submit_button("Guardar", "class": "btn btn-success") }}
                        <p class="help-block">Guardar los cambios realizados.</p>
                    </footer>
                    </form>

                </div>


            </div>                                    
        </div>
        {% include "layouts/pie_1.volt" %}
    </div>
    </div>
        {% include "layouts/footer.volt" %}