<?php session_start();
    include('includes.php');   
    include('error_reporting.php');   
    if(isLoggedin()){
        $str    				= "select * from tblusers where id = ". $_SESSION['user_id'];
        $strRs  				= Run($str);
        $userRow 				= getRow($strRs); 
        $_SESSION['userRow'] 	=  $userRow; 
        $pageTitle =  $_SESSION['firstname'] .  " " .  $_SESSION['lastname']; 
    }else{
        echo "<script>window.location.href = './login.php';</script>";
        header('Location: login.php');
    }
     
    include('top.php'); 

?>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css" type="text/css" media="all">
    <style>
        .ui-datepicker-year{
            display:none;
        }
    </style>
<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <?php include('sidebar.php') ?>
        <!--end sidebar wrapper -->
        <!--start header -->
        <?php include('header.php') ?>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <?php echo $_SESSION['msg']; $_SESSION['msg'] = ""; ?>
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">User Profile</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                                 
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="container">
                    <div class="main-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="d-flex flex-column align-items-center text-center">
                                            <form method="post" enctype="multipart/form-data" action=""
                                                id="profilePicture" name="profilePicture">
                                                <input type="hidden" name="action" value="update_profile_picture">
                                                <div class="profile-pic">
                                                    <label class="-label" for="file">
                                                        <span class="glyphicon glyphicon-camera"></span>
                                                        <span>Change Image</span>
                                                    </label>
                                                    <input id="file" type="file" name="photo"
                                                        onchange="loadFile(event)" />

                                                    <?php if($userRow['image']!="") {?>
                                                    <img id="output"
                                                        src="user_images/<?php echo $_SESSION['user_id'] ?>/<?php echo $userRow['image'] ?>"
                                                        alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                                    <?php } else{?>
                                                    <img id="output" src="assets/images/avatars/default.png"
                                                        class="user-img" alt="user avatar">
                                                    <?php } ?>
                                                </div>
                                            </form>
                                            <div class="mt-3">
                                                <h4><?php echo $userRow['firstname']." " .$userRow['lastname'] ?></h4>
                                                <p class="text-secondary mb-1"><?php echo $userRow['user_type'] ?></p>

                                                <p class="text-muted font-size-sm">
                                                    <i class="lni lni-map-marker"></i>
                                                    <?php if( $userRow['city']  =="" && $userRow['state']  =="" && $userRow['country']  =="") {echo "N/A"; } ?>
                                                    <?php if( $userRow['city']  !="") { ?>
                                                    <?php echo $userRow['city'] . ", "; } ?>
                                                    <?php if( $userRow['state'] !="") { ?><?php echo $userRow['state'] . ", "; } ?>
                                                    <?php if( $userRow['state'] !="") { ?><?php echo $userRow['country']; } ?>
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-secondary mb-1">
                                                <div
                                                    class="d-flex align-items-center theme-icons  cursor-pointer rounded">
                                                    <?php if( $userRow['phone']!="") { ?>
                                                    <div class="font-22 text-primary"><i
                                                            class="fadeIn animated bx bx-phone"></i></div>
                                                    <div class="ms-2"><a
                                                            href="tel:<?php echo $userRow['phone'] ?>"><?php echo $userRow['phone'] ?></a>
                                                    </div>
                                                    <?php } ?> 
                                                </div> 
                                                <div
                                                    class="d-flex align-items-center theme-icons  cursor-pointer rounded">
                                                    <div class="font-22 text-primary"><i
                                                            class="fadeIn animated bx bx-envelope"></i></div>
                                                    <div class="ms-2"><a
                                                            href="mailto:<?php echo $userRow['email'] ?>"><?php echo $userRow['email'] ?></a>
                                                    </div>
                                                </div>
                                                </p>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body p-4">
                                                <form class="row g-3" method="post" action="process.php">
                                                    <input type="hidden" name="action" value="update_basic_profile">
                                                    <div class="col-md-6">
                                                        <label for="firstname" class="form-label">First Name *</label>
                                                        <input name="firstname" type="text" class="form-control"
                                                            id="firstname" placeholder="First Name"
                                                            value="<?php echo $userRow['firstname']; ?>" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="lastname" class="form-label">Last Name *</label>
                                                        <input name="lastname" type="text" class="form-control"
                                                            id="lastname" placeholder="Last Name"
                                                            value="<?php echo $userRow['lastname']; ?>" required>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="email" class="form-label">Email *</label>
                                                        <input readonly name="email" type="email" class="form-control"
                                                            id="email" placeholder="Email"
                                                            value="<?php echo $userRow['email']; ?>" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="phone" class="form-label">Phone</label>
                                                        <input name="phone" type="text" class="form-control" id="phone"
                                                            placeholder="Phone"
                                                            value="<?php echo $userRow['phone']; ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="dob" class="form-label">DOB *</label>
                                                        <input name="dob" type="text"  class="form-control" id="dob"
                                                            placeholder="Date of Birth"
                                                            value="<?php echo $userRow['dob']; ?>" required>
                                                    </div>
                                                    <?php if($userRow['user_type'] == "Loan Officer") { ?>
                                                    <div class="col-md-12">
                                                        <label for="company" class="form-label">Company</label>
                                                        <input name="company" type="text" class="form-control"
                                                            id="company" placeholder="Company"
                                                            value="<?php echo $userRow['company']; ?>">
                                                    </div>
                                                    <?php } ?> 
                                                    <div class="col-md-2">
                                                        <label for="zip" class="form-label">Zip *</label>
                                                        <input pattern="[0-9]*" name="zip" type="text"
                                                            class="form-control" id="zip" placeholder="Zip"
                                                            value="<?php echo $userRow['zip']; ?>" required>
                                                            <p class="zip-error">Not a real zip code.</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="city" class="form-label">City *</label>
                                                        <input name="city" type="text" class="form-control" id="city"
                                                            placeholder="City" value="<?php echo $userRow['city']; ?>"
                                                            required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="state" class="form-label">State *</label>

                                                        <?php 
                                                        
                                                        $stateError = "";
                                                            $states = array("Alabama","Alaska","Arizona","Arkansas","California",
                                                                                "Colorado","Connecticut","Delaware","District Of Columbia",
                                                                                "Florida","Georgia","Hawaii","Idaho","Illinois","Indiana",
                                                                                "Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland",
                                                                                "Massachusetts",">Michigan","Minnesota","Mississippi","Missouri",
                                                                                "Montana","Nebraska","Nevada","New Hampshire","New Jersey",
                                                                                "New Mexico","New York","North Carolina","North Dakota","Ohio",
                                                                                "Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina",
                                                                                "South Dakota","Tennessee","Texas","Utah","Vermont","Virginia",
                                                                                "Washington","West Virginia","Wisconsin","Wyoming");
                                                            $state_names = array("Alabama","Alaska","Arizona","Arkansas","California",
                                                                        "Colorado","Connecticut","Delaware","District Of Columbia",
                                                                        "Florida","Georgia","Hawaii","Idaho","Illinois","Indiana",
                                                                        "Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland",
                                                                        "Massachusetts",">Michigan","Minnesota","Mississippi","Missouri",
                                                                        "Montana","Nebraska","Nevada","New Hampshire","New Jersey",
                                                                        "New Mexico","New York","North Carolina","North Dakota","Ohio",
                                                                        "Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina",
                                                                        "South Dakota","Tennessee","Texas","Utah","Vermont","Virginia",
                                                                        "Washington","West Virginia","Wisconsin","Wyoming");
                                                                        // we check if the posted state is in the array states
                                                                        
                                                        ?>
                                                        <select name="state" id="state" class="form-select" required>
                                                            <option selected="">Choose...</option>
                                                            <?php
                                                                foreach ($states as $key => $val){
                                                                echo '<option value="'.$val.'" ';
                                                                if ($val===$userRow['state']){
                                                                    // if state was selected remember the position
                                                                    echo " selected ";
                                                                }
                                                                echo '>'.$state_names[$key].'</option>'; 
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="country" class="form-label">Country</label>
                                                        <select name="country" id="country" class="form-select">
                                                            <option>United States</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 hidden">
                                                        <label for="address" class="form-label">Address</label>
                                                        <textarea name="address" class="form-control" id="address"
                                                            placeholder="Address ..."
                                                            rows="3"><?php echo $userRow['address']; ?></textarea>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                                            <button type="submit"
                                                                class="btn btn-primary px-4">Submit</button>
                                                            <button type="reset"
                                                                class="btn btn-light px-4">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                
                                    if($_SESSION['user_type']== "Processor"){ 
                                        
                                   // $processorRow = getProcessorRow();
                                    $processorStr = "SELECT tblusers.id, tblprocessor.* FROM tblusers
                                    JOIN tblprocessor ON tblusers.id = tblprocessor.user_id where tblusers.id = ". $_SESSION['user_id'];  
                                    $processorRs = Run($processorStr);
                                    $processorRow = GetRow($processorRs);
                                        ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body p-4">
                                                <form class="row g-3" method="post" action="process.php">
                                                    <input type="hidden" name="action" value="update_processor_profile">
                                                    <div class="col-md-4">
                                                        <label for="Experience" class="form-label">Experience *</label>
                                                        <select id="experience" name="experience" class="form-select"
                                                            required>
                                                            <option value="" selected="">Choose...</option>
                                                            <option
                                                                <?php if($processorRow['experience'] == "Less than 5 years") {?>
                                                                selected <?php } ?>>Less than 5 years</option>
                                                            <option
                                                                <?php if($processorRow['experience'] == "5 - 10 years") {?>
                                                                selected <?php } ?>>5 - 10 years</option>
                                                            <option
                                                                <?php if($processorRow['experience'] == "10+ years") {?>
                                                                selected <?php } ?>>10+ years</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="licensed" class="form-label">Licensed</label>
                                                        <select id="licensed" name="licensed" class="form-select"
                                                            required>
                                                            <option selected="">Choose...</option>
                                                            <option
                                                                <?php if($processorRow['licensed'] == "Licensed") {?>
                                                                selected <?php } ?>>Licensed</option>
                                                            <option
                                                                <?php if($processorRow['licensed'] == "Not Licensed") {?>
                                                                selected <?php } ?>>Not Licensed</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="nmls" class="form-label">NMLS # *</label>
                                                        <input type="text" class="form-control" name="nmls" id="nmls"
                                                            placeholder="NMLS #" required
                                                            value="<?php echo $processorRow['nmls'] ?>">
                                                    </div>
                                                   
                                                    <div class="col-md-12">
                                                        <label for="specialties" class="form-label">Specialties
                                                            *</label> 

                                                        <select value="<?php echo $processorRow['specialties'] ?>" multiple required id="specialties" name="specialties[]" class="form-select select2" required>
                                                            <option  value="">Choose...</option>
                                                            <option <?php  if (str_contains($processorRow['specialties'], "Income Calculations"))   { echo "selected"; } ?>>Income Calculations</option>
                                                            <option
                                                                <?php if(str_contains($processorRow['specialties'], "Self-Employed Income Calculations")) {?>
                                                                selected <?php } ?>>Self-Employed Income Calculations
                                                            </option>
                                                            <option
                                                                <?php if (str_contains($processorRow['specialties'], "Initial Disclosures")) { ?>
                                                                selected <?php } ?>>Initial Disclosures</option>
                                                            <option
                                                                <?php if (str_contains($processorRow['specialties'], "Closing Documents")) { ?>
                                                                selected <?php } ?>>Closing Documents</option>
                                                            <option
                                                                <?php if (str_contains($processorRow['specialties'], "Purchase Loans")) { ?>
                                                                selected <?php } ?>>Purchase Loans</option>
                                                            <option
                                                                <?php if (str_contains($processorRow['specialties'], "Refinance Loans")) { ?>
                                                                selected <?php } ?> >Refinance Loans</option>
                                                            <option
                                                                <?php if (str_contains($processorRow['specialties'], "Non-QM Loans")) { ?>
                                                                selected <?php } ?> >Non-QM Loans</option>
                                                            <option
                                                                <?php if (str_contains($processorRow['specialties'], "Client Interaction")) { ?>
                                                                selected <?php } ?> >Client Interaction</option>
                                                            <option
                                                                <?php if (str_contains($processorRow['specialties'], "Other")) { ?>
                                                                selected <?php } ?> >Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="work_style" class="form-label">Work Style *</label>
                                                        <select id="work_style" name="work_style" class="form-select"
                                                            required>
                                                            <option selected="">Choose...</option>
                                                            <option
                                                                <?php if($processorRow['work_style'] == "Remote") {?>
                                                                selected <?php } ?>>Remote</option> 
                                                            <option
                                                                <?php if($processorRow['work_style'] == "In Office") {?>
                                                                selected <?php } ?>>In Office</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="loans_closed" class="form-label">Estimate of how
                                                            many loans they’ve closed in their lifetime</label> 
                                                            <select class="form-control" name="loans_closed" id="loans_closed">
                                                                <option value="1-10" <?php if($processorRow['loans_closed'] == "1-10") echo "selected"; ?>>1 - 10</option>
                                                                <option value="11-49" <?php if($processorRow['loans_closed'] == "11-49") echo "selected"; ?>>11 - 49</option>
                                                                <option value="50-99" <?php if($processorRow['loans_closed'] == "50-99") echo "selected"; ?>>50 - 99</option>
                                                                <option value="100-499" <?php if($processorRow['loans_closed'] == "100-499") echo "selected"; ?>>100 - 499</option>
                                                                <option value="500-999" <?php if($processorRow['loans_closed'] == "500-999") echo "selected"; ?>>500 - 999</option>
                                                                <option value="1000+" <?php if($processorRow['loans_closed'] == "1000+") echo "selected"; ?>>1000+</option>
                                                                <option value="2000+" <?php if($processorRow['loans_closed'] == "2000+") echo "selected"; ?>>2000+</option>
                                                                <option value="5000+" <?php if($processorRow['loans_closed'] == "5000+") echo "selected"; ?>>5000+</option>
                                                            </select>
                                                       
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="hobbies" class="form-label">Hobbies</label>
                                                        <input type="text" class="form-control" id="hobbies"
                                                            name="hobbies" placeholder="Hobbies"
                                                            value="<?php echo $processorRow['hobbies'] ?>">
                                                    </div> 
                                                    <div class="col-md-6">
                                                        <label for="family" class="form-label">Family</label>
                                                        <input type="text" class="form-control" id="family"
                                                            name="family" placeholder="Family"
                                                            value="<?php echo $processorRow['family'] ?>">
                                                    </div>
                                                    <div class="col-md-12">
                                                            <div>
                                                                <label for="closed_loans" class="form-label">Have they closed
                                                                any of the below loans</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input <?php if (str_contains($processorRow['closed_loans'], "FHA")) {?>
                                                                checked="checked" <?php } ?> name="closed_loans[]"  class="form-check-input" type="checkbox" id="FHA" value="FHA">
                                                                <label class="form-check-label" for="FHA">FHA</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input <?php if (str_contains($processorRow['closed_loans'], "VA")) {?>
                                                                checked="checked" <?php } ?> name="closed_loans[]" class="form-check-input" type="checkbox" id="VA" value="VA">
                                                                <label class="form-check-label" for="VA">VA</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input <?php if (str_contains($processorRow['closed_loans'], "Conventional")) {?>
                                                                checked="checked" <?php } ?> name="closed_loans[]" class="form-check-input" type="checkbox" id="Conventional" value="Conventional">
                                                                <label class="form-check-label" for="Conventional">Conventional</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input <?php if (str_contains($processorRow['closed_loans'], "USDA")) {?>
                                                                checked="checked" <?php } ?> name="closed_loans[]" class="form-check-input" type="checkbox" id="USDA" value="USDA">
                                                                <label class="form-check-label" for="USDA">USDA</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input <?php if (str_contains($processorRow['closed_loans'], "NON-QM")) {?>
                                                                checked="checked" <?php } ?> name="closed_loans[]" class="form-check-input" type="checkbox" id="NON-QM" value="NON-QM">
                                                                <label class="form-check-label" for="NON-QM">NON-QM</label>
                                                            </div> 
                                                        </div>
                                                    <div class="col-md-12">
                                                        <div>
                                                            <label for="broker_portals" class="form-label">What Broker
                                                            Portals have they worked in</label>       
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input <?php if (str_contains($processorRow['broker_portals'], "UWM")) {?>
                                                            checked="checked" <?php } ?> name="broker_portals[]" class="form-check-input" type="checkbox" id="UWM" value="UWM">
                                                            <label class="form-check-label" for="UWM">UWM</label>
                                                        </div>
                                                        
                                                        <div class="form-check form-check-inline">
                                                            <input <?php if (str_contains($processorRow['broker_portals'], "Home Point")) {?>
                                                            checked="checked" <?php } ?> name="broker_portals[]" class="form-check-input" type="checkbox" id="HomePoint" value="Home Point">
                                                            <label class="form-check-label" for="HomePoint">Home Point</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input <?php if (str_contains($processorRow['broker_portals'], "Carrington")) {?>
                                                            checked="checked" <?php } ?> name="broker_portals[]" class="form-check-input" type="checkbox" id="Carrington" value="Carrington">
                                                            <label class="form-check-label" for="Carrington">Carrington</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input <?php if (str_contains($processorRow['broker_portals'], "Cardinal")) {?>
                                                            checked="checked" <?php } ?> name="broker_portals[]" class="form-check-input" type="checkbox" id="Cardinal" value="Cardinal">
                                                            <label class="form-check-label" for="Cardinal">Cardinal</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input <?php if (str_contains($processorRow['broker_portals'], "Freedom")) {?>
                                                            checked="checked" <?php } ?> name="broker_portals[]" class="form-check-input" type="checkbox" id="Freedom" value="Freedom">
                                                            <label class="form-check-label" for="Freedom">Freedom</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input <?php if (str_contains($processorRow['broker_portals'], "Windsor")) {?>
                                                            checked="checked" <?php } ?> name="broker_portals[]" class="form-check-input" type="checkbox" id="Windsor" value="Windsor">
                                                            <label class="form-check-label" for="Windsor">Windsor</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input <?php if (str_contains($processorRow['broker_portals'], "Orion")) {?>
                                                            checked="checked" <?php } ?> name="broker_portals[]" class="form-check-input" type="checkbox" id="Orion" value="Orion">
                                                            <label class="form-check-label" for="Orion">Orion</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input <?php if (str_contains($processorRow['broker_portals'], "Rocket")) {?>
                                                            checked="checked" <?php } ?> name="broker_portals[]" class="form-check-input" type="checkbox" id="Rocket" value="Rocket">
                                                            <label class="form-check-label" for="Rocket">Rocket</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input <?php if (str_contains($processorRow['broker_portals'], "Mutual of Omaha")) {?>
                                                            checked="checked" <?php } ?> name="broker_portals[]" class="form-check-input" type="checkbox" id="MutualofOmaha" value="Mutual of Omaha">
                                                            <label class="form-check-label" for="MutualofOmaha">Mutual of Omaha</label>
                                                        </div> 
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label for="looking_for" class="form-label">What they’re looking
                                                            for</label>
                                                        <select id="looking_for" class="form-select" name="looking_for">
                                                            <option selected="">Choose...</option>
                                                            <option
                                                                <?php if($processorRow['looking_for'] == "Employment") {?>
                                                                selected <?php } ?>>Employment</option>
                                                            <option
                                                                <?php if($processorRow['looking_for'] == "Extra 5 loans to process a month") {?>
                                                                selected <?php } ?>>Extra 5 loans to process a month
                                                            </option>
                                                            <option
                                                                <?php if($processorRow['looking_for'] == "Become the sole contract processor for LO/Broker") {?>
                                                                selected <?php } ?>>Become the sole contract processor
                                                                for LO/Broker</option>
                                                        </select>
                                                    </div>

                                                    
                                                    <div class="col-md-12">
                                                        <label for="currently_processing_for" class="form-label">Who
                                                            they’re currently processing for</label>
                                                        <input type="text" class="form-control"
                                                            id="currently_processing_for"
                                                            name="currently_processing_for"
                                                            placeholder="Who they’re currently processing for"
                                                            value="<?php echo $processorRow['currently_processing_for'] ?>">
                                                    </div> 
                                                    <div class="col-md-12">
                                                         <?php   $processorRow['fundings'] ?>
                                                        <label for="fundings" class="form-label">Average fundings per month over last 3 months</label>
                                                        <select name="fundings" id="fundings" class="form-control">
                                                            <?php
                                                                $tableOf = 5;
                                                                $maxValue = 25; 
                                                                for ($i = $tableOf; $i <= $maxValue; $i += $tableOf) {
                                                                $selected = '';
                                                                if ($i == $processorRow['fundings']) {
                                                                    $selected = 'selected';
                                                                }
                                                                    if($i == $maxValue){$$i = "$i+";}

                                                                    echo "<option value='$i' $selected >$i</option>"; 
                                                                } 
                                                            ?>
                                                        </select> 
                                                    </div> 
                                                    <div class="col-md-12">
                                                        <label for="aboutme" class="form-label">About me</label>
                                                        <input type="text" class="form-control" name="aboutme"
                                                            id="aboutme" placeholder="About me" required
                                                            value="<?php echo $processorRow['aboutme'] ?>">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                                            <button type="submit"
                                                                class="btn btn-primary px-4">Submit</button>
                                                            <button type="reset"
                                                                class="btn btn-light px-4">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php  }   ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->

    <?php include('footer.php') ?>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

    <script>
    var loadFile = function(event) {
        var image = document.getElementById("output");
        image.src = URL.createObjectURL(event.target.files[0]);
        $('#profilePicture').submit();
    };


    $("#profilePicture").on('submit', function(
        e) { // Here if the form is submitted i send the picture to a php treatment page 
        e.preventDefault();
        console.log('submitted');

        $.ajax({
            type: 'POST',
            url: 'process.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {


            }
        });
    });

    $('#inputAvatar').on('change',
        function() { // So here i trigger a click on the input file when the user click on his profile picture. The input is not visible by default on the page. 

            let userfile = $(this).val();
            if (userfile) { // here i want to check if a file has been selected but it doesn't seems to work
                $('#formAvatar').submit(); // Here i submit the form if the previous condition is true
            }
        }); // close the change event

    $('.avatar').on('click', function() { // trigger the input file click
        $('#inputAvatar').click();
    });


    //autofill data

    function is_int(value) {
        if ((parseFloat(value) == parseInt(value)) && !isNaN(value)) {
            return true;
        } else {
            return false;
        }
    }

    $(".fancy-form div > div").hide();

    $("#zip").keyup(function() {
        // Cache
        var el = $(this);
        // Did they type five integers?
        if ((el.val().length == 5) && (is_int(el.val()))) {
            // Call Ziptastic for information
            $.ajax({
                url: "https://zip.getziptastic.com/v2/US/" + el.val(),
                cache: false,
                dataType: "json",
                type: "GET",
                success: function(result, success) {
                    $(".zip-error, .instructions").slideUp(200);
                    $("#city").val(result.city);
                    $("#state").val(result.state);
                   // $(".fancy-form div > div").slideDown();
                    $("#zip").blur();
                    //$("#address-line-1").show().focus();
                },
                error: function(result, success) {
                    $(".zip-error").slideDown(300);

                }

            });

        } else if (el.val().length < 5) {
            $(".zip-error").slideUp(200);

        };

    });
  
		$(function () {
			 
             

            $('#dob').datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'dd MM'
                });



			 
		});
	</script>

    