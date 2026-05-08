<table cellpadding="0" cellspacing="0" border="0" style="font-family: 'Titillium Web', Arial, sans-serif; font-size: 12px; color: #1f2937; border-collapse: collapse; max-width: 520px;">
  <tr>
    <td style="padding: 12px 16px; background-color: #8a4dfd; border-radius: 8px 8px 0 0;">
      <table cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
        <tr>
          <td style="vertical-align: middle; padding-right: 12px;">
            <img src="<?= htmlspecialchars($company['logo']) ?>" alt="<?= htmlspecialchars($company['name']) ?>" width="46" height="46" style="display: block; border-radius: 8px; border: 0;">
          </td>
          <td style="vertical-align: middle;">
            <span style="font-size: 15px; line-height: 19px; font-weight: 700; color: #ffffff; display: block;"><?= $name ?></span>
            <?php if ($job): ?>
            <span style="font-size: 11px; line-height: 15px; color: #efe6ff; font-weight: 600; display: block; margin-top: 2px;"><?= $job ?></span>
            <?php endif; ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td style="padding: 12px 16px; background-color: #f8f9fb; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 8px 8px;">
      <table cellpadding="0" cellspacing="0" border="0" style="font-size: 11px; border-collapse: collapse; color: #4b5563;">
        <tr>
          <td style="padding: 0 8px 4px 0; color: #6b7280;">E-mail</td>
          <td style="padding: 0 0 4px 0;"><a href="mailto:<?= $email ?>" style="color: #374151; text-decoration: none; font-weight: 500;"><?= $email ?></a></td>
        </tr>
        <tr>
          <td style="padding: 0 8px 4px 0; color: #6b7280;">Site</td>
          <td style="padding: 0 0 4px 0;"><a href="<?= htmlspecialchars($company['website']) ?>" style="color: #8a4dfd; text-decoration: none; font-weight: 600;"><?= htmlspecialchars($company['domain']) ?></a></td>
        </tr>
        <tr>
          <td style="padding: 0 8px 0 0; color: #6b7280; vertical-align: top;">Adresse</td>
          <td style="padding: 0; color: #374151;"><?= htmlspecialchars($company['address']) ?></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
