<div class="sb2-2">
    <!--== breadcrumbs ==-->
    <div class="sb2-2-2">
        <ul>
            <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li class="active-bre"><a href="<?php echo getConfig('siteUrl').'/dashboard/parentsreview'; ?>"> Manage Parent Reviews</a></li>
            <li class="active-bre"><a href="#"> Add New Review</a></li>
        </ul>
    </div>

    <!--== Add Review Form ==-->
    <div class="sb2-2-3">
        <div class="row">
            <div class="col-md-12">
                <div class="box-inn-sp admin-form">
                    <div class="inn-title">
                        <h4>Add Review</h4>
                        <p>Here you can add a new review.</p>
                    </div>
                    <div class="tab-inn">
                        <form method="POST" enctype="multipart/form-data" action="" id="reviewForm">
                            <!-- Ensure the action attribute is empty to use the current script -->
                            
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="text" name="name" id="name" required>
                                    <label for="name">Name</label>
                                </div>
                                <div class="input-field col s12">
                                    <textarea id="description" name="description" class="materialize-textarea" required></textarea>
                                    <label for="description">Description</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="file-field input-field col s12">
                                    <div class="btn admin-upload-btn">
                                        <span>Upload Image</span>
                                        <input type="file" name="thumbnail" accept=".jpg, .jpeg, .png" id="thumbnail" required>
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" placeholder="Image">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="waves-effect waves-light btn-large waves-input-wrapper">
                                        <input type="submit" class="waves-button-input" value="Add Review">
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
document.getElementById('reviewForm').addEventListener('submit', function(e) {
    var fileInput = document.getElementById('thumbnail');
    var file = fileInput.files[0];

    if (file) {
        var img = new Image();
        img.src = URL.createObjectURL(file);

        img.onload = function() {
            var width = img.width;
            var height = img.height;

            if (width !== 100 || height !== 100) {
                e.preventDefault();
                alert('The image dimensions must be exactly 100x100 pixels. Please use this to resize your image: https://www.reduceimages.com/');
            }

            URL.revokeObjectURL(img.src); // Clean up
        };

        img.onerror = function() {
            e.preventDefault();
            alert('Failed to load image. Please select a valid image file.');
            URL.revokeObjectURL(img.src); // Clean up
        };
    } else {
        e.preventDefault();
        alert('Please select an image file to upload.');
    }
});
</script>
