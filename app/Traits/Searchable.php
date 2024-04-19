<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Searchable{
    /**
     * Undocumented function
     *
     * @param Builder $builder 
     * @param string $term //the search term
     * @param string $searchable //the column you want search in ; if you want search in relation send it relationName.columnName
     * //if you not send $searchable will search in all column in $searchable variable in model
    
     * must use trait in model

     *if you want use spacefic search mean use where in search 
     *

     * if mixedSearchable request wil be   
     *"mixedSearch":1,
     *"term":{"profile.first_name":"GuestProfileOnlyName","profile.last_name":"OnlyName"}
     *if column has date will be like this "relation.column+date"
     * @return void
     */
    public function scopeSearch(Builder $builder, $term =null, $searchable=null,$mixedSearchable = null, $spaceficSearch = null)

    {
        if($term == null)
        {
            return;
        }

        if($mixedSearchable)
        {
            return $this->MixedSearch($builder,$term,$spaceficSearch);
        }

        // if(str_contains($term,' '))
        // {
        //     if(str_contains($searchable,'.'))
        //         {
        //             $firstTerm = Str::beforeLast($term,' ');
        //             $lastTerm = Str::afterLast($term,' ');
        //             $firstSearchable = Str::beforeLast($searchable,' ');
        //             $lastSearchable = Str::afterLast($searchable,' ');

        //             $firstRelation = Str::beforeLast($firstSearchable, '.');
        //             $firstColumn = Str::afterLast($firstSearchable, '.');
        //             $secondRelation = Str::beforeLast($lastSearchable, '.');
        //             $secondColumn = Str::afterLast($lastSearchable, '.');

        //             $builder->orWhereRelation($firstRelation, $firstColumn, 'like', "%$firstTerm%")
        //             ->whereRelation($secondRelation, $secondColumn, 'like', "%$lastTerm%");
        //             return $builder;
        //         }
        //     $firstTerm = Str::beforeLast($term,' ');
        //     $lastTerm = Str::afterLast($term,' ');
        //     $firstSearchable = Str::beforeLast($searchable,' ');
        //     $lastSearchable = Str::afterLast($searchable,' ');

        //     $builder->orWhere($firstSearchable, 'like', "%$firstTerm%")->where($lastSearchable,  "%$lastTerm%");

        //     return $builder;
        // }
        if($searchable == null) 
        {
            foreach($this->searchable as $searchable)
            {
                if(str_contains($searchable,'.'))
                {
                    $relation = Str::beforeLast($searchable, '.');
                    $column = Str::afterLast($searchable, '.');
                    $builder->orWhereRelation($relation, $column, 'like', "%$term%");
                    continue;
                }
                $builder->orWhere($searchable, 'like', "%$term%");
            }
            return $builder;
        }


        $builder->orWhere($searchable, 'like', "%$term%");
        return $builder;
    }

    public function MixedSearch(Builder $builder,$arraySearchable,$spaceficSearch = null)
    {

        if($spaceficSearch == 1)
        {
            $builder = $this->whereSearch($builder, $arraySearchable);
        }else{
            $builder = $this->OrWhereSearch($builder, $arraySearchable);
        }
        return $builder;
    }

    public function OrWhereSearch($builder,$arraySearchable)
    {
        foreach($arraySearchable as $searchable=>$term)
        {
            if($term == null)
            {
                continue;
            }
            if(str_contains($searchable,'.'))
            {
                $relation = Str::beforeLast($searchable, '.');
                $column = Str::afterLast($searchable, '.');
                $columnCheckHasDate = Str::afterLast($column, '+');
                $columnHasDate = Str::beforeLast($column, '+');
                if($columnCheckHasDate == "date")
                {
                    $builder->orWhere(function($q)use($relation,$term,$columnHasDate){
                        $q->whereHas("$relation",function($qq)use($term,$columnHasDate){
                            $qq->whereDate("$columnHasDate", 'like', "%$term%");
                        });
                    });   
                }
                else{
                    $builder->orWhereRelation($relation, $column, 'like', "%$term%");
                }
                continue;
            }
            if(str_contains($searchable,'+'))
            {
                $columnCheckHasDate = Str::afterLast($searchable, '+');
                $columnHasDate = Str::beforeLast($searchable, '+');
                $builder->orWhereDate($columnHasDate, 'like', "%$term%");

            }else{
                    $builder->orWhere($searchable, 'like', "%$term%");
                }
        }
        return  $builder;
    }
    public function whereSearch($builder,$arraySearchable)
    {
        foreach($arraySearchable as $searchable=>$term)
        {
            if($term == null)
            {
                continue;
            }
            if(str_contains($searchable,'.'))
            {
                $relation = Str::beforeLast($searchable, '.');
                $column = Str::afterLast($searchable, '.');
                $columnCheckHasDate = Str::afterLast($column, '+');
                $columnHasDate = Str::beforeLast($column, '+');
               
                if($searchable == 'first_name' || $searchable == 'last_name')
                {
                    $builder->orWhereRelation($relation, $column, 'like', "%$term%");
                }else{
                    if($columnCheckHasDate == "date")
                    {
                        $builder->where(function($q)use($relation,$term,$columnHasDate){
                            $q->whereHas("$relation",function($qq)use($term,$columnHasDate){
                                $qq->whereDate("$columnHasDate", 'like', "%$term%");
                            });
                        });   
                    }else{
                        $builder->whereRelation($relation, $column, 'like', "%$term%");
                    }
                   
                }
                continue;
            }else{
                if($searchable == 'first_name' || $searchable == 'last_name')
                {
                    $builder->orWhere($searchable, 'like', "%$term%");
                }else{
                    if(str_contains($searchable,'+'))
                    {
                        $columnCheckHasDate = Str::afterLast($searchable, '+');
                        $columnHasDate = Str::beforeLast($searchable, '+');
                        $builder->whereDate($columnHasDate, 'like', "%$term%");
    
                    }else{
                        $builder->where($searchable, 'like', "%$term%");
    
                    }
                  
                }
            }
           
           
        }
        return  $builder;
    }




}

