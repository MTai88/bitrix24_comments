<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

\Bitrix\Main\UI\Extension::load("ui.bootstrap4");

?>
    <div class="media">
        <div class="media-body">
            <?php if (!empty($arResult['DETAIL_PICTURE'])): ?>
                <div class="img-post">
                    <img class="d-block img-fluid" src="<?= $arResult['DETAIL_PICTURE'] ?>"
                         alt="<?= $arResult['NAME'] ?>">
                </div>
            <?php endif; ?>
            <h3 class="mt-3"><?= $arResult['NAME'] ?></h3>
            <span class="badge bg-primary text-white"><?= $arResult['DATES'] ?></span>
            <p><?= $arResult['DETAIL_TEXT'] ?></p>
        </div>
    </div>

    <h3 class="mb-3">Comments</h3>

    <?php if (!empty($arResult['ID'])): ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.comments",
            "stream",
            array(
                "BLOG_TITLE" => "Комментарии инфоблоков",
                "BLOG_URL" => "iblock_comments",
                "BLOG_USE" => "Y",
                "CACHE_TIME" => "0",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "COMMENTS_COUNT" => "5",
                "ELEMENT_CODE" => "",
                "ELEMENT_ID" => $arResult['ID'],
                "EMAIL_NOTIFY" => "N",
                "FB_USE" => "N",
                "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
                "PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
                "RATING_TYPE" => "",
                "SHOW_DEACTIVATED" => "N",
                "SHOW_RATING" => "Y",
                "SHOW_SPAM" => "Y",
                "TEMPLATE_THEME" => "blue",
                "URL_TO_COMMENT" => "",
                "VK_USE" => "N",
                "WIDTH" => ""
            )
        ); ?>
    <?php endif; ?>
