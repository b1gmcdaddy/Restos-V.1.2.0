<?php
include("config.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <title>Jolo and Ali's Foodtrips</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <div class="container-lg mt-5">
        <header id="main-header" class="text-white p-4 mb-3" style="background-color: #2C5282; border: 2px solid">
            <div class="row">
                <div class="col-md-12">
                    <h1 id="header-title">FoodTrips
                        <i class="fa fa-cutlery me-2" style="float:right"></i>
                    </h1>
                </div>
            </div>
        </header>
        <div class="card p-2" style="background-color:#faf0e6;">
            <div class="card-body" style="background-color:#faf0e6;">
                <form action="" method="POST" style="background-color:#faf0e6;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Restaurant</span>
                                    <input type="text" class="form-control" name="resto" aria-label="Username"
                                        aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <select class="form-select" id="typeSelect" name="type" required>
                                    <option value="Meal">Meal</option>
                                    <option value="Snack">Snack</option>
                                    <option value="Dessert">Dessert</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"
                            name="notes"></textarea>
                        <label for="floatingTextarea">Notes/Description</label>
                    </div>
                    <div class="d-grid mt-3">
                        <button class="btn add-button" type="submit">ADD</button>
                    </div>
                </form>
            </div>
            <hr style="box-shadow: 0 5px #2C5282; border: solid black;" />
            <div class="listofRestos mt-1.5 p-3" id="listContainer" style="height: 400px; overflow-y: auto;">
                <?php
    $sql = "SELECT resto_name, meal_type, resto_id, resto_desc FROM places";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $type = $row['meal_type'];
            $resto = $row['resto_name'];
            $restoId = $row['resto_id'];
            $restoDesc = $row['resto_desc'];

            //list of restos to be displayed
            echo '<div class="row mb-2" style="padding: 13px; width: 90%; margin:auto; border-style: outset;
            border-radius: 10px; box-shadow: 7px 5px 5px gray; background-color: whitesmoke;">';
            echo '<div class="col-md-4 data-entry" style="text-align:center; margin-top:2px;">' . $resto . '</div>';
            echo '<div class="col-md-4" style="text-align:center;"></div>';
            echo '<div class="col-md-4" style="text-align:center;">
                <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#descriptionModal' . $restoId . '"><i class="fas fa-info-circle" title="Additional Info" id="infoIcon"></i></a>
                <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#editModal' . $restoId . '"><i class="fas fa-edit" title="Edit Resto" id="editIcon"></i></a>
                <a href="delete_resto.php?id=' . $restoId . '" class="btn"><i class="fas fa-trash" title="Delete Resto" id="trashIcon"></i></a>
            </div>';
            
            echo '</div>';

            // Modal for displaying restaurant description
            echo '<div class="modal fade" id="descriptionModal' . $restoId . '" tabindex="-1" aria-labelledby="descriptionModalLabel' . $restoId . '" aria-hidden="true">';
            echo '<div class="modal-dialog">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="descriptionModalLabel' . $restoId . '">Restaurant Type & Notes</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<p>' . $type . '</p>';
            echo '<p>' . $restoDesc . '</p>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            // Modal for editing restaurant information
            echo '<div class="modal fade" id="editModal' . $restoId . '" tabindex="-1" aria-labelledby="editModalLabel' . $restoId . '" aria-hidden="true">';
            echo '<div class="modal-dialog">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="editModalLabel' . $restoId . '">Edit Restaurant Information</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<form action="edit_resto.php" method="post">';
            echo '<div class="mb-3">';
            echo '<label for="editRestoName' . $restoId . '" class="form-label">Restaurant Name</label>';
            echo '<input type="text" class="form-control" id="editRestoName' . $restoId . '" name="editRestoName" value="' . $resto . '">';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="editMealType' . $restoId . '" class="form-label">Meal Type</label>';
            echo '<input type="text" class="form-control" id="editMealType' . $restoId . '" name="editMealType" value="' . $type . '">';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="editRestoDesc' . $restoId . '" class="form-label">Restaurant Description</label>';
            echo '<textarea class="form-control" id="editRestoDesc' . $restoId . '" name="editRestoDesc" rows="4">' . $restoDesc . '</textarea>';
            echo '</div>';
            echo '<input type="hidden" name="restoId" value="' . $restoId . '">';
            echo '<button type="submit" class="btn btn-primary">Save Changes</button>';
            echo '</form>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>No data available.</p>';
    }
    ?>
            </div>


        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>