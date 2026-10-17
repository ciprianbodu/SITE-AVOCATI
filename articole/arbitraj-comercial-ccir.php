<?php
$title = "Arbitraj Comercial la Curtea de Arbitraj CCIR | Ghid Complet | Avocat Sebastian Bodu";
$description = "Ce este arbitrajul comercial la Curtea de Arbitraj Comercial Internațional de pe lângă CCIR? Avantaje, procedură și când este recomandat. Consultanță de la arbitru și avocat specializat.";
$keywords = "arbitraj comercial, Curtea de Arbitraj CCIR, arbitru București, litigii comerciale, soluționare dispute, avocat arbitraj";
$canonical = "https://avocatbodu.ro/articole/arbitraj-comercial-ccir.php";
include '../partials/header.php'; // we'll create a simple shared header or inline for simplicity
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <meta name="description" content="<?= $description ?>">
    <meta name="keywords" content="<?= $keywords ?>">
    <link rel="canonical" href="<?= $canonical ?>">
    <link rel="alternate" hreflang="ro" href="<?= $canonical ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { background:#000; color:#fff; } .gold { color:#D4AF37; }</style>
</head>
<body class="font-sans p-6 max-w-4xl mx-auto">
    <nav class="mb-8"><a href="/" class="gold hover:underline">← Înapoi la pagina principală</a></nav>
    <h1 class="text-3xl font-serif gold mb-6">Arbitraj Comercial la Curtea de Arbitraj Comercial Internațional (CCIR)</h1>
    <p class="mb-4 text-gray-300">Arbitrajul comercial este o metodă alternativă de soluționare a litigiilor dintre companii, mai rapidă și confidențială decât instanțele de judecată.</p>
    
    <h2 class="text-xl gold mt-8 mb-4">De ce să alegi arbitrajul la CCIR?</h2>
    <ul class="list-disc pl-6 space-y-2 text-gray-300">
        <li>Confidențialitate totală a procedurii</li>
        <li>Durată mult mai scurtă decât procesele civile</li>
        <li>Posibilitatea de a alege arbitri specializați în domeniul tău</li>
        <li>Hotărâri executorii în România și recunoscute internațional</li>
        <li>Flexibilitate procedurală</li>
    </ul>

    <h2 class="text-xl gold mt-8 mb-4">Când este recomandat arbitrajul?</h2>
    <p class="text-gray-300 mb-4">Pentru contracte comerciale complexe, dispute între asociați, interpretare de clauze contractuale, litigii internaționale sau când părțile doresc o soluție rapidă și discretă.</p>

    <h2 class="text-xl gold mt-8 mb-4">Rolul avocatului și al arbitrului</h2>
    <p class="text-gray-300">Prof. univ. dr. Sebastian V. Bodu este atât avocat specializat în drept comercial și societar, cât și arbitru la Curtea de Arbitraj Comercial Internațional de pe lângă CCIR. Poate oferi consultanță pentru redactarea clauzelor arbitrale, reprezentare în proceduri sau perspective din ambele părți.</p>

    <div class="mt-10 p-6 border border-gold/30 rounded">
        <h3 class="gold font-semibold mb-2">Ai nevoie de consultanță în arbitraj?</h3>
        <a href="/#contact" class="inline-block bg-gold text-black px-6 py-2 font-bold">Solicită o discuție</a>
    </div>
    <footer class="mt-12 text-xs text-gray-600 text-center">© <?= date('Y') ?> Cabinet Avocat Sebastian Bodu | avocatbodu.ro</footer>
</body>
</html>
