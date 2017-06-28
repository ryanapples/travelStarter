<?php
//check if INTERNAL is true.  If it isn't, or it isn't set, exit the code (die())
if(INTERNAL !== true){
    die('Error: cannot directly access.');
}

//checks database for all existing itineraries and sends that data
$query = "SELECT `id`, `itinerary_name`, `creator_id`, `timestamp` FROM `itineraries`";

/*  join request for itinerary, items_in_itinerary, and activities
 * SELECT i.id AS itinerary_id, i.itinerary_name AS itinerary_name, i.creator_id,
	IinI.index_in_itinerary,
    a.name AS activity_name, a.city_id, a.latitude, a.longitude, a.tag_label AS category,
    a.images AS image_list

FROM itineraries AS i
JOIN items_in_itinerary AS IinI
	ON i.id = IinI.itinerary_id
JOIN activities AS a
	ON a.id = IinI.activity_id
WHERE i.id = 1
 */

//make a query to read all itineraries
$result = mysqli_query($conn, $query);

//check if $result is empty
if(empty($result)) {
    //if yes, report the error in the output
    $output['errors'][] = 'result variable is empty';
    //if no,     check if any results were passed in
}else {
    if(mysqli_num_rows($result) !== 0){
    //if yes,
    $output['success']= true;
    //set the success to true
    //do a while loop to fetch all the information, put it into an array
    while($row = mysqli_fetch_assoc($result)){
        $output['data'][] = $row;
    }
    //if no, report the error in the output
    }else{
    $output['errors'][]= 'No data.';
    }
}
?>