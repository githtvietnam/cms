<div class="va-list-tour-panel">
    <div class="uk-container uk-container-center">
        <div class="va-wrapper">
            <div class="mid-title va-title">
                <h1 class="va-title-main">Lịch khởi hành tour tổng hợp</h1>
            </div>
            <div class="va-mid-content">
                <div class="va-the-content mb30">
                    <div>Click tên tour để xem chương trình, giá tour chi tiết, để tìm tour nhanh hơn, bạn có thể chọn “Điểm khởi hành” - “Điểm đến” hoặc “Loại tour” và tìm kiếm</div>
                </div>
                <div class="va-tour-search">
                    <form name="search_tour">
                        <div class="va-choose-tour mb10">
                            <ul class=" uk-flex uk-flex-middle uk-flex-space-between uk-flex-wrap">
                                <?php if(isset($listLocation) && is_array($listLocation) && count($listLocation)){
                                    foreach ($listLocation as $key => $value) {
                                 ?>
                                    <li>
                                        <label class="check-radio check_location">
                                            <input type="radio" name="zone_id" value="<?php echo check_isset($value['id']) ?>">
                                            <span class="style-check"></span>
                                            <?php echo check_isset($value['title']) ?>
                                        </label>
                                    </li>
                                <?php }} ?>
                            </ul>
                        </div>
                        <div class="va-tour-detail">
                            <div class="uk-grid uk-grid-small un-grid-width-small-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-4 uk-clearfix">
                                <div class="va-grid-wrap">
                                    <div class="va-tour-body">
                                        <?php echo form_dropdown('start', $start, set_value('start', (isset($tour['start'])) ? $tour['start'] : 0), 'class="form-control select2 m-b "  id="start"');?>
                                    </div>
                                </div>
                                <div class="va-grid-wrap">
                                    <div class="va-tour-body">
                                        <?php echo form_dropdown('end', $end, set_value('end', (isset($tour['end'])) ? $tour['end'] : 0), 'class="form-control select2 m-b end check_end"  id="end"');?>
                                    </div>
                                </div>
                                <div class="va-grid-wrap">
                                    <div class="va-tour-body">
                                        <?php echo form_dropdown('start_at', [], set_value('start_at', (isset($tour['start_at'])) ? $tour['start_at'] : 0), 'class="form-control select2 m-b start_at"  id="start_at"');?>
                                    </div>
                                </div>
                                <div class="va-grid-wrap">
                                    <div class="va-tour-body">
                                        <button type="submit" class="btn va-btn-tour"><span><i class="fa fa-search" aria-hidden="true"></i>Tìm tour</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="va-table-list">
                    <table>
                        <thead>
                            <tr>
                                <td><div class="text-center">STT</div></td>
                                <td>Tên tour</td>
                                <td>Thời gian</td>
                                <td>Giá tour<br>(VNĐ/Khách)</td>
                                <td width="30%">Ngày đi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if (isset($object) && is_array($object) && count($object)) {
                                    $count = 1;
                                    foreach ($object as $key => $value) {
                             ?>
                                <tr>
                                    <td>
                                        <div class="text-center"><?php echo check_isset($count) ?></div>
                                    </td>
                                    <td><strong class="fs14"><a href="<?php echo BASE_URL.check_isset($value['canonical']).HTSUFFIX ?>" target="_blank"><?php echo check_isset($value['tour_title']) ?></a></strong><div class="ribbon"><div class="rib" style="background-color: #d82727;  border-color: #d82727">TOUR TẾT ÂM LỊCH</div></div> <span class="i-hot"><img src="https://luhanhvietnam.com.vn/tour-du-lich/modules/tour/images/hot-icon.gif" alt="Hot" class="i-hot"></span></td>
                                    <td nowrap=""><?php echo check_isset($value['number_days']) ?> Ngày</td>
                                    <td nowrap=""><?php echo check_isset($value['price']) ?>  đ</td>
                                    <td><?php echo check_isset($value['day_start']) ?></td>
                                </tr>
                            <?php $count++;}}else{ ?>
                                <tr>
                                    <td colspan="100%"><span class="text-danger">Không có dữ liệu phù hợp...</span></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div id="pagination" class="va-num-page">
                        <?php echo (isset($pagination)) ? $pagination : ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>