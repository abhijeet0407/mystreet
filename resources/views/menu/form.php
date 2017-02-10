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
                  <form class="form-horizontal" role="form" method="POST" action="<?php echo url('/menu') ?>"> 
                  <?php }else{

                  
                   ?>
                  <form class="form-horizontal" role="form" method="POST" action="<?php echo url('/menu/'.$menu->id) ?>"> 
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

                        <div class="input-group input-group-sm fg-float">
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

