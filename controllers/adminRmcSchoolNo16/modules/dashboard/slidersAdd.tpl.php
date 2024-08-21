<div class="sb2-2">
    <!--== breadcrumbs ==-->
    <div class="sb2-2-2">
        <ul>
            <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li class="active-bre"><a href="<?php echo getConfig('siteUrl').'/dashboard/sliders'?>"> Manage Sliders</a></li>
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
    document.getElementById('sliderForm').addEventListener('submit', async function(event) {
        const fileInput = document.getElementById('thumbnail');
        const file = fileInput.files[0];

        if (file) {
            const img = new Image();
            img.src = URL.createObjectURL(file);

            // Prevent form submission until image dimensions are checked
            event.preventDefault();

            img.onload = function() {
                if (img.width !== 1366 || img.height !== 768) {
                    alert('Thumbnail must be 1366x768 pixels, Please use this to resize your image: https://www.reduceimages.com/');
                    URL.revokeObjectURL(img.src); // Clean up
                } else {
                    // If dimensions are correct, manually submit the form
                    document.getElementById('sliderForm').submit();
                }
            };

            img.onerror = function() {
                alert('Failed to load image.');
                URL.revokeObjectURL(img.src); // Clean up
            };
        } else {
            alert('Please select a thumbnail image.');
            event.preventDefault(); // Prevent form submission
        }
    });
</script>

