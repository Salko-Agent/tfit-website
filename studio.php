<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();
$seo_key = 'studio';
$site    = $content['site'] ?? [];
$studio    = $content['_studio'] ?? [];
$st_hero   = $studio['hero']['data']          ?? [];
$st_info   = $studio['studio_info']['data']   ?? [];
$st_miete  = $studio['raummiete']['data']     ?? [];
$st_fit    = $studio['fitnessraum']['data']   ?? [];
$st_ther   = $studio['therapieraum']['data']  ?? [];
$st_err    = $studio['erreichbarkeit']['data'] ?? [];
require_once __DIR__ . '/includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="container">
    <span class="section-label" style="justify-content:center;margin-bottom:16px"><?= e($st_hero['label'] ?? 'Privates Studio Wien') ?></span>
    <h1><?= he($st_hero['headline'] ?? 'FlexFit Fitnessraum &amp; Therapieraum') ?></h1>
    <p style="max-width:540px;margin:12px auto 24px;color:rgba(255,255,255,.8)"><?= e($st_hero['subtext'] ?? 'Mustergasse 12, 1080 Wien') ?></p>
    <a href="/probetraining" class="btn btn-primary btn-lg">Gratis Probetraining buchen <?= icon('arrow-right') ?></a>
  </div>
</section>

<!-- STUDIO INTRO -->
<section class="section-pad" style="background:var(--white)">
  <div class="container">
    <div class="sg2-center">
      <div class="reveal-left">
        <span class="section-label"><?= e($st_info['label'] ?? 'Unser privates Studio') ?></span>
        <h2 style="margin-bottom:20px">FlexFit Personal Training Studio</h2>
        <?php foreach(($st_info['paragraphs'] ?? []) as $p): ?>
        <p style="color:var(--text-secondary);margin-bottom:16px;line-height:1.7"><?= e($p) ?></p>
        <?php endforeach; ?>
        <?php if (!empty($st_info['motto'])): ?>
        <p style="font-style:italic;color:var(--gold);margin-bottom:24px;font-size:.95rem"><?= e($st_info['motto']) ?></p>
        <?php endif; ?>

        <div style="display:flex;flex-direction:column;gap:8px;margin-bottom:24px">
          <?php foreach(($st_info['features'] ?? []) as $f): ?>
          <div style="display:flex;align-items:center;gap:10px;font-size:.9rem;color:var(--text-secondary)">
            <span style="color:var(--gold)"><?= icon('check') ?></span> <?= e($f) ?>
          </div>
          <?php endforeach; ?>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap">
          <a href="/team" class="btn btn-outline-dark">Zu unserem Team <?= icon('arrow-right') ?></a>
          <a href="https://maps.app.goo.gl/4JZrRWVM3tTMzeqk8" target="_blank" rel="noopener" class="btn btn-outline-dark" style="font-size:.85rem">360° Studio-Ansicht</a>
        </div>
      </div>
      <div class="reveal-right">
        <!-- Studio Tour Video -->
        <div style="border-radius:var(--r-lg);overflow:hidden;margin-bottom:8px;aspect-ratio:16/9;background:#000">
          <iframe src="https://www.youtube.com/embed/4YyaZI6OGMA" title="FlexFit Studio Wien – Virtual Tour" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width:100%;height:100%" loading="lazy"></iframe>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
          <img src="/assets/img/studio/gym1.jpg" alt="Fitnessraum mieten Wien 1080 FlexFit" style="border-radius:var(--r-md);width:100%;height:180px;object-fit:cover" loading="lazy">
          <img src="/assets/img/studio/gym2.jpeg" alt="Gym mieten Wien FlexFit" style="border-radius:var(--r-md);width:100%;height:180px;object-fit:cover" loading="lazy">
          <img src="/assets/img/studio/therapieraum.jpeg" alt="Therapieraum mieten Wien 1080" style="border-radius:var(--r-md);width:100%;height:180px;object-fit:cover" loading="lazy">
          <img src="/assets/img/studio/garderobe.jpg" alt="Garderobe FlexFit Studio 1080 Wien" style="border-radius:var(--r-md);width:100%;height:180px;object-fit:cover" loading="lazy">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- RAUMVERMIETUNG -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container">
    <div class="text-center reveal" style="margin-bottom:48px">
      <span class="section-label">Raumvermietung</span>
      <h2>Fitnessraum &amp; Therapieraum mieten Wien</h2>
      <p style="color:var(--text-secondary);max-width:640px;margin:12px auto 0">F&uuml;r selbstst&auml;ndige Trainer, Physios, Masseure, Ern&auml;hrungsberater und andere Gesundheitsexperten. Gruppentrainings bis maximal 4 Personen m&ouml;glich. Kein finanzielles Risiko &ndash; ideal zum Start oder Ausbau Ihrer Selbstst&auml;ndigkeit.</p>
    </div>

    <div class="sg2" style="align-items:flex-start;gap:var(--space-8)">

      <!-- Fitnessraum -->
      <div class="card reveal reveal-delay-1">
        <div class="card-body" style="padding:32px">
          <div style="font-size:2.5rem;margin-bottom:12px">🏋️</div>
          <h3 style="font-size:1.1rem;margin-bottom:12px"><?= e($st_fit['label'] ?? 'Fitnessraum / Gym mieten Wien') ?></h3>
          <div style="display:flex;flex-direction:column;gap:6px;margin-bottom:20px">
            <?php foreach(($st_fit['items'] ?? []) as $v): ?>
            <div style="display:flex;gap:8px;font-size:.85rem;color:var(--text-secondary);align-items:flex-start">
              <span style="color:var(--gold);flex-shrink:0"><?= icon('check') ?></span> <?= e($v) ?>
            </div>
            <?php endforeach; ?>
          </div>
          <div style="background:var(--off-white);border-radius:var(--r-md);padding:16px;margin-bottom:16px">
            <div style="font-size:.82rem;color:var(--text-muted);margin-bottom:8px;font-weight:600;text-transform:uppercase;letter-spacing:.06em">Monatliche Mietkosten</div>
            <div style="display:flex;justify-content:space-between;padding:6px 0;border-bottom:1px solid var(--border-light);font-size:.9rem">
              <span>Fixer Halbtag</span><span style="font-weight:700;color:var(--gold)"><?= e($st_fit['preise_halbtag'] ?? '€170,- netto') ?></span>
            </div>
            <div style="display:flex;justify-content:space-between;padding:6px 0;font-size:.9rem">
              <span>Fixer Ganztag</span><span style="font-weight:700;color:var(--gold)"><?= e($st_fit['preise_ganztag'] ?? '€270,- netto') ?></span>
            </div>
          </div>
          <?php if (!empty($st_fit['preise_note'])): ?><div style="font-size:.8rem;color:var(--text-muted)"><?= e($st_fit['preise_note']) ?></div><?php endif; ?>
          <?php if (!empty($st_fit['verfuegbar'])): ?><div style="margin-top:16px;font-size:.85rem;color:var(--text-secondary)"><strong>Aktuell verfügbar:</strong> <?= e($st_fit['verfuegbar']) ?></div><?php endif; ?>
        </div>
      </div>

      <!-- Therapieraum -->
      <div class="card reveal reveal-delay-2">
        <div class="card-body" style="padding:32px">
          <div style="font-size:2.5rem;margin-bottom:12px">🪑</div>
          <h3 style="font-size:1.1rem;margin-bottom:12px"><?= e($st_ther['label'] ?? 'Therapieraum / Massageraum mieten Wien') ?></h3>
          <div style="display:flex;flex-direction:column;gap:6px;margin-bottom:20px">
            <?php foreach(($st_ther['items'] ?? []) as $v): ?>
            <div style="display:flex;gap:8px;font-size:.85rem;color:var(--text-secondary);align-items:flex-start">
              <span style="color:var(--gold);flex-shrink:0"><?= icon('check') ?></span> <?= e($v) ?>
            </div>
            <?php endforeach; ?>
          </div>
          <div style="background:var(--off-white);border-radius:var(--r-md);padding:16px;margin-bottom:16px">
            <div style="font-size:.82rem;color:var(--text-muted);margin-bottom:8px;font-weight:600;text-transform:uppercase;letter-spacing:.06em">Monatliche Mietkosten</div>
            <div style="display:flex;justify-content:space-between;padding:6px 0;border-bottom:1px solid var(--border-light);font-size:.9rem">
              <span>Fixer Halbtag</span><span style="font-weight:700;color:var(--gold)"><?= e($st_ther['preise_halbtag'] ?? '€180,- netto') ?></span>
            </div>
            <div style="display:flex;justify-content:space-between;padding:6px 0;font-size:.9rem">
              <span>Fixer Ganztag</span><span style="font-weight:700;color:var(--gold)"><?= e($st_ther['preise_ganztag'] ?? '€275,- netto') ?></span>
            </div>
          </div>
          <?php if (!empty($st_ther['verfuegbar'])): ?><div style="margin-top:0;font-size:.85rem;color:var(--text-secondary)"><strong>Aktuell verfügbar:</strong> <?= e($st_ther['verfuegbar']) ?></div><?php endif; ?>
        </div>
      </div>

    </div>

    <!-- Vorteile Einmietung -->
    <div style="margin-top:48px;padding:32px;background:var(--white);border-radius:var(--r-lg);border:1px solid var(--border-light)" class="reveal">
      <h3 style="margin-bottom:20px;text-align:center">Ihre Vorteile durch eine Einmietung bei FlexFit</h3>
      <div class="sg2" style="gap:var(--space-4)">
        <?php foreach(($st_miete['vorteile_cards'] ?? []) as $v): ?>
        <div style="display:flex;gap:10px;font-size:.9rem;color:var(--text-secondary);align-items:flex-start">
          <span style="flex-shrink:0">✅</span>
          <span><strong><?= e($v['title'] ?? '') ?></strong> – <?= e($v['text'] ?? '') ?></span>
        </div>
        <?php endforeach; ?>
      </div>
      <p style="margin-top:20px;font-size:.82rem;color:var(--text-muted);text-align:center">Vermietungen durch K&ouml;hler Fitness KG &nbsp;&middot;&nbsp; Mustergasse 12, 1080 Wien &nbsp;&middot;&nbsp; Preise netto exkl. MwSt.</p>
    </div>
  </div>
</section>

<!-- ERREICHBARKEIT -->
<section class="section-pad" style="background:var(--white)">
  <div class="container" style="max-width:780px">
    <div class="text-center reveal" style="margin-bottom:32px">
      <span class="section-label">Erreichbarkeit</span>
      <h2>Super erreichbar aus 1070, 1080, 1090, 1160 &amp; 1170</h2>
    </div>
    <p style="color:var(--text-secondary);line-height:1.7;text-align:center;margin-bottom:24px"><?= e($st_err['text'] ?? '') ?></p>
    <div style="border-radius:var(--r-lg);overflow:hidden;margin-bottom:16px;box-shadow:0 4px 20px rgba(0,0,0,.08)">
      <iframe src="https://maps.google.com/maps?q=Mustergasse+50,+1080+Wien,+FlexFit+Personal+Training&output=embed" width="100%" height="380" style="border:0;display:block" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="FlexFit Personal Training Wien – Mustergasse 12, 1080 Wien"></iframe>
    </div>
    <div style="text-align:center;padding:20px;background:var(--off-white);border-radius:var(--r-md)">
      <div style="font-weight:700;margin-bottom:4px">Muster Fitness KG &amp; FlexFit Personal Training e.U.</div>
      <div style="color:var(--text-secondary)">Mustergasse 12, 1080 Wien</div>
      <div style="margin-top:12px;display:flex;gap:10px;justify-content:center;flex-wrap:wrap">
        <a href="https://maps.app.goo.gl/4JZrRWVM3tTMzeqk8" target="_blank" rel="noopener" class="btn btn-outline-dark" style="font-size:.85rem">In Google Maps öffnen <?= icon('arrow-right') ?></a>
        <a href="https://maps.app.goo.gl/4JZrRWVM3tTMzeqk8" target="_blank" rel="noopener" class="btn btn-outline-dark" style="font-size:.85rem">360° Studio-Ansicht</a>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-banner">
  <div class="container"><div class="reveal">
    <h2>Überzeugen Sie sich selbst</h2>
    <p>Wagneren Sie Ihr gratis Probetraining und entdecken Sie unser privates Studio in der Mustergasse 12, 1080 Wien.</p>
    <div class="cta-banner-actions">
      <a href="/probetraining" class="btn btn-primary btn-lg">Gratis Probetraining buchen <?= icon('arrow-right') ?></a>
      <a href="/kontakt" class="btn btn-outline btn-lg">Besichtigungstermin anfragen</a>
    </div>
  </div></div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
