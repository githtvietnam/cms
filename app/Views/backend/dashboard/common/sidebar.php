<nav class="navbar-default navbar-static-side" role="navigation">
    <?php  
        $user = authentication();
        $uri = service('uri');   
        $uri = current_url(true);
        $uriModule = $uri->getSegment(2);
        $baseController = new App\Controllers\BaseController();
        $language = $baseController->currentLanguage();

    ?>
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                    <img alt="image" class="img-circle" src="<?php echo $user['image']; ?>" style="max-width:48px;height:48px;" />
                     </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="<?php echo site_url('profile') ?>">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $user['fullname'] ?></strong>
                     </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('backend/authentication/auth/logout') ?>">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
           <li class="landing_link">
                <a  href="<?php echo base_url('backend/dashboard/dashboard/index') ?>"><i class="fa fa-star"></i> <span class="nav-label">Dashboard</span> <span class="label label-warning pull-right">NEW</span></a>
            </li>
            <li class="<?php echo ( $uriModule == 'product') ? 'active'  : '' ?>">
                <a href="index.html"><i class="fa fa-desktop"></i> <span class="nav-label">QL Sản phẩm</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo base_url('backend/product/catalogue/index') ?>">QL Nhóm Sản phẩm</a></li>
                    <li><a href="<?php echo base_url('backend/product/brand/brand/index') ?>">QL Thương hiệu</a></li>
                    <li><a href="<?php echo base_url('backend/product/store/index') ?>">QL Cửa hàng</a></li>
                    <li><a href="<?php echo base_url('backend/product/warehouse/index') ?>">QL Kho hàng</a></li>
                </ul>
            </li>
            <li class="<?php echo ( $uriModule == 'article') ? 'active'  : '' ?>">
                <a href="index.html"><i class="fa fa-file"></i> <span class="nav-label"><?php echo translate('cms_lang.sidebar.sb_article', $language) ?></span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo base_url('backend/article/catalogue/index') ?>"><?php echo translate('cms_lang.sidebar.sb_article_catalogue', $language) ?></a></li>
                    <li><a href="<?php echo base_url('backend/article/article/index') ?>"><?php echo translate('cms_lang.sidebar.sb_article', $language) ?></a></li>
                </ul>
            </li>
            <li class="<?php echo ( $uriModule == 'user') ? 'active'  : '' ?>">
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label"><?php echo translate('cms_lang.sidebar.sb_user', $language) ?></span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo base_url('backend/user/catalogue/index') ?>"><?php echo translate('cms_lang.sidebar.sb_user_catalogue', $language) ?></a></li>
                    <li><a href="<?php echo base_url('backend/user/user/index') ?>"><?php echo translate('cms_lang.sidebar.sb_user', $language) ?></a></li>
                </ul>
            </li>
            <li class="<?php echo ( $uriModule == 'contact') ? 'active'  : '' ?>">
                <a href="index.html"><i class="fa fa-address-card-o" aria-hidden="true"></i> <span class="nav-label"><?php echo translate('cms_lang.sidebar.sb_contact', $language) ?></span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo base_url('backend/contact/catalogue/index') ?>"><?php echo translate('cms_lang.sidebar.sb_contactCatalogue', $language) ?></a></li>

                    <li><a href="<?php echo base_url('backend/contact/contact/index') ?>"><?php echo translate('cms_lang.sidebar.sb_contact', $language) ?></a></li>
                </ul>
            </li>
            <li class="<?php echo ( $uriModule == 'language' || $uriModule == 'system' || $uriModule == 'slide') ? 'active'  : '' ?>">
                <a href="index.html"><i class="fa fa-cog"></i> <span class="nav-label"><?php echo translate('cms_lang.sidebar.sb_setting', $language) ?></span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo base_url('backend/language/language/index') ?>"><?php echo translate('cms_lang.sidebar.sb_language', $language) ?></a></li>

                    <li><a href="<?php echo base_url('backend/slide/slide/index') ?>"><?php echo translate('cms_lang.sidebar.sb_slide', $language) ?></a></li>

                    <li><a href="<?php echo base_url('backend/system/general/index') ?>">Cấu hình chung</a></li>
                    <li><a href="<?php echo base_url('backend/menu/menu/listmenu') ?>">QL Menu</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>