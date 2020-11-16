<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Trả lời thắc mắc của khách hàng</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin'); ?>">Home</a>
            </li>
            <li class="active"><strong>Trả lời thắc mắc của khách hàng</strong></li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox"> 
		<table class="table table-striped table-bordered table-hover dataTables-example mt20">
		    <thead>
		    <tr>
		        <th class="text-center">
		            <input type="checkbox" id="checkbox-all">
		            <label for="check-all" class="labelCheckAll"></label>
		        </th>
		        <th class="text-center" style="width:80px">Ưu tiên</th>
		        <th class="medium">Thông tin người gửi</th>
		        <th class="text-center big"> Nội dung gửi</th>
		        <th class="text-center">Thời gian gửi</th>
		        <th class="text-center">Nơi nhận</th>
		        <th class="text-center">Thao tác</th>
		    </tr>
		    </thead>
		    <tbody>

		        <?php if(isset($contactList) && is_array($contactList) && count($contactList)){ ?>
		        <?php foreach($contactList as $key => $val){ ?>

		        
		        <?php  
		            $status = ($val['order'] == 1) ? '<i class="fa fa-star  text-red" data-id="6" data-bookmark="1"></i>'  : '<i class="fa fa-star" data-id="6" data-bookmark="1"></i>';
		        ?>

		        <tr id="post-<?php echo $val['id']; ?>" data-id="<?php echo $val['id']; ?>">
		            <td>
		                <input type="checkbox" name="checkbox[]" value="<?php echo $val['id']; ?>" class="checkbox-item">
		                <div for="" class="label-checkboxitem"></div>
		            </td>
		            <td class="text-center"><?php echo $val['order'] ?></td>
		            <td class="information">
		                <div class="customer-name uk-flex uk-flex-middle uk-flex-space-between">
		                    <div class="user-name"><?php echo $val['fullname']; ?></div>
		                   
		                </div>
		                <div class="customer-detail">
		                    Phone: <?php echo $val['phone']; ?>
		                    <br>
		                    Email: <?php echo $val['email']; ?>
		                    <br>
		                    Địa chỉ: <?php echo $val['address']; ?>
		                </div>
		            </td>
		            <td class="tv text">
		                <div class="tv content line-3"><a href="<?php echo base_url('backend/contact/contact/reply/'.$val['id']) ?>"><?php echo $val['content']; ?></a></div></td>
		            <td class="text-center"><?php echo $val['created_at']; ?></td>
		            <td class="text-center"><?php echo $val['title']; ?></td>
		            <td class="text-center tv">
		                <button class="btn btn-danger btn-sm delete1" id="<?php echo $val['id'] ?>" name="delete" value="delete" type="submit">Xóa</button>
		            </td>
		            
		        </tr>
		        <?php }}else{ ?>
		            <tr>
		                <td colspan="100%"><span class="text-danger">Không có dữ liệu phù hợp...</span></td>
		            </tr>
		        <?php } ?>
		    
		    </tbody>
		</table>
	</div>
</div>