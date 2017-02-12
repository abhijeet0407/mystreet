<?php include(base_path().'/resources/views/include/doctype.php') ?>
    
<?php include(base_path().'/resources/views/include/header.php') ?>    


        <section id="main">
            <?php include(base_path().'/resources/views/include/nav.php') ?>

            <section id="content">
                <div class="container">
                 
                <!-- cards containers -->
                <div class="card">
                  <div class="card-header">  
                    <h2>Vendor</h2>
                    <small class="text-danger">Fields marked in * are required</small>
                  </div>
                  <?php if(!isset($vendor)){ ?>
                  <form class="form-horizontal" role="form" method="POST" action="<?php echo url('/vendor') ?>"> 
                  <?php }else{

                  
                   ?>
                  <form class="form-horizontal" role="form" method="POST" action="<?php echo url('/vendor/'.$vendor->user_id) ?>"> 
                    <input type="hidden" name="_method" value="PATCH">
                  <?php  } ?>      
                        <?php echo csrf_field() ?>
                  <div class="card-body card-padding">

                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <input type="text" name="name" value="<?php echo (isset($vendor))?old('name',$vendor->name):old('name') ?>" class="input-sm form-control fg-input" required>
                                <label class="fg-label">Vendor*</label>
                            </div>
                        </div>

                        <div class="form-group fg-float m-t-20">
                            <div class="fg-line">
                                <input type="email" name="email" <?php echo (isset($vendor))?'disabled':''; ?> value="<?php echo (isset($vendor))?old('email',$vendor->email):old('email') ?>" class="input-sm form-control fg-input" required>
                                <label class="fg-label">Email Address*</label>
                            </div>
                        </div>

                        <div class="form-group fg-float  m-t-20">
                            <div class="fg-line">
                                <input type="password" name="password" value="" class="input-sm form-control fg-input" >
                                <label class="fg-label">Password*</label>
                            </div>
                            <?php if(isset($vendor)){ ?>
                            <div><input type="checkbox" value="1" name="change_password_check" >Check to change password</div>
                            <?php } ?>
                        </div>


                        <div class="form-group fg-float  m-t-20">
                            <div class="fg-line">
                                <input type="text" name="phone" value="<?php echo (isset($vendor))?old('phone',$vendor->phone):old('phone') ?>" class="input-sm form-control fg-input" required>
                                <label class="fg-label">Mobile Number*</label>
                            </div>
                        </div>

                        <div class="form-group  m-t-20">
                        	<label class="fg-label">Address*</label>
                            <div class="fg-line">
                                <textarea name="address"  class="input-sm form-control fg-input" required><?php echo (isset($vendor))?old('address',$vendor->address):old('address') ?></textarea>
                                
                            </div>
                        </div>



                       

                        <div class="form-group m-t-20">
                        <label class="fg-label">Location*</label>
                            <div class="fg-line">
                                <div class="select">
                                    <select name="location" class="form-control">
                                        <option value="">Select Location</option>
                                      <?php  foreach($location as $loc){ ?>
                                                <option <?php if(isset($vendor)){ echo ($loc->id==$vendor->location_id)?'selected':''; } ?> value="<?php echo $loc->id ?>"><?php echo $loc->location ?></option>
                                       <?php  } ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="form-group m-t-20">
                        	<label class="fg-label">Cuisine*</label>
                            <div class="clearfix"></div>
                            <div class="row">
                            <?php  foreach($cuisine as $cus){ ?>
                                <div class="col-sm-4 toggle-border m-b-20">
                                    <div class="toggle-switch" data-ts-color="red">
                                        <label for="ts<?php echo $cus->id ?>" class="ts-label"><?php echo $cus->cuisine; ?></label>
                                        <input id="ts<?php echo $cus->id ?>" <?php if(isset($vendor)){ $cuss=$vendor->cuisines->find($cus->id); if(isset($cuss)){ echo 'checked';} } ?> type="checkbox" hidden="hidden" name="cuisine_vendor[]" value="<?php echo $cus->id ?>">
                                        <label for="ts<?php echo $cus->id ?>" class="ts-helper"></label>
                                    </div>
                                </div>     
                                       <?php  } ?>
	                        </div>
                        </div>   



                        <div class="form-group m-t-20">
                            <label class="fg-label">Location Delivered*</label>
                            <div class="clearfix"></div>
                            <div class="row">
                            <?php  foreach($location as $loc){ ?>
                                <div class="col-sm-4 toggle-border m-b-20">
                                    <div class="toggle-switch" data-ts-color="red">
                                        <label for="tsl<?php echo $loc->id ?>" class="ts-label"><?php echo $loc->location; ?></label>
                                        <input id="tsl<?php echo $loc->id ?>" type="checkbox" hidden="hidden" <?php if(isset($vendor)){ $cuss=$vendor->locations->find($loc->id); if(isset($cuss)){ echo 'checked';} } ?> name="location_vendor[]" value="<?php echo $loc->id ?>">
                                        <label for="tsl<?php echo $loc->id ?>" class="ts-helper"></label>
                                    </div>
                                </div>     
                                       <?php  } ?>
                            </div>
                        </div>               


                        

                        <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect">Submit</button>

                        <a href="<?php echo url('vendor') ?>" class="btn btn-info btn-sm m-t-10 m-l-20 waves-effect">Cancel</a>

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

