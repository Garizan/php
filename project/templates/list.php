<div class="card">
    <div class="top-links">
        <span class="badge">PHP templates</span>
    </div>

    <h2>Список рецептов</h2>

    <div class="sort">
        <a href="?sort=title">Название</a>
        <a href="?sort=created_at">Дата</a>
    </div>

    <table>
        <tr>
            <th>Название</th>
            <th>Категория</th>
            <th>Сложность</th>
            <th>Дата</th>
            <th>Автор</th>
            <th>Время</th>
            <th>Действия</th>
        </tr>

        <?php if (!empty($data)): ?>
            <?php foreach ($data as $recipe): ?>
                <tr>
                    <td><?= htmlspecialchars($recipe['title']) ?></td>
                    <td><?= htmlspecialchars($recipe['category'] ?? '') ?></td>
                    <td><?= htmlspecialchars($recipe['difficulty']) ?></td>
                    <td><?= htmlspecialchars($recipe['created_at']) ?></td>
                    <td><?= htmlspecialchars($recipe['author']) ?></td>
                    <td><?= htmlspecialchars((string)($recipe['prep_time'] ?? '')) ?></td>

                    <td>
                        <a href="/edit.php?id=<?= (int)$recipe['id'] ?>">Редактировать</a>

                        <form method="POST" action="/delete.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= (int)$recipe['id'] ?>">
                            <button type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7">Пока нет рецептов</td></tr>
        <?php endif; ?>
    </table>
</div>

</div>
</body>
</html>