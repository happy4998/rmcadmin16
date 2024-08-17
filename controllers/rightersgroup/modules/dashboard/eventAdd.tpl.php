<div class="sb2-2">
    <!--== breadcrumbs ==-->
    <div class="sb2-2-2">
        <ul>
            <li><a href="index-2.html"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li class="active-bre"><a href="#"> Add New Event</a></li>
            <!-- <li class="page-back"><a href="index-2.html"><i class="fa fa-backward" aria-hidden="true"></i> Back</a></li> -->
        </ul>
    </div>

    <!--== User Details ==-->
    <div class="sb2-2-3">
        <div class="row">
            <div class="col-md-12">
                <div class="box-inn-sp admin-form">
                    <div class="inn-title">
                        <h4>Add Event</h4>
                        <p>Here you can add a new event, including title, description, URL, and thumbnail.</p>
                    </div>
                    <div class="tab-inn">
                        <form method="POST" enctype="multipart/form-data" action="">
                            <!-- Ensure the action attribute is empty to use the current script -->
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="text" id="title" name="title" class="validate" required>
                                    <label for="title">Title</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="description" name="description" class="materialize-textarea" required></textarea>
                                    <label for="description">Video Description</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="text" id="url" name="url" class="validate" required>
                                    <label for="url">Video URL</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="file-field input-field col s12">
                                    <div class="btn admin-upload-btn">
                                        <span>Video Thumbnail</span>
                                        <input type="file" name="thumbnail" accept=".jpg, .jpeg, .png" required>
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" placeholder="Event Thumbnail">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="waves-effect waves-light btn-large waves-input-wrapper">
                                        <input type="submit" class="waves-button-input" value="Add Event">
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
