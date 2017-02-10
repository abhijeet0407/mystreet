<!--  -->
<!-- Profile view -->
    <div class="card c-dark profile-view palette-Blue bg">
        <div class="card-header text-center palette-Blue-400 bg">
            
            <h2 class="m-t-10"><?php foreach($vendor as $ven){ echo  $ven->name; } ?></h2>

            

            
        </div>

        <div class="card-body p-30">
            <div class="list-group lg-alt">
                <div class="media">
                    <div class="pull-left">
                        <i class="pvb-icon zmdi zmdi-phone"></i>
                    </div>
                    <div class="media-body">
                        <div class="f-15">Phone Number</div>
                        <small><?php foreach($vendor as $ven){ echo  $ven->phone; } ?></small>
                    </div>
                </div>

                <div class="media">
                    <div class="pull-left">
                        <i class="pvb-icon zmdi zmdi-email"></i>
                    </div>
                    <div class="media-body">
                        <div class="f-15">Email</div>
                        <small><?php foreach($vendor as $ven){ echo  $ven->email; } ?></small>
                    </div>
                </div>

                <div class="media">
                    <div class="pull-left">
                        <i class="pvb-icon zmdi zmdi-pin"></i>
                    </div>
                    <div class="media-body">
                        <div class="f-15">Address</div>
                        <small><?php foreach($vendor as $ven){ echo  $ven->address; } ?></small>
                    </div>
                </div>
                <div class="media">
                    <div class="pull-left">
                        <i class="pvb-icon zmdi zmdi-local-dining"></i>
                    </div>
                    <div class="media-body">
                        <div class="f-15">Cuisines</div>
                        <small><?php foreach($vendor as $ven){  $ll=$ven->cuisines; 
					count($ll);
					foreach($ll as $loc){ ?>
					<tr><td><?php echo $loc->cuisine.', ';  ?></td></tr>
				<?php	
					 }

				 } ?></small>
                    </div>
                </div>

                <div class="media">
                    <div class="pull-left">
                        <i class="pvb-icon zmdi zmdi-pin"></i>
                    </div>
                    <div class="media-body">
                        <div class="f-15">Locations Delivered</div>
                        <small><?php foreach($vendor as $ven){  $ll=$ven->locations; 
					count($ll);
					foreach($ll as $loc){ ?>
					<tr><td><?php echo $loc->location.', ';  ?></td></tr>
				<?php	
					 }

				 } ?></small>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!--  -->
