# CLAUDE.md - Satu Sehat Package

## Overview

This package provides integration with Indonesia's **Satu Sehat** (One Health) national health information system, managed by the Ministry of Health (Kemenkes). Satu Sehat is a FHIR R4-compliant interoperability platform that enables healthcare providers to share patient health data across Indonesia's healthcare ecosystem.

**Package:** `hanafalah/satu-sehat`
**Namespace:** `Hanafalah\SatuSehat`

## API Integration Patterns

### Environment Configuration

The package supports three environments:
- **DEV** - Development/sandbox environment
- **STG** - Staging environment (default)
- **PROD** - Production environment

Each environment has three host types:
- **AUTH** - OAuth2 authentication endpoint
- **FHIR** - FHIR R4 API endpoint
- **SATUSEHAT** - General Satu Sehat API endpoint

### Host URLs

```
AUTH:
  DEV:  https://api-satusehat-dev.dto.kemkes.go.id/oauth2/v1
  STG:  https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1
  PROD: https://api-satusehat.kemkes.go.id/oauth2/v1

FHIR:
  DEV:  https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1
  STG:  https://api-satusehat-stg.dto.kemkes.go.id/fhir-r4/v1
  PROD: https://api-satusehat.kemkes.go.id/fhir-r4/v1

SATUSEHAT:
  DEV:  https://api-satusehat-dev.dto.kemkes.go.id
  STG:  https://api-satusehat-stg.dto.kemkes.go.id
  PROD: https://api-satusehat.kemkes.go.id
```

### Required Credentials

```env
SS_CLIENT_ID=your_client_id
SS_CLIENT_SECRET=your_client_secret
SS_ORGANIZATION_ID=your_organization_id
```

Optional host overrides:
```env
SS_AUTH_DEV=custom_auth_url
SS_AUTH_STG=custom_auth_url
SS_AUTH_PROD=custom_auth_url
SS_FHIR_DEV=custom_fhir_url
SS_FHIR_STG=custom_fhir_url
SS_FHIR_PROD=custom_fhir_url
```

## Directory Structure

```
src/
├── Commands/                    # Artisan commands
│   ├── EnvironmentCommand.php
│   ├── InstallMakeCommand.php
│   ├── MigrateCommand.php
│   └── SeedCommand.php
├── Concerns/                    # Traits for core functionality
│   ├── HasEnvironment.php       # Environment/credential management
│   ├── HasHeader.php            # HTTP header management
│   ├── HasHost.php              # Host URL management
│   └── HasHttpRequest.php       # HTTP request handling
├── Contracts/                   # Interfaces
│   ├── Data/                    # Data transfer object contracts
│   │   └── Fhir/               # FHIR resource DTOs
│   │       ├── Encounter/
│   │       ├── Location/
│   │       ├── Observation/
│   │       ├── Organization/
│   │       ├── Patient/
│   │       └── Practitioner/
│   ├── Schemas/                 # Schema contracts
│   │   └── Fhir/
│   └── SatuSehat.php           # Main service contract
├── Controllers/API/
│   └── ApiController.php
├── Data/                        # Data transfer object implementations
│   └── Fhir/
├── Database/Seeders/
├── Facades/
│   └── SatuSehat.php           # Service facade
├── Models/                      # Eloquent models
│   ├── EncounterSatuSehat.php
│   ├── LocationSatuSehat.php
│   ├── MasterSaranaSatuSehat.php
│   ├── OAuth2.php
│   ├── ObservationSatuSehat.php
│   ├── OrganizationSatuSehat.php
│   ├── PatientSatuSehat.php
│   ├── PractitionerSatuSehat.php
│   └── SatuSehatLog.php        # Base model for API logging
├── Providers/
│   ├── CommandServiceProvider.php
│   └── RouteServiceProvider.php
├── Resources/                   # API Resources (transformers)
├── Routes/
│   └── api.php
├── Schemas/                     # Business logic schemas
│   ├── Fhir/
│   │   ├── Encounter/
│   │   ├── Location/
│   │   ├── MasterSarana/
│   │   ├── Observation/
│   │   ├── Organization/
│   │   ├── Patient/
│   │   └── Practitioner/
│   ├── OAuth2.php              # Authentication schema
│   └── SatuSehatLog.php        # Base schema with logging
├── Supports/
│   └── BaseSatuSehat.php       # Base class for Satu Sehat operations
├── SatuSehat.php               # Main service class
├── SatuSehatServiceProvider.php
└── helper.php
```

## Key Classes

### Main Service Class

**`Hanafalah\SatuSehat\SatuSehat`**

The main service class providing core API operations:

```php
use Hanafalah\SatuSehat\Facades\SatuSehat;

// GET request to FHIR endpoint
SatuSehat::get('Patient?name=John');

// POST request to FHIR endpoint
SatuSehat::store('Patient', $payload);

// Authentication request
SatuSehat::auth('accesstoken?grant_type=client_credentials', [
    'client_id' => $clientId,
    'client_secret' => $clientSecret
]);

// Access token management
SatuSehat::getAccessToken();
SatuSehat::setAccessToken($token);
```

### Facade

**`Hanafalah\SatuSehat\Facades\SatuSehat`**

Provides static access to the SatuSehat service:
- `get(string $url)` - FHIR GET request
- `store(string $url, array $payload)` - FHIR POST request
- `auth(string $url, array $payload)` - OAuth2 authentication
- `getAccessToken()` - Get current access token
- `setAccessToken(string $token)` - Set access token

### Base Classes

**`Hanafalah\SatuSehat\Supports\BaseSatuSehat`**

Base class that combines:
- `HasEnvironment` - Environment and credential configuration
- `HasHost` - Host URL management for different environments
- `HasHttpRequest` - HTTP request handling with Laravel HTTP client

**`Hanafalah\SatuSehat\Schemas\SatuSehatLog`**

Base schema providing API request/response logging functionality. All FHIR schemas extend this class.

**`Hanafalah\SatuSehat\Schemas\OAuth2`**

Handles OAuth2 authentication with automatic token refresh and organization lookup. All FHIR resource schemas extend this class.

### FHIR Resource Schemas

Each FHIR resource has a corresponding schema class:

| Schema | FHIR Resource | Purpose |
|--------|---------------|---------|
| `PatientSatuSehat` | Patient | Patient demographic data |
| `PractitionerSatuSehat` | Practitioner | Healthcare provider data |
| `OrganizationSatuSehat` | Organization | Healthcare facility data |
| `LocationSatuSehat` | Location | Physical location data |
| `EncounterSatuSehat` | Encounter | Patient visit/encounter data |
| `ObservationSatuSehat` | Observation | Clinical observations |
| `MasterSaranaSatuSehat` | - | Master facility registry |

### Models

All models extend `SatuSehatLog` and use:
- `HasUlids` - ULID primary keys
- `HasProps` - JSON property storage for API responses

The `SatuSehatLog` model stores:
- `name` - Entity type (OAuth2, PatientSatuSehat, etc.)
- `env_type` - Environment (DEV, STG, PROD)
- `url` - Request URL
- `method` - HTTP method
- `reference_type` / `reference_id` - Polymorphic reference to local models
- `props` - JSON containing headers, payload, and response

## Configuration

### Config File: `config/satu-sehat.php`

```php
return [
    'env_type' => env('SS_ENV_TYPE', 'STG'), // DEV, STG, PROD
    'organization_id' => env('SS_ORGANIZATION_ID'),
    'environment' => [
        'env_type' => null,
        'hosts' => [],
        'credentials' => [
            'client_id' => env('SS_CLIENT_ID'),
            'client_secret' => env('SS_CLIENT_SECRET'),
            'organization_id' => env('SS_ORGANIZATION_ID'),
        ],
    ],
];
```

### Application Contracts Configuration

Register DTOs in `config/app.php`:

```php
'contracts' => [
    'OAuth2Data' => \App\Data\OAuth2Data::class,
    'SatuSehatLogData' => \App\Data\SatuSehatLogData::class,
    'PatientSatuSehatData' => \App\Data\Fhir\PatientSatuSehatData::class,
    'OrganizationSatuSehatData' => \App\Data\Fhir\OrganizationSatuSehatData::class,
    // ... other FHIR resource DTOs
],
```

## Common Usage

### Authentication Flow

```php
use Hanafalah\SatuSehat\Facades\SatuSehat;

// Automatic authentication (checks existing token, refreshes if expired)
$oauth2Schema = app(\Hanafalah\SatuSehat\Contracts\Schemas\OAuth2::class);
$oauth2Schema->useAccessToSatuSehat();

// After this, all subsequent requests will use the authenticated token
```

### Patient Operations

```php
// Search patients
$patientSchema = app(\Hanafalah\SatuSehat\Contracts\Schemas\Fhir\Patient\PatientSatuSehat::class);
$patients = $patientSchema->prepareViewPatientSatuSehatList(
    $this->requestDTO(config('app.contracts.PatientSatuSehatData'), [
        'params' => [
            'name' => 'John Doe',
            'birthdate' => '1990-01-01',
            'gender' => 'male'
        ]
    ])
);

// Create patient
$patient = $patientSchema->prepareStorePatientSatuSehat($patientDTO);
```

### Organization Operations

```php
$orgSchema = app(\Hanafalah\SatuSehat\Contracts\Schemas\Fhir\Organization\OrganizationSatuSehat::class);

// Find organization by ID
$org = $orgSchema->prepareFindOrganizationSatuSehat(
    $this->requestDTO(config('app.contracts.OrganizationSatuSehatData'), [
        'params' => ['id' => 'organization-uuid']
    ])
);

// List organizations
$orgs = $orgSchema->prepareViewOrganizationSatuSehatList($orgDTO);
```

### Encounter Operations

```php
$encounterSchema = app(\Hanafalah\SatuSehat\Contracts\Schemas\Fhir\Encounter\EncounterSatuSehat::class);

// Create encounter (patient visit)
$encounter = $encounterSchema->prepareStoreEncounterSatuSehat($encounterDTO);

// List encounters
$encounters = $encounterSchema->prepareViewEncounterSatuSehatList($encounterDTO);
```

### Direct API Calls

```php
use Hanafalah\SatuSehat\Facades\SatuSehat;

// First authenticate
$oauth = app(\Hanafalah\SatuSehat\Contracts\Schemas\OAuth2::class);
$oauth->useAccessToSatuSehat();

// Then make direct API calls
$response = SatuSehat::get('Patient/patient-uuid');
$response = SatuSehat::store('Observation', $observationPayload);
```

## Error Handling

The package throws exceptions for API errors. Common patterns:

```php
try {
    $patient = SatuSehat::store('Patient', $payload);
} catch (\Exception $e) {
    $response = SatuSehat::getResponse()->json();

    // Check for duplicate error
    if (isset($response['issue']) && $response['issue'][0]['code'] === 'duplicate') {
        // Handle duplicate - search for existing record
    }
}
```

## Logging

All API requests are automatically logged to the `satu_sehat_logs` table via the `SatuSehatLog` model. Each log entry includes:
- Request URL, method, headers
- Request payload
- Response data
- Environment type
- Reference to local model (if applicable)

For error logging, use the dedicated channel:
```php
Log::channel('satu-sehat')->error("Error message", $context);
```

## Dependencies

- `hanafalah/laravel-support` - Base Laravel support package
- Laravel HTTP client for API requests
- Spatie Laravel Data for DTOs
