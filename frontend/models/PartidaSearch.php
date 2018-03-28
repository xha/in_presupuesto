<?php

namespace frontend\Models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\Models\Partida;

/**
 * PartidaSearch represents the model behind the search form of `frontend\Models\Partida`.
 */
class PartidaSearch extends Partida
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_partida', 'partida', 'generica', 'especifica', 'subEspecifica', 'denominacion', 'descripcion'], 'safe'],
            [['activo', 'movimiento'], 'integer'],
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
        $query = Partida::find();

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
            'activo' => $this->activo,
            'movimiento' => $this->movimiento,
        ]);

        $query->andFilterWhere(['like', 'id_partida', $this->id_partida])
            ->andFilterWhere(['like', 'partida', $this->partida])
            ->andFilterWhere(['like', 'generica', $this->generica])
            ->andFilterWhere(['like', 'especifica', $this->especifica])
            ->andFilterWhere(['like', 'subEspecifica', $this->subEspecifica])
            ->andFilterWhere(['like', 'denominacion', $this->denominacion])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
