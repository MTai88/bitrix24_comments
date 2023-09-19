### Using Bitrix24 livefeed commenting in your custom iblock components
### How to use:
#### 1. Copy template `/local/templates/.default/components/bitrix/catalog.comments` to your local directory
#### 2. Add a component `bitrix:catalog.comments` call in your template with `stream` template in parameter
```
<? $APPLICATION->IncludeComponent(
    "bitrix:catalog.comments",
    "stream",
    array(
        "BLOG_TITLE" => "Iblock comments",
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
```
#### 3. Enter the parameters `ELEMENT_ID`, `IBLOCK_ID`, `IBLOCK_TYPE` in component call with your iblock data

### Notes:
#### Example of usage on page `/commenting/` and component `/local/components/mtai/element.detail`