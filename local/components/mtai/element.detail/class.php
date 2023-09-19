<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock;

class ElementDetail extends CBitrixComponent
{

    public function __construct($component = null)
    {
        parent::__construct($component);

        Loader::includeModule("iblock");
    }

    /**
     * @throws Exception
     */
    public function onPrepareComponentParams($arParams): array
    {
        if (empty($arParams['ID']))
            throw new Exception(Loc::getMessage('ELEMENT_DETAIL_ID_PARAMETER'));

        if (empty($arParams['IBLOCK_ID']))
            throw new Exception(Loc::getMessage('ELEMENT_IBLOCK_ID_PARAMETER'));

        if (empty($arParams['IBLOCK_TYPE']))
            $arParams['IBLOCK_TYPE'] = 'content';

        return $arParams;
    }

    public function executeComponent()
    {
        global $APPLICATION;

        $filter = [
            "IBLOCK_TYPE" => $this->arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
            "ACTIVE" => "Y",
            "CHECK_PERMISSIONS" => "Y",
            "MIN_PERMISSION" => 'R',
            "ID" => $this->arParams["ID"]
        ];
        $sort = ["DATE_ACTIVE_FROM" => "asc"];

        $res = CIBlockElement::GetList(
            $sort,
            $filter,
            false,
            [
                'nTopCount' => 1
            ]
        );

        if ($ob = $res->GetNextElement()) {
            $fields = $ob->GetFields();
            $fields["PROPERTIES"] = $ob->GetProperties();

            $fields = $this->getImage($fields);

            $this->arResult = $fields;

            $this->arResult["DATES"] = $this->getDates();
        } else {
            Iblock\Component\Tools::process404(
                Loc::getMessage('ELEMENT_DETAIL_NOT_FOUND')
                , true
                , "Y"
                , "Y"
            );
        }

        $APPLICATION->SetTitle($this->arResult["NAME"]);

        $this->includeComponentTemplate();
    }

    private function getImage($item): array
    {
        if ($item['DETAIL_PICTURE']) {
            $imageFile = \CFile::GetFileArray($item['DETAIL_PICTURE']);
            if ($imageFile !== false) {
                $item["DETAIL_PICTURE"] = \CFile::GetFileSRC($imageFile);
            } else
                $item["DETAIL_PICTURE"] = false;
        }

        return $item;
    }

    private function getDates(): string
    {
        if (!empty($this->arResult["DATE_ACTIVE_TO"])) {
            return Loc::getMessage('ELEMENT_DETAIL_DATES_PERIOD', [
                "#DATE_FROM#" => FormatDate("j F", strtotime($this->arResult["DATE_ACTIVE_FROM"])),
                "#DATE_TO#" => FormatDate("j F Y", strtotime($this->arResult["DATE_ACTIVE_TO"])),
            ]);
        } else {
            return FormatDate("j F Y", strtotime($this->arResult["DATE_ACTIVE_FROM"]));
        }
    }
}
