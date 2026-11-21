<div class="practice-slider" data-practice-slider>
    <div id="<?= esc($sliderId) ?>" class="practice-track" role="group" tabindex="0" aria-label="<?= esc($labels['practice']) ?>">
        <?php foreach ($practiceAreas as $area): ?>
            <?php $translation = $area[$language]; ?>
            <a class="practice-card" href="<?= esc($translation['path']) ?>">
                <h3><?= esc($translation['title']) ?></h3>
                <?php if (!$compactSlider): ?>
                    <p><?= esc($translation['description']) ?></p>
                <?php endif; ?>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="practice-navigation" hidden>
        <button type="button" data-practice-step="-1" aria-controls="<?= esc($sliderId) ?>" aria-label="<?= esc($labels['previousPractice']) ?>"><span class="practice-chevron" aria-hidden="true"></span></button>
        <span class="practice-position" aria-live="polite"></span>
        <button type="button" data-practice-step="1" aria-controls="<?= esc($sliderId) ?>" aria-label="<?= esc($labels['nextPractice']) ?>"><span class="practice-chevron" aria-hidden="true"></span></button>
    </div>
</div>
