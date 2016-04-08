<?php $this->layout('html', ['title' => "{$entity->title} | {$app->title}"]); ?>

<?php $this->insert('nav', ['entity' => $entity, 'search' => $search]); ?>

<?php $sort = $search->getSort() ?>

<article class="page page-list">
	<div class="page-content" data-module="page-loader">

		<?php if ($rows): ?>
		<table class="page-list-table">
			<thead>
				<th></th>
				<?php foreach (reset($rows) as $name => $column): ?>
				<th class="format <?= $column->get('class').($sort === $name ? ' is-sorted' : '') ?>">
					<a href="<?= $app->getRoute('search', ['entity' => $entity->getName()], [
                        'query' => isset($search) ? $search->getQuery() : null,
                        'sort' => $name,
                        'direction' => ($sort === $name) ? ($search->getDirection() === 'ASC' ? 'DESC' : 'ASC') : 'ASC',
                    ]) ?>">
						<?= $column->label(); ?>
					</a>
				</th>
				<?php endforeach; ?>
			</thead>

			<tbody class="ui-autoload-container">
				<?php foreach ($rows as $id => $row): ?>
				<tr>
					<th>
						<a class="button button-call" href="<?= $app->getRoute('read', ['entity' => $entity->getName(), 'id' => $id]) ?>">
							<?= $id ?>
						</a>
					</th>

					<?php foreach ($row as $name => $td): ?>
					<td<?= $sort === $name ? ' class="is-sorted"' : '' ?>>
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
			<a href="<?= $app->getRoute('search', ['entity' => $entity->getName()], [
                    'query' => isset($search) ? $search->getQuery() : null,
                    'page' => (isset($search) ? $search->getPage() : 0) + 1,
                ]) ?>" class="button button-call ui-autoload-btn">
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