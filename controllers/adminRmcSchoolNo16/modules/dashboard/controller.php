<?php 
 
class dashboardController {
    public $aLayout = array('home'=>'main','event'=>'main','eventadd'=>'main','eventupdate'=>'main','sliders'=>'main','slideradd'=>'main','parentsreview'=>'main','parentsreviewadd'=>'main','gallery'=>'main','galleryadd'=>'main','galleryupdate'=>'main','category'=>'main','categoryadd'=>'main','categoryupdate'=>'main');
    public $aLoginRequired = array('home'=>true,'event'=>true,'eventadd'=>true,'eventupdate'=>true,'sliders'=>true,'slideradd'=>true,'parentsreview'=>true,'parentsreviewadd'=>true,'gallery'=>true,'galleryadd'=>true,'galleryupdate'=>true,'category'=>true,'categoryadd'=>true,'categoryupdate'=>true);
    private $dbConfig=[];
    public function __construct() 
    {
        global $sAction;
        global $oUser;
        global $oSession;
        if($this->aLoginRequired[$sAction])
        {                   
                if(!$oUser->isLoggedin())
                {  
                    redirect(getConfig('siteUrl').'/'.getConfig('loginModule').'/'.getConfig('loginAction'));
                }
        }
        $this->dbConfig=array(
            'dbHost' => getConfig('dbHost'),
            'dbUser' => getConfig('dbUser'),
            'dbPassword' => getConfig('dbPassword'),
            'dbName' => getConfig('dbName')
        );
    }
    public function callHome()
    {
        require ('home.tpl.php');
    }

    public function callEvent() {
        // Define initial conditions for existing lists
        $aGallery = array('*');
        $sCondition = "type='video'";
    
        // Instantiate Lists object and retrieve existing lists from the database
        $oSchool = new school($this->dbConfig);
    
        // Handle the deletion
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $deleteId = intval($_POST['delete_id']);
            $deleteQuery = "DELETE FROM gallery WHERE id=" . $deleteId;
            $oSchool->executeQuery($deleteQuery);
    
            // Redirect to prevent form resubmission
            header('Location: ' . getConfig('siteUrl') . '/dashboard/event');
            exit();
        }
    
        $aGalleryData = $oSchool->getschool('gallery', $aGallery, $sCondition);
    
        require('event.tpl.php');
    }
    
    public function callEventUpdate() {
        // Define initial conditions for existing lists
        $aGallery = array('*');
        $sCondition = "id=" . $_GET['id'];
    
        // Instantiate Lists object and retrieve existing lists from the database
        $oSchool = new school($this->dbConfig);
        $aGalleryData = $oSchool->getschool('gallery', $aGallery, $sCondition);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve current values
            $currentData = $aGalleryData[0];
            
            // Initialize variables
            $title = isset($_POST['title']) ? str_replace("'", " ", htmlspecialchars($_POST['title'])) : $currentData['title'];
            $description = isset($_POST['description']) ? str_replace("'", " ", htmlspecialchars($_POST['description'])) : $currentData['description'];
            $url = isset($_POST['url']) ? htmlspecialchars($_POST['url']) : $currentData['url'];
            $status = isset($_POST['status']) ? intval($_POST['status']) : $currentData['activated'];
            $thumbnailPath = $currentData['thumbnail'];
    
            // Handle file upload
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['thumbnail']['tmp_name'];
                $fileName = $_FILES['thumbnail']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
    
                $allowedExtensions = array('jpg', 'jpeg', 'png');
                if (in_array($fileExtension, $allowedExtensions)) {
                    // Define the upload path
                    $uploadFileDir = getConfig('rootDir') . '/web/adminRmcSchoolNo16/thumbnails/';
                    $dest_path = $uploadFileDir . $fileName;
    
                    // Move the file to the upload directory
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $thumbnailPath = getConfig('siteUrl') . '/thumbnails/' . $fileName; // Update the thumbnail path
                    }
                }
            }
    
            // Construct SQL query for update
            $updateFields = [];
            if ($title !== $currentData['title']) {
                $updateFields[] = "title='" . $title . "'";
            }
            if ($description !== $currentData['description']) {
                $updateFields[] = "description='" . $description . "'";
            }
            if ($url !== $currentData['url']) {
                $updateFields[] = "url='" . $url . "'";
            }
            if ($thumbnailPath !== $currentData['thumbnail']) {
                $updateFields[] = "thumbnail='" . $thumbnailPath . "'";
            }
            if ($status !== $currentData['activated']) {
                $updateFields[] = "activated=" . $status;
            }
    
            if (!empty($updateFields)) {
                $updateQuery = "UPDATE gallery SET " . implode(", ", $updateFields) . " WHERE id=" . $_GET['id'];
                $oSchool->executeQuery($updateQuery); // Assuming executeQuery is a method to execute raw SQL queries
            }
    
            // Redirect or show a success message
            header('Location: ' . getConfig('siteUrl') . '/dashboard/event');
            exit();
        }
    
        require('eventUpdate.tpl.php');
    }

    public function callEventAdd() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $title = isset($_POST['title']) ? str_replace("'", " ", htmlspecialchars($_POST['title'])) : '';
            $description = isset($_POST['description']) ? str_replace("'", " ", htmlspecialchars($_POST['description'])) : '';
            $url = isset($_POST['url']) ? htmlspecialchars($_POST['url']) : '';
            $thumbnailPath = '';
    
            // Handle file upload
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['thumbnail']['tmp_name'];
                $fileName = $_FILES['thumbnail']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
    
                $allowedExtensions = array('jpg', 'jpeg', 'png');
                if (in_array($fileExtension, $allowedExtensions)) {
                    
                    // Use getConfig to get the base URL or directory
                    $uploadFileDir = getConfig('rootDir') . '/web/adminRmcSchoolNo16/thumbnails/';
                    $dest_path = $uploadFileDir . $fileName;

                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $thumbnailPath = getConfig('siteUrl') . '/thumbnails/'.$fileName; 
                    }
                }
            }
            
            // Prepare data for insertion
            $sTable = 'gallery';
            $aFields = ['title', 'type', 'description', 'url', 'thumbnail', 'activated'];
            $aData = [
                [$title, 'video', $description, $url, "".$thumbnailPath."", 1] // 1 for active
            ];
    
            // Insert the data into the database
            $oSchool = new school($this->dbConfig);
            $oSchool->insertRecords($sTable, $aFields, $aData);
    
            // Redirect or show a success message
            header('Location: ' . getConfig('siteUrl') . '/dashboard/event');
            exit();
        }
    
        require('eventAdd.tpl.php');
    }

    public function callSliders() {
        // Define initial conditions for existing sliders
        $aSlider = array('*');
        $sCondition = "1"; // Adjust if you need specific conditions
        
        // Instantiate Lists object and retrieve existing sliders from the database
        $oSchool = new school($this->dbConfig);
        
        // Handle the deletion
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $deleteId = intval($_POST['delete_id']);
            $deleteQuery = "DELETE FROM sliders WHERE id=" . $deleteId;
            $oSchool->executeQuery($deleteQuery);
        
            // Redirect to prevent form resubmission
            header('Location: ' . getConfig('siteUrl') . '/dashboard/sliders');
            exit();
        }
        
        // Fetch slider data
        $aSliderData = $oSchool->getschool('sliders', $aSlider, $sCondition);
        
        // Include the template for displaying sliders
        require('sliders.tpl.php');
    }    

    public function callSlideradd() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $thumbnailPath = '';
            
            // Handle file upload
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['thumbnail']['tmp_name'];
                $fileName = $_FILES['thumbnail']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
        
                $allowedExtensions = array('jpg', 'jpeg', 'png');
                if (in_array($fileExtension, $allowedExtensions)) {
                    
                    // Use getConfig to get the base URL or directory
                    $uploadFileDir = getConfig('rootDir') . '/web/adminRmcSchoolNo16/sliders/';
                    $dest_path = $uploadFileDir . $fileName;
        
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $thumbnailPath = getConfig('siteUrl') . '/sliders/' . $fileName; 
                    }
                }
            }
            
            // Prepare data for insertion
            $sTable = 'sliders'; // Ensure this is the correct table name for sliders
            $aFields = ['url', 'activated'];
            $aData = [
                [$thumbnailPath, 1] // 1 for active
            ];
        
            // Insert the data into the database
            $oSchool = new school($this->dbConfig);
            $oSchool->insertRecords($sTable, $aFields, $aData);
        
            // Redirect or show a success message
            header('Location: ' . getConfig('siteUrl') . '/dashboard/sliders');
            exit();
        }
    
        require('slidersAdd.tpl.php');
    }

    public function callParentsReview() {
        // Define initial conditions for existing reviews
        $aReview = array('*');
        $sCondition = "1"; // Adjust if you need specific conditions
        
        // Instantiate Lists object and retrieve existing reviews from the database
        $oSchool = new school($this->dbConfig);
        
        // Handle the deletion
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $deleteId = intval($_POST['delete_id']);
            $deleteQuery = "DELETE FROM parentsreview WHERE id=" . $deleteId;
            $oSchool->executeQuery($deleteQuery);
        
            // Redirect to prevent form resubmission
            header('Location: ' . getConfig('siteUrl') . '/dashboard/parentsreview');
            exit();
        }
        
        // Fetch review data
        $aReviewData = $oSchool->getschool('parentsreview', $aReview, $sCondition);
        
        // Include the template for displaying reviews
        require('parentsReview.tpl.php');
    }    
    
    public function callParentsReviewAdd() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $thumbnailPath = '';
            
            // Handle file upload
            // if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == UPLOAD_ERR_OK) {
            //     $fileTmpPath = $_FILES['thumbnail']['tmp_name'];
            //     $fileName = $_FILES['thumbnail']['name'];
            //     $fileNameCmps = explode(".", $fileName);
            //     $fileExtension = strtolower(end($fileNameCmps));
        
            //     $allowedExtensions = array('jpg', 'jpeg', 'png');
            //     if (in_array($fileExtension, $allowedExtensions)) {
                    
            //         // Use getConfig to get the base URL or directory
            //         $uploadFileDir = getConfig('rootDir') . '/web/adminRmcSchoolNo16/images/parentsReview/';
            //         $dest_path = $uploadFileDir . $fileName;
        
            //         if (move_uploaded_file($fileTmpPath, $dest_path)) {
            //             $thumbnailPath = getConfig('siteUrl') . '/images/parentsReview/' . $fileName; 
            //         }
            //     }
            // }
            
            // Prepare data for insertion
            $sTable = "parentsreview"; // Ensure this is the correct table name for reviews
            $aFields = ["name", "description"];

            // $url = $thumbnailPath;
            $name = str_replace("'", "", $_POST["name"]);
            $description = str_replace("'", "", $_POST["description"]);

            $aData = [
                [$name, $description]
            ];
        // print_r("'".$_POST['name']."'");
            // Insert the data into the database
            $oSchool = new school($this->dbConfig);
            $oSchool->insertRecords($sTable, $aFields, $aData);
        
            // Redirect or show a success message
            header('Location: ' . getConfig('siteUrl') . '/dashboard/parentsreview');
            exit();
        }
        
        // Include the template for adding a review
        require('parentsReviewAdd.tpl.php');
    }
    
    
    public function callGallery() {
        // Define initial conditions for existing lists
        $aGallery = array('category.*,gallery.*');
        $sCondition = " gallery.type='img'";
    
        // Instantiate Lists object and retrieve existing lists from the database
        $oSchool = new school($this->dbConfig);
    
        // Handle the deletion
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $deleteId = intval($_POST['delete_id']);
            $deleteQuery = "DELETE FROM gallery WHERE id=" . $deleteId;
            $oSchool->executeQuery($deleteQuery);
    
            // Redirect to prevent form resubmission
            header('Location: ' . getConfig('siteUrl') . '/dashboard/event');
            exit();
        }
    
        $aGalleryData = $oSchool->getJobAndschool('category','gallery', $aGallery, $sCondition);
        // $aGalleryData = $oSchool->getschool('gallery', $aGallery, $sCondition);
    
        require('gallery.tpl.php');
    }
    
    public function callGalleryUpdate() {
        // Define initial conditions for existing lists
        $aGallery = array('*');
        $sCondition = "id=" . intval($_GET['id']); // Sanitize input
    
        // Instantiate Lists object and retrieve existing lists from the database
        $oSchool = new school($this->dbConfig);
        $aGalleryData = $oSchool->getschool('gallery', $aGallery, $sCondition);
    
        // Retrieve categories for dropdown
        $aCategory = array('*');
        $sCategoryCondition = "activated=1"; // You can refine this condition as needed
        $aCategoryData = $oSchool->getschool('category', $aCategory, $sCategoryCondition);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve current values
            $currentData = $aGalleryData[0];
    
            // Initialize variables
            $title = isset($_POST['title']) ? str_replace("'", " ", htmlspecialchars($_POST['title'])) : $currentData['title'];
            $categoryId = isset($_POST['category']) ? intval($_POST['category']) : $currentData['id_category'];
            $status = isset($_POST['status']) ? intval($_POST['status']) : $currentData['activated'];
            $thumbnailPath = $currentData['thumbnail'];
    
            // Handle file upload
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['thumbnail']['tmp_name'];
                $fileName = $_FILES['thumbnail']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
    
                $allowedExtensions = array('jpg', 'jpeg', 'png');
                if (in_array($fileExtension, $allowedExtensions)) {
                    // Define the upload path
                    $uploadFileDir = getConfig('rootDir') . '/web/adminRmcSchoolNo16/thumbnails/';
                    $dest_path = $uploadFileDir . $fileName;
    
                    // Move the file to the upload directory
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $thumbnailPath = getConfig('siteUrl') . '/thumbnails/' . $fileName; // Update the thumbnail path
                    }
                }
            }
    
            // Construct SQL query for update
            $updateFields = [];
            if ($title !== $currentData['title']) {
                $updateFields[] = "title='" . $title . "'";
            }
            if ($categoryId !== $currentData['id_category']) {
                $updateFields[] = "id_category=" . intval($categoryId); // Sanitize input
            }
            if ($thumbnailPath !== $currentData['thumbnail']) {
                $updateFields[] = "thumbnail='" . $thumbnailPath . "'";
            }
            if ($status !== $currentData['activated']) {
                $updateFields[] = "activated=" . intval($status); // Sanitize input
            }
    
            if (!empty($updateFields)) {
                $updateQuery = "UPDATE gallery SET " . implode(", ", $updateFields) . " WHERE id=" . intval($_GET['id']); // Sanitize input
                $oSchool->executeQuery($updateQuery); // Assuming executeQuery is a method to execute raw SQL queries
            }
    
            // Redirect or show a success message
            header('Location: ' . getConfig('siteUrl') . '/dashboard/gallery');
            exit();
        }
    
        require('galleryUpdate.tpl.php');
    }
    

    public function callGalleryAdd() {
        $oSchool = new school($this->dbConfig);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $title = isset($_POST['title']) ? str_replace("'", " ", htmlspecialchars($_POST['title'])) : '';
            $thumbnailPath = '';
    
            // Handle file upload
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['thumbnail']['tmp_name'];
                $fileName = $_FILES['thumbnail']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
    
                $allowedExtensions = array('jpg', 'jpeg', 'png');
                if (in_array($fileExtension, $allowedExtensions)) {
                    
                    // Use getConfig to get the base URL or directory
                    $uploadFileDir = getConfig('rootDir') . '/web/adminRmcSchoolNo16/thumbnails/';
                    $dest_path = $uploadFileDir . $fileName;

                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $thumbnailPath = getConfig('siteUrl') . '/thumbnails/'.$fileName; 
                    }
                }
            }
            
            $aCatagory = array('id');
            $sCondition = " category_name='".$_POST['category']."'";

            $aCatagoryDataId = $oSchool->getschool('category', $aCatagory, $sCondition);
            // print_r($aCatagoryDataId);
            // Prepare data for insertion
            $sTable = 'gallery';
            $aFields = ['title', 'type', 'id_category', 'thumbnail', 'activated'];
            $aData = [
                [$title, 'img', $aCatagoryDataId[0]['id'], "".$thumbnailPath."", 1] // 1 for active
            ];
    
            // Insert the data into the database
            $oSchool->insertRecords($sTable, $aFields, $aData);
    
            // Redirect or show a success message
            header('Location: ' . getConfig('siteUrl') . '/dashboard/gallery');
            exit();
        }

        $aCatagory = array('*');
        $sCondition = " 1=1";

        $aCatagoryData = $oSchool->getschool('category', $aCatagory, $sCondition);
    // print_r($aCatagoryData);
        require('galleryAdd.tpl.php');
    }
    
    public function callCategory() {
        // Define initial conditions for existing lists
        $aGallery = array('*');
        $sCondition = "1=1";
    
        // Instantiate Lists object and retrieve existing lists from the database
        $oSchool = new school($this->dbConfig);
    
        // Handle the deletion
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $deleteId = intval($_POST['delete_id']);
            $deleteQuery = "DELETE FROM category WHERE id=" . $deleteId;
            $oSchool->executeQuery($deleteQuery);
    
            // Redirect to prevent form resubmission
            header('Location: ' . getConfig('siteUrl') . '/dashboard/category');
            exit();
        }
    
        $aGalleryData = $oSchool->getschool('category', $aGallery, $sCondition);
    
        require('category.tpl.php');
    }
    
    public function callCategoryUpdate() {
        // Define initial conditions for existing lists
        $aGallery = array('*');
        $sCondition = "id=" . $_GET['id'];
    
        // Instantiate Lists object and retrieve existing lists from the database
        $oSchool = new school($this->dbConfig);
        $aGalleryData = $oSchool->getschool('category', $aGallery, $sCondition);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve current values
            $currentData = $aGalleryData[0];
            
            // Initialize variables
            $title = isset($_POST['category_name']) ? str_replace("'", " ", htmlspecialchars($_POST['category_name'])) : $currentData['category_name'];
            $status = isset($_POST['status']) ? intval($_POST['status']) : $currentData['activated'];
    
            // Construct SQL query for update
            $updateFields = [];
            if ($title !== $currentData['category_name']) {
                $updateFields[] = "category_name='" . $title . "'";
            }
            if ($status !== $currentData['activated']) {
                $updateFields[] = "activated=" . $status;
            }
    
            if (!empty($updateFields)) {
                $updateQuery = "UPDATE category SET " . implode(", ", $updateFields) . " WHERE id=" . $_GET['id'];
                $oSchool->executeQuery($updateQuery); // Assuming executeQuery is a method to execute raw SQL queries
            }
    
            // Redirect or show a success message
            header('Location: ' . getConfig('siteUrl') . '/dashboard/category');
            exit();
        }
    
        require('categoryUpdate.tpl.php');
    }

    public function callCategoryAdd() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $title = isset($_POST['title']) ? str_replace("'", " ", htmlspecialchars($_POST['title'])) : '';
    
            // Prepare data for insertion
            $sTable = 'category';
            $aFields = ['category_name', 'activated'];
            $aData = [
                [$title, 1] // 1 for active
            ];
    
            // Insert the data into the database
            $oSchool = new school($this->dbConfig);
            $oSchool->insertRecords($sTable, $aFields, $aData);
    
            // Redirect or show a success message
            header('Location: ' . getConfig('siteUrl') . '/dashboard/category');
            exit();
        }
    
        require('categoryAdd.tpl.php');
    }
}