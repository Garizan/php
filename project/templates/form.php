<div class="card">
    <h2>Добавить рецепт</h2>
    <p class="subtitle">Заполни форму и нажми «Сохранить»</p>

    <form action="/src/save.php" method="POST">
        <div class="row">
            <div class="field">
                <label>Название *</label>
                <input type="text" name="title" required>
            </div>
            <div class="field">
                <label>Категория</label>
                <input type="text" name="category" placeholder="Суп, Десерт, Салат...">
            </div>
        </div>

        <div class="field">
            <label>Ингредиенты *</label>
            <textarea name="ingredients" required></textarea>
        </div>

        <div class="field">
            <label>Инструкция *</label>
            <textarea name="instructions" required></textarea>
        </div>

        <div class="row">
            <div class="field">
                <label>Сложность</label>
                <input type="text" name="difficulty" placeholder="Легко / Средне / Сложно">
            </div>
            <div class="field">
                <label>Время (мин)</label>
                <input type="number" name="prep_time" min="0" placeholder="30">
            </div>
        </div>

        <div class="row">
            <div class="field">
                <label>Дата *</label>
                <input type="date" name="created_at" required>
            </div>
            <div class="field">
                <label>Автор</label>
                <input type="text" name="author" placeholder="Твоё имя">
            </div>
        </div>

        <div class="actions">
            <button class="btn btn-primary" type="submit">Сохранить</button>
            <a class="btn btn-ghost" href="/index_twig.php">Открыть Twig-версию</a>
        </div>
    </form>
</div>