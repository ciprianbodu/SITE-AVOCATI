<?php
$brandHref = $brandHref ?? '/';
$brandClass = $brandClass ?? '';
$brandVariant = $brandVariant ?? '';
?>
<a href="<?= htmlspecialchars($brandHref) ?>" class="brand-logo <?= htmlspecialchars(trim($brandClass . ' ' . $brandVariant)) ?>" aria-label="MITESCU LEGAL">
    <?php if ($brandVariant === 'brand-logo--footer'): ?>
        <img src="/logo.svg" alt="" width="260" height="52" class="brand-logo__img" decoding="async">
    <?php else: ?>
        <?php include __DIR__ . '/../logo.svg'; ?>
    <?php endif; ?>
</a>
