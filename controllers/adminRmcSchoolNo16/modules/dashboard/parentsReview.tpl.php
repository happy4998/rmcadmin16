<div class="sb2-2">
    <!--== breadcrumbs ==-->
    <div class="sb2-2-2">
        <ul>
            <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li class="active-bre"><a href="#">Manage Parent Reviews</a></li>
        </ul>
    </div>

    <!--== Review Details ==-->
    <div class="sb2-2-3">
        <div class="row">
            <div class="col-md-12">
                <div class="box-inn-sp">
                    <div class="inn-title d-flex justify-content-between align-items-center">
                        <div>
                            <h4>All Reviews</h4>
                            <p>All about Parent Reviews.</p>
                        </div>
                        <!--== Add Review Button ==-->
                        <div class="add-review-btn">
                            <a href="<?php echo getConfig('siteUrl').'/dashboard/parentsreviewadd'; ?>" class="btn btn-primary">Add Review</a>
                        </div>
                    </div>
                    
                    <div class="tab-inn">
                        <div class="table-responsive table-desi">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach ($aReviewData as $index => $review) {
                                        echo "<tr>
                                                <td>".($index + 1)."</td>
                                                <td><span class='list-img'><img src='{$review['url']}' alt='Review Thumbnail'></span></td>
                                                <td>{$review['name']}</td>
                                                <td>{$review['description']}</td>
                                                <td>
                                                    <form method='POST' action='' onsubmit=\"return confirm('Are you sure you want to delete this review?');\">
                                                        <input type='hidden' name='delete_id' value='{$review['id']}'>
                                                        <button type='submit' class='btn btn-danger' style='background:none; border:none; padding:0;'>
                                                            <i class='fa fa-trash'></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>";
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
