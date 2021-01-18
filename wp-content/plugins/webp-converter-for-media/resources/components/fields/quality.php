<?php if ($option['info']) : ?>
  <p><?= wp_kses_post($option['info']); ?></p>
<?php endif; ?>
<div class="webpPage__quality">
  <?php
    foreach ($option['values'] as $value => $label) :
      $isChecked = (isset($values[$option['name']]) && ($value == $values[$option['name']]));
  ?>
    <div class="webpPage__qualityItem">
      <input type="radio"
        name="<?= esc_attr($option['name']); ?>"
        value="<?= esc_attr($value); ?>"
        id="webpc-<?= esc_attr($index); ?>-<?= esc_attr($value); ?>"
        class="webpPage__qualityItemInput"
        <?= $isChecked ? 'checked' : ''; ?>
        <?= (in_array($value, $option['disabled'])) ? 'disabled' : ''; ?>>
      <label for="webpc-<?= esc_attr($index); ?>-<?= esc_attr($value); ?>"
        class="webpPage__qualityItemLabel">
        <?= wp_kses_post($label); ?>
      </label>
    </div>
  <?php endforeach; ?>
</div>