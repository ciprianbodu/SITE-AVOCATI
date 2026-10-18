<?php
$brandHref = $brandHref ?? '/';
$brandClass = $brandClass ?? '';
$brandVariant = $brandVariant ?? '';
?>
<a href="<?= htmlspecialchars($brandHref) ?>" class="brand-logo <?= htmlspecialchars(trim($brandClass . ' ' . $brandVariant)) ?>" aria-label="MITESCU LEGAL">
    <img src="logo.svg" alt="MITESCU LEGAL" width="260" height="52" class="brand-logo__img" decoding="async">
</a>
