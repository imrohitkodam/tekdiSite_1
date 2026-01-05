<?php
defined('_JEXEC') or die;

// Find the subform field dynamically by type 'subform'
$subformField = null;

if (!empty($item->jcfields) && is_array($item->jcfields)) {
    foreach ($item->jcfields as $field) {
        if ($field->type === 'subform') {
            $subformField = $field;
            break;
        }
    }
}

if ($subformField && !empty($subformField->subform_rows)):
?>

    <div class="stories-outcomes-section">
        <div class="container1">
            <div class="row ">
                <?php foreach ($subformField->subform_rows as $row): 
                    $title = isset($row['stories-outcomes-title']->value) ? $row['stories-outcomes-title']->value : '';
                    $description = isset($row['stories-outcomes-description']->value) ? $row['stories-outcomes-description']->value : '';
                ?>
                    <?php if ($title || $description): ?>
                        <div class="col-md-6 col-lg-3">
                            <div class="stories-card shadow-sm border-0">
                                <div class="stories-outcomes-body ">
                                    <?php if ($title): ?>
                                        <h5 class="stories-outcomes-title card-title"><?php echo htmlspecialchars($title); ?></h5>
                                    <?php endif; ?>
                                    <?php if ($description): ?>
                                        <p class="stories-outcomes-text card-text"><?php echo htmlspecialchars($description); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <p>No Stories Outcomes found.</p>
<?php endif; ?>
