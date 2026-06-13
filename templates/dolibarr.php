<!-- Signature Groupe Speed Cloud — Dolibarr -->
<table cellpadding="0" cellspacing="0" border="0"
    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #1f2937; border-collapse: collapse; max-width: 480px;">
  <!-- En-tête violet -->
  <tr>
    <td style="padding: 12px 16px; background-color: #8a4dfd; border-radius: 8px 8px 0 0;">
      <table cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
        <tr>
          <td valign="middle" style="padding-right: 12px;">
            <img src="<?= htmlspecialchars($company['logo']) ?>"
                 alt="<?= htmlspecialchars($company['name']) ?>"
                 width="44" height="44"
                 style="display: block; border-radius: 8px; border: 0;">
          </td>
          <td valign="middle">
            <span style="display: block; font-size: 15px; font-weight: 700; color: #ffffff; line-height: 1.2;">
              <?= htmlspecialchars($signatureData['name']) ?>
            </span>
            <?php if (!empty($signatureData['job'])): ?>
            <span style="display: block; font-size: 11px; font-weight: 500; color: #e0d4ff; margin-top: 2px;">
              <?= htmlspecialchars($signatureData['job']) ?>
            </span>
            <?php endif; ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <!-- Corps -->
  <tr>
    <td style="padding: 12px 16px; background-color: #f9fafb; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 8px 8px;">
      <table cellpadding="0" cellspacing="0" border="0" style="font-size: 11px; border-collapse: collapse; color: #4b5563; width: 100%;">
        <?php if (!empty($signatureData['phone'])): ?>
        <tr>
          <td style="padding: 0 10px 4px 0; color: #9ca3af; white-space: nowrap; width: 50px;">Tél.</td>
          <td style="padding: 0 0 4px 0;">
            <a href="tel:<?= htmlspecialchars(preg_replace('/\s+/', '', $signatureData['phone'])) ?>"
               style="color: #374151; text-decoration: none; font-weight: 500;">
              <?= htmlspecialchars($signatureData['phone']) ?>
            </a>
          </td>
        </tr>
        <?php endif; ?>
        <tr>
          <td style="padding: 0 10px 4px 0; color: #9ca3af; white-space: nowrap;">E-mail</td>
          <td style="padding: 0 0 4px 0;">
            <a href="mailto:<?= htmlspecialchars($signatureData['email']) ?>"
               style="color: #374151; text-decoration: none; font-weight: 500;">
              <?= htmlspecialchars($signatureData['email']) ?>
            </a>
          </td>
        </tr>
        <tr>
          <td style="padding: 0 10px 4px 0; color: #9ca3af; white-space: nowrap;">Site</td>
          <td style="padding: 0 0 4px 0;">
            <a href="<?= htmlspecialchars($company['website']) ?>"
               style="color: #8a4dfd; text-decoration: none; font-weight: 600;">
              <?= htmlspecialchars($company['domain']) ?>
            </a>
          </td>
        </tr>
        <tr>
          <td style="padding: 0 10px 0 0; color: #9ca3af; white-space: nowrap; vertical-align: top;">Adresse</td>
          <td style="padding: 0; color: #6b7280;">
            <?= htmlspecialchars($company['address']) ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
