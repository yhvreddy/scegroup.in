<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Gallery
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Gallery</li>
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
              <h3 class="box-title">Upload Gallery Image</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(isset($bannerdetails) && count($bannerdetails) != 0){ ?>
                <form role="form" method="post" action="<?=base_url('admin/editgallerydetails')?>" enctype="multipart/form-data">
                  <input type="hidden" name="edit_id" value="<?=$bannerdetails[0]->id?>">
                  <div class="box-body">
                    <div class="form-group">
                        <label for="bannertitle">Image Title</label>
                        <input type="text" value="<?=$bannerdetails[0]->title?>" placeholder="Image Title" class="form-control" required name="Image_title">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Banner <span class="text-danger">*</span></label>
                      <input type="file" id="exampleInputFile" name="BannersImages" accept=".png,.jpg,.jpeg">

                      <p class="help-block">Upload Banner images (.png,.jpg,.jpeg) formats only.</p>
                      <?php if(!empty($bannerdetails[0]->image)){ ?>
                        <b>Uploaded Image preview</b>
                        <img src="<?=base_url($bannerdetails[0]->image)?>" style="width: 100%;margin-top:5px">
                      <?php } ?>
                      <input type="hidden" name="Uploaded_image" value="<?=$bannerdetails[0]->image?>">
                    </div>
                    <div class="form-group">
                      <label for="Information">Information</label>
                      <textarea class="form-control" id="BannerInformation" name="Information" placeholder="Enter Information" rows="4"><?=$bannerdetails[0]->information?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="BannerURl">Link</label>
                      <input type="url" class="form-control" name="BannerURl" id="BannerURl" value="<?=$bannerdetails[0]->links?>" placeholder="Enter url">
                    </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Update Gallery Details</button>
                  </div>
                </form>
            <?php }else{ ?>
                <form role="form" method="post" action="<?=base_url('admin/galleryupload')?>" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                        <label for="bannertitle">Image Title</label>
                        <input type="text" placeholder="Image Title" class="form-control" required name="Image_title">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Image <span class="text-danger">*</span></label>
                      <input type="file" id="exampleInputFile" name="BannersImages" accept=".png,.jpg,.jpeg" required="">

                      <p class="help-block">Upload Banner images (.png,.jpg,.jpeg) formats only.</p>
                    </div>
                    <div class="form-group">
                      <label for="Information">Information</label>
                      <textarea class="form-control" id="BannerInformation" name="Information" placeholder="Enter Information" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="BannerURl">Link</label>
                      <input type="url" class="form-control" name="BannerURl" id="BannerURl" placeholder="Enter url">
                    </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Upload Gallery Details</button>
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
              <h3 class="box-title">Banners List</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <table class="table table-striped table-bordered">
              <thead>
                <th>#</th>
                <th>Title/Name</th>
                <th>Banner Image</th>
                <th>Information</th>
                <th></th>
              </thead>
              <tbody>
                <?php $i = 1; foreach ($banners as $key => $banner) { ?>
                  <tr>
                    <td><?=$i++;?></td>
                    <td><?=$banner->title?></td>
                    <td align="center"><img src="<?=base_url($banner->image)?>" style="width:50px"></td>
                    <td><?=$banner->information?></td>
                    <td>
                      <a href="<?=base_url('admin/gallery/'.$banner->id.'/edit')?>" onclick="return confirm('Are you sure to edit gallery details..?')"><i class="fa fa-edit"></i></a>&nbsp;
                      <a href="<?=base_url('cpanel/dashboard/banners/'.$banner->id.'/delete')?>" onclick="return confirm('Are you sure to delete banner details..?')"><i class="fa fa-trash-o"></i></a>
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