<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Recherche - Villes de France</title>
  <style>
    :root { --blue:#2563eb; --gray:#f3f4f6; }
    body {
      font-family: system-ui, sans-serif;
      background: var(--gray);
      margin: 0;
      padding: 40px;
      text-align: center;
    }
    h1 {
      color: #1f2937;
      margin-bottom: 25px;
    }
    form {
      display: inline-block;
      background: #fff;
      padding: 20px 25px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,.1);
      position: relative;
    }
    select, input, button {
      padding: 8px 10px;
      margin: 5px;
      font-size: 14px;
      border-radius: 6px;
      border: 1px solid #d1d5db;
    }
    button {
      background: var(--blue);
      color: white;
      border: none;
      cursor: pointer;
    }
    button:hover { filter: brightness(.95); }
    #resultats {
      max-width: 800px;
      margin: 30px auto;
      text-align: left;
    }
    .ville {
      background: #fff;
      border-radius: 10px;
      padding: 15px 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,.08);
      margin-bottom: 12px;
    }
    .ville h3 { margin: 0 0 8px; color: var(--blue); }
    .ville p { margin: 2px 0; color: #374151; }

    #suggestBox div {
      padding: 6px 10px;
      cursor: pointer;
    }
    #suggestBox div:hover {
      background: #f1f5f9;
    }
  </style>
</head>
<body>
  <h1>Recherche - Villes de France</h1>

  <form id="form">
    <select id="type">
      <option value="ville">Ville</option>
      <option value="departement">Département</option>
      <option value="code">Code postal</option>
    </select>

    <div style="position:relative; display:inline-block;">
      <input type="text" id="q" placeholder="ex: Paris, 76, 75000" required autocomplete="off">
      <div id="suggestBox" style="position:absolute; left:0; right:0; background:#fff; border:1px solid #ddd; border-top:none; border-radius:0 0 6px 6px; max-height:200px; overflow-y:auto; z-index:10; display:none;"></div>
    </div>

    <button type="submit">Rechercher</button>
  </form>

  <div id="resultats"></div>

  <script>
    const form = document.getElementById('form');
    const q = document.getElementById('q');
    const type = document.getElementById('type');
    const resultats = document.getElementById('resultats');
    const suggestBox = document.getElementById('suggestBox');

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const val = q.value.trim();
      if (!val) return;

      resultats.innerHTML = "<p>Chargement...</p>";

      try {
        const res = await fetch(`/villes_de_france/${type.value}/${encodeURIComponent(val)}`);
        const data = await res.json();

        if (!data.length) {
          resultats.innerHTML = "<p>Aucun résultat trouvé</p>";
          return;
        }

        resultats.innerHTML = data.map(v => `
          <div class="ville">
            <h3>${v.ville_nom}</h3>
            <p><b>Code postal :</b> ${v.ville_code_postal ?? "N/A"}</p>
            <p><b>Département :</b> ${v.ville_departement ?? "N/A"}</p>
            <p><b>Population :</b> ${v.ville_population_2012 ?? "N/A"}</p>
            <p><b>Coordonnées :</b> ${v.ville_latitude_deg ?? "?"}, ${v.ville_longitude_deg ?? "?"}</p>
          </div>
        `).join('');
      } catch (err) {
        resultats.innerHTML = "<p>Erreur lors du chargement</p>";
      }
    });

    let lastTerm = "";
    q.addEventListener('input', async () => {
      const term = q.value.trim();
      if (type.value !== 'ville' || term.length < 2) {
        suggestBox.style.display = 'none';
        return;
      }
      if (term === lastTerm) return;
      lastTerm = term;

      try {
        const res = await fetch(`/villes_de_france/search?term=${encodeURIComponent(term)}`);
        const noms = await res.json();

        if (!noms.length) {
          suggestBox.style.display = 'none';
          return;
        }

        suggestBox.innerHTML = noms.map(n => `<div>${n}</div>`).join('');
        suggestBox.style.display = 'block';
      } catch {
        suggestBox.style.display = 'none';
      }
    });

    suggestBox.addEventListener('click', e => {
      if (e.target.tagName === 'DIV') {
        q.value = e.target.textContent;
        suggestBox.style.display = 'none';
      }
    });

    document.addEventListener('click', e => {
      if (!suggestBox.contains(e.target) && e.target !== q) {
        suggestBox.style.display = 'none';
      }
    });
  </script>
</body>
</html>
