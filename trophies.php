<?php include '_nav.php'; ?>
<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Real Madrid — Trofeji</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root { --gold:#C8A96E; --white:#F5F3EE; --dark:#0A0A0A; --mid:#1A1A1A; --card:#141414; --border:#2a2a2a; --text:#b0aca4; }
    body { background: var(--dark); color: var(--white); font-family: 'Inter', sans-serif; min-height: 100vh; }

    .site-nav { background:#0d0d0d; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; padding:0 48px; height:56px; position:sticky; top:0; z-index:50; }
    .nav-logo { display:flex; align-items:center; gap:10px; text-decoration:none; color:var(--white); font-family:'Bebas Neue',sans-serif; font-size:18px; letter-spacing:0.06em; }
    .nav-logo img { height:28px; }
    .nav-links { display:flex; gap:4px; }
    .nav-links a { color:var(--text); text-decoration:none; font-size:12px; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; padding:8px 14px; border-radius:3px; transition:color 0.2s,background 0.2s; }
    .nav-links a:hover { color:var(--white); background:#1a1a1a; }
    .nav-links a.active { color:var(--gold); }

    .hero { position:relative; height:380px; overflow:hidden; display:flex; align-items:flex-end; }
    .hero-bg { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center 40%; filter:brightness(0.3); }
    .hero-content { position:relative; z-index:2; padding:0 48px 40px; }
    .hero-eyebrow { font-size:11px; font-weight:600; letter-spacing:0.18em; text-transform:uppercase; color:var(--gold); margin-bottom:8px; }
    .hero h1 { font-family:'Bebas Neue',sans-serif; font-size:clamp(52px,8vw,90px); line-height:0.92; color:var(--white); }
    .hero h1 span { color:var(--gold); }

    .total-bar { background:var(--gold); padding:14px 48px; display:flex; align-items:center; gap:16px; }
    .total-bar .big-num { font-family:'Bebas Neue',sans-serif; font-size:42px; color:var(--dark); line-height:1; }
    .total-bar .big-label { font-size:12px; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; color:rgba(0,0,0,0.6); line-height:1.4; }

    .filters { background:var(--mid); border-bottom:1px solid var(--border); padding:0 48px; display:flex; gap:4px; }
    .filter-btn { background:none; border:none; color:var(--text); font-family:'Inter',sans-serif; font-size:12px; font-weight:600; letter-spacing:0.08em; text-transform:uppercase; padding:16px 18px; cursor:pointer; border-bottom:2px solid transparent; white-space:nowrap; transition:color 0.2s,border-color 0.2s; }
    .filter-btn:hover { color:var(--white); }
    .filter-btn.active { color:var(--gold); border-bottom-color:var(--gold); }

    .trophy-wrap { padding:48px; max-width:960px; margin:0 auto; display:flex; flex-direction:column; gap:2px; }
    .trophy-row { background:var(--card); border:1px solid var(--border); border-radius:4px; display:grid; grid-template-columns:72px 1fr auto; align-items:center; gap:24px; padding:20px 24px; cursor:pointer; transition:border-color 0.2s,background 0.2s; }
    .trophy-row:hover { border-color:var(--gold); background:#181818; }
    .trophy-icon { width:56px; height:56px; object-fit:contain; filter:drop-shadow(0 0 8px rgba(200,169,110,0.3)); }
    .trophy-name { font-size:16px; font-weight:600; color:var(--white); }
    .trophy-cat { font-size:11px; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:var(--text); margin-top:3px; }
    .trophy-desc { font-size:12px; color:var(--text); margin-top:6px; line-height:1.5; display:none; }
    .trophy-row.expanded .trophy-desc { display:block; }
    .trophy-count-col { text-align:right; }
    .trophy-count { font-family:'Bebas Neue',sans-serif; font-size:48px; color:var(--gold); line-height:1; }
    .trophy-last { font-size:11px; color:var(--text); margin-top:2px; white-space:nowrap; }
    .status { padding:80px 48px; text-align:center; color:var(--text); font-size:14px; }

    @media (max-width:640px) {
      .hero { height:260px; }
      .hero-content,.filters,.trophy-wrap,.total-bar { padding-left:20px; padding-right:20px; }
      .trophy-row { grid-template-columns:48px 1fr auto; gap:14px; padding:16px; }
      .trophy-count { font-size:36px; }
    }
  </style>
</head>
<body>

<header class="hero">
  <img class="hero-bg"
       src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=1400&auto=format&fit=crop"
       alt="Trofej Lige prvaka" />
  <div class="hero-content">
    <p class="hero-eyebrow">Soba slavlja</p>
    <h1>NAŠI<br><span>TROFEJI</span></h1>
  </div>
</header>

<div class="total-bar">
  <div class="big-num" id="total-num">—</div>
  <div class="big-label">Ukupno<br>trofeja</div>
</div>

<nav class="filters" id="filters">
  <button class="filter-btn active" data-cat="all">Svi</button>
  <button class="filter-btn" data-cat="Domestic">Domaći</button>
  <button class="filter-btn" data-cat="European">Europski</button>
  <button class="filter-btn" data-cat="International">Međunarodni</button>
</nav>

<main class="trophy-wrap" id="trophy-wrap">
  <p class="status">Učitavanje trofeja…</p>
</main>

<script>
  let allTrophies = [];

  async function loadTrophies() {
    try {
      const res  = await fetch('trophies-api.php');
      if (!res.ok) throw new Error('Greška API-ja ' + res.status);
      const data = await res.json();
      allTrophies = data.trophies;
      document.getElementById('total-num').textContent = data.total_trophies;
      renderList(allTrophies);
    } catch (err) {
      document.getElementById('trophy-wrap').innerHTML =
        `<p class="status">⚠ Nije moguće učitati podatke o trofejima.<br><small>${err.message}</small></p>`;
    }
  }

  function renderList(trophies) {
    const wrap = document.getElementById('trophy-wrap');
    if (!trophies.length) { wrap.innerHTML = '<p class="status">Nema trofeja.</p>'; return; }
    wrap.innerHTML = trophies.map(t => `
      <div class="trophy-row" onclick="this.classList.toggle('expanded')">
        <img class="trophy-icon" src="${t.image}" alt="${t.name}" onerror="this.style.display='none'">
        <div class="trophy-info">
          <div class="trophy-name">${t.name}</div>
          <div class="trophy-cat">${t.category}</div>
          <div class="trophy-desc">${t.description}</div>
        </div>
        <div class="trophy-count-col">
          <div class="trophy-count">${t.count}</div>
          <div class="trophy-last">Zadnji: ${t.last_won}</div>
        </div>
      </div>
    `).join('');
  }

  document.getElementById('filters').addEventListener('click', e => {
    const btn = e.target.closest('.filter-btn');
    if (!btn) return;
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    const cat = btn.dataset.cat;
    renderList(cat === 'all' ? allTrophies : allTrophies.filter(t => t.category === cat));
  });

  loadTrophies();
</script>
</body>
</html>
