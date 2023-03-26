<div id="container">
    <div id="form-container">
        <form class="form opinion-form" method="post">
            <input class="input" type="text" name="name" placeholder="<?=$yourName?>">
            <textarea class="input" name="opinion" placeholder="<?=$opinion?>"></textarea>
            <button class="btn" type="submit"><?=$button?></button>
        </form>
    </div>
    <div class="form" id="opinions-container">
        <?
        foreach ($opinions as $opinion) {
            ?>
            <div class="opinion-item">
                <span class="span-name">Имя: <?=$opinion->name?></span><br>
                <span class="span-message">Отзыв: <?=$opinion->message?></span><br>
                <span class="span-date">Дата: <?=date_format(date_create($opinion->date), 'd-m-Y H:i')?></span><br><br>
            </div>
        <? } ?>
    </div>
</div>
