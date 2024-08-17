 <!--== BODY CONTNAINER ==-->
 <div class="container-fluid sb2">
        <div class="row">
            <div class="sb2-1">
                <!--== USER INFO ==-->
                <div class="sb2-12">
                    <ul>
                        <li><img src="images/placeholder.jpg" alt="">
                        </li>
                        <li>
                            <h5>Victoria Baker <span> Santa Ana, CA</span></h5>
                        </li>
                        <li></li>
                    </ul>
                </div>
                <!--== LEFT MENU ==-->
                <div class="sb2-13">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-image" aria-hidden="true"></i> Manage Sliders</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="<?php echo getConfig('siteUrl').'/dashboard/sliders'?>">Slider</a>
                                    </li>
                                    <li><a href="<?php echo getConfig('siteUrl').'/dashboard/slideradd'?>">Create New Slider</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-calendar" aria-hidden="true"></i> Events</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="<?php echo getConfig('siteUrl').'/dashboard/event'?>">All Events</a>
                                    </li>
                                    <li><a href="<?php echo getConfig('siteUrl').'/dashboard/eventadd'?>">Create New Events</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!--== BODY INNER CONTAINER ==-->