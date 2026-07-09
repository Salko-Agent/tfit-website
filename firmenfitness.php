<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();
$seo_key = 'firmenfitness';
$site    = $content['site'] ?? [];
$ff        = $content['_ff'] ?? [];
$ff_hero   = $ff['hero']['data']    ?? [];
$ff_why    = $ff['why']['data']     ?? [];
$ff_intro  = $ff['intro']['data']   ?? [];
$ff_ang    = $ff['angebot']['data'] ?? [];
$ff_fazit  = $ff['fazit']['data']   ?? [];
$ff_part   = $ff['partners']['data']?? [];
require_once __DIR__ . '/includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="container">
    <span class="section-label" style="justify-content:center;margin-bottom:16px"><?= e($ff_hero['label'] ?? 'Firmenfitness Wien') ?></span>
    <h1><?= he($ff_hero['headline'] ?? 'Firmenfitness Wien – betriebliche Gesundheitsvorsorge') ?></h1>
    <p style="max-width:640px;margin:12px auto 32px;color:rgba(255,255,255,.8)"><?= e($ff_hero['subtext'] ?? 'Gruppentrainings, Workshops, Einzeltrainings & Fitnessgespräche – direkt bei Ihnen im Unternehmen oder in unserem Studio.') ?></p>
    <a href="<?= e($ff_hero['cta_url'] ?? '/kontakt.php') ?>" class="btn btn-primary btn-lg"><?= e($ff_hero['cta'] ?? 'Unverbindlich anfragen') ?> <?= icon('arrow-right') ?></a>
  </div>
</section>

<!-- INTRO -->
<section class="section-pad" style="background:var(--white)">
  <div class="container">
    <div class="sg2-center">
      <div class="reveal-left">
        <span class="section-label"><?= e($ff_why['label'] ?? 'Über uns') ?></span>
        <h2 style="margin-bottom:24px"><?= he($ff_why['headline'] ?? 'Betriebliche Gesundheitsvorsorge Wien – Fitness als Investition in Ihr Unternehmen') ?></h2>
        <p style="color:var(--text-secondary);margin-bottom:16px;font-size:1.05rem;line-height:1.7"><?= e($ff_intro['text'] ?? 'Sie suchen nach einer effektiven Möglichkeit, die Gesundheit und das Wohlbefinden Ihrer Mitarbeiter zu fördern und gleichzeitig die Produktivität am Arbeitsplatz zu steigern? Herzlich willkommen bei unserer exklusiven Firmenfitness in Wien.') ?></p>
        <a href="/kontakt" class="btn btn-primary">Jetzt anfragen <?= icon('arrow-right') ?></a>
      </div>
      <div class="reveal-right">
        <img src="/assets/img/firmenfitness/hero.jpeg" alt="Firmenfitness Wien – Gruppentraining bei FlexFit" style="border-radius:var(--r-lg);width:100%;object-fit:cover;max-height:400px" loading="lazy">
      </div>
    </div>
  </div>
</section>

<!-- WARUM FIRMENFITNESS -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container">
    <div class="text-center reveal" style="margin-bottom:40px">
      <span class="section-label">Warum Firmenfitness?</span>
      <h2>Nachweislich positive Auswirkungen auf Ihr Unternehmen</h2>
      <p style="color:var(--text-secondary);max-width:620px;margin:12px auto 0">Investitionen in die Gesundheit und das Wohlbefinden Ihrer Mitarbeiter haben nachweislich positive Auswirkungen auf das Arbeitsklima und die Unternehmensperformance.</p>
    </div>
    <div class="sg2" style="gap:var(--space-5)">
      <?php foreach(($ff_why['vorteile'] ?? []) as $i => $w): ?>
      <div style="display:flex;gap:16px;padding:20px;background:var(--white);border-radius:var(--r-md);border:1px solid var(--border-light)" class="reveal">
        <div style="font-size:1.8rem;flex-shrink:0;line-height:1"><?= $w['icon'] ?></div>
        <div>
          <div style="font-weight:700;font-size:.95rem;margin-bottom:4px;color:var(--text-primary)"><?= $w['title'] ?></div>
          <div style="font-size:.88rem;color:var(--text-secondary);line-height:1.6"><?= $w['text'] ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div style="margin-top:40px;padding:24px 32px;background:var(--white);border-radius:var(--r-lg);border-left:4px solid var(--gold);display:flex;gap:20px;align-items:center" class="reveal">
      <img src="/assets/img/team/marcus-kohler.jpg" alt="Marcus Muster" style="width:70px;height:70px;border-radius:50%;object-fit:cover;object-position:top;flex-shrink:0;border:2px solid var(--gold)">
      <div>
        <div style="font-weight:700;color:var(--text-primary)">Marcus Muster</div>
        <div style="font-size:.82rem;color:var(--gold);margin-bottom:4px">Sportwissenschaftler &amp; 15+ Jahre Erfahrung im Personal Training</div>
        <div style="font-size:.88rem;color:var(--text-secondary)">Gründer FlexFit – entwickelte das erprobte FlexFit-System zur Reduktion von Rücken- und Nackenbeschwerden</div>
      </div>
    </div>
  </div>
</section>

<!-- UNSER ANGEBOT -->
<section class="section-pad" style="background:var(--white)">
  <div class="container">
    <div class="sg2-center" style="align-items:flex-start">
      <div class="reveal-left">
        <span class="section-label">Unser Angebot</span>
        <h2 style="margin-bottom:12px">Firmenfitness-Programme f&uuml;r Ihr Unternehmen in Wien</h2>
        <p style="color:var(--text-secondary);margin-bottom:24px;line-height:1.7">Gruppentrainings bis maximal 4 Personen, Workshops, Einzelcoachings und Fitnessgespräche – speziell auf die Anforderungen Ihrer Firma abgestimmt.</p>
        <div style="display:flex;flex-direction:column;gap:12px">
          <?php foreach(($ff_ang['items'] ?? []) as $a): ?>
          <div style="display:flex;gap:20px;padding:20px 24px;background:var(--off-white);border-radius:var(--r-md);align-items:flex-start" class="reveal">
            <div style="font-family:var(--font-display);font-size:1.8rem;font-weight:700;color:var(--gold);line-height:1;min-width:44px"><?= $a['num'] ?></div>
            <div>
              <div style="font-weight:700;font-size:1rem;margin-bottom:4px;color:var(--text-primary)"><?= $a['title'] ?></div>
              <div style="font-size:.9rem;color:var(--text-secondary);line-height:1.6"><?= $a['text'] ?></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <p style="margin-top:16px;font-size:.85rem;color:var(--text-muted)">Preise verstehen sich netto, inklusive Anfahrt in Wien. Je nach Wunsch auch Workshops außerhalb Wiens möglich.</p>
      </div>
      <div class="reveal-right" style="display:flex;flex-direction:column;gap:12px">
        <img src="/assets/img/firmenfitness/firmenfitness-office.jpg" alt="Firmenfitness Wien FlexFit – Training im Büro" style="border-radius:var(--r-lg);width:100%;object-fit:cover;max-height:300px" loading="lazy">
        <img src="/assets/img/firmenfitness/workshop.jpeg" alt="Fitness Workshop Wien FlexFit" style="border-radius:var(--r-lg);width:100%;object-fit:cover;max-height:220px" loading="lazy">
      </div>
    </div>
  </div>
</section>

<!-- GALERIE & REFERENZ -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container">
    <div class="text-center reveal" style="margin-bottom:32px">
      <span class="section-label">Einblicke</span>
      <h2>Firmenfitness in der Praxis</h2>
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:40px" class="reveal">
      <img src="/assets/img/firmenfitness/gruppentraining-workshop.jpeg" alt="Gruppentraining Firmenfitness Wien FlexFit" style="border-radius:var(--r-md);width:100%;height:220px;object-fit:cover" loading="lazy">
      <img src="/assets/img/firmenfitness/firmenfitness-session.jpg" alt="Firmenfitness Session FlexFit Wien" style="border-radius:var(--r-md);width:100%;height:220px;object-fit:cover" loading="lazy">
      <img src="/assets/img/firmenfitness/firmenfitness-training.jpeg" alt="Betriebliche Gesundheitsvorsorge Wien FlexFit" style="border-radius:var(--r-md);width:100%;height:220px;object-fit:cover" loading="lazy">
    </div>
    <!-- YUUTEL Referenz -->
    <div style="background:var(--white);border-radius:var(--r-lg);overflow:hidden;display:flex;gap:0;flex-wrap:wrap;border:1px solid var(--border-light)" class="reveal">
      <img src="/assets/img/firmenfitness/yuutel-referenz.jpg" alt="Yuutel Firmenfitness FlexFit Referenz" style="width:100%;max-width:380px;object-fit:cover;min-height:260px" loading="lazy">
      <div style="padding:32px;flex:1;min-width:280px;display:flex;flex-direction:column;justify-content:center">
        <span class="section-label" style="margin-bottom:12px">Referenz</span>
        <h3 style="font-size:1.2rem;margin-bottom:16px">yuutel GmbH – Betriebliche Gesundheitsförderung</h3>
        <p style="color:var(--text-secondary);line-height:1.7;font-size:.95rem">FlexFit begleitet yuutel bei der betrieblichen Gesundheitsförderung. Regelmäßige Trainingseinheiten, Workshops und Bewegungsberatung direkt im Unternehmen sorgen für messbar weniger Fehlzeiten und mehr Mitarbeiterzufriedenheit.</p>
        <a href="/kontakt" class="btn btn-outline-dark" style="margin-top:20px;align-self:flex-start">Auch für Ihr Unternehmen anfragen <?= icon('arrow-right') ?></a>
      </div>
    </div>
  </div>
</section>

<!-- PARTNER LOGOS -->
<section class="partners-section" style="background:var(--off-white)">
  <div class="container">
    <p class="partners-label">Bisherige Zusammenarbeit mit</p>
    <div class="partners-logos">
      <img src="/assets/img/partners/orf.png" alt="ORF" class="partner-logo" loading="lazy">
      <img src="/assets/img/partners/waterdrop.png" alt="Waterdrop" class="partner-logo" loading="lazy">
      <img src="/assets/img/partners/heute.png" alt="Heute" class="partner-logo" loading="lazy">
      <img src="/assets/img/partners/netdoktor.png" alt="Netdoktor" class="partner-logo" loading="lazy">
      <img src="/assets/img/partners/gerngross.png" alt="Gerngross" class="partner-logo" loading="lazy">
      <img src="/assets/img/partners/qualiant.png" alt="Qualiant" class="partner-logo" loading="lazy">
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-banner">
  <div class="container"><div class="reveal">
    <h2>Gemeinsam entwickeln wir Ihr Firmenfitness-Programm</h2>
    <p>F&ouml;rdern Sie die Gesundheit und das Wohlbefinden Ihrer Mitarbeiter mit unserer ma&szlig;geschneiderten Firmenfitness in Wien. Kontaktieren Sie Marcus K&ouml;hler direkt f&uuml;r eine unverbindliche Beratung &ndash; Ihr Unternehmen wird es Ihnen danken.</p>
    <div class="cta-banner-actions">
      <a href="/kontakt" class="btn btn-primary btn-lg">Unverbindlich anfragen <?= icon('arrow-right') ?></a>
      <a href="tel:+4312345678" class="btn btn-outline btn-lg">+43 1 234 5678</a>
    </div>
    <p style="margin-top:16px;font-size:.85rem;color:rgba(255,255,255,.5)">Marcus Muster &nbsp;·&nbsp; marcus@flexfit-demo.at &nbsp;·&nbsp; Mustergasse 12, 1080 Wien</p>
  </div></div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
