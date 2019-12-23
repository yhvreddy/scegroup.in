<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      SubCategory
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">SubCategory</li>
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
              <h3 class="box-title">Add SubCategory</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(isset($subcategoriesdata) && count($subcategoriesdata) != 0){
              //print_r($subcategoriesdata)
            ?>
              <form role="form" method="post" action="<?=base_url('cpanel/dashboard/subcategories/saveEditsubdetails')?>" enctype="multipart/form-data">
                <div class="box-body">
                  <input type="hidden" name="edit_id" value="<?=$subcategoriesdata[0]->id?>">
                  <div class="form-group">
                    <label for="category_name">Select Category Name</label>
                    <select class="form-control" name="category_name" id="category_name">
                      <option value="">Select Category Name</option>
                      <?php foreach ($categories as $key => $category) { ?>
                        <option <?php if($subcategoriesdata[0]->category_id == $category->id){ ?> selected <?php } ?> value="<?=$category->id?>"><?=$category->category_name?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="subcategory_name">SubCategory Name</label>
                    <input type="text" class="form-control" name="subcategory_name" id="subcategory_name" value="<?=$subcategoriesdata[0]->sub_category_name?>" placeholder="Enter SubCategory Name">
                  </div>
                  <div class="form-group">
                    <label for="Price">Price</label>
                    <input type="text" class="form-control" name="Price" id="Price" placeholder="Enter Price" value="<?=$subcategoriesdata[0]->price?>">
                  </div>
                  <div class="form-group">
                    <label for="Price">Qunatity</label>
                    <input type="tel" class="form-control" name="Qunatity" id="Qunatity" placeholder="Enter Qunatity" value="<?=$subcategoriesdata[0]->quantity?>">
                  </div>
                  <div class="form-group">
                    <label for="CategoryImages">Upload SubCategory Image <span class="text-danger">*</span></label>
                    <input type="file" id="CategoryImages" name="CategoryImages" accept=".png,.jpg,.jpeg">

                    <p class="help-block">Upload SubCategory image (.png,.jpg,.jpeg).</p>
                    <?php if(!empty($subcategoriesdata[0]->image)){ ?>
                      <b>uploaded Image</b>
                      <img src="<?=base_url($subcategoriesdata[0]->image)?>" width="100%">
                  <?php } ?>
                  <input type="hidden" name="uploaded_image" value="<?=$subcategoriesdata[0]->image?>">
                  </div>
                  <div class="form-group">
                    <label for="Information">Information</label>
                    <textarea class="form-control" id="BannerInformation" name="Information" placeholder="Enter Information" rows="4">
                      <?=$subcategoriesdata[0]->information?>
                    </textarea>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary pull-right">Add SubCategory</button>
                </div>
              </form>
            <?php }else{ ?>
              <form role="form" method="post" action="<?=base_url('cpanel/dashboard/savesubcategories')?>" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
                    <label for="category_name">Select Category Name</label>
                    <select class="form-control" name="category_name" id="category_name">
                      <option value="">Select Category Name</option>
                      <?php foreach ($categories as $key => $category) { ?>
                        <option value="<?=$category->id?>"><?=$category->category_name?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="subcategory_name">SubCategory Name</label>
                    <input type="text" class="form-control" name="subcategory_name" id="subcategory_name" placeholder="Enter SubCategory Name">
                  </div>
                  <div class="form-group">
                    <label for="CategoryImages">Upload SubCategory Image <span class="text-danger">*</span></label>
                    <input type="file" id="CategoryImages" name="CategoryImages" accept=".png,.jpg,.jpeg">
                    <p class="help-block">Upload SubCategory image (.png,.jpg,.jpeg).</p>
                  </div>
                  <div class="form-group">
                    <label for="Information">Information</label>
                    <textarea class="form-control" id="BannerInformation" name="Information" placeholder="Enter Information" rows="4"></textarea>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary pull-right">Add SubCategory</button>
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
                <th>Category</th>
                <th>Sub Category</th>
                <th class="text-center">Image</th>
                <th></th>
              </thead>
              <tbody>
                <?php $i = 1; foreach ($subcategories as $key => $subcategory) { ?>
                  <tr>
                    <td><?=$i++;?></td>
                    <td>
                      <?php
                        $CategoryName = $this->Model_default->select_data('ks_categories',array('id'=>$subcategory->category_id),'id DESC');
                        print_r($CategoryName[0]->category_name);
                      ?>
                    </td>
                    <td><?=$subcategory->sub_category_name?></td>
                    <td align="center"><?php if(!empty($subcategory->image)){ ?> <img src="<?=base_url($subcategory->image)?>" style="width:40px"> <?php }else{ ?> No Image Uplaoded <?php } ?></td>
                    <td>
                      <a href="<?=base_url('cpanel/dashboard/subcategories/'.$subcategory->id.'/edit')?>"  onclick="return confirm('You want to edit SubCategory..?');"><i class="fa fa-edit"></i></a>&nbsp;
                      <a href="<?=base_url('cpanel/dashboard/subcategories/'.$subcategory->id.'/delete')?>" onclick="return confirm('You want to delete SubCategory..?');"><i class="fa fa-trash-o"></i></a>
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