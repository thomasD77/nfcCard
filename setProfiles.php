<?php
// AAN TE PASSEN WANNEER LIVE
$servername = "ID368008_tester.db.webhosting.be";
$username = "ID368008_tester";
$password = "@Skatemovies777";
$dbname = "ID368008_tester";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM members";
$result = $conn->query($sql);

$fields = getFields();
// Put Members in profiles
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $start = "INSERT INTO profiles";
        $columns = "(";
        $values = "VALUES(";
        foreach($fields as $field){
            if(!$row[$field]){
                continue;
            }
            if($field === "id"){
                $columns .= "member_id,";
            } else{
                $columns .= $field . ",";
            }
            $values .= "'" . $row[$field] . "',";
        }
        $columns .= "active)";
        $values .= "'1')";
        $sql = $start . $columns . $values;
        mysqli_query($conn, $sql);
    }
}

$profileIds = array();
$sql = "SELECT id, member_id FROM profiles";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $profileIds[$row['id']] = $row['member_id'];
    }
}
foreach($profileIds as $key => $id){
    $sql = "UPDATE states SET profile_id = '" . $key . "' WHERE member_id = '" . $id . "'";
    $conn->query($sql);
}

$conn->close();

function getFields(){
    return array(
        "avatar",
        "logo_id",
        "banner_id",
        "video_id",
        "front_style",
        "profile_views",
        "firstname",
        "lastname",
        "email",
        "company",
        "jobTitle",
        "age",
        "shortDescription",
        "notes",
        "website",
        "archived",
        "mobile",
        "mobileWork",
        "addressLine1",
        "city",
        "postalCode",
        "country",
        "facebook",
        "instagram",
        "linkedIn",
        "twitter",
        "youTube",
        "tikTok",
        "whatsApp",
        "id",
        'youtube_video',
        'titleMessage',
        'message',
        'customField',
        'customText'
    );
}
