<div class="sb2-2">
    <!--== breadcrumbs ==-->
    <div class="sb2-2-2">
        <ul>
            <li><a href="index-2.html"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li class="active-bre"><a href="#">Events</a></li>
            <!-- <li class="page-back"><a href="index-2.html"><i class="fa fa-backward" aria-hidden="true"></i> Back</a></li> -->
        </ul>
    </div>

    <!--== User Details ==-->
    <div class="sb2-2-3">
        <div class="row">
            <div class="col-md-12">
                <div class="box-inn-sp">
                    <div class="inn-title">
                        <h4>All Events</h4>
                        <p>All about our school events including videos and descriptions.</p>
                    </div>
                    <div class="tab-inn">
                        <div class="table-responsive table-desi">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th> <!-- Added Delete Column -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach ($aGalleryData as $index => $event) {
                                        $status = $event['activated'] == 1 ? 'Active' : 'Inactive';
                                        echo "<tr>
                                                <td>".($index + 1)."</td>
                                                <td><span class='list-img'><img src='{$event['thumbnail']}' alt='Event Thumbnail'></span></td>
                                                <td>{$event['title']}</td>
                                                <td>{$event['description']}</td>
                                                <td><span class='label label-".($status == 'Active' ? 'success' : 'danger')."'>{$status}</span></td>
                                                <td><a href='".getConfig('siteUrl')."/dashboard/eventupdate?id={$event['id']}' class='ad-st-view'>Edit</a></td>
                                                <td>
                                                    <form method='POST' action='' onsubmit=\"return confirm('Are you sure you want to delete this event?');\">
                                                        <input type='hidden' name='delete_id' value='{$event['id']}'>
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
