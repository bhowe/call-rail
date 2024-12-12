<?php

//error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

function getCallRailTrackers($account_id,$company_id,$api_key) {
    // API endpoint for trackers
    $url = "https://api.callrail.com/v3/a/{$account_id}/trackers.json";
    
    // Initialize cURL session
    $ch = curl_init();
    
   // Optional parameters (uncomment and modify as needed)
    $parameters = [
        // 'start_date' => '2024-01-01',
        // 'end_date' => '2024-12-31',
        // 'page' => 1,
        // 'per_page' => 25,
        // 'answered' => true,
        // 'direction' => 'inbound'
        'company_id' => $company_id  // Filter for specific company
    ];
    
    // Add parameters to URL if any are set
    if (!empty($parameters)) {
        $url .= '?' . http_build_query($parameters);
        curl_setopt($ch, CURLOPT_URL, $url);
    }
    
    // Set cURL options
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,  // Disable SSL verification
        CURLOPT_SSL_VERIFYHOST => 0,      // Disable host verification
        CURLOPT_HTTPHEADER => [
            "Authorization: Token token={$api_key}",
            "Accept: application/json"
        ]
    ]);
    
    // Execute request
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    // Check for errors
    if (curl_errno($ch)) {
        throw new Exception('Curl error: ' . curl_error($ch));
    }
    
    curl_close($ch);
    
    // Handle response
    if ($http_code !== 200) {
        throw new Exception("API request failed with status code: {$http_code}");
    }
    
    // Decode JSON response
    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Failed to decode JSON response');
    }
    
    return $data;
}


function getCallRailCalls($account_id,$company_id, $api_key) {
    // API endpoint
    $url = "https://api.callrail.com/v3/a/{$account_id}/calls.json";
    
    // Initialize cURL session
    $ch = curl_init();
    
    // Set cURL options
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,  // Disable SSL verification
		CURLOPT_SSL_VERIFYHOST => 0,      // Disable host verification
        CURLOPT_HTTPHEADER => [
            "Authorization: Token token={$api_key}",
            "Accept: application/json"
        ]
    ]);
    
    // Optional parameters (uncomment and modify as needed)
    $parameters = [
        // 'start_date' => '2024-01-01',
        // 'end_date' => '2024-12-31',
        // 'page' => 1,
        // 'per_page' => 25,
        // 'answered' => true,
        // 'direction' => 'inbound'
        'company_id' => $company_id  // Filter for specific company
    ];
    
    // Add parameters to URL if any are set
    if (!empty($parameters)) {
        $url .= '?' . http_build_query($parameters);
        curl_setopt($ch, CURLOPT_URL, $url);
    }
    
    // Execute request
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    // Check for errors
    if (curl_errno($ch)) {
        throw new Exception('Curl error: ' . curl_error($ch));
    }
    
    curl_close($ch);
    
    // Handle response
    if ($http_code !== 200) {
        throw new Exception("API request failed with status code: {$http_code}");
    }
    
    // Decode JSON response
    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Failed to decode JSON response');
    }
    
    return $data;
}

// Usage example
try {
    $account_id = 'ENtER YOUR ACCOUNt ID';
    $api_key = 'ENTER YOUR API KEY';
    $company_id = 'ENTER YOUR COMPANT ID';  // Add your specific company ID here
    
   
   
    
   // $calls = getCallRailCalls($account_id,$company_id,$api_key);
   $calls = getCallRailTrackers($account_id,$company_id,$api_key);
   
  // echo 'dumping calls </br></br>';
  // var_dump($calls);
   
    //$calls['calls'] -- get a list of all calls
    
    //$calls['trackers'] - get a list of all tracking numbers
    // Process the results
    foreach ($calls['trackers'] as $call) {
    
        echo "------------------------\</br></br>";
        
         echo "call";
        var_dump($call);
        echo "------------------------\</br></br>";
        
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
