<div class="sb2-2">
    <!--== breadcrumbs ==-->
    <div class="sb2-2-2">
        <ul>
            <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li class="active-bre"><a href="<?php echo getConfig('siteUrl').'/dashboard/gallery'?>"> Manage Gallery</a></li>
            <li class="active-bre"><a href="#"> Add New Image</a></li>
            <!-- <li class="page-back"><a href="#"><i class="fa fa-backward" aria-hidden="true"></i> Back</a></li> -->
        </ul>
    </div>

    <!--== User Details ==-->
    <div class="sb2-2-3">
        <div class="row">
            <div class="col-md-12">
                <div class="box-inn-sp admin-form">
                    <div class="inn-title">
                        <h4>Add Image</h4>
                        <p>Here you can add a new Image. <strong>Note:</strong> Image dimensions should be 400x400 pixels.</p>
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
                            <!-- <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="description" name="description" class="materialize-textarea" required></textarea>
                                    <label for="description">Image Description</label>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="file-field input-field col s12">
                                    <div class="btn admin-upload-btn">
                                        <span>Image</span>
                                        <input type="file" name="thumbnail" id="thumbnail" accept=".jpg, .jpeg, .png" required>
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" placeholder="Image Thumbnail">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="waves-effect waves-light btn-large waves-input-wrapper">
                                        <input type="submit" class="waves-button-input" value="Add Image">
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

<script>
    document.getElementById('imageForm').addEventListener('submit', async function(event) {
        const fileInput = document.getElementById('thumbnail');
        const file = fileInput.files[0];

        if (file) {
            const img = new Image();
            img.src = URL.createObjectURL(file);

            // Prevent form submission until image dimensions are checked
            event.preventDefault();

            img.onload = async function() {
                if (img.width !== 400 || img.height !== 400) {
                    alert('Image must be 400x400 pixels, Please use this to resize your image: https://www.reduceimages.com/');
                } else {
                    // If dimensions are correct, manually submit the form
                    document.getElementById('imageForm').submit();
                }
                URL.revokeObjectURL(img.src); // Clean up
            };
        } else {
            // Handle the case where no file was selected
            alert('Please select an image file.');
            event.preventDefault(); // Prevent form submission
        }
    });
</script>
