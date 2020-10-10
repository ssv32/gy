<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

class ContainerData
{            
    public static $tableContainerData = 'container_data';
    public static $tableListPropertysContainerData = 'list_propertys_container_data';
    public static $tableTypesPropertyContainerData = 'types_property_container_data'; 
    public static $tableElementContainerData = 'element_container_data';
    public static $tableValuePropertysTypeHtml = 'value_propertys_type_html';
    public static $tableValuePropertysTypeNumber = 'value_propertys_type_number';

    public static $propertyTapleProperty = array(
        'id_type_property',
        'id_container_data',
        'code',
        'name'
    );

    /**
     * getContainerData - получить по фильтру ContainerData
     * @param type $arFilter
     * @param type $arProperty
     * @return array
     */
    public static function getContainerData($arFilter, $arProperty)
    {
        $result = array();
        global $DB;
        $res = $DB->selectDb(
            self::$tableContainerData,
            $arProperty,
            $arFilter
        );

        $result = $DB->fetchAll($res, false);

        return $result;
    }

    /**
     * addContainerData - добавить ContainerData
     * @return boolean
     */
    public static function addContainerData($arParams)
    {
        $result = false;

        // id, login, name, pass, groups
        global $DB;
        $res = $DB->insertDb(self::$tableContainerData, $arParams);

        if ($res) {
            $result = true;
        }

        return $result;
    }

    /**
     * deleteContainerData - удалить ContainerData
     * @global type $DB
     * @param type $arParams
     * @return boolean
     */
    public static function deleteContainerData($id)
    {
        $result = false;

        // id, login, name, pass, groups
        global $DB;
        $res = $DB->deleteDb(self::$tableContainerData, array('=' => array('id', $id)));

        if ($res) {

            //нужно удалить все элементы связанные с ним свойства и значения свойств

            $DB->deleteDb( // удалить значения свойств свойств html
                self::$tableValuePropertysTypeHtml,
                array('=' => array('id_container_data', $id) )
            );
            $DB->deleteDb( // удалить значения свойств свойств number
                self::$tableValuePropertysTypeNumber, 
                array('=' => array('id_container_data', $id) )
            );

            $DB->deleteDb( // удалить элементы container-data
                self::$tableElementContainerData,
                array('=' => array('id_container_data', $id) )
            );

            $DB->deleteDb( // удалить свойства container-data
                self::$tableListPropertysContainerData,
                array('=' => array('id_container_data', $id) )
            );

            $result = true;
        }

        return $result;
    }

    /**
     * deleteContainerData - удалить ContainerData
     * @global type $DB
     * @param type $arParams
     * @return boolean
     */
    public static function updateContainerData($arParams, $where)
    {
        $result = false;

        global $DB;
        $res = $DB->updateDb(self::$tableContainerData, $arParams, $where);

        if ($res) {
            $result = true;
        }

        return $result; 
    }

    /**
     * getAllTypePropertysContainerData - получить все типы свойств ContainerData 
     * @return array
     */
    public static function getAllTypePropertysContainerData()
    {

        $result = array();
        global $DB;
        $res = $DB->selectDb(
            self::$tableTypesPropertyContainerData,
            array('*'),
            array()
        );

        $result = $DB->fetchAll($res);

        return $result;
    }

    /**
     * getAllPropertysContainerData - получить свойства ContainerData (! не значения)
     * @return array
     */
    public static function getPropertysContainerData($where)
    {
        $result = array();
        global $DB;
        $res = $DB->selectDb(
            self::$tableListPropertysContainerData,
            array('*'),
            $where
        );

        $result = $DB->fetchAll($res);

        return $result;
    }

    /**
     * addPropertyContainerData - добавить свойство для ContainerData
     * @param type $arParams
     * @return boolean
     */
    public static function addPropertyContainerData($arParams)
    {
        $result = false;

        // id, login, name, pass, groups
        global $DB;
        $res = $DB->insertDb(self::$tableListPropertysContainerData, $arParams);

        if ($res) {
            $result = true;
        }

        return $result;

    }

    /**
     * getValuePropertysContainerData - получить значения свойств указанного элемента ContainerData
     * @param type $idContainerData
     * @param type $idElementContainerData
     * @param type $idProperty
     * @param type $tableName
     * @return array
     */
    public static function getValuePropertysContainerData($idContainerData, $idElementContainerData, $idProperty,  $tableName)
    {
        $result = array();
        global $DB;
        $res = $DB->selectDb(
            $tableName,
            array('*'),
            array(
                'AND' => array(
                    array('=' => array('id_container_data', $idContainerData) ),
                    array('=' => array('id_element_container_data', $idElementContainerData) ),
                    array('=' => array('id_property_container_data', $idProperty) ) 
                )
            )
        );

        if ($arRes = $DB->fetch($res)) {
            $result = $arRes;
        }
        return $result;
    }

    /**
     * addValuePropertyContainerData - добавить значения свойства для элемента ContainerData
     * @param int $idContainerData
     * @param int $idElementContainerData
     * @param int $idProperty
     * @param int $tableName
     * @param mixed $value
     * @return boolean
     */
    public static function addValuePropertyContainerData($idContainerData, $idElementContainerData, $idProperty,  $tableName, $value)
    {
        $result = false;
        global $DB;
        $res = $DB->insertDb(
            $tableName, 
            array(
                'id_container_data' => $idContainerData,
                'id_element_container_data' => $idElementContainerData,
                'id_property_container_data' => $idProperty,
                'value' => $value
            )
        );
        if ($res) {
            $result = true;
        }
        return $result;
    }

    /**
     * updateValuePropertyContainerData - обновить значение свойства элемента container-data
     * @global type $DB
     * @param type $tableName
     * @param type $id
     * @param type $value
     * @return boolean
     */
    public static function updateValuePropertyContainerData($tableName, $id, $value)
    {
        $result = false;
        global $DB;

        $res = $DB->updateDb(
            $tableName, 
            array('value' => $value), 
            array(
                '=' => array('id', $id)
            )
        );

        if ($res) {
            $result = true;
        }
        return $result;
    }

    /**
     * getAllElementContainerData - получить все элементы ContainerData
     * @param int $idContainerData
     * @return array
     */
    public static function getAllElementContainerData($idContainerData)
    {

        $result = array();
        global $DB;
        $res = $DB->selectDb(
            self::$tableElementContainerData,
            array('*'),
            array(
                '=' => array('id_container_data', $idContainerData )
            )
        );

        $result = $DB->fetchAll($res, false);
        
        return $result;
    }

    /**
     * getElementContainerData - получить элемент ContainerData
     * @param int $idContainerData
     * @return array
     */
    public static function getElementContainerData($where){

        $result = array();
        global $DB;
        $res = $DB->selectDb(
            self::$tableElementContainerData,
            array('*'),
            $where
        );

        $result = $DB->fetch($res, false);

        return $result;
    }

    /**
     * addElementContainerData - добавить элемент ContainerData
     * @param type $arParams
     * @return boolean
     */
    public static function addElementContainerData($arParams)
    {
        $result = false;

        // id, login, name, pass, groups
        global $DB;
        $res = $DB->insertDb(self::$tableElementContainerData, $arParams);

        if ($res) {
            $result = true;
        }

        return $result;
    }

    /**
     * deleteElementContainerData - удалить элемент ContainerData
     * @param type $arParams
     * @return boolean
     */
    public static function deleteElementContainerData($id)
    {
        $result = false;

        global $DB;
        $res = $DB->deleteDb(self::$tableElementContainerData, array('=' => array('id', $id)));

        if ($res) {
            // надо удалить все свойства этого элемента
            $DB->deleteDb( // удалить всё для свойств html
                self::$tableValuePropertysTypeHtml, 
                array('=' => array('id_element_container_data', $id) )  
            );
            $DB->deleteDb( // удалить всё для свойств number
                self::$tableValuePropertysTypeNumber, 
                array('=' => array('id_element_container_data', $id) )  
            );


            $result = true;
        }

        return $result;
    }

    /**
     * updateElementContainerData - изменить элемент ContainerData
     * @param type $arParams
     * @return boolean
     */
    public static function updateElementContainerData($arParams, $where)
    {
        $result = false;

        // id, login, name, pass, groups
        global $DB;
        $res = $DB->updateDb(self::$tableElementContainerData, $arParams, $where);

        if ($res) {
            $result = true;
        }

        return $result;
    }

    /** //TODO протестировать за комментировать
     * deletePropertyContainerData - удалить свойства контент блока
     * @param int $idProperty - id свойства container-data
     * @param int $containerData
     * @return boolean
     */
    public static function deletePropertyContainerData($idProperty, $containerData)
    {
        //---надо взять все имеющиеся для этого свойства значения у элементов и удалить тоже
        global $DB;

        // взять все типы контент блоков что бы знать в каких таблицах искать значения
        $dataTypeProperty = ContainerData::getAllTypePropertysContainerData();

        // найти все свойства container-data      
        $propertyContainerData = ContainerData::getPropertysContainerData(
            array(
                '='=>array(
                    'id_container_data',
                    $containerData
                )
            )
        );

        $tableName = $dataTypeProperty[$propertyContainerData[$idProperty]['id_type_property']]['name_table'];

        // удалить для всех элементов значения свойства           
        $DB->deleteDb($tableName, array('=' => array('id_property_container_data', $idProperty) )  );

        // удалить само свойство container-data
        $DB->deleteDb(static::$tableListPropertysContainerData, array('=' => array('id', $idProperty) )  );

        ////---
        return true; // TODO доделать что бы был ещё false
    }

}
