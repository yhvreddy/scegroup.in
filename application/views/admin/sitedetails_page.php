<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Site Details
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Site Details</li>
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
              <h3 class="box-title">Add / edit Site Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(isset($sitedetails) && count($sitedetails) != 0){ ?>
                <form role="form" method="post" action="<?=base_url('admin/saveeditsitedetails')?>" enctype="multipart/form-data">
                  <input type="hidden" name="edit_id" value="<?=$sitedetails[0]->id?>">
                  <div class="box-body">
                    <div class="form-group col-md-3">
                        <label for="bannertitle">Site Name <span class="text-danger">*</span></label>
                        <input type="text" placeholder="Enter Site Name" value="<?=$sitedetails[0]->site_name?>" class="form-control" required name="site_name">
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="bannertitle">Domain Name <span class="text-danger">*</span></label>
                        <input type="text" placeholder="Enter Domain Name" value="<?=$sitedetails[0]->site_url?>" class="form-control" required name="domain_name">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="exampleInputFile">Upload Logo </label>
                      <input type="file" id="exampleInputFile" name="SiteLogo" accept=".png">
                      <input type="hidden" name="Uploaded_image" value="<?=$sitedetails[0]->site_logo?>">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Enter State <span class="text-danger">*</span></label>
                        <input type="text" value="<?=$sitedetails[0]->state?>" placeholder="Enter State" class="form-control" required name="state_name">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Enter City <span class="text-danger">*</span></label>
                        <input type="text" value="<?=$sitedetails[0]->city?>" placeholder="Enter City" class="form-control" required name="city_name">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Enter Address <span class="text-danger">*</span></label>
                        <input type="text" value="<?=$sitedetails[0]->address?>" placeholder="Enter Address" class="form-control" required name="address">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Enter Pincode <span class="text-danger">*</span></label>
                        <input type="tel" maxlength="6" value="<?=$sitedetails[0]->pincode?>" placeholder="Enter Pincode" class="form-control" required name="pincode">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Email id <span class="text-danger">*</span></label>
                        <input type="email" value="<?=$sitedetails[0]->email_id?>" placeholder="Enter Email id" class="form-control" required name="mail_id">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Enter Mobile Number <span class="text-danger">*</span></label>
                        <input type="text" placeholder="Image Title" value="<?=$sitedetails[0]->mobile?>" class="form-control" required name="mobile">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Facebook Link <span class="text-danger">*</span></label>
                        <input type="url" placeholder="Facebook Link" value="<?=$sitedetails[0]->facebook?>" class="form-control" name="facebook_link">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Instagram Link <span class="text-danger">*</span></label>
                        <input type="url" placeholder="Instagram Link" value="<?=$sitedetails[0]->instagram?>" class="form-control" name="instagram_link">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Linkedin Link <span class="text-danger">*</span></label>
                        <input type="url" placeholder="Linkedin Link" class="form-control" value="<?=$sitedetails[0]->linkedin?>" name="linkedin_link">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Twitter Link <span class="text-danger">*</span></label>
                        <input type="url" value="<?=$sitedetails[0]->twitter?>" placeholder="Twitter Link" class="form-control" name="twitter_link">
                    </div>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Update Site Details</button>
                  </div>
                </form>
            <?php }else{ ?>
                <form role="form" method="post" action="<?=base_url('admin/savesitedetails')?>" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group col-md-3">
                        <label for="bannertitle">Site Name <span class="text-danger">*</span></label>
                        <input type="text" placeholder="Enter Site Name" class="form-control" required name="site_name">
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="bannertitle">Domain Name <span class="text-danger">*</span></label>
                        <input type="text" placeholder="Enter Domain Name" class="form-control" required name="domain_name">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="exampleInputFile">Upload Logo </label>
                      <input type="file" id="exampleInputFile" name="SiteLogo" accept=".png">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Enter State <span class="text-danger">*</span></label>
                        <input type="text" placeholder="Enter State" class="form-control" required name="state_name">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Enter City <span class="text-danger">*</span></label>
                        <input type="text" placeholder="Enter City" class="form-control" required name="city_name">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Enter Address <span class="text-danger">*</span></label>
                        <input type="text" placeholder="Enter Address" class="form-control" required name="address">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Enter Pincode <span class="text-danger">*</span></label>
                        <input type="tel" maxlength="6" placeholder="Enter Pincode" class="form-control" required name="pincode">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Email id <span class="text-danger">*</span></label>
                        <input type="email" placeholder="Enter Email id" class="form-control" required name="mail_id">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Enter Mobile Number <span class="text-danger">*</span></label>
                        <input type="text" placeholder="Image Title" class="form-control" required name="mobile">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Facebook Link <span class="text-danger">*</span></label>
                        <input type="url" placeholder="Facebook Link" class="form-control" name="facebook_link">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Instagram Link <span class="text-danger">*</span></label>
                        <input type="url" placeholder="Instagram Link" class="form-control" name="instagram_link">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Linkedin Link <span class="text-danger">*</span></label>
                        <input type="url" placeholder="Linkedin Link" class="form-control" name="linkedin_link">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bannertitle">Twitter Link <span class="text-danger">*</span></label>
                        <input type="url" placeholder="Twitter Link" class="form-control" name="twitter_link">
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Save Site Details</button>
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