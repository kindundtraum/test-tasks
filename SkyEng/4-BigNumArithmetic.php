<?php

/**
 * Разместила всё в одном файле чтобы было проще читать.
 * В большом проекте, да и в маленьком микросервисе тоже, предпочла бы создать класс Calculator,
 * у которого были бы реализованы методы для длинной арифметики, в частности сложение.
 * Тесты расположились бы в CalculatorTest.
 * Но здесь такого не требовалось, поэтому позволила себе в учебных целях поиспользовать старые-добрые функции.
 */

function addition(string $firstNumber, string $secondNumber): string
{
    $resultNum = '';

    $firstStrCurrentSymbolIndex = strlen($firstNumber) - 1;
    $secondStrCurrentSymbolIndex = strlen($secondNumber) - 1;
    $needPlusOne = false;

    while ($firstStrCurrentSymbolIndex >= 0 || $secondStrCurrentSymbolIndex >= 0) {
        // получение i-го / j-го байта нам вполне подойдёт, так как мы работаем с числами, а не с символами алфавита
        // не-число должно стать 0
        $firstStrCurrentSymbol = $firstStrCurrentSymbolIndex < 0
            ? 0
            : (int) $firstNumber[$firstStrCurrentSymbolIndex];
        $secondStrCurrentSymbol = $secondStrCurrentSymbolIndex < 0
            ? 0
            : (int) $secondNumber[$secondStrCurrentSymbolIndex];

        $currentValue = $needPlusOne
            ? $firstStrCurrentSymbol + $secondStrCurrentSymbol + 1
            : $firstStrCurrentSymbol + $secondStrCurrentSymbol;

        $resultNum = ((string) $currentValue % 10) . $resultNum;

        $needPlusOne = $currentValue >= 10;

        $firstStrCurrentSymbolIndex--;
        $secondStrCurrentSymbolIndex--;
    }

    if ($needPlusOne) {
        $resultNum = "1{$resultNum}";
    }

    return $resultNum;
}

assert('123' === addition('123', 'abc'));
assert(
    '2469135780246913578024691357802469135780246913578024691357802469135780246913578024691357802469135780' ===
    addition(
        '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',
        '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890'
    )
);
assert('2086443' === addition('1987456', '98987'));
