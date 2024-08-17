<div class="sb2-2">
    <!--== breadcrumbs ==-->
    <div class="sb2-2-2">
        <ul>
            <li><a href="index-2.html"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li class="active-bre"><a href="#"> Add New Slider</a></li>
        </ul>
    </div>

    <!--== User Details ==-->
    <div class="sb2-2-3">
        <div class="row">
            <div class="col-md-12">
                <div class="box-inn-sp admin-form">
                    <div class="inn-title">
                        <h4>Add Slider</h4>
                        <p>Here you can add a new slider.</p>
                        <!-- Slider dimension requirement -->
                        <p><strong>Note:</strong> Slider dimension should be 1366x768 pixels.</p>
                    </div>
                    <div class="tab-inn">
                        <form method="POST" enctype="multipart/form-data" action="" id="sliderForm">
                            <!-- Ensure the action attribute is empty to use the current script -->
                            
                            <div class="row">
                                <div class="file-field input-field col s12">
                                    <div class="btn admin-upload-btn">
                                        <span>Upload Slider</span>
                                        <input type="file" name="thumbnail" accept=".jpg, .jpeg, .png" id="thumbnail" required>
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" placeholder="Slider">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="waves-effect waves-light btn-large waves-input-wrapper">
                                        <input type="submit" class="waves-button-input" value="Add Slider">
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
document.getElementById('sliderForm').addEventListener('submit', function(e) {
    var fileInput = document.getElementById('thumbnail');
    var file = fileInput.files[0];

    if (file) {
        var img = new Image();
        img.src = URL.createObjectURL(file);

        img.onload = function() {
            var width = img.width;
            var height = img.height;

            if (width !== 1366 || height !== 768) {
                e.preventDefault();
                alert('The image dimensions must be exactly 1366x768 pixels, Please use this to resize your image: https://www.reduceimages.com/');
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
