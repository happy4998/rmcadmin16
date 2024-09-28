<div class="sb2-2">
    <!--== breadcrumbs ==-->
    <div class="sb2-2-2">
        <ul>
            <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li class="active-bre"><a href="<?php echo getConfig('siteUrl').'/dashboard/category'?>"> Manage Category</a></li>
            <li class="active-bre"><a href="#"> Add New Category</a></li>
            <!-- <li class="page-back"><a href="#"><i class="fa fa-backward" aria-hidden="true"></i> Back</a></li> -->
        </ul>
    </div>

    <!--== User Details ==-->
    <div class="sb2-2-3">
        <div class="row">
            <div class="col-md-12">
                <div class="box-inn-sp admin-form">
                    <div class="inn-title">
                        <h4>Add Category</h4>
                        <!-- <p>Here you can add a new Image. <strong>Note:</strong> Image dimensions should be 400x400 pixels.</p> -->
                    </div>
                    <div class="tab-inn">
                        <form id="imageForm" method="POST" enctype="multipart/form-data" action="">
                            <!-- Ensure the action attribute is empty to use the current script -->
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="text" id="title" name="title" class="validate" required>
                                    <label for="title">Title</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="waves-effect waves-light btn-large waves-input-wrapper">
                                        <input type="submit" class="waves-button-input" value="Add Category">
                                    </i>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>