<table cellpadding="0" cellspacing="0" border="0" style="font-family: 'Titillium Web', 'Segoe UI', Tahoma, Arial, sans-serif; font-size: 13px; color: #333333; line-height: 1.45; max-width: 520px; border-collapse: collapse;">
  <tr>
    <td valign="top" style="padding-right: 14px; vertical-align: top; border-right: 2px solid #8a4dfd; width: 84px;">
      <img src="<?= htmlspecialchars($company['logo']) ?>" alt="<?= htmlspecialchars($company['name']) ?>" width="70" height="70" style="display: block; border-radius: 8px; border: 0;">
    </td>
    <td valign="top" style="padding-left: 14px; vertical-align: top;">
      <p style="margin: 0; font-size: 16px; line-height: 20px; font-weight: 700; color: #1f2937;"><?= $name ?></p>
      <?php if ($job): ?>
      <p style="margin: 3px 0 10px 0; font-size: 12px; line-height: 16px; color: #8a4dfd; font-weight: 600; text-transform: uppercase; letter-spacing: 0.4px;"><?= $job ?></p>
      <?php else: ?>
      <div style="height: 10px; line-height: 10px;">&nbsp;</div>
      <?php endif; ?>

      <table cellpadding="0" cellspacing="0" border="0" style="font-size: 12px; color: #4b5563; border-collapse: collapse;">
        <tr>
          <td style="padding: 0 8px 4px 0; color: #6b7280;">E-mail</td>
          <td style="padding: 0 0 4px 0;"><a href="mailto:<?= $email ?>" style="color: #4b5563; text-decoration: none;"><?= $email ?></a></td>
        </tr>
        <tr>
          <td style="padding: 0 8px 0 0; color: #6b7280;">Site</td>
          <td style="padding: 0;"><a href="<?= htmlspecialchars($company['website']) ?>" style="color: #8a4dfd; text-decoration: none; font-weight: 600;"><?= htmlspecialchars($company['domain']) ?></a></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
