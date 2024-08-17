<?php 
 
class dashboardController {
    public $aLayout = array('home'=>'main','event'=>'main','eventadd'=>'main','eventupdate'=>'main','contactus'=>'main','sliders'=>'main','slideradd'=>'main','gallery'=>'main');
    public $aLoginRequired = array('home'=>false,'event'=>false,'eventadd'=>false,'eventupdate'=>false,'contactus'=>false,'sliders'=>false,'slideradd'=>false,'gallery'=>false);
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
            $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : $currentData['title'];
            $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : $currentData['description'];
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
                    $uploadFileDir = getConfig('rootDir') . '/web/righters_front/thumbnails/';
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
            $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
            $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
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
                    $uploadFileDir = getConfig('rootDir') . '/web/righters_front/thumbnails/';
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
    public function callslideradd() {
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
                    $uploadFileDir = getConfig('rootDir') . '/web/righters_front/sliders/';
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
    
    public function callGallery(){
        // Define initial conditions for existing lists
        $aGallery = array('*');
        $sCondition = "type='img' AND activated=1";

        // Instantiate Lists object and retrieve existing lists from the database
        $oSchool = new school($this->dbConfig);
        $aGalleryData = $oSchool->getschool('gallery',$aGallery, $sCondition);
        // echo getConfig('siteUrl').'/img/school-logo.jpeg';
        require('gallery.tpl.php');
    }
}