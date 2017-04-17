<?php include(base_path().'/resources/views/include/doctype.php') ?>
    
<?php include(base_path().'/resources/views/include/header.php') ?>    


        <section id="main">
            <?php include(base_path().'/resources/views/include/nav.php') ?>

            <section id="content">
                <div class="container">
                 
                <!-- cards containers -->
                <div class="card">
                  <div class="card-header">  
                    <h2>Create Menu</h2>
                    <small class="text-danger">Fields marked in * are required</small>
                  </div>
                  <?php if(!isset($menu)){ ?>
                  <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo url('/menu') ?>"> 
                  <?php }else{

                  
                   ?>
                  <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo url('/menu/'.$menu->id) ?>"> 
                    <input type="hidden" name="_method" value="PATCH">
                  <?php  } ?>      
                        <?php echo csrf_field() ?>
                  <div class="card-body card-padding">

                        <div class="form-group ">
                        <label class="fg-label">Vendor*</label>
                            <div class="fg-line">
                                <div class="select">
                                    <select name="vendor" class="form-control">
                                        <option value="">Select Vendor</option>
                                      <?php if(isset($vendor)){  foreach($vendor as $ven){ ?>
                                                <option <?php if(isset($menu)){ echo ($ven->id==$menu->vendor_id)?'selected':''; }  ?> value="<?php echo $ven->id ?>"><?php echo $ven->name ?></option>
                                       <?php  } } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group fg-float m-t-20">
                            <div class="fg-line">
                                <input type="text" name="menu" value="<?php echo (isset($menu))?old('menu',$menu->menu):old('menu') ?>" class="input-sm form-control fg-input" required>
                                <label class="fg-label">Menu*</label>
                            </div>
                        </div>

                        <div class="form-group fg-float m-t-20">
                            <div class="">
                            <label class="">Menu Description*</label>
                                <textarea required="required" class="form-control" name="description"><?php echo (isset($menu))?old('menu',$menu->description):old('description') ?></textarea>
                                
                                
                            </div>
                        </div>

                        <div class="input-group input-group-sm fg-float m-t-20">
                            <span class="input-group-addon text-sm"><small>Rs.</small></span>
                            <div class="fg-line">
                                <input type="text" name="price" value="<?php echo (isset($menu))?old('price',$menu->price):old('price') ?>" class="input-sm form-control fg-input" required>
                                <label class="fg-label">Price*</label>
                            </div>
                        </div>

                        


                        <div class="form-group m-t-20">
                        <label class="fg-label">Menu Type*</label>
                            <div class="fg-line">
                                <div class="select">
                                    <select name="menu_type" class="form-control">
                                        <option <?php if(isset($menu)){ echo ('1'==$menu->menu_type)?'selected':''; } ?> value="1">Breakfast</option>

                                                <option <?php if(isset($menu)){ echo ('2'==$menu->menu_type)?'selected':''; } ?> value="2">Lunch/Dinner</option>
                                       
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="form-group fg-float">
                        <label class="">Menu Image*</label>
                            <div class="">
                            <input type="file" name="image" />

                                <?php if(isset($menu)){ if($menu->image != ""){ ?>
                                <div class="col-md-6 m-t-15 image_container">
                                 <input type="hidden" name="prev_image" class="image_val" value="<?php echo (isset($menu))?old('location',$menu->image):old('image') ?>">
                           
                                  <a href="javascript:void(0)" class="btn btn-xs delete_image btn-danger">X</a>
                                  <img src="<?php echo  asset('storage/menu/'.$menu->image); ?>" />
                                </div>
                                <?php } } ?>
                            </div>
                        </div>



                        <div class="form-group m-t-20">
                            <label class="fg-label">Select Filter*</label>
                            <div class="clearfix"></div>
                            <div class="row">
                            <?php  foreach($menufilter as $menuf){ ?>
                                <div class="col-sm-4 toggle-border m-b-20">
                                    <div class="toggle-switch" data-ts-color="red">
                                        <label for="tsl<?php echo $menuf->id ?>" class="ts-label"><?php echo $menuf->menufilter; ?></label>
                                        <input id="tsl<?php echo $menuf->id ?>" type="checkbox" hidden="hidden" <?php if(isset($menu)){ $cuss=$menu->menufilter->find($menuf->id); if(isset($cuss)){ echo 'checked';} } ?> name="menu_menufilter[]" value="<?php echo $menuf->id ?>">
                                        <label for="tsl<?php echo $menuf->id ?>" class="ts-helper"></label>
                                    </div>
                                </div>     
                                       <?php  } ?>
                            </div>
                        </div> 

                        

                        <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect">Submit</button>

                        <a href="<?php echo url('menu') ?>" class="btn btn-info btn-sm m-t-10 m-l-20 waves-effect">Cancel</a>

                  </div>
                 </form> 
                </div>
                <!-- card containers -->

                </div>
            </section>

          <script type="text/javascript">
              
              jQuery(document).ready(function($) {

                



                <?php if (count($errors) > 0){
                        foreach ($errors->all() as $error){
                 ?>
                        notify22('<?php echo $error; ?>','danger')
                                  
                            <?php } ?>
                        
                <?php } ?>




                function notify22(message, type){
                        $.growl({
                            message: message
                        },{
                            type: type,
                            allow_dismiss: false,
                            label: 'Cancel',
                            className: 'btn-xs btn-inverse',
                            placement: {
                                from: 'top',
                                align: 'right'
                            },
                            delay: 4500,
                            animate: {
                                    enter: 'animated fadeInDown',
                                    exit: 'animated fadeOutUp'
                            },
                            offset: {
                                x: 20,
                                y: 25
                            }
                        });
                };



              });   


          </script>

<?php include(base_path().'/resources/views/include/footer.php') ?>


<script type="text/javascript">
    
    jQuery(document).ready(function($) {
        /*tinymce*/
                tinymce.init({
                  selector: 'textarea',
                  height: 500,
                  menubar: false,
                  plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste code'
                  ],
                  toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                 setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        }
                });
                /*tinymce*/
    });



</script>



