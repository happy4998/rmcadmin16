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
                        <!-- Thumbnail dimension requirement -->
                        <p><strong>Note:</strong> Thumbnail dimension should be 400x400 pixels.</p>
                    </div>
                    <div class="tab-inn">
                        <form id="eventForm" method="POST" enctype="multipart/form-data" action="">
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
                                        <input type="file" name="thumbnail" id="thumbnail" accept=".jpg, .jpeg, .png" required>
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

<script>
    document.getElementById('eventForm').addEventListener('submit', async function(event) {
        const fileInput = document.getElementById('thumbnail');
        const file = fileInput.files[0];

        if (file) {
            const img = new Image();
            img.src = URL.createObjectURL(file);

            // Prevent form submission until image dimensions are checked
            event.preventDefault();

            img.onload = function() {
                if (img.width !== 400 || img.height !== 400) {
                    alert('Thumbnail must be 400x400 pixels, Please use this to resize your image: https://www.reduceimages.com/');
                    URL.revokeObjectURL(img.src); // Clean up
                } else {
                    // If dimensions are correct, manually submit the form
                    document.getElementById('eventForm').submit();
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
