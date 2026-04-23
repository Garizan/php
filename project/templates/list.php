<div class="card">
    <div class="top-links">
        <span class="badge">PHP templates</span>
    </div>

    <h2>Список рецептов</h2>

    <div class="sort">
        <a href="?sort=title">Сортировка: Название</a>
        <a href="?sort=category">Сортировка: Категория</a>
        <a href="?sort=created_at">Сортировка: Дата</a>
    </div>

    <table>
        <tr>
            <th>Название</th>
            <th>Категория</th>
            <th>Сложность</th>
            <th>Дата</th>
            <th>Автор</th>
            <th>Время (мин)</th>
        </tr>

        <?php if (!empty($data)): ?>
            <?php foreach ($data as $recipe): ?>
                <tr>
                    <td><?= htmlspecialchars($recipe['title'] ?? '') ?></td>
                    <td><?= htmlspecialchars($recipe['category'] ?? '') ?></td>
                    <td><?= htmlspecialchars($recipe['difficulty'] ?? '') ?></td>
                    <td><?= htmlspecialchars($recipe['created_at'] ?? '') ?></td>
                    <td><?= htmlspecialchars($recipe['author'] ?? '') ?></td>
                    <td><?= htmlspecialchars($recipe['prep_time'] ?? '') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">Пока нет рецептов</td></tr>
        <?php endif; ?>
    </table>
</div>