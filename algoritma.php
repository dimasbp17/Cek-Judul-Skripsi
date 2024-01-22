<?php

// membuat fungsi n-gram
function createNGram($value, $size)
{
    $nGramList = [];
    for ($i = 0; $i < strlen($value); $i++) {
        $str = substr($value, $i, $size);
        if (strlen($str) < $size) continue;
        $nGramList[] = $str;
    }
    return $nGramList;
}

// membuat fungsi rolling hash
function createHash($arrNGramList, $base, $nGramSize)
{
    $hashList = [];
    for ($i = 0; $i < sizeof($arrNGramList); $i++) {
        $arrASCII = str_split($arrNGramList[$i]);
        $result = 0;
        for ($k = 0; $k < $nGramSize; $k++) {
            $result += ord($arrASCII[$k]) * pow($base, $nGramSize - ($k + 1));
        }
        $hashList[] = $result;
    }
    return $hashList;
}

// membuat fungsi window
function createWindow($hashList, $windowSize)
{
    $windowList = [];
    for ($i = 0; $i < sizeof($hashList); $i++) {
        $result = array_slice($hashList, $i, $windowSize);
        if (sizeof($result) < $windowSize) continue;
        $windowList[][] = $result;
    }
    return $windowList;
}

// membuat fungsi fingerprint
function createFingerprint($windowList)
{
    $fingerprintList = [];
    for ($i = 0; $i < sizeof($windowList); $i++) {
        for ($k = 0; $k < sizeof($windowList[$i]); $k++) {
            $fingerprintList[] = min($windowList[$i][$k]);
        }
    }
    return $fingerprintList;
}

// membuat fungsi intersection
function getIntersection($finger1, $finger2)
{
    $result = 0;
    for ($i = 0; $i < sizeof($finger1); $i++) {
        for ($k = 0; $k < sizeof($finger2); $k++) {
            if ($finger1[$i] == $finger2[$k]) {
                $result += 1;
                break;
            }
        }
    }
    return $result;
}

// membuat fungsi kalkulasi
function calculate($intersection, $finger1, $finger2)
{
    $union = sizeof($finger1) + sizeof($finger2);
    return ($intersection / ($union - $intersection)) * 100;
}

function checkSimilarity($title1, $title2)
{
    $specialChar = [
        '{',
        '}',
        '!',
        '@',
        '#',
        '%',
        '^',
        '&',
        '*',
        '(',
        ')',
        '-',
        '_',
        '+',
        '=',
        '[',
        ']',
        ',',
        '.',
        ':',
        '/',
        '"',
        '`'
    ];

    // Pembuatan lowercase
    $title1 = strtolower($title1);
    $title2 = strtolower($title2);

    // menghapus spasi
    $title1 = join("", explode(' ', $title1));
    $title2 = join("", explode(' ', $title2));

    // menghapus tanda baca
    $title1 = str_replace($specialChar, '', $title1);
    $title2 = str_replace($specialChar, '', $title2);

    // membuat n-gram
    $nGramSize = 3;
    $nGramList1 = createNGram($title1, $nGramSize);
    $nGramList2 = createNGram($title2, $nGramSize);

    // membuat hash value
    $hashList1 = createHash($nGramList1, 2, $nGramSize);
    $hashList2 = createHash($nGramList2, 2, $nGramSize);

    // membuat window
    $windowSize = 5;
    $windowList1 = createWindow($hashList1, $windowSize);
    $windowList2 = createWindow($hashList2, $windowSize);

    // membuat fingerprint
    $fingerprintList1 = createFingerprint($windowList1);
    $fingerprintList2 = createFingerprint($windowList2);

    // mendapatkan intersection
    $intersection = getIntersection($fingerprintList1, $fingerprintList2);

    // menghitung persentase similarity
    $similarity = calculate($intersection, $fingerprintList1, $fingerprintList2);

    return [
        "percentage" => $similarity,
        "union" => sizeof($fingerprintList1) + sizeof($fingerprintList2),
        "intersection" => $intersection
    ];
}
