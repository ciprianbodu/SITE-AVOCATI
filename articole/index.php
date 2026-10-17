<?php
$title = "Articole Publicate | Drept Societar, Arbitraj, Ghiduri | Avocat Sebastian Bodu";
$description = "Articole și ghiduri practice despre drept societar, arbitraj comercial la CCIR, întrebări frecvente și consultanță juridică de afaceri.";
?>
<!DOCTYPE html>
<html lang="ro" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <meta name="description" content="<?= $description ?>">
    <meta name="keywords" content="articole drept societar, arbitraj CCIR, ghiduri juridice, avocat București">
    <link rel="canonical" href="https://avocatbodu.ro/articole/">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background:#000; color:#fff; }
        .gold { color:#D4AF37; }
        .glass-card { background: rgba(15,15,15,0.75); border: 1px solid rgba(212,175,55,0.15); }
    </style>
</head>
<body class="font-sans antialiased">
    <nav class="fixed w-full z-50 bg-black/90 border-b border-gold/20 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 h-14 flex justify-between items-center">
            <a href="/" class="font-serif text-sm tracking-widest gold uppercase font-bold">Prof. Dr. Sebastian Bodu</a>
            <a href="/" class="text-xs uppercase tracking-widest hover:text-gold">← Acasă</a>
        </div>
    </nav>

    <main class="pt-24 pb-16 px-6 max-w-5xl mx-auto">
        <h1 class="font-serif text-4xl gold text-center mb-4">Articole Publicate</h1>
        <p class="text-center text-gray-400 mb-12">Ghiduri și analize practice în drept societar, comercial și arbitraj.</p>

        <div class="grid gap-6">
            <a href="arbitraj-comercial-ccir.php" class="glass-card p-8 block hover:border-gold/60 transition">
                <p class="text-gold text-xs uppercase tracking-widest mb-2">Arbitraj</p>
                <h2 class="font-serif text-2xl mb-3">Arbitraj Comercial la Curtea de Arbitraj CCIR</h2>
                <p class="text-gray-300 text-sm">Ce este arbitrajul comercial, avantajele procedurii la CCIR și când este recomandat.</p>
                <span class="text-gold text-xs mt-4 inline-block">Citește articolul →</span>
            </a>

            <a href="drept-societar-ghid.php" class="glass-card p-8 block hover:border-gold/60 transition">
                <p class="text-gold text-xs uppercase tracking-widest mb-2">Drept Societar</p>
                <h2 class="font-serif text-2xl mb-3">Drept Societar: Ghid pentru Companii și Antreprenori</h2>
                <p class="text-gray-300 text-sm">Teme esențiale: guvernanță, asociați, fuziuni, litigii corporative.</p>
                <span class="text-gold text-xs mt-4 inline-block">Citește articolul →</span>
            </a>

            <a href="intrebari-frecvente.php" class="glass-card p-8 block hover:border-gold/60 transition">
                <p class="text-gold text-xs uppercase tracking-widest mb-2">FAQ</p>
                <h2 class="font-serif text-2xl mb-3">Întrebări Frecvente</h2>
                <p class="text-gray-300 text-sm">Răspunsuri la întrebările comune despre domenii de practică, arbitraj și contact.</p>
                <span class="text-gold text-xs mt-4 inline-block">Citește articolul →</span>
            </a>
        </div>

        <div class="mt-12 text-center">
            <a href="/#contact" class="inline-block border border-gold text-gold py-3 px-8 uppercase tracking-widest text-xs font-bold hover:bg-gold hover:text-black transition">Solicită consultanță</a>
        </div>
    </main>

    <footer class="py-8 bg-black text-center text-[8px] text-gray-600 uppercase tracking-widest border-t border-gold/10">
        &copy; <?= date("Y") ?> Cabinet de Avocat Prof. Univ. Dr. Sebastian V. Bodu. | avocatbodu.ro
    </footer>
</body>
</html>
