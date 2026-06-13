<!-- Signature Groupe Speed Cloud — Gmail -->
<table cellpadding="0" cellspacing="0" border="0"
    style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #374151; line-height: 1.5; max-width: 520px; border-collapse: collapse;">
  <tbody>
    <tr>
      <!-- Logo -->
      <td style="vertical-align: top; padding-right: 16px; border-right: 2.5px solid #8a4dfd; width: 90px; padding-top: 2px;">
        <img src="<?= htmlspecialchars($company['logo']) ?>"
             alt="<?= htmlspecialchars($company['name']) ?>"
             width="72" height="72"
             style="display: block; border-radius: 10px; border: 0;">
      </td>
      <!-- Infos -->
      <td style="vertical-align: top; padding-left: 16px;">
        <!-- Nom -->
        <p style="margin: 0 0 1px 0; font-size: 16px; font-weight: 700; color: #111827; line-height: 1.25;">
          <?= $signatureData['name'] ?>
        </p>
        <!-- Poste -->
        <?php if (!empty($signatureData['job'])): ?>
        <p style="margin: 0 0 10px 0; font-size: 11px; font-weight: 600; color: #8a4dfd; text-transform: uppercase; letter-spacing: 0.6px;">
          <?= $signatureData['job'] ?>
        </p>
        <?php else: ?>
        <div style="height: 10px;"></div>
        <?php endif; ?>

        <!-- Coordonnées -->
        <table cellpadding="0" cellspacing="0" border="0" style="font-size: 12px; color: #6b7280; border-collapse: collapse;">
          <?php if (!empty($signatureData['phone'])): ?>
          <tr>
            <td style="padding: 0 10px 3px 0; white-space: nowrap; color: #9ca3af; font-size: 11px;">&#128222;&nbsp;Tél.</td>
            <td style="padding: 0 0 3px 0;">
              <a href="tel:<?= htmlspecialchars(preg_replace('/\s+/', '', $signatureData['phone'])) ?>"
                 style="color: #374151; text-decoration: none; font-size: 12px;">
                <?= $signatureData['phone'] ?>
              </a>
            </td>
          </tr>
          <?php endif; ?>
          <tr>
            <td style="padding: 0 10px 3px 0; white-space: nowrap; color: #9ca3af; font-size: 11px;">&#9993;&nbsp;Email</td>
            <td style="padding: 0 0 3px 0;">
              <a href="mailto:<?= $signatureData['email'] ?>"
                 style="color: #374151; text-decoration: none; font-size: 12px;">
                <?= $signatureData['email'] ?>
              </a>
            </td>
          </tr>
          <tr>
            <td style="padding: 0 10px <?= !empty($signatureData['linkedin']) ? '3' : '0' ?>px 0; white-space: nowrap; color: #9ca3af; font-size: 11px;">&#127760;&nbsp;Site</td>
            <td style="padding: 0 0 <?= !empty($signatureData['linkedin']) ? '3' : '0' ?>px 0;">
              <a href="<?= htmlspecialchars($company['website']) ?>"
                 style="color: #8a4dfd; text-decoration: none; font-weight: 600; font-size: 12px;">
                <?= htmlspecialchars($company['domain']) ?>
              </a>
            </td>
          </tr>
          <?php if (!empty($signatureData['linkedin'])): ?>
          <tr>
            <td style="padding: 0 10px 0 0; white-space: nowrap; color: #9ca3af; font-size: 11px; vertical-align: middle;">
              <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/linkedin.svg"
                   alt="LinkedIn" width="11" height="11"
                   style="vertical-align: middle; filter: invert(60%); display: inline;">&nbsp;LinkedIn
            </td>
            <td style="padding: 0;">
              <a href="<?= $signatureData['linkedin'] ?>"
                 style="color: #0077b5; text-decoration: none; font-weight: 500; font-size: 12px;">
                Profil LinkedIn
              </a>
            </td>
          </tr>
          <?php endif; ?>
        </table>
      </td>
    </tr>
  </tbody>
</table>
