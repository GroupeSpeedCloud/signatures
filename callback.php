<?php
/**
 * Fichier de compatibilité - redirige vers le routeur
 * Ce fichier sera supprimé dans une future version
 */
header('Location: /callback?' . http_build_query($_GET));
exit;
