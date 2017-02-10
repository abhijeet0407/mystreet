<aside id="s-main-menu" class="sidebar">
                <div class="smm-header">
                    <i class="zmdi zmdi-long-arrow-left" data-ma-action="sidebar-close"></i>
                </div>

                <ul class="smm-alerts">
                    <li data-user-alert="sua-messages" data-ma-action="sidebar-open" data-ma-target="user-alerts">
                        <i class="zmdi zmdi-email"></i>
                    </li>
                    <li data-user-alert="sua-notifications" data-ma-action="sidebar-open" data-ma-target="user-alerts">
                        <i class="zmdi zmdi-notifications"></i>
                    </li>
                    <li data-user-alert="sua-tasks" data-ma-action="sidebar-open" data-ma-target="user-alerts">
                        <i class="zmdi zmdi-view-list-alt"></i>
                    </li>
                </ul>

                <ul class="main-menu">
                    <li class="active">
                        <a href="<?php echo url('/home') ?>"><i class="zmdi zmdi-home"></i> Home</a>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:void(0)" data-ma-action="submenu-toggle"><i class="zmdi zmdi-pin"></i>Manage Locations</a>

                        <ul>
                            <li><a href="<?php echo url('/location') ?>">Locations</a></li>
                            <li><a href="<?php echo url('/location/create') ?>">Add Location </a></li>
                        </ul>
                    </li>


                    <li class="sub-menu">
                        <a href="javascript:void(0)" data-ma-action="submenu-toggle"><i class="zmdi zmdi-local-dining"></i>Manage Cuisines</a>

                        <ul>
                            <li><a href="<?php echo url('/cuisine') ?>">Cuisine</a></li>
                            <li><a href="<?php echo url('/cuisine/create') ?>">Add Cuisine </a></li>
                        </ul>
                    </li>



                    <li class="sub-menu">
                        <a href="javascript:void(0)" data-ma-action="submenu-toggle"><i class="zmdi zmdi-account"></i>Manage Customers</a>

                        <ul>
                            <li><a href="<?php echo url('/customer') ?>">Customers</a></li>
                            <li><a href="<?php echo url('/customer/create') ?>">Add Customer </a></li>
                        </ul>
                    </li>


                   
                    
                    
                </ul>
 </aside>