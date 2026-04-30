<?php
/** @var array $recipe */
if (!isset($recipe) || !is_array($recipe)) {
    // если кто-то открыл шаблон напрямую — не падаем
    exit('Нет данных рецепта ($recipe). Откройте edit.php?id=...');
}
?>

<div class="card">
    <h2>Редактировать рецепт</h2>

    <form action="/update.php" method="POST">
        <input type="hidden" name="id" value="<?= (int)$recipe['id'] ?>">

        <div class="row">
            <div class="field">
                <label>Название *</label>
                <input type="text" name="title" required value="<?= htmlspecialchars((string)$recipe['title']) ?>">
            </div>
            <div class="field">
                <label>Категория (ID)</label>
                <input type="number" name="category_id" value="<?= htmlspecialchars((string)($recipe['category_id'] ?? '')) ?>">
            </div>
        </div>

        <div class="field">
            <label>Ингредиенты *</label>
            <textarea name="ingredients" required><?= htmlspecialchars((string)$recipe['ingredients']) ?></textarea>
        </div>

        <div class="field">
            <label>Инструкция *</label>
            <textarea name="instructions" required><?= htmlspecialchars((string)$recipe['instructions']) ?></textarea>
        </div>

        <div class="row">
            <div class="field">
                <label>Сложность</label>
                <input type="text" name="difficulty" value="<?= htmlspecialchars((string)($recipe['difficulty'] ?? '')) ?>">
            </div>
            <div class="field">
                <label>Время (мин)</label>
                <input type="number" name="prep_time" min="0" value="<?= htmlspecialchars((string)($recipe['prep_time'] ?? '')) ?>">
            </div>
        </div>

        <div class="row">
            <div class="field">
                <label>Дата *</label>
                <input type="date" name="created_at" required value="<?= htmlspecialchars((string)$recipe['created_at']) ?>">
            </div>
            <div class="field">
                <label>Автор</label>
                <input type="text" name="author" value="<?= htmlspecialchars((string)($recipe['author'] ?? '')) ?>">
            </div>
        </div>

        <div class="actions">
            <button class="btn btn-primary" type="submit">Сохранить</button>
            <a class="btn btn-ghost" href="/index.php">Назад</a>
        </div>
    </form>
</div>

</div>
</body>
</html>