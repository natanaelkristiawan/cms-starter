<?php

namespace Master\Core\Repositories\Criteria;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;

class RequestCriteria implements CriteriaInterface
{
  public function apply($model, RepositoryInterface $repository)
  {
    $fieldsSearchable = $repository->getFieldsSearchable();

    $search     = request()->search;
    $columns    = request()->columns;
    $order      = request()->order;

    

    if ($search && is_array($fieldsSearchable) && count($fieldsSearchable)) {
      $fields = $this->parserFieldsSearch($fieldsSearchable);
      $searchData = $this->parserSearchData($search);


      $search = $this->parserSearchValue($search);

      
      if ($search != '') {

        $model = $model->where(function ($query) use ($fields, $search) {
          $isFirstField = true;

          foreach ($fields as $field => $condition) {
            if ($condition != 'like') {
              continue;
            }

            $value = "%{$search}%";

            if ($isFirstField && !is_null($value)) {
         	   $query->where($field, 'like', $value);
         	   $isFirstField = false;
            } elseif (!is_null($value)) {
              $query->orWhere($field, 'like', $value);
            }
          }
        });
      }


      if (is_array($searchData) && count($searchData)) {
        $model = $model->where(function ($query) use ($fields, $searchData) {
          $mergBetween = function ($array, $default) {
            $array = array_values($array);
            $default = array_values($default);

            return $array + $default;
          };




          foreach ($fields as $field => $condition) {
            $default = null;

            if (is_numeric($field)) {
                $field = $condition;
                $condition = '=';
            } elseif (is_array($condition)) {
                $default = $condition['default'];
                $condition = $condition['condition'];
            }

            $value = null;

            $condition = trim(strtolower($condition));

            if (isset($searchData[$field])) {
              // khusus status
              if ($field == 'status') {
                if ( strtolower($searchData['status']) === 'all') {
                  continue;
                }
              }

              $value = $searchData[$field];

              if (in_array($condition, ['=', '>', '>=', '<', '<=', '!=', '<>'])) {
               	$query->where($field, $condition, $value);
              } elseif ($condition == 'like') {
               	$query->where($field, $condition, "%{$value}%");
              } elseif ($condition == 'not like') {
               	$query->where($field, $condition, $value);
              } elseif ($condition == 'between' && is_array($value) && !empty($value[0]) && !empty($value[1])) {
                $query->whereBetween($field, $mergBetween($value, $default));
              } elseif ($condition == 'not between' && is_array($value) && !empty($value[0]) && !empty($value[1])) {
                $query->whereNotBetween($field, $mergBetween($value, $default));
              } elseif ($condition == 'in' && is_array($value)) {
                $query->whereIn($field, $value);
              } elseif ($condition == 'not in' && is_array($value)) {
                $query->whereNotIn($field, $value);
              } elseif ($condition == 'null') {
                $query->whereNull($field);
              } elseif ($condition == 'not null') {
                $query->whereNotNull($field);
              }
            }
          }
        });
      }
    }


    $sortBy = $columns[$order[0]['column']]['data'];
    $sortOrder = $order[0]['dir'];

    if (isset($sortBy) && !empty($sortBy)) {
      $model = $model->orderBy($sortBy, $sortOrder);
    }
    return $model;
  }

  /**
   * @param $search
   *
   * @return array
   */
  protected function parserSearchData($search)
  {
    if (is_array($search)) {
      foreach ($search as $key => $value) {
        if ($key == 'regex') {
          unset($search[$key]);
        }
      }

      return $search;
    }

    $searchData = [];

    if (stripos($search, ':')) {
        $fields = explode(';', $search);

        foreach ($fields as $row) {
            try {
                list($field, $value) = explode(':', $row);
                $searchData[$field] = $value;
            } catch (\Exception $e) {
                //Surround offset error
            }
        }
    }

    return $searchData;
  }

  /**
   * @param $search
   *
   * @return null
   */
  protected function parserSearchValue($search)
  {
    if (is_array($search)) {
      return isset($search['value']) ? $search['value'] : null;
    }

    if (stripos($search, ';') || stripos($search, ':')) {
      $values = explode(';', $search);

      foreach ($values as $value) {
        $s = explode(':', $value);

        if (count($s) == 1) {
          return $s[0];
        }
      }

      return;
    }

    return $search;
  }

  protected function parserFieldsSearch(array $fields = [], array $searchFields = null)
  {
    if (!is_null($searchFields) && count($searchFields)) {
      $acceptedConditions = array('=', '>', '>=', '<', '<=', '!=', '<>', 'like', 'not like', 'between', 'not between', 'in', 'not in', 'null', 'not null');
      $originalFields = $fields;
      $fields = [];

      foreach ($searchFields as $index => $field) {
        $field_parts = explode(':', $field);
        $_index = array_search($field_parts[0], $originalFields);

        if (count($field_parts) == 2) {
          if (in_array($field_parts[1], $acceptedConditions)) {
            unset($originalFields[$_index]);
            $field = $field_parts[0];
            $condition = $field_parts[1];
            $originalFields[$field] = $condition;
            $searchFields[$index] = $field;
        }
        }
      }

      foreach ($originalFields as $field => $condition) {
        if (is_numeric($field)) {
          $field = $condition;
          $condition = '=';
        }

        if (in_array($field, $searchFields)) {
          $fields[$field] = $condition;
        }
      }

      if (count($fields) == 0) {
        throw new \Exception(trans('database::criteria.fields_not_accepted', ['field' => implode(',', $searchFields)]));
      }
    }

    return $fields;
  }
}
