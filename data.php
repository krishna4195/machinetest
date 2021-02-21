<?php 
include 'backend/database.php';
//$result = mysqli_query($connn,"SELECT id,name,email,phone FROM users");
    
    // $data =  array();
    // header("Content-type:application/json;charset=utf-8");
    // $count=mysqli_num_rows($result);
    // while($row = mysqli_fetch_array($result)){
    //     array_push($data,$row);
    // }
    // $json_data = array(
    //     "draw"            =>intval($_GET['draw']) ,
    //     "recordsTotal"    => intval( $count ),
    //     "recordsFiltered" => intval($count),
    //     "data"            => $data   // total data array
    // );
    // $json_data = json_encode($json_data);
    // echo $json_data;
    
## Database configuration


## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($conn,$_POST['search']['value']); // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " and (name like '%".$searchValue."%' or 
        email like '%".$searchValue."%' or 
        phone like'%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($conn,"select count(*) as allcount from users");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($conn,"select count(*) as allcount from users WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select id,name,email,phone from users WHERE 1 ".$searchQuery;

$empRecords = mysqli_query($conn, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $data[] = array( 
      "id"=>$row['id'],
      "name"=>$row['name'],
      "email"=>$row['email'],
      "phone"=>$row['phone']
      
   );
}

## Response
$response = array(
  "draw" => intval($draw),
  "recordsTotal" => $totalRecords,
  "recordsFiltered" => $totalRecordwithFilter,
  "data" => $data
);

echo json_encode($response);
                    
?>