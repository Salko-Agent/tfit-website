<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();
$seo_key = 'home';
$content['seo']['home']['title']       = 'FAQ – Häufige Fragen zu Personal Training Wien | FlexFit';
$content['seo']['home']['description'] = 'Häufig gestellte Fragen zu Personal Training bei FlexFit Wien: Ablauf, Kosten, Probetraining, Ernährung und mehr.';
$site = $content['site'] ?? [];
require_once __DIR__ . '/includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="container">
    <span class="section-label" style="justify-content:center;margin-bottom:16px">Häufige Fragen</span>
    <h1>FAQ – Ihre Fragen zu Personal Training</h1>
    <p style="max-width:640px;margin:20px auto 0;color:rgba(255,255,255,.75);font-size:1rem;line-height:1.7">
      Alles was Sie über Personal Training bei FlexFit wissen möchten – ehrlich &amp; direkt beantwortet.
    </p>
  </div>
</section>

<!-- FAQ ACCORDION -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container" style="max-width:780px">

    <style>
      .faq-item {
        background: var(--white);
        border-radius: var(--r-md);
        border: 1px solid var(--border-light);
        margin-bottom: 12px;
        overflow: hidden;
      }
      .faq-item summary {
        list-style: none;
        cursor: pointer;
        padding: 20px 24px;
        font-weight: 600;
        font-size: 1rem;
        color: var(--text-primary);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        transition: color .2s;
      }
      .faq-item summary::-webkit-details-marker { display: none; }
      .faq-item summary::after {
        content: '+';
        font-size: 1.4rem;
        font-weight: 300;
        color: var(--gold);
        flex-shrink: 0;
        line-height: 1;
        transition: transform .25s;
      }
      .faq-item[open] summary::after {
        transform: rotate(45deg);
      }
      .faq-item[open] summary {
        color: var(--gold);
      }
      .faq-answer {
        padding: 0 24px 20px;
        color: var(--text-secondary);
        font-size: .95rem;
        line-height: 1.75;
        border-top: 1px solid var(--border-light);
        padding-top: 16px;
      }
    </style>

    <?php
    $faqs = [
      [
        'q' => 'Für wen ist Personal Training geeignet?',
        'a' => 'Personal Training ist selbstverständlich für jeden, unabhängig von Alter, Geschlecht oder Leistungsstufe geeignet. Jeder profitiert von individuell betreutem Krafttraining.',
      ],
      [
        'q' => 'Wie lange dauert eine Personal Training Einheit?',
        'a' => 'Ein Training dauert je nach Wunsch 60 oder 45 Minuten.',
      ],
      [
        'q' => 'Wo findet das Personal Training statt?',
        'a' => 'Das Training findet bei uns im Studio statt, oder, falls gewünscht auch bei Ihnen Zuhause.',
      ],
      [
        'q' => 'Wie sieht ein Probetraining aus?',
        'a' => 'In einem unverbindlichen, kostenlosen Probetraining fokussieren wir uns auf die Ausarbeitung Ihrer Wünsche und Bedürfnisse. Es gibt eine gemeinsame Anamnese in der wir Ziele, Trainingszustand, Verletzungen etc. klären. Anschließend ein ca. 45 minütiges Kennenlern Personal Training bei dem die aktive Anamnese fortgesetzt wird. Nach dem Kennenlernen hat der Personal Trainer die Möglichkeit ein individuell, perfekt zugeschnittenes Personal Training für Sie zu erstellen.',
      ],
      [
        'q' => 'Was beinhaltet ein Training?',
        'a' => 'Zuerst findet das WarmUp statt. Hier geht es darum den Körper sowie den Geist auf das Training vorzubereiten. Zusätzlich werden hier schon einige Übungen zur Beweglichkeit und Stabilität eingebaut, welche individuell auf die Schwachstellen abzielen. Danach kommt der Hauptteil, welcher in der Regel aus einem Ganzkörper Krafttraining in Supersätzen stattfindet.',
      ],
      [
        'q' => 'Wird auch Ausdauer trainiert?',
        'a' => 'Im Rahmen des Personal Trainings wird auch Ausdauer in Form von Tabata trainiert. Tabata sind kurze intensive Belastungen, welche einen hohen Energieverbrauch bewirken und auch die Ausdauer steigern. Klassisches Grundlagenausdauertraining wird nicht gemeinsam absolviert.',
      ],
      [
        'q' => 'Wie oft muss in Betreuung trainiert werden?',
        'a' => 'Das hängt von Ihren Zielen ab und ist pauschal schwer zu beantworten. Meistens empfehle ich zumindest zu Beginn 2x wöchentlich in Betreuung zu trainieren, um eine Sicherheit für die Übungen zu bekommen. Nach einiger Zeit wird dann oft auf 1x wöchentlich reduziert und dazu 1-4x selbstständig zuhause, Outdoor oder im Fitnessstudio ein erstellter Plan umgesetzt.',
      ],
      [
        'q' => 'Wie schnell sehe ich Erfolge?',
        'a' => 'Das ist ebenso von Ihrem Ziel, dem Ausgangszustand, der Trainingshäufigkeit und anderen Faktoren wie z.B. Ernährung abhängig. Was Rücken- oder Nackenschmerzen betrifft wurden schon sehr oft nach wenigen Einheiten eindeutige Besserungen erzielt.',
      ],
      [
        'q' => 'Wird auch Ernährung behandelt?',
        'a' => 'Ja, Ernährung ist ein unglaublich wichtiges Thema für Fitness und Gesundheit. Wenn Sie das Thema interessiert, bekommen Sie ein Ernährungssheet welches Ihnen ein gut aufgestelltes Grundwissen über Ernährung geben soll. Anschließend wird Ihre Ernährung 3 Tage exakt dokumentiert, und wir besprechen etwaige Verbesserungen. Im Rahmen des Personal Trainings steht der Trainer natürlich immer für Fragen zur Verfügung.',
      ],
      [
        'q' => 'Was kostet Personal Training?',
        'a' => 'Das unverbindliche Probetraining ist kostenlos. Danach haben Sie die Wahl zwischen einem 10er oder 20er Block. Das Training startet ab 67€ (45 min. / 20er Block).',
      ],
    ];
    foreach ($faqs as $i => $faq):
    ?>
    <details class="faq-item reveal">
      <summary><?= e($faq['q']) ?></summary>
      <div class="faq-answer"><?= e($faq['a']) ?></div>
    </details>
    <?php endforeach; ?>

  </div>
</section>

<!-- CTA -->
<section class="cta-banner">
  <div class="container"><div class="reveal">
    <h2>Noch Fragen? Einfach melden!</h2>
    <p>Wagneren Sie Ihr gratis Probetraining oder schreiben Sie uns – wir antworten schnell und unkompliziert.</p>
    <div class="cta-banner-actions">
      <a href="/probetraining.php" class="btn btn-primary btn-lg">Gratis Probetraining buchen <?= icon('arrow-right') ?></a>
      <a href="/kontakt.php" class="btn btn-outline btn-lg">Kontakt</a>
    </div>
    <p class="cta-note">&#10003; Kostenlos &nbsp;&middot;&nbsp; &#10003; Unverbindlich &nbsp;&middot;&nbsp; &#10003; Kein Vertrag</p>
  </div></div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
