# Engage_API_PHP_Framework
A PHP Framework for the Engage API.

Follow the installation instructions here:
  https://github.com/salsalabs/engage_api_php

Then add download the Engage_API_Framework.php & Engage_API_Framework_Example.php to the main folder of the cloned repository.
Refer to the Engage_API_Framework_Example.php for an example of how to use the Engage API PHP Framework.

How to use the Framework & Example

  I have created an Example of each endpoint using the framework in the Engage_API_PHP_Framework_Example.php file. You'll find that each endpoint function is commented out with "/*" and ending with "*/" removing these from the example code blocks will allow you to run the API call. You'll also need a payload, UUID, parameters, or some mix thereof for some endpoints.

  There are 2 initializations that need to happen. The first for the Integration endpoints, you'll find this at the top of the Example code just above the Run Metrics endpoint code block. To initialize the Integration endpoints an instance of Engage_API needs to be created, then you'd call the Init_API function from this instance passing in the Integration Token variable and the Uri variable for the Integration. The same needs to be done for the Developer endpoint functions, but you'd pass in the Developer Token and Developer Uri (unless you are on UAT - see below).

The following is a breakdown of the URIs available:

  UAT Uri: 'https://hq.uat.igniteaction.net' - Use this for both the developer Uri and Integration Uri if you are on a UAT account. UAT should be in the URL when using the Engage HQ if you're in a UAT Account.
  Integration Uri: 'https://api.salsalabs.org' - Use this to initialize the Integration Endpoint Functions (not for UAT accounts).
  Developer Uri: 'https://dev-api.salsalabs.org' - Use this to initialize the Developer Endpoint Functions (not for UAT accounts).

Each endpoint has a URL to the documentation that can be useful to see what parameters, UUID, or payload needs to be submitted for this endpoint along with examples for these as well.

Variables have been created as an example for each endpoint function. You'll need to replace the contents of these variables with the desired payload, parameters, and/or UUIDs. If an endpoint function does not have a payload directly above it, then the payload from a previous endpoint is the one used; this is due to some endpoint functions being able to use the same payload and this saves on space. Refer to the documentation in the URL in the comment above each endpoint for help with these.

Some developer endpoints require parameters. Example variables ($params) have been created for these and you'll want to replace these. Each parameter variable should start with a question mark followed by the parameters just as they would appear at the end of a URL. Refer to the documentation in the URL in the comment above each endpoint for help with these.

A few developer endpoints may require a UUID. Example variables ($params) have been created for these and you'll want to replace these. Refer to the documentation in the URL in the comment above each endpoint for help with these. For an endpoint that uses both a UUID and parameter(s) you'll need to create an array to pass into the endpoint function. An example of this can be found in the Get_Activity_Teams code block:

  $params = ["8552a90e-e9ea-464a-a23b-d18fc996b37b","?count=5&offset=1"];

The Developer endpoint Submissions requires a payload instead of accepting parameters. For this Developer function you'll still need to pass in an empty set ("") for the parameter variable. This is why you the example includes the empty set variable for the Submissions endpoint function. Filling in the $params variable for this endpoint will not affect it's behavior as it is ignored. The Submissions endpoint is the only Developer endpoint that accepts a payload.

Structure

The Engage API PHP Framework is structured to present functions that are intuitive and do not vary much. This design allows for ease of use when calling endpoints. To call an endpoint (initialization first) you would use the following format:

You'll need to make sure your code uses the Engage API PHP Framework:

   require 'Engage_API_Framework.php';

Initialize:

   $API_Instance→Init_API($AuthToken, $uri);

Integration Endpoint Function:

   $dataVariable = $API_Instance→Int_API($command, [Optional:$payload]);

Developer Endpoint Function:

   $dataVariable = $API_Instance→Dev_API($command, [Optional: $params], [Optional: $payload])

*Each Endpoint Function returns JSON that can be parsed to retrieve the data/results.

*Recommended:
  Using an API instance for each Endpoint path (one for Integration & one for Developer) allows for easy transition between making Integration calls and Developer calls. Without this you would need to initialize the instance to the path you wish to switch to each time.
Commands

The following is a list of commands for each endpoint:

Integration:
   - Metrics
   - Search_Activities
   - Search_Supporters
   - PUT_Supporters
   - Delete_Supporters
   - Search_Segment
   - PUT_Segment
   - Delete_Segment (**NOTE** As of v1.0.0 this endpoint returns an Error. Still under development)
   - Search_Members_Segment
   - PUT_Members_Segment
   - Remove_Members_Segment
   - Merge_Supporters
   - Offline_Donations
   - Email_Individual_Results
   - Email_Search_Results
   
Developer:
   - Metrics
   - Get_Activity_Types
   - Get_Activity_List
   - Get_Activity_Metadata
   - Get_Activity_Summary
   - Get_Activity_Targets
   - Get_Activity_Attendees
   - Get_Activity_Registrations
   - Get_Activity_Fundraisers
   - Get_Activity_Teams
   - Get_Activity_Purchases
   - Get_FundraiserMeta_Summary
   - Get_TeamMeta_Summary
   - Get_EmailBlast_List
   - Submissions
*Refer to the Engage_API_PHP_Framework_Example.php file for examples of each of these endpoints.

Step-by-step guide

Run your first API call:

   1. Open the Engage_API_PHP_Framework_Example.php file with your chosen PHP editor.
   2. Copy your Integration Token and replace "Your Integration Token GOES HERE" with that token.
   3. Remove the "/*" and "*/" from around the Integration Metrics Example.
   4. Save the Framework example.
   5. Open your command line/Terminal
   6. Use the "cd" command to navigate to the directory of the cloned repository
   7. Run the Framework Example:
         php Engage_API_Framework_Example.php
