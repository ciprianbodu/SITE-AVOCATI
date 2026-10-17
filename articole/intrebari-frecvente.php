<?php
$title = "Întrebări Frecvente despre Avocat Drept Comercial și Arbitraj | Sebastian Bodu";
$description = "Răspunsuri la întrebări frecvente despre consultanță juridică, drept societar, comercial, arbitraj CCIR și cum poți contacta cabinetul.";
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <meta name="description" content="<?= $description ?>">
    <link rel="canonical" href="https://avocatbodu.ro/articole/intrebari-frecvente.php">
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        {"@type":"Question","name":"Ce domenii acoperă cabinetul?","acceptedAnswer":{"@type":"Answer","text":"Drept societar, drept comercial, fiscal, bancar, criminalitate economică și arbitraj comercial."}},
        {"@type":"Question","name":"Este Sebastian Bodu arbitru?","acceptedAnswer":{"@type":"Answer","text":"Da, este arbitru la Curtea de Arbitraj Comercial Internațional de pe lângă Camera de Comerț și Industrie a României (CCIR)."}},
        {"@type":"Question","name":"Cum pot solicita o consultanță?","acceptedAnswer":{"@type":"Answer","text":"Completați formularul de pe site sau scrieți la bodu.sebastian@gmail.com."}}
      ]
    }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { background:#000; color:#fff; } .gold { color:#D4AF37; }</style>
</head>
<body class="font-sans p-6 max-w-4xl mx-auto">
    <nav class="mb-8"><a href="/" class="gold hover:underline">← Înapoi</a></nav>
    <h1 class="text-3xl font-serif gold mb-6">Întrebări Frecvente</h1>
    <div class="space-y-6">
        <div><h2 class="text-lg gold">Ce domenii acoperă cabinetul?</h2><p class="text-gray-300">Drept societar, comercial, fiscal, bancar, criminalitate economică și arbitraj.</p></div>
        <div><h2 class="text-lg gold">Este Sebastian Bodu arbitru?</h2><p class="text-gray-300">Da, la Curtea de Arbitraj Comercial Internațional de pe lângă CCIR.</p></div>
        <div><h2 class="text-lg gold">Cum contactez cabinetul?</h2><p class="text-gray-300">Prin formularul de pe pagina principală sau la bodu.sebastian@gmail.com / +40 722 509 759.</p></div>
    </div>
    <footer class="mt-12 text-xs text-gray-600 text-center">© <?= date('Y') ?> Cabinet Avocat Sebastian Bodu</footer>
</body>
</html>
