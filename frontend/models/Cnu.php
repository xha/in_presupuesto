<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISPR_CNU".
 *
 * @property int $id_cnu
 * @property int $id_unidad
 * @property int $id_clasificacion
 * @property string $id_partida
 * @property string $CodItem
 * @property int $EsServicio
 * @property string $cuentaC
 */
class Cnu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISPR_CNU';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_unidad', 'id_partida', 'CodItem', 'cuentaC'], 'required'],
            [['EsServicio'], 'integer'],
            [['id_partida', 'CodItem', 'cuentaC', 'id_unidad', 'id_clasificacion'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cnu' => 'Id Cnu',
            'id_unidad' => 'Unidad',
            'id_clasificacion' => 'Clasificacion',
            'id_partida' => 'Partida',
            'CodItem' => 'Producto',
            'EsServicio' => 'Es Servicio',
            'cuentaC' => 'Cuenta C',
        ];
    }
}
