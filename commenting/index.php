<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
?>
<?php $APPLICATION->IncludeComponent("mtai:element.detail","", Array(
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => 2,
		"ID" => 19,
	)
);?>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
