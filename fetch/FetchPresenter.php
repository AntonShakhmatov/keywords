<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Presenter;

class FetchPresenter extends Presenter

{

public function renderDefault(){    

$data = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$Search = $_POST['query'];

$conn = mysqli_connect('localhost', 'root', '', 'keywords');

$query = "SELECT `keywords` FROM `words` WHERE `keywords` LIKE '%" . $Search . "%'";

$statement = mysqli_query($conn, $query);

// $statement->execute();

if(mysqli_num_rows($statement) > 0){?>
    <table class="table table-boardered table-striped mt-4">
        <thead>
            <tr>
                <th>keywords</th>
            </tr>
        </thead>

        <tbody>
<?php
while($row = mysqli_fetch_assoc($statement)){
 {
  $data[] = $row["keywords"];
 }
 ?>

<td><?php echo $data;?></td>

</tbody>

</table>

 <?php 
}

// echo json_encode($data);
}else{
    echo "<h6 class='text-danger text-center mt-3'>No data Found</h6>";
}

}

}

}

?>