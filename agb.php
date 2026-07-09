<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();
$seo_key = 'agb';
require_once __DIR__ . '/includes/header.php';
$site = $content['site'] ?? [];
?>
<section class="page-hero">
  <div class="container">
    <h1>Allgemeine Gesch&auml;ftsbedingungen</h1>
    <p class="hero-subtitle">AGB von FlexFit</p>
  </div>
</section>
<section class="section-pad" style="background:var(--off-white)">
  <div class="container" style="max-width:780px">
    <div class="card"><div class="card-body" style="padding:40px">
      <h3 style="font-size:1.05rem;margin-bottom:8px">&sect; 1 Geltungsbereich</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.75;margin-bottom:24px">Diese Allgemeinen Gesch&auml;ftsbedingungen gelten f&uuml;r alle Vertr&auml;ge zwischen FlexFit und den Kunden &uuml;ber Personal Training, Physiotherapie und sonstige Dienstleistungen.</p>
      <h3 style="font-size:1.05rem;margin-bottom:8px">&sect; 2 Vertragsschluss</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.75;margin-bottom:24px">Ein Vertrag kommt zustande, wenn der Anbieter eine schriftliche Wagnerungsbest&auml;tigung per E-Mail &uuml;bermittelt oder die Dienstleistung tats&auml;chlich erbracht wird.</p>
      <h3 style="font-size:1.05rem;margin-bottom:8px">&sect; 3 Preise und Zahlung</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.75;margin-bottom:24px">Alle Preise sind in Euro angegeben und verstehen sich inkl. der gesetzlichen Umsatzsteuer. Die Zahlung erfolgt nach Rechnungsstellung, f&auml;llig innerhalb von 14 Tagen.</p>
      <h3 style="font-size:1.05rem;margin-bottom:8px">&sect; 4 Stornierung und Absagen</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.75;margin-bottom:24px">Termine k&ouml;nnen bis 24 Stunden vor Beginn kostenlos storniert werden. Bei sp&auml;terer Absage oder Nichterscheinen wird die volle Einheit verrechnet.</p>
      <h3 style="font-size:1.05rem;margin-bottom:8px">&sect; 5 Haftung</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.75;margin-bottom:24px">Der Anbieter haftet nicht f&uuml;r Sch&auml;den, die durch unsachgem&auml;&szlig;e Ausf&uuml;hrung von &Uuml;bungen durch den Kunden entstehen.</p>
      <h3 style="font-size:1.05rem;margin-bottom:8px">&sect; 6 Datenschutz</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.75;margin-bottom:24px">Die Verarbeitung personenbezogener Daten erfolgt gem&auml;&szlig; unserer <a href="/datenschutz.php" style="color:var(--gold)">Datenschutzerkl&auml;rung</a> und der DSGVO.</p>
      <h3 style="font-size:1.05rem;margin-bottom:8px">&sect; 7 Anwendbares Recht und Gerichtsstand</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.75;margin-bottom:24px">Es gilt &ouml;sterreichisches Recht. Gerichtsstand ist Wien.</p>
      <div style="margin-top:40px;padding-top:24px;border-top:1px solid var(--border-light)">
        <p style="color:var(--text-muted);font-size:.85rem">Fragen: <a href="mailto:marcus@flexfit-demo.at" style="color:var(--gold)">marcus@flexfit-demo.at</a></p>
      </div>
    </div></div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
