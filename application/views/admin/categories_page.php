<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Category
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Category</li>
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
              <h3 class="box-title">Add /edit Category</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(isset($categorydata) && count($categorydata) != 0){ ?>
              <form role="form" method="post" action="<?=base_url('cpanel/dashboard/categories/saveEditdetails')?>" enctype="multipart/form-data">
              <div class="box-body">
                <input type="hidden" name="edit_id" value="<?=$categorydata[0]->id?>">
                <div class="form-group">
                  <label for="category_name">Category Name</label>
                  <input type="text" class="form-control" name="category_name" id="category_name" value="<?=$categorydata[0]->category_name?>" placeholder="Enter Category Name">
                </div>
                <div class="form-group">
                  <label for="CategoryImages">Upload Category Image</label>
                  <input type="file" id="CategoryImages" name="CategoryImages" accept=".png,.jpg,.jpeg">

                  <p class="help-block">Upload Category image (.png,.jpg,.jpeg).</p>
                  <?php if(!empty($categorydata[0]->image)){ ?>
                      <b>uploaded Image</b>
                      <img src="<?=base_url($categorydata[0]->image)?>" width="100%">
                  <?php } ?>
                  <input type="hidden" name="uploaded_image" value="<?=$categorydata[0]->image?>">
                </div>

                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Add Category</button>
              </div>
            </form>
            <?php }else{ ?>
              <form role="form" method="post" action="<?=base_url('cpanel/dashboard/savecategories')?>" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter Category Name">
                  </div>
                  <div class="form-group">
                    <label for="CategoryImages">Upload Category Image</label>
                    <input type="file" id="CategoryImages" name="CategoryImages" accept=".png,.jpg,.jpeg">

                    <p class="help-block">Upload Category image (.png,.jpg,.jpeg).</p>
                  </div>

                  
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary pull-right">Add Category</button>
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
              <h3 class="box-title">Categories List</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <table class="table table-striped table-bordered">
              <thead>
                <th>#</th>
                <th>Category Name</th>
                <th class="text-center">Category Image</th>
                <th></th>
              </thead>
              <tbody>
                <?php $i = 1; foreach ($categories as $key => $category) { ?>
                  <tr>
                    <td><?=$i++;?></td>
                    <td><?=$category->category_name?></td>
                    <td align="center"><?php if(!empty($category->image)){ ?> <img src="<?=base_url($category->image)?>" style="width:40px"> <?php }else{ ?> No Image Uplaoded <?php } ?></td>
                    <td>
                      <a href="<?=base_url('cpanel/dashboard/categories/'.$category->id.'/edit')?>" onclick="return confirm('Are you want to edit category..?')"><i class="fa fa-edit"></i></a>&nbsp;
                      <a href="<?=base_url('cpanel/dashboard/categories/'.$category->id.'/delete')?>" onclick="return confirm('Are you want to delete category..?')"><i class="fa fa-trash-o"></i></a>
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