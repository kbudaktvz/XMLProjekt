<?php include '_nav.php'; ?>
<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Real Madrid — Momčad</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    
    .site-nav {
      background: #0d0d0d;
      border-bottom: 1px solid #2a2a2a;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 48px;
      height: 56px;
      position: sticky;
      top: 0;
      z-index: 50;
    }
    .nav-logo {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      color: #F5F3EE;
      font-family: 'Bebas Neue', sans-serif;
      font-size: 18px;
      letter-spacing: 0.06em;
    }
    .nav-logo img { height: 28px; width: auto; }
    .nav-links { display: flex; gap: 4px; }
    .nav-links a {
      color: #b0aca4;
      text-decoration: none;
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      padding: 8px 14px;
      border-radius: 3px;
      transition: color 0.2s, background 0.2s;
    }
    .nav-links a:hover { color: #F5F3EE; background: #1a1a1a; }
    .nav-links a.active { color: #C8A96E; }

    :root {
      --gold:    #C8A96E;
      --gold-lt: #e2c992;
      --white:   #F5F3EE;
      --dark:    #0A0A0A;
      --mid:     #1A1A1A;
      --card:    #141414;
      --border:  #2a2a2a;
      --text:    #b0aca4;
    }

    body { background: var(--dark); color: var(--white); font-family: 'Inter', sans-serif; min-height: 100vh; }

    .hero {
      position: relative;
      height: 420px;
      overflow: hidden;
      display: flex;
      align-items: flex-end;
    }
    .hero img.hero-bg {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center 30%;
      filter: brightness(0.35);
    }
    .hero-content {
      position: relative;
      z-index: 2;
      padding: 0 48px 40px;
      width: 100%;
    }
    .hero-eyebrow {
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: var(--gold);
      margin-bottom: 8px;
    }
    .hero h1 {
      font-family: 'Bebas Neue', sans-serif;
      font-size: clamp(52px, 8vw, 96px);
      line-height: 0.92;
      letter-spacing: 0.02em;
      color: var(--white);
    }
    .hero h1 span { color: var(--gold); }
    .hero-meta { margin-top: 14px; font-size: 13px; color: var(--text); letter-spacing: 0.04em; }

    .filters {
      background: var(--mid);
      border-bottom: 1px solid var(--border);
      padding: 0 48px;
      display: flex;
      align-items: center;
      gap: 4px;
      overflow-x: auto;
    }
    .filter-btn {
      background: none;
      border: none;
      color: var(--text);
      font-family: 'Inter', sans-serif;
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      padding: 16px 18px;
      cursor: pointer;
      border-bottom: 2px solid transparent;
      white-space: nowrap;
      transition: color 0.2s, border-color 0.2s;
    }
    .filter-btn:hover { color: var(--white); }
    .filter-btn.active { color: var(--gold); border-bottom-color: var(--gold); }

    .grid-wrap { padding: 40px 48px 64px; max-width: 1400px; margin: 0 auto; }
    .section-label { font-size: 11px; font-weight: 600; letter-spacing: 0.15em; text-transform: uppercase; color: var(--gold); margin-bottom: 24px; }
    .squad-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 20px; }

    .player-card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 4px;
      overflow: hidden;
      cursor: pointer;
      transition: transform 0.2s, border-color 0.2s;
      display: block;
    }
    .player-card:hover { transform: translateY(-4px); border-color: var(--gold); }
    .card-img { width: 100%; aspect-ratio: 3/4; object-fit: cover; object-position: top; display: block; background: #1e1e1e; }
    .card-body { padding: 14px 14px 16px; }
    .card-number { font-family: 'Bebas Neue', sans-serif; font-size: 28px; color: var(--gold); line-height: 1; }
    .card-name { font-size: 13px; font-weight: 600; color: var(--white); margin-top: 4px; line-height: 1.3; }
    .card-pos { font-size: 11px; color: var(--text); margin-top: 3px; }
    .card-nat { font-size: 11px; color: var(--text); margin-top: 2px; }

    .modal-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.85);
      z-index: 100;
      align-items: center;
      justify-content: center;
      padding: 24px;
    }
    .modal-overlay.open { display: flex; }
    .modal {
      background: var(--mid);
      border: 1px solid var(--border);
      border-radius: 6px;
      max-width: 480px;
      width: 100%;
      overflow: hidden;
      position: relative;
      animation: fadeUp 0.2s ease;
    }
    @keyframes fadeUp { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:translateY(0); } }
    .modal-close { position: absolute; top: 14px; right: 16px; background: none; border: none; color: var(--text); font-size: 22px; cursor: pointer; z-index: 2; }
    .modal-close:hover { color: var(--white); }
    .modal-img { width: 100%; height: 260px; object-fit: cover; object-position: top; display: block; }
    .modal-body { padding: 24px; }
    .modal-number { font-family: 'Bebas Neue', sans-serif; font-size: 48px; color: var(--gold); line-height: 1; }
    .modal-name { font-family: 'Bebas Neue', sans-serif; font-size: 32px; color: var(--white); line-height: 1.1; margin-top: 4px; }
    .modal-divider { height: 1px; background: var(--border); margin: 18px 0; }
    .modal-stat { display: flex; justify-content: space-between; font-size: 13px; padding: 6px 0; border-bottom: 1px solid var(--border); }
    .modal-stat:last-child { border-bottom: none; }
    .modal-stat span:first-child { color: var(--text); }
    .modal-stat span:last-child { color: var(--white); font-weight: 600; }
    .status { padding: 80px 48px; text-align: center; color: var(--text); font-size: 14px; }

    @media (max-width: 640px) {
      .hero { height: 300px; }
      .hero-content, .filters, .grid-wrap { padding-left: 20px; padding-right: 20px; }
      .squad-grid { grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); }
    }
  </style>
</head>
<body>

<header class="hero">
  <img class="hero-bg"
       src="https://images.unsplash.com/photo-1522778119026-d647f0596c20?w=1400&auto=format&fit=crop"
       alt="Stadion Santiago Bernabéu" />
  <div class="hero-content">
    <p class="hero-eyebrow">Službena momčad</p>
    <h1>REAL<br><span>MADRID</span></h1>
    <p class="hero-meta" id="hero-meta">Učitavanje podataka…</p>
  </div>
</header>

<nav class="filters" id="filters">
  <button class="filter-btn active" data-pos="all">Svi</button>
  <button class="filter-btn" data-pos="Goalkeeper">Golmani</button>
  <button class="filter-btn" data-pos="Defender">Braniči</button>
  <button class="filter-btn" data-pos="Midfielder">Vezni igrači</button>
  <button class="filter-btn" data-pos="Forward">Napadači</button>
</nav>

<main class="grid-wrap">
  <p class="section-label" id="section-label">Prva momčad</p>
  <div class="squad-grid" id="squad-grid">
    <p class="status" style="grid-column:1/-1">Učitavanje igrača…</p>
  </div>
</main>

<div class="modal-overlay" id="modal-overlay">
  <div class="modal" id="modal">
    <button class="modal-close" id="modal-close">✕</button>
    <img class="modal-img" id="modal-img" src="" alt="" />
    <div class="modal-body">
      <div class="modal-number" id="modal-number"></div>
      <div class="modal-name"   id="modal-name"></div>
      <div class="modal-divider"></div>
      <div id="modal-stats"></div>
    </div>
  </div>
</div>

<script>
  const positionHR = { Goalkeeper: 'Golman', Defender: 'Branič', Midfielder: 'Vezni igrač', Forward: 'Napadač' };

  let allPlayers = [];
  let activeFilter = 'all';

  async function loadSquad() {
    try {
      const res  = await fetch('api.php');
      if (!res.ok) throw new Error('Greška API-ja ' + res.status);
      const data = await res.json();
      allPlayers = data.players;
      document.getElementById('hero-meta').textContent =
        `${data.season}  ·  ${data.stadium}  ·  ${allPlayers.length} igrača`;
      renderGrid(allPlayers);
    } catch (err) {
      document.getElementById('squad-grid').innerHTML =
        `<p class="status" style="grid-column:1/-1"> Nije moguće učitati podatke o momčadi.<br><small>${err.message}</small></p>`;
    }
  }

  function renderGrid(players) {
    const grid  = document.getElementById('squad-grid');
    const label = document.getElementById('section-label');

    if (activeFilter === 'all') {
      label.textContent = `Prva momčad — ${players.length} igrača`;
    } else {
      label.textContent = `${positionHR[activeFilter] || activeFilter}i — ${players.length} igrača`;
    }

    if (!players.length) {
      grid.innerHTML = '<p class="status" style="grid-column:1/-1">Nema igrača.</p>';
      return;
    }

    grid.innerHTML = players
      .sort((a,b) => a.number - b.number)
      .map(p => `
        <div class="player-card" onclick="openModal(${p.id})">
          <img class="card-img" src="${p.image}" alt="${p.name}"
               onerror="this.src='https://upload.wikimedia.org/wikipedia/en/5/56/Real_Madrid_CF.svg';this.style.padding='20px'">
          <div class="card-body">
            <div class="card-number">${p.number}</div>
            <div class="card-name">${p.name}</div>
            <div class="card-pos">${positionHR[p.position] || p.position}</div>
            <div class="card-nat">${p.nationality}</div>
          </div>
        </div>
      `).join('');
  }

  document.getElementById('filters').addEventListener('click', e => {
    const btn = e.target.closest('.filter-btn');
    if (!btn) return;
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    activeFilter = btn.dataset.pos;
    const filtered = activeFilter === 'all' ? allPlayers : allPlayers.filter(p => p.position === activeFilter);
    renderGrid(filtered);
  });

  function openModal(id) {
    const p = allPlayers.find(pl => pl.id === id);
    if (!p) return;
    document.getElementById('modal-img').src = p.image;
    document.getElementById('modal-img').alt = p.name;
    document.getElementById('modal-number').textContent = '#' + p.number;
    document.getElementById('modal-name').textContent = p.name;
    document.getElementById('modal-stats').innerHTML = `
      <div class="modal-stat"><span>Pozicija</span><span>${positionHR[p.position] || p.position}</span></div>
      <div class="modal-stat"><span>Nacionalnost</span><span>${p.nationality}</span></div>
      <div class="modal-stat"><span>Dob</span><span>${p.age}</span></div>
      <div class="modal-stat"><span>Broj dresa</span><span>${p.number}</span></div>
    `;
    document.getElementById('modal-overlay').classList.add('open');
  }

  document.getElementById('modal-close').addEventListener('click', closeModal);
  document.getElementById('modal-overlay').addEventListener('click', e => {
    if (e.target === document.getElementById('modal-overlay')) closeModal();
  });
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
  function closeModal() { document.getElementById('modal-overlay').classList.remove('open'); }

  loadSquad();
</script>
</body>
</html>
