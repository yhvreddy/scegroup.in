<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Reviews
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Reviews</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Reviews List</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <table class="table table-striped table-bordered">
              <thead>
                <th>#</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Review</th>
                <th></th>
              </thead>
              <tbody>
                <?php $i = 1; foreach ($reviews as $key => $review) { 
                    $category = $this->Model_default->select_data('ks_categories',array('id'=>$review->category_id),'id');
                    $subcategory = $this->Model_default->select_data('ks_sub_categories',array('id'=>$review->sub_category_id),'id');
                  ?>
                  <tr>
                    <td><?=$i++;?></td>
                    <td><?=ucwords($category[0]->category_name)?></td>
                    <td><?=ucwords($subcategory[0]->sub_category_name)?></td>
                    <td><?=$review->firstname.'.'.substr($review->lastname,0,1)?></td>
                    <td><?=$review->email_id?></td>
                    <td><?=$review->mobile?></td>
                    <th><?=$review->review?></th>
                    <td>
                      <?php if($review->status == 1){ ?>
                        <a href="<?=base_url('cpanel/dashboard/review/'.$review->id.'/unpublish')?>" style="color:red" onclick="return confirm('Are you sure to Unpublish review..?')"><i class="fa fa-edit"></i></a>
                      <?php }else{ ?>
                        <a href="<?=base_url('cpanel/dashboard/review/'.$review->id.'/publish')?>" style="color:green" onclick="return confirm('Are you sure to publish review..?')"><i class="fa fa-edit"></i></a>
                      <?php } ?>
                      
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.box -->
        </div>
    </div>
      <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->