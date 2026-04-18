<table cellpadding="0" cellspacing="0" border="0" style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #333333; line-height: 1.5; max-width: 480px;">
  <tr>
    <td valign="top" style="padding-right: 16px; border-right: 3px solid #8a4dfd; padding-top: 3px;">
      <img src="<?= $company['logo'] ?>" alt="<?= $company['name'] ?>" width="68" height="68" style="display: block; border-radius: 8px;">
    </td>
    <td valign="top" style="padding-left: 16px;">
      <p style="margin: 0 0 2px 0; font-size: 15px; font-weight: 700; color: #1a1a1a; letter-spacing: -0.1px;"><?= $name ?></p>
      <?php if ($job): ?>
      <p style="margin: 0 0 10px 0; font-size: 11px; color: #8a4dfd; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px;"><?= $job ?></p>
      <?php else: ?>
      <p style="margin: 0 0 10px 0;"></p>
      <?php endif; ?>
      <p style="margin: 0 0 3px 0; font-size: 12px; color: #555555;">
        <a href="mailto:<?= $email ?>" style="color: #555555; text-decoration: none;"><?= $email ?></a>
      </p>
      <p style="margin: 0<?= $phone ? ' 0 3px 0' : '' ?>; font-size: 12px;">
        <a href="<?= $company['website'] ?>" style="color: #8a4dfd; text-decoration: none; font-weight: 600;"><?= $company['domain'] ?></a>
      </p>
      <?php if ($phone): ?>
      <p style="margin: 0; font-size: 12px; color: #555555;"><?= $phone ?></p>
      <?php endif; ?>
    </td>
  </tr>
</table>
