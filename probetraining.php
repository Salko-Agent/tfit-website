<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();
$seo_key = 'probetraining';
require_once __DIR__ . '/includes/header.php';
$site = $content['site'] ?? [];
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="container">
    <span class="section-label" style="justify-content:center;margin-bottom:16px">Kostenlos &amp; Unverbindlich</span>
    <h1>Gratis Probetraining<br>bei FlexFit Wien</h1>
    <p>Sichern Sie sich jetzt Ihr kostenloses, unverbindliches Probetraining (Gespräch &amp; Training ca. 60 Min.) bei FlexFit Personal Training Wien.</p>
  </div>
</section>

<!-- MAIN CONTENT: Formular links/oben, Info rechts/unten -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container">
    <div class="sg2-form">

      <!-- Formular (Position 1 – links / auf Mobile zuerst) -->
      <div class="contact-form-wrap" style="background:var(--white);box-shadow:var(--shadow-md);order:1">
        <h2 style="font-size:1.6rem;margin-bottom:8px">Probetraining anfragen</h2>
        <p style="color:var(--text-muted);font-size:.9rem;margin-bottom:28px">Wir melden uns innerhalb von 24 Stunden – kostenlos und unverbindlich.</p>

        <form id="probetrainingForm" novalidate>
          <?= csrf_field() ?>
          <input type="hidden" name="form_type" value="probetraining">

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="pt_fname">Vorname *</label>
              <input class="form-input" id="pt_fname" name="firstname" type="text" placeholder="Max" required>
            </div>
            <div class="form-group">
              <label class="form-label" for="pt_lname">Nachname *</label>
              <input class="form-input" id="pt_lname" name="lastname" type="text" placeholder="Mustermann" required>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="pt_email">E-Mail *</label>
            <input class="form-input" id="pt_email" name="email" type="email" placeholder="max@beispiel.at" required>
          </div>

          <div class="form-group">
            <label class="form-label" for="pt_phone">Telefonnummer *</label>
            <input class="form-input" id="pt_phone" name="phone" type="tel" placeholder="+43 123 456 789" required>
          </div>

          <div class="form-group">
            <label class="form-label" for="pt_goal">Alter, Größe / Gewicht, Ziele *</label>
            <input class="form-input" id="pt_goal" name="goal" type="text" placeholder="z.B. 35 Jahre, 175 cm, 85 kg – Abnehmen &amp; Kraft aufbauen" required>
          </div>

          <div class="form-group">
            <label class="form-label" for="pt_times">Mögliche Trainingszeiten *</label>
            <input class="form-input" id="pt_times" name="preferred_date" type="text" placeholder="z.B. Montag &amp; Mittwoch Abend, Samstag Vormittag" required>
          </div>

          <!-- Wunschtrainer mit Preisen -->
          <div class="form-group">
            <label class="form-label">Wunschtrainer *</label>
            <div style="display:flex;flex-direction:column;gap:10px;margin-top:8px">

              <label style="display:flex;align-items:center;gap:14px;padding:14px 16px;background:var(--off-white);border-radius:var(--r-md);border:2px solid var(--border-light);cursor:pointer;transition:border-color .2s" class="trainer-radio-wrap">
                <input type="radio" name="trainer" value="Marcus" required style="accent-color:var(--gold);width:18px;height:18px;flex-shrink:0">
                <img src="/assets/img/team/marcus-kohler.jpg" alt="Marcus Muster" style="width:48px;height:48px;border-radius:50%;object-fit:cover;object-position:top;flex-shrink:0">
                <div>
                  <div style="font-weight:700;color:var(--text-primary)">Marcus Muster</div>
                  <div style="font-size:.8rem;color:var(--text-muted)">Gesundheit, Fitness &amp; Lebensqualität</div>
                  <div style="font-size:.82rem;color:var(--gold);font-weight:700;margin-top:2px">ab 86 € / Training</div>
                </div>
              </label>

              <label style="display:flex;align-items:center;gap:14px;padding:14px 16px;background:var(--off-white);border-radius:var(--r-md);border:2px solid var(--border-light);cursor:pointer;transition:border-color .2s" class="trainer-radio-wrap">
                <input type="radio" name="trainer" value="Eric" style="accent-color:var(--gold);width:18px;height:18px;flex-shrink:0">
                <img src="/assets/img/team/eric-weber.jpeg" alt="Eric Weber" style="width:48px;height:48px;border-radius:50%;object-fit:cover;object-position:top;flex-shrink:0">
                <div>
                  <div style="font-weight:700;color:var(--text-primary)">Eric Weber</div>
                  <div style="font-size:.8rem;color:var(--text-muted)">Muskelaufbau, Kraft &amp; Abnehmen</div>
                  <div style="font-size:.82rem;color:var(--gold);font-weight:700;margin-top:2px">ab 76 € / Training</div>
                </div>
              </label>

              <label style="display:flex;align-items:center;gap:14px;padding:14px 16px;background:var(--off-white);border-radius:var(--r-md);border:2px solid var(--border-light);cursor:pointer;transition:border-color .2s" class="trainer-radio-wrap">
                <input type="radio" name="trainer" value="Oliver" style="accent-color:var(--gold);width:18px;height:18px;flex-shrink:0">
                <img src="/assets/img/team/oliver-kraft.jpeg" alt="Oliver Kraft" style="width:48px;height:48px;border-radius:50%;object-fit:cover;object-position:top;flex-shrink:0">
                <div>
                  <div style="font-weight:700;color:var(--text-primary)">Oliver Kraft</div>
                  <div style="font-size:.8rem;color:var(--text-muted)">Gesundheit, Krafttraining &amp; Körperformung</div>
                  <div style="font-size:.82rem;color:var(--gold);font-weight:700;margin-top:2px">ab 69 € / Training</div>
                </div>
              </label>

              <label style="display:flex;align-items:center;gap:14px;padding:14px 16px;background:var(--off-white);border-radius:var(--r-md);border:2px solid var(--border-light);cursor:pointer;transition:border-color .2s" class="trainer-radio-wrap">
                <input type="radio" name="trainer" value="Trainer egal" style="accent-color:var(--gold);width:18px;height:18px;flex-shrink:0">
                <div style="width:48px;height:48px;border-radius:50%;background:var(--light-gray);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:1.3rem">🤝</div>
                <div>
                  <div style="font-weight:700;color:var(--text-primary)">Trainer egal</div>
                  <div style="font-size:.8rem;color:var(--text-muted)">Wir empfehlen den passenden Trainer für Ihre Ziele</div>
                </div>
              </label>

            </div>
            <p style="font-size:.75rem;color:var(--text-muted);margin-top:8px">*Ab-Preise pro Einheit bei Kauf eines 10er-Blocks à 45 Minuten</p>
          </div>

          <div class="form-group">
            <label class="form-label" for="pt_msg">Weitere Infos (optional)</label>
            <textarea class="form-textarea" id="pt_msg" name="message" placeholder="Gesundheitliche Besonderheiten, frühere Erfahrungen, Fragen…" style="min-height:90px"></textarea>
          </div>

          <button type="submit" class="btn btn-primary btn-lg" style="width:100%;justify-content:center">
            Probetraining sichern <?= icon('arrow-right') ?>
          </button>

          <p style="font-size:.75rem;color:var(--text-muted);text-align:center;margin-top:12px">
            Kostenlos · Unverbindlich · Kein Vertrag<br>
            <a href="/datenschutz.php" style="color:var(--gold)">Datenschutzerklärung</a>
          </p>
        </form>
      </div>

      <!-- Info (Position 2 – rechts) -->
      <div style="order:2">
        <span class="section-label" style="margin-bottom:20px;display:block">Was Sie erwartet</span>
        <h2 style="margin-bottom:24px;font-size:1.7rem">Der Weg zu mehr Lebensqualität &amp; Fitness</h2>

        <div style="display:flex;flex-direction:column;gap:16px;margin-bottom:40px">
          <?php
          $steps = [
            ['num'=>'01','title'=>'Kostenloses Erstgespräch','text'=>'Wir besprechen Ihre Ziele, Ihren Gesundheitszustand und Ihr aktuelles Fitnesslevel. Keine Verpflichtungen.'],
            ['num'=>'02','title'=>'Bedarfsanalyse','text'=>'Ihr Trainer analysiert Ihre Bewegungsqualität, Stärken und eventuelle Einschränkungen.'],
            ['num'=>'03','title'=>'Probetrainingseinheit','text'=>'Sie absolvieren eine vollständige Trainingseinheit – maßgeschneidert auf Sie. So wissen Sie sofort, wie es ist.'],
            ['num'=>'04','title'=>'Individuelle Empfehlung','text'=>'Am Ende erhalten Sie eine klare Empfehlung, welches Format am besten zu Ihnen und Ihren Zielen passt.'],
          ];
          foreach ($steps as $step): ?>
          <div style="display:flex;gap:18px;padding:18px 20px;background:var(--white);border-radius:var(--r-md);border:1px solid var(--border-light)">
            <div style="font-family:var(--font-display);font-size:1.8rem;font-weight:700;color:var(--gold);line-height:1;min-width:44px"><?= $step['num'] ?></div>
            <div>
              <div style="font-weight:700;margin-bottom:4px"><?= $step['title'] ?></div>
              <div style="font-size:.88rem;color:var(--text-secondary)"><?= $step['text'] ?></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <!-- Studio Info -->
        <div style="padding:20px;background:var(--gold-subtle);border:1px solid rgba(200,150,60,.3);border-radius:var(--r-md)">
          <p style="font-size:.9rem;color:var(--text-primary);font-weight:500;margin:0">
            📍 <strong>Unser Studio:</strong> Mustergasse 12, 1080 Wien<br>
            🕐 <strong>Öffnungszeiten:</strong> Mo–Fr 7:00–21:00, Sa 9:00–16:00<br>
            📞 <strong>Telefon:</strong> <a href="tel:+4312345678" style="color:var(--text-primary)">+43 1 234 56 78</a>
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<script>
// Trainer-Radio Highlight
document.querySelectorAll('.trainer-radio-wrap input[type="radio"]').forEach(radio => {
  radio.addEventListener('change', () => {
    document.querySelectorAll('.trainer-radio-wrap').forEach(w => w.style.borderColor = '');
    if (radio.checked) radio.closest('.trainer-radio-wrap').style.borderColor = 'var(--gold)';
  });
});

document.getElementById('probetrainingForm')?.addEventListener('submit', async function(e) {
  e.preventDefault();
  const btn = this.querySelector('[type="submit"]');
  const orig = btn.innerHTML;
  btn.innerHTML = 'Wird gesendet…';
  btn.disabled = true;
  try {
    const resp = await fetch('/api/contact.php', { method:'POST', body: new FormData(this) });
    const data = await resp.json();
    if (data.success) {
      this.innerHTML = '<div style="text-align:center;padding:40px 0"><div style="font-size:3rem;margin-bottom:16px">✅</div><h3 style="margin-bottom:8px">Danke für Ihre Anfrage!</h3><p style="color:var(--text-secondary)">Wir melden uns innerhalb von 24 Stunden. Wir freuen uns darauf, Sie kennenzulernen!</p></div>';
    } else {
      alert(data.message || 'Fehler beim Senden. Bitte versuchen Sie es erneut.');
      btn.innerHTML = orig; btn.disabled = false;
    }
  } catch { btn.innerHTML = orig; btn.disabled = false; }
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
