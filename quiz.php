<?php include '_nav.php'; ?>
<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Real Madrid — Kviz</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root { --gold:#C8A96E; --white:#F5F3EE; --dark:#0A0A0A; --mid:#1A1A1A; --card:#141414; --border:#2a2a2a; --text:#b0aca4; --green:#4caf50; --red:#e05252; }
    body { background: var(--dark); color: var(--white); font-family: 'Inter', sans-serif; min-height: 100vh; }

    .site-nav { background:#0d0d0d; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; padding:0 48px; height:56px; position:sticky; top:0; z-index:50; }
    .nav-logo { display:flex; align-items:center; gap:10px; text-decoration:none; color:var(--white); font-family:'Bebas Neue',sans-serif; font-size:18px; letter-spacing:0.06em; }
    .nav-logo img { height:28px; }
    .nav-links { display:flex; gap:4px; }
    .nav-links a { color:var(--text); text-decoration:none; font-size:12px; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; padding:8px 14px; border-radius:3px; transition:color 0.2s,background 0.2s; }
    .nav-links a:hover { color:var(--white); background:#1a1a1a; }
    .nav-links a.active { color:var(--gold); }

    .hero { position:relative; height:340px; overflow:hidden; display:flex; align-items:flex-end; }
    .hero-bg { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center 55%; filter:brightness(0.28); }
    .hero-content { position:relative; z-index:2; padding:0 48px 40px; }
    .hero-eyebrow { font-size:11px; font-weight:600; letter-spacing:0.18em; text-transform:uppercase; color:var(--gold); margin-bottom:8px; }
    .hero h1 { font-family:'Bebas Neue',sans-serif; font-size:clamp(52px,8vw,90px); line-height:0.92; color:var(--white); }
    .hero h1 span { color:var(--gold); }

    .quiz-wrap { max-width:640px; margin:48px auto; padding:0 24px 80px; }

    .progress-bar-wrap { margin-bottom:32px; }
    .progress-label { display:flex; justify-content:space-between; font-size:11px; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:var(--text); margin-bottom:8px; }
    .progress-track { height:3px; background:var(--border); border-radius:2px; overflow:hidden; }
    .progress-fill { height:100%; background:var(--gold); border-radius:2px; transition:width 0.4s ease; }

    .question-card { background:var(--card); border:1px solid var(--border); border-radius:6px; overflow:hidden; }
    .question-img { width:100%; height:220px; object-fit:cover; object-position:center; display:block; }
    .question-body { padding:28px; }
    .question-num { font-size:11px; font-weight:600; letter-spacing:0.15em; text-transform:uppercase; color:var(--gold); margin-bottom:10px; }
    .question-text { font-size:18px; font-weight:600; color:var(--white); line-height:1.4; margin-bottom:24px; }

    .options { display:flex; flex-direction:column; gap:10px; }
    .option-btn { background:var(--mid); border:1px solid var(--border); border-radius:4px; color:var(--white); font-family:'Inter',sans-serif; font-size:14px; font-weight:500; padding:14px 18px; text-align:left; cursor:pointer; transition:border-color 0.15s,background 0.15s; }
    .option-btn:hover:not(:disabled) { border-color:var(--gold); background:#1e1e1e; }
    .option-btn.correct { border-color:var(--green); background:rgba(76,175,80,0.12); color:var(--green); }
    .option-btn.wrong   { border-color:var(--red);   background:rgba(224,82,82,0.12);  color:var(--red); }
    .option-btn:disabled { cursor:default; }

    .feedback { margin-top:16px; font-size:13px; color:var(--text); min-height:20px; line-height:1.5; }
    .feedback.right { color:var(--green); }
    .feedback.wrong  { color:var(--red); }

    .next-btn { display:none; margin-top:20px; background:var(--gold); border:none; border-radius:4px; color:var(--dark); font-family:'Inter',sans-serif; font-size:12px; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; padding:13px 28px; cursor:pointer; transition:background 0.2s; }
    .next-btn:hover { background:#e2c992; }

    .results-card { background:var(--card); border:1px solid var(--border); border-radius:6px; overflow:hidden; text-align:center; }
    .results-img { width:100%; height:200px; object-fit:cover; object-position:center 30%; filter:brightness(0.5); display:block; }
    .results-body { padding:36px 28px; }
    .results-score-label { font-size:11px; font-weight:600; letter-spacing:0.15em; text-transform:uppercase; color:var(--text); margin-bottom:8px; }
    .results-score { font-family:'Bebas Neue',sans-serif; font-size:72px; color:var(--gold); line-height:1; }
    .results-rating { font-size:18px; font-weight:600; color:var(--white); margin-top:8px; }
    .results-sub { font-size:13px; color:var(--text); margin-top:6px; }
    .retry-btn { margin-top:28px; background:var(--gold); border:none; border-radius:4px; color:var(--dark); font-family:'Inter',sans-serif; font-size:12px; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; padding:13px 32px; cursor:pointer; transition:background 0.2s; }
    .retry-btn:hover { background:#e2c992; }

    @media (max-width:640px) {
      .hero { height:260px; }
      .hero-content { padding-left:20px; padding-right:20px; }
      .question-img { height:160px; }
    }
  </style>
</head>
<body>

<header class="hero">
  <img class="hero-bg"
       src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=1400&auto=format&fit=crop"
       alt="Nogometni stadion" />
  <div class="hero-content">
    <p class="hero-eyebrow">Provjeri svoje znanje</p>
    <h1>HALA<br><span>MADRID</span></h1>
  </div>
</header>

<div class="quiz-wrap">
  <div id="quiz-container"></div>
</div>

<script>
const questions = [
  {
    text: "Koje godine je osnovan Real Madrid?",
    image: "https://images.unsplash.com/photo-1517927033932-b3d18e61fb3a?w=800&auto=format&fit=crop",
    options: ["1895", "1900", "1902", "1910"],
    answer: 2,
    fact: "Real Madrid CF osnovan je 6. ožujka 1902. godine."
  },
  {
    text: "Koliko puta je Real Madrid osvoji Ligu prvaka?",
    image: "https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=800&auto=format&fit=crop",
    options: ["12", "14", "15", "16"],
    answer: 2,
    fact: "Real Madrid je 2024. osvoji 15. Ligu prvaka, pobijedivši Borussiu Dortmund."
  },
  {
    text: "Tko je povijesno najveći strijelac Real Madrida?",
    image: "https://images.unsplash.com/photo-1543326727-cf6c39e8f84c?w=800&auto=format&fit=crop",
    options: ["Raúl", "Cristiano Ronaldo", "Hugo Sánchez", "Alfredo Di Stéfano"],
    answer: 1,
    fact: "Cristiano Ronaldo zabio je 450 golova u 438 nastupa za Real Madrid između 2009. i 2018."
  },
  {
    text: "Koji igrač nosi broj 7 u trenutnoj momčadi?",
    image: "https://img.a.transfermarkt.technology/portrait/big/371998-1695207768.jpg",
    options: ["Rodrygo", "Vinícius Júnior", "Mbappé", "Brahim Díaz"],
    answer: 1,
    fact: "Vinícius Júnior nosi broj 7 — povijesni dres koji su prije nosili Raúl i Cristiano Ronaldo."
  },
  {
    text: "Kako se zove stadion Real Madrida?",
    image: "https://images.unsplash.com/photo-1522778119026-d647f0596c20?w=800&auto=format&fit=crop",
    options: ["Camp Nou", "Wanda Metropolitano", "Santiago Bernabéu", "La Cartuja"],
    answer: 2,
    fact: "Santiago Bernabéu otvoren je 1947. godine i nedavno je prošao veliku obnovu dovršenu 2023."
  },
  {
    text: "Koju nacionalnu reprezentaciju zastupa Jude Bellingham?",
    image: "https://img.a.transfermarkt.technology/portrait/big/581678-1695207928.jpg",
    options: ["Njemačka", "Francuska", "Engleska", "Španjolska"],
    answer: 2,
    fact: "Jude Bellingham potpisao je za Real Madrid 2023. iz Borussie Dortmund za 103 milijuna eura."
  },
  {
    text: "Koje boje nose Real Madrid na domaćim utakmicama?",
    image: "https://images.unsplash.com/photo-1508098682722-e99c43a406b2?w=800&auto=format&fit=crop",
    options: ["Plava", "Crveno-bijela", "Sve bijela", "Zlatno-bijela"],
    answer: 2,
    fact: "Real Madrid se zove Los Blancos (Bijeli) zbog tradicijskog dresa koji je potpuno bijel."
  },
  {
    text: "Iz kojeg kluba je Kylian Mbappé prešao u Real Madrid?",
    image: "https://img.a.transfermarkt.technology/portrait/big/342229-1695207659.jpg",
    options: ["Monaco", "Paris Saint-Germain", "Marseille", "Lyon"],
    answer: 1,
    fact: "Mbappé je kao slobodan igrač prešao iz PSG-a u Real Madrid ljeti 2024., nakon godina nagađanja."
  }
];

let current = 0;
let score   = 0;
let answered = false;

function render() {
  if (current >= questions.length) { showResults(); return; }

  const q   = questions[current];
  const pct = Math.round((current / questions.length) * 100);

  document.getElementById('quiz-container').innerHTML = `
    <div class="progress-bar-wrap">
      <div class="progress-label">
        <span>Pitanje ${current + 1} od ${questions.length}</span>
        <span>${score} točno</span>
      </div>
      <div class="progress-track"><div class="progress-fill" style="width:${pct}%"></div></div>
    </div>
    <div class="question-card">
      <img class="question-img" src="${q.image}" alt="" onerror="this.style.display='none'">
      <div class="question-body">
        <div class="question-num">Pitanje ${current + 1}</div>
        <div class="question-text">${q.text}</div>
        <div class="options">
          ${q.options.map((opt, i) => `<button class="option-btn" onclick="choose(${i})">${opt}</button>`).join('')}
        </div>
        <div class="feedback" id="feedback"></div>
        <button class="next-btn" id="next-btn" onclick="next()">
          ${current + 1 === questions.length ? 'Pogledaj rezultate' : 'Sljedeće pitanje →'}
        </button>
      </div>
    </div>
  `;
  answered = false;
}

function choose(idx) {
  if (answered) return;
  answered = true;
  const q    = questions[current];
  const btns = document.querySelectorAll('.option-btn');
  const fb   = document.getElementById('feedback');
  btns.forEach(b => b.disabled = true);
  if (idx === q.answer) {
    btns[idx].classList.add('correct');
    fb.textContent = '✓ Točno! ' + q.fact;
    fb.className   = 'feedback right';
    score++;
  } else {
    btns[idx].classList.add('wrong');
    btns[q.answer].classList.add('correct');
    fb.textContent = '✗ Nije točno. ' + q.fact;
    fb.className   = 'feedback wrong';
  }
  document.getElementById('next-btn').style.display = 'inline-block';
}

function next() { current++; render(); }

function showResults() {
  const pct = Math.round((score / questions.length) * 100);
  let rating, sub;
  if      (pct === 100) { rating = "Legenda Real Madrida";  sub = "Savršen rezultat. Krvarite bijelo!"; }
  else if (pct >= 75)   { rating = "Pravi Madridista";      sub = "Izvrsno poznavanje kluba."; }
  else if (pct >= 50)   { rating = "Solidan navijač";       sub = "Dobro — ali gledaj više utakmica!"; }
  else if (pct >= 25)   { rating = "Povremeni navijač";     sub = "Ima mjesta za napredak. Učite povijest!"; }
  else                  { rating = "Jeste li Barçin navijač?"; sub = "Vrijeme je za učenje o Los Blancos!"; }

  document.getElementById('quiz-container').innerHTML = `
    <div class="results-card">
      <img class="results-img"
           src="https://images.unsplash.com/photo-1522778119026-d647f0596c20?w=800&auto=format&fit=crop"
           alt="Slavlje Real Madrida" />
      <div class="results-body">
        <div class="results-score-label">Vaš rezultat</div>
        <div class="results-score">${score}/${questions.length}</div>
        <div class="results-rating">${rating}</div>
        <div class="results-sub">${sub}</div>
        <button class="retry-btn" onclick="restart()">Pokušaj ponovo</button>
      </div>
    </div>
  `;
}

function restart() { current = 0; score = 0; answered = false; render(); }

render();
</script>
</body>
</html>
