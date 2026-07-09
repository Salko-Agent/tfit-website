<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();
$seo_key = 'datenschutz';
require_once __DIR__ . '/includes/header.php';
$site = $content['site'] ?? [];
?>
<section class="page-hero">
  <div class="container">
    <h1>Datenschutzerkl&auml;rung</h1>
    <p class="hero-subtitle">FlexFit nimmt den Schutz Ihrer personenbezogenen Daten ernst.</p>
  </div>
</section>
<section class="section-pad" style="background:var(--off-white)">
  <div class="container" style="max-width:780px">
    <div class="card"><div class="card-body" style="padding:40px">
      <p style="color:var(--text-muted);font-size:.85rem;margin-bottom:32px">
        Verantwortlicher: FlexFit, Mustergasse 12, 1080 Wien &mdash;
        <a href="mailto:marcus@flexfit-demo.at">marcus@flexfit-demo.at</a>
      </p>
      <h3 style="font-size:1.05rem;margin-top:28px;margin-bottom:8px">Umfang der Verarbeitung personenbezogener Daten</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.75">Wir erheben und verwenden personenbezogene Daten grundsätzlich nur, soweit dies zur Bereitstellung einer funktionsfähigen Website erforderlich ist.</p>
      <h3 style="font-size:1.05rem;margin-top:28px;margin-bottom:8px">Rechtsgrundlage</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.75">Soweit wir Einwilligungen einholen, gilt Art. 6 Abs. 1 lit. a DSGVO. Für Vertragserfüllung gilt Art. 6 Abs. 1 lit. b DSGVO.</p>
      <h3 style="font-size:1.05rem;margin-top:28px;margin-bottom:8px">Datenlöschung und Speicherdauer</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.75">Die personenbezogenen Daten werden gelöscht, sobald der Zweck der Speicherung entfällt.</p>
      <h3 style="font-size:1.05rem;margin-top:28px;margin-bottom:8px">Ihre Rechte</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.75">Sie haben das Recht auf Auskunft, Berichtigung, Löschung und Einschränkung der Verarbeitung.</p>
      <h3 style="font-size:1.05rem;margin-top:28px;margin-bottom:8px">Bereitstellung der Website / Logfiles</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.75">Bei jedem Aufruf erfasst unser System automatisiert Daten vom aufrufenden Rechner. Diese Daten werden nach spätestens sieben Tagen gelöscht.</p>
      <h3 style="font-size:1.05rem;margin-top:28px;margin-bottom:8px">Kontaktformular</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.75">Die eingegebenen Daten werden an uns übermittelt und gespeichert. Eine Weitergabe an Dritte findet nicht statt.</p>
      <h3 style="font-size:1.05rem;margin-top:28px;margin-bottom:8px">Cookies</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.75">Unsere Webseite verwendet technisch notwendige Cookies.</p>
      <h3 style="font-size:1.05rem;margin-top:28px;margin-bottom:8px">Google Analytics</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.75">Diese Website benutzt Google Analytics. Durch Aktivierung der IP-Anonymisierung wird Ihre IP-Adresse innerhalb der EU gekürzt.</p>
      <div style="margin-top:40px;padding-top:24px;border-top:1px solid var(--border-light)">
        <p style="color:var(--text-muted);font-size:.85rem">
          Fragen zu dieser Datenschutzerkl&auml;rung richten Sie bitte an:
          <a href="mailto:marcus@flexfit-demo.at" style="color:var(--gold)">marcus@flexfit-demo.at</a>
        </p>
      </div>
    </div></div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
