<!-- Signature Groupe Speed Cloud — Outlook (compatible MSO) -->
<table cellpadding="0" cellspacing="0" border="0"
    style="font-family: 'Segoe UI', Tahoma, Arial, sans-serif; font-size: 13px; color: #333333; line-height: 1.5; max-width: 520px; border-collapse: collapse;">
  <tr>
    <!-- Logo -->
    <td valign="top" width="90" style="padding-right: 16px; border-right: 2px solid #8a4dfd; vertical-align: top;">
      <img src="<?= htmlspecialchars($company['logo']) ?>"
           alt="<?= htmlspecialchars($company['name']) ?>"
           width="70" height="70"
           style="display: block; border-radius: 10px; border: 0;">
    </td>
    <!-- Infos -->
    <td valign="top" style="padding-left: 16px; vertical-align: top;">
      <p style="margin: 0 0 2px 0; font-size: 16px; font-weight: 700; color: #111827; line-height: 1.2;">
        <?= htmlspecialchars($signatureData['name']) ?>
      </p>
      <?php if (!empty($signatureData['job'])): ?>
      <p style="margin: 0 0 10px 0; font-size: 11px; font-weight: 600; color: #8a4dfd; text-transform: uppercase; letter-spacing: 0.5px;">
        <?= htmlspecialchars($signatureData['job']) ?>
      </p>
      <?php else: ?>
      <p style="margin: 0 0 10px 0; font-size: 11px;">&nbsp;</p>
      <?php endif; ?>

      <table cellpadding="0" cellspacing="0" border="0" style="font-size: 12px; color: #4b5563; border-collapse: collapse;">
        <?php if (!empty($signatureData['phone'])): ?>
        <tr>
          <td style="padding: 0 10px 3px 0; color: #9ca3af;">Tél.</td>
          <td style="padding: 0 0 3px 0;">
            <a href="tel:<?= htmlspecialchars(preg_replace('/\s+/', '', $signatureData['phone'])) ?>"
               style="color: #374151; text-decoration: none;">
              <?= htmlspecialchars($signatureData['phone']) ?>
            </a>
          </td>
        </tr>
        <?php endif; ?>
        <tr>
          <td style="padding: 0 10px 3px 0; color: #9ca3af;">E-mail</td>
          <td style="padding: 0 0 3px 0;">
            <a href="mailto:<?= htmlspecialchars($signatureData['email']) ?>"
               style="color: #374151; text-decoration: none;">
              <?= htmlspecialchars($signatureData['email']) ?>
            </a>
          </td>
        </tr>
        <tr>
          <td style="padding: 0 10px 0 0; color: #9ca3af;">Site</td>
          <td style="padding: 0;">
            <a href="<?= htmlspecialchars($company['website']) ?>"
               style="color: #8a4dfd; text-decoration: none; font-weight: 600;">
              <?= htmlspecialchars($company['domain']) ?>
            </a>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
