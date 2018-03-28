<?php

namespace frontend\Models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\Models\Upa;

/**
 * UpaSearch represents the model behind the search form of `frontend\Models\Upa`.
 */
class UpaSearch extends Upa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_upa', 'id_clasificacion', 'id_unidad', 'asignacion'], 'integer'],
            [['id_partida', 'denominacion_partida', 'descripcion_clasificacion', 'fecha', 'partida_origen', 'tipo_operacion'], 'safe'],
            [['monto'], 'number'],
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
        $query = Upa::find();

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
            'id_upa' => $this->id_upa,
            'id_clasificacion' => $this->id_clasificacion,
            'id_unidad' => $this->id_unidad,
            'monto' => $this->monto,
            'fecha' => $this->fecha,
            'asignacion' => $this->asignacion,
        ]);

        $query->andFilterWhere(['like', 'id_partida', $this->id_partida])
            ->andFilterWhere(['like', 'denominacion_partida', $this->denominacion_partida])
            ->andFilterWhere(['like', 'descripcion_clasificacion', $this->descripcion_clasificacion])
            ->andFilterWhere(['like', 'partida_origen', $this->partida_origen])
            ->andFilterWhere(['like', 'tipo_operacion', $this->tipo_operacion]);

        return $dataProvider;
    }
}
