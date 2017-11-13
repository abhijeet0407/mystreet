<?php include(base_path().'/resources/views/include/doctype.php') ?>
    
<?php include(base_path().'/resources/views/include/header.php') ?>    


        <section id="main">
            <?php include(base_path().'/resources/views/include/nav.php') ?>

            <section id="content">
                <div class="container">
                 
                <!-- cards containers -->
                <div class="card">
                  <div class="card-header">  
                    <h2>Create Cuisine</h2>
                    <small class="text-danger">Fields marked in * are required</small>
                  </div>
                  <?php if(!isset($cuisine)){ ?>
                  <form class="form-horizontal" role="form" method="POST" action="<?php echo url('/cuisine') ?>"> 
                  <?php }else{

                  
                   ?>
                  <form class="form-horizontal" role="form" method="POST"  enctype="multipart/form-data" action="<?php echo url('/cuisine/'.$cuisine->id) ?>"> 
                    <input type="hidden" name="_method" value="PATCH">
                  <?php  } ?>      
                        <?php echo csrf_field() ?>
                  <div class="card-body card-padding">
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <input type="text" name="cuisine" value="<?php echo (isset($cuisine))?old('cuisine',$cuisine->cuisine):old('cuisine') ?>" class="input-sm form-control fg-input" required>
                                <label class="fg-label">Cuisine*</label>
                            </div>
                        </div>


                        <div class="form-group fg-float">
                        <label class="">Cuisine Image*</label>
                            <div class="">
                            <input type="file" name="cuisine_image" />

                                <?php if(isset($cuisine)){ if($cuisine->cuisine_image != ""){ ?>
                                <div class="col-md-6 m-t-15 image_container">
                                 <input type="hidden" name="prev_cuisine_image" class="image_val" value="<?php echo (isset($cuisine))?old('cuisine',$cuisine->cuisine_image):old('cuisine_image') ?>">
                           
                                  <a href="javascript:void(0)" class="btn btn-xs delete_image btn-danger">X</a>
                                  <img src="<?php echo '/app/storage/app/public/cuisines/'.$cuisine->cuisine_image; ?>" />
                                </div>
                                <?php } } ?>
                            </div>
                        </div>

                        

                        <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect">Submit</button>

                        <a href="<?php echo url('cuisine') ?>" class="btn btn-info btn-sm m-t-10 m-l-20 waves-effect">Cancel</a>

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

