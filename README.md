# Number Classification API

A simple REST API that provides mathematical properties and fun facts about numbers. The API analyzes a given number and returns various properties including whether it's prime, perfect, Armstrong, odd/even, along with its digit sum and an interesting mathematical fact.

## Features

- Number classification (Prime, Perfect, Armstrong)
- Odd/Even determination
- Digit sum calculation
- Integration with Numbers API for mathematical fun facts
- CORS support
- Docker containerization
- Error handling and input validation

## Requirements

- Docker
- Docker Compose

## Installation & Setup

1. Clone the repository:
```bash
git clone <your-repository-url>
cd number-api
```

2. Build and start the Docker container:
```bash
docker-compose up -d --build
```

The API will be available at `http://localhost:8000`

## API Documentation

### Classify Number

Returns mathematical properties and a fun fact about a given number.

- **URL:** `/api/classify-number`
- **Method:** `GET`
- **URL Params Required:** `number=[integer]`

#### Success Response (200 OK)

```json
{
    "number": 371,
    "is_prime": false,
    "is_perfect": false,
    "properties": ["armstrong", "odd"],
    "digit_sum": 11,
    "fun_fact": "371 is an Armstrong number because 3³ + 7³ + 1³ = 371"
}
```

#### Error Response (400 Bad Request)

```json
{
    "number": "invalid_input",
    "error": true
}
```

### Property Definitions

- **Prime Number:** A natural number greater than 1 that is only divisible by 1 and itself
- **Perfect Number:** A positive integer that is equal to the sum of its proper divisors
- **Armstrong Number:** A number that is equal to the sum of its own digits raised to the power of the number of digits
- **Digit Sum:** The sum of all individual digits in the number

## Project Structure

```
number-api/
│
├── index.php          # Main API implementation
├── .htaccess         # Apache configuration
├── Dockerfile        # Docker configuration
├── docker-compose.yml # Docker Compose configuration
└── README.md         # This file
```

## Technical Details

- **Base Image:** PHP 8.2 with Apache
- **Port:** 8000
- **Dependencies:** PHP Curl extension
- **External API:** Numbers API (http://numbersapi.com)

## Error Handling

The API includes validation for:
- Invalid number formats
- Non-numeric inputs
- Decimal numbers
- Missing parameters
- Invalid HTTP methods

## Testing

You can test the API using curl:

```bash
# Test with a valid number
curl "http://localhost:8000/api/classify-number?number=371"

# Test with an invalid input
curl "http://localhost:8000/api/classify-number?number=abc"
```

Or using your web browser by visiting:
```
http://localhost:8000/api/classify-number?number=371
```

## Development

To make changes to the application:

1. Modify the code in `index.php`
2. Rebuild and restart the Docker container:
```bash
docker-compose down
docker-compose up -d --build
```

## Performance

- Response time: < 500ms (as per requirements)
- Efficient algorithms for number property calculations
- Minimal dependencies for fast execution

## Security

- Input validation to prevent injection attacks
- CORS headers for cross-origin resource sharing
- Apache configuration for secure deployment
