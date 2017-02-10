
<?php include(base_path().'/resources/views/include/doctype.php') ?>
    
<?php include(base_path().'/resources/views/include/header.php') ?>    


        <section id="main">
            <?php include(base_path().'/resources/views/include/nav.php') ?>
            <?php $module='cuisine'; ?>
            <script type="text/javascript">
            var module='cuisine';
            jQuery(document).ready(function($) {
            	$('a[data-table]').attr('data-table','cuisine');
            });
            	
            </script>
            <section id="content">
                <div class="container">
                 
                <!-- cards containers -->
                <div class="card">
                        <form method="GET">
                        <div class="action-header palette-Teal-400 bg clearfix">
                            <div class="ah-label hidden-xs palette-White text"><?php echo $module; ?></div>
                            <?php $search_display=''; $q=''; $bgcolor=''; if(isset($_REQUEST['q'])){ $q=$_REQUEST['q']; $search_display='style="display:block"'; $bgcolor='palette-Teal bg'; }?>
                            
                            <div class="ah-search" <?php echo $search_display; ?>>
                                
                                <input name="q" type="text" placeholder="Start typing..." class="ahs-input search_text" value="<?php echo $q; ?>">
                                

                                <i class="ah-search-close zmdi zmdi-long-arrow-left" data-ma-action="ah-search-close"></i>
                            </div>


                            <ul class="ah-actions actions a-alt">
                                <li>
                                    <a data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Search" href="javascript:void(0)" class="ah-search-trigger" data-ma-action="ah-search-open">
                                        <i class="zmdi zmdi-search"></i>
                                    </a>
                                </li>

                              	<li>
                                      <a class="alt_menu  <?php echo $bgcolor; ?>" data-table="" data-toggle="tooltip"  data-placement="bottom" title="" data-original-title="Add" href="<?php echo $module.'/create'; ?>"><i class="zmdi zmdi-plus-circle"></i></a>
                                </li>
                                
                                <li>
                                      <a class="alt_menu bulkDelete <?php echo $bgcolor; ?>" data-table="" data-toggle="tooltip" data-token="<?php echo csrf_token(); ?>" data-placement="bottom" title="" data-original-title="Bulk delete" href="javascript:void(0)"><i class="zmdi zmdi-minus-circle"></i></a>
                                </li>
                                <li>
                                        <a data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Refresh" class="alt_menu <?php echo $bgcolor; ?>" href="javascript:void(0)"><i class="zmdi zmdi-refresh-alt"></i></a>
                                </li>
                                        
                                    </ul>
                                </li> 
                            </ul>
                        </div>
                        </form>
                        <div class="list-group lg-alt lg-even-black">
                            <?php if(count($datas)==0){ ?>

                                <div  class="list-group-item media">
                                

                                

                                <div class="media-body">
                                    <div class="lgi-heading">No data to list.</div>
                                    
                                </div>
                            </div>


                            <?php } ?>

                            <?php $i=1; foreach($datas as $data){ ?>

                            <div rel="<?php echo $data->id; ?>" class="list-group-item media">
                                <div class="pull-right">
                                    
                                       		<a rel="<?php echo $data->id; ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View" href="javascript:void(0)" class="btn view_cart btn-xs palette-Orange btn-icon bg waves-effect waves-circle waves-float m-r-10"><i class="zmdi zmdi-eye"></i></a>
                                            <a data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit" href="<?php echo $module.'/'.$data->id.'/'.'edit' ?>" class="btn btn-xs palette-Cyan btn-icon bg waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit"></i></a>
                                            <a href="javascript:void(0)" rel="<?php echo $data->id; ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove" data-table="" data-token="<?php echo csrf_token();  ?>" class="btn singleDelete btn-xs btn-danger m-l-10 btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-delete"></i></a>

                                            
                                       
                                </div>

                                <div class="pull-left">
                                    <div data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Check this box to add this listing to bulk delete" class="avatar-char ac-check">
                                                <input class="acc-check" value="<?php echo $data->id; ?>" type="checkbox">

                                                <span class="acc-helper palette-Teal bg"><?php echo substr($data->cuisine,0,1) ?></span>
                                            </div>
                                    
                                </div>

                                <div class="media-body">
                                    <div class="lgi-heading"><?php echo $data->cuisine; ?></div>
                                   
                                    <!-- <ul class="lgi-attrs">
                                    
                                    	<li></li>
                                        <li></li>
                                        <li></li> 
                                        
                                    </ul> -->
                                </div>
                            </div>
                            <?php $i++;} 


                            ?>
                            

                            

                            

                            

                            

                            
                        </div>

                        <div class="text-center"><?php echo $datas->links(); ?></div>
                    </div>
                <!-- card containers -->

                </div>
            </section>

            <div id="cart_modal" class="modal fade"  id="modalColor" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Location Data</h4>
                                </div>
                                <div class="modal-body">
                                    Loading Data...
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-link waves-effect">Save changes</button> -->
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Close</button>
                                </div>
                        </div>
                </div>
            </div>
            <!-- <script type="text/javascript">
                jQuery(document).ready(function($) {
                    
                    $('body').on('click','.view_cart',function(){	
                    	var cartnumber=$(this).attr('rel');
                    	$('#cart_modal').modal('show');
                    			$.ajax({
                                    url: APP_URL+'/cartdata',
                                    type: 'GET',
                                    data: 'cartnumber='+encodeURIComponent(cartnumber)
                                    
                                })
                                .done(function(data) {
                                    //console.log(data);
                                    $('#cart_modal').find('.modal-body').html(data);
                                   
                                })
                                .fail(function() {
                                    console.log("error");
                                })
                                .always(function() {
                                    console.log("complete");
                                });

                    })
                    
					//bulk delete
                    $('body').on('click','.bulkDelete',function(){
                        //alert('test')

                        if($('.acc-check:checked').length==0){
                            swal("Info!", "Please select the members in the list to delete!", "info")
                        }else{
                            var check_count=$('.acc-check:checked').length;
                            var checked_ids = $('input:checkbox:checked.acc-check').map(function () {
                              return this.value;
                            }).get(); 
                            //console.log(JSON.stringify({bulkids:checked_ids})); 
                            
                            var bel=$(this).attr('data-table');

                            swal({
                              title: "Are you sure?",
                              text: "You want to bulk delete the data!",
                              type: "warning",
                              showCancelButton: true,
                              confirmButtonColor: "#DD6B55",
                              confirmButtonText: "Yes, delete it!",
                              closeOnConfirm: true
                            },
                            function(){
                              

                                var myJsonString = checked_ids.join(",");

                                $.ajax({
                                    url: APP_URL+'/'+bel+'/bulkdelete',
                                    type: 'GET',
                                    data: 'bulkids='+encodeURIComponent(myJsonString)
                                    
                                })
                                .done(function(data) {
                                    console.log(data);
                                    if(data=='deleted'){
                                        $.each(checked_ids, function( index, value ) {

                                             $('.list-group-item[rel="'+value+'"]').remove();

                                        });
                                        window.location.reload();
                                       
                                    }
                                })
                                .fail(function() {
                                    console.log("error");
                                })
                                .always(function() {
                                    console.log("complete");
                                });

                            });  

                        }


                        


                        
                        
                        

                    });


                    
                });
            </script> -->
            

<?php include(base_path().'/resources/views/include/footer.php') ?>

