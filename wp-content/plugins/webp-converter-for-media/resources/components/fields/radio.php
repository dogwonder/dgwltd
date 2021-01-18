<?php if ($option['info']) : ?>
  <p><?= wp_kses_post($option['info']); ?></p>
<?php endif; ?>
<table class="webpTable">
  <?php
    foreach ($option['values'] as $value => $label) :
      $isChecked = (isset($values[$option['name']]) && ($value === $values[$option['name']]));
  ?>
    <tr>
      <td>
        <input type="radio"
          name="<?= esc_attr($option['name']); ?>"
          value="<?= esc_attr($value); ?>"
          id="webpc-<?= esc_attr($index); ?>-<?= esc_attr($value); ?>"
          class="webpCheckbox__input"
          <?= $isChecked ? 'checked' : ''; ?>
          <?= (in_array($value, $option['disabled'])) ? 'disabled' : ''; ?>>
        <label for="webpc-<?= esc_attr($index); ?>-<?= esc_attr($value); ?>"></label>
      </td>
      <td>
        <label for="webpc-<?= esc_attr($index); ?>-<?= esc_attr($value); ?>"
          class="webpCheckbox__label">
          <?= wp_kses_post($label); ?>
        </label>
      </td>
    </tr>
  <?php endforeach; ?>
</table>