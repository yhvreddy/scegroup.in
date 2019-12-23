<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      About us
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">About us</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add / edit About us</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(isset($aboutus) && count($aboutus) != 0){ ?>
                <form role="form" method="post" action="<?=base_url('admin/uploadeditaboutdetails')?>" enctype="multipart/form-data">
                  <input type="hidden" name="edit_id" value="<?=$aboutus[0]->id?>">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputFile">Upload About us Image </label>
                      <input type="file" id="exampleInputFile" name="BannersImages" accept=".png,.jpg,.jpeg">
                      <p class="help-block">Upload Banner images (.png,.jpg,.jpeg) formats only.</p>
                      <?php if(!empty($aboutus[0]->image)){ ?>
                        <b>Uploaded Image preview</b>
                        <img src="<?=base_url($aboutus[0]->image)?>" style="width: 5%;margin-top:5px">
                      <?php } ?>
                      <input type="hidden" name="Uploaded_image" value="<?=$aboutus[0]->image?>">
                    </div>
                    <div class="form-group">
                      <label for="Information">About Information</label>
                      <textarea class="form-control" id="BannerInformation" name="Information" placeholder="Enter Information" rows="4"><?=$aboutus[0]->information?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="bannertitle">About Title <span class="text-danger">*</span></label>
                          <input type="text" value="<?=$aboutus[0]->title?>" placeholder="About Title" class="form-control" required name="About_title">
                    </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Update Aboutus Details</button>
                  </div>
                </form>
            <?php }else{ ?>
                <form role="form" method="post" action="<?=base_url('admin/uploadaboutus')?>" enctype="multipart/form-data">
                  <div class="box-body">
                      <div class="form-group">
                          <label for="bannertitle">About Title <span class="text-danger">*</span></label>
                          <input type="text" placeholder="Image Title" class="form-control" required name="About_title">
                      </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Banner </label>
                      <input type="file" id="exampleInputFile" name="BannersImages" accept=".png,.jpg,.jpeg">

                      <p class="help-block">Upload Banner images (.png,.jpg,.jpeg) formats only.</p>
                    </div>
                    <div class="form-group">
                      <label for="Information">Information <span class="text-danger">*</span></label>
                      <textarea class="form-control" id="BannerInformation" name="Information" placeholder="Enter Information" rows="4"></textarea>
                    </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Upload Banner</button>
                  </div>
                </form>
            <?php } ?>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->