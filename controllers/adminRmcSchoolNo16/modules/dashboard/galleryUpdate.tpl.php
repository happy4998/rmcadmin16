<div class="sb2-2">
    <!--== breadcrumbs ==-->
    <div class="sb2-2-2">
        <ul>
            <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li class="active-bre"><a href="#"> Edit Image</a></li>
            <!-- <li class="page-back"><a href="#"><i class="fa fa-backward" aria-hidden="true"></i> Back</a></li> -->
        </ul>
    </div>

    <!--== User Details ==-->
    <div class="sb2-2-3">
        <div class="row">
            <div class="col-md-12">
                <div class="box-inn-sp admin-form">
                    <div class="inn-title">
                        <h4>Edit Image</h4>
                        <p>Here you can edit your Images.</p>
                    </div>
                    <div class="tab-inn">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col s12">
                                    <span>Title</span>
                                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($aGalleryData[0]['title']); ?>" class="validate" required>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col s12">
                                    <span>Image Description</span>
                                    <textarea id="description" name="description" class="materialize-textarea" required><?php echo htmlspecialchars($aGalleryData[0]['description']); ?></textarea>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="file-field input-field col s12">
                                    <div class="btn admin-upload-btn">
                                        <span>Image Thumbnail</span>
                                        <input type="file" name="thumbnail" accept=".jpg, .jpeg, .png">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" placeholder="Image" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <span>Status</span>
                                    <select id="status" name="status" class="browser-default">
                                        <option value="1" <?php echo ($aGalleryData[0]['activated'] == 1) ? 'selected' : ''; ?>>Active</option>
                                        <option value="0" <?php echo ($aGalleryData[0]['activated'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <!-- Button Container -->
                                    <div class="button-container">
                                        <i class="waves-effect waves-light btn-large waves-input-wrapper"><input type="submit" class="waves-button-input" value="Update"></i>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add custom CSS styles for the buttons -->
<style>
.button-container {
    display: flex;
    gap: 10px;
    align-items: center;
}

.small-btn {
    font-size: 0.75rem; /* Smaller font size */
    padding: 0.5rem 1rem; /* Smaller padding */
}
</style>
