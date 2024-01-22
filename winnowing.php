<?php
function winnowing($text, $k){
    $hashes = array(); // array untuk menyimpan hash nilai
    $minHash = PHP_INT_MAX; // inisialisasi minHash dengan nilai maksimum
    $fingerprint = array(); // array untuk menyimpan fingerprint
    $textLength = strlen($text);

    if($k > $textLength){
        echo "Error: Nilai k lebih besar dari panjang teks.";
        return;
    }

    // Mencari hash minimum dalam jendela pertama
    for($i = 0; $i < $k; $i++){
        $minHash = min($minHash, ord($text[$i]));
    }
    $hashes[] = $minHash;

    // Mencari hash minimum untuk jendela berikutnya
    for($i = $k; $i < $textLength; $i++){
        if(ord($text[$i - $k]) == $minHash){
            $minHash = ord($text[$i - $k + 1]);
            for($j = $i - $k + 1; $j <= $i; $j++){
                $minHash = min($minHash, ord($text[$j]));
            }
        }
        else{
            $minHash = min($minHash, ord($text[$i]));
        }
        $hashes[] = $minHash;
    }

    // Mencari fingerprint dari hash nilai
    $windowStart = 0;
    $windowEnd = $k - 1;
    while($windowEnd < $textLength){
        $minIndex = $windowStart;
        for($i = $windowStart + 1; $i <= $windowEnd; $i++){
            if($hashes[$i] < $hashes[$minIndex]){
                $minIndex = $i;
            }
        }
        $fingerprint[] = $hashes[$minIndex];
        $windowStart++;
        $windowEnd++;
    }

    return $fingerprint;
}

// Contoh penggunaan algoritma Winnowing
$text = "Ini adalah contoh teks yang akan diuji menggunakan algoritma Winnowing dalam PHP. Algoritma ini berguna untuk menemukan pola dalam teks.";
$k = 5; // Panjang jendela (window size)

$fingerprint = winnowing($text, $k);
echo "Fingerprint: " . implode(", ", $fingerprint);
?>
