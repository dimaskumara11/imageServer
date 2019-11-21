        <div class="box box-solid">
            
            <div class="box-header with-border">
              <h3 class="box-title">Carousel</h3>
            </div>
            
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                  {SLIDER_LIST}  
                  <div class="item {is_active}">
                    <img src="{slider_image}" alt="{slider_title}">

                    <div class="carousel-caption">
                      {slider_title}
                    </div>
                  </div>
                  {/SLIDER_LIST}
                  
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div>
        </div>    