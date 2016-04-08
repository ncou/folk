<?php $this->layout('html', ['title' => "{$entity->title} - New | {$app->title}"]); ?>

<?php $this->insert('nav', ['entity' => $entity]) ?>

<div class="page page-form">
	<div class="page-content">
		<?php
        echo $form->action($app->getRoute('create', ['entity' => $entity->getName()]))->openHtml();

        $form['data']->addClass('page-form-content');
        echo $form->html();
        ?>

		<div class="footer-primary">
			<button type="submit" class="button button-call">Create</button>
		</div>

        <input type="hidden" name="method-override" value="put">

		<?= $form->closeHtml(); ?>
	</div>
</div>