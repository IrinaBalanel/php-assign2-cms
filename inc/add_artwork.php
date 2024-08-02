<?php
    // Include necessary files
    include('functions.php');
    require('../reusable/conn.php');

    // Start session for flash messages
    session_start();

    // Collect POST data and escape to prevent SQL injection
    $Source = mysqli_real_escape_string($connect, $_POST['Source']);
    $Title = mysqli_real_escape_string($connect, $_POST['Title']);
    $Medium = mysqli_real_escape_string($connect, $_POST['Medium']);
    $ArtForm = mysqli_real_escape_string($connect, $_POST['ArtForm']);
    $Status = mysqli_real_escape_string($connect, $_POST['Status']);
    $ImageName = mysqli_real_escape_string($connect, $_POST['ImageName']);
    $ImageURL = mysqli_real_escape_string($connect, $_POST['ImageURL']);
    $YearInstalled = mysqli_real_escape_string($connect, $_POST['YearInstalled']);
    $Description = mysqli_real_escape_string($connect, $_POST['Description']);
    $ImageOrientation = mysqli_real_escape_string($connect, $_POST['ImageOrientation']);
    $Artist = mysqli_real_escape_string($connect, $_POST['Artist']);
    $Location = mysqli_real_escape_string($connect, $_POST['Location']);
    $Ward = mysqli_real_escape_string($connect, $_POST['Ward']);
    $WardFullName = mysqli_real_escape_string($connect, $_POST['WardFullName']);
    $Latitude = mysqli_real_escape_string($connect, $_POST['latitude']);
    $Longitude = mysqli_real_escape_string($connect, $_POST['longitude']);



    // Set default description if empty
    if (empty($Description)) {
        $Description = "No description about this art.";
    }

    // Start a transaction
    $connect->begin_transaction();

    try {
        // Insert into Artists table
        $artist_stmt = $connect->prepare("INSERT INTO Artists (Artist) VALUES (?)");
        $artist_stmt->bind_param("s", $Artist);
        if (!$artist_stmt->execute()) {
            throw new Exception($connect->error);
        }
        $artist_id = $connect->insert_id;

        // Insert into Locations table
        $location_stmt = $connect->prepare("INSERT INTO Locations (`Location`, Ward, WardFullName, latitude, longitude) VALUES (?, ?, ?, ?, ?)");
        $location_stmt->bind_param("sisdd", $Location, $Ward, $WardFullName, $Latitude, $Longitude);
        if (!$location_stmt->execute()) {
            throw new Exception($connect->error);
        }
        $location_id = $connect->insert_id;

        //IMAGE UPLOAD FUNCTIONALITY
        $Image = '';
        if (isset($_FILES['Image']) && $_FILES['Image']['error'] == 0) {
            $allowedTypes = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
            $fileType = $_FILES['Image']['type'];
            if (in_array($fileType, $allowedTypes)) {
                switch ($fileType) { // Determine the file type of the uploaded image
                    case 'image/png': $type = 'png'; break;
                    case 'image/jpg': $type = 'jpg'; break;
                    case 'image/jpeg': $type = 'jpeg'; break;
                    case 'image/gif': $type = 'gif'; break;
                }
                $ImageData = file_get_contents($_FILES['Image']['tmp_name']);
                $ImageEncoded = base64_encode($ImageData);
                $Image = "data:image/$type;base64,$ImageEncoded";
            } else {
                set_message("Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.", "alert-danger");
                header('Location: ../addart.php');
                exit();
            }
        } else {
            set_message("Image file is required.", "alert-danger");
            header('Location: ../addart.php');
            exit();
        }


        // Insert into Artworks table
        $artwork_stmt = $connect->prepare("INSERT INTO Artworks (Title, Medium, ArtForm, `Status`, ImageName, ImageURL, `Image`, YearInstalled, `Description`, ImageOrientation, ArtistID, LocationID)
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $artwork_stmt->bind_param("ssssssssssii", $Title, $Medium, $ArtForm, $Status, $ImageName, $ImageURL, $Image, $YearInstalled, $Description, $ImageOrientation, $artist_id, $location_id);
        if (!$artwork_stmt->execute()) {
            throw new Exception($connect->error);
        }
        $artwork_id = $connect->insert_id;

        // Commit transaction
        $connect->commit();

        // Set success message
        set_message("New artwork added successfully", "alert-success");

        // Redirect to the view_artwork.php page with the new artwork ID
        header("Location: ../view_artwork-admin.php?id=$artwork_id");
        exit();

    } catch (Exception $e) {
        // Rollback transaction on error
        $connect->rollback();

        // Set error message
        set_message("Error: " . $e->getMessage(), "alert-danger");

        // Debugging output
        echo "Error: " . $e->getMessage();
        header("Location: ../addart.php");
        exit();
    } finally {
        // Close statement and connection
        $artist_stmt->close();
        $location_stmt->close();
        $artwork_stmt->close();
        $connect->close();
    }
?>
