<?php

namespace frontend\Models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\Models\Transaccion;

/**
 * TransaccionSearch represents the model behind the search form of `frontend\Models\Transaccion`.
 */
class TransaccionSearch extends Transaccion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaccion', 'id_transaccionO', 'id_usuario', 'activo'], 'integer'],
            [['nro_control', 'nro_factura', 'nro_orden', 'fecha', 'fecha_transaccion', 'CodProv', 'DescripProv', 'id_autorizado', 'nombre_autorizado', 'concepto', 'tipo'], 'safe'],
            [['total', 'descuento'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Transaccion::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_transaccion' => $this->id_transaccion,
            'id_transaccionO' => $this->id_transaccionO,
            'fecha' => $this->fecha,
            'fecha_transaccion' => $this->fecha_transaccion,
            'total' => $this->total,
            'descuento' => $this->descuento,
            'id_usuario' => $this->id_usuario,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'nro_control', $this->nro_control])
            ->andFilterWhere(['like', 'nro_factura', $this->nro_factura])
            ->andFilterWhere(['like', 'nro_orden', $this->nro_orden])
            ->andFilterWhere(['like', 'CodProv', $this->CodProv])
            ->andFilterWhere(['like', 'DescripProv', $this->DescripProv])
            ->andFilterWhere(['like', 'id_autorizado', $this->id_autorizado])
            ->andFilterWhere(['like', 'nombre_autorizado', $this->nombre_autorizado])
            ->andFilterWhere(['like', 'concepto', $this->concepto])
            ->andFilterWhere(['like', 'tipo', $this->tipo]);

        return $dataProvider;
    }
}
