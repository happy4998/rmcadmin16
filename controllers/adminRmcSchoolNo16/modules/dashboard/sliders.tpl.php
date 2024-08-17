<div class="sb2-2">
    <!--== breadcrumbs ==-->
    <div class="sb2-2-2">
        <ul>
            <li><a href="index-2.html"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li class="active-bre"><a href="#">Sliders</a></li>
            <!-- <li class="page-back"><a href="index-2.html"><i class="fa fa-backward" aria-hidden="true"></i> Back</a></li> -->
        </ul>
    </div>

    <!--== Slider Details ==-->
    <div class="sb2-2-3">
        <div class="row">
            <div class="col-md-12">
                <div class="box-inn-sp">
                    <div class="inn-title">
                        <h4>All Sliders</h4>
                        <p>All about our sliders.</p>
                    </div>
                    <div class="tab-inn">
                        <div class="table-responsive table-desi">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Delete</th> <!-- Added Delete Column -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach ($aSliderData as $index => $slider) {
                                        $status = $slider['activated'] == 1 ? 'Active' : 'Inactive';
                                        echo "<tr>
                                                <td>".($index + 1)."</td>
                                                <td><span class='list-img'><img src='{$slider['url']}' alt='Slider Image'></span></td>
                                                <td>
                                                    <form method='POST' action='' onsubmit=\"return confirm('Are you sure you want to delete this slider?');\">
                                                        <input type='hidden' name='delete_id' value='{$slider['id']}'>
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
