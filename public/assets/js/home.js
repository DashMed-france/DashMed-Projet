    // Mettre à jour l'heure en live
    function updateClock(){
      const el = document.getElementById('clock');
      if (!el) return;
      const d = new Date();
      const h = String(d.getHours()).padStart(2,'0');
      const m = String(d.getMinutes()).padStart(2,'0');
      el.textContent = `${h}:${m}`;
    }
    updateClock();
    setInterval(updateClock, 15000);