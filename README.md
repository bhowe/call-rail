# CallRail API PHP Integration

A simple PHP implementation for interacting with the CallRail API to retrieve call logs and tracking numbers for specific companies.

## Features

- Fetch call logs for a specific company
- Retrieve tracking numbers (trackers) for a specific company
- SSL verification disabled for local development
- Error handling for API requests
- Support for optional parameters and filtering

## Prerequisites

- PHP 7.0 or higher
- cURL extension enabled
- Valid CallRail API credentials:
  - Account ID
  - API Key
  - Company ID

## Installation

1. Clone this repository or download the PHP file
2. Update the credentials in the code with your CallRail API information:
```php
$account_id = 'YOUR_ACCOUNT_ID';
$api_key = 'YOUR_API_KEY';
$company_id = 'YOUR_COMPANY_ID';
```

## Usage

### Fetching Tracking Numbers

```php
$trackers = getCallRailTrackers($account_id, $company_id, $api_key);
foreach ($calls['trackers'] as $tracker) {
    // Process tracker information
}
```

### Fetching Call Logs

```php
$calls = getCallRailCalls($account_id, $company_id, $api_key);
foreach ($calls['calls'] as $call) {
    // Process call information
}
```

### Optional Parameters

Both functions support additional parameters that can be uncommented and modified in the code:

```php
$parameters = [
    'start_date' => '2024-01-01',
    'end_date' => '2024-12-31',
    'page' => 1,
    'per_page' => 25,
    'answered' => true,
    'direction' => 'inbound'
];
```

## Security Note

The code currently has SSL verification disabled for local development. For production use, it's recommended to properly configure SSL certificates and enable verification:

```php
CURLOPT_SSL_VERIFYPEER => true,
CURLOPT_SSL_VERIFYHOST => 2,
```

## Error Handling

The code includes error handling for:
- cURL errors
- Invalid HTTP response codes
- JSON decoding errors

Errors are thrown as exceptions that can be caught and handled as needed.

## API Documentation

For more information about the CallRail API, visit:
- [CallRail API Documentation](https://apidocs.callrail.com/)
- [Tracking Numbers Documentation](https://apidocs.callrail.com/#trackers)
- [Calls Documentation](https://apidocs.callrail.com/#listing-all-calls)

## License

This code is released under the MIT License. Feel free to modify and use it as needed.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.
