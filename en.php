<?php
// --- LOGICA PHP PENTRU FUNDAL ALEATORIU ---
$backgrounds = [
    'https://images.pexels.com/photos/5668772/pexels-photo-5668772.jpeg',
    'https://images.pexels.com/photos/3771097/pexels-photo-3771097.jpeg',
    'https://images.pexels.com/photos/606541/pexels-photo-606541.jpeg',
    'https://images.pexels.com/photos/159832/justice-law-case-hearing-159832.jpeg',
    'https://images.pexels.com/photos/8112199/pexels-photo-8112199.jpeg'
];
$randomBg = $backgrounds[array_rand($backgrounds)];

// --- PHP MAIL LOGIC ---
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$statusMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['trimite_contact'])) {
    require 'PHPmailer/Exception.php';
    require 'PHPmailer/PHPMailer.php';
    require 'PHPmailer/SMTP.php';
    $nume = strip_tags($_POST['nume']);
    $email_client = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mesaj_client = strip_tags($_POST['mesaj']);
    $cfg = require __DIR__ . '/config.php';
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = $cfg['smtp_host']; 
        $mail->SMTPAuth   = true;
        $mail->Username   = $cfg['smtp_user']; 
        $mail->Password   = $cfg['smtp_pass']; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = $cfg['smtp_port'];
        $mail->setFrom($cfg['from_email'], $cfg['from_name']);
        $mail->addAddress($cfg['to_email']); 
        $mail->addReplyTo($email_client, $nume);
        $mail->isHTML(true);
        $mail->Subject = "New Inquiry: $nume";
        $mail->Body    = "<h3>New inquiry from avocatbodu.ro (EN)</h3><p><strong>Name:</strong> $nume</p><p><strong>Email:</strong> $email_client</p><p><strong>Message:</strong><br>" . nl2br($mesaj_client) . "</p>";
        $mail->send();
        $statusMessage = "success";
    } catch (Exception $e) { $statusMessage = "error"; }
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corporate & Commercial Law Attorney and CCIR Arbitrator Bucharest | Prof. Dr. Sebastian V. Bodu</title>
    <meta name="description" content="Law office of Prof. Dr. Sebastian V. Bodu in Bucharest. Specialized in corporate, commercial, tax law and arbitration. Arbitrator at the CCIR Court of International Commercial Arbitration. Bucharest Bar member since 1996, ASE professor.">
    <meta name="keywords" content="lawyer Bucharest, corporate law attorney, commercial law Romania, CCIR arbitrator, Sebastian Bodu, business lawyer Bucharest, Court of International Commercial Arbitration, Bucharest Bar">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="author" content="Prof. Dr. Sebastian V. Bodu">
    <link rel="canonical" href="https://avocatbodu.ro/en.php">
    <link rel="alternate" hreflang="en" href="https://avocatbodu.ro/en.php">
    <link rel="alternate" hreflang="ro" href="https://avocatbodu.ro/">
    <link rel="alternate" hreflang="x-default" href="https://avocatbodu.ro/">
    <!-- Open Graph -->
    <meta property="og:title" content="Corporate Law Attorney and CCIR Arbitrator Bucharest | Prof. Dr. Sebastian V. Bodu">
    <meta property="og:description" content="Expert in business law and arbitrator at the CCIR Court of International Commercial Arbitration. Individual practice, Bucharest.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://avocatbodu.ro/en.php">
    <meta property="og:image" content="https://avocatbodu.ro/sebastianbodu.jpg">
    <meta property="og:image:alt" content="Prof. Dr. Sebastian V. Bodu">
    <meta property="og:locale" content="en_US">
    <meta property="og:site_name" content="Attorney Sebastian Bodu">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Corporate & Commercial Law Attorney and CCIR Arbitrator | Sebastian V. Bodu">
    <meta name="twitter:description" content="Business law attorney and CCIR arbitrator in Bucharest.">
    <meta name="twitter:image" content="https://avocatbodu.ro/sebastianbodu.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { serif: ['Cinzel', 'serif'], sans: ['Inter', 'sans-serif'] },
                    colors: { gold: '#D4AF37', pureBlack: '#000000' },
                    animation: { 'shimmer': 'shimmer 5s infinite linear' },
                    keyframes: { shimmer: { '0%': { backgroundPosition: '-200% 0' }, '100%': { backgroundPosition: '200% 0' } } }
                }
            }
        }
    </script>
    <style>
        body { background-color: #000; color: #fff; overflow-x: hidden; }
        #particles-js { position: fixed; width: 100%; height: 100%; z-index: 0; pointer-events: none; }
        .logo-shine { background: linear-gradient(90deg, #D4AF37 0%, #fff 50%, #D4AF37 100%); background-size: 200% auto; -webkit-background-clip: text; -webkit-text-fill-color: transparent; animation: shimmer 5s infinite linear; }
        .glass-card { background: rgba(15, 15, 15, 0.75); backdrop-filter: blur(12px); border: 1px solid rgba(212, 175, 55, 0.15); transition: all 0.4s ease; }
        .glass-card:hover { border-color: rgba(212, 175, 55, 0.6); transform: translateY(-5px); }
        .profile-frame-small { padding: 1px; background: linear-gradient(to bottom, #D4AF37, #111); max-width: 280px; }
        
        .hero-section {
            background-image: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.85)), url('<?php echo $randomBg; ?>');
            background-size: cover; background-position: center; background-attachment: fixed;
        }
        nav { z-index: 100 !important; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #D4AF37; }
    </style>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "Attorney",
          "@id": "https://avocatbodu.ro/en.php#attorney",
          "name": "Sebastian V. Bodu",
          "honorificPrefix": "Prof. Dr.",
          "jobTitle": "Attorney at Law, University Professor",
          "description": "Definitive member of the Bucharest Bar since 1996, specialized in corporate, commercial, tax, banking law and arbitration. Arbitrator at the CCIR Court of International Commercial Arbitration. Professor at Bucharest University of Economic Studies.",
          "url": "https://avocatbodu.ro/en.php",
          "image": "https://avocatbodu.ro/sebastianbodu.jpg",
          "telephone": "+40722509759",
          "email": "bodu.sebastian@gmail.com",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Str. Sfântul Spiridon, Nr. 10",
            "addressLocality": "Bucharest",
            "addressRegion": "Sector 2",
            "addressCountry": "RO"
          },
          "knowsAbout": ["Corporate Law", "Commercial Law", "Tax Law", "Banking Law", "Commercial Arbitration", "White-collar Crime", "CCIR Arbitrator"],
          "memberOf": {
            "@type": "Organization",
            "name": "Bucharest Bar"
          }
        },
        {
          "@type": "LegalService",
          "@id": "https://avocatbodu.ro/en.php#legalservice",
          "name": "Law Office of Prof. Dr. Sebastian V. Bodu",
          "url": "https://avocatbodu.ro/en.php",
          "description": "Business law practice specialized in corporate and commercial matters in Bucharest.",
          "telephone": "+40722509759",
          "email": "bodu.sebastian@gmail.com",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Str. Sfântul Spiridon, Nr. 10",
            "addressLocality": "Bucharest",
            "addressRegion": "Sector 2",
            "addressCountry": "RO"
          },
          "areaServed": "Bucharest, Romania",
          "serviceType": ["Corporate Law", "Commercial Law", "Tax Law", "Arbitration"]
        }
      ]
    }
    </script>
</head>
<body class="font-sans antialiased">
    <div id="particles-js"></div>
    <audio id="bgMusic" loop><source src="background-law.mp3" type="audio/mpeg"></audio>

    <nav class="fixed w-full z-50 bg-black/90 border-b border-gold/20 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 h-14 flex justify-between items-center">
            <div class="font-serif text-sm tracking-widest logo-shine uppercase font-bold">Prof. Dr. Sebastian Bodu</div>
            <div class="flex items-center">
                <div class="hidden md:flex space-x-6 text-[10px] uppercase tracking-widest mr-6 border-r border-white/10 pr-6">
                    <a href="#profil" class="hover:text-gold transition">Profile</a>
                    <a href="#experienta" class="hover:text-gold transition">Experience</a>
                    <a href="#carti" class="hover:text-gold transition">Books</a>
                    <a href="#contact" class="bg-gold text-black px-4 py-1.5 font-bold hover:bg-white transition">Contact</a>
                </div>
                <div class="flex space-x-2 text-[10px] font-bold uppercase tracking-widest">
                    <a href="index.php" class="text-gray-400 hover:text-gold transition">RO</a><span class="text-gray-600">|</span><a href="en.php" class="text-gold">EN</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="hidden md:block fixed top-20 right-6 z-40 w-80">
        <div class="glass-card p-5 text-left">
            <p class="text-gold text-[10px] uppercase tracking-[0.25em] mb-2 font-semibold">Advanced Legal Monitor</p>
            <p class="text-gray-300 text-xs leading-relaxed mb-4 font-light">Quick access to the advanced legal monitoring section: relevant updates, structured analysis, and practical tools for legal work.</p>
            <a href="https://avocatbodu.ro/monitor" target="_blank" rel="noopener noreferrer" class="inline-block border border-gold/60 text-gold px-5 py-2 text-[10px] uppercase tracking-widest font-bold hover:bg-gold hover:text-black transition">Open Monitor</a>
        </div>
    </div>
    <section class="min-h-screen flex flex-col justify-center items-center text-center px-6 hero-section">
        <div data-aos="zoom-out" data-aos-duration="2000" class="relative z-10">
            <p class="text-gold text-[10px] tracking-[0.5em] uppercase mb-4 opacity-80">Legal Rigor • Excellence • Doctrine</p>
            <h1 class="font-serif text-4xl md:text-6xl font-bold mb-4 tracking-tight leading-tight">Prof. Dr. <span class="logo-shine">Sebastian V. Bodu</span></h1>
            <h2 class="text-xs md:text-lg text-gray-400 mb-10 tracking-[0.2em] font-light uppercase">Attorney at Law • CCIR Arbitrator • MBA • PhD • Habil. | Corporate & Commercial Law Bucharest</h2>
            <a href="#contact" class="inline-block border border-gold text-gold py-3 px-10 transition-all hover:bg-gold hover:text-black uppercase tracking-widest text-[10px] font-bold">Elite Consultation</a>
        </div>
    </section>

    <section id="profil" class="py-20 px-6 max-w-7xl mx-auto border-t border-white/5">
        <div class="flex flex-col md:flex-row gap-12 items-center">
            <div class="w-full md:w-2/3 space-y-6" data-aos="fade-right">
                <h2 class="font-serif text-3xl text-gold uppercase tracking-widest border-b border-gold/10 pb-4">Academic & Professional Profile</h2>
                <div class="text-gray-300 leading-relaxed text-justify space-y-4 text-base md:text-lg font-light">
                    <p><strong>Prof. Dr. Sebastian V. Bodu</strong> has been a definitive member of the Bucharest Bar since 1996, amassing extensive <strong>experience</strong> in business law, coupled with a prestigious academic career.</p>
                    <p>He currently serves as a <strong>Full Professor</strong> at the Bucharest University of Economic Studies (ASE), leading courses in <em>Corporate</em> and <em>Commercial Law</em>. He is also a <strong>PhD Supervisor</strong> (Habilitated) in Law.</p>
                    <p>He is an <strong>arbitrator</strong> at the <strong>Court of International Commercial Arbitration attached to the Chamber of Commerce and Industry of Romania (CCIR)</strong>, handling complex commercial disputes.</p>
                </div>
            </div>
            <div class="w-full md:w-1/3 flex justify-center" data-aos="fade-left">
                <div class="profile-frame-small shadow-2xl"><img src="sebastianbodu.jpg" alt="Prof. Dr. Sebastian V. Bodu, Bucharest Bar attorney, corporate and commercial law specialist" class="w-full grayscale hover:grayscale-0 transition duration-1000"></div>
            </div>
        </div>
    </section>

    <section id="experienta" class="py-20 px-6 bg-[#030303]">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php 
            $exp = [
                ['Corporate Law', 'Governance, mergers and commercial litigation.'],
                ['Commercial Law', 'International contracts and complex transactions.'],
                ['Tax Law', 'Strategic consultancy and tax litigation.'],
                ['Economic Offenses', 'Specialized defense in white-collar crime.'],
                ['Banking & Capital', 'Regulation, compliance and capital markets.'],
                ['Arbitration', 'Complex patrimonial and business disputes.']
            ]; 
            foreach($exp as $i => $item): ?>
            <div class="glass-card p-8" data-aos="fade-up" data-aos-delay="<?= $i*50 ?>">
                <h3 class="font-serif text-gold text-sm uppercase mb-3 tracking-widest"><?= $item[0] ?></h3>
                <p class="text-gray-400 text-xs leading-relaxed font-light"><?= $item[1] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="carti" class="py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <h2 class="font-serif text-3xl text-gold uppercase tracking-widest text-center mb-12">Publications & Treatises</h2>
            <div class="max-w-4xl mx-auto glass-card p-10 mb-12 border-l-4 border-gold" data-aos="fade-up">
                <p class="text-gold text-lg md:text-xl font-serif italic mb-6">"Treatises and books represent an indispensable tool for practitioners, judges, prosecutors, and lawyers."</p>
                <p class="text-gray-400 text-sm font-light">Core reference works in business criminal law co-authored with <strong>Ciprian Bodu</strong> (Prosecutor, NIM Graduate).</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="https://www.emag.ro/tratat-de-drept-societar-sebastian-bodu-rosetti-ed-2025-ros978-606-025-137-8/pd/DZDBPJ3BM/" target="_blank" class="glass-card p-8 group text-center">
                    <p class="text-gold text-[9px] uppercase tracking-widest mb-3">eMAG.ro</p>
                    <h3 class="font-serif text-lg mb-3 group-hover:text-gold transition">Treatise on Corporate Law (2025)</h3>
                    <span class="text-[9px] font-bold text-gold uppercase tracking-widest">Order &rarr;</span>
                </a>
                <a href="https://www.ujmag.ro/drept/drept-comercial/tratat-de-drept-societar-editia-2025" target="_blank" class="glass-card p-8 group text-center">
                    <p class="text-gold text-[9px] uppercase tracking-widest mb-3">UJMag.ro</p>
                    <h3 class="font-serif text-lg mb-3 group-hover:text-gold transition">Universul Juridic</h3>
                    <span class="text-[9px] font-bold text-gold uppercase tracking-widest">Order &rarr;</span>
                </a>
                <a href="https://www.editurarosetti.ro/?id_autor=65" target="_blank" class="glass-card p-8 group text-center">
                    <p class="text-gold text-[9px] uppercase tracking-widest mb-3">Rosetti Publishing</p>
                    <h3 class="font-serif text-lg mb-3 group-hover:text-gold transition">Full Collection</h3>
                    <span class="text-[9px] font-bold text-gold uppercase tracking-widest">View All &rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <section id="contact" class="py-20 px-6 bg-[#030303] border-t border-white/5">
        <div class="max-w-3xl mx-auto glass-card p-10" data-aos="fade-up">
            <h2 class="font-serif text-xl text-gold mb-8 text-center uppercase tracking-widest">Secure Contact</h2>
            <form action="en.php#contact" method="POST" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="nume" placeholder="Name" required class="w-full bg-black/50 border border-white/10 p-3 text-white text-xs outline-none focus:border-gold transition">
                    <input type="email" name="email" placeholder="Email" required class="w-full bg-black/50 border border-white/10 p-3 text-white text-xs outline-none focus:border-gold transition">
                </div>
                <textarea name="mesaj" rows="3" placeholder="Brief case description" required class="w-full bg-black/50 border border-white/10 p-3 text-white text-xs outline-none focus:border-gold transition resize-none"></textarea>
                <button type="submit" name="trimite_contact" class="w-full bg-gold text-black font-bold py-3 uppercase tracking-widest text-[9px] hover:bg-white transition">Submit Inquiry</button>
            </form>
            <div class="mt-8 text-center text-gold text-[10px] tracking-widest font-semibold uppercase">bodu.sebastian@gmail.com | +40 722 509 759</div>
            <p class="text-center text-gray-500 text-xs mt-4">Str. Sfântul Spiridon, Nr. 10, Sector 2, Bucharest</p>
        </div>
    </section>
    <div class="md:hidden px-6 pb-20 bg-[#030303]">
        <div class="glass-card p-5 text-left max-w-xl mx-auto">
            <p class="text-gold text-[10px] uppercase tracking-[0.25em] mb-2 font-semibold">Advanced Legal Monitor</p>
            <p class="text-gray-300 text-xs leading-relaxed mb-4 font-light">Quick access to the advanced legal monitoring section: relevant updates, structured analysis, and practical tools for legal work.</p>
            <a href="https://avocatbodu.ro/monitor" target="_blank" rel="noopener noreferrer" class="inline-block border border-gold/60 text-gold px-5 py-2 text-[10px] uppercase tracking-widest font-bold hover:bg-gold hover:text-black transition">Open Monitor</a>
        </div>
    </div>

    
    <section class="py-12 px-6 max-w-7xl mx-auto border-t border-white/5">
        <h2 class="font-serif text-2xl text-gold uppercase tracking-widest text-center mb-4">Published Articles</h2>
        <p class="text-center text-gray-400 text-sm mb-8"><a href="/articole/" class="gold hover:underline">View all articles →</a></p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="/articole/arbitraj-comercial-ccir.php" class="glass-card p-6 hover:border-gold/60 transition">
                <h3 class="font-serif text-gold mb-2">Commercial Arbitration CCIR</h3>
                <p class="text-gray-400 text-sm">Guide to arbitration at the CCIR Court.</p>
            </a>
            <a href="/articole/drept-societar-ghid.php" class="glass-card p-6 hover:border-gold/60 transition">
                <h3 class="font-serif text-gold mb-2">Corporate Law</h3>
                <p class="text-gray-400 text-sm">Practical guide for companies.</p>
            </a>
            <a href="/articole/intrebari-frecvente.php" class="glass-card p-6 hover:border-gold/60 transition">
                <h3 class="font-serif text-gold mb-2">FAQ</h3>
                <p class="text-gray-400 text-sm">Frequently asked questions.</p>
            </a>
        </div>
    </section>

    <footer class="py-8 bg-black text-center text-[8px] text-gray-600 uppercase tracking-widest border-t border-gold/10">
        &copy; <?php echo date("Y"); ?> Law Office of Prof. Dr. Sebastian V. Bodu. | avocatbodu.ro
    </footer>

    <div class="fixed bottom-6 right-6 z-[60]">
        <button onclick="toggleMusic()" id="musicBtn" class="bg-black/50 border border-gold/50 p-3 rounded-full hover:bg-gold hover:text-black transition-all shadow-lg">
            <svg id="speakerIcon" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" /></svg>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        AOS.init({ once: true });
        particlesJS('particles-js', {"particles": {"number": {"value": 50},"color": {"value": "#D4AF37"},"opacity": {"value": 0.1},"size": {"value": 1.2},"move": {"enable": true, "speed": 0.6, "direction": "top"}}});
        const music = document.getElementById('bgMusic');
        function toggleMusic() { if (music.paused) { music.play(); document.getElementById('musicBtn').classList.add('bg-gold', 'text-black'); } else { music.pause(); document.getElementById('musicBtn').classList.remove('bg-gold', 'text-black'); } }
    </script>
</body>
</html>
