<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "SADEPO".
 *
 * @property string $CodUbic
 * @property string $Descrip
 * @property string $Clase
 * @property int $Activo
 * @property string $Represent
 * @property string $Direc1
 * @property string $Direc2
 * @property string $ZipCode
 * @property string $Telef
 * @property int $Printer
 */
class Ubicacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SADEPO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodUbic'], 'required'],
            [['CodUbic', 'Descrip', 'Clase', 'Represent', 'Direc1', 'Direc2', 'ZipCode', 'Telef'], 'string'],
            [['Activo', 'Printer'], 'integer'],
            [['CodUbic'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodUbic' => 'Código',
            'Descrip' => 'Descripción',
            'Clase' => 'Clase',
            'Activo' => 'Activo',
            'Represent' => 'Representante',
            'Direc1' => 'Dirección 1',
            'Direc2' => 'Dirección2',
            'ZipCode' => 'Zip Code',
            'Telef' => 'Teléfono',
            'Printer' => 'Printer',
        ];
    }
}
