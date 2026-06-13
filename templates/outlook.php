<!-- Signature Groupe Speed Cloud — Outlook (compatible MSO, pas de CSS shorthand) -->
<table cellpadding="0" cellspacing="0" border="0"
    style="font-family: 'Segoe UI', Tahoma, Arial, sans-serif; font-size: 13px; color: #374151; line-height: 1.5; max-width: 520px; border-collapse: collapse;">
  <tr>
    <!-- Logo -->
    <td valign="top" width="90" style="padding-right: 16px; padding-top: 2px; border-right: 2px solid #8a4dfd; vertical-align: top;">
      <img src="<?= htmlspecialchars($company['logo']) ?>"
           alt="<?= htmlspecialchars($company['name']) ?>"
           width="72" height="72"
           style="display: block; border-radius: 10px; border: 0;">
    </td>
    <!-- Infos -->
    <td valign="top" style="padding-left: 16px; vertical-align: top;">
      <!-- Nom -->
      <p style="margin: 0; margin-bottom: 1px; font-size: 16px; font-weight: 700; color: #111827; line-height: 1.25;">
        <?= $signatureData['name'] ?>
      </p>
      <!-- Poste -->
      <?php if (!empty($signatureData['job'])): ?>
      <p style="margin: 0; margin-bottom: 10px; font-size: 11px; font-weight: 600; color: #8a4dfd; text-transform: uppercase; letter-spacing: 0.6px;">
        <?= $signatureData['job'] ?>
      </p>
      <?php else: ?>
      <p style="margin: 0; margin-bottom: 10px; font-size: 11px;">&nbsp;</p>
      <?php endif; ?>

      <!-- Coordonnées -->
      <table cellpadding="0" cellspacing="0" border="0" style="font-size: 12px; color: #6b7280; border-collapse: collapse;">
        <?php if (!empty($signatureData['phone'])): ?>
        <tr>
          <td style="padding-right: 10px; padding-bottom: 3px; white-space: nowrap; color: #9ca3af; font-size: 11px;">Tél.</td>
          <td style="padding-bottom: 3px;">
            <a href="tel:<?= htmlspecialchars(preg_replace('/\s+/', '', $signatureData['phone'])) ?>"
               style="color: #374151; text-decoration: none;">
              <?= $signatureData['phone'] ?>
            </a>
          </td>
        </tr>
        <?php endif; ?>
        <tr>
          <td style="padding-right: 10px; padding-bottom: 3px; white-space: nowrap; color: #9ca3af; font-size: 11px;">E-mail</td>
          <td style="padding-bottom: 3px;">
            <a href="mailto:<?= $signatureData['email'] ?>"
               style="color: #374151; text-decoration: none;">
              <?= $signatureData['email'] ?>
            </a>
          </td>
        </tr>
        <tr>
          <td style="padding-right: 10px; padding-bottom: <?= !empty($signatureData['linkedin']) ? '3' : '0' ?>px; white-space: nowrap; color: #9ca3af; font-size: 11px;">Site</td>
          <td style="padding-bottom: <?= !empty($signatureData['linkedin']) ? '3' : '0' ?>px;">
            <a href="<?= htmlspecialchars($company['website']) ?>"
               style="color: #8a4dfd; text-decoration: none; font-weight: 600;">
              <?= htmlspecialchars($company['domain']) ?>
            </a>
          </td>
        </tr>
        <?php if (!empty($signatureData['linkedin'])): ?>
        <tr>
          <td style="padding-right: 10px; white-space: nowrap; color: #9ca3af; font-size: 11px;">LinkedIn</td>
          <td>
            <a href="<?= $signatureData['linkedin'] ?>"
               style="color: #0077b5; text-decoration: none; font-weight: 500;">
              Profil LinkedIn
            </a>
          </td>
        </tr>
        <?php endif; ?>
      </table>
    </td>
  </tr>
</table>
