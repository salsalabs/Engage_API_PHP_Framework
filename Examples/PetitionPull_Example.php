<?php
// Use the Engage API Framework PHP
require 'Engage_API_Framework.php';

$IntAuthToken = "Your Integration Token GOES HERE";
$IntUri = 'https://api.salsalabs.org';

//Create API Framework instance then Initialize
$IntAPI = new Engage_API;
$IntAPI->Init_API($IntAuthToken, $IntUri);

$offSet = 0; // Keep track of where we are in the pull
$Count = 20; // Integration API maxBatchSize
$dataArray = [];
$page = 0; // Track the pull #

//Loop through all Petition Signatures that meet payload criteria
do
{
    //Create Payload for search request
    $payload = [
        'payload' => [
            'modifiedFrom' => '2000-01-01T00:00:00.00Z',
            'type' => "PETITION",
            'count' => $Count,
            'offset' => $offSet,
        ],
    ];

    echo "\n<==== BEGIN Search Activities Page " . $page . " ====>\n";
    
    //Search for activity test
    // https://help.salsalabs.com/hc/en-us/articles/224470267-Engage-API-Activity-Data#acquiring-activities
    // This endpoint would be https://api.salsalabs.org/api/integration/ext/v1/activities/search with POST method
    // It is submitted with the Authorization header and payload containing the desired search criteria
    $data = $IntAPI->Int_API("Search_Activities", $payload); //Pull the activities with current offset and count
    
    //Add desired data to array for storage
    array_push($dataArray, $data->payload->activities);
    
    echo "\n<==== END Search Activities Page " . $page . " ====>\n";
    
    $offSet += $data->payload->count; // Set offSet for next pull
    $page++;
    
    echo "\n\tOffset: " . $offSet . "\n\tCount: " . $Count . "\n\tTotal: " . $data->payload->total . "\n\n";//Debug counts
    
}while($data->payload->total > $offSet);

$csvBuilder = "Form Name,Form ID,Supporter ID,Activity Date,Comment\n";

echo "\n<!!! Begin Processing !!!>\n";

//Cycle through each page of the array
foreach($dataArray as $arrayPage)
{
    foreach($arrayPage as $activity)
    {
        $csvBuilder .= str_replace(",", "_", $activity->activityFormName) . ",";
        $csvBuilder .= $activity->activityFormId . ",";
        $csvBuilder .= $activity->supporterId . ",";
        $csvBuilder .= $activity->activityDate . ",";
        $csvBuilder .= str_replace(",", "_", $activity->comment);
        $csvBuilder .= "\n";
    }//end foreach activity
}//end foreach arrayPage

echo "<!!! End Processing - Output to file !!!>\n";

file_put_contents("output.csv",$csvBuilder);

echo "<**** Output Complete! ****>\n";
?>