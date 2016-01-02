<?php $this->layout('html'); ?>

<?php $this->insert('nav', ['entity' => $entity, 'search' => $search]); ?>

<article class="page page-list">
	<div class="page-content" data-module="page-loader">
		<?php if ($rows): ?>
		<table class="page-list-table">
			<thead>
				<th></th>
				<?php foreach (reset($rows) as $column): ?>
				<th class="format <?= $column->get('class') ?>">
					<?= $column->label(); ?>
				</th>
				<?php endforeach; ?>
			</thead>

			<tbody class="ui-autoload-container">
				<?php foreach ($rows as $id => $row): ?>
				<tr>
					<th>
						<a class="button button-normal" href="<?= $this->url('edit', ['entity' => $entity->name, 'id' => $id]) ?>">
							<?= $id ?>
						</a>
					</th>

					<?php foreach ($row as $td): ?>
					<td>
						<div class="format <?= $td->get('class') ?>">
							<?= $td->valToHtml() ?>
						</div>
					</td>
					<?php endforeach; ?>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<?php if ($search->getPage() !== null): ?>
			<footer class="footer-primary">
				<a href="<?= $this->url('list', ['entity' => $entity->name], [
                        'query' => isset($search) ? $search->getQuery() : null,
                        'page' => $search->getPage() + 1,
                    ]) ?>" class="button button-normal ui-autoload-btn">
					More results
				</a>
			</footer>
		<?php endif; ?>

		<?php else: ?>
		<div class="page-list-noresults">
			<p>No items found</p>
		</div>
		<?php endif; ?>
	</div>
</article>
