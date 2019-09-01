    <div class="w-100" style="background-color: #C1C1C1">
        <div class="container-fluid">
            <nav class="navbar navbar-default" style="background-color: #F3BE25;">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"><img class="img-responsive" style="display:inline-block; weight:60px; height:30px; margin-top:-5px" src="https://carrillosteam.com/public/img/aurora.png?text=Logo" alt=""></a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    {{ elements.getMenu() }}
                </div><!-- /.container-fluid -->
            </nav>
        </div>
        <div class="container-fluid">
            {{ flash.output() }}
        </div>
    </div>
