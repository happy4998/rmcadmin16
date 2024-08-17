<!-- Page Header Start -->
<div class="container-xxl py-5 page-header position-relative mb-5">
    <div class="container py-5">
        <h1 class="display-2 text-white animated slideInDown mb-4">Gallery</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Gallery</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Gallery Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Our Gallery</h1>
            <p>Explore our collection of videos and images showcasing our activities and events. Click on the items to view more details.</p>
        </div>

        <!-- Image Gallery -->
        <h2 class="text-center mb-4 mt-5">Image Gallery</h2>
        <div class="row g-4">
            <?php foreach ($aGalleryData as $item): ?>
                <?php if ($item['type'] === 'img'): ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="image-item bg-light rounded">
                            <a href="<?php echo $item['url']; ?>" data-lightbox="gallery" data-title="<?php echo htmlspecialchars($item['title']); ?>">
                                <img class="img-fluid rounded" src="<?php echo $item['thumbnail']; ?>" alt="Image Description">
                            </a>
                            <div class="p-4">
                                <h5 class="mb-3"><?php echo htmlspecialchars($item['title']); ?></h5>
                                <p><?php echo htmlspecialchars($item['description']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Gallery End -->