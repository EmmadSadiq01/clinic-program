<div id="chat">
<table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Paitent ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Medicines</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>



    <?php

    require '../database.php';
    $sno=0;
    
    $date = date("Y-m-d");
    $query = "SELECT * FROM `current_paitents` Where `date` = '$date'";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
            $sno = $sno + 1;
            echo "";
            echo "<tr>
            <th scope='row'>" . $sno . "</th>
            <td> 100" . $row['paitent_id'] . "</td>
            <td style='text-transform:capitalize'>" . $row['paitent_name'] . "</td>
            <td style='text-transform:capitalize'>" . nl2br($row['meds']) . "</td>
            <td><button type='button' class='deliver btn btn-primary' onclick=deliver(this) id=" . $row['paitent_id'] . ">Deliver</button></td>
            </tr>";
        }
            ?>
            </tbody >
        </table>

        <?php
    //      $id = '<script>
    //             deliver = document.getElementsByClassName("deliver");
    //             Array.from(deliver).forEach((element) => {
    //             element.addEventListener("click", (e) => {
    //                 $sno = e.target.id;
    //                 return $sno
                
 
    //  })
    //      })</script>';
    //      $query = "UPDATE `paitents_opd` SET `deliver` = 'yes' WHERE `paitents_opd`.`id` = $id" ;
    //      $result = mysqli_query($connection, $sql);
    //      echo $id;
        ?>

</div> 