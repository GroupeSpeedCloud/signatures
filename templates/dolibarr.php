<table cellpadding="0" cellspacing="0" border="0" style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #333333; line-height: 1.5; max-width: 480px; border-left: 3px solid #8a4dfd;">
  <tr>
    <td style="padding: 12px 16px; background-color: #f7f4ff; border-bottom: 1px solid #e0d6ff;">
      <table cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td valign="middle" style="padding-right: 14px;">
            <img src="<?= $company['logo'] ?>" alt="<?= $company['name'] ?>" width="52" height="52" style="display: block; border-radius: 8px;">
          </td>
          <td valign="middle">
            <p style="margin: 0 0 2px 0; font-size: 15px; font-weight: 700; color: #1a1a1a; letter-spacing: -0.1px;"><?= $name ?></p>
            <?php if ($job): ?>
            <p style="margin: 0; font-size: 11px; color: #8a4dfd; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px;"><?= $job ?></p>
            <?php endif; ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td style="padding: 12px 16px; background-color: #ffffff;">
      <table cellpadding="0" cellspacing="0" border="0" style="font-size: 12px; color: #555555;">
        <tr>
          <td style="padding-bottom: 4px;">
            <a href="mailto:<?= $email ?>" style="color: #555555; text-decoration: none;"><?= $email ?></a>
          </td>
        </tr>
        <tr>
          <td style="<?= ($phone || $company['address']) ? 'padding-bottom: 4px;' : '' ?>">
            <a href="<?= $company['website'] ?>" style="color: #8a4dfd; text-decoration: none; font-weight: 600;"><?= $company['domain'] ?></a>
          </td>
        </tr>
        <?php if ($phone): ?>
        <tr>
          <td style="<?= $company['address'] ? 'padding-bottom: 4px;' : '' ?>"><?= $phone ?></td>
        </tr>
        <?php endif; ?>
        <?php if ($company['address']): ?>
        <tr>
          <td><?= $company['address'] ?></td>
        </tr>
        <?php endif; ?>
      </table>
    </td>
  </tr>
</table>
