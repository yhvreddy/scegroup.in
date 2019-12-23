<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Services
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Services</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-5">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add / edit Services</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(isset($servicedetails) && count($servicedetails) != 0){ ?>
              <form role="form" method="post" action="<?=base_url('admin/uploadeditservicedetails')?>" enctype="multipart/form-data">
                <div class="box-body">
                  <input type="hidden" name="edit_id" value="<?=$servicedetails[0]->id?>">
                  <div class="form-group">
                    <label for="category_name">Service Name</label>
                    <input type="text" class="form-control" name="category_name" id="category_name" value="<?=$servicedetails[0]->name?>" placeholder="Enter Category Name">
                  </div>
                  <div class="form-group">
                    <label for="CategoryImages">Upload Category Image</label>
                    <input type="file" id="CategoryImages" name="CategoryImages" accept=".png,.jpg,.jpeg">

                    <p class="help-block">Upload Category image (.png,.jpg,.jpeg).</p>
                    <?php if(!empty($servicedetails[0]->image)){ ?>
                        <b>uploaded Image</b>
                        <img src="<?=base_url($servicedetails[0]->image)?>" width="100%">
                    <?php } ?>
                    <input type="hidden" name="uploaded_image" value="<?=$servicedetails[0]->image?>">
                  </div>

                  <div class="form-group">
                      <label for="Information">Information</label>
                      <textarea class="form-control" id="BannerInformation" name="Information" placeholder="Enter Information" rows="4"><?=$servicedetails[0]->information?></textarea>
                  </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary pull-right">Edit Service Details</button>
                </div>
            </form>
            <?php }else{ ?>
              <form role="form" method="post" action="<?=base_url('admin/uploadservicedetails')?>" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
                    <label for="category_name">Service Name</label>
                    <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter Category Name">
                  </div>
                  <div class="form-group">
                    <label for="CategoryImages">Upload Service Image</label>
                    <input type="file" id="CategoryImages" name="CategoryImages" accept=".png,.jpg,.jpeg">
                    <p class="help-block">Upload image (.png,.jpg,.jpeg).</p>
                  </div>
                    <div class="form-group">
                        <label for="Information">Information</label>
                        <textarea class="form-control" id="BannerInformation" name="Information" placeholder="Enter Information" rows="4"></textarea>
                    </div>
                  
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary pull-right">Add Service</button>
                </div>
              </form>
            <?php } ?>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-7">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Service List</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <table class="table table-striped table-bordered">
              <thead>
                <th>#</th>
                <th>Service Name</th>
                <th>Service Image</th>
                <th>Information</th>
                <th></th>
              </thead>
              <tbody>
                <?php $i=1; foreach ($services as $key => $service) { ?>
                  <tr>
                    <td><?=$i++;?></td>
                    <td><?=$service->name?></td>
                    <td>
                      <?php
                        if(!empty($service->image)){
                          ?>
                          <img src="<?=base_url($service->image)?>" width="20%">
                          <?php
                        }
                      ?>
                    </td>
                    <td>
                      <?=substr($service->information, 0,50).'...';?>
                    </td>
                    <td>
                      <a href="<?=base_url('admin/service/'.$service->id.'/edit')?>" onclick="return confirm('Are you sure to edit service details..?')"><i class="fa fa-edit"></i></a>&nbsp;
                      <a href="<?=base_url('admin/service/'.$service->id.'/delete')?>" onclick="return confirm('Are you sure to delete service details..?')"><i class="fa fa-trash-o"></i></a>
                    </td>
                  </tr> 
                <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.box -->
          
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->