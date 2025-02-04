<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$number = $_GET['number'] ?? null;

if ($number === null || !is_numeric($number) || strpos($number, '.') !== false) {
    http_response_code(400);
    echo json_encode([
        'number' => $_GET['number'] ?? '',
        'error' => true
    ]);
    exit;
}

$number = (int)$number;

function isArmstrong(int $number): bool {
    $digits = str_split(abs($number));
    $power = strlen((string)abs($number));
    $sum = array_reduce($digits, function($carry, $digit) use ($power) {
        return $carry + pow((int)$digit, $power);
    }, 0); 

    return $sum === abs($number);
}

function isPerfect(int $number): bool {
    if ($number < 1) return false;

    $sum = 0;
    for ($i = 1; $i <= $number / 2; $i++) {
        if ($number % $i === 0) {
            $sum += $i;
        }
    }

    return $sum === $number;
}

function getDigitSum(int $number): int {
    return array_sum(str_split(abs($number)));
}

function getFunFact(int $number): string {
    $ch = curl_init("http://numbersapi.com/$number/math");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response ?: "$number is a boring number.";
}

$properties = [];

if ($number % 2 === 0) {
    $properties[] = 'even';
} else {
    $properties[] = 'odd';
}

if (isArmstrong($number)) {
    array_unshift($properties, 'armstrong');
}

function isPrime($number): bool
    {
        if ($number < 2) {
            return false;
        }

        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i === 0) {
                return false;
            }
        }

        return true;
    }

$response = [
    'number' => $number,
    'is_prime' => isPrime($number),
    'is_perfect' => isPerfect($number),
    'properties' => $properties,
    'digit_sum' => getDigitSum($number),
    'fun_fact' => getFunFact($number)
];

http_response_code(200);
echo json_encode($response);