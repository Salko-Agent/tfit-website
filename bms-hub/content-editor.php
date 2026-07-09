<?php
require_once __DIR__ . '/auth.php';
bms_require_auth();
require_once __DIR__ . '/config.php';
require_once BMS_ROOT . '/includes/functions.php';

$content = load_content();
$section = $_GET['section'] ?? 'hero';
$page    = 'content';

// Handle save
$saved = false;
$saveError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_action']) && $_POST['_action'] === 'save') {
    if (!bms_csrf_valid()) {
        $saveError = 'Ungültiger Token.';
    } else {
        // Merge posted fields into content
        $posted = $_POST;
        unset($posted['_action'], $posted['_csrf'], $posted['_section']);

        // Deep update based on section
        switch ($section) {
            case 'hero':
                foreach (['badge','headline_line1','headline_line2','subheadline','price_note',
                          'cta_primary','cta_primary_url','cta_secondary','cta_secondary_url',
                          'trust_text','rating','bg_image'] as $f) {
                    if (isset($posted[$f])) $content['hero'][$f] = trim($posted[$f]);
                }
                break;

            case 'site':
                foreach (['name','full_name','tagline','description','phone','email',
                          'address','maps_url','instagram','facebook','logo'] as $f) {
                    if (isset($posted[$f])) $content['site'][$f] = trim($posted[$f]);
                }
                break;

            case 'trainer':
                foreach (['name','title','credentials','experience','bio','bio2','photo'] as $f) {
                    if (isset($posted[$f])) $content['trainer'][$f] = trim($posted[$f]);
                }
                // Specializations (textarea, one per line)
                if (isset($posted['specializations_text'])) {
                    $lines = array_filter(array_map('trim', explode("\n", $posted['specializations_text'])));
                    $content['trainer']['specializations'] = array_values($lines);
                }
                break;

            case 'testimonials':
                // Rebuild testimonials array from posted data
                $names  = $posted['testimonial_name']  ?? [];
                $texts  = $posted['testimonial_text']  ?? [];
                $dates  = $posted['testimonial_date']  ?? [];
                $ratings= $posted['testimonial_rating']?? [];
                $content['testimonials'] = [];
                foreach ($names as $i => $name) {
                    if (empty(trim($name))) continue;
                    $content['testimonials'][] = [
                        'name'     => trim($name),
                        'text'     => trim($texts[$i] ?? ''),
                        'date'     => trim($dates[$i] ?? ''),
                        'rating'   => (int)($ratings[$i] ?? 5),
                        'initials' => strtoupper(substr(trim($name), 0, 1)),
                    ];
                }
                break;

            case 'stats':
                $nums   = $posted['stat_number'] ?? [];
                $labels = $posted['stat_label']  ?? [];
                $content['stats'] = [];
                foreach ($nums as $i => $num) {
                    if (empty(trim($num))) continue;
                    $content['stats'][] = [
                        'number' => trim($num),
                        'label'  => trim($labels[$i] ?? ''),
                    ];
                }
                break;

            case 'seo':
                foreach (['home','personal_training','kontakt'] as $pg) {
                    if (isset($posted["seo_{$pg}_title"])) {
                        $content['seo'][$pg]['title']       = trim($posted["seo_{$pg}_title"]);
                        $content['seo'][$pg]['description'] = trim($posted["seo_{$pg}_description"] ?? '');
                    }
                }
                break;

            case 'contact':
                foreach (['headline','subtext','address','email','hours','hours_weekend'] as $f) {
                    if (isset($posted[$f])) $content['contact'][$f] = trim($posted[$f]);
                }
                break;
        }

        $content['meta']['last_updated'] = date('Y-m-d');

        if (save_content($content)) {
            header("Location: /bms-hub/content-editor.php?section=$section&saved=1");
            exit;
        } else {
            $saveError = 'Fehler beim Speichern. Schreibrechte prüfen.';
        }
    }
}

include __DIR__ . '/partials/admin-header.php';

// Section labels
$sectionLabels = [
    'hero'         => '🖼️ Hero-Bereich',
    'site'         => '⚙️ Allgemeine Infos',
    'trainer'      => '👤 Trainer / Team',
    'services'     => '💪 Leistungen',
    'testimonials' => '⭐ Testimonials',
    'stats'        => '📈 Statistiken',
    'seo'          => '🔍 SEO & Meta',
    'contact'      => '📍 Kontakt',
];
?>

<div class="admin-page-header">
  <div>
    <h1><?= htmlspecialchars($sectionLabels[$section] ?? $section) ?></h1>
    <p>Bearbeite die Inhalte und klicke auf Speichern.</p>
  </div>
  <div style="display:flex;gap:8px">
    <a href="/" target="_blank" class="admin-btn admin-btn-outline">🌐 Vorschau</a>
    <a href="/bms-hub/dashboard.php" class="admin-btn admin-btn-outline">← Dashboard</a>
  </div>
</div>

<!-- TAB NAV -->
<div class="admin-tabs">
  <?php foreach ($sectionLabels as $key => $label): ?>
  <a href="?section=<?= $key ?>" class="admin-tab <?= $section === $key ? 'active' : '' ?>"><?= $label ?></a>
  <?php endforeach; ?>
</div>

<?php if ($saveError): ?>
<div class="admin-alert admin-alert-error"><?= htmlspecialchars($saveError) ?></div>
<?php endif; ?>

<form method="POST">
  <input type="hidden" name="_action" value="save">
  <input type="hidden" name="_section" value="<?= htmlspecialchars($section) ?>">
  <input type="hidden" name="_csrf" value="<?= htmlspecialchars(bms_csrf_token()) ?>">

  <?php if ($section === 'hero'): $hero = $content['hero'] ?? []; ?>
  <div class="admin-card">
    <div class="admin-card-header">
      <span class="admin-card-title">Hero-Sektion Startseite</span>
    </div>
    <div class="admin-form-row">
      <div class="admin-form-group">
        <label class="admin-label">Badge-Text (kleine Zeile oben)</label>
        <input class="admin-input" name="badge" value="<?= htmlspecialchars($hero['badge'] ?? '') ?>">
      </div>
      <div class="admin-form-group">
        <label class="admin-label">Google Rating</label>
        <input class="admin-input" name="rating" value="<?= htmlspecialchars($hero['rating'] ?? '4.9') ?>">
      </div>
    </div>
    <div class="admin-form-row">
      <div class="admin-form-group">
        <label class="admin-label">Headline Zeile 1</label>
        <input class="admin-input" name="headline_line1" value="<?= htmlspecialchars($hero['headline_line1'] ?? '') ?>">
      </div>
      <div class="admin-form-group">
        <label class="admin-label">Headline Zeile 2 (gold hervorgehoben)</label>
        <input class="admin-input" name="headline_line2" value="<?= htmlspecialchars($hero['headline_line2'] ?? '') ?>">
      </div>
    </div>
    <div class="admin-form-group">
      <label class="admin-label">Subheadline</label>
      <textarea class="admin-textarea" name="subheadline" style="min-height:80px"><?= htmlspecialchars($hero['subheadline'] ?? '') ?></textarea>
    </div>
    <div class="admin-form-row">
      <div class="admin-form-group">
        <label class="admin-label">Preishinweis</label>
        <input class="admin-input" name="price_note" value="<?= htmlspecialchars($hero['price_note'] ?? '') ?>">
      </div>
      <div class="admin-form-group">
        <label class="admin-label">Trust-Text (HTML erlaubt für &lt;strong&gt;)</label>
        <input class="admin-input" name="trust_text" value="<?= htmlspecialchars($hero['trust_text'] ?? '') ?>">
      </div>
    </div>
    <div class="admin-form-row">
      <div class="admin-form-group">
        <label class="admin-label">CTA Button 1 Text</label>
        <input class="admin-input" name="cta_primary" value="<?= htmlspecialchars($hero['cta_primary'] ?? '') ?>">
      </div>
      <div class="admin-form-group">
        <label class="admin-label">CTA Button 1 URL</label>
        <input class="admin-input" name="cta_primary_url" value="<?= htmlspecialchars($hero['cta_primary_url'] ?? '') ?>">
      </div>
    </div>
    <div class="admin-form-row">
      <div class="admin-form-group">
        <label class="admin-label">CTA Button 2 Text</label>
        <input class="admin-input" name="cta_secondary" value="<?= htmlspecialchars($hero['cta_secondary'] ?? '') ?>">
      </div>
      <div class="admin-form-group">
        <label class="admin-label">CTA Button 2 URL</label>
        <input class="admin-input" name="cta_secondary_url" value="<?= htmlspecialchars($hero['cta_secondary_url'] ?? '') ?>">
      </div>
    </div>
    <div class="admin-form-group">
      <label class="admin-label">Hero Hintergrundbild URL</label>
      <input class="admin-input" name="bg_image" value="<?= htmlspecialchars($hero['bg_image'] ?? '') ?>">
      <span class="admin-hint">Direkte Bild-URL (https://...)</span>
    </div>
  </div>

  <?php elseif ($section === 'site'): $site = $content['site'] ?? []; ?>
  <div class="admin-card">
    <div class="admin-card-header"><span class="admin-card-title">Allgemeine Seiten-Infos</span></div>
    <div class="admin-form-row">
      <div class="admin-form-group">
        <label class="admin-label">E-Mail Adresse</label>
        <input class="admin-input" name="email" type="email" value="<?= htmlspecialchars($site['email'] ?? '') ?>">
      </div>
      <div class="admin-form-group">
        <label class="admin-label">Telefon</label>
        <input class="admin-input" name="phone" value="<?= htmlspecialchars($site['phone'] ?? '') ?>">
      </div>
    </div>
    <div class="admin-form-group">
      <label class="admin-label">Adresse</label>
      <input class="admin-input" name="address" value="<?= htmlspecialchars($site['address'] ?? '') ?>">
    </div>
    <div class="admin-form-group">
      <label class="admin-label">Google Maps URL</label>
      <input class="admin-input" name="maps_url" value="<?= htmlspecialchars($site['maps_url'] ?? '') ?>">
    </div>
    <div class="admin-form-row">
      <div class="admin-form-group">
        <label class="admin-label">Instagram URL</label>
        <input class="admin-input" name="instagram" value="<?= htmlspecialchars($site['instagram'] ?? '') ?>">
      </div>
      <div class="admin-form-group">
        <label class="admin-label">Facebook URL</label>
        <input class="admin-input" name="facebook" value="<?= htmlspecialchars($site['facebook'] ?? '') ?>">
      </div>
    </div>
    <div class="admin-form-group">
      <label class="admin-label">Logo URL</label>
      <input class="admin-input" name="logo" value="<?= htmlspecialchars($site['logo'] ?? '') ?>">
      <span class="admin-hint">Direkte Bild-URL zum Logo (quadratisch empfohlen)</span>
    </div>
    <div class="admin-form-group">
      <label class="admin-label">Tagline (kurze Beschreibung)</label>
      <input class="admin-input" name="tagline" value="<?= htmlspecialchars($site['tagline'] ?? '') ?>">
    </div>
  </div>

  <?php elseif ($section === 'trainer'): $trainer = $content['trainer'] ?? []; ?>
  <div class="admin-card">
    <div class="admin-card-header"><span class="admin-card-title">Trainer-Profil</span></div>
    <div class="admin-form-row">
      <div class="admin-form-group">
        <label class="admin-label">Name</label>
        <input class="admin-input" name="name" value="<?= htmlspecialchars($trainer['name'] ?? '') ?>">
      </div>
      <div class="admin-form-group">
        <label class="admin-label">Titel / Position</label>
        <input class="admin-input" name="title" value="<?= htmlspecialchars($trainer['title'] ?? '') ?>">
      </div>
    </div>
    <div class="admin-form-row">
      <div class="admin-form-group">
        <label class="admin-label">Credentials (Zeile unter Titel)</label>
        <input class="admin-input" name="credentials" value="<?= htmlspecialchars($trainer['credentials'] ?? '') ?>">
      </div>
      <div class="admin-form-group">
        <label class="admin-label">Erfahrung</label>
        <input class="admin-input" name="experience" value="<?= htmlspecialchars($trainer['experience'] ?? '') ?>">
      </div>
    </div>
    <div class="admin-form-group">
      <label class="admin-label">Bio (Absatz 1)</label>
      <textarea class="admin-textarea" name="bio"><?= htmlspecialchars($trainer['bio'] ?? '') ?></textarea>
    </div>
    <div class="admin-form-group">
      <label class="admin-label">Bio (Absatz 2, optional)</label>
      <textarea class="admin-textarea" name="bio2"><?= htmlspecialchars($trainer['bio2'] ?? '') ?></textarea>
    </div>
    <div class="admin-form-group">
      <label class="admin-label">Foto URL</label>
      <input class="admin-input" name="photo" value="<?= htmlspecialchars($trainer['photo'] ?? '') ?>">
    </div>
    <div class="admin-form-group">
      <label class="admin-label">Spezialisierungen (eine pro Zeile)</label>
      <textarea class="admin-textarea" name="specializations_text" style="min-height:140px"><?= htmlspecialchars(implode("\n", $trainer['specializations'] ?? [])) ?></textarea>
    </div>
  </div>

  <?php elseif ($section === 'testimonials'): $testimonials = $content['testimonials'] ?? []; ?>
  <div class="admin-section">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
      <h2 class="admin-section-title">Testimonials verwalten</h2>
      <button type="button" class="admin-btn admin-btn-outline admin-btn-sm" id="addTestimonial">+ Neu hinzufügen</button>
    </div>
    <div id="testimonials-list">
      <?php foreach ($testimonials as $i => $t): ?>
      <div class="admin-card" style="margin-bottom:16px" data-testimonial>
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
          <strong style="color:#FFF">Testimonial <?= $i + 1 ?></strong>
          <button type="button" class="admin-btn admin-btn-danger admin-btn-sm remove-testimonial">Entfernen</button>
        </div>
        <div class="admin-form-row">
          <div class="admin-form-group">
            <label class="admin-label">Name</label>
            <input class="admin-input" name="testimonial_name[]" value="<?= htmlspecialchars($t['name'] ?? '') ?>">
          </div>
          <div class="admin-form-group">
            <label class="admin-label">Datum</label>
            <input class="admin-input" name="testimonial_date[]" value="<?= htmlspecialchars($t['date'] ?? '') ?>">
          </div>
        </div>
        <div class="admin-form-group">
          <label class="admin-label">Bewertungstext</label>
          <textarea class="admin-textarea" name="testimonial_text[]"><?= htmlspecialchars($t['text'] ?? '') ?></textarea>
        </div>
        <div class="admin-form-group">
          <label class="admin-label">Sterne (1–5)</label>
          <select class="admin-select" name="testimonial_rating[]">
            <?php for ($s = 5; $s >= 1; $s--): ?>
            <option value="<?= $s ?>" <?= ($t['rating'] ?? 5) == $s ? 'selected' : '' ?>><?= $s ?> Sterne</option>
            <?php endfor; ?>
          </select>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <?php elseif ($section === 'stats'): $stats = $content['stats'] ?? []; ?>
  <div class="admin-card">
    <div class="admin-card-header"><span class="admin-card-title">Statistiken / Zahlen</span></div>
    <p style="color:var(--text-2);font-size:.83rem;margin-bottom:20px">Diese Zahlen erscheinen im Statistik-Streifen unterhalb des Heros.</p>
    <?php foreach ($stats as $i => $stat): ?>
    <div class="admin-form-row" style="align-items:end">
      <div class="admin-form-group">
        <label class="admin-label">Zahl <?= $i + 1 ?></label>
        <input class="admin-input" name="stat_number[]" value="<?= htmlspecialchars($stat['number'] ?? '') ?>" placeholder="z.B. 15+, 4.9★">
      </div>
      <div class="admin-form-group">
        <label class="admin-label">Beschriftung</label>
        <input class="admin-input" name="stat_label[]" value="<?= htmlspecialchars($stat['label'] ?? '') ?>" placeholder="z.B. Jahre Erfahrung">
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <?php elseif ($section === 'seo'): $seo = $content['seo'] ?? []; ?>
  <div class="admin-card">
    <div class="admin-card-header"><span class="admin-card-title">SEO Meta-Tags</span></div>
    <p style="color:var(--text-2);font-size:.83rem;margin-bottom:20px">Title: max. 60 Zeichen · Description: max. 160 Zeichen</p>

    <?php foreach (['home'=>'Startseite', 'personal_training'=>'Personal Training', 'kontakt'=>'Kontakt'] as $key => $label): ?>
    <div class="admin-divider"></div>
    <h3 style="color:#FFF;font-size:.9rem;margin-bottom:16px"><?= $label ?></h3>
    <div class="admin-form-group">
      <label class="admin-label">Meta Title</label>
      <input class="admin-input" name="seo_<?= $key ?>_title" value="<?= htmlspecialchars($seo[$key]['title'] ?? '') ?>">
    </div>
    <div class="admin-form-group">
      <label class="admin-label">Meta Description</label>
      <textarea class="admin-textarea" name="seo_<?= $key ?>_description" style="min-height:70px"><?= htmlspecialchars($seo[$key]['description'] ?? '') ?></textarea>
    </div>
    <?php endforeach; ?>
  </div>

  <?php elseif ($section === 'contact'): $contact = $content['contact'] ?? []; ?>
  <div class="admin-card">
    <div class="admin-card-header"><span class="admin-card-title">Kontakt-Sektion</span></div>
    <div class="admin-form-group">
      <label class="admin-label">Überschrift Kontakt-Sektion</label>
      <input class="admin-input" name="headline" value="<?= htmlspecialchars($contact['headline'] ?? '') ?>">
    </div>
    <div class="admin-form-group">
      <label class="admin-label">Untertext</label>
      <textarea class="admin-textarea" name="subtext"><?= htmlspecialchars($contact['subtext'] ?? '') ?></textarea>
    </div>
    <div class="admin-form-row">
      <div class="admin-form-group">
        <label class="admin-label">Adresse</label>
        <input class="admin-input" name="address" value="<?= htmlspecialchars($contact['address'] ?? '') ?>">
      </div>
      <div class="admin-form-group">
        <label class="admin-label">E-Mail</label>
        <input class="admin-input" name="email" type="email" value="<?= htmlspecialchars($contact['email'] ?? '') ?>">
      </div>
    </div>
    <div class="admin-form-row">
      <div class="admin-form-group">
        <label class="admin-label">Öffnungszeiten Wochentags</label>
        <input class="admin-input" name="hours" value="<?= htmlspecialchars($contact['hours'] ?? '') ?>">
      </div>
      <div class="admin-form-group">
        <label class="admin-label">Öffnungszeiten Wochenende</label>
        <input class="admin-input" name="hours_weekend" value="<?= htmlspecialchars($contact['hours_weekend'] ?? '') ?>">
      </div>
    </div>
  </div>

  <?php else: ?>
  <div class="admin-alert admin-alert-info">Dieser Bereich wird in einer zukünftigen Version verfügbar sein.</div>
  <?php endif; ?>

  <!-- SAVE BAR -->
  <div style="position:sticky;bottom:0;background:var(--surface);border-top:1px solid var(--border);padding:16px 0;margin-top:24px;display:flex;justify-content:flex-end;gap:12px;z-index:100">
    <a href="/bms-hub/dashboard.php" class="admin-btn admin-btn-outline">Abbrechen</a>
    <button type="submit" class="admin-btn admin-btn-primary">💾 Änderungen speichern</button>
  </div>
</form>

<?php include __DIR__ . '/partials/admin-footer.php'; ?>
