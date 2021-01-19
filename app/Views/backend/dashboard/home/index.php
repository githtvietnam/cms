<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content">
                <div class="row">
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Tin tức mới nhất</h5> 
                        </div>
                        <div class="ibox-content">
                            <div class="wrap-dashboard">
                                <ul class="uk-list">
                                    <?php if(isset($articleList) && is_array($articleList) &&count($articleList)){
                                        foreach ($articleList as $key => $value) {
                                    ?>
                                        <li class="mb15">
                                            <div class="uk-flex">
                                                <div class="img-dashboard mr20">
                                                    <a class=" img-cover" href="<?php echo site_url('backend/article/article/update/'.$value['id']); ?>">
                                                        <img src="<?php echo check_isset($value['image']) ?>" alt="">
                                                    </a>
                                                </div>
                                                <div class="content-dashboard">
                                                    <a href="<?php echo site_url('backend/article/article/update/'.$value['id']); ?>">
                                                        <h3><?php echo check_isset($value['title']) ?></h3>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="number-viewed">
                                                <i class="fa fa-eye mr10" aria-hidden="true"></i><?php echo check_isset($value['viewed']) ?>
                                            </div>
                                        </li>
                                        <hr>

                                    <?php }} ?>
                                </ul>
                            </div>              
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Tour mới nhất</h5> 
                        </div>
                        <div class="ibox-content">
                            <div class="wrap-dashboard">
                                <ul class="uk-list">
                                    <?php if(isset($tourList) && is_array($tourList) &&count($tourList)){
                                        foreach ($tourList as $key => $value) {
                                            $album = json_decode($value['album'])[0];
                                    ?>
                                        <li class="mb15">
                                            <div class="uk-flex">
                                                <div class="img-dashboard mr20">
                                                    <a class=" img-cover" href="<?php echo site_url('backend/article/article/update/'.$value['id']); ?>">
                                                        <img src="<?php echo check_isset($album) ?>" alt="">
                                                    </a>
                                                </div>
                                                <div class="content-dashboard">
                                                    <a href="<?php echo site_url('backend/article/article/update/'.$value['id']); ?>" class="title_tour_dashboard">
                                                        <h3><?php echo check_isset($value['title']) ?></h3>
                                                    </a>
                                                    <div class="price_tour_dashboard uk-flex">
                                                        <div class="old-price <?php echo ((isset($value['price_promotion'])) ? 'line-price' : '') ?>">
                                                            <?php echo number_format(check_isset($value['price']),0,',','.') ?>
                                                        </div>
                                                        <div class="new-price">
                                                            <?php echo number_format(check_isset($value['price_promotion']),0,',','.') ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="number-viewed">
                                                <i class="fa fa-eye mr10" aria-hidden="true"></i><?php echo check_isset($value['viewed']) ?>
                                            </div>
                                        </li>
                                        <hr>

                                    <?php }} ?>
                                </ul>
                            </div>              
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Thông tin liên hệ khách hàng</h5>
                        </div>
                        <div class="ibox-content inspinia-timeline">
                            <?php if(isset($contactList) && is_array($contactList) &&count($contactList)){
                                foreach ($contactList as $key => $value) {
                            ?>
                                <div class="timeline-item">
                                    <div class="row">
                                        <div class="col-xs-5 date">
                                            <i class="fa fa-comments"></i>
                                            <?php echo check_isset($value['fullname']) ?>
                                            <br/>
                                            <small class="text-navy">
                                                <time class="timeago" datetime="<?php echo check_isset($value['created_at']) ?>"></time>
                                            </small>
                                        </div>
                                        <div class="col-xs-7 content">
                                            <p class="m-b-xs"><strong><?php echo check_isset($value['title']) ?></strong></p>
                                            <p>
                                                <?php echo check_isset($value['content']) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php }} ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <?php echo view('backend/dashboard/common/footer'); ?>
    </div>
</div>